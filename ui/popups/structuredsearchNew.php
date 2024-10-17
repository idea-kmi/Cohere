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
    include_once("../../config.php");

	checkLogin();

    global $USER, $CFG;

    include_once($CFG->dirAddress."ui/dialogheader.php");

	$searchid = optional_param("searchid", "", PARAM_ALPHANUM);
	$searchname = optional_param("searchname", "Search Name", PARAM_TEXT);

	$scope = optional_param("scope", "all", PARAM_ALPHA);
	$focalnodeid = optional_param("focalnodeid", "", PARAM_ALPHANUM);
	$labelmatch = optional_param("labelmatch", 'false', PARAM_BOOLTEXT);
	$uniquepath = optional_param("uniquepath", 'false', PARAM_BOOLTEXT);
	$logictype = optional_param("uniquepath", 'or', PARAM_ALPHA);

	// form submitted.
	$nodeids = optional_param("nodeids", "", PARAM_ALPHANUM);
    $directionArray = optional_param("direction","",PARAM_TEXT);
    $linkgroupArray = optional_param("linkgroup","",PARAM_TEXT);
    $linksetArray = optional_param("linkset","",PARAM_TEXT);
    $selectedlinksArray = optional_param("selectedlinks","",PARAM_TEXT);
    $selectedrolesArray = optional_param("selectedroles","",PARAM_TEXT);
	$textareaselectedrolesArray = optional_param("textareaselectedroles","",PARAM_TEXT);

	/*if ($linkgroup != "") {
		$links = "";
		$checklist = "";
		$linkset = "";
	}

	if ($linkset != "") {
		$links = "";
		$checklist = "";
		$linkgroup = "";
	}

	if ($depth > 7) {
		$depth = 7;
	}

	$linklist = "";
	if ($checklist != "" && is_countable($checklist)) {
		for($i =0 ; $i<count($checklist); $i++){
			if($checklist[$i] != ""){
			   if ($linklist == "") {
				   $linklist = $checklist[$i];
			   } else {
				   $linklist .= ",".$checklist[$i];
			   }
			}
		}

	}

	if ($links == "" && $linklist != "") {
		$links = $linklist;
	}*/

	//echo "set=".$linkset;
	//echo "group=".$linkgroup;

	if(isset($_POST["addsearch"])){
			$search = new Search();

			if ($searchname == "") {
				echo "You must give the search a name";
				die;
			}

			$search = $search->add($searchname, $scope, $depth, $focalnodeid, $linklist, $linkgroup, $linkset, $direction, $labelmatch);
            // refresh parent window then close
            echo "<script type='text/javascript'>";
            echo "if (window.opener.refreshSearchList) { window.opener.refreshSearchList(); ";
            echo "} else if (window.opener.opener && window.opener.opener.refreshSearchList) { window.opener.opener.refreshSearchList(); }";
            echo 'window.close();';
            echo '</script>';
            include_once($CFG->dirAddress."ui/dialogfooter.php");
            die;

	} else if($searchid != "" && isset($_POST["savesearch"])){

	        // check user can edit this search
			if ($searchname == "") {
				echo "You must give the search a name";
				die;
			}

			$search = new Search($searchid);
			$search->load();
	        try {
	            $search->canedit();
	        } catch (Exception $e){
	            echo "You do not have permissions to edit this network search";
	            die;
	        }

			$search->edit($searchname, $scope, $depth, $focalnodeid, $linklist, $linkgroup, $linkset, $direction, $labelmatch);

            // refresh parent window then close
            echo "<script type='text/javascript'>";
            echo "if (window.opener.refreshSearchList) { window.opener.refreshSearchList(); ";
            echo "} else if (window.opener.opener && window.opener.opener.refreshSearchList) { window.opener.opener.refreshSearchList(); }";
            echo 'window.close();';
            echo "</script>";
            include_once($CFG->dirAddress."ui/dialogfooter.php");
            die;
	} else {
		$focalnode = null;

		// load data if editing an existing search
		if ($searchid != "") {
			$search = new Search($searchid);
			$search->load();

			if (!$search instanceof Search){
				echo "Search not found";
				die;
			}

			// check user can edit this search
			try {
				$search->canedit();
			} catch (Exception $e){
				echo "You do not have permissions to edit this Search";
				die;
			}

			$links = $search->linktypes;
			$linkgroup = $search->linkgroup;
			$linkset = $search->linkset;
			$scope = $search->scope;
			$focalnodeid = $search->focalnodeid;
			$focalnode = $search->focalnode;
			$depth = $search->depth;
			$searchname = $search->name;
			$direction = $search->direction;
			$labelmatch = $search->labelmatch;

			$linklist=null;
			if ($links != null && $links != "") {
				$linklist = explode(",", $links);
			}
		}
	}

	if ($focalnode == null && $focalnodeid != "") {
		$focalnode = new CNode($focalnodeid);
		$focalnode->load();
	}

	$linkTypeFilterList = array();
	if ($linklist != null) {
		foreach ($linklist as &$value) {
			$linkTypeFilterList[$value] = $value;
		}
	}

	$rs = getAllLinkTypes();
	$linktypes = $rs->linktypes;
