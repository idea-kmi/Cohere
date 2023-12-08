<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2020 The Open University UK                                   *
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

$HUB_SQL->DATAMODEL_FEED_SELECT = "SELECT * FROM Feeds WHERE FeedID=?";
$HUB_SQL->DATAMODEL_FEED_ADD_CHECK = "SELECT FeedID FROM Feeds WHERE UserID=? AND URL=?";
$HUB_SQL->DATAMODEL_FEED_ADD = "INSERT INTO Feeds (FeedID, UserID, URL, Name, CreationDate, LastUpdated, Regular)
                        			VALUES (?,?,?,?,?,?,?)";
$HUB_SQL->DATAMODEL_FEED_DELETE = "DELETE FROM Feeds WHERE FeedID=?";
$HUB_SQL->DATAMODEL_FEED_UPDATE_LASTUPDATED = "UPDATE Feeds SET LastUpdated=? WHERE FeedID=?";
$HUB_SQL->DATAMODEL_FEED_UPDATE_REGULAR = "UPDATE Feeds SET Regular=? WHERE FeedID=?";

$HUB_SQL->DATAMODEL_FEED_CAN_EDIT = "SELECT u.FeedID FROM Feeds u WHERE u.UserID=? AND u.FeedID=";
$HUB_SQL->DATAMODEL_FEED_CAN_DELETE = $HUB_SQL->DATAMODEL_FEED_CAN_EDIT;
$HUB_SQL->DATAMODEL_FEED_CAN_REFRESH = $HUB_SQL->DATAMODEL_FEED_CAN_EDIT;
?>