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
/**
 * sql-apilib.php
 *
 * Michelle Bachler (KMi)
 *
 */

/** shared SQL bits **/

$HUB_SQL->APILIB_NODE_ORDERBY_VOTE_PART1 = "Select ot.NodeID, ot.CreationDate, case 'ItemID' when null then 0 else Count(ItemID) end as vote, (Sum(case when VoteType='Y' then 1 else 0 end) - Sum(case when VoteType='N' then 1 else 0 end)) as weight From (";
$HUB_SQL->APILIB_NODE_ORDERBY_VOTE_PART2 = ") ot left join Voting on NodeID = Voting.ItemID group by NodeID";

$HUB_SQL->APILIB_CONNECTION_ORDERBY_VOTE_PART1 = "Select ot.TripleID, ot.CreationDate, case 'ItemID' when null then 0 else Count(ItemID) end as vote, (Sum(case when VoteType='Y' then 1 else 0 end) - Sum(case when VoteType='N' then 1 else 0 end)) as weight From (";
$HUB_SQL->APILIB_CONNECTION_ORDERBY_VOTE_PART2 = ") ot left join Voting on TripleID = Voting.ItemID group by TripleID";


$HUB_SQL->APILIB_HAVING_UNCONNECTED = " HAVING connectedness = 0";
$HUB_SQL->APILIB_HAVING_CONNECTED = " HAVING connectedness > 0";
$HUB_SQL->APILIB_FILTER_THEMES = "t.NodeID IN (SELECT t.FromID FROM Triple t WHERE (LinkTypeID IN
								(Select LinkTypeID from LinkType where Label='has main theme'))
								AND t.ToContextTypeID IN (SELECT NodeTypeID from NodeType where Name='Theme')
								AND t.ToLabel=?)";

$HUB_SQL->APILIB_TAG_SEARCH = "u.Name=?";
$HUB_SQL->APILIB_NODE_NAME_STARTING_SEARCH = "t.Name ".$HUB_SQL->SEARCH_LIKE_FROM_START;

$HUB_SQL->APILIB_FILTER_NODETYPES = "LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID WHERE nt.Name IN";
$HUB_SQL->APILIB_FILTER_USER_SOCIAL = "(n1.UserID=? OR n2.UserID=?)";
$HUB_SQL->APILIB_FILTER_STATUS = "t.CurrentStatus=?";

$HUB_SQL->APILIB_NODES_PERMISSIONS_MY = $HUB_SQL->FILTER_USER;
$HUB_SQL->APILIB_NODES_PERMISSIONS_ALL = " ((t.Private=?) OR (t.UserID=?)
												OR (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
												 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
												 WHERE ug.UserID=?)))";

$HUB_SQL->APILIB_URLS_PERMISSIONS_ALL = "((u.Private=?) OR (u.UserID=?) OR
											(u.URLID IN (SELECT tg.URLID FROM URLGroup tg
											   INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
											   WHERE ug.UserID=?)))";

$HUB_SQL->APILIB_NODES_UNCONNECTED = "((SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID) + (SELECT COUNT(ToID) FROM Triple WHERE ToID=t.NodeID)) = 0";
$HUB_SQL->APILIB_NODES_NO_CONNECTIONS = "connectedness = 0";

$HUB_SQL->APILIB_NODE_NAME_BY_ID_SELECT = "SELECT Name from Node where NodeID=?";

