<?php
include_once "config.php";

// $sql = mysqli_query($conn, "SELECT * FROM users INNER JOIN companion ON users.unique_id=companion.user
//                         WHERE unique_id = '1493215544'");

$select_user = mysqli_query($conn, "SELECT * FROM companion WHERE user = '1493215544'");
if(mysqli_num_rows($select_user) > 0) {
    while($row_user = mysqli_fetch_assoc($select_user)) {
        $select_user_companions = mysqli_query($conn, "SELECT unique_id, fname, lname, img, status FROM users WHERE unique_id = {$row_user['user_companion']}");
        $row_companions = mysqli_fetch_assoc($select_user_companions);
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row_companions['unique_id']}
                OR outgoing_msg_id = {$row_companions['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if(mysqli_num_rows($query2) > 0){
            $result = $row2['msg'];
        } else{
            $result = "No message available";
        }

        //message preview
        if(strlen($result) > 28){
            $msg = substr($result, 0, 28) . "...";
        } else {$msg = $result;}

        if($outgoing_id == $row2['outgoing_msg_id']){
            $you = "You: ";
        } else {$you = "";}

        //online status
        if($row_companions['status'] == "Offline now"){
            $offline = "offline";
        }  else {$offline = "";}


        $output .= '
        <a href="chat.php?user_id=' . $row_companions['unique_id'] . '">
            <div class="content">
                <img src="../img/' . $row_companions['img'] . '" alt="">
                <div class="details">
                    <span>' . $row_companions['fname'] . ' ' . $row_companions['lname']  . ' </span>
                    <p>' . $you . $msg . '</p>
                </div>
            </div>
            <div class="status-dot ' . $offline . '">
                <i class="fas fa-circle"></i>
            </div>
        </a>';
    }



// 1493215544 - Benjamin Julien
// 2 compaions: John saka sama

// 444558286 - sama
//1 companion: Benjamin Julien

// 930844194 - John
// 436445548 - Acc









// $select_user = mysqli_query($conn, "SELECT * FROM companion WHERE user = '1493215544'");
// if(mysqli_num_rows($select_user) > 0) {
//     while($row_users = mysqli_fetch_assoc($select_user)) {
//         $select_user_companions = mysqli_query($conn, "SELECT unique_id, fname, lname, img, status FROM users WHERE unique_id = {$row_users['user_companion']}");
//         $row = mysqli_fetch_assoc($select_user_companions);
//         echo $row['fname'] . "</br>";
//     }    
// }




?>