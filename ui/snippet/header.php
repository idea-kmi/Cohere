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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>
Cohere >>> make the connection
</title>
<link rel="stylesheet" href="<?php echo $CFG->homeAddress; ?>ui/styles/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $CFG->homeAddress; ?>ui/styles/node.css" type="text/css" media="screen" />
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/prototype.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/dateformat.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/jsr_class.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/util.php" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/node.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/urls.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/conns.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/users.js" type="text/javascript"></script>

<?php
	$snippetType = required_param("snippet", PARAM_INT);
	$context = required_param("context",PARAM_TEXT);

    $connid = optional_param("connid", "", PARAM_TEXT);
    $userid = optional_param("userid", "", PARAM_TEXT);
    $nodeid = optional_param("nodeid", "", PARAM_TEXT);
    $urlid = optional_param("urlid", "", PARAM_TEXT);
    $url = optional_param("url", "", PARAM_TEXT);
    $groupid = optional_param('groupid', "",PARAM_TEXT);
    $query = optional_param('q', "", PARAM_TEXT);
    $focalnode = optional_param('focalnode',"",PARAM_TEXT);

    $scope = optional_param('scope','all',PARAM_TEXT);
    $start = optional_param("start",0,PARAM_INT);
    $max = optional_param("max",20,PARAM_INT);
    $orderby = optional_param("orderby","date",PARAM_ALPHA);
    $sort = optional_param("sort","DESC",PARAM_ALPHA);

    $args = array();
    if ($connid != "") {
	   	$args["connid"] = $connid;
	}
    if ($userid != "") {
	   	$args["userid"] = $userid;
	}
    if ($nodeid != "") {
	   	$args["nodeid"] = $nodeid;
	}
    if ($urlid != "") {
	   	$args["urlid"] = $urlid;
	}
    if ($url != "") {
	   	$args["url"] = $url;
	}
    if ($groupid != "") {
	   	$args["groupid"] = $groupid;
	}
	if ($q != "") {
   		$args["q"] = $query;
   	}
	if ($focalnode != "") {
	   	$args["focalnode"] = $focalnode;
	}

   	$args["scope"] = $scope;
    $args["start"] = $start;
    $args["max"] = $max;
    $args["orderby"] = $orderby;
    $args["sort"] = $sort;

	// trigger the js to load data
    $argsStr = "{";
    $keys = array_keys($args);
    for($i=0;$i< count($keys); $i++){
        $argsStr .= '"'.$keys[$i].'":"'.$args[$keys[$i]].'"';
        if ($i != (count($keys)-1)){
            $argsStr .= ',';
        }
    }
    $argsStr .= "}";

	echo "<script type='text/javascript'>";

	echo "var CONTEXT = '".$context."';\n";
	echo "var SNIPPET_TYPE = ".$snippetType.";\n";
	echo "var NODE_ARGS = ".$argsStr.";\n";
	echo "var CONN_ARGS = ".$argsStr.";\n";
	echo "var NEIGHBOURHOOD_ARGS = ".$argsStr.";\n";
	echo "var NET_ARGS = ".$argsStr.";\n";
	echo "var URL_ARGS = ".$argsStr.";\n";
	echo "var USER_ARGS = ".$argsStr.";\n";

	$role = $CFG->DEFAULT_NODE_TYPE;
	$defaultRole = new Role();
	$defaultRole->loadByName($role);
	$roleimage = $CFG->homeAddress.$defaultRole->image;

	echo "var defaultRoleImage = '".$roleimage."';\n";
	echo "var defaultRoleName = '".$CFG->DEFAULT_NODE_TYPE."';\n";

	echo "</script>\n";
?>
<script type='text/javascript'>

	function displayContext() {
		SNIPPET_URL_ROOT = getURL(SNIPPET_TYPE);
		if (SNIPPET_URL_ROOT != "") {
			window.open(SNIPPET_URL_ROOT);
		} else {
			alert("Url could not be created");
		}
	}

	function displayURL() {
		showURL(SNIPPET_TYPE);
	}

	function displaySnippet() {
		var id = null;
		if (SNIPPET_TYPE == SNIPPET_IDEA) {
			id = NODE_ARGS['nodeid'];
		} else if (SNIPPET_TYPE == SNIPPET_TRIPLE) {
			id = CONN_ID;
		}
		showSnippet(SNIPPET_TYPE, id);
	}
</script>
</head>
<body>
<div id="snippetdiv">

