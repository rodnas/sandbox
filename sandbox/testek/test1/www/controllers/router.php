<?php
if (!defined('SERVER_ROOT'))
	exit('No direct script access allowed');
function __autoload($className) {
	$classSplit = explode('_', $className);	
	$filename = $classSplit[0];
	$suffix = $classSplit[1];
	switch (strtolower($suffix)) {	
		case 'model':
			$folder = 'models/';
		break;
	}

	$file = SERVER_ROOT . $folder . strtolower($filename) . '.php';
	
	if (file_exists($file)) {
		include_once($file);		
	} else {
		die("File '$filename' containing class '$className' not found in '$folder'.");	
	}
}
	
if (isset($_GET['Feladat'])) {
	$page=$_GET['Feladat'];
} else {
	$page = "";
}
if (empty($page)) {
	$page = "Bekero";
}
$target = 'controllers/page.php';
if (file_exists($target)) {
	include_once($target);
	
	$class = ucfirst('page') . '_Controller';
	if (class_exists($class)) {
		$controller = new $class;
	} else {
		die('class does not exist!');
	}
} else {
	die('page does not exist!');
}

$controller->main($page);
