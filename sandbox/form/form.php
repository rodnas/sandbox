<!DOCTYPE HTML>
<html>  
<body>

<form action="welcome.php" method="post">
<?php
$config["configShare"]["databaseServer"]["name"] = "Server";
$config["configShare"]["databaseServer"]["value"] = "localhost";
$config["configShare"]["databaseUser"]["name"] = "User";
$config["configShare"]["databaseUser"]["value"] = "root";
echo "<pre>";
echo "orig:<br>";
var_dump($config);

foreach ($config as $configAKey=>$configAValue) {
	foreach ($configAValue as $configBKey=>$configBValue) {
		echo $configBValue["name"].': <input type="text" name="config['.$configAKey.']['.$configBKey.'][value]"><br>';
	}
}
?>
<input type="submit">
</form>

</body>
</html>