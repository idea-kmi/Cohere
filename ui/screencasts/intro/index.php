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
    include_once("../../config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
   <!-- saved from url=(0025)http://www.techsmith.com/ -->
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Created by Camtasia Studio 3</title>
   
   <script type="text/javascript" src="flashobject.js"></script>    
   <script type="text/javascript">
      <!-- To load a movie other then the first one listed in the xml file you can specify a movie=# arguement. -->
      <!-- For example, to load the third movie you would do the following: MyProjectName.html?movie=3 -->      
      // <![CDATA[
      var args = new Object();
      var query = location.search.substring(1);
      // Get query string
      var pairs = query.split( "," );
      // Break at comma
      for ( var i = 0; i < pairs.length; i++ )
      {
         var pos = pairs[i].indexOf('=');
         if( pos == -1 )
         {
            continue; // Look for "name=value"
         }
         var argname = pairs[i].substring( 0, pos ); // If not found, skip
         var value = pairs[i].substring( pos + 1 ); // Extract the name
         args[argname] = unescape( value ); // Extract the value
      }
      // ]]>
   </script>        

	<style type="text/css">	   
	   body 
	   {
			background-color: #ffffff;
			font: .8em/1.3em verdana,arial,helvetica,sans-serif;
			text-align: center;
	   }
	   
	   #noexpressUpdate
	   {
	      margin: 0 auto;
			font-family:Arial, Helvetica, sans-serif;
			font-size: x-small;
			color: #003300;
			text-align: left;
			background-image: url(cohere-intro_nofp_bg.gif);
			background-repeat: no-repeat;
			width: 210px; 
			height: 200px;	
			padding: 40px;
	   }
	</style>
</head>
   <body >
    <div style=""><a href="<?php echo $CFG->homeAddress;?>#screencast">Return to the Cohere screencasts</a></div>
     
      <div id="flashcontent">	   		
			<div id="noexpressUpdate">
			  <p>The Camtasia Studio video content presented here requires JavaScript to be enabled and the  latest version of the Macromedia Flash Player. If you are you using a browser with JavaScript disabled please enable it now. Otherwise, please update your version of the free Flash Player by <a href="http://www.macromedia.com/go/getflashplayer">downloading here</a>. </p>
		    </div>
	   </div>
      <script type="text/javascript">
		  // <![CDATA[          
         var fo = new FlashObject( "cohere-intro_controller.swf", "cohere-intro_controller.swf", "967", "768", "7", "#FFFFFF", false, "best" );
         fo.addVariable( "csConfigFile", "cohere-intro_config.xml"  ); 
         fo.addVariable( "csColor"     , "FFFFFF"           );
         fo.addVariable( "csPreloader" , 'cohere-intro_preload.swf' );
         if( args.movie )
         {
            fo.addVariable( "csFilesetBookmark", args.movie );
         }
         fo.write("flashcontent"); 		  	  
         // ]]>

	   </script>  		        
   </body>
</html>