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
?>
</div> <!-- end innertube -->
</div> <!-- end content -->
</div> <!-- end contentwrapper -->

<div id="sidebar">
    <div class="s_innertube">
    <?php
        include("sidebar.php");
    ?>
    </div>
</div>

</div> <!-- end main -->

<div id="footer" style="border: 1px solid white">
	<div style="height: 24px; padding: 5px; margin-left: 20px; margin-right: 20px; margin-top: 15px;">
		<div style="float:right; line-height:24px">
    	A <a href="http://projects.kmi.open.ac.uk/hyperdiscourse/">KMi</a> Tool
    	| <a href="mailto:<?php print($CFG->EMAIL_REPLY_TO);?>?subject=Cohere Website">Contact</a>
		</div>

		<div style="margin:0 auto; width: 250px; line-height:24px;">
			<a href="<?php print($CFG->homeAddress);?>conditionsofuse.php">Terms of Use</a> |
			<a href="http://kmi.open.ac.uk/accessibility/"><?php echo $LNG->FOOTER_ACCESSIBILITY; ?></a> |
			<a href="<?php print($CFG->homeAddress);?>privacy.php">Privacy</a>
		</div>
	</div>
</div>

<!-- Google analytics -->
<!-- script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
if (typeof(_gat)=="object") {
    var pageTracker = _gat._getTracker("<?php print($CFG->GOOGLE_ANALYTICS_KEY);?>");
    pageTracker._initData();
    pageTracker._trackPageview();
}
</script -->

</div>

</div>

</body>
</html>








