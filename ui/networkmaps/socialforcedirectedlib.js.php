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

	include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
?>

var FD_MOST_CONNECTED_NODE = "";

var checkEdges = new Array();
var checkNodes = new Array();

$jit.ForceDirected.Plot.EdgeTypes.implement({

	'socialline': {
		'render': function(adj, canvas) {
			var orifrom = adj.nodeFrom.pos.getc(true);
			var orito = adj.nodeTo.pos.getc(true);

			//alert("fromNode = "+adj.nodeTo.pos.getc(true));
			//alert("toNode = "+adj.nodeFrom.pos.getc(true));

			// want the to and from to be where the line intercepcts the node boxes.
			var to = computeIntersectionWithRectangle(adj.nodeTo, orito, orifrom);
			var from = computeIntersectionWithRectangle(adj.nodeFrom, orifrom, orito);

			if (!to) {
				to = orito;
			}
			if (!from) {
				from = orifrom
			}

			var dim = adj.getData('dim');
			var direction = adj.data.$direction;
			var swap = (direction && direction.length>1 && direction[0] != adj.nodeFrom.id);

			var context = canvas.getCtx();
			// invert edge direction
			if (swap) {
				var tmp = from;
				from = to;
				to = tmp;
			}

			var vect = new $jit.Complex(to.x - from.x, to.y - from.y);
			vect.$scale(dim / vect.norm());
			var posVect = vect;
			var intermediatePoint = new $jit.Complex(to.x - posVect.x, to.y - posVect.y);
			var normal = new $jit.Complex(-vect.y / 2, vect.x / 2);
			var endPoint = intermediatePoint.add(vect);
			var v1 = intermediatePoint.add(normal);
			var v2 = intermediatePoint.$add(normal.$scale(-1));

			// only do this calulation the first time.
			var linkgroup = adj.getData('linkgroup');

			var labelcount = adj.getData('label');

			//alert("adj selected"+adj.getData('selected'));
			if (adj.getData('selected')) {
				context.strokeStyle = '#FFFF40';
			}

			if (labelcount > 1) {
				context.lineWidth = 3;
			}

			//line
			context.beginPath();
			context.moveTo(from.x, from.y);
			context.lineTo(to.x, to.y);
			context.stroke();

			// Link Text
			var extra = "Connections";
			if (labelcount == 1) {
				extra = "Connection";
			}
			var labeltext = labelcount+" "+extra
			context.font = "12px Arial";
			context.textBaseline = 'top';

	  		var metrics = context.measureText(labeltext);
	  		var testWidth = metrics.width;

			// center label on line
			var posVectLabel = new $jit.Complex((to.x - from.x)/2, (to.y - from.y)/2);
			var intermediatePointLabel = new $jit.Complex(to.x - posVectLabel.x, to.y - posVectLabel.y);
			//var endPointLabel = intermediatePointLabel.add(vect);

			context.fillText(labeltext, (intermediatePointLabel.x-(testWidth/2)), intermediatePointLabel.y);
		},
		//optional
		'contains': function(adj, pos) {
			var posFrom = adj.nodeFrom.pos.getc(true);
			var posTo = adj.nodeTo.pos.getc(true);
			var epsilon = this.edge.epsilon;
            var min = Math.min,
                max = Math.max,
                minPosX = min(posFrom.x, posTo.x) - epsilon,
                maxPosX = max(posFrom.x, posTo.x) + epsilon,
                minPosY = min(posFrom.y, posTo.y) - epsilon,
                maxPosY = max(posFrom.y, posTo.y) + epsilon;

            if(pos.x >= minPosX && pos.x <= maxPosX
                && pos.y >= minPosY && pos.y <= maxPosY) {
                if(Math.abs(posTo.x - posFrom.x) <= epsilon) {
                    return true;
                }
                var dist = (posTo.y - posFrom.y) / (posTo.x - posFrom.x) * (pos.x - posFrom.x) + posFrom.y;
                return Math.abs(dist - pos.y) <= epsilon;
            }
            return false;
		}
	}
});

