<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2007-2024 The Open University UK                              *
 *                                                                              *
 *  This software is freely distributed in accordance with                      *
 *  the GNU Lesser General Public (LGPL) license, version 3 or later            *
 *  as published by the Free Software Foundation.                               *
 *  For details see LGPL: http://www.fsf.org/licensing/licenses/lgpl.html       *
 *               and GPL: http://www.fsf.org/licensing/licenses/gpl-3.0.html    *
 *                                                                              *
 *  This software is provided by the copyright holders and contributors "as is" *
 *  and any express or implied warranties, including, but not limited to, the   *
 *  implied warranties of merchantability and fitness for a particular purpose  *
 *  are disclaimed. In no event shall the copyright owner or contributors be    *
 *  liable for any direct, indirect, incidental, special, exemplary, or         *
 *  consequential damages (including, but not limited to, procurement of        *
 *  substitute goods or services; loss of use, data, or profits; or business    *
 *  interruption) however caused and on any theory of liability, whether in     *
 *  contract, strict liability, or tort (including negligence or otherwise)     *
 *  arising in any way out of the use of this software, even if advised of the  *
 *  possibility of such damage.                                                 *
 *                                                                              *
 ********************************************************************************/

///////////////////////////////////////
// SearchAgent Class
///////////////////////////////////////

class SearchAgent {

    public $agentid;
    public $userid;
    public $searchid;
    public $creationdate;
    public $modificationdate;
    public $lastrun;
    public $email;
    public $runinterval;

    public $user;

    public $agentruns;

    /**
     * Constructor
     *
     * @param string $agentid (optional)
     * @return SearchAgent (this)
     */
    function SearchAgent($agentid = ""){
        if ($agentid != ""){
            $this->agentid = $agentid;
            return $this;
        }
    }

    /**
     * Loads the data for the SearchAgent from the database
     *
     * @return SearchAgent object (this)
     */
    function load() {
        global $DB,$HUB_SQL;

        try {
			$this->canview();
		} catch (Exception $e){
            return access_denied_error();
        }

		$params = array();
		$params[0] = $this->agentid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_AGENT_SELECT, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];

				$this->userid = $array['UserID'];
				$this->searchid = stripslashes($array['SearchID']);
				$this->creationdate = $array['CreationDate'];
				$this->modificationdate = $array['ModificationDate'];
				$this->lastrun = $array['LastRun'];
				$this->email = $array['Email'];
				$this->runinterval = $array['RunInterval'];

