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
 * Logs the into the site
 *
 * @uses $DB
 * @uses $CFG
 * @param string $username
 * @param string $password
 * @return boolean whether login successful or not
 */
function userLogin($username,$password){
    global $DB,$CFG;

    clearSession();

	/** Just in case **/
    if($password == "" || $username == "") {
        $ERROR = new Hub_Error();
        $ERROR->createLoginFailedError();
        return $ERROR;
    }

    $user = new User();
    $user->setEmail($username);
    $user = $user->getByEmail();

	if ($user instanceof User) {
    	// make sure this user is an active user
    	$status = $user->getStatus();

    	if ($status == $CFG->USER_STATUS_ACTIVE) {
    		if ($user->getAuthType() == $CFG->AUTH_TYPE_COHERE) {

				$passwordCheck = $user->validPassword($password);
				if($passwordCheck){

					createSession($user);
					$user->resetInvitationCode(); // hang over from Cohere groups code
					$user->load();
					return $user;
				} else {
					$ERROR = new Hub_Error();
					$ERROR->createLoginFailedError();
					return $ERROR;
				}
        	} else {
				$ERROR = new Hub_Error();
				$ERROR->createLoginFailedError();
				return $ERROR;
			}
		} else {
			$ERROR = new Hub_Error();
			if ($status == $CFG->USER_STATUS_UNAUTHORIZED) {
				$ERROR->createLoginFailedUnauthorizedError();
			} else if ($status == $CFG->USER_STATUS_SUSPENDED) {
				$ERROR->createLoginFailedSuspendedError();
			} else if ($status == $CFG->USER_STATUS_UNVALIDATED) {
				$ERROR->createLoginFailedUnvalidatedError();
			} else {
				$ERROR->createAccessDeniedError();
			}
			return $ERROR;
		}
	} else {
		$ERROR = new Hub_Error();
		$ERROR->createLoginFailedError();
		return $ERROR;
    }
}

/**
 * Start a session
 *
 * @return string | false
 */
function startSession($time = 99999999, $ses = 'Cohere') {
    ini_set('session.cache_expire', $time);
	ini_set('session.gc_maxlifetime', '7200'); // two hours

	session_set_cookie_params($time);

    if(session_id() == '') {
    	//session_name($ses);
    	session_start();
	}

    // Reset the expiration time upon page load
    if (isset($_COOKIE[$ses])){
    	setcookie($ses, $_COOKIE[$ses], time() + $time, "/");
    }
}

/**
 * Clear all session variables
 *
 */
 function clearSession() {
    $_SESSION["session_userid"] = "";
    setcookie("Cohere","",time()-3600, "/");
 }

 /**
  * Create the user session details.
  * (also updates the last login date/time)
  */
 function createSession($user) {
    $_SESSION["session_userid"] = $user->userid;
    setcookie("Cohere",$user->userid,time()+99999999,"/");
    $user->updateLastLogin();
 }

/**
 * Check that the session is active and valid for the user passed.
 */
function validateSession($userid) {
	try {
		if (isset($_SESSION["session_userid"]) && $_SESSION["session_userid"] == $userid) {
			return "OK";
		} else {
			return "Session Invalid";
	    }
	} catch(Exception $e) {
		return "Session Invalid";
	}
}

/**
 * Checks if current user is logged in
 * if not, they get redirected to homepage
 *
 */
function checkLogin(){
    global $USER,$CFG;
    $url = "http" . ((!empty($_SERVER["HTTPS"])) ? "s" : "") . "://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    if(!isset($USER->userid)){
        header('Location: '.$CFG->homeAddress.'login.php?ref='.urlencode($url));
        exit();
    }
}
?>