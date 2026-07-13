include('upload.php');
if($_FILES['image']['name']) {
	list($file,$error) = upload('image','uploads/','jpeg,gif,png');
	if($error) print $error;
}