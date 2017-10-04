<?php
    $f_id = $_GET['f_id'];
    
    $query = "DELETE FROM tbl_gopy WHERE MaGopY = {$f_id};";
    $result = mysql_query($query);
    
    if($result){
        header('location:admin.php?page=other_features&q=view_feedbacks');
    }
    else{
        header('location:admin.php?page=other_features&q=error&e=7');
    }