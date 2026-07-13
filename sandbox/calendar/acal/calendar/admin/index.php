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
    <h1>Calendar Admin: Index</h1>
    <p style="text-align: center;"><a href="../" class="link">Back to Calendar</a></p>

<div class="panel">
<table class="prefs">
 <tr>
  <td><a href="purge.php" class="pref" title="Purge"><img src="icons/purge.png" alt="Purge" /></a></td>
  <td><a href="changelogin.php" class="pref" title="Login"><img src="icons/login.png" alt="Login" /></a></td>
  <td><a href="edit.php" class="pref" title="Header/Footer"><img src="icons/head-foot.png" alt="Edit Header/Footer" /></a></td>
  <td><a href="setup.php" class="pref" title="Setup"><img src="icons/setup.png" alt="Setup" /></a></td>
 </tr>
 <tr>
  <td><a href="style.php" class="pref" title="Style Options"><img src="icons/style.png" alt="Style" /></a></td>
 </tr>
</table>
 
  
</div>

  </body>
</html>
