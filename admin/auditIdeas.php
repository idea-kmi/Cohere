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
include_once("../config.php");
include_once($CFG->dirAddress."ui/header.php");

if(!isset($USER->userid)){
    header('Location: index.php');
	exit();
}
?>

<h2>Ideas Audited for Cohere</h2>

<?php

if($USER == null || $USER->getIsAdmin() == "N"){
    //reject user
    echo "Sorry you need to be an administrator to access these pages";
    include_once($CFG->dirAddress."ui/dialogfooter.php");
    die;
} else {
    global $DB,$CFG;

	$params = array();

	$sort = optional_param("sort","date",PARAM_ALPHANUM);
	$oldsort = optional_param("lastsort","",PARAM_ALPHANUM);
	$direction = optional_param("lastdir","DESC",PARAM_ALPHANUM);

	$startdate = 0;

	$err = "";
	if( !$DB->conn ) {
		$err .= $DB->conn->connect_error;
	} else {
		$qry = "select ModificationDate FROM AuditNode order by ModificationDate ASC Limit 1";

		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$array = $resArray[0];
			$startdate = $array['ModificationDate'];
		}
		//$startdate = mktime(0, 0, 0, 7, 18, 2007);

		echo '<div class="hometext" style="float:left; margin-bottom: 10px; font-size: 12pt;">Figures calculated from '.strftime( '%d/%m/%Y' ,$startdate).'</div>';

		echo '<div style="clear: both; float: left;"><table>';

		$qry = "select count(NodeID) as num from AuditNode where ModificationDate >= ".$startdate;
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$innercount = $array['num'];
				echo '<tr><td><span class="hometext">Total ideas count</span></td><td><span class="hometext"> = '.$innercount.'</span</td></tr>';
			}
		}

		$qry = "SELECT count(NodeID) as num FROM AuditNode WHERE ModificationDate >= ".$startdate." AND ChangeType='add'";
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$array = $resArray[0];
			$num = $array['num'];
			echo '<tr><td><span class="hometext">Added idea count</span></td><td><span class="hometext"> = '.$num.'</span></td></tr>';

		}

		$qry = "SELECT count(NodeID) as num FROM AuditNode WHERE ModificationDate >= ".$startdate." AND ChangeType='edit'";
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$array = $resArray[0];
			$num2 = $array['num'];
			echo '<tr><td><span class="hometext">Edited idea count</span></td><td><span class="hometext"> = '.$num2.'</span></td></tr>';
		}

		$qry = "SELECT count(NodeID) as num FROM AuditNode WHERE ModificationDate >= ".$startdate." AND ChangeType='delete'";
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$array = $resArray[0];
			$num3 = $array['num'];
			echo '<tr><td><span class="hometext">Deleted idea count</span></td><td><span class="hometext"> = '.$num3.'</span></td></tr>';
		}

		echo '</table></div>';
	}
}
?>

<!--div style="clear: both; float: left; margin-top: 20px;" align="center"><img src="auditIdeasGraph.php?time=weeks" /></div-->

<!-- div style="clear: both; float: left; margin-top: 20px;" align="center"><img src="auditIdeasGraph.php?time=months" /></div -->

<?php
	include_once("footer.php");
?>