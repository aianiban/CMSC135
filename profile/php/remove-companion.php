<?php
    // session_start();
    include_once "../../config.php";    
    $user = $_POST['user'];
    $add_user = $_POST['add_user'];
    if($user != "" && $add_user != ""){
        $sql = mysqli_query($conn, "DELETE FROM companion WHERE (user = '$add_user' AND user_companion = '$user') OR (user = '$user' AND user_companion = '$add_user')") or die();
        echo json_encode(array("statusCode"=>200));
    } else {
        echo json_encode(array("statusCode"=>201));
    }
    $conn = null;
        

        
    
?>