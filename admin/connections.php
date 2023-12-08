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
include_once("../config.php");
include_once($CFG->dirAddress."ui/header.php");

if(!isset($USER->userid)){
    header('Location: index.php');
	exit();
}
?>

<h2>Connections Created for Cohere</h2>

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
		$qry = "select CreationDate FROM Triple order by CreationDate ASC Limit 1";
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$startdate = $array['CreationDate'];
			}
		}
		//$startdate = mktime(0, 0, 0, 7, 18, 2007);

		echo '<div class="hometext" style="float:left; margin-bottom: 10px; font-size: 12pt;">Figures calculated from '.strftime( '%d/%m/%Y' ,$startdate).'</div>';

		echo '<div style="clear: both; float: left; margin-top: 5px;"><table>';

		$qry = "select count(TripleID) as num from Triple where CreationDate >= ".$startdate;
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$innercount = $array['num'];
				echo '<tr><td><span class="hometext">Total connection count</span></td><td><span class="hometext"> = '.$innercount.'</span</td></tr>';
			}
		}

		$qry = "SELECT count(TripleID) as num FROM Triple WHERE CreationDate >= ".$startdate." AND CreatedFrom='cohere'";
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$num = $array['num'];
				echo '<tr><td><span class="hometext">Cohere connection count</span></td><td><span class="hometext"> = '.$num.'</span></td></tr>';
			}
		}

		$qry = "SELECT count(TripleID) as num FROM Triple WHERE CreationDate >= ".$startdate." AND CreatedFrom != 'cohere'";
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$num2 = $array['num'];
				echo '<tr><td><span class="hometext">Imported connection count</span></td><td><span class="hometext"> = '.$num2.'</span></td></tr>';
			}
		}

		echo '</table></div>';
?>

<!-- div style="clear: both; float: left; margin-top: 20px;" align="center"><img src="connectionsGraph.php?time=weeks" /></div -->

<div style="clear: both; float: left; margin-top: 20px;" align="center"><img src="connectionsGraph.php?time=months" /></div>

<div style="clear: both; float: left; margin-top: 20px;" align="center">
<table width="650" cellpadding="2" border="1" style="border-collapse: collapse">
<?php

		if ($sort == 'to') {
			$qry = "select Node.Name, Triple.FromID, LinkType.Label, Triple.CreationDate, Triple.CreatedFrom, Users.Name as UserName from Triple left join Users on Triple.UserID = Users.UserID left join LinkType on Triple.LinkTypeID = LinkType.LinkTypeID left join Node on Triple.ToID = Node.NodeID where Triple.CreationDate >= ".$startdate;
		} else {
			$qry = "select Node.Name, Triple.ToID, LinkType.Label, Triple.CreationDate, Triple.CreatedFrom, Users.Name as UserName from Triple left join Users on Triple.UserID = Users.UserID left join LinkType on Triple.LinkTypeID = LinkType.LinkTypeID left join Node on Triple.FromID = Node.NodeID where Triple.CreationDate >= ".$startdate;
		}

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

			if ($sort == 'from') {
				$qry .= ' ORDER BY Node.Name '.$direction;
			} else if ($sort == 'date') {
				$qry .= ' ORDER BY Triple.CreationDate '.$direction;
			} else if ($sort == 'to') {
				$qry .= ' ORDER BY Node.Name '.$direction;
			} else if ($sort == 'link') {
				$qry .= ' ORDER BY LinkType.Label '.$direction;
			} else if ($sort == 'user') {
				$qry .= ' ORDER BY UserName '.$direction;
			} else if ($sort == 'origin') {
				$qry .= ' ORDER BY CreatedFrom '.$direction;
			}
		} else {
			$qry .= ' order by Triple.CreationDate DESC';
			$sort='date';
			$direction='DESC';
		}

		echo '<td align="left" valign="bottom" width="15%" class="adminTableHead"><a href="connections.php?&sort=date&lastsort='.$sort.'&lastdir='.$direction.'">Date';
		if ($sort === 'date') {
			if ($direction === 'ASC') {
				echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
			} else {
				echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
			}
		}
		echo '</td>';
		echo '<td align="left" valign="bottom" width="25%" class="adminTableHead"><a href="connections.php?&sort=from&lastsort='.$sort.'&lastdir='.$direction.'">From Idea';
		if ($sort === 'from') {
			if ($direction === 'ASC') {
				echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
			} else {
				echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
			}
		}
		echo '</td>';
		echo '<td align="left" valign="bottom" width="10%" class="adminTableHead"><a href="connections.php?&sort=link&lastsort='.$sort.'&lastdir='.$direction.'">Link Type';
		if ($sort === 'link') {
			if ($direction === 'ASC') {
				echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
			} else {
				echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
			}
		}
		echo '</td>';
		echo '<td align="left" valign="bottom" width="25%" class="adminTableHead"><a href="connections.php?&sort=to&lastsort='.$sort.'&lastdir='.$direction.'">To Idea';
		if ($sort === 'to') {
			if ($direction === 'ASC') {
				echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
			} else {
				echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
			}
		}
		echo '</td>';
		echo '<td align="left" valign="bottom" width="15%" class="adminTableHead"><a href="connections.php?&sort=user&lastsort='.$sort.'&lastdir='.$direction.'">Users';
		if ($sort === 'user') {
			if ($direction === 'ASC') {
				echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
			} else {
				echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
			}
		}
		echo '</td>';
		echo '<td align="left" valign="bottom" width="10%" class="adminTableHead"><a href="connections.php?&sort=origin&lastsort='.$sort.'&lastdir='.$direction.'">Origin';
		if ($sort === 'origin') {
			if ($direction === 'ASC') {
				echo '<img border="0" src="../images/uparrow.gif" width="16" height="8" />';
			} else {
				echo '<img border="0" src="../images/downarrow.gif" width="16" height="8" />';
			}
		}
		echo '</td></tr>';

		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];

				$fromID = null;
				if (isset($array['FromID'])) {
					$fromID = $array['FromID'];
				}
				$toID = null;
				if (isset($array['ToID'])) {
					$toID = $array['ToID'];
				}

				$name = $array['Name'];
				$date = $array['CreationDate'];
				$linklabel= $array['Label'];
				$user = $array['UserName'];
				$origin = $array['CreatedFrom'];

				echo '<tr>';
					echo '<td valign="top">';
						echo strftime( '%d %B %Y' ,$date);
					echo '</td>';
					if ($toID != null) {
						echo '<td valign="top">';
							echo $name;
						echo '</td>';
					} else {
						$qry1 = "select Name from Node where NodeID='".$fromID."'";
						$resArray1 = $DB->select($qry1, array());
						if (!$resArray) {
							echo '<td valign="top">';
								echo $fromID;
							echo '</td>';
						} else {
							$array1 = $resArray[0];
							echo '<td valign="top">';
							echo $array1['Name'];
							echo '</td>';
						}
					}
					echo '<td valign="top">';
						echo $linklabel;
					echo '</td>';
					if ($fromID != null) {
						echo '<td valign="top">';
							echo $name;
						echo '</td>';
					} else {
						$qry1 = "select Name from Node where NodeID='".$toID."'";
						$resArray1 = $DB->select($qry1, $params);
						if (!$resArray1) {
							echo '<td valign="top">';
								echo $toID;
							echo '</td>';
						} else {
							$array1 = $resArray1[0];
							echo '<td valign="top">';
								echo $array1['Name'];
							echo '</td>';
						}
					}
					echo '<td valign="top">';
						echo $user;
					echo '</td>';
					echo '<td valign="top">';
						echo $origin;
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
	include_once("footer.php");
?>