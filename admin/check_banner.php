<?php
    include_once '../include/dbconnect.php';
    
    $query = "SELECT SoThuTu FROM tbl_banner ORDER BY (SoThuTu) DESC LIMIT 0, 1;";
    $result = mysql_query($query)  or die ('<font color="red"><b>Lỗi truy xuất cơ sở dữ liệu</b></font>' . mysql_error());
    $row = mysql_fetch_array($result);    
    $cur_index = $row[0];
    
    if(isset($_POST['b_index']) && $_POST['b_index'] != ''){   
    
        $b_index = $_POST['b_index'];
        $query = "SELECT SoThuTu FROM tbl_banner WHERE SoThuTu = {$b_index}";
        $result = mysql_query($query)  or die ('<font color="red"><b>Bạn phải điền số</b></font>');
        $row = mysql_fetch_array($result);
        
        if($row[0] > 0){
            echo '<font color="#FF0000"><b>Số thứ tự này đã được dùng cho banner khác.<br />Bạn cần dùng STT > ' . $cur_index . '</b></font>';
        }else{
            echo '<font color="#006600"><b>Có thể dùng số thứ tự này</b></font>';
        }
    }    