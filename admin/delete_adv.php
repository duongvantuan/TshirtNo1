<?php
    $a_id = $_GET['a_id'];
    
    $query = "SELECT DuongDanAnh FROM tbl_quangcao WHERE MaQC = {$a_id};"; // lấy đường dẫn ảnh để xóa
    $result = mysql_query($query);    
    $row = mysql_fetch_array($result);
    
    unlink("../{$row['DuongDanAnh']}"); // xóa ảnh
    
    $query = "DELETE FROM tbl_quangcao WHERE MaQC = {$a_id};";
    $result = mysql_query($query);
    
    if($result){
        header('location:admin.php?page=other_features&q=view_advs');
    }else{
        header("location:admin.php?page=other_features&q=error&e=2");
    }