?>

<script type="text/javascript">

	var SERVICE_ROOT = "<?php echo $CFG->homeAddress."api/service.php?format=json"; ?>";
	var URL_ROOT = "<?php echo $CFG->homeAddress; ?>";
   	var roles = null;
   	var linktypes = null;
   	var role0 = null;
   	var node0 = null;
   	var noSearchDepth = 1;
   	var nodes = new Array();


   	function init(){

	    $('dialogheader').insert('Network Search Builder - By Depth');

		addDepth();

		<?php if ($focalnode) {
			$jsonIdea0 = json_encode($focalnode);
			echo "node0 = ";
			echo $jsonIdea0;
			echo ";";
		}
		?>

		if (node0 != null) {
			node0.depth = 0;
			loadConnectionNodeInternal(node0);
		} else {
			renderFakeNode();
		}

	}

	function showLinkConnectionSearchMessage(evt, panelName) {

		var event = evt || window.event;
		var thing = event.target || event.srcElement;

		$("connectionSearchHintMessage").innerHTML="";
		var sometext = document.createTextNode("These are predefined sets of link types using the default link types we provide. When selecting from the list each set will display its link types.");
		$("connectionSearchHintMessage").appendChild(sometext);

		showHint(event, panelName, 30, -40);
	}

	function showMessage(evt, panelName) {

		var event = evt || window.event;
		var thing = event.target || event.srcElement;

		if (panelName == "labelmatchhint") {
			$("labelMatchHintMessage").innerHTML="";
			var sometext = document.createTextNode("Include Ideas with the same Idea label text as matched Ideas. If this option not selected, match on exact Idea ids only");
			$("labelMatchHintMessage").appendChild(sometext);
		} else if (panelName == 'unqiuepathhint') {
			$("uniquePathHintMessage").innerHTML="";
			var sometext = document.createTextNode("If this is selected, connections cannot be navigated twice when following paths. If this is not selected the same connection can be considered for matching at more than one depth (effectively the path can double back as long as the rules still apply)");
			$("uniquePathHintMessage").appendChild(sometext);
		} else if (panelName == 'typehint') {
			$("typeHintMessage").innerHTML="";
			var sometext = document.createTextNode("If you choose OR, then connections matching the criteria at each depth will be kept in the results, even if a given path fails to find matches at later depths. If you choose AND, the connections kept in the results will only be for paths that match the criteria at all depths.");
			$("typeHintMessage").appendChild(sometext);
		}
		showHint(event, panelName, 0, 0);
	}

	function runNetworkSearch() {

		if (node0 == null) {
			alert("You must select an idea first");
			return;
		}

		//var direction = document.structuredsearch.elements["direction[]"];
		var linkgroups = document.structuredsearch.elements["linkgroup[]"];
		var linksets = document.structuredsearch.elements["linkset[]"];
		var selectedlinks = document.structuredsearch.elements["selectedlinks[]"];
		//var selectedroles = document.structuredsearch.elements["selectedroles[]"];

		var depth = selectedlinks.length;
		for(i=0;i<depth;i++) {
			if (selectedlinks[i].value == "" && linksets[i].value == "" && linkgroups[i].value == "") {
				alert("You must select links to search on for each depth");
				return;
			}
		}

		var frm = document.forms["structuredsearch"];
		var newURL = URL_ROOT+"networksearchNew.php";

		frm.target = window.opener.name;
		//frm.onsubmit = window.self.close();
      	frm.action = newURL;
      	frm.submit();
      	return;
	}

   /**
    * Load the node data into the currently selected idea.
    */
   function loadConnectionNode(node, role) {
   		node.role = role;
	    loadConnectionNodeInternal(node);
   }

   /**
    * Load the node data into the indicated idea.
    */
   function loadConnectionNodeInternal(node) {

	   	var blobNode = renderNode(node, "node"+node.depth, node.role, false, 'inactive');

       	$('ideadivarea'+node.depth).innerHTML = "";
       	$('ideadivarea'+node.depth).insert(blobNode);

		if (node.depth == 0) {
	   		$('focalnodeid').value = node.nodeid;
	   	}

		$('nodeids'+node.depth).value = node.nodeid;
		$('selectedroles'+node.depth).value = '';

       	$('removeidea'+node.depth).style.visibility = "visible";

	   	nodes[node.depth] = node;
    }


	/**
	* Remove the node at the given position and replace with blank node.
	*/
	function removeFocalNode() {
	   renderFakeNode();
	}

   /**
	* Remove the node at the given position and replace with blank node.
	*/
	function removeNode(depth) {
	   renderFakeNodeToDepth(depth);
	}

	function renderFakeNodeToDepth(depth) {

	   	var iDiv = new Element("div", {'class':'idea-container-fake'});
	   	var ihDiv = new Element("div", {'class':'idea-header-fake'});
	   	var itDiv = new Element("div", {'class':'idea-title-fake'});
	   	ihDiv.insert(itDiv);

	   	var clearDiv = new Element("div", {'style':'clear: both;'});
		ihDiv.insert(clearDiv);
	   	iDiv.insert(ihDiv);

		itDiv.update('Idea Types:<a style="margin-left: 5px;" title="Open the idea selector" href="#" onclick="showNodeTypeSelector('+depth+')">Choose Type(s)</a>');

		iDiv.insert('<input type="hidden" id="selectedroles"'+depth+' name="selectedroles[]" value="" />');
	   	var textarea = new Element("textarea", {'rows':'2', 'name':'textareaselectedroles[]', 'id':'textareaselectedroles'+depth, 'readonly':'readonly', 'value':'All', 'style':'width:100%;font-size: 10pt;font-family: Arial, Helvetica, sans-serif; color: #308D88;border:1px solid gray; background: transparent;'});
		itDiv.insert(textarea);
		textarea.value='All';

		if (depth == 0) {
	   		$('focalnodeid').value = "";
	   	}
		$('nodeids'+depth).value = '';

		nodes[depth] = null;

		$('ideadivarea'+depth).innerHTML = "";
		$('ideadivarea'+depth).insert(iDiv);

        $('removeidea'+depth).style.visibility = "hidden";
	}

    /**
     * For when a node has no connections at one end or both.
     */
    function renderFakeNode(){
       $('removeidea0').style.visibility = "hidden";

	   	var iDiv = new Element("div", {'class':'idea-container-fake'});
	   	var ihDiv = new Element("div", {'class':'idea-header-fake'});
	   	var itDiv = new Element("div", {'class':'idea-title-fake'});
   		itDiv.update('Select CENTRAL IDEA to search from<br/><br />Use Idea Selector - click link on right');
		//itDiv.insert("<a href='#' onclick='javascript:toggleNodePicker()'>Click to view Idea Picker</a>");

	   	ihDiv.insert(itDiv);

	   	var iwDiv = new Element("div", {'class':'idea-wrapper'});
	   	var imDiv = new Element("div", {'class':'idea-main'});
		iwDiv.style.background = "transparent";

	   	iwDiv.insert(imDiv);

	   	iDiv.insert(ihDiv);
	   	iDiv.insert('<div style="clear:both;"></div>');
	   	iDiv.insert(iwDiv);

		//iDiv.insert('<input type="hidden" id="nodeids0" name="nodeids[]" value="" />';

	   	$('focalnodeid').value = "";
		$('nodeids0').value = '';
   		node0 = null;
	    $('ideadivarea0').innerHTML = "";
    	$('ideadivarea0').insert(iDiv);
    }

