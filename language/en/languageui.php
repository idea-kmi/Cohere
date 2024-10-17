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


/**
 * languageui.php
 *
 * Michelle Bachler (KMi)
 *
 * This should eventually be broken up into separate files and become part of the internationalization of the Evidence Hub
 */


/** NETWORK MAPS **/
$LNG->NETWORKMAPS_RESIZE_MAP_HINT = 'Resize the Map';
$LNG->NETWORKMAPS_ENLARGE_MAP_LINK = 'Enlarge Map';
$LNG->NETWORKMAPS_REDUCE_MAP_LINK = 'Reduce Map';
$LNG->NETWORKMAPS_EXPLORE_ITEM_LINK = 'Explore Selected Item';
$LNG->NETWORKMAPS_EXPLORE_ITEM_HINT = 'Open the full details page for the currently selected item';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_LINK = 'Explore Author of Selected Item';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_HINT = 'Open the Author home page for the currently selected item';
$LNG->NETWORKMAPS_SELECTED_NODEID_ERROR = 'Please make sure you have made a selection in the map.';
$LNG->NETWORKMAPS_MAC_PAINT_ISSUE_WARNING = '(This visualization requires Java 7 on MacOS X 10.7 onwards (Lion) to work correctly)';
$LNG->NETWORKMAPS_APPLET_NOT_RECOGNISED_ERROR = '(Your browser recognizes the APPLET element but does not run the applet.)';
$LNG->NETWORKMAPS_THEME_SELECTION_MESSAGE = 'Please make a selection above to view a map';
$LNG->NETWORKMAPS_LOADING_MESSAGE = '(Loading map...)';
$LNG->NETWORKMAPS_APPLET_REF_BROKEN_ERROR = 'Map Applet reference broken. Please restart your browser.';
$LNG->NETWORKMAPS_NO_RESULTS_THEME_MESSAGE = 'No results found. Please select again.';
$LNG->NETWORKMAPS_NO_RESULTS_MESSAGE = 'No results found. Please select again.';
$LNG->NETWORKMAPS_SAME_USER_MESSAGE = "All connections made by the same person.";
$LNG->NETWORKMAPS_OPTIONAL_TYPE = 'and optionally a type';
$LNG->NETWORKMAPS_KEY_SELECTED_ITEM = 'Selected item';
$LNG->NETWORKMAPS_KEY_FOCAL_ITEM = 'Focal item';
$LNG->NETWORKMAPS_KEY_NEIGHBOUR_ITEM = 'Neighbour item';
$LNG->NETWORKMAPS_KEY_SOCIAL_MODERATELY = 'Moderately connected';
$LNG->NETWORKMAPS_KEY_SOCIAL_HIGHLY = 'Highly connected';
$LNG->NETWORKMAPS_KEY_SOCIAL_SLIGHTLY = 'Slightly connected';
$LNG->NETWORKMAPS_KEY_SOCIAL_MOST = 'The most connected';
$LNG->NETWORKMAPS_SOCIAL_ITEM_HINT = "Open the home page of the currently selected person";
$LNG->NETWORKMAPS_SOCIAL_ITEM_LINK = 'Explore Selected Person';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_HINT = 'Show all connections for the selected link';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_LINK = 'Explore Selected Link';
$LNG->NETWORKMAPS_SOCIAL_LOADING_MESSAGE = '(Loading Social Network View. This may take a few minutes to calculate depending on the size of the Hub...)';
$LNG->NETWORKMAPS_SOCIAL_NO_RESULTS_MESSAGE = 'No data to calculate the Social Network from.';

$LNG->TAB_VIEW_SOCIALMAP = 'Social Network';
$LNG->TAB_VIEW_USER_SOCIALMAP = 'My Social Network';


/** CHATS SYSTEM **/
$LNG->VIEWS_CHAT_TITLE = $LNG->CHATS_NAME;
$LNG->VIEWS_CHAT_HINT = 'Click to view any '.$LNG->CHATS_NAME.' on this item';

$LNG->CHAT_USER_TITLE = 'Users currently on this Page';
$LNG->CHAT_USER_ENTRY_DATE = "Arrived at this chat:";

$LNG->CHAT_TREE_COUNT_HINT = 'The number of replies currently added to this '.$LNG->CHAT_NAME.' topic';
$LNG->CHAT_REPLY_TO_MENU_TEXT = 'Reply';
$LNG->CHAT_REPLY_TO_MENU_HINT = 'Post a reply to this '.$LNG->CHAT_NAME.' item';
$LNG->CHAT_ADD_BUTTON_TEXT = 'Start a New '.$LNG->CHAT_NAME;
$LNG->CHAT_ADD_BUTTON_HINT = 'Start a new '.$LNG->CHAT_NAME.' about the current focal item';
$LNG->CHAT_LOADING = "Loading ".$LNG->CHATS_NAME."...";
$LNG->NODE_CHAT_BUTTON_TEXT = $LNG->CHATS_NAME;
$LNG->NODE_CHAT_BUTTON_HINT = 'View all the '.$LNG->CHATS_NAME.' about this item';
$LNG->CHAT_TREE_TOGGLE = 'Show/hide the replies';
$LNG->NODE_REPLY_ON = 'Added on';

$LNG->CHAT_CONVERT_TO_CHALLENGE_HINT = 'Convert this '.$LNG->CHAT_NAME.' item to a '.$LNG->CHALLENGE_NAME;
$LNG->CHAT_CONVERT_TO_ISSUE_HINT = 'Convert this '.$LNG->CHAT_NAME.' item to an '.$LNG->ISSUE_NAME;
$LNG->CHAT_CONVERT_TO_CLAIM_HINT = 'Convert this '.$LNG->CHAT_NAME.' item to a '.$LNG->CLAIM_NAME;
$LNG->CHAT_CONVERT_TO_SOLUTION_HINT = 'Convert this '.$LNG->CHAT_NAME.' item to a '.$LNG->SOLUTION_NAME;
$LNG->CHAT_CONVERT_TO_EVIDENCE_HINT = 'Convert this '.$LNG->CHAT_NAME.' item to an '.$LNG->EVIDENCE_NAME;
$LNG->CHAT_CONVERT_TO_RESOURCE_HINT = 'Convert this '.$LNG->CHAT_NAME.' item to a '.$LNG->RESOURCE_NAME;

$LNG->CHAT_CONVERT_TO_CHALLENGE_TEXT = 'Make into '.$LNG->CHALLENGE_NAME_SHORT;
$LNG->CHAT_CONVERT_TO_ISSUE_TEXT = 'Make into '.$LNG->ISSUE_NAME_SHORT;
$LNG->CHAT_CONVERT_TO_CLAIM_TEXT = 'Make into '.$LNG->CLAIM_NAME_SHORT;
$LNG->CHAT_CONVERT_TO_SOLUTION_TEXT = 'Make into '.$LNG->SOLUTION_NAME_SHORT;
$LNG->CHAT_CONVERT_TO_EVIDENCE_TEXT = 'Make into '.$LNG->EVIDENCE_NAME_SHORT;
$LNG->CHAT_CONVERT_TO_RESOURCE_TEXT = 'Make into '.$LNG->RESOURCE_NAME_SHORT;
$LNG->CHAT_COMMENT_PARENT_TREE = 'Which is in a '.$LNG->CHAT_NAME.' about:';
$LNG->CHAT_COMMENT_PARENT_FOCUS = 'This item appears in a '.$LNG->CHAT_NAME.' about:';
$LNG->NODE_COMMENT_PARENT = 'Connected To:';

$LNG->CHAT_DELETE_CHECK_MESSAGE_PART1 = 'Are you sure you want to delete the '.$LNG->CHAT_NAME.' item: ';
$LNG->CHAT_DELETE_CHECK_MESSAGE_PART2 = '?';

$LNG->CHAT_HIGHLIGHT_NEWEST_TEXT = 'Most Recent Reply';

$LNG->NODE_DISCONNECT_TREE_MENU_HINT = "Disconnect this from:";


/** CONNECTION COG MENU OPTION **/

$LNG->CONNECTION_MENU_OPTION_TEXT = 'Add >>';
$LNG->CONNECTION_MENU_OPTION_HINT = 'Click to show/hide how you can connect this item';
$LNG->CONNECTION_MENU_OPTION_LOGIN_TEXT = 'Sign In to Add';
$LNG->CONNECTION_MENU_OPTION_LOGIN_HINT = 'You need to Sign In to be able to Add items to this';
$LNG->DEFAULT_SEARCH_TEXT = 'Enter "phrase search" or separate words';

$LNG->OVERVIEW_HOME_MOSTRECENT_TITLE = 'Last 10';
$LNG->HOME_MOSTRECENT_TITLE = 'Most Recent Entries';

$LNG->ALL_ITEMS_FILTER = "All Items";
$LNG->CONNECTED_ITEMS_FILTER = "Connected Items";
$LNG->UNCONNECTED_ITEMS_FILTER = "Unconnected Items";

$LNG->SEARCH_TREE_TITLE = 'Knowledge Trees for Search results on: ';
$LNG->SEARCH_TREE_TITLE_TAGS = 'Knowledge Trees for Tag search results on: ';
$LNG->SEARCH_NET_TITLE = 'Networks for Search results on: ';
$LNG->SEARCH_NET_TITLE_TAGS = 'Networks for Tag search results on: ';
$LNG->SEARCH_NET_MESSAGE = "A search can result in mutiple networks being returned.<br>Press either the 'Pause graph moving' button or the 'Pin all Nodes' (Closed Padlock) button to stop separate networks from floating off too far.<br>Press the 'Fit to Screen' button to see them all together.";

$LNG->GRAPH_PRINT_HINT = "Print this network graph";
$LNG->GRAPH_ZOOM_FIT_HINT = "Scale graph down if required and move to make it all fit in the visible area";
$LNG->GRAPH_ZOOM_ONE_TO_ONE_HINT = "Zoom this network graph to 100% and center on the Focal item";
$LNG->GRAPH_ZOOM_IN_HINT = "Zoom in";
$LNG->GRAPH_ZOOM_OUT_HINT = "Zoom out";
$LNG->GRAPH_CONNECTION_COUNT_LABEL = 'Number of Connections:';
$LNG->GRAPH_NOT_SUPPORTED = 'Your current browser does not support HTML5 Canvas.<br><br>Please upgrade to a newer version if you wish to view this network graph: IE 9.0+; Firefox 23.0+; Chrome 29.0+; Opera 17.0+; Safari 5.1+';

$LNG->USER_PROFILE_TAG_USAGE = "You have used this tag in your user profile.";
$LNG->FORM_REMOVE_MULTI = "Are you sure you want to remove this item? This action cannot be undone!";

$LNG->USER_REPORT_MY_DATA_TITLE = 'My contributions to the '.$CFG->SITE_TITLE;
$LNG->USER_REPORT_MY_DATA_LINK = 'Print My Contributions';
$LNG->USER_REPORT_MY_DATA_LINK_HINT = 'View a report showing the contributions this '.$LNG->USER_NAME.' made to the '.$CFG->SITE_TITLE;

$LNG->CORE_DATAMODEL_GROUP_CANNOT_REMOVE_MEMBER = 'Cannot remove '.$LNG->USER_NAME.' as admin as group will have no admins';

/** Just This Button For Now **/
$LNG->FORM_BUTTON_PRINT_PAGE = 'Print Page';

/** Geographical Maps **/
$LNG->GEO_LOADING = 'Loading map';
$LNG->GEO_BROWSER_INCOMPATIBLE = 'Browser not compatible';
$LNG->GEO_LOADING_ERROR = 'There was an error loading the geo map data.';
$LNG->GEO_LOADING_ERROR_FAILURE = 'Error loading data for map...';
$LNG->GEO_LOADING = '(Loading locations...)';
$LNG->GEO_USER_LOADING = '(Loading people locations...)';
$LNG->GEO_USER_NODE_LOADING = '(Loading user entry locations...)';

/** FORMS **/
$LNG->FORM_REGISTER_CAPTCHA = 'Are you human?';
$LNG->FORM_ERROR_CAPTCHA_INVALID = "The reCAPTCHA wasn't entered correctly. Please try it again.";

/** FOOTER **/
$LNG->FOOTER_ACCESSIBILITY = 'Accessibility';


/** HEADERS **/
/*
$LNG->HEADER_LOGO_HINT = 'Go to the '.$CFG->SITE_TITLE.' home page';
$LNG->HEADER_LOGO_ALT = $CFG->SITE_TITLE.' Logo';
$LNG->HEADER_HOME_ICON_HINT = 'Go back to Home Page';
$LNG->HEADER_HOME_ICON_ALT = 'Home icon';
$LNG->HEADER_OU_LOGO_HINT =  'Go to the Open University Website';
$LNG->HEADER_OU_LOGO_ALT =  'Open University Logo';
$LNG->HEADER_RSS_FEED_ICON_HINT = 'Get an RSS feed for the Evidence Hub. Note: each category has own feed too.';
$LNG->HEADER_RSS_FEED_ICON_ALT = 'RSS Icon';
$LNG->HEADER_VERSION_TEXT = 'Alpha';
$LNG->HEADER_USER_HOME_LINK_HINT = 'Go to your home page';
$LNG->HEADER_EDIT_PROFILE_LINK_TEXT = 'Edit Profile';
$LNG->HEADER_EDIT_PROFILE_LINK_HINT = 'Edit your profile information';
$LNG->HEADER_SIGN_OUT_LINK_TEXT = 'Sign Out';
$LNG->HEADER_SIGN_OUT_LINK_HINT = 'Sign Out';
$LNG->HEADER_SIGN_IN_LINK_TEXT = 'Sign In';
$LNG->HEADER_SIGN_IN_LINK_HINT = 'Sign In';
$LNG->HEADER_SIGNUP_OPEN_LINK_TEXT = 'Sign Up';
$LNG->HEADER_SIGNUP_OPEN_LINK_HINT = 'Register now instantly, so you can sign in and add data';
$LNG->HEADER_SIGNUP_REQUEST_LINK_TEXT = 'Sign Up';
$LNG->HEADER_SIGNUP_REQUEST_LINK_HINT = 'Request an account, so you can sign in and add data';
$LNG->HEADER_HELP_PAGE_LINK_TEXT = 'Help';
$LNG->HEADER_HELP_PAGE_LINK_HINT = 'Go to the Help page';
$LNG->HEADER_ABOUT_PAGE_LINK_TEXT = 'About';
$LNG->HEADER_ABOUT_PAGE_LINK_HINT = 'Go to the About page';
$LNG->HEADER_ADMIN_PAGE_LINK_TEXT = 'Admin';
$LNG->HEADER_ADMIN_PAGE_LINK_HINT = 'Go to the Admin page';
$LNG->HEADER_SEARCH_BOX_LABEL = 'Site Search';
$LNG->HEADER_SEARCH_TAGS_ONLY_LABEL = 'Tags Only (comma separated list)';
$LNG->HEADER_SEARCH_RUN_ICON_HINT = 'Run Search';
$LNG->HEADER_SEARCH_RUN_ICON_ALT = 'Run';
$LNG->HEADER_MY_HUB_LINK = 'My Hub';
*/

/** ODD **/
/*
$LNG->PRACTITIONER_STORY_NAME = "Practitioner Story";
$LNG->RESEARCHER_STORY_NAME = "Researcher Story";
$LNG->RESET_INVALID_MESSAGE = 'Invalid password reset code';
$LNG->POPUPS_BLOCK = 'You appear to have blocked popup windows.\n\n Please alter your browser settings to allow This Evidence Hub to open popup windows.';
$LNG->SIDEBAR_TITLE = "Recently Viewed";
$LNG->INDEX_ALL_DATA = 'All Data';
$LNG->ENTER_URL_FIRST = 'You must enter a url first';
*/

/** TABS **/
/*
//main
$LNG->TAB_HOME = 'Home';
$LNG->TAB_CHALLENGE = $LNG->CHALLENGES_NAME;
$LNG->TAB_ISSUE = $LNG->ISSUES_NAME;
$LNG->TAB_SOLUTION = $LNG->SOLUTIONS_NAME;
$LNG->TAB_CLAIM = $LNG->CLAIMS_NAME;
$LNG->TAB_EVIDENCE = $LNG->EVIDENCES_NAME;
$LNG->TAB_RESOURCE = $LNG->RESOURCES_NAME;
$LNG->TAB_ORG = $LNG->ORGS_NAME;
$LNG->TAB_PROJECT = $LNG->PROJECTS_NAME;
$LNG->TAB_USER = $LNG->USERS_NAME;
$LNG->TAB_SOCIAL = 'Social';
$LNG->TAB_COMMENT = $LNG->COMMENTS_NAME;
$LNG->TAB_NEWS = $LNG->NEWSS_NAME;

//user
$LNG->TAB_USER_HOME = 'My Home';
$LNG->TAB_USER_CHALLENGE = 'My '.$LNG->CHALLENGES_NAME_SHORT;
$LNG->TAB_USER_ISSUE = 'My '.$LNG->ISSUES_NAME_SHORT;
$LNG->TAB_USER_SOLUTION = 'My '.$LNG->SOLUTIONS_NAME_SHORT;
$LNG->TAB_USER_CLAIM = 'My '.$LNG->CLAIMS_NAME_SHORT;
$LNG->TAB_USER_EVIDENCE = 'My '.$LNG->EVIDENCES_NAME_SHORT;
$LNG->TAB_USER_RESOURCE = 'My '.$LNG->RESOURCES_NAME_SHORT;
$LNG->TAB_USER_ORG = 'My '.$LNG->ORGS_NAME;
$LNG->TAB_USER_PROJECT = 'My '.$LNG->PROJECTS_NAME;
$LNG->TAB_USER_CHAT = 'My '.$LNG->CHATS_NAME;
$LNG->TAB_USER_COMMENT = 'My '.$LNG->COMMENTS_NAME;
$LNG->TAB_USER_USED_COMMENT = 'My Used'.$LNG->COMMENTS_NAME;

//inner view
$LNG->TAB_VIEW_OVERVIEW = 'Dashboard';
$LNG->TAB_VIEW_LIST = 'List';
$LNG->TAB_VIEW_THEME_MAP = $LNG->THEME_NAME.' Map';
$LNG->TAB_VIEW_GEOMAP = 'Geo Map';

//explore
$LNG->VIEWS_LINEAR_TITLE = "Knowledge Trees";
$LNG->VIEWS_LINEAR_HINT = "Click to view any Knowledge Trees for this item";
$LNG->VIEWS_WIDGET_TITLE = "Full Details";
$LNG->WIDGET = "Click to view any Knowledge Trees for this item";
$LNG->VIEWS_EVIDENCE_MAP_TITLE="Network Graph";
$LNG->VIEWS_EVIDENCE_MAP_HINT="Click to view the Network Graph for this item";
$LNG->VIEWS_ORG_MAP_TITLE="Organizational Network";
*/

/** TAB PAGES TEXT **/
/*
$LNG->TAB_CHALLENGE_STRAPLINE = 'What are the '.$LNG->CHALLENGES_NAME.' facing your community?';
$LNG->TAB_ISSUE_STRAPLINE = 'What are the '.$LNG->ISSUES_NAME.' for your community?';
$LNG->TAB_SOLUTION_STRAPLINE = 'Your community movement needs evidence-based '.$LNG->SOLUTIONS_NAME.'.';
$LNG->TAB_CLAIM_STRAPLINE = "There's a lively debate in your community - here it is distilled and connected.";
$LNG->TAB_EVIDENCE_STRAPLINE = 'Dig into the '.$LNG->EVIDENCES_NAME.': Stories, Case Studies, Research Findings and Policy.';
$LNG->TAB_RESOURCE_STRAPLINE = 'In the Hub, Publications and Websites are used to strengthen '.$LNG->EVIDENCES_NAME;
$LNG->TAB_ORG_STRAPLINE = 'Welcome to the community! These are the '.$LNG->ORGS_NAME.' registered on the site to date.';
$LNG->TAB_PROJECT_STRAPLINE = 'Welcome to the community! These are the '.$LNG->PROJECTS_NAME.' registered on the site to date.';
$LNG->TAB_COMMENT_STRAPLINE = $LNG->COMMENTS_NAME.' made on the Evidence Hub';
$LNG->TAB_USER_STRAPLINE = 'Welcome to the community! These are the people registered on the site to date.';
$LNG->TAB_COMMENT_USER_STRAPLINE = $LNG->COMMENTS_NAME.' this user has made on the Evidence Hub';
*/

/** ERROR MESSAGES */
/*
$LNG->DATABASE_CONNECTION_ERROR = 'Could not connect to database - please check the server configuration.';
$LNG->ITEM_NOT_FOUND_ERROR = 'Item not found';
*/

/** BUTTONS AND LINK HINTS **/
/*
$LNG->SIGN_IN_HINT = 'Sign In to add to the Evidence Hub';
$LNG->SIGN_IN_FOLLOW_HINT = 'Sign In to follow this entry';

$LNG->ADD_BUTTON = 'Add';
$LNG->FOLLOW_BUTTON_ALT = 'Follow';
$LNG->FOLLOW_OFF_BUTTON_ALT = 'Follow off';

$LNG->EDIT_BUTTON_TEXT = 'Edit';
$LNG->EDIT_BUTTON_HINT_ITEM = 'Edit this item';
$LNG->EDIT_BUTTON_HINT_CHALLENGE = 'Edit this '.$LNG->CHALLENGE_NAME;
$LNG->EDIT_BUTTON_HINT_ISSUE = 'Edit this '.$LNG->ISSUE_NAME;
$LNG->EDIT_BUTTON_HINT_CLAIM = 'Edit this '.$LNG->CLAIM_NAME;
$LNG->EDIT_BUTTON_HINT_SOLUTION = 'Edit this '.$LNG->SOLUTION_NAME;
$LNG->EDIT_BUTTON_HINT_EVIDENCE = 'Edit this '.$LNG->EVIDENCE_NAME;
$LNG->EDIT_BUTTON_HINT_RESOURCE = 'Edit this '.$LNG->RESOURCE_NAME;

$LNG->DELETE_BUTTON_ALT = 'Delete';
$LNG->DELETE_BUTTON_HINT = 'Delete this item';
$LNG->NO_DELETE_BUTTON_ALT = 'Delete unavailable';
$LNG->NO_DELETE_BUTTON_HINT = 'You cannot delete this item. Someone else has connected to it';
*/

/** USER PAGE **/
/*
$LNG->USER_FOLLOW_HINT = 'Follow this person...';
$LNG->USER_FOLLOW_BUTTON = 'Follow';
$LNG->USER_UNFOLLOW_HINT = 'Unfollow this person...';
$LNG->USER_UNFOLLOW_BUTTON = 'Unfollow';

$LNG->USER_RSS_HINT = 'Get an RSS feed for ';
$LNG->USER_RSS_BUTTON = 'RSS Feed';
*/

/** LIST NAV **/
/*
$LNG->LIST_NAV_PREVIOUS_HINT = 'Previous';
$LNG->LIST_NAV_NO_PREVIOUS_HINT = 'No Previous';
$LNG->LIST_NAV_NEXT_HINT = 'Next';
$LNG->LIST_NAV_NO_NEXT_HINT = 'No Next';
$LNG->LIST_NAV_NO_ITEMS = "You haven't added any yet.";
$LNG->LIST_NAV_TO = 'to';
$LNG->LIST_NAV_USER_NO_CHALLENGE = "No ".$LNG->CHALLENGES_NAME.' found';
$LNG->LIST_NAV_USER_NO_ORG = "No ".$LNG->ORGS_NAME.' found';
$LNG->LIST_NAV_USER_NO_PROJECT = "No ".$LNG->PROJECTS_NAME.' found';
$LNG->LIST_NAV_USER_NO_ISSUE = "No ".$LNG->ISSUES_NAME.' found';
$LNG->LIST_NAV_USER_NO_SOLUTION = "No ".$LNG->SOLUTIONS_NAME.' found';
$LNG->LIST_NAV_USER_NO_CLAIM = "No ".$LNG->CLAIMS_NAME.' found';
$LNG->LIST_NAV_USER_NO_EVIDENCE = "No ".$LNG->EVIDENCES_NAME.' found';
$LNG->LIST_NAV_USER_NO_RESOURCE = "No ".$LNG->RESOURCES_NAME.' found';
$LNG->LIST_NAV_USER_NO_COMMENT = "No ".$LNG->COMMENTS_NAME.' found';
$LNG->LIST_NAV_USER_NO_NEWS = "No ".$LNG->NEWS_NAME.' found';
$LNG->LIST_NAV_USER_NO_CHAT = "No ".$LNG->CHATS_NAME.' found';
$LNG->LIST_NAV_NO_CHALLENGE = 'There are no '.$LNG->CHALLENGES_NAME.' to display';
$LNG->LIST_NAV_NO_EVIDENCE = 'There are no '.$LNG->EVIDENCE_NAME.' items to display';
$LNG->LIST_NAV_NO_ORGS = 'There are no '.$LNG->ORGS_NAME.' to display';
$LNG->LIST_NAV_NO_PROJECTS = 'There are no '.$LNG->PROJECTS_NAME.' to display';
$LNG->LIST_NAV_NO_RESOURCE = 'There are no '.$LNG->RESOURCES_NAME.' to display';
$LNG->LIST_NAV_NO_ISSUE = 'There are no '.$LNG->ISSUES_NAME.' to display';
$LNG->LIST_NAV_NO_SOLUTION = 'There are no '.$LNG->SOLUTIONS_NAME.' to display';
$LNG->LIST_NAV_NO_CLAIM = 'There are no '.$LNG->CLAIMS_NAME.' to display';
$LNG->LIST_NAV_NO_ITEMS = 'There are no items to display';
*/

/** FILTERS AND SORTS **/
/*
$LNG->FILTER_BY = 'Filter by';
$LNG->FILTER_TYPES_ALL = 'All Types';
$LNG->FILTER_THEMES_ALL = 'All '.$LNG->THEMES_NAME;
$LNG->FILTER_THEME_LABEL = $LNG->THEME_NAME.':';
$LNG->FILTER_ALSO_SELECT_THEME = 'Please also select a '.$LNG->THEME_NAME;
$LNG->FILTER_COUNTRY_DEFAULT = 'Default view...';

$LNG->SORT_BY = 'Sort by';
$LNG->SORT_ASC = 'Ascending';
$LNG->SORT_DESC = 'Descending';
$LNG->SORT_CREATIONDATE = 'Creation Date';
$LNG->SORT_MODDATE = 'Modification Date';
$LNG->SORT_TITLE = 'Title';
$LNG->SORT_NAME = 'Name';
$LNG->SORT_CONNECTIONS = 'Connections';
$LNG->SORT_VOTES = 'Votes';
$LNG->SORT_LAST_LOGIN = 'Last Sign In';
$LNG->SORT_LAST_ACTIVE = 'Last Active';
$LNG->SORT_DATE_JOINED = 'Date Joined';
*/

/** LOADING MESSAGES **/
/*
$LNG->LOADING_ITEMS = 'Loading items';
$LNG->LOADING_MESSAGE_PRINT_NODE = 'This may take a minute or so depending on the length of the list you are viewing';
$LNG->LOADING_CHALLENGES = '(Loading '.$LNG->CHALLENGES_NAME.'...)';
$LNG->LOADING_ISSUES = '(Loading '.$LNG->ISSUES_NAME.'...)';
$LNG->LOADING_SOLUTIONS = '(Loading '.$LNG->SOLUTIONS_NAME.'...)';
$LNG->LOADING_CLAIMS = '(Loading '.$LNG->CLAIMS_NAME.'...)';
$LNG->LOADING_EVIDENCES = '(Loading '.$LNG->EVIDENCES_NAME.'...)';
$LNG->LOADING_RESOURCES = '(Loading '.$LNG->RESOURCES_NAME.'...)';
$LNG->LOADING_ORGS = '(Loading '.$LNG->ORGS_NAME.'...)';
$LNG->LOADING_PROJECTS = '(Loading '.$LNG->PROJECTS_NAME.'...)';
$LNG->LOADING_USERS = '(Loading '.$LNG->USERS_NAME.'...)';
$LNG->LOADING_DATA = '(Loading data...)';
$LNG->LOADING_COMMENTS = '(Loading '.$LNG->COMMENTS_NAME.'...)';
$LNG->LOADING_CHATS = '(Loading '.$LNG->CHATS_NAME.'...)';
$LNG->LOADING_NEWS = '(Loading '.$LNG->NEWS_NAME.'...)';
*/

/** SEARCH RESULTS PAGE **/
/*
$LNG->SEARCH_TITLE_ERROR = 'Search Results';
$LNG->SEARCH_TITLE_TAGS = 'Search results for tags: ';
$LNG->SEARCH_ERROR_EMPTY = 'You must enter something to search for.';
$LNG->SEARCH_TITLE = 'Search results for: ';
$LNG->SEARCH_BACKTOTOP = 'back to top';
$LNG->SEARCH_BACKTOTOP_IMG_ALT = 'Up';
*/

/** DATAMODEL HINT TEXT **/
/*
// Evidence
$LNG->DATAMODEL_evidenceToResource = 'Select/create a '.$LNG->RESOURCE_NAME.' to associate with the current '.$LNG->EVIDENCE_NAME;
$LNG->DATAMODEL_evidenceToSolution = 'Select/create a '.$LNG->SOLUTION_NAME.' which the current '.$LNG->EVIDENCE_NAME.' is supporting/countering';
$LNG->DATAMODEL_evidenceToClaim = 'Select/create a '.$LNG->CLAIM_NAME.' which the current '.$LNG->EVIDENCE_NAME.' is supporting/countering';
$LNG->DATAMODEL_evidenceToOrg = 'Select/create an '.$LNG->ORG_NAME.' to associate with the current '.$LNG->EVIDENCE_NAME;
$LNG->DATAMODEL_evidenceToProject = 'Select/create a '.$LNG->PROJECT_NAME.' to associate with the current '.$LNG->EVIDENCE_NAME;
//Resource
$LNG->DATAMODEL_resourceToOrg = 'Select/create an '.$LNG->ORG_NAME.' that is related to the current '.$LNG->RESOURCE_NAME;
$LNG->DATAMODEL_resourceToProject = 'Select/create a '.$LNG->PROJECT_NAME.' that is related to the current '.$LNG->RESOURCE_NAME;
$LNG->DATAMODEL_resourceToChallenge = 'Select a '.$LNG->CHALLENGE_NAME.' that is related to the current '.$LNG->RESOURCE_NAME;
$LNG->DATAMODEL_resourceToIssue = 'Select/create an '.$LNG->ISSUE_NAME.' that is related to the current '.$LNG->RESOURCE_NAME;
$LNG->DATAMODEL_resourceToEvidence = 'Select/create an '.$LNG->EVIDENCE_NAME.' that is related to the current '.$LNG->RESOURCE_NAME;
//org
$LNG->DATAMODEL_orgToIssue = 'Select/create an '.$LNG->ISSUE_NAME.' that is addressed by the current '.$LNG->ORG_NAME;
$LNG->DATAMODEL_orgToClaim = 'Select/create a '.$LNG->CLAIM_NAME.' that is claimed by the current '.$LNG->ORG_NAME;
$LNG->DATAMODEL_orgToSolution = 'Select/create a '.$LNG->SOLUTION_NAME.' that the current '.$LNG->ORG_NAME.' specifies';
$LNG->DATAMODEL_orgToChallenge = 'Select a '.$LNG->CHALLENGE_NAME.' that is addressed by the current '.$LNG->ORG_NAME;
$LNG->DATAMODEL_orgToProject = 'Select/create a '.$LNG->PROJECT_NAME.' that is managed by the current '.$LNG->ORG_NAME;
$LNG->DATAMODEL_orgToOrg = 'Select/create an '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.' that is partnered with the current '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME;
$LNG->DATAMODEL_orgToResource = 'Select/create a '.$LNG->RESOURCE_NAME.' to associate with the current '.$LNG->ORG_NAME;
$LNG->DATAMODEL_orgToEvidence = 'Select/create an '.$LNG->EVIDENCE_NAME.' to associate with the current '.$LNG->ORG_NAME;
$LNG->DATAMODEL_projectToOrg = 'Select/create an '.$LNG->ORG_NAME.' that manages this '.$LNG->PROJECT_NAME;
//project
$LNG->DATAMODEL_projectToIssue = 'Select/create an '.$LNG->ISSUE_NAME.' that is addressed by the current '.$LNG->PROJECT_NAME;
$LNG->DATAMODEL_projectToClaim = 'Select/create a '.$LNG->CLAIM_NAME.' that is claimed by the current '.$LNG->PROJECT_NAME;
$LNG->DATAMODEL_projectToSolution = 'Select/create a '.$LNG->SOLUTION_NAME.' that the current '.$LNG->PROJECT_NAME.' specifies';
$LNG->DATAMODEL_projectToChallenge = 'Select a '.$LNG->CHALLENGE_NAME.' that is addressed by the current '.$LNG->PROJECT_NAME;
$LNG->DATAMODEL_projectToResource = 'Select/create a '.$LNG->RESOURCE_NAME.' to associate with the current '.$LNG->PROJECT_NAME;
$LNG->DATAMODEL_projectToEvidence = 'Select/create an '.$LNG->EVIDENCE_NAME.' to associate with the current '.$LNG->PROJECT_NAME;
$LNG->DATAMODEL_projectToOrg = 'Select/create an '.$LNG->ORG_NAME.' that manages this '.$LNG->PROJECT_NAME;
//issue
$LNG->DATAMODEL_issueToClaim = 'Select/create a '.$LNG->CLAIM_NAME.' that responds to the current '.$LNG->ISSUE_NAME;
$LNG->DATAMODEL_issueToSolution = 'Select/create a '.$LNG->SOLUTION_NAME.' that addresses the current '.$LNG->ISSUE_NAME;
$LNG->DATAMODEL_issueToOrg = 'Select/create an '.$LNG->ORG_NAME.' that addresses the current '.$LNG->ISSUE_NAME;
$LNG->DATAMODEL_issueToProject = 'Select/create an '.$LNG->PROJECT_NAME.' that addresses the current '.$LNG->ISSUE_NAME;
$LNG->DATAMODEL_issueToChallenge = 'Select a '.$LNG->CHALLENGE_NAME.' that the current '.$LNG->ISSUE_NAME.' relates to';
$LNG->DATAMODEL_issueToResource = 'Select/create a '.$LNG->RESOURCE_NAME.' to associate with the current '.$LNG->ISSUE_NAME;
//Claim
$LNG->DATAMODEL_claimToOrg = 'Select/create an '.$LNG->ORG_NAME.' that claims the current '.$LNG->CLAIM_NAME;
$LNG->DATAMODEL_claimToProject = 'Select/create a '.$LNG->PROJECT_NAME.' that claims the current '.$LNG->CLAIM_NAME;
$LNG->DATAMODEL_claimToIssue = 'Select/create an '.$LNG->ISSUE_NAME.' that the current '.$LNG->CLAIM_NAME.' responds to';
$LNG->DATAMODEL_claimToChallenge = 'Select a '.$LNG->CHALLENGE_NAME.' that the current '.$LNG->CLAIM_NAME.' responds to';
//Challenge
$LNG->DATAMODEL_challengeToIssue = 'Select/create a sub '.$LNG->ISSUE_NAME.' to this '.$LNG->CHALLENGE_NAME;
$LNG->DATAMODEL_challengeToResource = 'Select/create a '.$LNG->RESOURCE_NAME.' to associate with the current '.$LNG->CHALLENGE_NAME;
$LNG->DATAMODEL_challengeToOrg = 'Select/create an '.$LNG->ORG_NAME.' that addresses the current '.$LNG->CHALLENGE_NAME;
$LNG->DATAMODEL_challengeToProject = 'Select/create a '.$LNG->PROJECT_NAME.' that addresses the current '.$LNG->CHALLENGE_NAME;
//Solution
$LNG->DATAMODEL_solutionToOrg = 'Select/create an '.$LNG->ORG_NAME.' that specifies the current '.$LNG->SOLUTION_NAME;
$LNG->DATAMODEL_solutionToProject = 'Select/create a '.$LNG->PROJECT_NAME.' that specifies the current '.$LNG->SOLUTION_NAME;
$LNG->DATAMODEL_solutionToIssue = 'Select/create an '.$LNG->ISSUE_NAME.' that the current '.$LNG->SOLUTION_NAME.' addresses';
$LNG->DATAMODEL_solutionToChallenge = 'Select a '.$LNG->CHALLENGE_NAME.' that the current '.$LNG->SOLUTION_NAME.' addresses';
*/

