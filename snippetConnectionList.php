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

    $connid = optional_param("select","",PARAM_TEXT);

    $type = optional_param("type","",PARAM_ALPHANUM);
   	$mode = optional_param("mode","",PARAM_ALPHANUM);
   	$pathtype = optional_param("pathtype","",PARAM_ALPHANUM);
   	$id = optional_param("id","",PARAM_ALPHANUMEXT);
   	$links = optional_param("links","",PARAM_TEXT);
   	$searchText = optional_param("text","",PARAM_TEXT);
   	$userid = optional_param("uid","",PARAM_ALPHANUMEXT);
   	$sort =  optional_param("sort","",PARAM_ALPHANUM);
   	$sortdir = optional_param("sortdir","",PARAM_ALPHANUM);
   	$filter = optional_param("filter","",PARAM_TEXT);
   	$focus =  optional_param("focus","",PARAM_ALPHANUM);
   	$direction = optional_param("condir","",PARAM_ALPHANUM);
   	$select = optional_param("select","",PARAM_TEXT);
   	$exact = optional_param("exact","",PARAM_ALPHANUM);

   	$context = 'context=node&nodeid='.$id;
   	if ($searchText != "") {
   		$context = 'context=search&q='.$searchText."&scope=";
   		if ($mode == 'world') {
   			$context .= 'all';
   		} else {
   			$context .= 'my';
   		}
   	} else if ($uid != "") {
   		$context = 'context=user&userid='.$uid;
   	}

   	// MORE OPTIONS REQUIRED?

   	$url = $CFG->homeAddress.'ui/snippet/snippet-conn-list.php?'.$context.'&snippet=2#conn-list';
    array_push($HEADER, '<meta http-equiv="refresh" content="1;url='.$url.'">');

    addToLog("View connection network snippet (oldurl)","Connection Network",$connid);
    include_once($CFG->dirAddress."ui/dialogheader.php");
?>
    <p>This page has been moved, you will shortly be automatically redirected to:</p>
    <p><a href="<?php echo $url;?>"><?php echo $url;?></a></p>

<?php
    include_once($CFG->dirAddress."ui/dialogfooter.php");
?>