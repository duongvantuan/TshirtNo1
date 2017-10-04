<form method="POST" id="add-admin-form">
<table border='1'>
    <p class="title">thêm quản trị viên</p>
    <tr>
        <th>Tên đăng nhập</th>
        <td>
            <input type="text" name="user_admin" size="40" onkeyup="check_user(this.value)" />
            <p id="message"></p>
        </td>
        
    </tr>
    <tr>
        <th>Mật khẩu</th>
        <td><input type="password" name="pass_admin" size="40" /></td>
    </tr>
    <tr>
        <th>Họ tên</th>
        <td><input type="text" name="fullname" size="40" /></td>    
    </tr>
    <tr>
        <th>Điện thoại</th>
        <td>
            <input type="text" name="telephone" size="40" onkeyup="check_phone(this.value)"/>
            <p id="message_phone"></p>
        </td>        
    </tr>
    <tr>
        <th>Email</th>
        <td>
            <input type="text" name="email" size="40" onkeyup="check_email(this.value)" />
            <p id="message_email"></p>
        </td>
    </tr>
    <tr>
        <th>Level</th>
        <td>
            <label><input type="radio" name="level" value="1" />1</label>
            <label><input type="radio" name="level" value="2" checked="True" />2</label>
        </td>
    </tr>
    <tr >
        <td colspan="2" align="center" >
            <input type="submit" name="add_admin" value="Thêm" class="button_big submit-btn invi_button" style="margin-left: 30px;" />
            <input type="reset" value="Nhập lại" class="button_big" />
        </td>
    </tr>
</table>
</form>
<?php 

   include_once '..\include\dbconnect.php';
   
    if(isset($_POST["add_admin"])){
        $sql = "SELECT COUNT(*) FROM tbl_admin"; 
        $result = mysql_query($sql);
        
        $us_a = $_POST["user_admin"];
        $ps_a = sha1($_POST["pass_admin"]);
        $nm_a = $_POST["fullname"];
        $tp_a = $_POST["telephone"];
        $em_a = $_POST["email"];
        $lv_a = $_POST["level"];
        
        $sql1 = "SELECT COUNT(*) FROM tbl_admin WHERE TenDangNhap='$us_a'";
        $result1 = mysql_query($sql1);
        $row1=  mysql_fetch_array($result1);
          mysql_query("SET NAMES utf8;");
        $sql2="INSERT INTO tbl_admin(TenDangNhap,MatKhau,HoTen,Email,DienThoai,NgayTao)
                VALUES('$us_a','$ps_a','$nm_a','$em_a','$tp_a',NOW())";
        
           
        $result2 = mysql_query($sql2) or die("Có lỗi xảy ra trong quá trình đăng ký ");
        if($result2){
            if($lv_a == 1)
        {
            $sql3 = "SELECT * FROM tbl_admin ORDER BY MaAdmin DESC LIMIT 0,1";
            $result3 = mysql_query($sql3);
            $data3 = mysql_fetch_array($result3);
           
            $sql_is1 = "INSERT INTO tbl_phanquyen(MaAdmin,MaQuyen) VALUES({$data3["MaAdmin"]},1)";
            $result_is1 = mysql_query($sql_is1);
            
            $sql_is2 = "INSERT INTO tbl_phanquyen(MaAdmin,MaQuyen) VALUES({$data3["MaAdmin"]},2)";
            $result_is2 = mysql_query($sql_is2);
            
            $sql_is3 = "INSERT INTO tbl_phanquyen(MaAdmin,MaQuyen) VALUES({$data3["MaAdmin"]},3)";
            $result_is3 = mysql_query($sql_is3);
            echo "Thêm quản trị viên thành công";
        }
        else{
            $sql4 = "SELECT * FROM tbl_admin ORDER BY MaAdmin DESC LIMIT 0,1";
            $result4 = mysql_query($sql4);
            $data4 = mysql_fetch_array($result4);
            
            $sql_is_4 = "INSERT INTO tbl_phanquyen(MaAdmin,MaQuyen) VALUES({$data4["MaAdmin"]},1)";
            $result_is_4 = mysql_query($sql_is_4);
            
            $sql_is_5 = "INSERT INTO tbl_phanquyen(MaAdmin,MaQuyen) VALUES({$data4["MaAdmin"]},2)";
            $result_is_5 = mysql_query($sql_is_5);
            echo "Thêm quản trị viên thành công";
           }
            
        }
        else{
            echo "Lỗi";
        }
    }
?>
<script>

        $(document).ready(function(){
            $('#message').hide();
            $("#add-admin-form").validate({
                rules: {user_admin:{required: true, minlength: 5}
                        ,pass_admin:{required: true, minlength: 6}
                        ,telephone:{digits: true, minlength: 10, maxlength: 11}
                        ,email:{required: true, email: true}
                        ,fullname:{required: true, minlength: 5}}
                        ,
                messages:{user_admin:{required: "Vui lòng điền tên đăng nhập", minlength: "Tên đăng nhập cần có tối thiểu 5 kí tự."}
                            ,pass_admin:{required: "Vui lòng điền mật khẩu.", minlength: "Mật khẩu cần có tối thiểu 6 kí tự."}
                            ,telephone:{digits: "Bạn phải điền số", minlength: "Tối thiểu 10 số", maxlength: "Tối thiểu 11 số"}
                            ,email:{required:"Vui lòng điền Email của bạn.", email:"Địa chỉ email không chính xác."},
                            fullname:{required: "Vui lòng điền tên của bạn", minlength:"Họ tên phải tối thiểu 5 kí tự."}
                            }
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
                url: "check_admin.php",
                data: "user_admin=" + str_user,
                success: function(data){
                    $('#message').html("");
                    $('#message').show();
                    $('#message').append(data);
                }                         
            });
        };

        // check email
        function check_email(str_email){

                if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(str_email)){

                    $.ajax({
                        type: "POST",
                        url: "check_admin.php",
                        data: "email=" + str_email,
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