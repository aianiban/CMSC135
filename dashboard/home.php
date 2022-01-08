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
        <a href="../profie/profile.php?user_id=' . $row2['unique_id'] .'">
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
  <style>
    .userlist {
      position: relative;
      top: 10px;
      width: 100%;
      height: 50px;
      /* justify-content: center; */
    }

    .user-item{
      background: linear-gradient(90deg, rgba(35,182,118,1) 0%, rgba(32,178,170,1) 100%);
      width: 25%;
      margin: auto;
      color: white;
      border-radius: 5px;
      border: 1px solid black;
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

</body>
</html>