$HUB_SQL->APILIB_NODES_SELECT_START = "SELECT DISTINCT t.NodeID,
								(SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
								(SELECT COUNT(ToID) FROM Triple WHERE ToID=t.NodeID) AS connectedness
								FROM Node t ";

$HUB_SQL->APILIB_NODES_SELECT_START_WITH_DATE = "SELECT DISTINCT t.NodeID, t.CreationDate,
								(SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
								(SELECT COUNT(ToID) FROM Triple WHERE ToID=t.NodeID) AS connectedness
								FROM Node t ";

/** get nodes by global (Also use for get nodes by user) **/

$HUB_SQL->APILIB_NODES_BY_GLOBAL_SELECT = $HUB_SQL->APILIB_NODES_SELECT_START_WITH_DATE.
								"LEFT JOIN TagNode ut ON t.NodeID = ut.NodeID
								LEFT JOIN Tag u ON u.tagID = ut.TagID
								LEFT JOIN URLNode rn ON t.NodeID = rn.NodeID
								LEFT JOIN URL r ON r.URLID = rn.URLID ";

/** get nodes by date **/

$HUB_SQL->APILIB_NODES_BY_DATE = $HUB_SQL->APILIB_NODES_SELECT_START.
								"WHERE t.CreationDate=? AND".$HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;


/** get nodes by name **/

$HUB_SQL->APILIB_NODES_BY_NAME = $HUB_SQL->APILIB_NODES_SELECT_START.
								"WHERE t.Name=? AND".$HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;

/** get nodes by first character **/
$HUB_SQL->APILIB_NODES_BY_FIRST_CHARACTERS_SELECT = "SELECT t.Name, MAX(t.NodeID) AS NodeID FROM Node t ";
$HUB_SQL->APILIB_NODES_BY_FIRST_CHARACTERS_PART4 = " GROUP BY t.Name";


/** get nodes by tag **/

$HUB_SQL->APILIB_NODES_BY_TAG = $HUB_SQL->APILIB_NODES_SELECT_START.
								"INNER JOIN TagNode ut ON t.NodeID = ut.NodeID
								INNER JOIN Tag u ON u.tagID = ut.TagID
								WHERE u.TagID=?	AND".$HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;

/** get nodes by url **/

$HUB_SQL->APILIB_NODES_BY_URL_SELECT = $HUB_SQL->APILIB_NODES_SELECT_START.
								"INNER JOIN URLNode ut ON t.NodeID = ut.NodeID
								INNER JOIN URL u ON u.URLID = ut.URLID ";

$HUB_SQL->APILIB_NODES_BY_URL_PERMISSIONS =  "u.URL=? AND ((u.Private=?) OR
								(u.UserID=?) OR
								(u.URLID IN (SELECT tg.URLID FROM URLGroup tg
									INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
									WHERE ug.UserID=?)
								 ))
								AND ((t.Private=?) OR (t.UserID=?)
								OR (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
									INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
									WHERE ug.UserID=?)))";


/** get connected nodes by global (Also used by select nodes by user) **/

$HUB_SQL->APILIB_CONNECTED_NODES_BY_GLOBAL_SELECT = "SELECT DISTINCT t.NodeID from Node t
								LEFT JOIN TagNode ut ON t.NodeID = ut.NodeID
								LEFT JOIN Tag u ON u.tagID = ut.TagID
								LEFT JOIN URLNode rn ON t.NodeID = rn.NodeID
								LEFT JOIN URL r ON r.URLID = rn.URLID
								WHERE ";

$HUB_SQL->APILIB_CONNECTED_NODES_NODETYPES_PART1 = "t.NodeTypeID IN (";
$HUB_SQL->APILIB_CONNECTED_NODES_NODETYPES_PART2 = ") AND ";

$HUB_SQL->APILIB_CONNECTED_NODES_LINKTYPES_PART1 = "((SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID AND Triple.LinkTypeID IN (";
$HUB_SQL->APILIB_CONNECTED_NODES_LINKTYPES_PART2 = ")) + (SELECT COUNT(ToID) FROM Triple WHERE ToID=t.NodeID AND Triple.LinkTypeID IN (";
$HUB_SQL->APILIB_CONNECTED_NODES_LINKTYPES_PART3 = "))) > 0 ";


/** Get unconnected nodes by global (also used for get unconnected nodes by user) **/

$HUB_SQL->APILIB_UNCONNECTED_NODES_BY_GLOBAL_SELECT = $HUB_SQL->APILIB_NODES_SELECT_START_WITH_DATE.
								"LEFT JOIN TagNode ut ON t.NodeID = ut.NodeID
								LEFT JOIN Tag u ON u.tagID = ut.TagID
								LEFT JOIN URLNode rn ON t.NodeID = rn.NodeID
								LEFT JOIN URL r ON r.URLID = rn.URLID ";


/** get most connected nodes **/

$HUB_SQL->APILIB_MOST_CONNECTED_NODES_SELECT = $HUB_SQL->APILIB_NODES_SELECT_START;


/** Get Connections by global **/

$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_SELECT_SEARCH = "SELECT DISTINCT t.NodeID from Node t
											LEFT JOIN TagNode ut ON t.NodeID = ut.NodeID
											LEFT JOIN Tag u ON u.tagID = ut.TagID
											LEFT JOIN URLNode rn ON t.NodeID = rn.NodeID
											LEFT JOIN URL r ON r.URLID = rn.URLID WHERE";

$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_SELECT = "SELECT DISTINCT t.TripleID, t.CreationDate FROM Triple t
											INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID WHERE ";

$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_SELECT_PART1 = "(t.FromID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_SELECT_PART2 = ") AND t.ToID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_SELECT_PART3 = ")) AND ";

