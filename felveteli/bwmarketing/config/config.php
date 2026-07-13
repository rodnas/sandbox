<?php
define('SERVER_ROOT' , '');
switch(strtolower($_SERVER['SERVER_NAME'])) {
	case 'localhost':
		define('DATABASETYPE' , 'mysql');
		define('DATABASESERVER' , 'localhost');
		define('DATABASESELECT' , 'allas5');
		define('DATABASEUSER' , 'root');
		define('DATABASEPASSWORD' , '');
		define('DATABASESETNAMES' , 'set names utf8');
		define('ROOT' , '/zencm/');
		break;
	case 'allas5.ysolutions.hu':
		define('DATABASETYPE' , 'mysql');
		define('DATABASESERVER' , 'localhost');
		define('DATABASESELECT' , 'allas5');
		define('DATABASEUSER' , 'allas5');
		define('DATABASEPASSWORD' , 'nxhH210Ls');
		define('DATABASESETNAMES' , 'set names utf8');
		define('ROOT' , '/');
		break;
	default:
		define('DATABASETYPE' , 'mysql');
		define('DATABASESERVER' , 'localhost');
		define('DATABASESELECT' , 'allas5');
		define('DATABASEUSER' , 'allas5');
		define('DATABASEPASSWORD' , 'nxhH210Ls');
		define('DATABASESETNAMES' , 'set names utf8');
		define('ROOT' , '/');
		break;
}
?>