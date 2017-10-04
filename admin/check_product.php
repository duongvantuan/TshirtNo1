<?php
    include ('../include/dbconnect.php');
    
    $p_name = $_POST['p_name'];
    
    mysql_query("SET NAMES UTF8");
    $query = "SELECT * FROM tbl_sanpham WHERE TenSP = '{$p_name}';";
    $result = mysql_query($query) or die ('<font color="red"><b>Lỗi truy xuất cơ sở dữ liệu</b></font>');    
    $row =  mysql_fetch_array($result);
    
    if($row[0] > 0){
        echo '<font color="#FF0000"><b>Sản phẩm này đã tồn tại</b></font>';
    }else{
        echo '<font color="#006600"><b>Có thể sử dụng tên sản phẩm này</b></font>';
    }