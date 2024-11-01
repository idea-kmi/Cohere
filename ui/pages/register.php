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

    // check if user already logged in
    if(isset($USER->userid)){
        header('Location: index.php');
		exit();
    }

    include_once($CFG->dirAddress."ui/dialogheader.php");

    if($CFG->CAPTCHA_ON) {
		array_push($HEADER,'<script src="https://www.google.com/recaptcha/api.js" type="text/javascript"></script>');
	}

    require_once($HUB_FLM->getCodeDirPath("core/lib/recaptcha/autoload.php"));

    $errors = array();
    $email = trim(optional_param("email","",PARAM_TEXT));
    $password = trim(optional_param("password","",PARAM_TEXT));
    $confirmpassword = trim(optional_param("confirmpassword","",PARAM_TEXT));
    $fullname = trim(optional_param("fullname","",PARAM_TEXT));

    $description = optional_param("description","",PARAM_TEXT);

    $location = optional_param("location","",PARAM_TEXT);
    $loccountry = optional_param("loccountry","",PARAM_TEXT);

    $homepage = optional_param("homepage","",PARAM_URL);
    $homepage2 = optional_param("homepage","",PARAM_TEXT);

    $privatedata = optional_param("defaultaccess","Y",PARAM_ALPHA);

    $ref = optional_param("ref",'',PARAM_TEXT);

    if(isset($_POST["register"])){
        // check email, password & full name provided
        if (!validEmail($email)) {
            array_push($errors,"Please enter a valid email address.");
        } else {
	        if ($password == ""){
	            array_push($errors,"Please enter a password.");
	        }
	        if ($fullname == ""){
	            array_push($errors,"Please enter your full name.");
	        }
	        // check password & confirm password match
	        if ($password != $confirmpassword){
	            array_push($errors,"The password and password confirmation don't match.");
	        }

	        // check url
	        if($homepage2 != "" && $homepage != $homepage2){
	            array_push($errors,"Please enter a full valid URL (including 'http://') for your homepage.");
	            $homepage = $homepage2;
	        }

			if (empty($errors)) {
		        // check username not already in use

				$u = new User();
				$u->setEmail($email);
				$user = $u->getByEmail();

				if($user instanceof User){
					array_push($errors,"This email address is already in use, please either login or select a different email address.");
				} else {
					if($CFG->CAPTCHA_ON) {
						$reCaptcha = new \ReCaptcha\ReCaptcha($CFG->CAPTCHA_PRIVATE);
						$response = $reCaptcha->setExpectedHostname($CFG->CAPTCHA_DOMAIN)
							->verify(
								$recaptcha_response_field,
								$_SERVER["REMOTE_ADDR"]
						);
						if ($response == null || !$response->isSuccess()) {
							if (isset($response) && $response != null) {
								error_log($response->getErrorCodes());
							}
							array_push($errors, $LNG->FORM_ERROR_CAPTCHA_INVALID);
						}
					}

        			if(empty($errors)){

						// only create user if no error so far
						// create new user
						$u->add($email,$fullname,$password,$homepage,'N',$CFG->AUTH_TYPE_COHERE,"",$description,'');
						$u->updatePrivate($privatedata);
						$u->updateLocation($location,$loccountry);

						$photofilename = "";
						if(empty($errors)){
							// upload image if provided
							if ($_FILES['photo']['tmp_name'] != "") {
								// Can't upload photo without userid
								$USER = $u;
								$photofilename = uploadImage('photo',$errors,$CFG->IMAGE_WIDTH);
								$USER = null;
							} else {
								$photofilename = $CFG->DEFAULT_USER_PHOTO;
							}
						}

						$u->updatePhoto($photofilename);

						echo "<h1>Registration successful</h1>";
					} else {
						array_push($errors,"The reCAPTCHA wasn't entered correctly. Please try it again. ");
					   // "(reCAPTCHA said: " . $resp->error . ")
					}
				}
	        }
        }

        if(empty($errors)){
		    $referrer = required_param("referrer",PARAM_TEXT);
		    echo "ref=".$referrer;
        	echo "You can now <a href='login.php?ref=".urlencode($referrer)."'>log in</a>";
	        include_once("includes/dialogfooter.php");
	        die;
        }
    }

    $countries = getCountryList();
