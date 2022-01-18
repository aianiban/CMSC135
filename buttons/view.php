<?php
	include '../config.php';
	$sql = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
?>	
		<tr>
			<td><?=$row['fname'];?></td>
			<td><?=$row['email'];?></td>
			<td><?=$row['position'];?></td>
			<td><?=$row['bio'];?></td>
			<td><button type="button" class="btn btn-success btn-sm update" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#update_profile"
			data-id="<?=$row['fname'];?>"
			data-name="<?=$row['lname'];?>"
			data-email="<?=$row['email'];?>"
			data-phone="<?=$row['bio'];?>"
			data-city="<?=$row['position'];?>"
			">Edit</button></td>
		</tr>
<?php	
	}
	}
	else {
		echo "<tr >
		<td colspan='5'>No Result found !</td>
		</tr>";
	}
	mysqli_close($conn);
?>