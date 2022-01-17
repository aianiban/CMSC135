<?php
	session_start();
	if(!isset($_SESSION['unique_id'])){
		header("location: ../login.php");
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" context="width-device-width", initial-scale=1.0>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Accompany</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
	<div class="wrapper">
		<section class="users">
			<header>
			<?php
				include_once "../config.php";
				$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
				if(mysqli_num_rows($sql) > 0){
					$row = mysqli_fetch_assoc($sql);

				}
			?>
				<div class="content">
					<img src="../img/<?php echo $row['img'];?>" alt="">
					<div class="details">
						<span><?php echo $row['fname'] . " " . $row['lname'];?></span>
						<p><?php echo $row['status'];?></p>	
					</div>
				</div>
				<a href="../dashboard/home.php" class="home">Home</a>
			</header>
			<div class="search">
				<span class="text">Select a user to start chat</span>
				<input type="text" placeholder="Enter name to search..." >
				<button><i class="fas fa-search"></i></button>
			</div>
			<div class="users-list">
				
			</div>
		</section>
	</div>

<script src="javascript/users.js"></script>

</body>
</html>
