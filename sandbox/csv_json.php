<?php
header("Content-type: text/html; charset=utf-8");

$csvFiles[]='nationalities.csv';  // input file
foreach ($csvFiles as $csvKey => $csvActual) {
	echo $csvActual." file<br>";
	$size = filesize($csvActual);
	$pointer = fopen($csvActual,"r");
	$itemCount=0;
	$itemCountInsert=0;
	$itemCountUpdate=0;
	$nationalities = Array();
	while ($line = fgets($pointer, $size))
		{
		if ($itemCount>0) {}
		if (!empty($line)) {
			$datas = explode(";", $line);
//			print_r(iconv('ISO-8859-2', 'UTF-8',$datas[0]).' - '.iconv('ISO-8859-2', 'UTF-8',$datas[1]).' - '.iconv('ISO-8859-2', 'UTF-8',$datas[2]));
//			print_r('<br>');
//			$nationalities+=array('"'.iconv('ISO-8859-2', 'UTF-8',$datas[0]).'"'=>'"'.iconv('ISO-8859-2', 'UTF-8',$datas[2]).'"');
			$nationalities+=array(iconv('ISO-8859-2', 'UTF-8',$datas[0])=>iconv('ISO-8859-2', 'UTF-8',$datas[2]));
			$itemCount++;
		}
	}
}
//print_r(json_encode($nationalities));
//print_r('<br>');
$nationalities_json = json_encode($nationalities);  
$exportCSV["configName"]='nationalities.json';
$filePointer = fopen($exportCSV["configName"],"w");
fputs($filePointer, $nationalities_json);
fclose($filePointer);
//$nationalities = json_decode(\Storage::get('nationalities.json'));
$countries = json_decode(file_get_contents('nationalities.json'),true);
//$countries = json_decode($nationalities_json,true);

//$arr = json_decode($jsonobj, true);
//echo $countries["HUN"];

print_r('<pre>');
//print_r($countries);
//if (isset($countries->HUK)) {
	print_r($countries["HUN"]);
//}
foreach($nationalities as $nkey => $nationality) {
//	print_r($nkey.' - '.$nationality);
//	print_r('<br>');
}

print_r('<br>');


echo "insert: ".$itemCountInsert." beolvasva<br>";
echo "update: ".$itemCountUpdate." beolvasva<br>";
echo "full: ".$itemCount." beolvasva<br>";
echo str_repeat("**", 20)."<br><br>";
fclose($pointer);
?>