				//$this->user = new user($this->userid);
			}
        	$this->loadAgentRuns();
        } else {
             return database_error("SearchAgent not found","7002");
        }

        return $this;
    }

    /**
     * Load all the data about the runs of this agent
     */
    function loadAgentRuns() {
        global $DB,$HUB_SQL;

        $this->agentruns = array();

		$params = array();
		$params[0] = $this->agentid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_AGENT_RUN_SELECT, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
	            $runid = $array['RunID'];
	            $item = new SearchAgentRun($runid);
	            array_push($this->agentruns,$item->load());
			}
        }
   }

    /**
     * Add new SearchAgent to the database
     *
     * @param string $searchid
     * @param boolean $email
     * @param string $runinterval
     * @return SearchAgent object (this) (or Error object)
     */
    function add($searchid, $email=false, $runinterval="monthly"){
        global $DB,$CFG,$USER,$HUB_SQL;
        try {
            $this->canadd();
        } catch (Exception $e){
            return access_denied_error();
        }
        $dt = time();

		$emaildata = 0;
		if ($email) {
			$emaildata = 1;
		}

        $this->agentid = getUniqueID();

		$params = array();
		$params[0] = $this->agentid;
		$params[1] = $USER->userid;
		$params[2] = $searchid;
		$params[3] = $dt;
		$params[4] = $dt;
		$params[5] = $dt;
		$params[6] = $emaildata;
		$params[7] = $runinterval;

		$resArray = $DB->insert($HUB_SQL->DATAMODEL_SEARCH_AGENT_ADD, $params);
    	if ($resArray === false) {
           return database_error();
        }

        $this->load();
        return $this;
    }

    /**
     * Edit a SearchAgent
     *
     * @param string $searchid
     * @param boolean $email
     * @param string $runinterval
     * @return SearchAgent object (this) (or Error object)
     */
    function edit($email=false, $runinterval="monthly"){
        global $DB,$CFG,$USER,$HUB_SQL;

        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }
        $dt = time();

		$emaildata = 0;
		if ($email) {
			$emaildata = 1;
		}

		$params = array();
		$params[0] = $dt;
		$params[1] = $emaildata;
		$params[2] = $runinterval;
		$params[3] = $this->agentid;

		$resArray = $DB->insert($HUB_SQL->DATAMODEL_SEARCH_AGENT_EDIT, $params);
    	if ($resArray === false) {
			return database_error();
        }

        $this->load();
        return $this;
    }

    /**
     * Update the LastRun time for this SearchAgent
     *
     * @param string $lastrun
     * @return SearchAgent object (this) (or Error object)
     */
    function updateLastRun($lastrun=0){
        global $DB,$HUB_SQL;
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

		$params = array();
		$params[0] = $lastrun;
		$params[1] = $this->agentid;

		$resArray = $DB->insert($HUB_SQL->DATAMODEL_SEARCH_AGENT_UPDATE_LASTRUN, $params);
    	if ($resArray === false) {
			return database_error();
        } else {
        	$this->lastrun = $lastrun;
        }

        return $this;
    }

    /**
     * Create a new SearchAgentRun and store the results of this run.
     * @param double $from the time from whihc the search was run
     * @param double $to the tim to which the search was run
     * @param String type, who requested this run, the user themselves through an interface button push
     * or an automated process like a nightly cron: values = 'user' or 'auto'; default = 'user';
     * @param array $connections a list of connection which are the result of the run.
     */
    function addAgentRun($from, $to, $type='user', $connections) {

    	$run = new SearchAgentRun();
    	$results = $run->add($this->agentid, $from, $to, $this->userid, $type, $connections);

    	if (!$results instanceof error) {
    		$this->updateLastRun($to);
    		$this->loadAgentRuns();
    	}

    	return $results;
    }

    /**
     * Delete a SearchAgent
     */
    function delete(){
        global $DB,$CFG,$USER;
        try {
            $this->candelete();
        } catch (Exception $e){
            return access_denied_error();
        }
        $dt = time();

		$params = array();
		$params[0] = $this->agentid;

		$resArray = $DB->delete($HUB_SQL->DATAMODEL_SEARCH_AGENT_DELETE, $params);
    	if ($resArray === false) {
			database_error();
		}

        return new Result("deleted","true");
    }

    /**
     * Return the SearchAgentRun object for the given run id
     * @param $runid the runid of the agent run to return;
     * @return SearchAgentRun object or null;
     */
    function getRun($runid) {
    	if ($this->agentruns) {
	    	foreach($this->agentruns as $run) {
	    		if ($run && $run->runid && $run->runid === $runid) {
	    			return $run;
	    		}
	    	}
    	}
    	return null;
    }

    /**
     * Return the SearchAgentRun object previous to the given run id
     * @param $run the SearchAgentRun to find the previous run for.
     * @return SearchAgentRun object or null;
     */
    function getPreviousRun($run) {
        global $DB,$USER,$HUB_SQL;

    	$previousrun = null;

		$params = array();
		$params[0] = $run->from;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_AGENT_SELECT_PREVIOUS_RUN, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count > 0) {
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];
					$runid = $array['RunID'];
				}
				$previousrun = $this->getRun($runid);
			}
		}

		return $previousrun;
    }

    /**
     * Return the newest agent run or null
     */
    function getLastAgentRun() {
    	//runs are loaded in order of newest first.
    	if ($this->agentruns && count($this->agentruns) > 0) {
    		return $this->agentruns[0];
    	}

    	return null;
    }


    /////////////////////////////////////////////////////
    // security functions
    /////////////////////////////////////////////////////

    /**
     * Check whether the current user can view the current SearchAgent
     *
     * @throws Exception
     */
    function canview(){
        global $DB,$USER,$HUB_SQL;
        if(api_check_login() instanceof Error){
            throw new Exception("access denied");
        }
        /*
		$params = array();
		$params[0] = $USER->userid;
		$params[1] = $this->agentid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_CAN_VIEW, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count == 0) {
				throw new Exception("access denied");
			}
		} else {
			throw new Exception("access denied");
		}
		*/
    }

    /**
     * Check whether the current user can add a SearchAgent
     *
     * @throws Exception
     */
    function canadd(){
        // needs to be logged in that's all!
        if(api_check_login() instanceof Error){
            throw new Exception("access denied");
        }
    }

    /**
     * Check whether the current user can edit the current SearchAgent
     *
     * @throws Exception
     */
    function canedit(){
        global $DB,$USER,$HUB_SQL;
        if(api_check_login() instanceof Error){
            throw new Exception("access denied");
        }

		$params = array();
		$params[0] = $USER->userid;
		$params[1] = $this->agentid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_AGENT_CAN_EDIT, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count == 0) {
				throw new Exception("access denied");
			}
		} else {
			throw new Exception("access denied");
		}
    }

    /**
     * Check whether the current user can delete the current SearchAgent
     *
     * @throws Exception
     */
    function candelete(){
        global $DB,$USER,$HUB_SQL;
        if(api_check_login() instanceof Error){
            throw new Exception("access denied");
        }
		$params = array();
		$params[0] = $USER->userid;
		$params[1] = $this->agentid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_AGENT_CAN_DELTE, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count == 0) {
				throw new Exception("access denied");
			}
		} else {
			throw new Exception("access denied");
		}
    }
}
?>