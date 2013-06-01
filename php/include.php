<?php
	
	function debug($stuff)
	{
		echo '<PRE>';var_dump($stuff);echo '</PRE>';
	}
	
	function mysqlConnect()
	{
		return new mysqli('localhost', 'root', '', 'govhack');
	}
	
	
 ?>