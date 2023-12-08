<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2020 The Open University UK                                   *
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
 *
 * Cohere API functions
 *
 * <p>This page describes the services currently available through the Cohere API. The service base URL is:
 * <pre>
 *     <a href="http://cohere.open.ac.uk/api/service.php">http://cohere.open.ac.uk/api/service.php</a>
 * </pre>
 * and it will always require a 'method' parameter.</p>
 *
 * <p>In all service calls, an optional parameter 'format' can be provided
 * to set how the output is displayed, the default is 'xml', but other options currently are 'gmap','json','list','rdf','rss', 'shortxml' and 'simile'.
 * Not all formats are available with all methods, as explained below:</p>
 * <ul>
 * <li>'xml', 'json' and 'rdf' formats are available to all methods</li>
 * <li>'rss' and 'shortxml' formats are only available to methods which return a NodeSet or ConnectionSet
 * <li>'gmap' and 'simile' formats are only available to methods which return a NodeSet.</li>
 * <li>'list' format is available to methods which return a NodeSet or a TagSet.</li>
 * </ul>
 * If you specify 'json' as the output format, then you can (optionally) provide a parameter 'callback'.</p>
 *
 * <p>Although all the example services calls show the parameters passed as GET requests, parameters will be accepted as either GET or POST -
 * so the parameters can be provided in any order - not just the order in which they've been listed on this page.</p>
 *
 * <p>Some services require a valid user login to work (essentially any add, edit or delete method) and in these cases, when you call
 * the service, you must also provide a valid Cohere session cookie, this can be obtained by calling the login service.
 * If you are calling the services via your web browser, you won't need to worry much about this, as your browser will automatically store and send
 * the cookie with each service call.</p>
 *
 * <p>If you are using a script to automate requests such as add or delete nodes, then rather than grabbing and resending the cookies,
 * you can obtain the sessionid from the userlogin request and then append this to each subsequent request by adding PHPSESSID={your-session-id} as an extra parameter.</p>
 *
 * <p>Example service calls:
 * <pre>
 *     <a href="http://cohere.open.ac.uk/api/service.php?method=getnode&amp;nodeid=131211811270778613001206700042870488149">http://cohere.open.ac.uk/api/service.php?method=getnode&amp;nodeid=131211811270778613001206700042870488149</a>
 *     <a href="http://cohere.open.ac.uk/api/service.php?method=getnodesbyuser&amp;userid=1371081452501184165093">http://cohere.open.ac.uk/api/service.php?method=getnodesbyuser&amp;userid=1371081452501184165093</a>
 *     <a href="http://cohere.open.ac.uk/api/service.php?method=getnodesbyuser&amp;userid=1371081452501184165093&amp;format=json">http://cohere.open.ac.uk/api/service.php?method=getnodesbyuser&amp;userid=1371081452501184165093&amp;format=json</a>
 *     <a href="http://cohere.open.ac.uk/api/service.php?method=getnodesbyuser&amp;userid=1371081452501184165093&amp;format=rdf">http://cohere.open.ac.uk/api/service.php?method=getnodesbyuser&amp;userid=1371081452501184165093&amp;format=rdf</a>
 *     <a href="http://cohere.open.ac.uk/api/service.php?method=getnodesbyuser&amp;userid=1371081452501184165093&amp;format=xml">http://cohere.open.ac.uk/api/service.php?method=getnodesbyuser&amp;userid=1371081452501184165093&amp;format=xml</a>
 * </pre>
 * </p>
 * <p>Example calls are given below for each service and it is noted which services require the user to be logged in</p>
 * <p>Note that if any required parameters are missing from a service call, then an error object will be returned detailing the missing parameter.</p>
 *
 * <p>For any datetime parameter the following formats will be accepted:</p>
 * <ul>
 * <li>14 May 2008</li>
 * <li>14-05-2008</li>
 * <li>14 May 2008 9:00</li>
 * <li>14 May 2008 9:00PM</li>
 * <li>14-05-2008 9:00PM</li>
 * <li>9:00</li>
 * <li>14 May</li>
 * <li>wed</li>
 * <li>wed 9:00</li>
 * </ul>
 * <p>and the following formats would not be accepted:</p>
 * <ul>
 * <li>14 05 2008</li>
 * <li>14/05/2008</li>
 * <li>14 05 2008 9:00</li>
 * <li>14/05/2008 9:00</li>
 * <li>14-05</li>
 * </ul>
 *
 */

/**
 * @ignore
 */
require_once('accesslib.php');
/**
 * @ignore
 */
require_once('utillib.php');
/**
 * @ignore
 */
require_once('formatlib.php');
/**
 * @ignore
 */
require_once('datamodel/node.class.php');
/**
 * @ignore
 */
require_once('datamodel/nodeset.class.php');
/**
 * @ignore
 */
require_once('datamodel/url.class.php');
/**
 * @ignore
 */
require_once('datamodel/urlset.class.php');
/**
 * @ignore
 */
require_once('datamodel/user.class.php');
/**
 * @ignore
 */
require_once('datamodel/userset.class.php');
/**
 * @ignore
 */
require_once('datamodel/result.class.php');
/**
 * @ignore
 */
require_once('datamodel/connection.class.php');
/**
 * @ignore
 */
require_once('datamodel/connectionset.class.php');
/**
 * @ignore
 */
require_once('datamodel/role.class.php');
/**
 * @ignore
 */
require_once('datamodel/roleset.class.php');
/**
 * @ignore
 */
require_once('datamodel/linktype.class.php');
/**
 * @ignore
 */
require_once('datamodel/linktypeset.class.php');
/**
 * @ignore
 */
require_once('datamodel/tag.class.php');
/**
 * @ignore
 */
require_once('datamodel/tagset.class.php');
/**
 * @ignore
 */

require_once('datamodel/group.class.php');
/**
 * @ignore
 */
require_once('datamodel/groupset.class.php');
/**
 * @ignore
 */
require_once('datamodel/feed.class.php');
/**
 * @ignore
 */
require_once('datamodel/feedset.class.php');
/**
 * @ignore
 */
require_once('datamodel/userscache.class.php');

/**
 * @ignore
 */
require_once('datamodel/search.class.php');

/**
 * @ignore
 */
require_once('datamodel/searchset.class.php');

/**
 * @ignore
 */
require_once('datamodel/searchagent.class.php');
/**
 * @ignore
 */
require_once('datamodel/searchagentrun.class.php');


/**
 * @ignore
 */
require_once('datamodel/log.class.php');


///////////////////////////////////////////////////////////////////
// functions for nodes
///////////////////////////////////////////////////////////////////
/**
 * Vote for the node with the given nodeid
 *
 * @param string $nodeid
 * @param string $vote to make ('Y' vote or 'N' vote);
 * @return Node or Error
 */
function nodeVote($nodeid,$vote){
    $n = new CNode($nodeid);
    return $n->vote($vote);
}

/**
 * Delete Vote for the node with the given nodeid
 *
 * @param string $nodeid
 * @param string $vote to delete ('Y' vote or 'N' vote);
 * @return Node or Error
 */
function deleteNodeVote($nodeid,$vote){
    $n = new CNode($nodeid);
    return $n->deleteVote($vote);
}

/**
 * Get all the Votes for the object with the given itemid
 *
 * @param string $itemid
 * @return Voting or Error
 */
/*function getVotes($itemid){
    $n = new Voting($itemid);
    return $n->getVotes();
}*/


/**
 * Get a node
 *
 * @param string $nodeid
 * @param string $style (optional - default 'long') may be 'short' or 'long'
 * @return Node or Error
 */
function getNode($nodeid,$style='long'){
    $n = new CNode($nodeid);
    return $n->load($style);
}

/**
 * Add a node. Requires login
 *
 * @param string $name
 * @param string $desc
 * @param string $private optional, can be Y or N, defaults to users preferred setting
 * @param string $nodetypeid optional, the id of the nodetype this node is, defaults to 'Idea' node type id.
 * @param string $imageurlid optional, the urlid of the url for the image that is being used as this node's icon
 * @param string $imagethumbnail optional, the local server path to the thumbnail of the image used for this node
 *
 * @return Node or Error
 */
function addNode($name,$desc,$private="",$nodetypeid="",$imageurlid="",$imagethumbnail=""){
    global $USER;
    if($private == ""){
        $private = $USER->privatedata;
    }
    if($nodetypeid == "") {
    	$r = new Role();
    	$nodetypeid = $r->getDefaultRoleID();
    }
    $n = new CNode();
    $node = $n->add($name,$desc,$private,$nodetypeid,$imageurlid,$imagethumbnail);
    return $node;
}

/**
 * Adds nodes. Requires login.
 *
 * Purpose of this function is to allow the importing of another users nodes into
 * the users workspace, and more than one at a time can be added
 *
 * @param string $nodeids
 * @return Result or Error
 */
function addNodesById($nodeids){
    global $USER;
    $nodesArr = explode(",",$nodeids);
    foreach ($nodesArr as $nodeid){
        $exN = new CNode($nodeid);
        $exN->load();
        $n = new CNode();
        $n->add($exN->name,$exN->desc,$USER->privatedata);
        //now add any URLs
        foreach($exN->urls as $url){
            $urlobj = new URL();
            $urlobj->add($url->url, $url->title, $url->description, $url->private, $url->clip, $url->clippath, $url->cliphtml);
            $n->addURL($urlobj->urlid,"");
        }
    }
    return new Result("added","true");
}

/**
 * Edit a node. Requires login and user must be owner of the node.
 *
 * @param string nodeid
 * @param string name
 * @param string desc
 * @param string $private optional, can be Y or N, defaults to users preferred setting
 * @param string $nodetypeid optional, the id of the nodetype this node is, defaults to 'Idea' node type id.
 * @param string $imageurlid optional, the urlid of the url for the image that is being used as this node's icon
 * @param string $imagethumbnail optional, the local server path to the thumbnail of the image used for this node
 * @return Node or Error
 */
function editNode($nodeid,$name,$desc,$private="",$nodetypeid="",$imageurlid="",$imagethumbnail=""){
    global $USER;
    if($private == ""){
        $private = $USER->privatedata;
    }

    if($nodetypeid == "") {
    	$r = new Role();
    	$nodetypeid = $r->getDefaultRoleID();
    }

    $n = new CNode($nodeid);
    $n->load();
    $node = $n->edit($name,$desc,$private,$nodetypeid,$imageurlid,$imagethumbnail);
    return $node;
}

/**
 * update a node start date. Requires login and user must be owner of the node.
 *
 * @param string nodeid
 * @param string $startdatetime optional text representation of start date and/or time

 * @return Node or Error
 */
function updateNodeStartDate($nodeid,$startdatetime){
    global $USER;
    $n = new CNode($nodeid);
    $n->load();
    $node = $n->updateStartDate($startdatetime);
    return $node;
}

/**
 * update a node end date. Requires login and user must be owner of the node.
 *
 * @param string nodeid
 * @param string $enddatetime optional text representation of start date and/or time
 * @return Node or Error
 */
function updateNodeEndDate($nodeid,$enddatetime){
    global $USER;
    $n = new CNode($nodeid);
    $n->load();
    $node = $n->updateEndDate($enddatetime);
    return $node;
}

/**
 * update a node location. Requires login and user must be owner of the node.
 *
 * @param string nodeid
 * @param string $location optional
 * @param string $loccountry optional
 * @return Node or Error
 */
function updateNodeLocation($nodeid,$location,$loccountry){
    global $USER;
    $n = new CNode($nodeid);
    $n->load();
    $node = $n->updateLocation($location,$loccountry);
    return $node;
}


/**
 * Delete a node. Requires login and user must be owner of the node.
 *
 * @param string $nodeid
 * @return Result or Error
 */
function deleteNode($nodeid){
    $n = new CNode($nodeid);
    $result = $n->delete();
    return $result;
}

/**
 * Deletes a set of nodes. Requires login and user must be owner of each node.
 *
 * @param string $nodeids (comma separated list of nodeids)
 * @return Result or Error
 */
function deleteNodes($nodeids){
    $nodesArr = explode(",",$nodeids);
    foreach ($nodesArr as $nodeid){
        $n = new CNode($nodeid);
        $n->delete();
    }
    return new Result("deleted","true");
}

/**
 * Get the nodes for given user
 *
 * @param string $userid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20), -1 means all
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesByUser($userid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC', $filternodetypes="", $style='long'){
    global $CFG,$USER,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();

    $sql = $HUB_SQL->APILIB_NODES_SELECT_START;

	// FILTER NODE TYPES
    if ($filternodetypes != "") {
        $pieces = explode(",", $filternodetypes);
        $sqlList = "";
		$loopCount = 0;
        foreach ($pieces as $value) {
        	$params[count($params)] = $value;
        	if ($loopCount == 0) {
        		$sqlList .= "?";
        	} else {
        		$sqlList .= ",?";
        	}
        	$loopCount++;
        }
        $sql .= $HUB_SQL->APILIB_FILTER_NODETYPES.$HUB_SQL->OPENING_BRACKET;
	    $sql .= $sqlList;
	    $sql .= $HUB_SQL->CLOSING_BRACKET.$HUB_SQL->AND;
    }  else {
        $sql .= $HUB_SQL->WHERE;
    }

	// FILTER BY USER
	$params[count($params)] = $userid;
    $sql .= $HUB_SQL->FILTER_USER;

	// PERMISSIONS
	$params[count($params)] = 'N';
	$params[count($params)] = $currentuser;
	$params[count($params)] = $currentuser;
    $sql .= $HUB_SQL->AND.$HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;

	if ($orderby == 'vote') {
		$sql = $HUB_SQL->APILIB_NODE_ORDERBY_VOTE_PART1.$sql.$HUB_SQL->APILIB_NODE_ORDERBY_VOTE_PART2;
	}

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the nodes for given date
 *
 * @param integer $date
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesByDate($date,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $style='long'){
    global $CFG,$USER,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();
	$params[0] = $date;
	$params[1] = 'N';
	$params[2] = $currentuser;
	$params[3] = $currentuser;

    $sql = $HUB_SQL->APILIB_NODES_BY_DATE;
    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the nodes for given name
 *
 * @param string $name
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesByName($name,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $style='long'){
    global $CFG,$USER,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();
	$params[0] = $name;
	$params[1] = 'N';
	$params[2] = $currentuser;
	$params[3] = $currentuser;

    $sql = $HUB_SQL->APILIB_NODES_BY_NAME;

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Searches nodes by node name based on the first chartacters
 *
 * @param string $q the query term(s)
 * @param string $scope (optional, either 'all' or 'my' - default: 'my')
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesByFirstCharacters($q,$scope,$start = 0,$max = 20 ,$orderby = 'name',$sort ='ASC', $style='long'){
    global $CFG,$USER,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();

	$sql = $HUB_SQL->APILIB_NODES_BY_FIRST_CHARACTERS_SELECT;
	$sql .= $HUB_SQL->APILIB_NODE_NAME_STARTING_SEARCH;
	$sql .= $q;
	$sql .= $HUB_SQL->SEARCH_LIKE_FROM_END;

	// PERMISSIONS
    if ($scope == 'my') {
    	$params[count($params)] = $currentuser;
        $sql .= $HUB_SQL->AND.$HUB_SQL->APILIB_NODES_PERMISSIONS_MY;
    } else {
		$params[count($params)] = 'N';
		$params[count($params)] = $currentuser;
		$params[count($params)] = $currentuser;
		$sql .= $HUB_SQL->AND.$HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;
	}

	$sql .= $HUB_SQL->APILIB_NODES_BY_FIRST_CHARACTERS_PART4;

	//echo $sql;

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the nodes for given tagid
 *
 * @param string $tagid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesByTag($tagid, $start = 0,$max = 20 ,$orderby = 'date', $sort ='ASC', $style='long'){
    global $USER,$CFG,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();
	$params[0] = $tagid;
	$params[1] = 'N';
	$params[2] = $currentuser;
	$params[3] = $currentuser;

    $sql = $HUB_SQL->APILIB_NODES_BY_TAG;

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style,$style);
}

/**
 * Get the nodes for given url
 * (note that this uses the actual URL rather than the urlid)
 *
 * @param string $url
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesByURL($url,$start = 0,$max = 20 ,$orderby = 'date', $sort ='ASC', $filternodetypes="", $style='long'){
    global $USER,$CFG,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();

    $sql = $HUB_SQL->APILIB_NODES_BY_URL_SELECT;

	// FILTER NODE TYPES
    if ($filternodetypes != "") {
        $pieces = explode(",", $filternodetypes);
        $sqlList = "";
		$loopCount = 0;
        foreach ($pieces as $value) {
        	$params[count($params)] = $value;
        	if ($loopCount == 0) {
        		$sqlList .= "?";
        	} else {
        		$sqlList .= ",?";
        	}
        	$loopCount++;
		}
        $sql .= $HUB_SQL->APILIB_FILTER_NODETYPES.$HUB_SQL->OPENING_BRACKET;
        $sql .= $sqlList;
	    $sql .= $HUB_SQL->CLOSING_BRACKET.$HUB_SQL->AND;
    }  else {
        $sql .= $HUB_SQL->WHERE;
    }

	$params[count($params)] = $url;
	$params[count($params)] = 'N';
	$params[count($params)] = $currentuser;
	$params[count($params)] = $currentuser;
	$params[count($params)] = 'N';
	$params[count($params)] = $currentuser;
	$params[count($params)] = $currentuser;
	$sql .= $HUB_SQL->APILIB_NODES_BY_URL_PERMISSIONS;

	//echo $sql;

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style,$style);
}

/**
 * Get nodes not connected to other nodes
 *
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getUnconnectedNodes($start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $style='long'){
    global $CFG,$USER,$HUB_SQL;

	$params = array();
	$params[0] = 'N';
	$params[1] = $USER->userid;
	$params[2] = $USER->userid;

    $sql = $HUB_SQL->APILIB_UNCONNECTED_NODES_SELECT;

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get nodes which are connected to other nodes
 *
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getConnectedNodes($start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $style='long'){
    global $CFG,$USER,$HUB_SQL;

	$params = array();
	$params[0] = 'N';
	$params[1] = $USER->userid;
	$params[2] = $USER->userid;

    $sql = $HUB_SQL->APILIB_CONNECTED_NODES_SELECT;

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style);
}


/**
 * Get nodes which are most connected to other nodes
 *
 * @param string $scope (optional, either 'all' or 'my' - default 'all' )
 * @param integer $groupid (optional - default: '') id of the group to filter on.
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getMostConnectedNodes($scope='all', $groupid='', $start = 0,$max = 20, $style='long'){
    global $CFG,$USER,$HUB_SQL;

	$params = array();
	$params[0] = 'N';
	$params[1] = $USER->userid;
	$params[2] = $USER->userid;

    $sql = $HUB_SQL->APILIB_MOST_CONNECTED_NODES_SELECT;

    if($scope == 'my'){
		$params[3] = $USER->userid;
        $sql .= $HUB_SQL->APILIB_MOST_CONNECTED_NODES_SELECT_MY;
    }

    if ($groupid != "") {
		$params[count($params)] = $groupid;
    	$sql .= $HUB_SQL->APILIB_MOST_CONNECTED_NODES_SELECT_GROUP;
    }

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,'connectedness','DESC',$style);
}


/**
 * Get popular nodes
 *
 * @param string $scope (optional, either 'all' or 'my' - default 'all' )
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getPopularNodes($scope='all', $groupid='', $start = 0,$max = 20,$style='long'){
    global $CFG,$USER,$HUB_SQL;

	$params = array();

    $sql = "";

    if($scope == "my"){
		$params[1] = $USER->userid;
        $sql = $HUB_SQL->APILIB_POPULAR_NODES_SELECT_PART1A;
    } else {
        $sql =  $HUB_SQL->APILIB_POPULAR_NODES_SELECT_PART1B;
    }

    $sql .= $HUB_SQL->WHERE;

    if ($groupid != "") {
		$params[count($params)] = $groupid;
    	$sql .= $HUB_SQL->APILIB_POPULAR_NODES_SELECT_GROUP;
    }

	$params[count($params)] = 'N';
	$params[count($params)] = $USER->userid;
	$params[count($params)] = $USER->userid;
	$sql .= $HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;

    $sql .= $HUB_SQL->APILIB_POPULAR_NODES_SELECT_GROUP_BY;

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,'connectedness','DESC',$style);
}

/**
 * Get popular nodes by vote
 *
 * @param string $scope (optional, either 'all' or 'my' - default 'all' )
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getPopularNodesByVote($scope='all', $groupid='', $start = 0,$max = 20,$style='long'){
    global $CFG,$USER,$HUB_SQL;

	$params = array();

    $sql = $HUB_SQL->APILIB_POPULAR_NODES_BY_VOTE_SELECT_PART1;
    if($scope == "my"){
		$params[count($params)] = $USER->userid;
    	$sql .= $HUB_SQL->FILTER_USER.$HUB_SQL->AND;
	}

    if ($groupid != "") {
		$params[count($params)] = $groupid;
    	$sql .= $HUB_SQL->APILIB_NODES_GROUP_SELECT.$HUB_SQL->AND;
    }

	$params[count($params)] = 'N';
	$params[count($params)] = $USER->userid;
	$params[count($params)] = $USER->userid;
	$sql .= $HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;


    $sql .= $HUB_SQL->APILIB_POPULAR_NODES_BY_VOTE_SELECT_GROUP_BY;


    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,'connectedness','DESC',$style);
}

/**
 * Return usage statistics for groups usage of NodeTypes (Roles)
 *
 * @param string $groupid the id of the group to get stats for
 * @param string $scope (optional, either 'all' or 'my' - default 'all' )
 * @return RoleSet or Error //Roles have only name and num parameters filled in
 */
