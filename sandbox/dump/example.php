<?php
	//MySQL connection parameters
	$dbhost = '127.0.0.1';
	$dbuser = 'root';
	$dbpsw = 'root';
	$dbname = 'database_1';
	
	//Connects to mysql server
	$connessione = @mysql_connect($dbhost,$dbuser,$dbpsw);

	//Includes class
	require_once('mysqldump.php');

//Creates a new instance of MySQLDump: it exports a compressed and base-16 file
$dumper = new MySQLDump($dbname,'filename.sql',true,true);

//Use this for plain text and not compressed file
//$dumper = new MySQLDump($dbname,'filename.sql',false,false);

//Dumps all the database
$dumper->doDump();
  
//Dumps all the database structure only (no data)
$dumper->getDatabaseStructure();

//Dumps all the database data only (no structure)
$dumper->getDatabaseData();

//Dumps "mytable" table structure only (no data)
$dumper->getTableStructure('mytable');

//Dumps "mytable" table data only (no structure)
$dumper->getTableData('mytable');
?>