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

if($USER == null || $USER->getIsAdmin() == "N"){
    //reject user
    echo "Sorry you need to be an administrator to access these pages";
    include_once($CFG->dirAddress."ui/dialogfooter.php");
    die;
} else {
    global $DB,$CFG;
	$err = "";
	$params = array();
	if( !$DB->conn ) {
		$err .= $DB->conn->connect_error;
	} else {
		// MOST USED LinkType
		$qry = "SELECT LinkTypeID, Label FROM LinkType Order By Label";
		$linkCount = 0;
		$linkName = "";
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= "<error>SQL error: ".$DB->conn->error."</error>";
		} else {
			$linkIDs = "";
			$previousName = "";
			$count = count($resArray);

			//$count = 1;

			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$name = $array['Label'];
				$linkid = $array['LinkTypeID'];

				if ($previousName == "") {
					$previousName = $name;
				}

				if ($previousName != $name) {
					$qry4 = "select Count(TripleID) as num FROM Triple where LinkTypeID IN ($linkIDs)";
					$resArray4 = $DB->select($qry4, $params);
					if (!$resArray4) {
						$err .= " ".$DB->conn->error;
					} else {
						$countj = count($resArray4);
						for ($j=0; $j<$countj; $j++) {
							$array4 = $resArray4[$j];
							$countinner = $array4['num'];
							if ($countinner > $linkCount) {
								$linkCount = $countinner;
								$linkName = $previousName;
							}
						}
					}

					$linkIDs = "";
				}

				$previousName = $name;

				if ($linkIDs == "") {
					$linkIDs .= "'".$linkid."'";
				} else {
					$linkIDs .= ", '".$linkid."'";
				}
			}

		}

		// MOST USED ROLE
		$qry = "SELECT NodeTypeID, Name FROM NodeType Order By Name";
		$roleCount = 0;
		$roleName = "";
		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= "<error>SQL error: ".$DB->conn->error."</error>";
		} else {
			$roleIDs = "";
			$previousName = "";
			$count = count($resArray);

			//$count = 1;

			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];

				$name = $array['Name'];
				$roleid = $array['NodeTypeID'];

				if ($previousName == "") {
					$previousName = $name;
				}

				if ($previousName != $name) {
					$qry4 = "select Count(TripleID) as num FROM Triple where (FromContextTypeID IN ($roleIDs) or ToContextTypeID IN ($roleIDs))";
					$resArray4 = $DB->select($qry4, $params);
					if (!$resArray4) {
						$err .= " ".$DB->conn->error;
					} else {
						$countj = count($resArray4);
						for ($j=0; $j<$countj; $j++) {
							$array4 = $resArray4[$j];
							$innercount = $array4['num'];
							if ($innercount > $roleCount) {
								$roleCount = $innercount;
								$roleName = $previousName;
							}
						}
					}

					$roleIDs = "";
				}

				$previousName = $name;

				if ($roleIDs == "") {
					$roleIDs .= "'".$roleid."'";
				} else {
					$roleIDs .= ", '".$roleid."'";
				}
			}
		}

		// MOST RECENT IDEA
		$recentName = "";
		$recentDate = "";
		$qry1 = "select Name, CreationDate from Node where UserID NOT IN (select UserID from Users where private='Y') ORDER BY CreationDate DESC LIMIT 1";
		$resArray = $DB->select($qry1, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$recentName = $array1['Name'];
				$recentDate = $array1['CreationDate'];
			}
		}

		// MOST_POPULAR_IDEA
		$popularName = "";
		$popularCount = 0;
		$qry2 = "SELECT Name, COUNT(Name) as num FROM Node where UserID NOT IN (select UserID from Users where private='Y') Group By Name Order By num DESC LIMIT 1";
		$resArray2 = $DB->select($qry2, $params);
		if (!$resArray2) {
			$err .= " ".$DB->conn->error;
		} else {
			$count = count($resArray2);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray2[$i];
				$popularName = $array2['Name'];
				$popularCount = $array2['num'];
			}
		}

		/** MOST CONNECTED NODES - WITH PRIVACY CHECKING **/
		$ideaConArray = array();

		$qry = "SELECT allnodes.ID, Count(node) AS num FROM( ";

		$qry .= "(SELECT Node.NodeID AS ID, FromID AS node ";
		$qry .= "FROM Triple right join Node on Triple.FromID = Node.NodeID ";
		$qry .= "WHERE ";
		$qry .= "((Triple.Private = 'N')
					   OR
					   (Triple.UserID = '".$USER->userid."')
					   OR
					   (TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
									 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
									  WHERE ug.UserID = '".$USER->userid."'))
					AND FromID IN (SELECT t.NodeID FROM Node t
									WHERE ((t.Private = 'N')
									   OR
									   (t.UserID = '".$USER->userid."')
									   OR
									   (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
												   INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
													WHERE ug.UserID = '".$USER->userid."')))
									)
					AND ToID IN (SELECT t.NodeID FROM Node t
									WHERE ((t.Private = 'N')
									   OR
									   (t.UserID = '".$USER->userid."')
									   OR
									   (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
												   INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
													WHERE ug.UserID = '".$USER->userid."')))
								)))";

		$qry .= "UNION ALL ";

		$qry .= "(SELECT  Node.NodeID AS ID, ToID AS node ";
		$qry .= "FROM Triple right join Node on Triple.ToID = Node.NodeID ";
		$qry .= "WHERE ";
		$qry .= "((Triple.Private = 'N')
					   OR
					   (Triple.UserID = '".$USER->userid."')
					   OR
					   (TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
									 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
									  WHERE ug.UserID = '".$USER->userid."'))
					AND FromID IN (SELECT t.NodeID FROM Node t
									WHERE ((t.Private = 'N')
									   OR
									   (t.UserID = '".$USER->userid."')
									   OR
									   (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
												   INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
													WHERE ug.UserID = '".$USER->userid."')))
									)
					AND ToID IN (SELECT t.NodeID FROM Node t
									WHERE ((t.Private = 'N')
									   OR
									   (t.UserID = '".$USER->userid."')
									   OR
									   (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
												   INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
													WHERE ug.UserID = '".$USER->userid."')))
								)))";


		$qry .= ") AS allnodes ";
		$qry .= "Group by allnodes.ID order by num DESC LIMIT 1";

		$resArray = $DB->select($qry, $params);
		if (!$resArray) {
			$err .= " ".$DB->conn->error;
		} else {
			$count = count($resArray);
			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];

				$id = $array['ID'];
				$node = new CNode();
				$node->nodeid = $id;
				$node->load();
				if (!$node instanceof error) {
					$count = $array['num'];
					$ideaConArray[$node->name] = $count;
				}
			}
			reset($ideaConArray);
			$mostconidea = key($ideaConArray);
			$mostconideaCount = $ideaConArray[$mostconidea];
		}

		$qryStart = "SELECT allLinks.Label, ";
		$qryNames = "";
		$qryMiddle = " from (";
		$qryMiddle .= "(select DISTINCT LinkType.Label as Label from LinkType WHERE LinkType.UserID IN ( ";
		$qryIDs = "";
		$qryEnd = ") AND LinkType.Label != '' order by LinkType.Label ASC ) AS allLinks";

		$qry = "";
		$userSet = getActiveConnectionUsers(0, 20);
		if ($userSet->count > 0) {
			for ($i = 0; $i < $userSet->count; $i++) {
				$user = $userSet->users[$i];
				if ($user->userid && $user->userid != "") {
					$name = str_replace(" ", "_", trim($user->name));
					$name = str_replace(".", "_", $name);
					$name .= "_".$user->userid;
					if ($i==0) {
						$qryNames .= $name;
						$qryIDs .= "'".$user->userid."'";
					} else {
						$qryNames .= ",".$name;
						$qryIDs .= ",'".$user->userid."'";
					}

					$qry .= " LEFT JOIN (SELECT LinkType.Label as Label, Count(TripleID) AS ".$name;
					$qry .= " FROM LinkType left JOIN Triple ON Triple.LinkTypeID = LinkType.LinkTypeID";
					$qry .= " WHERE Triple.UserID='".$user->userid."'";
					$qry .= " GROUP BY Label) as table".$user->userid." on allLinks.Label = table".$user->userid.".Label";
				}
			}
		}

		if ($qryNames != "" && $qryIDs != "") {
			$qryFinal = $qryStart.$qryNames.$qryMiddle.$qryIDs.$qryEnd.$qry.")";
			$linktypeUse = array();

			$resArray = $DB->select($qryFinal, $params);
			if (!$resArray) {
				$err .= " ".$DB->conn->error;
			} else {
				$count = count($resArray);
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];
					$linktypeUse[count($linktypeUse)] = $array;
				}
			}
		}
	}
}
?>


