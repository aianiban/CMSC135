<?php
  session_start();
  include_once "../config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../chat/login.php");
  }

  $post_id = mysqli_real_escape_string($conn, $_GET['post_id']);

  $sql = mysqli_query($conn, "SELECT * FROM forum_posts WHERE post_id = '$post_id'");
  if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);    
  }

  $_SESSION['post_id'] = $post_id;
  $request_count = 0;
  $sql3 = mysqli_query($conn, "SELECT * FROM companion_request WHERE user_two = {$_SESSION['unique_id']}");
  if(mysqli_num_rows($sql3) > 0) {
    $request_count = mysqli_num_rows($sql3);
  }
 include_once "../dashboard/modal.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="forumstyle/thread-style.css">
  <link rel="stylesheet" href="../stylea.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <!-- Modal -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Modal -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="../index/search.js"></script>
</head>
<style>
  .thread-container{
    position: absolute;
    top: 80px;
    width: 70%;
    left: 15%;
    padding-bottom: 200px;
  }

</style>


<body>

<div class="wrapper">
  <nav>
    <input type="checkbox" id="show-search">
    <input type="checkbox" id="show-menu">
    <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
    <div class="content">
    <div class="logo"><a href="#">Accompany</a></div>
      <ul class="links">
        <li><a href="../dashboard/home.php">Home</a></li>
        <li>
          <a href="../profile/profile.php" class="desktop-link">Profile</a>
          <input type="checkbox" id="show-features">
          <label for="show-features">Profile</label>
          <ul class="dropdown">
            <li><a href="../profile/profile.php">Go to profile</a></li>
            <li><a href="#" data-toggle="modal" data-target="#companion-modal">Companion List</a></li>
            <li><a href="#" class="requests-btn" data-toggle="modal" data-target="#request-modal">Requests(<?php echo $request_count;?>)</a></li>
            <li><a href="../chat/php/logout.php?logout_id=<?php echo $_SESSION['unique_id'];?>" class="logout">Logout</a></li>
          </ul>
        </li>
        <li><a href="../chat/users.php">Chat</a></li>
        <li>
          <a href="../forum/forum-home.php" class="desktop-link">Forum</a>
          <input type="checkbox" id="show-services">
          <label for="show-services">Forum</label>
          <ul class="dropdown">
            <li><a href="#">Drop Menu 1</a></li>
            <li><a href="#">Drop Menu 2</a></li>
            <li><a href="#">Drop Menu 3</a></li>
            <li>
              <a href="#" class="desktop-link">More Items</a>
              <input type="checkbox" id="show-items">
              <label for="show-items">More Items</label>
              <ul>
                <li><a href="#">Sub Menu 1</a></li>
                <li><a href="#">Sub Menu 2</a></li>
                <li><a href="#">Sub Menu 3</a></li>
              </ul>
            </li>              
          </ul>
        </li>
      </ul>
    </div>
    <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
    <form action="#" class="search-box" name="search-form">
      <input type="text" placeholder="Type Something to Search..." id="search-bar" name="search-bar" required>
      <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
      <div class="search" id="search">
      </div>                
    </form>
  </nav>
</div>


<!---------------------Thread---------------------------->
<input type="text" id="num-comments" name="num-comments" value="5" hidden>
<div class="thread-container">
  <div class="panel panel-d`efault">
    <div class="panel-body">
      <!-- <a href="../forum/forum-home.php"><h3>Accompany forum</h3></a> -->
      <h4>Title: <?php echo $row['title'];?></h4>
      <p>Body: <?php echo $row['body']?></p>
      <hr>
      <form name="frm" method="post">
        <input type="hidden" id="commentid" name="Pcommentid" value="0">

        <div class="form-group">
          <label for="comment">Write your question:</label>
          <textarea class="form-control" rows="5" name="msg" required></textarea>
        </div>
        <input type="button" id="butsave" name="butsave" class="btn btn-primary" value="Send">
      </form>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-body">
      <h4>Recent questions</h4>           
      <table class="table" id="MyTable" style="background-color: #edfafa; border:0px;border-radius:10px">
        <tbody id="record">
        
        </tbody>
      </table>
    </div>
  </div>
  <div id="forum-btns" name="forum-btns">
    <!-- <input type="button" class="btn btn-outline-success" id="view-more" value="View More Comments">
    <input type="button" class="btn btn-outline-success" id="view-entire" value="View Entire Discussion"> -->
  </div>
  
</div>



<!-- Reply Comment Modal -->
<div class="modal" role="dialog" id="reply-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Enter Your Reply</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
          <form name="frm1" method="post">
            <input type="hidden" id="commentid" name="Rcommentid">
            <div class="form-group">
              <label for="comment">Write your reply:</label>
              <textarea class="form-control" rows="5" name="Rmsg" required></textarea>
            </div>
            <input type="button" id="btnreply" name="btnreply" class="btn btn-primary" value="Reply">
          </form>            
	      </div>
	    </div>
	  </div>
	</div>



<!-- 
<div id="ReplyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class>Reply Question</h4>
      </div>
      <div class="modal-body">
        <form name="frm1" method="post">
            <input type="hidden" id="commentid" name="Rcommentid">
        	<div class="form-group">
        	  <label for="usr">Write your name:</label>
        	  <input type="text" class="form-control" name="Rname" required>
        	</div>
            <div class="form-group">
              <label for="comment">Write your reply:</label>
              <textarea class="form-control" rows="5" name="Rmsg" required></textarea>
            </div>
        	 <input type="button" id="btnreply" name="btnreply" class="btn btn-primary" value="Reply">
      </form>
      </div>
    </div>
  </div>
</div> -->

</body>
<script src = "javascript/thread.js"></script>
</html>