/** EXPLORE SECTION TITLES **/
/*
//Challenge
$LNG->EXPLORE_challengeToIssue = $LNG->ISSUES_NAME;
$LNG->EXPLORE_challengeToResource = $LNG->RESOURCES_NAME.' associated to this '.$LNG->CHALLENGE_NAME;
$LNG->EXPLORE_challengeToOrg = $LNG->ORGS_NAME.' addressing this '.$LNG->CHALLENGE_NAME;
$LNG->EXPLORE_challengeToProject = $LNG->PROJECTS_NAME.' addressing this '.$LNG->CHALLENGE_NAME;
$LNG->EXPLORE_challengeToTheme = $LNG->THEMES_NAME.' assigned to this '.$LNG->CHALLENGE_NAME;
$LNG->EXPLORE_challengeToComment = $LNG->COMMENTS_NAME.' about this '.$LNG->CHALLENGE_NAME;
$LNG->EXPLORE_challengeToFollower = $LNG->FOLLOWERS_NAME.' of this '.$LNG->CHALLENGE_NAME;
//Issue
$LNG->EXPLORE_issueToSolution = $LNG->SOLUTIONS_NAME;
$LNG->EXPLORE_issueToClaim = $LNG->CLAIMS_NAME;
$LNG->EXPLORE_issueToChallenge = $LNG->CHALLENGES_NAME;
$LNG->EXPLORE_issueToOrg = $LNG->ORGS_NAME.' addressing this '.$LNG->ISSUE_NAME;
$LNG->EXPLORE_issueToProject = $LNG->PROJECTS_NAME.' addressing this '.$LNG->ISSUE_NAME;
$LNG->EXPLORE_issueToResource = $LNG->RESOURCES_NAME.' associated to this '.$LNG->ISSUE_NAME;
$LNG->EXPLORE_issueToTheme = $LNG->THEMES_NAME.' assigned to this '.$LNG->ISSUE_NAME;
$LNG->EXPLORE_issueToComment = $LNG->COMMENTS_NAME.' about this '.$LNG->ISSUE_NAME;
$LNG->EXPLORE_issueToFollower = $LNG->FOLLOWERS_NAME.' of this '.$LNG->ISSUE_NAME;
//Claim
$LNG->EXPLORE_claimToEvidenceSupport = 'Supporting '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_claimToEvidenceCounter = 'Counter '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_claimToIssue = $LNG->ISSUES_NAME;
$LNG->EXPLORE_claimToOrg = $LNG->ORGS_NAME.' claiming this '.$LNG->CLAIM_NAME;
$LNG->EXPLORE_claimToProject = $LNG->PROJECTS_NAME.' claiming this '.$LNG->CLAIM_NAME;
$LNG->EXPLORE_claimToTheme = $LNG->THEMES_NAME.' assigned to this '.$LNG->CLAIM_NAME;
$LNG->EXPLORE_claimToComment = $LNG->COMMENTS_NAME.' about this '.$LNG->CLAIM_NAME;
$LNG->EXPLORE_claimToFollower = $LNG->FOLLOWERS_NAME.' of this '.$LNG->CLAIM_NAME;
//Solution
$LNG->EXPLORE_solutionToEvidenceSupport = 'Supporting '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_solutionToEvidenceCounter = 'Counter '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_solutionToIssue = $LNG->ISSUES_NAME;
$LNG->EXPLORE_solutionToOrg = $LNG->ORGS_NAME.' proposing this '.$LNG->SOLUTION_NAME;
$LNG->EXPLORE_solutionToProject = $LNG->PROJECTS_NAME.' proposing this '.$LNG->SOLUTION_NAME;
$LNG->EXPLORE_solutionToTheme = $LNG->THEMES_NAME.' assigned to this '.$LNG->SOLUTION_NAME;
$LNG->EXPLORE_solutionToComment = $LNG->COMMENTS_NAME.' about this '.$LNG->SOLUTION_NAME;
$LNG->EXPLORE_solutionToFollower = $LNG->FOLLOWERS_NAME.' of this '.$LNG->SOLUTION_NAME;
//org
$LNG->EXPLORE_orgToProject = $LNG->PROJECTS_NAME.' managed by this '.$LNG->ORG_NAME;
$LNG->EXPLORE_orgToOrg = 'Partners of this '.$LNG->ORG_NAME;
$LNG->EXPLORE_orgToChallenge = $LNG->CHALLENGES_NAME.' addressed by this '.$LNG->ORG_NAME;
$LNG->EXPLORE_orgToIssue = $LNG->ISSUE_NAME.'s addressed by this '.$LNG->ORG_NAME;
$LNG->EXPLORE_orgToSolution = $LNG->SOLUTIONS_NAME.' specified by this '.$LNG->ORG_NAME;
$LNG->EXPLORE_orgToClaim = $LNG->CLAIMS_NAME.' made by this '.$LNG->ORG_NAME;
$LNG->EXPLORE_orgToEvidence = $LNG->EVIDENCES_NAME.' specified by this '.$LNG->ORG_NAME;
$LNG->EXPLORE_orgToResource = $LNG->RESOURCES_NAME.' associated to this '.$LNG->ORG_NAME;
$LNG->EXPLORE_orgToTheme = $LNG->THEMES_NAME.' assigned to this '.$LNG->ORG_NAME;
$LNG->EXPLORE_orgToComment = $LNG->COMMENTS_NAME.' made about this '.$LNG->ORG_NAME;
$LNG->EXPLORE_orgToFollower = $LNG->FOLLOWERS_NAME.' of this '.$LNG->ORG_NAME;
//project
$LNG->EXPLORE_projectToOrg = 'Partners of this '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_projectToManager = 'Managing '.$LNG->ORGS_NAME.' for this '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_projectToChallenge = $LNG->CHALLENGES_NAME.' addressed by this '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_projectToIssue = $LNG->ISSUES_NAME.' addressed by this '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_projectToSolution = $LNG->SOLUTIONS_NAME.' specified by this '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_projectToClaim = $LNG->CLAIMS_NAME.' made by this '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_projectToEvidence = $LNG->EVIDENCES_NAME.' specified by this '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_projectToResource = $LNG->RESOURCES_NAME.' associated to this '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_projectToTheme = $LNG->THEMES_NAME.' assigned to this '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_projectToComment = $LNG->COMMENTS_NAME.' made about this '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_projectToFollower = $LNG->FOLLOWERS_NAME.' of this '.$LNG->PROJECT_NAME;
//Evidence
$LNG->EXPLORE_evidenceToSolution = $LNG->SOLUTIONS_NAME;
$LNG->EXPLORE_evidenceToClaim = $LNG->CLAIMS_NAME;
$LNG->EXPLORE_evidenceToOrg = $LNG->ORGS_NAME.' specifying this '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_evidenceToProject = $LNG->PROJECTS_NAME.' specifying this '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_evidenceToResource = $LNG->RESOURCES_NAME;
$LNG->EXPLORE_evidenceToTheme = $LNG->THEMES_NAME.' assigned to this '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_evidenceToComment = $LNG->COMMENTS_NAME.' about this '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_evidenceToFollower = $LNG->FOLLOWERS_NAME.' of this '.$LNG->EVIDENCE_NAME;
//Resource
$LNG->EXPLORE_resourceToChallenge = $LNG->CHALLENGES_NAME.' linked to this '.$LNG->RESOURCE_NAME;
$LNG->EXPLORE_resourceToIssue = $LNG->ISSUES_NAME;
$LNG->EXPLORE_resourceToEvidence = $LNG->EVIDENCES_NAME.' using this '.$LNG->RESOURCE_NAME;
$LNG->EXPLORE_resourceToOrg = $LNG->ORGS_NAME.' linked to this '.$LNG->RESOURCE_NAME;
$LNG->EXPLORE_resourceToProject = $LNG->PROJECTS_NAME.' linked to this '.$LNG->RESOURCE_NAME;
$LNG->EXPLORE_resourceToTheme = $LNG->THEMES_NAME.' assigned to this '.$LNG->RESOURCE_NAME;
$LNG->EXPLORE_resourceToComment = $LNG->COMMENTS_NAME.' about this '.$LNG->RESOURCE_NAME;
$LNG->EXPLORE_resourceToFollower = $LNG->FOLLOWERS_NAME.' of this '.$LNG->RESOURCE_NAME;
$LNG->EXPLORE_resourceToResourceShort = 'Related '.$LNG->RESOURCES_NAME;
$LNG->EXPLORE_resourceToResource = 'Other '.$LNG->RESOURCES_NAME.' from the same Site';
//Theme
$LNG->EXPLORE_themeToChallenge = $LNG->CHALLENGES_NAME.' with this '.$LNG->THEME_NAME;
$LNG->EXPLORE_themeToIssue = $LNG->ISSUES_NAME.' with this '.$LNG->THEME_NAME;
$LNG->EXPLORE_themeToSolution = $LNG->SOLUTIONS_NAME.' with this '.$LNG->THEME_NAME;
$LNG->EXPLORE_themeToClaim = $LNG->CLAIMS_NAME.' with this '.$LNG->THEME_NAME;
$LNG->EXPLORE_themeToEvidence = $LNG->EVIDENCES_NAME.' with this '.$LNG->THEME_NAME;
$LNG->EXPLORE_themeToResource = $LNG->RESOURCES_NAME.' with this '.$LNG->THEME_NAME;
$LNG->EXPLORE_themeToOrg = $LNG->ORGS_NAME.' with this '.$LNG->THEME_NAME;
$LNG->EXPLORE_themeToProject = $LNG->PROJECTS_NAME.' with this '.$LNG->THEME_NAME;
$LNG->EXPLORE_themeToComment = $LNG->COMMENTS_NAME.' about this '.$LNG->THEME_NAME;
$LNG->EXPLORE_themeToFollower = $LNG->FOLLOWERS_NAME.' of this '.$LNG->THEME_NAME;
*/

/** EXPLORE BUTTONS,LINKS AND HINTS **/
/*
$LNG->EXPLORE_PRINT_BUTTON_ALT = "Print this item";
$LNG->EXPLORE_PRINT_BUTTON_HINT = "Print this item";

$LNG->EXPLORE_COMMENT_HINT_STUB = 'Add a new '.$LNG->COMMENT_NAME.' to this';
$LNG->EXPLORE_COMMENT_HINT_CHALLENGE = $LNG->EXPLORE_COMMENT_HINT_STUB.' '.$LNG->CHALLENGE_NAME;
$LNG->EXPLORE_COMMENT_HINT_ISSUE = $LNG->EXPLORE_COMMENT_HINT_STUB.' '.$LNG->ISSUE_NAME;
$LNG->EXPLORE_COMMENT_HINT_SOLUTION = $LNG->EXPLORE_COMMENT_HINT_STUB.' '.$LNG->SOLUTION_NAME;
$LNG->EXPLORE_COMMENT_HINT_CLAIM = $LNG->EXPLORE_COMMENT_HINT_STUB.' '.$LNG->CLAIM_NAME;
$LNG->EXPLORE_COMMENT_HINT_EVIDENCE = $LNG->EXPLORE_COMMENT_HINT_STUB.' '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_COMMENT_HINT_RESOURCE = $LNG->EXPLORE_COMMENT_HINT_STUB.' '.$LNG->RESOURCE_NAME;
$LNG->EXPLORE_COMMENT_HINT_ORG = $LNG->EXPLORE_COMMENT_HINT_STUB.' '.$LNG->ORG_NAME;
$LNG->EXPLORE_COMMENT_HINT_PROJECT = $LNG->EXPLORE_COMMENT_HINT_STUB.' '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_COMMENT_HINT_THEME = $LNG->EXPLORE_COMMENT_HINT_STUB.' '.$LNG->THEME_NAME;

$LNG->EXPLORE_THEME_HINT_STUB = 'Add the current '.$LNG->THEME_NAME.' to a new or existing';
$LNG->EXPLORE_THEME_HINT_CHALLENGE = $LNG->EXPLORE_THEME_HINT_STUB.' '.$LNG->CHALLENGE_NAME;
$LNG->EXPLORE_THEME_HINT_ISSUE = $LNG->EXPLORE_THEME_HINT_STUB.' '.$LNG->ISSUE_NAME;
$LNG->EXPLORE_THEME_HINT_SOLUTION = $LNG->EXPLORE_THEME_HINT_STUB.' '.$LNG->SOLUTION_NAME;
$LNG->EXPLORE_THEME_HINT_CLAIM = $LNG->EXPLORE_THEME_HINT_STUB.' '.$LNG->CLAIM_NAME;
$LNG->EXPLORE_THEME_HINT_EVIDENCE = $LNG->EXPLORE_THEME_HINT_STUB.' '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_THEME_HINT_RESOURCE = $LNG->EXPLORE_THEME_HINT_STUB.' '.$LNG->RESOURCE_NAME;
$LNG->EXPLORE_THEME_HINT_ORG = $LNG->EXPLORE_THEME_HINT_STUB.' '.$LNG->ORG_NAME;
$LNG->EXPLORE_THEME_HINT_PROJECT = $LNG->EXPLORE_THEME_HINT_STUB.' '.$LNG->PROJECT_NAME;
$LNG->EXPLORE_THEME_HINT_ORGPROJECT = $LNG->EXPLORE_THEME_HINT_STUB.' '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME;

$LNG->EXPLORE_BACKTOTOP = 'back to top';
$LNG->EXPLORE_BACKTOTOP_IMG_ALT = 'Up';

$LNG->EXPLORE_SUPPORTING_EVIDENCE = 'Supporting '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_COUNTER_EVIDENCE = 'Counter '.$LNG->EVIDENCE_NAME;
$LNG->EXPLORE_ISSUES_ADDRESSED = $LNG->ISSUES_NAME.' addressed';
$LNG->EXPLORE_CHALLENGES_ADDRESSED = $LNG->CHALLENGES_NAME.' addressed';
$LNG->EXPLORE_ORG_PROPOSING = $LNG->ORGS_NAME.' proposing this';
$LNG->EXPLORE_PROJECTS_PROPOSING = $LNG->PROJECTS_NAME.' proposing this';
$LNG->EXPLORE_PROJECTS_MANAGED = $LNG->PROJECTS_NAME.' managed';
$LNG->EXPLORE_PARTNERS = 'Partners';
$LNG->EXPLORE_SOLUTIONS_SPECIFIED = $LNG->SOLUTIONS_NAME.' specified';
$LNG->EXPLORE_CLAIMS_MADE = $LNG->CLAIMS_NAME.' made';
$LNG->EXPLORE_EVIDENCE_SPECIFIED = $LNG->EVIDENCES_NAME.' specified';
$LNG->EXPLORE_MANAGING_ORGS = 'Managing '.$LNG->ORGS_NAME;
*/

/** OVERVIEW TITLES **/
/*
//Challenge
$LNG->OVERVIEW_CHALLENGE_MOSTRECENT_TITLE = 'Most Recent '.$LNG->CHALLENGES_NAME;
$LNG->OVERVIEW_CHALLENGE_MOSTCONNECTED_TITLE = 'Most Connected '.$LNG->CHALLENGES_NAME;
$LNG->OVERVIEW_CHALLENGE_MOSTVOTED_TITLE = 'Most Voted on '.$LNG->CHALLENGES_NAME;
$LNG->OVERVIEW_CHALLENGE_POPULARTHEMES_TITLE = 'Most Popular '.$LNG->THEMES_NAME.' for '.$LNG->CHALLENGES_NAME;
//Issue
$LNG->OVERVIEW_ISSUE_MOSTRECENT_TITLE = 'Most Recent '.$LNG->ISSUES_NAME;
$LNG->OVERVIEW_ISSUE_MOSTCONNECTED_TITLE = 'Most Connected '.$LNG->ISSUES_NAME;
$LNG->OVERVIEW_ISSUE_MOSTVOTED_TITLE = 'Most Voted on '.$LNG->ISSUES_NAME;
$LNG->OVERVIEW_ISSUE_POPULARTHEMES_TITLE = 'Most Popular '.$LNG->THEMES_NAME.' for '.$LNG->ISSUES_NAME;
//Claim
$LNG->OVERVIEW_CLAIM_MOSTRECENT_TITLE = 'Most Recent '.$LNG->CLAIMS_NAME;
$LNG->OVERVIEW_CLAIM_MOSTCONNECTED_TITLE = 'Most Connected '.$LNG->CLAIMS_NAME;
$LNG->OVERVIEW_CLAIM_MOSTVOTED_TITLE = 'Most Voted on '.$LNG->CLAIMS_NAME;
$LNG->OVERVIEW_CLAIM_POPULARTHEMES_TITLE = 'Most Popular '.$LNG->THEMES_NAME.' for '.$LNG->CLAIMS_NAME;
//Solution
$LNG->OVERVIEW_SOLUTION_MOSTRECENT_TITLE = 'Most Recent '.$LNG->SOLUTIONS_NAME;
$LNG->OVERVIEW_SOLUTION_MOSTCONNECTED_TITLE = 'Most Connected '.$LNG->SOLUTIONS_NAME;
$LNG->OVERVIEW_SOLUTION_MOSTVOTED_TITLE = 'Most Voted on '.$LNG->SOLUTIONS_NAME;
$LNG->OVERVIEW_SOLUTION_POPULARTHEMES_TITLE = 'Most Popular '.$LNG->THEMES_NAME.' for '.$LNG->SOLUTIONS_NAME;
//Evidence
$LNG->OVERVIEW_EVIDENCE_MOSTRECENT_TITLE = 'Most Recent '.$LNG->EVIDENCES_NAME;
$LNG->OVERVIEW_EVIDENCE_MOSTCONNECTED_TITLE = 'Most Connected '.$LNG->EVIDENCES_NAME;
$LNG->OVERVIEW_EVIDENCE_MOSTVOTED_TITLE = 'Most Voted on '.$LNG->EVIDENCES_NAME;
$LNG->OVERVIEW_EVIDENCE_POPULARTHEMES_TITLE = 'Most Popular '.$LNG->THEMES_NAME.' for '.$LNG->EVIDENCES_NAME;
//Resource
$LNG->OVERVIEW_RESOURCE_MOSTRECENT_TITLE = 'Most Recent '.$LNG->RESOURCES_NAME;
$LNG->OVERVIEW_RESOURCE_MOSTCONNECTED_TITLE = 'Most Connected '.$LNG->RESOURCES_NAME;
$LNG->OVERVIEW_RESOURCE_POPULARTHEMES_TITLE = 'Most Popular '.$LNG->THEMES_NAME.' for '.$LNG->RESOURCES_NAME;
//Org
$LNG->OVERVIEW_ORG_MOSTRECENT_TITLE = 'Most Recent '.$LNG->ORGS_NAME;
$LNG->OVERVIEW_ORG_MOSTCONNECTED_TITLE = 'Most Connected '.$LNG->ORGS_NAME;
$LNG->OVERVIEW_ORG_POPULARTHEMES_TITLE = 'Most Popular '.$LNG->THEMES_NAME.' for '.$LNG->ORGS_NAME;
$LNG->OVERVIEW_ORG_COUNTRIES_TITLE = $LNG->ORG_NAME.' Countries';
$LNG->OVERVIEW_ORG_COUNTRIES_HINT = 'click to explore all '.$LNG->ORGS_NAME;
//Project
$LNG->OVERVIEW_PROJECT_MOSTRECENT_TITLE = 'Most Recent '.$LNG->PROJECTS_NAME;
$LNG->OVERVIEW_PROJECT_MOSTCONNECTED_TITLE = 'Most Connected '.$LNG->PROJECTS_NAME;
$LNG->OVERVIEW_PROJECT_POPULARTHEMES_TITLE = 'Most Popular '.$LNG->THEMES_NAME.' for '.$LNG->PROJECTS_NAME;
$LNG->OVERVIEW_PROJECT_COUNTRIES_TITLE = $LNG->PROJECT_NAME.' Countries';
$LNG->OVERVIEW_PROJECT_COUNTRIES_HINT = 'click to explore all '.$LNG->PROJECTS_NAME;
//User
$LNG->OVERVIEW_USER_MOSTRECENT_TITLE = 'Most Recent '.$LNG->USERS_NAME;
$LNG->OVERVIEW_USER_MOSTFOLLOWED_TITLE = 'Most Followed '.$LNG->USERS_NAME;
$LNG->OVERVIEW_USER_MOSTACTIVE_TITLE = 'Most Active '.$LNG->USERS_NAME.' in the past Month';
$LNG->OVERVIEW_USER_COUNTRIES_TITLE = $LNG->USER_NAME.' Countries';
$LNG->OVERVIEW_USER_COUNTRIES_HINT = 'click to explore all '.$LNG->USERS_NAME;
//Buttons
$LNG->OVERVIEW_BUTTON_EXPLOREALL = 'Explore all';
$LNG->OVERVIEW_BUTTON_VIEWONMAP = 'View on Map';
*/

/** LIST HOME BUTTON HINTS **/
/*
$LNG->CHALLENGE_HOME_LIST_BUTTON_HINT = 'Click to go to the '.$LNG->CHALLENGES_NAME.' List';
$LNG->ISSUE_HOME_LIST_BUTTON_HINT = 'Click to go to the '.$LNG->ISSUES_NAME.' List';
$LNG->CLAIM_HOME_LIST_BUTTON_HINT = 'Click to go to the '.$LNG->CLAIMS_NAME.' List';
$LNG->SOLUTION_HOME_LIST_BUTTON_HINT = 'Click to go to the '.$LNG->SOLUTIONS_NAME.' List';
$LNG->EVIDENCE_HOME_LIST_BUTTON_HINT = 'Click to go to the '.$LNG->EVIDENCES_NAME.' List';
$LNG->RESOURCE_HOME_LIST_BUTTON_HINT = 'Click to go to the '.$LNG->RESOURCES_NAME.' List';
$LNG->ORG_HOME_LIST_BUTTON_HINT = 'Click to go to the '.$LNG->ORGS_NAME.' List';
$LNG->PROJECT_HOME_LIST_BUTTON_HINT = 'Click to go to the '.$LNG->PROJECTS_NAME.' List';
$LNG->HOME_PAGE_BUTTON_HINT = "Click to go to the Home Page";

$LNG->HOME_ADDITIONAL_INFO_TOGGLE_HINT = 'Click to view/hide additional information';

$LNG->NAV_FILTER_ORG_HINT = 'Click to filter by '.$LNG->ORG_NAME.'. Click again to unfilter.';
$LNG->NAV_FILTER_PROJECT_HINT = 'Click to filter by '.$LNG->PROJECT_NAME.'. Click again to unfilter.';
*/

/** FORM LABELS, BUTTONS AND TEXT **/
/*
$LNG->MAILCHIMP_NEWSLETTER_FORM_REGISTER_MESSAGE = "Tick to receive our newsletter";
$LNG->MAILCHIMP_NEWSLETTER_FORM_PROFILE_MESSAGE = "Opt in/out of receiving our newsletter";
$LNG->MAILCHIMP_NEWSLETTER_FORM_FURTHER_INFO = "Find out more about our newsletter";
$LNG->MAILCHIMP_NEWSLETTER_FORM_MESSAGE = "We use MailChimp for our newsletters. If you subscribe, please be aware that your email address will be shared with our MailChimp account.";
$LNG->MAILCHIMP_NEWSLETTER_FORM_SUBSCRIPTION_SUCCESS = "Newsletter subscription successful - look for the confirmation email!";
$LNG->MAILCHIMP_NEWSLETTER_FORM_SUBSCRIPTION_FAILED = "Unsuccessful attempt to subscribe you to the Newsletter (see above for details)";
$LNG->MAILCHIMP_NEWSLETTER_FORM_UNSUBSCRIPTION_FAILED = "Unsuccessful attempt to unsubscribe you from the Newsletter (see above for details)";
$LNG->MAILCHIMP_NEWSLETTER_FORM_SUBSCRIPTION_FAILED_NEW_EMAIL = "Unsuccessful attempt to subscribe you to the Newsletter (see above for details) with your new email address";
$LNG->MAILCHIMP_NEWSLETTER_FORM_UNSUBSCRIPTION_FAILED_OLD_EMAIL = "Unsuccessful attempt to unsubscribe you from the Newsletter (see above for details) from your previous email address";
$LNG->MAILCHIMP_NEWSLETTER_FORM_EDIT_NAME_FAILED = "Unsuccessful attempt to change your name on the Newsletter (see above for details)";

$LNG->CONDITIONS_REGISTER_FORM_TITLE = 'Terms and Conditions of use';
$LNG->CONDITIONS_REGISTER_FORM_MESSAGE = 'By registering to be a member of this Hub you agree to the Terms and Conditions of this Hub as written in our <a href="'.$CFG->homeAddress.'ui/pages/conditionsofuse.php">Terms of Use</a>.';
$LNG->CONDITIONS_AGREE_FORM_REGISTER_MESSAGE = 'I agree to the terms and conditions of use of this Hub';
$LNG->CONDITIONS_AGREE_FAILED_MESSAGE = 'You must agree to the terms and conditions of use of this Hub before you can register.';
*/

/** QUICK FORM SPECIFIC **/
/*
$LNG->QUICKFORM_STEP1 = 'Step 1: '.$LNG->ISSUE_NAME;
$LNG->QUICKFORM_P_STEP2 = 'Step 2: '.$LNG->SOLUTION_NAME;
$LNG->QUICKFORM_R_STEP2 = 'Step 2: '.$LNG->CLAIM_NAME;
$LNG->QUICKFORM_STEP3 = 'Step 3: '.$LNG->EVIDENCE_NAME;
$LNG->QUICKFORM_STEP4 = 'Step 4: '.$LNG->RESOURCE_NAME;
$LNG->QUICKFORM_STEP5 = 'Step 5: '.$LNG->THEMES_NAME.' & Tags';
$LNG->QUICKFORM_STEP5b = '& '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.'';
$LNG->QUICKFORM_OPTIONAL = '(Optional)';

$LNG->QUICKFORM_STEP1_HINT = 'Click to view the '.$LNG->ISSUE_NAME.' section of the form';
$LNG->QUICKFORM_P_STEP2_HINT = 'Click to view the '.$LNG->SOLUTION_NAME.' section of the form';
$LNG->QUICKFORM_R_STEP2_HINT = 'Click to view the '.$LNG->CLAIM_NAME.' section of the form';
$LNG->QUICKFORM_STEP3_HINT = 'Click to view the '.$LNG->EVIDENCE_NAME.' section of the form';
$LNG->QUICKFORM_STEP4_HINT = 'Click to view the '.$LNG->RESOURCES_NAME.' section of the form';
$LNG->QUICKFORM_STEP5_HINT = 'Click to view the '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.', '.$LNG->THEMES_NAME.' and Tags section of the form';

$LNG->QUICKFORM_P_STEP1_SECTION_HEADING = 'What question are you investigating?';
$LNG->QUICKFORM_R_STEP1_SECTION_HEADING = 'What research question are you investigating?';
$LNG->QUICKFORM_P_STEP2_SECTION_HEADING = 'What '.$LNG->SOLUTION_NAME.' can you propose to help tackle your '.$LNG->ISSUE_NAME.'?';
$LNG->QUICKFORM_R_STEP2_SECTION_HEADING = 'What '.$LNG->CLAIM_NAME.' can you make that helps answer your research question?';
$LNG->QUICKFORM_P_STEP3_SECTION_HEADING = 'Is there any '.$LNG->EVIDENCE_NAME.' to support your '.$LNG->SOLUTION_NAME_SHORT.'?';
$LNG->QUICKFORM_R_STEP3_SECTION_HEADING = 'Is there any '.$LNG->EVIDENCE_NAME.' to support your '.$LNG->CLAIM_NAME_SHORT.'?';
$LNG->QUICKFORM_STEP4_SECTION_HEADING = 'What '.$LNG->RESOURCES_NAME.' can you point to in order to back up your '.$LNG->EVIDENCE_NAME.'?';
$LNG->QUICKFORM_STEP5_SECTION_HEADING = 'Connect your story to an '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.', '.$LNG->THEMES_NAME.' and Tags';

$LNG->QUICKFORM_P_STEP1_SECTION_MESSAGE = 'Add a question/issue you are investigating and you think it is particularly important for the community to tackle.';
$LNG->QUICKFORM_R_STEP1_SECTION_MESSAGE = 'Add a question/issue you are investigating and you think it is particularly important for the community to tackle.';
$LNG->QUICKFORM_P_STEP2_SECTION_MESSAGE = 'Add a '.$LNG->SOLUTION_NAME.' to the '.$LNG->ISSUE_NAME.' you just proposed';
$LNG->QUICKFORM_R_STEP2_SECTION_MESSAGE = 'Add a '.$LNG->CLAIM_NAME.' which addresses the '.$LNG->ISSUE_NAME.' you just proposed';
$LNG->QUICKFORM_P_STEP3_SECTION_MESSAGE = 'Add a Supporting '.$LNG->EVIDENCE_NAME.' to the '.$LNG->SOLUTION_NAME.' you proposed by specifying what type of '.$LNG->EVIDENCE_NAME.' it is ('.implode(",",$CFG->EVIDENCE_TYPES).')';
$LNG->QUICKFORM_R_STEP3_SECTION_MESSAGE = 'Add a Supporting '.$LNG->EVIDENCE_NAME.' to the '.$LNG->CLAIM_NAME.' you proposed by specifying what type of '.$LNG->EVIDENCE_NAME.' it is ('.implode(",",$CFG->EVIDENCE_TYPES).')';
$LNG->QUICKFORM_STEP4_SECTION_MESSAGE = "Resources can either be Web Resources (e.g. URL links to Web Sites, You tube video, Slideshare presentations, etc) or Publications. Please change the 'Type' if you want to add a URL which points to a Publication.";
$LNG->QUICKFORM_P_STEP5_SECTION_MESSAGE_ORG = 'Associate the '.$LNG->ISSUE_NAME.', '.$LNG->SOLUTION_NAME_SHORT.' and '.$LNG->EVIDENCE_NAME.' you have entered as being specifed by a particular '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.'.';
$LNG->QUICKFORM_R_STEP5_SECTION_MESSAGE_ORG = 'Associate the '.$LNG->ISSUE_NAME.', '.$LNG->CLAIM_NAME_SHORT.' and '.$LNG->EVIDENCE_NAME.' you have entered as being specifed by a particular '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.'.';
$LNG->QUICKFORM_P_STEP5_SECTION_MESSAGE_THEME = 'Associate one or more '.$LNG->THEME_NAME.' to the '.$LNG->ISSUE_NAME.', '.$LNG->SOLUTION_NAME_SHORT.', '.$LNG->EVIDENCE_NAME.' and '.$LNG->RESOURCES_NAME.' you have added.';
$LNG->QUICKFORM_R_STEP5_SECTION_MESSAGE_THEME = 'Associate one or more '.$LNG->THEME_NAME.' to the '.$LNG->ISSUE_NAME.', '.$LNG->CLAIM_NAME_SHORT.', '.$LNG->EVIDENCE_NAME.' and '.$LNG->RESOURCES_NAME.' you have added.';
$LNG->QUICKFORM_P_STEP5_SECTION_MESSAGE_TAG = 'Add any tags you want to be associated to the '.$LNG->ISSUE_NAME.', '.$LNG->SOLUTION_NAME_SHORT.', '.$LNG->EVIDENCE_NAME.' and '.$LNG->RESOURCES_NAME.' you have added.';
$LNG->QUICKFORM_R_STEP5_SECTION_MESSAGE_TAG = 'Add any tags you want to be associated to the '.$LNG->ISSUE_NAME.', '.$LNG->CLAIM_NAME_SHORT.', '.$LNG->EVIDENCE_NAME.' and '.$LNG->RESOURCES_NAME.' you have added.';

$LNG->FORM_QUICK_HEADER_MESSAGE = 'Please be aware that all data you enter here will be publically viewable on this site by other users.';
$LNG->FORM_QUICK_REQUIRED_FIELDS_MESSAGE_PART1 = '(fields with a';
$LNG->FORM_QUICK_REQUIRED_FIELDS_MESSAGE_PART2 = 'are compulsory only if you want to enter that item)';
$LNG->FORM_QUICK_PRACTITIONER_STORY_TITLE = 'Add your story as a Practitioner';
$LNG->FORM_QUICK_RESEARCHER_STORY_TITLE = 'Add your story as a Researcher';
$LNG->FORM_QUICK_ISSUE_DESC_ERROR = 'Please enter an '.$LNG->ISSUE_NAME.' summary as well as the description before trying to publish';
$LNG->FORM_QUICK_SOLUTION_DESC_ERROR = 'Please enter a '.$LNG->SOLUTION_NAME.' summary as well as the description before trying to publish';
$LNG->FORM_QUICK_CLAIM_DESC_ERROR = 'Please enter a '.$LNG->CLAIM_NAME.' summary as well as the description before trying to publish';
$LNG->FORM_QUICK_EVIDENCE_DESC_ERROR = 'Please enter an '.$LNG->EVIDENCE_NAME.' summary as well as the description before trying to publish';
*/

