<?php
	session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: ../login.php");
    }
	include '../config.php';
	$sql = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	echo json_encode($row);
	mysqli_close($conn);
?>