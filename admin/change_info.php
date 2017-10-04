<?php
    include 'delete_invi.php';
    $sql = "SELECT * FROM tbl_admin WHERE TenDangNhap='{$_SESSION["admin_login"]}';";
    $result = mysql_query($sql);
    $data = mysql_fetch_array($result);
?>
<form method="POST" id="add-admin-form" action="admin.php?page=update_info_admin">
<table border='1' align="center">
    <p class="title">Chỉnh sửa thông tin</p>
    
    <tr>
        <th>Mật khẩu mới </th>
        <td><input type="password" name="pass_admin" size="40" /></td>
    </tr>
    <tr>
        <th>Họ tên</th>
        <td><input type="text" name="new_fullname" size="40" value="<?php echo $data["HoTen"]; ?>"/></td>    
    </tr>
    <tr>
        <th>Điện thoại</th>
        <td>
            <input type="text" name="new_telephone" size="40" onkeyup="check_phone(this.value)" value="<?php echo $data["DienThoai"]; ?>"/>
            <p id="message_phone" class="error"></p>
        </td>        
    </tr>
    <tr>
        <th>Email</th>
        <td>
            <input type="text" name="email" size="40" onkeyup="check_email(this.value, 1)" value="<?php echo $data["Email"]; ?>" />
            <p id="message_email" class="error"></p>
        </td>
    </tr>
       <tr >
        <td colspan="2" align="center" >
            <input type="submit" name="edit_admin" value="Cập nhật " class="button_big submit-btn" style="margin-left:30px;" />
            <input type="reset" value="Nhập lại" class="button_big" />
        </td>
    </tr>
</table>
</form>
<script>
  
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
    
     function check_email(str_email, d){
                               
                               if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(str_email)){
                                
                                   $.ajax({
                                       type: "POST",
                                       url: "checkuser.php",
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