function getGroupNodeTypeUsage($groupid, $scope='all') {
    global $DB,$USER,$HUB_SQL;

	$params = array();

    $sql = $HUB_SQL->APILIB_GROUP_NODE_TYPE_USAGE_PART1;
    if($scope == "my"){
		$params[count($params)] = $USER->userid;
    	$sql .= $HUB_SQL->FILTER_USER.$HUB_SQL->AND;
	}

	$params[count($params)] = $groupid;
	$params[count($params)] = $groupid;

	$sql .= $HUB_SQL->APILIB_GROUP_NODE_TYPE_USAGE_PART2;

	$rs = new RoleSet();

	$resArray = $DB->select($sql, $params);
	if ($resArray !== false) {
		$count = count($resArray);
		for ($i=0; $i<$count; $i++) {
			$array = $resArray[$i];
			$next = new Role();
			$next->name = $array['Name'];
			$next->num = $array['num'];
			$rs->add($next);
		}
		return $rs;
	} else {
		return "<error>SQL error: ".$DB->conn->error."</error>";
	}
}

/**
 * Return usage statistics for groups usage of LinkTypes
 *
 * @param string $groupid the id of the group to get stats for
 * @param string $scope (optional, either 'all' or 'my' - default 'all' )
 * @return LinkTypeSet or Error //LinkTypes have only name and num parameters filled in
 */
function getGroupLinkTypeUsage($groupid, $scope='all') {
    global $DB, $USER,$HUB_SQL;

	$params = array();

    $sql = $HUB_SQL->APILIB_GROUP_LINK_TYPE_USAGE_PART1;
    if($scope == "my"){
		$params[count($params)] = $USER->userid;
    	$sql .= $HUB_SQL->FILTER_USER.$HUB_SQL->AND;
	}

	$params[count($params)] = $groupid;
	$params[count($params)] = $groupid;

	$sql .= $HUB_SQL->APILIB_GROUP_LINK_TYPE_USAGE_PART2;

	$ls = new LinkTypeSet();

	$resArray = $DB->select($sql, $params);
	if ($resArray !== false) {
		$count = count($resArray);
		for ($i=0; $i<$count; $i++) {
			$array = $resArray[$i];
			$next = new LinkType();
			$next->label = $array['Label'];
			$next->num = $array['num'];
			$ls->add($next);
		}
		return $ls;
	} else {
		return "<error>SQL error: ".$DB->conn->error."</error>";
	}
}

///////////////////////////////////////////////////////////////////
// functions for URLs
///////////////////////////////////////////////////////////////////

/**
 * Get a URL
 *
 * @param string $urlid
 * @return URL or Error
 */
function getURL($urlid){
    $url = new URL($urlid);
    $url->load();
    return $url; // return the node object
}

/**
 * Go and try and automatically retrieve the title and descritpion for the given url.
 *
 * @param string $url
 * @return URL or Error
 */
function autoCompleteURLDetails($url){
    global $CFG;

	$http = array('method'  => 'GET',
            'request_fulluri' => true,
            'timeout' => '2');
	if($CFG->PROXY_HOST != ""){
		$http['proxy'] = $CFG->PROXY_HOST . ":".$CFG->PROXY_PORT;
	}
	$opts = array();
	$opts['http'] = $http;

	$context  = stream_context_create($opts);
	$content = file_get_contents($url, false, $context);

	// get title
    $start = '<title>';
    $end = '<\/title>';
    preg_match( "/$start(.*)$end/si", $content, $match );
    $title = strip_tags($match[ 1 ]);
    $title = trim($title);

    try {
    	if ($metatagarray = get_meta_tags( $url )) {
    		//$keywords = $metatagarray[ "keywords" ];
    		$description = $metatagarray[ "description" ];
    		$description = trim($description);
    	} else {
    		$description = "";

    	}
    } catch (Exception $ex) {
    	$description = $ex->getMessage();
    }

    $urlObj = new URL();
    $urlObj->title = $title;
    $urlObj->description = trim($description);

    return $urlObj;
}

/**
 * Add a URL. Requires login
 *
 * @param string $url
 * @param string $title
 * @param string $desc
 * @param string $private optional, can be Y or N, defaults to users preferred setting
 * @param string $clip (optional);
 * @param string $clippath (optional) - only used by Firefox plugin
 * @param string $cliphtml (optional) - only used by Firefox plugin
 * @param string $createdfrom (optional) - only used for Utopia, rss, compendium
 * @param string $identifier (optional) an additional identifier, json with mutiple identitifer - only really used for Utopia
 * @return URL or Error
 */
function addURL($url, $title, $desc, $private='Y', $clip="", $clippath="", $cliphtml="", $createdfrom="", $identifier=""){
    $urlobj = new URL();
    return $urlobj->add($url, $title, $desc, $private, $clip, $clippath, $cliphtml, $createdfrom, $identifier);
}

/**
 * Edit a URL. Requires login and user must be owner of the URL
 *
 * @param string $urlid
 * @param string $url
 * @param string $title
 * @param string $desc
 * @param string $private optional, can be Y or N, defaults to users preferred setting
 * @param string $clippath (optional) - only used by Firefox plugin
 * @param string $cliphtml (optional) - only used by Firefox plugin
 * @param string $createdfrom (optional) - only used for Utopia, rss, compendium
 * @param string $identifier (optional) an additional identifier, json with mutiple identitifer - only really used for Utopia
 * @return URL or Error
 */
function editURL($urlid,$url,$title,$desc,$private='Y',$clip="", $clippath="", $cliphtml="", $createdfrom="", $identifier=""){
    $urlObj = new URL($urlid);
    return $urlObj->edit($url, $title, $desc, $private, $clip, $clippath, $cliphtml, $createdfrom, $identifier);
}

/**
 * Delete a URL. Requires login and user must be owner of the URL
 *
 * @param string $urlid
 * @return URL or Error
 */
function deleteURL($urlid){
    $urlObj = new URL($urlid);
    $result = $urlObj->delete();
    return $result;
}

/**
 * Get the urls for given user
 *
 * @param string $userid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).
 * @return URLSet or Error
 */
