<?php
include_once "../../config.php";
session_start();

$id = $_POST['id'];
$user = $_SESSION['unique_id'];
$msg = $_POST['msg'];
$post_id = $_SESSION['post_id'];
$date_updated = date("Y-m-d H:i:s");

if($id != "" && $msg != "") {
    $sql2 = mysqli_query($conn, "INSERT INTO forum_comments (parent_comment, comment_userid, comment_content, post_id, date_posted)
                VALUES ('$id', '$user', '$msg', '$post_id', '$date_updated')");
    $sql3 = mysqli_query($conn, "UPDATE forum_posts SET date_update='$date_updated', comment_count=comment_count+1 WHERE post_id='$post_id'");
    echo json_encode(array("statusCode"=>200));
} else {
    echo json_encode(array("statusCode"=>201));
}

$conn = null;




?>