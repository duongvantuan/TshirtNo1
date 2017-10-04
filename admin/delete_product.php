<?php
    $p_id = $_GET['p_id'];
    
    $query = "SELECT DuongDan FROM tbl_hinhanh WHERE MaSP = {$p_id}";
    $result = mysql_query($query);
    while($rows = mysql_fetch_array($result)){
        unlink("../{$row['DuongDan']}");// xóa ?nh
    }
    
    $query = "DELETE FROM tbl_hinhanh WHERE MaSP = {$p_id}";
    $result = mysql_query($query) or die ("L?i xóa ?nh s?n ph?m: " . mysql_error());
    
    $query = "DELETE FROM tbl_sanpham WHERE MaSP = {$p_id}";
    $result = mysql_query($query);
    
    if($result){
        header("location:admin.php?page=products&q=success&s=6");
    }else{
        header("location:admin.php?page=products&q=error&e=11");
    }