<script type="text/javascript">

function init() {
	loadActiveConnectionUsersStats();
	loadActiveIdeaUsersStats();
}

function loadActiveConnectionUsersStats() {
	var reqUrl = SERVICE_ROOT + "&method=getactiveconnectionusers&max=20";
	new Ajax.Request(reqUrl, { method:'get',
  			onSuccess: function(transport){
  				var json = transport.responseText.evalJSON();
      			if(json.error){
      				alert(json.error[0].message);
      				return;
      			}
      			var users = json.userset[0].users;
      			if(users.length > 0){
					var lOL = new Element("ol", {'class':'user-list-ol'});
					lOL.style.margin="0px";
					for(var i=0; i< users.length; i++){
						if(users[i].user){
							var iUL = new Element("li", {'id':users[i].user.userid, 'class':'user-list-li'});
							iUL.style.clear = "both";
							iUL.style.height="36px";
							lOL.insert(iUL);

							var user = users[i].user;

							if(user.isgroup == 'Y'){
								iUL.insert("<a style='float:left; padding-right: 3px;' href='group.php?groupid="+ user.userid +"'><img src='"+user.thumb+"' border='0' /></a>");
							} else {
								iUL.insert("<a style='float:left; padding-right: 3px;' href='user.php?userid="+ user.userid +"'><img src='"+user.thumb+"' border='0' /></a>")
							}

							if(user.isgroup == 'Y'){
								iUL.insert("<b style='float:left;'><a href='"+URL_ROOT+"group.php?groupid="+ user.userid +"'>" + user.name + "</a></b>");
							} else {
								iUL.insert("<b style='float:left;'><a href='"+URL_ROOT+"user.php?userid="+ user.userid +"'>" + user.name + "</a></b>");
							}
							iUL.insert("<br><span style='clear:top; font-size: 80%'>Connection count: "+user.connectioncount+"</span>");
						}
					}

					$('content-stats-users').insert(lOL);
      			}
      		}
      	});
}

