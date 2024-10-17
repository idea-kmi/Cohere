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

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- 
-- Database: `cohere`
-- 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE if not exists `cohere`;

USE `cohere`;

-- --------------------------------------------------------

--
-- Table structure for table `AuditNode`
--

CREATE TABLE `AuditNode` (
  `NodeID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `Name` text DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `ModificationDate` double NOT NULL DEFAULT 0,
  `ChangeType` varchar(255) NOT NULL DEFAULT '',
  `NodeXML` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `AuditTriple`
--

CREATE TABLE `AuditTriple` (
  `TripleID` varchar(50) NOT NULL DEFAULT '',
  `LinkTypeID` varchar(50) DEFAULT NULL,
  `FromID` varchar(50) DEFAULT NULL,
  `ToID` varchar(50) DEFAULT NULL,
  `Label` text DEFAULT NULL,
  `FromContextTypeID` varchar(50) DEFAULT NULL,
  `ToContextTypeID` varchar(50) DEFAULT NULL,
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `ModificationDate` double NOT NULL DEFAULT 0,
  `ChangeType` varchar(255) NOT NULL DEFAULT '',
  `TripleXML` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `AuditURL`
--

CREATE TABLE `AuditURL` (
  `URLID` varchar(50) NOT NULL DEFAULT '',
  `TagID` varchar(50) DEFAULT NULL,
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `URL` text DEFAULT NULL,
  `Title` text DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  `ModificationDate` double NOT NULL DEFAULT 0,
  `ChangeType` varchar(255) NOT NULL DEFAULT '',
  `URLXML` text DEFAULT NULL,
  `Clip` text DEFAULT NULL,
  `ClipPath` text DEFAULT NULL,
  `ClipHTML` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `AuditView`
--

CREATE TABLE `AuditView` (
  `ViewID` varchar(50) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `ViewType` varchar(255) DEFAULT NULL,
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `ModificationDate` double NOT NULL DEFAULT 0,
  `ChangeType` varchar(255) NOT NULL DEFAULT '',
  `XML` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `AuditViewAssignment`
--

CREATE TABLE `AuditViewAssignment` (
  `ViewID` varchar(50) NOT NULL,
  `ItemID` varchar(50) NOT NULL DEFAULT '',
  `Type` int(10) NOT NULL DEFAULT 0,
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `ModificationDate` double NOT NULL DEFAULT 0,
  `ChangeType` varchar(255) NOT NULL DEFAULT '',
  `XML` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `Feeds`
--

CREATE TABLE `Feeds` (
  `FeedID` varchar(50) NOT NULL DEFAULT '',
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `URL` text NOT NULL,
  `Name` text NOT NULL,
  `FeedType` varchar(255) DEFAULT NULL,
  `CreationDate` double NOT NULL DEFAULT 0,
  `LastUpdated` double NOT NULL DEFAULT 0,
  `Regular` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `Following`
--

CREATE TABLE `Following` (
  `UserID` varchar(50) NOT NULL,
  `ItemID` varchar(50) NOT NULL,
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `LinkType`
--

CREATE TABLE `LinkType` (
  `LinkTypeID` varchar(60) NOT NULL DEFAULT '',
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `Color` varchar(255) DEFAULT '#000000',
  `ToContextTypeID` varchar(50) DEFAULT NULL,
  `FromContextTypeID` varchar(50) DEFAULT NULL,
  `Label` text NOT NULL,
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `LinkTypeGroup`
--

CREATE TABLE `LinkTypeGroup` (
  `LinkTypeGroupID` varchar(50) NOT NULL DEFAULT '',
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `Label` text NOT NULL,
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `LinkTypeGrouping`
--

CREATE TABLE `LinkTypeGrouping` (
  `LinkTypeGroupID` varchar(50) NOT NULL DEFAULT '0',
  `LinkTypeID` varchar(60) NOT NULL DEFAULT '0',
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `LinkTypeProperty`
--

CREATE TABLE `LinkTypeProperty` (
  `LinkTypePropertyID` varchar(50) NOT NULL DEFAULT '',
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `Property` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT '',
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `LinkTypePropertyAssignment`
--

CREATE TABLE `LinkTypePropertyAssignment` (
  `LinkTypeID` char(50) NOT NULL DEFAULT '0',
  `LinkTypePropertyID` char(50) NOT NULL DEFAULT '0',
  `UserID` char(50) NOT NULL DEFAULT '0',
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `Log`
--

CREATE TABLE `Log` (
  `LogID` bigint(20) UNSIGNED NOT NULL,
  `LogDateTime` double NOT NULL DEFAULT 0,
  `LogIP` varchar(45) DEFAULT NULL,
  `LogReferer` text DEFAULT NULL,
  `LogAction` varchar(255) DEFAULT NULL,
  `LogObjectType` varchar(45) DEFAULT NULL,
  `LogObjectID` varchar(45) DEFAULT NULL,
  `UserID` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `Node`
--

CREATE TABLE `Node` (
  `NodeID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `Name` text NOT NULL,
  `CreationDate` double NOT NULL DEFAULT 0,
  `Description` text DEFAULT NULL,
  `CurrentStatus` int(11) NOT NULL DEFAULT 0,
  `Image` varchar(255) DEFAULT NULL,
  `ImageThumbnail` varchar(255) DEFAULT NULL,
  `ModificationDate` double NOT NULL DEFAULT 0,
  `CreatedFrom` varchar(50) NOT NULL DEFAULT 'cohere',
  `Private` enum('N','Y') DEFAULT 'Y',
  `StartDate` double DEFAULT NULL,
  `EndDate` double DEFAULT NULL,
  `LocationText` varchar(255) DEFAULT NULL,
  `LocationCountry` char(2) DEFAULT NULL,
  `LocationLat` decimal(18,15) DEFAULT NULL,
  `LocationLng` decimal(18,15) DEFAULT NULL,
  `NodeTypeID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `NodeGroup`
--

CREATE TABLE `NodeGroup` (
  `NodeID` varchar(50) NOT NULL,
  `GroupID` varchar(50) NOT NULL DEFAULT '',
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `NodeType`
--

CREATE TABLE `NodeType` (
  `NodeTypeID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `CreationDate` double NOT NULL DEFAULT 0,
  `Image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `NodeTypeGroup`
--

CREATE TABLE `NodeTypeGroup` (
  `NodeTypeGroupID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `NodeTypeGrouping`
--

CREATE TABLE `NodeTypeGrouping` (
  `NodeTypeGroupID` varchar(50) NOT NULL DEFAULT '0',
  `NodeTypeID` varchar(50) NOT NULL DEFAULT '0',
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Search`
--

CREATE TABLE `Search` (
  `SearchID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Name` varchar(254) NOT NULL,
  `CreationDate` double NOT NULL,
  `ModificationDate` double NOT NULL,
  `Scope` varchar(3) NOT NULL DEFAULT 'my',
  `Depth` int(11) DEFAULT 1,
  `FocalNode` varchar(50) DEFAULT NULL,
  `LinkTypes` text DEFAULT NULL,
  `LinkGroup` varchar(50) DEFAULT NULL,
  `LinkSet` varchar(50) DEFAULT NULL,
  `Direction` int(1) DEFAULT 2,
  `LabelMatch` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SearchAgent`
--

CREATE TABLE `SearchAgent` (
  `AgentID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `SearchID` varchar(50) NOT NULL,
  `CreationDate` double NOT NULL,
  `ModificationDate` double NOT NULL,
  `LastRun` double DEFAULT 0,
  `Email` int(1) NOT NULL DEFAULT 0,
  `RunInterval` varchar(50) NOT NULL DEFAULT 'monthly'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SearchAgentRun`
--

CREATE TABLE `SearchAgentRun` (
  `RunID` varchar(50) NOT NULL,
  `AgentID` varchar(50) DEFAULT NULL,
  `UserID` varchar(50) DEFAULT NULL,
  `FromDate` double DEFAULT NULL,
  `ToDate` double DEFAULT NULL,
  `RunType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `SearchAgentRunResults`
--

CREATE TABLE `SearchAgentRunResults` (
  `RunID` varchar(50) NOT NULL,
  `TripleID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `Tag`
--

CREATE TABLE `Tag` (
  `TagID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `CreationDate` double NOT NULL,
  `ModificationDate` double NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TagGroup`
--

CREATE TABLE `TagGroup` (
  `TagGroupID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreationDate` double NOT NULL,
  `ModificationDate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TagGrouping`
--

CREATE TABLE `TagGrouping` (
  `TagID` varchar(50) NOT NULL,
  `TagGroupID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `CreationDate` double NOT NULL,
  `ModificationDate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TagNode`
--

CREATE TABLE `TagNode` (
  `NodeID` varchar(50) NOT NULL,
  `TagID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TagTriple`
--

CREATE TABLE `TagTriple` (
  `TripleID` varchar(50) NOT NULL,
  `TagID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TagURL`
--

CREATE TABLE `TagURL` (
  `URLID` varchar(50) NOT NULL,
  `TagID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TagUsers`
--

CREATE TABLE `TagUsers` (
  `UserID` varchar(50) NOT NULL,
  `TagID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Triple`
--

CREATE TABLE `Triple` (
  `TripleID` varchar(50) NOT NULL DEFAULT '',
  `LinkTypeID` varchar(60) NOT NULL DEFAULT '',
  `FromID` varchar(50) NOT NULL DEFAULT '',
  `ToID` varchar(50) NOT NULL DEFAULT '',
  `Label` text DEFAULT NULL,
  `FromContextTypeID` varchar(50) DEFAULT NULL,
  `ToContextTypeID` varchar(50) DEFAULT NULL,
  `CurrentStatus` int(11) NOT NULL DEFAULT 0,
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `CreationDate` double NOT NULL DEFAULT 0,
  `FromLabel` text NOT NULL,
  `ToLabel` text NOT NULL,
  `ModificationDate` double NOT NULL DEFAULT 0,
  `CreatedFrom` varchar(50) NOT NULL DEFAULT 'cohere',
  `Private` enum('Y','N') DEFAULT 'Y',
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `TripleGroup`
--

CREATE TABLE `TripleGroup` (
  `TripleID` varchar(50) NOT NULL DEFAULT '',
  `GroupID` varchar(50) NOT NULL DEFAULT '',
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `URL`
--

CREATE TABLE `URL` (
  `URLID` varchar(50) NOT NULL DEFAULT '',
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `CreationDate` double NOT NULL DEFAULT 0,
  `URL` text NOT NULL,
  `Title` text DEFAULT NULL,
  `Private` enum('Y','N') NOT NULL DEFAULT 'Y',
  `CurrentStatus` int(11) NOT NULL DEFAULT 0,
  `Description` text DEFAULT NULL,
  `ModificationDate` double NOT NULL DEFAULT 0,
  `CreatedFrom` varchar(50) NOT NULL DEFAULT '',
  `Clip` text DEFAULT NULL,
  `ClipPath` text DEFAULT NULL,
  `ClipHTML` text DEFAULT NULL,
  `AdditionalIdentifier` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `URLGroup`
--

CREATE TABLE `URLGroup` (
  `URLID` varchar(50) NOT NULL DEFAULT '',
  `GroupID` varchar(50) NOT NULL DEFAULT '',
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `URLNode`
--

CREATE TABLE `URLNode` (
  `UserID` varchar(50) NOT NULL DEFAULT '0',
  `URLID` varchar(50) NOT NULL DEFAULT '0',
  `NodeID` varchar(50) NOT NULL DEFAULT '0',
  `CreationDate` double NOT NULL DEFAULT 0,
  `Comments` text DEFAULT NULL,
  `CurrentStatus` int(11) DEFAULT 0,
  `ModificationDate` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `UserGroup`
--

CREATE TABLE `UserGroup` (
  `GroupID` varchar(50) NOT NULL DEFAULT '',
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `CreationDate` double NOT NULL DEFAULT 0,
  `IsAdmin` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `CreationDate` double NOT NULL DEFAULT 0,
  `ModificationDate` double NOT NULL DEFAULT 0,
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Description` text DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `LastLogin` double NOT NULL DEFAULT 0,
  `LastActive` double NOT NULL DEFAULT 0,
  `IsAdministrator` enum('N','Y') NOT NULL DEFAULT 'N',
  `IsGroup` enum('N','Y') NOT NULL DEFAULT 'N',
  `CurrentStatus` int(11) NOT NULL DEFAULT 0,
  `Website` varchar(255) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Private` enum('N','Y') NOT NULL DEFAULT 'N',
  `AuthType` varchar(10) NOT NULL DEFAULT 'cohere',
  `OpenIDURL` text DEFAULT NULL,
  `InvitationCode` varchar(50) DEFAULT NULL,
  `SocialLearnID` varchar(45) NOT NULL DEFAULT '',
  `SocialLearnPassword` blob DEFAULT NULL,
  `TwitterID` varchar(255) NOT NULL DEFAULT '',
  `TwitterPassword` varchar(255) NOT NULL DEFAULT '',
  `LocationText` varchar(255) DEFAULT NULL,
  `LocationCountry` char(2) DEFAULT NULL,
  `LocationLat` decimal(18,15) DEFAULT NULL,
  `LocationLng` decimal(18,15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `UsersCache`
--

CREATE TABLE `UsersCache` (
  `UsersCacheID` int(10) UNSIGNED NOT NULL,
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `NodeID` varchar(50) NOT NULL,
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `View`
--

CREATE TABLE `View` (
  `ViewID` varchar(50) NOT NULL DEFAULT '',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `ViewType` varchar(255) DEFAULT NULL,
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `CreationDate` double NOT NULL DEFAULT 0,
  `CurrentStatus` int(11) NOT NULL DEFAULT 0,
  `ModificationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ViewAssignment`
--

CREATE TABLE `ViewAssignment` (
  `ViewID` varchar(50) NOT NULL,
  `ItemID` varchar(50) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `ItemType` varchar(50) NOT NULL DEFAULT '0',
  `CreationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `Voting`
--

CREATE TABLE `Voting` (
  `VoteID` int(10) UNSIGNED NOT NULL,
  `UserID` varchar(50) NOT NULL DEFAULT '',
  `ItemID` varchar(50) NOT NULL,
  `VoteType` enum('N','Y') NOT NULL DEFAULT 'Y',
  `CreationDate` double NOT NULL DEFAULT 0,
  `ModificationDate` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Feeds`
--
ALTER TABLE `Feeds`
  ADD PRIMARY KEY (`FeedID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Following`
--
ALTER TABLE `Following`
  ADD PRIMARY KEY (`UserID`,`ItemID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `LinkType`
--
ALTER TABLE `LinkType`
  ADD PRIMARY KEY (`LinkTypeID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `FromContextTypeID` (`FromContextTypeID`),
  ADD KEY `ToContextTypeID` (`ToContextTypeID`);

--
-- Indexes for table `LinkTypeGroup`
--
ALTER TABLE `LinkTypeGroup`
  ADD PRIMARY KEY (`LinkTypeGroupID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `LinkTypeGrouping`
--
ALTER TABLE `LinkTypeGrouping`
  ADD PRIMARY KEY (`LinkTypeGroupID`,`LinkTypeID`,`UserID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `LinkTypeID` (`LinkTypeID`);

--
-- Indexes for table `LinkTypeProperty`
--
ALTER TABLE `LinkTypeProperty`
  ADD PRIMARY KEY (`LinkTypePropertyID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `LinkTypePropertyAssignment`
--
ALTER TABLE `LinkTypePropertyAssignment`
  ADD PRIMARY KEY (`LinkTypeID`,`LinkTypePropertyID`,`UserID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `LinkTypePropertyID` (`LinkTypePropertyID`);

--
-- Indexes for table `Log`
--
ALTER TABLE `Log`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Node`
--
ALTER TABLE `Node`
  ADD PRIMARY KEY (`NodeID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `NodeGroup`
--
ALTER TABLE `NodeGroup`
  ADD PRIMARY KEY (`NodeID`,`GroupID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `NodeType`
--
ALTER TABLE `NodeType`
  ADD PRIMARY KEY (`NodeTypeID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `NodeTypeGroup`
--
ALTER TABLE `NodeTypeGroup`
  ADD PRIMARY KEY (`NodeTypeGroupID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `NodeTypeGrouping`
--
ALTER TABLE `NodeTypeGrouping`
  ADD PRIMARY KEY (`NodeTypeGroupID`,`NodeTypeID`,`UserID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ContextualNodeTypeID` (`NodeTypeID`);

--
-- Indexes for table `Search`
--
ALTER TABLE `Search`
  ADD PRIMARY KEY (`SearchID`),
  ADD KEY `Search_ibfk_1` (`UserID`),
  ADD KEY `Search_ibfk_2` (`FocalNode`);

--
-- Indexes for table `SearchAgent`
--
ALTER TABLE `SearchAgent`
  ADD PRIMARY KEY (`AgentID`),
  ADD KEY `SearchAgent_ibfk_1` (`UserID`),
  ADD KEY `SearchAgent_ibfk_2` (`SearchID`);

--
-- Indexes for table `SearchAgentRun`
--
ALTER TABLE `SearchAgentRun`
  ADD PRIMARY KEY (`RunID`),
  ADD KEY `AgentID` (`AgentID`);

--
-- Indexes for table `SearchAgentRunResults`
--
ALTER TABLE `SearchAgentRunResults`
  ADD PRIMARY KEY (`RunID`,`TripleID`);

--
-- Indexes for table `Tag`
--
ALTER TABLE `Tag`
  ADD PRIMARY KEY (`TagID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `TagGroup`
--
ALTER TABLE `TagGroup`
  ADD PRIMARY KEY (`TagGroupID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `TagGrouping`
--
ALTER TABLE `TagGrouping`
  ADD PRIMARY KEY (`TagID`,`TagGroupID`),
  ADD KEY `GroupTag_TagGroupID_Ind` (`TagGroupID`);

--
-- Indexes for table `TagNode`
--
ALTER TABLE `TagNode`
  ADD PRIMARY KEY (`NodeID`,`TagID`,`UserID`),
  ADD KEY `TagNode_TagID_Ind` (`TagID`);

--
-- Indexes for table `TagTriple`
--
ALTER TABLE `TagTriple`
  ADD PRIMARY KEY (`TripleID`,`TagID`,`UserID`),
  ADD KEY `TagTriple_TagID_Ind` (`TagID`);

--
-- Indexes for table `TagURL`
--
ALTER TABLE `TagURL`
  ADD PRIMARY KEY (`URLID`,`TagID`,`UserID`),
  ADD KEY `TagURL_TagID_Ind` (`TagID`);

--
-- Indexes for table `TagUsers`
--
ALTER TABLE `TagUsers`
  ADD PRIMARY KEY (`TagID`,`UserID`),
  ADD KEY `TagUsers_TagID_Ind` (`TagID`),
  ADD KEY `FK_TagUsers_1` (`UserID`);

--
-- Indexes for table `Triple`
--
ALTER TABLE `Triple`
  ADD PRIMARY KEY (`TripleID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `FromContextTypeID` (`FromContextTypeID`),
  ADD KEY `ToContextTypeID` (`ToContextTypeID`),
  ADD KEY `FromID` (`FromID`),
  ADD KEY `ToID` (`ToID`);

--
-- Indexes for table `TripleGroup`
--
ALTER TABLE `TripleGroup`
  ADD PRIMARY KEY (`TripleID`,`GroupID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `URL`
--
ALTER TABLE `URL`
  ADD PRIMARY KEY (`URLID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `URLGroup`
--
ALTER TABLE `URLGroup`
  ADD PRIMARY KEY (`URLID`,`GroupID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `URLNode`
--
ALTER TABLE `URLNode`
  ADD PRIMARY KEY (`UserID`,`URLID`,`NodeID`),
  ADD KEY `URLID` (`URLID`),
  ADD KEY `TagID` (`NodeID`);

--
-- Indexes for table `UserGroup`
--
ALTER TABLE `UserGroup`
  ADD PRIMARY KEY (`GroupID`,`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `UsersCache`
--
ALTER TABLE `UsersCache`
  ADD PRIMARY KEY (`UsersCacheID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `View`
--
ALTER TABLE `View`
  ADD PRIMARY KEY (`ViewID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `ViewAssignment`
--
ALTER TABLE `ViewAssignment`
  ADD PRIMARY KEY (`ViewID`,`ItemID`,`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Voting`
--
ALTER TABLE `Voting`
  ADD PRIMARY KEY (`VoteID`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Log`
--
ALTER TABLE `Log`
  MODIFY `LogID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UsersCache`
--
ALTER TABLE `UsersCache`
  MODIFY `UsersCacheID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Voting`
--
ALTER TABLE `Voting`
  MODIFY `VoteID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Feeds`
--
ALTER TABLE `Feeds`
  ADD CONSTRAINT `Feeds_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `Following`
--
ALTER TABLE `Following`
  ADD CONSTRAINT `Following_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `LinkType`
--
ALTER TABLE `LinkType`
  ADD CONSTRAINT `LinkType_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `LinkType_ibfk_3` FOREIGN KEY (`ToContextTypeID`) REFERENCES `NodeType` (`NodeTypeID`) ON DELETE SET NULL,
  ADD CONSTRAINT `LinkType_ibfk_4` FOREIGN KEY (`FromContextTypeID`) REFERENCES `NodeType` (`NodeTypeID`) ON DELETE SET NULL;

--
-- Constraints for table `LinkTypeGroup`
--
ALTER TABLE `LinkTypeGroup`
  ADD CONSTRAINT `LinkTypeGroup_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `LinkTypeGrouping`
--
ALTER TABLE `LinkTypeGrouping`
  ADD CONSTRAINT `LinkTypeGrouping_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `LinkTypeGrouping_ibfk_2` FOREIGN KEY (`LinkTypeID`) REFERENCES `LinkType` (`LinkTypeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `LinkTypeGrouping_ibfk_3` FOREIGN KEY (`LinkTypeGroupID`) REFERENCES `LinkTypeGroup` (`LinkTypeGroupID`) ON DELETE CASCADE;

--
-- Constraints for table `LinkTypeProperty`
--
ALTER TABLE `LinkTypeProperty`
  ADD CONSTRAINT `LinkTypeProperty_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `LinkTypePropertyAssignment`
--
ALTER TABLE `LinkTypePropertyAssignment`
  ADD CONSTRAINT `LinkTypePropertyAssignment_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `LinkTypePropertyAssignment_ibfk_2` FOREIGN KEY (`LinkTypePropertyID`) REFERENCES `LinkTypeProperty` (`LinkTypePropertyID`) ON DELETE CASCADE,
  ADD CONSTRAINT `LinkTypePropertyAssignment_ibfk_3` FOREIGN KEY (`LinkTypeID`) REFERENCES `LinkType` (`LinkTypeID`) ON DELETE CASCADE;

--
-- Constraints for table `Log`
--
ALTER TABLE `Log`
  ADD CONSTRAINT `Log_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `Node`
--
ALTER TABLE `Node`
  ADD CONSTRAINT `Node_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `NodeGroup`
--
ALTER TABLE `NodeGroup`
  ADD CONSTRAINT `NodeGroup_ibfk_1` FOREIGN KEY (`NodeID`) REFERENCES `Node` (`NodeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `NodeGroup_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `NodeType`
--
ALTER TABLE `NodeType`
  ADD CONSTRAINT `NodeType_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `NodeTypeGroup`
--
ALTER TABLE `NodeTypeGroup`
  ADD CONSTRAINT `NodeTypeGroup_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `NodeTypeGrouping`
--
ALTER TABLE `NodeTypeGrouping`
  ADD CONSTRAINT `NodeTypeGrouping_ibfk_1` FOREIGN KEY (`NodeTypeGroupID`) REFERENCES `NodeTypeGroup` (`NodeTypeGroupID`) ON DELETE CASCADE,
  ADD CONSTRAINT `NodeTypeGrouping_ibfk_2` FOREIGN KEY (`NodeTypeID`) REFERENCES `NodeType` (`NodeTypeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `NodeTypeGrouping_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `Search`
--
ALTER TABLE `Search`
  ADD CONSTRAINT `Search_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Search_ibfk_2` FOREIGN KEY (`FocalNode`) REFERENCES `Node` (`NodeID`) ON DELETE CASCADE;

--
-- Constraints for table `SearchAgent`
--
ALTER TABLE `SearchAgent`
  ADD CONSTRAINT `SearchAgent_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `SearchAgent_ibfk_2` FOREIGN KEY (`SearchID`) REFERENCES `Search` (`SearchID`) ON DELETE CASCADE;

--
-- Constraints for table `SearchAgentRun`
--
ALTER TABLE `SearchAgentRun`
  ADD CONSTRAINT `SearchAgentRun_ibfk_1` FOREIGN KEY (`AgentID`) REFERENCES `SearchAgent` (`AgentID`) ON DELETE CASCADE;

--
-- Constraints for table `SearchAgentRunResults`
--
ALTER TABLE `SearchAgentRunResults`
  ADD CONSTRAINT `SearchAgentRunResults_ibfk_1` FOREIGN KEY (`RunID`) REFERENCES `SearchAgentRun` (`RunID`) ON DELETE CASCADE;

--
-- Constraints for table `Tag`
--
ALTER TABLE `Tag`
  ADD CONSTRAINT `Tag_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `TagGroup`
--
ALTER TABLE `TagGroup`
  ADD CONSTRAINT `TagGroup_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `TagGrouping`
--
ALTER TABLE `TagGrouping`
  ADD CONSTRAINT `FK_GroupTag_1` FOREIGN KEY (`TagID`) REFERENCES `Tag` (`TagID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_GroupTag_2` FOREIGN KEY (`TagGroupID`) REFERENCES `TagGroup` (`TagGroupID`) ON DELETE CASCADE;

--
-- Constraints for table `TagNode`
--
ALTER TABLE `TagNode`
  ADD CONSTRAINT `FK_TagNode_1` FOREIGN KEY (`NodeID`) REFERENCES `Node` (`NodeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_TagNode_2` FOREIGN KEY (`TagID`) REFERENCES `Tag` (`TagID`) ON DELETE CASCADE;

--
-- Constraints for table `TagTriple`
--
ALTER TABLE `TagTriple`
  ADD CONSTRAINT `FK_TagTriple_1` FOREIGN KEY (`TripleID`) REFERENCES `Triple` (`TripleID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_TagTriple_2` FOREIGN KEY (`TagID`) REFERENCES `Tag` (`TagID`) ON DELETE CASCADE;

--
-- Constraints for table `TagURL`
--
ALTER TABLE `TagURL`
  ADD CONSTRAINT `FK_TagURL_1` FOREIGN KEY (`URLID`) REFERENCES `URL` (`URLID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_TagURL_2` FOREIGN KEY (`TagID`) REFERENCES `Tag` (`TagID`) ON DELETE CASCADE;

--
-- Constraints for table `TagUsers`
--
ALTER TABLE `TagUsers`
  ADD CONSTRAINT `FK_TagUsers_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_TagUsers_2` FOREIGN KEY (`TagID`) REFERENCES `Tag` (`TagID`) ON DELETE CASCADE;

--
-- Constraints for table `Triple`
--
ALTER TABLE `Triple`
  ADD CONSTRAINT `Triple_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `TripleGroup`
--
ALTER TABLE `TripleGroup`
  ADD CONSTRAINT `TripleGroup_ibfk_1` FOREIGN KEY (`TripleID`) REFERENCES `Triple` (`TripleID`) ON DELETE CASCADE,
  ADD CONSTRAINT `TripleGroup_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `URL`
--
ALTER TABLE `URL`
  ADD CONSTRAINT `URL_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `URLGroup`
--
ALTER TABLE `URLGroup`
  ADD CONSTRAINT `urlgroup_ibfk_1` FOREIGN KEY (`URLID`) REFERENCES `URL` (`URLID`) ON DELETE CASCADE,
  ADD CONSTRAINT `urlgroup_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `URLNode`
--
ALTER TABLE `URLNode`
  ADD CONSTRAINT `URLNode_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `URLNode_ibfk_2` FOREIGN KEY (`NodeID`) REFERENCES `Node` (`NodeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `URLNode_ibfk_3` FOREIGN KEY (`URLID`) REFERENCES `URL` (`URLID`) ON DELETE CASCADE;

--
-- Constraints for table `UserGroup`
--
ALTER TABLE `UserGroup`
  ADD CONSTRAINT `UserGroup_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `UserGroup_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `UsersCache`
--
ALTER TABLE `UsersCache`
  ADD CONSTRAINT `UsersCache_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `View`
--
ALTER TABLE `View`
  ADD CONSTRAINT `View_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `ViewAssignment`
--
ALTER TABLE `ViewAssignment`
  ADD CONSTRAINT `ViewAssignment_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ViewAssignment_ibfk_2` FOREIGN KEY (`ViewID`) REFERENCES `View` (`ViewID`) ON DELETE CASCADE;

--
-- Constraints for table `Voting`
--
ALTER TABLE `Voting`
  ADD CONSTRAINT `Voting_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
