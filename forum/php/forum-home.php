<?php
    session_start();
    include_once "../../config.php";
    $output = "";
    $sql = mysqli_query($conn, "SELECT * FROM forum_posts ORDER BY date_update DESC");
    if(mysqli_num_rows($sql) == 0){
        $output .= "";
    } else{
        include "data.php";
    }
    echo $output;


?>