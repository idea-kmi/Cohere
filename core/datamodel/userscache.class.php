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
// UsersCache Class
// Stores the users bookmarked ideas
///////////////////////////////////////

class UsersCache {

    public $ideas;

    function UsersCache(){
        return $this->load();
    }

    function load(){
        global $DB,$USER,$HUB_SQL;
        $loggedin = api_check_login();
        if($loggedin instanceof Hub_Error){
            return $loggedin;
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}
		$params = array();
		$params[0] = $currentuser;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_CACHE_SELECT, $params);
    	if ($resArray !== false) {
            $this->ideas = array();
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$uci = new UserCachedIdea();
				$uci->idea = $array['NodeID'];
				$uci->date = $array['CreationDate'];
				array_push($this->ideas,$uci);
            }
        } else {
        	return database_error();
        }
        return $this;
    }

    function add($nodeid){
        global $DB,$USER,$HUB_SQL;
        $loggedin = api_check_login();
        if($loggedin instanceof Hub_Error){
            return $loggedin;
        }

        if(trim($nodeid)==""){
            $ERROR = new Hub_Error;
            $ERROR->createBlankNodeidError();
            return $ERROR;
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}
		$params = array();
		$params[0] = $currentuser;
		$params[1] = $nodeid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_CACHE_ADD_CHECK, $params);
    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count == 0) {
				$dt = time();
				$params = array();
				$params[0] = $currentuser;
				$params[1] = $nodeid;
				$params[2] = $dt;
				$res = $DB->insert($HUB_SQL->DATAMODEL_USER_CACHE_ADD, $params);
				if(!$res){
					return database_error();
				}
			} else {
				$dt = time();
				$params = array();
				$params[0] = $dt;
				$params[1] = $currentuser;
				$params[2] = $nodeid;
				$res = $DB->insert($HUB_SQL->DATAMODEL_USER_CACHE_EDIT, $params);
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

    function delete($nodeid){
        global $DB,$USER,$HUB_SQL;
        $loggedin = api_check_login();
        if($loggedin instanceof Hub_Error){
            return $loggedin;
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}
		$params = array();
		$params[0] = $currentuser;
		$params[1] = $nodeid;
		$res = $DB->delete($HUB_SQL->DATAMODEL_USER_CACHE_DELETE, $params);
        if(!$res){
            return database_error();
        }
        $this->load();
        return $this;
    }

    function clear(){
        global $DB,$USER,$HUB_SQL;
        $loggedin = api_check_login();
        if($loggedin instanceof Hub_Error){
            return $loggedin;
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}
		$params = array();
		$params[0] = $currentuser;
		$res = $DB->delete($HUB_SQL->DATAMODEL_USER_CACHE_DELETE_ALL, $params);
        if(!$res){
            return database_error();
        }
        $this->load();
        return $this;
    }

}

class UserCachedIdea {

    public $idea;
    public $date;
}
?>