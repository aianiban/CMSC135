<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: ../login.php");
    }
?>

<?php
    include_once "../config.php";
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
    }
    $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$_SESSION['unique_id']}");
    $items = "";
    while($row2 = mysqli_fetch_assoc($sql2)) {
      $items .= '
          <div class="user-item">
            <img src="../img/'. $row2['img'].'" alt="Admin" class="rounded" width="250" height="250">
            <div class="name"><p>' . $row2['fname'] . ' ' . $row2['lname'] . '</p></div>
						<button type="button" class="btn btn-outline-light">View Profile</button>
            <button type="button" class="btn btn-outline-light">Message</button>
          </div>';
    }
              $request_count = 0;
              $sql3 = mysqli_query($conn, "SELECT * FROM companion_request WHERE user_two = {$_SESSION['unique_id']}");
              if(mysqli_num_rows($sql3) > 0) {
                $request_count = mysqli_num_rows($sql3);
              }
?>
<?php
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="../javascript/users.js"></script>

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
              <li><a href="#">Companion List</a></li>
              <li><a href="#" class="requests-btn" data-toggle="modal" data-target="#request-modal">Requests(<?php echo $request_count;?>)</a></li>
              <li><a href="../chat/php/logout.php?logout_id=<?php echo $row['unique_id'];?>" class="logout">Logout</a></li>
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
    </nav>
  </div>

  <div class="body-content">
    <div class="welcome">Welcome to Accompany <?php echo $row['fname'];?>!</div>  
      <div class="about"><p>Accompany is a social media platform for BS Computer Science students and alumni of University of the Philippines Baguio. 
        It is an online community whose main goal is to help struggling students in their computer science courses through connecting them to people who can give a helping hand. 
        Users can find, add, and converse with other people whether you're a freshman looking for a quick peer to peer tutorial, or a senior who wants to provide a more relatable perspective on computer science concepts. 
        In this platform, users are called “companions”. Find your companion today!</p>
    </div>   

        <div class="userlist">
          <div class="header-text">Find a companion now!</div>
          <?php echo $items;?>
        </div>
  </div>
</body>
</html>