function getURLsByUser($userid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC',$style='long'){

    global $CFG,$USER,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();

	$sql = $HUB_SQL->APILIB_URLS_BY_USER_PART1;
    $sql .= $HUB_SQL->WHERE;

	// FILTER BY USER
	$params[count($params)] = $userid;
    $sql .= $HUB_SQL->FILTER_USER;

	// PERMISSIONS
	$params[count($params)] = 'N';
	$params[count($params)] = $currentuser;
	$params[count($params)] = $currentuser;
    $sql .= $HUB_SQL->AND.$HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;

    $sql .= $HUB_SQL->APILIB_URLS_BY_USER_PART2;

	//error_log($sql);

    $us = new URLSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the urls for given group
 *
 * @param string $groupid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filterusers (optional, a list of user ids to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).
 * @return URLSet or Error
 */
function getURLsByGroup($groupid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $filterusers='',$style='long'){
    global $USER,$CFG,$HUB_SQL;

	$params = array();
	$params[0] = $groupid;
	$params[1] = 'N';
	$params[2] = $USER->userid;
	$params[3] = $USER->userid;

    $sql = $HUB_SQL->APILIB_URLS_BY_GROUP_PART1;

    if ($filterusers != "") {
        $pieces = explode(",", $filterusers);
        $loopCount = 0;
        $searchUsers = "";
        foreach ($pieces as $value) {
            if ($loopCount == 0) {
            	$searchUsers .= "'".$value."'";
            } else {
            	$searchUsers .= ",'".$value."'";
            }
            $loopCount++;
        }

		$sql .=  $HUB_SQL->APILIB_URLS_BY_GROUP_PART1b.$HUB_SQL->OPENING_BRACKET.$searchUsers.$HUB_SQL->CLOSING_BRACKET;
    }

    $sql .= $HUB_SQL->APILIB_URLS_BY_GROUP_PART2;

    //echo $sql;

    $us = new URLSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the urls for all nodes with the same label as the node with the given node id
 *
 * @param string $nodeid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).
 * @return URLSet or Error
 */
function getURLsByNode($nodeid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC',$style='long'){
    global $USER,$CFG,$HUB_SQL;

	$params = array();

	$list = getAggregatedNodeIDs($nodeid);
    if ($list != "") {
	    $sql = $HUB_SQL->APILIB_URLS_BY_NODE_PART1.$HUB_SQL->OPENING_BRACKET.$list.$HUB_SQL->CLOSING_BRACKET;

		$params[0] = 'N';
		$params[1] = $USER->userid;
		$params[2] = $USER->userid;

		$sql .= $HUB_SQL->APILIB_URLS_PERMISSIONS_ALL;
		$sql .= $HUB_SQL->APILIB_URLS_BY_NODE_PART2;

	    $us = new URLSet();
	    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
    } else {
    	return new URLSet();
    }
}

/**
 * Search urls
 * If in speech marks searches LIKE match on phrase, else splits on spaces and searches OR on elements
 *
 * @param string $q the query term(s)
 * @param string $scope (either 'all' or 'my')
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).
 * @return URLSet or Error
 */
function getURLsBySearch($q,$scope,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC',$style='long'){
    global $CFG,$USER,$HUB_SQL,$DB;

	$params = array();


    /*$q = trim($q);
    $q = htmlspecialchars_decode($q, ENT_QUOTES);
    $len = strlen($q);
    $startChar = mb_substr($q, 0, 1);
    $lastChar = mb_substr($q, $len-1, $len);
    $sql = "SELECT u.URLID, COUNT(ut.NodeID) AS connectedness FROM URL t
        LEFT OUTER JOIN URLNode ut ON t.URLID = ut.URLID WHERE ";

    if ($startChar == "\"" && $lastChar == "\"") {
    	$q = mb_substr($q, 1, $len-2);
        $sql .= "(u.Title LIKE('%".$DB->cleanString($q)."%')".
        		" OR u.URL LIKE('%".$DB->cleanString($q)."%'))";
    } else {
    	$pieces = explode(" ", $q);
    	$loopCount = 0;
    	foreach ($pieces as $value) {
    		if ($loopCount == 0) {
    		    $search .= "(u.Title LIKE('%".$DB->cleanString($value)."%')".
        					" OR t.URL LIKE('%".$DB->cleanString($value)."%')) ";
    		} else {
    			$search .= " OR (u.Title LIKE('%".$DB->cleanString($value)."%')".
						" OR u.URL LIKE('%".$DB->cleanString($value)."%')) ";
    		}
    		$loopCount++;
    	}
		$sql .= "( ".$search." )";
    }*/

    $sql = "SELECT DISTINCT u.URLID, COUNT(ut.NodeID) AS connectedness FROM URL u
            LEFT OUTER JOIN URLNode ut ON u.URLID = ut.URLID
            LEFT JOIN TagURL tn ON u.URLID = tn.URLID
            LEFT JOIN Tag ta ON ta.tagID = tn.TagID
            WHERE (ta.Name LIKE('%".$DB->cleanString($q)."%')".
            " OR ta.Title LIKE('%".$DB->cleanString($q)."%')".
            " OR ta.URL LIKE('%".$DB->cleanString($q)."%'))".
    		" AND ((u.Private = 'N')
                OR
                (u.UserID = '".$USER->userid."')
                OR
                (u.URLID IN (SELECT tg.URLID FROM URLGroup tg
                               INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                               WHERE ug.UserID = '".$USER->userid."')
                 ))";

    if($scope == 'my'){
        $sql .= " AND u.UserID = '".$USER->userid."' ";
    }
    $sql .= " GROUP BY u.URLID";

    $us = new URLSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the urls for given url
 * (note that this uses the actual URL rather than the urlid)
 *
 * @param string $url
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).
 * @return URLSet or Error
 */
function getURLsByURL($url,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $style='long'){
    global $USER,$CFG,$HUB_SQL;

	$params = array();
	$params[0] = $url;

    $sql = $HUB_SQL->APILIB_URLS_BY_URL_PART1;

	$params[1] = 'N';
	$params[2] = $USER->userid;
	$params[3] = $USER->userid;

	$sql .= $HUB_SQL->APILIB_URLS_PERMISSIONS_ALL;

    $sql .= $HUB_SQL->APILIB_URLS_BY_URL_PART2;

    $us = new URLSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the urls with clips for given url
 * (note that this uses the actual URL rather than the urlid)
 *
 * @param string $url
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).
 * @return URLSet or Error
 */
function getClipsByURL($url,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC',$style='long'){
    global $USER,$CFG,$HUB_SQL;

	$params = array();
	$params[0] = $url;

    $sql = $HUB_SQL->APILIB_CLIPS_BY_URL_PART1;

	$params[1] = 'N';
	$params[2] = $USER->userid;
	$params[3] = $USER->userid;

	$sql .= $HUB_SQL->APILIB_URLS_PERMISSIONS_ALL;

   	$sql .= $HUB_SQL->APILIB_CLIPS_BY_URL_PART2;

    $us = new URLSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the urls with clips for given url but not attached to an idea.
 * (note that this uses the actual URL rather than the urlid)
 *
 * @param string $url
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).
 * @return URLSet or Error
 */
function getClipsByURLNoIdea($url,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC',$style='long'){
    global $USER,$CFG,$HUB_SQL;

	$params = array();
	$params[0] = $url;

    $sql = $HUB_SQL->APILIB_CLIPS_BY_URL_NO_IDEA_PART1;

	$params[1] = 'N';
	$params[2] = $USER->userid;
	$params[3] = $USER->userid;

	$sql .= $HUB_SQL->APILIB_URLS_PERMISSIONS_ALL;

    $sql .= $HUB_SQL->APILIB_CLIPS_BY_URL_NO_IDEA_PART2;

    $us = new URLSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the clips for the given url where the url has been joined to the given node id
 *
 * @param string $url the url to get the clips for
 * @param string $nodeid to get the url's clips for
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).
 * @return URLSet or Error
 */
function getClipsByNodeAndURL($url, $nodeid ,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC',$style='long'){
    global $USER,$CFG,$HUB_SQL;

	$list = getAggregatedNodeIDs($nodeid);
    if ($list != "") {

    	$params = array();
		$params[0] = $url;

	    $sql = $HUB_SQL->APILIB_CLIPS_BY_NODE_AND_URL_PART1;

		$params[1] = 'N';
		$params[2] = $USER->userid;
		$params[3] = $USER->userid;

		$sql .= $HUB_SQL->APILIB_URLS_PERMISSIONS_ALL;

		$params[4] = $nodeid;

		$sql .= $HUB_SQL->APILIB_CLIPS_BY_NODE_AND_URL_PART2;

	    $us = new URLSet();
	    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
    } else {
    	return new URLSet();
    }
}


///////////////////////////////////////////////////////////////////
// functions for node <-> URL relationships
///////////////////////////////////////////////////////////////////
/**
 * Add a URL to a Node. Requires login, user must be owner of both the node and URL
 *
 * @param string $urlid
 * @param string $nodeid
 * @param string $comments (optional)
 * @return Node or Error
 */
function addURLToNode($urlid, $nodeid, $comments=""){
    $node = new CNode($nodeid);
    $node->load();
    return $node->addURL($urlid,$comments);
}

/**
 * Remove a URL from a Node. Requires login, user must be owner of both the node and URL
 *
 * @param string $urlid
 * @param string $nodeid
 * @return Result or Error
 */
function removeURLFromNode($urlid, $nodeid){
    $node = new CNode($nodeid);
    $node->load();
    return $node->removeURL($urlid);
}

/**
 * Remove all URLs from a node. Requires login, user must be owner of the node
 *
 * @param string $nodeid
 * @return Result or Error
 */
function removeAllURLsFromNode($nodeid){
    $node = new CNode($nodeid);
    $node->load();
    return $node->removeAllURLs();
}

///////////////////////////////////////////////////////////////////
// functions for connections
///////////////////////////////////////////////////////////////////
/**
 * Vote for the connection with the given connid
 *
 * @param string $connid
 * @param string $vote to make ('Y' vote or 'N' vote);
 * @return Connection or Error
 */
function connectionVote($connid,$vote){
    $c = new Connection($connid);
    return $c->vote($vote);
}

/**
 * Delete Vote for the connection with the given connid
 *
 * @param string $connid
 * @param string $vote to delete ('Y' vote or 'N' vote);
 * @return Connection or Error
 */
function deleteConnectionVote($connid,$vote){
    $c = new Connection($connid);
    return $c->deleteVote($vote);
}

/**
 * Get a Connection
 *
 * @param string $connid
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return Connection or Error
 */
function getConnection($connid, $style='long'){
    $c = new Connection($connid);
    $conn = $c->load($style);
    return $conn; // return the connection object
}

/**
 * Add a Connection. Requires login.
 *
 * @param string $fromnodeid
 * @param string $fromroleid
 * @param string $linktypeid
 * @param string $tonodeid
 * @param string $toroleid
 * @param string $private optional, can be Y or N, defaults to users preferred setting
 * @param string $description
 * @return Connection or Error
 */
function addConnection($fromnodeid,$fromroleid,$linktypeid,$tonodeid,$toroleid,$private="",$description=""){
    global $USER;
    if($private == ""){
        $private = $USER->privatedata;
    }
    $cobj = new Connection();
    return $cobj->add($fromnodeid,$fromroleid,$linktypeid,$tonodeid,$toroleid,$private,$description);
}

/**
 * Edit a Connection. Requires login and user must be owner of the connection
 *
 * @param string $connid
 * @param string $fromnodeid
 * @param string $fromroleid
 * @param string $linktypeid
 * @param string $tonodeid
 * @param string $toroleid
 * @param string $private optional, can be Y or N, defaults to users preferred setting
 * @param string $description
 * @return Connection or Error
 */
function editConnection($connid,$fromnodeid,$fromroleid,$linktypeid,$tonodeid,$toroleid,$private="",$description=""){
    global $USER;
    if($private == ""){
        $private = $USER->privatedata;
    }
    $cobj = new Connection($connid);
    return $cobj->edit($fromnodeid,$fromroleid,$linktypeid,$tonodeid,$toroleid,$private,$description);
}

/**
 * Delete a connection. Requires login and user must be owner of the connection
 *
 * @param string $connid
 * @return Result or Error
 */
function deleteConnection($connid){
    $cobj = new Connection($connid);
    $result = $cobj->delete();
    return $result;
}

/**
 * Copy a Connection. Requires login
 *
 * @param string $connid
 * @return Connection or Error
 */
function copyConnection($connid){
    global $USER;

    $private = $USER->privatedata;
    $cobj = new Connection($connid);
    $cobj->load();

    //check user has the nodes - NO!! Client side copy of these only
    //$f = addNode($cobj->from->name,$cobj->from->description,$private);
    //$fromnodeid = $f->nodeid;
    //$t = addNode($cobj->to->name,$cobj->to->description,$private);
    //$tonodeid = $t->nodeid;

    //check user has the roles
    $fr = addRole($cobj->fromrole->name, $cobj->fromrole->image);
    $fromroleid = $fr->roleid;

    $tr = addRole($cobj->torole->name, $cobj->torole->image);
    $toroleid = $tr->roleid;

    //check user has the linktype
    $lt = addLinkType($cobj->linktype->label,$cobj->linktype->grouplabel);
    $linktypeid = $lt->linktypeid;

    return $cobj;
}

/**
 * Deletes a set of connections. Requires login and user must be owner of each connection.
 *
 * @param string $connids (comma separated list of connids)
 * @return Result or Error
 */
function deleteConnections($connids){
    $cArr = split(",",$connids);
    foreach ($cArr as $connid){
        $c = new Connection($connid);
        $c->delete();
    }
    return new Result("deleted","true");
}

/**
 * Get the connections for given user
 *
 * @param string $userid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filtergroup (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)
 * @param string $filterlist (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsByUser($userid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $filtergroup = 'all', $filterlist = '', $filternodetypes='', $style='long'){
    global $USER,$CFG,$DB,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();

    $sql = $HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_SELECT;

	// FILTER BY USER
	$params[count($params)] = $userid;
	$sql .= $HUB_SQL->FILTER_USER.$HUB_SQL->AND;

	// FILTER BY NODE TYPES - AND
    if ($filternodetypes != "") {
		$nodetypeArray = array();
		$innersql = getSQLForNodeTypeIDsForLabels($nodetypeArray,$filternodetypes);

		$params = array_merge($params, $nodetypeArray);
		$sql .= $HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_NODETYPE_FILTER_PART1;
		$sql .= $innersql;

		$params = array_merge($params, $nodetypeArray);
		$sql .= $HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_NODETYPE_FILTER_PART2;
		$sql .= $innersql;
		$sql .= $HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_NODETYPE_FILTER_PART3;
    }

	// FILTER BY LINK TYPES
	if ($filtergroup != '' && $filtergroup != 'all' && $filtergroup != 'selected') {
		$innersql = getSQLForLinkTypeIDsForGroup($params,$filtergroup);
		$sql .= $HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_LINKTYPE_FILTER;
		$sql .= $HUB_SQL->OPENING_BRACKET;
		$sql .= $innersql;
		$sql .= $HUB_SQL->CLOSING_BRACKET.$HUB_SQL->AND;
	} else {
		if ($filterlist != "") {
			$innersql = getSQLForLinkTypeIDsForLabels($params,$filterlist);
			$sql .= $HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_LINKTYPE_FILTER;
			$sql .= $HUB_SQL->OPENING_BRACKET;
			$sql .= $innersql;
			$sql .= $HUB_SQL->CLOSING_BRACKET.$HUB_SQL->AND;
		}
	}

	// PERMISSIONS
	$params[count($params)] = 'N';
	$params[count($params)] = $currentuser;
	$params[count($params)] = $currentuser;
	$params[count($params)] = 'N';
	$params[count($params)] = $currentuser;
	$params[count($params)] = $currentuser;
	$params[count($params)] = 'N';
	$params[count($params)] = $currentuser;
	$params[count($params)] = $currentuser;
	$sql .= $HUB_SQL->APILIB_CONNECTIONS_BY_GLOBAL_PERMISSIONS;

    $cs = new ConnectionSet();
    return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the connections for given group
 *
 * @param string $groupid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filtergroup (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)
 * @param string $filterlist (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')
 * @param string $filterusers (optional, a list of user ids to filter by)
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsByGroup($groupid, $start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $filtergroup = 'all', $filterlist = '', $filterusers='', $filternodetypes='', $style='long'){
    global $USER,$CFG;

	$params = array();

    $sql = "SELECT t.TripleID FROM Triple t
    			INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
                INNER JOIN TripleGroup tg ON tg.TripleID = t.TripleID
                WHERE tg.GroupID = '".$groupid."' ";

	if ($filternodetypes != "") {
	    $nodetypeids = getNodeTypeIDsForLabels($filternodetypes);
		if ($nodetypeids != "") {
			$sql .= "AND (t.FromContextTypeID IN (".$nodetypeids.") OR t.ToContextTypeID IN (".$nodetypeids.")) ";
		}
	}

	if ($filtergroup != 'all') {
		if ($filtergroup != 'selected') {
			$list = getLinkTypeIDsForGroup($filtergroup);
			if ($list != "") {
				$sql .= "AND t.LinkTypeID IN (".$list.") ";
			}
		} else if ($filterlist != "") {
	    	$list = getLinkTypeIDsForLabels($filterlist);
			if ($list != "") {
				$sql .= "AND t.LinkTypeID IN (".$list.") ";
			}
	    }
	}

    if ($filterusers != "") {
        $pieces = explode(",", $filterusers);
        $loopCount = 0;
        $searchUsers = "";
        foreach ($pieces as $value) {
            if ($loopCount == 0) {
            	$searchUsers .= "'".$value."'";
            } else {
            	$searchUsers .= ",'".$value."'";
            }
            $loopCount++;
        }

        $sql .=  "AND t.UserID IN (".$searchUsers.") ";
    }

    $sql .= "AND ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            )";

     $cs = new ConnectionSet();
     return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the connections for given label of the node with the given nodeid
 *
 * @param string $nodeid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filtergroup (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)
 * @param string $filterlist (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsByNode($nodeid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $filtergroup = 'all', $filterlist = '', $filternodetypes='', $style='long'){
    global $USER,$CFG;

	$params = array();

    $list =  getAggregatedNodeIDs($nodeid);
	if ($list != "") {
		$sql = "SELECT t.TripleID FROM Triple t
					INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
			 		WHERE (t.FromID IN (".$list.") OR t.ToID IN (".$list."))";

		if ($filternodetypes != "") {
		    $nodetypeids = getNodeTypeIDsForLabels($filternodetypes);
			if ($nodetypeids != "") {
				$sql .= " AND (t.FromContextTypeID IN (".$nodetypeids.") OR t.ToContextTypeID IN (".$nodetypeids."))";
			}
		}

		if ($filtergroup != 'all') {
			if ($filtergroup != 'selected') {
				$list = getLinkTypeIDsForGroup($filtergroup);
				if ($list != "") {
					$sql .= " AND t.LinkTypeID IN (".$list.") ";
				}
			} else if ($filterlist != "") {
		    	$list = getLinkTypeIDsForLabels($filterlist);
				if ($list != "") {
					$sql .= " AND t.LinkTypeID IN (".$list.") ";
				}
		    }
		}

		$sql .= " AND ((t.Private = 'N')
	                   OR
	                   (t.UserID = '".$USER->userid."')
	                   OR
	                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
	                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
	                                  WHERE ug.UserID = '".$USER->userid."')))
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
	                            )";

	     $cs = new ConnectionSet();
	     return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
	} else {
		return new ConnectionSet();
	}
}

/**
 * Get the connections for given url
 *
 * @param string $url
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filtergroup (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)
 * @param string $filterlist (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsByURL($url,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $filtergroup = 'all', $filterlist = '', $filternodetypes='', $style='long'){
    global $USER,$CFG;

	$params = array();

    $sql = "SELECT t.TripleID FROM Triple t
                    INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
                    WHERE";

	if ($filternodetypes != "") {
	    $nodetypeids = getNodeTypeIDsForLabels($filternodetypes);
		if ($nodetypeids != "") {
			$sql .= " (t.FromContextTypeID IN (".$nodetypeids.") OR t.ToContextTypeID IN (".$nodetypeids.")) AND ";
		}
	}

    if ($filtergroup != 'all') {
		if ($filtergroup != 'selected') {
			$list = getLinkTypeIDsForGroup($filtergroup);
			if ($list != "") {
				$sql .= " t.LinkTypeID IN (".$list.") AND ";
			}
		} else if ($filterlist != "") {
	    	$list = getLinkTypeIDsForLabels($filterlist);
			if ($list != "") {
				$sql .= " t.LinkTypeID IN (".$list.") AND ";
			}
	    }
    }

    $sql .= "((t.Private = 'N')
                       OR
                       (t.UserID = '".$USER->userid."')
                       OR
                       (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                     INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                      WHERE ug.UserID = '".$USER->userid."')))
                    AND (FromID IN (SELECT t.NodeID FROM Node t
                                  INNER JOIN URLNode ut ON ut.NodeID = t.NodeID
                                  INNER JOIN URL u ON u.URLID = ut.URLID
                                    WHERE u.URL = '".$url."'
                                    AND ((u.Private = 'N')
                                            OR
                                            (u.UserID = '".$USER->userid."')
                                            OR
                                            (u.URLID IN (SELECT urlg.URLID FROM URLGroup urlg
                                                           INNER JOIN UserGroup ug ON ug.GroupID=urlg.GroupID
                                                           WHERE ug.UserID = '".$USER->userid."')
                                             ))
                                    AND ((t.Private = 'N')
                                       OR
                                       (t.UserID = '".$USER->userid."')
                                       OR
                                       (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                                                   INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                                    WHERE ug.UserID = '".$USER->userid."')))
                                    )
                    OR ToID IN (SELECT t.NodeID FROM Node t
                              INNER JOIN URLNode ut ON ut.NodeID = t.NodeID
                                  INNER JOIN URL u ON u.URLID = ut.URLID
                                    WHERE u.URL = '".$url."'
                                    AND ((u.Private = 'N')
	                                     OR
	                                     (u.UserID = '".$USER->userid."')
	                                     OR
	                                     (u.URLID IN (SELECT urlg.URLID FROM URLGroup urlg
	                                                    INNER JOIN UserGroup ug ON ug.GroupID=urlg.GroupID
	                                                    WHERE ug.UserID = '".$USER->userid."')
	                                      ))
                                    AND ((t.Private = 'N')
                                       OR
                                       (t.UserID = '".$USER->userid."')
                                       OR
                                       (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                                                   INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                                    WHERE ug.UserID = '".$USER->userid."')))
                                ))";


    $cs = new ConnectionSet();
    return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
}


/**
 * Get the connections for given search
 * If in speech marks searches LIKE match on phrase, else splits on spaces and searches OR on elements
 *
 * @param string $q
 * @param string $scope (either 'all' or 'my')
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filtergroup (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)
 * @param string $filterlist (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsBySearch($q,$scope,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $filtergroup = 'all', $filterlist = '', $filternodetypes='', $style='long'){
    global $DB, $USER,$CFG,$DB;

	$params = array();

    /*$q = trim($q);
    $q = htmlspecialchars_decode($q, ENT_QUOTES);
    $len = strlen($q);
    $startChar = mb_substr($q, 0, 1);
    $lastChar = mb_substr($q, $len-1, $len);

    $sql = "SELECT t.NodeID from Node t WHERE ";

    if ($startChar == "\"" && $lastChar == "\"") {
    	$q = mb_substr($q, 1, $len-2);
		$sql .= "t.Name LIKE ('%".$DB->cleanString($q)."%') ";
    } else {
    	$pieces = explode(" ", $q);
    	$loopCount = 0;
    	foreach ($pieces as $value) {
    		if ($loopCount == 0) {
    		    $search .= "t.Name LIKE ('%".$DB->cleanString($value)."%')";
    		} else {
    		    $search .= " OR t.Name LIKE ('%".$DB->cleanString($value)."%')";
    		}
    		$loopCount++;
    	}
		$sql .= "( ".$search." )";
    }*/

	$sql = "SELECT DISTINCT t.NodeID from Node t
        LEFT JOIN TagNode tn ON t.NodeID = tn.NodeID
        LEFT JOIN Tag u ON u.tagID = tn.TagID
        WHERE (u.Name LIKE('%".$DB->cleanString($q)."%')".
		" OR t.Name LIKE ('%".$DB->cleanString($q)."%'))";

	if($scope == "my"){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .=  " AND (
			    (t.Private = 'N')
			     OR
			    (t.UserID = '".$USER->userid."') ". // the current user
			    " OR
			    (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
			                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
			                 WHERE ug.UserID = '".$USER->userid."')". // the current user
			    "))";

	$list = "";
	$nodes = array();

	$resArray = $DB->select($sql, $params);
	if ($resArray !== false) {
	    $count = 0;
        if (is_countable($resArray)) {
        	$count = count($resArray);
        }
		for ($i=0; $i<$count; $i++) {
			$array = $resArray[$i];
			$NodeID = $array['NodeID'];
			if (!isset($nodes[$NodeID])) {
				$list .= ",'".$NodeID."'";
				$nodes[$NodeID] = $NodeID;
			}
		}
		// remove first comma.
		$list = substr($list, 1);
	}

    if($list == ""){
        return new ConnectionSet();
    }

    $sql = "SELECT DISTINCT t.TripleID FROM Triple t";
    $sql .= " LEFT JOIN TagTriple tn ON t.TripleID = tn.TripleID";
    $sql .= " LEFT JOIN Tag u ON u.tagID = tn.TagID";
    $sql .= " WHERE (u.Name LIKE('%".$DB->cleanString($q)."%')";
    $sql .= " OR (FromID IN (".$list.") OR ToID IN (".$list.")))";

	if ($filternodetypes != "") {
	    $nodetypeids = getNodeTypeIDsForLabels($filternodetypes);
		if ($nodetypeids != "") {
			$sql .= " AND (t.FromContextTypeID IN (".$nodetypeids.") OR t.ToContextTypeID IN (".$nodetypeids."))";
		}
	}

	if ($filtergroup != 'all') {
		if ($filtergroup != 'selected') {
			$list = getLinkTypeIDsForGroup($filtergroup);
			if ($list != "") {
				$sql .= " AND t.LinkTypeID IN (".$list.") ";
			}
		} else if ($filterlist != "") {
	    	$list = getLinkTypeIDsForLabels($filterlist);
			if ($list != "") {
				$sql .= " AND t.LinkTypeID IN (".$list.") ";
			}
	    }
	}

    if($scope == "my"){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            )";

    $cs = new ConnectionSet();
     return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Search connections by thier tags
 * splits on commas and searches OR on elements
 *
 * @param string $q
 * @param string $scope (either 'all' or 'my')
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filtergroup (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)
 * @param string $filterlist (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param string $groupid (optional, the id of the user group to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsByTagSearch($q,$scope,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $filtergroup = 'all', $filterlist = '', $filternodetypes='', $groupid='', $style='long'){
    global $DB, $USER,$CFG,$DB;

	$params = array();

    $q = trim($q);
   	$pieces = explode(",", $q);

    $sql = "SELECT DISTINCT t.TripleID FROM Triple t";
    $sql .= " LEFT JOIN TagTriple tn ON t.TripleID = tn.TripleID";
    $sql .= " LEFT JOIN Tag u ON u.TagID = tn.TagID WHERE ";

	if ($filternodetypes != "") {
	    $nodetypeids = getNodeTypeIDsForLabels($filternodetypes);
		if ($nodetypeids != "") {
			$sql .= "(t.FromContextTypeID IN (".$nodetypeids.") OR t.ToContextTypeID IN (".$nodetypeids.")) AND ";
		}
	}

    if ($filtergroup != 'all') {
		if ($filtergroup != 'selected') {
			$list = getLinkTypeIDsForGroup($filtergroup);
			if ($list != "") {
				$sql .= " t.LinkTypeID IN (".$list.") AND ";
			}
		} else if ($filterlist != "") {
	    	$list = getLinkTypeIDsForLabels($filterlist);
			if ($list != "") {
				$sql .= " t.LinkTypeID IN (".$list.") AND ";
			}
	    }
    }

   	$loopCount = 0;
   	$search = "";
   	foreach ($pieces as $value) {
		$value = trim($value);
   		if ($loopCount == 0) {
   		    $search .= "u.Name ='".$DB->cleanString($value)."'";
   		} else {
   		    $search .= " OR u.Name = '".$DB->cleanString($value)."%'";
   		}
   		$loopCount++;
   	}
	$sql .= "( ".$search." )";

    if($scope == "my"){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            )";


	if ($groupid != "") {
		$sql .= " AND t.TripleID IN (SELECT TripleID FROM TripleGroup Where GroupID='".$groupid."')";
	}

    $cs = new ConnectionSet();
     return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
}


/**
 * Get all connections from the given list of connection ids.
 *
 * @param String $connectionids a comma separated list of the connection ids to get.
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: -1 = all)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getMultiConnections($connectionids, $start = 0,$max = -1 ,$orderby = 'date',$sort ='ASC', $style='long') {
    global $USER,$CFG;

	$params = array();

	$sql = "SELECT t.TripleID FROM Triple t
				INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
		 		WHERE t.TripleID IN (".$connectionids.")";

	$sql .= " AND ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            )";

     $cs = new ConnectionSet();
     return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
}


/**
 * Get the connections whose from idea labels are the same as
 * the label of the node with the given node id
 *
 * @param string $nodeid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filtergroup (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)
 * @param string $filterlist (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsByFromLabel($nodeid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $filtergroup = 'all', $filterlist = '', $style='long'){
    global $USER,$CFG;

	$params = array();

    $list =  getAggregatedNodeIDs($nodeid);
    if ($list != "") {
		$sql = "SELECT t.TripleID FROM Triple t
					INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
			 		WHERE t.FromID IN (".$list.")";

		if ($filtergroup != 'all') {
			if ($filtergroup != 'selected') {
				$list = getLinkTypeIDsForGroup($filtergroup);
				if ($list != "") {
					$sql .= " AND t.LinkTypeID IN (".$list.") ";
				}
			} else if ($filterlist != "") {
		    	$list = getLinkTypeIDsForLabels($filterlist);
				if ($list != "") {
					$sql .= " AND t.LinkTypeID IN (".$list.") ";
				}
		    }
		}

	    $sql .= " AND ((t.Private = 'N')
	           OR
	           (t.UserID = '".$USER->userid."')
	           OR
	           (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
	                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
	                          WHERE ug.UserID = '".$USER->userid."')))
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
	                    )";

	    $cs = new ConnectionSet();
	    return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
    } else {
    	return new ConnectionSet();
    }
}

/**
 * Get the connections whose to idea labels are the same as
 * the label of the node with the given node id
 *
 * @param string $nodeid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filtergroup (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)
 * @param string $filterlist (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsByToLabel($nodeid ,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $filtergroup = 'all', $filterlist = '', $style='long'){
    global $USER,$CFG;

	$params = array();

    $list =  getAggregatedNodeIDs($nodeid);
	if ($list != "") {
		$sql = "SELECT t.TripleID FROM Triple t
					INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
			 		WHERE t.ToID IN (".$list.")";

		if ($filtergroup != 'all') {
			if ($filtergroup != 'selected') {
				$list = getLinkTypeIDsForGroup($filtergroup);
				if ($list != "") {
					$sql .= " AND t.LinkTypeID IN (".$list.") ";
				}
			} else if ($filterlist != "") {
		    	$list = getLinkTypeIDsForLabels($filterlist);
				if ($list != "") {
					$sql .= " AND t.LinkTypeID IN (".$list.") ";
				}
		    }
		}

	    $sql .= " AND ((t.Private = 'N')
	           OR
	           (t.UserID = '".$USER->userid."')
	           OR
	           (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
	                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
	                          WHERE ug.UserID = '".$USER->userid."')))
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
	                    )";

	    $cs = new ConnectionSet();
	    return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
	} else {
		return new ConnectionSet();
	}
}

/**
 * Get the connections by link type
 *
 * @param string $linktypelabel = linktype label to search on - exact full label matching
 * @param string $scope (either 'all' or 'my')
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsByLinkTypeLabel($linktypelabel,$scope,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $style='long'){
    global $DB, $USER,$CFG,$DB;

	$params = array();

    $sql = "SELECT t.TripleID FROM Triple t
        INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
        WHERE lt.Label LIKE '".$DB->cleanString($linktypelabel)."'";

    if($scope == "my"){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            )";
     $cs = new ConnectionSet();

     return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
}


/**
 * Get the connections for the given netowrk search paramters from the given node.
 *
 * @param string $nodeid the id of the node to search outward from.
 * @param string $linklabels the string of link types.
 * @param string $userid optional for searching only a specified user's data. (only used if scope is 'all') - NOT USED AT PRESENT
 * @param string $scope (either 'all' or 'my', default 'all')
 * @param string $linkgroup (optional, either Positive, Negative, or Neutral - default: empty string);
 * @param integer $depth (optional, 1-7, or 7 for full depth;
 * @param string $direction (optional, 'outgoing', 'incmong', or 'both - default: 'both',
 * @param string $labelmatch (optional, 'true', 'false' - default: false;
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsByPath($nodeid, $linklabels, $userid, $scope='all', $linkgroup='', $depth=7, $direction="both", $labelmatch='false', $style='long'){
    global $DB,$USER,$CFG,$HUB_SQL;

	$searchLinkLabels = "";
	$searchLinkLabelsArray = array();
	//$searchLinkLabels = getSQLForLinkTypeIDsForLabels(&$searchLinkLabelsArray, $linklabels)

	if ($linklabels != "" && $linkgroup == "") {
		$pieces = explode(",", $linklabels);
		$loopCount = 0;
		foreach ($pieces as $value) {
			$searchLinkLabelsArray[$loopCount] = $value;
			if ($loopCount == 0) {
				$searchLinkLabels .= "?";
			} else {
				$searchLinkLabels .= ",?";
			}
			$loopCount++;
		}
	}


	$nodeTypeNames = "";
	$nodeTypeNamesArray = array();

	/** EVHUB
	if ($nodetypes != "") {
	    $nodeTypeNames = "";
	    $pieces = explode(",", $nodetypes);
	    $loopCount = 0;
	    foreach ($pieces as $value) {
			$nodeTypeNamesArray[$loopCount] = $value;
	        if ($loopCount == 0) {
	        	$nodeTypeNames .= "?";
	        } else {
	        	$nodeTypeNames .= ",?";
	        }
	        $loopCount++;
	    }
	}
	*/

	// GET TEXT FOR PASSED IDEA ID IF REQUIRED
	$text = "";
	if ($labelmatch == 'true') {
		$params = array();
		$params[0] = $nodeid;
		$qry = $HUB_SQL->APILIB_NODE_NAME_BY_ID_SELECT;
		$resArray = $DB->select($qry, $params);
		if ($resArray !== false && count($resArray) > 0) {
			$text = $resArray[0]['Name'];
		} else {
			return database_error();
		}
	}

	$matchesFound = array();
	if (($labelmatch == 'true' && $text != "") || ($labelmatch == 'false' && $nodeid != "")) {
		$checkConnections = array();
		$matchedConnections = array();
		if ($labelmatch == 'true') {
			$nextNodes[0] = $text;
		} else {
			$nextNodes[0] = $nodeid;
		}
		$matchesFound = searchNetworkConnections($checkConnections, $matchedConnections, $nextNodes, $searchLinkLabels, $searchLinkLabelsArray, $linkgroup, $labelmatch, $depth, 0, $direction, $nodeTypeNames, $nodeTypeNamesArray, $scope);
	}
	//return database_error($matchesFound);


	//error_log(print_r($matchesFound, true));

	$cs = new ConnectionSet($matchesFound);
	return $cs->loadConnections($matchesFound, $style);
}

/**
 * Get the connections for the given netowrk search paramters from the given node.
 *
 * @param string $scope (either 'all' or 'my', deafult 'all')
 * @param string $labelmatch (optional, 'true', 'false' - default: false;
 * @param string $nodeid the id of the node to search outward from.
 * @param integer $depth (optional, 1-7, default 1);
 * @param string $linklabels Array of strings of link types. Array length must match depth specified. Each array level is mutually exclusive with linkgroups - there can only be one.
 * @param string $linkgroups Array of either Positive, Negative, or Neutral - default: empty string). Array length must match depth specified.Each array level is mutually exclusive with linklabels - there can only be one.
 * @param string $directions Array of 'outgoing', 'incmong', or 'both - default: 'both'. Array length must match depth specified.
 * @param string $nodetypes Array of strings of node type names. Array length must match depth specified.
 * @param string $nodeids Array of strings of nodeids. Array length must match depth specified.
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getConnectionsByPathByDepth($scope='all', $labelmatch='false', $nodeid, $depth=1, $linklabels, $linkgroups, $directions, $nodetypes, $nodeids, $uniquepath='true', $style='long'){
    global $USER,$CFG,$DB;

	// GET TEXT FOR PASSED IDEA ID IF REQUIRED
	$text = "";
	if ($labelmatch == 'true') {

		$params = array($nodeid);
		$sql = "select Name from Node where NodeID=?";

		$resArray = $DB->select($sql, $params);
		if ($resArray !== false) {
			$count = 0;
			if (is_countable($resArray)) {
				$count = count($resArray);
			}

			for ($i=0; $i<$count; $i++) {
				$array = $resArray[$i];
				$text = $array['Name'];
			}
		} else {
			return database_error();
		}
	}

	$messages = '';

	$matchesFound = array();
	if (($labelmatch == 'true' && $text != "") || ($labelmatch == 'false' && $nodeid != "")) {
		$checkConnections = array();
		$matchedConnections = null;
		if ($labelmatch == 'true') {
			$nextNodes[0] = $text;
		} else {
			$nextNodes[0] = $nodeid;
		}
		$matchesFound = searchNetworkConnectionsByDepth($checkConnections, $matchedConnections, $nextNodes, $labelmatch, $depth, 0, $linklabels, $linkgroups, $directions, $nodetypes, $nodeids, $uniquepath, $scope, $messages);
	}
	//return database_error($messages);

	//aggregate the connections that made it to last level
	$results = array();
	getDepthConnectionResults($results, $matchesFound);

	$cs = new ConnectionSet();
	return $cs->loadConnections($results, $style);
}

function getDepthConnectionResults(&$results, $nextArray) {
	foreach ( $nextArray as $key=>$val ){
		$count = count($val);
		for ($j = 0; $j<$count; $j++) {
			$next = $val[$j];
			if (isset($next["TripleID"])) {
				$results[count($results)] = $next;
			} else {
				getDepthConnectionResults($results, $next);
			}
		}
	}
}

///////////////////////////////////////////////////////////////////
// functions for saved structured searches and thier agents
///////////////////////////////////////////////////////////////////

/**
 * Get all the saved searches for the current user
 *
 * @return SearchSet or Error
 */
function getUserSearches(){
    global $CFG,$USER;

	$params = array($USER->userid);
    $sql = "SELECT SearchID FROM Search WHERE UserID = ? ORDER BY CreationDate ASC";
    $ss = new SearchSet();
    return $ss->load($sql,$params);
}

/**
 * Get the search with the given id
 *
 * @param string $searchid
 * @return Search or Error
 */
function getSearch($searchid){
    $searchobj = new Search();
    $searchobj->searchid = $searchid;
    return $searchobj->load();
}

/**
 * Delete the search with the given id
 *
 * @param string $searchid
 * @return Result or Error
 */
function deleteSearch($searchid){
    $searchobj = new Search($searchid);
    return $searchobj->delete();
}


/**
 * Delete the search agent for the given search and agent id
 *
 * @param string $searchid the id of the search whose gent to delete
 * @param string $agentid the id of the agent to delete
 * @return Result or Error
 */
function deleteSearchAgent($agentid){
	$agent = new SearchAgent($agentid);
	return $agent->delete();
}

/**
 * Run the agent associated with this network search
 * @param string $searchid the id of the search whose agent to run
 * @param String type, who requested this run, the user themselves through an interface button push
 * or an automated process like a nightly cron: values = 'user' or 'auto'; default = 'user';
 * @return Result or Error
 */
function runSearchAgent($searchid, $type='user'){
    $searchobj = new Search($searchid);
    $searchobj->load();
    return $searchobj->runSearchAgent();
}

/**
 * Run the agent associated with this network search
 * @param string $searchid the id of the search whose agent to run
 * @param string $runid the run id of the run to load.
 * @return ConnectionSet or Error
 */
function loadSearchAgentRun($searchid, $runid){
    $searchobj = new Search($searchid);
    $searchobj->load();
    return $searchobj->loadSearchAgentRun($runid);
}

/**
 * Run the agent associated with this network search
 * @param string $searchid the id of the search whose agent to run
 * @param string $runid the run id of the run to load.
 * @return ConnectionSet or Error
 */
function loadSearchAgentRunNew($searchid, $runid){
    $searchobj = new Search($searchid);
    $searchobj->load();
    return $searchobj->getNewConnections($runid);
}

///////////////////////////////////////////////////////////////////
// functions for roles
///////////////////////////////////////////////////////////////////
/**
 * Get a role (by id)
 *
 * @param string $roleid
 * @return Role or Error
 */
function getRole($roleid){
    $r = new Role($roleid);
    return $r->load();
}

/**
 * Get a role (by name)
 *
 * @param string $rolename
 * @return Role or Error
 */
function getRoleByName($rolename){
    $r = new Role();
    return $r->loadByName($rolename);
}

/**
 * Get all roles
 *
 * @return RoleSet or Error
 */
function getAllRoles(){
    global $CFG,$USER;

    $params = array($USER->userid);

    $sql = "SELECT cnt.NodeTypeID FROM NodeType cnt
            INNER JOIN NodeTypeGrouping cntg On cntg.NodeTypeID = cnt.NodeTypeID
            WHERE cnt.UserID=? ORDER BY Name ASC";

    $rs = new RoleSet();

    return $rs->load($sql, $params);
}

/**
 * Get the current user's roles. Login required.
 *
 * @return RoleSet or Error
 */
function getUserRoles(){
    global $CFG,$USER;

    $params = array($USER->userid);

    $sql = "SELECT cnt.NodeTypeID FROM NodeType cnt
        	INNER JOIN NodeTypeGrouping cntg On cntg.NodeTypeID = cnt.NodeTypeID
            WHERE cnt.UserID=? ORDER BY Name ASC";

    $rs = new RoleSet();
    return $rs->load($sql, $params);
}

/**
 * Add new role - if the role already exists then this
 * existing role object will be returned. Login required.
 *
 * @param string $rolename
 * @param string $image, optional parameter local path to an image file (uploaded onto server).
 * @return Role or Error
 */
function addRole($rolename, $image=null){
    $roleobj = new Role;
    return $roleobj->add($rolename, $image);
}

/**
 * Edit a role. Requires login and user must be owner of the role
 *
 * @param string $roleid
 * @param string $rolename
 * @param string $image, optional parameter local path to an image file (uploaded onto server).
 * @return Role or Error
 */
function editRole($roleid,$rolename,$image=null){
    $roleobj = new Role($roleid);
    return $roleobj->edit($rolename,$image);
}

/**
 * Delete a role. Requires login and user must be owner of the role.
 * Connections using this role will have the role replaced by the default one.
 *
 * @param string $roleid
 * @return Result or Error
 */
function deleteRole($roleid){
    $roleobj = new Role($roleid);
    return $roleobj->delete();
}

/**
 * Get the node types for the nodes for given user
 *
 * @param string $userid
 * @return RoleSet or Error
 */
function getNodeRolesByUser($userid){
    global $CFG,$USER;

	$params = array();
	$params[0] = $userid;
	$params[1] = 'N';
	$params[2] = $USER->userid;
	$params[3] = $USER->userid;

    $sql = "SELECT DISTINCT nt.Name, nt.Image
            FROM Node t LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID
            WHERE t.UserID = ? AND (
            (t.Private = ?)
             OR
            (t.UserID = ?) ". // the current user
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = ?)". // the current user
            ")) order by nt.Name ASC";

    $rs = new RoleSet();
    return $rs->loadFilterRoles($sql, $params);
}

/**
 * Get the node types for the nodes for given node.
 * This includes the other nodes which share the same label as the given node (but will have been entered by another user).
 *
 * @param string $nodeid
 * @return RoleSet or Error
 */
function getNodeRolesByNode($nodeid) {
    global $CFG,$USER;

	$params = array();

	$list = getAggregatedNodeIDs($nodeid);
    if ($list != "") {
        $sql = "SELECT DISTINCT nt.Name, nt.Image
            	FROM Node t LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID
	            WHERE t.NodeID IN (".$list.") ".
	            " AND (
	            (t.Private = 'N')
	             OR
	            (t.UserID = '".$USER->userid."') ". // the current user
	            " OR
	            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
	                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
	                         WHERE ug.UserID = '".$USER->userid."')". // the current user
	            ")) order by nt.Name ASC";

	    $rs = new RoleSet();
	    return $rs->loadFilterRoles($sql, $params);
    } else {
    	return new RoleSet();
    }
}

/**
 * Get the node types for the nodes for given group
 *
 * @param string $groupid
 * @return RoleSet or Error
 */
function getNodeRolesByGroup($groupid) {
    global $CFG,$USER;

	$params = array();

    $sql = "SELECT DISTINCT nt.Name, nt.Image
    		FROM Node t LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID
            INNER JOIN NodeGroup tg ON tg.NodeID = t.NodeID
            WHERE tg.GroupID = '".$groupid."' "; // the group to get data for

    $sql .= "AND (
            (t.Private = 'N')
             OR
            (t.UserID = '".$USER->userid."') ". // the current user
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')". // the current user
            ")) order by nt.Name ASC";

     $rs = new RoleSet();
     return $rs->loadFilterRoles($sql,$params);
}

/**
 * Get the node types for the nodes for given url
 * (note that this uses the actual URL rather than the urlid)
 *
 * @param string $url
 * @return RoleSet or Error
 */
function getNodeRolesByURL($url) {
    global $USER,$CFG;

    $params = array();

    $sql = "SELECT DISTINCT nt.Name, nt.Image
			FROM Node t LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID
            INNER JOIN URLNode ut ON t.NodeID = ut.NodeID
            INNER JOIN URL u ON u.URLID = ut.URLID
            WHERE u.URL = '".$url."'
        	AND ((u.Private = 'N')
            OR
            (u.UserID = '".$USER->userid."')
            OR
            (u.URLID IN (SELECT tg.URLID FROM URLGroup tg
                           INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                           WHERE ug.UserID = '".$USER->userid."')
             ))
            AND ((t.Private = 'N')
             OR
            (t.UserID = '".$USER->userid."') ". // the current user
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')". // the current user
            ")) order by nt.Name ASC";

    $rs = new RoleSet();
    return $rs->loadFilterRoles($sql,$params);
}

/**
 * get node types for the nodes searched.
 * If in speech marks searches LIKE match on phrase, else splits on spaces and searches OR on elements
 *
 * @param string $q the query term(s)
 * @param string $scope (optional, either 'my' or 'all' - default: 'all')
 * @return RoleSet or Error
 */
function getNodeRolesBySearch($q,$scope) {
    global $CFG,$USER,$DB;

	$params = array();

    $sql = "SELECT DISTINCT nt.Name, nt.Image
		FROM Node t LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID
        LEFT JOIN TagNode ut ON t.NodeID = ut.NodeID
        LEFT JOIN Tag u ON u.tagID = ut.TagID
        WHERE (u.Name LIKE('%".$DB->cleanString($q)."%')".
            " OR t.Name LIKE('%".$DB->cleanString($q)."%')".
            " OR t.Description LIKE ('%".$DB->cleanString($q)."%'))";

    if($scope == 'my'){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND (
            (t.Private = 'N')
             OR
            (t.UserID = '".$USER->userid."') ". // the current user
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')". // the current user
            ")) order by nt.Name ASC";

    $rs = new RoleSet();
    return $rs->loadFilterRoles($sql,$params);
}

/**
 * get node types for the nodes by their tags
 * splits on commas and searches OR on elements
 *
 * @param string $q the query term(s)
 * @param string $scope (optional, either 'my' or 'all' - default: 'all')
 * @param string $groupid (optional, the id of the user group to filter by)
 * @return RoleSet or Error
 */
function getNodeRolesByTagSearch($q,$scope,$groupid='') {
    global $CFG,$USER,$DB;

	$params = array();

    $sql = "SELECT DISTINCT nt.Name, nt.Image
		FROM Node t LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID
        LEFT JOIN TagNode ut ON t.NodeID = ut.NodeID
        LEFT JOIN Tag u ON u.TagID = ut.TagID WHERE ";

   	$pieces = explode(",", $q);
   	$loopCount = 0;
   	$search = "";
   	foreach ($pieces as $value) {
		$value = trim($value);
   		if ($loopCount == 0) {
   		    $search .= "u.Name ='".$DB->cleanString($value)."'";
   		} else {
   			$search .= " OR u.Name ='".$DB->cleanString($value)."'";
   		}
   		$loopCount++;
   	}
	$sql .= "( ".$search." )";

    if($scope == 'my'){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND (
            (t.Private = 'N')
             OR
            (t.UserID = '".$USER->userid."') ". // the current user
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')". // the current user
            ")) ";

    if($groupid != ''){
    	$sql .= " AND t.NodeID IN (Select NodeID from NodeGroup where GroupID='".$groupid."')";
	}

	$sql .= " order by nt.Name ASC";

    $rs = new RoleSet();
    return $rs->loadFilterRoles($sql,$params);
}

/**
 * Get the idea types for the connections for given user
 *
 * @param string $userid
 * @return RoleSet or Error
 */
function getConnectionRolesByUser($userid) {
    global $USER,$CFG;

	$params = array();

    $sql = "SELECT DISTINCT Name, Image FROM (";
    $sql .= "(SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t
    		    INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
    		    Left JOIN NodeType nt ON t.FromContextTypeID = nt.NodeTypeID
                WHERE t.UserID = '".$userid."'
                AND ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            )";
    $sql .= ") UNION ( ";
    $sql .= "SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t
	    INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
	    Left JOIN NodeType nt ON t.ToContextTypeID = nt.NodeTypeID
        WHERE t.UserID = '".$userid."'
        AND ((t.Private = 'N')
           OR
           (t.UserID = '".$USER->userid."')
           OR
           (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                          WHERE ug.UserID = '".$USER->userid."')))
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
                    )";
    $sql .= ")) as alltypes order by alltypes.Name ASC";

    $rs = new RoleSet();
    return $rs->loadFilterRoles($sql,$params);
}

/**
 * Get the idea types for the connections for given group
 *
 * @param string $groupid
 * @return ConnectionSet or Error
 */
function getConnectionRolesByGroup($groupid) {

	$params = array();

    global $USER,$CFG;
    $sql = "SELECT DISTINCT Name, Image FROM (";
    $sql .= "(SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t
	    INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
        INNER JOIN TripleGroup tg ON tg.TripleID = t.TripleID
	    Left JOIN NodeType nt ON t.FromContextTypeID = nt.NodeTypeID
        WHERE tg.GroupID = '".$groupid."'
        AND ((t.Private = 'N')
           OR
           (t.UserID = '".$USER->userid."')
           OR
           (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                          WHERE ug.UserID = '".$USER->userid."')))
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
                            )";
    $sql .= ") UNION ( ";
    $sql .= "SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t
	    INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
        INNER JOIN TripleGroup tg ON tg.TripleID = t.TripleID
	    Left JOIN NodeType nt ON t.ToContextTypeID = nt.NodeTypeID
        WHERE tg.GroupID = '".$groupid."'
        AND ((t.Private = 'N')
           OR
           (t.UserID = '".$USER->userid."')
           OR
           (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                          WHERE ug.UserID = '".$USER->userid."')))
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
                    )";
    $sql .= ")) as alltypes order by alltypes.Name ASC";

    $rs = new RoleSet();
    return $rs->loadFilterRoles($sql,$params);
}

/**
 * Get the connection's node types for connections with nodes with the label of the node with the given nodeid
 *
 * @param string $nodeid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filtergroup (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)
 * @param string $filterlist (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return RoleSet or Error
 */
function getConnectionRolesByNode($nodeid) {
    global $USER,$CFG;

	$params = array();

    $list =  getAggregatedNodeIDs($nodeid);
	if ($list != "") {

	    $sql = "SELECT DISTINCT Name, Image FROM (";
		$sql .= "(SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t
					INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
					Left JOIN NodeType nt ON t.FromContextTypeID = nt.NodeTypeID
			 		WHERE (t.FromID IN (".$list.") OR t.ToID IN (".$list."))
					   AND ((t.Private = 'N')
	                   OR
	                   (t.UserID = '".$USER->userid."')
	                   OR
	                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
	                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
	                                  WHERE ug.UserID = '".$USER->userid."')))
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
	                            ))";
        $sql .= " UNION ";

		$sql .= "(SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t
			INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
			Left JOIN NodeType nt ON t.ToContextTypeID = nt.NodeTypeID
	 		WHERE (t.FromID IN (".$list.") OR t.ToID IN (".$list."))
			   AND ((t.Private = 'N')
	           OR
	           (t.UserID = '".$USER->userid."')
	           OR
	           (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
	                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
	                          WHERE ug.UserID = '".$USER->userid."')))
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
	                    ))";

    	$sql .= ") as alltypes order by alltypes.Name ASC";

    	$rs = new RoleSet();
    	return $rs->loadFilterRoles($sql, $params);
	} else {
		return new RoleSet();
	}
}