/** OTHER FORMS **/
/*
$LNG->FORM_REGISTER_OPEN_TITLE = 'Register';
$LNG->FORM_REGISTER_REQUEST_TITLE = 'Registration Request';
$LNG->FORM_REGISTER_ADMIN_TITLE = 'Register a New User';
$LNG->FORM_REGISTER_EMAIL = 'Email:';
$LNG->FORM_REGISTER_DESC = 'Description:';
$LNG->FORM_REGISTER_PASSWORD = 'Password:';
$LNG->FORM_REGISTER_PASSWORD_CONFIRM = 'Confirm Password:';
$LNG->FORM_REGISTER_NAME = 'Full name:';
$LNG->FORM_REGISTER_INTEREST = 'Interest in this Evidence Hub:';
$LNG->FORM_REGISTER_LOCATION = 'Location: (town/city)';
$LNG->FORM_REGISTER_COUNTRY = 'Country...';
$LNG->FORM_REGISTER_HOMEPAGE = 'Homepage:';
$LNG->FORM_REGISTER_NEWSLETTER = 'Newsletter:';
$LNG->FORM_REGISTER_SUBMIT_BUTTON = 'Register';
$LNG->FORM_REGISTER_REQUEST_DESC = 'Personal Description:';
$LNG->FORM_REGISTER_IMAGE_ERROR = "Please edit your profile and upload a different image once you complete your registration.";

$LNG->REGISTRATION_SUCCESSFUL_TITLE = 'Registration Successful';
$LNG->REGISTRATION_SUCCESSFUL_MESSAGE = 'You will shortly receive an email. You must click on the link inside it to validate your email address and complete your Hub Registration.';
$LNG->REGISTRATION_SUCCESSFUL_MESSAGE_NEW = 'You will shortly receive a welcome email.';
$LNG->REGISTRATION_COMPLETE_TITLE = 'Registration Complete';
$LNG->REGISTRATION_FAILED = 'Your registration could not be completed. Please try registering again';
$LNG->REGISTRATION_FAILED_INVALID = 'Your registration could not be completed as the Registration key was invalid for the given user. Please try registering again';
$LNG->REGISTRATION_SUCCESSFUL_LOGIN = "You can now <a href='".$CFG->homeAddress."ui/pages/login.php'>log in</a>";

$LNG->REGISTRATION_REQUEST_SUCCESSFUL_TITLE = 'Registration Request Recieved';
$LNG->REGISTRATION_REQUEST_SUCCESSFUL_MESSAGE = 'Thank you for your interest in contributing to this Evidence Hub.<br>Your registration request has been sent and you will be contacted shortly.';

$LNG->REGISTRATION_REQUEST_SUCCESSFUL_TITLE_ADMIN = 'Registration of new user successful';
$LNG->REGISTRATION_REQUEST_SUCCESSFUL_MESSAGE_ADMIN = "An email has been sent to the new User with their Sign In details";

$LNG->FORM_HEADER_MESSAGE = 'Please be aware that all data you enter here will be publically viewable on this site by other users.';
$LNG->FORM_REQUIRED_FIELDS_MESSAGE_PART1 = '(fields with a';
$LNG->FORM_REQUIRED_FIELDS_MESSAGE_PART2 = 'are compulsory';
$LNG->FORM_REQUIRED_FIELDS_MESSAGE_PART3 = ', unless they are in an optional subsection which you are not completing)';
$LNG->FORM_REQUIRED_FIELDS_MESSAGE_PART4 = '.)';

$LNG->FORM_RELEVANCE_LABEL = 'Why is this relevant to';
$LNG->FORM_REQUIRED_FIELDS = 'indicates required field';
$LNG->FORM_LABEL_SUMMARY = 'Summary:';
$LNG->FORM_LABEL_DESC = 'Description:';
$LNG->FORM_LABEL_TYPE = 'Type:';
$LNG->FORM_LABEL_EVIDENCE_TYPE = $LNG->EVIDENCE_NAME.' Type:';
$LNG->FORM_LABEL_EVIDENCE_RESOURCES = $LNG->EVIDENCE_NAME.' '.$LNG->RESOURCES_NAME.':';
$LNG->FORM_LABEL_ORG_PROJECT = $LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.':';
$LNG->FORM_LABEL_ORG_PROJECT_CHOICE = $LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.'...';
$LNG->FORM_LABEL_URL = 'Url:';
$LNG->FORM_LABEL_TITLE = 'Title:';
$LNG->FORM_LABEL_DOI = 'DOI:';
$LNG->FORM_LABEL_NAME = 'Name:';
$LNG->FORM_LABEL_THEME = $LNG->THEMES_NAME.':';
$LNG->FORM_LABEL_TAGS = 'Add Tags:';
$LNG->FORM_LABEL_TAGS_HINT = '(comma separated)';
$LNG->FORM_LABEL_ADDED_TAGS = 'Added Tags:';
$LNG->FORM_LABEL_ADDED_TAGS_HINT = '(Select to remove)';
$LNG->FORM_LABEL_PROJECT_STARTED_DATE = 'Started on:';
$LNG->FORM_LABEL_PROJECT_ENDED_DATE = 'Ended on:';
$LNG->FORM_LABEL_LOCATION = 'Location';
$LNG->FORM_LABEL_ADDRESS1 = 'Address 1:';
$LNG->FORM_LABEL_ADDRESS2 = 'Address 2:';
$LNG->FORM_LABEL_TOWN = 'Town/City:';
$LNG->FORM_LABEL_POSTAL_CODE = 'Postal Code:';
$LNG->FORM_LABEL_COUNTRY = 'Country:';
$LNG->FORM_LABEL_COUNTRY_CHOICE = 'Country...';
$LNG->FORM_LABEL_CHALLENGES_TOGGLE = 'Show/Hide '.$LNG->CHALLENGES_NAME.':';
$LNG->FORM_LABEL_CHALLENGES = $LNG->CHALLENGES_NAME.':';
$LNG->FORM_LABEL_PARTNERS = 'Partners:';
$LNG->FORM_LABEL_PARTNERS_CHOICE = $LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.'...';
$LNG->FORM_LABEL_RESOURCES = $LNG->RESOURCES_NAME.':';
$LNG->FORM_LABEL_CLIP = 'Clip:';
$LNG->FORM_LABEL_CLIPS = 'Clips:';
$LNG->FORM_LABEL_MANAGED = 'Managed:';

$LNG->FORM_DESC_PLAIN_TEXT_LINK = 'Plain text';
$LNG->FORM_DESC_PLAIN_TEXT_HINT = 'Switch to a plain text. Formatting will be lost.';
$LNG->FORM_DESC_HTML_TEXT_LINK = 'Formatting';
$LNG->FORM_DESC_HTML_TEXT_HINT = 'Show formatting toolbar.';
$LNG->FORM_DESC_HTML_SWITCH_WARNING = 'Are you sure you want to switch to plain text? Warning: All Formatting will be lost.';

$LNG->FORM_AUTOCOMPLETE_TITLE_HINT = 'Try and fetch the website title from the website page data';
$LNG->FORM_SELECT_RESOURCE_HINT = 'Select/create a '.$LNG->RESOURCE_NAME.' to support this';

$LNG->FORM_BUTTON_REMOVE = 'remove';
$LNG->FORM_BUTTON_REMOVE_CAP = 'Remove';
$LNG->FORM_BUTTON_SELECT_ANOTHER = 'Select Another';
$LNG->FORM_BUTTON_ADD_ANOTHER = 'add another';
$LNG->FORM_BUTTON_CHANGE = 'change';
$LNG->FORM_BUTTON_ADD = 'Add';
$LNG->FORM_BUTTON_ADD_NEW = 'Add New';
$LNG->FORM_BUTTON_PUBLISH = 'Publish';
$LNG->FORM_BUTTON_CANCEL = 'Cancel';
$LNG->FORM_BUTTON_CLOSE = 'Close';
$LNG->FORM_BUTTON_CONTINUE = 'Continue';
$LNG->FORM_BUTTON_SAVE = 'Save';
$LNG->FORM_BUTTON_NEXT = 'Next   >';
$LNG->FORM_BUTTON_BACK = '<   Back';
$LNG->FORM_BUTTON_SKIP = 'Skip   >';
$LNG->FORM_BUTTON_PRINT_PAGE = 'Print Page';
$LNG->FORM_BUTTON_SELECT_MANAGED_PROJECT_TEXT = 'ADD';
$LNG->FORM_BUTTON_SELECT_MANAGED_PROJECT_HINT = 'Select/create a '.$LNG->PROJECT_NAME.' you manage';
$LNG->FORM_MANAGED_PROJECTS_HINT = 'Another row will be added automatically';

$LNG->FORM_ERROR_NOT_ADMIN = 'You do not have permissions to view this page';
$LNG->FORM_ERROR_MESSAGE = 'The following problems were found, please try again';
$LNG->FORM_ERROR_MESSAGE_LOGIN = 'The following issues were found with your sign in attempt:';
$LNG->FORM_ERROR_MESSAGE_REGISTRATION = 'The following problems were found with your registration, please try again:';
$LNG->FORM_ERROR_THEME = 'Please make sure you pick at least one '.$LNG->THEME_NAME;
$LNG->FORM_ERROR_NOT_ADMIN = "Sorry you need to be an administrator to access this page";
$LNG->FORM_ERROR_PASSWORD_MISMATCH = "The password and password confirmation don't match. Please try again.";
$LNG->FORM_ERROR_PASSWORD_MISSING = "Please enter a password.";
$LNG->FORM_ERROR_NAME_MISSING = 'Please enter your full name.';
$LNG->FORM_ERROR_INTEREST_MISSING = "Please enter your interest in having an account with us.";
$LNG->FORM_ERROR_URL_INVALID = "Please enter a full valid URL (including 'http://') for your homepage.";
$LNG->FORM_ERROR_EMAIL_INVALID = "Please enter a valid email address.";
$LNG->FORM_ERROR_EMAIL_USED = "This email address is already in use, please either Sign In or select a different email address.";
$LNG->FORM_ERROR_MAILCHIMP_SUBSCRIPTION = 'Your Registration was successful, however your Newsletter subscription failed.';

$LNG->FORM_TITLE_CURRENT_ITEM = 'The current Item';
$LNG->FORM_CONNECT_RELEVANCE_SECTION = 'Optionally say why you are making this connection';
$LNG->FORM_THEME_CREATE_ERROR_MESSAGE = 'There was an problem creating the '.$LNG->THEME_NAME.':';
$LNG->FORM_QUICK_THANKS = 'Thank you for adding your story to the Evidendce Hub';

// Tag manager / Usage viewer
$LNG->FORM_TAG_MANAGER_TITLE = 'Manage Tags';
$LNG->FORM_TAG_MANAGER_NAME_LABEL = 'Name';
$LNG->FORM_TAG_MANAGER_ACTIONS_LABEL = 'Actions';
$LNG->FORM_TAG_MANAGER_EDIT_LINK = 'edit';
$LNG->FORM_TAG_MANAGER_DELETE_LINK = 'delete';
$LNG->FORM_TAG_MANAGER_VIEW_USAGE_LINK = 'view usage';
$LNG->FORM_TAG_MANAGER_DELETE_MESSAGE_PART1 = 'Are you sure you want to delete the tag';
$LNG->FORM_TAG_MANAGER_DELETE_MESSAGE_PART2 = "?\\n\\nThis tag will be removed from all items you have tagged with it. You may want to 'view usage' first, as this action cannot be undone.";
$LNG->FORM_TAG_MANAGER_NAME_ERROR = 'You must enter a tag name.';
$LNG->FORM_TAG_MANAGER_TAGID_ERROR = 'Error passing tag id.';
$LNG->FORM_TAG_USAGE_TITLE = 'View Usage for:';
$LNG->FORM_TAG_USAGE_NO_ITEMS_MESSAGE = 'You have not created any items using this tag';

//Selector
$LNG->FORM_SELECTOR_TITLE_DEFAULT = 'Select an item';
$LNG->FORM_SELECTOR_TITLE_CHALLENGE = 'Select a '.$LNG->CHALLENGE_NAME;
$LNG->FORM_SELECTOR_TITLE_RESOURCE = 'Select a '.$LNG->RESOURCE_NAME;
$LNG->FORM_SELECTOR_TITLE_EVIDENCE = 'Select a piece of '.$LNG->EVIDENCE_NAME;
$LNG->FORM_SELECTOR_TITLE_ISSUE = 'Select an '.$LNG->ISSUE_NAME;
$LNG->FORM_SELECTOR_TITLE_SOLUTION = 'Select a '.$LNG->SOLUTION_NAME;
$LNG->FORM_SELECTOR_TITLE_CLAIM = 'Select a '.$LNG->CLAIM_NAME;
$LNG->FORM_SELECTOR_TITLE_PROJECT = 'Select a '.$LNG->PROJECT_NAME;
$LNG->FORM_SELECTOR_TITLE_ORG = 'Select an '.$LNG->ORG_NAME;
$LNG->FORM_SELECTOR_TITLE_PROJECTORG = 'Select an '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME;
$LNG->FORM_SELECTOR_SEARCH_ERROR = 'There was an error retreiving your search from the server';
$LNG->FORM_SELECTOR_NOT_ITEMS = 'You have not created any items of the required type';
$LNG->FORM_SELECTOR_SEARCH_LABEL = 'Search';
$LNG->FORM_SELECTOR_SEARCH_MESSAGE = '( This is a key word/phrase search. Leave empty to list all )';
$LNG->FORM_SELECTOR_SEARCH_EMPTY_MESSAGE = 'Type a key word or phrase into the search box above';
$LNG->FORM_SELECTOR_TAB_MINE = 'Mine';
$LNG->FORM_SELECTOR_TAB_SEARCH_RESULTS = 'Search Results';

//Activity Forms
$LNG->FORM_ACTIVITY_HEADING = 'Recent Activity For';
$LNG->FORM_ACTIVITY_TABLE_HEADING_DATE = 'Date';
$LNG->FORM_ACTIVITY_TABLE_HEADING_TYPE = 'Type';
$LNG->FORM_ACTIVITY_TABLE_HEADING_DONEBY = 'Done By';
$LNG->FORM_ACTIVITY_TABLE_HEADING_ACTION = 'Action';
$LNG->FORM_ACTIVITY_TABLE_HEADING_ITEM = 'Item';
$LNG->FORM_ACTIVITY_ACTION_STARTED_FOLLOWING = 'started following';
$LNG->FORM_ACTIVITY_ACTION_STARTED_FOLLOWING_ITEM = 'started following this item';
$LNG->FORM_ACTIVITY_ACTION_VOTE_PROMOTED = 'promoted';
$LNG->FORM_ACTIVITY_ACTION_VOTE_DEMOTED = 'demoted';
$LNG->FORM_ACTIVITY_ACTION_VOTE_PROMOTED_ITEM = 'promoted this item';
$LNG->FORM_ACTIVITY_ACTION_VOTE_DEMOTED_ITEM = 'demoted this item';
$LNG->FORM_ACTIVITY_ACTION_ADDED = 'added';
$LNG->FORM_ACTIVITY_ACTION_EDITED = 'edited';
$LNG->FORM_ACTIVITY_ACTION_ADDED_ITEM = 'added this item';
$LNG->FORM_ACTIVITY_ACTION_EDITED_ITEM = 'edited this item';
$LNG->FORM_ACTIVITY_ACTION_ASSOCIATED = 'associated';
$LNG->FORM_ACTIVITY_ACTION_DESOCIATED = 'removed association';
$LNG->FORM_ACTIVITY_ACTION_ADDED_THEME = "added this ".$LNG->THEME_NAME." to";
$LNG->FORM_ACTIVITY_ACTION_ADDED_RESOURCE = "added the ".$LNG->RESOURCE_NAME;
$LNG->FORM_ACTIVITY_ACTION_ADDED_EVIDENCE_PRO = "added Supporting ".$LNG->EVIDENCE_NAME;
$LNG->FORM_ACTIVITY_ACTION_ADDED_EVIDENCE_CON = "added Counter ".$LNG->EVIDENCE_NAME;
$LNG->FORM_ACTIVITY_ACTION_ADDED_EVIDENCE = "associated this with the ".$LNG->EVIDENCE_NAME;
$LNG->FORM_ACTIVITY_ACTION_ASSOCIATED_WITH = "associated this with the";
$LNG->FORM_ACTIVITY_ACTION_REMOVED_THEME = "remove this ".$LNG->THEME_NAME." from";
$LNG->FORM_ACTIVITY_ACTION_REMOVED = "removed";
$LNG->FORM_ACTIVITY_ACTION_REMOVED_RESOURCE = "removed the ".$LNG->RESOURCE_NAME;
$LNG->FORM_ACTIVITY_ACTION_REMOVED_EVIDENCE = "removed the ".$LNG->EVIDENCE_NAME;
$LNG->FORM_ACTIVITY_ACTION_REMOVED_ASSOCIATION = "removed association with";
$LNG->FORM_ACTIVITY_ACTION_INDICATED_THAT = 'indicated that';
$LNG->FORM_ACTIVITY_ACTION_STRONG_SOLUTION = 'was a strong '.$LNG->SOLUTION_NAME_SHORT.' for';
$LNG->FORM_ACTIVITY_ACTION_SOUND_CLAIM = 'was a sound '.$LNG->CLAIM_NAME_SHORT.' for';
$LNG->FORM_ACTIVITY_ACTION_CONVINCING_EVIDENCE = 'was convincing '.$LNG->EVIDENCE_NAME.' for';
$LNG->FORM_ACTIVITY_ACTION_SOUND_EVIDENCE = 'was sound '.$LNG->EVIDENCE_NAME.' for';
$LNG->FORM_ACTIVITY_ACTION_PROMOTED = 'should be promoted against';
$LNG->FORM_ACTIVITY_ACTION_WEAK_SOLUTION = 'was a weak '.$LNG->SOLUTION_NAME_SHORT.' for';
$LNG->FORM_ACTIVITY_ACTION_UNSOUND_CLAIM = 'was a unsound '.$LNG->CLAIM_NAME_SHORT.' for';
$LNG->FORM_ACTIVITY_ACTION_UNCONVINCING_EVIDENCE = 'was unconvincing '.$LNG->EVIDENCE_NAME.' for';
$LNG->FORM_ACTIVITY_ACTION_UNSOUND_EVIDENCE = 'was unsound '.$LNG->EVIDENCE_NAME.' for';
$LNG->FORM_ACTIVITY_ACTION_DEMOTED = 'should be demoted against';
$LNG->FORM_ACTIVITY_LABEL_WITH = 'with';
$LNG->FORM_ACTIVITY_LABEL_FROM = 'from';
$LNG->FORM_ACTIVITY_PROBLEM_MESSAGE = 'The following problems were found retrieving the activities data: ';

//Form Print
$LNG->FORM_PRINT_LOADING_MESSAGE = 'This may take a minute or so depending on the amount of associated data the current item has';
$LNG->FORM_PRINT_NONE_FOUND_PART1 = 'No';
$LNG->FORM_PRINT_NONE_FOUND_PART2 = 'found';
$LNG->FORM_PRINT_FOLLOWERS_HEADING = $LNG->FOLLOWERS_NAME;
$LNG->FORM_PRINT_COMMENTS_HEADING = $LNG->COMMENTS_NAME;
$LNG->FORM_PRINT_RESOURCES_HEADING = $LNG->RESOURCES_NAME;
$LNG->FORM_PRINT_PARTNERS_HEADING = 'Partners';
$LNG->FORM_PRINT_SHARED_THEMES_SOLUTION_HDEAING = $LNG->SOLUTIONS_NAME;
$LNG->FORM_PRINT_SHARED_THEMES_CLAIM_HDEAING = $LNG->CLAIMS_NAME;
$LNG->FORM_PRINT_SHARED_THEMES_ISSUE_HDEAING = $LNG->ISSUES_NAME;
$LNG->FORM_PRINT_SHARED_THEMES_ORGP_HDEAING = $LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME;
$LNG->FORM_PRINT_RESOURCE_EVIDENCE_HEADING = $LNG->EVIDENCES_NAME.' using this '.$LNG->RESOURCE_NAME;
$LNG->FORM_PRINT_CHALLENGE_RESOURCE_HEADING = $LNG->CHALLENGES_NAME.' linked to this '.$LNG->RESOURCE_NAME;
$LNG->FORM_PRINT_CHALLENGE_SOLUTION_HEADING = $LNG->SOLUTION_NAME.' proposed';
$LNG->FORM_PRINT_CHALLENGE_ISSUE_HEADING = $LNG->CHALLENGES_NAME.' this '.$LNG->ISSUE_NAME.' responds to';
$LNG->FORM_PRINT_ORGP_CHALLENGE_HEADING = 'Addressed '.$LNG->CHALLENGES_NAME;
$LNG->FORM_PRINT_ORGP_CLAIM_HEADING = $LNG->CLAIMS_NAME.' made';
$LNG->FORM_PRINT_ORGP_SOLUTION_HEADING = $LNG->SOLUTIONS_NAME.' specified';
$LNG->FORM_PRINT_ORGP_ADDRESSING_HEADING = $LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.' addressing this';
$LNG->FORM_PRINT_ORGP_SPECIFY_HEADING = $LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.' specifying this';
$LNG->FORM_PRINT_ORGP_RESOURCE_HEADING = $LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.' linked to this '.$LNG->RESOURCE_NAME;
$LNG->FORM_PRINT_ISSUE_SOLUTION_HEADING = $LNG->SOLUTIONS_NAME.' to this';
$LNG->FORM_PRINT_ISSUE_CLAIM_HEADING = $LNG->CLAIMS_NAME.' Responding to this';
$LNG->FORM_PRINT_ISSUE_RESOURCE_HEADING = $LNG->ISSUES_NAME.' linked to this '.$LNG->RESOURCE_NAME;
$LNG->FORM_PRINT_ISSUE_CHALLENGE_HEADING = 'Related '.$LNG->ISSUES_NAME.' to this';
$LNG->FORM_PRINT_ISSUE_SOLUTION_HEADING = $LNG->ISSUES_NAME.' this '.$LNG->SOLUTION_NAME.' addresses';
$LNG->FORM_PRINT_SOLUTION_EVIDENCE_PRO_HEADING = 'Supporting '.$LNG->EVIDENCE_NAME;
$LNG->FORM_PRINT_SOLUTION_EVIDENCE_CON_HEADING = 'Counter '.$LNG->EVIDENCE_NAME;
$LNG->FORM_PRINT_SOLUTION_ISSUE_HEADING = $LNG->ISSUES_NAME.' addressed';
$LNG->FORM_PRINT_CLAIM_ORGP_HEADING = $LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.' claiming this';
$LNG->FORM_PRINT_CLAIM_EVIDENCE_PRO_HEADING = 'Supporting '.$LNG->EVIDENCE_NAME;
$LNG->FORM_PRINT_CLAIM_EVIDENCE_CON_HEADING = 'Counter '.$LNG->EVIDENCE_NAME;
$LNG->FORM_PRINT_CLAIM_ISSUE_HEADING = $LNG->ISSUES_NAME.' responded to by this '.$LNG->CLAIM_NAME;
$LNG->FORM_PRINT_ORG_PROJECT_HEADING = $LNG->PROJECTS_NAME.' managed';
$LNG->FORM_PRINT_EVIDENCE_SOLUTION_HEADING = $LNG->SOLUTIONS_NAME.' this is '.$LNG->EVIDENCE_NAME.' for';
$LNG->FORM_PRINT_EVIDENCE_CLAIM_HEADING = $LNG->CLAIMS_NAME.' this is '.$LNG->EVIDENCE_NAME.' for';
$LNG->FORM_PRINT_THEME_CHALLENGE_HEADING = $LNG->CHALLENGES_NAME.' with this '.$LNG->THEME_NAME;
$LNG->FORM_PRINT_THEME_ISSUE_HEADING = $LNG->ISSUES_NAME.' with this '.$LNG->THEME_NAME;
$LNG->FORM_PRINT_THEME_SOLTUION_HEADING = $LNG->SOLUTIONS_NAME.' with this '.$LNG->THEME_NAME;
$LNG->FORM_PRINT_THEME_CLAIM_HEADING = $LNG->CLAIMS_NAME.' with this '.$LNG->THEME_NAME;
$LNG->FORM_PRINT_THEME_EVIDENCE_HEADING = $LNG->EVIDENCE_NAME.'Evidence with this '.$LNG->THEME_NAME;
$LNG->FORM_PRINT_THEME_RESOURCE_HEADING = $LNG->RESOURCES_NAME.' with this '.$LNG->THEME_NAME;
$LNG->FORM_PRINT_THEME_ORGP_HEADING = $LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.' with this '.$LNG->THEME_NAME;


//Challenge
$LNG->FORM_TITLE_CHALLENGE_ADD = 'Add a '.$LNG->CHALLENGE_NAME;
$LNG->FORM_TITLE_CHALLENGE_CONNECT = 'Select '.$LNG->CHALLENGES_NAME.' and connect them to';
$LNG->FORM_TITLE_CHALLENGE_EDIT = 'Edit this '.$LNG->CHALLENGE_NAME;
$LNG->FORM_LABEL_CHALLENGE_SUMMARY = 'Summary';
$LNG->FORM_MESSAGE_CHALLENGE = 'Add a '.$LNG->CHALLENGE_NAME.' you think the community has to tackle.';
$LNG->FORM_CHALLENGE_ENTER_SUMMARY_ERROR = 'Please enter a '.$LNG->CHALLENGE_NAME.' before trying to publish';
$LNG->FORM_CHALLENGE_NOT_FOUND = 'The required '.$LNG->CHALLENGE_NAME.' could not be found';

//Issue
$LNG->FORM_ISSUE_TITLE_SECTION = 'Create/Select an '.$LNG->ISSUE_NAME;
$LNG->FORM_ISSUE_TITLE_CONNECT = $LNG->FORM_ISSUE_TITLE_SECTION.' and connect it to ';
$LNG->FORM_ISSUE_TITLE_ADD = 'Add an '.$LNG->ISSUE_NAME;
$LNG->FORM_ISSUE_TITLE_EDIT = 'Edit this '.$LNG->ISSUE_NAME;
$LNG->FORM_ISSUE_ENTER_SUMMARY_ERROR = 'Please enter an '.$LNG->ISSUE_NAME.' summary before trying to publish';
$LNG->FORM_ISSUE_CREATE_ERROR_MESSAGE = 'There was an problem creating the '.$LNG->ISSUE_NAME.':';
$LNG->FORM_ISSUE_HEADING_MESSAGE = 'Add a question you are investigating or a '.$LNG->ISSUE_NAME.' you think the community has to tackle.';
$LNG->FORM_ISSUE_LABEL_SUMMARY = $LNG->ISSUE_NAME.' Summary:';
$LNG->FORM_ISSUE_NOT_FOUND = 'The required '.$LNG->ISSUE_NAME.' could not be found';
$LNG->FORM_ISSUE_SELECT_EXISTING = 'Select Existing '.$LNG->ISSUE_NAME;

//Claim
$LNG->FORM_CLAIM_LABEL_SUMMARY = $LNG->CLAIM_NAME_SHORT.' Summary:';
$LNG->FORM_CLAIM_TITLE_ADD = 'Add a '.$LNG->CLAIM_NAME;
$LNG->FORM_CLAIM_TITLE_EDIT = 'Edit this '.$LNG->CLAIM_NAME;
$LNG->FORM_CLAIM_SELECT_EXISTING = 'Select Existing '.$LNG->CLAIM_NAME_SHORT;
$LNG->FORM_CLAIM_TITLE_SECTION = 'Create/Select a '.$LNG->CLAIM_NAME;
$LNG->FORM_CLAIM_TITLE_CONNECT = $LNG->FORM_CLAIM_TITLE_SECTION.' and connect it to ';
$LNG->FORM_CLAIM_ENTER_SUMMARY_ERROR = 'Please enter a '.$LNG->CLAIM_NAME.' before trying to publish';
$LNG->FORM_CLAIM_NOT_FOUND = 'The required '.$LNG->CLAIM_NAME.' could not be found';
$LNG->FORM_CLAIM_CREATE_ERROR_MESSAGE = 'There was an problem creating the '.$LNG->CLAIM_NAME;
$LNG->FORM_CLAIM_REMOTE_MESSAGE_LINE1 = 'If you wish to add a '.$LNG->RESOURCE_NAME.' to this '.$LNG->CLAIM_NAME.' is must be using an '.$LNG->EVIDENCE_NAME.' item.';
$LNG->FORM_CLAIM_REMOTE_MESSAGE_LINE2 = 'To add an Evidence try to answer the following question';
$LNG->FORM_CLAIM_REMOTE_MESSAGE_LINE3 = 'Why does this '.$LNG->RESOURCE_NAME.' supports this '.$LNG->CLAIM_NAME.'? What is the '.$LNG->EVIDENCE_NAME.' in this '.$LNG->RESOURCE_NAME.' that made you make this '.$LNG->CLAIM_NAME.'?';
$LNG->FORM_CLAIM_REMOTE_MESSAGE_LINE4 = 'Please add an explanation below in the "Supporting '.$LNG->EVIDENCE_NAME.'" and "Description" fields.';

// Solution
$LNG->FORM_SOLUTION_TITLE_SECTION = 'Create/Select a '.$LNG->SOLUTION_NAME;
$LNG->FORM_SOLUTION_TITLE_CONNECT = $LNG->FORM_SOLUTION_TITLE_SECTION.' and connect it to ';
$LNG->FORM_SOLUTION_TITLE_ADD = 'Add a New '.$LNG->SOLUTION_NAME;
$LNG->FORM_SOLUTION_TITLE_EDIT = 'Edit this '.$LNG->SOLUTION_NAME;
$LNG->FORM_SOLUTION_LABEL_SUMMARY = $LNG->SOLUTION_NAME_SHORT.' Summary:';
$LNG->FORM_SOLUTION_ENTER_SUMMARY_ERROR = 'Please enter a '.$LNG->SOLUTION_NAME.' before trying to publish';
$LNG->FORM_SOLUTION_CREATE_ERROR_MESSAGE = 'There was an problem creating the '.$LNG->SOLUTION_NAME;
$LNG->FORM_SOLUTION_NOT_FOUND = 'The required '.$LNG->SOLUTION_NAME.' could not be found';
$LNG->FORM_SOLUTION_SELECT_EXISTING = 'Select Existing '.$LNG->SOLUTION_NAME_SHORT;
$LNG->FORM_SOLUTION_REMOTE_MESSAGE_LINE1 = 'If you wish to add a '.$LNG->RESOURCE_NAME.' to this '.$LNG->SOLUTION_NAME.' is must be using an '.$LNG->EVIDENCE_NAME.' item.';
$LNG->FORM_SOLUTION_REMOTE_MESSAGE_LINE2 = 'To add an '.$LNG->EVIDENCE_NAME.' try to answer the following question';
$LNG->FORM_SOLUTION_REMOTE_MESSAGE_LINE3 = 'Why does this '.$LNG->RESOURCE_NAME.' supports this '.$LNG->SOLUTION_NAME.'? What is the '.$LNG->EVIDENCE_NAME.' in this '.$LNG->RESOURCE_NAME.' that made you want to add this '.$LNG->SOLUTION_NAME.'?';
$LNG->FORM_SOLUTION_REMOTE_MESSAGE_LINE4 = 'Please add an explanation below in the "Supporting '.$LNG->EVIDENCE_NAME.'" and "Description" fields.';

//ORG - PROJECT
$LNG->FORM_TITLE_PROJECT_SECTION = 'Create/Select a '.$LNG->PROJECT_NAME;
$LNG->FORM_TITLE_PROJECT_CONNECT = $LNG->FORM_TITLE_PROJECT_SECTION.' and connect it to ';
$LNG->FORM_TITLE_ORG_SECTION = 'Create/Select an '.$LNG->ORG_NAME;
$LNG->FORM_TITLE_ORG_CONNECT = $LNG->FORM_TITLE_ORG_SECTION.' and connect it to ';
$LNG->FORM_TITLE_ORGPROJECT_SECTION = 'Create/Select an '.$LNG->ORG_NAME." or ".$LNG->PROJECT_NAME;
$LNG->FORM_TITLE_ORGPROJECT_CONNECT = $LNG->FORM_TITLE_ORGPROJECT_SECTION.' and connect it to ';
$LNG->FORM_ORG_TITLE_EDIT = 'Edit this';
$LNG->FORM_ORG_TITLE_ADD = 'Tell us about your '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME;
$LNG->FORM_ORG_ENTER_SUMMARY_ERROR = "Please enter a name";
$LNG->FORM_ORG_CREATE_ERROR_MESSAGE = 'The '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.'could not be added/retrieved.';
$LNG->FORM_ORG_PUBLISH_MESSAGE = "When you click on <b>".$LNG->FORM_BUTTON_PUBLISH."</b> below a new ".$LNG->ORG_NAME."/".$LNG->PROJECT_NAME." will be created and you will be taken to its explore page.<br>There you will be able to add more details like any partners it has, ";

if ($CFG->HAS_CHALLENGE) {
	$LNG->FORM_ORG_PUBLISH_MESSAGE .= $LNG->CHALLENGES_NAME.' or ';
}
$LNG->FORM_ORG_PUBLISH_MESSAGE .= $LNG->ISSUES_NAME.' it addresses, ';
if ($CFG->HAS_CLAIM) {
	$LNG->FORM_ORG_PUBLISH_MESSAGE .= $LNG->CLAIMS_NAME;
}
if ($CFG->HAS_CLAIM && $CFG->HAS_SOLUTION) {
	$LNG->FORM_ORG_PUBLISH_MESSAGE .= ' or ';
}
if ($CFG->HAS_SOLUTION) {
	$LNG->FORM_ORG_PUBLISH_MESSAGE .= $LNG->SOLUTIONS_NAME;
}
$LNG->FORM_ORG_PUBLISH_MESSAGE .= ' it proposes, or '.$LNG->EVIDENCES_NAME.' it specifies.';
$LNG->FORM_ORG_SELECT_EXISTING = 'Select Existing One';
$LNG->FORM_ORG_NOT_FOUND_ERROR_MESSAGE = "The required ".$LNG->ORG_NAME."/".$LNG->PROJECT_NAME." could not be found";

// Resource
$LNG->FORM_RESOURCE_URL_REQUIRED = 'You must enter a url for each '.$LNG->RESOURCE_NAME;
$LNG->FORM_RESOURCE_URL_FORMAT_ERROR = 'A url doesn\'t appear to be correctly formatted.';
$LNG->FORM_RESOURCE_TITLE_EDIT = 'Edit the '.$LNG->RESOURCE_NAME;
$LNG->FORM_RESOURCE_TITLE_SECTION = 'Create/Select a '.$LNG->RESOURCE_NAME;
$LNG->FORM_RESOURCE_TITLE_CONNECT = $LNG->FORM_RESOURCE_TITLE_SECTION.' and connect it to ';
$LNG->FORM_RESOURCE_ENTER_URL_ERROR = 'Please enter a Url before trying to publish';
$LNG->FORM_RESOURCE_ENTER_TITLE_ERROR = 'Please enter a title for the Url before trying to publish';
$LNG->FORM_RESOURCE_CREATE_ERROR_MESSAGE = 'There was an problem creating the '.$LNG->RESOURCE_NAME.':';
$LNG->FORM_RESOURCE_TITLE_ADD = 'Add a New '.$LNG->RESOURCE_NAME;
$LNG->FORM_RESOURCE_NOT_FOUND = 'The required '.$LNG->RESOURCE_NAME.' could not be found';
$LNG->FORM_RESOURCE_PERMISSION_ERROR_MESSAGE = 'You do not have permissions to edit this '.$LNG->RESOURCE_NAME;
$LNG->FORM_RESOURCE_CLIPS_SELECT_TO_REMOVE = '(Select to remove)';
$LNG->FORM_RESOURCE_SELECT_EXISTING = 'Select Existing '.$LNG->RESOURCE_NAME;

// Evidence
$LNG->FORM_EVIDENCE_LABEL_SUMMARY = $LNG->EVIDENCE_NAME." Summary:";
$LNG->FORM_EVIDENCE_TITLE_SECTION = 'Create/Select a piece of ';
$LNG->FORM_EVIDENCE_TITLE_SECTION_SUPPORTING = 'Supporting';
$LNG->FORM_EVIDENCE_TITLE_SECTION_COUNTER = 'Counter';
$LNG->FORM_EVIDENCE_TITLE_CONNECT = ' and connect it to ';
$LNG->FORM_EVIDENCE_TITLE_ADD = 'Add '.$LNG->EVIDENCE_NAME;
$LNG->FORM_EVIDENCE_TITLE_EDIT = 'Edit '.$LNG->EVIDENCE_NAME;
$LNG->FORM_EVIDENCE_ENTER_SUMMARY_ERROR = 'Please enter a summary of the '.$LNG->EVIDENCE_NAME.' before trying to publish';
$LNG->FORM_EVIDENCE_SELECT_EXISTING = 'Select Existing '.$LNG->EVIDENCE_NAME;
$LNG->FORM_EVIDENCE_ALREADY_EXISTS = 'You already have a item with that summary and type. Please change one or the other.';
$LNG->FORM_EVIDENCE_NOT_FOUND = 'The required '.$LNG->EVIDENCE_NAME.' item could not be found';
$LNG->FORM_SUPPORTING_EVIDENCE_LABEL = 'Supporting '.$LNG->EVIDENCE_NAME;
*/

