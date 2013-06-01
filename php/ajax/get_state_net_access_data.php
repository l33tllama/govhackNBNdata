<?php
/*
 * @author Leo
 * @about: gets info about internet availability in each state
 * and returns JSON data
 * 
 * 
 * 
 */
 
 $con = mysqli_connect("127.0.0.1", "govhacker", "govhacktas", "govhack");
 
 if (mysqli_connect_errno($con)) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 } else {
		$state_label_array = array("id" => "", "label" => "State", "pattern" => "", "type" => "string");
		$with_net = array("id" => "", "label" => "State", "pattern" => "", "type" => "number");
		
		$google_graph_json_data['cols'] = array($state_label_array, $with_net);
					
		$google_graph_json_data['rows'] = array();
		$qry = mysqli_query($con, "SELECT * FROM `households_in_000s_with_net_by_state` , `states` WHERE `states`.`id` =  `state_id`"); 	
		
		while ($r = mysqli_fetch_assoc($qry)) {
			$state = $r['fullname'];
			$has_net = $r['with'];
			$row_entry = array("c" => array(array("v" => $state, "f" => NULL), array("v" => (int)$has_net, "f" => null)));
			array_push($google_graph_json_data['rows'], $row_entry);
		}
		
		//Close MySQL connection
		mysqli_close($con);
		echo json_encode($google_graph_json_data);
		
 }

?>