<?php
// Include some files
include 'functions.php';
include 'data/prefs.php';

session_start();
if ($_SESSION['ACalAuthenticate'] != 'inside') {
	if ($protectionType = 'all' || $protectionType = 'admin') {
		$redirectlocation = 'Location: login_mini.php?year=' . $_GET['year'] . '&month=' . $_GET['month'] . '&day=' . $_GET['day'];
		header($redirectlocation);
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
 <head>
  <title>Insert Image</title>
  <link rel="stylesheet" title="Default" type="text/css" href="style.css" />
 </head>
 <body>
  <div>
   <form enctype="multipart/form-data" action="insert_img.php?upload=file" method="post">
     <p>Select Image: <input name="userfile" type="file" size="25" /></p>
     <b>OR</b>
     <p>Url: <input type="text" size="35" name="url" value="http://" /></p>
     <input type="submit" value="Submit" />
   </form>
   
<?php

if ($_GET['upload'] == file) {
	if ($_POST['url'] == 'http://') {
		$MAX_FILE_SIZE = '999999999';
		$uploaddir = 'uploads/';
		$uploadfile = $uploaddir . $_FILES['userfile']['name'];

		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			echo 'Copy this line into the description.<br />';
			echo '<textarea cols="40" rows="2" name="code"><img src="uploads/' . $_FILES['userfile']['name'] . '" alt="Image" /></textarea>';
		}
	}
	elseif (preg_match('/(.*)/', $_POST['url'])) {
		echo 'Copy this line into the description.<br />';
		echo '<textarea cols="40" rows="2" name="code"><img src="' . $_POST['url'] . '" alt="Image" /></textarea>';
	}
}

?>
   
  </div>
 </body>
</html>