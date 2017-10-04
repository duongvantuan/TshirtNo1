<?php
    $b_id = $_GET['b_id'];
    
    $query = "SELECT DuongDan FROM tbl_banner WHERE MaBanner = {$b_id};"; // lấy đường dẫn ảnh để xóa
    $result = mysql_query($query);    
    $row = mysql_fetch_array($result);
    
    unlink("../{$row['DuongDan']}"); // xóa ảnh
    
    $query = "DELETE FROM tbl_banner WHERE MaBanner = {$b_id};";
    $result = mysql_query($query);
    
    if($result){
        header('location:admin.php?page=other_features&q=view_banners');
    }
    else{
        header('location:admin.php?page=other_features&q=error&e=4');
    }