<?php

include_once('../config.php');

global $USER, $DB, $CFG;

$err = "";

if( !$DB->conn ) {
	$err .= "<error>SQL error: ".$DB->conn->connect_error."</error>";
} else {
	$params = array();

	$sql = "Select URLID from URL";
	$resArray = $DB->select($sql, $params);
	if ($resArray && is_countable($resArray)) {
		$count = count($resArray);
		for ($i=0; $i<$count; $i++) {
			$array = $resArray[$i];

			$urlid = stripslashes(trim($array['URLID']));
			$sql2 = "SELECT tg.GroupID FROM URLNode ut
				INNER JOIN Node ON Node.NodeID = ut.NodeID
				INNER JOIN NodeGroup tg ON tg.NodeID = Node.NodeID
				WHERE ut.URLID = '".$urlid."'";

			$resArray2 = $DB->select($sql2, $params);
			if ($resArray2 && is_countable($resArray2)) {
				$countj = count($resArray2);
				for ($j=0; $j<$countj; $j++) {
					$array2 = $resArray2[$j];
					$dt = time();
					$sql3 = "INSERT INTO URLGroup (URLID,GroupID,CreationDate) VALUES ('".$urlid."','".$array2['GroupID']."',".$dt.")";
					$res = $DB->insert($sql3, $params);
					if (!$res) {
						$err .= "<error>SQL error: ".$DB->conn->error."</error>";
					}
				}
			} else {
				$err .= "<error>SQL error: ".$DB->conn->error."</error>";
			}
		}
	} else {
		$err .= "<error>SQL error: ".$DB->conn->error."</error>";
	}
}
?>