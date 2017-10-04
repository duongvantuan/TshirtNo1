<?php
    $m_id = $_GET['m_id'];
       
    $query = "DELETE FROM tbl_hinhanh WHERE MaSP IN (SELECT MaSP FROM tbl_sanpham WHERE MaNhaSX = {$m_id});";
    $result = mysql_query($query) or die(mysql_error());
    
    $query = "DELETE FROM tbl_sanpham WHERE MaNhaSX = {$m_id}";
    $result = mysql_query($query) or die ('Error 1');
    
    $query = "DELETE FROM tbl_nhasx WHERE MaNhaSX = {$m_id}";
    $result = mysql_query($query) or die ('Error 2');
    
   if($result){
        header('location:admin.php?page=products&q=success&s=5');
    }else{
        header("location:admin.php?page=products&q=error&e=11");
    }
    
