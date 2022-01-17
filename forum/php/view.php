<?php
include '../../config.php';
session_start();
$data = array();
$post_id = $_SESSION['post_id'];
$sql = mysqli_query($conn, "SELECT * FROM forum_comments WHERE post_id = '$post_id'");
while($row = mysqli_fetch_assoc($sql)){
    $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$row['comment_userid']}");
    $row2 = mysqli_fetch_assoc($sql2);
    $row['comment_user'] = $row2['fname'] . " " . $row2['lname'];
    $row['img'] = $row2['img'];
    array_push($data, $row);
}
echo json_encode($data);
// echo print_r($data);
$conn = null;
exit();




// include '../../../forum/conn.php';
// $data = array();
// $sql = "SELECT *  FROM `discussion` ORDER BY id desc";
// $result = $conn->query($sql);
// while($row = $result->fetch()){
//         array_push($data, $row);
//         // array_push($data);
//         // echo $row['id'] . " " . $row['parent_comment'] . " " . $row['student'] . " " . $row['post'] . " " . $row['date'] . "</br>";
// }
// // echo print_r($data);
// echo json_encode($data);
// $conn = null;
// exit();


?>