$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_THEME_FILTER = "( t.FromID IN (Select FromID from Triple
									where ToContextTypeID IN (SELECT NodeTypeID from NodeType where
									Name='Theme') AND ToLabel=?) AND t.ToID IN
									(Select FromID from Triple where ToContextTypeID IN
									(SELECT NodeTypeID from NodeType where Name='Theme')
									AND ToLabel=?) ) AND ";

$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_NODETYPE_FILTER_PART1 = "(t.FromContextTypeID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_NODETYPE_FILTER_PART2 = ") AND t.ToContextTypeID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_NODETYPE_FILTER_PART3 = ") ) AND ";

$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_LINKTYPE_FILTER = "t.LinkTypeID IN";

$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_PERMISSIONS_CONNECTION = "((t.Private=?) OR (t.UserID=?) OR
                   				(t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                WHERE ug.UserID=?)))";

$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_PERMISSIONS_NODES = "FromID IN (SELECT t.NodeID FROM Node t
                                WHERE".$HUB_SQL->APILIB_NODES_PERMISSIONS_ALL.
                                ") AND ToID IN (SELECT t.NodeID FROM Node t
                                WHERE".$HUB_SQL->APILIB_NODES_PERMISSIONS_ALL.")";


$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_PERMISSIONS = $HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_PERMISSIONS_CONNECTION.
								$HUB_SQL->AND.
								$HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_PERMISSIONS_NODES;


/** Get connections by User **/

$HUB_SQL->APILIB_CONNECTIONS_BY_USER_SELECT_PART1 = "(t.FromID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_USER_SELECT_PART2 = ") OR t.ToID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_USER_SELECT_PART3 = ")) AND ";


/** Get connections by Node **/

$HUB_SQL->APILIB_CONNECTIONS_BY_NODE_SELECT_PART1 = "(t.FromID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_NODE_SELECT_PART2 = ") OR t.ToID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_NODE_SELECT_PART3 = ")) AND ";

$HUB_SQL->APILIB_CONNECTIONS_BY_NODE_NODETYPE_FILTER_PART1 = "(t.FromContextTypeID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_NODE_NODETYPE_FILTER_PART2 = ") OR t.ToContextTypeID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_NODE_NODETYPE_FILTER_PART3 = ") ) AND ";

/** Get connections by URL **/

$HUB_SQL->APILIB_CONNECTIONS_BY_URL_PERMISSIONS_URL = "WHERE u.URL=? AND
								((u.Private=?) OR (u.UserID=?) OR
								 (u.URLID IN (SELECT urlg.URLID FROM URLGroup urlg
												INNER JOIN UserGroup ug ON ug.GroupID=urlg.GroupID
												WHERE ug.UserID=?)
								))";

$HUB_SQL->APILIB_CONNECTIONS_BY_URL_PERMISSIONS = $HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_PERMISSIONS_CONNECTION.
                    			" AND (FromID IN (SELECT t.NodeID FROM Node t
                            	INNER JOIN URLNode ut ON ut.NodeID = t.NodeID
                            	INNER JOIN URL u ON u.URLID = ut.URLID ".
                            	$HUB_SQL->APILIB_CONNECTIONS_BY_URL_PERMISSIONS_URL.
                                $HUB_SQL->AND.
                                $HUB_SQL->APILIB_NODES_PERMISSIONS_ALL.
			                    " OR ToID IN (SELECT t.NodeID FROM Node t
                              	INNER JOIN URLNode ut ON ut.NodeID = t.NodeID
						  		INNER JOIN URL u ON u.URLID = ut.URLID ".
                            	$HUB_SQL->APILIB_CONNECTIONS_BY_URL_PERMISSIONS_URL.
                                $HUB_SQL->AND.
                                $HUB_SQL->APILIB_NODES_PERMISSIONS_ALL.
						  		"))";



/** Get connections by Social **/

$HUB_SQL->APILIB_CONNECTIONS_BY_SOCIAL = "SELECT t.TripleID FROM Triple t
							LEFT JOIN TagTriple tn ON t.TripleID = tn.TripleID
							LEFT JOIN Tag u ON u.tagID = tn.TagID
							LEFT JOIN Node n1 ON n1.NodeID = t.FromID
							LEFT JOIN Node n2 ON n2.NodeID = t.ToID
							WHERE n1.UserID <> n2.UserID";

/** Get connections by Group **/

