<?php
    include_once "../../config.php";    
    $user = $_POST['user'];
    $add_user = $_POST['add_user'];
    if($user != "" && $add_user != ""){
        $sql = mysqli_query($conn, "INSERT INTO companion_request (user_one, user_two)
                    VALUES (" . $user . ", " . $add_user . ")") or die();
        echo json_encode(array("statusCode"=>200));
    } else {
        echo json_encode(array("statusCode"=>201));
    }
    $conn = null;  
?>