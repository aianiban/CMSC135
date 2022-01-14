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
    $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$_SESSION['unique_id']}");
    $items = "";
    while($row2 = mysqli_fetch_assoc($sql2)) {
      $items .= '
        <a href="../profile/users-profile.php?user_id=' . $row2['unique_id'] .'">
          <div class="user-item">
            <img src="" alt="" class="item-img">
            <p>' . $row2['fname'] . ' ' . $row2['lname'] . '</p>
          </div>
        </a>';
      
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Accompany</title>
  <link rel="stylesheet" href="../stylea.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Modal -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Modal -->
  <style>
    .userlist {
      position: relative;
      top: 10px;
      width: 100%;
      height: 50px;
      /* justify-content: center; */
    }

    .badge {
      position: relative;
      top: -10px;
      right: 20px;
      padding: 5px 5px;
      border-radius: 50%;
      background-color: red;
      color: white;

    }

    .user-item{
      background: linear-gradient(90deg, rgba(35,182,118,1) 0%, rgba(32,178,170,1) 100%);
      width: 25%;
      margin: auto;
      color: white;
      border-radius: 5px;
      border: 1px solid black;
    }

    .companion-request{
      overflow: auto;
      /* width: ; */
    }

    .request-img{
      display: inline;
      width: 50px;
      height: 50px;
      right: 0%;
      border-radius: 50%;
    }

    .img-name{
      float: left;
    }

    .confirm-decline{
      float: right;
    }

    .companion-request .img-name p,
    .companion-request .confirm-decline i{
      display: inline-block;
    }

    .modal-body ul{
      list-style-type: none;
    }

    .compaion-request .confirm-decline i{
      width: 50px;
      height: 50px;
    }

  </style>

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
          <li><a href="home.php">Home</a></li>
          <li>
            <a href="../profile/profile.php" class="desktop-link">Profile</a>
            <input type="checkbox" id="show-features">
            <label for="show-features">Profile</label>
            <ul class="dropdown">
              <li><a href="#">Drop Menu 1</a></li>
              <li><a href="#">Drop Menu 2</a></li>
              <li><a href="#">Drop Menu 3</a></li>
              <li><a href="#">Drop Menu 4</a></li>
            </ul>
          </li>
          <li><a href="../chat/users.php">Chat</a></li>
          <li>
            <a href="#" class="desktop-link">Forum</a>
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
          <li>
            <?php 
              $request_count = 0;
              $sql3 = mysqli_query($conn, "SELECT * FROM companion_request WHERE user_two = {$_SESSION['unique_id']}");
              if(mysqli_num_rows($sql3) > 0) {
                $request_count = mysqli_num_rows($sql3);
              }
            ?>
            <a href="#" class="desktop-link" class="requests-btn" data-toggle="modal" data-target="#request-modal">Requests(<?php echo $request_count;?>)</a>
            <input type="checkbox" id="show-features">
            <label for="show-services" class="requests-btn" data-toggle="modal" data-target="#request-modal">Requests(<?php echo $request_count;?>)</label>
          </li>
        </ul>
      </div>
      <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
      <form action="#" class="search-box">
        <input type="text" placeholder="Type Something to Search..." id="search-bar" required>
        <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
      </form>
      <!-- <div class="search-list" style="display:none">
        <div class="home-search-item">
          <p>hello</p>
        </div>
      </div> -->
    </nav>
  
  </div>
    
  <div class="dummy-text">
    <h2>Welcome to Accompany <?php echo $row['fname'];?>!</h2>
    <h2>Find a companion now</h2>
    <div class="userlist">
      <!-- <a href="">
        <div class="user-item">
          <img src="" alt="" class="item-img">
          <p>Sample User</p>
        </div>
      </a> -->
      <?php echo $items;?>
      
    </div>
  </div>



<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" id="request-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Companion Requests</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
          if(mysqli_num_rows($sql3) > 0) {
            while($row3 = mysqli_fetch_assoc($sql3)) {
              $sql4 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$row3['user_one']}");
              $user_requesting = mysqli_fetch_assoc($sql4);
              $name = $user_requesting['fname'] . " " . $user_requesting['lname'];
              $img = $user_requesting['img'];
              echo '<ul>
              <li>
                <div class="companion-request">
                  <div class="img-name">
                    <img src="../img/' . $img . '" class="request-img">
                    <a href="../profile/users-profile.php?user_id=' . $user_requesting['unique_id'] . '"><p>' . $name . '</p></a>
                  </div>
                  <div class="confirm-decline">                    
                    <i class="fas fa-check-circle"></i>
                  </div>
                  
                  
                </div>    
              </li>
            </ul>';
            }


          } else {
            echo 'No Companion Requests';
          }
        
        
        
        
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="remove-request-confirm" data-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>





