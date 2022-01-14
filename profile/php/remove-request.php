<?php
    // session_start();
    include_once "../../config.php";    
    $user = $_POST['user'];
    $add_user = $_POST['add_user'];
    if($user != "" && $add_user != ""){
        $sql = mysqli_query($conn, "DELETE FROM companion_request WHERE user_one = {$user} AND user_two = {$add_user}") or die();
        echo json_encode(array("statusCode"=>200));
    } else {
        echo json_encode(array("statusCode"=>201));
    }
    $conn = null;
        

        
    
?>