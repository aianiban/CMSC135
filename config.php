<?php
    $conn = mysqli_connect("localhost", "root", "", "accompany");
    if(!$conn){
        echo "Failed to connect database connected " . mysqli_connect_error();
    }


?>