<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2012 The Open University UK                                   *
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
 * Check whether current user is logged in or not
 *
 * @return Error object
 */
function api_check_login(){
    global $USER;
    if(!isset($USER->userid)){
         return access_denied_error();
    }
    return true;
}

/**
 * Create access denied error message
 *
 * @return Error object
 */
function access_denied_error(){
    global $ERROR;
    $ERROR = new Hub_Error;
    $ERROR->message = "Access denied";
    $ERROR->code = "2001";
    return $ERROR;
}

/**
 * Create database error message
 *
 * @param string $error (optional error message)
 * @param string $code (optional error code)
 * @return Error object
 */
function database_error($error="Database error", $code="7000"){
    global $ERROR;
    $ERROR = new Hub_Error;
    $ERROR->message = $error;
    $ERROR->code = $code;
    return $ERROR;
}

/**
 * Create tweet error message
 *
 * @param string $error (optional error message)
 * @param string $code (optional error code)
 * @return Error object
 */
function tweet_error($error="Tweet error", $code="8000"){
    global $ERROR;
    $ERROR = new Hub_Error;
    $ERROR->message = $error;
    $ERROR->code = $code;
    return $ERROR;
}

/**
 * Replace chars with their JSON escaped chars. Also removes line feeds/returns/tabs which mess up JSON validation
 *
 * @param string $str
 * @return string
 */
function parseToJSON($str) {
	//reverse this from reading in
    $str = str_replace("&quot;", '"', $str);
    $str = str_replace("&#039;", "'", $str);
    $str = str_replace("&lt;", "<", $str);
    $str = str_replace("&gt;", ">", $str);

	$str = str_replace('&#43;','+',$str);
	$str = str_replace('&#40;','(',$str);
	$str = str_replace('&#41;',')',$str);
	$str = str_replace('&#61;','=',$str);
    $str = str_replace("&amp;", "&", $str);

    //$str = str_replace(chr(13),' ',$str); // remove returns
    //$str = str_replace(chr(10), ' ',$str); // remove line feeds

    $str = str_replace("\r\n", "\n", $str);
    $str = str_replace("\r", "\n", $str);

    // JSON requires new line characters be escaped
    $str = str_replace("\n", "\\n", $str);

    $str = str_replace(chr(9),' ',$str);  // remove tabs
    $str = str_replace("\"",'\\"',$str); // escape double quotes
    return $str;
}

/**
 * Create a unique ID number (based on users IP address and current time)
 *
 * @return string
 */
function getUniqueID() {
	try {
		return implode('-', [
			bin2hex(random_bytes(4)),
			bin2hex(random_bytes(2)),
			bin2hex(chr((ord(random_bytes(1)) & 0x0F) | 0x40)) . bin2hex(random_bytes(1)),
			bin2hex(chr((ord(random_bytes(1)) & 0x3F) | 0x80)) . bin2hex(random_bytes(1)),
			bin2hex(random_bytes(6))
		]);
	}
	catch(Exception $e) {
		//http://www.php.net/manual/en/function.uniqid.php#94959
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand(0, 0xffff), mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0x0fff) | 0x4000,
			mt_rand(0, 0x3fff) | 0x8000,
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}
}

function get_file_from_url($url,&$errors)  {
    global $CFG;

	$info = pathinfo($url);
	$filename = $CFG->workdir.$info['basename'];

 	$http = array('method'  => 'GET',
	                'request_fulluri' => true,
	                'timeout' => '30');
 	if($CFG->PROXY_HOST != ""){
	    $http['proxy'] = $CFG->PROXY_HOST . ":".$CFG->PROXY_PORT;
	}
	$opts = array();
	$opts['http'] = $http;
	$context  = stream_context_create($opts);

	if ($fp = &fopen($url, 'rb', false, $context)) {
		$contents = '';
		while (!feof($fp)) {
		  $contents .= fread($fp, 8192);
		}
		fclose($fp);
	} else {
    	array_push($errors,"Cannot download url image");
		return "";
	}

	//check its an image
	if ($contents !== FALSE) {
		$im = imagecreatefromstring($contents);
		if ($im !== false) {

		    if (!$handle = fopen($filename, 'wb')) {
		    	array_push($errors,"Cannot open file ($filename)");
		        return"";
		    }

		   // Write $somecontent to our opened file.
		   if (fwrite($handle, $contents) === FALSE) {
			   array_push($errors,"Cannot write to file ($filename)");
		       return "";
		   }
		   fclose($handle);

		   return $filename;
		} else {
	       array_push($errors,"Sorry you can only upload images.");
	       return "";
		}
	} else {
    	array_push($errors,"Cannot download url image");
        return"";
	}
}

