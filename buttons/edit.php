<?php
	include '../config.php';
	$id=$_POST['id'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$city=$_POST['city'];
	$position=$_POST['position'];
	$bio=$_POST['bio'];
	$sql = "UPDATE `users` 
	SET `fname`='$fname', 
	`lname`='$lname',
	`email`='$email',
	`phone`='$phone',
	`city`='$city',
	`position`='$position',
	`bio`='$bio' WHERE unique_id=$id";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>