/**
 * Remove the given multiple for the given type at the given index
 */
function removeDepth(num) {

	var answer = confirm("Are you sure you want to remove depth '"+num+"' from the search?\n\nThis action cannot be undone!\n");
    if(answer) {
		if ($('searchdepth'+num)) {
			$('searchdepth'+num).remove();
			noSearchDepth--;
		}

		$('depthbutton').style.display = "block";

		if ((num) > 2) {
			$('removedepth'+(num-1)).style.visibility = 'visible';
		}

    }
}

function addDepth(direction, linkset, linkgroup, roles, links){

	var newitem =  '<div id="searchdepth'+noSearchDepth+'">';
	newitem += '<div style="clear:both;" class="link-top-arrow" id="linktop'+noSearchDepth+'"></div>';
	newitem += '<div id="link">';
	newitem += '<fieldset style="border: none; padding: 5px;">';

	newitem += '<div style="margin-bottom:10px;">';
	newitem += '<label style="float: left;margin-left:0px; margin-bottom: 5px;padding:0px;text-align: left; font-weight: bold">Direction</label>';
	newitem += '<select class="forminput" id="direction'+noSearchDepth+'" name="direction[]" onChange="switchLink('+noSearchDepth+')">;';

	if (!direction) {
		direction = 'both';
	}

	if (!linkgroup) {
		linkgroup = 'All';
	}

	var dirs = ['outgoing','incoming','both'];
	for(var i=0; i<3; i++) {
		var next = dirs[i];
		if (direction && direction == next) {
			newitem += '<option value="'+next+'" selected="selected">'+next+'</option>';
		} else {
			newitem += '<option value="'+next+'">'+next+'</option>';
		}
	}

	newitem += '</select>';
	newitem += '</div>';

	newitem += '<div>';
	newitem += '<label style="margin-left:0px;width: 70px;padding:0px;text-align: left; font-weight: bold">Link Type </label>';
	newitem += '<select class="forminput" id="linkgroup'+noSearchDepth+'" name="linkgroup[]" onchange="javascript:linkGroupChanged('+noSearchDepth+')">';
	newitem += '<option value="" selected="selected">Select Link Group</option>';
	newitem += '<option value="All">All Link Types</option>';
	newitem += '<option value="Neutral">Neutral</option>';
	newitem += '<option value="Positive" >Positive</option>';
	newitem += '<option value="Negative">Negative</option>';
	newitem += '</select>';

	newitem += '<label style="margin-left:10px;width: 80px;padding:0px;text-align: left;">or</label>';
	newitem += '<span class="forminput" id="linksetarea'+noSearchDepth+'" name="linksetarea'+noSearchDepth+'"></span>';
	newitem += '<span id="definedsetsdiv'+noSearchDepth+'" style="margin-top: 2px;"></span>';
	newitem += '<div>';

	newitem += '<div style="margin-top: 3px;">';
	newitem += '<label style="float: left;margin-left:0px; margin-bottom: 5px; padding:0px;text-align: left;">or</label>';
	newitem += '<a class="forminput" title="Open the link type selector" href="javascript: showLinkTypeSelector('+noSearchDepth+')">Choose</a>';
	newitem += '<textarea rows="1" name="selectedlinks[]" id="selectedlinks'+noSearchDepth+'" readonly style="width:98%;font-size: 10pt;font-family: Arial, Helvetica, sans-serif; border: 1px solid gray; color: #308D88;background: transparent;">';
	if (links && links != "") {
		newitem += links;
	}
	newitem += '</textarea>';

	newitem += '</div>';

	newitem += '</fieldset>';
	newitem += '</div>';

	newitem += '<input type="hidden" id="nodeids'+noSearchDepth+'" name="nodeids[]" value="" />';


	newitem += '<input type="hidden" id="selectedroles'+noSearchDepth+'" name="selectedroles[]" value="';
	if (roles && roles != "") {
		newitem += roles;
	} else {
		newitem += "All";
	}
	newitem += '" />'

	newitem += '<div style="clear:both;" class="link-bottom-arrow" id="linkbottom'+noSearchDepth+'"></div>';

	newitem += '<div>';
	newitem += '<table border="0" cellpadding="0" style="border-collapse:collapse;">';
	newitem += '<tr>';
	newitem += '<td width="65">';
	if (noSearchDepth > 1) {

		for (var i=2; i <noSearchDepth; i++) {
			$('removedepth'+i).style.visibility = 'hidden';
		}

		newitem += '<a id = "removedepth'+noSearchDepth+'" title="Remove this connection depth from the network search" href="javascript: removeDepth('+noSearchDepth+')">Remove Depth '+noSearchDepth+'</a>';
	}
	newitem += '</td>';
	newitem += '<td>';
	newitem += '<div id="ideadivarea'+noSearchDepth+'" class="ideadiv" style="clear:both;">';

	//renderFakeNodeToDepth(depth, roles);

	newitem += '<div class="idea-container-fake">';
	newitem += '<div class="idea-header-fake">';
	newitem += '<div class="idea-title-fake">';
	newitem += 'Idea Types:<a style="margin-left: 5px;" title="Open the idea selector" href="#" onclick="showNodeTypeSelector('+noSearchDepth+')">Choose Type(s)</a>';
	newitem += '<textarea rows="2" name="textareaselectedroles[]" id="textareaselectedroles'+noSearchDepth+'" readonly style="width:100%;font-size: 10pt;font-family: Arial, Helvetica, sans-serif; color: #308D88;border:1px solid gray; background: transparent;">';
	if (roles && roles != "") {
		newitem += roles;
	} else {
		newitem += "All";
	}

	newitem += '</textarea>';
	newitem += '</div>';
	newitem += '</div>';
	newitem += '<div style="clear: both;"/>';
	newitem += '</div>';

	nodes[noSearchDepth] = null;

	newitem += '<div class="idea-wrapper" style="background: none repeat scroll 0% 0% transparent;"></div>';
	newitem += '</div>';

	newitem += '</div>';
	newitem += '</td>';
	newitem += '<td>';
	newitem += '<div id="removeidea'+noSearchDepth+'" style="width: 35px; float: left; visibility: hidden; padding: 3px; padding-left:8px; margin-bottom: 10px;"><a title="Remove this node from the connection" href="javascript: removeNode('+noSearchDepth+')">Remove</a></div>';
	newitem += '<div style="clear:both; width: 35px; float: left; padding: 3px; padding-left:8px;"><a title="Open the idea selector" href="javascript: openIdeaPicker('+noSearchDepth+')">Idea Selector</a></div>';

	//newitem += '';
	newitem += '</td>';
	newitem += '</tr>';
	newitem += '</table>';
	newitem += '</div>';

	newitem += '</div>';


    $('searchdepths').insert(newitem);

	$('linksetarea'+noSearchDepth).insert(createDefinedLinkSetSelectorNew('linkset[]', 'linkset'+noSearchDepth, 'linkSetChanged', noSearchDepth));

	var options = $('linkset'+noSearchDepth).options;
	for (var itemIndex = 0; itemIndex < options.length; itemIndex++) {
		if (linkset && options[itemIndex].value == linkset) {
			$('linkset'+noSearchDepth).options[itemIndex].selected = true;
		}
	}

	$('definedsetsdiv'+noSearchDepth).insert('<a href="#" onMouseOver="showLinkConnectionSearchMessage(event, \'connectionsearchhint\'); return false;" onMouseOut="hideHints(); return false;" onClick="hideHints(); return false;" onkeypress="enterKeyPressed(event)"><img src="'+URL_ROOT+'images/info.png" border="0" style="margin-top: 2px; margin-left: 5px; margin-right: 2px;" /></a>');
	$('definedsetsdiv'+noSearchDepth).insert('<div id="connectionsearchhint" class="hintRollover" style="position: absolute; visibility: hidden"><table width="350" border="0" cellpadding="1" cellspacing="0" bgcolor="#FFFED9"><tr width="350"><td width="350" align="left"><span id="connectionSearchHintMessage"></span></td></tr></table></div>');

	options = $('linkgroup'+noSearchDepth).options;
	for (var itemIndex = 0; itemIndex < options.length; itemIndex++) {
		if (linkgroup && options[itemIndex].value == linkgroup) {
			$('linkgroup'+noSearchDepth).options[itemIndex].selected = true;
		}
	}

    noSearchDepth++;

    if (noSearchDepth > 7) {
    	$('depthbutton').style.display = "none"
    } else {
    	$('depthbutton').style.display = "block"
    }
}