/**
 * Upload an image from a url(checking it's actually an image and get it resized
 *
 * @param string $url
 * @param array $errors
 * @param array $errors
 * @return array
 */
function uploadImageURL($url,&$errors,$imagewidth, $directory=""){
    global $CFG, $USER;
    if ($directory =="") {
    	if(!isset($USER->userid)){
        	array_push($errors,"User unknown");
        	return "";
    	} else {
    	 $directory = $USER->userid;
    	}
    }

    $target_path = $CFG->dirAddress."uploads/".$directory."/";
    if(!file_exists($target_path)){
        mkdir($target_path, 0777, true);
    }

    $dt = time();

    $file = get_file_from_url($url,$errors);
    if ($file == "") {
    	return "";
    }

    //replace any non alphanum chars in filename
    $info = pathinfo($file);
    $t_filename = $dt ."_". basename( preg_replace('/[^A-Za-z0-9.]/i', '', $info['basename']));

    //replace the filetype with png (as the resize image code makes everything a png)
    $filename = preg_replace('.[G|g][i|I][f|F]$', '.png',$t_filename);
    $filename = preg_replace('.[J|j][p|P][g|G]$', '.png',$t_filename);
    $filename = preg_replace('.[J|j][p|P][e|E][g|G]$', '.png',$t_filename);
    $target_path = $target_path . $filename;

    if(!getimagesize($file)){
        array_push($errors,"Sorry you can only upload images.");
        $filename = "";
    } else if (filesize($file) > $CFG->IMAGE_MAX_FILESIZE) {
        array_push($errors,"Sorry image file is too large.");
        $filename = "";
    }

    //resize image
    if($filename == "" || !resize_image($file,$target_path,$imagewidth)){
         array_push($errors,"Error resizing image");
         $filename == "";
    }

    //delete original local file
    unlink($file);

    return $filename;

}

/**
 * Upload an image
 * checking it's actually an image and get it resized to default image size
 * on success return file name;
 * of fialuar return error
 *
 * @param string $field
 * @param array $errors
 * @return filename or empty string
 */
function uploadImage($field,&$errors,$imagewidth,$directory=""){
    global $CFG, $USER;

    if ($directory == "") {
    	if(!isset($USER->userid)){
        	array_push($errors,"User unknown");
        	return "";
    	} else {
    	 	$directory = $USER->userid;
    	}
    }

    if ($_FILES[$field]['tmp_name'] != "") {
        $target_path = $CFG->dirAddress. "uploads/" .$directory."/";
        if(!file_exists($target_path)){
            mkdir($target_path, 0777, true);
        }

        //$dt = time();
        //replace any non alphanum chars in filename
        //should warn user about the file type Gary 2009. 01. 13
        //$t_filename = $dt ."_". basename( preg_replace('[^A-Za-z0-9.]', '',$_FILES[$field]['name']));
        $t_filename =  basename( preg_replace('[^A-Za-z0-9.]', '',$_FILES[$field]['name']));

        //echo "t-filename: " . $t_filename;

        //replace the filetype with png (as the resize image code makes everything a png)
        $filename = preg_replace('.[B|b][m|M][p|P]$', '.png', $t_filename);
        $filename = preg_replace('.[G|g][i|I][f|F]$', '.png', $t_filename);
        $filename = preg_replace('.[J|j][p|P][g|G]$', '.png', $t_filename);
        $filename = preg_replace('.[J|j][p|P][e|E][g|G]$', '.png', $t_filename);

       //echo "filename: ".$filename;
       //exit();
        $target_path = $target_path . $filename;

        if(!getimagesize($_FILES[$field]['tmp_name'])){
            array_push($errors,"Sorry you can only upload images.");
            return "";
        } else if (filesize($_FILES[$field]['tmp_name']) > $CFG->IMAGE_MAX_FILESIZE) {
            array_push($errors,"Sorry image file is too large.");
            return "";
        } else if(!move_uploaded_file($_FILES[$field]['tmp_name'], $target_path)) {
            array_push($errors,"An error occured uploading the image");
            return "";
        }

		// image moved but may still be dodgy

        //resize image
        if(!resize_image($target_path,$target_path,$imagewidth)){
             //delete the file, it could be dodgy
			 unlink($target_path);
             array_push($errors,"Error resizing image");
             return "";
        }

       	//create thumnail
       	if (!create_image_thumb($filename, $CFG->IMAGE_THUMB_WIDTH, $directory)){
            //delete the file, it could be dodgy
			unlink($target_path);
       		array_push($errors,"Error create image thumb.");
            return "";
       	}
        return $filename;

    }
    return "";
}