/** FORM ROLLOVER HINTS **/
/*
//Challenge
$LNG->CHALLENGE_SUMMARY_FORM_HINT = '(compulsory) - Enter a new '.$LNG->CHALLENGE_NAME.' summary. This will form the '.$LNG->CHALLENGE_NAME.' title displayed in lists.';
$LNG->CHALLENGE_THEME_FORM_HINT = '(compulsory) - Select at least one '.$LNG->THEME_NAME.' associated to this '.$LNG->CHALLENGE_NAME.'. These are used to help cluster '.$LNG->CHALLENGES_NAME.' around '.$LNG->THEMES_NAME.' and also provide recommendations based on '.$LNG->THEME_NAME.' matching. You can enter more than one.';
$LNG->CHALLENGE_DESC_FORM_HINT ='(optional) - Enter a longer description of the '.$LNG->CHALLENGE_NAME;
$LNG->CHALLENGE_TAG_FORM_HINT ='(optional) - Tags associated to this '.$LNG->CHALLENGE_NAME.'. You can enter more than one in a comma separated list.';
$LNG->CHALLENGE_TAGADDED_FORM_HINT ='This is a list of tags you have added to this '.$LNG->CHALLENGE_NAME.'. Tick the tags in the list if you wish to delete them.';
$LNG->CHALLENGE_REASON_FORM_HINT = 'Describe why you think this '.$LNG->CHALLENGE_NAME.' is relevant to: ';
$LNG->CHALLENGES_FORM_HINT = 'Select the '.$LNG->CHALLENGES_NAME.' that you wish to relate to: ';

// Issues
$LNG->ISSUE_SUMMARY_FORM_HINT = '(compulsory) - Enter a new '.$LNG->ISSUE_NAME.' summary. This will form the '.$LNG->ISSUE_NAME.' title displayed in lists.';
$LNG->ISSUE_DESC_FORM_HINT = '(optional) - Enter a longer description of the '.$LNG->ISSUE_NAME;
$LNG->ISSUE_CHALLENGES_FORM_HINT = '(optional) - Select one or more '.$LNG->CHALLENGES_NAME.' that this '.$LNG->ISSUE_NAME.' relates to.';
$LNG->ISSUE_THEME_FORM_HINT = '(compulsory) - Select at least one '.$LNG->THEME_NAME.' associated to this '.$LNG->ISSUE_NAME.'. These are used to help cluster '.$LNG->ISSUES_NAME.' around '.$LNG->THEMES_NAME.' and also provide recommendations based on '.$LNG->THEME_NAME.' matching. You can enter more than one.';
$LNG->ISSUE_TAG_FORM_HINT = '(optional) - Tags associated to this '.$LNG->ISSUE_NAME.'. You can enter more than one in a comma separated list';
$LNG->ISSUE_TAGADDED_FORM_HINT = 'This is a list of tags you have added to this '.$LNG->ISSUE_NAME.'. Tick the tags in the list if you wish to delete them.';
$LNG->ISSUE_REASON_FORM_HINT = '(optional) - Describe why you think this '.$LNG->ISSUE_NAME.' is relevant to: ';
$LNG->ISSUE_OTHERCHALLENGE_FORM_HINT = '(optional) - Select any other '.$LNG->CHALLENGES_NAME.' that you want to relate to this '.$LNG->ISSUE_NAME;
$LNG->ISSUE_RESOURCE_FORM_HINT = '(optional) - Add any Publications, website, or images etc.. that form part of or support this '.$LNG->ISSUE_NAME.'. You can enter more than one.';

// Solutions
$LNG->SOLUTION_SUMMARY_FORM_HINT = '(compulsory) - Enter a new '.$LNG->SOLUTION_NAME.' summary. This will form the item title.';
$LNG->THEME_SUMMARY_FORM_HINT = '(compulsory) - Select at least one '.$LNG->THEME_NAME.' associated to this '.$LNG->SOLUTION_NAME.'n. These are used to help cluster '.$LNG->SOLUTIONS_NAME.' around '.$LNG->THEMES_NAME.' and also provide recommendations based on '.$LNG->THEME_NAME.' matching. You can enter more than one.';
$LNG->SOLUTION_PRO_FORM_HINT = 'Enter a piece of supporting evidence for the above '.$LNG->SOLUTION_NAME.'. Add a summary of the evidence, and then if desired a fuller description and/or a url for a website that contributes to/is the evidence.';
$LNG->SOLUTION_CON_FORM_HINT = 'Enter a piece of opposing evidence for the above '.$LNG->SOLUTION_NAME.'.  Add a summary of the evidence, and then if desired a fuller description and/or a url for a website that contributes to/is the evidence.';
$LNG->SOLUTION_DESC_FORM_HINT = '(optional) - Enter a longer description of the '.$LNG->SOLUTION_NAME;
$LNG->SOLUTION_TAG_FORM_HINT = '(optional) - Tags associated to this '.$LNG->SOLUTION_NAME.'. You can enter more than one in a comma separated list.';
$LNG->SOLUTION_TAGADDED_FORM_HINT = 'This is a list of tags you have added to this '.$LNG->SOLUTION_NAME.'. Tick the tags in the list if you wish to delete them.';
$LNG->SOLUTION_REASON_FORM_HINT = '(optional) - Describe why you think this '.$LNG->SOLUTION_NAME.' is relevant to: ';
// Claims
$LNG->CLAIM_SUMMARY_FORM_HINT = '(compulsory) - Enter a new '.$LNG->CLAIM_NAME.' summary. This will be the '.$LNG->CLAIM_NAME.' title displayed in lists.';
$LNG->CLAIM_THEME_FORM_HINT = '(compulsory) - Select at least one '.$LNG->THEME_NAME.' associated to this '.$LNG->CLAIM_NAME.'. These are used to help cluster '.$LNG->CLAIMS_NAME.' around '.$LNG->THEMES_NAME.' and also provide recommendations based on '.$LNG->THEME_NAME.' matching. You can enter more than one.';
$LNG->CLAIM_DESC_FORM_HINT = '(optional) - Enter a longer description of the '.$LNG->CLAIM_NAME;
$LNG->CLAIM_RESAON_FORM_HINT = '(optional) - Describe why you think this '.$LNG->CLAIM_NAME.'  is relevant to: ';
$LNG->CLAIM_TAG_FORM_HINT = '(optional) - Tags associated to this '.$LNG->CLAIM_NAME.'. You can enter more than one in a comma separated list.';
$LNG->CLAIM_TAGADDED_FORM_HINT = 'This is a list of tags you have added to this '.$LNG->CLAIM_NAME.'. Tick the tags in the list if you wish to delete them.';
// Evidence
$LNG->EVIDENCE_SUMMARY_FORM_HINT = '(compulsory) - Enter a summary of the '.$LNG->EVIDENCE_NAME.'. This will be the '.$LNG->EVIDENCE_NAME.' title displayed in lists.';
$LNG->EVIDENCE_DESC_FORM_HINT = '(optional) - Enter a longer description of the '.$LNG->EVIDENCE_NAME;
$LNG->EVIDENCE_WEBSITE_FORM_HINT = '(optional) - Add any Publications, website, or images etc.. that form part of or support this '.$LNG->EVIDENCE_NAME.'. You can enter more than one.';
$LNG->EVIDENCE_THEME_FORM_HINT = '(compulsory) - Select at least one '.$LNG->THEME_NAME.' associated with this evidence. These are used to help cluster '.$LNG->EVIDENCES_NAME.' around '.$LNG->THEMES_NAME.' and also provide recommendations based on '.$LNG->THEME_NAME.' matching. You can enter more than one.';
$LNG->EVIDENCE_TYPE_FORM_HINT = '(compulsory) - Select what sort of '.$LNG->EVIDENCE_NAME.' you wish to submit - the default is '.$CFG->EVIDENCE_TYPES_DEFAULT.', but if you can be more specific that would be helpful.';
$LNG->EVIDENCE_TAG_FORM_HINT = '(optional) - Tags associated to this '.$LNG->EVIDENCE_NAME.'. You can enter more than one in a comma separated list.';
$LNG->EVIDENCE_TAGADDED_FORM_HINT = 'This is a list of tags you have added to this '.$LNG->EVIDENCE_NAME.'. Tick the tags in the list if you wish to delete them.';
$LNG->EVIDENCE_REASON_FORM_HINT = '(optional) - Describe why you think this '.$LNG->EVIDENCE_NAME.' is relevant to: ';
// Resource
$LNG->RESOURCES_FORM_HINT = '(optional) - Enter any web resources supporting your '.$LNG->EVIDENCE_NAME;
$LNG->RESOURCES_REMOTE_FORM_HINT = '(optional) - Enter any web '.$LNG->RESOURCES_NAME.' supporting your '.$LNG->EVIDENCE_NAME.'. The url of the site you are currently on should have been automatically entered for you, as well as any selected text.';
$LNG->RESOURCES_ORG_FORM_HINT = '(optional) - Please add the website for this organization or project and any other supporting web resources you feel will be useful to people viewing this item. You can enter more than one.';
$LNG->RESOURCES_CLIP_FORM_HINT = 'This is the text you have selected on the website';
$LNG->RESOURCES_TYPE_FORM_HINT = '(compulsory) - Select what sort of '.$LNG->RESOURCE_NAME.' you wish to submit - the default is '.$CFG->RESOURCE_TYPES_DEFAULT.', which covers website and any urls which are not Publications.';
$LNG->RESOURCES_THEME_FORM_HINT = '(compulsory) - Select at least one '.$LNG->THEME_NAME.' associated with this '.$LNG->RESOURCE_NAME.'. These are used to help cluster '.$LNG->RESOURCES_NAME.' around '.$LNG->THEMES_NAME.' and also provide recommendations based on '.$LNG->THEME_NAME.' matching. You can enter more than one.';
$LNG->RESOURCES_TITLE_FORM_HINT = '(compulsory) - Enter a title for the '.$LNG->RESOURCE_NAME.'. If you do not complete the title, the url will be used, which may not be ideal. Bear in mind, that this title will be used in all listings of this '.$LNG->RESOURCE_NAME.'<br><br>You can use the arrow button at the end of the URL field to try and fetch the title from the website page automatically if you wish.';
$LNG->RESOURCES_URL_FORM_HINT = '(compulsory) - Enter the url of the '.$LNG->RESOURCE_NAME;
$LNG->RESOURCES_DOI_FORM_HINT = '(optional) - Enter the digital object identifier (DOI) for the Publication you are adding, if known.';
$LNG->RESOURCES_TAG_FORM_HINT = '(optional) - Tags associated to this '.$LNG->RESOURCE_NAME.'. You can enter more than one in a comma separated list.';
$LNG->RESOURCES_TAGADDED_FORM_HINT = 'This is a list of tags you have added to this '.$LNG->RESOURCE_NAME.'. Tick the tags in the list if you wish to delete them.';
$LNG->RESOURCES_REASON_FORM_HINT = '(optional) - Describe why you think this '.$LNG->RESOURCE_NAME.' is relevant to: ';
// organization / project
$LNG->ORG_TYPE_FORM_HINT = '(compulsory) - Select if you are entering information about an '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME;
$LNG->ORG_TOWN_FORM_HINT = '(optional) - Town or City where the '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.' is primarily based. For the '.$LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.' to appear on the Map you must enter at least the city/town and the country.';
$LNG->ORG_COUNTRY_FORM_HINT = '(optional) - Geographical country where the '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.' is primarily based.';
$LNG->ORG_THEME_FORM_HINT = '(compulsory) - Select at least one '.$LNG->THEME_NAME.' of interest to your '.$LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.'. These are used to help cluster '.$LNG->ORG_NAME.' and '.$LNG->PROJECT_NAME.' and also provide recommendations based on '.$LNG->THEME_NAME.' matching. You can enter more than one.';
$LNG->ORG_NAME_FORM_HINT = '(compulsory) - The '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.' name.';
$LNG->ORG_PARTNER_FORM_HINT = '(optional) - '.$LNG->ORGS_NAME.' or '.$LNG->PROJECTS_NAME.' with which your '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.' has a major partnership with in the community. You can enter more than one.';
$LNG->ORG_DESC_FORM_HINT = '(optional) - A longer description about the '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME;
$LNG->ORG_WEBSITE_FORM_HINT = '(optional) - Please add the website for this '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.' and any other supporting '.$LNG->RESOURCES_NAME.' you feel will be useful to people viewing this item. You can enter more than one.';
$LNG->ORG_DATE_FORM_HINT = "(optional) - Date formats allowed e.g.: \'14 May 2008\' or \'14-05-2008\'";
$LNG->ORG_CHALLENGES_FORM_HINT = '(optional) - Select any '.$LNG->CHALLENGES_NAME.' you feel you would like to associate with this '.$LNG->ORGS_NAME.' or '.$LNG->PROJECTS_NAME;
$LNG->ORG_PROJECT_FORM_HINT = '(optional) - Add any '.$LNG->PROJECTS_NAME.' which this '.$LNG->ORG_NAME.' direclty manages. You can enter more than one.';
$LNG->ORG_TAG_FORM_HINT = '(optional) - Tags associated to this '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.' You can enter more than one in a comma separated list.';
$LNG->ORG_TAGADDED_FORM_HINT = 'This is a list of tags you have added to this '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.' Tick the tags in the list if you wish to delete them.';
$LNG->ORG_REASON_FORM_HINT = '(optional) - Describe why you think this '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.' is relevant to: ';
*/

//Comment
/*
$LNG->COMMENT_TAG_FORM_HINT = '(optional) - Tags associated to this '.$LNG->COMMENT_NAME.' You can enter more than one in a comma separated list.';
$LNG->COMMENT_TAGADDED_FORM_HINT ='This is a list of tags you have added to this '.$LNG->COMMENT_NAME.'. Tick the tags in the list if you wish to delete them.';
$LNG->COMMENT_DESC_FORM_HINT = '(compulsory) - Enter your '.$LNG->COMMENT_NAME.' text here. This can be as long as you like but cannot be empty. If using the Formatter, some text is still required, i.e. it can not just be a picture or a movie. The Comment title is created using up to the first 100 characters entered here.';
*/

//Remote Forms
/*
$LNG->REMOTE_EVIDENCE_SOLUTION_FORM_HINT = 'Enter your supporting '.$LNG->EVIDENCE_NAME.' for the '.$LNG->SOLUTION_NAME.'.  Add a summary of the '.$LNG->EVIDENCE_NAME.', and then if desired a fuller description.';
$LNG->REMOTE_EVIDENCE_CLAIM_FORM_HINT = 'Enter your supporting '.$LNG->EVIDENCE_NAME.' for the '.$LNG->CLAIM_NAME.'.  Add a summary of the '.$LNG->EVIDENCE_NAME.', and then if desired a fuller description.';
$LNG->REMOTE_EVIDENCE_DESC_FORM_HINT = 'Enter a longer description of the '.$LNG->EVIDENCE_NAME.' (optional)';
$LNG->REMOTE_EVIDENCE_TYPE_FORM_HINT = 'Select what sort of '.$LNG->EVIDENCE_NAME.' you wish to submit - the default is '.$CFG->EVIDENCE_TYPES_DEFAULT.', but if you can be more specific that would be helpful.';
*/

/** QUICK FORM HINTS **/
/*
// Issue
$LNG->ISSUE_SUMMARY_QUICKFORM_HINT	= 'Enter a new '.$LNG->ISSUE_NAME.' summary. This will form the item title.';
// Theme
$LNG->THEME_P_QUICKFORM_HINT = 'Select one or more '.$LNG->THEMES_NAME.' to associate to the '.$LNG->ISSUE_NAME.', '.$LNG->SOLUTION_NAME.', '.$LNG->EVIDENCE_NAME.' and any '.$LNG->RESOURCES_NAME.' you are adding. These are used to help cluster data and also provide recommendations based on '.$LNG->THEME_NAME.' matching. You can enter more than one.';
$LNG->THEME_R_QUICKFORM_HINT = 'Select one or more '.$LNG->THEMES_NAME.' to associate to the '.$LNG->ISSUE_NAME.', '.$LNG->CLAIM_NAME.', '.$LNG->EVIDENCE_NAME.' and any '.$LNG->RESOURCES_NAME.' you are adding. These are used to help cluster data and also provide recommendations based on '.$LNG->THEME_NAME.' matching. You can enter more than one.';
// Tag
$LNG->TAG_P_QUICKFORM_HINT = 'Type in one or more tags to be associated with the '.$LNG->ISSUE_NAME.', '.$LNG->SOLUTION_NAME.', '.$LNG->EVIDENCE_NAME.' and any '.$LNG->RESOURCES_NAME.' you are adding - comma separated (optional)';
$LNG->TAG_R_QUICKFORM_HINT = 'Type in one or more tags to be associated with the '.$LNG->ISSUE_NAME.', '.$LNG->CLAIM_NAME.', '.$LNG->EVIDENCE_NAME.' and any '.$LNG->RESOURCES_NAME.' you are adding - comma separated (optional)';
// Solution
$LNG->SOLUTION_SUMMARY_QUICKFORM_HINT = 'Enter a new '.$LNG->SOLUTION_NAME.' summary. This will form the item title.';
// Evidence
$LNG->EVIDENCE_P_QUICKFORM_HINT = 'Enter your '.$LNG->EVIDENCE_NAME.' for the '.$LNG->SOLUTION_NAME.'.  Add a summary of the '.$LNG->EVIDENCE_NAME.', and then if desired a fuller description.';
$LNG->EVIDENCE_R_QUICKFORM_HINT = 'Enter your '.$LNG->EVIDENCE_NAME.' for the '.$LNG->CLAIM_NAME.'.  Add a summary of the '.$LNG->EVIDENCE_NAME.', and then if desired a fuller description.';
$LNG->EVIDENCE_TYPE_QUICKFORM_HINT = 'Select what sort of '.$LNG->EVIDENCE_NAME.' you wish to submit - the default is '.$CFG->EVIDENCE_TYPES_DEFAULT.', but if you can be more specific that would be helpful.';
// Claim
$LNG->CLAIM_SUMMARY_QUICKFORM_HINT = 'Enter a new '.$LNG->CLAIM_NAME.' summary. This will form the item title.';
// Org
$LNG->ORG_P_QUICKFORM_HINT = 'Select an '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.' to associated with the '.$LNG->ISSUE_NAME.', '.$LNG->SOLUTION_NAME.' and '.$LNG->EVIDENCE_NAME.' you are entering. If it is not listed, please add it. (optional)';
$LNG->ORG_R_QUICKFORM_HINT = 'Select an '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.' to associated with the '.$LNG->ISSUE_NAME.', '.$LNG->CLAIM_NAME.' and '.$LNG->EVIDENCE_NAME.' you are entering. If it is not listed, please add it. (optional)';
*/

/** QUICK FORM NAV **/
/*
$LNG->ISSUE_QUICKFORM_NAV_HINT = 'Click to view the '.$LNG->ISSUE_NAME.' section of the form';
$LNG->SOLUTION_QUICKFORM_NAV_HINT = 'Click to view the '.$LNG->SOLUTION_NAME.' section of the form';
$LNG->CLAIM_QUICKFORM_NAV_HINT = 'Click to view the '.$LNG->CLAIM_NAME.' section of the form';
$LNG->EVIDENCE_QUICKFORM_NAV_HINT = 'Click to view the '.$LNG->EVIDENCE_NAME.' section of the form';
$LNG->RESOURCE_QUICKFORM_NAV_HINT = 'Click to view the '.$LNG->RESOURCES_NAME.' section of the form';
$LNG->THEME_QUICKFORM_NAV_HINT = 'Click to view the '.$LNG->THEMES_NAME.' and Tags section of the form';
*/

/** HOME PAGE NAV HINT **/
/*
$LNG->CHALLENGE_HOME_NAV_HINT = '<p><b>'.$LNG->CHALLENGES_NAME.'</b> connect to <b>'.$LNG->ISSUES_NAME.'</b>. This connection explains the '.$LNG->CHALLENGE_NAME.' has one or more sub problems it can be mapped into (the '.$LNG->ISSUES_NAME.').</p>';

if ($CFG->HAS_CHALLENGE) {
	$LNG->ISSUE_HOME_NAV_HINT = '<p><b>'.$LNG->ISSUES_NAME.'</b> can be connected to: '.$LNG->CHALLENGES_NAME.' (left hand connection) and to ';
} else {
	$LNG->ISSUE_HOME_NAV_HINT = '<p><b>'.$LNG->ISSUES_NAME.'</b> can be connected to ';
}

if ($CFG->HAS_SOLUTION) {
	$LNG->ISSUE_HOME_NAV_HINT .= $LNG->SOLUTIONS_NAME;
}
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$LNG->ISSUE_HOME_NAV_HINT .= ' and ';
}
if ($CFG->HAS_CLAIM) {
	$LNG->ISSUE_HOME_NAV_HINT .= $LNG->CLAIMS_NAME;
}
$LNG->ISSUE_HOME_NAV_HINT .= ' (right hand connection).</p>';

if ($CFG->HAS_CHALLENGE) {
	$LNG->ISSUE_HOME_NAV_HINT .= '<p>The <b>left hand connection</b> explains what higher-level problem the '.$LNG->ISSUE_NAME.' is related to.</p>';
}

if ($CFG->HAS_SOLUTION) {
	$LNG->ISSUE_HOME_NAV_HINT .= '<p>The <b>right connection to a '.$LNG->SOLUTION_NAME.'</b> explains what practical solution has been proposed to address the '.$LNG->ISSUE_NAME.'.</p>';
}
if ($CFG->HAS_CLAIM) {
	$LNG->ISSUE_HOME_NAV_HINT .= '<p>The <b>right connection to a '.$LNG->CLAIM_NAME.'</b> explains what knowledge statements can be made to address the '.$LNG->ISSUE_NAME.'.</p>';
}

$LNG->EVIDENCE_HOME_NAV_HINT = '<p>'.$LNG->EVIDENCES_NAME.' can be connected to ';
if ($CFG->HAS_SOLUTION) {
	$LNG->EVIDENCE_HOME_NAV_HINT .= $LNG->SOLUTIONS_NAME;
}
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$LNG->EVIDENCE_HOME_NAV_HINT .= '/';
}
if ($CFG->HAS_CLAIM) {
	$LNG->EVIDENCE_HOME_NAV_HINT .= $LNG->CLAIMS_NAME;
}
$LNG->EVIDENCE_HOME_NAV_HINT .= ' (left hand connection) and to '.$LNG->RESOURCES_NAME.' (right hand connection).</p>';
$LNG->EVIDENCE_HOME_NAV_HINT .= '<p>The <b>left hand connection</b> explains what ';
if ($CFG->HAS_SOLUTION) {
	$LNG->EVIDENCE_HOME_NAV_HINT .= $LNG->SOLUTION_NAME;
}
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$LNG->EVIDENCE_HOME_NAV_HINT .= '/';
}
if ($CFG->HAS_CLAIM) {
	$LNG->EVIDENCE_HOME_NAV_HINT .= $LNG->CLAIM_NAME;
}
$LNG->EVIDENCE_HOME_NAV_HINT .= ' the '.$LNG->EVIDENCE_NAME.' is either supporting or challenging.</p>';
$LNG->EVIDENCE_HOME_NAV_HINT .= '<p>The <b>right hand connection</b> explains what '.$LNG->RESOURCES_NAME.' (either Web Resources or Research Publications) can be pointed out to endorse the '.$LNG->EVIDENCE_NAME.'.</p>';
$LNG->RESOURCE_HOME_NAV_HINT = '<p>'.$LNG->RESOURCE_NAME.' can be connected to '.$LNG->EVIDENCE_NAME.'. This connection explains what '.$LNG->EVIDENCE_NAME.' can be distilled from or endorsed by this '.$LNG->RESOURCE_NAME.'.</p>';
$LNG->CLAIM_HOME_NAV_HINT = '<p><b>'.$LNG->CLAIMS_NAME.'</b> can be connected to '.$LNG->ISSUES_NAME.' (left hand connection) and to '.$LNG->EVIDENCE_NAME.' (right hand connection).</p>';
$LNG->CLAIM_HOME_NAV_HINT .= '<p>The <b>left hand connection</b> explains what '.$LNG->ISSUE_NAME.' a '.$LNG->CLAIM_NAME.' addresses.</p>';
$LNG->CLAIM_HOME_NAV_HINT .= '<p>The <b>right hand connection</b> explains what '.$LNG->EVIDENCE_NAME.' is there that a '.$LNG->CLAIM_NAME.' is sound.</p>';
$LNG->SOLUTION_HOME_NAV_HINT = '<p><b>'.$LNG->SOLUTIONS_NAME.'</b> can be connected to '.$LNG->ISSUES_NAME.' (left hand connection) and to '.$LNG->EVIDENCE_NAME.' (right hand connection).</p>';
$LNG->SOLUTION_HOME_NAV_HINT .= '<p>The <b>left hand connection</b> explains what '.$LNG->ISSUE_NAME.' a '.$LNG->SOLUTION_NAME.' addresses.</p>';
$LNG->SOLUTION_HOME_NAV_HINT .= '<p>The <b>right hand connection</b> explains what '.$LNG->EVIDENCE_NAME.' is there that a '.$LNG->SOLUTION_NAME.' is working.</p>';
$LNG->ORG_HOME_NAV_HINT = '<p>'.$LNG->ORGS_NAME.' can be connected to any of the Knowledge categories on the left. '.$LNG->ORGS_NAME.' can manage one or more '.$LNG->PROJECTS_NAME.' and be partnered with other '.$LNG->ORGS_NAME.' and '.$LNG->PROJECTS_NAME.'</p>';
$LNG->PROJECT_HOME_NAV_HINT = '<p>'.$LNG->PROJECTS_NAME.' can be connected to any of the Knowledge categories on the left. '.$LNG->PROJECTS_NAME.' can be managed by one or more '.$LNG->ORGS_NAME.' and partnered with other '.$LNG->PROJECTS_NAME.' and '.$LNG->ORGS_NAME.'</p>';
*/

