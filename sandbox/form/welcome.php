<html>
<body>
<?php
echo "<pre>";
echo "post:<br>";
var_dump($_POST);

$config = Array();
$config = $_POST["config"];
echo "config:<br>";
var_dump($config);

echo "orig:<br>";
$config2["configShare"]["databaseServer"]["name"] = "Server";
$config2["configShare"]["databaseServer"]["value"] = "localhost";
$config2["configShare"]["databaseUser"]["name"] = "User";
$config2["configShare"]["databaseUser"]["value"] = "root";
var_dump($config2);

echo "merge:<br>";
//$config2 = array_merge_recursive($config2,$config);

foreach ($config as $configAKey=>$configAValue) {
	foreach ($configAValue as $configBKey=>$configBValue) {
		$config2[$configAKey][$configBKey]["value"] = $configBValue["value"];
	}
}

var_dump($config2);

echo "json_encode:<br>";
$json_encode = json_encode($config2);
echo "type: ".gettype($json_encode) . "<br>";
echo "type2: ".gettype(json_decode($json_encode, true))."<br>";
echo $json_encode."<br>";

echo "json_decode:<br>";
$json_decode = json_decode($json_encode,true);
var_dump($json_decode);

?>
</body>
</html>