/**
 * Resize an image
 *
 * @param string $in
 * @param string $out
 * @param int $size
 * @return boolean
 */
function resize_image($in,$out,$size){

	$imagetype = @exif_imagetype($in);
	if ($imagetype == IMAGETYPE_JPEG) {
		$image = @imagecreatefromjpeg($in);
	} else if ($imagetype == IMAGETYPE_GIF) {
       $image = @imagecreatefromgif($in);
    } else if ($imagetype == IMAGETYPE_PNG) {
       $image = @imagecreatefrompng($in);
    } else if ($imagetype == IMAGETYPE_BMP) {
       $image = @imagecreatefrombmp($in);
	} else {
      return false;
	}

	if ($image === FALSE) {
		return false;
	}

    $width = imagesx($image);
    $height = imagesy($image);

    //if the 'image' has no width or height it could be dodgy
    if ($width == 0 || $height == 0) {
    	return false;
    }

    $new_width = $width;
    $new_height = $height;

    if($width > 0 && $width > $size){
		$new_width = floatval($size);
		$new_height = $height * ($new_width/$width);
    }

    $image_resized = imagecreatetruecolor($new_width,$new_height);
    imagesavealpha($image_resized, true);
    $trans_colour = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
    imagefill($image_resized, 0, 0, $trans_colour);

    if (imagecopyresampled($image_resized,$image,0,0,0,0,$new_width,$new_height, $width,$height) === FALSE) {
    	return false;
    }
    if (imagepng($image_resized,$out) === FALSE) {
    	return false;
    }

    return true;
}

/**
 * Creat an thumbnail for an image
 *
 * @param string $image
 * @param int $size
 * @param string $directory
 * @return true
 */
function create_image_thumb($image_name, $size, $directory){
	global $CFG, $USER;
    if ($directory == "") {
    	if(!isset($USER->userid)){
        	array_push($errors,"User unknown");
        	return "";
    	} else {
    	 $directory = $USER->userid;
    	}
    }

    $target_path = $CFG->dirAddress. "uploads/" .$directory."/";
    if(!file_exists($target_path)){
        mkdir($target_path, 0777, true);
    }
	$image = $target_path . $image_name;
	$image_thumb = $target_path . str_replace('.','_thumb.',$image_name);

   //echo "imagename=".$image;
   //echo "thumb_imagename=".$image_thumb;

	if(!resize_image($image,$image_thumb,$size)){
   		array_push($errors,"Error resizing image");
   		return False;
	} else {
   		return true;
	}
}

/**
 * Sends an email of the specified template
 *
 * @param string $email
 * @return boolean
 */
function sendMail($template,$subject,$to,$params){
    global $CFG,$HUB_FLM;
    //get emailhead and foot
	$headpath = $HUB_FLM->getMailTemplatePath("emailhead.txt");
    $headtemp = loadFileToString($headpath);

    $head = vsprintf($headtemp,array($CFG->homeAddress."images/cohere_logo2.png"));

	$footpath = $HUB_FLM->getMailTemplatePath("emailfoot.txt");
    $foottemp = loadFileToString($footpath);
    $foot = vsprintf($foottemp,array ($CFG->homeAddress."contact.php"));

    // load the template
	$templatepath = $HUB_FLM->getMailTemplatePath($template.".txt");
	$template = loadFileToString($templatepath);

    $message = $head . vsprintf($template,$params) .$foot;

    $headers = "Content-type: text/html; charset=utf-8\r\n";
    ini_set("sendmail_from", $CFG->EMAIL_FROM_ADDRESS );
    $headers .= "From: ".$CFG->EMAIL_FROM_NAME ." <".$CFG->EMAIL_FROM_ADDRESS .">\r\n";
    $headers .= "Reply-To: ".$CFG->EMAIL_REPLY_TO."\r\n";
    if($CFG->send_mail){
        mail($to,$subject,$message,$headers);
    }
}