/**
 * Open the node type selector.
 */
function showNodeTypeSelector(depth) {
	var selected = $('textareaselectedroles'+depth).value;
	if (selected == "All") {
		selected = "";
	}
	loadDialog('nodetypeselectorns', URL_ROOT+"ui/popups/roleselector.php?depth="+depth+"&nodetypes="+encodeURIComponent(selected), 600, 700);
}

/**
 * Open the link type selector.
 */
function showLinkTypeSelector(depth) {
	var selected = $('selectedlinks'+depth).value;
	loadDialog('linktypeselectorns', URL_ROOT+"ui/popups/linktypeselector.php?depth="+depth+"&links="+encodeURIComponent(selected), 600, 700);
}

function openIdeaPicker(depth) {
	loadDialog('ideaselectors', URL_ROOT+"ui/popups/ideaselector.php?depth="+depth+"&ownonly=false", 420, 730);
}

function addSelectedNode(node, role) {
	loadConnectionNode(node, role);
}


function linkSetChanged(num) {
	if ($('linkset'+num).selectedIndex > 0) {
		$('linkgroup'+num).options[0].selected = true;
		$('selectedlinks'+num).value='';
	}
}

function linkGroupChanged(num) {
	if ($('linkgroup'+num).selectedIndex > 0) {
		$('linkset'+num).options[0].selected = true;
		$('selectedlinks'+num).value='';
	}
}

