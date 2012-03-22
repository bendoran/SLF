<?php
//Include the Framework
include_once 'core/slf.php';
$slf = slf::get_instance(); 

//Set Up the DB Connection
$slf->set_config( slf::$CONFIG_DB, array(
	'server' => 'localhost',
	'username' => 'root',
	'password' => 'password',
	'database' => 'some_database' 
));

//Boot the Framework
$slf->boot();
