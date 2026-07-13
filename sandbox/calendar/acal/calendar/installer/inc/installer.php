<?php
// Installer version 2.1

// Check for required fields
if ($_POST['user'] == '' || $_POST['pass'] == '') {
	echo '<p style="color: red;">You did not fill in all the required fields. Please go back and try again.</p>';
	exit;
}


$newVersion = '2.2';

// Make the data folder
if (!is_dir('../data')) {
	if (!mkdir('../data', 0777)) {
		echo '<p>Could not make data folder.</p>';
	}
}

// Make the uploads folder
if (!is_dir('../uploads')) {
	if (!mkdir('../uploads', 0777)) {
		echo '<p>Could not make uploads folder.</p>';
	}
}

// Configure and install the preferences
$handle = fopen('contents/prefs.php', 'r');
$prefs = fread($handle, filesize('contents/prefs.php'));
fclose($handle);

$prefs = str_replace('xview', $_POST['view'], $prefs);
$prefs = str_replace('xshow', 'yes', $prefs);

$handle = fopen('../data/prefs.php', 'w');
if (!fwrite($handle, $prefs)) {
	echo '<p>Could not configure preferences.</p>';
	fclose($handle);
}
else {
	fclose($handle);
}

// Configure and install the vault
$vault = array($_POST['user'] => $_POST['pass']);
$vault = serialize($vault);

$handle = fopen('contents/vault.php', 'r');
$fvault = fread($handle, filesize('contents/vault.php'));
fclose($handle);

$vault = str_replace('xvault', $vault, $fvault);

$handle = fopen('../vault.php', 'w');
if (!fwrite($handle, $vault)) {
	echo '<p>Could not configure username and password.</p>';
	fclose($handle);
}
else {
	fclose($handle);
}

// Make the footer and header files
$handle = fopen('../footer.php', 'w');
fclose($handle);
$handle = fopen('../header.php', 'w');
fclose($handle);

// Install the stylesheet
copy('contents/style.css', '../style.css');

// Install the version.
$handle = fopen('contents/version.php', 'r');
$version = fread($handle, filesize('contents/version.php'));
fclose($handle);

$version = str_replace('xxx', $newVersion, $version);

$handle = fopen('../version.php', 'w');
if (!fwrite($handle, $version)) {
	echo '<p>Could not configure the version.</p>';
	fclose($handle);
}
else {
	fclose($handle);
}

// Echo Installation Report
echo '<p>Your calendar has been installed. If you see any errors above see the manual that came with your download.<br />[ <a href="../">Visit Calendar</a> ]';
?>