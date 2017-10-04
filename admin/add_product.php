<?php
    include('check_upload.php');
    
    if(isset($_POST['add_product'])){                
        if(check_upload('uploadanhchinh')){
            
            $query = "SELECT MaSP FROM tbl_sanpham ORDER BY MaSP DESC LIMIT 0, 1;";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result);
            $last_id = $row['MaSP'];// Mã sp cuối cùng
            $last_id++; // tăng mã sp lên 1
            
            // Chèn vào CSDL
            $tensp = $_POST['tensp'];
            $gia = $_POST['gia'];
            $giacu = (isset($_POST['giacu'])) ? $_POST['giacu'] : 0;
            $donvitinh = $_POST['donvitinh'];
            $baohanh = $_POST['baohanh'];
            $spmoi = (isset($_POST['spmoi'])) ? 1 : 0;
            $spkm = (isset($_POST['spkm'])) ? 1 : 0;
            $mausac = $_POST['mausac'];
            $loaisp = $_POST['loaisp'];
            $nhasx = $_POST['nhasx'];
            $mota = $_POST['mota'];
            $linksun = $_POST['linksun'];

            mysql_query("SET NAMES UTF8");
            $query = "INSERT INTO tbl_sanpham(MaSP, TenSP, MoTa, DonViTinh, Gia, GiaCu, BaoHanh, SPMoi, KhuyenMai, LuotDanhGia, Rating, MaLoai, MaNhaSX, MauSac, NgayThem, LinkSun)
                        VALUES({$last_id}, '{$tensp}', '{$mota}', '{$donvitinh}', {$gia}, {$giacu}, {$baohanh}, {$spmoi}, {$spkm}, 0, 0, {$loaisp}, {$nhasx}, '{$mausac}', NOW(),'{$linksun}');";                
            $result = mysql_query($query) or die ('Lỗi thêm sản phẩm' . mysql_error());            
            if($result){
                header('location:admin.php?page=products&q=success&s=6');    
                
            }else{
                header('location:admin.php?page=products&q=error&e=6');
            }
                        
            // ảnh chính                        
            $ext = substr(strrchr($_FILES['uploadanhchinh']['name'], '.'), 1);
            $nameImg = "p_{$last_id}." . $ext;
            $dst = "../images_products/" . $nameImg;
            $anhchinh = substr($dst, 3); // cắt bỏ dấu ../            
                                   
            // thêm ảnh chính vào csdl
            $query = "INSERT INTO tbl_hinhanh (MaSP, DuongDan, SoThuTu) 
                      VALUE ({$last_id}, '{$anhchinh}', 0);";
            $result = mysql_query($query) or die ('Lỗi thêm hình ảnh chính' .  mysql_error());
            move_uploaded_file($_FILES['uploadanhchinh']['tmp_name'], $dst);
            
            // ảnh phụ 1
            if(!empty($_FILES['uploadanhphu1']['name'])){
                if(check_upload('uploadanhphu1')){
                    $ext = substr(strrchr($_FILES['uploadanhphu1']['name'], '.'), 1);
                    $nameImg = "p_{$last_id}_1." . $ext;
                    $dst = "../images_products/" . $nameImg;
                    $anhphu = substr($dst, 3);
                    
                    $query = "INSERT INTO tbl_hinhanh (MaSP, DuongDan, SoThuTu)
                                            VALUE ({$last_id}, '{$anhphu}', 1);";
                    $result = mysql_query($query) or die ('Lỗi thêm hình ảnh phụ' .  mysql_error());
                    move_uploaded_file($_FILES['uploadanhphu1']['tmp_name'], $dst);                    
                }
            }
            // ảnh phụ 2
            if(!empty($_FILES['uploadanhphu2']['name'])){
                if(check_upload('uploadanhphu2')){
                    $ext = substr(strrchr($_FILES['uploadanhphu2']['name'], '.'), 1);
                    $nameImg = "p_{$last_id}_2." . $ext;
                    $dst = "../images_products/" . $nameImg;
                    $anhphu2 = substr($dst, 3);
                    
                    $query = "INSERT INTO tbl_hinhanh (MaSP, DuongDan, SoThuTu)
                                            VALUE ({$last_id}, '{$anhphu2}', 2);";
                    $result = mysql_query($query) or die ('Lỗi thêm hình ảnh phụ' .  mysql_error());
                    move_uploaded_file($_FILES['uploadanhphu2']['tmp_name'], $dst);                    
                }
            }
        }        
    }
