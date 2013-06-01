<?php
	
	function mysqlConnect()
	{
		return new mysqli('localhost', 'root', '', 'govhack');
	}
	
 ?>