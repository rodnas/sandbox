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

<?php
include '../vault.php';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
  <head>
    <title>Calendar Admin</title>
    <link rel="stylesheet" title="Default" type="text/css" href="../style.css" />
  </head>
  <body>
    <h1>Calendar Admin: Setup</h1>
    <p style="text-align: center;"><a href="index.php" class="link">Back to Index</a></p>
    <p style="text-align: center;"><a href="../" class="link">Back to Calendar</a></p>
	
<div class="panel">
<h2>Password Protection</h2>

<?php
if (isset($_GET['change']) && $_GET['change'] == 'protection') {
	// Change protection type
	$prefs = file_get_contents('../data/prefs.php');
	$currentstr = '$protectionType = \'' . $protectionType . '\'';
	$newstr = '$protectionType = \'' . $_POST['type'] . '\'';
	$prefs = str_replace($currentstr, $newstr, $prefs);
	
	$handle = fopen('../data/prefs.php', 'w');
	fwrite($handle, $prefs);
	fclose($handle);
	
	echo '<span style="color: red;">Your changes have been made!</span>';
}
?>

<form method="post" action="setup.php?change=protection">
<?php
echo '<p>Protection Type: <select name="type"><option value="admin"';
if ($protectionType == 'admin') {
	echo ' selected="selected"';
} echo '>Protect Admin Only</option>
<option value="all"';
if ($protectionType == 'all') {
	echo ' selected="selected"';
} echo '>Protect Everything</option>
<option value="none"';
if ($protectionType == 'none') {
	echo ' selected="selected"';
} echo '>Protect Nothing</option>
</select>';
echo '<p><input type="submit" value="Change" /></p>';
?>
</form>

</div>


<div class="panel">
<h2>View Options</h2>
<?php
if (!isset($_GET['change']) || $_GET['change'] != 'view') {
?>
<form method="post" action="setup.php?change=view">
<?php
echo '<p>Default View: <select name="view">';
if ($view == 'month') {
	echo <<<ED
<option value="month">Month -</option>
<option value="day">Day +</option>
</select></p>
ED;
}
else {
echo <<<ED
<option value="day">Day -</option>
<option value="month">Month +</option>
</select></p>
ED;
}

echo '<p>Show Buttons: <input type="checkbox" name="showBtns" value="yes"';
if ($showButtons == 'yes') {
	echo ' checked=checked" /><br />';
}
else {
	echo '" /><br />';
}
echo '<img src="../images/btn_pre.png" alt="Button Preview" /></p>';
?>
<p><input type="submit" value="Change" /></p>
</form>
<?php
} else {
?>

<?php
// Once change view form submitted change stuff if needed
if ($_GET['change'] == 'view' && $_POST['view'] != $view) {
	$prefs = file_get_contents('../data/prefs.php');
	$prefs = str_replace($view, $_POST['view'], $prefs);
	// Now write to disk
	$handle = fopen('../data/prefs.php', 'w');
	fwrite($handle, $prefs);
	fclose($handle);
}

if ($_GET['change'] == 'view') {
	if ($_POST['showBtns'] != 'yes') {
		$showBtns = 'no';
	}
	else {
		$showBtns = 'yes';
	}
}

if ($_GET['change'] == 'view' && $showBtns != $showButtons) {
	$prefs = file_get_contents('../data/prefs.php');
	$prefs = str_replace($showButtons, $showBtns, $prefs);
	// Now write to disk
	$handle = fopen('../data/prefs.php', 'w');
	fwrite($handle, $prefs);
	fclose($handle);
}
echo '<span style="color: red;">Your changes have been made!</span>';
?>

<?php
}
?>
</div>

  </body>
</html>
