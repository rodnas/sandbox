<?php
header("Content-type: text/html; charset=utf-8");

$conn = new mysqli ('localhost', 'root', '', 'merged');
$conn->query("SET NAMES utf8");
$conn->query("SET CHARACTER SET utf8");
if ($conn->connect_errno) {
	echo $conn->connect_error;
	die();
}
// $truncateTableSQL="TRUNCATE TABLE users";
// $conn->query($truncateTableSQL);
$csvFiles[]='main.csv';  // input file
foreach ($csvFiles as $csvKey => $csvActual) {
	echo $csvActual." file<br>";
	$size = filesize($csvActual);
	$pointer = fopen($csvActual,"r");
	$itemCount=0;
	$itemCountInsert=0;
	$itemCountUpdate=0;
	while ($line = fgets($pointer, $size))
		{
		if ($itemCount>0) {}
		if (!empty($line)) {
			$datas = explode(";", $line);
			foreach ($datas as $key => $di) {
				$datas[$key]=iconv('ISO-8859-2', 'UTF-8', trim($di));
			}
			$emailSelectSQL = "SELECT * FROM users";
			$emailSelectSQL .= " WHERE email = '" . $datas[0]."'";
			$emailSelectRS = $conn->query($emailSelectSQL);
			$data_row = $emailSelectRS->fetch_array(MYSQLI_ASSOC);
			if ($data_row == 0) {
				switch(count($datas)) {
					case 3:
						$importInsertSQL="INSERT INTO users (email, v_nev, k_nev, ertek) VALUES ('".$datas[0]."','".$datas[1]."','".$datas[2]."',0)";
						break;
					case 1:
						$importInsertSQL="INSERT INTO users (email, ertek) VALUES ('".$datas[0]."', 0)";
						break;
				}
				$impSQL=$conn->query($importInsertSQL);
				$itemCountInsert++;
			} else {
				$importUpdateSQL="UPDATE users SET ertek = ertek+100 WHERE id=".$data_row["id"];
				$impSQL = $conn->query($importUpdateSQL);
				$itemCountUpdate++;
			}
			$itemCount++;
		}
	}
}
echo "insert: ".$itemCountInsert." beolvasva<br>";
echo "update: ".$itemCountUpdate." beolvasva<br>";
echo "full: ".$itemCount." beolvasva<br>";
echo str_repeat("**", 20)."<br><br>";
fclose($pointer);
?>
