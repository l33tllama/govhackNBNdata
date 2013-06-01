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
 $con = mysqli_connect("127.0.0.1", "govhacker", "govhacktas", "govhack");
 
 if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
		echo "Connection success!";
	}
 $sql = "";
?>