/** HOME BUTTONS FURTHER INFO TEXT **/
/*
// Issue button
$LNG->ISSUE_HOME_BUTTON_EXTRA = '<p>'.$LNG->ISSUES_NAME.' describe key problems the community has directly added to the Evidence Hub and brought into debate.</p>';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<p>An '.$LNG->ISSUE_NAME.' should be ideally phrased as question and should be ideally connected to one or more of the '.$LNG->CHALLENGES_NAME.' the community is trying to address.';
//$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<br><span id="issuehomemorebutton" class="active" style="font-weight:normal;text-decoration:underline" onclick="if ($(\'issuehomemorediv\').style.display == \'none\') { $(\'issuehomemorediv\').style.display = \'block\'; $(\'issuehomemorebutton\').innerHTML = \'read less\'; } else { $(\'issuehomemorediv\').style.display = \'none\';  $(\'issuehomemorebutton\').innerHTML = \'keep reading\';}">keep reading</span></p>';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<div id="issuehomemorediv" style="float:left;clear:both;width:100%;display:block;margin:0px;padding:0px">';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= 'Each member of the community can either add a new '.$LNG->ISSUE_NAME.' to the Evidence Hub or collaboratively improve an existing '.$LNG->ISSUE_NAME.' by adding:</p>';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<ul>';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<li>Web resources associated to it;</li>';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->ORGS_NAME.' or '.$LNG->PROJECTS_NAME.' addressing the '.$LNG->ISSUE_NAME.';</li>';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->THEMES_NAME.' associated to it; </li>';
if ($CFG->HAS_SOLUTION) {
	$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->SOLUTIONS_NAME.' to the '.$LNG->ISSUE_NAME.' and</li>';
}
if ($CFG->HAS_CLAIM) {
	$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->CLAIMS_NAME.' addressing it.</li>';
}
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<li>General '.$LNG->COMMENTS_NAME.' about the '.$LNG->ISSUE_NAME.'.</li>';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '</ul>';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<p>The list of key '.$LNG->ISSUES_NAME.' added by the community so far can be explored by clicking on the <a href="'.$CFG->homeAddress.'#issue-list" title="Click to go to '.$LNG->ISSUES_NAME.' List">'.$LNG->ISSUE_NAME.'</a> tab.</p>';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '<p>Within the '.$LNG->ISSUES_NAME.' list, '.$LNG->ISSUES_NAME.' can also be promoted or demoted, so that the community can express how important they consider each '.$LNG->ISSUE_NAME.' to be compared to the other '.$LNG->ISSUES_NAME.' the community has raised. Up-green/down-red arrows can be used to promote/demote '.$LNG->ISSUES_NAME.' in the list.</p>';
$LNG->ISSUE_HOME_BUTTON_EXTRA .= '</div>';

// Solution Button
$LNG->SOLCLAIM_TEXT = "";
if ($CFG->HAS_SOLUTION) {
	$LNG->SOLCLAIM_TEXT .= $LNG->SOLUTION_NAME;
}
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$LNG->SOLCLAIM_TEXT .= ' or ';
}
if ($CFG->HAS_CLAIM) {
	$LNG->SOLCLAIM_TEXT .= $LNG->CLAIM_NAME;
}
$LNG->SOLCLAIMS_TEXT = "";
if ($CFG->HAS_SOLUTION) {
	$LNG->SOLCLAIMS_TEXT .= $LNG->SOLUTIONS_NAME;
}
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$LNG->SOLCLAIMS_TEXT .= ' and ';
}
if ($CFG->HAS_CLAIM) {
	$LNG->SOLCLAIMS_TEXT .= $LNG->CLAIMS_NAME;
}

$LNG->SOLUTION_HOME_BUTTON_EXTRA = '<p>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= $LNG->SOLCLAIMS_TEXT.' are used to answer specific '.$LNG->ISSUES_NAME.' and they can be supported or challenged by specific '.$LNG->EVIDENCE_NAME.'.</p>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<p>';
if ($CFG->HAS_SOLUTION) {
	$LNG->SOLUTION_HOME_BUTTON_EXTRA .= 'A '.$LNG->SOLUTION_NAME.' describes a solution that practitioners within the community have tried out and can report on.<br>';
}
if ($CFG->HAS_CLAIM) {
	$LNG->SOLUTION_HOME_BUTTON_EXTRA .= 'A '.$LNG->CLAIM_NAME.' describes specific knowledge statements that people within the community have made or can report on.</p>';
}
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<p>'.$LNG->SOLCLAIMS_TEXT.' should be ideally connected to one or more existing '.$LNG->ISSUES_NAME.' that have been added to the Evidence Hub.';
//$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<br><span id="solutionhomemorebutton" class="active" style="font-weight:normal;text-decoration:underline" onclick="if ($(\'solutionhomemorediv\').style.display == \'none\') { $(\'solutionhomemorediv\').style.display = \'block\'; $(\'solutionhomemorebutton\').innerHTML = \'read less\'; } else { $(\'solutionhomemorediv\').style.display = \'none\';  $(\'solutionhomemorebutton\').innerHTML = \'keep reading\';}">keep reading</span></p>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<div id="solutionhomemorediv" style="float:left;clear:both;width:100%;display:block;margin:0px;padding:0px">';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= 'Each member of the community can add a new '.$LNG->SOLCLAIM_TEXT.' to the Evidence Hub or collaboratively improve an existing '.$LNG->SOLCLAIM_TEXT.' by adding:</p>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<ul>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<li>Supporting '.$LNG->EVIDENCE_NAME.' for the '.$LNG->SOLCLAIM_TEXT.', or</li>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<li>Counter '.$LNG->EVIDENCE_NAME.' for it.</li>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<li>'.$LNG->ORGS_NAME.' or '.$LNG->PROJECTS_NAME.' working on the '.$LNG->SOLCLAIM_TEXT.';</li>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<li>'.$LNG->THEMES_NAME.' associated to it;</li>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<li>General '.$LNG->COMMENTS_NAME.' about the '.$LNG->SOLCLAIM_TEXT.'.</li>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '</ul>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<p>'.$LNG->SOLCLAIMS_TEXT.' have a key role within the Evidence Hub since they frame the topics of the community debate.<br>The main objective of the Evidence Hub is to promote a community debate around '.$LNG->SOLCLAIMS_TEXT.'. To contribute to this debate each member of the community can add '.$LNG->EVIDENCE_NAME.' in favour (Supporting '.$LNG->EVIDENCE_NAME.') or '.$LNG->EVIDENCE_NAME.' against (Counter '.$LNG->EVIDENCE_NAME.') to each '.$LNG->SOLCLAIM_TEXT.' that has been added to the Evidence Hub.</p>';
if ($CFG->HAS_SOLUTION) {
	$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<p>The list of '.$LNG->SOLUTIONS_NAME.' added by the community so far can be explored by clicking on the <a href="'.$CFG->homeAddress.'#solution-list" title="Click to go to '.$LNG->SOLUTIONS_NAME.' List">'.$LNG->SOLUTIONS_NAME.'</a> tab. </p>';
}
if ($CFG->HAS_CLAIM) {
	$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<p>The list of '.$LNG->CLAIMS_NAME.' added by the community so far can be explored by clicking on the <a href="'.$CFG->homeAddress.'#claim-list" title="Click to go to '.$LNG->CLAIMS_NAME.' List">'.$LNG->CLAIMS_NAME.'</a> tab. </p>';
}
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '<p>Within the list of '.$LNG->SOLCLAIMS_TEXT.', these can also be promoted or demoted, so that the community can express how important they consider each '.$LNG->SOLCLAIM_TEXT.' to be compared to the other '.$LNG->SOLCLAIMS_TEXT.' the community has raised. Up-green/down-red arrows can be used to promote/demote '.$LNG->SOLCLAIMS_TEXT.' in the list.</p>';
$LNG->SOLUTION_HOME_BUTTON_EXTRA .= '</div>';

// Evidence Button
$LNG->EVIDENCE_HOME_BUTTON_EXTRA = '<p>'.$LNG->EVIDENCE_NAME.' represents the distillation of the community effort to map what works and what does not work within the community as suggested by practice or by research. As such '.$LNG->EVIDENCES_NAME.' are the heart to the Evidence Hub.</p>';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<p>'.$LNG->EVIDENCE_NAME.' can be one of the following: ';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= implode(",",$CFG->EVIDENCE_TYPES);
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= ', that the community has added to the Website. </p>';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<p>Ideally '.$LNG->EVIDENCE_NAME.' will either support or challenge at least one existing '.$LNG->SOLCLAIM_TEXT;
//$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<br><span id="evidencehomemorebutton" class="active" style="font-weight:normal;text-decoration:underline" onclick="if ($(\'evidencehomemorediv\').style.display == \'none\') { $(\'evidencehomemorediv\').style.display = \'block\'; $(\'evidencehomemorebutton\').innerHTML = \'read less\'; } else { $(\'evidencehomemorediv\').style.display = \'none\';  $(\'evidencehomemorebutton\').innerHTML = \'keep reading\';}">keep reading</span></p>';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<div id="evidencehomemorediv" style="float:left;clear:both;width:100%;display:block;margin:0px;padding:0px">';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= 'Each member of the community can either add some new '.$LNG->EVIDENCE_NAME.' to the Evidence Hub or collaboratively improve an existing '.$LNG->EVIDENCE_NAME.' by adding:</p>';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<ul>';
if ($CFG->HAS_SOLUTION) {
	$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->SOLUTIONS_NAME.' the '.$LNG->EVIDENCE_NAME.' is either supporting or challenging;</li>';
}
if ($CFG->HAS_CLAIM) {
	$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->CLAIMS_NAME.' the '.$LNG->EVIDENCE_NAME.' is either supporting or challenging;</li>';
}
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->ORGS_NAME.' or '.$LNG->PROJECTS_NAME.' which contributed to developing the '.$LNG->EVIDENCE_NAME.';</li>';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->THEMES_NAME.' associated to it;</li>';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<li>General '.$LNG->COMMENTS_NAME.' about the '.$LNG->EVIDENCE_NAME.';</li>';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '</ul>';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<p>The list of '.$LNG->EVIDENCE_NAME.' added by the community so far can be explored by clicking on the '.$LNG->EVIDENCE_NAME.' tab.</p>';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '<p>Within the '.$LNG->EVIDENCE_NAME.' List, '.$LNG->EVIDENCE_NAME.' can also be promoted or demoted, so that the community can express how important they consider each '.$LNG->EVIDENCE_NAME.' to be compared to the other '.$LNG->EVIDENCE_NAME.' the community has raised. Up-green/down-red arrows can be used to promote/demote '.$LNG->EVIDENCE_NAME.' in the list.</p>';
$LNG->EVIDENCE_HOME_BUTTON_EXTRA .= '</div>';

// Resource Button
$LNG->RESOURCE_HOME_BUTTON_EXTRA = '<p>'.$LNG->RESOURCES_NAME.' are the Publications (URL pointing at Research Papers) or Web Resources (URLs pointing at any other relevant Website) that have been added to the Evidence Hub.</p>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<p>'.$LNG->RESOURCES_NAME.' can be used in two main ways:</p>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<ul>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<li>to endorse the '.$LNG->EVIDENCE_NAME.' that have been added to the Website;</li>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<li>to describe an '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.'.</li>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '</ul>';
//$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<span id="resourcehomemorebutton" class="active" style="font-weight:normal;text-decoration:underline" onclick="if ($(\'resourcehomemorediv\').style.display == \'none\') { $(\'resourcehomemorediv\').style.display = \'block\'; $(\'resourcehomemorebutton\').innerHTML = \'read less\'; } else { $(\'resourcehomemorediv\').style.display = \'none\';  $(\'resourcehomemorebutton\').innerHTML = \'keep reading\';}">keep reading</span>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<div id="resourcehomemorediv" style="float:left;clear:both;width:100%;display:block;margin:0px;padding:0px">';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<br>Each member of the community can either add a new '.$LNG->RESOURCE_NAME.' to the Evidence Hub or collaboratively improve an existing '.$LNG->RESOURCE_NAME.' by adding:</p>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<ul>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->EVIDENCE_NAME.' distilled from and endorsed by this '.$LNG->RESOURCE_NAME.';</li>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->ORGS_NAME.' or '.$LNG->PROJECTS_NAME.' linked to the '.$LNG->RESOURCE_NAME.';</li>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<li>'.$LNG->THEMES_NAME.' associated to it; and </li>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<li>General '.$LNG->COMMENTS_NAME.' about the '.$LNG->RESOURCE_NAME.'.</li>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '</ul>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '<p>The list of '.$LNG->RESOURCES_NAME.' added by the community so far can be explored by clicking on the <a href="'.$CFG->homeAddress.'#web-list" title="Click to go to '.$LNG->RESOURCES_NAME.' List">'.$LNG->RESOURCES_NAME.'</a> tab.</p>';
$LNG->RESOURCE_HOME_BUTTON_EXTRA .= '</div>';

// Org Button
$LNG->ORG_HOME_BUTTON_EXTRA = '<p><b>'.$LNG->ORGS_NAME.'</b> and <b>'.$LNG->PROJECTS_NAME.'</b> can be added to the Evidence Hub to map the organizational ecosystem of the community.';
$LNG->ORG_HOME_BUTTON_EXTRA .= '<br>The list of '.$LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.' added by the community so far can be explored by clicking on the <a href="'.$CFG->homeAddress.'#org-list" title="Click to go to '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.' List">'.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.'</a> tab.';
$LNG->ORG_HOME_BUTTON_EXTRA .= '<br>'.$LNG->PROJECTS_NAME.' and '.$LNG->ORGS_NAME.' can also be explored by <a href="'.$CFG->homeAddress.'#org-list" title="Click to go to geo map">geo-location</a>.<br>';
//$LNG->ORG_HOME_BUTTON_EXTRA .= '<span id="orghomemorebutton" class="active" style="font-weight:normal;text-decoration:underline" onclick="if ($(\'orghomemorediv\').style.display == \'none\') { $(\'orghomemorediv\').style.display = \'block\'; $(\'orghomemorebutton\').innerHTML = \'read less\'; } else { $(\'orghomemorediv\').style.display = \'none\';  $(\'orghomemorebutton\').innerHTML = \'keep reading\';}">keep reading</span></p>';
$LNG->ORG_HOME_BUTTON_EXTRA .= '<div id="orghomemorediv" style="float:left;clear:both;width:100%;display:block;margin:0px;padding:0px">';
$LNG->ORG_HOME_BUTTON_EXTRA .= 'Each member of the community can either add a new '.$LNG->ORG_NAME.' or '.$LNG->PROJECT_NAME.' to the Evidence Hub, or they can collaboratively improve an existing '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.' by adding:<br>';
$LNG->ORG_HOME_BUTTON_EXTRA .= '<ul>';
$LNG->ORG_HOME_BUTTON_EXTRA .= '<li>Partner and managed '.$LNG->PROJECTS_NAME.' and '.$LNG->ORGS_NAME.';</li>';
$LNG->ORG_HOME_BUTTON_EXTRA .= '<li>'.$LNG->CHALLENGES_NAME.' and '.$LNG->ISSUES_NAME.' addressed by the '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.';</li>';
$LNG->ORG_HOME_BUTTON_EXTRA .= '<li>';
if ($CFG->HAS_CLAIM) {
	$LNG->ORG_HOME_BUTTON_EXTRA .= $LNG->CLAIMS_NAME;
}
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$LNG->ORG_HOME_BUTTON_EXTRA .= ", ";
}
if ($CFG->HAS_SOLUTION) {
	$LNG->ORG_HOME_BUTTON_EXTRA .= $LNG->SOLUTIONS_NAME;
}
$LNG->ORG_HOME_BUTTON_EXTRA .= ' used and '.$LNG->EVIDENCES_NAME.' specified by the '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.';</li>';
$LNG->ORG_HOME_BUTTON_EXTRA .= '<li>'.$LNG->RESOURCES_NAME.' associated to the '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.';</li>';
$LNG->ORG_HOME_BUTTON_EXTRA .= '<li>'.$LNG->THEMES_NAME.' associated to it; and</li>';
$LNG->ORG_HOME_BUTTON_EXTRA .= '<li>General '.$LNG->COMMENTS_NAME.' about the '.$LNG->ORG_NAME.'/'.$LNG->PROJECT_NAME.'.</li>';
$LNG->ORG_HOME_BUTTON_EXTRA .= '</ul>';
$LNG->ORG_HOME_BUTTON_EXTRA .= '</div>';

// Story Button
$LNG->STORY_HOME_BUTTON_EXTRA = '<p>Whether you are new to the site, or you want to add a lot of content in one go, or if you are a member of the community and you want to add knowledge on your recent work, then the best way to add content to the Evidence Hub is by adding a ';
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$LNG->STORY_HOME_BUTTON_EXTRA .= '"Practitioner Story" or a "Researcher Story".<br>';
} else {
	$LNG->STORY_HOME_BUTTON_EXTRA .= '"Story".<br>';
}
//$LNG->STORY_HOME_BUTTON_EXTRA .= '<span id="storyhomemorebutton" class="active" style="font-weight:normal;text-decoration:underline" onclick="if ($(\'storyhomemorediv\').style.display == \'none\') { $(\'storyhomemorediv\').style.display = \'block\'; $(\'storyhomemorebutton\').innerHTML = \'read less\'; } else { $(\'storyhomemorediv\').style.display = \'none\';  $(\'storyhomemorebutton\').innerHTML = \'keep reading\';}">keep reading</span></p>';
$LNG->STORY_HOME_BUTTON_EXTRA .= '<div id="storyhomemorediv" style="float:left;clear:both;width:100%;display:block;margin:0px;padding:0px">';
$LNG->STORY_HOME_BUTTON_EXTRA .= 'A ';
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$LNG->STORY_HOME_BUTTON_EXTRA .= 'Practitioner/Researcher';
}
$LNG->STORY_HOME_BUTTON_EXTRA .= ' Story is built by providing answers to the following questions:<br>';
$LNG->STORY_HOME_BUTTON_EXTRA .= '<ul>';
$LNG->STORY_HOME_BUTTON_EXTRA .= '<li>What '.$LNG->ISSUE_NAME.' are you investigating?</li>';
$LNG->STORY_HOME_BUTTON_EXTRA .= '<li>What '.$LNG->CHALLENGE_NAME.' this helps addressing?</li>';
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$LNG->STORY_HOME_BUTTON_EXTRA .= '<li>What solution has been or can be proposed?</li>';
	$LNG->STORY_HOME_BUTTON_EXTRA .= '<li>What '.$LNG->EVIDENCE_NAME.' is there to support this solution?</li>';
}
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM === FALSE) {
	$LNG->STORY_HOME_BUTTON_EXTRA .= '<li>What '.$LNG->SOLUTION_NAME.' has been or can be proposed?</li>';
	$LNG->STORY_HOME_BUTTON_EXTRA .= '<li>What '.$LNG->EVIDENCE_NAME.' is there to support this '.$LNG->SOLUTION_NAME.'?</li>';
}
if ($CFG->HAS_CLAIM && $CFG->HAS_SOLUTION === FALSE) {
	$LNG->STORY_HOME_BUTTON_EXTRA .= '<li>What '.$LNG->CLAIM_NAME.' has been or can be made?</li>';
	$LNG->STORY_HOME_BUTTON_EXTRA .= '<li>What '.$LNG->EVIDENCE_NAME.' is there to support this '.$LNG->CLAIM_NAME.'?</li>';
}
$LNG->STORY_HOME_BUTTON_EXTRA .= '<li>What '.$LNG->RESOURCES_NAME.' can you point out to ground this '.$LNG->EVIDENCE_NAME.'?</li>';
$LNG->STORY_HOME_BUTTON_EXTRA .= '</ul>';
$LNG->STORY_HOME_BUTTON_EXTRA .= '<p>Users can add a Story by clicking on Add a';


if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$LNG->STORY_HOME_BUTTON_EXTRA .= '<a id="pstoryaddhomelink" href="javascript:loadDialog(\'createpractitionerstory\',\''.$CFG->homeAddress.'ui/popups/quickformpractitioner.php\', 750,500);" title="Add your Practitioner Story"> Practitioner Story</a> or Add a <a id="rstoryaddhomelink" href="javascript:loadDialog(\'createreseacherstory\',\''.$CFG->homeAddress.'ui/popups/quickformresearcher.php\', 750,500);" title="Add your Reseacher Story"> Reseacher Story</a>.</p>';
}
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM === FALSE) {
	$LNG->STORY_HOME_BUTTON_EXTRA .= '<a id="pstoryaddhomelink" href="javascript:loadDialog(\'createpractitionerstory\',\''.$CFG->homeAddress.'ui/popups/quickformpractitioner.php\', 750,500);" title="Add your Story"> Story</a>.</p>';
}
if ($CFG->HAS_CLAIM && $CFG->HAS_SOLUTION === FALSE) {
	$LNG->STORY_HOME_BUTTON_EXTRA .= '<a id="rstoryaddhomelink" href="javascript:loadDialog(\'createreseacherstory\',\''.$CFG->homeAddress.'ui/popups/quickformresearcher.php\', 750,500);" title="Add your Story"> Story</a>.</p>';
}

$LNG->STORY_HOME_BUTTON_EXTRA .= '</div>';

// Challenge Button
$LNG->CHALLENGE_HOME_BUTTON_EXTRA = '<p>The community can use '.$LNG->CHALLENGES_NAME.' as common umbrella questions to cluster the issues they add to the Evidence Hub.</p>';
$LNG->CHALLENGE_HOME_BUTTON_EXTRA .= '<p>'.$LNG->CHALLENGES_NAME.' can also be used to cluster projects and organizations under common umbrella problems they tackle.</p>';
$LNG->CHALLENGE_HOME_BUTTON_EXTRA .= '<p>Finally the community can also contribute to the general description of a '.$LNG->CHALLENGE_NAME.' by adding Web resources to it.<br>';
//$LNG->CHALLENGE_HOME_BUTTON_EXTRA .= '<span id="challengehomemorebutton" class="active" style="font-weight:normal;text-decoration:underline" onclick="if ($(\'challengehomemorediv\').style.display == \'none\') { $(\'challengehomemorediv\').style.display = \'block\'; $(\'challengehomemorebutton\').innerHTML = \'read less\'; } else { $(\'challengehomemorediv\').style.display = \'none\';  $(\'challengehomemorebutton\').innerHTML = \'keep reading\';}">keep reading</span></p>';
$LNG->CHALLENGE_HOME_BUTTON_EXTRA .= '<div id="challengehomemorediv" style="float:left;clear:both;width:100%;display:block;margin:0px;padding:0px">';
$LNG->CHALLENGE_HOME_BUTTON_EXTRA .= ''.$LNG->CHALLENGES_NAME.' are identified by the core '.$CFG->SITE_TITLE.' team, through analysis of data in the Evidence Hub and in consultation with leading researchers and practitioners in the community. They can be explored under the '.$LNG->CHALLENGES_NAME.' tab. (hyperlink to the tab)';
$LNG->CHALLENGE_HOME_BUTTON_EXTRA .= '<p>'.$LNG->CHALLENGES_NAME.' form a good starting point for exploring the '.$LNG->EVIDENCE_NAME.' in the hub.</p>';
$LNG->CHALLENGE_HOME_BUTTON_EXTRA .= '<p>'.$LNG->CHALLENGES_NAME.' can be explored by clicking on the <a href="'.$CFG->homeAddress.'#challenge-list" title="Click to go to '.$LNG->CHALLENGES_NAME.' List">'.$LNG->CHALLENGES_NAME.'</a> tab.</p>';
$LNG->CHALLENGE_HOME_BUTTON_EXTRA .= '<p>Within the '.$LNG->CHALLENGES_NAME.' list, '.$LNG->CHALLENGES_NAME.' can also be promoted or demoted, so that the community can express how important they consider each '.$LNG->CHALLENGE_NAME.' to be compared to the other '.$LNG->CHALLENGES_NAME.' the community has raised. Up-green/down-red arrows can be used to promote/demote '.$LNG->CHALLENGES_NAME.' in the list.</p>';
$LNG->CHALLENGE_HOME_BUTTON_EXTRA .= '</div>';
*/

/** TAB INFO HINTS **/
/*
// Challenge Tab
$LNG->CHALLENGE_TAB_INFO_HINT = '<ul style="padding-left:20px;margin-left:0px">';
$LNG->CHALLENGE_TAB_INFO_HINT .= '<li>'.$LNG->CHALLENGES_NAME.' for your community have been identified.</li>';
$LNG->CHALLENGE_TAB_INFO_HINT .= '<li>These '.$LNG->CHALLENGES_NAME.' form a good starting point for exploring the evidence in the hub.</li>';
$LNG->CHALLENGE_TAB_INFO_HINT .= '<li>Help the community by linking these '.$LNG->CHALLENGES_NAME.' to '.$LNG->ISSUES_NAME.', and '.$LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.'.</li>';
$LNG->CHALLENGE_TAB_INFO_HINT .= '<li>Existing '.$LNG->CHALLENGES_NAME.' can be promoted or demoted, so that community can express how important they consider each '.$LNG->CHALLENGE_NAME.' to be.</li>';
$LNG->CHALLENGE_TAB_INFO_HINT .= '<li>If logged in, use the up-green/down-red arrows <img border="0" src="'.$HUB_FLM->getImagePath('thumb-up-empty3.png').'"/> <img border="0" src="'.$HUB_FLM->getImagePath('thumb-down-empty3.png').'"/> to promote/demote '.$LNG->CHALLENGES_NAME.'.</li>';
$LNG->CHALLENGE_TAB_INFO_HINT .= '</ul>';
// Issue Tab
$LNG->ISSUE_TAB_INFO_HINT = '<ul style="padding-left:20px;margin-left:0px">';
$LNG->ISSUE_TAB_INFO_HINT .= '<li>'.$LNG->ISSUES_NAME.' and problems facing your community are found here.</li>';
$LNG->ISSUE_TAB_INFO_HINT .= '<li>'.$LNG->ISSUES_NAME.' can be associated to the '.$LNG->CHALLENGES_NAME.' for your community that are use to cluster community suggested '.$LNG->ISSUES_NAME.' into few '.$LNG->CHALLENGES_NAME.'. Click the <span class="active">'.$LNG->CHALLENGES_NAME.'</span> tab  to explore them further.</li>';
$LNG->ISSUE_TAB_INFO_HINT .= '<li>'.$LNG->ISSUES_NAME.' are tagged with '.$LNG->THEMES_NAME.', meaning you can see how they relate to each other.</li>';
$LNG->ISSUE_TAB_INFO_HINT .= '<li>You can also see which '.$LNG->ORGS_NAME.' have an interest in these '.$LNG->ISSUES_NAME.'.</li>';
$LNG->ISSUE_TAB_INFO_HINT .= '<li>Existing '.$LNG->ISSUES_NAME.' can also be promoted or demoted, so that the community can express how important they consider each '.$LNG->ISSUE_NAME.' to be.</li>';
$LNG->ISSUE_TAB_INFO_HINT .= '<li>If logged in, use the up-green/down-red arrows <img border="0" src="'.$HUB_FLM->getImagePath('thumb-up-empty3.png').'"/> <img border="0" src="'.$HUB_FLM->getImagePath('thumb-down-empty3.png').'"/> to promote/demote '.$LNG->ISSUES_NAME.'.</li>';
$LNG->ISSUE_TAB_INFO_HINT .= '<li>If logged in, add your own '.$LNG->ISSUES_NAME.' by clicking \'Add '.$LNG->ISSUE_NAME.'\' - opening a dialogue where you can add a new '.$LNG->ISSUE_NAME.'.</li>';
$LNG->ISSUE_TAB_INFO_HINT .= '</ul>';
// Solution Tab
$LNG->SOLUTION_TAB_INFO_HINT = '<ul style="padding-left:20px;margin-left:0px">';
$LNG->SOLUTION_TAB_INFO_HINT .= '<li>Here you can explore possible answers to '.$LNG->ISSUES_NAME.'.</li>';
$LNG->SOLUTION_TAB_INFO_HINT .= '<li>'.$LNG->ISSUES_NAME.' and '.$LNG->SOLUTIONS_NAME.' are linked to each other, so you can see these relationships.</li>';
$LNG->SOLUTION_TAB_INFO_HINT .= '<li>See the '.$LNG->EVIDENCE_NAME.' relating to '.$LNG->SOLUTIONS_NAME.' for yourself by exploring the relevant items.</li>';
$LNG->SOLUTION_TAB_INFO_HINT .= '<li>Existing '.$LNG->SOLUTIONS_NAME.' can also be promoted or demoted, so that the community can express how important they consider each '.$LNG->SOLUTION_NAME.' to be.</li>';
$LNG->SOLUTION_TAB_INFO_HINT .= '<li>If logged in, use the up-green/down-red arrows <img border="0" src="'.$HUB_FLM->getImagePath('thumb-up-empty3.png').'"/> <img border="0" src="'.$HUB_FLM->getImagePath('thumb-down-empty3.png').'"/> to promote/demote '.$LNG->SOLUTIONS_NAME.'.</li>';
$LNG->SOLUTION_TAB_INFO_HINT .= '<li>If logged in, add your own '.$LNG->SOLUTIONS_NAME.' by clicking \'Add '.$LNG->SOLUTION_NAME.'\' - opening a dialogue where you can add a new '.$LNG->SOLUTION_NAME.'.</li>';
$LNG->SOLUTION_TAB_INFO_HINT .= '</ul>';
// Claim
$LNG->CLAIM_TAB_INFO_HINT = '<ul style="padding-left:20px;margin-left:0px">';
$LNG->CLAIM_TAB_INFO_HINT .= '<li>Click on individual '.$LNG->CLAIMS_NAME.' to explore the '.$LNG->CLAIM_NAME.' in more detail - click, then select \'explore\'.</li>';
$LNG->CLAIM_TAB_INFO_HINT .= '<li>Sort and/or filter the '.$LNG->CLAIMS_NAME.'... you can also use the global search facility to explore.</li>';
$LNG->CLAIM_TAB_INFO_HINT .= '<li>If logged in, add your own '.$LNG->CLAIMS_NAME.' by clicking \'Add '.$LNG->CLAIM_NAME.'\' - opening a dialogue where you can add a '.$LNG->CLAIM_NAME.'.</li>';
$LNG->CLAIM_TAB_INFO_HINT .= '</ul>';

$LNG->EVIDENCE_TAB_INFO_HINT = '<ul style="padding-left:20px;margin-left:0px">';
$LNG->EVIDENCE_TAB_INFO_HINT .= '<li>Existing '.$LNG->EVIDENCES_NAME.' can be promoted or demoted, so that the community can express how sounds they consider an '.$LNG->EVIDENCE_NAME.' to be.</li>';
$LNG->EVIDENCE_TAB_INFO_HINT .= '<li>Use the up-green/down-red arrows <img border="0" src="'.$HUB_FLM->getImagePath('thumb-up-empty3.png').'"/> <img border="0" src="'.$HUB_FLM->getImagePath('thumb-down-empty3.png').'"/> to promote/demote evidence.</li>';
$LNG->EVIDENCE_TAB_INFO_HINT .= '<li>By clicking on \'Add '.$LNG->EVIDENCE_NAME.'\' (just below the horizontal tab menu) you can contribute your own metadata and '.$LNG->RESOURCES_NAME.' about the '.$LNG->EVIDENCE_NAME.'.</li>';
$LNG->EVIDENCE_TAB_INFO_HINT .= '<li>The dialogue allows you to describe the '.$LNG->EVIDENCE_NAME.', link it to '.$LNG->THEMES_NAME.' and '.$LNG->RESOURCES_NAME.' to support your '.$LNG->EVIDENCE_NAME.'.</li>';
$LNG->EVIDENCE_TAB_INFO_HINT .= '<li>Try to add web <span class="active">'.$LNG->RESOURCES_NAME.'</span> to support your '.$LNG->EVIDENCE_NAME.'.</li>';
$LNG->EVIDENCE_TAB_INFO_HINT .= '</ul>';

$LNG->TAB_RESOURCE_INFO_HINT = '<ul style="padding-left:20px;margin-left:0px">';
$LNG->TAB_RESOURCE_INFO_HINT .= '<li>This area holds a collection of websites and publications.</li>';
$LNG->TAB_RESOURCE_INFO_HINT .= '<li>You can sort and search these as well as adding your own.</li>';
$LNG->TAB_RESOURCE_INFO_HINT .= '<li>Click on the title and then click on \'explore\' to open the item details for that entry.</li>';
$LNG->TAB_RESOURCE_INFO_HINT .= '<li>The '.$LNG->RESOURCE_NAME.' explore pages will shows all related '.$LNG->ORGS_NAME.'.'.$LNG->PROJECTS_NAME.', '.$LNG->THEMES_NAME.', and '.$LNG->EVIDENCE_NAME.'.</li>';
$LNG->TAB_RESOURCE_INFO_HINT .= '</ul>';

$LNG->TAB_ORG_INFO_HINT = '<ul style="padding-left:20px;margin-left:0px">';
$LNG->TAB_ORG_INFO_HINT .= '<li>From this page, if you are logged in, you can click on \'Add '.$LNG->ORG_NAME.'\' (just below the horizontal tab menu).</li>';
$LNG->TAB_ORG_INFO_HINT .= '<li>Add a description of your '.$LNG->ORG_NAME.', including geographical location and website.</li>';
$LNG->TAB_ORG_INFO_HINT .= '<li>Use the <span class="active">Geo Map View</span> and <span class="active">'.$LNG->THEME_NAME.' Map View</span> to explore '.$LNG->ORGS_NAME.' in relation to each other.</li>';
$LNG->TAB_ORG_INFO_HINT .= '</ul>';

$LNG->TAB_PROJECT_INFO_HINT = '<ul style="padding-left:20px;margin-left:0px">';
$LNG->TAB_PROJECT_INFO_HINT .= '<li>From this page, if you are logged in, you can click on \'Add '.$LNG->PROJECT_NAME.'\' (just below the horizontal tab menu).</li>';
$LNG->TAB_PROJECT_INFO_HINT .= '<li>Add a description of your '.$LNG->PROJECTS_NAME.', including geographical location and website.</li>';
$LNG->TAB_PROJECT_INFO_HINT .= '<li>Use the <span class="active">Geo Map View</span> and <span class="active">'.$LNG->THEME_NAME.' Map View</span> to explore '.$LNG->PROJECTS_NAME.' in relation to each other.</li>';
$LNG->TAB_PROJECT_INFO_HINT .= '</ul>';

$LNG->TAB_USER_INFO_HINT = '<p style="padding: 5px; margin-top:0;">The Evidence Hub is a community-led, collective intelligence - raise your own questions, propose solutions, add evidence to really benefit from this resource!</p>';

if ($CFG->signupstatus == $CFG->SIGNUP_OPEN) {
	$LNG->TAB_USER_INFO_HINT .= '<p style="padding: 5px; margin-top:0px">To start contributing please create an account</p>';
	$LNG->TAB_USER_INFO_HINT .= '<ul style="padding-left:20px;margin-left:0px">';
	$LNG->TAB_USER_INFO_HINT .= '<li>Click on Sign Up in the top right of the homepage.</li>';
	$LNG->TAB_USER_INFO_HINT .= '<li>Fill in the form (including the captcha) and request your account.</li>';
	$LNG->TAB_USER_INFO_HINT .= '<li>Once registered, Sign In and customize your profile by clicking on your account name when signed in.</li>';
	$LNG->TAB_USER_INFO_HINT .= '</ul>';
} else if ($CFG->signupstatus == $CFG->SIGNUP_REQUEST) {
	$LNG->TAB_USER_INFO_HINT .= '<p style="padding: 5px; margin-top:0px">To start contributing please create an account</p>';
	$LNG->TAB_USER_INFO_HINT .= '<ul style="padding-left:20px;margin-left:0px">';
	$LNG->TAB_USER_INFO_HINT .= '<li>Click on Sign Up in the top right of the homepage.</li>';
	$LNG->TAB_USER_INFO_HINT .= '<li>Fill in the form (including the captcha) and request your account.</li>';
	$LNG->TAB_USER_INFO_HINT .= '<li>You will be notified by email when your account becomes active</li>';
	$LNG->TAB_USER_INFO_HINT .= '<li>Once registered, Sign In and customize your profile by clicking on your account name when signed in.</li>';
	$LNG->TAB_USER_INFO_HINT .= '</ul>';
} else {
	$LNG->TAB_USER_INFO_HINT .= '<p style="padding-left: 5px; margin-top:0px">Registration for this site is currently by invitation only.</p>';
}
*/

/**** EMAIL TEXT *****/
/*
$LNG->WELCOME_REGISTER_OPEN_SUBJECT = "Welcome to the ".$CFG->SITE_TITLE;
$LNG->WELCOME_REGISTER_OPEN_BODY = 'Thank you for registering with us.<br><br>For more information about what the Evidence Hub is, why not read our <a href="'.$CFG->homeAddress.'ui/pages/about.php">about page</a>.<br>For help in getting started using the hub why not visit our <a href="'.$CFG->homeAddress.'help/">help page</a>.<br>Why not start using the <a href="'.$CFG->homeAddress.'">'.$CFG->SITE_TITLE.'</a> today.';

$LNG->VALIDATE_REGISTER_SUBJECT = "Completing your registration on ".$CFG->SITE_TITLE;

$LNG->WELCOME_REGISTER_REQUEST_SUBJECT = "Registration request for the ".$CFG->SITE_TITLE;
$LNG->WELCOME_REGISTER_REQUEST_BODY = 'Thank you for requesting an account on the <a href="'.$CFG->homeAddress.'">'.$CFG->SITE_TITLE.'</a>.<br>This is to acknowledge that we have received your request.<br>We will attempt to process your request within 24 hours, but at busy times it may take longer.<br>You will receive a further email with your Sign In details, if your request is successful.<br><br>Thanks again for your interest.';
$LNG->WELCOME_REGISTER_REQUEST_BODY_ADMIN = "A new User has requested an account. Please use the Admin area to accept or reject this new User.";

$LNG->WELCOME_REGISTER_CLOSED_SUBJECT = "Registration on the ".$CFG->SITE_TITLE;

$LNG->MAILCHIMP_SUBSCRIPTION_ERROR_SUBJECT = "MailChimp Subscription issue";
$LNG->MAILCHIMP_SUBSCRIPTION_ERROR_BODY = "Error trying to subscribe a new user to MailChimp";
$LNG->MAILCHIMP_EDIT_ERROR_SUBJECT = "MailChimp Edit issue";
$LNG->MAILCHIMP_EDIT_ERROR_BODY = "Error trying to Edit a user on MailChimp";
$LNG->MAILCHIMP_UNSUBSCRIBE_ERROR_SUBJECT = "MailChimp Unsubscribe issue";
$LNG->MAILCHIMP_UNSUBSCRIBE_ERROR_BODY = "Error trying to Unsubscribe a user on MailChimp";
$LNG->MAILCHIMP_SUBSCRIBER_LIST_ERROR = 'Unable to load subscriber list!';
$LNG->MAILCHIMP_UPDATE_MEMBER_ERROR = 'Unable to update member info!';
$LNG->MAILCHIMP_CHECK_MEMBERS_ERROR = 'Unable to check members!';
*/

/*** NODE LISTINGS AND ITEMS ***/
/*
$LNG->NODE_DETAIL_BUTTON_TEXT = 'Full Details';
$LNG->NODE_DETAIL_MENU_TEXT = 'Full Details';

//$LNG->NODE_DETAIL_BUTTON_HINT = 'Click to go and view all information and connections around this item.';
//$LNG->NODE_DETAIL_BUTTON_HINT = 'Go to item home and view all information about it';

$LNG->NODE_DETAIL_BUTTON_HINT = 'Go to full information on this item.';

$LNG->NODE_MAP_BUTTON_TEXT = 'Network Graph';
$LNG->NODE_MAP_BUTTON_HINT = 'View the network graph around this item (uses a Java Applet)';
$LNG->NODE_TYPE_ICON_HINT = 'View original image';
$LNG->NODE_EXPLORE_BUTTON_TEXT = 'Explore >>';
$LNG->NODE_EXPLORE_BUTTON_HINT = 'Click to show/hide where you can go and see more information and activities around this item';
$LNG->NODE_DISCONNECT_MENU_TEXT = 'Disconnect';
$LNG->NODE_DISCONNECT_MENU_HINT = 'Disconnect this from the current focal item';
$LNG->NODE_DISCONNECT_LINK_TEXT = 'Remove';
$LNG->NODE_DISCONNECT_LINK_HINT = 'Disconnect this from the current focal item';
$LNG->NODE_TOGGLE_HINT = 'Click to view/hide additional information';
$LNG->NODE_VIEW_CONNECTOR_MENU_TEXT = "Who connected it?";
$LNG->NODE_VIEW_CONNECTOR_MENU_HINT = "Go to the connectors Home Page: ";
*/

//in widget list
/*
$LNG->NODE_RELEVANCE_ADD_ICON_ALT = 'Relevance';
$LNG->NODE_RELEVANCE_ADD_ICON_HINT = 'Add why this is a relevant association to the focal node';
$LNG->NODE_RELEVANCE_EDIT_LINK_TEXT = 'Edit Relevance';
$LNG->NODE_RELEVANCE_EDIT_LINK_HINT = 'Edit the text you entered for why this is a relavant association to the focal node';

$LNG->NODE_RELEVANCE_VIEW_MENU_TEXT = 'View Relevance';
$LNG->NODE_RELEVANCE_VIEW_MENU_HINT = 'View why this is a relevant association to the above';
$LNG->NODE_RELEVANCE_HEADING = 'Relevance:';
$LNG->NODE_RELEVANCE_ADD_MENU_TEXT = 'Add Relevance';
$LNG->NODE_RELEVANCE_EDIT_MENU_TEXT = 'Edit Relevance';

$LNG->NODE_EDIT_ICON_ALT = 'Edit';
$LNG->NODE_EDIT_CHALLENGE_ICON_HINT = 'Edit this '.$LNG->CHALLENGE_NAME;
$LNG->NODE_EDIT_ISSUE_ICON_HINT = 'Edit this '.$LNG->ISSUE_NAME;
$LNG->NODE_EDIT_SOLUTION_ICON_HINT = 'Edit this '.$LNG->SOLUTION_NAME;
$LNG->NODE_EDIT_CLAIM_ICON_HINT = 'Edit this '.$LNG->CLAIM_NAME;
$LNG->NODE_EDIT_EVIDENCE_ICON_HINT = 'Edit this '.$LNG->EVIDENCE_NAME;
$LNG->NODE_EDIT_RESOURCE_ICON_HINT = 'Edit this '.$LNG->RESOURCE_NAME;
$LNG->NODE_EDIT_PROJECT_ICON_HINT = 'Edit this '.$LNG->PROJECT_NAME;
$LNG->NODE_EDIT_ORG_ICON_HINT = 'Edit this '.$LNG->ORG_NAME;

$LNG->NODE_DELETE_ICON_ALT = 'Delete';
$LNG->NODE_DELETE_ICON_HINT = 'Delete this item';
$LNG->NODE_NO_DELETE_ICON_ALT = 'Delete unavailable';
$LNG->NODE_NO_DELETE_ICON_HINT = 'You cannot delete this item. Someone else has connected to it';
$LNG->NODE_SUPPORTING_EVIDENCE_LINK = 'Supporting '.$LNG->EVIDENCE_NAME;
$LNG->NODE_ADD_SUPPORTING_EVIDENCE_HINT = 'Add Supporting '.$LNG->EVIDENCE_NAME;
$LNG->NODE_COUNTER_EVIDENCE_LINK = 'Counter '.$LNG->EVIDENCE_NAME;
$LNG->NODE_ADD_COUNTER_EVIDENCE_HINT = 'Add Counter '.$LNG->EVIDENCE_NAME;

$LNG->NODE_VOTE_FOR_ICON_ALT = 'Voting For';
$LNG->NODE_VOTE_AGAINST_ICON_ALT = 'Voting Against';
$LNG->NODE_VOTE_REMOVE_HINT = 'Unset...';
$LNG->NODE_VOTE_FOR_ADD_HINT = 'Promote this...';
$LNG->NODE_VOTE_FOR_SOLUTION_HINT = 'Strong '.$LNG->SOLUTION_NAME.' for this';
$LNG->NODE_VOTE_FOR_CLAIM_HINT = 'Sound '.$LNG->CLAIM_NAME.' for this';
$LNG->NODE_VOTE_FOR_EVIDENCE_SOLUTION_HINT = 'Convincing '.$LNG->EVIDENCE_NAME.' for this';
$LNG->NODE_VOTE_FOR_EVIDENCE_CLAIM_HINT = 'Sound '.$LNG->EVIDENCE_NAME.' for this';
$LNG->NODE_VOTE_AGAINST_ADD_HINT = 'Demote this...';
$LNG->NODE_VOTE_AGAINST_SOLUTION_HINT = 'Weak '.$LNG->SOLUTION_NAME.' for this';
$LNG->NODE_VOTE_AGAINST_CLAIM_HINT = 'Unsound '.$LNG->CLAIM_NAME.' for this';
$LNG->NODE_VOTE_AGAINST_EVIDENCE_SOLUTION_HINT = 'Unconvincing '.$LNG->EVIDENCE_NAME.' for this';
$LNG->NODE_VOTE_AGAINST_EVIDENCE_CLAIM_HINT = 'Unsound '.$LNG->EVIDENCE_NAME.' for this';
$LNG->NODE_VOTE_FOR_LOGIN_HINT = 'Sign In to Promote this';
$LNG->NODE_VOTE_AGAINST_LOGIN_HINT = 'Sign In to Demote this';
$LNG->NODE_VOTE_MENU_TEXT = 'Vote:';

$LNG->NODE_ADDED_ON = 'Added on:';
$LNG->NODE_ADDED_BY = 'Added by:';
$LNG->NODE_CONNECTED_ON = 'Connected on';
$LNG->NODE_CONNECTED_BY = 'Connected by';
$LNG->NODE_RESOURCE_LINK_HINT = 'View site';
$LNG->NODE_URL_LINK_TEXT = 'Go to web page';
$LNG->NODE_URL_LINK_HINT = 'Open the associated web page in a new tab';
$LNG->NODE_URL_HEADING = 'Url:';
$LNG->NODE_RESOURCE_CLIPS_HEADING = 'Clips:';
$LNG->NODE_TAGS_HEADING = 'Tags:';
$LNG->NODE_DESC_HEADING = 'Description:';
$LNG->NODE_SHARED_THEMES = 'Shared '.$LNG->THEMES_NAME.':';

$LNG->NODE_CHILDREN_ISSUE = 'Sub '.$LNG->ISSUES_NAME;
$LNG->NODE_CHILDREN_SOLUTION = $LNG->SOLUTIONS_NAME.' to this';
$LNG->NODE_CHILDREN_CLAIM = $LNG->CLAIMS_NAME.' Responding to this';
$LNG->NODE_CHILDREN_EVIDENCE_PRO = 'Supporting '.$LNG->EVIDENCES_NAME;
$LNG->NODE_CHILDREN_EVIDENCE_CON = 'Counter '.$LNG->EVIDENCES_NAME;
$LNG->NODE_CHILDREN_RESOURCES =  $LNG->RESOURCES_NAME;

$LNG->NODE_DISCONNECT_CHECK_MESSAGE_PART1 = 'Are you sure you want to disconnect';
$LNG->NODE_DISCONNECT_CHECK_MESSAGE_PART2 = 'from';
$LNG->NODE_DISCONNECT_CHECK_MESSAGE_PART3 = '?';
$LNG->NODE_DELETE_CHECK_MESSAGE = 'Are you sure you want to delete the';
$LNG->NODE_DELETE_CHECK_MESSAGE_ITEM = 'item';
$LNG->NODE_FOLLOW_ITEM_HINT = 'Follow this item...';
$LNG->NODE_UNFOLLOW_ITEM_HINT = 'Unfollow this item...';
$LNG->NODE_CONNECTION_RELEVANCE_MESSAGE = 'Why is this association relevant?';
*/

