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
// SearchAgentRun Class
///////////////////////////////////////

class SearchAgentRun {

	public $runid;
    public $agentid;
    public $userid;
    public $from;
    public $to;
    public $type;
    public $results;

    /**
     * Constructor
     *
     * @param string $runid (optional)
     * @return SearchAgentRun (this)
     */
    function SearchAgentRun($runid = ""){
        if ($runid != ""){
            $this->runid = $runid;
            return $this;
        }
    }

    /**
     * Loads the data for the SearchAgentRun from the database
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
		$params[0] = $this->runid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_AGENTRUN_SELECT, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count > 0) {
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];
					$this->agentid = $array['AgentID'];
					$this->userid = $array['UserID'];
					$this->from = $array['FromDate'];
					$this->to = $array['ToDate'];
					$this->type = $array['RunType'];
				}

				// This times out and breaks the Managed Structured Searches and their Agents popup (managesearches.php)
				$this->loadAgentRunResults();

			} else {
				return database_error("SearchAgentRun not found","7002");
			}
		} else {
			return database_error();
		}

        return $this;
    }

    /**
     * Load all the results for this run of the agent
     */
    function loadAgentRunResults() {
        global $DB,$HUB_SQL;

        $this->results = array();

		$params = array();
		$params[0] = $this->runid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_AGENTRUN_RESULTS_SELECT, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$connid = $array['TripleID'];

				$item = new Connection($connid);
				$item->load();
				if (isset($item->userid)) {
					array_push($this->results, $item);
				}
			}
		}
   }

    /**
     * Add new SearchAgent to the database
     *
     * @param string $agentid
     * @param double $from the time from whihc the search was run
     * @param double $to the tim to which the search was run
     * @param String $user the userid for this run
     * @param String type, who requested this run, the user themselves through an interface button push
     * or an automated process like a nightly cron: values = 'user' or 'auto'; default = 'user';
     * @param array $connections a list of connection which are the result of the run.
     * @return SearchAgentRun object (this) (or Error object)
     */
    function add($agentid, $from, $to, $userid, $type="user", $connections){
        global $DB,$CFG,$USER,$HUB_SQL;
        try {
            $this->canadd();
        } catch (Exception $e){
            return access_denied_error();
        }

        $this->runid = getUniqueID();

		$params = array();
		$params[0] = $this->runid;
		$params[1] = $agentid;
		$params[2] = $userid;
		$params[3] = $from;
		$params[4] = $to;
		$params[5] = $type;

		$resArray = $DB->insert($HUB_SQL->DATAMODEL_SEARCH_AGENTRUN_ADD, $params);
    	if ($resArray === false) {
           return database_error();
        }

        if (count($connections) > 0) {
	        foreach($connections as $conn) {

				$params = array();
				$params[0] = $this->runid;
				$params[1] = $conn->connid;

				$resArray = $DB->insert($HUB_SQL->DATAMODEL_SEARCH_AGENTRUN_ADD_RUN, $params);
				if ($resArray === false) {
				   return database_error();
				}
	        }
        }

        $this->load();
        return $this;
    }

    /**
     * Delete a SearchAgentRun
     */
    function delete(){
        global $DB,$CFG,$USER,$HUB_SQL;
        try {
            $this->candelete();
        } catch (Exception $e){
            return access_denied_error();
        }
        $dt = time();

		$params = array();
		$params[0] = $this->runid;

		$resArray = $DB->delete($HUB_SQL->DATAMODEL_SEARCH_AGENTRUN_DELETE, $params);
    	if ($resArray === false) {
           return database_error();
        }

        return new Result("deleted","true");
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
        //can view only if owner of the SearchAgent
        /*
		$params = array();
		$params[0] = $USER->userid;
		$params[1] = $this->runid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_AGENTRUN_CAN_VIEW, $params);
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
        //can edit only if owner of the Search

		$params = array();
		$params[0] = $USER->userid;
		$params[1] = $this->runid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_AGENTRUN_CAN_EDIT, $params);
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
        //can delete only if owner of the Search
		$params = array();
		$params[0] = $USER->userid;
		$params[1] = $this->runid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_AGENTRUN_CAN_DELETE, $params);
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