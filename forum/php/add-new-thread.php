<?php
    include_once "../../config.php";
    session_start();

    $user = $_SESSION['unique_id'];
    $newThreadTitle = $_POST['newThreadTitle'];
    $newThreadBody = $_POST['newThreadBody'];
    $date = date("Y-m-d H:i:s");  

    // $user = 12345234;
    // $newThreadTitle = "gibberish";
    // $newThreadBody = "more gibberish";

    if($newThreadTitle != "" && $newThreadBody != "") {
        $sql = mysqli_query($conn, "INSERT INTO forum_posts (title, body, post_userid, date_posted, date_update) 
                VALUES ('$newThreadTitle', '$newThreadBody', '$user', '$date', '$date')");
                echo json_encode(array("statusCode"=>200));
    } else {
        echo json_encode(array("statusCode"=>201));
    }


?>