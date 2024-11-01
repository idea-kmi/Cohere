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

if($USER == null || $USER->getIsAdmin() == "N"){
    //reject user
    echo "Sorry you need to be an administrator to access these pages";
    include_once($CFG->dirAddress."ui/dialogfooter.php");
    die;
} else {
    global $DB,$CFG;

	$params = array();

	if( isset($_POST["deleteuser"]) ) {
		$userid = optional_param("userid","",PARAM_TEXT);
		if ($userid != "") {
			$qry = "DELETE FROM Users WHERE UserID='".$userid."'";
			$res = $DB->delete($qry, $params);
			if (!$res) {
				$err .= " There was an issue deleting the user with the id = ".$userid;
			} else {
				//remove user image folder if exists
				$dir = $CFG->dirAddress."uploads/".$userid."/";
				deleteDirectory($dir);
			}
		}
	}

	$con = $DB->conn;

	$sort = optional_param("sort","date",PARAM_ALPHANUM);
	$oldsort = optional_param("lastsort","",PARAM_ALPHANUM);
	$direction = optional_param("lastdir","DESC",PARAM_ALPHANUM);

	$err = "";
	if( !$DB->conn ) {
		$err .= $DB->conn->connect_error;
	} else {
		$startdate = 0;

		$qry = "select CreationDate FROM Users WHERE IsGroup = 'N' order by CreationDate ASC Limit 1";

		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$db->conn->error;
		} else {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$startdate = $array['CreationDate'];
			}
		}

		$qry = "select count(UserID) as num from Users where IsGroup = 'N' AND CreationDate >= ".$startdate;
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$db->conn->error;
		} else {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$countinner = $array['num'];
				echo '<div  class="hometext" style="float: left">Total user count (from '.strftime( '%d/%m/%Y' ,$startdate).') = '.$countinner.'</div><br><br>';
			}
		}
?>

<script type="text/javascript">
function checkDeleteForm(username) {
	var reply = confirm("Are you sure you want to delete the user: "+username);
	if (reply) {
		return true;
	}
	return false;
}

</script>

<h2>Users Registered for Cohere</h2>

	<!-- div style="clear: both; float: left; margin-top: 10px;" align="center"><img src="usersGraph.php?time=weeks" /></div -->

	<div style="clear: both; float: left; margin-top: 20px;" align="center"><img src="usersGraph.php?time=months" /></div>

	<div style="clear: both; float: left; margin-top: 20px;" class="adminTableDiv" align="center">

	<table width="650" cellpadding="2" border="1" style="border-collapse: collapse">
	<?php
			$qry = "select * from Users where IsGroup = 'N' AND CreationDate >= $startdate";

			if ($sort) {
				if ($direction) {
					if ($oldsort === $sort) {
						if ($direction === 'ASC') {
							$direction = "DESC";
						} else {
							$direction = "ASC";
						}
					} else {
						$direction = "ASC";
					}
				} else {
					$direction = "ASC";
				}

				if ($sort == 'name') {
					$qry .= ' ORDER BY Name '.$direction;
				} else if ($sort == 'date') {
					$qry .= ' ORDER BY CreationDate '.$direction;
				} else if ($sort == 'login') {
					$qry .= ' ORDER BY LastLogin '.$direction;
				} else if ($sort == 'email') {
					$qry .= ' ORDER BY Email '.$direction;
				} else if ($sort == 'desc') {
					$qry .= ' ORDER BY Description '.$direction;
				} else if ($sort == 'web') {
					$qry .= ' ORDER BY Webiste '.$direction;
				}
			} else {
				$qry .= ' order by CreationDate DESC';
				$sort='date';
				$direction='DESC';
			}

			echo '<tr><td align="left" valign="bottom" width="25%" class="adminTableHead"><b>Delete</b></b>';
			echo '</td>';

			echo '<td align="left" valign="bottom" width="25%" class="adminTableHead"><a href="userRegistration.php?&sort=name&lastsort='.$sort.'&lastdir='.$direction.'">Name</b>';
			if ($sort === 'name') {
				if ($direction === 'ASC') {
					echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
				} else {
					echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
				}
			}
			echo '</td>';
			echo '<td align="left" valign="bottom" width="10%" class="adminTableHead"><a href="userRegistration.php?&sort=date&lastsort='.$sort.'&lastdir='.$direction.'">Date</b>';
			if ($sort === 'date') {
				if ($direction === 'ASC') {
					echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
				} else {
					echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
				}
			}
			echo '</td>';
			echo '<td align="left" valign="bottom" width="15%" class="adminTableHead"><a href="userRegistration.php?&sort=email&lastsort='.$sort.'&lastdir='.$direction.'">Email</b>';
			if ($sort === 'email') {
				if ($direction === 'ASC') {
					echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
				} else {
					echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
				}
			}
			echo '</td>';
			echo '<td align="left" valign="bottom" width="25%" class="adminTableHead"><a href="userRegistration.php?&sort=desc&lastsort='.$sort.'&lastdir='.$direction.'">Description</b>';
			if ($sort === 'desc') {
				if ($direction === 'ASC') {
					echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
				} else {
					echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
				}
			}
			echo '</td>';
			echo '<td align="left" valign="bottom" width="10%" class="adminTableHead"><a href="userRegistration.php?&sort=website&lastsort='.$sort.'&lastdir='.$direction.'">Website</b>';
			if ($sort === 'website') {
				if ($direction === 'ASC') {
					echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
				} else {
					echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
				}
			}
			echo '</td>';
			echo '<td align="left" valign="bottom" width="15%" class="adminTableHead"><a href="userRegistration.php?&sort=login&lastsort='.$sort.'&lastdir='.$direction.'">Last Login</b>';
			if ($sort === 'login') {
				if ($direction === 'ASC') {
					echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
				} else {
					echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
				}
			}
			echo '</td></tr>';

			$params = array();
			$resArray = $DB->select($qry, $params);
			if (!$resArray) {
				$err .= " ".$db->conn->error;
			} else {
				$count = count($resArray);
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];

					$name = $array['Name'];
					$email = $array['Email'];
					$date = $array['CreationDate'];
					$desc = $array['Description'];
					$website = $array['Website'];
					$lastlogin = $array['LastLogin'];

					echo '<tr>';
						echo '<td valign="top">';
							echo '<form  id="deleteuserform'.$array['UserID'].'" name="deleteuserform" action="" enctype="multipart/form-data" method="post" onsubmit="return checkDeleteForm(\''.$name.'\');">';
							echo '<input id="userid" name="userid" type="hidden" value="'.$array['UserID'].'" />';
							echo '<input type="submit" id="deleteuser" name="deleteuser" value="Delete" />';
							echo '</form>';
						echo '</td>';
						echo '<td valign="top">';
							echo '<a href="'.$CFG->homeAddress.'user.php?userid='.$array['UserID'].'" target="_blank">'.$name.'</a>';
						echo '</td>';
						echo '<td valign="top">';
							echo strftime( '%d/%m/%Y' ,$date);
						echo '</td>';
						echo '<td valign="top">';
							echo $email;
						echo '</td>';
						echo '<td valign="top">';
							echo $desc;
						echo '</td>';
						echo '<td valign="top">';
							if ($website != null && $website != "") {
								echo '<a href="'.$website.'">Homepage</a>';
							} else {
								echo '&nbsp;';
							}
						echo '</td>';
						echo '<td valign="top">';
							echo strftime( '%d/%m/%Y' ,$lastlogin);
						echo '</td>';
					echo '</tr>';
				}
			}
		}
	}
?>
</table>
</div>

<?php
	include_once($CFG->dirAddress."ui/footer.php");
?>