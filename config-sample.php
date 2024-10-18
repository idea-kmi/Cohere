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

unset($CFG);

/********************************************** for EvHub copied code ************************************/

// Name of the language folder to use
$CFG->language = 'en';

$CFG->SITE_TITLE = "Cohere";

$CFG->databasetype = "mysql";

$CFG->domainfolder = "";

$CFG->ismultidomain = false;

// url for map tiles
$CFG->maptilesurl = "";

$CFG->SIGNUP_OPEN = "open";
$CFG->SIGNUP_REQUEST = "request";
$CFG->SIGNUP_CLOSED = "closed";

/**
 * SITE REGISTRATION
 *
 * Whether or not the site is open for registration.
 * There are three option you can change this parameter to.
 * $CFG->SIGNUP_OPEN, If you use this state for signup, then users can register themselves for using the Hub
 * $CFG->SIGNUP_REQUEST, If you use this state for signup below, then users can request an account
 * 		for using the Hub which is then validated by a Hub Admin user.
 * $CFG->SIGNUP_CLOSED, If you use this state for signup below, then users cannot register,
 * 		they must be sent login details. So by invitation only.
 * The deault is $CFG->SIGNUP_CLOSED;
 */
//$CFG->signupstatus = $CFG->SIGNUP_CLOSED;

/*********************************************************************************************************/

/** For specific research aspects of Cohere - not required */
$CFG->MDLLGroup = "";
$CFG->TELGroup = "";

/**
 * The variables in this section are the minimum that must be modified
 * for each Cohere installation to work
 */

// home address is the base url for the website and must end with trailing '/'
$CFG->homeAddress = "url/to/website/";

//Support address is the base url for the website user support area and must end with trailing '/'
//We use a modified installation of Bugzilla. You may want to change this to offer your own support.
$CFG->supportAddress = "url/to/support/address";

//Blog address is the base url for the website blog and must end with trailing '/'
// You may want to change this to offer your own blog.
$CFG->blogAddress = "url/to/blo/address";

// Link to you accessibility page
$CFG->accessibilityLink = "url to your accessibility page";

// dir address is the base file path for the website
$CFG->dirAddress = "/file/path/to/website/";

// the database address, e.g. localhost or a url to the database.
$CFG->databaseaddress = "localhost";

// the database username that Cohere uses to login to the database.
$CFG->databaseuser= "db user";

// the database password to go with the above username
$CFG->databasepass = "db password";

// the database name for the database Cohere is to use.
$CFG->databasename = "db name";

// the path to a temp directory that Cohere can use for temporary file activities.
$CFG->workdir = "/tmp/";

// the database user id number for the default user.
// If you have installed our default data you don't need to edit this
$CFG->defaultUserID = "defaultuser";

// the database id of the default role group in the database where the default roles can be found.
$CFG->defaultRoleGroupID = "defaultrolegroup";

/**
 * These variables can be left on their defaults setting and Cohere will work
 */

/* NB: IF you change the default-data you will need to make sure the following two variables are updated accordingly */
// the database user id number for the default user.
// If you have installed our default data you don't need to edit this
$CFG->defaultUserID = "defaultuser";

// the database id of the default NodeTypeGroup a.k.a. role group in the database in which the default roles can be found.
$CFG->defaultRoleGroupID = "defaultrolegroup";


/*** Login related variables ***/

// the author type text to store in the database for cohere users
$CFG->AUTH_TYPE_COHERE = "cohere";

// the author type text to store in the database for openid users
$CFG->AUTH_TYPE_OPENID = "openid";

//the default status of an item
$CFG->STATUS_ACTIVE = 0;

// the status of an item (idea, websitem, user) has been reported as spam
$CFG->STATUS_SPAM = 1;


/*** Image related variables ***/

// the maximum image file size allowed when uploading user images.
$CFG->IMAGE_MAX_FILESIZE = 1000000;

$CFG->IMAGE_MAX_HEIGHT = 100;
$CFG->IMAGE_WIDTH = 60;
$CFG->IMAGE_THUMB_WIDTH = 30;
$CFG->ICON_WIDTH = 32;

