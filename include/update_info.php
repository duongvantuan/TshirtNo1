<?php
    session_start();
    require 'dbconnect.php';
    
    $name_nw = $_POST["fullname"];

    
    $address_nw = $_POST["address"];
    $telephone_nw = $_POST["telephone"];
    $pass_nw = sha1($_POST["new_pass"]);
    $gender_nw = $_POST["gender"];
    $email_nw = $_POST["email"];
    $date = $_POST["date"];
    $month = $_POST["month"];
    $year= $_POST["year"];
    $birthday = $year."-".$month."-".$date;    
   if($_POST["new_pass"]== ""){
       
   
         mysql_query("SET NAMES utf8;");

         $sql4 = "UPDATE tbl_thanhvien
                     SET HoTen = '$name_nw',
                        NgaySinh = '$birthday',
                        DiaChi = '$address_nw',
                        SoDienThoai = '$telephone_nw',
                        GioiTinh = '$gender_nw',
                        Email = '$email_nw'
                  WHERE UserName = '{$_SESSION["user_login"]}'";
         }
         else{
             mysql_query("SET NAMES utf8;");
             $sql4 = "UPDATE tbl_thanhvien
                        SET HoTen = '$name_nw',
                              NgaySinh = '$birthday',
                            DiaChi = '$address_nw',
                                SoDienThoai = '$telephone_nw',
                                GioiTinh = '$gender_nw',
                                Email = '$email_nw',
                                MatKhau = '$pass_nw'
                     WHERE UserName = '{$_SESSION["user_login"]}'";
         }
         
         $result4 = mysql_query($sql4) or die("Có lỗi xảy ra trong quá trình sửa thông tin.");
        // echo $result4;
         if($result4)
         {
              header('location:index.php?page=success&q=4');
         }
         else{
             echo 'lỗi';
         }
    ?>