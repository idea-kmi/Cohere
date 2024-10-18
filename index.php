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
    include_once("config.php");
    array_push($HEADER,'<script src="'.$CFG->homeAddress.'ui/homepage.js" type="text/javascript"></script>');
    include_once($CFG->dirAddress."ui/header.php");
?>

<style type="text/css">
#tab-content-welcome {
    font-size: 140%;
    font-weight:bold;
}

#home1 {
    width: 225px;
    float: left;
    margin: 10px;
    margin-left: 5px;
}
#home2 {
    width: 235px;
    float: left;
    margin: 10px;
    margin-left: 0px;
    margin-right: 5px;
}
#home3 {
     width: 225px;
    float: left;
    margin: 10px;
    margin-right: 0px;
}
.hi-light {
    color: #e80074;
}

ul.home-node-head-list {
   list-style:none;
   margin: 0px 0px 0px 15px;
   padding: 3px;
}

li.home-node-head-item {
   font-weight: bold;
   display:inline;
   margin-left: 10px;
}

li.current {
   color: #40B5B2;
   padding: 3px;
   border: 1px solid #FACEE3;
}

li.option {
    color: #e80074;
    cursor:pointer;
    padding: 3px;
}
</style>
    <div id="tabber">
        <ul id="tabs" class="tab">
            <li class="tab"><a class="tab" id="tab-home" href="#home"><span class="tab">Home</span></a></li>
            <li class="tab"><a class="tab" id="tab-screencast" href="#screencast"><span class="tab">Screencasts</span></a></li>
            <li class="tab"><a class="tab" id="tab-node" href="#node"><span class="tab">Ideas</span></a></li>
            <li class="tab"><a class="tab" id="tab-conn" href="#conn"><span class="tab">Connections</span></a></li>
            <li class="tab"><a class="tab" id="tab-user" href="#user"><span class="tab">People &amp; Groups</span></a></li>
        </ul>
        <div id="tabs-content">
           <div id='tab-content-home' class='tabcontenthome'>
			  <div style="float:left;">

				<div style="float:left; padding-left: 5px;">
					 <strong><p>The Web is about IDEAS+PEOPLE.</p>
					 <p>Cohere is a visual tool to create, connect and share Ideas.</p>
					 Back them up with websites. Support or challenge them. Embed them to spread virally.<br/>
					 Discover who - literally - connects with your thinking.</strong>
					 <div id="steps">
						 <div id="home1"><img alt="" src="images/home/idea-blob-step1b.png"/><br/>Publish <a href="index.php#node" onclick="setTabPushed('node')">ideas</a> and optionally add relevant websites</div>
						 <div id="home2"><img alt="" src="images/home/idea-blob-step2b.png"/><br/>Weave webs of <a href="index.php#conn" onclick="setTabPushed('conn')">meaningful connections</a> between ideas: your own and the world's</div>
						 <div id="home3"><img alt="" src="images/home/idea-blob-step3.png"/><br/>Discover new <a href="index.php#node" onclick="setTabPushed('node')">ideas</a> and <a href="index.php#user" onclick="setTabPushed('user')">people</a></div>
						 <div style="clear:both;"></div>
					 </div>
				</div>

				<div style="clear: both; float:left; margin-left: 5px; margin-top: 10px; padding-bottom: 10px; ">
					<div style="clear:both; float:left; margin-bottom: 10px; height: 20px; background:#F8EAF3; width: 735px; padding-left: 5px; padding-top: 4px;"><strong>Example Network View.</strong></div>
					<img src="images/home/homepage-network3.png" style="border:2px solid gray;" />
				</div>

				<div id="tab-content-home-conn" style="overflow: hidden; clear:both; float:left; width: 740px; padding-right: 5px: 0px; padding: 0px; margin-top:10px; margin-left: 5px;">
					<div style="margin-bottom:10px; height: 20px; background:#F8EAF3; padding-left: 5px; padding-top: 4px; "><strong>Most Recent Connection</strong></div>
				</div>
			 </div>
           </div>

        <!-- div id="tab-content-tags" class="tabcontent">
        <div id="tagcloud" style="width:98%">
   		<ul>
       	<?php
           		$tags = getTagsForCloud(0);

           		if ($tags != null) {

       	    		// get the count range first
       	    		$minCount = -1;
       	    		$maxCount = -1;
       	    		foreach($tags as $tag) {
       	    			$count = $tag['UseCount'];
       	    			if ($count > $maxCount) {
       	    				$maxCount = $count;
       	    			}
       	    			if ($minCount == -1) {
       	    				$minCount = $count;
       	    			} else if ($count < $minCount) {
       	    				$minCount = $count;
       	    			}
       	    		}
           			//echo $maxCount."<br>";
           			//echo $minCount."<br>";


           			if ($maxCount < 10) {
           				$range = 1;
           			} else {
           				$range = round(($maxCount - $minCount) / 10);
           			}
           			//echo $range."<br>";

       	    		$i = 0;
       	    		foreach($tags as $tag) {

       	    			$cloudlistcolour = "";
       	    			if ($i % 2) {
       	    				$cloudlistcolour = "#40b5b2";
       	    			} else {
       	    				$cloudlistcolour = "#e80074";
       	    			}
       	    			$i++;

       	    			$count = $tag['UseCount'];

    					if ($count < 2) {
       	    				echo '<li class="tag1" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
    					} else if ($count >= 2 && $count < 4) {
       	    				echo '<li class="tag2" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
    					} else if ($count >= 4 && $count < 6) {
       	    				echo '<li class="tag3" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
    					} else if ($count >= 6 && $count < 8) {
       	    				echo '<li class="tag4" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
    					} else if ($count >= 8 && $count < 10) {
       	    				echo '<li class="tag5" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
    					} else if ($count >= 10 && $count < 12) {
       	    				echo '<li class="tag6" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
    					} else if ($count >= 12 && $count < 14) {
       	    				echo '<li class="tag7" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
    					} else if ($count >= 14 && $count < 16) {
       	    				echo '<li class="tag8" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
    					} else if ($count >= 16 && $count < 18) {
       	    				echo '<li class="tag9" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
    					} else if ($count >= 18) {
       	    				echo '<li class="tag10" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
    					}


       	    			/*if ($count >= $minCount && $count < $minCount+$range) {
       	    				echo '<li class="tag1" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
       	    			} else if ($count >= $minCount+($range*1) && $count < $minCount+($range*2)) {
       	    				echo '<li class="tag2" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
       	    			} else if ($count >= $minCount+($range*2) && $count < $minCount+($range*3)) {
       	    				echo '<li class="tag3" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
       	    			} else if ($count >= $minCount+($range*3) && $count < $minCount+($range*4)) {
       	    				echo '<li class="tag4" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
       	    			} else if ($count >= $minCount+($range*4) && $count < $minCount+($range*5)) {
       	    				echo '<li class="tag5" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
       	    			} else if ($count >= $minCount+($range*5) && $count < $minCount+($range*6)) {
       	    				echo '<li class="tag6" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
       	    			} else if ($count >= $minCount+($range*6) && $count < $minCount+($range*7)) {
       	    				echo '<li class="tag7" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
       	    			} else if ($count >= $minCount+($range*7) && $count < $minCount+($range*8)) {
       	    				echo '<li class="tag8" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
       	    			} else if ($count >= $minCount+($range*8) && $count < $minCount+($range*9)) {
       	    				echo '<li class="tag9" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
       	    			} else if ($count >= $minCount+($range*9))  {
       	    				echo '<li class="tag10" title="'.$count.'"><a href="'.$CFG->homeAddress.'tagsearch.php?q='.$tag['Name'].'&scope=all&tagsonly=true" style="color: '.$cloudlistcolour.';">'.$tag['Name'].'</a></li>';
       	    			}*/
       	    		}
           		}
           	?>

       	</ul>
       </div>
       </div -->

            <div id='tab-content-screencast' class='tabcontent'>
                <h2>Screencasts</h2>

                <h3>Introduction to Cohere</h3>
                <div>
                    <div style="float:left;">
                        <object width="425" height="350"> <param name="movie" value="http://www.youtube.com/v/eBS03VoWWAA"> </param> <embed src="http://www.youtube.com/v/eBS03VoWWAA" type="application/x-shockwave-flash" width="425" height="350"> </embed> </object>
                    </div>
                    <div style="float:left;padding:10px;">
                        <a href="<?php echo $CFG->homeAddress; ?>ui/screencasts/intro/">View a high-resolution version (approx 67Mb)</a>
                    </div>
                    <div style="clear:both;"></div>
                </div>

                <h3>Help Screencasts</h3>

                <table class='table' cellspacing='0' cellpadding='3' border='0'>
                   <tr>
                        <td><b>How to add an Idea</b></td>
                        <td><div id="add-idea-sc"></div><span id="add-idea-sc-open" class="active">on YouTube</span><span id="add-idea-sc-close" class="active">close</span></td>
                        <td><a href="<?php echo $CFG->homeAddress; ?>ui/screencasts/Cohere-NewIdea/Cohere-NewIdea.html">View a high-resolution version (approx 16Mb)</a></td>
                    </tr>
                    <tr>
                        <td><b>How to add a Connection</b></td>
                        <td><div id="add-conn-sc"></div><span id="add-conn-sc-open" class="active">on YouTube</span><span id="add-conn-sc-close" class="active">close</span></td>
                        <td><a href="<?php echo $CFG->homeAddress; ?>ui/screencasts/cohere-NewConnection/cohere-NewConnection.html">View a high-resolution version (approx 27Mb)</a></td>
                    </tr>
                    <tr>
                        <td><b>How to add a Website</b></td>
                        <td><div id="add-url-sc"></div><span id="add-url-sc-open" class="active">on YouTube</span><span id="add-url-sc-close" class="active">close</span></td>
                        <td><a href="<?php echo $CFG->homeAddress; ?>ui/screencasts/Cohere-NewWebsite/Cohere-NewWebsite.html">View a high-resolution version (approx 16Mb)</a></td>
                    </tr>
                </table>

                <h3>OER Screencasts</h3>

                <table class='table' cellspacing='0' cellpadding='3' border='0'>
                	<tr>
	            		<td><b>Gathering OER Collective Intelligence</b></td>
	            		<td><div id="ci-oer-sc"></div><span id="ci-oer-sc-open" class="active">on YouTube</span><span id="ci-oer-sc-close" class="active">close</span></td>
	            		<td><a href="<?php echo $CFG->homeAddress; ?>ui/screencasts/OLnet-CI.m4v">View a high-resolution version (approx 45Mb)</a></td>
	            	</tr>
                </table>

                <script type="text/javascript">
                </script>

                <h3>Jetpack Movies (An experimental Firefox Extension)</h3>
                <table class='table' cellspacing='0' cellpadding='3' border='0'>
		            <tr>
		        		<td><b>Mozilla Firefox Competition 2009: Jetpack for Learning</b></td>
		        		<td><a title="Go to YouTube to watch movie" href="http://www.youtube.com/watch?v=xKykgBo-zGI">on YouTube</td>
		        	</tr>
	               	<tr>
                		<td><b>Quick Overview</b></td>
                		<td><a title="Go to YouTube to watch movie" href="http://www.youtube.com/watch?v=uOPtKYU8I3A">on YouTube</td>
                 	</tr>
                	<tr>
            			<td><b>Login</b></td>
            			<td><a title="Go to YouTube to watch movie" href="http://www.youtube.com/watch?v=wiS4HY7MVI8">on YouTube</td>
            		</tr>
                	<tr>
        				<td><b>Clips Slidebar</b></td>
        				<td><a title="Go to YouTube to watch movie" href="http://www.youtube.com/watch?v=W1B_z9HH3kY">on YouTube</td>
        			</tr>
                	<tr>
    					<td><b>Ideas Slidebar</b></td>
    					<td><a title="Go to YouTube to watch movie" href="http://www.youtube.com/watch?v=yRw3zN_GypM">on YouTube</td>
     				</tr>
                	<tr>
						<td><b>Connections Slidebar</b></td>
						<td><a title="Go to YouTube to watch movie" href="http://www.youtube.com/watch?v=fFlAc9Xh3C0">on YouTube</td>
					</tr>
                	<tr>
						<td><b>Navigation the Web through Ideas and Connections</b></td>
						<td><a title="Go to YouTube to watch movie" href="http://www.youtube.com/watch?v=q3hvFNYzE1U">on YouTube</td>
						</tr>
				</table>
            </div>


            <div id='tab-content-node' class='tabcontent'>(Loading ideas...)</div>
            <div id='tab-content-conn' class='tabcontent'>(Loading connections...)</div>
            <div id='tab-content-user' class='tabcontent'>(Loading people and groups...)</div>

        </div>
    </div>


<?php
    include_once($CFG->dirAddress."ui/footer.php");
?>




