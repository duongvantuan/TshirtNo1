<div id="center_col" class="center_col">
    <div id="frame" class="center_block">
        <h4>Lỗi đăng nhập</h4>
        <div class="center_block_content">
            <p id="frame_header">Lỗi đăng nhập</p>
            <p class="paragraph">Tên đăng nhập hoặc mật khẩu không đúng</p>
            <form id="loginForm" method="POST" action="index.php">
                <table>
                <tr>
                    <td rowspan="3"><img src="<?php echo BASE_URL; ?>/images/error-icon.png" alt="Lỗi đăng nhập"/></td>
                </tr>
                <tr>
                    <td>
                        Tên đăng nhập: <input name="user_login" id="username" type="text" class="login_register" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Mật khẩu: <input name="password_login" id="password_login" type="password" class="login_register" />
                          <?php 
                                if(isset($_POST["submit_login"])) {
                                    $us=$_POST["user_login"];
                                    $ps=sha1($_POST["password_login"]);

                                    $sql = "SELECT COUNT(*) FROM tbl_thanhvien WHERE UserName='$us' AND MatKhau='$ps'";
                                    $result = mysql_query($sql);
                                    $row = mysql_fetch_array($result);
                                 
                                    if($row[0]>0){
                                            
                                            $_SESSION["user_login"]=$us;
                                            header("location:index.php") ;
                                    }
                                    else
                                        {   
                                            
                                            header("location=index.php?page=login_error");
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="index.php?page=forgotpass" title="Bạn quên mật khẩu?">Quên mật khẩu?</a>
                            <br /><br />
                            <a href="index.php?page=register" title="Đăng ký làm thành viên">Đăng ký</a>
                        </td>
                            <td align="center" style="padding-left:45px;">
                                    <input type="submit" value="Đăng nhập" name="submit_login" src="<?php echo BASE_URL; ?>/images/login-button.png" class="button_big" />
                        </td>
                    </tr>
                </table>
            </form>		
        </div>
    </div>
</div>
<script type="text/javascript">
		$(document).ready(function() 
                {	
                $("#loginForm_er").validate({
                rules: {username:{required: true},
                        password:{required: true}
                        },
                messages: { username:{required: "<br />Bạn chưa điền username."},
                            password:{required: "<br />Bạn chưa điền password."}
                            }
                });			
		});	
	</script>