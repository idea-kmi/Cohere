<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2013 The Open University UK                                   *
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
?>

var forcedirectedGraph = null;

function loadConnectionNet(){

	$("tab-content-conn").innerHTML = "";

	/**** CHECK GRAPH SUPPORTED ****/
	if (!isCanvasSupported()) {
		$("tab-content-conn").insert('<div style="float:left;font-weight:12pt;padding:10px;"><?php echo $LNG->GRAPH_NOT_SUPPORTED; ?></div>');
		return;
	}

	/**** SETUP THE GRAPH ****/

	var graphDiv = new Element('div', {'id':'graphDiv', 'style': 'clear:both;float:left'});
	var width = 4000;
	var height = 4000;

	var messagearea = new Element("div", {'id':'netissuemessage','class':'toolbitem','style':'float:left;clear:both;font-weight:bold'});

	graphDiv.style.width = width+"px";
	graphDiv.style.height = height+"px";

	var outerDiv = new Element('div', {'id':'graphDiv-outer', 'style': 'border:1px solid gray;clear:both;float:left;margin-left:5px;margin-bottom:5px;overflow:hidden'});

	outerDiv.insert(messagearea);
	outerDiv.insert(graphDiv);
	$("tab-content-conn").insert(outerDiv);

	forcedirectedGraph = createNewForceDirectedGraph('graphDiv', NODE_ARGS['nodeid']);

	// THE TOOLBAR

	var toolbar = createGraphToolbar(forcedirectedGraph, "tab-content-conn");

	$("tab-content-conn").insert({top: toolbar});

	//event to resize
	Event.observe(window,"resize",function() {
		resizeFDGraph(forcedirectedGraph, "tab-content-conn", false);
	});

 	var size = calulateInitialGraphViewport("tab-content-conn");
	outerDiv.style.width = size.width+"px";
	outerDiv.style.height = size.height+"px";

	loadConnectionData(forcedirectedGraph, toolbar, messagearea);
}

function loadConnectionData(forcedirectedGraph, toolbar, messagearea) {

	messagearea.update(getLoading("<?php echo $LNG->NETWORKMAPS_LOADING_MESSAGE; ?>"));

	var args = Object.clone(NET_ARGS);
	args["start"] = 0;

	//get all (not just the normal 20 max)
	args["max"] = -1;

	var reqUrl = SERVICE_ROOT + "&method=getconnectionsby" + CONTEXT + "&style=short&" + Object.toQueryString(args);

	new Ajax.Request(reqUrl, { method:'post',
		onSuccess: function(transport){
			var json = null;
			try {
				json = transport.responseText.evalJSON();
			} catch(e) {
				alert(e);
			}
			if(json.error){
				alert(json.error[0].message);
				return;
			}

			var conns = json.connectionset[0].connections;
			//console.log("conns: "+conns.length);

			if (conns.length > 0) {
				for(var i=0; i< conns.length; i++){
					var c = conns[i].connection;
					addConnectionToFDGraph(c, forcedirectedGraph.graph);
				}
			}

			//$('graphConnectionCount').innerHTML = "";
			//$('graphConnectionCount').insert('<span style="font-size:10pt;color:black;float:left;margin-left:20px"><?php echo $LNG->GRAPH_CONNECTION_COUNT_LABEL; ?> '+conns.length+'</span>');

			if (conns.length > 0) {

				var root = computeMostConnectedNode(forcedirectedGraph);
				if (root != -1) {
					layoutAndAnimate(forcedirectedGraph, messagearea);
				} else {
					messagearea.innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
				}

				toolbar.style.display = 'block';
			} else {
				messagearea.innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
				toolbar.style.display = 'none';
			}
		}
	});
}

loadConnectionNet();