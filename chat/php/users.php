<?php
    include_once "../../config.php";
    session_start();    
    $outgoing_id = $_SESSION['unique_id'];
    // $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = '$outgoing_id'");
    $select_user = mysqli_query($conn, "SELECT * FROM companion WHERE user = '$outgoing_id'");
    $output = "";
    if(mysqli_num_rows($select_user) == 0){
        $output .= "No users";
    } elseif(mysqli_num_rows($select_user) > 0) {
        include "data.php";
    }
    echo $output;











    // include_once "../../config.php";
    // session_start();    
    // $outgoing_id = $_SESSION['unique_id'];
    // $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = '$outgoing_id'");
    // $output = "";
    // if(mysqli_num_rows($sql) == 0){
    //     $output .= "No users";
    // } elseif(mysqli_num_rows($sql) > 0){
    //     include "data.php";
    // }
    // echo $output;
?>



