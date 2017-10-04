<?php
/**
 * User Dashboard Administration Screen
 *
 * @package WordPress
 * @subpackage Administration
 * @since 3.1.0
 */

require_once( './admin.php' );

?>
<table width="500px" align="center" border="1">
	<tr>
		<td>Quoc Gia</td>
		<td>
			<select name="mid" size="1" id="nhasanxuat" size="45" class="float_left">
				 <option value="0">Lua Chon Quoc Gia</option>
				 <?php 
				 	$sql="select * from wp_quocgia";
					$result=  mysql_query($sql) or die("loi");
					while($row = mysql_fetch_array($result))
					{ 
				 ?>
				<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				  <?php 
				  	} 
				  ?>
			</select>
		</td>
	</tr>	
	<tr>
		<td>The Loai</td>
		<td>
			<select name="mid" size="1" id="nhasanxuat" size="45" class="float_left">
				 <option value="0">Lua Chon The Loai</option>
				 <?php 
				 	$sql="select * from wp_theloai";
					$result=  mysql_query($sql) or die("loi");
					while($row = mysql_fetch_array($result))
					{ 
				 ?>
				<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				  <?php 
				  	} 
				  ?>
			</select>
		</td>
	</tr>	
	<tr>
		<td>Nhom Phim</td>
		<td>
			<select name="mid" size="1" id="nhasanxuat" size="45" class="float_left">
				 <option value="0">Lua Chon Nhom Phim</option>
				 <?php 
				 	$sql="select * from wp_nhomphim";
					$result=  mysql_query($sql) or die("loi");
					while($row = mysql_fetch_array($result))
					{ 
				 ?>
				<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				  <?php 
				  	} 
				  ?>
			</select>
		</td>
	</tr>	
	<tr>
		<td>Title Phim</td>
		<td>
			<input name="title" type="text" class="float_left" id="title" value="" size="45"/>
		</td>
	</tr>	
	<tr>
		<td>Ten Phim</td>
		<td>
			<input name="tenphim" type="text" class="float_left" id="title" value="" size="45"/>
		</td>
	</tr>	
	<tr>
		<td>Link Anh</td>
		<td>
			<input name="linkanh" type="text" class="float_left" id="title" value="" size="45"/>
		</td>
	</tr>
	<tr>
		<td>Link Video</td>
		<td>
			<input name="linkvideo" type="text" class="float_left" id="title" value="" size="45"/>
		</td>
	</tr>
	<tr>
		<td>Luot Xem</td>
		<td>
			<input name="luotxem" type="text" class="float_left" id="title" value="" size="45"/>
		</td>
	</tr>
	<tr>
		<td>Chat Luong</td>
		<td>
			<input name="chatluong" type="text" class="float_left" id="title" value="" size="45"/>
		</td>
	</tr>
	<tr>
		<td>Tap</td>
		<td>
			<input name="tap" type="text" class="float_left" id="title" value="" size="45"/>
		</td>
	</tr>
	<tr>
		<td>Tong So Tap</td>
		<td>
			<input name="tongsotap" type="text" class="float_left" id="title" value="" size="45"/>
		</td>
	</tr>
	<tr>
		<td>Trang Thai</td>
		<td>
			<input name="trangthai" type="text" class="float_left" id="title" value="" size="45"/>
		</td>
	</tr>
	<tr>
		<td>
		</td>
		<td align="center">
			<input type="submit" name="add_product" value="Add" class="float_left"/>
			<input type="button" name="back" value="Cancel" onclick="history.go(-1); return false;" class="float_left"/>
		</td>
	</tr>
</table>









