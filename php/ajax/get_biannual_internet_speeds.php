<?php
/*
 * @author Leo
 * @about: gets info about internet speeds in australian households
 * and small busisnesses, and returns JSON data
 * 
 * 
 * 
 */
 
 require_once '../include.php';
 
 $con = mysqlConnect(false);
 
 if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		$date_label_array = array("id" => "", "label" => "Date", "pattern" => "", "type" => "string");
		$less256k_label_array = array("id" => "", "label" => "Less Than 256k", "pattern" => "", "type" => "number");
		$_256k_to_1_5m_label_array = array("id" => "", "label" => "256k To 1.5M", "pattern" => "", "type" => "number");
		$_1_5m_to_8m_label_array = array("id" => "", "label" => "1.5M To 8M", "pattern" => "", "type" => "number");
		$_8m_to_24m_label_array = array("id" => "", "label" => "8M To 24M", "pattern" => "", "type" => "number");
		$_24m_or_above_label_array = array("id" => "", "label" => "24M Or Above", "pattern" => "", "type" => "number");
		
		$google_graph_json_data['cols'] = array($date_label_array,$less256k_label_array, $_1_5m_to_8m_label_array, $_8m_to_24m_label_array, $_24m_or_above_label_array);
		$google_graph_json_data['rows'] = array();
		
		$qry = mysqli_query($con, "SELECT * FROM `net_users_by_connection_type`");
		
		while ($r = mysqli_fetch_assoc($qry)) {
			$date = $r['Date'];
			$less256 = $r['less_than_256k'];
			$_256_to_1_5 = $r['256k_to_1.5m'];
			$_1_5_to_8 = $r['1.5m_to_8m'];
			$_8_to_24 = $r['8m_to_24m'];
			$_24m_or_above = $r['greater_than_24m'];
			
			$row_entry = array("c" => array(array("v" => $date, "f" => NULL), array("v" => (int)$less256, "f" => null), array("v" => (int)$_256_to_1_5, "f" => null),
						array("v" => (int)$_1_5_to_8, "f" => null), array("v" => (int)$_8_to_24, "f" => null), array("v" => (int)$_24m_or_above, "f" => null)));
			array_push($google_graph_json_data['rows'], $row_entry);
		}
		
		//Close MySQL connection
		mysqli_close($con);
		echo json_encode($google_graph_json_data);
		
	}
?>