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

    // check that user not already logged in
    if(isset($USER->userid)){
        header('Location: '.$CFG->homeAddress.'index.php');
        return;
    }

    $errors = array();

    $ref = optional_param("ref",$CFG->homeAddress."user.php",PARAM_URL);

    // check to see if form submitted
    if(isset($_POST["login"])){
        $username = required_param("username",PARAM_TEXT); // removes
        $password = required_param("password",PARAM_TEXT);
        $referrer = required_param("referrer",PARAM_URL);

        $user = userLogin($username,$password);

        if($user instanceof Hub_Error) {
        	$error = $user;
           	array_push($errors, $error->message);
        	if ($error->code == $LNG->ERROR_LOGIN_FAILED_UNVALIDATED_MESSAGE) {
				$revalidateEmail = true;
        	}
        } else if ($user instanceof User) {
            header('Location: '. $ref);
        } else { // should never happen
        	if (empty($errors)) {
            	array_push($errors,$LNG->LOGIN_INVALID_ERROR);
            }
        }
    }
    include_once($CFG->dirAddress."ui/dialogheader.php");

    $ref2 = optional_param("ref", "", PARAM_TEXT);
?>

<div style="margin-left:20px;">
<h1>Login to Cohere</h1>


<!-- p>Not yet registered? <a href="register.php?ref=<?php echo urlencode($ref2); ?>">Sign Up!</a -->
<?php
    if(!empty($errors)){
        echo "<div class='errors'>";
        echo $errors[0];
        echo "</div>";
    }
?>


<form name="login" action="login.php" method="post">
    <div class="formrow">
        <label class="formlabel" for="username">Username/Email:</label>
        <input class="forminput" id="username" name="username" size="30" value="">
    </div>
    <div class="formrow">
        <label class="formlabel" for="password">Password:</label>
        <input class="forminput" id="password" name="password" type="password"  size="30">
    </div>
    <div class="formrow">
        <input class="formsubmit" type="submit" value="login" id="login" name="login">
        <a href="forgot.php">Forgotten password?</a>
    </div>
    <input type="hidden" name="referrer" value="<?php print $ref; ?>"/>
</form>
</div>

<?php
/*<p>Or login with your <a href="http://openid.net" target="_blank">OpenID</a>:</p>
<form name="openidlogin" action="openid-go-auth.php" method="post">
    <div class="formrow">
        <label class="formlabel" for="openid_url">OpenID URL:</label>
        <input class="forminput" id="openid_url" name="openid_url" type="text" size="30">
    </div>
    <div class="formrow">
        <input class="formsubmit" type="submit" value="login" id="login" name="login">
    </div>
</form>
*/
?>
<?php
    include_once($CFG->dirAddress."ui/dialogfooter.php");
?>