/**
 * Sends an email of the specified template
 *
 * @param string $email
 * @return boolean
 */
function sendMailMessage($subject,$to,$message){
    global $CFG,$HUB_FLM;

    //get emailhead and foot
	$headpath = $HUB_FLM->getMailTemplatePath("emailhead.txt");
	$headtemp = loadFileToString($headpath);

    $head = vsprintf($headtemp,array($CFG->homeAddress."images/cohere_logo2.png"));

	$footpath = $HUB_FLM->getMailTemplatePath("emailfoot.txt");
	$foottemp = loadFileToString($footpath);
    $foot = vsprintf($foottemp,array ($CFG->homeAddress));

    $message = $head.$message.$foot;

    $headers = "Content-type: text/html; charset=utf-8\r\n";
    ini_set("sendmail_from", $CFG->EMAIL_FROM_ADDRESS );
    $headers .= "From: ".$CFG->EMAIL_FROM_NAME ." <".$CFG->EMAIL_FROM_ADDRESS .">\r\n";
    $headers .= "Reply-To: ".$CFG->EMAIL_REPLY_TO."\r\n";
    if($CFG->send_mail){
        mail($to,$subject,$message,$headers);
    }
}


/**
 * Method load File into an String.
 *
 * @return string | false
 */
function loadFileToString($file) {
    // If file exists load file into String.
    if(file_exists($file)) {
        return implode('',file($file));
    } else {
        return false;
    }
}

/**
 * Display the help icon
 *
 *
 */
function helpIcon($subject) {
    global $CFG;
    echo "<a href=\"javascript: loadDialog('help','".$CFG->homeAddress."help/help.php?subject=".$subject."')\" class=\"help\"><img border=\"0\" src=\"".$CFG->homeAddress."images/info.png\"/></a>";
}


/**
 * Returns a list of country names
 *
 * @uses $CFG
 * @return array
 */
function getCountryList() {
    global $CFG;

	$string;

    include($CFG->dirAddress .'ui/countries.php');

    if (!empty($string)) {
        uasort($string, 'strcoll');
    }

    return $string;
}

/**
 * Geocode a location
 *
 * @uses $CFG
 * @param string $loc
 * @param string $cc country code for location
 * @return array
 */
function geoCode($loc,$cc) {
    global $CFG;
    $geo = array("lat"=>"", "lng"=>"");

    // BING
   	$geocodeURL = "http://dev.virtualearth.net/REST/v1/Locations?q=".urlencode($loc).",%20".urlencode($cc)."&key=".$CFG->BINGMAPS_KEY;
	//https://docs.microsoft.com/en-us/bingmaps/rest-services/locations/find-a-location-by-query
	//https://www.bingmapsportal.com/Application#

    $http = array('method'  => 'GET',
                    'request_fulluri' => true,
                    'timeout' => '10');
    if($CFG->PROXY_HOST != ""){
        $http['proxy'] = $CFG->PROXY_HOST . ":".$CFG->PROXY_PORT;
    }

    $opts = array();
    $opts['http'] = $http;
    $context  = stream_context_create($opts);

	$response = file_get_contents($geocodeURL, 0, $context);
	if ($response !== false) {
		if ($geodata = json_decode($response)) {
			$geoPoint = $geodata->resourceSets[0]->resources[0]->point->coordinates;
			$geo["lat"] = sprintf($geoPoint[0]);
			$geo["lng"] = sprintf($geoPoint[1]);
		}
	}

    return $geo;
}

/**
 * Ends With
 *
 * @param string $haystack
 * @param string $needle
 * @return boolean
 */
function endsWith($haystack, $needle) {
    return substr($haystack, -strlen($needle)) == $needle;
}


/**
 * Ends With
 *
 * @param string $FullStr
 * @param string $EndStr
 * @return boolean
 */
 /*
function endsWith($FullStr, $EndStr){
    // Get the length of the end string
    $StrLen = strlen($EndStr);
    // Look at the end of FullStr for the substring the size of EndStr
    $FullStrEnd = substr($FullStr, strlen($FullStr) - $StrLen);
    // If it matches, it does end with EndStr
    return $FullStrEnd == $EndStr;
}
*/

