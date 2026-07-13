<?php
/* 
 * Copyright (C) 2005 Lauri Itkonen, indom at mbnet fi
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
**/
$errors=array();
$messages=array();

function addErrorMessage($error, $type)
{
	global $errors;
	if($type=='DB') {
		$key='DB Error:';
	} elseif($type=='CONFIG') {
		$key='Config Error:';
	}
	$errors[]=$key.' '.$error;
}

function addMessage($message, $type)
{
	global $messages;
	if($type=='GOOD') {
		$class="green";
	} else {
		$class="red";
	}
	$messages[]='<span class="'.$class.'">'.$message.'</span>';
}

function parse($text)
{
	$part=explode(':', $text);
	return $part;
}

if(isset($_POST['install']))
{

	if(empty($_POST['absolute_path'])) {
		addErrorMessage('Absolute path not set.', 'CONFIG');
	}

	if(empty($_POST['calendar_url'])) {
		addErrorMessage('Calendar url not set.', 'CONFIG');
	}

	if(!empty($_POST['language_path'])) {
		if(!file_exists($_POST['language_path'])) {
			addErrorMessage('Directory "'.$_POST['language_path'].'" does not exist.', 'CONFIG');
		}
	} else {
		addErrorMessage('Language dir not set.', 'CONFIG');
	}

	if(!empty($_POST['smarty_dir'])) {
		if(!file_exists($_POST['smarty_dir'])) {
			addErrorMessage('Directory "'.$_POST['smarty_dir'].'" does not exist.', 'CONFIG');
		}
	} else {
		addErrorMessage('Smarty dir not set.', 'CONFIG');
	}

	if(!empty($_POST['themes_dir'])) {
		if(!file_exists($_POST['themes_dir'])) {
			addErrorMessage('Directory "'.$_POST['themes_dir'].'" does not exist.', 'CONFIG');
		}
	} else {
		addErrorMessage('Smarty dir not set.', 'CONFIG');
	}

	if(empty($_POST['cookie_expire'])) {
		addErrorMessage('Cookie expire time not set.', 'CONFIG');
	}

	if(empty($_POST['admin_username'])) {
		addErrorMessage('Admin username not set.', 'CONFIG');
	}

	if(empty($_POST['admin_email'])) {
		addErrorMessage('Admin email not set.', 'CONFIG');
	}

	if(!empty($_POST['admin_password']) || !empty($_POST['admin_password'])) {
		if(strlen($_POST['admin_password']) >= 6) {
			if($_POST['admin_password'] != $_POST['admin_password_check']) {
				addErrorMessage('Admin password doesn\'t match with password check', 'CONFIG');
			}
		} else {
			addErrorMessage('Admin password is too sort. Must be at least 6 characters long.', 'CONFIG');
		}
	} else {
		addErrorMessage('Admin password not set.', 'CONFIG');
	}

	if(empty($_POST['db_hostname'])) {
		addErrorMessage('DB hostname not set.', 'CONFIG');
	}

	if(empty($_POST['db_username'])) {
		addErrorMessage('DB username not set.', 'CONFIG');
	}

	if(empty($_POST['db_password'])) {
		addErrorMessage('DB password not set.', 'CONFIG');
	}

	if(empty($_POST['db_table_prefix'])) {
		addErrorMessage('DB tableprefix not set.', 'CONFIG');
	}

	if(empty($_POST['db_name'])) {
		addErrorMessage('DB name not set.', 'CONFIG');
	}



	/* NO ERRORS SO FAR... LET'S CREATE THE CONFIG FILE */
	if(empty($errors)) 
	{
		$absolute_path = "'".$_POST['absolute_path']."'";
		$db_host="'".$_POST['db_hostname']."'";
		$db_user="'".$_POST['db_username']."'";
		$db_name="'".$_POST['db_name']."'";
		$db_pw="'".$_POST['db_password']."'";
		$db_tableprefix="'".$_POST['db_table_prefix']."'";
		$langpath="'".$_POST['language_path']."'";
		$smarty_dir="'".$_POST['smarty_dir']."'";
		$themes_dir="'".$_POST['themes_dir']."'";
		$db_driver="'".$_POST['db_driver']."'";
		$cookie_expire="".$_POST['cookie_expire']."";
		$cookie_prefix="'".$_POST['cookie_prefix']."'";
		$calendar_url="'".$_POST['calendar_url']."'";

		$installvariables = array(
		'DB_HOST' => $db_host, 
		'DB_USER' => $db_user, 
		'DB_NAME' => $db_name, 
		'DB_PASSWORD' => $db_pw, 
		'DB_TABLEPREFIX' => $db_tableprefix, 
		'DB_DRIVER' => $db_driver,
		'LANGUAGE_DIR' => $langpath, 
		'THEMES_DIR' => $themes_dir,
		'ABSOLUTE_PATH' => $absolute_path,
		'SMARTY_DIR' => $smarty_dir,
		'CALENDAR_URL' => $calendar_url,
		'COOKIE_EXPIRE' => $cookie_expire,
		'COOKIE_PREFIX' => $cookie_prefix);

		$cfgTemplate='config-template.dat';
		$cfgHandle=fopen($cfgTemplate,'r');
		$cfgData=fread($cfgHandle,filesize($cfgTemplate));
		fclose($cfgHandle);

		foreach($installvariables as $key => $value) {
			$cfgData=ereg_replace("{".$key."}", $value, $cfgData);
		}

		$createConfig=@touch('config.php');
		if($createConfig) {
			$fg = fopen('config.php', "w");
			fwrite($fg, $cfgData);	
			fclose($fg);
			addMessage('Config file created succesfully.', 'GOOD');
		} else {
			addErrorMessage('Cannot create config file.', 'CONFIG');
		}
	}

	/* OKAY, CONFIG FILE CREATED SUCCESFULLY - LET'S CREATE DATABASE TABLES */
	if(empty($errors)) 
	{
		$errors=array();
		$DB_INSTALL_IN_PROGRESS = true;
		require('init.php');
	
		$tbop=array();

		/* Check if we can connect to the DB */
		if(!$datenator->db) {
			addErrorMessage('Can\'t connect to database.', 'DB');
		} 

		/* Now we're connected to the DB, let's test if tables are already there */
		if(empty($errors)) 
		{
			$currentTables=$datenator->db->MetaTables('TABLES');
			if(in_array($datenator->getConfig('db_tableprefix').'events',$currentTables)) {
				addErrorMessage('Table "'.$datenator->getConfig('db_tableprefix').'events" already exists.', 'DB');
			}

			if(in_array($datenator->getConfig('db_tableprefix').'events_repeat',$currentTables)) {
				addErrorMessage('Table "'.$datenator->getConfig('db_tableprefix').'events_repeat" already exists.', 'DB');
			}

			if(in_array($datenator->getConfig('db_tableprefix').'events_log',$currentTables)) {
				addErrorMessage('Table "'.$datenator->getConfig('db_tableprefix').'events_log" already exists.', 'DB');
			}

			if(in_array($datenator->getConfig('db_tableprefix').'users',$currentTables)) {
				addErrorMessage('Table "'.$datenator->getConfig('db_tableprefix').'users" already exists.', 'DB');
			}

			if(in_array($datenator->getConfig('db_tableprefix').'settings',$currentTables)) {
				addErrorMessage('Table "'.$datenator->getConfig('db_tableprefix').'settings" already exists.', 'DB');
			}
		}

		/* There were no tables with same name, so let's create new ones */
		if(empty($errors)) 
		{
			$dict = NewDataDictionary($datenator->db);
			/* --- EVENTS Table --- */

			$table_events = " 
			event_id I PRIMARY AUTO,
			event_year I  NOTNULL DEFAULT 0,
			event_month I NOTNULL DEFAULT 0,
			event_day I NOTNULL DEFAULT 0,
			event_starttime C(5) NOTNULL,
			event_endtime C(5) NOTNULL,
			event_type C(1) NOTNULL,
			event_name C(45) NOTNULL,
			event_font C(45) NOTNULL,
			event_fontsize C(45) NOTNULL,
			event_fontstyle C(45) NOTNULL,
			event_fontcolor C(45) NOTNULL,
			event_description X,
			event_location X,
			event_contact X,
			event_contactemail C(100),
			event_link X,
			event_author C(45) NOTNULL,
			event_authorid I NOTNULL";

			$sql_array = $dict->createTableSQL(''.$datenator->getConfig('db_tableprefix').'events', $table_events, $tbop);
			$dict->executeSQLArray($sql_array);

			/* --- EVENTS_REPEAT Table --- */

			$table_events_repeat = "
			repeat_event_id I PRIMARY AUTO,
			repeat_frequency I NOTNULL,
			repeat_closeyear I NOTNULL,
			repeat_closemonth I NOTNULL,
			repeat_closeday I NOTNULL,
			repeat_useclosedate I NOTNULL,
			repeat_type C(45) NOTNULL,
			repeat_days C(45)";

			$sql_array = $dict->createTableSQL(''.$datenator->getConfig('db_tableprefix').'events_repeat', $table_events_repeat, $tbop);
			$dict->executeSQLArray($sql_array);

			/* --- SETTINGS Table --- */

			$table_settings = "
			setting_name C(45) PRIMARY,
			setting_value X";

			$sql_array = $dict->createTableSQL(''.$datenator->getConfig('db_tableprefix').'settings', $table_settings, $tbop);
			$dict->executeSQLArray($sql_array);

			/* --- USERS Table --- */

			$table_users = "
			user_id I PRIMARY AUTO,
			user_name C(45) NOTNULL,
			user_realname C(45),
			user_email C(45),
			user_pw C(32) NOTNULL,
			user_level I NOTNULL DEFAULT 1";

			$sql_array = $dict->createTableSQL(''.$datenator->getConfig('db_tableprefix').'users', $table_users, $tbop);
			$dict->executeSQLArray($sql_array);

			/* --- ACTIVITY LOG Table --- */

			$table_log = "
			log_id I PRIMARY AUTO,
			log_type C(1) NOTNULL,
			log_author C(45) NOTNULL,
			log_authorid I NOTNULL,
			log_date I NOTNULL,
			log_event_id I NOTNULL,
			log_event_name C(45) NOTNULL";

			$sql_array = $dict->createTableSQL(''.$datenator->getConfig('db_tableprefix').'events_log', $table_log, $tbop);
			$dict->executeSQLArray($sql_array);


			/* NOW LET'S PUT SOME DEFAULT DATA INTO THESE TABLES */

			/* Creating SUPER USER */
			$sql = "INSERT INTO ".$datenator->getConfig('db_tableprefix')."users 
			(user_name, user_realname, user_email, user_pw, user_level) values ('".$_POST['admin_username']."', '".$_POST['admin_realname']."', '".$_POST['admin_email']."', '".md5($_POST['admin_password'])."', 0)";
			$datenator->db->Execute($sql);

			/* Setting defaults */
			$defaults = $datenator->get_defaults();
			foreach($defaults as $column => $value) 
			{
				$datenator->db->execute("INSERT INTO ".$datenator->getConfig('db_tableprefix')."settings 
				(setting_name, setting_value) values ('".$column."', '".$value."')");
			}

			/* Install went well, so redirect */
			addMessage('Database tables created succesfully.', 'GOOD');
		
		} else {
			addMessage('Database tables were not created.', 'BAD');
		}

	} else {
		addMessage('Config file was not created.', 'BAD');
	}

	$printMsg=true;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1" />
	<link rel="stylesheet" href="css/install.css" type="text/css" />
	<title>Datenator installation</title>
</head>
<body>

<?php
if(isset($printMsg)) {
?>
	<table class="big_box" cellpadding="9" align="center">
		<tr>
			<td class="title_summary">Installation summary</td>
		</tr>
		<tr>
			<td>
				<table border="0">
				<?php
				foreach($messages as $message) 
				{
					print '<tr>';
					print '<td><b>'.$message.'</b></td>';
					print '</tr>';
				}
				?>
				</table>
			</td>
		</tr>
		<tr>
			<td class="title_errors">Below are the erros that installer found</td>
		</tr>
			<td>

				<table border="0">
				<?php
				if(!empty($errors)) {
				foreach($errors as $error) 
				{
					$part=parse($error);
					print '<tr>';
					print '<td><b>'.$part[0].':</b></td>';
					print '<td>'.$part[1].'</td>';
					print '</tr>';
				}
				} else {
					print 'Gongratulations! There occured no errors during installation, which means Datenator is now installed and ready to use. <a href="index.php">Click here to go to your calendar</a>!';
				}
				?>
				</table>
			</td>
		</tr>
	</table>
	<?php
}
?>
<br />
<form action="install.php" method="post">
<table class="big_box" cellpadding="9" align="center">
<tr>
<td class="title">Welcome to Datenator installation</td>
</tr>
<td>
<p>
Installing Datenator is easy. This installation wizard will guide you through few steps and that's it.
</p>
</td>
</tr>
<tr>
<td class="title">System checks</td>
</tr>
<tr>
<td>

	<table border="1" width="70%" align="center">
	<tr>

	<?php

	$phpversion = phpversion();
	if(version_compare($phpversion,'4.1.0') == -1)
	{
		$ermessage = 'PHP is too old.';
		print '<td class="failure">Failure</td><td>';
		print $ermessage.'</td></tr><tr><td colspan="2">Your PHP version is too old. Version 4.1.0 and lower don\'t have the needed functionality that is needed to run Datenator properly. Please upgrade your PHP version';
	} else {
		print '<td class="success">Success.</td><td> PHP '.$phpversion.' is ok!';
	}

	print '</td>';
	print '</tr>';
	print '<tr>';

	$reg_globals = ini_get('register_globals');

	if(empty($reg_globals)) {
		print '<td class="success">Success.</td><td> Register_globals is off.</td>';
	} else {
		$ermessage = 'Register globals is on.';
		print '<td class="failure">Failure.</td><td>';
		print $ermessage.'</td></tr><tr><td colspan="2">Register globals is on, which means that Datenator may not run properly. Also, having <i>register globals</i> on will lead to serious security risks. Please put this option off.';
	}

	print '</td>';
	print '</tr>';
	print '<tr>';

	if(is_writable('templates_c')) 
	{
		print '<td class="success">Success.</td><td> Folder "templates_c" is writable.';
	} else {
		$ermessage = 'Folder "templates_c" is NOT writable.';
		print '<td class="failure">Failure.</td><td>';
		print $ermessage.'</td></tr><tr><td colspan="2">Folder '.dirname(getenv('SCRIPT_FILENAME')).'/templates_c is NOT writable, which causes Datenator fail to run properly. Make sure that web server has rights to write to that directory.';
	}

	print '</td>';
	print '</tr>';
	print '<tr>';

	if(is_writable('.'))
	{
		print '<td class="success">Success.</td><td> Base folder is writable.';
	} else {
		$ermessage = 'Base folder is NOT writable.';
		print '<td class="failure">Failure.</td><td>';
		print $ermessage.'</td></tr><tr><td colspan="2">This means that folder '.dirname(getenv('SCRIPT_FILENAME')).' is NOT writable. ';
		print 'Make sure web server has rights to write in that folder, or Datenator may have problems creating a config file which is needed to run Datenator properly.';
	}
	?>

	</td>
	</tr>
	</table>

</td>
</tr>
<tr>
<td class="title">Common information</td>
</tr>
<tr>
<td>

	<table border="0">
	<tr>
	<td>Absolute path:</td>
	<td><input type="text" name="absolute_path" value="<?php print dirname(getenv('SCRIPT_FILENAME')); ?>" size="35"></td>
	</tr>
	<tr>
	<td>Calendar url:</td>
	<td><input type="text" name="calendar_url" value="" size="35"></td>
	</tr>
	<tr>
	<td>Languages- folder:</td>
	<td><input type="text" name="language_path" value="languages/" size="35"></td>
	</tr>
	<tr>
	<td>SMARTY-dir:</td>
	<td><input type="text" name="smarty_dir" value="smarty/libs/" size="35"></td>
	</tr>
	<tr>
	<td>Themes folder:</td>
	<td><input type="text" name="themes_dir" value="themes/" size="35"></td>
	</tr>
	<tr>
	<td>Cookie expire time:</td>
	<td><input type="text" name="cookie_expire" value="60*60*24*30" size="35"> (seconds, default 30 days)</td>
	</tr>
	<tr>
	<td>Cookie prefix:</td>
	<td><input type="text" name="cookie_prefix" value="datenator_" size="35"></td>
	</tr>
	</table>

</td>
</tr>
<tr>
<td class="title">Admin user</td>
</tr>
<tr>
<td>
<p>
Datenator system will have atleast one Super user who can view and modify everything.<br />
Now, please choose username and password for your super user account. You can add more users to your calendar system later.
</p>

	<table border="0">
	<tr>
	<td>Username:</td>
	<td><input type="text" name="admin_username" value="admin" size="35"> (required)</td>
	</tr>
	<tr>
	<td>Email:</td>
	<td><input type="text" name="admin_email" value="admin@mysite.com" size="35"> (required)</td>
	</tr>
	<tr>
	<td>Real name:</td>
	<td><input type="text" name="admin_realname" value="John Doe" size="35"></td>
	</tr>
	<tr>
	<td>Password:</td>
	<td><input type="password" name="admin_password" value="" size="35"> (required, at least 6 chars)</td>
	</tr>
	<tr>
	<td>Password check:</td>
	<td><input type="password" name="admin_password_check" value="" size="35"></td>
	</tr>
	</table>

</td>
</tr>
<tr>
<td class="title">Database setup</td>
</tr>
<tr>
<td>
<p>
Please enter your database authentication information.<br />
Install wizard won't create database for you, so you must create one by yourself.
</p>
	<table border="0">
	<tr>
	<td>DB Driver:</td>
	<td>

		<select name="db_driver">
			<option value="mysql">MySQL</option>
			<option value="postgres">PostgreSQL 7/8</option>
			<option value="oci8po">Oracle 8/9</option>
		</select>

	</td>
	</tr>
	<tr>
	<td>DB Hostname:</td>
	<td><input type="text" name="db_hostname" value="localhost" size="35"></td>
	</tr>
	<tr>
	<td>DB Username:</td>
	<td><input type="text" name="db_username" value="" size="35"></td>
	</tr>
	<tr>
	<td>DB Password:</td>
	<td><input type="password" name="db_password" value="" size="35"></td>
	</tr>
	<tr>
	<td>DB Name:</td>
	<td><input type="text" name="db_name" value="datenator" size="35"></td>
	</tr>
	<tr>
	<td>Table prefix:</td>
	<td><input type="text" name="db_table_prefix" value="dat_" size="35"></td>
	</tr>
	</table>

</td>
</tr>
<tr>
<td class="title">Save information</td>
</tr>
<tr>
<td>
<p>
Click below to create config file and database tables.
</p>
<input type="submit" name="install" value="Install Datenator">
</form>
</body>
</html>