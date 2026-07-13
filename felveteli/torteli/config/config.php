<?php
//echo strtolower($_SERVER['SERVER_NAME']).'<br>';
define('SERVER_ROOT' , '');
define('SITE_ROOT' , '/test/');
//echo 'server:'.$_SERVER['SERVER_NAME'].'<br>';
define('FRONTENDADMIN',1);
switch(strtolower($_SERVER['SERVER_NAME'])) {
	case 'localhost':
		define('DATABASETYPE' , 'mysql');
		define('DATABASESERVER' , 'localhost');
		define('DATABASESELECT' , 'ttest');
		define('DATABASEUSER' , 'root');
		define('DATABASEPASSWORD' , '');
		define('DATABASESETNAMES' , 'set names utf8');
		define('STARTURL' , '');
		define('REQUESTARR' , 2);
		define('ROOT' , '/test/');
		break;
	default:
		define('DATABASETYPE' , 'mysql');
		define('DATABASESERVER' , 'localhost');
		define('DATABASESELECT' , 'ttest');
		define('DATABASEUSER' , 'root');
		define('DATABASEPASSWORD' , '');
		define('DATABASESETNAMES' , 'set names utf8');
		define('STARTURL' , '');
		define('REQUESTARR' , 2);
		define('ROOT' , '/test/');
		break;
}
?>