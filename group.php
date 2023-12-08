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
    include_once("config.php");
    array_push($HEADER,'<script src="'.$CFG->homeAddress.'ui/tabber.js" type="text/javascript"></script>');
    include_once($CFG->dirAddress."ui/header.php");
    include_once($CFG->dirAddress."ui/tabberlib.php");
    global $USER;

    $groupid = required_param("groupid",PARAM_ALPHANUMEXT);

	// default parameters
    $start = optional_param("start",0,PARAM_INT);
    $max = optional_param("max",20,PARAM_INT);
    $orderby = optional_param("orderby","date",PARAM_ALPHA);
    $sort = optional_param("sort","DESC",PARAM_ALPHA);

	// filter parameters
    $direction = optional_param("direction","right",PARAM_ALPHA);
    $filtergroup = optional_param("filtergroup","",PARAM_TEXT);
    $filterlist = optional_param("filterlist","",PARAM_TEXT);
    $filternodetypes = optional_param("filternodetypes","",PARAM_TEXT);

	// network search parameters
    $netnodeid = optional_param("netnodeid","",PARAM_ALPHANUMEXT);
    $netq = optional_param("netq","",PARAM_TEXT);
    $netscope = optional_param("netscope","",PARAM_ALPHA);
    $netlinkgroup = optional_param("netlinkgroup","",PARAM_TEXT);
    $netdepth = optional_param("netdepth",1,PARAM_INT);
    $netdirection = optional_param("netdirection",'both',PARAM_ALPHA);
    $netlabelmatch = optional_param("netlabelmatch",'false',PARAM_BOOLTEXT);

	// Geo parameters
	$zoom = optional_param('zoom', "", PARAM_NUMBER);
	$lat = optional_param('lat',"", PARAM_NUMBER);
	$long = optional_param('lng', "", PARAM_NUMBER);

    $agentlastrun = optional_param("agentlastrun",'',PARAM_ALPHANUMEXT);

    $group = getGroup($groupid);
    //getGroup does not return group properties apart from its members

    if($group instanceof Error){
        echo "<h1>Group not found</h1>";
        include_once($CFG->dirAddress."ui/footer.php");
        die;
    }
?>
    <div id="context">
        <div id="contextimage">
            <img src="<?php print $group->photo;?>"/></div>
        <div id="contextinfo">
            <h1>Group: <?php print $group->name; ?></h1>
            <?php
				if($USER->getIsAdmin() == "Y"){
					echo "<a title='stats' href='".$CFG->homeAddress."admin/groupContextStats.php?groupid=".$groupid."'> (stats) </a>";
					echo "&nbsp;&nbsp;<a title='stats-new' href='".$CFG->homeAddress."admin/groupContextStats2.php?groupid=".$groupid."'> (tag stats) </a>";
				}
                if($group->description != ""){
                    echo "<p>".$group->description."</p>";
                }
                if($group->website != ""){
                    echo "<p><a href='".$group->website."'>".$group->website."</a></p>";
                }
            ?>
        </div>
    </div>
    <div style="clear:both;"></div>
<?php

    $args = array();
    $args["groupid"] = $groupid;

    $args["start"] = $start;
    $args["max"] = $max;
    $args["orderby"] = $orderby;
    $args["sort"] = $sort;

    $args["direction"] = $direction;
    $args["filtergroup"] = $filtergroup;
    $args["filterlist"] = $filterlist;
    $args["filternodetypes"] = $filternodetypes;
    $args["filterusers"] = "";

    $args["netnodeid"] = $netnodeid;
    $args["netq"] = $netq;
    $args["netscope"] = $netscope;
    $args["netlinkgroup"] = $netlinkgroup;
    $args["netdepth"] = $netdepth;
    $args["netdirection"] = $netdirection;
    $args["netlabelmatch"] = $netlabelmatch;

	$args['zoom'] = $zoom;
	$args['lat'] = $lat;
	$args['lng'] = $long;

    $args["agentlastrun"] = $agentlastrun;

    $args["title"] = $group->name;

    display_tabber($CFG->GROUP_CONTEXT,$args);

    include_once($CFG->dirAddress."ui/footer.php");
?>