?>
<div style="margin-left:20px;">

<h1>Register</h1>

<?php
    if(!empty($errors)){
        echo "<div class='errors'>The following problems were found with your form, please try again:<ul>";
        foreach ($errors as $error){
            echo "<li>".$error."</li>";
        }
        echo "</ul></div>";
    }
?>

<p><span class="required">*</span> indicates required field</p>

<form name="register" action="register.php" method="post" enctype="multipart/form-data">

    <input type="hidden" name="referrer" value="<?php print $ref; ?>"/>

    <div class="formrow">
        <label class="formlabel" for="email">Email:</label>
        <input class="forminput" id="email" name="email" size="40" value="<?php print $email; ?>"><span class="required">*</span>
    </div>
    <div class="formrow">
        <label class="formlabel" for="password">Password:</label>
        <input class="forminput" id="password" name="password" type="password"  size="30" value="<?php print $password; ?>"><span class="required">*</span>
    </div>
    <div class="formrow">
        <label class="formlabel" for="confirmpassword">Confirm Password:</label>
        <input class="forminput" id="confirmpassword" name="confirmpassword" type="password" size="30" value="<?php print $confirmpassword; ?>"><span class="required">*</span>
    </div>
    <div class="formrow">
        <label class="formlabel" for="fullname">Full name:</label>
        <input class="forminput" type="text" id="fullname" name="fullname" size="40" value="<?php print $fullname; ?>"><span class="required">*</span>
    </div>
    <div class="formrow">
        <label class="formlabel" for="description">Description:</label>
        <textarea class="forminput" id="description" name="description" cols="40" rows="5"><?php print $description; ?></textarea>
    </div>

    <div class="formrow">
		<label class="formlabel" for="location">Location: (town/city)</label>
		<input class="forminput" id="location" name="location" style="width:160px;" value="<?php echo $location; ?>">
		<select id="loccountry" name="loccountry" style="margin-left: 5px;width:160px;">
	        <option value="" >Country...</option>
	        <?php
	            foreach($countries as $code=>$c){
	                echo "<option value='".$code."'";
	                if($code == $loccountry){
	                    echo " selected='true'";
	                }
	                echo ">".$c."</option>";
	            }
	        ?>
	    </select>
	</div>

	<div class="formrow">
        <label class="formlabel" for="homepage">Homepage:</label>
        <input class="forminput" type="text" id="homepage" name="homepage" size="40" value="<?php print $homepage; ?>">
    </div>
    <div class="formrow">
        <label class="formlabel" for="photo">Photo:</label>
        <input class="forminput" type="file" id="photo" name="photo" size="40">
    </div>
    <div class="formrow">
        <label class="formlabel" for="defaultaccess">By default keep my data:</label>
        <input class="forminput" type="radio" id="defaultaccessprivate" name="defaultaccess" value="Y"
        <?php if($privatedata == "Y"){ echo "checked='checked'";}?>>Private
        <input type="radio" id="defaultaccesspublic" name="defaultaccess" value="N"
        <?php if($privatedata == "N"){ echo "checked='checked'";}?>>Public
    </div>

	<?php if($CFG->CAPTCHA_ON) { ?>
		<div class="formrow" style="width:800px;">
			<label class="formlabelbig" for="g-recaptcha"><?php echo $LNG->FORM_REGISTER_CAPTCHA; ?></label>
			<div class="g-recaptcha" data-sitekey="<?php echo $CFG->CAPTCHA_PUBLIC; ?>" style="float:left;margin-left:5px;"></div>
		</div>
	<?php } ?>

    <div class="formrow">
        <input class="formsubmit" type="submit" value="Register" id="register" name="register">
    </div>

</form>
</div>

<?php
    include_once($CFG->dirAddress."ui/dialogfooter.php");
?>