/**
 * Get the connections for given url
 *
 * @param string $url
 * @return ConnectionSet or Error
 */
function getConnectionRolesByURL($url) {
    global $USER,$CFG;

	$params = array();

    $sql = "SELECT DISTINCT Name, Image FROM (";
    $sql .= "(SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t
            INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
			Left JOIN NodeType nt ON t.FromContextTypeID = nt.NodeTypeID
            WHERE ((t.Private = 'N')
               OR
               (t.UserID = '".$USER->userid."')
               OR
               (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                             INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                              WHERE ug.UserID = '".$USER->userid."')))
            AND (FromID IN (SELECT t.NodeID FROM Node t
                          INNER JOIN URLNode ut ON ut.NodeID = t.NodeID
                          INNER JOIN URL u ON u.URLID = ut.URLID
                            WHERE u.URL = '".$url."'
                            AND ((u.Private = 'N')
                                    OR
                                    (u.UserID = '".$USER->userid."')
                                    OR
                                    (u.URLID IN (SELECT urlg.URLID FROM URLGroup urlg
                                                   INNER JOIN UserGroup ug ON ug.GroupID=urlg.GroupID
                                                   WHERE ug.UserID = '".$USER->userid."')
                                     ))
                            AND ((t.Private = 'N')
                               OR
                               (t.UserID = '".$USER->userid."')
                               OR
                               (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                                           INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                            WHERE ug.UserID = '".$USER->userid."')))
                            )
            OR ToID IN (SELECT t.NodeID FROM Node t
                      INNER JOIN URLNode ut ON ut.NodeID = t.NodeID
                          INNER JOIN URL u ON u.URLID = ut.URLID
                            WHERE u.URL = '".$url."'
                            AND ((u.Private = 'N')
                                 OR
                                 (u.UserID = '".$USER->userid."')
                                 OR
                                 (u.URLID IN (SELECT urlg.URLID FROM URLGroup urlg
                                                INNER JOIN UserGroup ug ON ug.GroupID=urlg.GroupID
                                                WHERE ug.UserID = '".$USER->userid."')
                                  ))
                            AND ((t.Private = 'N')
                               OR
                               (t.UserID = '".$USER->userid."')
                               OR
                               (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                                           INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                            WHERE ug.UserID = '".$USER->userid."')))
                        )))";

    $sql .= " UNION ";

    $sql .= "(SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t
        INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
		Left JOIN NodeType nt ON t.ToContextTypeID = nt.NodeTypeID
        WHERE ((t.Private = 'N')
           OR
           (t.UserID = '".$USER->userid."')
           OR
           (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                          WHERE ug.UserID = '".$USER->userid."')))
        AND (FromID IN (SELECT t.NodeID FROM Node t
                      INNER JOIN URLNode ut ON ut.NodeID = t.NodeID
                      INNER JOIN URL u ON u.URLID = ut.URLID
                        WHERE u.URL = '".$url."'
                        AND ((u.Private = 'N')
                                OR
                                (u.UserID = '".$USER->userid."')
                                OR
                                (u.URLID IN (SELECT urlg.URLID FROM URLGroup urlg
                                               INNER JOIN UserGroup ug ON ug.GroupID=urlg.GroupID
                                               WHERE ug.UserID = '".$USER->userid."')
                                 ))
                        AND ((t.Private = 'N')
                           OR
                           (t.UserID = '".$USER->userid."')
                           OR
                           (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                                       INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                        WHERE ug.UserID = '".$USER->userid."')))
                        )
        OR ToID IN (SELECT t.NodeID FROM Node t
                  INNER JOIN URLNode ut ON ut.NodeID = t.NodeID
                      INNER JOIN URL u ON u.URLID = ut.URLID
                        WHERE u.URL = '".$url."'
                        AND ((u.Private = 'N')
                             OR
                             (u.UserID = '".$USER->userid."')
                             OR
                             (u.URLID IN (SELECT urlg.URLID FROM URLGroup urlg
                                            INNER JOIN UserGroup ug ON ug.GroupID=urlg.GroupID
                                            WHERE ug.UserID = '".$USER->userid."')
                              ))
                        AND ((t.Private = 'N')
                           OR
                           (t.UserID = '".$USER->userid."')
                           OR
                           (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                                       INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                        WHERE ug.UserID = '".$USER->userid."')))
                    )))";

	$sql .= ") as alltypes order by alltypes.Name ASC";

	$rs = new RoleSet();
	return $rs->loadFilterRoles($sql, $params);
}

