<?php
    include("../include/dbconnect.php");
    include("check_upload.php");

    if(isset($_POST['product_submit'])){
        $p_id = $_POST['p_id'];
        $tensp = $_POST['tensp'];
        $gia  = $_POST['gia'] * 1000;
        $giacu = (isset($_POST['giacu'])) ? $_POST['giacu']*1000 : 0;
        $donvitinh = $_POST['donvitinh'];
        $baohanh = $_POST['baohanh'];
        $spmoi = (isset($_POST['spmoi'])) ? 1 : 0;
        $spkm = (isset($_POST['spkm'])) ? 1 : 0;
        $mausac = $_POST['mausac'];
        $loaisp = $_POST['loaisp'];
        $nhasx = $_POST['nhasx'];
        $mota = $_POST['mota'];
        $anhchinh_cu = $_POST['anhchinh_cu'];
        $anhphu_cu1 = (isset($_POST['anhphu_cu1'])) ? $_POST['anhphu_cu1'] : null;
        $anhphu_cu2 = (isset($_POST['anhphu_cu2'])) ? $_POST['anhphu_cu2'] : null;
        $uploadanhchinh = $_FILES['uploadanhchinh']['name'];
        $uploadanhphu1 = $_FILES['uploadanhphu1']['name'];
        $uploadanhphu2 = $_FILES['uploadanhphu2']['name'];
        
        // nếu thay ảnh chính
        if(!empty($uploadanhchinh)){
            if(check_upload('uploadanhchinh')){
                // xóa ảnh cũ                
                unlink("../{$anhchinh_cu}");
                                
                $ext= substr(strrchr($uploadanhchinh,'.'),1);
                $anhchinh_moi = "p_{$p_id}." . $ext;
                // thư mục đích: images_products
                $dst = "../images_products/" . $anhchinh_moi;
                $duongdananhchinh = substr($dst, 3); 
                // cập nhật ảnh mới
                move_uploaded_file($_FILES['uploadanhchinh']['tmp_name'], $dst);
                $query = "UPDATE tbl_hinhanh SET DuongDan = '{$duongdananhchinh}' WHERE MaSP = {$p_id} AND SoThuTu = 0;";
                $result = mysql_query($query) or die ("Lỗi cập nhật ảnh chính: " . mysql_error());                
            }
        }       
        
        // nếu thay ảnh phụ 1
        if(!empty($uploadanhphu1)){
            if(check_upload('uploadanhphu1')){
                // nếu đã có ảnh phụ thì xóa ảnh cũ
                if(!empty($anhphu_cu1)){
                    unlink("../{$anhphu_cu1}");// xóa ảnh phụ cũ
                }
                $ext= substr(strrchr($uploadanhphu1,'.'),1);
                $anhphu_moi1 = "p_{$p_id}_1." . $ext;
                $dst = "../images_products/" . $anhphu_moi1;
                $duongdan_anhphu1 = substr($dst, 3); 
                // cập nhật ảnh mới
                move_uploaded_file($_FILES['uploadanhphu1']['tmp_name'], $dst);
                
                // nếu chưa có ảnh phụ
                if(empty($anhphu_cu1)){
                    $query = "INSERT INTO tbl_hinhanh (MaSP, DuongDan, SoThuTu)
                                VALUE ({$p_id}, '{$duongdan_anhphu1}', 1);";
                    $result = mysql_query($query) or die ('Lỗi thêm hình ảnh phụ 1' .  mysql_error());                     
                }
                else{
                    $query = "UPDATE tbl_hinhanh SET DuongDan = '{$duongdan_anhphu1}' WHERE MaSP = {$p_id} AND SoThuTu = 1;";
                    $result = mysql_query($query) or die ("Lỗi cập nhật ảnh phụ 1: " . mysql_error());                    
                }
            }            
        }
        
        // nếu thay ảnh phụ 2
        if(!empty($uploadanhphu2)){
            if(check_upload('uploadanhphu2')){
                // nếu có ảnh cũ thì xóa
                if(!empty($anhphu_cu2)){
                    unlink("../{$anhphu_cu2}"); // xóa
                }
                $ext= substr(strrchr($uploadanhphu2,'.'),1);
                $anhphu_moi2 = "p_{$p_id}_2." . $ext;
                $dst = "../images_products/" . $anhphu_moi2;
                $duongdan_anhphu2 = substr($dst, 3); 
                // cập nhật ảnh mới
                move_uploaded_file($_FILES['uploadanhphu2']['tmp_name'], $dst);
                
                // nếu chưa có ảnh phụ
                if(empty($anhphu_cu2)){
                    $query = "INSERT INTO tbl_hinhanh (MaSP, DuongDan, SoThuTu)
                                VALUE ({$p_id}, '{$duongdan_anhphu2}', 2);";
                    $result = mysql_query($query) or die ('Lỗi thêm hình ảnh phụ 2' .  mysql_error());
                }
                else{
                    $query = "UPDATE tbl_hinhanh SET DuongDan = '{$duongdan_anhphu2}' WHERE MaSP = {$p_id} AND SoThuTu = 2;";
                    $result = mysql_query($query) or die ("Lỗi cập nhật ảnh phụ 2: " . mysql_error());                    
                }                 
            }
        }
                
        mysql_query("SET NAMES UTF8");
        $query = "UPDATE tbl_sanpham
                    SET TenSP = '{$tensp}'
                        , MoTa = '{$mota}'
                        , DonViTinh = '{$donvitinh}'
                        , Gia = {$gia}
                        , GiaCu = {$giacu}
                        , BaoHanh = {$baohanh}
                        , SPMoi = {$spmoi}
                        , KhuyenMai = {$spkm}
                        , MaLoai = {$loaisp}
                        , MaNhaSX = {$nhasx}
                        , MauSac = '{$mausac}'
                        , NgaySua = NOW()
                    WHERE MaSP={$p_id};";
                    
        $result = mysql_query($query) or die ("Lỗi sửa sản phẩm" . mysql_error());
        
        if($result){
            header('location:admin.php?page=products&q=success&s=6');
        }else{
            header('location:admin.php?page=products&q=success&s=6');
        }
    }