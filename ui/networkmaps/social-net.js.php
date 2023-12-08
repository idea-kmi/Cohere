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

    include_once("../../config.php");
?>

var forcedirectedGraph = null;

function loadSocialNet() {

	$("tab-content-svn").innerHTML = "";

	/**** CHECK GRAPH SUPPORTED ****/
	if (!isCanvasSupported()) {
		$("tab-content-svn").insert('<div style="float:left;font-weight:12pt;padding:10px;"><?php echo $LNG->GRAPH_NOT_SUPPORTED; ?></div>');
		return;
	}

	/**** SETUP THE GRAPH ****/

	var graphDiv = new Element('div', {'id':'graphUserDiv', 'style': 'clear:both;float:left'});
	var width = 2000;
	var height = 2000; // multi-graphs float off

	var messagearea = new Element("div", {'id':'netusermessage','class':'toolbitem','style':'float:left;clear:both;font-weight:bold'});

	graphDiv.style.width = width+"px";
	graphDiv.style.height = height+"px";

	var outerDiv = new Element('div', {'id':'graphUserDiv-outer', 'style': 'border:1px solid gray;clear:both;float:left;margin-left:5px;margin-bottom:5px;overflow:hidden'});
	outerDiv.insert(messagearea);
	outerDiv.insert(graphDiv);
	$("tab-content-svn").insert(outerDiv);

	forcedirectedGraph = createNewForceDirectedGraphSocial('graphUserDiv', "");

	// THE KEY
	var keybar = createSocialNetworkGraphKey();
	// THE TOOLBAR
	var toolbar = createSocialGraphToolbar(forcedirectedGraph, "tab-content-svn");

	$("tab-content-svn").insert({top: toolbar});
	$("tab-content-svn").insert({top: keybar});

	//event to resize
	Event.observe(window,"resize",function() {
		resizeFDGraph(forcedirectedGraph, "tab-content-svn", false);
	});

 	var size = calulateInitialGraphViewport("tab-content-svn");
	outerDiv.style.width = size.width+"px";
	outerDiv.style.height = size.height+"px";

	loadSocialData(forcedirectedGraph, toolbar, messagearea);
}

function loadSocialData(forcedirectedGraph, toolbar, messagearea) {

	messagearea.update(getLoading("<?php echo $LNG->NETWORKMAPS_SOCIAL_LOADING_MESSAGE; ?>"));

	var args = Object.clone(NET_ARGS);
	args["start"] = 0;
	args["max"] = -1;

	//request to get the current connections
	var reqUrl = SERVICE_ROOT + "&method=getconnectionsby" + CONTEXT + "&style=short&max=-1&start=0&groupid="+NET_ARGS['groupid'];

	new Ajax.Request(reqUrl, { method:'post',
  			onSuccess: function(transport){
				//console.log(transport);
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
				$('graphConnectionCount').innerHTML = "";
				$('graphConnectionCount').insert('<span style="font-size:10pt;color:black;float:left;margin-left:20px"><?php echo $LNG->GRAPH_CONNECTION_COUNT_LABEL; ?> '+conns.length+'</span>');

      			//console.log("connection count = "+conns.length);

      			if (conns.length > 0) {
	      			for(var i=0; i< conns.length; i++){
	      				var c = conns[i].connection;
						//console.log(c);
						addConnectionToFDGraphSocial(c, forcedirectedGraph.graph);
	      			}

					var root = computeMostConnectedNode(forcedirectedGraph);
					if (root != -1) {
						layoutAndAnimate(forcedirectedGraph, messagearea);
					} else {
						messagearea.innerHTML="<?php echo $LNG->NETWORKMAPS_SAME_USER_MESSAGE; ?>";
					}

					toolbar.style.display = 'block';
				} else {
					messagearea.innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
					toolbar.style.display = 'none';
				}
      		}
      	});
}

loadSocialNet();