/**
 * Get the node types for the connections for given search
 * If in speech marks searches LIKE match on phrase, else splits on spaces and searches OR on elements
 *
 * @param string $q
 * @param string $scope (either 'all' or 'my')
 * @return RoleSet or Error
 */
function getConnectionRolesBySearch($q,$scope) {
    global $USER,$CFG,$DB;

	$params = array();

	$sql = "SELECT DISTINCT t.NodeID from Node t
        LEFT JOIN TagNode tn ON t.NodeID = tn.NodeID
        LEFT JOIN Tag u ON u.tagID = tn.TagID
        WHERE (u.Name LIKE('%".$DB->cleanString($q)."%')".
		" OR t.Name LIKE ('%".$DB->cleanString($q)."%'))";

	if($scope == "my"){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .=  " AND (
			    (t.Private = 'N')
			     OR
			    (t.UserID = '".$USER->userid."') ". // the current user
			    " OR
			    (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
			                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
			                 WHERE ug.UserID = '".$USER->userid."')". // the current user
			    "))";

	$list = "";
	$nodes = array();

	$resArray = $DB->select($sql, $params);
	if ($resArray !== false) {
	    $count = 0;
        if (is_countable($resArray)) {
        	$count = count($resArray);
        }

		for ($i=0; $i<$count; $i++) {
			$array = $resArray[$i];
			$NodeID = $array['NodeID'];
			if (!isset($nodes[$NodeID])) {
				$list .= ",'".$NodeID."'";
				$nodes[$NodeID] = $NodeID;
			}
		}
		// remove first comma.
		$list = substr($list, 1);
	}

    if($list == ""){
        return new RoleSet();
    }

	$params = array();

    $sql = "SELECT DISTINCT Name, Image FROM (";

    $sql .= "(SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t";
    $sql .= " LEFT JOIN NodeType nt ON t.FromContextTypeID = nt.NodeTypeID";
    $sql .= " LEFT JOIN TagTriple tn ON t.TripleID = tn.TripleID";
    $sql .= " LEFT JOIN Tag u ON u.tagID = tn.TagID";
    $sql .= " WHERE (u.Name LIKE('%".$DB->cleanString($q)."%')";
    $sql .= " OR (FromID IN (".$list.") or ToID IN (".$list.")))";
    if($scope == "my"){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            ))";

    $sql .= " UNION ";

    $sql .= "(SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t";
    $sql .= " LEFT JOIN NodeType nt ON t.ToContextTypeID = nt.NodeTypeID";
    $sql .= " LEFT JOIN TagTriple tn ON t.TripleID = tn.TripleID";
    $sql .= " LEFT JOIN Tag u ON u.tagID = tn.TagID";
    $sql .= " WHERE (u.Name LIKE('%".$DB->cleanString($q)."%')";
    $sql .= " OR (FromID IN (".$list.") or ToID IN (".$list.")))";
    if($scope == "my"){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            ))";

	$sql .= ") as alltypes order by alltypes.Name ASC";

	$rs = new RoleSet();
	return $rs->loadFilterRoles($sql, $params);
}

/**
 * Get the node types for the connections searched by the given tags
 * splits on commas and searches OR on elements
 *
 * @param string $q
 * @param string $scope (either 'all' or 'my')
 * @param string $groupid (optional, the id of the user group to filter by)
 * @return RoleSet or Error
 */
function getConnectionRolesByTagSearch($q,$scope,$groupid='') {
    global $DB,$USER,$CFG;

	$params = array();

    $q = trim($q);
   	$pieces = explode(",", $q);
   	$loopCount = 0;
   	$search = "";
   	foreach ($pieces as $value) {
		$value = trim($value);
   		if ($loopCount == 0) {
   		    $search .= "u.Name ='".$DB->cleanString($value)."'";
   		} else {
   		    $search .= " OR u.Name ='".$DB->cleanString($value)."'";
   		}
   		$loopCount++;
   	}


    $sql = "SELECT DISTINCT Name, Image FROM (";

    $sql .= "(SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t";
    $sql .= " LEFT JOIN NodeType nt ON t.FromContextTypeID = nt.NodeTypeID";
    $sql .= " LEFT JOIN TagTriple tn ON t.TripleID = tn.TripleID";
    $sql .= " LEFT JOIN Tag u ON u.TagID = tn.TagID WHERE ";
	$sql .= "( ".$search." )";
    if($scope == "my"){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            )";
    if($groupid != ''){
    	$sql .= " AND t.TripleID IN (Select TripleID from TripleGroup where GroupID='".$groupid."')";
	}

    $sql .= ") UNION ";

    $sql .= "(SELECT DISTINCT nt.Name as Name, nt.Image as Image FROM Triple t";
    $sql .= " LEFT JOIN NodeType nt ON t.ToContextTypeID = nt.NodeTypeID";
    $sql .= " LEFT JOIN TagTriple tn ON t.TripleID = tn.TripleID";
    $sql .= " LEFT JOIN Tag u ON u.TagID = tn.TagID WHERE ";
	$sql .= "( ".$search." )";
    if($scope == "my"){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            )";

    if($groupid != ''){
    	$sql .= " AND t.TripleID IN (Select TripleID from TripleGroup where GroupID='".$groupid."')";
	}

	$sql .= ")) as alltypes order by alltypes.Name ASC";

	$rs = new RoleSet();
	return $rs->loadFilterRoles($sql, $params);
}


