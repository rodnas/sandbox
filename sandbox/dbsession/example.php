<?php
$mySQLHost = "localhost";
$mySQLUsername = "username";
$mySQLPassword = "password";
$mySQLDatabase = "database";
$link = mysql_connect($mySQLHost, $mySQLUsername, $mySQLPassword);
if (!$link)
	{
	die ("Could not connect to database!");
	}
$db = mysql_select_db($mySQLDatabase, $link);
if (!$db)
	{
	die ("Could not select database!");
	}
require "class.dbsession.php";
$session = new dbsession();
print_r("
	Elöször futtatva üres tömb (nincs semmi a tömbben \$_SESSION array)<br />
	Frissítés után a beállított értékek megjelennek a tömbben  \$_SESSION array<br>
	");
print_r("<pre>");
print_r($_SESSION);
print_r("</pre>");
$_SESSION["value1"] = "hello";
$_SESSION["value2"] = "world";
?>
