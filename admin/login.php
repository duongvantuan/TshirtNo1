<?php
    ob_start();
    session_start();
   require_once('../include/dbconnect.php');
   if(isset($_SESSION['admin_login'])){
       header("location:admin.php");
   }
?>
    

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Đăng nhập vào trang điều khiển</title>
        <?php 
            include_once ('css_js_admin.php');
        ?>
    </head>
    <body>
        <div id="wrapper-login">
            <form action="" method="POST" id="login-admin-form" name="loginadminform">
                <table>                        
                        <tr align="center">
                            <td colspan="2"><span>ĐĂNG NHẬP</span></td>
                        </tr>      
                        <tr>
                            <td rowspan="3"><img src="../images/login_icon.png" alt="Đăng nhập"  /></td>
                        </tr>
                        <tr>
                            <td>
                                Tên đăng nhập: <input name="admin_login" id="admin_login" type="text" class="login_register" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mật khẩu: <input name="password_admin" id="password_admin" type="password" class="login_register" />
                                <?php 
                                    if(isset($_POST["submit_login"])){
                                        
                                        $us_a = $_POST["admin_login"];
                                        $ps = sha1($_POST["password_admin"]);

                                        $sql = "SELECT COUNT(*) FROM tbl_admin WHERE TenDangNhap='{$us_a}' AND MatKhau='{$ps}'";
                                            $result1 = mysql_query($sql);
                                        $row = mysql_fetch_array($result1);

                                        if($row[0] == 1){
                                                $_SESSION["admin_login"] = true;
                                                $_SESSION["admin_login"] = $us_a;
                                                header("location:admin.php") ;

                                                $log_query = "UPDATE tbl_admin SET NgayLoginGanNhat = NOW() WHERE TenDangNhap='{$us_a}'";
                                                mysql_query($log_query) or die ("Lỗi ghi vào log");
                                        }
                                        else{   
                                                echo '<p class="error">Bạn đăng nhập sai.</p>';
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td align="center" style="padding-left:45px;">
                                    <input type="submit" value="Đăng nhập" name="submit_login" src="images/login-button.png" class="button_big" />
                            </td>
                        </tr>
                </table>
                <a href='../index.php' title="Quay lại trang chủ">Quay lại trang chủ</a>
            </form>            
        </div>
    </body>
</html>

<script>
    document.loginadminform.admin_login.focus();
    $(document).ready(function() {
    $("#login-admin-form").validate({
                rules: {admin_login:{required: true},
                        password_admin:{required: true}
                        },
                messages: { admin_login:{required: "<br />Bạn chưa điền username."},
                            password_admin:{required: "<br />Bạn chưa điền password."}
                            }
                });			
		});	
</script>