///////////////////////////////////////////////////////////////////
// functions for link types
///////////////////////////////////////////////////////////////////
/**
 * Get a linktype
 *
 * @param string $ltid
 * @return LinkType or Error
 */
function getLinkType($ltid){
    $lt = new LinkType($ltid);
    return $lt->load();
}

/**
 * Get a linktype by label
 *
 * @param string $label
 * @return LinkType or Error
 */
function getLinkTypeByLabel($label){
    $lt = new LinkType();
    return $lt->loadByLabel($label);
}

/**
 * Get all the linktypes for the current user
 *
 * @return LinkTypeSet or Error
 */
function getAllLinkTypes(){
    return getUserLinkTypes();
}

/**
 * Get all the linktypes for the current user
 *
 * @return LinkTypeSet or Error
 */
function getUserLinkTypes(){
    global $CFG,$USER;

	$params = array();

    $sql = "SELECT lt.LinkTypeID FROM LinkTypeGroup ltg
            INNER JOIN LinkTypeGrouping ltgg ON ltgg.LinkTypeGroupID = ltg.LinkTypeGroupID
            INNER JOIN LinkType lt ON lt.LinkTypeID = ltgg.LinkTypeID
            WHERE ltgg.UserID = '".$USER->userid."' AND lt.UserID = '".$USER->userid."'
            ORDER BY ltg.Label DESC, lt.Label ASC";
    $lts = new LinkTypeSet();

    return $lts->load($sql, $params);
}

/**
 * Add a linktype (will return the existing one if it's already in the db).
 * Requires login.
 *
 * @param string $label
 * @param string $linktypegroup
 * @return LinkType or Error
 */
function addLinkType($label,$linktypegroup){
    $lt = new LinkType();
    return $lt->add($label,$linktypegroup);
}

/**
 * Edit a linktype. Requires login and user must be owner of the linktype
 *
 * @param string $linktypeid
 * @param string $linktypelabel
 * @return LinkType or Error
 */
function editLinkType($linktypeid,$linktypelabel){
    $linktypeobj = new LinkType($linktypeid);
    return $linktypeobj->edit($linktypelabel);
}

/**
 * Delete a linktype. Requires login and user must be owner of the linktype
 *
 * @param string $linktypeid
 * @return Result or Error
 */
function deleteLinkType($linktypeid){
    $linktypeobj = new LinkType($linktypeid);
    return $linktypeobj->delete();
}


///////////////////////////////////////////////////////////////////
//functions for tags
///////////////////////////////////////////////////////////////////
/**
* Get a tag (by id)
*
* @param string $tagid
* @return Tag or Error
*/
function getTag($tagid){
	$t = new Tag($tagid);
	return $t->load();
}

/**
* Get a tag (by name)
*
* @param string $tagname
* @return Tag or Error
*/
function getTagByName($tagname){
	$t = new Tag();
	return $t->loadByName($tagname);
}

/**
* Get the current user's tags. Login required.
*
* @return TagSet or Error
*/
function getUserTags(){
	global $CFG,$USER;

	$params = array();

	$sql = "SELECT Tag.TagID FROM Tag
         WHERE Tag.UserID='".$USER->userid."' ORDER BY Name ASC";

    $ts = new TagSet();
	return $ts->load($sql, $params);
}

/**
* Get the tags for given nodeid. Login required.
*
* @return TagSet or Error
*/
function getTagsByNode(){
	global $CFG,$USER;

	$params = array();

    $sql = "SELECT t.TagID FROM TagNode tn INNER JOIN Tag t ON t.TagID = tn.TagID
    		WHERE tn.NodeID='".$this->nodeid."' ORDER BY Name ASC";

    $ts = new TagSet();
	return $ts->load($sql, $params);
}


/**
 * Search urls by their tags
 * splits on commas and searches OR on elements
 *
 * @param string $q the query term(s)
 * @param string $scope (either 'all' or 'my')
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $groupid (optional, the id of the user group to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a url's details to load (long includes: tags, groups).
 * @return NodeSet or Error
 */
function getURLsByTagSearch($q,$scope,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC',$groupid='',$style='long'){
    global $CFG,$USER,$DB;

	$params = array();

    $q = trim($q);
	$pieces = explode(",", $q);
	$loopCount = 0;
	$search="";
	foreach ($pieces as $value) {
		$value = trim($value);
		if ($loopCount == 0) {
		    $search .= "tg.Name ='".$DB->cleanString($value)."'";
		} else {
			$search .= " OR (tg.Name ='".$DB->cleanString($value)."'";
		}
		$loopCount++;
	}

	$sql = "Select DISTINCT u.URLID, u.CreationDate from (
        (SELECT ul.* FROM URL ul
        LEFT JOIN TagURL tn ON ul.URLID = tn.URLID
        LEFT JOIN Tag tg ON tg.TagID = tn.TagID WHERE ";
	$sql .= "( ".$search." )";
    if($scope == 'my'){
        $sql .= " AND ul.UserID = '".$USER->userid."' ";
    } else {
        $sql .= " AND ((ul.Private = 'N')
                OR
                (ul.UserID = '".$USER->userid."')
                OR
                (ul.URLID IN (SELECT urlg.URLID FROM URLGroup urlg
                               INNER JOIN UserGroup ug ON ug.GroupID=urlg.GroupID
                               WHERE ug.UserID = '".$USER->userid."')
                 )) ";
    }

	if ($groupid != "") {
		$sql .= " AND u.URLID IN (Select URLID from URLGroup Where GroupID='".$groupid."')";
	}

    $sql .= ") UNION ";

    $sql .= "(SELECT ul.* FROM URL ul
	  	 LEFT JOIN URLNode n on ul.URLID = n.URLID
	  	 LEFT JOIN TagNode tn on n.NodeID = tn.NodeID
	     LEFT JOIN Tag tg ON tg.TagID = tn.TagID WHERE ( ".$search." )";
    if($scope == 'my'){
       $sql .= " AND ul.UserID = '".$USER->userid."' ";
    } else {
       $sql .= " AND ((ul.Private = 'N')
                OR
                (ul.UserID = '".$USER->userid."')
                OR
                (ul.URLID IN (SELECT urlg.URLID FROM URLGroup urlg
                               INNER JOIN UserGroup ug ON ug.GroupID=urlg.GroupID
                               WHERE ug.UserID = '".$USER->userid."')
                 )) ";
    }

	if ($groupid != "") {
		$sql .= " AND ul.URLID IN (Select URLID from URLGroup Where GroupID='".$groupid."')";
	}

    $sql .= ")) as u ";

    $us = new URLSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Search users by their tags and by the nodes they have tagged
 * splits on commas and searches OR on elements
 *
 * @param string $q the query term(s)
 * @param string $scope (must be 'all' or 'my')
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $groupid (optional, the id of the user group to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags, groups).
 * @return NodeSet or Error
 */
function getUsersByTagSearch($q,$scope,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC',$groupid='', $style='long'){
    global $CFG,$USER,$DB;

	$params = array();

    $q = trim($q);
   	$pieces = explode(",", $q);
	$loopCount = 0;
	$search="";
	foreach ($pieces as $value) {
		$value = trim($value);
		if ($loopCount == 0) {
		    $search .= "tg.Name ='".$DB->cleanString($value)."'";
		} else {
		    $search .= " OR tg.Name ='".$DB->cleanString($value)."'";
		}

		$loopCount++;
	}

    $sql = "Select DISTINCT t.UserID from (
       (SELECT u.* FROM Users u
    	LEFT JOIN TagUsers tn ON u.UserID = tn.UserID
    	LEFT JOIN Tag tg ON tg.TagID = tn.TagID WHERE ";
    $sql .= "( ".$search." )";
    if($scope == 'my'){
       $sql .= " AND u.UserID = '".$USER->userid."' ";
    }

    $sql .= ") UNION ";
    $sql .= "(SELECT u.* FROM Users u
		  	 LEFT JOIN Node n on u.UserID = n.UserID
		  	 LEFT JOIN TagNode tn on n.NodeID = tn.NodeID
    	     LEFT JOIN Tag tg ON tg.TagID = tn.TagID WHERE ( ".$search." )";
    if($scope == 'my'){
       $sql .= " AND u.UserID = '".$USER->userid."' ";
    } else {
       $sql .= " AND (
            (n.Private = 'N')
             OR
            (n.UserID = '".$USER->userid."') ".
            " OR
            (n.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')".
            "))";
    }

	if ($groupid != "") {
		$sql .= " AND u.UserID IN (Select UserID from UserGroup Where GroupID='".$groupid."')";
	}


    $sql .= ") UNION ";
    $sql .= "(SELECT u.* FROM Users u
		  	 LEFT JOIN Triple n on u.UserID = n.UserID
		  	 LEFT JOIN TagTriple tn on n.TripleID = tn.TripleID
    	     LEFT JOIN Tag tg ON tg.TagID = tn.TagID WHERE ( ".$search." )";
    if($scope == 'my'){
    	$sql .= " AND u.UserID = '".$USER->userid."' ";
    } else {
        $sql .= " AND (
        	(n.Private = 'N')
            OR
            (n.UserID = '".$USER->userid."')
            OR
            (n.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                          INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                           WHERE ug.UserID = '".$USER->userid."')))
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
            )";
    }
	if ($groupid != "") {
		$sql .= " AND u.UserID IN (Select UserID from UserGroup Where GroupID='".$groupid."')";
	}

    $sql .= ") UNION ";
    $sql .= "(SELECT u.* FROM Users u
		  	 LEFT JOIN URL n on u.UserID = n.UserID
		  	 LEFT JOIN TagURL tn on n.URLID = tn.URLID
    	     LEFT JOIN Tag tg ON tg.TagID = tn.TagID WHERE ( ".$search." )";
     if($scope == 'my'){
     	$sql .= " AND n.UserID = '".$USER->userid."' ";
     } else {
        $sql .= " AND ((n.Private = 'N')
                OR
                (n.UserID = '".$USER->userid."')
                OR
                (n.URLID IN (SELECT urlg.URLID FROM URLGroup urlg
                               INNER JOIN UserGroup ug ON ug.GroupID=urlg.GroupID
                               WHERE ug.UserID = '".$USER->userid."')
                 )) ";
     }

	if ($groupid != "") {
		$sql .= " AND u.UserID IN (Select UserID from UserGroup Where GroupID='".$groupid."')";
	}

    $sql .= ")) as t ";

    $us = new UserSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Searches tags by node name based on the first chartacters
 *
 * @param string $q the query term(s)
 * @param string $scope (optional, either 'all' or 'my' - default: 'my')
 * @return TagSet or Error
 */
function getTagsByFirstCharacters($q, $scope){
    global $CFG,$USER,$DB;

	$params = array();

    $sql = "SELECT t.Name, MAX(t.TagID) AS TagID  FROM Tag t
            WHERE t.Name LIKE '".$DB->cleanString($q)."%'";
    if($scope == 'my'){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= "GROUP BY t.Name";

    $ts = new TagSet();
    return $ts->load($sql, $params);
}

/**
 * Add the given tag labels to the given connection ids
 * @param $tags the comma separated list of tags to add
 * @param $connids the comma separated list of connetion id to add tags to
 */
function addTagsToConnections($tags, $connids) {

    $tagsArray = explode(',', $tags);
    $connidArray = explode(',', $connids);

    if(is_countable($tagsArray) && count($tagsArray) != 0 && is_countable($connidArray) && count($connidArray) != 0){
    	foreach($connidArray as $connid) {
			$conn = new Connection($connid);
			$conn->load();
			if ($conn && $conn->connid) {
				foreach($tagsArray as $tagname){
		        	if ($tagname && $tagname != "") {
		            	$tag = addTag($tagname);
		            	if ($tag && $tag->tagid) {
		            		$conn->addTag($tag->tagid);
		            	}
		        	}
		        }
			}
    	}
	}
}


/**
 * Add the given tag labels to the given node ids
 * @param $tags the comma separated list of tags to add
 * @param $nodeids the comma separated list of node id to add tags to
 */
function addTagsToNodes($tags, $nodeids) {

    $tagsArray = explode(',', $tags);
    $nodeidArray = explode(',', $nodeids);

    if(is_countable($tagsArray) && count($tagsArray) != 0 && is_countable($nodeidArray) && count($nodeidArray) != 0){
    	foreach($nodeidArray as $id) {
			$node = new CNode($id);
			$node->load();
			if ($node && $node->nodeid) {
				foreach($tagsArray as $tagname){
		        	if ($tagname && $tagname != "") {
		            	$tag = addTag($tagname);
		            	if ($tag && $tag->tagid) {
		            		$node->addTag($tag->tagid);
		            	}
		        	}
		        }
			}
    	}
	}
}


/**
 * Add the given tag labels to the given urls ids
 * @param $tags the comma separated list of tags to add
 * @param $urlids the comma sepsrated list of url id to add tags to
 */
function addTagsToURLs($tags, $urlids) {

    $tagsArray = explode(',', $tags);
    $urlidArray = explode(',', $urlids);

    if(is_countable($tagsArray) && count($tagsArray) != 0 && is_countable($urlidArray) && count($urlidArray) != 0){
    	foreach($urlidArray as $urlid) {
			$url = new URL($urlid);
			$url->load();
			if ($url && $url->urlid) {
				foreach($tagsArray as $tagname){
		        	if ($tagname && $tagname != "") {
		            	$tag = addTag($tagname);
		            	if ($tag && $tag->tagid) {
		            		$url->addTag($tag->tagid);
		            	}
		        	}
		        }
			}
    	}
	}
}

/**
* Add new tag - if the tag already exists then this
* existing tag object will be returned. Login required.
*
* @param string $tagname
* @return Role or Error
*/
function addTag($tagname){
	$tagobj = new Tag;
	return $tagobj->add($tagname);
}

/**
* Edit a tag. If that tag name already exists for this user, return an error.
* Requires login and user must be owner of the tag
*
* @param string $tagid
* @param string $tagname
* @return Tag or Error
*/
function editTag($tagid,$tagname){
	$tagobj = new Tag($tagid);
	return $tagobj->edit($tagname);
}

/**
* Delete a tag. Requires login and user must be owner of the tag.
*
* @param string $tagid
* @return Result or Error
*/
function deleteTag($tagid){
	$tagobj = new Tag($tagid);
	return $tagobj->delete();
}

///////////////////////////////////////////////////////////////////
// misc functions
///////////////////////////////////////////////////////////////////
/**
 * Get the recent nodes
 *
 * @param string $scope (optional, either 'all' or 'my' - default 'all' )
 * @param integer $groupid (optional - default: '') id of the group to filter on.
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getRecentNodes($scope = 'all',$groupid='', $start = 0,$max = 20, $style='long'){
    global $CFG,$USER;

	$params = array();

    $sql = "SELECT t.NodeID,
                (SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
                (SELECT COUNT(ToID) FROM Triple WHERE ToiD=t.NodeID) AS connectedness
            FROM Node t
            WHERE  (
            (t.Private = 'N')
             OR
            (t.UserID = '".$USER->userid."') ". // the current user
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')". // the current user
            "))";
    if ($scope == 'my'){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }

    if ($groupid != "") {
    	$sql .= " AND t.NodeID IN (SELECT NodeID FROM NodeGroup WHERE GroupID='".$groupid."')";
    }

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,'date','DESC',$style);
}


/**
 * Get the recent visitors (excludes groups)
 *
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a users details to load (long includes: tags and groups).
 * @return UserSet or Error
 */
function getRecentUsers($start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC',$style='long'){
    global $CFG;

	$params = array();

    $sql = "SELECT UserID FROM Users t
            WHERE UserID NOT IN (SELECT GroupID FROM UserGroup)
            AND Name != ''";

    $us = new UserSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}


/**
 * Get the users with the most connections to other user's (excludes groups)
 *
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a users details to load (long includes: tags and groups).
 * @param String $groupid (optional - default '') any group to filter results on
 * @return UserSet or Error
 */
function getMostConnectedUsers($start = 0,$max = 20,$style='long',$groupid='') {
	global $CFG,$USER,$DB;

	$params = array();

	/*select UserID, sum(num) as bignum From (

	(SELECT m.UserID AS UserID, count(DISTINCT c.UserID) AS num FROM Triple t
	RIGHT JOIN Node c ON c.NodeID = t.ToID
	RIGHT JOIN Node m ON m.NodeID = t.FromID
	WHERE c.UserID != m.UserID AND c.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID='137108251470343583001284988782')
	AND m.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID='137108251470343583001284988782')
	AND t.TripleID IN (Select TripleID FROM TripleGroup WHERE GroupID='137108251470343583001284988782')
	group by m.UserID)

	UNION ALL

	(SELECT c.UserID AS UserID, count(DISTINCT m.UserID) AS num FROM Triple t
	RIGHT JOIN Node c ON c.NodeID = t.ToID
	RIGHT JOIN Node m ON m.NodeID = t.FromID
	WHERE c.UserID != m.UserID AND c.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID='137108251470343583001284988782')
	AND m.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID='137108251470343583001284988782')
	AND t.TripleID IN (Select TripleID FROM TripleGroup WHERE GroupID='137108251470343583001284988782')
	group by c.UserID)
	) as alldata group by alldata.UserID*/

	$qry = "SELECT UserID, sum(num) as bignum FROM ( ";

	$qry .= "(Select m.UserID AS UserID, count(DISTINCT c.UserID) AS num ";
	$qry .= "FROM Triple t RIGHT JOIN Node c ON c.NodeID = t.ToID ";
	$qry .= "RIGHT JOIN Node m ON m.NodeID = t.FromID ";
	$qry .= "WHERE c.UserID != m.UserID ";
	$qry .= "AND c.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID='".$groupid."') ";
	$qry .= "AND m.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID='".$groupid."') ";
	$qry .= "AND t.TripleID IN (Select TripleID FROM TripleGroup WHERE GroupID='".$groupid."') ";
	$qry .= "AND ((t.Private = 'N')
				   OR
				   (t.UserID = '".$USER->userid."')
				   OR
				   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
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
							)) group by m.UserID)";

	$qry .= "UNION ALL ";

	$qry .= "(Select c.UserID AS UserID, count(DISTINCT m.UserID) AS num ";
	$qry .= "FROM Triple t RIGHT JOIN Node c ON c.NodeID = t.ToID ";
	$qry .= "RIGHT JOIN Node m ON m.NodeID = t.FromID ";
	$qry .= "WHERE c.UserID != m.UserID ";
	$qry .= "AND c.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID='".$groupid."') ";
	$qry .= "AND m.UserID IN (SELECT UserID FROM UserGroup WHERE GroupID='".$groupid."') ";
	$qry .= "AND t.TripleID IN (Select TripleID FROM TripleGroup WHERE GroupID='".$groupid."') ";
	$qry .= "AND ((t.Private = 'N')
				   OR
				   (t.UserID = '".$USER->userid."')
				   OR
				   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
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
							)) group by c.UserID)";


	$qry .= ") AS allusers ";
	$qry .= "Group by allusers.UserID order by bignum DESC ";

	$us = new UserSet();

	$resArray = $DB->select($qry, $params);
	if ($resArray !== false) {
	    $count = 0;
        if (is_countable($resArray)) {
        	$count = count($resArray);
        }
		$us->start = $start;
		$us->count = $count;
		$us->totalno = $us->count;

		for ($i=0; $i<$count; $i++) {
			$array = $resArray[$i];

			$u = new User($array["UserID"]);
			$us->add($u->load($style));
			$u->connectioncount = $array["bignum"];
		}
	}

    return $us;
}