/** CHANGE PASSWORD PAGE **/
/*
$LNG->CHANGE_PASSWORD_TITLE = 'Change Password';
$LNG->CHANGE_PASSWORD_CURRENT_PASSWORD_ERROR = 'Please enter your current password.';
$LNG->CHANGE_PASSWORD_NEW_PASSWORD_ERROR = 'Please enter your new password.';
$LNG->CHANGE_PASSWORD_CONFIRM_PASSWORD_ERROR = 'Please confirm your new password.';
$LNG->CHANGE_PASSWORD_PASSWORD_INCORRECT_ERROR = 'Your current password is incorrect. Please try again.';
$LNG->CHANGE_PASSWORD_CONFIRM_MISSMATCH_ERROR = "The password and password confirmation don't match.";
$LNG->CHANGE_PASSWORD_PROVIDE_PASSWORD_ERROR = 'You must provide a password.';
$LNG->CHANGE_PASSWORD_SUCCESSFUL_UPDATE = 'Password successfully updated';
$LNG->CHANGE_PASSWORD_BACK_TO_PROFILE = 'Go To My Profile';
$LNG->CHANGE_PASSWORD_GO_TO_MY_HOME = 'Go To My Home Page';
$LNG->CHANGE_PASSWORD_CURRENT_PASSWORD_LABEL = 'Current Password:';
$LNG->CHANGE_PASSWORD_NEW_PASSWORD_LABEL = 'New Password:';
$LNG->CHANGE_PASSWORD_CONFIRM_PASSWORD_LABEL = 'Confirm Password:';
$LNG->CHANGE_PASSWORD_UPDATE_BUTTON = 'Update';
*/

/** FORGOT PASSWORD PAGE **/
/*
$LNG->FORGOT_PASSWORD_TITLE = 'Forgotten password?';
$LNG->FORGOT_PASSWORD_HEADER_MESSAGE = "Please enter your email address and we'll send you a link where you can reset your password.";
$LNG->FORGOT_PASSWORD_EMAIL_NOT_FOUND_ERROR = 'Email address not found';
$LNG->FORGOT_PASSWORD_EMAIL_SUMMARY = 'Reset Evidence Hub password';
$LNG->FORGOT_PASSWORD_EMAIL_SENT_MESSAGE = 'An email has been sent for you to reset your password.';
$LNG->FORGOT_PASSWORD_EMAIL_LABEL = 'Email:';
$LNG->FORGOT_PASSWORD_SUBMIT_BUTTON = 'Submit';
*/

/** LOGIN PAGE **/
/*
$LNG->LOGIN_TITLE = 'Sign In to the '.$CFG->SITE_TITLE;
$LNG->LOGIN_INVALID_ERROR = 'Invalid Sign In, please try again.';
$LNG->LOGIN_NOT_REGISTERED_MESSAGE = 'Not yet registered?';
$LNG->LOGIN_INVITIATION_ONLY_MESSAGE = 'Registration for this site is currently by invitation only.';
$LNG->LOGIN_SIGNUP_OPEN_LINK = 'Sign Up!';
$LNG->LOGIN_SIGNUP_REGISTER_LINK = 'Sign Up!';
$LNG->LOGIN_USERNAME_LABEL = 'Email:';
$LNG->LOGIN_PASSWORD_LABEL = 'Password:';
$LNG->LOGIN_LOGIN_BUTTON = 'Login';
$LNG->LOGIN_FORGOT_PASSWORD_LINK = 'Forgotten password?';
$LNG->LOGIN_FORGOT_PASSWORD_MESSAGE_PART1 = 'Forgotten password? Please';
$LNG->LOGIN_FORGOT_PASSWORD_MESSAGE_PART2 = 'Contact Us';
$LNG->LOGIN_PASSWORD_LENGTH = 'Your password must be at least 8 characters long.';
$LNG->LOGIN_PASSWORD_LENGTH_UPDATE = 'For added security we now enforce a minimum password length of 8 characters on new accounts.<br>We recommend to existing account holders with passwords under 8 characters in length that they reset their passwords now.<br>Thank you for your co-operation in increasing security on this site.';
*/

/** PROFILE PAGE **/
/*
$LNG->PROFILE_TITLE = 'Edit Profile';
$LNG->PROFILE_CHANGE_PASSWORD_LINK = '(Change Password)';
$LNG->PROFILE_INVALID_EMAIL_ERROR = "Please enter a valid email address.";
$LNG->PROFILE_EMAIL_IN_USE_ERROR = "That email address is already in use, please select another one.";
$LNG->PROFILE_FULL_NAME_ERROR = "Please enter your full name.";
$LNG->PROFILE_HOMEPAGE_URL_ERROR = "Please enter a full valid URL (including 'http://') for your homepage.";
$LNG->PROFILE_SUCCESSFULLY_UPDATED_MESSAGE = 'Profile successfully updated';
$LNG->PROFILE_UPDATE_BUTTON = 'Update';
$LNG->PROFILE_DESC_LABEL = 'Description:';
$LNG->PROFILE_PHOTO_CURRENT_LABEL = 'Current photo:';
$LNG->PROFILE_PHOTO_REPLACE_LABEL = 'Replace photo with:';
$LNG->PROFILE_PHOTO_LABEL = 'Photo:';
$LNG->PROFILE_LOCATION = 'Location: (town/city)';
$LNG->PROFILE_COUNTRY = 'Country...';
$LNG->PROFILE_HOMEPAGE = 'Homepage:';
$LNG->PROFILE_EMAIL_VALIDATE_TEXT = 'Validate Email Address';
$LNG->PROFILE_EMAIL_VALIDATE_HINT = 'Your email address has not been validated. If you want to use Social Sign On you will need to validate you own this email address.';
$LNG->PROFILE_EMAIL_VALIDATE_MESSAGE = 'You have been sent an email to validate that you own the email address on this user account.';
$LNG->PROFILE_EMAIL_VALIDATE_COMPLETE = 'This email address has been validated.';
$LNG->PROFILE_EMAIL_CHANGE_CONFIRM = 'You have changed your email address.\nThis new email address will need to be verified.\n\nYour user account will now be locked, you will be logged out and you will be sent a new account validation email.\nPlease click on the link in the email to complete the change of email address.\n\nAre you sure you want to proceed?';
*/

/** COMPENDIUM IMPORT **/
/*
$LNG->IMPORT_COMPENDIUM_TITLE = 'Import from Compendium';
$LNG->IMPORT_COMPENDIUM_HELP_LINK = 'help';
$LNG->IMPORT_COMPENDIUM_FILE_UPLOAD_ERROR = 'An error occured uploading the file';
$LNG->IMPORT_COMPENDIUM_INVALID_XML = 'Not a valid XML file';
$LNG->IMPORT_COMPENDIUM_SUCCESS_MESSAGE = 'The file was sucessfully uploaded and imported:';
$LNG->IMPORT_COMPENDIUM_PROBLEMS_ERROR = 'The following problems were found during the upload, please try again:';
$LNG->IMPORT_COMPENDIUM_FILE_LABEL = 'Compendium XML File:';
$LNG->IMPORT_COMPENDIUM_IMPORT_BUTTON = 'Import';
$LNG->IMPORT_COMPENDIUM_NO_LINKS_ERROR = 'There are no links that can be imported from this map';
$LNG->IMPORT_COMPENDIUM_CONNECTION_MESSAGE_PART1 = 'Connection added from:';
$LNG->IMPORT_COMPENDIUM_CONNECTION_MESSAGE_PART2 = 'to:';
$LNG->IMPORT_COMPENDIUM_IDEA_ADDED_MESSAGE = 'Idea added:';
$LNG->IMPORT_COMPENDIUM_FORM_MESSAGE = 'Please select the Compendium XML file to import and select one or more Themes to associate with the imported data.';
$LNG->IMPORT_COMPENDIUM_THEME_FORM_HINT = '(compulsory) - Select at least one '.$LNG->THEME_NAME.' to associate with all the data that is being imported. You can enter more than one.';
$LNG->IMPORT_COMPENDIUM_LOADING_DATA = '( Importing Compendium data... Note: time taken will vary depending on size of XML import file )';
$LNG->IMPORT_COMPENDIUM_REQUIRED_FIELDS_MESSAGE_PART1 = '(fields with a';
$LNG->IMPORT_COMPENDIUM_REQUIRED_FIELDS_MESSAGE_PART2 = 'are compulsory)';
*/

/** BUILDER TOOLBAR **/
/*
$LNG->BUILDER_GOTO_HOME_SITE_HINT = "go to ".$CFG->SITE_TITLE." Website";
$LNG->BUILDER_COLLAPSE_TOOLBAR_HINT = "collapse Evidence Hub Helper";
$LNG->BUILDER_ADD_RESOURCE_HINT = "Add this page as new ".$LNG->RESOURCE_NAME." into the Evidence Hub";
$LNG->BUILDER_ADD_EVIDENCE_HINT = "Add a new ".$LNG->EVIDENCE_NAME." into the Evidence Hub";
$LNG->BUILDER_ADD_ISSUE_HINT = "Add a new ".$LNG->ISSUE_NAME." into the Evidence Hub";
$LNG->BUILDER_ADD_SOLUTION_HINT = "Add a new ".$LNG->SOLUTION_NAME." into the Evidence Hub";
$LNG->BUILDER_ADD_CLAIM_HINT = "Add a new ".$LNG->CLAIM_NAME." into the Evidence Hub";
$LNG->BUILDER_ADD_ORG_HINT = "Add a new ".$LNG->ORG_NAME."/".$LNG->PROJECT_NAME." into the Evidence Hub";
$LNG->BUILDER_CLOSE_TOOLBAR_HINT = "close this Evidence Hub Helper";
$LNG->BUILDER_TITLE_LABEL = "Title:";
$LNG->BUILDER_EXPLORE_LINK = "Explore";
*/

/** FOOTER **/
/*
$LNG->FOOTER_TERMS_LINK = 'Terms of Use';
$LNG->FOOTER_PRIVACY_LINK = 'Privacy';
$LNG->FOOTER_COOKIES_LINK = 'Cookies';
$LNG->FOOTER_CONTACT_LINK = 'Contact';
$LNG->FOOTER_FAMILY_MESSAGE_PART1 = 'part of the';
$LNG->FOOTER_FAMILY_MESSAGE_PART2 = 'family';
$LNG->FOOTER_EVIDENCE_HUB_HINT = 'Go the the evidence-hub.net website';
*/

/** REPORT FOOTER **/
//$LNG->FOOTER_REPORT_PRINTED_ON = 'Report printed on:';

/** USERS **/
/*
$LNG->USERS_UNFOLLOW = 'Unfollow this person...';
$LNG->USERS_FOLLOW = 'Follow this person...';
$LNG->USERS_FOLLOW_ICON_ALT = 'Follow';
$LNG->USERS_STARTED_FOLLOWING_ON = 'Started following on:';
$LNG->USERS_PROFILE_TAGS = 'Profile Tags:';
$LNG->USERS_LAST_LOGIN = 'Last Sign In:';
$LNG->USERS_LAST_ACTIVE = 'Last Active:';
$LNG->USERS_DATE_JOINED = 'Date Joined:';
$LNG->USERS_PRESENCE_OFF = 'User offline or inactive for more than 20 minutes';
$LNG->USERS_PRESENCE_ON = 'User active in the last 20 minutes';
*/

/** THEMELIST **/
//$LNG->THEMELIST_ITEM_HINT = 'Click to explore this';

/** USER HOME PAGE **/
/*
$LNG->USER_HOME_MANAGE_TAGS_LINK = 'Manage Tags';
$LNG->USER_HOME_MANAGE_TAGS_HINT = 'Open a popup dialog listing all your tags and allowing you to edit/delete them and view their usage.';
$LNG->USER_HOME_IMPORT_COMPENDIUM_LINK = 'Import from Compendium';
$LNG->USER_HOME_IMPORT_BIBTEX_LINK = 'Import from Bib TeX';

$LNG->USER_HOME_REMOVE_ACCOUNT_LINK = 'Request Account Closure';
$LNG->USER_HOME_REMOVE_ACCOUNT_EMAIL_CONFIRMATION = 'Account closure request sent';
$LNG->USER_HOME_REMOVE_ACCOUNT_LINK_HINT = 'Send an email to request your account be closed down';
$LNG->USER_HOME_REMOVE_ACCOUNT_CONFIRM = 'Your account will be anonymized and your personal data removed, but your content on the site will remain.\nOnce implemented, this action cannot be undone.\n\nAre you sure you want to request to close your account?';

$LNG->USER_HOME_COMPENDIUM_HELP_LINK = 'help';
$LNG->USER_HOME_LOCATION_LABEL = 'Location:';
$LNG->USER_HOME_TABLE_ITEM_TYPE = 'Item Type';
$LNG->USER_HOME_TABLE_CREATION_COUNT = 'Creation Count';
$LNG->USER_HOME_TABLE_VIEW = 'View';
$LNG->USER_HOME_TABLE_TYPE = 'Type';
$LNG->USER_HOME_TABLE_NAME = 'Name';
$LNG->USER_HOME_TABLE_ACTION = 'Action';
$LNG->USER_HOME_TABLE_PICTURE = 'Picture';
$LNG->USER_HOME_PROFILE_HEADING = 'Profile';
$LNG->USER_HOME_VIEW_CONTENT_HEADING = 'Content Creation Summary';
$LNG->USER_HOME_VIEW_ACTIVITIES_LINK = "( View all Activity for this person )";
$LNG->USER_HOME_VIEW_ACTIVITIES_HINT =  "This opens a new window and may take some time to load depending on the volume of activity by that person";
$LNG->USER_HOME_FOLLOWING_HEADING = 'Following';
$LNG->USER_HOME_ACTIVITY_ALERT = 'Send email Alert of New Activity';
$LNG->USER_HOME_EMAIL_DAILY = 'Daily';
$LNG->USER_HOME_EMAIL_WEEKLY = 'Weekly';
$LNG->USER_HOME_EMAIL_MONTHLY = 'Monthly';
$LNG->USER_HOME_PERSON_LABEL = 'Person';
$LNG->USER_HOME_UNFOLLOW_LINK = 'Unfollow';
$LNG->USER_HOME_EXPLORE_LINK = 'Explore';
$LNG->USER_HOME_ACTIVITY_LINK = 'Activity';
$LNG->USER_HOME_NOT_FOLLOWING_MESSAGE = 'Not following any people or items yet.';
$LNG->USER_HOME_FOLLOWERS_HEADING = 'Followers';
$LNG->USER_HOME_NO_FOLLOWERS_MESSAGE = 'No followers yet.';
$LNG->USER_HOME_ANALYTICS_LINK_TEXT = '( View Analytics for this person )';
$LNG->USER_HOME_ANALYTICS_LINK_HINT =  "This opens a new window and may take some time to load depending on the volume of activity by that person";
*/

/** MAIN TAB SCREENS - TABBERLIB **/
/*
$LNG->TAB_ADD_CHALLENGE_LINK = 'Add '.$LNG->CHALLENGE_NAME;
$LNG->TAB_ADD_ISSUE_LINK = 'Add '.$LNG->ISSUE_NAME;
$LNG->TAB_ADD_SOLUTION_LINK = 'Add '.$LNG->SOLUTION_NAME;
$LNG->TAB_ADD_CLAIM_LINK = 'Add '.$LNG->CLAIM_NAME;
$LNG->TAB_ADD_EVIDENCE_LINK = 'Add '.$LNG->EVIDENCE_NAME;
$LNG->TAB_ADD_RESOURCE_LINK = 'Add '.$LNG->RESOURCE_NAME;
$LNG->TAB_ADD_ORG_LINK = 'Add '.$LNG->ORG_NAME;
$LNG->TAB_ADD_PROJECT_LINK = 'Add '.$LNG->PROJECT_NAME;
$LNG->TAB_ADD_COMMENT_LINK = 'Add '.$LNG->COMMENT_NAME;

$LNG->TAB_ADD_CHALLENGE_HINT = 'Add '.$LNG->CHALLENGE_NAME;
$LNG->TAB_ADD_ISSUE_HINT = 'Add '.$LNG->ISSUE_NAME;
$LNG->TAB_ADD_SOLUTION_HINT = 'Add '.$LNG->SOLUTION_NAME;
$LNG->TAB_ADD_CLAIM_HINT = 'Add '.$LNG->CLAIM_NAME;
$LNG->TAB_ADD_EVIDENCE_HINT = 'Add '.$LNG->EVIDENCE_NAME;
$LNG->TAB_ADD_RESOURCE_HINT = 'Add website or publication';
$LNG->TAB_ADD_ORG_HINT = 'Add '.$LNG->ORG_NAME;
$LNG->TAB_ADD_PROJECT_HINT = 'Add '.$LNG->PROJECT_NAME;
$LNG->TAB_ADD_COMMENT_HINT = 'Add '.$LNG->COMMENT_NAME;

$LNG->TAB_RSS_CHALLENGE_HINT = 'Get an RSS feed for '.$LNG->CHALLENGES_NAME;
$LNG->TAB_RSS_ISSUE_HINT = 'Get an RSS feed for '.$LNG->ISSUES_NAME;
$LNG->TAB_RSS_SOLUTION_HINT = 'Get an RSS feed for '.$LNG->SOLUTIONS_NAME;
$LNG->TAB_RSS_CLAIM_HINT = 'Get an RSS feed for '.$LNG->CLAIMS_NAME;
$LNG->TAB_RSS_EVIDENCE_HINT = 'Get an RSS feed for '.$LNG->EVIDENCES_NAME;
$LNG->TAB_RSS_RESOURCE_HINT = 'Get an RSS feed for '.$LNG->RESOURCES_NAME;
$LNG->TAB_RSS_ORG_HINT = 'Get an RSS feed for '.$LNG->ORGS_NAME;
$LNG->TAB_RSS_PROJECT_HINT = 'Get an RSS feed for '.$LNG->PROJECTS_NAME;
$LNG->TAB_RSS_COMMENT_HINT = 'Get an RSS feed for '.$LNG->COMMENTS_NAME;

$LNG->TAB_RSS_ALT = 'RSS feed';
$LNG->TAB_PRINT_ALT = 'Print';
$LNG->TAB_PRINT_HINT_CHALLENGE = 'Print '.$LNG->CHALLENGES_NAME.' list';
$LNG->TAB_PRINT_HINT_ISSUE = 'Print '.$LNG->ISSUES_NAME.' list';
$LNG->TAB_PRINT_HINT_SOLUTION = 'Print '.$LNG->SOLUTIONS_NAME.' list';
$LNG->TAB_PRINT_HINT_CLAIM = 'Print '.$LNG->CLAIMS_NAME.' list';
$LNG->TAB_PRINT_HINT_EVIDENCE = 'Print '.$LNG->EVIDENCES_NAME.' list';
$LNG->TAB_PRINT_HINT_RESOURCE = 'Print '.$LNG->RESOURCES_NAME.' list';
$LNG->TAB_PRINT_HINT_ORG = 'Print '.$LNG->ORGS_NAME.' list';
$LNG->TAB_PRINT_HINT_PROJECT = 'Print '.$LNG->PROJECTS_NAME.' list';
$LNG->TAB_PRINT_HINT_COMMENT = 'Print '.$LNG->COMMENTS_NAME.' list';

$LNG->TAB_PRINT_TITLE_CHALLENGE = 'Evidence Hub: '.$LNG->CHALLENGES_NAME.' Listing';
$LNG->TAB_PRINT_TITLE_ISSUE = 'Evidence Hub: '.$LNG->ISSUES_NAME.' Listing';
$LNG->TAB_PRINT_TITLE_SOLUTION = 'Evidence Hub: '.$LNG->SOLUTIONS_NAME.' Listing';
$LNG->TAB_PRINT_TITLE_CLAIM = 'Evidence Hub: '.$LNG->CLAIMS_NAME.' Listing';
$LNG->TAB_PRINT_TITLE_EVIDENCE = 'Evidence Hub: '.$LNG->EVIDENCES_NAME.' Listing';
$LNG->TAB_PRINT_TITLE_RESOURCE = 'Evidence Hub: '.$LNG->RESOURCES_NAME.' Listing';
$LNG->TAB_PRINT_TITLE_ORG = 'Evidence Hub: '.$LNG->ORGS_NAME.' Listing';
$LNG->TAB_PRINT_TITLE_PROJECT = 'Evidence Hub: '.$LNG->PROJECTS_NAME.' Listing';
$LNG->TAB_PRINT_TITLE_COMMENT = 'Evidence Hub: '.$LNG->COMMENTS_NAME.' Listing';
/*

/*
$LNG->TAB_SEARCH_ISSUE_LABEL = 'Search '.$LNG->ISSUES_NAME;
$LNG->TAB_SEARCH_SOLUTION_LABEL = 'Search '.$LNG->SOLUTIONS_NAME;
$LNG->TAB_SEARCH_CLAIM_LABEL = 'Search '.$LNG->CLAIMS_NAME;
$LNG->TAB_SEARCH_EVIDENCE_LABEL = 'Search '.$LNG->EVIDENCES_NAME;
$LNG->TAB_SEARCH_RESOURCE_LABEL = 'Search '.$LNG->RESOURCES_NAME;
$LNG->TAB_SEARCH_ORG_LABEL = 'Search '.$LNG->ORGS_NAME;
$LNG->TAB_SEARCH_PROJECT_LABEL = 'Search '.$LNG->PROJECTS_NAME;
$LNG->TAB_SEARCH_USER_LABEL = 'Search People';
$LNG->TAB_SEARCH_COMMENT_LABEL = 'Search '.$LNG->COMMENTS_NAME;
$LNG->TAB_SEARCH_CHAT_LABEL = 'Search '.$LNG->CHATS_NAME;
*/

/*
$LNG->TAB_SEARCH_ISSUE_LABEL = 'Search';
$LNG->TAB_SEARCH_SOLUTION_LABEL = 'Search';
$LNG->TAB_SEARCH_CLAIM_LABEL = 'Search';
$LNG->TAB_SEARCH_EVIDENCE_LABEL = 'Search';
$LNG->TAB_SEARCH_RESOURCE_LABEL = 'Search';
$LNG->TAB_SEARCH_ORG_LABEL = 'Search '.$LNG->ORGS_NAME;
$LNG->TAB_SEARCH_PROJECT_LABEL = 'Search';
$LNG->TAB_SEARCH_USER_LABEL = 'Search';
$LNG->TAB_SEARCH_COMMENT_LABEL = 'Search';
$LNG->TAB_SEARCH_CHAT_LABEL = 'Search';

$LNG->TAB_SEARCH_GO_BUTTON = 'Go';
$LNG->TAB_SEARCH_CLEAR_SEARCH_BUTTON = 'Clear Current Search';

$LNG->TAB_CHALLENGE_MESSAGE = 'Explore the overarching '.$LNG->CHALLENGES_NAME.' confronting your community. These provide anchors for adding '.$LNG->ISSUES_NAME.', '.$LNG->SOLUTIONS_NAME.' and '.$LNG->EVIDENCES_NAME.'...';

$LNG->TAB_ISSUE_MESSAGE_LOGGEDIN = 'Explore key questions confronting your community, and add your own. These provide anchors for adding '.$LNG->SOLUTIONS_NAME.' and '.$LNG->EVIDENCES_NAME.'...';
$LNG->TAB_ISSUE_MESSAGE_LOGGEDOUT_OPEN = "Explore key questions confronting your community, and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registeropen.php'>Sign Up</a> to add your own. These provide anchors for adding ".$LNG->SOLUTIONS_NAME." and ".$LNG->EVIDENCES_NAME."...";
$LNG->TAB_ISSUE_MESSAGE_LOGGEDOUT_REQUEST = "Explore key questions confronting your community, and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registerrequest.php'>Sign Up</a> to add your own. These provide anchors for adding ".$LNG->SOLUTIONS_NAME." and ".$LNG->EVIDENCES_NAME."...";
$LNG->TAB_ISSUE_MESSAGE_LOGGEDOUT_CLOSED = 'Explore key questions confronting your community, and <a title="Sign In" href="'.$CFG->homeAddress.'ui/pages/login.php">Sign In</a> to add your own. These provide anchors for adding '.$LNG->SOLUTIONS_NAME.' and '.$LNG->EVIDENCES_NAME.'...';

$LNG->TAB_SOLUTION_MESSAGE_LOGGEDIN = "Explore ".$LNG->SOLUTIONS_NAME." to the ".$LNG->ISSUES_NAME." - and add your own, ideally, with some supporting/counter-evidence.";
$LNG->TAB_SOLUTION_MESSAGE_LOGGEDOUT_OPEN = "Explore ".$LNG->SOLUTIONS_NAME." to the ".$LNG->ISSUES_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registeropen.php'>Sign Up</a> to add your own, ideally, with some supporting/counter-evidence.";
$LNG->TAB_SOLUTION_MESSAGE_LOGGEDOUT_REQUEST = "Explore ".$LNG->SOLUTIONS_NAME." to the ".$LNG->ISSUES_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registerrequest.php'>Sign Up</a> to add your own, ideally, with some supporting/counter-evidence.";
$LNG->TAB_SOLUTION_MESSAGE_LOGGEDOUT_CLOSED = "Explore ".$LNG->SOLUTIONS_NAME." to the ".$LNG->ISSUES_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> to add your own, ideally, with some supporting/counter-evidence.";

$LNG->TAB_CLAIM_MESSAGE_LOGGEDIN = "Explore the ".$LNG->CLAIMS_NAME." that are being made and the debate that surrounds these - and add your own.";
$LNG->TAB_CLAIM_MESSAGE_LOGGEDOUT_OPEN = "Explore the ".$LNG->CLAIMS_NAME." that are being made and the debate that surrounds these - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registeropen.php'>Sign Up</a> to add your own.";
$LNG->TAB_CLAIM_MESSAGE_LOGGEDOUT_REQUEST = "Explore the ".$LNG->CLAIMS_NAME." that are being made and the debate that surrounds these - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registerrequest.php'>Sign Up</a> to add your own.";
$LNG->TAB_CLAIM_MESSAGE_LOGGEDOUT_CLOSED = "Explore the ".$LNG->CLAIMS_NAME." that are being made and the debate that surrounds these - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> to add your own.";

$temp = "";
if ($CFG->HAS_SOLUTION) {
	$temp .= $LNG->SOLUTIONS_NAME;
}
if ($CFG->HAS_SOLUTION && $CFG->HAS_CLAIM) {
	$temp .= " and ";
}
if ($CFG->HAS_CLAIM) {
	$temp .= $LNG->CLAIMS_NAME;
}
$LNG->TAB_EVIDENCE_MESSAGE_LOGGEDIN = "Explore supporting and counter ".$LNG->EVIDENCES_NAME." for ".$temp." - and add your own";
$LNG->TAB_EVIDENCE_MESSAGE_LOGGEDOUT_OPEN = "Explore supporting and counter ".$LNG->EVIDENCES_NAME." for ".$temp." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registeropen.php'>Sign Up</a> to add your own.";
$LNG->TAB_EVIDENCE_MESSAGE_LOGGEDOUT_REQUEST = "Explore supporting and counter ".$LNG->EVIDENCES_NAME." for ".$temp." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registerrequest.php'>Sign Up</a> to add your own.";
$LNG->TAB_EVIDENCE_MESSAG_LOGGEDOUT_CLOSED = "Explore supporting and counter ".$LNG->EVIDENCES_NAME." for ".$temp." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> to add your own.";

$LNG->TAB_RESOURCE_MESSAGE_LOGGEDIN = "Explore the ".$LNG->RESOURCES_NAME." - and add your own.";
$LNG->TAB_RESOURCE_MESSAGE_LOGGEDOUT_OPEN = "Explore the ".$LNG->RESOURCES_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registeropen.php'>Sign Up</a> to add your own.";
$LNG->TAB_RESOURCE_MESSAGE_LOGGEDOUT_REQUEST = "Explore the ".$LNG->RESOURCES_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registerrequest.php'>Sign Up</a> to add your own.";
$LNG->TAB_RESOURCE_MESSAGE_LOGGEDOUT_CLOSED = "Explore the ".$LNG->RESOURCES_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> to add your own.";

$LNG->TAB_ORG_MESSAGE_LOGGEDIN = "Explore the ".$LNG->ORGS_NAME." - and add your own.";
$LNG->TAB_ORG_MESSAGE_LOGGEDOUT_OPEN = "Explore the ".$LNG->ORGS_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registeropen.php'>Sign Up</a> to add your own.";
$LNG->TAB_ORG_MESSAGE_LOGGEDOUT_REQUEST = "Explore the ".$LNG->ORGS_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registerrequest.php'>Sign Up</a> to add your own.";
$LNG->TAB_ORG_MESSAGE_LOGGEDOUT_CLOSED = "Explore the ".$LNG->ORGS_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> to add your own.";

$LNG->TAB_PROJECT_MESSAGE_LOGGEDIN = "Explore the ".$LNG->PROJECTS_NAME." - and add your own.";
$LNG->TAB_PROJECT_MESSAGE_LOGGEDOUT_OPEN = "Explore the ".$LNG->PROJECTS_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registeropen.php'>Sign Up</a> to add your own.";
$LNG->TAB_PROJECT_MESSAGE_LOGGEDOUT_REQUEST = "Explore the ".$LNG->PROJECTS_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registerrequest.php'>Sign Up</a> to add your own.";
$LNG->TAB_PROJECT_MESSAGE_LOGGEDOUT_CLOSED = "Explore the ".$LNG->PROJECTS_NAME." - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> to add your own.";

$LNG->TAB_USER_MESSAGE = "Click a user's name to see their profile, and their contributions to the Evidence Hub.";
*/

/** HOMEPAGE **/
/*
$LNG->HOMEPAGE_TITLE = 'The Evidence Hub is a new kind of website for your community to pool its ideas and debate different kinds of evidence.';
$LNG->HOMEPAGE_FIRST_PARA = 'You\'re invited to contribute and debate the evidence-based practice and research that will move your community forward.';
$LNG->HOMEPAGE_KEEP_READING = 'keep reading';
$LNG->HOMEPAGE_READ_LESS = 'read less';
$LNG->HOMEPAGE_SECOND_PARA_PART2 = 'To do so you can:';
$LNG->HOMEPAGE_SECOND_PARA_PART2 .= '<ul>';
$LNG->HOMEPAGE_SECOND_PARA_PART2 .= '<li>Map your community - add '.$LNG->PROJECTS_NAME.' and '.$LNG->ORGS_NAME.'</li>';
$LNG->HOMEPAGE_SECOND_PARA_PART2 .= '<li>Map your ideas - add '.$LNG->ISSUES_NAME.', ';
if ($CFG->HAS_SOLUTION) {
	$LNG->HOMEPAGE_SECOND_PARA_PART2 .= $LNG->SOLUTIONS_NAME.', ';
}
if ($CFG->HAS_CLAIM) {
	$LNG->HOMEPAGE_SECOND_PARA_PART2 .= $LNG->CLAIMS_NAME.', ';
}
$LNG->HOMEPAGE_SECOND_PARA_PART2 .= $LNG->EVIDENCES_NAME.' and '.$LNG->RESOURCES_NAME.'</li></ul>';
$LNG->HOMEPAGE_CATEGORIES_CONNECT_TITLE = 'How the Categories Connect';
$LNG->HOMEPAGE_CATEGORIES_CONNECT_MESSAGE = 'The Evidence Hub joins the jigsaw pieces brought by individuals into bigger pictures which you can explore and search in new ways.';
$LNG->HOMEPAGE_CATEGORIES_CONNECT_HINT = '(rollover icons to view more information)';
$LNG->HOMEPAGE_QUICKGUIDE_LABEL = 'View the';
$LNG->HOMEPAGE_QUICKGUIDE_HINT = 'Click to go to a Quick guide to using the Evidence Hub';
$LNG->HOMEPAGE_QUICKGUIDE_LINK = 'Quick Guide';
$LNG->HOMEPAGE_THEME_TITLE = $LNG->THEMES_NAME;
$LNG->HOMEPAGE_GEOMAP_TITLE = 'Geo map of projects and organizations';
$LNG->HOMEPAGE_GEOMAP_MESSAGE = '(click image for active view)';
$LNG->HOMEPAGE_TOOLS_TITLE = 'Tools:';
$LNG->HOMEPAGE_TOOLS_LINK = 'Get the Evidence Hub Toolbar';
$LNG->HOMEPAGE_STORIES_TITLE = 'Stories:';
$LNG->HOMEPAGE_STORIES_OR = 'or';
$LNG->HOMEPAGE_STORIES_PRACTITIONER_LINK = 'Add your '.$LNG->PRACTITIONER_STORY_NAME;
$LNG->HOMEPAGE_STORIES_PRACTITIONER_HINT = 'Add your '.$LNG->PRACTITIONER_STORY_NAME;
$LNG->HOMEPAGE_STORIES_RESEARCHER_LINK = 'Add your '.$LNG->RESEARCHER_STORY_NAME;
$LNG->HOMEPAGE_STORIES_RESEARCHER_HINT = 'Add your '.$LNG->RESEARCHER_STORY_NAME;
$LNG->HOMEPAGE_STORIES_LINK = 'Add your Story';
$LNG->HOMEPAGE_STORIES_HINT = 'Add your Story';
$LNG->HOMEPAGE_TAG_TITLE_PART1 = 'Top';
$LNG->HOMEPAGE_TAG_TITLE_PART2 = 'Tags:';
*/

