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
  <link rel="stylesheet" href="forumstyle/forum-home-style-old.css">
  
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


<tr>
  <td>
    <b><img src="avatar.jpg" width="30px" height="30px" />' + data[i].student + ' :<i> '+ data[i].date + ':</i></b></br>
    <p style="padding-left:80px">
      ' + data[i].post + '</br>
      <a data-toggle="modal" data-id="'+ commentId +'" title="Add this item" class="open-ReplyModal" href="#ReplyModal">Reply</a>'+'
    </p>
  </td>
</tr>



</body>
</html>