$jit.ForceDirected.Plot.NodeTypes.implement({
    'socialnode': {
		'render': function(node, canvas){

			var context = canvas.getCtx()

			var width = node.getData('width');
			var height = node.getData('height');

			var finalpos = node.pos.getc(true);
			var pos = { x: finalpos.x - width / 2, y: finalpos.y - height / 2};

			if (node.id == FD_MOST_CONNECTED_NODE.id) {
				context.fillStyle = '#E9157F';
			} else {
				var connectioncount = node.getData('connections').length;
				var mostConnectedCount = FD_MOST_CONNECTED_NODE.getData('connections').length;

				var range1 = parseInt((mostConnectedCount / 100.00) * 25);
				var range2 = parseInt((mostConnectedCount / 100.00) * 75);

				if (connectioncount <= range1) {
					context.fillStyle = '#E4E2E2';
					//LIGHT GRAY - Slightly Connected
				} else if (connectioncount >= range2) {
					context.fillStyle = '#F8C7D9';
					//PINK - Highly Connected
				} else {
					context.fillStyle = '#C6ECFE';
					//TURQUOISE - Moderately Connected
				}
			}

			context['fill' + 'Rect'](finalpos.x - width / 2, finalpos.y - height / 2,
				width, height);


			if (node.id == NODE_ARGS['nodeid']) {
				context.strokeStyle = '#000000';
				context.lineWidth = 3;
				context['stroke' + 'Rect'](finalpos.x - width / 2, finalpos.y - height / 2,
					width, height);
			}

			if (node.selected) {
				context.strokeStyle = '#FFFF40';
				context.lineWidth = 3;
				context['stroke' + 'Rect'](finalpos.x - width / 2, finalpos.y - height / 2,
					width, height);
			}

			var orinode = node.getData('orinode');
			var user = node.getData('oriuser');

			var userimage = user.thumb;

			var usericon = new Image();
		    usericon.src = userimage;

		    var imgheight = usericon.height;
		    var imgwidth = usericon.width;
		    if(usericon.height > 30) {
		    	imgheight = 30;
		    	imgwidth = usericon.width * (30/usericon.height);
	    		context.drawImage(usericon, pos.x+5, pos.y+5, imgwidth, imgheight);
		    } else {
		    	context.drawImage(usericon, pos.x+5, pos.y+5);
		    }

			var labeltext = node.name;
			if (labeltext.length > 60) {
				labeltext = labeltext.substr(0,60)+"...";
			}

			context.fillStyle = context.strokeStyle = '#000000';
			context.font = "12px Arial";
			context.textBaseline = 'top';

			var maxWidth = 150;
			var lineHeight = 15;

			wrapText(context, labeltext, pos.x + 45, pos.y + 5, maxWidth, lineHeight, 10);
		},

		'contains': function(node, pos, width, height){

			var width = node.getData('width');
			var height = node.getData('height');

			var cpos = node.pos.getc(true);
			var npos = { x: cpos.x - width / 2, y: cpos.y - height / 2};
			var finalnpos = {x:npos.x+width/2, y:npos.y+height/2}

			return Math.abs(pos.x - finalnpos.x) <= width / 2
				&& Math.abs(pos.y - finalnpos.y) <= height / 2;
		}
	}
});

