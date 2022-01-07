<?php
    include_once "../../config.php";
    
    while($row = mysqli_fetch_assoc($sql)){
        $output .= '
        <li class = "row">
            <a href="thread.php?post_id=' . $row['post_id'] . '">
                <h4 class = "title">' . $row['title'] . '</h4>
                <div class="bottom">
                    <p class = "timestamp">' . $row['date'] . '</p>
                    <p class = "comment-count">' . $row['comment_count'] . '</p>
                </div>
            </a>
        </li>        
        ';
    }

?>