<?php
    include('check_upload.php');
    
    if(isset($_POST['add_product'])){                
        if(check_upload('uploadanhchinh')){
            
            $query = "SELECT MaSP FROM tbl_sanpham ORDER BY MaSP DESC LIMIT 0, 1;";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result);
            $last_id = $row['MaSP'];// Mã sp cu?i cùng
            $last_id++; // tang mã sp lên 1
            
            // Chèn vào CSDL
            $tensp = $_POST['tensp'];
            $gia = $_POST['gia'] * 1000;
            $giacu = (isset($_POST['giacu'])) ? $_POST['giacu']*1000 : 0;
            $donvitinh = $_POST['donvitinh'];
            $baohanh = $_POST['baohanh'];
            $spmoi = (isset($_POST['spmoi'])) ? 1 : 0;
            $spkm = (isset($_POST['spkm'])) ? 1 : 0;
            $mausac = $_POST['mausac'];
            $loaisp = $_POST['loaisp'];
            $nhasx = $_POST['nhasx'];
            $mota = $_POST['mota'];

            mysql_query("SET NAMES UTF8");
            $query = "INSERT INTO tbl_sanpham(MaSP, TenSP, MoTa, DonViTinh, Gia, GiaCu, BaoHanh, SPMoi, KhuyenMai, LuotDanhGia, Rating, MaLoai, MaNhaSX, MauSac, NgayThem)
                        VALUES({$last_id}, '{$tensp}', '{$mota}', '{$donvitinh}', {$gia}, {$giacu}, {$baohanh}, {$spmoi}, {$spkm}, 0, 0, {$loaisp}, {$nhasx}, '{$mausac}', NOW());";                
            $result = mysql_query($query) or die ('L?i thêm s?n ph?m' . mysql_error());            
            if($result){
                header('location:admin.php?page=products&q=success&s=6');    
                
            }else{
                header('location:admin.php?page=products&q=error&e=6');
            }
                        
            // ?nh chính                        
            $ext = substr(strrchr($_FILES['uploadanhchinh']['name'], '.'), 1);
            $nameImg = "p_{$last_id}." . $ext;
            $dst = "../images_products/" . $nameImg;
            $anhchinh = substr($dst, 3); // c?t b? d?u ../            
                                   
            // thêm ?nh chính vào csdl
            $query = "INSERT INTO tbl_hinhanh (MaSP, DuongDan, SoThuTu) 
                      VALUE ({$last_id}, '{$anhchinh}', 0);";
            $result = mysql_query($query) or die ('L?i thêm hình ?nh chính' .  mysql_error());
            move_uploaded_file($_FILES['uploadanhchinh']['tmp_name'], $dst);
            
            // ?nh ph? 1
            if(!empty($_FILES['uploadanhphu1']['name'])){
                if(check_upload('uploadanhphu1')){
                    $ext = substr(strrchr($_FILES['uploadanhphu1']['name'], '.'), 1);
                    $nameImg = "p_{$last_id}_1." . $ext;
                    $dst = "../images_products/" . $nameImg;
                    $anhphu = substr($dst, 3);
                    
                    $query = "INSERT INTO tbl_hinhanh (MaSP, DuongDan, SoThuTu)
                                            VALUE ({$last_id}, '{$anhphu}', 1);";
                    $result = mysql_query($query) or die ('L?i thêm hình ?nh ph?' .  mysql_error());
                    move_uploaded_file($_FILES['uploadanhphu1']['tmp_name'], $dst);                    
                }
            }
            // ?nh ph? 2
            if(!empty($_FILES['uploadanhphu2']['name'])){
                if(check_upload('uploadanhphu2')){
                    $ext = substr(strrchr($_FILES['uploadanhphu2']['name'], '.'), 1);
                    $nameImg = "p_{$last_id}_2." . $ext;
                    $dst = "../images_products/" . $nameImg;
                    $anhphu2 = substr($dst, 3);
                    
                    $query = "INSERT INTO tbl_hinhanh (MaSP, DuongDan, SoThuTu)
                                            VALUE ({$last_id}, '{$anhphu2}', 2);";
                    $result = mysql_query($query) or die ('L?i thêm hình ?nh ph?' .  mysql_error());
                    move_uploaded_file($_FILES['uploadanhphu2']['tmp_name'], $dst);                    
                }
            }
        }        
    }
