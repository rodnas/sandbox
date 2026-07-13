<?php
$sql["inputFileName"]='ipboard_lapforum.sql';
$sql["outputFileName"]="new_".$sql["inputFileName"];
$inputPointer = fopen($sql["inputFileName"],"r");
$outputPointer = fopen($sql["outputFileName"],"w");
$lineCount=0;
while ($line = fgets($inputPointer, 4096))
	{
	$writeLine = str_replace("CHARSET=latin1","CHARSET=utf8",$line);
//	$writeLine = str_replace("","COLLATE=utf8_unicode_ci",$writeLine);
//	$writeLine = str_replace("CHARSET=utf8","",$writeLine);
//	$writeLine = str_replace("COLLATE=utf8_unicode_ci","",$writeLine);
//	$writeLine = str_replace("COLLATE utf8_unicode_ci","",$writeLine);
	$writeLine = iconv('ISO-8859-2','UTF-8',utf8_decode($writeLine));
	fputs($outputPointer, $writeLine);
	$lineCount++;
	}
echo $lineCount." beolvasva<br>";
fclose($inputPointer);
fclose($outputPointer);
?>