/**
 * Get the recent connections
 *
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'
 * @return ConnectionSet or Error
 */
function getRecentConnections($start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC', $style='long'){
    global $CFG,$USER;

	$params = array();

    $sql = "SELECT t.TripleID FROM Triple t
    			INNER JOIN LinkType lt ON lt.LinkTypeID = t.LinkTypeID
                WHERE ((t.Private = 'N')
                   OR
                   (t.UserID = '".$USER->userid."')
                   OR
                   (t.TripleID IN (SELECT tg.TripleID FROM TripleGroup tg
                                 INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                                  WHERE ug.UserID = '".$USER->userid."')))
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
                            )";

     $cs = new ConnectionSet();
     return $cs->load($sql,$params,$start,$max,$orderby,$sort,$style);
}



///////////////////////////////////////////////////////////////////
// functions for groups
///////////////////////////////////////////////////////////////////


/**
 * Get the nodes for given group
 *
 * @param string $groupid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filterusers (optional, a list of user ids to filter by)
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesByGroup($groupid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $filterusers='', $filternodetypes='', $style='long'){
    global $CFG,$USER,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();

    $sql = $HUB_SQL->APILIB_NODES_BY_GROUP_SELECT;

	// FILTER NODE TYPES
    if ($filternodetypes != "") {
		// This comes first in HUB_SQL->APILIB_NODES_BY_GROUP_NODETYPE
		// Before node type list.
		$params[count($params)] = $groupid;

        $pieces = explode(",", $filternodetypes);
        $sqlList = "";
		$loopCount = 0;
        foreach ($pieces as $value) {
        	$params[count($params)] = $value;
        	if ($loopCount == 0) {
        		$sqlList .= "?";
        	} else {
        		$sqlList .= ",?";
        	}
        	$loopCount++;
		}

        $sql .= $HUB_SQL->APILIB_NODES_BY_GROUP_NODETYPE.$HUB_SQL->OPENING_BRACKET;
        $sql .= $sqlList;
	    $sql .= $HUB_SQL->CLOSING_BRACKET.$HUB_SQL->AND;
    } else {
		$params[count($params)] = $groupid;
		$sql .= $HUB_SQL->APILIB_NODES_BY_GROUP_NODETYPE_NONE.$HUB_SQL->AND;
    }

    if ($filterusers != "") {
        $pieces = explode(",", $filterusers);
        $loopCount = 0;
        $searchUsers = "";
        foreach ($pieces as $value) {
        	$params[count($params)] = $value;
            if ($loopCount == 0) {
            	$searchUsers .= "?";
            } else {
            	$searchUsers .= ",?";
            }
            $loopCount++;
        }

        $sql .=  $HUB_SQL->FILTER_USERS.$HUB_SQL->OPENING_BRACKET;
        $sql .= $searchUsers;
	    $sql .= $HUB_SQL->CLOSING_BRACKET.$HUB_SQL->AND;
    }

	// PERMISSIONS
	$params[count($params)] = 'N';
	$params[count($params)] = $currentuser;
	$params[count($params)] = $currentuser;
	$sql .=  $HUB_SQL->APILIB_NODES_PERMISSIONS_ALL;

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort, $style);
}

/**
 * Get a group
 *
 * @param string $groupid
 * @return Group or Error
 */
function getGroup($groupid){

    $g = new Group($groupid);
	$g->load();
    $g->loadmembers();
    return $g;
}

/**
 * Add a group to a node. Requires login, user must be the node owner and member of the group.
 *
 * @param string $nodeid
 * @param string $groupid
 * @return Node or Error
 */
function addGroupToNode($nodeid,$groupid){
    $n = new CNode($nodeid);
    $n->load();
    return $n->addGroup($groupid);
}

/**
 * Add a group to a set of nodes. Requires login, user must be the node owner and member of the group.
 *
 * @param string $nodeids
 * @param string $groupid
 * @return Result or Error
 */
function addGroupToNodes($nodeids,$groupid){
    $nodesArr = explode(",",$nodeids);
    foreach ($nodesArr as $nodeid){
        $n = new CNode($nodeid);
        $n->load();
        $n->addGroup($groupid);
    }
    return new Result("added","true");
}

/**
 * Remove a group from a node. Requires login, user must be the node owner and member of the group.
 *
 * @param string $nodeid
 * @param string $groupid
 * @return Node or Error
 */
function removeGroupFromNode($nodeid,$groupid){
    $n = new CNode($nodeid);
    $n->load();
    return $n->removeGroup($groupid);
}

/**
 * Remove a group from a set of nodes. Requires login, user must be the node owner and member of the group.
 *
 * @param string $nodeids
 * @param string $groupid
 * @return Result or Error
 */
function removeGroupFromNodes($nodeids,$groupid){
    $nodesArr = explode(",",$nodeids);
    foreach ($nodesArr as $nodeid){
        $n = new CNode($nodeid);
        $n->load();
        $n->removeGroup($groupid);
    }
    return new Result("added","true");
}

/**
 * Remove all groups from a node. Requires login, user must be the node owner.
 *
 * @param string $nodeid
 * @return Node or Error
 */
function removeAllGroupsFromNode($nodeid){
    $n = new CNode($nodeid);
    $n->load();
    return $n->removeAllGroups();
}

/**
 * Make all the users nodes and connections in a group private or public.
 * Requires login, user must be member of the group, and this will only update the nodes/connections
 * that the user is the owner of.
 *
 * @param string $groupid
 * @param string $private (must be either 'Y' or 'N')
 * @return Result or Error
 */
function setGroupPrivacy($groupid,$private){
    global $DB,$CFG,$USER,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();
	$params[0] = $groupid;
	$params[1] = $currentuser;

    // set the nodes
    $sql = $HUB_SQL->APILIB_NODE_GROUP_PRIVACY_SELECT;
	$resArray = $DB->select($sql, $params);
	if ($resArray !== false) {
		$count = count($resArray);
		for ($i=0; $i<$count; $i++) {
			$array = $resArray[$i];
			$n = new CNode($array['NodeID']);
			$n->load();
			$n->setPrivacy($private);
		}
	}

    // set the connections
    $sql = APILIB_CONNECTION_GROUP_PRIVACY_SELECT;
	$resArray = $DB->select($sql, $params);
	if ($resArray !== false) {
		$count = count($resArray);
		for ($i=0; $i<$count; $i++) {
			$array = $resArray[$i];
			$c = new Connection($array['TripleID']);
			$c->load();
			$c->setPrivacy($private);
		}
	}

    return new Result("privacy updated","true");
}

/**
 * Add a group to a Connection. Requires login, user must be the connection owner and member of the group.
 *
 * @param string $connid
 * @param string $groupid
 * @return Connection or Error
 */
function addGroupToConnection($connid,$groupid){
    $c = new Connection($connid);
    $c->load();
    return $c->addGroup($groupid);
}

/**
 * Add a group to a set of connections. Requires login, user must be the connection owner and member of the group.
 *
 * @param string $connids
 * @param string $groupid
 * @return Result or Error
 */
function addGroupToConnections($connids,$groupid){
    $connsArr = explode(",",$connids);
    foreach ($connsArr as $connid){
        $c = new Connection($connid);
        $c->load();
        $c->addGroup($groupid);
    }
    return new Result("added","true");
}
/**
 * Remove a group from a Connection. Requires login, user must be the connection owner and member of the group.
 *
 * @param string $connid
 * @param string $groupid
 * @return Result or Error
 */
function removeGroupFromConnection($connid,$groupid){
    $c = new Connection($connid);
    $c->load();
    return $c->removeGroup($groupid);
}

/**
 * Remove a group from a set of Connections. Requires login, user must be the connections owner and member of the group.
 *
 * @param string $connids
 * @param string $groupid
 * @return Result or Error
 */
function removeGroupFromConnections($connids,$groupid){
    $connsArr = explode(",",$connids);
    foreach ($connsArr as $connid){
        $c = new Connection($connid);
   		$c->load();
        $c->removeGroup($groupid);
    }
    return new Result("removed","true");
}

/**
 * Remove all groups from a Connection. Requires login, user must be the connection owner.
 *
 * @param string $connid
 * @return Result or Error
 */
function removeAllGroupsFromConnection($connid){
    $c = new Connection($connid);
    $c->load();
    return $c->removeAllGroups();
}


/**
 * Get all groups for current user. Requires login.
 *
 * @return GroupSet or Error
 */
function getMyGroups(){
    global $USER,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();
	$params[0] = $currentuser;

    $sql = $HUB_SQL->APILIB_GET_MY_GROUPS_SELECT;

    $gs = new GroupSet();
    return $gs->load($sql,$params);
}

/**
 * Get groups that current user is an admin for. Requires login.
 *
 * @return GroupSet or Error
 */
function getMyAdminGroups(){
    global $USER,$HUB_SQL;

	$currentuser = '';
	if (isset($USER->userid)) {
		$currentuser = $USER->userid;
	}

	$params = array();
	$params[0] = $currentuser;

    $sql = $HUB_SQL->APILIB_GET_MY_ADMIN_GROUPS_SELECT;

    $gs = new GroupSet();
    return $gs->load($sql,$params);
}

/**
 * Add a new group. Requires login.
 *
 * @param string $groupname
 * @return Group or Error
 */
function addGroup($groupname){
    $g = new Group();
    $group = $g->add($groupname);
    return $group;
}

/**
 * Delete a group. Requires login and user must be an admin for the group.
 *
 * @param string $groupid
 * @return Result or Error
 */
function deleteGroup($groupid){
    $g = new Group($groupid);
    $result = $g->delete();
    return $result;
}

/**
 * Add a user to a group. Requires login and user must be an admin for the group.
 *
 * @param string $groupid
 * @param string $userid
 * @return Group or Error
 */
function addGroupMember($groupid,$userid){
    $g = new Group($groupid);
    $g->load();
    $group = $g->addmember($userid);
    return $group;
}

/**
 * Make a user an admin of the group. Requires login and user must be an admin for the group.
 *
 * @param string $groupid
 * @param string $userid
 * @return Group or Error
 */
function makeGroupAdmin($groupid,$userid){
    $g = new Group($groupid);
    $g->load();
    $group = $g->makeadmin($userid);
    return $group;
}


/**
 * Remove a user as admin of the group. Requires login and user must be an admin for the group.
 *
 * @param string $groupid
 * @param string $userid
 * @return Group or Error
 */
function removeGroupAdmin($groupid,$userid){
    $g = new Group($groupid);
    $g->load();
    $group = $g->removeadmin($userid);
    return $group;
}

/**
 * Remove a user from a group. Requires login and user must be an admin for the group.
 *
 * @param string $groupid
 * @param string $userid
 * @return Group or Error
 */
function removeGroupMember($groupid,$userid){
    $g = new Group($groupid);
    $g->load();
    $group = $g->removemember($userid);
    return $group;
}

/**
 * Is the given user in the given group.
 *
 * @param string $groupid
 * @param string $userid
 * @return true if member else false
 */
function isGroupMember($groupid,$userid) {
    $g = new Group($groupid);
    $g->load();

    return $g->ismember($userid);
}

///////////////////////////////////////////////////////////////////
// functions for users
///////////////////////////////////////////////////////////////////

/**
 * Get the users with the most connections (excludes groups)
 * If filtering by group, premissions include private connections visible to group, otherwise it only inlcude public connections
 *
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a users details to load (long includes: tags and groups).
 * @param String $groupid (optional - default '') any group to filter results on
 * @return UserSet or Error
 */
function getActiveConnectionUsers($start = 0,$max = 20,$style='long',$groupid='') {
    global $CFG,$USER,$DB,$HUB_SQL;

	$params = array();

	$sql = $HUB_SQL->APILIB_CONNECTIONS_BY_ACTIVE_USERS_SELECT;

    if ($groupid != "") {

    	$sql .= $HUB_SQL->APILIB_CONNECTIONS_BY_ACTIVE_USERS_SELECT_PART2A;

    	$params[0] = $groupid;
    	$params[1] = $groupid;
    	$params[2] = $USER->userid;
    	$params[3] = $USER->userid;
    	$params[4] = $USER->userid;
    	$params[5] = $USER->userid;
    	$params[6] = $USER->userid;
    	$params[7] = $USER->userid;

    } else {
        $sql .= $HUB_SQL->APILIB_CONNECTIONS_BY_ACTIVE_USERS_SELECT_PART2B;
    }

    if ($max > -1) {
    	$sql .= $HUB_SQL->APILIB_CONNECTIONS_BY_ACTIVE_USERS_SELECT_PART3;
    	$sql = $DB->addLimitingResults($sql, $start, $max);
    }
    else {
    	$sql .= $HUB_SQL->APILIB_CONNECTIONS_BY_ACTIVE_USERS_SELECT_PART3B;
    }

	$resArray = $DB->select($sql, $params);

    $us = new UserSet();
	$count = count($resArray);
	$us->totalno = $count;
	$us->start = $start;
	$us->count = $count;
	for ($i=0; $i<$count; $i++) {
		$array = $resArray[$i];
		$u = new User($array["UserID"]);
		$us->add($u->load($style));
		$u->connectioncount = $array["num"];
	}

    return $us;
}

/**
 * Get the users with the most ideas (excludes groups)
 * If filtering by group, premissions include private ideas visible to group, otherwise it only inlcude public ideas
 *
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a users details to load (long includes: tags and groups).
 * @param String $groupid (optional - default '') any group to filter results on
 * @return UserSet or Error
 */
function getActiveIdeaUsers($start = 0,$max = 20,$style='long',$groupid) {
    global $CFG,$USER,$DB,$HUB_SQL;

	$params = array();

	$sql = $HUB_SQL->APILIB_NODES_BY_ACTIVE_USERS_SELECT;

    if ($groupid != "") {

		$params[0] = $groupid;
		$params[1] = $groupid;
    	$params[2] = $USER->userid;
    	$params[3] = $USER->userid;

        $sql .= $HUB_SQL->APILIB_NODES_BY_ACTIVE_USERS_SELECT_PART2A;
	} else {
        $sql .= $HUB_SQL->APILIB_NODES_BY_ACTIVE_USERS_SELECT_PART2B;
    }

    if ($max > -1) {
    	$sql .= $HUB_SQL->APILIB_NODES_BY_ACTIVE_USERS_SELECT_PART3;
    	$sql = $DB->addLimitingResults($sql, $start, $max);
    }
    else {
    	$sql .= $HUB_SQL->APILIB_NODES_BY_ACTIVE_USERS_SELECT_PART3;
    }

	$resArray = $DB->select($sql, $params);

    $us = new UserSet();
	$count = count($resArray);
	$us->totalno = $count;
	$us->start = $start;
	$us->count = $count;
	for ($i=0; $i<$count; $i++) {
		$array = $resArray[$i];
		$u = new User($array["UserID"]);
		$us->add($u->load($style));
		$u->ideacount = $array["num"];
	}

    return $us;
}

/**
 * Get a user
 *
 * @param string $userid
 * @param string $format (optional - default 'long') may be 'short' or 'long'
 * @return User or Error
 */
function getUser($userid,$format='long'){
    $u = new User($userid);
    return $u->load($format);
}

/**
 * Get the users for given user (bascially means any groups they are in)
 *
 * @param string $userid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags and groups).
 * @return UserSet or Error
 */
function getUsersByUser($userid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC',$style='long'){
    global $HUB_SQL;

	$params = array();
	$params[0] = $userid;

    $sql = $HUB_SQL->APILIB_USERS_BY_USER;

    $us = new UserSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the users for given group
 *
 * @param string $groupid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags and groups).
 * @return UserSet or Error
 */
function getUsersByGroup($groupid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC',$style='long'){
    global $HUB_SQL;

	$params = array();
	$params[0] = $groupid;

    $sql = $HUB_SQL->APILIB_USERS_BY_GROUP;

    $us = new UserSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Search users.
 * If in speech marks searches LIKE match on phrase, else splits on spaces and searches OR on elements
 *
 * @param string $q the query term(s)
 * @param string $scope (must be 'all' or 'my')
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags and groups).
 * @return NodeSet or Error
 */