function loadActiveIdeaUsersStats() {
	var reqUrl = SERVICE_ROOT + "&method=getactiveideausers&max=20";
	new Ajax.Request(reqUrl, { method:'get',
  			onSuccess: function(transport){
  				var json = transport.responseText.evalJSON();
      			if(json.error){
      				alert(json.error[0].message);
      				return;
      			}
      			var users = json.userset[0].users;
      			if(users.length > 0){
					var lOL = new Element("ol", {'class':'user-list-ol'});
					lOL.style.margin="0px";
					for(var i=0; i< users.length; i++){
						if(users[i].user){
							var iUL = new Element("li", {'id':users[i].user.userid, 'class':'user-list-li'});
							iUL.style.clear = "both";
							iUL.style.margin="0px";
							iUL.style.height="36px";
							lOL.insert(iUL);

							var user = users[i].user;

							if(user.isgroup == 'Y'){
								iUL.insert("<a style='float:left; padding-right: 3px;' href='group.php?groupid="+ user.userid +"'><img src='"+user.thumb+"' border='0' /></a>");
							} else {
								iUL.insert("<a style='float:left; padding-right: 3px;' href='user.php?userid="+ user.userid +"'><img src='"+user.thumb+"' border='0' /></a>")
							}

							if(user.isgroup == 'Y'){
								iUL.insert("<b style='float:left;'><a href='"+URL_ROOT+"group.php?groupid="+ user.userid +"'>" + user.name + "</a></b>");
							} else {
								iUL.insert("<b style='float:left;'><a href='"+URL_ROOT+"user.php?userid="+ user.userid +"'>" + user.name + "</a></b>");
							}
							iUL.insert("<br><span style='clear:top; font-size: 80%'>Idea count: "+user.ideacount+"</span>");
						}
					}
					$('content-stats-ideas').insert(lOL);
      			}
      		}
      	});
}

