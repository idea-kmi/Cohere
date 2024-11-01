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
// Search Class
///////////////////////////////////////

class Search {

    public $searchid;
    public $userid;
    public $name;
    public $creationdate;
    public $modificationdate;
    public $scope;
    public $depth;
    public $focalnodeid;
    public $linktypes;
    public $linkgroup;
    public $linkset;
    public $direction;
	public $labelmatch;

    public $user;
    public $focalnode;
	public $agent = null;

	public $DIRECTION_OUTGOING = 'outgoing';
	public $DIRECTION_INCOMING = 'incoming';
	public $DIRECTION_BOTH = 'both';

	public $DIRECTION_OUTGOING_NUM = 0;
	public $DIRECTION_INCOMING_NUM = 1;
	public $DIRECTION_BOTH_NUM = 2;

    /**
     * Constructor
     *
     * @param string $searchid (optional)
     * @return Search (this)
     */
    function Search($searchid = ""){
        if ($searchid != ""){
            $this->searchid = $searchid;
            return $this;
        }
    }

    /**
     * Loads the data for the search from the database
     *
     * @return Search object (this)
     */
    function load() {

        global $DB,$HUB_SQL;
        try {
            $this->canview();
        } catch (Exception $e){
            return access_denied_error();
        }

		$params = array();
		$params[0] = $this->searchid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_SELECT, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count > 0) {
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];
					$this->userid = $array['UserID'];
					$this->name = stripslashes($array['Name']);
					$this->creationdate = $array['CreationDate'];
					$this->modificationdate = $array['ModificationDate'];
					$this->scope = $array['Scope'];
					$this->depth = $array['Depth'];
					$this->focalnodeid = $array['FocalNode'];
					$this->linktypes = $array['LinkTypes'];
					$this->linkgroup = $array['LinkGroup'];
					$this->linkset = $array['LinkSet'];

					$directiondata = $array['Direction'];
					if ($directiondata == $this->DIRECTION_OUTGOING_NUM) {
						$this->direction = $this->DIRECTION_OUTGOING;
					} else if ($directiondata == $this->DIRECTION_INCOMING_NUM) {
						$this->direction = $this->DIRECTION_INCOMING;
					} else {
						$this->direction = $this->DIRECTION_BOTH;
					}

					$labelmatchdata = $array['LabelMatch'];
					if ($labelmatchdata == 0) {
						$this->labelmatch = false;
					} else {
						$this->labelmatch = true;
					}

					if ($this->focalnodeid && $this->focalnodeid != null) {
						$this->focalnode = new cnode($this->focalnodeid);
					}

