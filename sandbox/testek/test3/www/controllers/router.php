<?php
if (!defined('SERVER_ROOT'))
	exit('No direct script access allowed');
/**
 * This controller routes all incoming requests to the appropriate controller
 */
//Automatically includes files containing classes that are called
function __autoload($className) {
	//parse out filename where class should be located
	$classSplit = explode('_', $className);	
	$filename = $classSplit[0];
	$suffix = $classSplit[1];
	//select the folder where class should be located based on suffix
	switch (strtolower($suffix)) {	
		case 'model':
			$folder = 'models/';
		break;
	}

	//compose file name
	$file = SERVER_ROOT . $folder . strtolower($filename) . '.php';
	
	//fetch file
	if (file_exists($file)) {
		//get file
		include_once($file);		
	} else {
		//file does not exist!
		die("File '$filename' containing class '$className' not found in '$folder'.");	
	}
}
	
//fetch the passed request
$request = $_SERVER['REQUEST_URI'];
//var_dump($request).'<br>';
$requestArr = explode('/', $request);

$page = $requestArr[REQUESTARR];
if (empty($page)) {
	$page = "fooldal";
}
//compute the path to the file
$target = 'controllers/page.php';
//get target
if (file_exists($target)) {
	include_once($target);
	
	//modify page to fit naming convention
	$class = ucfirst('page') . '_Controller';
	//instantiate the appropriate class
	if (class_exists($class)) {
		$controller = new $class;
	} else {
		//did we name our class correctly?
		die('class does not exist!');
	}
} else {
	//can't find the file in 'controllers'! 
	die('page does not exist!');
}

//once we have the controller instantiated, execute the default function
//pass any GET varaibles to the main method
$controller->main($page,$requestArr);


