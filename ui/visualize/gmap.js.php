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

var nodegeomap;

function loadNodeMap(){

	if (!NODE_ARGS['fromsnippet']) {
		var tb1 = new Element("div", {'class':'toolbarrow'});
		$("tab-content-node").update(tb1);
		tb1.insert(displayNodeAdd());
		tb1.insert(displayNodeVisualisations('gmap'));
		tb1.insert(displaySnippetButtons(SNIPPET_IDEA_GEO));
	} else {
		$("tab-content-node").update("");
	}

	$("tab-content-node").insert('<div style="clear: both; margin:0px; padding: 0px;"></div>');
	$("tab-content-node").insert('<div id="my-nodemap" style="height: 400px; border: 1px solid #aaa"><?php echo $LNG->GEO_BROWSER_INCOMPATIBLE; ?></div>');
	$("tab-content-node").insert('<div id="node-nodegmap-loading"></div>');

	$("node-nodegmap-loading").insert(getLoading("<?php echo $LNG->GEO_LOADING; ?>"));

	var zoomNum = 2;
	if (NODE_ARGS['zoom'] != 'undefined' && NODE_ARGS['zoom'] != "") {
		zoomNum = parseInt(NODE_ARGS['zoom']);
	}

	var lat= 17.383;
	if (NODE_ARGS['lat'] != 'undefined' && NODE_ARGS['lat'] != "") {
		lat = NODE_ARGS['lat'];
	}

	var lng = 11.183;
	if (NODE_ARGS['lng'] != 'undefined' && NODE_ARGS['lng'] != "") {
		lng = NODE_ARGS['lng'];
	}

	nodegeomap = L.map('my-nodemap').setView([lat, lng], zoomNum);
	L.tileLayer('<?php echo $CFG->maptilesurl; ?>', {
	   attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
	   maxZoom: 18,
	   crossOrigin: true
	}).addTo(nodegeomap);

	loadMapMarkers();
}

function loadMapMarkers(){
	var url = SERVICE_ROOT.replace('format=json','format=gmap');
	var args = Object.clone(NODE_ARGS);

	args["start"] = 0;
	args["max"] = -1;

	var reqUrl = url+"&method=getnodesby"+CONTEXT+"&"+Object.toQueryString(args);



	new Ajax.Request(reqUrl, { method:'get',
  			onSuccess: function(transport){
				var json = transport.responseText.evalJSON();
				if(json.error){
					alert(json.error[0].message);
					return;
				}

				var checker = new Array();
				var titleArray = new Array();
				var countArray = new Array();
				var countlocations = 0;

				for(var i=0; i<json.locations.length; i++){
					var data = json.locations[i];
					var key = data.lat+"-"+data.lng;

					if (!titleArray[key]) {
						if (data.city) {
							title = data.title;
							titleArray[ key ] = title;
						}
					}

					var desc = nl2br(data.desc);

					if (checker[ key ]) {
						var html = checker[key];
						var newhtml = "<div style='margin: 3px; clear: both;float:left;'><div style='clear:both;float:left'><img class='forminput' style='margin-right:5px;' src='"+data.thumb+"'/>";
						newhtml += "<a href='"+URL_ROOT+"node.php?nodeid="+data.id+"'>"+ data.title + "</a></div>";
						newhtml += "<div style='margin-bottom: 3px;clear:both;float:left'>"+ desc + "</div></div>";
						html += newhtml;
						checker[ key ] = html;
						countArray[ key ] = countArray[ key ] + 1;
						countlocations = countlocations +1;
					} else {
						var html = "<div style='margin: 3px; clear: both;float:left;'><div style='clear:both;float:left'><img class='forminput' style='margin-right:5px;' src='"+data.thumb+"'/>";
						html += "<a href='"+URL_ROOT+"node.php?nodeid="+data.id+"'>"+ data.title + "</a></div>";
						html += "<div style='margin-bottom: 3px;clear:both;float:left'>"+ desc + "</div></div>";
						checker[key] = html;
						countArray[ key ] = 1;
						countlocations = countlocations +1;
					}
				}

				var checkerDone = new Array();

				for(var i=0; i<json.locations.length; i++){
					var data = json.locations[i];
					var key = data.lat+"-"+data.lng;
					if (!checkerDone[ key ]) {
						var html = "<div style='overflow-y: auto; height: 150px; width: 250px;'>";
						if (countArray[ key ] > 1) {
							if (titleArray[ key ] ) {
								html += "<h2>"+'Ideas'+" <span id=style='color: black; font-size:10pt'>("+countArray[ key ]+")</span></h2>";
							} else {
								html += "<h2><span id=style='color: black; font-size:10pt'>("+countArray[ key ]+")</span></h2>";
							}
						}

						html += checker[ key ];
						html += "</div>";

						var title = "";
						if (titleArray[ key ]) {
							if (countArray[ key ] == 1) {
								title = titleArray[ key ];
							} else {
								title = 'Ideas' + " (" + countArray[ key ] + ")";
							}
						} else {
							if (countArray[ key ] == 1) {
								title = data.title;
							} else {
								title = "(" + countArray[ key ] + ")";
							}
						}

						createMarker(data.lat,data.lng, title, html);
						checkerDone[ key ] = 'true';
					}
				}
				($("node-nodegmap-loading")).remove();
    		},
    		onFailure: function(){
    			alert('<?php echo $LNG->GEO_LOADING_ERROR_FAILURE; ?>')
    		}
  		});
}

/**
 * Create a marker with correct listener event
 */
function createMarker(lat, lng, title, html) {

	var marker = L.marker([lat,lng], {title: title}).addTo(nodegeomap);
	marker.bindPopup(html); //.openPopup();
}

loadNodeMap();