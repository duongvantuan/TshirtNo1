<?php
    include ('check_upload.php');
    
    if(isset($_POST['add-banner'])){
        if(check_upload('upload')){
            $ext = substr(strrchr($_FILES['upload']['name'], '.'), 1);
            $nameImg = "banner_" . time() . "." . $ext;
            $dst = "../images_banners/" . $nameImg;
            
            // Chèn vào CSDL
            $chuthich = $_POST['chuthich'];
            $duongdan = substr($dst, 3); // cắt bỏ dấu ../
            $thutu = $_POST['stt'];
                    
            mysql_query("SET NAMES UFT8");
            $query = "INSERT INTO tbl_banner(ChuThich, DuongDan, SoThuTu)
                        VALUES('{$chuthich}', '{$duongdan}', {$thutu});";                
            $result = mysql_query($query) or die ('Lỗi đăng banner' . mysql_error());
            
            if($result){
                header('location:admin.php?page=other_features&q=success&s=2');
                   
                move_uploaded_file($_FILES['upload']['tmp_name'], $dst);
            }else{
                header('location:admin.php?page=other_features&q=error&e=3');
            }
        }
    }
?>
<form id="add-banner-form" action="admin.php?page=other_features&q=add_banner" method="POST"  enctype="multipart/form-data">
    <p class="title">đăng banner mới</p>
    <table border='1'>
        <tr>
            <th>Hình ảnh</th>
            <td><input type="file" name="upload" /></td>
        </tr>
        <tr>
            <th>Số thứ tự hiển thị</th>
            <td>
                <input type="text" name="stt" onkeyup="check_exist(this.value)" />
                <p id="message"></p>
            </td>
        </tr>
        <tr>
            <th>Chú thích</th>
            <td><textarea cols="30" rows="10" name="chuthich" id="chuthich" ></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="right" >
                <input type="submit" name="add-banner" class="button_big submit-btn" value="Thêm banner" />
                <input type="reset" class="button_big" value="Nhập lại" />
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
$(function()
  {
      $('#chuthich').wysiwyg();
  });
  
  
   $(document).ready(function(){
        $('#message').html("").hide();
        $("#add-banner-form").validate({
            rules: {upload:{required: true}
                   ,stt:{required: true, digits: true}},  
            messages:{upload:{required: "Bạn chưa upload ảnh."}
                     ,stt:{required: "Vui lòng điền số thứ tự", digits: "Bạn phải điền số"}}
        });									
    });
    
    function check_exist(str_index){
            $.ajax({
            type: "POST",
            url: "check_banner.php",
            data: "b_index=" + str_index,
            success: function(data){
                $('#message').html("");
                $('#message').show();
                $('#message').append(data);
            }                         
        });
    };      
</script>