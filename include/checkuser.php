<?php
    require_once 'dbconnect.php';            
    
    if(isset($_POST['username']) && !isset($_POST['email'])){
        
        $us = $_POST['username']; //lấy tên để kiểm tra
        
        if(strlen($us) < 5){
            echo '';
        }
        else{
            // kiểm tra sự tồn tại của username trong database
            $sql= "SELECT COUNT(*) FROM tbl_thanhvien WHERE UserName = '{$us}';";
            $result =  mysql_query($sql) or die ('<font color="red"><b>Lỗi truy xuất cơ sở dữ liệu</b></font>');    
            $row =  mysql_fetch_array($result);
            
            if($row[0] > 0){
                echo '<font color="#FF0000"><b>Tài khoản này đã tồn tại</b></font>';
            }
            else{
                echo '<font color="#006600"><b>Tài khoản này có thể sử dụng</b></font>';
            }
        }        
    }
    else{
        if(isset($_POST['email'])){ 
            
            $email = $_POST['email'];            
            // kiểm tra sự tồn tại của email trong database
            $sql = "SELECT COUNT(*) FROM tbl_thanhvien WHERE Email = '{$email}';";            
            $result = mysql_query($sql) or die ('<font color="red"><b>Lỗi truy xuất cơ sở dữ liệu email</b></font>');
            $row = mysql_fetch_array($result);
            
            if($row[0] > 0){
                if($_POST['d'] == 1){
                    echo '<font color="#FF0000"><b>Email này đã được đăng ký bởi tài khoản khác</b></font>';
                }
                else{
                    echo '<font color="#006600"><b>Bạn có thể sử dụng email này</b></font>';
                }
            }
            else{
                if($_POST['d'] == 1){
                    echo '<font color="#006600"><b>Bạn có thể sử dụng email này</b></font>';
                }
                else{
                    echo '<font color="#FF0000"><b>Email này chưa được đăng ký bởi tài khoản nào</b></font>';
                }
            }            
        }
    }