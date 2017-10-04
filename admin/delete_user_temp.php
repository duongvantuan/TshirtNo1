<?php
    $usm = $_GET["usm"];
    $sql = "DELETE FROM tbl_thanhvien_temp WHERE UserName = '$usm'";
    $result = mysql_query($sql);
    if($result){
        header('location:admin.php?page=accounts&q=view_members');
    }
    else{
        header('location:admin.php?page=accounts&q=error&e=12');        
    }
?>