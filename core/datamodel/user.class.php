<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2013 The Open University UK                                   *
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
///////////////////////////////////////
// User Class
///////////////////////////////////////

class user {

    private $phpsessid;
    private $authtype;
    private $isadmin;
    private $openidurl;
    private $password;
    private $email;

    private $interest;
	private $properties;

	// For span icon on user lists

    public $userid;
    public $name;
    public $photo;
    public $thumb;
    public $lastlogin;
    public $lastactive;
    public $status = 0;

    public $isgroup;
    public $userfollow;
    public $followsendemail;
    public $followruninterval;

	public $newsletter = 'N';
	public $recentactivitiesemail = 'N';
    public $location;
    public $countrycode;

    //public $description;
    //public $creationdate;
    //public $modificationdate;
    //public $privatedata;
    //public $website;
    //public $country;
    //public $locationlat;
    //public $locationlng;
    //public $tags;

    //public $location;
    //public $countrycode;
    //public $sociallearnid;
    //public twitterid;

    /**
     * Constructor
     *
     * @param string $userid (optional)
     * @return User (this)
     */
    function user($userid = "") {
        if ($userid != ""){
            $this->userid = $userid;
            return $this;
        }
    }

    /**
     * Loads the data for the user from the database
     * This will not return a "group" (even though groups are
     * stored in the Users table)
     *
     * @param String $style (optional - default 'long') may be 'short' or 'long'
     * @return User object (this) (or Error object)
     */
    function load($style='long'){
        global $DB,$USER, $CFG,$ERROR,$HUB_FLM,$HUB_SQL;

		$params = array();
		$params[0] = $this->userid;
		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_SELECT, $params);

