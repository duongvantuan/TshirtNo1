<?php
    include_once '../include/dbconnect.php';         
    
    if(isset($_POST['user_admin']) && !isset($_POST['email'])){
        
        $us_a = $_POST['user_admin']; //lấy tên để kiểm tra
        
        if(strlen($us_a) < 5){
            echo '';
        }
        else{
            // kiểm tra sự tồn tại của username trong database
            $sql= "SELECT COUNT(*) FROM tbl_admin WHERE TenDangNhap = '{$us_a}';";
            $result =  mysql_query($sql) or die ('<font color="red"><b>Lỗi truy xuất cơ sở dữ liệu</b></font>');    
            $row =  mysql_fetch_array($result);
            
            if($row[0] > 0){
                echo '<font color="#FF0000"><b>Tài khoản admin này đã tồn tại</b></font>';
            }
            else{
                echo '<font color="#006600"><b>Tài khoản này có thể sử dụng</b></font>';
            }
        }        
    }
    else{
        if(isset($_POST['email'])){ 
            
            $em_a = $_POST['email'];      
            // kiểm tra sự tồn tại của email trong database
            $sql = "SELECT COUNT(*) FROM tbl_admin WHERE Email = '{$em_a}';";            
            $result = mysql_query($sql) or die ('<font color="red"><b>Lỗi truy xuất cơ sở dữ liệu email</b></font>');
            $row = mysql_fetch_array($result);
            
            if($row[0] > 0){
                    echo '<font color="#FF0000"><b>Email này đã được đăng ký bởi tài khoản khác</b></font>';
            }
            else{
                    echo '<font color="#006600"><b>Bạn có thể sử dụng email này</b></font>';
            }            
        }
    }