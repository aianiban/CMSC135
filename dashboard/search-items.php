<?php
    include_once "../config.php";

    $searchTerm = $_POST['searchTerm'];
    $sql_users = mysqli_query($conn, "SELECT * FROM users WHERE fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%'");
    $sql_forum = mysqli_query($conn, "SELECT * FROM forum_posts WHERE title LIKE '%{$searchTerm}%'");
    $output = '';
    if($searchTerm != "") {
        if(mysqli_num_rows($sql_users) > 0) {
            $output .= '<div class="people"><p>People</p>';
            while($row = mysqli_fetch_assoc($sql_users)) {
                $output .= '<div class="search-item"><a href="../profile/users-profile.php?user_id=' . $row['unique_id'] . '"><img src="../img/' . $row['img'] . '" width="50px" height="50px"><p><b>' . $row['fname'] . " " . $row['lname'] . '</b></p></a></div>';
            }
            $output .= '</div>';
        }
    
        if(mysqli_num_rows($sql_forum) > 0) {
            $output .= '<div class="forum-search"><p>Forum Threads</p>';
            while($row2 = mysqli_fetch_assoc($sql_forum)) {
                $date_posted = explode(" ", $row2['date_posted']);
                $date_update = explode(" ", $row2['date_update']);
                $output .= '<div class="search-item"><a href="../forum/thread.php?post_id=' . $row2['post_id'] . '"><p><b>' . $row2['title'] . '</b><p class="forum-details">Posted on: ' . $date_posted[0] . '  |  Last Updated: ' . $date_posted[0]. '</p></p></div>';
            }
            $output .= '</div>';
        }
    } else {
        
    }
    
    // echo '<div class="people"><p>' . $searchTerm . '</p><div class="search-item"><img src="../img/sample.jpg" width="50px" height="50px"><p>Agent Dude</p></div><div class="search-item"><img src="../img/sample.jpg" width="50px" height="50px"><p>Agent Dude</p></div></div><div class="forum-search"><p>Forum Threads</p><div class="search-item"><p><b>Sample Thread title</b></p></div></div>';
    echo $output;








?>