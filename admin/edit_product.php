<?php
    $p_id = $_GET['p_id'];
    $query = "SELECT * FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP AND B.SoThuTu = 0 WHERE A.MaSP = {$p_id};";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    
    $ten = $row['TenSP'];
    $mota = $row['MoTa'];
    $dvitinh = $row['DonViTinh'];
    $gia = $row['Gia'];
    $giacu = $row['GiaCu'];
    $baohanh = $row['BaoHanh'];
    $spmoi = $row['SPMoi'];
    $km = $row['KhuyenMai'];
    $loai = $row['MaLoai']; 
    $nhasx = $row['MaNhaSX'];
    $mausac = $row['MauSac'];
    $anhchinh_cu = $row['DuongDan'];    
?>
<form id="edit-product-form" action="update_product.php" method="POST"  enctype="multipart/form-data">
    <p class="title">sửa thông tin sản phẩm</p>
    <input type="hidden" name="p_id" value="<?php echo $p_id;?>" />
    <table border='1'>
        <tr>
            <th>Tên sản phẩm: </th>
            <td><input type="text" value="<?echo $ten; ?>" size="70" name="tensp" onkeyup="check_exist(this.value)" />
            <p id="message"></p>
            </td>
        </tr>
        <tr>
            <th>Giá </th>
            <td><input type="text" value="<?echo $gia/1000; ?>" size="20" name="gia" /> .000 VND</td>
        </tr>
        <tr>
            <th>Giá cũ </th>
            <td><input type="text" value="<?echo $giacu/1000; ?>" size="20" name="giacu" id="giacu"/> .000 VND</td>            
        </tr>        
        <tr>
            <th>Đơn vị tính </th>
            <td><input type="text" value="<?php echo $dvitinh; ?>" size="10" name="donvitinh" /></td>
        </tr>
        <tr>
            <th>Bảo hành (tháng) </th>
            <td><input type="text" value="<?php echo $baohanh; ?>" size="10" name="baohanh" /></td>
        </tr>
        <tr>
            <th>                
                <label><input type="checkbox" name="spmoi" <?php echo ($spmoi == 1) ? "checked='checked'" : "";?> /> Sản phẩm mới</label>
            </th>
            <th>
                <label><input type="checkbox" id="spkm" name="spkm" <?php echo ($km == 1) ? "checked='checked'" : "";?> /> Sản phẩm đang khuyến mại</label>
            </th>
        </tr>
        <tr>
            <th>Màu sắc</th>
            <td><input type="text" value="<?php echo $mausac; ?>" name="mausac" /></td>
        </tr>
        <tr>
            <th>Loại sản phẩm</th>
            <td>
                <select name="loaisp">
                <?php 
                    $sql = "SELECT * FROM tbl_loaisp WHERE MaLoai <> MaCha;";
                    $res = mysql_query($sql) or die("Lỗi truy xuất cơ sở dữ liệu");
                    while($rows = mysql_fetch_array($res)){
                        if($rows['MaLoai'] == $loai){
                            echo "<option selected='selected' value='{$rows['MaLoai']}'>{$rows['TenLoai']}</option>";
                        }
                        else{
                            echo "<option value='{$rows['MaLoai']}'>{$rows['TenLoai']}</option>";
                        }                        
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Nhà sản xuất</th>
            <td>
                <select name="nhasx">
                <?php
                    $sql = "SELECT * FROM tbl_nhasx;";
                    $res = mysql_query($sql) or die("Lỗi truy xuất cơ sở dữ liệu");
                    while($rows = mysql_fetch_array($res)){
                        if($rows['MaNhaSX'] == $nhasx){
                            echo "<option selected='selected' value='{$rows['MaNhaSX']}'>{$rows['TenNhaSX']}</option>";
                        }
                        else{
                            echo "<option value='{$rows['MaNhaSX']}'>{$rows['TenNhaSX']}</option>";
                        }                        
                    }                
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Mô tả sản phẩm</th>
            <td><textarea cols="40" rows="10" name="mota" id="mota" ><?php echo $mota; ?></textarea></td>
        </tr>
        <tr>
            <th>Hình ảnh chính của sản phẩm</th>
            <td>
                <input type="hidden" name="anhchinh_cu" value="<?php echo $row['DuongDan']; ?>" />
                <img src="../<?php echo $anhchinh_cu; ?>" alt="<?php echo $ten; ?>" /><br /><br />
                Đường dẫn: <p class="path"><?php echo $row['DuongDan']; ?></p>
                <input type="file" name="uploadanhchinh" />
            </td>
        </tr>
        <tr>
            <th>Hình ảnh khác của sản phẩm</th>
            <td>
                <?php 
                    $sql = "SELECT * FROM tbl_hinhanh WHERE SoThuTu > 0 AND MaSP = {$p_id};";
                    $res = mysql_query($sql) or die  ("Lỗi truy xuất cơ sở dữ liệu");
                    $i = 0;
                    while($rows = mysql_fetch_array($res)){
                        $i++;
                        echo "<input type='hidden' name='anhphu_cu{$i}' value='{$rows['DuongDan']}' />                            
                            <img src='../{$rows['DuongDan']}' alt='{$ten}' /><br />                            
                            Đường dẫn: <p class='path'>{$rows['DuongDan']}</p>";
                        echo "<input type='file' name='uploadanhphu{$i}' /><br /><br />";

                    }
                    
                    if(mysql_num_rows($res) == 0)
                        echo "<input type='file' name='uploadanhphu1' />
                                <label><input type='checkbox' id='uploadmore' />Thêm ảnh nữa<br /></label>
                                <input type='file' name='uploadanhphu2' id='upload2' />";
                    if(mysql_num_rows($res) == 1)
                        echo "<label><input type='checkbox' id='uploadmore' />Thêm ảnh nữa<br /></label>
                                <input type='file' name='uploadanhphu2' id='upload2' />";                                            
                                                                            
                ?>                
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="button_big submit-btn" value="Cập nhật" name="product_submit" />
                <input type="reset" class="button_big" value="Nhập lại" />
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
$(function()
  {
      $('#mota').wysiwyg();
  });
    $(document).ready(function(){
        $('#message').html("").hide();
        $('#upload2').hide();

        $("#edit-product-form").validate({
            rules: {tensp:{required: true}
                   ,gia:{required: true, digits: true}
                   ,giacu:{required: true, digits: true}
                   ,donvitinh:{required: true}
                   ,baohanh:{required: true, digits: true}},  
            messages:{tensp:{required: "Vui lòng điền tên sản phẩm"}
                     ,gia:{required: "Vui lòng điền giá sản phẩm", digits: "Bạn phải nhập số"}
                     ,giacu:{required: "Vui lòng điền giá cũ của sản phẩm", digits: "Bạn phải nhập số"}
                     ,donvitinh:{required: "Vui lòng điền đơn vị tính"}
                     ,baohanh:{required: "Vui lòng điền thời gian bảo hành", digits: "Bạn phải nhập số"}}
        });									

        var spkm = $('#spkm');
        var giacu = $('#giacu');
        
        if(spkm.is(':checked')){
            
        }else{
           giacu.attr('disabled', 'disabled');
        }
        
        spkm.click(function(){
            if(spkm.is(':checked')){
                giacu.removeAttr('disabled');
            }else{
               giacu.attr('disabled', 'disabled');
            }                        
        });
        
        $('#uploadmore').click(function(){
            if($(this).is(':checked')){
                $('#upload2').show(400);
            }else{
                $('#upload2').hide(400);
            } 
        });        
    });
    
    // kiểm tra sự tồn tại của tên sản phẩm
    function check_exist(str_product){

            $.ajax({
            type: "POST",
            url: "check_product.php",
            data: "p_name=" + str_product,
            success: function(data){
                $('#message').html("");
                $('#message').show();
                $('#message').append(data);
            }                         
        });
    };  
</script>