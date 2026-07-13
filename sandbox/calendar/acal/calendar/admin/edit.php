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
    <h1>Calendar Admin: Edit Header and Footer</h1>
    <p style="text-align: center;"><a href="index.php" class="link">Back to Admin Index</a></p>
    <p style="text-align: center;"><a href="../" class="link">Back to Calendar</a></p>
    
<?php
if (isset($_GET['edit']) && $_GET['edit'] == 'header') {
	$file = '../header.php';
	$fh = fopen($file, 'w');
	$head = stripslashes($_POST['header']);
	fwrite($fh, $head);
	fclose($fh);
	echo "<span style=\"color: red;\">Header has been changed!</span>";
}
if (isset($_GET['edit']) && $_GET['edit'] == 'footer') {
	$file = '../footer.php';
	$fh = fopen($file, 'w');
	$foot = stripslashes($_POST['footer']);
	fwrite($fh, $foot);
	fclose($fh);
	echo "<span style=\"color: red;\">Footer has been changed!</span>";
}
?>

<div class="panel">
<h2>Edit/Add Header</h2>
<form action="edit.php?edit=header" method="post">
<p><textarea cols="60" rows="14" name="header"><?php include '../header.php'; ?></textarea></p>
<p><input type="submit" value="Submit Changes" /></p>
</form>
</div>

<div class="panel">
<h2>Edit/Add Footer</h2>
<form action="edit.php?edit=footer" method="post">
<p><textarea cols="60" rows="14" name="footer"><?php include '../footer.php'; ?></textarea></p>
<p><input type="submit" value="Submit Changes" /></p>
</form>
</div>

  </body>
</html>
