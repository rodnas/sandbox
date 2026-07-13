<?php
// Send do not cache headers if not sent already
if (!headers_sent()) {
	header("Cache-control: private, no-cache");
	header("Expires: Mon, 10 Jan 2000 09:00:00 GMT");
	header("Pragma: no-cache");
}
session_start();
include 'vault.php';
include 'functions.php';
include 'data/prefs.php';

// Turn debug mode on if set
if ($debug == 'on') {
	ini_set('display_errors', '1');
}

if (isset($_GET['log']) && $_GET['log'] == 'in') {
	$logswitch = login_auth($_POST['user'], $_POST['pass']);
	if ($logswitch == 'true') {
		$_SESSION['ACalAuthenticate'] = 'inside';
		$redirectlocation = 'Location: e_edit.php?year=' . $_GET['year'] . '&month=' . $_GET['month'] . '&day=' . $_GET['day'];
		header($redirectlocation);
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
 <head>
  <title>Login to Calendar</title>
  <link rel="stylesheet" title="Default" type="text/css" href="style.css" />
 </head>
 <body> 

<div class="paneltwo">
<?php
if (isset($_GET['log']) && $_GET['log'] == 'in') {
	if ($logswitch == 'false') {
		echo '<span style="color: red;">You either entered a wrong username or password. Please try again.</span>';
	}
}
?>
<?php
echo '<form method="post" action="login_mini.php?log=in&year=';
echo $_GET['year'] . '&month=' . $_GET['month'] . '&day=' . $_GET['day'] . '">';
?>
<p>Username: <input type="text" name="user" size="20" /></p>
<p>Password: <input type="password" name="pass" size="20" /></p>
<p><input type="submit" value="Login" /></p>
</form>
</div>

  </body>
</html>