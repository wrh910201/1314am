<?php
	require 'medoo.php';
	
	$config = array(
		'database_type' => 'mysql',
		'database_name' => '1314am',
		'server' => 'localhost',
		'username' => 'root',
		'password' => '',
			
	);
	
	
	$db = new medoo($config);
	
	
	
	