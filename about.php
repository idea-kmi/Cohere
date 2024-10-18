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
    include_once($CFG->dirAddress."ui/header.php");
?>
<style type="text/css">
#home1 {
    width: 250px;
    float: left;
    margin: 10px;
}
#home2 {
     width: 250px;
    float: left;
    margin: 10px;
}
#home3 {
     width: 250px;
    float: left;
    margin: 10px;
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

    <h1>About Cohere</h1>

	 <p>The Web is about IDEAS+PEOPLE.</p>
	 <p>Cohere is a visual tool to create, connect and share Ideas.</p>
	 <p>Back them up with websites. Support or challenge them. Embed them to spread virally.<br/>
	 Discover who - literally - connects with your thinking.</p>
	 <div id="steps">
		 <div id="home1"><img alt="" src="images/home/idea-blob-step1.png"/><br/>Publish <a href="index.php#node" onclick="setTabPushed('node')">ideas</a> and optionally add relevant websites</div>
		 <div id="home2"><img alt="" src="images/home/idea-blob-step2.png"/><br/>Weave webs of <a href="index.php#conn" onclick="setTabPushed('conn')">meaningful connections</a> between ideas: your own and the world's</div>
		 <div id="home3"><img alt="" src="images/home/idea-blob-step3.png"/><br/>Discover new <a href="index.php#node" onclick="setTabPushed('node')">ideas</a> and <a href="index.php#user" onclick="setTabPushed('user')">people</a></div>
		 <div style="clear:both;"></div>
	 </div>

    <p>We experience the information ocean as streams of media fragments, flowing past us in every modality.</p>
    <p>To make sense of these, learners, researchers and analysts must organise them into coherent patterns.</p>
    <p>Cohere is an idea management tool for you to annotate URLs with ideas, and weave meaningful connections between ideas for personal, team or social use.</p>

    <h2>Key Features</h2>

    <ul>
        <li>Annotate a URL with any number of Ideas, or vice-versa.</li>
        <li>Visualize your network as it grows</li>
        <li>Make connections between your Ideas, or Ideas that anyone else has made public or shared with you via a common Group</li>
        <li>Use Groups to organise your Ideas and Connections by project, and to manage access-rights</li>
        <li>Import your data as RSS feeds (eg. bookmarks or blog posts), to convert them to Ideas, ready for connecting</li>
        <li>Use the <a href="<?php echo $CFG->homeAddress; ?>help/code-doc/Cohere-API/apilib.html">RESTful API services</a> to query, edit and mashup data from other tools</li>
    </ul>

    <h2>Version</h2>

    <p>This is version 1.0 of the Cohere website. Please use 1.0 when entering support queries, bugs or feature requests on our <a href="<?php echo $CFG->supportAddress; ?>" target="_blank">support email address</a>.</p>


	<h2>Open Source</h2>

	<p>Cohere code is available on GitHub under LGPL license.<br>
	
    <h2>Acknowledgements</h2>

    Cohere is a tool developed in the UK <a target="CohereAbout" href="http://www.open.ac.uk">Open University</a>'s
    <a target="CohereAbout" href="http://kmi.open.ac.uk">Knowledge Media Institute</a>, funded by the
    <a target="CohereAbout" href="http://www.hewlett.org/Programs/Education/OER/openEdResources.htm">William and Flora Hewlett Foundation</a>,
    as part of the  <a target="CohereAbout" href="http://www.open.ac.uk/openlearn">OpenLearn</a> initiative to make high quality learning resources and sensemaking tools freely accessible via the Web.
    Cohere design team is
        <a target="CohereAbout" href="http://kmi.open.ac.uk/people/sbs">Simon Buckingham Shum</a>,
        <a target="CohereAbout" href="http://kmi.open.ac.uk/people/bachler">Michelle Bachler</a>,
        <a target="CohereAbout" href="http://alexlittle.net/">Alex Little</a> and
        <a target="CohereAbout" href="http://kmi.open.ac.uk/people/mikele/">Michele Pasin</a>.
    We are indebted to <a target="CohereAbout" href="http://kmi.open.ac.uk/people/harry/">Harriett Cornish</a> for graphic design.
    We gratefully acknowledge use of PARC's <a target="CohereAbout" href="http://prefuse.org/">prefuse</a> visualization toolkit for the Connection Net view.



<?php
    include_once($CFG->dirAddress."ui/footer.php");
?>