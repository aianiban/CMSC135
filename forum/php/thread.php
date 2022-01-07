<?php
session_start();
include_once "../../config.php";

$post_id = 17;
$output = "";
    $sql = mysqli_query($conn, "SELECT * FROM forum_comments WHERE post_id = '$post_id'");
    if(mysqli_num_rows($sql) == 0){
        $output .= "";
    } else{
        $sql2 = mysqli_query($conn, "SELECT * FROM forum_comments WHERE post_id = '$post_id'");
        if(mysqli_num_rows($sql2) > 0){
            while($row = mysqli_fetch_assoc($sql2)){
                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$row['comment_userid']}");
                $row2 = mysqli_fetch_assoc($sql3);
                $output .= '
                    <div class="comment">
                    <div class="top-comment">
                        <p class="user">' . $row2['fname'] . '</p>
                        <p class="comment-ts">' . $row['date'] . '</p>
                    </div>
                    <div class="comment-content">' . $row['comment_content'] . '</div>
                    </div>';
            }
        }
    }
    echo $output;


?>

