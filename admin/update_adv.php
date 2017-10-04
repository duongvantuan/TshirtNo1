<?php
    include("../include/dbconnect.php");
    include("check_upload.php");
    
    if(isset($_POST['adv_submit'])){
        $a_id = $_POST['a_id'];
        $tenqc = $_POST['tenqc'];
        $link = $_POST['link'];
        $vitri = ($_POST['vitri'] == 0) ? 0 : 1;
        $thutu = $_POST['thutu'];        
        $anhcu = $_POST['anhcu'];        
        $upload = $_FILES['upload']['name'];
        
        if(!empty($upload)){
            
            if(check_upload('upload')){
                $ext= substr(strrchr($upload,'.'),1);
                $anhmoi = "adv_" . time() . "." . $ext;
                // thư mục đích: images_adv
                $dst = "../images_adv/" . $anhmoi;
                $duongdan = substr($dst, 3); // lấy đường dẫn chèn vào csdl; 
                // cập nhật ảnh mới
                move_uploaded_file($_FILES['upload']['tmp_name'], $dst);
                // xóa ảnh cũ
                unlink("../{$anhcu}");                                                                      
            }
        }
        else{
            $duongdan = $anhcu;
        }
        // update
        mysql_query("SET NAMES UTF8");
        $query = "UPDATE tbl_quangcao
                    SET TenQC = '{$tenqc}'
                        , DuongDanAnh = '{$duongdan}'
                        , ThuTu = {$thutu}
                        , Link = '{$link}'
                        , ViTri = {$vitri}
                    WHERE MaQC = {$a_id};";
        $result = mysql_query($query) or die(mysql_error());
        
        if($result){
            header('location:admin.php?page=other_features&q=success&s=1');
        }else{
            header('location:admin.php?page=other_features&q=error&e=1');
        }                 
    }