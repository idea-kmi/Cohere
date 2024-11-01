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
 include_once("../../../config.php");
 include_once($CFG->dirAddress."ui/helpheader.php");
 ?>
<link rel="stylesheet" href="../media/stylesheet.css" />

<div style="background-color:white; padding-left:20px">	
			
<h1>Cohere API Services</h1>

<p class="description"><p>This page describes the services currently available through the Cohere API. The service base URL is:  
	<a href="<?php print($CFG->homeAddress)?>api/service.php"><?php print($CFG->homeAddress)?>api/service.php</a>
	
        and it will always require a 'method' parameter.</p>
		<p>In all service calls, an optional parameter 'format' can be provided  to set how the output is displayed, the default is 'xml', but other options currently are 'gmap','json','list','rdf','rss', 'shortxml' and 'simile'.  Not all formats are available with all methods, as explained below:</p>
		<p><ul>
			<li>'xml', 'json' and 'rdf' formats are available to all methods</li>
			<li>'rss' and 'shortxml' formats are only available to methods which return a NodeSet or ConnectionSet</li>
			<li>'gmap' and 'simile' formats are only available to methods which return a NodeSet.</li>
			<li>'list' format is available to methods which return a NodeSet or a TagSet.</li>
		</ul> If you specify 'json' as the output format, then you can (optionally) provide a parameter 'callback'.
 Although all the example services calls show the parameters passed as GET requests, parameters will be accepted as either GET or POST -  so the parameters can be provided in any order - not just the order in which they've been listed on this page.</p><p>Some services require a valid user login to work (essentially any add, edit or delete method) and in these cases, when you call  the service, you must also provide a valid Cohere session cookie, this can be obtained by calling the login service.  If you are calling the services via your web browser, you won't need to worry much about this, as your browser will automatically store and send  the cookie with each service call.</p>
 <p>Example service calls:  <pre>
<?php print($CFG->homeAddress)?>api/service.php?method=getnode&amp;nodeid=***a node id***<br />
<?php print($CFG->homeAddress)?>api/service.php?method=getnodesbyuser&amp;userid=***a user id***<br />
<?php print($CFG->homeAddress)?>api/service.php?method=getnodesbyuser&amp;userid=***a user id***&amp;format=json<br />
<?php print($CFG->homeAddress)?>api/service.php?method=getnodesbyuser&amp;userid=***a user id***&amp;format=rdf<br />
<?php print($CFG->homeAddress)?>api/service.php?method=getnodesbyuser&amp;userid=***a user id***&amp;format=xml<br />
</pre>
</p>

