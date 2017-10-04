<?php
    $ad_id = $_GET["ad_id"];
    
    $sql = "DELETE FROM tbl_admin WHERE MaAdmin = '$ad_id'";
    
    $result = mysql_query($sql);
    if($result){
        header('location:admin.php?page=accounts&q=view_admins');
    }
    else{
        header('location:admin.php?page=accounts&q=error&e=13');
    }
?>