function setSelectedLinkTypes(selected, depth) {
	$('selectedlinks'+depth).value=selected;

	$('linkset'+depth).options[0].selected = true;
	$('linkgroup'+depth).options[0].selected = true;
}

function setSelectedNodeTypes(selected, depth) {
	if (selected == "") {
		selected = "All";
	}

	if ($('textareaselectedroles'+depth) != null) {
		$('textareaselectedroles'+depth).value=selected;
	}
	if ($('selectedroles'+depth) != null) {
		$('selectedroles'+depth).value=selected;
	}

	$('nodeids'+depth).value = '';
}

function switchLink(num) {
	if ($('direction'+num).options[0].selected) {  //outgoing
		$('linktop'+num).className = 'link-top-plain';
		$('linkbottom'+num).className = 'link-bottom-arrow';
	} else if ($('direction'+num).options[1].selected) { //incoming
		$('linktop'+num).className = 'link-top-arrow';
		$('linkbottom'+num).className = 'link-bottom-plain';
	} else if ($('direction'+num).options[2].selected) { //both
		$('linktop'+num).className = 'link-top-arrow';
		$('linkbottom'+num).className = 'link-bottom-arrow';
	}
}

window.onload = init;

</script>

<div style="float: left; margin: 0px; margin-left:20px; margin-right: 20px;">

