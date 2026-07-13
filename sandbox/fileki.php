<?php
include ("phpmkrfn.lib.php");
$mySQLHost = "localhost";
$mySQLUsername = "SzSanyi";
$mySQLPassword = "phoenix";
$mySQLDatabase = "infotipp";
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

$exportCSV["configName"]='emailsexport.txt';
$filePointer = fopen($exportCSV["configName"],"w");
$exportSQL = "SELECT * FROM emails WHERE active=1 AND name LIKE '%.org%'";
$exportRS = mysql_query($exportSQL, $link);
if ($exportRS)
	{
	$itemCount = 0;
	while ($exportData = mysql_fetch_array($exportRS))
		{
		$exportLine = $exportData["name"];
		fputs($filePointer, $exportLine);
		$itemCount++;
		}
	}
fclose($filePointer);
echo $itemCount." feldolgozva<br>";
?>