$HUB_SQL->APILIB_CONNECTIONS_BY_GROUP_SELECT = "SELECT DISTINCT t.TripleID FROM Triple t
    						LEFT JOIN TagTriple tn ON t.TripleID = tn.TripleID
							LEFT JOIN TripleGroup tg ON t.TripleID = tg.TripleID
							WHERE ";

$HUB_SQL->APILIB_CONNECTIONS_BY_GROUP_FILTER = "tg.GroupID=?";


/** Get multi connections **/

$HUB_SQL->APILIB_CONNECTIONS_BY_MULTI_SELECT_PART1 = "SELECT t.TripleID FROM Triple t
							INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
		 					WHERE t.TripleID IN (";
$HUB_SQL->APILIB_CONNECTIONS_BY_MULTI_SELECT_PART2 = ")";


/** Get user tags **/
$HUB_SQL->APILIB_TAGS_BY_USER_SELECT = "SELECT t.TagID FROM Tag t WHERE t.UserID=? AND (t.TagID IN (Select tn.TagID from TagNode tn where t.UserID = tn.UserID) OR t.TagID IN (Select tu.TagID from TagUsers tu where t.UserID = tu.UserID)) ORDER BY t.Name ASC";

/** Get tags by first character **/

$HUB_SQL->APILIB_TAGS_BY_FIRST_CHARACTER_SELECT_PART1 = "SELECT t.Name, MAX(t.TagID) AS TagID  FROM Tag t WHERE t.Name ".$HUB_SQL->SEARCH_LIKE_FROM;
$HUB_SQL->APILIB_TAGS_BY_FIRST_CHARACTER_SELECT_PART2 = " GROUP BY t.Name";

/** Get active connection users **/

$HUB_SQL->APILIB_CONNECTIONS_BY_ACTIVE_USERS_SELECT = "SELECT Triple.UserID, count(Triple.UserID) as num
									FROM Triple left join Users on Triple.UserID = Users.UserID
    						        WHERE Triple.UserID NOT IN (SELECT GroupID FROM UserGroup) AND ";

$HUB_SQL->APILIB_CONNECTIONS_BY_ACTIVE_USERS_SELECT_PART2A = "Triple.TripleID in (Select TripleID from TripleGroup where GroupID=?) AND
    	 														Triple.UserID in (Select UserID from UserGroup where GroupID=?) AND
	    														((Triple.Private = 'N') OR (Triple.UserID = ?) OR (Triple.TripleID IN
	           													(SELECT tg.TripleID FROM TripleGroup tg INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID WHERE ug.UserID = ?)
	        													AND FromID IN (SELECT Triple.NodeID FROM Node t WHERE ((t.Private = 'N') OR (t.UserID = ?) OR
	                           										(t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
	                                        						WHERE ug.UserID = ?))))
	        													AND ToID IN (SELECT t.NodeID FROM Node t WHERE ((t.Private = 'N') OR (t.UserID = ?) OR
	                           										(t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
	                                        						WHERE ug.UserID = ?))))
	                                        					)) ";


$HUB_SQL->APILIB_CONNECTIONS_BY_ACTIVE_USERS_SELECT_PART2B = "Triple.Private='N' AND Users.Name <> '' ";
$HUB_SQL->APILIB_CONNECTIONS_BY_ACTIVE_USERS_SELECT_PART3 = "group by Triple.UserID order by num DESC";


/** Get active idea users **/

$HUB_SQL->APILIB_NODES_BY_ACTIVE_USERS_SELECT = "SELECT Node.UserID, count(Node.UserID) as num FROM Node
									left join Users on Node.UserID = Users.UserID
						            WHERE Node.UserID NOT IN (SELECT GroupID FROM UserGroup) ";

$HUB_SQL->APILIB_NODES_BY_ACTIVE_USERS_SELECT_PART2A = "AND Node.NodeID in (Select NodeID from NodeGroup where GroupID=?)
    														AND Node.UserID in (Select UserID from UserGroup where GroupID=?)
															AND ((Node.Private = 'N') OR (Node.UserID = ?) OR
																   (Node.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
																		INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
																		WHERE ug.UserID = ?))) ";

$HUB_SQL->APILIB_NODES_BY_ACTIVE_USERS_SELECT_PART2B = "AND Node.Private = 'N' AND Users.Name <> '' ";
$HUB_SQL->APILIB_NODES_BY_ACTIVE_USERS_SELECT_PART3 = " group by Node.UserID order by num DESC";






/** Get users by following **/

$HUB_SQL->APILIB_USERS_BY_FOLLOWING_SELECT = "SELECT t.UserID, t.CreationDate FROM Following t WHERE t.ItemID=?";
$HUB_SQL->APILIB_USERS_BY_FOLLOWING_SELECT_DATE = " AND t.CreationDate >= ?";


