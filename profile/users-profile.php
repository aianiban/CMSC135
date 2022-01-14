<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: ../login.php");
    }
    
    include_once "../config.php";
	
	$profile_user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$profile_user_id}");
    if(mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
    }
    $name = $row['fname'] . " " . $row['lname'];
    $email = $row['email'];
    $img = $row['img'];
	echo "<script>console.log('user=" . $_SESSION['unique_id'] . ", profile_user_id=" . $profile_user_id . "')</script>";
	$_SESSION['relationship'] = "";

	$request_count = 0;
	$sql3 = mysqli_query($conn, "SELECT * FROM companion_request WHERE user_two = {$_SESSION['unique_id']}");
	if(mysqli_num_rows($sql3) > 0) {
	  $request_count = mysqli_num_rows($sql3);
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
  <link rel="stylesheet" href="profile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <!-- Modal -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Modal -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
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
          <li>
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
    </nav>
  </div>


  <div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="../img/<?php echo $img;?>" alt="Admin" class="rounded-circle p-1 bg-primary" width="150" height="150">                                
								<div class="mt-3">
									<h4><?php echo $name;?></h4>
									<p class="text-secondary mb-1">Full Stack Developer</p>
									<p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
									<form id="add" method="post">
										<?php
											//Add Companion Button
											$b1 = 'style="display: none"';
											$b2 = 'style="display: none"';
											$b3 = 'style="display: inline-block"';
											$b4 = 'style="display: none"';
											$b5 = 'style="display: none"';

											//Check if user has any companions
											$sql2 = mysqli_query($conn, "SELECT * FROM companion WHERE user = {$_SESSION['unique_id']}");
											if(mysqli_num_rows($sql2) > 0) {
												//Check if user is alerady a companion
												$sql3 = mysqli_query($conn, "SELECT * FROM companion WHERE user = {$_SESSION['unique_id']} AND user_companion = {$profile_user_id}");
												if(mysqli_num_rows($sql3) > 0) {
													echo "<script>console.log('has companions, users are companions');</script>";
													//Users are companions
													$b1 = 'style="display: inline-block"'; 
													$b2 = 'style="display: inline-block"'; 
													$b3 = 'style="display: none"'; 
													$b4 = 'style="display: none"';
													$b5 = 'style="display: none"';
												} 
												//Check if user is requesting to be a companion
												$sql4 = mysqli_query($conn, "SELECT * FROM companion_request WHERE user_one = {$_SESSION['unique_id']} AND user_two = {$profile_user_id}");
												if(mysqli_num_rows($sql4) > 0) {
													//Requesting to be companions (Cancel Request)
													echo "<script>console.log('has companions, requesting to be a companion (Cancel Request)');</script>";
													$b1 = 'style="display: none"'; 
													$b2 = 'style="display: none"';
													$b3 = 'style="display: none"'; 
													$b4 = 'style="display: inline-block"'; 
													$b5 = 'style="display: none"';
												}											
												//Check if user is being requested to be a companion
												$sql5 = mysqli_query($conn, "SELECT * FROM companion_request WHERE user_one = {$profile_user_id} AND user_two = {$_SESSION['unique_id']}");
												if(mysqli_num_rows($sql5) > 0) {
													//Confirm Request
													echo "<script>console.log('has companions, user is being requested to be a companion (Confirm)');</script>";
													$b1 = 'style="display: none"'; 
													$b2 = 'style="display: none"';
													$b3 = 'style="display: none"'; 
													$b4 = 'style="display: none"'; 
													$b5 = 'style="display: inline-block"';
												}																																				
																																	
											} else {
												//Check if user is requesting to be a companion
												$sql6 = mysqli_query($conn, "SELECT * FROM companion_request WHERE user_one = {$_SESSION['unique_id']} AND user_two = {$profile_user_id}");
												if(mysqli_num_rows($sql6) > 0) {
													//Requesting to be companions (Cancel Request)
													echo "<script>console.log('no companions, requesting to be a companion (Cancel Request)');</script>";
													$b1 = 'style="display: none"'; 
													$b2 = 'style="display: none"';
													$b3 = 'style="display: none"'; 
													$b4 = 'style="display: inline-block"'; 
													$b5 = 'style="display: none"';
												}
												//Check if user is being requested to be a companion
												$sql7 = mysqli_query($conn, "SELECT * FROM companion_request WHERE user_one = {$profile_user_id} AND user_two = {$_SESSION['unique_id']}");
												if(mysqli_num_rows($sql7) > 0) {
													//Confirm Request
													echo "<script>console.log('no companion, user is being requested to be a companion (Confirm)');</script>";
													$b1 = 'style="display: none"'; 
													$b2 = 'style="display: none"';
													$b3 = 'style="display: none"'; 
													$b4 = 'style="display: none"'; 
													$b5 = 'style="display: inline-block"';
												}
											}
										?>
										<input type="text" name="unique_id" id="unique_id" value="<?php echo $_SESSION['unique_id']?>" hidden>										
										<input type="text" name="add_user" id="add_user" value="<?php echo $profile_user_id?>" hidden>

										
									</form>
									<div class="relationship-buttons">
										<!--$b1--><a href="../chat/chat.php?user_id=<?php echo $profile_user_id;?>"><button class="btn btn-primary" id="message" <?php echo $b1;?>>Message</button></a>
										<!--$b2--><button class="btn btn-outline-primary" id="remove-companion" name="remove-companion" data-toggle="modal" data-target="#remove-companion-modal" <?php echo $b2;?>>Un-Companion</button>
										<!--$b3--><button class="btn btn-primary" id="add-companion" name="add-companion" <?php echo $b3;?>>Add Companion</button>
										<!--$b4--><button class="btn btn-outline-primary" id="remove-request" data-toggle="modal" data-target="#remove-request-modal" <?php echo $b4;?>>Cancel Request</button>
										<!--$b5--><button class="btn btn-outline-primary" id="confirm-request" <?php echo $b5;?>>Confirm Request</button>
									</div>
									
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
									<span class="text-secondary">https://bootdey.com</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
									<span class="text-secondary">bootdey</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
									<span class="text-secondary">@bootdey</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
									<span class="text-secondary">bootdey</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
									<span class="text-secondary">bootdey</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $name;?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="<?php echo $email;?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Phone</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="(239) 816-9029">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Mobile</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="(320) 380-4539">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" value="Bay Area, San Francisco, CA">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-secondary">
									<input type="button" class="btn btn-primary px-4" value="Save Changes">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<h5 class="d-flex align-items-center mb-3">Project Status</h5>
									<p>Web Design</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>Website Markup</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-danger" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>One Page</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>Mobile Template</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>Backend API</p>
									<div class="progress" style="height: 5px">
										<div class="progress-bar bg-info" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



<!-- Remove Request Confirmation Modal -->
	<div class="modal" tabindex="-1" role="dialog" id="remove-request-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Remove Companion Request</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Are you sure you want to cancel your Companion Request to <?php echo $name;?>?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="remove-request-confirm" data-dismiss="modal">Confirm</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

<!-- Remove Companion Confirmation Modal -->
	<div class="modal" tabindex="-1" role="dialog" id="remove-companion-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Remove Companion</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Are you sure you want to remove <?php echo $name;?> as your Companion?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="remove-companion-confirm" data-dismiss="modal">Confirm</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>	
</body>
<script src="companion-methods.js"></script>
</html>