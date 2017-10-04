<?php
    $a_id = $_GET['a_id'];
    $query = "SELECT * FROM tbl_quangcao WHERE MaQC={$a_id}";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);    
?>
<form id="edit-adv-form" method="POST" action="update_adv.php" enctype="multipart/form-data">
    <p class="title">sửa quảng cáo số <?php echo $row['MaQC']; ?></p>
    <input type="hidden" name="a_id" value="<?php echo $a_id; ?>" />
    <table border='1'>                
        <tr>
            <td>Tên quảng cáo</td>
            <td><input type="text" name="tenqc" value="<?php echo $row['TenQC']; ?>" size="40" /></td>
        </tr>
        <tr>
            <td>Hình ảnh</td>
            <td>
                <input type="hidden" name="anhcu" value="<?php echo $row['DuongDanAnh']; ?>" />
                <img src="../<?php echo $row['DuongDanAnh']; ?>" style="width: 200px;" alt="<?php echo $row['MaQC']; ?>" /><br /><br />
                 Đường dẫn: <p class="path"><?php echo $row['DuongDanAnh'];?></p>
                <input type="file" name="upload" />
            </td>
        </tr>
        <tr>
            <td>Liên kết</td>
            <td><input type="text" name="link" value="<?php echo $row['Link']?>" size="40" /></td>
        </tr>
        <tr>
            <td>Vị trí</td>
            <td>
            <?php                
                echo "<label><input type='radio' name='vitri' value='0' " . (($row['ViTri'] == 0) ? "checked='checked'" : "") . "/>Phải</label>";                
                echo "<label><input type='radio' name='vitri' value='1' " . (($row['ViTri'] == 1) ? "checked='checked'" : "") . "/>Trái</label>";                
            ?>
            </td>
        </tr>
        <tr>
            <td>Thứ tự</td>
            <td><input type="text" name="thutu" value="<?php echo $row['ThuTu']; ?>" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center" ><input type="submit" name="adv_submit" class="button_big submit-btn" value="Sửa quảng cáo" style="margin-left: 50px;" />
                <input type="reset" class="button_big" value="Nhập lại" />
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $("#edit-adv-form").validate({
            rules: {tenqc:{required: true}
                    ,link:{required: true}
                    ,thutu:{digits: true, required: true}},  
            messages:{tenqc:{required: "Vui lòng điền tên quảng cáo."}
                     ,link:{required: "Vui lòng điền liên kết quảng cáo"}
                     ,thutu:{digits: "Bạn phải điền số", required: "Bạn chưa điền thứ tự hiển thị"}}
                  });						 
        
         });
    
</script>