function getUsersBySearch($q,$scope,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC',$style='long'){

	global $DB;

	$params = array();

    /*$q = trim($q);
    $q = htmlspecialchars_decode($q, ENT_QUOTES);
    $len = strlen($q);
    $startChar = mb_substr($q, 0, 1);
    $lastChar = mb_substr($q, $len-1, $len);

    $sql = "SELECT t.UserID FROM Users t WHERE ";

    if ($startChar == "\"" && $lastChar == "\"") {
    	$q = mb_substr($q, 1, $len-2);
    	$sql .= "t.Name LIKE ('%".$DB->cleanString($q)."%')".
        	"OR t.Description LIKE ('%".$DB->cleanString($q)."%')";
    } else {
    	$pieces = explode(" ", $q);
    	$loopCount = 0;
    	foreach ($pieces as $value) {
    		if ($loopCount == 0) {
    		    $search .= "t.Name LIKE ('%".$DB->cleanString($value)."%')";
    		} else {
    		    $search .= " OR t.Name LIKE ('%".$DB->cleanString($value)."%')";
    		}
		    $search .=" OR t.Description LIKE ('%".$DB->cleanString($value)."%')";

    		$loopCount++;
    	}
        $sql .= "( ".$search." )";
    }*/

    $sql = "SELECT DISTINCT t.UserID FROM Users t
        	LEFT JOIN TagUsers tn ON t.UserID = tn.UserID
        	LEFT JOIN Tag u ON u.tagID = tn.TagID
        	WHERE u.Name LIKE('%".$DB->cleanString($q)."%')".
           " OR t.Name LIKE ('%".$DB->cleanString($q)."%')".
            " OR t.Description LIKE ('%".$DB->cleanString($q)."%')";

    $us = new UserSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the users for nodes with the node label of the given nodeid
 *
 * @param string $nodeid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags and groups).
 * @return UserSet or Error
 */
function getUsersByNode($nodeid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC',$style='long'){

	$params = array();

	$list = getAggregatedNodeIDs($nodeid);
	if ($list != "") {
		$sql = "SELECT t.UserID FROM Users t
	            WHERE t.UserID IN (SELECT UserID FROM Node WHERE NodeID IN (".$list."))
	            OR t.UserID IN (SELECT GroupID FROM NodeGroup WHERE NodeID IN (".$list."))";
	    $us = new UserSet();
	    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
	} else {
		return new UserSet();
	}
}

/**
 * Get the users for given url
 *
 * @param string $url
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags and groups).
 * @return UserSet or Error
 */
function getUsersByURL($url,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC',$style='long'){

	$params = array();

    $sql = "SELECT t.UserID FROM URL t
            WHERE t.URL = '".$url."'
            AND (t.Private='N' OR t.UserID = '".$USER->userid."')";


    $us = new UserSet();
    return $us->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Check that the session is active and valid for the user passed.
 * @param string $userid
 * @return User or Error
 */
function validateUserSession($userid){
    global $USER, $LNG;

	$validateSession = validateSession($userid);

	if(strcmp($validateSession,$LNG->CORE_SESSION_OK) != 0) {
		$ERROR = new Hub_Error;
		$ERROR->createValidateSessionError($validateSession);
		return $ERROR;
    }

    $user = $USER;

    return $user;
}

/**
 * Logs a user in.
 *
 * @param string $username
 * @param string $password
 * @return User or Error
 */
function login($username,$password){
	global $CFG;

    if($password == "" || $username == ""){
       $ERROR = new Hub_Error;
       $ERROR->createLoginFailedError();
       return $ERROR;
    }

    $user = userLogin($username,$password);
    if($user instanceof Hub_Error){
       	return $user;
    } else if ($user instanceof User) {
    	$user->setPHPSessID(session_id());
    	return $user;
	} else {
        $ERROR = new Hub_Error();
        return $ERROR->createLoginFailedError();
	}
}

///////////////////////////////////////////////////////////////////
// functions for feeds
///////////////////////////////////////////////////////////////////
/**
 * Add a new feed. Requires login.
 *
 * @param string $url
 * @param string $name
 * @param string $regular - optional, can be 'Y' or 'N' (default N) and indicates whether Cohere should regularly call the feed to update
 * @return Feed or Error
 */
function addFeed($url, $name, $regular='N'){
    $f = new Feed();
    $feed = $f->add($url,$name,$regular);
    return $feed;
}

/**
 * Refresh feed. Requires login and user must be owner of the feed.
 *
 * @param string $feedid
 * @return Feed or Error
 */
function refreshFeed($feedid){
    $f = new Feed($feedid);
    $feed->load();
    $errors = array();
    $log = array();
    return $f->refresh($errors,$log);
}

/**
 * Gets all feeds for user. If userid not specified then the current user is assumed.
 *
 * @param string $userid
 * @return Feed or Error
 */
function getFeedsForUser($userid = ""){
    global $USER;

	$params = array();

    if($userid==""){
        $userid = $USER->userid;
    }
    $sql = "SELECT t.FeedID FROM Feeds t
            WHERE t.UserID = '".$userid."'";

    $fs = new FeedSet();
    return $fs->load($sql,$params);
}

/**
 * Change whether or not the feed is regularly updated. Requires login and user must be owner of the feed.
 *
 * @param string $feedid
 * @param string $regular
 * @return Feed or Error
 */
function feedSetRegular($feedid,$regular){
    $f = new Feed($feedid);
    $f->load();
    return $f->updateRegular($regular);
}


/**
 * Delete a feed. Requires login and user must be owner of the feed.
 *
 * @param string $feedid
 * @return Result or Error
 */
function deleteFeed($feedid){
    $f = new Feed($feedid);
    $f->load();
    return $f->delete();
}

///////////////////////////////////////////////////////////////////
// functions for user session cache (Bookmarks)
///////////////////////////////////////////////////////////////////
/**
 * Searches user cache nodes (bookmarks). Login required.
 *
 * @param string $q the query term(s)
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getUserCacheNodes($start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC', $style='long'){
    global $CFG,$USER;

	$params = array();

    $sql = "SELECT g.NodeID FROM Node g LEFT JOIN UsersCache t ON g.NodeID = t.NodeID ".
            "WHERE t.UserId='".$USER->userid.
            "'";

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort);
}

/**
 * Add item to users cache (bookmarks). Login required.
 *
 * @param string $idea the id of the idea to add
 * @return UserCache or Error
 */
function addToUserCache($idea){
    $c = new UsersCache();
    return $c->add($idea);
}

/**
 * Delete item from users cache (bookmarks). Login required.
 *
 * @param string $idea the id of the idea to delete
 * @return UserCache or Error
 */
function deleteFromUserCache($idea){
    $c = new UsersCache();
    return $c->delete($idea);
}

/**
 * Get whats in the users cache (bookmarks). Login required.
 * @return UserCache or Error
 */
function getUserCache(){
    return new UsersCache();
}

/**
 * Empties the users cache (bookmarks). Login required.
 * @return UserCache or Error
 */
function clearUserCache(){
    $c = new UsersCache();
    return $c->clear();
}

///////////////////////////////////////////////////////////////////
// Twitter Functions
///////////////////////////////////////////////////////////////////

/**
 * Tweet the idea with the given nodeid to the current user's twitter accounts, if setup.
 * @param $nodeid the id of the idea to tweet.
 */
function tweetUserIdea($nodeid) {
    global $DB, $USER,$CFG;

    $key = $USER->getTwitterKey();
    $secret = $USER->getTwitterSecret();

 	$node = new CNode($nodeid);
	$node->load();
 	if ($node->private == "N") {
 		if ($key  != "" && $secret != "") {

			$twitterURL = $CFG->homeAddress."node.php?nodeid=".$nodeid."#conn-neighbour";

			//add the idea user name to the tweet only if it is not an idea by the current user.
			$ideauser = $node->users[0]->name;
			if ($node->users[0]->userid == $USER->userid) {
				$ideauser = "";
			}

			$reply = tweet($node->name, $ideauser, $twitterURL, $key, $secret, "#cohereweb");

			return $reply;
		} else {
			return tweet_error("Please authorize Cohere with your Twitter account through your Cohere profile");
		}
 	} else {
		return tweet_error("The idea cannot be Tweeted as it is Private");
 	}
}

///////////////////////////////////////////////////////////////////
// logging functions
///////////////////////////////////////////////////////////////////
/**
 * Add to the log
 * @param string $action
 * @param string $type
 * @param string $id
 * @return Result or Error
 */
function addToLog($action,$type,$id){
    $l = new Log();
    return $l->add($action,$type,$id);
}


/////////////////////////////////////////////////////////////////////
// COHERE SPECIFIC
/////////////////////////////////////////////////////////////////////


/**
 * Get the nodes for given node. This returns the other nodes which share the same label as the given node (but will have been entered by another user).
 *
 * @param string $nodeid
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesByNode($nodeid,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC', $filternodetypes="", $style='long'){
    global $CFG,$USER,$HUB_SQL;

	$params = array();

	$list = getAggregatedNodeIDs($nodeid);
    if ($list != "") {
	    $sql = "SELECT t.NodeID,
	                (SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
	                (SELECT COUNT(ToID) FROM Triple WHERE ToiD=t.NodeID) AS connectedness
	            FROM Node t ";


    if ($filternodetypes != "") {
        $pieces = explode(",", $filternodetypes);
        $loopCount = 0;
        $searchNodeTypes = "";
        foreach ($pieces as $value) {
            if ($loopCount == 0) {
            	$searchNodeTypes .= "'".$value."'";
            } else {
            	$searchNodeTypes .= ",'".$value."'";
            }
            $loopCount++;
        }

        $sql .= "LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID ";
	    $sql .= "WHERE nt.Name IN (".$searchNodeTypes.") AND ";
    }  else {
        $sql .= "WHERE ";
    }

	$sql .= "t.NodeID IN (".$list.") ".
	            " AND (
	            (t.Private = 'N')
	             OR
	            (t.UserID = '".$USER->userid."') ". // the current user
	            " OR
	            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
	                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
	                         WHERE ug.UserID = '".$USER->userid."')". // the current user
	            "))";
	    $ns = new NodeSet();
	    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style);
    } else {
    	return new NodeSet();
    }
}

/**
 * Get the nodes for given comma separated list of node ids
 *
 * @param string $nodeids a comma separated list of node ids to get the nodes for.
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getMultiNodes($nodeids,$start = 0,$max = 20 ,$orderby = 'date',$sort ='ASC', $style='long') {
    global $CFG,$USER;

	$params = array();

	$pieces = explode(",", $nodeids);
	$loopCount = 0;
	$nodestring = "";
	foreach ($pieces as $value) {
		if ($loopCount == 0) {
			$nodestring .= "'".$value."'";
		} else {
			$nodestring .= ",'".$value."'";
		}
		$loopCount++;
	}

    $sql = "SELECT t.NodeID,
                (SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
                (SELECT COUNT(ToID) FROM Triple WHERE ToiD=t.NodeID) AS connectedness
            FROM Node t
            WHERE t.NodeID IN (".$nodestring.") ".
            " AND (
            (t.Private = 'N')
             OR
            (t.UserID = '".$USER->userid."') ".
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')". // the current user
            "))";

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Search nodes.
 * If in speech marks searches LIKE match on phrase, else splits on spaces and searches OR on elements
 *
 * @param string $q the query term(s)
 * @param string $scope (optional, either 'my' or 'all' - default: 'all')
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesBySearch($q,$scope,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC', $filternodetypes="",$style='long'){
    global $CFG,$USER,$DB;

	$params = array();

    /*$q = trim($q);
    $q = htmlspecialchars_decode($q, ENT_QUOTES);
    $len = strlen($q);
    $startChar = mb_substr($q, 0, 1);
    $lastChar = mb_substr($q, $len-1, $len);
    $sql = "SELECT t.NodeID,
        (SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
        (SELECT COUNT(ToID) FROM Triple WHERE ToiD=t.NodeID) AS connectedness
        FROM Node t WHERE ";

    if ($startChar == "\"" && $lastChar == "\"") {
    	$q = mb_substr($q, 1, $len-2);
        $sql .= "(t.Name LIKE('%".$DB->cleanString($q)."%')".
        		" OR t.Description LIKE ('%".$DB->cleanString($q)."%'))";
    } else {
    	$pieces = explode(" ", $q);
    	$loopCount = 0;
    	foreach ($pieces as $value) {
    		if ($loopCount == 0) {
    		    $search .= "(t.Name LIKE('%".$DB->cleanString($value)."%')".
                			" OR t.Description LIKE ('%".$DB->cleanString($value)."%'))";
    		} else {
    			$search .= " OR (t.Name LIKE('%".$DB->cleanString($value)."%')".
                			" OR t.Description LIKE ('%".$DB->cleanString($value)."%'))";
    		}
    		$loopCount++;
    	}
		$sql .= "( ".$search." )";
    }*/

    $sql = "SELECT DISTINCT t.NodeID,
                (SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
                (SELECT COUNT(ToID) FROM Triple WHERE ToiD=t.NodeID) AS connectedness
            FROM Node t
            LEFT JOIN TagNode ut ON t.NodeID = ut.NodeID
            LEFT JOIN Tag u ON u.tagID = ut.TagID ";

    if ($filternodetypes != "") {
        $pieces = explode(",", $filternodetypes);
        $loopCount = 0;
        $searchNodeTypes = "";
        foreach ($pieces as $value) {
            if ($loopCount == 0) {
            	$searchNodeTypes .= "'".$value."'";
            } else {
            	$searchNodeTypes .= ",'".$value."'";
            }
            $loopCount++;
        }

        $sql .= "LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID ";
	    $sql .= "WHERE nt.Name IN (".$searchNodeTypes.") AND ";
    } else {
	    $sql .= "WHERE ";
    }

    $sql .= " (u.Name LIKE('%".$DB->cleanString($q)."%')".
            " OR t.Name LIKE('%".$DB->cleanString($q)."%')".
            " OR t.Description LIKE ('%".$DB->cleanString($q)."%'))";

    if($scope == 'my'){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND (
            (t.Private = 'N')
             OR
            (t.UserID = '".$USER->userid."') ". // the current user
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')". // the current user
            "))";

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style);
}

/**
 * Get the nodes for given urlid
 *
 * @param string $urlid the id of the url to get nodes for
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesByURLID($urlid,$start = 0,$max = 20 ,$orderby = 'date', $sort ='ASC', $style='long'){
    global $USER,$CFG;

	$params = array();

    $sql = "SELECT DISTINCT t.NodeID,
                (SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
                (SELECT COUNT(ToID) FROM Triple WHERE ToID=t.NodeID) AS connectedness
            FROM Node t
            INNER JOIN URLNode ut ON t.NodeID = ut.NodeID
            INNER JOIN URL u ON u.URLID = ut.URLID
            WHERE u.URLID = '".$urlid."'
            AND (u.Private = 'N' OR u.UserID = '".$USER->userid."')
            AND (
            (t.Private = 'N')
             OR
            (t.UserID = '".$USER->userid."') ". // the current user
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')". // the current user
            "))";

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style,$style);
}

/**
 * Get the nodes for given tagname
 *
 * @param string $tagname
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @return NodeSet or Error
 */
function getNodesByTagName($tagname, $start = 0,$max = 20 ,$orderby = 'date', $sort ='ASC', $style='long'){
    global $USER,$CFG;

	$params = array();

    $sql = "SELECT DISTINCT t.NodeID,
                (SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
                (SELECT COUNT(ToID) FROM Triple WHERE ToID=t.NodeID) AS connectedness
            FROM Node t
            INNER JOIN TagNode ut ON t.NodeID = ut.NodeID
            INNER JOIN Tag u ON u.tagID = ut.TagID
            WHERE u.Name = '".$tagname."'
            AND (
            (t.Private = 'N')
             OR
            (t.UserID = '".$USER->userid."') ". // the current user
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')". // the current user
            "))";

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style,$style);
}

/**
 * Search nodes by their tags
 * splits on commas and searches OR on elements
 *
 * @param string $q the query term(s)
 * @param string $scope (optional, either 'my' or 'all' - default: 'all')
 * @param integer $start (optional - default: 0)
 * @param integer $max (optional - default: 20)
 * @param string $orderby (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')
 * @param string $sort (optional, either 'ASC' or 'DESC' - default: 'DESC')
 * @param string $filternodetypes (optional, a list of node type names to filter by)
 * @param String $style (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).
 * @param string $groupid (optional, the id of the user group to filter by)
 * @return NodeSet or Error
 */
function getNodesByTagSearch($q,$scope,$start = 0,$max = 20 ,$orderby = 'date',$sort ='DESC', $filternodetypes='', $groupid='', $style='long'){
    global $CFG,$USER,$DB;

	$params = array();

    $sql = "SELECT DISTINCT t.NodeID,
        (SELECT COUNT(FromID) FROM Triple WHERE FromID=t.NodeID)+
        (SELECT COUNT(ToID) FROM Triple WHERE ToiD=t.NodeID) AS connectedness
        FROM Node t
        LEFT JOIN TagNode ut ON t.NodeID = ut.NodeID
        LEFT JOIN Tag u ON u.TagID = ut.TagID ";

    if ($filternodetypes != "") {
        $pieces = explode(",", $filternodetypes);
        $loopCount = 0;
        $searchNodeTypes = "";
        foreach ($pieces as $value) {
            if ($loopCount == 0) {
            	$searchNodeTypes .= "'".$value."'";
            } else {
            	$searchNodeTypes .= ",'".$value."'";
            }
            $loopCount++;
        }

        $sql .= "LEFT JOIN NodeType nt ON t.NodeTypeID = nt.NodeTypeID ";
	    $sql .= "WHERE nt.Name IN (".$searchNodeTypes.") AND ";
    } else {
	    $sql .= "WHERE ";
    }

   	$pieces = explode(",", $q);
   	$loopCount = 0;
   	$search = "";
   	foreach ($pieces as $value) {
		$value = trim($value);
   		if ($loopCount == 0) {
   		    $search .= "u.Name ='".$DB->cleanString($value)."'";
   		} else {
   			$search .= " OR u.Name ='".$DB->cleanString($value)."'";
   		}
   		$loopCount++;
   	}
	$sql .= "( ".$search." )";

    if($scope == 'my'){
        $sql .= " AND t.UserID = '".$USER->userid."'";
    }
    $sql .= " AND (
            (t.Private = 'N')
             OR
            (t.UserID = '".$USER->userid."') ". // the current user
            " OR
            (t.NodeID IN (SELECT tg.NodeID FROM NodeGroup tg
                         INNER JOIN UserGroup ug ON ug.GroupID=tg.GroupID
                         WHERE ug.UserID = '".$USER->userid."')". // the current user
            "))";

	if ($groupid != "") {
		$sql .= " AND t.NodeID IN (SELECT NodeID FROM NodeGroup Where GroupID='".$groupid."')";
	}

    $ns = new NodeSet();
    return $ns->load($sql,$params,$start,$max,$orderby,$sort,$style);
}



// ensure there are no spaces or blank lines after this closing tag
?>