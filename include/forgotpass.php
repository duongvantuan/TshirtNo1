<div id="center_col" class="center_col">
    <div id="frame" class="center_block">
        <h4>Quên mật khẩu</h4>
        <div class="center_block_content">
            <p id="frame_header">Điền chính xác địa chỉ Email để chúng tôi gửi lại mật khẩu cho bạn</p>
            <form action="index.php?page=forgotpass" method="POST" id="forgotpassForm">
                <table>
                    <tr>
                        <td rowspan="3"><img src="<?php echo BASE_URL; ?>/images/error-icon.png" alt="Đăng nhập"/></td>
                    </tr>
                    <tr>
                        <td>Nhập địa chỉ Email<br />
                            <input type="text" name="email" class="text_big" onkeyup="check_email(this.value, 0)" />
                            <p id="message_email" class="error"></p>
                        </td>
                    </tr>
                    <?php 
                         if(isset($_POST["submit_forgotpass"])){
                             $new_pass = uniqid(rand(0, 100));
                             $email_fg = $_POST["email"];
                             
                             $sql = "UPDATE tbl_thanhvien SET MatKhau = '". sha1($new_pass) . "' WHERE Email='$email_fg'";
                             $result = mysql_query($sql);
                             $mail = new PHPMailer();

                        /*=====================================
                        * THIET LAP THONG TIN GUI MAIL
                        *=====================================*/

                        $mail->IsSMTP(); // Gọi đến class xử lý SMTP
                        $mail->Host       = "localhost"; // tên SMTP server
                        $mail->SMTPDebug  = 2;                    // enables SMTP debug information (for testing)
                                                                // 1 = errors and messages
                                                                // 2 = messages only
                        $mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
                        $mail->SMTPSecure = "ssl";
                        $mail->Host       = "smtp.gmail.com";     // Thiết lập thông tin của SMPT
                        $mail->Port       = 465;                     // Thiết lập cổng gửi email của máy
                        $mail->Username   = "vietdung299@gmail.com"; // SMTP account username
                        $mail->Password   = "vietdung";            // SMTP account password

                        //Thiet lap thong tin nguoi gui va email nguoi gui
                        $mail->SetFrom('vietdung299@gmail.com','Computer Parts Store');

                        //Thiết lập thông tin người nhận
                        $mail->AddAddress($email_fg, "Friend");


                        //Thiết lập email nhận email hồi đáp
                        //nếu người nhận nhấn nút Reply
                        $mail->AddReplyTo("vietdung299@gmail.com","Computer Parts Store");

                        /*=====================================
                        * THIET LAP NOI DUNG EMAIL
                        *=====================================*/

                        //Thiết lập tiêu đề
                        $mail->Subject    = "Lấy lại mật khẩu từ Website Computer Parts Store";

                        //Thiết lập định dạng font chữ
                        $mail->CharSet = "utf-8";

                        //Thiết lập nội dung chính của email
                        
                        $body = "Mật khẩu mới của bạn là $new_pass. Hãy đăng nhập bằng mật khẩu mới để đổi mật khẩu."; 
                        $mail->Body = $body;
                        
                        if(!$mail->Send()) {
                            echo "Mailer Error: " . $mail->ErrorInfo;
                        }
                        else{
                            header ('location:index.php?page=success&q=2');
                        }         
                    }
                ?>
                    <tr>
                        <td colspan="2" align='center'><input type="submit" name="submit_forgotpass" value="Xác nhận" class="button_big" id="submit" /></td>
                    </tr>
                </table>
            </form>
        </div><!-- end center block content -->
    </div><!-- end center block -->
</div><!-- end center column -->
<script type="text/javascript">
                        $(document).ready(function(){
                            $('#message').hide();
                            $("#forgotpassForm").validate({
                                rules: {email:{required: true, email: true}},
                                messages:{email:{required:"Vui lòng điền Email của bạn.", email:"Địa chỉ email không chính xác."}}
                            });									
                        });
                                                    
                        // Sử dụng jQuery AJAX
                        // check email
                        function check_email(str_email, d){
                               
                               if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(str_email)){
                                
                                   $.ajax({
                                       type: "POST",
                                       url: "include/checkuser.php",
                                       data: "email=" + str_email + "&d=" + d,
                                       success: function(data){
                                            $('#message_email').html("");
                                            $('#message_email').show();
                                            $('#message_email').append(data);
                                        }                         
                                   });
                                }
                                else{
                                    $('#message_email').hide();
                                }
                        };                        
                    </script>