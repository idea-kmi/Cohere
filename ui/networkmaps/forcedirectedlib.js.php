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

	include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
?>

var checkNodes = new Array();

var labelType, useGradients, nativeTextSupport, animate;

// TAKEN FROM EXAMPLES IN THE jit-2.0.2 CODE BASE.
(function() {
  var ua = navigator.userAgent,
      iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
      typeOfCanvas = typeof HTMLCanvasElement,
      nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
      textSupport = nativeCanvasSupport
        && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
  //I'm setting this based on the fact that ExCanvas provides text support for IE
  //and that as of today iPhone/iPad current text support is lame
  labelType = (!nativeCanvasSupport || (textSupport && !iStuff))? 'Native' : 'HTML';
  nativeTextSupport = labelType == 'Native';
  useGradients = nativeCanvasSupport;
  animate = !(iStuff || !nativeCanvasSupport);
})();

/**
 * Returns the intersecting point of the line with the given from and
 * to point with the given node rectangle. To get the other intersecting point
 * the from and to points need to be reversed.
 *
 * @param node the node whose Rectangle to check.
 * @param from the origin point of the line to check.
 * @param to the destination point of the line to check.
 * @return Point the point the rectangle and line intersect, else null it they don't.
 */
function computeIntersectionWithRectangle(node, from, to) {

	//alert("to="+to.x);
	//alert("from="+from.x);

	var widthr = node.getData('width');
	var heightr = node.getData('height');

	var cpos = node.pos.getc(true);
	var r = { x: cpos.x - widthr / 2, y: cpos.y - heightr / 2, width: node.getData('width'), height: node.getData('height')};

	var pt = { x: 0, y: 0};

	if ((from.x == to.x)&& (from.y == to.y)) return null;

	//line to the right of rectangle
	if ((from.x>r.x+r.width) && (to.x>r.x+r.width)) return null;

	//line below rectangle
	if ((from.y>r.y+r.height) && (to.y>r.y+r.height)) return null;

	//line to left of rectangle
	if ((from.x<r.x) && (to.x<r.x)) return null;

	//line above rectangle
	if ((from.y<r.y) && (to.y<r.y)) return null;

	if (to.y != from.y) {
		if (r.y+r.height<=to.y) {
			pt.y=r.y+r.height;
			pt.x=from.x+(to.x-from.x)*(r.y+r.height-from.y)/(to.y-from.y);
		} else {
			pt.y=r.y;
			pt.x=from.x+(to.x-from.x)*(r.y-from.y)/(to.y-from.y);
		}
	}

	if (to.y==from.y || r.x>pt.x || pt.x>=r.x+r.width) {
		if (r.x+r.width<=to.x) {
			pt.y=from.y+(to.y-from.y)*(r.x+r.width-from.x)/(to.x-from.x);
			pt.x=r.x+r.width;
		}
		else {
			pt.y=from.y+(to.y-from.y)*(r.x-from.x)/(to.x-from.x);
			pt.x=r.x;
		}
	}

	return pt;
}