					$this->user = new user($this->userid);
					$this->user->load();
				}
			} else {
				 return database_error("Search not found","7002");
			}
		} else {
			return database_error();
		}

		// load any associated agent - should only be 1 at most.
		$this->loadAgents();

        return $this;
    }

	/**
	 * Load any agents this search has against it.
	 */
	function loadAgents() {
        global $DB, $HUB_SQL;

		$params = array();
		$params[0] = $this->searchid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_SELECT_AGENT, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$this->agent = new SearchAgent($array['AgentID']);
				$this->agent->load();
			}
		}
	}

    /**
     * Add new Search to the database
     *
     * @param string $name
     * @param string $scope
     * @param int $depth; 1-7
     * @param string $focalnodeid
     * @param string $linktypes - a comma separated list of linktypes
     * @param string $linkgroup (Positive, Neutral, Negative)
     * @param string $linkset (predefined collections)
     * @param string $direction; incoming or outgoing, default is both: database 0=outgoing, 1=incoming, 2=both directions;
     * @param boolean $labelmatch true to match node labels, false not to. Default is false.
     * @return Search object (this) (or Error object)
     */
    function add($name, $scope="my", $depth=1, $focalnodeid="", $linktypes = "", $linkgroup="", $linkset="", $direction='both', $labelmatch = false){
        global $DB,$CFG,$USER,$HUB_SQL;

        try {
            $this->canadd();
        } catch (Exception $e){
            return access_denied_error();
        }

		$directiondata = $this->DIRECTION_OUTGOING_NUM;
		if ($direction == $this->DIRECTION_INCOMING) {
			$directiondata = $this->DIRECTION_INCOMING_NUM;
		} else if ($direction == $this->DIRECTION_BOTH) {
			$directiondata = $this->DIRECTION_BOTH_NUM;
		}

		$labelmatchdata = 0;
		if ($labelmatch) {
			$labelmatchdata = 1;
		}

        $dt = time();

        $this->searchid = getUniqueID();

		$params = array();
		$params[0] = $this->searchid;
		$params[1] = $USER->userid;
		$params[2] = $name;
		$params[3] = $dt;
		$params[4] = $dt;
		$params[5] = $scope;
		$params[6] = $depth;
		$params[7] = $focalnodeid;
		$params[8] = $linktypes;
		$params[9] = $linkgroup;
		$params[10] = $linkset;
		$params[11] = $directiondata;
		$params[12] = $labelmatchdata;

		$resArray = $DB->insert($HUB_SQL->DATAMODEL_SEARCH_ADD, $params);
    	if ($resArray === false) {
           return database_error();
        }

        $this->load();
        return $this;
    }

    /**
     * Edit a Search
     *
     * @param string $name
     * @param string $scope
     * @param int $depth; 1-7
     * @param string $focalnodeid
     * @param string $linktypes - a comma separated list of linktypes
     * @param string $linkgroup (Positive, Neutral, Negative)
     * @param string $linkset (predefined collections)
     * @param string $direction; outgoing or incoming, default is both: database 0=outgoing, 1=incoming, 2=both directions;
     * @param boolean $labelmatch true to match node labels, false not to. Deault is false.
     */
    function edit($name, $scope="my", $depth=1, $focalnodeid="", $linktypes = "", $linkgroup="", $linkset="", $direction='both', $labelmatch = false){

        global $DB,$CFG,$USER,$HUB_SQL;
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }
        $dt = time();

		$directiondata = $this->DIRECTION_OUTGOING_NUM;
		if ($direction == $this->DIRECTION_INCOMING) {
			$directiondata = $this->DIRECTION_INCOMING_NUM;
		} else if ($direction == $this->DIRECTION_BOTH) {
			$directiondata = $this->DIRECTION_BOTH_NUM;
		}

		$labelmatchdata = 0;
		if ($labelmatch) {
			$labelmatchdata = 1;
		}

		$params = array();
		$params[0] = $dt;
		$params[1] = $name;
		$params[2] = $scope;
		$params[3] = $depth;
		$params[4] = $focalnodeid;
		$params[5] = $linktypes;
		$params[6] = $linkgroup;
		$params[7] = $linkset;
		$params[8] = $directiondata;
		$params[9] = $labelmatchdata;
		$params[10] = $this->searchid;

		$resArray = $DB->insert($HUB_SQL->DATAMODEL_SEARCH_EDIT, $params);
    	if ($resArray === false) {
			return database_error();
        }

        $this->load();
        return $this;
    }

    /**
     * Delete a Search
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
		$params[0] = $this->searchid;

		$resArray = $DB->delete($HUB_SQL->DATAMODEL_SEARCH_DELETE, $params);
    	if ($resArray === false) {
           return database_error();
        }

        return new Result("deleted","true");
    }

	/**
	 * Return a a SearchAgentRun
	 * @param String type, who requested this run, the user themselves through an interface button push
	 * or an automated process like a nightly cron: values = 'user' or 'auto'; default = 'user';
	 * @return SearchAgentRun or Error
	 */
   function runSearchAgent($type="user") {
        global $DB,$USER,$CFG,$ERROR;

        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        if ($this->agent) {
            $selectedLinks = $this->linktypes;
    		if ($selectedLinks == "" && $this->linkset != "") {
    		    $lts = new LinkTypeSet();
    		    $lts->load();
    			$selectedlinks = $lts->getDefinedLinkSet($this->linkset);
    		}

        	$labelmatchdata = 'false';
        	if ($this->labelmatch) {
        		$labelmatchdata = 'true';
        	}

        	$connectionset = getConnectionsByPath($this->focalnodeid, $selectedLinks, "", $this->scope, $this->linkgroup, $this->depth, $this->direction, $labelmatchdata);
        	if ($connectionset instanceof error) {
        		return $connectionset;
        	}

        	/*$filteredConns = new ConnectionSet();

           	$lastruntime = $this->agent->lastrun;

        	$connections = $connectionset->connections;
        	$loopcount = count($connections);
        	for ($i= 0; $i < $loopcount; $i++) {
       			$filteredConns->add($connections[$i]);
        	}
        	$filteredConns->totalno = count($filteredConns->connections);
        	$filteredConns->start = 0;
        	$filteredConns->count = $filteredConns->totalno;
        	*/

        	$from = $this->agent->lastrun;
        	$to = time();

        	$agentrun = $this->agent->addAgentRun($from, $to, $type, $connectionset->connections);

         	return $agentrun;
    	} else {
            $ERROR = new Hub_Error;
            $ERROR->message = "No agent";
    		return $ERROR;
    	}
    }

	/**
	 * Return a connection set of the search result with new connections marked as isNew="Y"
	 * comparing run result to the previous run, or if no previous run, the the creation date of the agent.
	 * @param $runid the agent run id of the run to make.
	 * @return ConnectionSet or Error
	 */
   function loadSearchAgentRun($runid) {
       global $DB,$USER,$CFG,$ERROR;

       try {
           $this->canview();
       } catch (Exception $e){
           return access_denied_error();
       }

       if ($this->agent) {
	       	$run = $this->agent->getRun($runid);
	       	if ($run != null) {
		       	$filteredConns = new ConnectionSet();

		       	$previousrun = $this->agent->getPreviousRun($run);
		       	if ($previousrun != null) {
			       	foreach($run->results as $connection) {

			       		$found = false;
			       		foreach($previousrun->results as $previousconn) {
			       			if ($connection->connid == $previousconn->connid) {
			       				$found = true;
			       			}
			       		}
			       		if ($found === false) {
			       			$connection->isNew = "Y";
			       		} else {
			       			$connection->isNew = "N";
			       		}

		       			$filteredConns->add($connection);
			       	}
		       	} else {
		       		//mark all those connections whose creation date is greater than the agent creationdate date
		           	$creationdate = $this->agent->creationdate;
			       	foreach($run->results as $connection) {
			       		if ($connection->creationdate > $creationdate) {
			       			$connection->isNew = "Y";
			       		} else {
			       			$connection->isNew = "N";
			       		}
		       			$filteredConns->add($connection);
			       	}
		       	}


		       	$filteredConns->totalno = count($filteredConns->connections);;
		       	$filteredConns->start = 0;
		       	$filteredConns->count = $filteredConns->totalno;

		        return $filteredConns;
	       	} else {
		        $ERROR = new Hub_Error;
		        $ERROR->message = "No agent run found";
		   		return $ERROR;
	       	}
	   	} else {
	        $ERROR = new Hub_Error;
	        $ERROR->message = "No agent found";
	   		return $ERROR;
	   	}
   }

	/**
	 * Return a connection set of only the new connections for the given agent runid
	 * compared to the previous run, or if no previous run, the the creation date of the agent.
	 * @param $runid the agent run id of the run to get new connections for.
	 * @return ConnectionSet or Error
	 */
   function getNewConnections($runid) {
      global $DB,$USER,$CFG,$ERROR;

      try {
          $this->canview();
      } catch (Exception $e){
          return access_denied_error();
      }

      if ($this->agent) {
	       	$run = $this->agent->getRun($runid);
	       	if ($run != null) {
		       	$filteredConns = new ConnectionSet();

		       	$previousrun = $this->agent->getPreviousRun($run);
		       	if (isset($run->results)) {
					if ($previousrun != null) {
						foreach($run->results as $connection) {

							$found = false;
							foreach($previousrun->results as $previousconn) {
								if ($connection->connid == $previousconn->connid) {
									$found = true;
								}
							}
							if ($found === false) {
								$connection->isNew = "Y";
								$filteredConns->add($connection);
							}
						}
					} else {
						//mark all those connections whose creation date is greater than the agent creationdate date
						$creationdate = $this->agent->creationdate;
						foreach($run->results as $connection) {
							if ($connection->creationdate > $creationdate) {
								$connection->isNew = "Y";
								$filteredConns->add($connection);
							}
						}
					}
				}

		       	$filteredConns->totalno = count($filteredConns->connections);
		       	$filteredConns->start = 0;
		       	$filteredConns->count = $filteredConns->totalno;

		        return $filteredConns;
	       	} else {
		        $ERROR = new Hub_Error;
		        $ERROR->message = "No agent run found";
		   		return $ERROR;
	       	}
	   	} else {
	        $ERROR = new Hub_Error;
	        $ERROR->message = "No agent found";
	   		return $ERROR;
	   	}
   }


   /////////////////////////////////////////////////////
   // security functions
   /////////////////////////////////////////////////////

    /**
     * Check whether the current user can view the current Search
     *
     * @throws Exception
     */
    function canview(){
        global $DB,$USER,$HUB_SQL,$LNG;

        if(api_check_login() instanceof Error){
            throw new Exception("access denied");
        }

        //can view only if owner of the Search

		$params = array();
		$params[0] = $USER->userid;
		$params[1] = $this->searchid;

		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_CAN_VIEW, $params);

    	if ($resArray !== false) {
			if (count($resArray) == 0) {
	            throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
	        }
		} else {
			throw new Exception("access denied");
		}
     }

    /**
     * Check whether the current user can add a Search
     *
     * @throws Exception
     */
    function canadd(){
        global $LNG;

        // needs to be logged in that's all!
        if(api_check_login() instanceof Error){
            throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
        }
    }

    /**
     * Check whether the current user can edit the current Search
     *
     * @throws Exception
     */
    function canedit(){
        global $DB,$USER,$HUB_SQL,$LNG;
        if(api_check_login() instanceof Error){
            throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
        }

		$params = array();
		$params[0] = $USER->userid;
		$params[1] = $this->searchid;

		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_CAN_EDIT, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count == 0) {
				throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
			}
		} else {
			throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
		}
    }

    /**
     * Check whether the current user can delete the current Search
     *
     * @throws Exception
     */
    function candelete(){
        global $DB,$USER,$HUB_SQL,$LNG;
        if(api_check_login() instanceof Error){
            throw new Exception("access denied");
        }

		$params = array();
		$params[0] = $USER->userid;
		$params[1] = $this->searchid;

		$resArray = $DB->select($HUB_SQL->DATAMODEL_SEARCH_CAN_DELETE, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count == 0) {
				throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
			}
		} else {
			throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
		}
    }
}
?>