function createNewForceDirectedGraphSocial(containername, rootNodeID) {

	var fd = new $jit.ForceDirected({
		//id of the visualization container
		injectInto: containername,

		Navigation: {
			enable: true,
			type: 'Native',

			//Enable panning events only if were dragging the empty
			//canvas (and not a node).
			panning: 'avoid nodes',
			zooming: 10 //zoom speed. higher is more sensible
		},

		// Change node and edge styles such as
		// color and width.
		// These properties are also set per node
		// with dollar prefixed data-properties in the
		// JSON structure.
		Node: {
			overridable: true,
			type: "socialnode",
			height: 40,
			width: 180,
			nodetype: "",
			orinode:null,
			oriuser:null,
			connections:{},
		},

		Edge: {
		  	overridable: true,
		  	color: '#808080',
		  	lineWidth: 1.5,
		  	type: "socialline",
		  	label: "",
		  	connections:{},
		  	selected: false,
		},

		// Add node events
		Events: {
			enable: true,
		  	enableForEdges: true,

			type: 'Native',
			//Change cursor style when hovering a node
			onMouseEnter: function() {
				fd.canvas.getElement().style.cursor = 'move';
			},
			onMouseLeave: function() {
				fd.canvas.getElement().style.cursor = '';
			},
			//Update node positions when dragged
			onDragMove: function(node, eventInfo, e) {
				var pos = eventInfo.getPos();
				node.pos.setc(pos.x, pos.y);
				fd.plot();
			},
			//Implement the same handler for touchscreens
			onTouchMove: function(node, eventInfo, e) {
				$jit.util.event.stop(e); //stop default touchmove event
				this.onDragMove(node, eventInfo, e);
			},

			onRightClick: function(node, eventInfo, e) {

				//alert("node="+node);

				if (!node) return;

				//if(node.nodeFrom){
				//   console.log("target is an edge");
				//} else {
				//     console.log("target is a node");
				//}

				/*if (node != false) {
					var panel = $('graphpopupmenudiv');
					panel.innerHTML = "";
					var viewdetails = new Element("span", {'class':'active','style':'margin-bottom:5px;clear:both;float:left;font-size:10pt', 'title':'<?php echo $LNG->CHAT_CONVERT_TO_ISSUE_HINT; ?>'} );
					viewdetails.insert("<?php echo $LNG->NETWORKMAPS_EXPLORE_ITEM_LINK; ?>");
					Event.observe(viewdetails,'click',function (){
						var nodeid = node.id;
						var nodetype = node.getData('nodetype');
						var width = getWindowWidth();
						var height = getWindowHeight()-20;
						viewNodeDetails(nodeid, nodetype, width, height);
					});
					panel.insert(viewdetails);

					var viewuser = new Element("span", {'class':'active','style':'margin-bottom:5px;clear:both;float:left;font-size:10pt', 'title':'<?php echo $LNG->CHAT_CONVERT_TO_ISSUE_HINT; ?>'} );
					viewuser.insert("<?php echo $LNG->NETWORKMAPS_SOCIAL_ITEM_LINK; ?></span>");
					Event.observe(viewuser,'click',function (){
						var userid = node.getData('oriuser').userid;
						viewUserHome(userid);
					});
					panel.insert(viewuser);

					var viewportHeight = getWindowHeight();
					var viewportWidth = getWindowWidth();
					var extraX = 10;
					var extraY = 10;

					var x=e.clientX;
					var y=e.clientY;
					if ( (x+panel.offsetWidth+30) > viewportWidth) {
						x = x-(panel.offsetWidth+30);
					} else {
						x = x+10;
					}
					if ( (y+panel.offsetHeight) > viewportHeight) {
						y = y-50;
					} else {
						y = y-5;
					}

					panel.style.left = x+extraX+window.pageXOffset+"px";
					panel.style.top = y+extraY+window.pageYOffset+"px";

					//alert(e.clientX+":"+e.clientY);
					//alert(fd.canvas.getSize().width+":"+fd.canvas.getSize().height);

					showBox('graphpopupmenudiv');

				}*/
			},

			onClick: function(node, eventInfo, e) {
				if (!node) return;

				if (node.nodeFrom) {
					clearSelectedFDLinks(fd);
					node.setData('selected', true);

					//trigger animation to final styles
					fd.fx.animate({
						modes: ['edge-property:lineWidth:color'],
						duration: 2
					});

				} else {
					if (node != false) {
						fd.graph.eachNode(function(n) {

							/*n.eachAdjacency(function(adj) {
								var linkcolour = "#808080";
								if (adj.getData('label') == "<?php echo $LNG->LINK_EVIDENCE_SOLCLAIM_PRO; ?>") {
									linkcolour = "#00BD53";
								} else if (adj.getData('label') == "<?php echo $LNG->LINK_EVIDENCE_SOLCLAIM_CON; ?>") {
									linkcolour = "#C10031";
								}

								adj.setDataset('end', {
								  lineWidth: 1.5,
								  color: linkcolour,
								});
								adj.setDataset('start', {
								  lineWidth: 1.5,
								  color: linkcolour,
								});
							});
							*/

							if(n.id != node.id) {
								delete n.selected;
							} else {
								if(!n.selected) {
									n.selected = true;

									/*n.eachAdjacency(function(adj) {
										adj.setDataset('end', {
										  lineWidth: 3,
										  color: '#F2F377'
										});
										adj.setDataset('start', {
										  lineWidth: 3,
										  color: '#F2F377'
										});
									});*/
								}
							}
						});


						//trigger animation to final styles
						fd.fx.animate({
							modes: ['edge-property:lineWidth:color'],
							duration: 2
						});
					}
				}
			}
		},

		//Number of iterations for the FD algorithm
		iterations: 100,

		//Edge length
		levelDistance: 280,

		//Add Tips
		Tips: {
			enable: true,
			type: 'Native',
			offsetX: 10,
  			offsetY: 10,
			onShow: function(tip, node) {
				var connections = node.getData('connections');
				var count = -1;
				if (connections) {
					count = connections.length;
				}
				if (count > -1) {
					tip.innerHTML = "<div class=\"tip-title\">" + node.name + "</div>"
					  + "<div class=\"tip-text\"><b>connections:</b> " + count; + "</div>";
				} else {
					tip.innerHTML = node.name;
				}
			}
		}
	});

	fd.graph = new $jit.Graph(fd.graphOptions, fd.config.Node, fd.config.Edge, fd.config.Label);

	if (rootNodeID != "") {
		fd.root = rootNodeID;
	}

	return fd;
}

