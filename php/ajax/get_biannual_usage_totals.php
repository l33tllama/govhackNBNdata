<?php

/*
 * @author: Leo
 * About this code:
 * Gets the bi-annual download totals for each state 
 * in australia and converts it into a JSON file ready for
 *  manipulation by Javascript
 * 
 * 
 */
 require_once '../include.php';
 
 $con = mysqlConnect(false);
 
 if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		
		$date_label_array = array("id" => "", "label" => "Date", "pattern" => "", "type" => "string");
		$dialup_label_array = array("id" => "", "label" => "Dialup", "pattern" => "", "type" => "number");
		$fixed_label_array = array("id" => "", "label" => "Fixed Line", "pattern" => "", "type" => "number");
		$wireless_label_array = array("id" => "", "label" => "Wireless", "pattern" => "", "type" => "number");
		$broadband_label_array = array("id" => "", "label" => "Broadband", "pattern" => "", "type" => "number");
		
		$google_graph_json_data['cols'] = array($date_label_array, $dialup_label_array, $fixed_label_array, $wireless_label_array, $broadband_label_array);
		$google_graph_json_data['rows'] = array();
		//echo "Connection success!";
		$qry = mysqli_query($con, "SELECT * FROM `data_volume_total_australia`"); 
		
		while ($r = mysqli_fetch_assoc($qry)) {
			$date = $r['Date'];
			$dialup = $r['volume_dialup_tb'];
			$fixed_line = $r['volume_fixedline_tb'];
			$wireless = $r['volume_wireless_tb'];
			$broadband = $r['volume_broadband_tb'];
			$row_entry = array("c" => array(array("v" => $date, "f" => NULL), array("v" => (int)$dialup, "f" => null), 
								array("v" => (int)$fixed_line, "f" => null), array("v" => (int)$wireless, "f" => null),
								array("v" => (int)$broadband, "f" => null)));
			array_push($google_graph_json_data['rows'], $row_entry);
		}
		
		//Close MySQL connection
		mysqli_close($con);
		echo json_encode($google_graph_json_data);
		
	}
?>
