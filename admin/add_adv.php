<?php
    include_once('check_upload.php');
    
    if(isset($_POST['add_adv'])){
        if(check_upload('upload')){
        
            $ext = substr(strrchr($_FILES['upload']['name'], '.'), 1);
            $nameImg = "adv_" . time() . "." . $ext;
            // thư mục đích: images_adv
            $dst = "../images_adv/" . $nameImg;
            
            // Chèn vào CSDL
            $tenqc = $_POST['tenqc'];
            $duongdan = substr($dst, 3); // cắt bỏ dấu ../
            $thutu = $_POST['thutu'];
            $link = $_POST['link'];
            $vitri = ($_POST['vitri'] == 0) ? 0 : 1;
            
            mysql_query("SET NAMES UTF8");
            $query = "INSERT INTO tbl_quangcao(TenQC, DuongDanAnh, ThuTu, Link, ViTri)
                        VALUES('{$tenqc}', '{$duongdan}', {$thutu}, '{$link}', {$vitri});";                
            $result = mysql_query($query) or die ('Lỗi đăng quảng cáo' . mysql_error());
            
            if($result){
                header('location:admin.php?page=other_features&q=success&s=1');
                // chuyển ảnh vào thư mục images_adv    
                move_uploaded_file($_FILES['upload']['tmp_name'], $dst);                    
            }else{
                header('location:admin.php?page=other_features&q=error&e=1');
            }                
        }
    }
?>
<form action="admin.php?page=other_features&q=add_adv" method="POST" id="add-adv-form" enctype="multipart/form-data">
    <p class="title">đăng quảng cáo mới</p>
    <table border='1'>
        <tr>
            <th>Tên quảng cáo</th>
            <td><input type="text" size="50" name="tenqc" /></td>
        </tr>
        <tr>
            <th>Liên kết tới</th>
            <td><input type="text" size="50" name="link" /></td>
        </tr>
        <tr>
            <th>Ảnh hiển thị</th>
            <td>
                <span>Hỗ trợ các định dạng ảnh: PNG, JPEG/JPG, GIF.<br /> File có dung lượng &lt; 2MB</span><br />
                <input type="file" size="30" name="upload" id="upload" /></td>
        </tr>
        <tr>
            <th>Vị trí</th>
            <td>
                <input type="radio" name="vitri" value="0" checked="checked" />Phải
                <input type="radio" name="vitri" value="1" />Trái
            </td>
        </tr>
        <tr>
            <th>Thứ tự</th>
            <td><input type="text" size="20" name="thutu" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="button_big submit-btn" name="add_adv" value="Đăng" style="margin-left: 40px;" />
                <input type="reset" class="button_big" value="Nhập lại" />
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $("#add-adv-form").validate({
            rules: {tenqc:{required: true}
                   ,link:{required: true}
                   ,upload:{required: true}
                   ,thutu:{digits: true, required: true}},  
            messages:{tenqc:{required: "Vui lòng điền tên quảng cáo."}
                     ,link:{required: "Vui lòng điền liên kết quảng cáo"}
                     ,upload:{required: "Bạn chưa upload ảnh"}
                     ,thutu:{digits: "Bạn phải điền số", required: "Bạn chưa điền thứ tự hiển thị"}}
        });									
    });
</script>