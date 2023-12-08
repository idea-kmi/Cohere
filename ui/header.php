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

if( isset($_POST["loginsubmit"]) ) {
    $url = "http" . ((!empty($_SERVER["HTTPS"])) ? "s" : "") . "://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    header('Location: '.$CFG->homeAddress.'login.php?ref='.urlencode($url));
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cohere >>> make the connection</title>
<link rel="stylesheet" href="<?php echo $CFG->homeAddress; ?>ui/styles/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $CFG->homeAddress; ?>ui/styles/node.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $CFG->homeAddress; ?>ui/styles/tabber.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $CFG->homeAddress; ?>ui/styles/networknav.css" type="text/css" media="screen" />

<link rel="icon" href="<?php echo $CFG->homeAddress; ?>favicon.ico" type="images/x-icon" />

<script src="<?php echo $CFG->homeAddress; ?>ui/lib/prototype.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/dateformat.js" type="text/javascript"></script>

<script src="<?php echo $CFG->homeAddress; ?>ui/util.php" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/node.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/urls.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/conns.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/users.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

<script src="<?php echo $CFG->homeAddress; ?>ui/lib/jit-2.0.2/Jit/jit.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/networkmaps/forcedirectedlib.js.php" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/networkmaps/socialforcedirectedlib.js.php" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/networkmaps/networklib.js.php" type="text/javascript"></script>

<script src="<?php echo $CFG->homeAddress; ?>ui/lib/timeline/timeline_ajax/simile-ajax-api.js?bundle=true" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/timeline/timeline_js/timeline-api.js?bundle=true" type="text/javascript"></script>
<script>

<?php
$role = $CFG->DEFAULT_NODE_TYPE;
$defaultRole = new Role();
$defaultRole->loadByName($role);
$roleimage = $CFG->homeAddress.$defaultRole->image;
?>

var defaultRoleImage = "<?php echo $roleimage; ?>";
var defaultRoleName = "<?php echo $CFG->DEFAULT_NODE_TYPE; ?>";

</script>
<?php
    global $HEADER,$BODY_ATT;
    if(is_array($HEADER)){
        foreach($HEADER as $header){
            echo $header;
        }
    }
?>
<script type="text/javascript">
function init(){
	setInterval("updateuserstatus()", 600000); // Update every 10 minute
}

function cleanup(){
	if (document.getElementById("Cohere-SocialNet")) {
		obj = document.getElementById("Cohere-SocialNet");
		obj.stop();
		obj.destroy();
		if (document.getElementById("tab-content-svn")) {
			document.getElementById("tab-content-svn").innerHTML="";
		}
	}
	if (document.getElementById("Cohere-ConnectionNet")) {
		obj = document.getElementById("Cohere-ConnectionNet");
		obj.stop();
		obj.destroy();
		if (document.getElementById("tab-content-conn")) {
			document.getElementById("tab-content-conn").innerHTML="";
		}
	}
}

function setSearchResultTab(){
    // set the action for the search form (to preserve the tab/visualisation)
    $('searchform').setAttribute('action',"<?php print($CFG->homeAddress);?>results.php#" + getAnchorVal('node-list'));
}

window.onload = init;
window.onunload = cleanup;

function updateuserstatus() {
	new Ajax.Request('../updateuserstatus.php', { method:'get' });
}
</script>

</head>
<body <?php echo $BODY_ATT; ?> id="cohere-body">

<div id="header">
    <div style="background-color:#e8e8e8; color:dimgray; float:left; width:100%; padding:10px; font-size:14pt; font-weight:bold"> Demo Only Site - Please use our new tool <a href="https://litemap.net"><img border="0" height="28" style="vertical-align:middle; padding-left:5px;" src="../images/evidence-hub-logo-header.png" /></a></div>

    <div id="logo" style="clear:both;">
        <a href="<?php echo $CFG->homeAddress; ?>index.php" title="Cohere home page"><img border="0" alt="Cohere home page" src="<?php echo $CFG->homeAddress; ?>images/cohere_logo2.png" /></a>
        <img class="hourglass" alt="Please wait" src="<?php echo $CFG->homeAddress; ?>images/hourglass.png" />
        <div style="clear: both;"><a href="#content" class="accesslink">Skip to content</a></div>
    </div>

    <div style="float: right;">

		<div id="menu">
			<?php
				global $USER;
				if(isset($USER->userid)){
					if($USER->name == ""){
						$name = $USER->getEmail();
					} else {
						$name = $USER->name;
					}
					echo "Signed in as: <a title='edit profile' href='".$CFG->homeAddress."profile.php'>". $name ."</a> | <a title='Sign Out' href='".$CFG->homeAddress."logout.php'>Sign Out</a> ";

				} else {
					echo "<form style='margin:0; padding:0; float:left;' id='loginform' action='' method='post'><input style='margin:0; padding:0;border:none; background:white;font-family: Arial, Helvetica, sans-serif; font-size: 10pt' id='loginsubmit' name='loginsubmit' type='submit' value='Sign In' class='active' title='Sign In'></input></form>";

					// | <a title='Sign Up' href='".$CFG->homeAddress."register.php'>Sign Up</a> ";
					//echo "<a title='Sign In' href='".$CFG->homeAddress."login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."register.php'>Sign Up</a> ";
				}
			?>
			| <a href='<?php print($CFG->blogAddress);?>'>Blog</a>
			| <a href='<?php echo $CFG->homeAddress; ?>about.php'>About</a>
			| <a href='<?php echo $CFG->homeAddress; ?>help/'>Help</a>

			<?php
			if($USER->getIsAdmin() == "Y"){
				echo "| <a title='Admin' href='".$CFG->homeAddress."admin/index.php'>Admin </a>";
			}
			?>
		</div>

		<div id="search">

			<form name="search" action="<?php print($CFG->homeAddress);?>results.php" method="get" id="searchform" onsubmit="return setSearchResultTab()">

				<div style="clear: both; float: left;">
					<a style="float: left; margin-right: 20px; margin-top: 3px; color: #e80074;" title="Click to view some example searches" href="#" onclick="toggleDiv('searchExamplesPanel')" onkeypress="enterKeyPressed(event)">Search Examples...</a>

					<div id="searchExamplesPanel" style="clear: both; background: #d3e8e8; position: absolute; display: none; border: 1px solid #308D88" onkeypress="enterKeyPressed(event)">
						<p style="margin-left: 2px;">

						<ul style="padding: 2px; margin:2px; list-style: none; margin-bottom:5px; font-weight: bold;">
						<!--li style="margin-bottom:6px;"><a href="http://cohere.open.ac.uk/node.php?nodeid=137108252141195571923&amp;start=0&amp;max=20&amp;orderby=date&amp;sort=DESC&amp;direction=left&amp;filtergroup=&amp;filterlist=&amp;netnodeid=&amp;netq=&amp;netscope=&amp;focalnode=137108252141195571923#conn-neighbour">Black IQ Scores Debate</a>
						 (<a href="http://cohere.open.ac.uk/node.php?nodeid=137108252141195571923&start=0&max=20&orderby=date&sort=DESC&direction=left&filtergroup=&filterlist=&netnodeid=137108252141195571923&netq=supports%2Cresponds%20to%2Cchallenges&netscope=all&nodelabel=On%20every%20measure%20of%20intellectual%20ability%20and%20educational%20attainment%20Blacks%20perform%20significantly%20worse%2C%20on%20average%2C%20than%20Whites.#conn-net">Network View</a>)<br-->

						 <li style="margin-bottom:6px;">COP15 Climate Change Conference - Main Issues
						 (<a href="http://cohere.open.ac.uk/group.php?groupid=137108251180957957001258741020&start=0&max=20&orderby=date&sort=DESC&direction=right&filtergroup=&filterlist=&netnodeid=&netq=&netscope=&nodelabel=%23COP15#conn-net">Network View</a>)<br>

						 <li style="margin-bottom:6px;"><a href="http://cohere.open.ac.uk/node.php?nodeid=1371081741340283942001260805078#conn-neighbour">Humans are the main influence on climate change</a></li>

						 <li style="margin-bottom:6px;"><a href="http://cohere.open.ac.uk/node.php?nodeid=9396932240241950001231360289#conn-neighbour">What are the top ten claims of climate sceptics?</a>
						 (<a href="http://cohere.open.ac.uk/group.php?groupid=137108251480800349001234365781&focalnode=9396932240241950001231360289#conn-net">Network View</a>)</li>

						<li style="margin-bottom:6px;"><a href="http://cohere.open.ac.uk/node.php?nodeid=8653491981196929343&start=0&max=20&orderby=date&sort=DESC&direction=right&filtergroup=&filterlist=&netnodeid=&netq=&netscope=&focalnode=8653491981196929343#conn-neighbour">CETIS 2007 Workshop on Semantic Structures for Teaching and Learning</a>
						 <br>(<a href="http://cohere.open.ac.uk/results.php?q=T%3Acetis&scope=all&start=0&max=20&orderby=date&sort=DESC&direction=right&filtergroup=&filterlist=&netnodeid=&netq=&netscope=#conn-net">Network View</a>)<br>

						<li style="margin-bottom:6px;><a href="http://cohere.open.ac.uk/node.php?nodeid=19276146511200983756&start=0&max=20&orderby=date&sort=DESC&direction=left&filtergroup=&filterlist=&netnodeid=&netq=&netscope=&focalnode=19276146511200983756#conn-neighbour">Argumentation and Social Networks</a>
						 (<a href="http://cohere.open.ac.uk/results.php?q=T%3Adagstuhl&scope=all&start=0&max=20&orderby=date&sort=DESC&direction=right&filtergroup=&filterlist=&netnodeid=&netq=&netscope=#conn-net">Network View</a>)<br>

						<li style="margin-bottom:6px;"><a href="http://cohere.open.ac.uk/user.php?userid=137108242490292899001209567757174240793#node-gmap">Blog feed</a>
						 (<a href="http://cohere.open.ac.uk/user.php?userid=137108242490292899001209567757174240793#node-gmap">Google Maps view</a>)</li>
						</ul>

						</p>
						<a style="float: right; margin: 3px;" href="javascript:toggleDiv('searchExamplesPanel')">Close</a>
					</div>
				</div>

				<label for="q" style="float: left; margin-right: 3px; margin-top: 3px;">Search</label>

				<?php
					// if search term is present in URL then show in search box
					$q = stripslashes(optional_param("q","",PARAM_TEXT));
					$scope = optional_param("scope","all",PARAM_ALPHA);
					$tagsonly = optional_param("tagsonly","false",PARAM_BOOLTEXT);
				?>

				<div style="float: left;">
					<input type="text" style=" margin-right:3px; width:250px" id="q" name="q" value="<?php print( htmlspecialchars($q) ); ?>"/>
					<div style="clear: both;">
					<?php
						//only show option to restrict to my items if user logged in
						if (isset($USER->userid)) {
						?>
							<input type="radio" name="scope" value="my" <?php if ($scope == 'my'){ echo "checked='checked'";}?>/>My Items &nbsp;
							<input type="radio" name="scope" value="all" <?php if ($scope == 'all'){ echo "checked='checked'";}?>/> All &nbsp;
						<?php
							} else {
						?>
							<input type="hidden" name="scope" value="all"/>
						<?php
						}
						?>
						<input type="checkbox" name="tagsonly" value="true" <?php if ($tagsonly == 'true'){ echo "checked='checked'";}?>/> Tags Only &nbsp;
					</div>
					<div id="q_choices" class="autocomplete" style="border-color: white;"></div>
				 </div>
				 <div style="float:left;"><input type="submit" value="Go"/></div>
			 </form>
		 </div>
     </div>
</div>
<div id="message" style="padding:5px; width: 250px; height: 80px; position: absolute; left:0px; top:0px; overflow: auto; display: none; color: white; background-color: #40B5B2; font-face: Arial; font-weight:bold"></div>
<div id="main">
<div id="contentwrapper">
<div id="content">
<div class="c_innertube">