<?php
    include_once "../../config.php";
    
    while($row = mysqli_fetch_assoc($sql)){
        if ($row['comment_count'] == 1) {$comment = $row['comment_count'] . " comment";}
        else{$comment = $row['comment_count'] . " comments";}
        $sql2 = mysqli_query($conn, "SELECT fname, lname FROM users WHERE unique_id={$row['post_userid']}");
        $row2 = mysqli_fetch_assoc($sql2);
        $name = $row2['fname'] . " " . $row2['lname'];
        $cut = explode(" ", $row['date_update']);
        $date = $cut[0];
        
        $output .= '
        <li class = "row">
            <a href="thread.php?post_id=' . $row['post_id'] . '">
                <h4 class = "title">' . $row['title'] . '</h4>
                <div class="bottom">
                    <p class = "timestamp">Posted by: ' . $name . ' on ' . $date . '</p>
                    <p class = "comment-count">' . $comment . '</p>
                </div>
            </a>
        </li>        
        ';
    }

?>