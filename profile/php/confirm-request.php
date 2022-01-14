<?php
    // session_start();
    include_once "../../config.php";    
    $user = $_POST['user'];
    $add_user = $_POST['add_user'];
    if($user != "" && $add_user != ""){
        $sql = mysqli_query($conn, "DELETE FROM companion_request WHERE user_one = '$add_user' AND user_two = '$user'") or die();
        $sql2 = mysqli_query($conn, "INSERT INTO companion (user, user_companion)
                    VALUES (" . $user . ", " . $add_user . ")") or die();
        $sql3 = mysqli_query($conn, "INSERT INTO companion (user, user_companion)
                    VALUES (" . $add_user . ", " . $user . ")") or die();
        echo json_encode(array("statusCode"=>200));
    } else {
        echo json_encode(array("statusCode"=>201));
    }
    $conn = null;
        

        
    
?>