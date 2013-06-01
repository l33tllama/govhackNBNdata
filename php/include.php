<?php
	
	define('MYSQL_USER', 'govhacker');
	define('MYSQL_PASS', 'govhacktas');
	
	function debug($stuff)
	{
		echo '<PRE>';var_dump($stuff);echo '</PRE>';
	}
	
	function mysqlConnect($useObject=true)
	{
		if($useObject)
			return new mysqli('127.0.0.1', MYSQL_USER, MYSQL_PASS, 'govhack');
		else
			return mysqli_connect('127.0.0.1', MYSQL_USER, MYSQL_PASS, 'govhack');
	}
	
	
 ?>