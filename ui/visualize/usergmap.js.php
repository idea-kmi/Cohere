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

var usergeomap;

function loadUserGMap(){

	if (!USER_ARGS['fromsnippet']) {
		var tb1 = new Element("div", {'class':'toolbarrow'});
		$("tab-content-user").update(tb1);
		tb1.insert(displayUserVisualisations('usergmap'));
		tb1.insert(displaySnippetButtons(SNIPPET_USER_GEO));
	} else {
		$("tab-content-user").update("");
	}

	$("tab-content-user").insert('<div style="clear: both; margin:0px; padding: 0px;"></div>');
	$("tab-content-user").insert('<div id="my-usermap" style="height: 400px; border: 1px solid #aaa"><?php echo $LNG->GEO_BROWSER_INCOMPATIBLE; ?></div>');
	$("tab-content-user").insert('<div id="user-usergmap-loading"></div>');
	$("user-usergmap-loading").insert(getLoading("<?php echo $LNG->GEO_USER_LOADING; ?>"));

	var zoomNum = 2;
	if (USER_ARGS['zoom'] != 'undefined' && USER_ARGS['zoom'] != "") {
		zoomNum = parseInt(USER_ARGS['zoom']);
	}

	var lat= 17.383;
	if (USER_ARGS['lat'] != 'undefined' && USER_ARGS['lat'] != "") {
		lat = USER_ARGS['lat'];
	}

	var lng = 11.183;
	if (USER_ARGS['lng'] != 'undefined' && USER_ARGS['lng'] != "") {
		lng = USER_ARGS['lng'];
	}

	usergeomap = L.map('my-usermap').setView([lat, lng], zoomNum);
	L.tileLayer('<?php echo $CFG->maptilesurl; ?>', {
	   attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
	   maxZoom: 18,
	   crossOrigin: true
	}).addTo(usergeomap);

	loadUserMapMarkers();
}

function loadUserMapMarkers(){
	var url = SERVICE_ROOT.replace('format=json','format=gmap');
	var args = Object.clone(USER_ARGS);
	args["start"] = 0;
	//get all (not just the normal 20 max)
	args["max"] = -1;
	var reqUrl = url+"&method=getusersby"+CONTEXT+"&includegroups=false&"+Object.toQueryString(args);
	new Ajax.Request(reqUrl, { method:'get',
  			onSuccess: function(transport){
  					var json = transport.responseText.evalJSON();
  					try {
  						var json = transport.responseText.evalJSON();
  					} catch(e) {
  						alert("There was an error loading the geo map data.");
						($("user-usergmap-loading")).remove();
  						return;
  					}

	      			if(json.error){
	      				alert(json.error[0].message);
						($("user-usergmap-loading")).remove();
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
								title = data.city;
								titleArray[ key ] = title;
							}
						}

						if (checker[ key ]) {
							var html = checker[key];
							var newhtml = "<div style='margin: 3px; clear: both;float:left;'><div style='clear:both;float:left'><img class='forminput' style='margin-right:5px;' src='"+data.thumb+"'/>";
							newhtml += "<a href='"+URL_ROOT+"user.php?userid="+data.id+"'>"+ data.title + "</a></div>";
							newhtml += "<div style='margin-bottom: 3px;clear:both;float:left'>"+ data.desc + "</div></div>";
							html += newhtml;
							checker[ key ] = html;
							countArray[ key ] = countArray[ key ] + 1;
							countlocations = countlocations +1;
						} else {
							var html = "<div style='margin: 3px; clear: both;float:left;'><div style='clear:both;float:left'><img class='forminput' style='margin-right:5px;' src='"+data.thumb+"'/>";
							html += "<a href='"+URL_ROOT+"user.php?userid="+data.id+"'>"+ data.title + "</a></div>";
							html += "<div style='margin-bottom: 3px;clear:both;float:left'>"+ data.desc + "</div></div>";
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
							var html = "<div style='overflow-y: auto; height: 200px; width: 310px;'>";
							if (titleArray[ key ]) {
								html += "<h2>"+titleArray[ key ]+" <span id=style='color: black; font-size:10pt'>("+countArray[ key ]+")</span></h2>";
							} else {
								html += "<h2><span id=style='color: black; font-size:10pt'>("+countArray[ key ]+")</span></h2>";
							}

							html += checker[ key ];
							html += "</div>";

							var title = "";
							if (titleArray[ key ]) {
								if (countArray[ key ] == 1) {
									title = titleArray[ key ] + " - " + data.title;
								} else {
									title = titleArray[ key ] + " (" + countArray[ key ] + ")";
								}
							} else {
								if (countArray[ key ] == 1) {
									title = data.title;
								} else {
									title = "(" + countArray[ key ] + ")";
								}
							}
							createUserMarker(data.lat,data.lng, title, html);
							checkerDone[ key ] = 'true';
						}
					}

					($("user-usergmap-loading")).remove();
    		}
  		});
}

/**
 * Create a marker with correct listener event
 */
function createUserMarker(lat, lng, title, html) {

	var marker = L.marker([lat,lng], {title: title}).addTo(usergeomap);
	marker.bindPopup(html); //.openPopup();
}

loadUserGMap();