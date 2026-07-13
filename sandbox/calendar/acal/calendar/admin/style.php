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
    <h1>Calendar Admin: Edit Style</h1>
    <p style="text-align: center;"><a href="index.php" class="link">Back to Admin Index</a></p>
    <p style="text-align: center;"><a href="../" class="link">Back to Calendar</a></p>

<div class="panel">
<h2>Style Options</h2>
<p>Below you can edit the stylesheet source. In the future this page will have more and better options.</p>
<?php
$stylefile = file_get_contents('../style.css');
echo '<form method="post" action="style.php?edit=style">';
echo '<textarea name="stylesheet" cols="60" rows="20">' . $stylefile . '</textarea>';
echo '<p><input type="submit" value="Edit" /></p>';
echo '</form>';

if (isset($_GET['edit']) && $_GET['edit'] == 'style') {
	$stylefile = str_replace('\\', '', $_POST['stylesheet']);
	$handle = fopen('../style.css', 'w');
	fwrite($handle, $stylefile);
	fclose($handle);
	echo 'Your stylesheet has been edited.';
}
?>
</div>

  </body>
</html>