?>
<form id="add-product-form" action="admin.php?page=products&q=add_product" method="POST" enctype="multipart/form-data">
    <p class="title">thêm s?n ph?m m?i</p>
    <table border='1'>
        <tr>
            <th>Tên s?n ph?m</th>
            <td>
                <input type="text" size="70" name="tensp" onkeyup="check_exist(this.value)" />
                <p id="message"></p>
            </td>
        </tr>
        <tr>
            <th>Giá </th>
            <td><input type="text" size="20" name="gia" /> .000 VND</td>
        </tr>
        <tr>
            <th>Giá cu </th>
            <td><input type="text" size="20" name="giacu" id="giacu" style="text-align: left;" /> .000 VND</td>            
        </tr>        
        <tr>
            <th>Ðon v? tính </th>
            <td><input type="text" size="10" name="donvitinh" /></td>
        </tr>
        <tr>
            <th>B?o hành (tháng)</th>
            <td><input type="text" size="10" name="baohanh" /></td>
        </tr>
        <tr>
            <th>
                <label><input type="checkbox" name="spmoi" /> S?n ph?m m?i</label>
            </th>
            <th>
                <label><input type="checkbox" id="spkm" name="spkm" /> S?n ph?m dang khuy?n m?i</label>
            </th>
        </tr>
        <tr>
            <th>Màu s?c</th>
            <td><input type="text" name="mausac" /></td>
        </tr>
        <tr>
            <th>Lo?i s?n ph?m</th>
            <td>
                <select name="loaisp">
                <?php 
                    $sql = "SELECT * FROM tbl_loaisp WHERE MaLoai <> MaCha;";
                    $res = mysql_query($sql) or die("L?i truy xu?t co s? d? li?u");
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
            <th>Nhà s?n xu?t</th>
            <td>
                <select name="nhasx">
                <?php
                    $sql = "SELECT * FROM tbl_nhasx;";
                    $res = mysql_query($sql) or die("L?i truy xu?t co s? d? li?u");
                    while($rows = mysql_fetch_array($res)){
                            echo "<option value='{$rows['MaNhaSX']}'>{$rows['TenNhaSX']}</option>";
                    }                
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Mô t? s?n ph?m</th>
            <td><textarea cols="40" rows="10" name="mota" id="mota" ></textarea></td>
        </tr>
        <tr>
            <th>Hình ?nh chính c?a s?n ph?m</th>
            <td>
                <input type="file" name="uploadanhchinh" />
            </td>
        </tr>
        <tr>
            <th>Hình ?nh khác</th>
            <td>
                <input type="file" name="uploadanhphu1" />
                <label><input type="checkbox" id="uploadmore" />Thêm ?nh n?a<br /></label>
                <input type="file" name="uploadanhphu2" id="upload2" />
            </td>            
        </tr>
        
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="button_big submit-btn" value="Thêm" name="add_product" />
                <input type="reset" class="button_big" value="Nh?p l?i" />
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
                   ,gia:{required: true, digits: true}
                   ,giacu:{required: true, digits: true}
                   ,donvitinh:{required: true}
                   ,baohanh:{required: true, digits: true}
                   ,uploadanhchinh:{required: true}},  
            messages:{tensp:{required: "Vui lòng di?n tên s?n ph?m"}
                     ,gia:{required: "Vui lòng di?n giá s?n ph?m", digits: "B?n ph?i nh?p s?"}
                     ,giacu:{required: "Vui lòng di?n giá cu c?a s?n ph?m", digits: "B?n ph?i nh?p s?"}
                     ,donvitinh:{required: "Vui lòng di?n don v? tính"}
                     ,baohanh:{required: "Vui lòng di?n th?i gian b?o hành", digits: "B?n ph?i nh?p s?"}
                     ,uploadanhchinh:{required: "B?n chua upload ?nh chính"}}
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
    
    // ki?m tra s? t?n t?i c?a tên s?n ph?m
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