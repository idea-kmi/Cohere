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

///////////////////////////////////////
// Log Class
///////////////////////////////////////

class Log {


    /**
     * Constructor
     *
     */
    function Log(){

    }

    function add($action,$type,$id) {
        global $DB,$USER,$CFG,$HUB_FLM,$HUB_SQL;

        include_once($HUB_FLM->getCodeDirPath('core/utillib.php'));

        $dt = time();
        $ip = "";
        $ref = "";
        if (isset($_SERVER['REMOTE_ADDR'])) {
        	$ip = clean_param($_SERVER['REMOTE_ADDR'], PARAM_TEXT);
        }
        if (isset($_SERVER['HTTP_REFERER'])) {
        	$ref = clean_param($_SERVER['HTTP_REFERER'], PARAM_URL);
        }

		$currentuser = '';
		if (isset($USER->userid)) {
			$currentuser = $USER->userid;
		}

		$params = array();
		$params[0] = $dt;
		$params[1] = $ip;
		$params[2] = $ref;
		$params[3] = $action;
		$params[4] = $type;
		$params[5] = $id;
		$params[6] = $currentuser;

		$res = $DB->insert($HUB_SQL->DATAMODEL_LOG_ADD, $params);
		if (!$res) {
			 return database_error();
		} else {
        	return new Result("added","true");
        }
    }
}
?>