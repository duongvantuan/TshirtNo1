<div id="center_col" class="center_col">
    <div id="frame" class="center_block">
        <h4>Đăng ký</h4>
        <div class="center_block_content">            
            <form id="registerForm" action="index.php?page=register" method="POST" onload="">
                <?php
                    
                    if(isset($_POST["submit_register"])){
                        $confirm_code=md5(uniqid(rand())); 
                        $us=$_POST["username"];
                        $ps = sha1($_POST["password"]);	
                        $nm = $_POST["fullname"];
                        $gt = $_POST["gender"];
                        $em = $_POST["email"];
                        $dt = $_POST["telephone"];
                        $dc = $_POST["address"];
                        $date = $_POST["date"];
                        $month = $_POST["month"];
                        $year= $_POST["year"];
                        $birthday = $year."-".$month."-".$date;

                        $sql = "SELECT COUNT(*) FROM tbl_thanhvien WHERE UserName='$us'";
                        $result = mysql_query($sql);
                        $row=  mysql_fetch_array($result);
                        
                        mysql_query("SET NAMES utf8;");
                        $sql2="INSERT INTO tbl_thanhvien_temp(confirm_code,UserName,MatKhau,HoTen,Email,Gioitinh,SoDienThoai,DiaChi,NgaySinh,NgayDangKi)
                              VALUES('$confirm_code','$us','$ps','$nm','$em','$gt','$dt','$dc','$birthday',NOW())";
                        $result4 = mysql_query($sql2) or die("Có lỗi xảy ra trong quá trình đăng ký </form> </div><!-- end center block content-->
                        </div><!-- end frame -->
                        </div><!-- end center columm -->");
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
                        $mail->AddAddress($em, "Friend");


                        //Thiết lập email nhận email hồi đáp
                        //nếu người nhận nhấn nút Reply
                        $mail->AddReplyTo("vietdung299@gmail.com","Viet Dung");

                        /*=====================================
                        * THIET LAP NOI DUNG EMAIL
                        *=====================================*/

                        //Thiết lập tiêu đề
                        $mail->Subject    = "Xác nhận đăng ký từ Website Computer Parts Store";

                        //Thiết lập định dạng font chữ
                        $mail->CharSet = "UTF-8";

                        //Thiết lập nội dung chính của email
                        
                        $body = "Click vào link để hoàn tất đăng ký http://localhost/Computer_Parts_Store/index.php?page=confirmation&passkey=$confirm_code"; 
                        $mail->Body = $body;
                        
                        if(!$mail->Send()){
                            echo "Mailer Error: " . $mail->ErrorInfo;
                        }
                        else{
                            header('location:index.php?page=success&q=1');   
                        }
                }
                 
                ?>
                <table width="500">
                      <tr>
                          <td><img src="<?php echo BASE_URL; ?>/images/Register_icon.png" alt="Đăng ký thành viên" width="90px" height="90px" /></p></td>
                          <td valign="middle"><p id="frame_header">ĐĂNG KÝ LÀM THÀNH VIÊN</p></td>                          
                      </tr>
                      <tr>
                        <td colspan="2">Các trường có dấu <font color="red">*</font> là các trường bắt buộc phải điền.</td>
                      </tr>
                        <td><font color="red">*</font>Tên đăng nhập:</td>
                        <td>
                            <input type="text" id="username" name="username" class="text_big" onkeyup="check_user(this.value)" />
                            <p id="message" class="error"></p>
                        </td>
                      </tr>                      
                      </tr>
                        <td><font color="red">*</font>Mật khẩu:</td>
                        <td><input type="password" id="password" name="password" class="text_big" /></td>
                      </tr>
                      <tr>
                          <td><font color="red">*</font>Nhập lại MK:</td>
                          <td><input type="password" id="confirm_password" name="confirm_password" class="text_big" /></td>
                      </tr>
                      <tr>
                          <td><font color="red">*</font>Họ tên:</td>
                          <td><input type="text" id="fullname" class="text_big" name="fullname"  /></td>
                      </tr>
                      <tr>
                          <td>Giới tính:</td>
                          <td>
                              <label><input type="radio" name="gender" value="1" checked="True" />Nam</label>
                              <label><input type="radio" name="gender" value="0" />Nữ</label>
                          </td>
                      </tr>
                    <tr>
                        <td>Ngày sinh:</td>
                        <td>
                            <script type="text/javascript">

                                    date();
                                    function date()
                                    {
                                        document.write("<span>Ngày</span><select name='date'>");
                                        for (var i = 1; i <= 31; i++)
                                        {
                                            document.write("<option>" + i + "</option>");
                                        }
                                        document.write("</select>");

                                        document.write("<span>Tháng</span><select name='month'>");
                                        for (var i = 1; i <= 12; i++)
                                        {
                                            document.write("<option>" + i + "</option>");
                                        }
                                        document.write("</select>");

                                        document.write("<span>Năm</span><select name='year'>");
                                        for (var i = 1960; i <= 2012; i++)
                                        {
                                            document.write("<option>" + i + "</option>");
                                        }
                                        document.write("</select>");
                                    }
                            </script>                            
                        </td>
                    </tr>   
                    <tr>
                        <td><font color="red">*</font>Email:</td>
                        <td>
                            <input type="text" id="email" name="email" class="text_big" onkeyup="check_email(this.value, 1)" />
                            <p id="message_email" class="error"></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td>
                            <input type="text" class="text_big" name="telephone" onkeyup="check_phone(this.value)" />
                            <p id="message_phone" class="error"></p>
                        </td>
                    </tr>                    
                    <tr valign="top">
                        <td>Địa chỉ :</td>
                        <td><textarea name="address" class="txt"></textarea></td>
                    </tr>
                    <?php
                        include_once('include/captcha.php');
                        ?>                      
                    <tr align="center">
                        <td colspan="2">
                            <input type="submit" name="submit_register" value="Đăng ký" class="button_big" id="submit" />
                            <input type="reset" value="Nhập lại" class="button_big"/>
                        </td>
                    </tr>   
                    <script type="text/javascript">
                
                        $(document).ready(function(){
                            $('#message').hide();
                            $("#registerForm").validate({
                                rules: {username:{required: true, minlength: 5}
                                       ,password:{required: true, minlength: 6}
                                       ,confirm_password:{required: true, equalTo:"#password"}
                                       ,telephone:{digits: true, minlength: 10, maxlength: 11}
                                       ,email:{required: true, email: true}
                                       ,fullname:{required: true, minlength: 5}},
                                messages:{username:{required: "Vui lòng điền tên đăng nhập của bạn.", minlength: "Tên đăng nhập cần có tối thiểu 5 kí tự."}
                                         ,password:{required: "Vui lòng điền mật khẩu.", minlength: "Mật khẩu cần có tối thiểu 6 kí tự."}
                                         ,confirm_password:{required: "Vui lòng điền mật khẩu xác nhận.", equalTo: "Mật khẩu xác nhận không đúng."}
                                         ,telephone:{digits: "Bạn phải điền số", minlength: "Tối thiểu 10 số", maxlength: "Tối thiểu 11 số"}
                                         ,email:{required:"Vui lòng điền Email của bạn.", email:"Địa chỉ email không chính xác."},
                                         fullname:{required: "Vui lòng điền tên của bạn", minlength:"Họ tên phải tối thiểu 5 kí tự."}}
                            });									
                        });
                        
                        // check số điện thoại
                        function check_phone(str_phone){
                            if(str_phone != ''){
                                if(/^[0][1-9][0-9]{8,9}$/.test(str_phone)){
                                    $('#message_phone').hide();
    
                                }else{
                                    $('#message_phone').html("Số điện thoại không hợp lệ");
                                    $('#message_phone').show();
                                }
                            }                            
                        };
                                                    
                        // Sử dụng jQuery AJAX                        
                        function check_user(str_user){
                                
                               $.ajax({
                               type: "POST",
                               url: "include/checkuser.php",
                               data: "username=" + str_user,
                               success: function(data){
                                    $('#message').html("");
                                    $('#message').show();
                                    $('#message').append(data);
                               }                         
                            });
                        };
                        
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
                  </table>           
            </form>
             
        </div><!-- end center block content-->
    </div><!-- end frame -->
</div><!-- end center columm -->