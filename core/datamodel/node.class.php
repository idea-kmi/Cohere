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
// Node Class
///////////////////////////////////////

class CNode {

    public $nodeid;
    public $name;
    public $creationdate;
    public $modificationdate;
    public $private;
    public $users;
    public $otheruserconnections;
    public $isbookmarked;
    public $status = 0;

    /*
     * The following is commented out to prevent empty properties appearing as
     * it just uses up more space when getting the node/connection
     *
    public $description;
    public $startdatetime;
    public $enddatetime;
    public $location;
    public $countrycode;
    public $country;
    public $locationlat;
    public $locationlng;
    public $urls;
    public $groups;
    public $tags;
    public $imageurlid;
    public $imagethumbnail;
    public $role;
    public $positivevotes = 0;
    public $negativevotes = 0;
    public $uservote;
    public $connectedness;
    */

    /**
     * Constructor
     *
     * @param string $nodeid (optional)
     * @return Node (this)
     */
    function CNode($nodeid = ""){
        if ($nodeid != ""){
            $this->nodeid = $nodeid;
            return $this;
        }
    }

    /**
     * Loads the data for the node from the database
     *
     * @param String $style (optional - default 'long') may be 'short' or 'long' or 'mini' (mini used for graphs)
     * @return Node object (this)
     */
    function load($style = 'long') {
        global $DB,$CFG,$USER,$ERROR,$HUB_FLM,$HUB_SQL;

        try {
            $this->canview();
        } catch (Exception $e){
            return access_denied_error();
        }

		$params = array();
		$params[0] = $this->nodeid;

        // without Themes
        $resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_SELECT, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count == 0) {
				$ERROR = new Hub_Error;
				$ERROR->createNodeNotFoundError($this->nodeid);
				return $ERROR;
			} else {
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];
					$this->name = stripslashes(trim($array['Name']));
					$this->connectedness = $array['connectedness'];
					$this->creationdate = $array['CreationDate'];
					$this->modificationdate = $array['ModificationDate'];
					$this->private = $array['Private'];
					$this->users = array();
					$this->users[0] = getUser($array['UserID'],$style);
					if(isset($array['StartDate']) && $array['StartDate'] != 0){
						$this->startdatetime = $array['StartDate'];
					}
					if(isset($array['EndDate']) && $array['EndDate'] != 0){
						$this->enddatetime = $array['EndDate'];
					}
					if(isset($array['LocationText'])){
						$this->location = $array['LocationText'];
					} else {
						$this->location = '';
					}
					if(isset($array['LocationCountry'])){
						$cs = getCountryList();
						$this->countrycode = $array['LocationCountry'];
						if (isset($cs[$array['LocationCountry']])) {
							$this->country = $cs[$array['LocationCountry']];
						}
					}
					if(isset($array['LocationLat'])){
						$this->locationlat = $array['LocationLat'];
					}
					if(isset($array['LocationLng'])){
						$this->locationlng = $array['LocationLng'];
					}
					if(isset($array['Image'])){
					    $this->imageurlid = $array['Image'];
					}
					if(isset($array['ImageThumbnail'])){
					    $this->imagethumbnail = $array['ImageThumbnail'];
					}

					if(isset($array['NodeTypeID'])){
						$this->role = new Role($array['NodeTypeID']);
						$this->role->load();
					}
					if (isset($array['CurrentStatus'])) {
						$this->status = $array['CurrentStatus'];
					}
					if (trim($array['Description']) != "") {
						$this->hasdesc = true;
					}

