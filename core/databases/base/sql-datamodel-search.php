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

$HUB_SQL->DATAMODEL_SEARCH_SELECT = "SELECT * FROM Search WHERE SearchID=?";
$HUB_SQL->DATAMODEL_SEARCH_SELECT_AGENT = "SELECT AgentID FROM SearchAgent WHERE SearchID=?";
$HUB_SQL->DATAMODEL_SEARCH_ADD = "INSERT INTO Search (SearchID, UserID, Name, CreationDate, ModificationDate, Scope, Depth, FocalNode, LinkTypes, LinkGroup, LinkSet, Direction, LabelMatch)
									values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$HUB_SQL->DATAMODEL_SEARCH_EDIT = "UPDATE Search SET ModificationDate=?, Name=?, Scope=?, Depth=?, FocalNode=?, LinkTypes=?, LinkGroup=, LinkSet=?, Direction=?, LabelMatch=? WHERE SearchID=?";
$HUB_SQL->DATAMODEL_SEARCH_DELETE = "DELETE FROM Search WHERE SearchID=?";
$HUB_SQL->DATAMODEL_SEARCH_CAN_VIEW = "SELECT SearchID FROM Search WHERE UserID=? AND SearchID=?";
$HUB_SQL->DATAMODEL_SEARCH_CAN_EDIT = $HUB_SQL->DATAMODEL_SEARCH_CAN_VIEW;
$HUB_SQL->DATAMODEL_SEARCH_CAN_DELETE = $HUB_SQL->DATAMODEL_SEARCH_CAN_VIEW;
?>