// the name of the image file to use for users with no photo uploaded yet (inside uploads dir).
$CFG->DEFAULT_USER_PHOTO= 'profile.png';

// the name of the image file to use for groups with no photo uploaded yet (inside uploads dir).
$CFG->DEFAULT_GROUP_PHOTO= 'groupprofile.png';


/*** Email section ***/

// whether or not to actually send emails - turn off in dev areas and on in live!
// if you set this to true, you must complete the variables below
$CFG->send_mail = false;

// email details that are use when Cohere sends out emails
$CFG->EMAIL_FROM_ADDRESS = "";
$CFG->EMAIL_FROM_NAME = "Cohere team";

// As well as the email reply to address this is used as support email address for people to contact
// on help/index.php page and contact.php pages.
$CFG->EMAIL_REPLY_TO = "";

// Which email address to send Spam / inapproriate content reports to
$CFG->SPAM_ALERT_RECIPIENT = "";

/*** Proxy related variables ***/

// If the server needs a proxy to access internet, set it here
$CFG->PROXY_HOST = "";
$CFG->PROXY_PORT = "";


/*** Site Context types ***/

// Don't touch these!!!
$CFG->NODE_CONTEXT = "node";
$CFG->USER_CONTEXT = "user";
$CFG->GROUP_CONTEXT = "group";
$CFG->SEARCH_CONTEXT = "search";
$CFG->URL_CONTEXT = "url";
$CFG->TAGSEARCH_CONTEXT = "tagsearch";

/*** Other ***/
//Best leave these alone

// the text used to store in the audit system for the add action
$CFG->actionAdd = "add";

// the text used to store in the audit system for the edit action
$CFG->actionEdit = "edit";

// the text used to store in the audit system for the delete action
$CFG->actionDelete = "delete";

// the name of the Node table
$CFG->setAssignmentNode = "Node";

// the name of the URL table
$CFG->setAssignmentURL = "URL";

// the name of the Triple table
$CFG->setAssignmentTriple = "Triple";

// the name of the View table
$CFG->setAssignmentView = "View";

// the default node type to apply if the user does not specify
$CFG->DEFAULT_NODE_TYPE = "Idea";


/*** Third Party Keys ***/

// recaptcha public/private keys
// you will need to get new keys for your website url
$CFG->RECAPTCHA_PUBLIC = "";
$CFG->RECAPTCHA_PRIVATE = "";
$CFG->CAPTCHA_DOMAIN = "";

// Google analytics (optional)
$CFG->GOOGLE_ANALYTICS_KEY = "";

/** for getting point location from an address */
//https://docs.microsoft.com/en-us/bingmaps/rest-services/locations/find-a-location-by-query
//https://www.bingmapsportal.com/Application#
$CFG->BINGMAPS_KEY = "";

// Whether to tweet all public nodes to the cohere stream.
// User's the TwiterID and TwitterPassword (key) in the default User account
// So make sure you set that up before you turn this on.
$CFG->TWITTER_STREAM_ON = "";
$CFG->TWITTER_CONSUMER_KEY = "";
$CFG->TWITTER_CONSUMER_SECRET = "";

$CFG->BITLY_KEY = "";
$CFG->BITLY_LOGIN = "";

/** MAILCHIMP NEWSLETTER SYSTEM **/
// Is MailChimp Newsletter service being used on this hub? (true/false)
$CFG->MAILCHIMP_ON = false;

// The main API Key for the Evidence Hub to use the MailChimp service you have set up
$CFG->MAILCHIMP_KEY = "";

// The MailChimp List id for the list you have setup for the Evidence Hub to subscribe users to
$CFG->MAILCHIMP_LISTID = "";

// If you want to point to an additional page with more information about your newsletter,
// put the url to use here. If this is empty, the link will not be displayed in the apporpraite pages.
$CFG->MAILCHIMP_NEWSLETTER_INFO_URL = "";

require_once("setup.php");
?>