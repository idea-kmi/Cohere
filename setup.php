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

/** UNTIL PHP 7.3 - supply own function **/
	if (!function_exists('is_countable')) {
		function is_countable($var) {
			return (is_array($var) || $var instanceof Countable);
		}
	}

/** SETUP THE FILE LOCATION MANAGER **/
	unset($HUB_FLM);
	require_once("core/filelocationmanager.class.php");
	// instantiate the file location manager
	if (isset($CFG->uitheme)) {
		$HUB_FLM = new FileLocationManager($CFG->uitheme);
	} else {
		$HUB_FLM = new FileLocationManager();
	}
	global $HUB_FLM;


/** SETUP STATIC CONFIG VARIABLES **/

	$CFG->AUTH_TYPE_EVHUB = "cohere";

	/*************** for EvHub copied code ***************************************/

	//$CFG->HAS_SOLUTION = in_array('Solution', $CFG->BASE_TYPES);
	//$CFG->HAS_CLAIM = in_array('Claim', $CFG->BASE_TYPES);
	//$CFG->HAS_CHALLENGE = in_array('Challenge', $CFG->BASE_TYPES);
	//$CFG->HAS_OPEN_COMMENTS = in_array('Idea', $CFG->BASE_TYPES);

	/**
	 * The file paths for the node type icons used.
	 * These are currently only referenced in ui/datamodel.js.php
	 */
	 /*
	 //EVHub
	$CFG->challengeicon = $HUB_FLM->getImagePath("nodetypes/Default/challenge.png");
	$CFG->evidenceicon = $HUB_FLM->getImagePath("nodetypes/Default/litertaure-analysis.png");
	$CFG->projecticon = $HUB_FLM->getImagePath("nodetypes/Default/project.png");

	// Cohere
	$CFG->issueicon = $HUB_FLM->getImagePath("nodetypes/Default/issue-32x32.png");
	$CFG->claimicon = $HUB_FLM->getImagePath("nodetypes/Default/position2-32x32.png");
	$CFG->solutionicon = $HUB_FLM->getImagePath("nodetypes/Default/position-32x32.png");
	$CFG->resourceicon = $HUB_FLM->getImagePath("nodetypes/Default/reference-32x32.png");
	$CFG->orgicon = $HUB_FLM->getImagePath("nodetypes/Default/organization.png");
	$CFG->proicon = $HUB_FLM->getImagePath("nodetypes/Default/plus-32x32.png");
	$CFG->conicon = $HUB_FLM->getImagePath("nodetypes/Default/minus-32x32.png");
	$CFG->themeicon = $HUB_FLM->getImagePath("nodetypes/Default/theme.png");
	*/

	/*************** for EvHub copied code ***************************************/

	$CFG->STATUS_ACTIVE = 0;
	$CFG->STATUS_SPAM = 1;

	$CFG->USER_STATUS_ACTIVE = 0;
	$CFG->USER_STATUS_REPORTED = 1;
	$CFG->USER_STATUS_UNVALIDATED = 2;
	$CFG->USER_STATUS_UNAUTHORIZED = 3;
	$CFG->USER_STATUS_SUSPENDED = 4;

/** CREATE ALL OTHER GLOBAL VARIABLES AND INITIALIZE THEM AND LOAD LIBRARIES **/

 	require_once($CFG->dirAddress.'core/sanitise.php');
 	require_once("language/language.php");
  	require_once($CFG->dirAddress.'core/databases/sqlstatements.php');
	//require_once("core/datamodel/datamodel.class.php");
    require_once($CFG->dirAddress.'core/accesslib.php');

	startSession();

    unset($DB);
    unset($USER);

    global $CFG;
    global $LNG;
    global $DB;
    global $USER;
    global $HEADER;
    global $BODY_ATT;
    global $HUB_DATAMODEL;
    global $HUB_SQL;

    $HEADER = array();

/**CREATE THE DATAMODEL CLASS INSTANCE */
	//$HUB_DATAMODEL = new DataModel();
	//$HUB_DATAMODEL->load();

/** SETUP THE DATABASE MANAGER **/
	unset($DB);
	require_once("core/databases/databasemanager.class.php");
	// instantiate the database
	if (isset($CFG->databasetype) && $CFG->databasetype != "") {
		$DB = new DatabaseManager($CFG->databasetype);
	} else {
		$DB = new DatabaseManager();
	}
    global $DB;

    require_once($CFG->dirAddress.'core/datamodel/error.class.php');
    require_once($CFG->dirAddress.'core/apilib.php');
    require_once($CFG->dirAddress.'core/auditlib.php');

    if (isset($_SESSION["session_userid"]) && $_SESSION["session_userid"] != "") {
    	$USER = new User($_SESSION["session_userid"]);
    	$USER->load();
    } else {
    	$USER = new User();
    }
    // ensure there are no spaces or blank lines after php these closing tags
?>