/**
 * Calculate the dominant link colour for the links that are multiple for the given key.
 * @param connections, the list of connections
 * @param multicheck, the key for the connection (source+target ids).
 * @return the hash colour to be used for the link.
 */
function getLinkGroupColour(connections) {
	var linkcolour = "#808080";

	var redCount = 0;
	var greenCount = 0;
	var greyCount = 0;

	if (connections.length > 0) {
		var count = connections.length;

		for (var i=0; i<count; i++) {
			var c = connections[i];
			var fN = c.from[0].cnode;
			var tN = c.to[0].cnode;

			var linklabelname = c.linktype[0].linktype.label;

			// EVHUB only
			//linklabelname = getLinkLabelName(fN.role[0].role.name, tN.role[0].role.name, linklabelname);

			if (linklabelname == "<?php echo $LNG->LINK_EVIDENCE_SOLCLAIM_PRO; ?>") {
				greenCount++;
			} else if (linklabelname == "<?php echo $LNG->LINK_EVIDENCE_SOLCLAIM_CON; ?>") {
				redCount++;
			} else {
				greyCount++;
			}
		}
	}

	if (redCount > greenCount && redCount > greyCount) {
		//alert("Negative");
		linkcolour = "#C10031"; // Negative
	} else if (greenCount > redCount && greenCount > greyCount) {
		///alert("Positive");
		linkcolour = "#00BD53"; // Positive
	} else if (greenCount == greyCount && greenCount > redCount) {
		//alert("Positive");
		linkcolour = "#00BD53"; // Positive
	} else if (redCount == greyCount && redCount > greenCount) {
		//alert("Negative");
		linkcolour = "#C10031"; //Negative
	}

	return linkcolour;
}

