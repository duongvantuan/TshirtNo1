<?php
    require_once('../include/dbconnect.php');
    
    $name_nw = $_POST["new_fullname"];
    $email_nw = $_POST["email"];
    $telephone_nw = $_POST["new_telephone"];
    $pass_nw = $_POST["pass_admin"];
    //$pass_nw = sha1($_POST["new_pass"]);
    
    if ($pass_nw == '')
    {
        mysql_query("SET names utf8");
  $sql="UPDATE  tbl_admin 
        SET HoTen='$name_nw',
            DienThoai='$telephone_nw',
            Email = '$email_nw'
        WHERE TenDangNhap='{$_SESSION["user_admin"]}'";
         $result = mysql_query($sql) or die("Có lỗi xảy ra trong quá trình sửa thông tin.");
        // echo $result4;
         if($result)
         {
              echo 'Sửa thông tin thành công';
         }
         else{
             echo 'lỗi';
         }
    }
    else
    {
        mysql_query("SET names utf8");
        $sql="UPDATE  tbl_admin 
        SET HoTen='$name_nw',
            Email = '$email_nw',
            DienThoai='$telephone_nw',
            MatKhau='$pass_nw'
        WHERE TenDangNhap='{$_SESSION["user_admin"]}'";
         $result = mysql_query($sql) or die("Có lỗi xảy ra trong quá trình sửa thông tin.");
        // echo $result4;
         if($result)
         {
              echo 'Sửa thông tin thành công';
         }
         else{
             echo 'lỗi';
         }
    }
    ?>