<form name="structuredsearch" action="" method="post">

<input type="hidden" id="searchid" name="searchid" value="<?php echo $searchid; ?>">
<input type="hidden" id="focalnodeid" name="focalnodeid" value="<?php echo $focalnodeid; ?>">

<div style="float: left;">

	<div style="padding: 5px;">
		<label style="font-weight: bold;">Search connection networks</label>
	</div>
	<div style="padding: 5px;margin-bottom: 10px;">
		<label style="font-weight: bold;">On</label>
		<input type="radio" name="scope" value="my" <?php if ($scope == 'my'){ echo 'checked="checked"';}?> />My Data &nbsp;
		<input type="radio" name="scope" value="all" <?php if ($scope == 'all'){ echo 'checked="checked"';}?> /> All Data&nbsp;

		<br>
		<label style="width: 100px;text-align:left; font-weight: bold;">Matching Ideas on Labels</label>
		<?php
			if ($labelmatch == 'true') {
				echo '<input class="forminput" type="checkbox" id="labelmatch" name="labelmatch" value="true" checked="checked" />';
			} else {
				echo '<input class="forminput" type="checkbox" id="labelmatch" name="labelmatch" value="true" />';
			}
		?>
		<a href="#" onMouseOver="showMessage(event, 'labelmatchhint'); return false;" onMouseOut="hideHints(); return false;" onClick="hideHints(); return false;" onkeypress="enterKeyPressed(event)"><img src="<?php echo $CFG->homeAddress; ?>images/info.png" border="0" style="margin-top: 2px; margin-left: 5px; margin-right: 2px;" /></a>
		<div id="labelmatchhint" class="hintRollover" style="position: absolute; visibility: hidden"><table width="250" border="0" cellpadding="1" cellspacing="0" bgcolor="#FFFED9"><tr width="250"><td width="350" align="left"><span id="labelMatchHintMessage"></span></td></tr></table></div>


		<br>
		<label style="width: 100px;text-align:left; font-weight: bold;">Follwing unique paths</label>
		<?php
			if ($uniquepath == 'true') {
				echo '<input class="forminput" type="checkbox" id="uniquepath" name="uniquepath" value="true" checked="checked" />';
			} else {
				echo '<input class="forminput" type="checkbox" id="uniquepath" name="uniquepath" value="true" />';
			}
		?>
		<a href="#" onMouseOver="showMessage(event, 'unqiuepathhint'); return false;" onMouseOut="hideHints(); return false;" onClick="hideHints(); return false;" onkeypress="enterKeyPressed(event)"><img src="<?php echo $CFG->homeAddress; ?>images/info.png" border="0" style="margin-top: 2px; margin-left: 5px; margin-right: 2px;" /></a>
		<div id="unqiuepathhint" class="hintRollover" style="position: absolute; visibility: hidden"><table width="250" border="0" cellpadding="1" cellspacing="0" bgcolor="#FFFED9"><tr width="250"><td width="350" align="left"><span id="uniquePathHintMessage"></span></td></tr></table></div>

		<br>
		<label style="width: 100px;text-align:left; font-weight: bold;">Match each depth as</label>
		<input type="radio" name="logictype" value="and" <?php if ($logictype == 'and'){ echo 'checked="checked"';}?> /> AND &nbsp;
		<input type="radio" name="logictype" value="or" <?php if ($logictype == 'or'){ echo 'checked="checked"';}?> /> OR&nbsp;
		<a href="#" onMouseOver="showMessage(event, 'typehint'); return false;" onMouseOut="hideHints(); return false;" onClick="hideHints(); return false;" onkeypress="enterKeyPressed(event)"><img src="<?php echo $CFG->homeAddress; ?>images/info.png" border="0" style="margin-top: 2px; margin-left: 5px; margin-right: 2px;" /></a>
		<div id="typehint" class="hintRollover" style="position: absolute; visibility: hidden"><table width="250" border="0" cellpadding="1" cellspacing="0" bgcolor="#FFFED9"><tr width="250"><td width="350" align="left"><span id="typeHintMessage"></span></td></tr></table></div>

	</div>

	<div id="ideadivspacer0" class="ideadivspacer">
		<table>
			<tr>
			<td><div style="width: 55px; float: left; font-weight: bold; padding: 3px; ">Starting From</div></td>
			<td><div id="ideadivarea0" class="ideadiv"></div></td>
			<td>
				<div id="removeidea0" style="width: 35px; float: left; visibility: hidden; padding: 3px; margin-bottom: 10px;"><a title="Remove this node from the connection" href="javascript: removeFocalNode()">Remove</a></div>
				<div style="width: 35px; float: left; padding: 3px; "><a title="Open the idea selector" href="javascript: openIdeaPicker(0)">Idea Selector</a></div>
			</td>
			</tr>
		</table>
	</div>

	<div id="searchdepths">
	</div>

	<div id="depthbutton" style="clear:both;padding: 5px; margin-bottom: 10px;margin-top: 10px; font-weight">
		<a href="#" onclick="addDepth()">Add Depth</a>
	</div>


	<div class="formrow">
	    <input type="button" value="Run" onclick="runNetworkSearch();" />
	   	<input type="button" value="Cancel" onclick="window.close();" />

		<input class="forminput" style="margin-left: 10px; width:200px; font-size: 10pt;" id="searchname" name="searchname" value="<?php echo $searchname; ?>" onblur="javascript:if(this.value=='')this.value='Search Name';return true" onfocus="javascript:if(this.value=='Search Name')this.value=''; return true" value="Search Name" />
		<?php
		if ($searchid == "") {
			echo '<input class="submit" disabled type="submit" value="Save" id="addsearch" name="addsearch">';
		} else {
			echo '<input class="submit" disabled type="submit" value="Save" id="savesearch" name="savesearch">';
		}
		?>
	</div>
</div>

</form>

</div>


<?php
    include_once($CFG->dirAddress."ui/dialogfooter.php");
?>