					if ($style == 'long') {
						$this->description = stripslashes(trim($array['Description']));
					}
				}
			}
        } else {
        	return database_error();
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = $this->nodeid;
		$params[2] = $currentuser;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_EXTERNAL_CONNECTIONS, $params);
		if ($resArray !== false) {
			if(count($resArray) > 0 ){
				$this->otheruserconnections = $resArray[0]['connectedness'];
			} else {
				$this->otheruserconnections = 0;
			}
		}

		//check if it's in the current user's bookmarks
		$this->isbookmarked = false;
		$params = array();
		$params[0] = $currentuser;
		$params[1] = $this->nodeid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_BOOKMARKED, $params);
		if ($resArray !== false) {
			if(count($resArray) > 0 ){
				$this->isbookmarked = true;
			}
		}

        if ($style == 'long'){
	        $this->loadWebsites($style);
	        $this->loadTags();
	        $this->loadGroups();
	        $this->loadVotes();
        }

        return $this;
    }

	/**
	 * Load Associated vote counts
	 */
	function loadVotes() {
        global $DB,$CFG,$USER,$HUB_SQL;

        //load positive votes

		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = 'Y';
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_VOTES, $params);
		if ($resArray !== false) {
			if(count($resArray) > 0 ){
        		$this->positivevotes = $resArray[0]['VoteCount'];
        	}
		} else {
			$this->positivevotes = 0;
		}

        //load negative votes
		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = 'N';
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_VOTES, $params);
		if ($resArray !== false) {
			if(count($resArray) > 0 ){
        		$this->negativevotes = $resArray[0]['VoteCount'];
        	}
		} else {
        	$this->negativevotes = 0;
		}

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

        //load the current user's vote for this node if any
        $this->uservote = '0';
		$params = array();
		$params[0] = $currentuser;
		$params[1] = $this->nodeid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_VOTES_USER, $params);
		if ($resArray !== false) {
			if(count($resArray) > 0 ){
            	$this->uservote = $resArray[0]['VoteType'];
            }
       	}
	}

	/**
	 * Load Associated websites
     * @param String $style (optional - default 'long') may be 'short' or 'long'
	 */
	function loadWebsites($style = 'long') {
        global $DB,$CFG,$USER,$HUB_SQL;

		$params = array();
		$params[0] = $this->nodeid;

		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_URLS, $params);
		if ($resArray !== false) {
			$count = count($resArray);
			if($count > 0 ){
				$this->urls = array();
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];

					// make sure url associated with this node can actually be seen by the current user.
					// if they can see the node they should really be able to see the url
					// but not necessarily
					try {
						$url = new URL(trim($array['URLID']));
						array_push($this->urls,$url->load($style));
					} catch (Exception $e){
						//return access_denied_error();
					}
				}

				usort($this->urls, 'titleSort');
			}
        } else {
        	return database_error();
        }
	}

	/**
	 * Load associated tags
	 */
	function loadTags() {
        global $DB,$CFG,$USER,$HUB_SQL;

		$params = array();
		$params[0] = $this->nodeid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_TAGS, $params);
		if ($resArray !== false) {
			$count = count($resArray);
			if(count($resArray) > 0 ){
            	$this->tags = array();
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];
	                $tag = new Tag(trim($array['TagID']));
	                array_push($this->tags,$tag->load());
	            }
            }
        } else {
        	return database_error();
        }
	}

	/**
	 * Load groups
	 */
	function loadGroups() {
        global $DB,$CFG,$USER,$HUB_SQL;

		$params = array();
		$params[0] = $this->nodeid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_GROUPS, $params);
		if ($resArray !== false) {
			$count = count($resArray);
			if($count > 0 ){
            	$this->groups = array();
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];
	                $group = new Group(trim($array['GroupID']));
	                array_push($this->groups,$group->load());
	            }
            }
        } else {
        	return database_error();
        }
	}

    /**
     * Add new node to the database
     *
     * @param string $name
     * @param string $desc
     * @param string $private optional, can be Y or N, defaults to users preferred setting
     * @param string $nodetypeid optional, the id of the nodetype this node is, defaults to 'Idea' node type id.
     * @param string $imageurlid optional, the local server path to the image of the image used for this node
     * @param string $imagethumbnail optional, the local server path to the thumbnail of the image used for this node
     * @return Node object (this) (or Error object)
     */
    function add($name,$desc="",$private,$nodetypeid="",$imageurlid="",$imagethumbnail=""){
        global $DB,$CFG,$USER,$HUB_SQL;

        try {
            $this->canadd();
        } catch (Exception $e){
            return access_denied_error();
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		// No transclusion in the debate hub
		$params = array();
		$params[0] = $currentuser;
		$params[1] = $name;
		$params[2] = $nodetypeid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_ADD_CHECK, $params);
		if ($resArray !== false) {
			if(count($resArray) > 0 ){
		    	 $this->nodeid = $resArray[0]["NodeID"];
			} else {
				$dt = time();
				$this->nodeid = getUniqueID();

				$params = array();
				$params[0] = $this->nodeid;
				$params[1] = $currentuser;
				$params[2] = $dt;
				$params[3] = $dt;
				$params[4] = $name;
				$params[5] = $desc;
				$params[6] = $private;
				$params[7] = $nodetypeid;
				$params[8] = $imageurlid;
				$params[9] = $imagethumbnail;

				$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_ADD, $params);
				if (!$res) {
					return database_error();
				} else {
					/*
					if ($CFG->TWITTER_STREAM_ON == "Y" && $private == "N") {
						$twitterURL = $CFG->homeAddress."node.php?nodeid=".$this->nodeid."#conn-neighbour";
						$defaultUser = new User($CFG->defaultUserID);
						$defaultUser->load('short');
						$key = $defaultUser->getTwitterKey();
						$secret = $defaultUser->getTwitterSecret();
 						if ($key  != "" && $secret != "") {
                			tweet($name, $USER->name, $twitterURL, $key, $secret);
                		}
                	}*/

					$this->load();
					auditIdea($currentuser, $this->nodeid, $name, $desc, $CFG->actionAdd,format_object('xml',$this));
				}
			}
		} else {
			return database_error();
		}

        return $this;
    }

    /**
     * Edit a node
     *
     * @param string $name
     * @param string $desc
     * @param string $private optional, can be Y or N, defaults to users preferred setting
     * @param string $nodetypeid optional, the urlid of the url for the image that is being used as this node's icon.
     * @param string $imageurlid optional, the urlid of the url for the image that is being used as this node's icon
     * @param string $imagethumbnail optional, the local server path to the thumbnail of the image used for this node
     *
     * @return Node object (this) (or Error object)
     */
    function edit($name,$desc,$private,$nodetypeid="",$imageurlid="",$imagethumbnail=""){
        global $CFG,$DB,$USER,$HUB_SQL,$HUB_FLM;
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		// no translusions
		$params = array();
		$params[0] = $currentuser;
		$params[1] = $name;
		$params[2] = $nodetypeid;
		$params[3] = $this->nodeid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_EDIT_CHECK, $params);
		if ($resArray !== false) {
			if(count($resArray) > 0 ){
	            return duplication_error("A node with this label and type already exists.");
			} else {
	        	$dt = time();

				$params = array();
				$params[0] = $dt;
				$params[1] = $name;
				$params[2] = $desc;
				$params[3] = $private;
				$params[4] = $nodetypeid;
				$params[5] = $imageurlid;
				$params[6] = $imagethumbnail;
				$params[7] = $this->nodeid;
				$params[8] = $currentuser;
				$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_EDIT, $params);

				//remove old image if new image added or old one deleted
				if (isset($this->filename) && $this->filename !="" && $this->filename != $imageurlid) {
					$originalphotopath = $HUB_FLM->createUploadsDirPath($imagedir."/".stripslashes($this->filename));
					$originalphotopaththumb = $HUB_FLM->createUploadsDirPath($imagedir."/".str_replace('.','_thumb.', stripslashes($this->filename)));
					unlink($this->originalphotopath);
					unlink($this->originalphotopaththumb);
				}

				if ($res) {
					//update labels in Triple Table
					$params = array();
					$params[0] = $name;
					$params[1] = $this->nodeid;
					$params[2] = $currentuser;
					$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_EDIT_UPDATE_TRIPLE_TO, $params);
					$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_EDIT_UPDATE_TRIPLE_FROM, $params);
				} else {
					return database_error();
				}

				$this->load();
				auditIdea($USER->userid, $this->nodeid, $name, $desc, $CFG->actionEdit,format_object('xml',$this));
			}
		} else {
			return database_error();
		}

        return $this;
    }

    /**
     * Delete node
     *
     * @return Result object (or Error object)
     */
    function delete(){
        global $DB,$CFG,$USER,$HUB_FLM,$HUB_SQL;

        $this->load();

        try {
            $this->candelete();
        } catch (Exception $e){
            return access_denied_error();
        }

        $dt = time();

		$this->load();
		$xml = format_object('xml',$this);

		$params = array();
		$params[0] = $this->nodeid;
		$res = $DB->delete($HUB_SQL->DATAMODEL_NODE_DELETE, $params);
        if ($res) {
            auditIdea($USER->userid, $this->nodeid, $this->name, $this->description, $CFG->actionDelete, $xml);

            // NOT SURE THIS IS REQUIRED NOW AS IT SHOULD HAPPEN ON CASCADE DELETE IN THE DATABASE
            // update the related connections (triples)
			$params = array();
			$params[0] = $this->nodeid;
			$params[1] = $this->nodeid;
			$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_DELETE_TRIPLE, $params);
            if($resArray !== false){
            	$count = count($resArray);
            	for ($i=0; $i<$count; $i++) {
            		$array = $resArray[$i];
                    $conn = new Connection($array['TripleID']);
                    $conn->delete();
                }
            } else {
                 return database_error();
            }

            //update the related URLs
			$params = array();
			$params[0] = $this->nodeid;
			$res3 = $DB->delete($HUB_SQL->DATAMODEL_NODE_DELETE_URLNODE, $params);
            if (!$res3) {
                return database_error();
            }

            // Take this opportunity to delete any URLs if they are no longer connected to a node
            // Probably should do this in a more organized way!
			$params = array();
			$res4Array = $DB->select($HUB_SQL->DATAMODEL_NODE_DELETE_URLS_CLEAN, $params);
            if ($res4Array !== false) {
            	$count = count($res4Array);
            	for ($i=0; $i<$count; $i++) {
            		$array = $res4Array[$i];
                    $url = new URL($array['URLID']);
                    $url->delete();
                }
            }
        } else {
            return database_error();
        }

        //remove old thumbnail
        if (isset($this->imagethumbnail) && $this->imagethumbnail != null && $this->imagethumbnail !="" && substr($this->imagethumbnail,0,7) == 'uploads') {
            unlink($HUB_FLM->createUploadsDirPath($this->imagethumbnail));
        }

        return new Result("deleted","true");
    }

    function vote($vote){
        global $DB,$USER,$HUB_SQL,$CFG;
        try {
            $this->canview();
        } catch (Exception $e){
            return access_denied_error();
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		$params = array();
		$params[0] = $currentuser;
		$params[1] = $this->nodeid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_VOTE_CHECK, $params);
		if($resArray !== false){
			if (count($resArray) == 0) {
				$dt = time();
				$params = array();
				$params[0] = $currentuser;
				$params[1] = $this->nodeid;
				$params[2] = $vote;
				$params[3] = $dt;
				$params[4] = $dt;
				$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_VOTE_ADD, $params);
				if(!$res){
					return database_error();
				}
			} else {
				$dt = time();
				$params = array();
				$params[0] = $dt;
				$params[1] = $vote;
				$params[2] = $currentuser;
				$params[3] = $this->nodeid;
				$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_VOTE_EDIT, $params);
				if(!$res){
					return database_error();
				}
			}
		} else {
			return database_error();
		}

        $this->load();
        return $this;
    }

    function deleteVote($vote){
        global $DB,$USER,$HUB_SQL,$CFG;
        try {
            $this->canview();
        } catch (Exception $e){
            return access_denied_error();
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		$params = array();
		$params[0] = $currentuser;
		$params[1] = $this->nodeid;
		$params[2] = trim($vote);
		$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_VOTE_DELETE, $params);
	    if(!$res){
            return database_error();
        }
        $this->load();
        return $this;
    }

    /**
     * Add a URL to this node
     *
     * @param string $urlid
     * @param string $comments
     * @return Node object (this) (or Error object)
     */
    function addURL($urlid,$comments){
        global $DB,$CFG,$USER,$HUB_SQL;

        //check user can edit the Node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        //check user can edit the URL
        $url = new URL($urlid);
        $url->load();
        try {
            $url->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = $urlid;
		$params[2] = $currentuser;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_URL_ADD_CHECK, $params);
		if($resArray !== false){
			if (count($resArray) == 0) {
		        $dt = time();
				$params = array();
				$params[0] = $currentuser;
				$params[1] = $urlid;
				$params[2] = $this->nodeid;
				$params[3] = $dt;
				$params[4] = $dt;
				$params[5] = $comments;
				$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_URL_ADD, $params);
                if ($res) {
                    if (!auditURL($USER->userid, $urlid, $this->nodeid, $urlid, "", "", "", "", "", "", $comments, $CFG->actionAdd,format_object('xml',$this))) {
                        return database_error();
                    }
                } else {
                     return database_error();
                }
            }
        }
        $this->load();
        return $this;
    }

    /**
     * Remove a URL from this node
     *
     * @param string $urlid
     * @return Node object (this) (or Error object)
     */
    function removeURL($urlid){
        global $DB,$CFG,$USER,$HUB_SQL;
        //check user can edit the Node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }
        //check user can edit the URL
        $url = new URL($urlid);
        try {
            $url->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = $urlid;
		$params[2] = $currentuser;
		$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_URL_DELETE, $params);
        if ($res) {
            if (!auditURL($USER->userid, $urlid, $this->nodeid, "", "", "", "", "", "", "", $CFG->actionDelete, format_object('xml',$this))) {
                return database_error();
            }
        } else {
            return database_error();
        }

        // if the url has no other connections to nodes delete the url object.
        $url = new URL($urlid);
        $url->load('short');
        if ($url->ideacount == 0) {
        	$url->delete();
        }

        $this->load();
        return $this;
    }

     /**
     * Remove all urls from this Node
     *
     * @return Node object (this) (or Error object)
     */
    function removeAllURLs(){
        global $DB,$CFG,$USER,$HUB_SQL;
        //check user owns the node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

		$params = array();
		$params[0] = $this->nodeid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_URL_DELETE_ALL, $params);
        if (!$res) {
            return database_error();
        }
		// empty it out in case.
		$this->urls = array();
        $this->load();
        return $this;
    }

    /**
     * Add group to this node
     *
     * @param string $groupid
     * @return Node object (this) (or Error object)
     */
    function addGroup($groupid){
        global $DB,$CFG,$USER,$HUB_SQL;
        //check user owns the node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        //check user member of group
        $group = new Group($groupid);
        $group->load();
        if(!$group->ismember($USER->userid)){
           return access_denied_error();
        }

        // check group not already in node
		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = $groupid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_GROUP_ADD_CHECK, $params);
		if($resArray !== false){
			if (count($resArray) == 0) {
	            $dt = time();
				$params = array();
				$params[0] = $this->nodeid;
				$params[1] = $groupid;
				$params[2] = $dt;
				$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_GROUP_ADD, $params);
                if (!$res) {
                     return database_error();
                }

	        }
        } else {
        	return database_error();
        }

        $this->load();
        return $this;
    }

    /**
     * Remove group from this node
     *
     * @param string $groupid
     * @return Node object (this) (or Error object)
     */
    function removeGroup($groupid){
        global $DB,$CFG,$USER,$HUB_SQL;
        //check user owns the node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        //check user member of group
        $group = new Group($groupid);
        $group->load();
        if(!$group->ismember($USER->userid)){
           return access_denied_error();
        }

        // check group not already in node
		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = $groupid;
		$res = $DB->delete($HUB_SQL->DATAMODEL_NODE_GROUP_DELETE, $params);
	    if(!$res){
            return database_error();
        }

        $this->load();
        return $this;
    }

    /**
     * Remove all groups from this Node
     *
     * @return Node object (this) (or Error object)
     */
    function removeAllGroups(){
        global $DB,$CFG,$USER,$HUB_SQL;
        //check user owns the node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

		$params = array();
		$params[0] = $this->nodeid;
		$res = $DB->delete($HUB_SQL->DATAMODEL_NODE_GROUP_DELETE_ALL, $params);
	    if(!$res){
            return database_error();
        }
        $this->load();
        return $this;
    }

    /**
     * Add a Tag to this node
     *
     * @param string $tagid
     * @return Node object (this) (or Error object)
     */
    function addTag($tagid){
        global $DB,$CFG,$USER,$HUB_SQL;

        //check user can edit the node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        //check user can edit the Tag
        $tag = new Tag($tagid);
        $tag->load();
        try {
        	$tag->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = $tagid;
		$params[2] = $currentuser;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_TAG_ADD_CHECK, $params);
		if($resArray !== false){
			if (count($resArray) == 0) {
				$params = array();
				$params[0] = $currentuser;
				$params[1] = $tagid;
				$params[2] = $this->nodeid;
				$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_TAG_ADD, $params);
                if (!$res) {
                     return database_error();
                }
            }
        } else {
            return database_error();
        }

        $this->load();
        return $this;
    }

    /**
     * Remove a Tag from this node
     *
     * @param string $urlid
     * @return Node object (this) (or Error object)
     */
    function removeTag($tagid){
        global $DB,$CFG,$USER,$HUB_SQL;

        //check user can edit the node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        //check user can edit the Tag
        $tag = new Tag($tagid);
        $tag->load();
        try {
        	$tag->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = $tagid;
		$params[2] = $currentuser;
		$res = $DB->delete($HUB_SQL->DATAMODEL_NODE_TAG_DELETE, $params);
        if (!$res) {
             return database_error();
        }
        $this->load();
        return $this;
    }

    /**
     * Set the privacy setting of this node
     *
     * @return Node object (this) (or Error object)
     */
    function setPrivacy($private){
        global $DB,$CFG,$USER,$HUB_SQL;

        //check user owns the node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        $dt = time();
		$params = array();
		$params[0] = $private;
		$params[1] = $dt;
		$params[2] = $this->nodeid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_PRIVACY_UPDATE, $params);
        if (!$res) {
             return database_error();
        }

        $this->load();
        return $this;
    }

    /**
     * Update the start date for this node
     *
     * @return Node object (this) (or Error object)
     */
    function updateStartDate($startdate){
        global $DB,$CFG,$USER,$HUB_SQL;
        //check user owns the node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        try {
            if(is_numeric($startdate)){
                $mydate = $startdate;
            } else {
                $mydate = strtotime($startdate);
            }
            $dt = time();
			$params = array();
			$params[0] = $mydate;
			$params[1] = $dt;
			$params[2] = $this->nodeid;
			$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_STARTDATE_UPDATE, $params);
			if (!$res) {
				 return database_error();
			}
        } catch (Exception $e) {
            //failed
        }

        $this->load();
        return $this;
    }

    /**
     * Update the end date for this node
     *
     * @return Node object (this) (or Error object)
     */
    function updateEndDate($enddate){
        global $DB,$CFG,$USER,$HUB_SQL;
        //check user owns the node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        try {
            if(is_numeric($enddate)){
                $mydate = $enddate;
            } else {
                $mydate = strtotime($enddate);
            }
            $dt = time();
			$params = array();
			$params[0] = $mydate;
			$params[1] = $dt;
			$params[2] = $this->nodeid;
			$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_ENDDATE_UPDATE, $params);
			if (!$res) {
				 return database_error();
			}
        } catch (Exception $e) {
            //failed
        }

        $this->load();
        return $this;
    }


    /**
     * Update the location for this node
     *
     * @return Node object (this) (or Error object)
     */
    function updateLocation($location,$loccountry){
        global $DB,$CFG,$USER,$HUB_SQL;

 		//check user owns the node
        try {
            $this->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        $dt = time();

		$params = array();
		$params[0] = $location;
		$params[1] = $loccountry;
		$params[2] = $dt;
		$params[3] = $this->nodeid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_LOCATION_UPDATE, $params);
		if ($res) {
			//try to geocode
			if ($location != "" && $loccountry != "" &&
				($location != $this->location || $loccountry != $this->countrycode)){

				$coords = geoCode($location, $loccountry);
				if($coords["lat"] != "" && $coords["lng"] != ""){
					$params = array();
					$params[0] = $coords["lat"];
					$params[1] = $coords["lng"];
					$params[2] = $this->nodeid;
					$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_LATLONG_UPDATE, $params);
				} else {
					$params = array();
					$params[0] = null;
					$params[1] = null;
					$params[2] = $this->nodeid;
					$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_LATLONG_UPDATE, $params);
				}
			}
		} else {
			return database_error();
		}
        $this->load();
        return $this;
    }

   /**
     * Update the status for this node
     *
     * @return Node object (this) (or Error object)
     */
    function updateStatus($status){
        global $DB,$CFG,$USER,$HUB_SQL;

        $dt = time();

		$params = array();
		$params[0] = $status;
		$params[1] = $dt;
		$params[2] = $this->nodeid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_NODE_STATUS_UPDATE, $params);
		if (!$res) {
			return database_error();
		}

        $this->load();
        return $this;
    }

    /////////////////////////////////////////////////////
    // security functions
    /////////////////////////////////////////////////////

    /**
     * Check whether the current user can view the current node
     *
     * @throws Exception
     */
    function canview(){
        global $DB,$CFG,$USER,$HUB_SQL,$LNG;

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = 'N';
		$params[2] = $currentuser;
		$params[3] = $this->nodeid;
		$params[4] = $currentuser;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_CAN_VIEW, $params);
		if($resArray !== false){
			if (count($resArray) == 0) {
	            throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
	        }
        } else {
	        throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
        }
    }

    /**
     * Check whether the current user can add a node
     *
     * @throws Exception
     */
    function canadd(){
        // needs to be logged in that's all!
        api_check_login();
    }

    /**
     * Check whether the current user can edit the current node
     *
     * @throws Exception
     */
    function canedit(){
        global $DB,$USER,$HUB_SQL,$LNG;
        api_check_login();

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

        //can edit only if owner of the node
		$params = array();
		$params[0] = $currentuser;
		$params[1] = $this->nodeid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_CAN_EDIT, $params);
		if($resArray !== false){
			if (count($resArray) == 0) {
	            throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
	        }
        } else {
	        throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
        }
    }

    /**
     * Check whether the current user can delete the current node
     *
     * @throws Exception
     */
    function candelete(){
        global $DB,$USER,$HUB_SQL,$LNG;
        api_check_login();

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

        //can delete only if owner of the node
		$params = array();
		$params[0] = $currentuser;
		$params[1] = $this->nodeid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_CAN_EDIT, $params);
		if($resArray !== false){
			if (count($resArray) == 0) {
	            throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
	        }
        } else {
	        throw new Exception($LNG->ERROR_ACCESS_DENIED_MESSAGE);
        }
    }

    /////////////////////////////////////////////////////
    // helper functions
    /////////////////////////////////////////////////////

    /**
     * How many times this node has been used in making a connection
     *
     * @return integer
     */
    function getConnectionUsage() {
        global $DB,$CFG,$HUB_SQL;
        $usage = 0;

        //one side of connection
		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = $this->userid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_CONNECTION_USAGE_FROM, $params);
		if($resArray !== false){
			if (count($resArray) > 0) {
	            $usage = $resArray[0]['nodecount'];
	        }
        }

        //other side of connection
		$params = array();
		$params[0] = $this->nodeid;
		$params[1] = $this->userid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_CONNECTION_USAGE_TO, $params);
		if($resArray !== false){
			if (count($resArray) > 0) {
	            $usage = $usage+$resArray[0]['nodecount'];
	        }
        }

        return $usage;
    }

    /**
     * How many users have entered this idea
     *
     * @return integer
     */
    function getNodeEntryUsage() {
        global $DB,$CFG,$HUB_SQL;
        $usage = 0;

		$params = array();
		$params[0] = $this->name;
		$params[1] = $this->userid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_NODE_ENTRY_USAGE, $params);
		if($resArray !== false){
			if (count($resArray) > 0) {
   	        	$usage = $resArray[0]['nodecount'];
   	        }
        }

        return $usage;
    }
}
?>