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
 * REST service API
 *
 * All the methods listed are are available to users through REST-style URL calls
 * The methods should call the corresponding methods in the PHP API (core/apilib.php)
 *
 */

include_once('../config.php');

global $USER,$CFG;

//send the header info
set_service_header();

$method = optional_param("method","",PARAM_ALPHA);

// optional params for ordering, max no and sorting sets of objects and filtering
$start = optional_param("start",0,PARAM_INT);
$max = optional_param("max",20,PARAM_INT);
$o = optional_param("orderby","date",PARAM_ALPHA);
$s = optional_param("sort","DESC",PARAM_ALPHA);
$filterlinkgroup = optional_param("filtergroup","all", PARAM_TEXT);
$filterlinktypes = optional_param("filterlist","", PARAM_TEXT);
$filternodetypes = optional_param('filternodetypes', '', PARAM_TEXT);
$style= optional_param('style','long',PARAM_ALPHA);

//check start and max are more than 0!
if($start < 0){
    $start = 0;
}
if ($max < -1 ){
    $max = -1;
}

$response = "";
switch($method){
	case "nodevote":
        $vote = required_param('vote',PARAM_TEXT);
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = nodeVote($nodeid, $vote);
		break;
	case "deletenodevote":
        $vote = required_param('vote',PARAM_TEXT);
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = deleteNodeVote($nodeid, $vote);
		break;
	case "connectionvote":
        $vote = required_param('vote',PARAM_TEXT);
        $connid = required_param('connid',PARAM_ALPHANUM);
        $response = connectionVote($connid, $vote);
		break;
	case "deleteconnectionvote":
        $vote = required_param('vote',PARAM_TEXT);
        $connid = required_param('connid',PARAM_ALPHANUM);
        $response = deleteConnectionVote($connid, $vote);
		break;
	/*case "getvotes":
        $itemid = required_param('itemid',PARAM_ALPHANUM);
        $response = getVotes($nodeid, $vote);
		break;*/
    case "validatesession":
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = validateUserSession($userid);
        break;
    case "login":
        $username = required_param('username',PARAM_TEXT);
        $password = required_param('password',PARAM_TEXT);
        $response = login($username,$password);
        break;
    case "getuser":
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = getUser($userid,$style);
        break;
    case "logout":
        clearSession();
        $response = new Result("logout","logged out");
        break;
    case "getnode":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = getNode($nodeid,$style);
        break;
    case "addnode":
        $name = required_param('name',PARAM_TEXT);
        $desc = required_param('desc',PARAM_TEXT);
        $private = optional_param('private',$USER->privatedata,PARAM_ALPHA);
        $nodetypeid = optional_param('nodetypeid',"",PARAM_ALPHANUM);
        $imageurlid = optional_param('imageurlid',"",PARAM_ALPHANUM);
        $imagethumbnail = optional_param('imagethumbnail',"",PARAM_ALPHA);
        $response = addNode($name,$desc,$private,$nodetypeid,$imageurlid,$imagethumbnail);
        break;
    case "addnodesbyid":
        $nodeids = required_param('nodeids',PARAM_ALPHANUM);
        $response = addNodesById($nodeids);
        break;
    case "editnode":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $name = required_param('name',PARAM_TEXT);
        $desc = required_param('desc',PARAM_TEXT);
        $private = optional_param('private',$USER->privatedata,PARAM_ALPHA);
        $nodetypeid = optional_param('nodetypeid',"",PARAM_ALPHANUM);
        $response = editNode($nodeid,$name,$desc,$private,$nodetypeid);
        break;
    case "updatenodestartdate":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $startdatetime = optional_param('startdatetime',"",PARAM_ALPHANUM);
        $response = updateNodeStartDate($nodeid,$startdatetime);
        break;
    case "updatenodeenddate":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $enddatetime = optional_param('enddatetime',"",PARAM_ALPHANUM);
        $response = updateNodeEndDate($nodeid,$enddatetime);
        break;
    case "updatenodelocation":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $location = optional_param('location',"",PARAM_TEXT);
        $loccountry = optional_param('loccountry',"",PARAM_TEXT);
        $response = updateNodeLocation($nodeid,$location,$loccountry);
        break;
    case "deletenode":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = deleteNode($nodeid);
        break;
    case "deletenodes":
        $nodeids = required_param('nodeids',PARAM_TEXT);
        $response = deleteNodes($nodeids);
        break;
    case "getnodesbydate":
        $date = required_param('date',PARAM_INT);
        $response = getNodesByDate($date,$start,$max,$o,$s,$style);
        break;
    case "getnodesbyname":
        $name = required_param('name',PARAM_TEXT);
        $response = getNodesByName($name,$start,$max,$o,$s,$style);
        break;
    case "getnodesbyuser":
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = getNodesByUser($userid,$start,$max,$o,$s,$filternodetypes,$style);
        break;
    case "getnodesbygroup":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $filterusers = optional_param('filterusers', '', PARAM_TEXT);
        $response = getNodesByGroup($groupid,$start,$max,$o,$s,$filterusers,$filternodetypes, $style);
        break;
    case "getnodesbynode":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = getNodesByNode($nodeid,$start,$max,$o,$s,$filternodetypes,$style);
        break;
    case "getnodesbyurl":
        $url= required_param('url',PARAM_TEXT);
        $response = getNodesByURL($url,$start,$max,$o,$s,$filternodetypes,$style);
        break;
    case "getnodesbydoi":
        $doi= required_param('doi',PARAM_TEXT);
        $response = getNodesByDOI($doi,$start,$max,$o,$s,$filternodetypes,$style);
        break;
    case "getnodesbysearch":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $response = getNodesBySearch($query,$scope,$start,$max,$o,$s,$filternodetypes,$style);
        break;
    case "getnodesbytagsearch":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
        $response = getNodesByTagSearch($query,$scope,$start,$max,$o,$s,$filternodetypes,$groupid,$style);
        break;
    case "getnodesbyurlid":
        $url= required_param('urlid',PARAM_TEXT);
        $response = getNodesByURLID($urlid,$start,$max,$o,$s,$style);
        break;
    case "getunconnectednodes":
        $response = getUnconnectedNodes($start,$max,$o,$s,$style);
        break;
    case "getconnectednodes":
        $response = getConnectedNodes($start,$max,$o,$s,$style);
        break;
    case "getmostconnectednodes":
        $scope = optional_param('scope','my',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
        $response = getMostConnectedNodes($scope,$groupid,$start,$max,$style);
        break;
    case "geturl":
        $urlid = required_param('urlid',PARAM_ALPHANUM);
        $response = getURL($urlid);
        break;
    case "autocompleteurldetails":
        $url= required_param('url',PARAM_TEXT);
        $response = autoCompleteURLDetails($url);
        break;
    case "addurl":
        $url = required_param('url',PARAM_TEXT);
        $title = required_param('title',PARAM_TEXT);
        $desc = required_param('desc',PARAM_TEXT);
        $private = optional_param('private',$USER->privatedata,PARAM_ALPHA);
        $clip = optional_param('clip',"",PARAM_TEXT);
        $clippath = urldecode(optional_param('clippath',"",PARAM_TEXT));
        $createdfrom = urldecode(optional_param('createdfrom',"",PARAM_TEXT));
        $identifier = urldecode(optional_param('identifier',"",PARAM_TEXT));
        //$cliphtml = urldecode(optional_param('cliphtml',"",PARAM_HTML));
        $cliphtml = "";
        $response = addURL($url, $title, $desc, $private,$clip, $clippath, $cliphtml, createdfrom, identifier);
        break;
    case "editurl":
        $urlid = required_param('urlid',PARAM_ALPHANUM);
        $url = required_param('url',PARAM_TEXT);
        $name = required_param('name',PARAM_TEXT);
        $desc = required_param('desc',PARAM_TEXT);
        $private = optional_param('private',$USER->privatedata,PARAM_ALPHA);
        $clip = optional_param('clip',PARAM_TEXT);
        $clippath = urldecode(optional_param('clippath',"",PARAM_TEXT));
        $createdfrom = urldecode(optional_param('createdfrom',"",PARAM_TEXT));
        $identifier = urldecode(optional_param('identifier',"",PARAM_TEXT));
        //$cliphtml = urldecode(optional_param('cliphtml',"",PARAM_HTML));
        $cliphtml = "";
        $response = editURL($urlid,$url,$name,$desc,$private,$clip, $clippath, $cliphtml, createdfrom, identifier);
        break;
    case "deleteurl":
        $urlid = required_param('urlid',PARAM_TEXT);
        $response = deleteURL($urlid);
        break;
    case "geturlsbyuser":
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = getURLsByUser($userid,$start,$max,$o,$s);
        break;
    case "geturlsbygroup":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $filterusers = optional_param('filterusers', '', PARAM_TEXT);
        $response = getURLsByGroup($groupid,$start,$max,$o,$s,$filterusers);
        break;
    case "geturlsbysearch":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $response = getURLsBySearch($query,$scope,$start,$max,$o,$s);
        break;
    case "geturlsbytagsearch":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
        $response = getURLsByTagSearch($query,$scope,$start,$max,$o,$s,$groupid);
        break;
    case "geturlsbynode":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = getURLsByNode($nodeid,$start,$max,$o,$s);
        break;
   case "addurltonode":
        $urlid = required_param('urlid',PARAM_ALPHANUM);
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $comments = optional_param("comments","",PARAM_TEXT);
        $response = addURLToNode($urlid,$nodeid,$comments);
        break;
    case "removeurlfromnode":
        $urlid = required_param('urlid',PARAM_ALPHANUM);
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = removeURLFromNode($urlid,$nodeid);
        break;
    case "removeallurlsfromnode":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = removeAllURLsFromNode($urlid);
        break;
    case "getconnection":
        $connid = required_param('connid',PARAM_ALPHANUM);
        $response = getConnection($connid,$style);
        break;
    case "getconnectionsbyuser":
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = getConnectionsByUser($userid,$start,$max,$o,$s,$filterlinkgroup,$filterlinktypes,$filternodetypes,$style);
        break;
    case "getconnectionsbygroup":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $filterusers = optional_param('filterusers', '', PARAM_TEXT);
        $response = getConnectionsByGroup($groupid,$start,$max,$o,$s,$filterlinkgroup,$filterlinktypes,$filterusers,$filternodetypes,$style);
        break;
    case "getconnectionsbysearch":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $response = getConnectionsBySearch($query,$scope,$start,$max,$o,$s,$filterlinkgroup,$filterlinktypes,$filternodetypes,$style);
        break;
    case "getconnectionsbytagsearch":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
        $response = getConnectionsByTagSearch($query,$scope,$start,$max,$o,$s,$filterlinkgroup,$filterlinktypes,$filternodetypes,$groupid,$style);
        break;

	case "getnoderolesbytagsearch":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
		$response = getNodeRolesByTagSearch($query,$scope,$groupid);
		break;
	case "getconnectionrolesbytagsearch":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
		$response = getConnectionRolesByTagSearch($query,$scope,$groupid);
		break;
    case "getconnectionsbynode":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = getConnectionsByNode($nodeid,$start,$max,$o,$s,$filterlinkgroup,$filterlinktypes,$filternodetypes,$style);
        break;
   	case "getconnectionsbyurl":
        $url= required_param('url',PARAM_TEXT);
        $response = getConnectionsByURL($url,$start,$max,$o,$s,$filterlinkgroup,$filterlinktypes,$filternodetypes,$style);
        break;
    case "getconnectionsbyfromlabel":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $max = -1;
        $response = getConnectionsByFromLabel($nodeid,$start,$max,$o,$s,$filterlinkgroup,$filterlinktypes,$style);
        break;
    case "getconnectionsbytolabel":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $max = -1;
        $response = getConnectionsByToLabel($nodeid,$start,$max,$o,$s,$filterlinkgroup,$filterlinktypes,$style);
        break;
    case "getconnectionsbylinktypelabel":
        $linktypelabel = required_param('linktypelabel',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $response = getConnectionsByLinkType($linktypelabel,$scope,$start,$max,$o,$s,$filterlinkgroup,$filterlinktypes,$style);
        break;
    case "getconnectionsbypath":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $linklabels = required_param('linklabels',PARAM_TEXT);
        $scope = optional_param('scope','my',PARAM_ALPHA);
        $userid = ""; //optional_param('userid','',PARAM_ALPHANUM);
        $linkgroup = optional_param('linkgroup','',PARAM_TEXT);
        $depth = optional_param('depth','7',PARAM_INT);
        $direction = optional_param('direction','both',PARAM_ALPHA);
        $labelmatch = optional_param('labelmatch','false',PARAM_BOOLTEXT);
        $response = getConnectionsByPath($nodeid,$linklabels,$userid,$scope,$linkgroup,$depth,$direction,$labelmatch,$style);
        break;
    case "getconnectionsbypathbydepth":
        $nodeid = optional_param('nodeid','',PARAM_ALPHANUM);
        $searchid = optional_param('searchid','', PARAM_ALPHANUM);
        $scope = optional_param('scope','my',PARAM_ALPHA);
        $labelmatch = optional_param('labelmatch','false',PARAM_BOOLTEXT);
        $depth = optional_param('depth','7',PARAM_INT);

        $linklabels = optional_param('linklabels',null,PARAM_TEXT);
        $linkgroups = optional_param('linkgroups',null,PARAM_TEXT);
        $directions = optional_param('directions',null,PARAM_TEXT);
        $nodetypes = optional_param('nodetypes',null,PARAM_TEXT);
        $nodeids = optional_param('nodeids',null,PARAM_TEXT);

        $logictype = optional_param('logictype','or',PARAM_ALPHA);
        $uniquepath = optional_param('uniquepath','false',PARAM_BOOLTEXT);

		if ($logictype == "and") {
        	$response = getConnectionsByPathByDepth($scope,$labelmatch,$nodeid,$depth,$linklabels,$linkgroups,$directions,$nodetypes,$nodeids, $uniquepath, $style);
        } else {
        	$response = getConnectionsByPathByDepthOR($scope,$labelmatch,$nodeid,$depth,$linklabels,$linkgroups,$directions,$nodetypes,$nodeids, $uniquepath, $style);
        }
        break;
   case "addconnection":
        $fromnodeid = required_param('fromnodeid',PARAM_ALPHANUM);
        $fromroleid = required_param('fromroleid',PARAM_ALPHANUM);
        $linktypeid = required_param('linktypeid',PARAM_ALPHANUM);
        $tonodeid = required_param('tonodeid',PARAM_ALPHANUM);
        $toroleid = required_param('toroleid',PARAM_ALPHANUM);
        $private = optional_param('private',$USER->privatedata,PARAM_ALPHA);
        $description = optional_param('description',"",PARAM_TEXT);
        $response = addConnection($fromnodeid,$fromroleid,$linktypeid,$tonodeid,$toroleid,$private,$description);
        break;
    case "editconnection":
        $connid = required_param('connid',PARAM_ALPHANUM);
        $fromnodeid = required_param('fromnodeid',PARAM_ALPHANUM);
        $fromroleid = required_param('fromroleid',PARAM_ALPHANUM);
        $linktypeid = required_param('linktypeid',PARAM_ALPHANUM);
        $tonodeid = required_param('tonodeid',PARAM_ALPHANUM);
        $toroleid = required_param('toroleid',PARAM_ALPHANUM);
        $private = optional_param('private',$USER->privatedata,PARAM_ALPHA);
        $description = optional_param('description',"",PARAM_TEXT);
        $response = editConnection($connid,$fromnodeid,$fromroleid,$linktypeid,$tonodeid,$toroleid,$private,$description);
        break;
    case "deleteconnection":
        $connid = required_param('connid',PARAM_ALPHANUM);
        $response = deleteConnection($connid);
        break;
    case "deleteconnections":
        $connids = required_param('connids',PARAM_ALPHANUM);
        $response = deleteConnections($connids);
        break;
    case "copyconnection":
        $connid = required_param('connid',PARAM_ALPHANUM);
        $response = copyConnection($connid);
        break;
    case "getrole":
        $roleid = required_param('roleid',PARAM_ALPHANUM);
        $response = getRole($roleid);
        break;
    case "getrolebyname":
        $rolename = required_param('rolename',PARAM_TEXT);
        $response = getRoleByName($rolename);
        break;
    case "getallroles":
        $response = getAllRoles();
        break;
    case "getuserroles":
        $response = getUserRoles();
        break;
    case "addrole":
        $rolename = required_param('rolename',PARAM_TEXT);
        $image = optional_param('image',null,PARAM_TEXT);
        $response = addRole($rolename,$image);
        break;
    case "editrole":
        $roleid = required_param('roleid',PARAM_ALPHANUM);
        $rolename = required_param('rolename',PARAM_TEXT);
        $image = optional_param('image',null,PARAM_TEXT);
        $response = editRole($roleid,$rolename,$image);
        break;
    case "deleterole":
        $roleid = required_param('roleid',PARAM_ALPHANUM);
        $response = deleteRole($roleid);
        break;
    case "getnoderolesbynode":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
    	$response = getNodeRolesByNode($nodeid);
    	break;
    case "getnoderolesbygroup":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
    	$response = getNodeRolesByGroup($groupid);
    	break;
    case "getnoderolesbyuser":
        $userid = required_param('userid',PARAM_ALPHANUM);
    	$response = getNodeRolesByUser($userid);
    	break;
    case "getnoderolesbyurl":
        $url= required_param('url',PARAM_TEXT);
    	$response = getNodeRolesByURL($url);
    	break;
    case "getlinktype":
        $linktypeid = required_param('linktypeid',PARAM_ALPHANUM);
        $response = getLinkType($linktypeid);
        break;
    case "getlinktypebylabel":
        $label = required_param('label',PARAM_TEXT);
        $response = getLinkTypeByLabel($label);
        break;
    case "getalllinktypes":
        $response = getAllLinkTypes();
        break;
    case "getuserlinktypes":
        $response = getUserLinkTypes();
        break;
    case "addlinktype":
        $label = required_param('label',PARAM_TEXT);
        $linktypegroup = required_param('linktypegroup',PARAM_TEXT);
        $response = addLinkType($label,$linktypegroup);
        break;
    case "editlinktype":
        $linktypeid = required_param('linktypeid',PARAM_ALPHANUM);
        $linktypelabel = required_param('linktypelabel',PARAM_TEXT);
        $response = editLinkType($linktypeid,$linktypelabel);
        break;
    case "deletelinktype":
        $linktypeid = required_param('linktypeid',PARAM_ALPHANUM);
        $response = deleteLinkType($linktypeid);
        break;
    case "getrecentusers":
        $response = getRecentUsers($start,$max,$o,$s,$style);
        break;
    case "getactiveconnectionusers":
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
    	$response = getActiveConnectionUsers($start,$max,$style,$groupid);
    	break;
    case "getmostconnectedusers":
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
    	$response = getMostConnectedUsers($start,$max,$style,$groupid);
    	break;
    case "getactiveideausers":
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
    	$response = getActiveIdeaUsers($start,$max,$style,$groupid);
    	break;
    case "getrecentconnections":
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $response = getRecentConnections($start,$max,$o,$s,$style);
        break;
    case "getrecentnodes":
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
        $response = getRecentNodes($scope,$groupid,$start,$max,$style);
        break;
    case "getpopularnodes":
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
        $response = getPopularNodes($scope,$groupid, $start,$max,$style);
        break;
    case "getpopularnodesbyvote":
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
        $response = getPopularNodesByVote($scope,$groupid, $start,$max,$style);
        break;
    case "getgroupnodetypeusage":
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
    	$response = getGroupNodeTypeUsage($groupid,$scope);
    	break;
    case "getgrouplinktypeusage":
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
    	$response = getGroupLinkTypeUsage($groupid,$scope);
    	break;
    case "searchusernodes":
        $query = required_param('q',PARAM_TEXT);
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = searchUserNodes($userid, $query);
        break;
    case "getnodesbyfirstcharacters":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','my',PARAM_ALPHA);
        $response = getNodesByFirstCharacters($query,$scope,$start,$max,"name","ASC",$style);
        break;
    case "getgroup":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $response = getGroup($groupid);
        break;
    case "addgrouptonode":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = addGroupToNode($nodeid,$groupid);
        break;
    case "addgrouptonodes":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $nodeids = required_param('nodeids',PARAM_TEXT);
        $response = addGroupToNodes($nodeids,$groupid);
        break;
    case "removegroupfromnode":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = removeGroupFromNode($nodeid,$groupid);
        break;
    case "removegroupfromnodes":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $nodeids = required_param('nodeids',PARAM_TEXT);
        $response = removeGroupFromNodes($nodeids,$groupid);
        break;
    case "removeallgroupsfromnode":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = removeAllGroupsFromNode($nodeid);
        break;
    case "setgroupprivacy":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $private = required_param('private',PARAM_ALPHA);
        $response = setGroupPrivacy($groupid,$private);
        break;
    case "addgrouptoconnection":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $connid = required_param('connid',PARAM_ALPHANUM);
        $response = addGroupToConnection($connid,$groupid);
        break;
    case "addgrouptoconnections":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $connids = required_param('connids',PARAM_TEXT);
        $response = addGroupToConnections($connids,$groupid);
        break;
    case "removegroupfromconnection":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $connid= required_param('connid',PARAM_ALPHANUM);
        $response = removeGroupFromConnection($connid,$groupid);
        break;
    case "removegroupfromconnections":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $connids= required_param('connids',PARAM_TEXT);
        $response = removeGroupFromConnections($connids,$groupid);
        break;
    case "removeallgroupsfromconnection":;
        $connid= required_param('connid',PARAM_ALPHANUM);
        $response = removeAllGroupsFromConnection($connid);
        break;
    case "getmygroups":
        $response = getMyGroups();
        break;
    case "getmyadmingroups":
        $response = getMyAdminGroups();
        break;
    case "addgroup":
        $groupname = required_param('groupname',PARAM_TEXT);
        $response = addGroup($groupname);
        break;
    case "deletegroup":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $response = deleteGroup($groupid);
        break;
    case "addgroupmember":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = addGroupMember($groupid,$userid);
        break;
    case "makegroupadmin":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = makeGroupAdmin($groupid,$userid);
        break;
    case "removegroupadmin":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = removeGroupAdmin($groupid,$userid);
        break;
    case "removegroupmember":
        $groupid = required_param('groupid',PARAM_ALPHANUM);
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = removeGroupMember($groupid,$userid);
        break;
    case "getusersbyuser":
        $userid = required_param('userid',PARAM_ALPHANUM);
        $response = getUsersByUser($userid,$start,$max,$o,$s,$style);
        break;
    case "getusersbynode":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = getUsersByNode($nodeid,$start,$max,$o,$s,$style);
        break;
    case "getusersbysearch":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $response = getUsersBySearch($query,$scope,$start,$max,$o,$s,$style);
        break;
    case "getusersbytagsearch":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','all',PARAM_ALPHA);
        $groupid = optional_param('groupid','',PARAM_ALPHANUM);
        $response = getUsersByTagSearch($query,$scope,$start,$max,$o,$s,$groupid,$style);
        break;
    case "getusersbygroup":
        $groupid= required_param('groupid',PARAM_ALPHANUM);
        $response = getUsersByGroup($groupid,$start,$max,$o,$s,$style);
        break;
    case "geturlsbyurl":
        $url= required_param('url',PARAM_TEXT);
        $response = getURLsByURL($url,$start,$max,$o,$s,$style);
        break;
    case "getclipsbyurl":
        $url= required_param('url',PARAM_TEXT);
        $response = getClipsByURL($url,$start,$max,$o,$s,$style);
        break;
    case "getclipsbyurlnoidea":
        $url= required_param('url',PARAM_TEXT);
        $response = getClipsByURLNoIdea($url,$start,$max,$o,$s,$style);
        break;
    case "getclipsbynodeandurl":
        $url= required_param('url',PARAM_TEXT);
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = getClipsByNodeAndURL($url,$nodeid,$start,$max,$o,$s,$style);
        break;
    case "getusersbyurl":
        $url= required_param('url',PARAM_TEXT);
        $response = getUsersByURL($url,$start,$max,$o,$s,$style);
        break;
    case "addfeed":
        $url = required_param('url',PARAM_URL);
        $name = required_param('name',PARAM_TEXT);
        $regular = optional_param('regular','N',PARAM_ALPHA);
        $response = addFeed($url,$name,$regular);
        break;
    case "refreshfeed":
        $feedid = required_param('feedid',PARAM_ALPHANUM);
        $response = refreshFeed($feedid);
        break;
    case "getfeedsforuser":
        $userid = optional_param('userid',$USER->userid,PARAM_ALPHANUM);
        $response = getFeedsForUser($userid);
        break;
    case "feedsetregular":
        $feedid = required_param('feedid',PARAM_ALPHANUM);
        $regular = required_param('regular',PARAM_ALPHA);
        $response = feedSetRegular($feedid,$regular);
        break;
    case "deletefeed":
        $feedid = required_param('feedid',PARAM_ALPHANUM);
        $response = deleteFeed($feedid);
        break;
    case "addtousercache":
        $idea = required_param('idea',PARAM_TEXT);
        $response = addToUserCache($idea);
        break;
    case "deletefromusercache":
        $idea = required_param('idea',PARAM_TEXT);
        $response = deleteFromUserCache($idea);
        break;
    case "getusercache":
        $response = getUserCache();
        break;
    case "getusercachenodes":
        $response = getUserCacheNodes($start,$max,"date","DESC");
        break;
    case "clearusercache":
        $response = clearUserCache();
        break;
    case "tweetuseridea":
        $nodeid = required_param('nodeid',PARAM_ALPHANUM);
        $response = tweetUserIdea($nodeid);
        break;
    case "addtolog":
        $action = required_param('action',PARAM_TEXT);
        $type = required_param('type',PARAM_TEXT);
        $id = required_param('id',PARAM_ALPHANUM);
        $response = addToLog($action,$type,$id);
        break;
    case "gettag":
        $tagid = required_param('tagid',PARAM_ALPHANUM);
        $response = getTag($tagid);
        break;
    case "gettagbyname":
        $tagname = required_param('tagname',PARAM_TEXT);
        $response = getTagByName($tagname);
        break;
    case "getusertags":
        $response = getUserTags();
        break;
    case "addtagstoconnections":
        $tags = required_param('tags',PARAM_TEXT);
        $connids = required_param('connids',PARAM_TEXT);
    	$response = addTagsToConnections($tags, $connids);
    	break;
    case "addtagstonodes":
        $tags = required_param('tags',PARAM_TEXT);
        $nodeids = required_param('nodeids',PARAM_TEXT);
    	$response = addTagsToNodes($tags, $nodeids);
    	break;
    case "addtagstourls":
        $tags = required_param('tags',PARAM_TEXT);
        $urlids = required_param('urlids',PARAM_TEXT);
    	$response = addTagsToURLs($tags, $urlids);
    	break;
    case "addtag":
        $tagname = required_param('tagname',PARAM_TEXT);
        $response = addTag($tagname);
        break;
    case "edittag":
        $tagid = required_param('tagid',PARAM_ALPHANUM);
        $tagname = required_param('tagname',PARAM_TEXT);
        $response = editTag($tagid,$tagname);
        break;
    case "deletetag":
        $tagid = required_param('tagid',PARAM_ALPHANUM);
        $response = deleteTag($tagid);
        break;
    case "gettagsbynode":
        $nodeid= required_param('nodeid',PARAM_ALPHANUM);
        $response = getTagsByNode($nodeid);
        break;
    case "getnodesbytagid":
        $tagid= required_param('tagid',PARAM_ALPHANUM);
        $response = getNodesByTag($tagid,$start,$max,$o,$s,$style);
        break;
    case "getnodesbytagname":
        $tagname= required_param('tagname',PARAM_TEXT);
        $response = getNodesByTagName($tagname,$start,$max,$o,$s,$style);
        break;
    case "gettagsbyfirstcharacters":
        $query = required_param('q',PARAM_TEXT);
        $scope = optional_param('scope','my',PARAM_ALPHA);
        $response = getTagsByFirstCharacters($query,$scope);
        break;
    case "getusersearches":
        $response = getUserSearches();
        break;
    case "getsearchbyid":
        $searchid = required_param('searchid',PARAM_ALPHANUM);
        $response = getSearch($searchid);
        break;
    case "deletesearch":
        $searchid = required_param('searchid',PARAM_ALPHANUM);
        $response = deleteSearch($searchid);
        break;
    case "deletesearchagent":
        $agentid = required_param('agentid',PARAM_ALPHANUM);
        $response = deleteSearchAgent($agentid);
        break;
    case "runsearchagent":
        $searchid = required_param('searchid',PARAM_ALPHANUM);
        $type = optional_param('type','user',PARAM_TEXT);
        $response = runSearchAgent($searchid);
        break;
    case "loadsearchagentrun":
        $searchid = required_param('searchid',PARAM_ALPHANUM);
        $runid = required_param('runid',PARAM_ALPHANUM);
        $response = loadSearchAgentRun($searchid, $runid);
        break;
    case "loadsearchagentrunnew":
        $searchid = required_param('searchid',PARAM_ALPHANUM);
        $runid = required_param('runid',PARAM_ALPHANUM);
        $response = loadSearchAgentRunNew($searchid, $runid);
        break;
   case "getmulticonnections":
        $connectionids = parseToJSON(required_param('connectionids',PARAM_TEXT)); // needs this parsing to convert single speech marks back.
        $response = getMultiConnections($connectionids,$start,$max,$o,$s,$style);
    	break;
   case "getmultinodes":
        $nodeids = parseToJSON(required_param('nodeids',PARAM_TEXT)); // needs this parsing to convert single speech marks back.
        $response = getMultiNodes($nodeids,$start,$max,$o,$s,$style);
    	break;
    default:
        //error as method not defined.
        global $ERROR;
        $ERROR = new Hub_Error;
        $ERROR->message = "Invalid or no method specified";
        $ERROR->code = "1001";
        include($CFG->dirAddress."api/apierror.php");
        die;
}
// finally format the output based on the format param in url
echo format_output($response);


?>