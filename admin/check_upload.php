<?php
    function check_upload($upload){

        if($_FILES["{$upload}"]["type"] != 'image/gif'
            && $_FILES["{$upload}"]["type"] != 'image/jpeg'
            && $_FILES["{$upload}"]["type"] != 'image/pjpeg'
            && $_FILES["{$upload}"]["type"] != 'image/png'){
            
            echo "<p class='error'>Không hỗ trợ định dạng file này</p>";
            return false;
        }
        else{
            if($_FILES["{$upload}"]["size"] > 2048000){
                echo "<p class='error'>Ảnh có dung lượng quá lớn</p>";
                return false;
            }
            else
                return true;
        }
    }
    ?>