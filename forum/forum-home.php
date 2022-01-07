<?php
  session_start();
  include_once "../config.php";
  if(!isset($_SESSION['unique_id'])){
      header("location: ../chat/login.php");
  }



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Accompany</title>
  <link rel="stylesheet" href="formstyle/forum-home-style.css">
  
</head>
<body>
<div class="top-bar">
  <h1>
    Accompany Forum
  </h1>
  <a href="add-thread.php"><button>Add thread</button></a>
</div>
<div class="main">
  <ol class = "forum-list">
  </ol>
</div>

<script src = "javascript/forum-home.js"></script>


</body>
</html>
