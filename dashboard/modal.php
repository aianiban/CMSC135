<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accompany</title>

  <!-- Modal -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../stylea.css">
</head>
<body>

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