<p>Below it is noted which services require the user to be logged in</p><p>Note that if any required parameters are missing from a service call, then an error object will be returned detailing the missing parameter.</p><p>For any datetime parameter the following formats will be accepted:</p><p><ul><li>14 May 2008</li><li>14-05-2008</li><li>14 May 2008 9:00</li><li>14 May 2008 9:00PM</li><li>14-05-2008 9:00PM</li><li>9:00</li><li>14 May</li><li>wed</li><li>wed 9:00</li></ul> and the following formats would not be accepted:</p><p><ul><li>14 05 2008</li><li>14/05/2008</li><li>14 05 2008 9:00</li><li>14/05/2008 9:00</li><li>14-05</li></ul></p></p>		
</div>
</div>
	<a name="sec-functions"></a>	
	<div class="info-box" style="padding-left: 20px;">
		<h2>API Services</h2>
		<div class="info-box-body">	
			<ul>
							<li><a href="#functionaddConnection">addconnection</a></li>
							<li><a href="#functionaddFeed">addfeed</a></li>
							<li><a href="#functionaddGroup">addgroup</a></li>
							<li><a href="#functionaddGroupMember">addgroupmember</a></li>
							<li><a href="#functionaddGroupToConnection">addgrouptoconnection</a></li>
							<li><a href="#functionaddGroupToConnections">addgrouptoconnections</a></li>
							<li><a href="#functionaddGroupToNode">addgrouptonode</a></li>
							<li><a href="#functionaddGroupToNodes">addgrouptonodes</a></li>
							<li><a href="#functionaddLinkType">addlinktype</a></li>
							<li><a href="#functionaddNode">addnode</a></li>
							<li><a href="#functionaddNodesById">addnodesbyid</a></li>
							<li><a href="#functionaddRole">addrole</a></li>
							<li><a href="#functionaddTag">addtag</a></li>
							<li><a href="#functionaddTagsToConnections">addtagstoconnections</a></li>
							<li><a href="#functionaddTagsToNodes">addtagstonodes</a></li>
							<li><a href="#functionaddTagsToURLs">addtagstourls</a></li>
							<li><a href="#functionaddToLog">addtolog</a></li>
							<li><a href="#functionaddToUserCache">addtousercache</a></li>
							<li><a href="#functionaddURL">addurl</a></li>
							<li><a href="#functionaddURLToNode">addurltonode</a></li>
							<li><a href="#functionautoCompleteURLDetails">autocompleteurldetails</a></li>
							<li><a href="#functionclearUserCache">clearusercache</a></li>
							<li><a href="#functioncopyConnection">copyconnection</a></li>
							<li><a href="#functiondeleteConnection">deleteconnection</a></li>
							<li><a href="#functiondeleteConnections">deleteconnections</a></li>
							<li><a href="#functiondeleteFeed">deletefeed</a></li>
							<li><a href="#functiondeleteFromUserCache">deletefromusercache</a></li>
							<li><a href="#functiondeleteGroup">deletegroup</a></li>
							<li><a href="#functiondeleteLinkType">deletelinktype</a></li>
							<li><a href="#functiondeleteNode">deletenode</a></li>
							<li><a href="#functiondeleteNodes">deletenodes</a></li>
							<li><a href="#functiondeleteRole">deleterole</a></li>
							<li><a href="#functiondeleteSearch">deletesearch</a></li>
							<li><a href="#functiondeleteSearchAgent">deletesearchagent</a></li>
							<li><a href="#functiondeleteTag">deletetag</a></li>
							<li><a href="#functiondeleteURL">deleteurl</a></li>
							<li><a href="#functioneditConnection">editconnection</a></li>
							<li><a href="#functioneditLinkType">editlinktype</a></li>
							<li><a href="#functioneditNode">editnode</a></li>
							<li><a href="#functioneditRole">editrole</a></li>
							<li><a href="#functioneditTag">edittag</a></li>
							<li><a href="#functioneditURL">editurl</a></li>
							<li><a href="#functionfeedSetRegular">feedsetregular</a></li>
							<li><a href="#functiongetActiveConnectionUsers">getactiveconnectionusers</a></li>
							<li><a href="#functiongetActiveIdeaUsers">getactiveideausers</a></li>
							<li><a href="#functiongetAllLinkTypes">getalllinktypes</a></li>
							<li><a href="#functiongetAllRoles">getallroles</a></li>
							<li><a href="#functiongetClipsByNodeAndURL">getclipsbynodeandurl</a></li>
							<li><a href="#functiongetClipsByURL">getclipsbyurl</a></li>
							<li><a href="#functiongetClipsByURLNoIdea">getclipsbyurlnoidea</a></li>
							<li><a href="#functiongetConnectedNodes">getconnectednodes</a></li>
							<li><a href="#functiongetConnection">getconnection</a></li>
							<li><a href="#functiongetConnectionsByFromLabel">getconnectionsbyfromlabel</a></li>
							<li><a href="#functiongetConnectionsByGroup">getconnectionsbygroup</a></li>
							<li><a href="#functiongetConnectionsByLinkTypeLabel">getconnectionsbylinktypelabel</a></li>
							<li><a href="#functiongetConnectionsByNode">getconnectionsbynode</a></li>
							<li><a href="#functiongetConnectionsByPath">getconnectionsbypath</a></li>
							<li><a href="#functiongetConnectionsBySearch">getconnectionsbysearch</a></li>
							<li><a href="#functiongetConnectionsByTagSearch">getconnectionsbytagsearch</a></li>
							<li><a href="#functiongetConnectionsByToLabel">getconnectionsbytolabel</a></li>
							<li><a href="#functiongetConnectionsByURL">getconnectionsbyurl</a></li>
							<li><a href="#functiongetConnectionsByUser">getconnectionsbyuser</a></li>
							<li><a href="#functiongetFeedsForUser">getfeedsforuser</a></li>
							<li><a href="#functiongetGroup">getgroup</a></li>
							<li><a href="#functiongetLinkType">getlinktype</a></li>
							<li><a href="#functiongetLinkTypeByLabel">getlinktypebylabel</a></li>
							<li><a href="#functiongetMostConnectedNodes">getmostconnectednodes</a></li>
							<li><a href="#functiongetMultiConnections">getmulticonnections</a></li>
							<li><a href="#functiongetMyAdminGroups">getmyadmingroups</a></li>
							<li><a href="#functiongetMyGroups">getmygroups</a></li>
							<li><a href="#functiongetNode">getnode</a></li>
							<li><a href="#functiongetNodesByDate">getnodesbydate</a></li>
							<li><a href="#functiongetNodesByFirstCharacters">getnodesbyfirstcharacters</a></li>
							<li><a href="#functiongetNodesByGroup">getnodesbygroup</a></li>
							<li><a href="#functiongetNodesByName">getnodesbyname</a></li>
							<li><a href="#functiongetNodesByNode">getnodesbynode</a></li>
							<li><a href="#functiongetNodesBySearch">getnodesbysearch</a></li>
							<li><a href="#functiongetNodesByTag">getnodesbytag</a></li>
							<li><a href="#functiongetNodesByTagName">getnodesbytagname</a></li>
							<li><a href="#functiongetNodesByTagSearch">getnodesbytagsearch</a></li>
							<li><a href="#functiongetNodesByURL">getnodesbyurl</a></li>
							<li><a href="#functiongetNodesByURLID">getnodesbyurlid</a></li>
							<li><a href="#functiongetNodesByUser">getnodesbyuser</a></li>
							<li><a href="#functiongetPopularNodes">getpopularnodes</a></li>
							<li><a href="#functiongetRecentConnections">getrecentconnections</a></li>
							<li><a href="#functiongetRecentNodes">getrecentnodes</a></li>
							<li><a href="#functiongetRecentUsers">getrecentusers</a></li>
							<li><a href="#functiongetRole">getrole</a></li>
							<li><a href="#functiongetRoleByName">getrolebyname</a></li>
							<li><a href="#functiongetSearch">getsearch</a></li>
							<li><a href="#functiongetTag">gettag</a></li>
							<li><a href="#functiongetTagByName">gettagbyname</a></li>
							<li><a href="#functiongetTagsByFirstCharacters">gettagsbyfirstcharacters</a></li>
							<li><a href="#functiongetTagsByNode">gettagsbynode</a></li>
							<li><a href="#functiongetUnconnectedNodes">getunconnectednodes</a></li>
							<li><a href="#functiongetURL">geturl</a></li>
							<li><a href="#functiongetURLsByGroup">geturlsbygroup</a></li>
							<li><a href="#functiongetURLsByNode">geturlsbynode</a></li>
							<li><a href="#functiongetURLsBySearch">geturlsbysearch</a></li>
							<li><a href="#functiongetURLsByTagSearch">geturlsbytagsearch</a></li>
							<li><a href="#functiongetURLsByURL">geturlsbyurl</a></li>
							<li><a href="#functiongetURLsByUser">geturlsbyuser</a></li>
							<li><a href="#functiongetUser">getuser</a></li>
							<li><a href="#functiongetUserCache">getusercache</a></li>
							<li><a href="#functiongetUserCacheNodes">getusercachenodes</a></li>
							<li><a href="#functiongetUserLinkTypes">getuserlinktypes</a></li>
							<li><a href="#functiongetUserRoles">getuserroles</a></li>
							<li><a href="#functiongetUsersByGroup">getusersbygroup</a></li>
							<li><a href="#functiongetUsersByNode">getusersbynode</a></li>
							<li><a href="#functiongetUsersBySearch">getusersbysearch</a></li>
							<li><a href="#functiongetUsersByTagSearch">getusersbytagsearch</a></li>
							<li><a href="#functiongetUsersByURL">getusersbyurl</a></li>
							<li><a href="#functiongetUsersByUser">getusersbyuser</a></li>
							<li><a href="#functiongetUserSearches">getusersearches</a></li>
							<li><a href="#functiongetUserTags">getusertags</a></li>
							<li><a href="#functionloadSearchAgentRun">loadsearchagentrun</a></li>
							<li><a href="#functionloadSearchAgentRunNew">loadsearchagentrunnew</a></li>
							<li><a href="#functionlogin">login</a></li>
							<li><a href="#functionmakeGroupAdmin">makegroupadmin</a></li>
							<li><a href="#functionrefreshFeed">refreshfeed</a></li>
							<li><a href="#functionremoveAllGroupsFromConnection">removeallgroupsfromconnection</a></li>
							<li><a href="#functionremoveAllGroupsFromNode">removeallgroupsfromnode</a></li>
							<li><a href="#functionremoveAllURLsFromNode">removeallurlsfromnode</a></li>
							<li><a href="#functionremoveGroupAdmin">removegroupadmin</a></li>
							<li><a href="#functionremoveGroupFromConnection">removegroupfromconnection</a></li>
							<li><a href="#functionremoveGroupFromConnections">removegroupfromconnections</a></li>
							<li><a href="#functionremoveGroupFromNode">removegroupfromnode</a></li>
							<li><a href="#functionremoveGroupFromNodes">removegroupfromnodes</a></li>
							<li><a href="#functionremoveGroupMember">removegroupmember</a></li>
							<li><a href="#functionremoveURLFromNode">removeurlfromnode</a></li>
							<li><a href="#functionrunSearchAgent">runsearchagent</a></li>
							<li><a href="#functionsetGroupPrivacy">setgroupprivacy</a></li>
							<li><a href="#functiontweetUserIdea">tweetuseridea</a></li>
							<li><a href="#functionupdateNodeEndDate">updatenodeenddate</a></li>
							<li><a href="#functionupdateNodeLocation">updatenodelocation</a></li>
							<li><a href="#functionupdateNodeStartDate">updatenodestartdate</a></li>
							<li><a href="#functionvalidateUserSession">validateusersession</a></li>
						</ul>
			<a name="functionaddConnection" id="functionaddConnection"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">addconnection</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a Connection. Requires login.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Connection</span>
		<span class="method-name">
			addConnection
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$fromnodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$fromroleid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$linktypeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$tonodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$toroleid</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$private</span> = <span class="var-default">&amp;quot;&amp;quot;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">fromnodeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">fromroleid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">linktypeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">tonodeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">toroleid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">private</span><span class="var-description"> optional, can be Y or N, defaults to users preferred setting</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Connection
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddFeed" id="functionaddFeed"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">addfeed</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a new feed. Requires login.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Feed</span>
		<span class="method-name">
			addFeed
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$name</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$regular</span> = <span class="var-default">&#039;N&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">name</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">regular</span><span class="var-description"> - optional, can be 'Y' or 'N' (default N) and indicates whether Cohere should regularly call the feed to update</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Feed
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddGroup" id="functionaddGroup"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">addgroup</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a new group. Requires login.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Group</span>
		<span class="method-name">
			addGroup
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupname</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupname</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Group
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddGroupMember" id="functionaddGroupMember"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">addgroupmember</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a user to a group. Requires login and user must be an admin for the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Group</span>
		<span class="method-name">
			addGroupMember
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Group
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddGroupToConnection" id="functionaddGroupToConnection"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">addgrouptoconnection</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a group to a Connection. Requires login, user must be the connection owner and member of the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Connection</span>
		<span class="method-name">
			addGroupToConnection
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$connid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">connid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Connection
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddGroupToConnections" id="functionaddGroupToConnections"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">addgrouptoconnections</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a group to a set of connections. Requires login, user must be the connection owner and member of the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			addGroupToConnections
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$connids</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">connids</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddGroupToNode" id="functionaddGroupToNode"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">addgrouptonode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a group to a node. Requires login, user must be the node owner and member of the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Node</span>
		<span class="method-name">
			addGroupToNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Node
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddGroupToNodes" id="functionaddGroupToNodes"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">addgrouptonodes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a group to a set of nodes. Requires login, user must be the node owner and member of the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			addGroupToNodes
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeids</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeids</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddLinkType" id="functionaddLinkType"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">addlinktype</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a linktype (will return the existing one if it's already in the db).</p>
<p class="description"><p>Requires login.</p></p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">LinkType</span>
		<span class="method-name">
			addLinkType
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$label</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$linktypegroup</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">label</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">linktypegroup</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				LinkType
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddNode" id="functionaddNode"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">addnode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a node. Requires login</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Node</span>
		<span class="method-name">
			addNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$name</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$desc</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$private</span> = <span class="var-default">&amp;quot;&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$nodetypeid</span> = <span class="var-default">&amp;quot;&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$imageurlid</span> = <span class="var-default">&amp;quot;&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$imagethumbnail</span> = <span class="var-default">&amp;quot;&amp;quot;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">name</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">desc</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">private</span><span class="var-description"> optional, can be Y or N, defaults to users preferred setting</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodetypeid</span><span class="var-description"> optional, the id of the nodetype this node is, defaults to 'Idea' node type id.</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">imageurlid</span><span class="var-description"> optional, the urlid of the url for the image that is being used as this node's icon</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">imagethumbnail</span><span class="var-description"> optional, the local server path to the thumbnail of the image used for this node</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Node
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddNodesById" id="functionaddNodesById"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">addnodesbyid</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Adds nodes. Requires login.</p>
<p class="description"><p>Purpose of this function is to allow the importing of another users nodes into  the users workspace, and more than one at a time can be added</p></p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			addNodesById
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeids</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeids</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddRole" id="functionaddRole"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">addrole</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add new role - if the role already exists then this  existing role object will be returned. Login required.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Role</span>
		<span class="method-name">
			addRole
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$rolename</span>, [<span class="var-type"></span>&nbsp;<span class="var-name">$image</span> = <span class="var-default">null</span>], <span class="var-type">string</span>&nbsp;<span class="var-name">$image,</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">rolename</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">image,</span><span class="var-description"> optional parameter local path to an image file (uploaded onto server).</span>			</li>
					<li>
				<span class="var-type"></span>
				<span class="var-name">image</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Role
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddTag" id="functionaddTag"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">addtag</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add new tag - if the tag already exists then this  existing tag object will be returned. Login required.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Role</span>
		<span class="method-name">
			addTag
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$tagname</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">tagname</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Role
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddTagsToConnections" id="functionaddTagsToConnections"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">addtagstoconnections</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add the given tag labels to the given connection ids</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">void</span>
		<span class="method-name">
			addTagsToConnections
		</span>
					(<span class="var-type">$tags</span>&nbsp;<span class="var-name">$tags</span>, <span class="var-type">$connids</span>&nbsp;<span class="var-name">$connids</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">$tags</span>
				<span class="var-name">tags</span><span class="var-description"> the comma separated list of tags to add</span>			</li>
					<li>
				<span class="var-type">$connids</span>
				<span class="var-name">connids</span><span class="var-description"> the comma separated list of connetion id to add tags to</span>			</li>
				</ul>
		
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddTagsToNodes" id="functionaddTagsToNodes"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">addtagstonodes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add the given tag labels to the given node ids</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">void</span>
		<span class="method-name">
			addTagsToNodes
		</span>
					(<span class="var-type">$tags</span>&nbsp;<span class="var-name">$tags</span>, <span class="var-type">$nodeids</span>&nbsp;<span class="var-name">$nodeids</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">$tags</span>
				<span class="var-name">tags</span><span class="var-description"> the comma separated list of tags to add</span>			</li>
					<li>
				<span class="var-type">$nodeids</span>
				<span class="var-name">nodeids</span><span class="var-description"> the comma separated list of node id to add tags to</span>			</li>
				</ul>
		
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddTagsToURLs" id="functionaddTagsToURLs"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">addtagstourls</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add the given tag labels to the given urls ids</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">void</span>
		<span class="method-name">
			addTagsToURLs
		</span>
					(<span class="var-type">$tags</span>&nbsp;<span class="var-name">$tags</span>, <span class="var-type">$urlids</span>&nbsp;<span class="var-name">$urlids</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">$tags</span>
				<span class="var-name">tags</span><span class="var-description"> the comma separated list of tags to add</span>			</li>
					<li>
				<span class="var-type">$urlids</span>
				<span class="var-name">urlids</span><span class="var-description"> the comma sepsrated list of url id to add tags to</span>			</li>
				</ul>
		
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddToLog" id="functionaddToLog"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">addtolog</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add to the log</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			addToLog
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$action</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$type</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$id</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">action</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">type</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">id</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddToUserCache" id="functionaddToUserCache"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">addtousercache</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add item to users cache (bookmarks). Login required.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserCache</span>
		<span class="method-name">
			addToUserCache
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$idea</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">idea</span><span class="var-description"> the id of the idea to add</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserCache
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddURL" id="functionaddURL"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">addurl</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a URL. Requires login</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URL</span>
		<span class="method-name">
			addURL
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$title</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$desc</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$private</span> = <span class="var-default">&#039;Y&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$clip</span> = <span class="var-default">&amp;quot;&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$clippath</span> = <span class="var-default">&amp;quot;&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$cliphtml</span> = <span class="var-default">&amp;quot;&amp;quot;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">title</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">desc</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">private</span><span class="var-description"> optional, can be Y or N, defaults to users preferred setting</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">clip</span><span class="var-description"> (optional);</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">clippath</span><span class="var-description"> (optional) - only used by Firefox plugin</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">cliphtml</span><span class="var-description"> (optional) - only used by Firefox plugin</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URL
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionaddURLToNode" id="functionaddURLToNode"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">addurltonode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Add a URL to a Node. Requires login, user must be owner of both the node and URL</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Node</span>
		<span class="method-name">
			addURLToNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$urlid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$comments</span> = <span class="var-default">&amp;quot;&amp;quot;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">urlid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">comments</span><span class="var-description"> (optional)</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Node
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionautoCompleteURLDetails" id="functionautoCompleteURLDetails"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">autocompleteurldetails</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Go and try and automatically retrieve the title and descritpion for the given url.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URL</span>
		<span class="method-name">
			autoCompleteURLDetails
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URL
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionclearUserCache" id="functionclearUserCache"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">clearusercache</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Empties the users cache (bookmarks). Login required.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserCache</span>
		<span class="method-name">
			clearUserCache
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserCache
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functioncopyConnection" id="functioncopyConnection"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">copyconnection</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Copy a Connection. Requires login</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Connection</span>
		<span class="method-name">
			copyConnection
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$connid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">connid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Connection
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteConnection" id="functiondeleteConnection"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">deleteconnection</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete a connection. Requires login and user must be owner of the connection</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteConnection
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$connid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">connid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteConnections" id="functiondeleteConnections"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">deleteconnections</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Deletes a set of connections. Requires login and user must be owner of each connection.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteConnections
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$connids</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">connids</span><span class="var-description"> (comma separated list of connids)</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteFeed" id="functiondeleteFeed"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">deletefeed</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete a feed. Requires login and user must be owner of the feed.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteFeed
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$feedid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">feedid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteFromUserCache" id="functiondeleteFromUserCache"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">deletefromusercache</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete item from users cache (bookmarks). Login required.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserCache</span>
		<span class="method-name">
			deleteFromUserCache
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$idea</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">idea</span><span class="var-description"> the id of the idea to delete</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserCache
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteGroup" id="functiondeleteGroup"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">deletegroup</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete a group. Requires login and user must be an admin for the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteGroup
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteLinkType" id="functiondeleteLinkType"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">deletelinktype</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete a linktype. Requires login and user must be owner of the linktype</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteLinkType
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$linktypeid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">linktypeid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteNode" id="functiondeleteNode"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">deletenode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete a node. Requires login and user must be owner of the node.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteNodes" id="functiondeleteNodes"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">deletenodes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Deletes a set of nodes. Requires login and user must be owner of each node.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteNodes
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeids</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeids</span><span class="var-description"> (comma separated list of nodeids)</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteRole" id="functiondeleteRole"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">deleterole</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete a role. Requires login and user must be owner of the role.</p>
<p class="description"><p>Connections using this role will have the role replaced by the default one.</p></p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteRole
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$roleid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">roleid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteSearch" id="functiondeleteSearch"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">deletesearch</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete the search with the given id</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteSearch
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$searchid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">searchid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteSearchAgent" id="functiondeleteSearchAgent"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">deletesearchagent</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete the search agent for the given search and agent id</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteSearchAgent
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$agentid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$searchid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">searchid</span><span class="var-description"> the id of the search whose gent to delete</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">agentid</span><span class="var-description"> the id of the agent to delete</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteTag" id="functiondeleteTag"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">deletetag</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete a tag. Requires login and user must be owner of the tag.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			deleteTag
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$tagid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">tagid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiondeleteURL" id="functiondeleteURL"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">deleteurl</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Delete a URL. Requires login and user must be owner of the URL</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URL</span>
		<span class="method-name">
			deleteURL
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$urlid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">urlid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URL
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functioneditConnection" id="functioneditConnection"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">editconnection</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Edit a Connection. Requires login and user must be owner of the connection</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Connection</span>
		<span class="method-name">
			editConnection
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$connid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$fromnodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$fromroleid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$linktypeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$tonodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$toroleid</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$private</span> = <span class="var-default">&amp;quot;&amp;quot;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">connid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">fromnodeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">fromroleid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">linktypeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">tonodeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">toroleid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">private</span><span class="var-description"> optional, can be Y or N, defaults to users preferred setting</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Connection
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functioneditLinkType" id="functioneditLinkType"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">editlinktype</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Edit a linktype. Requires login and user must be owner of the linktype</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">LinkType</span>
		<span class="method-name">
			editLinkType
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$linktypeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$linktypelabel</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">linktypeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">linktypelabel</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				LinkType
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functioneditNode" id="functioneditNode"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">editnode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Edit a node. Requires login and user must be owner of the node.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Node</span>
		<span class="method-name">
			editNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$name</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$desc</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$private</span> = <span class="var-default">&amp;quot;&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$nodetypeid</span> = <span class="var-default">&amp;quot;&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$imageurlid</span> = <span class="var-default">&amp;quot;&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$imagethumbnail</span> = <span class="var-default">&amp;quot;&amp;quot;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">private</span><span class="var-description"> optional, can be Y or N, defaults to users preferred setting</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodetypeid</span><span class="var-description"> optional, the id of the nodetype this node is, defaults to 'Idea' node type id.</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">imageurlid</span><span class="var-description"> optional, the urlid of the url for the image that is being used as this node's icon</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">imagethumbnail</span><span class="var-description"> optional, the local server path to the thumbnail of the image used for this node</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span><span class="var-description"> nodeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">name</span><span class="var-description"> name</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">desc</span><span class="var-description"> desc</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Node
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functioneditRole" id="functioneditRole"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">editrole</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Edit a role. Requires login and user must be owner of the role</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Role</span>
		<span class="method-name">
			editRole
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$roleid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$rolename</span>, [<span class="var-type"></span>&nbsp;<span class="var-name">$image</span> = <span class="var-default">null</span>], <span class="var-type">string</span>&nbsp;<span class="var-name">$image,</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">roleid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">rolename</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">image,</span><span class="var-description"> optional parameter local path to an image file (uploaded onto server).</span>			</li>
					<li>
				<span class="var-type"></span>
				<span class="var-name">image</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Role
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functioneditTag" id="functioneditTag"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">edittag</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Edit a tag. If that tag name already exists for this user, return an error.</p>
<p class="description"><p>Requires login and user must be owner of the tag</p></p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Tag</span>
		<span class="method-name">
			editTag
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$tagid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$tagname</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">tagid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">tagname</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Tag
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functioneditURL" id="functioneditURL"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">editurl</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Edit a URL. Requires login and user must be owner of the URL</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URL</span>
		<span class="method-name">
			editURL
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$urlid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$title</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$desc</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$private</span> = <span class="var-default">&#039;Y&#039;</span>], [<span class="var-type"></span>&nbsp;<span class="var-name">$clip</span> = <span class="var-default">&amp;quot;&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$clippath</span> = <span class="var-default">&amp;quot;&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$cliphtml</span> = <span class="var-default">&amp;quot;&amp;quot;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">urlid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">title</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">desc</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">private</span><span class="var-description"> optional, can be Y or N, defaults to users preferred setting</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">clippath</span><span class="var-description"> (optional) - only used by Firefox plugin</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">cliphtml</span><span class="var-description"> (optional) - only used by Firefox plugin</span>			</li>
					<li>
				<span class="var-type"></span>
				<span class="var-name">clip</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URL
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionfeedSetRegular" id="functionfeedSetRegular"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">feedsetregular</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Change whether or not the feed is regularly updated. Requires login and user must be owner of the feed.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Feed</span>
		<span class="method-name">
			feedSetRegular
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$feedid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$regular</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">feedid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">regular</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Feed
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetActiveConnectionUsers" id="functiongetActiveConnectionUsers"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getactiveconnectionusers</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the users with the most connections (excludes groups)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserSet</span>
		<span class="method-name">
			getActiveConnectionUsers
		</span>
					([<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a users details to load (long includes: tags and groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetActiveIdeaUsers" id="functiongetActiveIdeaUsers"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getactiveideausers</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the users with the most ideas (excludes groups)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserSet</span>
		<span class="method-name">
			getActiveIdeaUsers
		</span>
					([<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a users details to load (long includes: tags and groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetAllLinkTypes" id="functiongetAllLinkTypes"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getalllinktypes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get all the linktypes for the current user</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">LinkTypeSet</span>
		<span class="method-name">
			getAllLinkTypes
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				LinkTypeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetAllRoles" id="functiongetAllRoles"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getallroles</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get all roles</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">RoleSet</span>
		<span class="method-name">
			getAllRoles
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				RoleSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetClipsByNodeAndURL" id="functiongetClipsByNodeAndURL"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getclipsbynodeandurl</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the clips for the given url where the url has been joined to the given node id</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URLSet</span>
		<span class="method-name">
			getClipsByNodeAndURL
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span><span class="var-description"> the url to get the clips for</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span><span class="var-description"> to get the url's clips for</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URLSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetClipsByURL" id="functiongetClipsByURL"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getclipsbyurl</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the urls with clips for given url  (note that this uses the actual URL rather than the urlid)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URLSet</span>
		<span class="method-name">
			getClipsByURL
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URLSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetClipsByURLNoIdea" id="functiongetClipsByURLNoIdea"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getclipsbyurlnoidea</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the urls with clips for given url but not attached to an idea.</p>
<p class="description"><p>(note that this uses the actual URL rather than the urlid)</p></p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URLSet</span>
		<span class="method-name">
			getClipsByURLNoIdea
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URLSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectedNodes" id="functiongetConnectedNodes"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getconnectednodes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get nodes which are connected to other nodes</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getConnectedNodes
		</span>
					([<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnection" id="functiongetConnection"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getconnection</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a Connection</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Connection</span>
		<span class="method-name">
			getConnection
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$connid</span>, [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">connid</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Connection
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectionsByFromLabel" id="functiongetConnectionsByFromLabel"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getconnectionsbyfromlabel</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the connections whose from idea labels are the same as  the label of the node with the given node id</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getConnectionsByFromLabel
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filtergroup</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterlist</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filtergroup</span><span class="var-description"> (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterlist</span><span class="var-description"> (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectionsByGroup" id="functiongetConnectionsByGroup"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getconnectionsbygroup</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the connections for given group</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getConnectionsByGroup
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filtergroup</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterlist</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterusers</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filtergroup</span><span class="var-description"> (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterlist</span><span class="var-description"> (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterusers</span><span class="var-description"> (optional, a list of user ids to filter by)</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectionsByLinkTypeLabel" id="functiongetConnectionsByLinkTypeLabel"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getconnectionsbylinktypelabel</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the connections by link type</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getConnectionsByLinkTypeLabel
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$linktypelabel</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">linktypelabel</span><span class="var-description"> = linktype label to search on - exact full label matching</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (either 'all' or 'my')</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectionsByNode" id="functiongetConnectionsByNode"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getconnectionsbynode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the connections for given label of the node with the given nodeid</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getConnectionsByNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filtergroup</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterlist</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filtergroup</span><span class="var-description"> (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterlist</span><span class="var-description"> (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectionsByPath" id="functiongetConnectionsByPath"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getconnectionsbypath</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the connections for the given netowrk search paramters from the given node.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getConnectionsByPath
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$linklabels</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$linkgroup</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$depth</span> = <span class="var-default">7</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$direction</span> = <span class="var-default">&amp;quot;both&amp;quot;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$labelmatch</span> = <span class="var-default">&#039;false&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span><span class="var-description"> the id of the node to search outward from.</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">linklabels</span><span class="var-description"> the string of link types.</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span><span class="var-description"> optional for searching only a specified user's data. (only used if scope is 'all') - NOT USED AT PRESENT</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (either 'all' or 'my')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">linkgroup</span><span class="var-description"> (optional, either Positive, Negative, or Neutral - default: empty string);</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">depth</span><span class="var-description"> (optional, 1-7, or 7 for full depth;</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">direction</span><span class="var-description"> (optional, 'outgoing', 'incmong', or 'both - default: 'both',</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">labelmatch</span><span class="var-description"> (optional, 'true', 'false' - default: false;</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectionsBySearch" id="functiongetConnectionsBySearch"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getconnectionsbysearch</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the connections for given search  If in speech marks searches LIKE match on phrase, else splits on spaces and searches OR on elements</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getConnectionsBySearch
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filtergroup</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterlist</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (either 'all' or 'my')</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filtergroup</span><span class="var-description"> (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterlist</span><span class="var-description"> (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectionsByTagSearch" id="functiongetConnectionsByTagSearch"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getconnectionsbytagsearch</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Search connections by thier tags  splits on commas and searches OR on elements</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getConnectionsByTagSearch
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filtergroup</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterlist</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (either 'all' or 'my')</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filtergroup</span><span class="var-description"> (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterlist</span><span class="var-description"> (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectionsByToLabel" id="functiongetConnectionsByToLabel"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getconnectionsbytolabel</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the connections whose to idea labels are the same as  the label of the node with the given node id</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getConnectionsByToLabel
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filtergroup</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterlist</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filtergroup</span><span class="var-description"> (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterlist</span><span class="var-description"> (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectionsByURL" id="functiongetConnectionsByURL"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getconnectionsbyurl</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the connections for given url</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getConnectionsByURL
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filtergroup</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterlist</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filtergroup</span><span class="var-description"> (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterlist</span><span class="var-description"> (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetConnectionsByUser" id="functiongetConnectionsByUser"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getconnectionsbyuser</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the connections for given user</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getConnectionsByUser
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filtergroup</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterlist</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filtergroup</span><span class="var-description"> (optional, either 'all','selected','positive','negative' or 'neutral', default: 'all' - to filter the results by the link type group of the connection)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterlist</span><span class="var-description"> (optional, comma separated strings of the connection labels to filter the results by, to have any effect filtergroup must be set to 'selected')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetFeedsForUser" id="functiongetFeedsForUser"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getfeedsforuser</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Gets all feeds for user. If userid not specified then the current user is assumed.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Feed</span>
		<span class="method-name">
			getFeedsForUser
		</span>
					([<span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span> = <span class="var-default">&amp;quot;&amp;quot;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Feed
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetGroup" id="functiongetGroup"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getgroup</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a group</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Group</span>
		<span class="method-name">
			getGroup
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Group
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetLinkType" id="functiongetLinkType"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getlinktype</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a linktype</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">LinkType</span>
		<span class="method-name">
			getLinkType
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$ltid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">ltid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				LinkType
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetLinkTypeByLabel" id="functiongetLinkTypeByLabel"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getlinktypebylabel</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a linktype by label</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">LinkType</span>
		<span class="method-name">
			getLinkTypeByLabel
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$label</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">label</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				LinkType
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetMostConnectedNodes" id="functiongetMostConnectedNodes"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getmostconnectednodes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get nodes which are most connected to other nodes</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getMostConnectedNodes
		</span>
					([<span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (optional, either 'all' or 'my' - default 'all' )</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetMultiConnections" id="functiongetMultiConnections"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getmulticonnections</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get all connections from the given list of connection ids.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getMultiConnections
		</span>
					(<span class="var-type">String</span>&nbsp;<span class="var-name">$connectionids</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">-1</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">String</span>
				<span class="var-name">connectionids</span><span class="var-description"> a comma separated list of the connection ids to get.</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: -1 = all)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetMyAdminGroups" id="functiongetMyAdminGroups"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getmyadmingroups</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get groups that current user is an admin for. Requires login.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">GroupSet</span>
		<span class="method-name">
			getMyAdminGroups
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				GroupSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetMyGroups" id="functiongetMyGroups"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getmygroups</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get all groups for current user. Requires login.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">GroupSet</span>
		<span class="method-name">
			getMyGroups
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				GroupSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNode" id="functiongetNode"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getnode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a node</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Node</span>
		<span class="method-name">
			getNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Node
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByDate" id="functiongetNodesByDate"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getnodesbydate</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the nodes for given date</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByDate
		</span>
					(<span class="var-type">integer</span>&nbsp;<span class="var-name">$date</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">date</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByFirstCharacters" id="functiongetNodesByFirstCharacters"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getnodesbyfirstcharacters</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Searches nodes by node name based on the first chartacters</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByFirstCharacters
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;name&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span><span class="var-description"> the query term(s)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (optional, either 'all' or 'my' - default: 'my')</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByGroup" id="functiongetNodesByGroup"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getnodesbygroup</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the nodes for given group</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByGroup
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterusers</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterusers</span><span class="var-description"> (optional, a list of user ids to filter by)</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByName" id="functiongetNodesByName"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getnodesbyname</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the nodes for given name</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByName
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$name</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">name</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByNode" id="functiongetNodesByNode"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getnodesbynode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the nodes for given node. This returns the other nodes which share the same label as the given node (but will have been entered by another user).</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesBySearch" id="functiongetNodesBySearch"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getnodesbysearch</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Search nodes.</p>
<p class="description"><p>If in speech marks searches LIKE match on phrase, else splits on spaces and searches OR on elements</p></p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesBySearch
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span><span class="var-description"> the query term(s)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (optional, either 'my' or 'all' - default: 'all')</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByTag" id="functiongetNodesByTag"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getnodesbytag</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the nodes for given tagid</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByTag
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$tagid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">tagid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByTagName" id="functiongetNodesByTagName"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getnodesbytagname</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the nodes for given tagname</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByTagName
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$tagname</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">tagname</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByTagSearch" id="functiongetNodesByTagSearch"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getnodesbytagsearch</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Search nodes by their tags  splits on commas and searches OR on elements</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByTagSearch
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span><span class="var-description"> the query term(s)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (optional, either 'my' or 'all' - default: 'all')</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByURL" id="functiongetNodesByURL"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getnodesbyurl</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the nodes for given url  (note that this uses the actual URL rather than the urlid)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByURL
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByURLID" id="functiongetNodesByURLID"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getnodesbyurlid</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the nodes for given urlid</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByURLID
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$urlid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">urlid</span><span class="var-description"> the id of the url to get nodes for</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetNodesByUser" id="functiongetNodesByUser"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getnodesbyuser</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the nodes for given user</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getNodesByUser
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20), -1 means all</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name', 'connectedness' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetPopularNodes" id="functiongetPopularNodes"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getpopularnodes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get popular nodes</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getPopularNodes
		</span>
					([<span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (optional, either 'all' or 'my' - default 'all' )</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetRecentConnections" id="functiongetRecentConnections"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getrecentconnections</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the recent connections</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			getRecentConnections
		</span>
					([<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetRecentNodes" id="functiongetRecentNodes"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getrecentnodes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the recent nodes</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getRecentNodes
		</span>
					([<span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span> = <span class="var-default">&#039;all&#039;</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>], <span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (optional, either 'all' or 'my' - default 'all' )</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetRecentUsers" id="functiongetRecentUsers"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getrecentusers</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the recent visitors (excludes groups)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserSet</span>
		<span class="method-name">
			getRecentUsers
		</span>
					([<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a users details to load (long includes: tags and groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetRole" id="functiongetRole"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getrole</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a role (by id)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Role</span>
		<span class="method-name">
			getRole
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$roleid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">roleid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Role
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetRoleByName" id="functiongetRoleByName"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getrolebyname</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a role (by name)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Role</span>
		<span class="method-name">
			getRoleByName
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$rolename</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">rolename</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Role
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetSearch" id="functiongetSearch"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getsearch</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the search with the given id</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Search</span>
		<span class="method-name">
			getSearch
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$searchid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">searchid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Search
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetTag" id="functiongetTag"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">gettag</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a tag (by id)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Tag</span>
		<span class="method-name">
			getTag
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$tagid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">tagid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Tag
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetTagByName" id="functiongetTagByName"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">gettagbyname</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a tag (by name)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Tag</span>
		<span class="method-name">
			getTagByName
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$tagname</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">tagname</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Tag
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetTagsByFirstCharacters" id="functiongetTagsByFirstCharacters"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">gettagsbyfirstcharacters</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Searches tags by node name based on the first chartacters</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">TagSet</span>
		<span class="method-name">
			getTagsByFirstCharacters
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span><span class="var-description"> the query term(s)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (optional, either 'all' or 'my' - default: 'my')</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				TagSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetTagsByNode" id="functiongetTagsByNode"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">gettagsbynode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the tags for given nodeid. Login required.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">TagSet</span>
		<span class="method-name">
			getTagsByNode
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				TagSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUnconnectedNodes" id="functiongetUnconnectedNodes"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getunconnectednodes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get nodes not connected to other nodes</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getUnconnectedNodes
		</span>
					([<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetURL" id="functiongetURL"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">geturl</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a URL</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URL</span>
		<span class="method-name">
			getURL
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$urlid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">urlid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URL
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetURLsByGroup" id="functiongetURLsByGroup"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">geturlsbygroup</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the urls for given group</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URLSet</span>
		<span class="method-name">
			getURLsByGroup
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$filterusers</span> = <span class="var-default">&#039;&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">filterusers</span><span class="var-description"> (optional, a list of user ids to filter by)</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URLSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetURLsByNode" id="functiongetURLsByNode"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">geturlsbynode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the urls for all nodes with the same label as the node with the given node id</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URLSet</span>
		<span class="method-name">
			getURLsByNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URLSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetURLsBySearch" id="functiongetURLsBySearch"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">geturlsbysearch</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Search urls  If in speech marks searches LIKE match on phrase, else splits on spaces and searches OR on elements</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URLSet</span>
		<span class="method-name">
			getURLsBySearch
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span><span class="var-description"> the query term(s)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (either 'all' or 'my')</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URLSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetURLsByTagSearch" id="functiongetURLsByTagSearch"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">geturlsbytagsearch</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Search urls by their tags  splits on commas and searches OR on elements</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getURLsByTagSearch
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span><span class="var-description"> the query term(s)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (either 'all' or 'my')</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a url's details to load (long includes: tags, groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetURLsByURL" id="functiongetURLsByURL"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">geturlsbyurl</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the urls for given url  (note that this uses the actual URL rather than the urlid)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URLSet</span>
		<span class="method-name">
			getURLsByURL
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URLSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetURLsByUser" id="functiongetURLsByUser"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">geturlsbyuser</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the urls for given user</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">URLSet</span>
		<span class="method-name">
			getURLsByUser
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;ASC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a urls details to load (long includes: tags, groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				URLSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUser" id="functiongetUser"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getuser</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get a user</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">User</span>
		<span class="method-name">
			getUser
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>, [<span class="var-type">string</span>&nbsp;<span class="var-name">$format</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">format</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				User
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUserCache" id="functiongetUserCache"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getusercache</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get whats in the users cache (bookmarks). Login required.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserCache</span>
		<span class="method-name">
			getUserCache
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserCache
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUserCacheNodes" id="functiongetUserCacheNodes"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getusercachenodes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Searches user cache nodes (bookmarks). Login required.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getUserCacheNodes
		</span>
					([<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>], <span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span><span class="var-description"> the query term(s)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'nodeid', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a nodes details to load (long includes: description, tags, groups and urls).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUserLinkTypes" id="functiongetUserLinkTypes"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getuserlinktypes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get all the linktypes for the current user</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">LinkTypeSet</span>
		<span class="method-name">
			getUserLinkTypes
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				LinkTypeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUserRoles" id="functiongetUserRoles"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getuserroles</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the current user's roles. Login required.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">RoleSet</span>
		<span class="method-name">
			getUserRoles
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				RoleSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUsersByGroup" id="functiongetUsersByGroup"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getusersbygroup</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the users for given group</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserSet</span>
		<span class="method-name">
			getUsersByGroup
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags and groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUsersByNode" id="functiongetUsersByNode"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getusersbynode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the users for nodes with the node label of the given nodeid</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserSet</span>
		<span class="method-name">
			getUsersByNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags and groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUsersBySearch" id="functiongetUsersBySearch"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getusersbysearch</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Search users.</p>
<p class="description"><p>If in speech marks searches LIKE match on phrase, else splits on spaces and searches OR on elements</p></p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getUsersBySearch
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span><span class="var-description"> the query term(s)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (must be 'all' or 'my')</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags and groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUsersByTagSearch" id="functiongetUsersByTagSearch"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getusersbytagsearch</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Search users by their tags and by the nodes they have tagged  splits on commas and searches OR on elements</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">NodeSet</span>
		<span class="method-name">
			getUsersByTagSearch
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$q</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$scope</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">q</span><span class="var-description"> the query term(s)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">scope</span><span class="var-description"> (must be 'all' or 'my')</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags, groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				NodeSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUsersByURL" id="functiongetUsersByURL"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getusersbyurl</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the users for given url</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserSet</span>
		<span class="method-name">
			getUsersByURL
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$url</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">url</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags and groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUsersByUser" id="functiongetUsersByUser"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getusersbyuser</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the users for given user (bascially means any groups they are in)</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">UserSet</span>
		<span class="method-name">
			getUsersByUser
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>, [<span class="var-type">integer</span>&nbsp;<span class="var-name">$start</span> = <span class="var-default">0</span>], [<span class="var-type">integer</span>&nbsp;<span class="var-name">$max</span> = <span class="var-default">20</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$orderby</span> = <span class="var-default">&#039;date&#039;</span>], [<span class="var-type">string</span>&nbsp;<span class="var-name">$sort</span> = <span class="var-default">&#039;DESC&#039;</span>], [<span class="var-type">String</span>&nbsp;<span class="var-name">$style</span> = <span class="var-default">&#039;long&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">start</span><span class="var-description"> (optional - default: 0)</span>			</li>
					<li>
				<span class="var-type">integer</span>
				<span class="var-name">max</span><span class="var-description"> (optional - default: 20)</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">orderby</span><span class="var-description"> (optional, either 'date', 'name' or 'moddate' - default: 'date')</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">sort</span><span class="var-description"> (optional, either 'ASC' or 'DESC' - default: 'DESC')</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">style</span><span class="var-description"> (optional - default 'long') may be 'short' or 'long'  - how much of a user's details to load (long includes: tags and groups).</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				UserSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUserSearches" id="functiongetUserSearches"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">getusersearches</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get all the saved searches for the current user</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">SearchSet</span>
		<span class="method-name">
			getUserSearches
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				SearchSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiongetUserTags" id="functiongetUserTags"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">getusertags</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Get the current user's tags. Login required.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">TagSet</span>
		<span class="method-name">
			getUserTags
		</span>
				()
			</div>

		
			<ul class="tags">
						<li><span class="field">return:</span> 
				TagSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionloadSearchAgentRun" id="functionloadSearchAgentRun"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">loadsearchagentrun</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Run the agent associated with this network search</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			loadSearchAgentRun
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$searchid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$runid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">searchid</span><span class="var-description"> the id of the search whose agent to run</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">runid</span><span class="var-description"> the run id of the run to load.</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionloadSearchAgentRunNew" id="functionloadSearchAgentRunNew"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">loadsearchagentrunnew</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Run the agent associated with this network search</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">ConnectionSet</span>
		<span class="method-name">
			loadSearchAgentRunNew
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$searchid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$runid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">searchid</span><span class="var-description"> the id of the search whose agent to run</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">runid</span><span class="var-description"> the run id of the run to load.</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				ConnectionSet
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionlogin" id="functionlogin"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">login</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Logs a user in.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">User</span>
		<span class="method-name">
			login
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$username</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$password</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">username</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">password</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				User
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionmakeGroupAdmin" id="functionmakeGroupAdmin"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">makegroupadmin</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Make a user an admin of the group. Requires login and user must be an admin for the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Group</span>
		<span class="method-name">
			makeGroupAdmin
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Group
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionrefreshFeed" id="functionrefreshFeed"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">refreshfeed</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Refresh feed. Requires login and user must be owner of the feed.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Feed</span>
		<span class="method-name">
			refreshFeed
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$feedid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">feedid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Feed
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionremoveAllGroupsFromConnection" id="functionremoveAllGroupsFromConnection"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">removeallgroupsfromconnection</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Remove all groups from a Connection. Requires login, user must be the connection owner.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			removeAllGroupsFromConnection
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$connid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">connid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionremoveAllGroupsFromNode" id="functionremoveAllGroupsFromNode"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">removeallgroupsfromnode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Remove all groups from a node. Requires login, user must be the node owner.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Node</span>
		<span class="method-name">
			removeAllGroupsFromNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Node
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionremoveAllURLsFromNode" id="functionremoveAllURLsFromNode"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">removeallurlsfromnode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Remove all URLs from a node. Requires login, user must be owner of the node</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			removeAllURLsFromNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionremoveGroupAdmin" id="functionremoveGroupAdmin"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">removegroupadmin</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Remove a user as admin of the group. Requires login and user must be an admin for the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Group</span>
		<span class="method-name">
			removeGroupAdmin
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Group
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionremoveGroupFromConnection" id="functionremoveGroupFromConnection"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">removegroupfromconnection</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Remove a group from a Connection. Requires login, user must be the connection owner and member of the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			removeGroupFromConnection
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$connid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">connid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionremoveGroupFromConnections" id="functionremoveGroupFromConnections"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">removegroupfromconnections</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Remove a group from a set of Connections. Requires login, user must be the connections owner and member of the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			removeGroupFromConnections
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$connids</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">connids</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionremoveGroupFromNode" id="functionremoveGroupFromNode"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">removegroupfromnode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Remove a group from a node. Requires login, user must be the node owner and member of the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Node</span>
		<span class="method-name">
			removeGroupFromNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Node
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionremoveGroupFromNodes" id="functionremoveGroupFromNodes"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">removegroupfromnodes</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Remove a group from a set of nodes. Requires login, user must be the node owner and member of the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			removeGroupFromNodes
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeids</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeids</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionremoveGroupMember" id="functionremoveGroupMember"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">removegroupmember</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Remove a user from a group. Requires login and user must be an admin for the group.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Group</span>
		<span class="method-name">
			removeGroupMember
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Group
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionremoveURLFromNode" id="functionremoveURLFromNode"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">removeurlfromnode</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Remove a URL from a Node. Requires login, user must be owner of both the node and URL</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			removeURLFromNode
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$urlid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">urlid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionrunSearchAgent" id="functionrunSearchAgent"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">runsearchagent</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Run the agent associated with this network search</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			runSearchAgent
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$searchid</span>, [<span class="var-type">String</span>&nbsp;<span class="var-name">$type</span> = <span class="var-default">&#039;user&#039;</span>])
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">searchid</span><span class="var-description"> the id of the search whose agent to run</span>			</li>
					<li>
				<span class="var-type">String</span>
				<span class="var-name">type</span><span class="var-description"> type, who requested this run, the user themselves through an interface button push  or an automated process like a nightly cron: values = 'user' or 'auto'; default = 'user';</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionsetGroupPrivacy" id="functionsetGroupPrivacy"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">setgroupprivacy</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Make all the users nodes and connections in a group private or public.</p>
<p class="description"><p>Requires login, user must be member of the group, and this will only update the nodes/connections  that the user is the owner of.</p></p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Result</span>
		<span class="method-name">
			setGroupPrivacy
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$groupid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$private</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">groupid</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">private</span><span class="var-description"> (must be either 'Y' or 'N')</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Result
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functiontweetUserIdea" id="functiontweetUserIdea"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">tweetuseridea</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Tweet the idea with the given nodeid to the current user's twitter accounts, if setup.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">void</span>
		<span class="method-name">
			tweetUserIdea
		</span>
					(<span class="var-type">$nodeid</span>&nbsp;<span class="var-name">$nodeid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">$nodeid</span>
				<span class="var-name">nodeid</span><span class="var-description"> the id of the idea to tweet.</span>			</li>
				</ul>
		
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionupdateNodeEndDate" id="functionupdateNodeEndDate"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">updatenodeenddate</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">update a node end date. Requires login and user must be owner of the node.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Node</span>
		<span class="method-name">
			updateNodeEndDate
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$enddatetime</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">enddatetime</span><span class="var-description"> optional text representation of start date and/or time</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span><span class="var-description"> nodeid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Node
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionupdateNodeLocation" id="functionupdateNodeLocation"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">updatenodelocation</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">update a node location. Requires login and user must be owner of the node.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Node</span>
		<span class="method-name">
			updateNodeLocation
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$location</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$loccountry</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">location</span><span class="var-description"> optional</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">loccountry</span><span class="var-description"> optional</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span><span class="var-description"> nodeid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Node
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionupdateNodeStartDate" id="functionupdateNodeStartDate"><!-- --></a>
<div class="oddrow">
	
	<div>
		<span class="method-title">updatenodestartdate</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">update a node start date. Requires login and user must be owner of the node.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">Node</span>
		<span class="method-name">
			updateNodeStartDate
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$nodeid</span>, <span class="var-type">string</span>&nbsp;<span class="var-name">$startdatetime</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">startdatetime</span><span class="var-description"> optional text representation of start date and/or time</span>			</li>
					<li>
				<span class="var-type">string</span>
				<span class="var-name">nodeid</span><span class="var-description"> nodeid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				Node
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
<a name="functionvalidateUserSession" id="functionvalidateUserSession"><!-- --></a>
<div class="evenrow">
	
	<div>
		<span class="method-title">validateusersession</span>
	</div> 

	<!-- ========== Info from phpDoc block ========= -->
<p class="short-description">Check that the session is active and valid for the user passed.</p>
	
	<div class="method-signature" style="display:none;">
		<span class="method-result">User</span>
		<span class="method-name">
			validateUserSession
		</span>
					(<span class="var-type">string</span>&nbsp;<span class="var-name">$userid</span>)
			</div>

			Parameters:
		<ul class="parameters">
					<li>
				<span class="var-type">string</span>
				<span class="var-name">userid</span>			</li>
				</ul>
		
			<ul class="tags">
						<li><span class="field">return:</span> 
				User
									or Error
							</li>
					</ul>
	
		<a href="#sec-functions">back to service index</a> | <a href="#sec-description">back to top</a>
</div>
		</div>
	</div>
	
	<p class="notes" id="credit">
		Documentation generated on Tue, 07 Dec 2010 13:28:21 +0000 by <a href="http://www.phpdoc.org" target="_blank">phpDocumentor 1.4.1</a>
	</p>
	</div>
<?php
    include_once($CFG->dirAddress."ui/dialogfooter.php");
?>