<?php
    require_once 'dbconnect.php';
    
    if(isset($_POST['rate']) && isset($_POST['p_id'])){
        
        $_SESSION['rated'] = 1;
         
        $rate = $_POST['rate'];
        $p_id   = $_POST['p_id'];
         
        // lấy rate hiện tại
        $query1 = "SELECT Rating, LuotDanhGia FROM tbl_sanpham WHERE MaSP = {$p_id};";
        $result1 = mysql_query($query1);
        $row  = mysql_fetch_array($result1);
        $cur_rate = $row['Rating'];
        $cur_count = $row['LuotDanhGia'];
        
        if($cur_rate != 0){
            $cur_rate = ($rate + $cur_rate) / 2;
        }
        else{
            $cur_rate = $rate;    
        }         
        
        $cur_count++;        
        // cập nhật rate mới
        $query = "UPDATE tbl_sanpham SET Rating = {$cur_rate}, LuotDanhGia={$cur_count} WHERE MaSP = {$p_id};";
        mysql_query($query);
        echo "{$cur_rate} ({$cur_count} lượt đánh giá)<br />";
    }