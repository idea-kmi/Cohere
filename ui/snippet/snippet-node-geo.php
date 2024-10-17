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
 * snippet-node-geo.php
 * Created on 13th March 2013
 *
 * Michelle Bachler
 */

include_once("../../config.php");
include_once($CFG->homeAddress."ui/snippet/header.php");

$zoom = optional_param('zoom', "", PARAM_NUMBER);
$lat = optional_param('lat', "",PARAM_NUMBER);
$long = optional_param('lng', "", PARAM_NUMBER);
$groupid = optional_param('groupid', "", PARAM_INT);
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

<script type="text/javascript">//<![CDATA[
	NODE_ARGS['zoom'] = '<?php echo $zoom; ?>';
	NODE_ARGS['lat'] = '<?php echo $lat; ?>';
	NODE_ARGS['lng'] = '<?php echo $long; ?>';
	NODE_ARGS['fromsnippet'] = true;

	function loadGeoMap() {
        if (NODE_ARGS['groupid'] != "" || NODE_ARGS['userid'] != "" || NODE_ARGS['nodeid'] != "" || NODE_ARGS['urlid'] != "") {
			addScriptDynamically(URL_ROOT+"ui/visualize/gmap.js", 'gmap-script');
		} else {
			alert("Missing required id parameter");
		}
	}

    Event.observe(window, 'load', function() {
    	loadGeoMap();
    });
//]]>
</script>

<div id="tab-content-node" style="margin-bottom:10px;">
<p>Please wait while we load the geo map.</p><p>This embedded page requires JavaScript to be enabled.</p><p>If you have JavaScript disabled, please enable it then refresh the page.</p>
</div>

<?php
    include_once($CFG->homeAddress."ui/snippet/footer.php");
?>