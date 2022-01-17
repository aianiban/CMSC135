<?php
	session_start();
	if(!isset($_SESSION['unique_id'])){
		header("location: ../chat/index.php");
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
</script>
</head>

<body>
<div class="top-bar">
  <h1>
    Accompany Forum
  </h1>
</div>

<div class="main">
    <div class="header">
        <h4 class = "title">Create new thread</h4>
    </div>
    
    <form method="post" name = "new-thread">
        <p>Title</p>
        <input type="text" name = "title">
        <p>Body</p>
        <input type="text" name = "body">
        <p>Date</p>
        <input type="text" name = "date"><p></p>     
        <input type = "submit" name = "add-thread-btn" value = "Submit">
        <a href="forum-home.php"><button>Cancel</button></a>
    </form>

  





    
</div>


</body>

</html>


<?php
    include_once "../config.php";
    if(isset($_POST['add-thread-btn'])){
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $user_id = $_SESSION['unique_id'];
        $sql = mysqli_query($conn, "INSERT INTO forum_posts (title, body, date, post_userid)
                                VALUES ('$title', '$body', '$date', {$_SESSION['unique_id']})");
        
        $sql2 = mysqli_query($conn, "SELECT * FROM forum_posts WHERE post_id = (SELECT LAST_INSERT_ID())");
        $row = mysqli_fetch_assoc($sql2);
        // echo $row['post_id'];        
        // header("location: thread.php?post_id=" . $row['post_id'] . ".php");

        $header = "location: thread.php?post_id=" . $row['post_id'] . ".php";
        header($header);
    }

    


?>