window.onload = init();


</script>

<h2>General Stats for Cohere</h2>

<div style="float:left;">

	<?php if ($err != "") {
		echo $err;
	}
	?>

	<table cellspacing="5">
		<tr>
			<td width="40%"><b>Type</b></td>
			<td width="40%"><b>Name</b></td>
			<td width="20%"><b>Count</b></td>
		</tr>
		<tr>
			<td colspan="3" valign="top" style="border-top: 1px solid #666666 "></td>
		</tr>
		<tr>
			<td>Most popular Link Type</td>
			<td style="color: #666666 "><?php echo $linkName ?></td>
			<td><?php echo $linkCount ?></td>
		</tr>
		<tr>
			<td>Most popular Role</td>
			<td style="color: #666666 "><?php echo $roleName ?></td>
			<td><?php echo $roleCount ?></td>
		</tr>
		<tr>
			<td>Most popular (reused) Idea</td>
			<td style="color: #666666 "><?php echo $popularName ?></td>
			<td><?php echo $popularCount ?></td>
		</tr>
		<tr>
			<td>Most connected Public Idea</td>
			<td style="color: #666666 "><?php echo $mostconidea ?></td>
			<td><?php echo $mostconideaCount ?></td>
		</tr>
	</table>

	<div style="clear: both; float: left; margin-top: 10px; margin-right: 30px; ">
		<div style="float: left;margin-right: 20px;">
		<div style="margin-bottom:10px; height: 20px; background:#F8EAF3; padding-left: 5px; padding-top: 4px; "><strong>Top 20 Connection Builders</strong></div>
		<div id="content-stats-users" style="border: 1px solid #d3e8e8; width: 320px; overflow: auto;"></div>
		</div>

		<div style="float: left;">
		<div style="margin-bottom:10px; height: 20px; background:#F8EAF3; padding-left: 5px; padding-top: 4px; "><strong>Top 20 Node Creators</strong></div>
		<div id="content-stats-ideas" style="border: 1px solid #d3e8e8; width: 320px; overflow: auto;"></div>
		</div>
	</div>

<br>
	<div style="clear:both;"></div>
	<div style="margin-bottom:10px; margin-top:20px; height: 20px; background:#F8EAF3; padding-left: 5px; padding-top: 4px; "><strong>Top 20 Connection Builders - Their LinkType Usage</strong></div>
	<div>
	<table border="1" cellspacing="2" cellpadding="3" style="border-collapse:collapse;" >
	<?php
		$count = count($linktypeUse);
		if ($count > 0) {
			$headings = $linktypeUse[0];
		    echo '<tr style="background-color: #308D88; color: white">';
			foreach ($headings as $key => $value) {
				$names = explode("_", $key);
				if (count($names) > 2) {
					echo "<td>".$names[0]." ".$names[1]."</td>";
				} else {
					echo "<td>".$names[0]."</td>";
				}
			}
		    echo "</tr>";

		    for ($i = 0; $i < $count; $i++) {
			    echo "<tr>";
			    $nextArray = $linktypeUse[$i];
		    	foreach ($nextArray as $key => $value) {
					echo '<td align="right">'.$value.'</td>';
				}
			    echo "</tr>";
		    }
		}
	?>
	</table>
	</div>
</div>

</div>


<!-- footer -->
</div> <!-- end content -->
</div> <!-- end contentwrapper -->

<div id="sidebar">
    <div class="s_innertube">
    <?php
        include("sidebar.php");
    ?>
    </div>
</div>

</div> <!-- end main -->
<div id="footer">
    A <a href="http://projects.kmi.open.ac.uk/hyperdiscourse/">KMi</a> Tool from the <a href="http://www.olnet.org/">OLnet</a> Project
    | <a href="<?php print($CFG->homeAddress);?>contact.php">Contact</a>
</div>

<!-- Google analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
if (typeof(_gat)=="object") {
    var pageTracker = _gat._getTracker("<?php print($CFG->GOOGLE_ANALYTICS_KEY);?>");
    pageTracker._initData();
    pageTracker._trackPageview();
}
</script>

</body>
</html>