<?php
    $matv = $_GET["m_id"];
    
    $sql = "DELETE FROM tbl_thanhvien WHERE MaTV = '$matv'";
    
    $result = mysql_query($sql);
    if($result){
        header('location:admin.php?page=accounts&q=view_members');
    }
    else{
        header('location:admin.php?page=accounts&q=error&e=12');
    }
?>