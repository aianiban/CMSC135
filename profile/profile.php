<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: ../login.php");
    }
    
    include_once "../config.php";
	
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
    }
    $fname = $row['fname'];
	$lname = $row['lname'];
    $email = $row['email'];
	$phone = $row['phone'];
	$city = $row['city'];
    $img = $row['img'];
	$bio = $row['bio'];
	$position = $row['position'];
	$web = $row['fname'];
	$git = $row['fname'];
	$twt = $row['fname'];
	$ig = $row['fname'];
	$fb = $row['fname'];
	$unique_id = $row['unique_id'];

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
  <link rel="stylesheet" href="profile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
              <li><a href="#" class="requests-btn" data-toggle="modal" data-target="#request-modal">Requests(<?php echo $request_count;?>)</a></li><li><a href="../chat/php/logout.php?logout_id=<?php echo $row['unique_id'];?>" class="logout">Logout</a></li>
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
								<img src="../img/<?php echo $img;?>" alt="Admin" class="rounded" width="200" height="200">
								<div class="mt-3">
									<h4><?php echo $fname.' '.$lname;?></h4>
									<p class="text-secondary mb-1"><?php echo $position;?></p>
									<p class="text-muted font-size-sm"><em><?php echo $bio;?></em></p>
									<button class="btn btn-outline-success">Change Photo</button>
									<button type="button" class="btn btn-outline-success px-4" data-toggle="modal" data-target="#update_profile">Edit Profile</button>
								</div>
							</div>
							<hr class="my-4">
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
									<span class="text-secondary">www.<?php echo $web;?>.com</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
									<span class="text-secondary"><?php echo $git;?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-success"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
									<span class="text-secondary">@<?php echo $twt;?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-success"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
									<span class="text-secondary">@<?php echo $ig;?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-success"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
									<span class="text-secondary"><?php echo $fb;?></span>
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
									<input type="text" class="form-control" value="<?php echo $fname.' '.$lname;?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" id="email" value="<?php echo $email;?>"   >
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Contact</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" id="contact" value="<?php echo $phone;?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-3">
									<h6 class="mb-0">Address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									<input type="text" class="form-control" id="address" value="<?php echo $city;?>">
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
										<div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>Website Markup</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-success" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>One Page</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>Mobile Template</p>
									<div class="progress mb-3" style="height: 5px">
										<div class="progress-bar bg-success" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p>Backend API</p>
									<div class="progress" style="height: 5px">
										<div class="progress-bar bg-success" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Edit Profile Modal -->
<div class="modal" tabindex="-1" role="dialog" id="update_profile">
  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Profile</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

						<!--1-->
						<div class="row">
							<div class="col-md-3">
								<label>First Name</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="fname_modal" id="fname_modal" class="form-control-sm" required>
							</div>	
						</div>
						<!--1.2-->
						<div class="row">
							<div class="col-md-3">
								<label>Last Name</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="lname_modal" id="lname_modal" class="form-control-sm" required>
							</div>	
						</div>
						<!--2-->
						<div class="row">
							<div class="col-md-3">
								<label>Email</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="email_modal" id="email_modal" class="form-control-sm" required>
							</div>	
						</div>
						<!--3-->
						<div class="row">
							<div class="col-md-3">
								<label>Contact</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="phone_modal" id="phone_modal" class="form-control-sm" required>
							</div>	
						</div>
						<!--4-->
						<div class="row">
							<div class="col-md-3">
								<label>City</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="city_modal" id="city_modal" class="form-control-sm" required>
							</div>	
						</div>
						<!--4-->
						<div class="row">
							<div class="col-md-3">
								<label>Position</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="position_modal" id="position_modal" class="form-control-sm" required>
							</div>	
						</div>
						<!--4-->
						<div class="row">
							<div class="col-md-3">
								<label>Bio</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="bio_modal" id="bio_modal" class="form-control-sm" required>
							</div>	
						</div>
						<input type="hidden" name="id_modal" id="id_modal" class="form-control-sm" value="<?php echo $unique_id;?>">
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="update_data" data-dismiss="modal">Save Changes</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
    	</div>
  </div>
</div>
			
<script>
$(document).ready(function() {
	$(function () {
		/*$('#update_profile').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			console.log("It works!");
			//console.log(data);*/
			//alert("Successful!");  //Button that triggered the modal
			$.ajax({
				url: "../buttons/view.php",
				type: "POST",
				cache: false,
				success: function(dataResult){
					var data = JSON.parse(dataResult);
					$('#fname_modal').val(data.fname);
					$('#lname_modal').val(data.lname);
					$('#email_modal').val(data.email);
					$('#phone_modal').val(data.phone);
					$('#city_modal').val(data.city);
					$('#position_modal').val(data.position);
					$('#bio_modal').val(data.bio);
				}
			});
    }); 
	$(document).on("click", "#update_data", function() { 
		$.ajax({
			url: "../buttons/edit.php",
			type: "POST",
			cache: false,
			data:{
				id: $('#id_modal').val(),
				fname: $('#fname_modal').val(),
				lname: $('#lname_modal').val(),
				email: $('#email_modal').val(),
				phone: $('#phone_modal').val(),
				city: $('#city_modal').val(),
				position: $('#position_modal').val(),
				bio: $('#bio_modal').val(),
			},
			success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					$('#update_profile').modal().hide();
					alert('Data updated successfully !');
					location.reload();
				}
			}
		});
	});
});
</script>

</body>
</html>