/**
 * Send a tweet to the Cohere tweet account for the given message and the given Cohere url.
 * @param $message the message to sent to twitter
 * @param $username the name of the person to append to tweet as 'by XX'. Can by "" if not required
 * @param $url the Cohere url to add to the message (will be shortened with Bit.ly)
 * @param $twitterkey the twitter account key of the account to sent the tweet to.
 * @param $twittersecret the twitter secret for that account.
 * @param $hashtag any hashtag to append to the message (optional parameter);
 * @return Result or Error
 */
function tweet($message, $username, $url, $twitterkey, $twittersecret, $hashtag) {
	global  $CFG;

	require_once("lib/twitter-async/EpiCurl.php");
	require_once("lib/twitter-async/EpiOAuth.php");
	require_once("lib/twitter-async/EpiTwitter.php");

	try{
		$twitterObj = new EpiTwitter($CGF->TWITTER_CONSUMER_KEY, $CFG->TWITTER_CONSUMER_SECRET, $twitterkey, $twittersecret);

		$shortURL = getBitlyUrl($url);

		if (!$shortURL) {
			$shortURL = $url;
		}

		$tweet = $message;

		$len = 126; // 140 minus known required text and spaces
		if ($hashtag) {
			$len = 125-strlen($hashtag); // 125 = 1 space before hastag;
		}

		$byname = ": by ".$username;
		$labelen = $len-strlen($shortURL)-strlen($username);
		if ($username == "") {
			$labelen = $len-strlen($shortURL)+5;
			$byname = "";
		}

		if (strlen($tweet) > $labelen) {
			$tweet = substr($tweet, 0, $labelen)."...";
		}

		$tweetMessage = $tweet.$byname." more:".$shortURL;
		if ($hashtag) {
			$tweetMessage = $tweetMessage." ".$hashtag;
		}

		// does not work
		//$response = $twitterObj->post_statusesUpdate(array('status' => $tweetMessage));

		$response = $twitterObj->post('/statuses/update.xml', array('status' => $tweetMessage));

		$xml = simplexml_load_string($response->data);

		if ($xml->error != null) {
			return tweet_error((string)$xml->error);
		} else {
			return new Result("tweet sent", true);
		}

	} catch(Exception $e){
		return tweet_error($e->getMessage());
	}
}

/**
 * Return a short Bit.ly url for the given url
 * @param $url the url to shorten.
 * @return shortened url or false;
 */
function  getBitlyUrl($url) {
	global $CFG;

	if ($CFG->BITLY_LOGIN != "" && $CFG->BITLY_KEY != "") {

		$bitly = 'http://api.bit.ly/shorten?version=2.0.1&longUrl='.urlencode($url).'&login='.$CFG->BITLY_LOGIN.'&apiKey='.$CFG->BITLY_KEY.'&format=xml';
		$http = array('method'  => 'GET',
				'request_fulluri' => true,
				'timeout' => '2');
		if($CFG->PROXY_HOST != ""){
			$http['proxy'] = $CFG->PROXY_HOST . ":".$CFG->PROXY_PORT;
		}
		$opts = array();
		$opts['http'] = $http;
		$context  = stream_context_create($opts);

		$response = file_get_contents($bitly, false, $context);
		$xml = simplexml_load_string($response);

		if ($xml->results->errorCode == 0) {
			return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
		} else {
			false;
		}
	} else {
		return false;
	}
}

/**
 * Delete the given directory
 *
 * [EDITOR NOTE: "Credits to erkethan at free dot fr." - thiago]
 */
function deleteDirectory($dir) {
    if (!file_exists($dir)) return true;

    if (!is_dir($dir) || is_link($dir)) return unlink($dir);

	foreach (scandir($dir) as $item) {
		if ($item == '.' || $item == '..') continue;
		if (!deleteDirectory($dir . "/" . $item)) {
			chmod($dir . "/" . $item, 0777);
			if (!deleteDirectory($dir . "/" . $item)) return false;
		};
	}
	return rmdir($dir);
}


/**
 * Sort objects by title value
 */
function titleSort($a,$b) {
	if (isset($a->title) && isset($b->title)) {
		return strcmp($a->title, $b->title);
	} else {
		return 0;
	}
}


?>