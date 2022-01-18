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
  <title></title>

  <link rel="stylesheet" href="forumstyle/thread-style.css">
  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    $("#new-comment").submit(function(e) {
    e.preventDefault();
});
  </script>
</head>

<body>
<div class="top-bar">
  <a href="forum-home.php"><h1>Accompany Forum</h1></a>
</div>
<div class="main">
  <div class="header">
    <h4 class = "title">
    <?php
      $post_id = mysqli_real_escape_string($conn, $_GET['post_id']);
      $sql = mysqli_query($conn, "SELECT * FROM forum_posts WHERE post_id = '$post_id'");
      if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        echo $row['title'];
      }

    ?>
      
    </h4>
    <div class="bottom">
      <p class = "timestamp"><?php echo $row['date'];?></p>
      <p class = "comment-count"><?php echo $row['comment_count'];?> comments</p>
    </div>
  </div>

<div class="comments">
  
  
</div>
<form method="post" name="new-comment" id="new-comment">
    <textarea name = "new-comment-content"></textarea></br>
    <input type = "submit" name = "new-comment-btn" value = "Add Comments">
</form>

</body>
<style>

</style>
<script src = "javascript/thread.js"></script>
</html>

<?php
    if(isset($_POST['new-comment-btn'])){
        $post_id = $_GET['post_id'];
        $comment_content = mysqli_real_escape_string($conn, $_POST['new-comment-content']);
        $comment_userid = $_SESSION['unique_id'];
        $date = date("F j, Y");

        $sql = mysqli_query($conn, "INSERT INTO forum_comments (post_id, comment_userid, comment_content, date)
                                    VALUES ($post_id, $comment_userid, '$comment_content', '$date')");
        // if($sql) {

        // }
    }
?>