<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: ../login.php");
    }
    include_once "../config.php";
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
    }
    $_SESSION['post_id'] = "";
    $request_count = 0;
    $sql3 = mysqli_query($conn, "SELECT * FROM companion_request WHERE user_two = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql3) > 0) {
      $request_count = mysqli_num_rows($sql3);
    }
    $request_count = 0;
    $sql3 = mysqli_query($conn, "SELECT * FROM companion_request WHERE user_two = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql3) > 0) {
      $request_count = mysqli_num_rows($sql3);
    }
		include_once "../dashboard/modal.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Accompany</title>
  <link rel="stylesheet" href="../stylea.css">
  <link rel="stylesheet" href="forumstyle/forum-home-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Modal -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Modal -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="../index/search.js"></script>

  

 </head>
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
            <li><a href="../chat/php/logout.php?logout_id=<?php echo $row['unique_id'];?>" class="logout">Logout</a></li>
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
  

  <div class="add-thread">
      <button class="btn btn-outline-primary" data-toggle="modal" data-target="#add-thread-modal">Add New Thread</button>
    </div>
  <div class="forum-list">
    <!-- <div class="top-bar">
      <h1>
        Accompany Forum
      </h1>
      <a href="add-thread.php"><button>Add thread</button></a>
    </div> -->

    <div class="main">
      <ol class = "forum-list">
      </ol>
    </div>
  </div>


  <!-- Add Thread Modal -->
  <div class="modal" tabindex="-1" role="dialog" id="add-thread-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Add New Thread</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="" method="post" name="new-thread-form">
              <p>Thread Title:</p>
              <input type="text" size="50" name="new-thread-title" id="new-thread-title" required>
              <p>Thread Body:</p>
              <textarea class="form-control" rows="5"  name="new-thread-body" id="new-thread-body" required></textarea>
            <div class="modal-footer">
              <input type="button" class="btn btn-primary" id="add-new-thread-btn" data-dismiss="modal" value="Confirm">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
	      </div>
	      
	    </div>
	  </div>
	</div>


<script src = "javascript/forum-home.js"></script>
</html>





