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
    <h1>Calendar Admin: Purge Calendar</h1>
    <p style="text-align: center;"><a href="index.php" class="link">Back to Index</a></p>
    <p style="text-align: center;"><a href="../" class="link">Back to Calendar</a></p>
	
<div class="panel">
<h2>Purge Calendar Events</h2>
<p>Purging your calendar will remove all old events from months gone by. This can speed up your calendar as well as free up disk space.</p>
<form action="purge.php?purge=now" method="post">
<p><input type="submit" value="Purge" /></p>
</form>

<?php
if (isset($_GET['purge']) && $_GET['purge'] == 'now') {
	$rmonth = date("m");
	$rmonth--;
	$month = sprintf('%02d' , $rmonth);
	$sieve = date("Y") . $month . '31';
	
	if ($handle = opendir('../data')) {
     	while (false !== ($file = readdir($handle))) {
     		$myfile = substr($file, '0', '8');
     		if ($myfile <= $sieve) {
     			if ($file != '..' && $file != '.' && $file != '.DS_Store') {
     				unlink('../data/' . $file);
     			}
     		}
     	}
     	closedir($handle);
     }
     echo '<span style="color: red;">Your Calendar Has Been Purged</span>';
}
?>

</div>

  </body>
</html>