    	if ($resArray !== false) {
			$count = count($resArray);
			if ($count == 0) {
				$ERROR = new Hub_Error;
				$ERROR->createUserNotFoundError($this->userid);
				return $ERROR;
			} else {
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];

					$this->name = stripslashes($array['Name']);
					$this->isgroup = $array['IsGroup'];

					if($array['Photo']){
						//set user photo and thumb the thumb creation is done during registration
						$originalphotopath = $HUB_FLM->createUploadsDirPath($this->userid."/".stripslashes($array['Photo']));
						if (file_exists($originalphotopath)) {
							$this->photo =  $HUB_FLM->getUploadsWebPath($this->userid."/".stripslashes($array['Photo']));
							$this->thumb =  $HUB_FLM->getUploadsWebPath($this->userid."/".str_replace('.','_thumb.', stripslashes($array['Photo'])));
							if (!file_exists($this->thumb)) {
								create_image_thumb($array['Photo'], $CFG->IMAGE_THUMB_WIDTH, $this->userid);
							}
						} else {
							//if the file does not exists how to get it from a upper level? change it to
							//if file doesnot exists directly using default photo
							if ($this->isgroup == "Y") {
								$this->photo =  $HUB_FLM->getUploadsWebPath($CFG->DEFAULT_GROUP_PHOTO);
								$this->thumb =  $HUB_FLM->getUploadsWebPath(str_replace('.','_thumb.', stripslashes($CFG->DEFAULT_GROUP_PHOTO)));
							} else {
								$this->photo =  $HUB_FLM->getUploadsWebPath($CFG->DEFAULT_USER_PHOTO);
								$this->thumb =  $HUB_FLM->getUploadsWebPath(str_replace('.','_thumb.', stripslashes($CFG->DEFAULT_USER_PHOTO)));
							}
						}
					} else {
						if ($this->isgroup == "Y") {
							$this->photo =  $HUB_FLM->getUploadsWebPath($CFG->DEFAULT_GROUP_PHOTO);
							$this->thumb =  $HUB_FLM->getUploadsWebPath(str_replace('.','_thumb.', stripslashes($CFG->DEFAULT_GROUP_PHOTO)));
						} else {
							$this->photo =  $HUB_FLM->getUploadsWebPath($CFG->DEFAULT_USER_PHOTO);
							$this->thumb =  $HUB_FLM->getUploadsWebPath(str_replace('.','_thumb.', stripslashes($CFG->DEFAULT_USER_PHOTO)));
						}
					}
					$this->lastlogin = $array['LastLogin'];
		            $this->lastactive = $array['LastActive'];

					if (isset($array['CurrentStatus'])) {
						$this->status = $array['CurrentStatus'];
					}

					if($style=='long'){
						$this->description = stripslashes($array['Description']);
						$this->creationdate = $array['CreationDate'];
						$this->modificationdate = $array['ModificationDate'];
						$this->privatedata = $array['Private'];
                		$this->openidurl = $array['OpenIDURL'];
						$this->isadmin = $array['IsAdministrator'];
						$this->authtype = $array['AuthType'];
						$this->password = $array['Password'];
						$this->website = $array['Website'];
						$this->email = $array['Email'];
                		$this->sociallearnid = $array['SocialLearnID'];

						if(isset($array['LocationText'])){
							$this->location = $array['LocationText'];
						} else {
							$this->location = "";
						}
						if(isset($array['LocationCountry'])){
							$cs = getCountryList();
							$this->countrycode = $array['LocationCountry'];
							if (isset($cs[$array['LocationCountry']])) {
								$this->country = $cs[$array['LocationCountry']];
							}
						} else {
							$this->countrycode = "";
						}

						if(isset($array['LocationLat'])){
							$this->locationlat = $array['LocationLat'];
						}
						if(isset($array['LocationLng'])){
							$this->locationlng = $array['LocationLng'];
						}

						// REPAIR MISSING COODINATES
						if (isset($this->location) && isset($this->countrycode) && $this->location != "" && $this->countrycode != ""
								&& ( (!isset($array['LocationLng']) || $array['LocationLng'] == "") && (!isset($array['LocationLat']) || $array['LocationLat'] == "")) ) {

							$coords = geoCode($this->location,$this->countrycode);
							if($coords["lat"] != "" && $coords["lng"] != ""){
								$params = array();
								$params[0] = $coords["lat"];
								$params[1] = $coords["lng"];
								$params[2] = $this->userid;
								$res = $DB->insert($HUB_SQL->DATAMODEL_USER_LATLONG_UPDATE, $params);
								$this->locationlat = $coords["lat"];
								$this->locationlng = $coords["lng"];
							}
						}
					}
				}
            }
        } else {
        	return database_error();
        }

		//now add in any tags
		if($style=='long'){
			$params = array();
			$params[0] = $this->userid;
			$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_TAGS, $params);
			if ($resArray !== false) {
				$count = count($resArray);
				if ($count > 0) {
					$this->tags = array();
					for ($i=0; $i<$count; $i++) {
						$array = $resArray[$i];
						$tag = new Tag(trim($array['TagID']));
						array_push($this->tags,$tag->load());
					}
				}
			} else {
				return database_error();
			}
		}

        return $this;

    }

    /**
     * Check whether supplied password matches that in database
     *
     * @param string $password
     * @return boolean
     */
    function validPassword($password){
        global $CFG;

        // can only validate password against cohere auth type users
        if ($this->authtype == $CFG->AUTH_TYPE_COHERE){
            if(password_verify( $password, $this->password )){
               return true;
            } else {
               return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Load user based on their email address
     *
     * @return User object (this) (or Error object)
     */
    function getByEmail(){
        global $DB,$CFG,$ERROR,$HUB_SQL;

 		$params = array();
 		$params[0] = $this->email;
 		$params[1] = $CFG->AUTH_TYPE_OPENID;
 		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_BY_EMAIL_SELECT, $params);
 		if ($resArray !== false) {
 			$count = count($resArray);
 			if ($count == 0) {
				$ERROR = new Hub_Error;
				$ERROR->createUserNotFoundError($this->userid);
				return $ERROR;
			} else {
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];
					$this->userid =  trim($array['UserID']);
				}
			}
		} else {
			return database_error();
		}

        return $this->load();
    }

    /**
     * Load user based on their OpenIDURL
     *
     * @return User object (this) (or Error object)
     */
    function getByOpenIDURL(){
        global $DB,$CFG,$ERROR,$HUB_SQL;

 		$params = array();
 		$params[0] = $this->openidurl;
 		$params[0] = $CFG->AUTH_TYPE_OPENID;
 		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_BY_EMAIL_SELECT, $params);
 		if ($resArray !== false) {
 			$count = count($resArray);
 			if ($count == 0) {
				$ERROR = new Hub_Error;
				$ERROR->createUserNotFoundError($this->userid);
				return $ERROR;
			} else {
				for ($i=0; $i<$count; $i++) {
					$array = $resArray[$i];
					$this->userid =  trim($array['UserID']);
				}
			}
		} else {
			return database_error();
		}

        return $this->load();
    }

    /**
     * Add new users to database
     *
     * @param string $email
     * @param string $name
     * @param string $password
     * @param string $website
     * @param string $isgroup 'Y'/'N'
     * @param string $authtype
     * @param string $description
     * @param string $status
     * @param string $photo
     * @return User object (this) (or Error object)
     */
    function add($email,$name,$password,$website,$isgroup="N",$authtype="",$openidurl="",$description="",$status="",$photo=""){

        global $DB,$CFG,$HUB_SQL;
        $dt = time();

        // If no authtype passed, set to default value
        if ($authtype == "") {
        	$authtype=$CFG->AUTH_TYPE_COHERE;
        }

		// if no status passed then set to default status
		// must be === otherwise status of 0=active will match
		if ($status === "") {
			$status = $CFG->USER_STATUS_UNVALIDATED;
		}

        // If no photo passed then set to the default one
        if ($photo == "") {
        	if ($isgroup == 'Y') {
            	$photo = $CFG->DEFAULT_GROUP_PHOTO;
        	} else {
            	$photo = $CFG->DEFAULT_USER_PHOTO;
            }
        }

        $this->userid = getUniqueID();
		$registrationKey = createRegistrationKey();

		$passwordcrypt = "";
		if ($authtype == $CFG->AUTH_TYPE_COHERE && $password != "") {
			$passwordcrypt = password_hash($password);
		}

		$params = array();
		$params[0] = $this->userid;
		$params[1] = $dt;
		$params[2] = $dt;
		$params[3] = $email;
		$params[4] = $name;
		$params[5] = $passwordcrypt;
		$params[6] = $website;
		$params[7] = 'N';
		$params[8] = $dt;
		$params[9] = 'N';
		$params[10] = $isgroup;
		$params[11] = $authtype;
		$params[11] = $openidurl;
		$params[12] = $description;
		$params[13] = $photo;

		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_ADD, $params);
        if( !$res ) {
            return database_error();
        } else {
            $this->load();

            // add the default roles for user
            $r = new Role();
            $r->setUpDefaultRoles($this->userid);

			// add default links for user.
            $lt = new LinkType();
            $lt->setUpDefaultLinkTypes($this->userid);

            return $this;
        }
    }

    /**
     * Update a users name
     *
     * @param string $name
     * @return User object (this) (or Error object)
     */
    function updateName($name){
        global $DB,$HUB_SQL;

		$params = array();
		$params[0] = $name;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_NAME_UPDATE, $params);
        if( !$res ) {
            return database_error();
        } else {
            $this->name = $name;
            return $this;
        }
    }

    /**
     *  Update a users desctiption
     *
     * @param string $description
     * @return User object (this) (or Error object)
     */
    function updateDescription($desc){
        global $DB,$HUB_SQL;

		$params = array();
		$params[0] = $desc;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_DESC_UPDATE, $params);
        if( !$res ) {
            return database_error();
        } else {
            $this->description = $desc;
            return $this;
        }
    }

    /**
     *  Update a users website
     *
     * @param string $website
     * @return User object (this) (or Error object)
     */
    function updateWebsite($website){
        global $DB,$HUB_SQL;

		$params = array();
		$params[0] = $website;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_WEBSITE_UPDATE, $params);
        if( !$res ) {
            return database_error();
        } else {
            $this->website = $website;
            return $this;
        }
    }

    /**
     *  Update a users public/private setting
     *
     * @param string $private
     * @return User object (this) (or Error object)
     */
    function updatePrivate($private){
        global $DB,$HUB_SQL;

		$params = array();
		$params[0] = $private;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_PRIVACY_UPDATE, $params);
        if( !$res ) {
            return database_error();
        } else {
            $this->privatedata = $private;
            return $this;
        }
    }

    /**
     *  Update a users photo
     *
     * @param string $photo
     * @return User object (this) (or Error object)
     */
    function updatePhoto($photo){
        global $DB,$HUB_SQL,$HUB_FLM;

		$oldphoto = $this->photo;
		$oldthumb = $this->thumb;

		$params = array();
		$params[0] = $photo;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_PHOTO_UPDATE, $params);
        if( !$res ) {
            return database_error();
        } else {
        	// delete any old photos if there are any
            if (isset($oldphoto) && $oldphoto != "") {
            	$basename = basename($oldphoto);
        		$oldirphoto = $HUB_FLM->getUploadsUserDirPath($basename, $this->userid);
        		if ($oldirphoto !== $basename && $basename != $photo) {
	            	unlink($oldirphoto);

					if (isset($oldthumb) && $oldthumb != "") {
						$basename = basename($oldthumb);
						$oldirthumb = $HUB_FLM->getUploadsUserDirPath($basename, $this->userid);
						if ($oldirthumb !== $basename) {
							unlink($oldirthumb);
						}
					}
	            }
            }

        	// need to reload as this parameter is more complex and needs pre-processing
            $this->load();
            return $this;
        }
    }
    /**
     * Update a users email
     *
     * @param string $email
     * @return boolean true if successful else false.
     */
    function updateEmail($email){
        global $DB,$CFG,$HUB_SQL;

        //can only update email address if it's not already in use
 		$params = array();
 		$params[0] = $email;
 		$params[1] = $this->userid;
 		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_EMAIL_UPDATE_CHECK, $params);
 		if ($resArray !== false) {
 			$count = count($resArray);
 			if ($count != 0) {
				return false;
			}
		} else {
			return false;
		}

		$params = array();
		$params[0] = $email;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_EMAIL_UPDATE, $params);
        if( !$res ) {
            return false;
        } else {
			$this->email = $email;
			return true;
        }
    }

    /**
     * Update a users password
     *
     * @param string $password
     * @return boolean
     */
    function updatePassword($password){
        global $DB,$HUB_SQL;

		$params = array();
		$params[0] = password_hash($password);
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_PASSWORD_UPDATE, $params);
        if( !$res ) {
            return database_error();
        } else {
            $this->password = $password;
            return $this;
        }
    }

    /**
     * Update a users last login date/time
     *
     */
    function updateLastLogin(){
        global $DB,$HUB_SQL;
        $dt = time();

		$params = array();
		$params[0] = $dt;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_LAST_LOGIN_UPDATE, $params);
        if( !$res ) {
            return database_error();
        } else {
            $this->lastlogin = $dt;
            $this->updateLastActive($dt);
            return $this;
        }
    }

   /**
     * Update the time the user last did something to now (was active)
     *
     */
    function updateLastActive($time){
        global $DB,$HUB_SQL;

		$params = array();
		$params[0] = $time;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_LAST_ACTIVE_UPDATE, $params);
        if( !$res ) {
            return database_error();
        } else {
            $this->lastactive = $time;
            return $this;
        }
    }


    /**
     * Update the location for this user
     *
     * @return User object (this) (or Error object)
     */
    function updateLocation($location="",$loccountry=""){
        global $DB,$CFG,$USER,$HUB_SQL;

		$params = array();
		$params[0] = $location;
		$params[1] = $loccountry;
		$params[2] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_LOCATION_UPDATE, $params);
		if ($res) {
			//try to geocode
			if ($location != "" && $loccountry != "" && ($location != $this->location || $loccountry != $this->countrycode)){
				$coords = geoCode($location,$loccountry);
				if($coords["lat"] != "" && $coords["lng"] != ""){
					$params = array();
					$params[0] = $coords["lat"];
					$params[1] = $coords["lng"];
					$params[2] = $this->userid;
					$res = $DB->insert($HUB_SQL->DATAMODEL_USER_LATLONG_UPDATE, $params);
				} else {
					$params = array();
					$params[0] = null;
					$params[1] = null;
					$params[2] = $this->userid;
					$res = $DB->insert($HUB_SQL->DATAMODEL_USER_LATLONG_UPDATE, $params);
				}
			}
	        $this->load();
	        return $this;
		} else {
		 	return database_error();
		}
    }


    /**
     * Send Invitation to join cohere and group
     *
     */
    function sendGroupInvitation($group){
        global $CFG,$USER;

        $group  = getGroup($group);
        if ($group->photo != ""){
            $temp_image = "<img src='".$group->photo."' alt='logo for ".$group->name."'/><br/>";
        } else {
            $temp_image = "";
        }
        if ($group->description != ""){
            $temp_desc = "<p>".$group->description."</p>";
        } else {
            $temp_desc = "";
        }
        $paramArray = array ($CFG->homeAddress,
                            $USER->name,
                            $temp_image,
                            $CFG->homeAddress."group.php?groupid=".$group->groupid,
                            $group->name,
                            $temp_desc,
                            $CFG->homeAddress."invite.php?userid=".$this->userid."&code=".$this->getInvitationCode(),
                            $USER->getEmail(),
                            $USER->name);
        sendMail("invitetogroup","Invitation to join Cohere",$this->email,$paramArray);
    }


    /**
     * get users invitation code
     *
     */
    function getInvitationCode(){
        global $DB,$HUB_SQL;

 		$params = array();
 		$params[0] = $this->userid;
 		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_INVITATION_CODE_SELECT, $params);
 		if ($resArray !== false) {
            return $resArray[0]['InvitationCode'];
        }
        return "";
    }

    /**
     * Set users invitation code
     *
     */
    function setInvitationCode(){
        global $DB,$HUB_SQL;
        $code = getUniqueID();

		$params = array();
		$params[0] = $code;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_INVITATION_CODE_UPDATE, $params);
        if( !$res ) {
            return "";
        } else {
            return $code;
        }
    }

    /**
     * Reset users invitation code (so once it;s been used it can't be reused)
     * @return true if successful else false.
     */
    function resetInvitationCode(){
        global $DB,$HUB_SQL;

		$params = array();
		$params[0] = '';
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_INVITATION_CODE_RESET, $params);
        if( !$res ) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Validate users invitation code
     * @return true if successful else false.
     */
    function validateInvitationCode($code){
        global $DB,$HUB_SQL;

 		$params = array();
 		$params[0] = $code;
 		$params[1] = $this->userid;
 		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_INVITATION_CODE_VALIDATE, $params);
 		if (!$resArray) {
            return false;
        } else {
            if(count($resArray) == 0){
                return false;
            } else {
                return true;
            }
        }
    }

    /////////////////////////////////////////////////////
    // getter/setter functions
    // the reason for having these is that the variables are private
    // as we don't want these vars to appear in the REST API output
    // but do need way of setting/getting these variables in other parts
    // of the code
    /////////////////////////////////////////////////////

    /**
     * get PHPSessionID
     *
     * @return string
     */
    function getPHPSessID(){
        return $this->phpsessid;
    }

    /**
     * set PHPSessionID
     *
     * @param string
     */
    function setPHPSessID($phpsessid){
        $this->phpsessid = $phpsessid;
    }

    /**
     * Set email address
     *
     * @param string $email
     */
    function setEmail($email){
        $this->email = $email;
    }

    /**
     * get email address
     *
     * @return string
     */
    function getEmail(){
        return $this->email;
    }

    /**
     * Set OpenIDURL
     *
     * @param string $openidurl
     */
    function setOpenIDURL($openidurl){
        $this->openidurl = $openidurl;
    }

    /**
     * get OpenIDURL
     *
     * @return string
     */
    function getOpenIDURL(){
        return $this->openidurl;
    }

    /**
     * Set AuthType
     *
     * @param string $authtype
     */
    function setAuthType($authtype){
        $this->authtype = $authtype;
    }

    /**
     * get AuthType
     *
     * @return string
     */
    function getAuthType(){
        return $this->authtype;
    }

    /**
     * Set isAdmin
     *
     * @param string $isadmin
     */
    function setIsAdmin($isadmin){
        $this->isadmin = $isadmin;
    }

    /**
     * get isAdmin
     *
     * @return string
     */
    function getIsAdmin(){
        return $this->isadmin;
    }


    /**
     * Update a users Twitter key and secret
     *
     * @param string $twitterkey
     * @param string $twittersecret
     * @return User object (this) (or Error object)
     */
    function updateTwitterAccount($twitterkey,$twittersecret) {
        global $DB;

		$params = array();
		$params[0] = $twitterkey;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_UPDATE_TWITTER_KEY, $params);
        if( !$res ) {
            return database_error();
        }

        if($twittersecret != ''){
			$params = array();
			$params[0] = $twittersecret;
			$params[1] = $this->userid;
			$res = $DB->insert($HUB_SQL->DATAMODEL_USER_UPDATE_TWITTER_SECRET, $params);
			if( !$res ) {
				return database_error();
			}
		}

        $this->load();
        return $this;
    }

    /**
     * get Twitter password
     *
     * @return string
     */
    function getTwitterKey(){
        global $DB;

 		$params = array();
 		$params[0] = $this->userid;
 		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_GET_TWITTER_KEY, $params);
 		if (!$resArray) {
            return "";
        } else {
            if(count($resArray) == 0){
                return "";
            } else {
            	return $resArray[0]['twitterkey'];
            }
        }
    }

    /**
     * get Twitter password
     *
     * @return string
     */
    function getTwitterSecret(){
        global $DB;

 		$params = array();
 		$params[0] = $this->userid;
 		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_GET_TWITTER_SECRET, $params);
 		if (!$resArray) {
            return "";
        } else {
            if(count($resArray) == 0){
                return "";
            } else {
            	return $resArray[0]['twittersecret'];
            }
        }
    }

    /**
     * Update a users SocialLearn ID and password
     *
     * @param string $slid
     * @param string $slpassword
     * @return User object (this) (or Error object)
     */
    function updateSocialLearn($slid,$slpassword){
        global $DB;

		$params = array();
		$params[0] = $slid;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_UPDATE_SOCIALLEARN_ID, $params);
        if( !$res ) {
            return database_error();
        }

		$params = array();
		$params[0] = $slpassword;
		$params[1] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_UPDATE_SOCIALLEARN_PASSWORD, $params);
        if( !$res ) {
            return database_error();
        }

        $this->load();
        return $this;
    }

    /**
     * get SocialLearn password
     *
     * @return string
     */
    function getSocialLearnPassword(){
        global $DB;

        if($this->sociallearnid == ""){
            return "";
        }

 		$params = array();
 		$params[0] = $this->userid;
 		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_GET_SOCIALLEARN_PASSWORD, $params);
 		if (!$resArray) {
            return "";
        } else {
            if(count($resArray) == 0){
                return "";
            } else {
            	return $resArray[0]['slpassword'];
            }
        }
    }

    /**
     * Add a Tag to this url
     *
     * @param string $tagid
     * @return URL object (this) (or Error object)
     */
    function addTag($tagid){
        global $DB,$CFG,$USER,$HUB_SQL;

        //check user can edit the Tag
        $tag = new Tag($tagid);
        $tag->load();
        try {
        	$tag->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        $dt = time();

 		$params = array();
 		$params[0] = $tagid;
 		$params[1] = $this->userid;
 		$resArray = $DB->select($HUB_SQL->DATAMODEL_USER_ADD_TAG_CHECK, $params);
        if ($resArray !== false) {
            $count = count($resArray);
            if( $count == 0 ) {
				$params = array();
				$params[0] = $this->userid;
				$params[1] = $tagid;
				$res = $DB->insert($HUB_SQL->DATAMODEL_USER_ADD_TAG, $params);
                if (!$res) {
                	return database_error();
                }
	 	       	$this->load();
            }
	        return $this;
        } else {
        	return database_error();
        }
    }

    /**
     * Remove a Tag from this user
     *
     * @param string $urlid
     * @return User object (this) (or Error object)
     */
    function removeTag($tagid){
        global $DB,$CFG,$USER,$HUB_SQL;

        //check user can edit the Tag
        $tag = new Tag($tagid);
        $tag->load();
        try {
        	$tag->canedit();
        } catch (Exception $e){
            return access_denied_error();
        }

        $dt = time();

		$params = array();
		$params[0] = $this->userid;
		$params[1] = $tagid;
		$res = $DB->delete($HUB_SQL->DATAMODEL_USER_DELETE, $params);
        if (!$res) {
            return database_error();
        }
        $this->load();
        return $this;
    }

	/**
	 * Update the status for this user
	 *
	 * @return User object (this) (or Error object)
	 */
	function updateStatus($status){
	    global $DB,$CFG,$USER,$HUB_SQL;

	    $dt = time();

		$params = array();
		$params[0] = $status;
		$params[1] = $dt;
		$params[2] = $this->userid;
		$res = $DB->insert($HUB_SQL->DATAMODEL_USER_STATUS_UPDATE, $params);
		if (!$res) {
			return database_error();
		} else {
			$this->status = $status;
		    return $this;
		}
	}

	/**
	 * Return the status for this user
	 *
	 * @return user status
	 */
	function getStatus(){
		return $this->status;
	}

	/**
	 * Set the status for this user in this local object only.
	 */
	function setStatus($status){
		$this->status = $status;
	}
}
?>