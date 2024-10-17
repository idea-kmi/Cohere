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

$HUB_SQL->DATAMODEL_SEARCH_AGENT_SELECT = "SELECT * FROM SearchAgent WHERE AgentID=?";
$HUB_SQL->DATAMODEL_SEARCH_AGENT_RUN_SELECT = "SELECT RunID FROM SearchAgentRun WHERE AgentID=? order by ToDate DESC";
$HUB_SQL->DATAMODEL_SEARCH_AGENT_ADD = "INSERT INTO SearchAgent (AgentID, UserID, SearchID, CreationDate, ModificationDate, LastRun, Email, RunInterval) values (?, ?, ?, ?, ?, ?, ?, ?)";
$HUB_SQL->DATAMODEL_SEARCH_AGENT_EDIT = "UPDATE SearchAgent SET ModificationDate=?,Email=?,RunInterval=?	WHERE AgentID=?";
$HUB_SQL->DATAMODEL_SEARCH_AGENT_DELETE = "DELETE FROM SearchAgent WHERE AgentID=?";
$HUB_SQL->DATAMODEL_SEARCH_AGENT_UPDATE_LASTRUN = "UPDATE SearchAgent SET LastRun=? WHERE AgentID=?";
$HUB_SQL->DATAMODEL_SEARCH_AGENT_SELECT_PREVIOUS_RUN = "SELECT RunID FROM SearchAgentRun WHERE ToDate <=? order by ToDate DESC LIMIT 1";
$HUB_SQL->DATAMODEL_SEARCH_AGENT_CAN_VIEW = "SELECT AgentID FROM SearchAgent WHERE UserID=? AND AgentID=?";
$HUB_SQL->DATAMODEL_SEARCH_AGENT_CAN_EDIT = $HUB_SQL->DATAMODEL_SEARCH_AGENT_CAN_VIEW;
$HUB_SQL->DATAMODEL_SEARCH_AGENT_CAN_DELTE = $HUB_SQL->DATAMODEL_SEARCH_AGENT_CAN_VIEW;
?>