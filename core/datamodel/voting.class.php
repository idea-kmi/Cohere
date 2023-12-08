<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2012 The Open University UK                                   *
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
// Voting Class
// Stores the votes for objects
///////////////////////////////////////

class Voting {

    public $votes;
    public $id;

    function Voting($id){
       $this->$id = $id;
    }

    function load(){
        global $DB,$USER,$HUB_SQL;

        $loggedin = api_check_login();
        if($loggedin instanceof Error){
            return $loggedin;
        }

		$params = array();
		$params[0] = $id;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_GROUP_SELECT, $params);

    	if ($resArray !== false) {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];

				$vi = new Vote();
				$vi->id = $array['ItemID'];
				$vi->type = $array['VoteType'];
				$vi->date = $array['CreationDate'];
				$vi->userid = $array['UserID'];
				$vi->username = $array['Name'];
				array_push($this->votes,$vi);
			}
		} else {
            return database_error();
		}

        return $this;
    }
}

class Vote {
    public $id;
    public $type;
    public $date;
    public $userid;
    public $username;
}
?>