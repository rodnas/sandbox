<?php
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>ACal Embedding Example</title>
	<?php
	$view = "day"; // Can be month or day.
	$path = "../../"; // Relative or absolute path to calendar folder. Must have a trailing slash.
	
	// Do not edit the rest unless you know what you're doing
	echo '<link rel="stylesheet" title="Default" type="text/css" href="' . $path . 'style.css" />';
	if ($view == 'month' || isset($_GET['view'])) {
		echo '<script src="' . $path . 'e_edit.js" type="text/javascript"></script>';
	}
	?>
</head>
<body>
<h1>This web page is embedding the ACal Calendar.</h1>
<?php
// DO NOT EDIT
if (!isset($_GET['view'])) {
	include $path . 'embed/' . $view . '.php';
}
else {
	include $path . 'embed/' . $_GET['view'] . '.php';
}
?>
</body>
</html>
