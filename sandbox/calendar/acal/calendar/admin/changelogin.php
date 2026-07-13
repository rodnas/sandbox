<?php
// Include some files
include '../functions.php';
include '../data/prefs.php';

session_start();

if ($_SESSION['ACalAuthenticate'] != 'inside') {
	if ($protectionType == 'all' || $protectionType == 'admin') {
		header("Location: ../login.php");
	}
}
?>

<?php
// Include all the stuff I need
include '../vault.php';

// Turn debug mode on if set
if ($debug == 'on') {
	ini_set('display_errors', '1');
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
  <head>
    <title>Calendar Admin</title>
    <link rel="stylesheet" title="Default" type="text/css" href="../style.css" />
  </head>
  <body>
    <h1>Calendar Admin: Setup: Users Admin</h1>
    <p style="text-align: center;"><a href="index.php" class="link">Back to Index</a></p>
    <p style="text-align: center;"><a href="../" class="link">Back to Calendar</a></p>
	

<div  class="panel">
<h2>Add User</h2>
<?php
if (!isset($_GET['action'])) {
	echo '<form method="post" action="changelogin.php?action=add">';
	echo '<p>Username: <input type="text" size="20" name="user" /></p>';
	echo '<p>Password: <input type="password" size="20" name="pass" /></p>';
	echo '<p><input type="submit" value="Add User" /></p>';
	echo '</form>';
}

if (isset($_GET['action']) && $_GET['action'] == 'add') {
	if ($_POST['user'] == '' || $_POST['pass'] == '') {
		echo '<span style="color: red;">You did not fill all the required fields. [ <a href="changelogin.php">More...</a> ]</span>';
		exit;
	}
	else {
		$newvault = unserialize($vault);
		$user = $_POST['user'];
		$newvault[$user] = $_POST['pass'];
		$newvault = serialize($newvault);
		$newvault = '<' . '?' . 'php' . "\n" . '$vault = <<<END' . "\n" . $newvault . "\n" . 'END;' . "\n" . '?' . '>';
		$handle = fopen('../vault.php', 'w');
		if (fwrite($handle, $newvault)) {
			echo '<span style="color: red;">User has been added. [ <a href="changelogin.php">More...</a> ]</span>';
		}
		else {
			echo '<span style="color: red;">User could not be added. [ <a href="changelogin.php">More...</a> ]</span>';
		}
		fclose($handle);
	}
}
?>

</div>

<div class="panel">
<h2>Edit/Remove User</h2>

<?php
if (!isset($_GET['action'])) {
echo '<form method="post" action="changelogin.php?action=edit">';
// List the current info
echo '<p>User: <select name="user">';
$users = array_keys(unserialize($vault));
foreach ($users as $user) {
	echo '<option value="' . $user . '">' . $user . '</option>';
}
echo '</select></p>';
echo '<p>Current Password: <input type="password" name="oldpass" size="25" /></p>';
echo '<p>New Password: <input type="password" name="newpass" size="25" /></p>';
echo '<p>Remove User: <input type="checkbox" name="remove" value="true" /></p>';
echo '<p><input type="submit" value="Edit/Remove" /></p>';
echo '</form>';
}
?>
<?php
// Do the user edit and remove stuff
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
	// First thing ya gotta do is make sure all information is valid
	// Make sure all the required fields are filled.
	if (!isset($_POST['remove'])) {
		if ($_POST['oldpass'] == '' || $_POST['newpass'] == '') {
			echo '<span style="color: red;">You did not fill all the required fields. [ <a href="changelogin.php">More...</a> ]</span>';
			exit;
		}
	}
	elseif ($_POST['remove'] == 'true') {
		if ($_POST['oldpass'] == '') {
			echo '<span style="color: red;">You did not fill all the required fields. [ <a href="changelogin.php">More...</a> ]</span>';
			exit;
		}
	}
	
	// Make sure the password is correct
	$vault = unserialize($vault);
	if (count($vault) <= '1' && isset($_POST['remove'])) {
		echo '<span style="color: red;">You cannot remove the last user. [ <a href="changelogin.php">More...</a> ]</span>';
		exit;
	}
	$logged = login_auth($_POST['user'], $_POST['oldpass']);
	if ($logged == 'false') {
		echo '<span style="color: red;">You used a wrong password. [ <a href="changelogin.php">More...</a> ]</span>';
		exit;
	}
	elseif ($logged == 'true') {
		// If the user is supposed to be removed do it!
		if (isset($_POST['remove'])) {
			$user = $_POST['user'];
			unset($vault[$user]);
			$newvault = serialize($vault);
			$newvault = '<' . '?' . 'php' . "\n" . '$vault = <<<END' . "\n" . $newvault . "\n" . 'END;' . "\n" . '?' . '>';
			$handle = fopen('../vault.php', 'w');
			if (fwrite($handle, $newvault)) {
				echo '<span style="color: red;">User has been removed. [ <a href="changelogin.php">More...</a> ]</span>';
			}
			else {
				echo '<span style="color: red;">User could not be removed. [ <a href="changelogin.php">More...</a> ]</span>';
			}
			fclose($handle);
		}
		if (!isset($_POST['remove'])) {
			$user = $_POST['user'];
			$newvault = $vault;
			$newvault[$user] = $_POST['newpass'];
			$newvault = serialize($newvault);
			$newvault = '<' . '?' . 'php' . "\n" . '$vault = <<<END' . "\n" . $newvault . "\n" . 'END;' . "\n" . '?' . '>';
			$handle = fopen('../vault.php', 'w');
			if (fwrite($handle, $newvault)) {
				echo '<span style="color: red;">Password has been changed. [ <a href="changelogin.php">More...</a> ]</span>';
			}
			else {
				echo '<span style="color: red;">Password could not be changed. [ <a href="changelogin.php">More...</a> ]</span>';
			}
			fclose($handle);
		}
	}
}
?>
</div>
  </body>
</html>