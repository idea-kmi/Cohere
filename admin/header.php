<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>
Cohere >>> make the connection
</title>
<link rel="stylesheet" href="<?php echo $CFG->homeAddress; ?>ui/styles/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $CFG->homeAddress; ?>ui/styles/tabber.css" type="text/css" media="screen" />
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

<?php
    global $HEADER,$BODY_ATT;
    if(is_array($HEADER)){
        foreach($HEADER as $header){
            echo $header;
        }
    }
?>

</head>
<body <?php echo $BODY_ATT; ?> id="cohere-body">

<div id="header">
    <div id="logo">
        <a href="<?php echo $CFG->homeAddress; ?>index.php" title="Cohere homepage"><img border="0"alt="Cohere Logo" src="<?php echo $CFG->homeAddress; ?>images/cohere_logo2.png" /></a>
        <img class="hourglass" src="<?php echo $CFG->homeAddress; ?>images/hourglass.png" />
        <a href="#content" class="accesslink">Skip to content</a>
    </div>
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
                echo "<a title='Sign In' href='".$CFG->homeAddress."login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."register.php'>Sign Up</a> ";
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
</div>

<div id="main">
<div id="contentwrapper">
<div id="content">
<div class="c_innertube">
