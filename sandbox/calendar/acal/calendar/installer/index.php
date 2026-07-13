<?php
// Installer 2.1
// Revision 2
// This installer is a light-weight installer meant for easy installation of the ACal calendar.
// License: GNU General Pulic Licence
// http://acalproj.sourceforge.net
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
 <head>
  <title>Install ACal</title>
  <link rel="stylesheet" title="Default" type="text/css" href="style.css" />
 </head>
 <body>
 <div class="head">
 <img src="images/logo.png" alt="Installer 2.1" /> <span>Install ACal 2.2</span>
 </div>
 
 <?php
 // Check for requirements
 if (!$handle = fopen('../testfile', 'w')) {
 	echo '<div class="error">Calendar cannot write data. <a href="http://sourceforge.net/docman/display_doc.php?docid=23746&amp;group_id=105617#1.1.2">Read Section #1.1.2 in the manual</a>.</p>';
 	fclose($handle);
 	$check = 'bad';
 }
 else {
 	fclose($handle);
 	unlink('../testfile');
 	$check = 'passed';
 }
 
 if ($check == 'passed' && $_GET['action'] != 'install') {
 	echo <<<END
 <div class="form">
 <form method="post" action="index.php?action=install">
 <p>Default View: <select name="view">
 <option value="month">Month</option>
 <option value="day">Day</option>
 </select></p>
 
 <p>Username: <input type="text" size="20" name="user" /></p>
 <p>Password: <input type="password" size="20" name="pass" /></p>
 <p><input type="submit" value="Start Install" /></p>
 </form>
 </div>
END;
 }
 else {
  include 'inc/installer.php';
 }
 ?>
 </body>
</html>