/**
 * Add the given connection to the given graph
 */
function addConnectionToFDGraphSocial(c, graph) {
	var fN = c.from[0].cnode;
	var tN = c.to[0].cnode;

	var fromuser = null;
	if (fN.users[0].userid) {
		fromuser = fN.users[0];
	} else {
		fromuser = fN.users[0].user;
	}
	var touser = null;
	if (tN.users[0].userid) {
		touser = tN.users[0];
	} else {
		touser = tN.users[0].user;
	}

	if (fromuser.userid == touser.userid) {
		return;
	}

	var fromNode = null;
	if (!checkNodes[fromuser.userid]) {
		var connections = new Array();
		connections.push(c);
		fromNode = {
			"data": {
				"$orinode": fromuser,
				"$oriuser": fromuser,
				"$connections":connections,
			},
			"id": fromuser.userid,
			"name": fromuser.name,
		};
   		graph.addNode(fromNode);
   		checkNodes[fromuser.userid] = fromuser.userid;
	} else {
		fromNode = graph.getNode(fromuser.userid);
		var connections = fromNode.getData('connections');
		connections.push(c);
		fromNode.setData('connections', connections);
	}

	var toNode = null;
	if (!checkNodes[touser.userid]) {
		var connections = new Array();
		connections.push(c);
		toNode = {
			"data": {
				"$orinode": touser,
				"$oriuser": touser,
				"$connections": connections,
			},
			"id": touser.userid,
			"name": touser.name,
		};
   		graph.addNode(toNode);
   		checkNodes[touser.userid] = touser.userid;
	} else {
		toNode = graph.getNode(touser.userid);
		var connections = toNode.getData('connections');
		connections.push(c);
		toNode.setData('connections', connections);
	}

	// add edge/conn
	var conncheck1 = fromuser.userid+touser.userid;
	var conncheck2 = touser.userid+fromuser.userid;
	if (!checkEdges[conncheck1] && !checkEdges[conncheck2]) {
		var connections = new Array();
		connections.push(c);
		var linkcolour = getLinkGroupColour(connections);
		var data = {
			"$color": linkcolour,
			"$connections": c.connid,
			"$label": 1,
		};

		graph.addAdjacence(fromNode, toNode, data);
		checkEdges[conncheck1] = connections;
	 } else {
	 	var connections = {};
	 	var adj = "";
	 	if (checkEdges[conncheck1]) {
	 		connections = checkEdges[conncheck1];
	 		connections.push(c);
	 		checkEdges[conncheck1] = connections;
	 		var adj = graph.getAdjacence(fromuser.userid, touser.userid);
	 	} else if (checkEdges[conncheck2]) {
	 		connections = checkEdges[conncheck2];
	 		connections.push(c);
	 		checkEdges[conncheck2] = connections;
	 		adj = graph.getAdjacence(touser.userid, fromuser.userid);
	 	}

		if (adj != "" && connections.length > 0) {
			var constring = adj.getData('connections');
			constring += ","+c.connid;

			var linkcolour = getLinkGroupColour(connections);
			adj.setData('color', linkcolour);
			adj.setData('connections', constring);
			adj.setData('label', connections.length);
		}
	}
}

/**
 * Clear all link selection.
 */
function clearSelectedFDLinks(graphview) {
    for(var i in graphview.graph.edges) {
         var edgeslist = graphview.graph.edges[i];
	     for(var j in edgeslist) {
			var adj = edgeslist[j];
			adj.setData('selected', false);
		}
    }
}


/**
 * Return the currently selected link.
 */
function getSelectFDLink(graphview) {
	var selectedLink = "";

    for(var i in graphview.graph.edges) {
         var edgeslist = graphview.graph.edges[i];
	     for(var j in edgeslist) {
			var adj = edgeslist[j];
			if(adj.getData('selected')) {
				return adj;
			}
		}
    }

	return selectedLink;
}