/** WIDGETS **/
/*
$LNG->WIDGET_RESIZE_ITEM_ALT = 'Resize item';
$LNG->WIDGET_RESIZE_ITEM_HINT = 'Resize this area';
$LNG->WIDGET_EXPAND_HINT = 'Expand';
$LNG->WIDGET_ICON_ALT = 'Icon';
$LNG->WIDGET_OPEN_CLOSE_ALT = 'Open/Close item';
$LNG->WIDGET_OPEN_CLOSE_HINT = 'Open/Close this area';
$LNG->WIDGET_CONTRACT_HINT = 'Contract';
$LNG->WIDGET_LOADING = 'Loading';
$LNG->WIDGET_LOAD = 'load';
$LNG->WIDGET_LOADING_EVIDENCE = 'Loading '.$LNG->EVIDENCES_NAME.'...';
$LNG->WIDGET_LOADING_RESOURCE = 'Loading related '.$LNG->RESOURCES_NAME.'...';
$LNG->WIDGET_LOADING_FOLLOWERS = 'Loading '.$LNG->FOLLOWERS_NAME.'...';
$LNG->WIDGET_EVIDENCE_ADD_HINT = 'Select/create a contribution to add it as evidence against the current selected item';
$LNG->WIDGET_ADD_LINK = 'Add';
$LNG->WIDGET_SIGNIN_HINT = 'Sign In to add to the Evidence Hub';
$LNG->WIDGET_FOLLOW_SIGNIN_HINT = 'Sign In to follow this entry';
$LNG->WIDGET_NONE_FOUND_PART1 = 'No';
$LNG->WIDGET_NONE_FOUND_PART2 = 'added yet';
$LNG->WIDGET_NONE_FOUND_PART2b = 'listed';
$LNG->WIDGET_THEME_SELECT_OPTION = 'Select '.$LNG->THEME_NAME.'...';
$LNG->WIDGET_ADD_BUTTON = 'Add';
$LNG->WIDGET_NO_RELATED_THEMES_FOUND = 'No related '.$LNG->THEMES_NAME.' found';
$LNG->WIDGET_FOCUS_NODE_HINT = 'Click to View More Info';
$LNG->WIDGET_THEME_EXPLORE_HINT = 'click to explore all '.$LNG->THEMES_NAME.' for';
$LNG->WIDGET_CLICK_EXPLORE_HINT = 'click to explore all';
$LNG->WIDGET_CLICK_EXPLORE_HINT2 = 'Click to explore';
$LNG->WIDGET_THEME_EXPLORE_LINK = 'Explore all';
$LNG->WIDGET_NO_RESULTS_FOUND = 'No results found';
$LNG->WIDGET_NO_FOLLOWERS_FOUND = 'No '.$LNG->FOLLOWERS_NAME.' found';
$LNG->WIDGET_HOW_EVIDENCE_RELATES_MESSAGE = 'Please select how this '.$LNG->EVIDENCE_NAME.' relates?';
$LNG->WIDGET_ADD_COMMENT_HINT = 'Add a new comment against the current focal item';
*/

/** ADMIN AREA **/
/*
$LNG->ADMIN_TITLE = "Administration Area";
$LNG->ADMIN_BUTTON_HINT = "This launches in a new window";
$LNG->ADMIN_STATS_BUTTON_HINT = "Go to the Site Analytics pages";
$LNG->ADMIN_REGISTER_NEW_USER_LINK = 'Register a New '.$LNG->USER_NAME;
$LNG->ADMIN_MANAGE_THEMES_LINK = "Manage ".$LNG->THEMES_NAME;
$LNG->ADMIN_NOT_ADMINISTRATOR_MESSAGE = 'Sorry you need to be an administrator to access this page';
$LNG->ADMIN_SQL_ERROR = 'SQL error:';
$LNG->ADMIN_MANAGE_USERS_DELETE_ERROR = 'There was an issue deleting the '.$LNG->USER_NAME.' with the id:';
$LNG->ADMIN_MANAGE_THEMES_DELETE_ERROR = 'There was an issue deleting the '.$LNG->THEME_NAME.' with the id:';

$LNG->ADMIN_THEME_MISSING_NAME_ERROR = 'You must enter a '.$LNG->THEME_NAME.' name.';
$LNG->ADMIN_THEME_ID_ERROR  = 'Error passing '.$LNG->THEME_NAME.' id.';
$LNG->ADMIN_THEME_DELETE_QUESTION_PART1 = 'Are you sure you want to delete the '.$LNG->THEME_NAME;
$LNG->ADMIN_THEME_DELETE_QUESTION_PART2 = '?\n\nNote: Any associations made to this '.$LNG->THEME_NAME.' will be lost.\n\nThis action cannot be undone.';
$LNG->ADMIN_THEME_DELETE_SUCCESS_PART1 = $LNG->THEME_NAME;
$LNG->ADMIN_THEME_DELETE_SUCCESS_PART2 = 'has now been deleted.';
$LNG->ADMIN_THEME_TITLE = "Manage ".$LNG->THEMES_NAME;
$LNG->ADMIN_THEME_ADD_NEW_LINK = 'Add New '.$LNG->THEME_NAME;
$LNG->ADMIN_THEME_NAME_LABEL = 'Name:';
$LNG->ADMIN_THEME_DESC_LABEL = 'Description:';
$LNG->ADMIN_THEME_THEME_HEADING = $LNG->THEME_NAME;
$LNG->ADMIN_THEME_ACTION_HEADING = 'Action';
$LNG->ADMIN_THEME_EDIT_LINK = 'edit';
$LNG->ADMIN_THEME_DELETE_LINK = 'delete';
$LNG->ADMIN_THEME_IMAGE_LABEL = 'Image:';
$LNG->ADMIN_THEME_IMAGE_DELETE_LABEL = 'Delete Image';
$LNG->ADMIN_THEME_REPLACE_IMAGE_LABEL = 'Replace Image:';
$LNG->ADMIN_THEME_IMAGE_HELP = '(minimum size 150px w x 100px h. Larger images will be scaled/cropped to this size)';

$LNG->NODE_NEWS_POSTED_ON = 'Posted on';
$LNG->HOME_NEWS_TITLE = "Recent News";
$LNG->ADMIN_MANAGE_NEWS_LINK = "Manage ".$LNG->NEWSS_NAME;
$LNG->ADMIN_MANAGE_NEWS_DELETE_ERROR = 'There was an issue deleting the '.$LNG->NEWS_NAME.' with the id:';
$LNG->ADMIN_NEWS_MISSING_NAME_ERROR = 'You must enter a '.$LNG->NEWS_NAME.' title.';
$LNG->ADMIN_NEWS_ID_ERROR  = 'Error passing '.$LNG->NEWS_NAME.' id.';
$LNG->ADMIN_NEWS_DELETE_QUESTION_PART1 = 'Are you sure you want to delete the '.$LNG->THEME_NAME;
$LNG->ADMIN_NEWS_DELETE_QUESTION_PART2 = '?';
$LNG->ADMIN_NEWS_DELETE_SUCCESS_PART1 = $LNG->NEWS_NAME;
$LNG->ADMIN_NEWS_DELETE_SUCCESS_PART2 = 'has now been deleted.';
$LNG->ADMIN_NEWS_TITLE = "Manage ".$LNG->NEWSS_NAME;
$LNG->ADMIN_NEWS_ADD_NEW_LINK = 'Add '.$LNG->NEWS_NAME;
$LNG->ADMIN_NEWS_NAME_LABEL = 'Title:';
$LNG->ADMIN_NEWS_DESC_LABEL = 'Description:';
$LNG->ADMIN_NEWS_TITLE_HEADING = $LNG->NEWS_NAME;
$LNG->ADMIN_NEWS_ACTION_HEADING = 'Action';
$LNG->ADMIN_NEWS_EDIT_LINK = 'edit';
$LNG->ADMIN_NEWS_DELETE_LINK = 'delete';

$LNG->ADMIN_USER_STATS_TITLE = 'Stats for';
$LNG->ADMIN_USER_STATS_NAME_HEADING = 'Name';
$LNG->ADMIN_USER_STATS_ITEM_HEADING = 'Item';
$LNG->ADMIN_USER_STATS_COUNT_HEADING = 'Count';
$LNG->ADMIN_USER_STATS_ACTION_HEADING = 'Action';
$LNG->ADMIN_USER_STATS_POPULAR_LINK_HEADING = 'Most Used Link Type';
$LNG->ADMIN_USER_STATS_VIEW_ALL = 'view all';
$LNG->ADMIN_USER_STATS_POPULAR_NODE_HEADING = 'Most Used Node Type';
$LNG->ADMIN_USER_STATS_POPULAR_TAG_HEADING = 'Most Used Tag';
$LNG->ADMIN_USER_STATS_TOP_TEN = 'top 10';
$LNG->ADMIN_USER_STATS_COMPARED_THINKING = 'Compared Thinking';
$LNG->ADMIN_USER_STATS_INFO_BROKER = 'Information Broker';
$LNG->ADMIN_USER_STATS_TOP_TEN_TAGS = 'Top 10 Tags';
$LNG->ADMIN_USER_STATS_TAG_HEADING = 'Tag';
$LNG->ADMIN_USER_STATS_COUNT_HEADING = 'Count';
$LNG->ADMIN_USER_STATS_LINK_TYPES_HEADING = 'Link Types';
$LNG->ADMIN_USER_STATS_NODE_TYPES_HEADING = 'Node Types';
$LNG->ADMIN_USER_STATS_COMPARED_THINKING = 'Compared Thinking';
$LNG->ADMIN_USER_STATS_INFORMATION_THINKING = 'Information Broker';
$LNG->ADMIN_USER_STATS_SUMMARY_TITLE = 'SUMMARY';
$LNG->ADMIN_USER_STATS_VOTE_TITLE = 'Item Voting';

$LNG->ADMIN_CRON_FOLLOW_NEW_FOLLOWER_MESSAGE = 'You have a new follower called';
$LNG->ADMIN_CRON_FOLLOW_USER_ACTIVITY_MESSAGE = 'There has been activity for';
$LNG->ADMIN_CRON_FOLLOW_SEE_ACTIVITY_LINK = 'See activity';
$LNG->ADMIN_CRON_FOLLOW_ACTIVITY_FOR = 'Activity for';
$LNG->ADMIN_CRON_FOLLOW_EXPLORE_LINK = 'Explore';
$LNG->ADMIN_CRON_FOLLOW_ON_THE = 'On the';
$LNG->ADMIN_CRON_FOLLOW_THIS_ITEM = 'this item';
$LNG->ADMIN_CRON_FOLLOW_STARTED = 'started following';
$LNG->ADMIN_CRON_FOLLOW_PROMOTED = 'promoted';
$LNG->ADMIN_CRON_FOLLOW_DEMOTED = 'demoted';
$LNG->ADMIN_CRON_FOLLOW_ADDED_THEME_TO = 'added this '.$LNG->THEME_NAME.' to';
$LNG->ADMIN_CRON_FOLLOW_ADDED = 'added';
$LNG->ADMIN_CRON_FOLLOW_EDITED = 'edited';
$LNG->ADMIN_CRON_FOLLOW_ADDED_RESOURCE = 'added the '.$LNG->RESOURCE_NAME;
$LNG->ADMIN_CRON_FOLLOW_ADDED_SUPPORTING_EVIDENCE = 'added Supporting '.$LNG->EVIDENCE_NAME;
$LNG->ADMIN_CRON_FOLLOW_ADDED_COUNTER_EVIDENCE = 'added Counter '.$LNG->EVIDENCE_NAME;
$LNG->ADMIN_CRON_FOLLOW_ASSOCIATED_EVIDENCE = 'associated this with the '.$LNG->EVIDENCE_NAME;
$LNG->ADMIN_CRON_FOLLOW_ASSOCIATED_WITH = 'associated this with the';
$LNG->ADMIN_CRON_FOLLOW_REMOVED_THEME_FROM  = 'remove this '.$LNG->THEME_NAME.' from';
$LNG->ADMIN_CRON_FOLLOW_REMOVED = 'removed';
$LNG->ADMIN_CRON_FOLLOW_REMOVED_RESOURCE = 'removed the '.$LNG->RESOURCE_NAME;
$LNG->ADMIN_CRON_FOLLOW_REMOVED_EVIDENCE = 'removed the '.$LNG->EVIDENCE_NAME;
$LNG->ADMIN_CRON_FOLLOW_REMOVED_ASSOCIATION = 'removed association with';
$LNG->ADMIN_CRON_FOLLOW_DATE_FROM_TO_PART1 = 'From';
$LNG->ADMIN_CRON_FOLLOW_DATE_FROM_TO_PART2 = 'To';
$LNG->ADMIN_CRON_FOLLOW_WEEKLY = 'Weekly';
$LNG->ADMIN_CRON_FOLLOW_WEEKLY_TITLE = 'Weekly Evidence Hub Activity Report';
$LNG->ADMIN_CRON_FOLLOW_WEEKLY_DIGEST_RUN = 'Weekly Digest for Activites on '.$CFG->SITE_TITLE.' Run';
$LNG->ADMIN_CRON_FOLLOW_MONTHLY = 'Monthly';
$LNG->ADMIN_CRON_FOLLOW_MONTHLY_TITLE = 'Monthly Evidence Hub Activity Report';
$LNG->ADMIN_CRON_FOLLOW_MONTHLY_DIGEST_RUN = 'Monthly Digest for Activites on '.$CFG->SITE_TITLE.' Run';
$LNG->ADMIN_CRON_FOLLOW_DAILY = 'Daily';
$LNG->ADMIN_CRON_FOLLOW_DAILY_TITLE = 'Daily Evidence Hub Activity Report';
$LNG->ADMIN_CRON_FOLLOW_DAILY_DIGEST_RUN = 'Daily Digest for Activites on '.$CFG->SITE_TITLE.' Run';
$LNG->ADMIN_CRON_FOLLOW_NO_DIGEST = 'No email digest for:';
$LNG->ADMIN_CRON_FOLLOW_UNSUBSCRIBE_PART1 = 'To stop receiving this email digest please login to the hub and uncheck \'Send email Alert of New Activity\' on your';
$LNG->ADMIN_CRON_FOLLOW_UNSUBSCRIBE_PART2 = $LNG->HEADER_MY_HUB_LINK.' home page';
$LNG->ADMIN_REGISTER_WELCOME = 'Welcome to the '.$CFG->SITE_TITLE;
$LNG->ADMIN_CREATE_USER_NODES_TITLE = 'Create User Nodes';
$LNG->ADMIN_CREATE_LINK_TYPES_TITLE = 'Create Link Types';
$LNG->ADMIN_CREATE_NODE_TYPES_TITLE = 'Create Node Types';
$LNG->ADMIN_CRON_RECENT_ACTIVITY_DIGEST_RUN = 'Recent Activite Digest on '.$CFG->SITE_TITLE.' Run';
$LNG->ADMIN_CRON_RECENT_ACTIVITY_NO_DIGEST = 'No recent activity digest for:';
$LNG->ADMIN_CRON_RECENT_ACTIVITY_TITLE = 'Evidence Hub Recent Activity Report';
$LNG->ADMIN_CRON_RECENT_ACTIVITY_MESSAGE = 'See below for the top 5 most recent items entered for each Evidence Hub Category.';
*/

/** HELP PAGES **/
/*
$LNG->HELP_NETWORKMAP_TITLE = 'Network Map';
$LNG->HELP_NETWORKMAP_BODY = '<b>Background:</b><br><br>&nbsp;&nbsp;&nbsp;';
$LNG->HELP_NETWORKMAP_BODY .= '<b>L-drag to pan</b><br>&nbsp;&nbsp;&nbsp;';
$LNG->HELP_NETWORKMAP_BODY .= '<b>R-click</b> to fit network on screen (Apple-Click on Macs)<br>&nbsp;&nbsp&nbsp;';
$LNG->HELP_NETWORKMAP_BODY .= '<b>R-drag to zoom in/out</b> (Apple-Drag on Macs)<br><br>';
$LNG->HELP_NETWORKMAP_BODY .= '<b>Ideas:</b><br><br>&nbsp;&nbsp;&nbsp;';
$LNG->HELP_NETWORKMAP_BODY .= '<b>L-click</b> to highlight what\'s connected<br>&nbsp;&nbsp;&nbsp;';
$LNG->HELP_NETWORKMAP_BODY .= '<b>L-click</b> to view/edit its profile<br>&nbsp;&nbsp;&nbsp;';
$LNG->HELP_NETWORKMAP_BODY .= '<b>Duplicate Ideas</b> (created by >1 user) have a border<br>&nbsp;&nbsp;&nbsp;';
$LNG->HELP_NETWORKMAP_BODY .= '<b>L-click duplicate Ideas</b> to view profiles in Idea List<br><br>';
$LNG->HELP_NETWORKMAP_BODY .= '<b>Connections:</b><br><br>&nbsp;&nbsp;&nbsp;';
$LNG->HELP_NETWORKMAP_BODY .= '<b>Mouse over blobs</b> to view an Idea\'s<br>&nbsp;&nbsp;&nbsp;';

$LNG->HELP_BUILDER_TITLE = 'Evidence Hub Toolbar';
$LNG->HELP_BUILDER_PARA1 = 'The Evidence Hub toolbar lets you enter data into the Evidence Hub while browsing the web.';
$LNG->HELP_BUILDER_GET_TITLE = 'How to get the toolbar';
$LNG->HELP_BUILDER_GET_LINK = 'Bookmark this link';
$LNG->HELP_BUILDER_USING_FIREFOX = 'If you are using <b>Firefox</b>, <b>Chrome</b> or <b>Safari</b> you can drag the above link to your browser Favourites toolbar.';
$LNG->HELP_BUILDER_USING_OPERA = 'If you are using <b>Opera</b>, right-click on the link above, select \'Bookmark Link...\'. You can then choose to \'Show on bookmarks bar\'.';
$LNG->HELP_BUILDER_USING_IE = '<b>Only available for IE 9+</b>: drag the above link to your browser Favourites toolbar but you will get a security warning message. Just select OK.';
$LNG->HELP_BUILDER_USING_IE_MORE_LINK = 'more info for IE 9';
$LNG->HELP_BUILDER_USING_IE_HIDE_LINK = 'hide';
$LNG->HELP_BUILDER_USING_IE_ERROR_TITLE = 'Annoying popup security message in IE 9';
$LNG->HELP_BUILDER_USING_IE_ERROR_MESSAGE_PART1 = 'If you see a warning similar to the one above when using our bookmarklet please follow these instructions:';
$LNG->HELP_BUILDER_USING_IE_ERROR_MESSAGE_PART2 = '1. In Internet Explorer, select Tools &gt; Internet Options.<br>';
$LNG->HELP_BUILDER_USING_IE_ERROR_MESSAGE_PART2 .= '2. Select the Security tab.<br>';
$LNG->HELP_BUILDER_USING_IE_ERROR_MESSAGE_PART2 .= '3. Select "Trusted Sites" (the big green tick).<br>';
$LNG->HELP_BUILDER_USING_IE_ERROR_MESSAGE_PART2 .= '4. Click the "Custom level..." button.<br>';
$LNG->HELP_BUILDER_USING_IE_ERROR_MESSAGE_PART2 .= '5. In the "Security Settings" dialog, scroll down to the "Miscellaneous" section.<br>';
$LNG->HELP_BUILDER_USING_IE_ERROR_MESSAGE_PART2 .= '6. Find this setting: "Websites in less privileged content zone can navigate into this zone" and select "Enable."<br>';
$LNG->HELP_BUILDER_USING_IE_ERROR_MESSAGE_PART2 .= '7. Click OK to close the dialog, then OK to close Internet Options.<br>';
$LNG->HELP_BUILDER_USING_IE_ERROR_MESSAGE_PART2 .= '8. Restart Internet Explorer.';

$LNG->HELP_BUILDER_WARNING = "NOTE: Due to changes in security policies on browsers it is now possible for websites to block bookmarklets like ours that load content from a another website from working on their web pages.
					Facebook and Twitter are two examples of sites that have implemented this policy.
					On these sites, clicking our bookmarklet shortcut will currently do nothing, so it may appear broken, but it is just blocked.
					Your browser may also block the bookmarklet, so you may have to override your browser security settings to get it to work.
					We are investigating alternatives for the future like browser specific plugins.
					For now, this bookmarklet will still work on the majority of websites that have not implemented this policy.";
*/

/** CORE **/
$LNG->CORE_UNKNOWN_USER_ERROR = 'User unknown';
$LNG->CORE_NOT_IMAGE_ERROR = 'Sorry you can only upload images.';
$LNG->CORE_NOT_IMAGE_TOO_LARGE_ERROR = 'Sorry image file is too large.';
$LNG->CORE_NOT_IMAGE_UPLOAD_ERROR = 'An error occured uploading the image';
$LNG->CORE_NOT_IMAGE_RESIZE_ERROR = 'Error resizing image';
$LNG->CORE_NOT_IMAGE_SCALE_ERROR = 'Error scaling image.';

$LNG->CORE_SESSION_OK = 'OK';
$LNG->CORE_SESSION_INVALID = 'Session Invalid';

$LNG->CORE_AUDIT_NOT_XML_ERROR = 'Not a valid XML file';
$LNG->CORE_AUDIT_CONNECTION_NOT_FOUND_ERROR = 'Connection not found';
$LNG->CORE_AUDIT_NODE_NOT_FOUND_ERROR = 'Node not found';
$LNG->CORE_AUDIT_URL_NOT_FOUND_ERROR = 'URL not found';
$LNG->CORE_AUDIT_CONNECTION_ID_MISSING_ERROR = 'Connection id data missing - data could not be loaded';
$LNG->CORE_AUDIT_CONNECTION_DATA_MISSING_ERROR = 'Connection data missing';
$LNG->CORE_AUDIT_NODE_ID_MISSING_ERROR = 'Node id data missing - node could not be loaded';
$LNG->CORE_AUDIT_NODE_DATA_MISSING_ERROR = 'Node data missing';
$LNG->CORE_AUDIT_URL_ID_MISSING_ERROR = 'Url id data missing - url could not be loaded';
$LNG->CORE_AUDIT_URL_DATA_MISSING_ERROR = 'Url data missing';
$LNG->CORE_AUDIT_TAG_ID_MISSING_ERROR = 'Tag id data missing - Tag could not be loaded';
$LNG->CORE_AUDIT_TAG_DATA_MISSING_ERROR = 'Tag data missing';
$LNG->CORE_AUDIT_USER_ID_MISSING_ERROR = 'User id data missing - user could not be loaded';
$LNG->CORE_AUDIT_USER_DATA_MISSING_ERROR = 'User data missing';
$LNG->CORE_AUDIT_GROUP_ID_MISSING_ERROR = 'Group id data missing - Group could not be loaded';
$LNG->CORE_AUDIT_GROUP_DATA_MISSING_ERROR = 'Group data missing';
$LNG->CORE_AUDIT_ROLE_ID_MISSING_ERROR = 'Node Type id data missing - Node Type could not be loaded';
$LNG->CORE_AUDIT_ROLE_DATA_MISSING_ERROR = 'Node Type data missing';
$LNG->CORE_AUDIT_LINK_ID_MISSING_ERROR = 'Linktype id data missing - Link Type could not be loaded';
$LNG->CORE_AUDIT_LINK_DATA_MISSING_ERROR = 'Link Type data missing';

$LNG->CORE_FORMAT_NOT_IMPLEMENTED_MESSAGE = 'Not yet implemented';
$LNG->CORE_FORMAT_INVALID_SELECTION_ERROR = 'Invalid format selection';

$LNG->CORE_HELP_ERRORCODES_TITLE = 'Help - API Error codes';
$LNG->CORE_HELP_ERRORCODES_CODE_HEADING = 'Code';
$LNG->CORE_HELP_ERRORCODES_MEANING_HEADING = 'Meaning';

/**
 * THESE ARE ERRORE MESSAGE SENT FROM THE API CODE CODE
 * YOU MAY CHOOSE NOT TO TRANSLATE THESE
 */
$LNG->ERROR_REQUIRED_PARAMETER_MISSING_MESSAGE = "Required parameter missing";
$LNG->ERROR_INVALID_METHOD_SPECIFIED_MESSAGE = "Invalid or no method specified";
$LNG->ERROR_INVALID_ORDERBY_MESSAGE = "Invalid order by selection";
$LNG->ERROR_INVALID_SORT_MESSAGE = "Invalid sort selection";
$LNG->ERROR_BLANK_NODEID_MESSAGE = "The item id cannot be blank.";
$LNG->ERROR_ACCESS_DENIED_MESSAGE = "Access denied";
$LNG->ERROR_LOGIN_FAILED_MESSAGE = "Sign In failed: Your email or password are wrong. Please try again.";
$LNG->ERROR_LOGIN_FAILED_UNAUTHORIZED_MESSAGE = "Sign In failed: This account has not yet been authorized";
$LNG->ERROR_LOGIN_FAILED_SUSPENDED_MESSAGE = "Sign In failed: This account has been suspended";
$LNG->ERROR_LOGIN_FAILED_UNVALIDATED_MESSAGE = "Sign In failed: This account has not completed the registration process by having its Email address validated.";
$LNG->ERROR_LOGIN_FAILED_EXTERNAL_MESSAGE = "The account with the given email address was created with an external service and does not have a local password.<br>You must sign in to this account using:";

$LNG->ERROR_INVALID_METHOD_FOR_TYPE_MESSAGE = "Method not allowed for this format type";
$LNG->ERROR_DUPLICATION_MESSAGE = "Duplication Error";
$LNG->ERROR_INVALID_EMAIL_FORMAT_MESSAGE = "Invalid email format";
$LNG->ERROR_DATABASE_MESSAGE = "Database error";
$LNG->ERROR_USER_NOT_FOUND_MESSAGE = 'User not found in database';
$LNG->ERROR_URL_NOT_FOUND_MESSAGE = 'Url not found in database';
$LNG->ERROR_TAG_NOT_FOUND_MESSAGE = 'Tag not found in database';
$LNG->ERROR_ROLE_NOT_FOUND_MESSAGE = 'Node Type (Role) not found in database';
$LNG->ERROR_LINKTYPE_NOT_FOUND_MESSAGE = 'Link Type not found in database';
$LNG->ERROR_NODE_NOT_FOUND_MESSAGE = 'Node not found in database';
$LNG->ERROR_CONNECTION_NOT_FOUND_MESSAGE = 'Connection not found in database';
$LNG->ERROR_INVALID_CONNECTION_MESSAGE = "Invalid connection combination. Does not match the datamodel.";
$LNG->ERROR_INVALID_PARAMETER_TYPE_MESSAGE = "Invalid parameter type";

/*
$LNG->RECOMMENDATION_ORG_THEMES = $LNG->ORGS_NAME.'/'.$LNG->PROJECTS_NAME.' with shared '.$LNG->THEMES_NAME;
$LNG->RECOMMENDATION_ISSUE_THEMES = $LNG->ISSUES_NAME.' with shared '.$LNG->THEMES_NAME;
$LNG->RECOMMENDATION_SOLUTION_THEMES = $LNG->SOLUTIONS_NAME.' with shared '.$LNG->THEMES_NAME;
$LNG->RECOMMENDATION_CLAIM_THEMES = $LNG->CLAIMS_NAME.' with shared '.$LNG->THEMES_NAME;
$LNG->RECOMMENDATION_ISSUE_TAGS = $LNG->ISSUES_NAME.' with Shared Tags';
*/

/** SEE ALSO RELATED ITEMS **/
/*
$LNG->FORM_SELECT_EXISTING_ITEM = 'Select Existing Item';
$LNG->FORM_LABEL_SEE_ALSO = 'See Also';
$LNG->EXPLORE_SEE_ALSO = 'See Also';
$LNG->CONNECT_SEE_ALSO = "All as 'See Also'";
$LNG->WIDGET_LOADING_SEE_ALSO = 'Loading See Also items...';
$LNG->DELETE_CHECK_MESSAGE_SEE_ALSO = 'Are you sure you want to remove the See Also item';
*/

/** NEW USER HOME PAGE ARRANGEMENT **/
//$LNG->TAB_USER_DATA = 'My Data';
//$LNG->TAB_USER_SOCIAL = 'My Social Network';

//$LNG->TAB_HOME_USER_STRAPLINE = "Welcome to the home page for: ";

/** USER INNER TABS **/
//$LNG->TAB_VIEW_GEOMAP_USER = 'Geo Map - Users';
//$LNG->TAB_VIEW_GEOMAP_USERNODE = 'Geo Map - User Entries';

/** NEW GEOMAP FUNCTION */
//$LNG->ZOOM_TO = 'Zoom to';

/** SEARCH HINT **/
/*
$LNG->MAIN_SEARCH_INFO_HINT = "<div  style='padding:10px;'>The default search will separate words using the spaces and perform an OR search, e.g. <b>'school system'</b> will search for the words <b>'school' OR 'system'</b> in either the item title, item description, item tags or any associated web clip texts.";
$LNG->MAIN_SEARCH_INFO_HINT .= "<br><br>Use a '+' between words is you wish to perform an AND search, e.g. <b>'school+system'</b> will search for both the words <b>'school' and 'system'</b> somewhere in either the item title, item description, item tags or any associated web clip texts.";
$LNG->MAIN_SEARCH_INFO_HINT .= "<br><br>Use double quotes around the search string to perform a phrase search, e.g. <b>\"school system\"</b> will search for the <b>exact phrase 'school system'</b> in either the item title, item description, item tags or any associated web clip texts.</div>";
*/

/** DEBATE/KNOWLEDGE TREE PAGE **/
/*
$LNG->DEBATE_TREE_HEADING = 'Explore the Knowledge';
$LNG->DEBATE_ADD_HEADING = 'Add Your Knowledge';

$LNG->DEBATE_SWITCH_WIDER_BUTTON = '(View wider knowledge trees)';
$LNG->DEBATE_SWITCH_WIDER_HINT = 'See the full and wider knowledge trees that the current item is a part of. This can take a while to load.';
$LNG->DEBATE_SWITCH_NARROW_BUTTON = '(View narrower knowledge trees)';
$LNG->DEBATE_SWITCH_NARROW_HINT = 'See only the immediate knowledge trees that the current item is a part of';
$LNG->DEBATE_MISSING_SELECTED_ITEM_ERROR = 'The currently selected item is not in any narrower knowledge trees.';
$LNG->DEBATE_MISSING_ADDED_ITEM_QUESTION = 'The new item you have just added will not appear in the current knowledge tree.\n\nWould you like to refocus the knowledge tree on the new item?\n\n(Press Cancel to stay on this page)';
$LNG->DEBATE_HIGHLIGHT_ADDED_TEXT = '';
$LNG->DEBATE_LOADING = '(Loading knowledge trees content...)';
$LNG->DEBATE_WIDER_LOADING = '(Loading wider knowledge trees content. This may take a while...)';

$LNG->DEBATE_NO_DEBATES_CHALLENGE = "Why not start a tree by adding your experience below";
$LNG->DEBATE_NO_DEBATES_ISSUE = "Why not start a tree by adding your experience below";
$LNG->DEBATE_NO_DEBATES_SOLUTION = "Why not start a tree by adding your experience below";
$LNG->DEBATE_NO_DEBATES_CLAIM = "Why not start a tree by adding your experience below";
$LNG->DEBATE_NO_DEBATES_EVIDENCE = "Why not start a tree by adding your experience below";
$LNG->DEBATE_NO_DEBATES_RESOURCE = "";

$LNG->DEABTES_COUNT_MESSAGE_PART1 = 'This item is contained in';
$LNG->DEABTES_COUNT_MESSAGE_PART2 = 'Knowledge tree(s)';
$LNG->DEABTES_COUNT_THEME_MESSAGE_PART1 = 'This '.$LNG->THEME_NAME.' is on all the items forming'; // number will be added at this point
$LNG->DEABTES_COUNT_THEME_MESSAGE_PART2 = 'Knowledge tree(s).';
$LNG->DEABTES_COUNT_SEARCH_MESSAGE_PART1 = 'This search produces ';
$LNG->DEABTES_COUNT_SEARCH_MESSAGE_PART2 = 'Knowledge tree(s)';
$LNG->DEABTES_HOME_BUTTON_HINT = 'Click to explore Full Details on this item';

//in debate tree menu - new hints
$LNG->NODE_RELEVANCE_ADD_MENU_HINT = 'Add why this is a relevant association to the above';
$LNG->NODE_RELEVANCE_EDIT_MENU_HINT = 'Edit why this is a relevant association to the above';

$LNG->NODE_DEBATE_TOGGLE = 'Show/hide the knowledge tree';
$LNG->NODE_DEBATE_ADD_HINT = '- Click to add to the knowledge around this item';
$LNG->NODE_DEBATE_BUTTON_TEXT = 'Knowledge Trees';
$LNG->NODE_DEBATE_BUTTON_HINT = 'Go and explore the Knowledge trees around this item';
$LNG->NODE_DEBATE_REFOCUS_MENU_TEXT = 'Knowledge Trees';
$LNG->NODE_DEBATE_REFOCUS_MENU_HINT = 'Go and explore the Knowledge trees around this item';
$LNG->NODE_DEBATE_ADD_TO_MENU_TEXT = 'Add';
$LNG->NODE_DEBATE_ADD_TO_PRO_MENU_TEXT = 'Add Supporting '.$LNG->EVIDENCE_NAME;
$LNG->NODE_DEBATE_ADD_TO_CON_MENU_TEXT = 'Add Counter '.$LNG->EVIDENCE_NAME;
$LNG->NODE_DEBATE_ADD_TO_SOLUTION_MENU_TEXT = 'Add '.$LNG->SOLUTION_NAME;
$LNG->NODE_DEBATE_ADD_TO_RESOURCE_MENU_TEXT = 'Add '.$LNG->RESOURCE_NAME;
$LNG->NODE_DEBATE_ADD_TO_CLAIM_MENU_TEXT = 'Add '.$LNG->CLAIM_NAME;
$LNG->NODE_DEBATE_ADD_TO_ISSUE_MENU_TEXT = 'Add '.$LNG->ISSUE_NAME;

$LNG->NODE_DEBATE_ADD_TO_MENU_HINT = 'Add your knowledge around this item';
$LNG->NODE_DEBATE_TREE_COUNT_HINT = 'The number of entries currently added to this knowledge tree';

$LNG->NODE_GOTO_PARENT_HINT = '- Click to scroll to this';
*/

/** NEW WIDGET PAGE SECTIONS **/
/*
$LNG->EXPLORE_WIDGET_RECOMMENDATIONS_HEADING = 'Recommendations';
$LNG->EXPLORE_WIDGET_ADDITIONAL_RELATIONS_HEADING = 'Additional Relations';
$LNG->EXPLORE_WIDGET_EXTRAS = 'Extras';
*/