$jit.ForceDirected.Plot.EdgeTypes.implement({

	'labelarrow': {
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

			if (adj.selected) {
				context.strokeStyle = '#FFFF40';
				context.lineWidth = 3;
			} else {
				context.strokeStyle = adj.getData('color');
			}

			//line
			context.beginPath();
			context.moveTo(from.x, from.y);
			context.lineTo(to.x, to.y);
			context.stroke();

			// Arrow head
			context.beginPath();
			context.moveTo(v1.x, v1.y);
			context.moveTo(v1.x, v1.y);
			context.lineTo(v2.x, v2.y);
			context.lineTo(endPoint.x, endPoint.y);
			context.closePath();
			context.fill();

			// Link Text

			context.fillStyle = context.strokeStyle = '#000000';

			var labeltext = adj.getData('label');
			context.font = "bold 12px Arial";
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

/**
 * Wrap the given text over as many lines as required.
 */
function wrapText(context, text, x, y, maxWidth, lineHeight) {
	var words = text.split(' ');
	var line = '';

	for(var n = 0; n < words.length; n++) {
	  var testLine = line + words[n] + ' ';
	  var metrics = context.measureText(testLine);
	  var testWidth = metrics.width;
	  if (testWidth > maxWidth && n > 0) {
		context.fillText(line, x, y);
		line = words[n] + ' ';
		y += lineHeight;
	  }
	  else {
		line = testLine;
	  }
	}
	context.fillText(line, x, y);
}

$jit.ForceDirected.Plot.NodeTypes.implement({
    'cohere': {
		'render': function(node, canvas){

			var context = canvas.getCtx()

			var width = node.getData('width');
			var height = node.getData('height');

			var finalpos = node.pos.getc(true);
			var pos = { x: finalpos.x - width / 2, y: finalpos.y - height / 2};

			context.fillStyle = node.color;
			context.strokeStyle = node.color;
			var rad = 5;
			var xx = finalpos.x - width / 2;
			var yy = finalpos.y - height / 2;

			if (node.id == NODE_ARGS['nodeid']) {
				context.strokeStyle = '#606060';
				context.lineWidth = 3;
			} else {
				//context.strokeStyle = '#308D88';
				context.lineWidth = 1;
			}
			if (node.selected) {
				context.strokeStyle = '#FFFF40';
				context.lineWidth = 3;
			}

			/*
			// just rectangles
			context.beginPath();
			context.moveTo(xx+rad, yy);
			context.arcTo(xx+width, yy,    xx+width, yy+height, rad);
			context.arcTo(xx+width, yy+height, xx,    yy+height, rad);
			context.arcTo(xx,    yy+height, xx,    yy,    rad);
			context.arcTo(xx,    yy,    xx+width, yy,    rad);

			context['fill' + 'Rect'](finalpos.x - width / 2, finalpos.y - height / 2,
				width, height);
			*/

			// Curved corners on rectangles
			context.beginPath();
			context.moveTo(xx+rad, yy);
			context.lineTo(xx + width - rad, yy);
			context.quadraticCurveTo(xx + width, yy, xx + width, yy + rad);
			context.lineTo(xx + width, yy + height - rad);
			context.quadraticCurveTo(xx + width, yy + height, xx + width - rad, yy + height);
			context.lineTo(xx + rad, yy + height);
			context.quadraticCurveTo(xx, yy + height, xx, yy + height - rad);
			context.lineTo(xx, yy + rad);
			context.quadraticCurveTo(xx, yy, xx + rad, yy);
			context.closePath();
			context.fill();
			context.stroke();

			var orinode = node.getData('orinode');
			var orirole = node.getData('orirole');

			var roleicon = node.getData('icon');
    		context.drawImage(roleicon, pos.x+5, pos.y+((height-roleicon.height)/2));

			var usericon = node.getData('usericon');

		    var imgheight = usericon.height;
		    var imgwidth = usericon.width;
		    if(usericon.height > 40) {
		    	imgheight = 40;
		    	imgwidth = usericon.width * (40/usericon.height);
	    		context.drawImage(usericon, pos.x+(width-(5+imgwidth)), pos.y+((height-imgheight)/2), imgwidth, imgheight);
		    } else {
		    	context.drawImage(usericon, pos.x+(width-(5+imgwidth)), pos.y+((height-imgheight)/2));
		    }

			var labeltext = node.name;
			if (labeltext.length > 60) {
				labeltext = labeltext.substr(0,60)+"...";
			}

			context.fillStyle = context.strokeStyle = '#000000';
			context.font = "12px Arial";
			context.textBaseline = 'top';

			var maxWidth = 165;
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

function createNewForceDirectedGraph(containername, rootNodeID) {

	// to reload the nodes on tab switch;
	checkNodes = new Array();

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
			type: "cohere",
			height: 50,
			width: 250,
			nodetype: "",
			orinode: null,
			orirole: null,
			oriuser:null,
			icon: "",
			usericon: "",
			desc: "",
			connections:{},
		},

		Edge: {
		  	overridable: true,
		  	color: '#808080',
		  	lineWidth: 1.5,
		  	type: "labelarrow",
		  	label: "",
		},

		// Add node events
		Events: {
			enable: true,

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

				if (!node) return;

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

				//if(node.nodeFrom){
				//   console.log("target is an edge");
				//} else {
				//     console.log("target is a node");
				//}

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
 * Return the currently selected node.
 */
function getSelectFDNode(graphview) {
	var selectedNode = "";

    for(var i in graphview.graph.nodes) {
    	var n = graphview.graph.nodes[i];
		if(n.selected) {
			selectedNode = n;
			break;
        }
    }

	return selectedNode;
}

/**
 * Add the given connection to the given graph
 */
function addConnectionToFDGraph(c, graph) {

	var fN = c.from[0].cnode;
	var tN = c.to[0].cnode;

	var fnRole = c.fromrole[0].role;
	var fNNodeImage = "";
	if (fN.imagethumbnail != null && fN.imagethumbnail != "") {
		fNNodeImage = URL_ROOT + fN.imagethumbnail;
	} else if (fN.role[0].role.image != null && fN.role[0].role.image != "") {
		fNNodeImage = URL_ROOT + fN.role[0].role.image;
	}
	var	fromroleicon = new Image();
	fromroleicon.src = fNNodeImage;

	var tnRole = c.torole[0].role;
	var tNNodeImage = "";
	var toroleicon;
	if (tN.imagethumbnail != null && tN.imagethumbnail != "") {
		tNNodeImage = URL_ROOT + tN.imagethumbnail;
	} else if (tN.role[0].role.image != null && tN.role[0].role.image != "") {
		tNNodeImage = URL_ROOT + tN.role[0].role.image;
	}
	var toroleicon = new Image();
	toroleicon.src = fNNodeImage;


	var fromRole = fN.role[0].role.name;
	var toRole = tN.role[0].role.name;

	var fromDesc = "";
	if (fN.description) {
		fromDesc = fN.description;
	}
	var toDesc = "";
	if (tN.description) {
		toDesc = tN.description;
	}
	var fromName = fN.name;
	var toName = tN.name;

	// Get HEX for From Role
	var fromHEX = "#d3e8e8";

	// Get HEX for To Role
	var toHEX = "#d3e8e8";

	//create from & to nodes

	var fromuser = null;
	if (fN.users[0].userid) {
		fromuser = fN.users[0];
	} else {
		fromuser = fN.users[0].user;
	}
	var fromusericon = new Image();
	fromusericon.src = fromuser.thumb


	var touser = null;
	if (tN.users[0].userid) {
		touser = tN.users[0];
	} else {
		touser = tN.users[0].user;
	}
	var tousericon = new Image();
	tousericon.src = touser.thumb

	var fromNode = null;
	if (!checkNodes[fN.nodeid]) {
		var connections = new Array();
		connections.push(c);
	 	fromNode = {
		        "data": {
					"$color": fromHEX,
					"$nodetype": fromRole,
					"$orinode": fN,
					"$orirole": fnRole,
					"$oriuser": fromuser,
					"$icon": fromroleicon,
					"$usericon": fromusericon,
					"$desc": fromDesc,
					"$connections":connections,
		        },
		        "id": fN.nodeid,
		        "name": fromRole+": "+fromName,
	       };
   		graph.addNode(fromNode);
   		checkNodes[fN.nodeid] = fN.nodeid;
	} else {
		fromNode = graph.getNode(fN.nodeid);
		var connections = fromNode.getData('connections');
		connections.push(c);
		fromNode.setData('connections', connections);
	}

	var toNode = null;
	if (!checkNodes[tN.nodeid]) {

		var connections = new Array();
		connections.push(c);
		toNode = {
				"data": {
					"$color": toHEX,
					"$nodetype": toRole,
					"$orinode": tN,
					"$orirole": tnRole,
					"$oriuser": touser,
					"$icon": toroleicon,
					"$usericon": tousericon,
					"$desc": toDesc,
					"$connections": connections,
				},
				"id": tN.nodeid,
				"name": toRole+": "+toName,
		 };

   		graph.addNode(toNode);
   		checkNodes[tN.nodeid] = tN.nodeid;
	} else {
		toNode = graph.getNode(tN.nodeid);
		var connections = toNode.getData('connections');
		connections.push(c);
		toNode.setData('connections', connections);
	}

	// add edge/conn
	var fromRoleName = fromRole;
	if (c.fromrole[0].role) {
		fromRoleName = c.fromrole[0].role.name;
	}

	var toRoleName = toRole;
	if (c.torole[0].role) {
		toRoleName = c.torole[0].role.name;
	}

	var linklabelname = c.linktype[0].linktype.label;
	var linkgrouplabel = c.linktype[0].linktype.grouplabel;

	var linkcolour = "#808080"; //"#B2B2B2"
	if (linkgrouplabel == "Positive") {
		linkcolour = "#00BD53"; //#B2B2B2"
	} else if (linkgrouplabel == "Negative") {
		linkcolour = "#C10031"; //"#C10031"
	}

	var data = {
		"$color": linkcolour,
		"$label": linklabelname,
		"$direction": [fN.nodeid,tN.nodeid],
	};
	graph.addAdjacence(fromNode, toNode, data);
}

/**
 * Compute positions incrementally and animate.
 */
function layoutAndAnimate(graphview, messagearea) {

	//graphview.computeIncremental({
	graphview.computePrefuse({
		iter:20,
		property: 'end',
		onComplete: function(){
		  	graphview.animate({
				modes: ['linear'],
				transition: $jit.Trans.Elastic.easeOut,
				duration: 500,
				onComplete: function() {
					var width = $(graphview.config.injectInto+'-outer').offsetWidth;
					var height = $(graphview.config.injectInto+'-outer').offsetHeight;
					clipInitialCanvas(graphview, width, height);

					var size = graphview.canvas.getSize();
					if (size.width > width || size.height > height) {
						zoomFDFit(graphview);
					} else {
						var rootNodeID = graphview.root;
						panToNodeFD(graphview, rootNodeID);
					}

					if (messagearea) {
						messagearea.innerHTML="";
						messagearea.style.display = "none";
					}

					graphview.canvas.getPos(true);
				}
		  	});
		}
	});
}

/**
 * The inital canvas is huge.
 * If after drawing the map, the bounds of the map are smaller than the canvas space, but still bigger than the visible area.
 * Make the canvas the size of the map bounds
 */
function clipInitialCanvas(graphview, width, height) {

	var bounds = getBoundaries(graphview);
	var boundswidth = Math.round(bounds.width);
	var boundsheight = Math.round(bounds.height);
	//alert("bounds BEFORE="+boundswidth+":"+boundsheight);

	// If the map bounds are smaller than the visible area, make it as big as the visible area
	var finalwidth = boundswidth;
	if (boundswidth < width) {
		boundswidth = width;
	}
	var finalheight = boundsheight;
	if (boundsheight < height) {
		boundsheight = height;
	}

	// if the canvas bounds are larger than the map bounds
	// resize to map bounds

	var size = graphview.canvas.getSize();
	//alert("size="+size.width+":"+size.height);
	//alert("bounds AFTER="+boundswidth+":"+boundsheight);

	if (boundswidth < size.width || boundsheight < size.height) {
		$(graphview.config.injectInto).style.width = boundswidth+"px";
		$(graphview.config.injectInto).style.height = boundsheight+"px";
		graphview.canvas.resize(boundswidth, boundsheight);
	}
}

/**
 * Make sure if the visible div is resized that the canvas is never smaller than the visible space.
 */
function resizeFDGraphCanvas(graphview, width, height) {
	var size = graphview.canvas.getSize();

	var resizeWidth = size.width;
	if (size.width < width) {
		resizeWidth = width;
	}
	var resizeHeight = size.height;
	if (size.height < height) {
		resizeHeight = height;
	}

	if (size.width < width || size.height < height) {
		$(graphview.config.injectInto).style.width = resizeWidth+"px";
		$(graphview.config.injectInto).style.height = resizeHeight+"px";
		graphview.canvas.resize(resizeWidth, resizeHeight);
	}
}

/**
 * Pan the view to the given node only in 1:1
 */
function panToNodeFD(graphview, nodeid) {

	//var rectangle = getBoundaries(graphview);

	var canvas = graphview.canvas;
	var graph = graphview.graph;
	var node = graph.getNode(nodeid);

	var pos = node.pos.getc(false);
	// Do not edit the actualy position object you idiot woman!!!!
	var nodePos = {x: pos.x, y:pos.y}
    //alert(nodePos.x+":"+nodePos.y);

	//alert("offsets="+canvas.translateOffsetX+":"+canvas.translateOffsetY);
	var	sx = canvas.scaleOffsetX;
	var	sy = canvas.scaleOffsetY;
	var	ox = canvas.translateOffsetX;
	var oy = canvas.translateOffsetY;
	nodePos.x *= sx;
	nodePos.y *= sy;
	nodePos.x += ox;
	nodePos.y += oy;

    //alert(nodePos.x+":"+nodePos.y);

	var viewwidth = $(graphview.config.injectInto+'-outer').offsetWidth;
	var viewheight = $(graphview.config.injectInto+'-outer').offsetHeight;
	var size = canvas.getSize();

	//alert("size="+size.width+":"+size.height);

	var topX = 0 - (size.width/2);
	var topY = 0 - (size.height/2);

	//alert("topcorner="+topX+":"+topY);

	var movementX = 0-( (nodePos.x - topX) - (viewwidth/2) );
	var movementY = 0-( (nodePos.y - topY) - (viewheight/2) );

	//alert("movement="+movementX+":"+movementY);
	//alert("movement="+movementX*1/canvas.scaleOffsetX+":"+movementY*1/canvas.scaleOffsetX);

    canvas.translate(movementX*1/canvas.scaleOffsetX, movementY*1/canvas.scaleOffsetX);
}


/**
 * Zoom the given graph view to the given level
 */
function zoomFD(graphview, delta) {
     if (graphview) {
          var val = graphview.controller.Navigation.zooming/1000;
          var ans = 1 - (delta * val);
          graphview.canvas.scale(ans, ans);
     }
}

/**
 * Restore the view to 1:1 zoom.
 */
function zoomFDFull(graphview) {
     if (graphview) {
		var canvas = graphview.canvas;
		var ans = 1/canvas.scaleOffsetX;
		canvas.scale(ans, ans);

		var rectangle = getBoundaries(graphview);
		moveToVisibleArea(graphview, rectangle);

		var rootNodeID = graphview.root;
		panToNodeFD(graphview, rootNodeID);
	}
}

/**
 * Zoom to fit whole map to screen.
 */
function zoomFDFit(graphview) {
     if (graphview) {
		var rectangle = getBoundaries(graphview);

		var mapWidth = rectangle.width;
		var mapHeight = rectangle.height;

		var outerWidth = $(graphview.config.injectInto+'-outer').offsetWidth;
		var outerHeight = $(graphview.config.injectInto+'-outer').offsetHeight;
		var canvas = graphview.canvas;

		// Only scale if less than one, otherwise it is already fitting to page so just move if required.
		var ans = Math.min((outerWidth)/mapWidth,(outerHeight)/mapHeight) / canvas.scaleOffsetX;
		if (ans < 1) {
			canvas.scale(ans, ans);
		}

		moveToVisibleArea(graphview, rectangle);
	}
}

/**
 * Relocate the graph into the viewable area.
 */
function moveToVisibleArea(graphview, rectangle) {
     if (graphview) {
		var canvas = graphview.canvas;
		var size = canvas.getSize();

		var nodePos = {x:rectangle.x, y:rectangle.y}
		var	sx = canvas.scaleOffsetX;
		var	sy = canvas.scaleOffsetY;
		var	ox = canvas.translateOffsetX;
		var oy = canvas.translateOffsetY;
		nodePos.x *= sx;
		nodePos.y *= sy;
		nodePos.x += ox;
		nodePos.y += oy;

		var topX = 0 - (size.width/2);
		var topY = 0 - (size.height/2);

		var movementX = 0-(nodePos.x - topX);
		var movementY = 0-(nodePos.y - topY);

		canvas.translate(movementX*1/canvas.scaleOffsetX, movementY*1/canvas.scaleOffsetY);
	}
}

/**
 * Work out the rectangle that is the extent of the current graph based on the location of the nodes.
 * Return an array with x,y,width,height representing the rectangle of the graph.
 */
function getBoundaries(graphview) {

	var leftmost = 0;
	var rightmost = 0;
	var topmost = 0;
	var bottommost = 0;

	graphview.graph.eachNode(function(node) {

		var width = node.getData('width');
		var height = node.getData('height');
		var pos = node.pos.getc(true);
		//alert(pos);

		//var pos2 = node.getPos();
		//alert(pos2.x+"|"+pos2.y);

		//alert("size iter="+width+":"+height);
		//alert("before iter="+pos.x+":"+pos.y);

		var x = pos.x-(width/2);
		var y = pos.y-(height/2);

		//alert("cound iter="+x+":"+y);

		if (x < leftmost) {
			leftmost = x;
		}
		if (x+width > rightmost) {
			rightmost = x+width;
		}
		if (y < topmost) {
			topmost = y;
		}

		if ((y)+(height) > bottommost) {
			bottommost = (y)+(height);
		}
	});

	var finalwidth = rightmost-leftmost;
	var finalheight = bottommost - topmost;

	return {
    	'x' : leftmost,
    	'y' : topmost,
        'width' : finalwidth,
        'height' : finalheight,
    };
}

/**
 * Create a PNG of the given graph canvas and popup in a print window.
 */
function printCanvas(graphview)  {
	var canvas = graphview.canvas;

	var rectangle = getBoundaries(graphview);
	var mapWidth = rectangle.width;
	var mapHeight = rectangle.height;

	// Need to reposition the map to top corner so all map is printed
	var size = canvas.getSize();
	size.width = size.width;
	size.height = size.height;
	var nodePos = {x:rectangle.x, y:rectangle.y}
	var	sx = canvas.scaleOffsetX;
	var	sy = canvas.scaleOffsetY;
	var	ox = canvas.translateOffsetX;
	var oy = canvas.translateOffsetY;
	nodePos.x *= sx;
	nodePos.y *= sy;
	nodePos.x += ox;
	nodePos.y += oy;
	var topX = 0 - (size.width/2);
	var topY = 0 - (size.height/2);
	var movementX = 0-(nodePos.x - topX);
	var movementY = 0-(nodePos.y - topY);
	canvas.translate(movementX*1/canvas.scaleOffsetX, movementY*1/canvas.scaleOffsetY);

	// Get data for pn image of map
    var dataUrl = document.getElementById(graphview.config.injectInto+'-canvas').toDataURL("image/png"); //get png of canvas

	// Create page of image to print
    var windowContent = '<!DOCTYPE html>';
    windowContent += '<html>'
    windowContent += '<head><title>Print Graph Canvas</title></head>';
    windowContent += '<body>';

	/*windowContent += '<style type="text/css">';
	windowContent += '@media print {';
	windowContent += 'input#btnPrint {';
	windowContent += 'display: none;';
	windowContent += '}';
	windowContent += '}';
	windowContent += '</style>';
	windowContent += '<input style="margin-left: 10px;" type="button" id="btnPrint" value=" <?php echo $LNG->FORM_BUTTON_PRINT_PAGE; ?> " onclick="window.print();return false;" />';
	*/

    windowContent += '<img src="' + dataUrl + '">';
    windowContent += '</body>';
    windowContent += '</html>';
    var printWin = window.open('','','width='+mapWidth+',height='+mapHeight);
    printWin.document.open();
    printWin.document.write(windowContent);
    printWin.document.close();
    printWin.focus();
    printWin.print();
    printWin.close();

	// Now restore previous location of map.
	var reverseX = 0-movementX;
	var reverseY = 0-movementY;
	canvas.translate(reverseX*1/canvas.scaleOffsetX, reverseY*1/canvas.scaleOffsetY);
}

function computeMostConnectedNode(graphview) {
	var connectedCount = "";
	var connectedNode = "";
    for(var i in graphview.graph.nodes) {
    	var n = graphview.graph.nodes[i];
    	var connections = n.getData('connections');
		if (connections.length > connectedCount) {
			connectedCount = connections.length;
			connectedNode = n;
        }
    }

	if (connectedNode != "") {
		FD_MOST_CONNECTED_NODE = connectedNode;
		if (!graphview.root) {
			graphview.root = connectedNode.id;
		}
	} else {
		//if all else fails, just pick the first node

		var root = -1;

		for(var i in graphview.graph.nodes) {
			var n = graphview.graph.nodes[i];
			FD_MOST_CONNECTED_NODE = n;
			graphview.root = n.id;
			root = n.id;
			break;
		}

		return root;
	}
}