/** Get users by most followed **/

$HUB_SQL->APILIB_USERS_BY_MOST_FOLLOWING_SELECT = "SELECT count(t.ItemID) as UseCount, t. ItemID as
								UserID FROM Following t WHERE t.ItemID IN (Select UserID From Users)
    							Group by t.ItemID order by UseCount DESC";

/** Return the most Active users **/

$HUB_SQL->APILIB_USERS_BY_MOST_ACTIVE_SELECT = "Select count(UserID) as UseCount, UserID from ";

$HUB_SQL->APILIB_USERS_BY_MOST_ACTIVE_SELECT_SELECT = "(Select DISTINCT ItemID, UserID, Type,
											ModificationDate from (";

$HUB_SQL->APILIB_USERS_BY_MOST_ACTIVE_SELECT_NODE = "SELECT n.NodeID as ItemID, n.UserID, 'Node' as Type,
											n.ModificationDate FROM Node n WHERE n.Private = 'N'";
$HUB_SQL->APILIB_USERS_BY_MOST_ACTIVE_MOD_DATE = " AND n.ModificationDate >= ?";

$HUB_SQL->APILIB_USERS_BY_MOST_ACTIVE_SELECT_CONN = "SELECT t.TripleID as ItemID, t.UserID, 'Connection'
											as Type, t.ModificationDate FROM Triple t WHERE t.Private='N'";

$HUB_SQL->APILIB_USERS_BY_MOST_ACTIVE_MODE_DATE_WHERE = "SELECT a.ItemID as ItemID, a.UserID, 'Vote' as Type,
											a.ModificationDate FROM Voting a";

$HUB_SQL->APILIB_USERS_BY_MOST_ACTIVE_MOD_DATE_VOTE = " Where a.ModificationDate >= ?";

$HUB_SQL->APILIB_USERS_BY_MOST_ACTIVE_SELECT_FOLLOW = "SELECT a.ItemID as ItemID, a.UserID, 'Follow' as Type,
											a.CreationDate as ModificationDate FROM Following a";

$HUB_SQL->APILIB_USERS_BY_MOST_ACTIVE_END  = ") as AllActivity";

$HUB_SQL->APILIB_USERS_BY_MOST_ACTIVE_ORDER = ") as final group by UserID order by UseCount DESC";


/** Get Users By Global **/

$HUB_SQL->APILIB_USERS_BY_GLOBAL_SELECT = "SELECT DISTINCT t.UserID FROM Users t
        									LEFT JOIN TagUsers tn ON t.UserID = tn.UserID
        									LEFT JOIN Tag u ON u.tagID = tn.TagID
											WHERE (t.CurrentStatus=$CFG->USER_STATUS_ACTIVE
											OR t.CurrentStatus=$CFG->USER_STATUS_REPORTED)
											AND t.USERID <> ?";

$HUB_SQL->APILIB_USERS_BY_GLOBAL_FILTER_GROUPS = " AND t.IsGroup='N'";


/** Get Themes nodes by Name **/

$HUB_SQL->APILIB_THEMES_BY_NAME = "SELECT t.NodeID FROM Node t WHERE t.Name=? AND UserID=?";


/** Connect Node To Comment **/

$HUB_SQL->APILIB_NODE_TO_COMMENT = "UPDATE Triple set ModificationDate=?, Description=?	where TripleID=?";


/** Delete Comment **/

$HUB_SQL->APILIB_COMMENT_DELETE = "UPDATE Triple set Description=? where TripleID=?";


/** Get Type Connections By Theme **/

$HUB_SQL->APILIB_CONNS_BY_THEME_NODES_SELECT = "Select NodeID from Node where NodeTypeID IN (Select NodeTypeID from NodeType where Name='Theme') AND Node.Name=?";

$HUB_SQL->APILIB_CONNS_BY_THEME_SELECT = "SELECT t.TripleID FROM Triple t
    		    			INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
    		    			WHERE (t.LinkTypeID IN (Select LinkTypeID from LinkType where
    		    			Label='has main theme'))";

$HUB_SQL->APILIB_CONNS_BY_THEME_NODETYPE_FILTER_PART1 = "( (t.FromContextTypeID IN (";
$HUB_SQL->APILIB_CONNS_BY_THEME_NODETYPE_FILTER_PART2 = ") AND t.ToID IN (";
$HUB_SQL->APILIB_CONNS_BY_THEME_NODETYPE_FILTER_PART3 = ")) OR (t.ToContextTypeID IN (";
$HUB_SQL->APILIB_CONNS_BY_THEME_NODETYPE_FILTER_PART4 = ") AND t.FromID IN (";
$HUB_SQL->APILIB_CONNS_BY_THEME_NODETYPE_FILTER_PART5 = ")))";


/** Get theme connections by node **/

$HUB_SQL->APILIB_THEME_CONNECTIONS_BY_NODE_SELECT = "SELECT t.TripleID FROM Triple t
													WHERE (LinkTypeID IN (Select LinkTypeID from LinkType
													where Label='has main theme'))";

/** Get popular themes by nodetype **/

$HUB_SQL->APILIB_THEMES_BY_TYPE_SELECT_PART1 = "SELECT count(Node.NodeID) as UseCount, Node.NodeID as NodeID, Node.Name as Name from Triple
								left join Node on Triple.ToID = Node.NodeID
								Where Node.UserID=? AND
								(Triple.LinkTypeID IN (Select LinkTypeID from LinkType where Label='has main theme')) AND
								ToContextTypeID IN (Select NodeTypeID from NodeType Where Name='Theme')
								AND FromContextTypeID IN (";

$HUB_SQL->APILIB_THEMES_BY_TYPE_SELECT_PART2 = ") AND ToLabel IN (";
$HUB_SQL->APILIB_THEMES_BY_TYPE_SELECT_PART3 = ") AND Node.Private='N' AND Triple.Private = 'N'";

$HUB_SQL->APILIB_THEMES_BY_TYPE_GROUP_ORDER = "group by Node.NodeID order by UseCount DESC";


/** Get tree data **/

$HUB_SQL->APILIB_TREE_DATA_VOTING = "SELECT SUM(Total) as count from (";
$HUB_SQL->APILIB_TREE_DATA_AUDIT_NODE = "SELECT count(*) as Total from AuditNode";
$HUB_SQL->APILIB_TREE_DATA_AUDIT_TRIPLE = "SELECT count(*) as Total from AuditTriple";


$HUB_SQL->APILIB_TREE_DATA_AUDIT_END = ") as alldata ";

$HUB_SQL->APILIB_TREE_DATA_WHERE_FROM_TO = " WHERE ModificationDate >= ? AND ModificationDate ?";
$HUB_SQL->APILIB_TREE_DATA_WHERE_FROM = " WHERE ModificationDate >= ?";
$HUB_SQL->APILIB_TREE_DATA_WHERE_TO = " WHERE ModificationDate <= ?";


/** Get nodes by group **/

$HUB_SQL->APILIB_NODES_BY_GROUP_SELECT = "SELECT t.NodeID,
							(SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
							(SELECT COUNT(ToID) FROM Triple WHERE ToID=t.NodeID) AS connectedness
							FROM Node t
							INNER JOIN NodeGroup tg ON tg.NodeID = t.NodeID
							LEFT JOIN TagNode ut ON t.NodeID = ut.NodeID
							LEFT JOIN Tag u ON u.tagID = ut.TagID
							LEFT JOIN URLNode rn ON t.NodeID = rn.NodeID
							LEFT JOIN URL r ON r.URLID = rn.URLID ";

$HUB_SQL->APILIB_NODES_BY_GROUP_NODETYPE = "LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID WHERE tg.GroupID=? AND nt.Name IN";
$HUB_SQL->APILIB_NODES_BY_GROUP_NODETYPE_NONE = "WHERE tg.GroupID=?";

$HUB_SQL->APILIB_NODE_GROUP_PRIVACY_SELECT = "SELECT t.NodeID FROM Node t
											INNER JOIN NodeGroup tg ON tg.NodeID = t.NodeID
											WHERE tg.GroupID=? AND t.UserID=?";

$HUB_SQL->APILIB_CONNECTION_GROUP_PRIVACY_SELECT = "SELECT t.TripleID FROM Node t
											INNER JOIN TripleGroup tg ON tg.TripleID = t.TripleID
											WHERE tg.GroupID=? AND t.UserID=?";

$HUB_SQL->APILIB_GET_ALL_GROUPS_SELECT = "SELECT DISTINCT GroupID FROM UserGroup order by CreationDate DESC";

$HUB_SQL->APILIB_GET_MY_GROUPS_SELECT = "SELECT DISTINCT GroupID FROM UserGroup WHERE UserID=?";
$HUB_SQL->APILIB_GET_MY_ADMIN_GROUPS_SELECT = $HUB_SQL->APILIB_GET_MY_GROUPS_SELECT." AND IsAdmin = 'Y'";

$HUB_SQL->APILIB_GROUPS_BY_GLOBAL_PART1	= "SELECT DISTINCT t.UserID FROM Users t
        									LEFT JOIN TagUsers tn ON t.UserID = tn.UserID
        									LEFT JOIN Tag u ON u.tagID = tn.TagID
											WHERE (t.CurrentStatus=? OR
											t.CurrentStatus=?)
											AND t.USERID <> ? AND t.IsGroup='Y'";


/** COHERE SPECIFIC **/

/** Get Users By User **/

$HUB_SQL->APILIB_USERS_BY_USER = "SELECT t.UserID FROM Users t
            						WHERE t.UserID IN
            						(SELECT GroupID FROM UserGroup WHERE UserID = ?)";

/** Get Users By Group **/

$HUB_SQL->APILIB_USERS_BY_GROUP = "SELECT t.UserID FROM Users t
            						WHERE t.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID=?)";

/** Get nodes not connected to other nodes **/

$HUB_SQL->APILIB_UNCONNECTED_NODES_SELECT = "SELECT t.NodeID FROM Node t
            								WHERE t.NodeID NOT IN (SELECT FromID FROM Triple)
            								AND t.NodeID NOT IN (SELECT ToID FROM Triple) AND ";
$HUB_SQL->APILIB_UNCONNECTED_NODES_SELECT .= $HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;

/** Get nodes which are connected to other nodes **/

$HUB_SQL->APILIB_CONNECTED_NODES_SELECT = "SELECT t.NodeID FROM Node t
            								WHERE (t.NodeID IN (SELECT FromID FROM Triple)
                							OR t.NodeID IN (SELECT ToID FROM Triple)) AND ";
$HUB_SQL->APILIB_CONNECTED_NODES_SELECT .= $HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;

/** Get nodes which are most connected to other nodes **/

$HUB_SQL->APILIB_MOST_CONNECTED_NODES_SELECT = "SELECT t.NodeID,
                								(SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
                								(SELECT COUNT(ToID) FROM Triple WHERE ToiD=t.NodeID) AS connectedness
            									FROM Node t WHERE ";
$HUB_SQL->APILIB_MOST_CONNECTED_NODES_SELECT .= $HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;

$HUB_SQL->APILIB_MOST_CONNECTED_NODES_SELECT_MY = " AND t.UserID=?";

$HUB_SQL->APILIB_NODES_GROUP_SELECT = "t.NodeID IN (SELECT NodeID FROM NodeGroup WHERE GroupID=?)";

$HUB_SQL->APILIB_MOST_CONNECTED_NODES_SELECT_GROUP = $HUB_SQL->AND.$HUB_SQL->APILIB_NODES_GROUP_SELECT;

/** Get popular nodes **/

$HUB_SQL->APILIB_POPULAR_NODES_SELECT_PART1A = "SELECT t.Name, COUNT(t.NodeID) AS connectedness, t2.NodeID FROM Node t
                								INNER JOIN (SELECT NodeID, Name FROM Node WHERE UserID=?)
                								t2 On t2.name = t.Name";
$HUB_SQL->APILIB_POPULAR_NODES_SELECT_PART1B = "SELECT t.Name, COUNT(t.NodeID) AS connectedness, t.NodeID FROM Node t";
$HUB_SQL->APILIB_POPULAR_NODES_SELECT_GROUP = "t.NodeID IN (SELECT NodeID FROM NodeGroup WHERE GroupID=?) AND ";
$HUB_SQL->APILIB_POPULAR_NODES_SELECT_GROUP_BY = " GROUP BY t.Name";

/** Get popular nodes by vote **/

$HUB_SQL->APILIB_POPULAR_NODES_BY_VOTE_SELECT_PART1 = "SELECT t.NodeID, COUNT(v.ItemID) AS connectedness FROM Node t
														left join Voting v on t.NodeID = v.ItemID
  														WHERE v.VoteType='Y' AND ";

$HUB_SQL->APILIB_POPULAR_NODES_BY_VOTE_SELECT_GROUP_BY = " GROUP BY v.ItemID";

/** Return usage statistics for groups usage of NodeTypes (Roles) **/

$HUB_SQL->APILIB_GROUP_NODE_TYPE_USAGE_PART1 = "SELECT nt.Name, count(t.NodeID) AS num
											FROM Node t LEFT JOIN NodeType nt on t.NodeTypeID = nt.NodeTypeID
											WHERE ";

$HUB_SQL->APILIB_GROUP_NODE_TYPE_USAGE_PART2 = "t.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID=?)
												AND t.NodeID IN (Select NodeID FROM NodeGroup WHERE GroupID=?)
												GROUP BY nt.Name ORDER BY num DESC";

/** Return usage statistics for groups usage of LinkTypes **/

$HUB_SQL->APILIB_GROUP_LINK_TYPE_USAGE_PART1 = "SELECT LinkType.Label, Count(t.TripleID) as num
												FROM Triple t inner join LinkType on t.LinkTypeID = LinkType.LinkTypeID
												WHERE ";

$HUB_SQL->APILIB_GROUP_LINK_TYPE_USAGE_PART2 = "t.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID=?)
												AND t.TripleID IN (Select TripleID FROM TripleGroup WHERE GroupID=?)
												GROUP BY LinkType.Label ORDER BY num DESC";

/** Get the urls for given user**/

$HUB_SQL->APILIB_URLS_BY_USER_PART1 = "SELECT u.URLID, COUNT(ut.NodeID) AS connectedness FROM URL u
            						LEFT JOIN URLNode ut ON u.URLID = ut.URLID
            						LEFT JOIN Node t ON t.NodeID = ut.NodeID ";

$HUB_SQL->APILIB_URLS_BY_USER_PART2 = " GROUP BY u.URLID";

/** Get the urls for given group**/

$HUB_SQL->APILIB_URLS_BY_GROUP_PART1 = "SELECT u.URLID, COUNT(u.URLID) AS connectedness FROM URL u
            					INNER JOIN URLGroup ug ON ug.URLID = u.URLID
            					WHERE ug.GroupID=? AND ".$HUB_SQL->APILIB_URLS_PERMISSIONS_ALL;

$HUB_SQL->APILIB_URLS_BY_GROUP_PART1b = " AND u.UserID IN";
$HUB_SQL->APILIB_URLS_BY_GROUP_PART2 = "GROUP BY u.URLID";

/** Get the urls for all nodes with the same label as the node with the given node id **/

$HUB_SQL->APILIB_URLS_BY_NODE_PART1 = "SELECT t.URLID, COUNT(Node.NodeID) AS connectedness FROM URLNode t
	            						INNER JOIN Node ON Node.NodeID = t.NodeID
	            						INNER JOIN URL u ON t.URLID = u.URLID
	            						WHERE t.NodeID in";

$HUB_SQL->APILIB_URLS_BY_NODE_PART2 = " GROUP BY t.URLID";

/** Get the urls for given url **/

$HUB_SQL->APILIB_URLS_BY_URL_PART1 = "SELECT u.URLID, COUNT(Node.NodeID) AS connectedness FROM URL u
            							LEFT JOIN URLNode ut ON u.URLID = ut.URLID
            							LEFT JOIN Node t ON t.NodeID = ut.NodeID
           								WHERE u.URL=? AND ";

$HUB_SQL->APILIB_URLS_BY_URL_PART2 = " GROUP BY u.URLID";

/** Get the urls with clips for given url **/

$HUB_SQL->APILIB_CLIPS_BY_URL_PART1 = "SELECT u.URLID FROM URL u WHERE u.URL=? AND ";
$HUB_SQL->APILIB_CLIPS_BY_URL_PART2 = " AND u.Clip IS NOT NULL and u.Clip != '' GROUP BY u.URLID";

/** Get the urls with clips for given url but not attached to an idea. **/

$HUB_SQL->APILIB_CLIPS_BY_URL_NO_IDEA_PART1 = "SELECT u.URLID FROM URL u
    											WHERE u.URL=? AND u.Clip IS NOT NULL and u.Clip != '' AND ";

$HUB_SQL->APILIB_CLIPS_BY_URL_NO_IDEA_PART2 = "AND t.URLID NOT IN (Select Distinct URLID from URLNode) GROUP BY t.URLID";

/** Get the clips for the given url where the url has been joined to the given node id **/

$HUB_SQL->APILIB_CLIPS_BY_NODE_AND_URL_PART1 = "SELECT t.URLID, COUNT(Node.NodeID) AS connectedness FROM URLNode t
	            								INNER JOIN Node ON Node.NodeID = t.NodeID INNER JOIN URL u on t.URLID = u.URLID
	            								WHERE u.URL=? AND ";

$HUB_SQL->APILIB_CLIPS_BY_NODE_AND_URL_PART2 = " AND u.Clip IS NOT NULL and u.Clip != '' AND t.NodeID=?
	            									GROUP BY t.URLID";


?>