<?php
    $b_id = $_GET['b_id'];
    $query = "SELECT * FROM tbl_banner WHERE MaBanner={$b_id}";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);    
?>
<form id="edit-banner-form">
    <p class="title">sửa banner số <?php echo $row['MaBanner']; ?></p>
    <table border='1'>
        <tr>
            <td>Hình ảnh</td>
            <td>
                <img src="../<?php echo $row['DuongDan']; ?>" style="width: 200px;" alt="<?php echo $rows['MaBanner']; ?>" /><br /><br />
                <input type="file" name="upload" />
            </td>
        </tr>
        <tr>
            <td>Số thứ tự hiển thị</td>
            <td><input type="text" name="stt" value="<?php echo $row['SoThuTu']; ?>" /></td>
        </tr>
        <tr>
            <td>Chú thích</td>
            <td><textarea cols="30" rows="10" name="chuthich" id="chuthich" ><?php echo $row['ChuThich']; ?></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="right" ><input type="submit" name="banner-submit" class="button_big submit-btn" value="Sửa banner" />
                <input type="reset" name="banner-submit" class="button_big" value="Nhập lại" />
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
                            $("#edit-banner-form").validate({
                                rules: {stt:{required: true, digits: true}},  
                                messages:{stt:{required: "Vui lòng điền số thứ tự", digits: "Bạn phải điền số"}}
                            });									
                        });
</script>