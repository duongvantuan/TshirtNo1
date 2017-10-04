<div id="center_col" class="center_col">
     
    <div id="info" class="center_block">
        <h4>Chỉnh sửa thông tin</h4>
        <div class="center_block_content">
            <p id="frame_header">Chỉnh sửa thông tin của bạn</p>
            <table>
                 <table width="500">
                <form action="index.php?page=update_info" method="POST" >
                        <?php
                            if(isset($_SESSION["user_login"])){ 
                                $sql = "SELECT * FROM tbl_thanhvien WHERE UserName='{$_SESSION["user_login"]}'";
                                $result = mysql_query($sql);
                                $rows = mysql_fetch_array($result); 
                                
                                //Lấy giá trị tháng của thành viên trong
                                $sql1 = "SELECT MONTH(NgaySinh) FROM tbl_thanhvien WHERE UserName = '{$_SESSION["user_login"]}'";
                                $result1 = mysql_query($sql1);
                                $data1 = mysql_fetch_array($result1);
                                
                                $sql2 = "SELECT Day(NgaySinh) FROM tbl_thanhvien WHERE UserName = '{$_SESSION["user_login"]}'";
                                $result2 = mysql_query($sql2);
                                $data2 = mysql_fetch_array($result2);
                                
                                $sql3 = "SELECT YEAR(NgaySinh) FROM tbl_thanhvien WHERE UserName = '{$_SESSION["user_login"]}'";
                                $result3 = mysql_query($sql3);
                                $data3 = mysql_fetch_array($result3);
                                
                            }
                         
                        ?>
                      <tr>
                        <td>Mật khẩu cũ:</td>
                        <td><input type="password" id="password" name="password" class="text_big" /></td>
                      </tr>
                      <tr>
                          <td>Mật khẩu mới:</td>
                          <td><input type="password" id="new_pass" name="new_pass" class="text_big" /></td>
                      </tr>
                      <tr>
                          <td>Nhập lại MK mới:</td>
                          <td><input type="password" id="new_pass" name="new_pass" class="text_big" /></td>
                      </tr>
                      <tr>
                          <td>Họ tên:</td>
                          <td><input type="text" id="fullname" class="text_big required" name="fullname"  value="<?php echo $rows["HoTen"];?>" /></td>
                      </tr>
                      <tr>
                          <td>Giới tính:</td>
                          <td >
                             <?php
                                if($rows["GioiTinh"] == 1){
                                    $nam = 'checked="true"';
                                    $nu = '';
                                }
                                else{
                                   $nu = 'checked="true"';
                                   $nam = '';
                                }
                             ?>
                              <label><input type="radio" name="gender" value="1" <?php echo $nam ?> />Nam</label>
                              <label><input type="radio" name="gender" value="0" <?php echo $nu ?> />Nữ</label>
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
                                            if (i==<?php echo $data2["0"]; ?>)
                                                    {
                                                            document.write("<option selected='selected'>" + i + "</option>");
                                                    }
                                            else
                                                    {
                                                            document.write("<option >" + i + "</option>");
                                                    }
                                                             document.write("</select>");
                                                                 
                                    document.write("<span>Tháng</span><select name='month'>");
                                    for (var i = 1; i <= 12; i++)
                                            if (i==<?php echo $data1["0"]; ?>)
                                            {
                                                    document.write("<option selected='selected'>" + i + "</option>");
                                            }
                                            else
                                            {
                                                    document.write("<option >" + i + "</option>");
                                            }
                                    document.write("</select>");
                                    
                                    document.write("<span>Năm</span><select name='year'>");
                                    for (var i = 1960; i <= 2012; i++)
                                    if (i==<?php echo $data3["0"]; ?>)
                                        {
                                                document.write("<option selected='selected'>" + i + "</option>");
                                        }
                                    else
                                        {
                                                document.write("<option >" + i + "</option>");
                                        }
                                    document.write("</select>");
                            }
                          
                      </script>  
                        </td>
                    </tr>   
                    <tr>
                        <td>Email:</td>
                        <td>
                            <input type="text" id="email" name="email" class="text_big" onkeyup="check_email(this.value, 1)"  value="<?php echo $rows["Email"];?>" />
                            <p id="message_email" class="error"></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td><input type="text" class="text_big" name="telephone"  value="<?php echo $rows["SoDienThoai"];?>" /></td>
                    </tr>                    
                    <tr valign="top">
                        <td>Địa chỉ :</td>
                        <td><textarea name="address" class="txt"><?php echo $rows["DiaChi"];?></textarea></td>
                    </tr>
                      <tr align="center">
                        <td colspan="2" align="center">                            
                            <input type="submit" name="submit_changeinfo" value="Chỉnh sửa" class="button_big" id="submit" />
                            <input type="reset" value="Hủy" class="button_big" />                            
                        </td>
                    </tr>   
                </form>
            </table>
        </div>
    </div>
</div>
<script>
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