?>
<form id="add-product-form" action="admin.php?page=products&q=add_product" method="POST" enctype="multipart/form-data">
    <p class="title">thêm sản phẩm mới</p>
    <table border='1'>
        <tr>
            <th>Tên sản phẩm</th>
            <td>
                <input type="text" size="70" name="tensp" onkeyup="check_exist(this.value)" />
                <p id="message"></p>
            </td>
        </tr>
        <tr>
            <th>Giá </th>
            <td><input type="text" size="20" name="gia" /> USD</td>
        </tr>
        <tr>
            <th>Giá cũ </th>
            <td><input type="text" size="20" name="giacu" id="giacu" style="text-align: left;" /> USD</td>            
        </tr>        
        <tr>
            <th>Đơn vị tính </th>
            <td><input type="text" size="10" name="donvitinh" /></td>
        </tr>
        <tr>
            <th>Bảo hành (tháng)</th>
            <td><input type="text" size="10" name="baohanh" /></td>
        </tr>
        <tr>
            <th>
                <label><input type="checkbox" name="spmoi" /> Sản phẩm mới</label>
            </th>
            <th>
                <label><input type="checkbox" id="spkm" name="spkm" /> Sản phẩm đang khuyến mại</label>
            </th>
        </tr>
        <tr>
            <th>Màu sắc</th>
            <td><input type="text" name="mausac" /></td>
        </tr>
        <tr>
            <th>Loại sản phẩm</th>
            <td>
                <select name="loaisp">
                <?php 
                    $sql = "SELECT * FROM tbl_loaisp WHERE MaLoai <> MaCha;";
                    $res = mysql_query($sql) or die("Lỗi truy xuất cơ sở dữ liệu");
                    while($rows = mysql_fetch_array($res)){
                        if(isset($_GET['cat_id']) && $_GET['cat_id'] == $rows['MaLoai']){
                            echo "<option selected='selected' value='{$rows['MaLoai']}'>{$rows['TenLoai']}</option>";
                        }else{
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
                            echo "<option value='{$rows['MaNhaSX']}'>{$rows['TenNhaSX']}</option>";
                    }                
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Mô tả sản phẩm</th>
            <td><textarea cols="40" rows="10" name="mota" id="mota" ></textarea></td>
        </tr>
        <tr>
            <th>Link sản phẩm</th>
            <td><input type="text" size="70" name="linksun"/></td>
        </tr>
        <tr>
            <th>Hình ảnh chính của sản phẩm</th>
            <td>
                <input type="file" name="uploadanhchinh" />
            </td>
        </tr>
        <tr>
            <th>Hình ảnh khác</th>
            <td>
                <input type="file" name="uploadanhphu1" />
                <label><input type="checkbox" id="uploadmore" />Thêm ảnh nữa<br /></label>
                <input type="file" name="uploadanhphu2" id="upload2" />
            </td>            
        </tr>
        
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="button_big submit-btn" value="Thêm" name="add_product" />
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
        
        $("#add-product-form").validate({
            rules: {tensp:{required: true}
                   ,gia:{required: true}
                   ,giacu:{required: true}
                   ,donvitinh:{required: true}
                   ,baohanh:{required: true, digits: true}
                   ,uploadanhchinh:{required: true}},  
            messages:{tensp:{required: "Vui lòng điền tên sản phẩm"}
                     ,gia:{required: "Vui lòng điền giá sản phẩm", digits: "Bạn phải nhập số"}
                     ,giacu:{required: "Vui lòng điền giá cũ của sản phẩm", digits: "Bạn phải nhập số"}
                     ,donvitinh:{required: "Vui lòng điền đơn vị tính"}
                     ,baohanh:{required: "Vui lòng điền thời gian bảo hành", digits: "Bạn phải nhập số"}
                     ,uploadanhchinh:{required: "Bạn chưa upload ảnh chính"}}
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