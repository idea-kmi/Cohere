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
    include_once("../config.php");
    include_once($CFG->dirAddress."ui/header.php");

    if(!isset($USER->userid)){
        header('Location: index.php');
		exit();
    }

    if($USER == null || $USER->getIsAdmin() == "N"){
        //reject user
        echo "Sorry you need to be an administrator to access these pages";
        include_once($CFG->dirAddress."ui/dialogfooter.php");
        die;
    }
?>
	<br>
	<br>
	<div class="homeregtitle"><span class="hometext">Please select a report from the menu.</span></span></div>
    <br />
    <div id="innerwrap" class="innerwrap">

    <div class="lefthome">
        <div class="homeregtitle"><span class="hometext">Admin Reports for <span class="hometextinner">Cohere</span></span></div>
        <div style="float:left;">
            <ul>
                <li>
                    <a class="statslabel" href="generalStats.php">General Stats Report</a>
                </li>
                <li>
                    <a class="statslabel" href="userRegistration.php">User Registration Report</a>
                </li>
                <li>
                    <a class="statslabel" href="newIdeas.php">Ideas Created Report</a>
                </li>
                <li>
                    <a class="statslabel" href="auditIdeas.php">Audit Ideas Report</a>
                </li>			
                <li>
                    <a class="statslabel" href="connections.php">Connections Created Report</a>
                </li>			
                <li>
                    <a class="statslabel" href="auditConnections.php">Audit Connections Report</a>
                </li>			
                <li>
                    <a class="statslabel" href="feeds.php">Feeds Created Report</a>
                </li>
            </ul>
        </div>
    </div>
</div>    
<?php
	include_once($CFG->dirAddress."ui/footer.php");
?>

