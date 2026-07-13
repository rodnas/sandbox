<?php
define('SERVER_ROOT' , '');
define('SITE_ROOT' , '/devwing/testdw/www/');
define('FRONTENDADMIN',1);
switch(strtolower($_SERVER['SERVER_NAME'])) {
	case 'localhost':
		define('DATABASETYPE' , 'mysql');
		define('DATABASESERVER' , 'localhost');
		define('DATABASESELECT' , 'devwing');
		define('DATABASEUSER' , 'root');
		define('DATABASEPASSWORD' , '');
		define('DATABASESETNAMES' , 'set names utf8');
		define('STARTURL' , '');
		define('REQUESTARR' , 2);
		define('ROOT' , '/testdw/');
		break;
	default:
		define('DATABASETYPE' , 'mysql');
		define('DATABASESERVER' , 'localhost');
		define('DATABASESELECT' , 'devwing');
		define('DATABASEUSER' , 'root');
		define('DATABASEPASSWORD' , '');
		define('DATABASESETNAMES' , 'set names utf8');
		define('STARTURL' , '');
		define('REQUESTARR' , 2);
		define('ROOT' , '/testdw/');
		break;
}
?>