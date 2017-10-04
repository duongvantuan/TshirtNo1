<div id="center_col" class="center_col">
    <div id="frame" class="center_block">
        <h4>Liên hệ</h4>
        <div class="center_block_content">
            <p id="frame_header">TSHIRT ONLINE STORE</p>
            <p class="paragraph">
                <span>We always appreciate feedback from you!</span> <br/>
                If have any questions or suggestions about the quality as well as service of product, Please spend some time suggestions for us.
                We share to respond in the shortest time.</p>
            <p class="paragraph">
                <span>Phone: </span>0962016614
                <br/>
                <span>E-mail: </span><a href="mailto:tshirtno1@gmail.com">tshirtno1@gmail.com</a>
            </p>
            <?php
                
                if(isset($_POST['submit_contact'])){
                    $title = $_POST['title'];
                    $fullname = $_POST['fullname'];
                    $tel = $_POST['telephone'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $feedback = $_POST['feedback'];
                    
                    mysql_query('SET NAMES utf8');
                    
                    $query = "INSERT INTO tbl_gopy(TieuDe, HoTen, DienThoai, Email, DiaChi, NoiDung, NgayGopY) VALUES ('$title','$fullname','$tel','$email','$address', '$feedback',NOW());";
                    mysql_query($query);
                    
                    header('location:index.php?page=success&q=3');                    
                }
            ?>
            
            <form id="contactForm" action="" method="POST">
            	  <table width="500">
                    <tr>
                        <td colspan="2">The fields marked with <font color="red">*</font> are required fields.</td>
                    </tr>                  
            	    <tr>
                        <td><font color="red">*</font>Title :</td>
                        <td><input type="text" class="text_big" name="title" /></td>
                    </tr>	
            	    <tr>
                        <td><font color="red">*</font>Full name :</td>
                        <td><input type="text" class="text_big" name="fullname" /></td>
                    </tr>	
            	   
                    <tr>
                        <td>Phone:</td>
                        <td>
                            <input type="text" class="text_big" name="telephone" onkeyup="check_phone(this.value)" />
                            <p id="message_phone" class="error"></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><font color="red">*</font>Email :</td>
                        <td><input type="text" class="text_big" name="email" /></td>
                    </tr>
                    
                    <tr valign="top">
                        <td>Address :</td>
                        <td><textarea name="address" class="txt"></textarea></td>
                    </tr>
                    
                    <tr valign="top">
                        <td><font color="red">*</font>Message :</td>
                        <td>
                            <textarea name="feedback" id="feedback" class="txt" ></textarea>
                            <p id="message" class="error"></p>
                        </td>
                    </tr>
                    <?php
                        include_once('include/captcha.php');
                        ?>                    
                    <tr align="center">
                   	  <td colspan="2">
                              <input type="submit" value="Send" class="button_big" id="submit" name="submit_contact" />
                              <input type="reset" value="Reset" class="button_big"/>
                          </td>
                    </tr>
                  </table>
            </form>
            
            <script type="text/javascript">
            
                $(document).ready(function(){
                    
                    $('#message').hide();
                    
                    // đếm số ký tự trong #feedback
                    $('#feedback').keyup(function(){
                       var len = this.value.length;
                                              
                       $('#message').fadeIn(100);
                       $('#message').html("Your message there: " + len + " characters remaining: " + (800 - len) + " the characters.");
                         return len;                        
                    });
                    

                    
                    $("#contactForm").validate({
                        rules: {title:{required: true, minlength: 10}
                               ,telephone: {digits: true}
                               ,email:{required: true, email: true}
                               ,fullname:{required: true, minlength: 5}
                               ,feedback:{required: true, minlength: 10, maxlength:800}},
                        messages:{title:{required: "Please enter title.", minlength: "Your headline is too short, a minimum of 10 characters"}
                                 ,telephone: {digits: "You must enter the number."}
                                 ,email:{required:"Please fill in your Email.", email:"Incorrect email address."}
                                 ,fullname:{required: "Please fill in your name", minlength:"They must name a minimum of 5 characters."}
                                 ,feedback:{required: "You have written a message", minlength: "The content is too short, a minimum of 10 characters.", maxlength:"The content is too long, maximum 800 characters"}}
                    });	                    
                });
                
                // check số điện thoại
                function check_phone(str_phone){
                    
                    if(str_phone != ''){
                        if(/^[0][1-9][0-9]{8,9}$/.test(str_phone)){
                            $('#message_phone').hide();

                        }else{
                            $('#message_phone').html("The phone number is invalid");
                            $('#message_phone').show();
                        }
                    }
                };
            </script>         
        </div><!-- end center block content -->
    </div><!-- end contact block -->
</div><!-- end ceter_col -->