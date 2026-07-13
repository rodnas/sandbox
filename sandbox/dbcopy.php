<?php
set_time_limit(0); 
session_start();
ob_start();
//header("Content-type: text/html; charset=utf-8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
$db_host="localhost";

$db_database="replica";
$db_database_new="replica2";
$db_username="root";
$db_password="";
mysql_connect($db_host,$db_username,$db_password);
mysql_selectdb($db_database);

mysql_query("CREATE DATABASE ".$db_database_new);
mysql_query("GRANT ALL PRIVILEGES ON ".$db_database_new.".* TO 'general'@'% WITH GRANT OPTION");

echo "Start<br>";
echo $db_database." => ".$db_database_new."<br>";
$r=mysql_query("SELECT TABLE_NAME,TABLE_ROWS FROM information_schema.tables WHERE TABLE_SCHEMA = '".$db_database."'");
while ($d=mysql_fetch_assoc($r))
	$tables[]=$d['TABLE_NAME'];

if (is_array($tables))
	{
	$tableCounter = 1;
	foreach ($tables as $v)
		{
		echo $tableCounter.". => ".$v." => ";
		$r = mysql_query("SHOW CREATE TABLE ".$v);
		$d = mysql_fetch_assoc($r);
		mysql_select_db($db_database_new);
		mysql_query(str_replace("CHARSET=latin1","CHARSET=utf8",$d['Create Table']));
		mysql_select_db($db_database);
		$rn=mysql_query("SELECT * FROM ".$v);
		$recCount=0;
		while ($dn=mysql_fetch_assoc($rn))
			{
			mysql_select_db($db_database_new);
			foreach ($dn as $key => $di)
				{
				$dn[$key]="'".iconv('UTF-8','ISO-8859-2',$di)."'";
				}
				// insert into database
			$insertItemSQL = "INSERT INTO " .$v . " (";
			$insertItemSQL .= implode(",", array_keys($dn));
			$insertItemSQL .= ") VALUES (";
			$insertItemSQL .= implode(",", array_values($dn));
			$insertItemSQL .= ")";
		 	mysql_query($insertItemSQL);
			mysql_select_db($db_database);
			$recCount++;
			}
		echo $recCount." items<br>";
		mysql_select_db($db_database);
//		mysql_query("DROP TABLE ".$v);
		$tableCounter++;
		}
	}
echo "End<br>";
?>
