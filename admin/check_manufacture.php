<?php
    include '../include/dbconnect.php';
    
    if(isset($_POST['m_name']) && ($_POST['m_name'] != '')){
        $m_name = $_POST['m_name'];
        $query = "SELECT * FROM tbl_nhasx WHERE TenNhaSX = '{$m_name}';";
        $result = mysql_query($query) or die ('<font color="red"><b>Lỗi truy xuất cơ sở dữ liệu</b></font>');    
        $row =  mysql_fetch_array($result);
        
        if($row[0] > 0){
            echo '<font color="#FF0000"><b>Tên nhà sản xuất này đã tồn tại</b></font>';
        }else{
            echo '<font color="#006600"><b>Có thể sử dụng tên nhà sản xuất này</b></font>';
        }
        
    }