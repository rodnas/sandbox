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

$csv["configName"]='emails.txt';
$size = filesize($csv["configName"]);
$pointer = fopen($csv["configName"],"r");
$truncateTableSQL="TRUNCATE TABLE `emails`";
mysql_query($truncateTableSQL, $link) or die(db_error());
$itemCount=0;
$itemCountReally=0;
$importWhen = ConvertDateToMysqlFormat(date('Y-m-d H:i:s',time()));
while ($line = fgets($pointer, $size))
	{
	if (!empty($line))
		{
//		$emailSelectSQL = "SELECT * FROM emails";
//		$emailSelectSQL .= " WHERE email = '" . $line."'";
//		$emailSelectRS = mysql_query($emailSelectSQL, $link);
//		$emailSelectRS_is = intval(mysql_num_rows($emailSelectRS));
//		if ($emailSelectRS_is == 0)
//			{
			$importInsertSQL="INSERT INTO `emails` (`emailtype_id`,`name`,`lang_id`,`insert_user_id`,`insert_datetime`) VALUES (1,'".$line."',1,2,'".$importWhen."')";
			$impSQL=mysql_query($importInsertSQL, $link) or die(mysql_error());
			$itemCountReally++;
//			}
//		else
//			{
//			echo "exist: ".$line."<br>";
//			}
		$itemCount++;
		}
	}
echo $itemCount." beolvasva<br>";
echo $itemCountReally." feldolgozva<br>";
fclose($pointer);
?>