/** GLOBAL STATS **/
/*
$LNG->HOMEPAGE_STATS_LINK = "Evidence Hub Analytics";

$LNG->STATS_GLOBAL_TITLE = 'Evidence Hub Global Analytics';
$LNG->STATS_GLOBAL_TAB_OVERVIEW = 'Overview';
$LNG->STATS_GLOBAL_TAB_REGISTER = 'User Registration';
$LNG->STATS_GLOBAL_TAB_IDEAS = 'Items Created';
$LNG->STATS_GLOBAL_TAB_CONNS = 'Connections Created';
$LNG->STATS_GLOBAL_TAB_TAGS = 'All Tags';
$LNG->STATS_GLOBAL_TAB_VOTES = 'Voting';

$LNG->STATS_GLOBAL_VOTES_TOP_NODES = 'Top 10 Voted ON Items';
$LNG->STATS_GLOBAL_VOTES_TOP_FOR_NODES = "Top 10 Voted FOR Items";
$LNG->STATS_GLOBAL_VOTES_TOP_AGAINST_NODES = "Top 10 Voted AGAINST Items";
$LNG->STATS_GLOBAL_VOTES_TOP_NODES_TITLE_HEADING = 'Name';
$LNG->STATS_GLOBAL_VOTES_TOP_NODES_TOTAL_HEADING = 'Total';
$LNG->STATS_GLOBAL_VOTES_TOP_NODES_FOR_HEADING = 'For';
$LNG->STATS_GLOBAL_VOTES_TOP_NODES_AGAINST_HEADING = 'Against';
$LNG->STATS_GLOBAL_VOTES_TOP_NODES_CATEGORY_HEADING = "Category";
$LNG->STATS_GLOBAL_VOTES_TOP_VOTERS = 'Top 10 Voters';
$LNG->STATS_GLOBAL_VOTES_TOP_VOTERS_FOR = 'Top 10 Voters FOR';
$LNG->STATS_GLOBAL_VOTES_TOP_VOTERS_AGAINST = 'Top 10 Voters AGAINST';
$LNG->STATS_GLOBAL_VOTES_VOTING_MENU_TITLE = 'View Top Item Voting';
$LNG->STATS_GLOBAL_VOTES_VOTERS_MENU_TITLE = 'View Top Item Voters';
$LNG->STATS_GLOBAL_VOTES_ALL_VOTES_MENU_TITLE = 'View All Item Voting';
$LNG->STATS_GLOBAL_VOTES_BACK_UP = 'Go back to options menu';
$LNG->STATS_GLOBAL_VOTES_MENU_TITLE = 'Voting Stats';
$LNG->STATS_GLOBAL_ITEM_VOTES_MENU_TITLE = 'Items Voting Stats';
$LNG->STATS_GLOBAL_CONNECTION_VOTES_MENU_TITLE = 'Connection Voting Stats';
$LNG->STATS_GLOBAL_ALL_VOTES_MENU_TITLE = 'All Voting Stats';
$LNG->STATS_GLOBAL_VOTES_ALL_VOTING_TITLE = 'All Item Voting';
$LNG->STATS_GLOBAL_VOTES_ITEM_FOR_HEADING = 'Item For';
$LNG->STATS_GLOBAL_VOTES_ITEM_AGAINST_HEADING = 'Item Against';
$LNG->STATS_GLOBAL_VOTES_CONN_FOR_HEADING = 'Connection For';
$LNG->STATS_GLOBAL_VOTES_CONN_AGAINST_HEADING = 'Connection Against';

$LNG->STATS_GLOBAL_OVERVIEW_HEADER_TYPE = 'Type';
$LNG->STATS_GLOBAL_OVERVIEW_HEADER_NAME = 'Name';
$LNG->STATS_GLOBAL_OVERVIEW_HEADER_COUNT = 'Count';
$LNG->STATS_GLOBAL_OVERVIEW_USED_LINKS_LABEL = 'Most used Link Type';
$LNG->STATS_GLOBAL_OVERVIEW_USED_IDEAS_LABEL = 'Most used Item Type';
$LNG->STATS_GLOBAL_OVERVIEW_CONNECTED_IDEA_LABEL = 'Most connected Item';
$LNG->STATS_GLOBAL_OVERVIEW_TOP_CONN_BUILDERS = 'Top Connection Builders';
$LNG->STATS_GLOBAL_OVERVIEW_TOP_IDEA_CREATORS = 'Top Item Creators';
$LNG->STATS_GLOBAL_OVERVIEW_TOP_CONN_BUILDERS_LINKS = 'Top Connection Builders - Their LinkType Usage';
$LNG->STATS_GLOBAL_OVERVIEW_YOUR_STATS_PART1 = 'To view your personal analytics go to your';
$LNG->STATS_GLOBAL_OVERVIEW_YOUR_STATS_PART2 = 'home page';
$LNG->STATS_GLOBAL_OVERVIEW_USED_TAG_LABEL = 'Most used Tag';
$LNG->STATS_GLOBAL_OVERVIEW_USED_THEME_LABEL = 'Most used '.$LNG->THEME_NAME;

$LNG->STATS_GLOBAL_REGISTER_TOTAL_LABEL = 'Total user count';
$LNG->STATS_GLOBAL_REGISTER_HEADER_NAME = 'Name';
$LNG->STATS_GLOBAL_REGISTER_HEADER_DATE = 'Date';
$LNG->STATS_GLOBAL_REGISTER_HEADER_DESC = 'Description';
$LNG->STATS_GLOBAL_REGISTER_HEADER_WEBSITE = 'Website';
$LNG->STATS_GLOBAL_REGISTER_HEADER_LOCATION = 'Location';
$LNG->STATS_GLOBAL_REGISTER_HEADER_INTEREST = 'Interest';
$LNG->STATS_GLOBAL_REGISTER_HEADER_LAST_LOGIN = 'Last Sign In';
$LNG->STATS_GLOBAL_REGISTER_GRAPH_MONTH_TITLE = 'User Registration By Month';
$LNG->STATS_GLOBAL_REGISTER_GRAPH_WEEK_TITLE = 'User Registration By Week';
$LNG->STATS_GLOBAL_REGISTER_GRAPH_X_LABEL = 'Number of Registrations';
$LNG->STATS_GLOBAL_REGISTER_GRAPH_MONTH_Y_LABEL = 'Months (from';
$LNG->STATS_GLOBAL_REGISTER_GRAPH_WEEK_Y_LABEL = 'Weeks (from';

$LNG->STATS_GLOBAL_IDEAS_TOTAL_LABEL = 'Total count';
$LNG->STATS_GLOBAL_IDEAS_GRAPH_WEEK_TITLE  ='Weekly Item Creation for the last Year';
$LNG->STATS_GLOBAL_IDEAS_GRAPH_MONTH_TITLE  ='Monthly Item Creation for the last Year';
$LNG->STATS_GLOBAL_IDEAS_GRAPH_MONTH_Y_LABEL = 'Months (from';
$LNG->STATS_GLOBAL_IDEAS_GRAPH_WEEK_Y_LABEL = 'Weeks (from';
$LNG->STATS_GLOBAL_IDEAS_GRAPH_X_LABEL = 'Number of Ideas';

$LNG->STATS_GLOBAL_CONNS_TOTAL_LABEL = 'Total connection count';
$LNG->STATS_GLOBAL_IDEAS_MONTHLY_TOTAL_LABEL = 'Monthly Total';
$LNG->STATS_GLOBAL_CONNS_GRAPH_WEEK_TITLE  ='Weekly Connection Creation for the last Year';
$LNG->STATS_GLOBAL_CONNS_GRAPH_MONTH_TITLE  ='Monthly Connection Creation for the last Year';
$LNG->STATS_GLOBAL_CONNS_GRAPH_MONTH_Y_LABEL = 'Months (from';
$LNG->STATS_GLOBAL_CONNS_GRAPH_WEEK_Y_LABEL = 'Weeks (from';
$LNG->STATS_GLOBAL_CONNS_GRAPH_X_LABEL = 'Number of Connections';
*/

/** BIBTEX IMPORT **/
/*
$LNG->IMPORT_BIBTEX_TITLE = 'Import from Bib TeX';
$LNG->IMPORT_BIBTEX_HELP_LINK = 'help';
$LNG->IMPORT_BIBTEX_FILE_UPLOAD_ERROR = 'An error occured uploading the file';
$LNG->IMPORT_BIBTEX_NO_FILE = 'You must select a file first.';
$LNG->IMPORT_BIBTEX_FORM_MESSAGE = 'Please select the Bib TeX file to import.';
$LNG->IMPORT_BIBTEX_IMPORT_BUTTON = 'Import';
$LNG->IMPORT_BIBTEX_PROBLEMS_ERROR = 'The following problems were found during the upload, please try again:';
$LNG->IMPORT_BIBTEX_SUCCESS_MESSAGE = 'The file was sucessfully uploaded and imported:';
$LNG->IMPORT_BIBTEX_FILE_LABEL = 'Bib TeX File:';
$LNG->IMPORT_BIBTEX_TYPE_ERROR = 'The file to import must be a bibtext file ending in .bib';
$LNG->IMPORT_BIBTEX_LOADING_DATA = '( Importing Bib TeX data... Note: time taken will vary depending on size of the import file )';
$LNG->IMPORT_BIBTEX_THEME_FORM_HINT = '(compulsory) - Select at least one '.$LNG->THEME_NAME.' to associate with all the publications that are being imported. You can enter more than one.';
$LNG->IMPORT_BIBTEX_ITEM_ADDED_MESSAGE = 'Item added:';
$LNG->IMPORT_BIBTEX_REQUIRED_FIELDS_MESSAGE_PART1 = '(fields with a';
$LNG->IMPORT_BIBTEX_REQUIRED_FIELDS_MESSAGE_PART2 = 'are compulsory)';
$LNG->IMPORT_BIBTEX_GOTO_RESOURCES = 'View my Resources';
*/

/** SPAM REPORTING **/
/*
$LNG->SPAM_CONFIRM_MESSAGE_PART1= 'Are you sure you want to report';
$LNG->SPAM_CONFIRM_MESSAGE_PART2= 'as Spam / Inappropriate?';
$LNG->SPAM_SUCCESS_MESSAGE = 'has been reported as spam';
$LNG->SPAM_REPORTED_TEXT = 'Reported as Spam';
$LNG->SPAM_REPORTED_HINT = 'This has been reported as Spam / Inappropriate content';
$LNG->SPAM_REPORT_TEXT = 'Report as Spam';
$LNG->SPAM_REPORT_HINT = 'Report this as Spam / Inappropriate content';
$LNG->SPAM_LOGIN_REPORT_TEXT = 'Sign In to Report as Spam';
$LNG->SPAM_LOGIN_REPORT_HINT = 'Sign In to Report this as Spam / Inappropriate content';
$LNG->SPAM_ADMIN_MANAGER_SPAM_LINK = "Reported Items";
$LNG->SPAM_ADMIN_TITLE = "Item Report Manager";
$LNG->SPAM_ADMIN_ID_ERROR = "Can not process request as nodeid is missing";
$LNG->SPAM_ADMIN_TABLE_HEADING0 = "Reported By";
$LNG->SPAM_ADMIN_TABLE_HEADING1 = "Title";
$LNG->SPAM_ADMIN_TABLE_HEADING2 = "Action";
$LNG->SPAM_ADMIN_DELETE_CHECK_MESSAGE = "Are you sure you want to delete the item?: ";
$LNG->SPAM_ADMIN_RESTORE_CHECK_MESSAGE = "Are you sure you want to set as NOT SPAM?: ";
$LNG->SPAM_ADMIN_RESTORE_BUTTON = "Not Spam";
$LNG->SPAM_ADMIN_DELETE_BUTTON = "Delete";
$LNG->SPAM_ADMIN_VIEW_BUTTON = "View Details";
$LNG->SPAM_ADMIN_NONE_MESSAGE = 'There are currently no items reported as Spam / Inappropriate';

$LNG->SPAM_USER_REPORTED = 'User has been reported as a Spammer / Inappropriate';
$LNG->SPAM_USER_REPORT = 'Report this '.$LNG->USER_NAME.' as a Spammer / Inappropriate';
$LNG->SPAM_USER_LOGIN_REPORT = 'Login to report this User or Group as Spam / Inappropriate';
$LNG->SPAM_USER_REPORTED_ALT = 'Reported';
$LNG->SPAM_USER_REPORT_ALT = 'Report';
$LNG->SPAM_USER_LOGIN_REPORT_ALT = 'Login to Report';
$LNG->SPAM_USER_ADMIN_TABLE_HEADING0 = "Reported By";
$LNG->SPAM_USER_ADMIN_TABLE_HEADING1 = $LNG->USER_NAME." Name";
$LNG->SPAM_USER_ADMIN_TABLE_HEADING2 = "Action";
$LNG->SPAM_USER_ADMIN_VIEW_BUTTON = "View ".$LNG->USER_NAME." Home";
$LNG->SPAM_USER_ADMIN_VIEW_HINT = "Open a new Window showing this ".$LNG->USER_NAME."'s home page";
$LNG->SPAM_USER_ADMIN_RESTORE_BUTTON = "Restore Account";
$LNG->SPAM_USER_ADMIN_RESTORE_HINT = "Restore this ".$LNG->USER_NAME." account to active";
$LNG->SPAM_USER_ADMIN_DELETE_BUTTON = "Delete Account";
$LNG->SPAM_USER_ADMIN_DELETE_HINT = "Delete this ".$LNG->USER_NAME." account and all their data";
$LNG->SPAM_USER_ADMIN_SUSPEND_BUTTON = "Suspend Account";
$LNG->SPAM_USER_ADMIN_SUSPEND_HINT = "Suspend this ".$LNG->USER_NAME." account and prevent them signing in";
$LNG->SPAM_USER_ADMIN_DELETE_CHECK_MESSAGE_PART1 = "Are you sure you want to delete the ".$LNG->USER_NAME.": ";
$LNG->SPAM_USER_ADMIN_DELETE_CHECK_MESSAGE_PART2 = "Be warned: all their data will be permanently deleted. If you have not done so, you should check their contributions first by clicking '".$LNG->SPAM_USER_ADMIN_VIEW_BUTTON."'";;
$LNG->SPAM_USER_ADMIN_RESTORE_CHECK_MESSAGE_PART1 = "Are you sure you want to restore the account of: ";
$LNG->SPAM_USER_ADMIN_RESTORE_CHECK_MESSAGE_PART2 = "This will remove this ".$LNG->USER_NAME." from this list";
$LNG->SPAM_USER_ADMIN_SUSPEND_CHECK_MESSAGE = "Are you sure you want to suspend the account of: ";
$LNG->SPAM_USER_ADMIN_NONE_MESSAGE = 'There are currently no ".$LNG->USERS_NAME." reported as Spammers / Inappropriate';
$LNG->SPAM_USER_ADMIN_TITLE = "User Report Manager";
$LNG->SPAM_USER_ADMIN_MANAGER_SPAM_LINK = "Reported ".$LNG->USERS_NAME;
$LNG->SPAM_USER_ADMIN_ID_ERROR = "Can not process request as id is missing";
$LNG->SPAM_USER_ADMIN_NONE_SUSPENDED_MESSAGE = 'There are currently no ".$LNG->USERS_NAME." suspended';
$LNG->SPAM_USER_ADMIN_SPAM_TITLE = $LNG->USER_NAME.' Reported';
$LNG->SPAM_USER_ADMIN_SUSPENDED_TITLE = $LNG->USER_NAME.' Suspended';
*/

/** HISTORY BAR **/
//$LNG->HISTORY_ITEM_HINT = 'Click to explore';

/** EXTERNAL LOGIN **/
/*
$LNG->LOGIN_EXTERNAL_ERROR_HYBRIDAUTH_0 = 'Unspecified error.';
$LNG->LOGIN_EXTERNAL_ERROR_HYBRIDAUTH_1 = 'Hybriauth configuration error.';
$LNG->LOGIN_EXTERNAL_ERROR_HYBRIDAUTH_2 = 'Provider not properly configured.';
$LNG->LOGIN_EXTERNAL_ERROR_HYBRIDAUTH_3 = 'Unknown or disabled provider.';
$LNG->LOGIN_EXTERNAL_ERROR_HYBRIDAUTH_4 = 'Missing provider application credentials.';
$LNG->LOGIN_EXTERNAL_ERROR_HYBRIDAUTH_5 = 'Authentication failed. The user has canceled the authentication or the provider refused the connection.';
$LNG->LOGIN_EXTERNAL_ERROR_HYBRIDAUTH_6 = 'User profile request failed. Most likely the user is not connected to the provider and he should try to authenticate again';
$LNG->LOGIN_EXTERNAL_ERROR_HYBRIDAUTH_7 = 'User not connected to the provider.';

$LNG->LOGIN_EXTERNAL_ERROR_ACCOUNT_UNVALIDATED = 'An Evidence Hub '.$LNG->USER_NAME.' account already exists on this site using the email address from your external profile, but that user account has not completed the registration process.<br>If you own that user account you need to reply to the email you where sent to complete your registration, before you can Sign In.';
$LNG->LOGIN_EXTERNAL_ERROR_ACCOUNT_UNVALIDATED_EXISTING = 'An Evidence Hub '.$LNG->USER_NAME.' account already exists on this site using the email address from your external profile, but that Evidence Hub user account has not had the email address verify yet.<br><br>If you own that Evidence Hub user account you first need to <a href="'.$CFG->homeAddress.'ui/pages/login.php">Sign In</a> using that account and verify your email address from your profile page, before you can use any external services to Sign In to this Hub in the future.';
$LNG->LOGIN_EXTERNAL_ERROR_ACCOUNT_UNAUTHORIZED = 'An Evidence Hub '.$LNG->USER_NAME.' account already exists using the email address from your external profile, however that account is awaiting authorization, so we cannot log you in at this time.';
$LNG->LOGIN_EXTERNAL_ERROR_ACCOUNT_SUSPENDED = 'An Evidence Hub '.$LNG->USER_NAME.' account already exists on this site using the email address on your external profile, however the account has currently been suspended, so we cannot log you in at this time.';
$LNG->LOGIN_EXTERNAL_ERROR_ACCOUNT_PROVIDER_UNVALIDATED = 'It seems you have tried to sign in with'; // Provder service name will be inserted here .e.g Facebook, Yahoo, Google etc.
$LNG->LOGIN_EXTERNAL_ERROR_ACCOUNT_PROVIDER_UNVALIDATED_PART2 = 'before but did not complete the email validation required.';
$LNG->LOGIN_EXTERNAL_ERROR_ACCOUNT_PROVIDER_UNVALIDATED_PART2 .= '<br><br>Please respond to the email you where sent, before you try to Sign In with this service again.';
$LNG->LOGIN_EXTERNAL_ERROR_ACCOUNT_PROVIDER_UNVALIDATED_PART2 .= '<br><br>Alternatively, request another validation email by clicking the button below.';
$LNG->LOGIN_EXTERNAL_ERROR_USER_LOAD_FAILED = 'Failed to load user acount: ';
$LNG->LOGIN_EXTERNAL_ERROR_REGISTRATION_CLOSED = "Based on the email address given we can see that you do not have an account with us yet.<br><br>Unfortunately registration on this site is currently by invitation only.";
$LNG->LOGIN_EXTERNAL_ERROR_REQUIRES_AUTHORISATION = 'Based on the email address given we can see that you do not have an account with us yet.<br><br>This Evidence Hub currently requires registration requests to be authorised.<br>So please go to the <a href="'.$CFG->homeAddress.'ui/pages/registerrequest.php">Sign Up</a> page and complete the registration request form.';

$LNG->LOGIN_EXTERNAL_FIRST_TIME = 'We can see that this is the first time you have tried to sign in to this site using'; // Provder service name will be inserted here .e.g Facebook, Yahoo, Google etc.
$LNG->LOGIN_EXTERNAL_ERROR_EMAIL_UNVALIDATED_PART1 = '<br><br>Unfortunately the email address on the profile information they hold on you has not been verified by them. So before we can associated this external profile to an account in our Hub we need to validate the email address.<br><br>Therefore you have now been sent an email. Please click on the link in the email to complete the registration of your'; // Provder service name will be inserted here .e.g Facebook, Yahoo, Google etc.
$LNG->LOGIN_EXTERNAL_ERROR_EMAIL_UNVALIDATED_PART2 = 'profile on this Hub.';

$LNG->LOGIN_EXTERNAL_ERROR_NO_EMAIL_PART1 = '<br><br>Unfortunately'; // Provder service name will be inserted here .e.g Facebook, Yahoo, Google etc.
$LNG->LOGIN_EXTERNAL_ERROR_NO_EMAIL_PART2 = 'has not given us your email address, so we cannot check if you have an account with us already or create a new one if required.<br><br>Therefore, please enter the Email address you wish to use on this Evidence Hub below and press Login.';

$LNG->LOGIN_EXTERNAL_EMAIL_VERIFICALTION_MESSAGE = 'You will shortly receive an email.';
$LNG->LOGIN_EXTERNAL_EMAIL_VERIFICALTION_MESSAGE .= '<br>You must click on the link inside to complete your registration on this Hub.';

$LNG->LOGIN_EXTERNAL_EMAIL_VERIFICALTION_MESSAGE2 = 'There was no existing Hub user account for the email address on your external profile, so we have now created one and associated it to that external profile.';
$LNG->LOGIN_EXTERNAL_EMAIL_VERIFICALTION_MESSAGE2 .= '<br>However, the email address has not been validated by the external service provider, so before we can complete your registration we must first validate that email address belongs to you.';
$LNG->LOGIN_EXTERNAL_EMAIL_VERIFICALTION_MESSAGE2 .= '<br><br>'.$LNG->LOGIN_EXTERNAL_EMAIL_VERIFICALTION_MESSAGE;

$LNG->LOGIN_EXTERNAL_TITLE = 'Social Sign On';
$LNG->LOGIN_EXTERNAL_MESSAGE = 'You have been send an email to verify your email address. Please click on the link in the email to complete this process';

$LNG->LOGIN_EXTERNAL_COMPLETE_TITLE = 'SOCIAL SIGN ON - Completing Email Validation';
$LNG->LOGIN_EXTERNAL_COMPLETE_FAILED = 'The Social sign on record associated with the given id is no longer available. Please try Signing Up/In again';
$LNG->LOGIN_EXTERNAL_COMPLETE_FAILED = 'Your email validation could not be completed as the record id given was invalid. Please try Signing Up/In again';
$LNG->LOGIN_EXTERNAL_COMPLETE_FAILED_USER = 'The existing User account that is associated with the given email address is no longer available';
$LNG->LOGIN_EXTERNAL_COMPLETE_FAILED_INVALID = 'Your email validation could not be completed as the validation key given was invalid for the given external provider record id. <br><br>Please try again using a different provider, or create a local Evidence Hub account';
$LNG->LOGIN_EXTERNAL_REGISTER_COMPLETE_FAILED = 'Your registration could not be completed as the user id given did not belong to the external provider record given.<br><br>Please try again using a different provider, or create a local Evidence Hub account';

// Messages used when the provider didn't supply the email address so the user was asked to
$LNG->LOGIN_EXTERNAL_NO_EMAIL_ACCOUNT_EXISTS = 'An Evidence Hub user account already exists on this site using the email address you have given us';

$LNG->LOGIN_EXTERNAL_UNVALIDATED_TITLE = 'Validate Your Evidence Hub Email Address';

$LNG->LOGIN_EXTERNAL_NO_EMAIL_ERROR_ACCOUNT_UNVALIDATED = $LNG->LOGIN_EXTERNAL_NO_EMAIL_ACCOUNT_EXISTS.', but that user account has not completed its registration process.<br><br>If you own that Evidence Hub user account you need to reply to the email you where sent to complete your registration, before you can use any external services to Sign In to this Hub.';
$LNG->LOGIN_EXTERNAL_NO_EMAIL_ERROR_ACCOUNT_UNVALIDATED_EXISTING = $LNG->LOGIN_EXTERNAL_NO_EMAIL_ACCOUNT_EXISTS.', but that Evidence Hub user account has not had its email address validated yet.<br><br>If you own that Evidence Hub user account you first need to <a href="'.$CFG->homeAddress.'ui/pages/login.php">Sign In</a> using that account and validate your email address from your profile page, before you can use any external services to Sign In to this Hub in the future.';
$LNG->LOGIN_EXTERNAL_NO_EMAIL_ERROR_ACCOUNT_UNAUTHORIZED = $LNG->LOGIN_EXTERNAL_NO_EMAIL_ACCOUNT_EXISTS.', however that account is awaiting authorization, so we cannot log you in at this time.';
$LNG->LOGIN_EXTERNAL_NO_EMAIL_ERROR_ACCOUNT_SUSPENDED = $LNG->LOGIN_EXTERNAL_NO_EMAIL_ACCOUNT_EXISTS.', however the account has currently been suspended, so we cannot log you in at this time.';

$LNG->LOGIN_EXTERNAL_NO_EMAIL_EXISTING_VALIDATE_TITLE_PART1 = 'Validate Your';
$LNG->LOGIN_EXTERNAL_NO_EMAIL_EXISTING_VALIDATE_TITLE_PART2 = 'Email Address';
$LNG->LOGIN_EXTERNAL_NO_EMAIL_EXISTING_VALIDATE_MESSAGE_PART1 = $LNG->LOGIN_EXTERNAL_NO_EMAIL_ACCOUNT_EXISTS.'. In order for us to associate your'; // Provder service name will be inserted here .e.g Facebook, Yahoo, Google etc.
$LNG->LOGIN_EXTERNAL_NO_EMAIL_EXISTING_VALIDATE_MESSAGE_PART2 = 'account with this Evidence Hub user account we first need to validate that you are the owner of the email address you have given us.<br><br>Therefore we have sent you an email. Please click on the link inside to validate your email address and complete the registration of your external profile with us.';

$LNG->LOGIN_EXTERNAL_NO_EMAIL_VERIFICALTION_TITLE = 'Registration Successful';
$LNG->LOGIN_EXTERNAL_NO_EMAIL_VERIFICALTION_MESSAGE_PART1 = 'There was no existing Evidence Hub '.$LNG->USER_NAME.' account for the email address you have given us, so we have now created one and associated it to your'; // Provder service name will be inserted here .e.g Facebook, Yahoo, Google etc.
$LNG->LOGIN_EXTERNAL_NO_EMAIL_VERIFICALTION_MESSAGE_PART2 = 'profile.';
$LNG->LOGIN_EXTERNAL_NO_EMAIL_VERIFICALTION_MESSAGE_PART3 = '<br>However, to complete your registration with us we must first validate that you are the owner of the email address you have given us.';
$LNG->LOGIN_EXTERNAL_NO_EMAIL_VERIFICALTION_MESSAGE_PART3 .= '<br><br>'.$LNG->LOGIN_EXTERNAL_EMAIL_VERIFICALTION_MESSAGE;

$LNG->LOGIN_EXTERNAL_WELCOME_TITLE = 'Welcome to the Evidence Hub';
$LNG->LOGIN_EXTERNAL_WELCOME_MESSAGE_PART1 = 'There was no existing Evidence Hub '.$LNG->USER_NAME.' account for the email address:';
$LNG->LOGIN_EXTERNAL_WELCOME_MESSAGE_PART2 = ', so we have now created one and associated it to your'; // Provder service name will be inserted here .e.g Facebook, Yahoo, Google etc.
$LNG->LOGIN_EXTERNAL_WELCOME_MESSAGE_PART3 = 'profile.';
$LNG->LOGIN_EXTERNAL_WELCOME_MESSAGE_PART4 = 'You should receive a welcome email shortly.';

$LNG->LOGIN_EXTERNAL_ENTER_BUTTON = 'Enter Site';
*/

/** NEW LOGIN ADDITIONS **/
/*
$LNG->LOGIN_ERROR_ACCOUNT_UNVALIDATED = 'The account using the given Sign In details has not completed the registration process. You need to reply to the email you where sent to complete your registration, before you can Sign In.';
$LNG->LOGIN_ERROR_ACCOUNT_UNAUTHORIZED = 'The account using the given Sign In details is awaiting authorization, so we cannot log you in at this time.';
$LNG->LOGIN_ERROR_ACCOUNT_SUSPENDED = 'The account using the given Sign In details has currently been suspended, so we cannot log you in at this time.';

$LNG->VALIDATION_COMPLETE_TITLE = 'Email Address Validation';
$LNG->VALIDATION_FAILED = 'Your email address validation could not be completed. Please try again';
$LNG->VALIDATION_FAILED_INVALID = 'Your email address validation could not be completed as the Validation key was invalid for the given user. Please try again';
$LNG->VALIDATION_SUCCESSFUL_LOGIN = "Thank you for validating your email address with us.</a>";

$LNG->EMAIL_VALIDATE_TEXT = 'Send New Validation Email';
$LNG->EMAIL_VALIDATE_HINT = 'Click here to be sent another validation email for you to complete your registration of this external profile with us.';
$LNG->EMAIL_VALIDATE_MESSAGE = 'You have been sent an email to validate that you own the email address you tried to Sign In with.';
*/

/** ADMIN USER REGISTRATION MANAGER **/
/*
$LNG->REGSITRATION_ADMIN_MANAGER_LINK = "Registration Requests";
$LNG->REGSITRATION_ADMIN_TITLE = 'User Registration Manager';

$LNG->REGSITRATION_ADMIN_UNREGISTERED_TITLE = "Registration Requests";
$LNG->REGSITRATION_ADMIN_UNVALIDATED_TITLE = "Unvalidated Registrations";
$LNG->REGSITRATION_ADMIN_REVALIDATE_BUTTON = "Revalidate";
$LNG->REGSITRATION_ADMIN_REMOVE_BUTTON = "Remove";
$LNG->REGSITRATION_ADMIN_REMOVE_CHECK_MESSAGE = "Are you sure you want to REMOVE this user registration?: ";
$LNG->REGSITRATION_ADMIN_REVALIDATE_CHECK_MESSAGE = "Are you sure you want to send another validation email to this user?: ";
$LNG->REGSITRATION_ADMIN_USER_REMOVED = 'has had their acount removed from the system';
$LNG->REGSITRATION_ADMIN_USER_EMAILED_REVALIDATED = 'has been re-emailed that their registration request was accepted';

$LNG->REGSITRATION_ADMIN_REJECT_CHECK_MESSAGE = "Are you sure you want to REJECT this ".$LNG->USER_NAME." registration request?: ";
$LNG->REGSITRATION_ADMIN_ACCEPT_CHECK_MESSAGE = "Are you sure you want to ACCEPT this ".$LNG->USER_NAME." registration request?: ";
$LNG->REGSITRATION_ADMIN_NONE_MESSAGE = 'There are currently no '.$LNG->USERS_NAME.' requesting registration';
$LNG->REGSITRATION_ADMIN_VALIDATION_NONE_MESSAGE = 'There are currently no users awaiting validation';
$LNG->REGSITRATION_ADMIN_TABLE_HEADING_DATE = "Date";
$LNG->REGSITRATION_ADMIN_TABLE_HEADING_NAME = "Name";
$LNG->REGSITRATION_ADMIN_TABLE_HEADING_DESC = "Description";
$LNG->REGSITRATION_ADMIN_TABLE_HEADING_INTEREST = "Interest";
$LNG->REGSITRATION_ADMIN_TABLE_HEADING_WEBSITE = "website";
$LNG->REGSITRATION_ADMIN_TABLE_HEADING_ACTION = "Action";
$LNG->REGSITRATION_ADMIN_REJECT_BUTTON = 'Reject';
$LNG->REGSITRATION_ADMIN_ACCEPT_BUTTON = 'Accept';
$LNG->REGSITRATION_ADMIN_ID_ERROR = "Can not process user request as id is missing";
$LNG->REGSITRATION_ADMIN_USER_EMAILED_ACCEPTANCE = 'has been emailed that their registration request was accepted';
$LNG->REGSITRATION_ADMIN_USER_EMAILED_REJECTION = 'has been emailed that their registration request was rejected';
$LNG->REGSITRATION_ADMIN_EMAIL_REQUEST_SUBJECT = $LNG->WELCOME_REGISTER_REQUEST_SUBJECT;
*/

// %s will be replace with the name of the current Evidence Hub. When translating please leave this in the sentence appropariately placed.
//$LNG->REGSITRATION_ADMIN_EMAIL_REJECT_BODY = 'Thank you for requesting registration on the %s.<br>Unfortunately, on this occasion, your request for a user account has not been successful.';

/** NEW OPEN COMMENTS CATEGORY **/
/*
$LNG->FORM_COMMENT_ENTER_SUMMARY_ERROR = 'Please enter a '.$LNG->COMMENT_NAME_SHORT.' before trying to publish';
$LNG->FORM_COMMENT_TITLE = 'Add a New '.$LNG->COMMENT_NAME;
$LNG->FORM_LABEL_COMMENT = $LNG->COMMENT_NAME_SHORT.': ';
$LNG->FORM_COMMENT_MESSAGE = 'You can share your knowledge with a quick '.$LNG->COMMENT_NAME_SHORT.'. Later, it can be linked more carefully into the web of '.$LNG->EVIDENCE_NAME;
$LNG->FORM_COMMENT_NOT_FOUND = 'The required '.$LNG->COMMENT_NAME.' could not be found';
$LNG->FORM_COMMENT_CHILD_TITLE = "Used to build:";
$LNG->FORM_COMMENT_PARENT_TITLE = "Build from:";
$LNG->BUILT_FROM_ITEM_HINT = 'Go to the '.$LNG->COMMENT_NAME_SHORT.' list for this '.$LNG->COMMENT_NAME_SHORT;
$LNG->COMMENT_FILTER_ALL = "All ".$LNG->COMMENT_NAME_SHORT;
$LNG->COMMENT_FILTER_UNUSED = "Unused ".$LNG->COMMENT_NAME_SHORT;
$LNG->COMMENT_FILTER_USED = "Used ".$LNG->COMMENT_NAME_SHORT;
$LNG->COMMENT_LOADING_MESSAGE = "Checking usage";
$LNG->COMMENT_CONVERT_TO_STORY = 'Make into a Story';
$LNG->COMMENT_CONVERT_TO_STORY_HINT = 'Use the text from this '.$LNG->COMMENT_NAME_SHORT.' to create a Story';
$LNG->COMMENT_CONVERT_TO_PRACTITIONER_STORY = 'Make into a '.$LNG->PRACTITIONER_STORY_NAME;
$LNG->COMMENT_CONVERT_TO_PRACTITIONER_STORY_HINT = 'Use the text from this '.$LNG->COMMENT_NAME_SHORT.' to create a '.$LNG->PRACTITIONER_STORY_NAME;
$LNG->COMMENT_CONVERT_TO_RESEARCHER_STORY = 'Make into a '.$LNG->RESEARCHER_STORY_NAME;
$LNG->COMMENT_CONVERT_TO_RESEARCHER_STORY_HINT = 'Use the text from this '.$LNG->COMMENT_NAME_SHORT.' to create a '.$LNG->RESEARCHER_STORY_NAME;
$LNG->FORM_COMMENT_STORY_TITLE = 'Build a Story from this '.$LNG->COMMENT_NAME_SHORT;
$LNG->FORM_COMMENT_PRACTITIONER_STORY_TITLE = 'Build a Story'.$LNG->PRACTITIONER_STORY_NAME.' from this '.$LNG->COMMENT_NAME_SHORT;
$LNG->FORM_COMMENT_RESEARCHER_STORY_TITLE = 'Build a '.$LNG->RESEARCHER_STORY_NAME.' from this '.$LNG->COMMENT_NAME_SHORT;

$LNG->TAB_COMMENT_MESSAGE_LOGGEDIN = "Explore the ".$LNG->COMMENTS_NAME_SHORT." that are being made and - and add your own.";
$LNG->TAB_COMMENT_MESSAGE_LOGGEDOUT_OPEN = "Explore the ".$LNG->COMMENTS_NAME_SHORT." that are being made - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registeropen.php'>Sign Up</a> to add your own.";
$LNG->TAB_COMMENT_MESSAGE_LOGGEDOUT_REQUEST = "Explore the ".$LNG->COMMENTS_NAME_SHORT." that are being made - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> | <a title='Sign Up' href='".$CFG->homeAddress."ui/pages/registerrequest.php'>Sign Up</a> to add your own.";
$LNG->TAB_COMMENT_MESSAGE_LOGGEDOUT_CLOSED = "Explore the ".$LNG->COMMENTS_NAME_SHORT." that are being made - and <a title='Sign In' href='".$CFG->homeAddress."ui/pages/login.php'>Sign In</a> to add your own.";

$LNG->RECENT_EMAIL_DIGEST_LABEL = 'Email Digest:';
$LNG->RECENT_EMAIL_DIGEST_REGISTER_MESSAGE = "Tick to receive a monthly email digest of recent activity.";
$LNG->RECENT_EMAIL_DIGEST_PROFILE_MESSAGE = "Opt in/out of receiving a monthly email digest of recent activity.";
$LNG->OVERVIEW_COMMENT_MOSTRECENT_TITLE = 'Most Recent '.$LNG->COMMENTS_NAME_SHORT;
*/
?>