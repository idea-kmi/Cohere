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
    include_once("../../config.php");
    global $USER, $CFG;
    checkLogin();
    include_once($CFG->dirAddress."ui/dialogheader.php");

    $nodetypes = optional_param("nodetypes", "", PARAM_TEXT);
    $depth = required_param("depth", PARAM_ALPHANUM);
    $otherroles = optional_param("otherroles", "", PARAM_TEXT);

    $typelist=null;
	if ($nodetypes !=null && $nodetypes != "") {
		$typelist = explode(",", $nodetypes);
	}

	$roleNotFound = array();

	$nodeTypeFilterList = array();
	if ($typelist != null) {
		foreach ($typelist as &$value) {
			$nodeTypeFilterList[$value] = $value;
			$roleNotFound[$value] = $value;
		}
	}

    $rs = getUserRoles();
    $roles = $rs->roles;
?>

<script type="text/javascript">

   var depth = <?php echo $depth.";"; ?>

   function getSelections() {

	   if (window.opener.setSelectedNodeTypes) {
		   var selectedOnes = "";
		   var checks = document.getElementsByName("checklist");
		   for (i=0; i<checks.length; i++) {
			   if (checks[i].checked) {
				   if (selectedOnes == "") {
					   selectedOnes = checks[i].value;
				   } else {
					   selectedOnes += ","+checks[i].value;
				   }
			   }
		   }

			var otherroles = $('otherroles').value;
			if (otherroles != null && otherroles != "") {
				if (selectedOnes == "") {
					selectedOnes += otherroles;
				} else {
					selectedOnes += ","+otherroles;
				}
			}

		   window.opener.setSelectedNodeTypes(selectedOnes, depth);
	   }
	   window.close();
   }
</script>

<h1>Choose Idea Types</h1>

<div id="rolesdiv">
  <div class="formrow">
        <div id="roles" class="forminput" style="clear:both;">

        <?php
            echo "<table class='table' cellspacing='0' cellpadding='3' border='0' style='margin: 0px;'>";

        	echo "<tr>";
            echo "<th width='45'>&nbsp;</th>";
            echo "<th width='360'>&nbsp;</th>";
           	echo "<th width='20'>Pick</th>";
            echo "</tr>";

            foreach($roles as $role){
                echo "<tr>";

                echo "<td>";
                if ($role->image != null && $role->image != "") {
                	echo "<img border='0' src='".$CFG->homeAddress.$role->image."' />";
                } else {
                	echo "<img border='0' src='".$CFG->homeAddress."images/nodetypes/blank.gif' />";
                }
                echo "</td>";

                echo "<td>";
 		        echo "<span class='labelinput' style='width: 90%'>".htmlspecialchars($role->name)."</span>";
                echo "</td>";

                echo "<td>";
                if (count($nodeTypeFilterList) > 0
                		&& $nodeTypeFilterList[$role->name]) {

					unset($roleNotFound[$role->name]);

					echo '<input type="checkbox" name="checklist" checked value="'.htmlspecialchars($role->name).'"></a>';
			    } else {
					echo '<input type="checkbox" name="checklist" value="'.htmlspecialchars($role->name).'"></a>';
                }
                echo "</td>";

                echo "</tr>";
            }
            echo "</table>";
        ?>
        </div>

		<div style="margin-top: 5px; margin-left: 10px; margin-top:15px; padding-bottom:15px;">
    		<label for="otherroles" style="float: left; margin-right: 3px; margin-top: 3px;">Other</label>
			<input type="text" style=" margin-right:3px; width:300px" id="otherroles" name="otherroles" value="<?php $otherroles = implode(',', $roleNotFound); if ($otherroles == undefined) {$otherroles="";} echo trim($otherroles);	?>" />
    		<label style="clear:both;float: left; margin-right: 3px; margin-top: 3px;">(comma separated list - spelling and case must be exact)</label>
		</div>
   </div>


    <div class="formrow">
	    <input type="button" value="Select" onclick="javascript:getSelections();"/>
	    <input type="button" value="Close" onclick="window.close();"/>
    </div>
</div>


<?php
    include_once($CFG->dirAddress."ui/dialogfooter.php");
?>