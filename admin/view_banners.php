<?php
    include 'delete_invi.php';
?>
<table border='1' class="tables-admin">
    <p class="title">danh sách banner đã đăng</p>
    <tr>
        <th>Mã Banner</th>
        <th>Hình ảnh</th>
        <th>Chú thích</th>
        <th>Số thứ tự</th>
        <th>Quản lý</th>
    </tr>
    <?php
        $query = "SELECT * FROM tbl_banner;";
        $result = mysql_query($query);
        
        while($rows = mysql_fetch_array($result)){
            $banner_id = $rows['MaBanner'];
            $duongdan = $rows['DuongDan'];
            $chuthich = $rows['ChuThich'];
            $stt = $rows['SoThuTu'];
            
            echo "<tr><td>{$banner_id}</td>                
            <td>
                <img src='../{$duongdan}' alt='{$banner_id}' style='width:200px;' /><br />
            </td>
            <td>
                {$chuthich}
            </td>
            <td>{$stt}</td>
            <td>
                <a href='admin.php?page=other_features&q=edit_banner&b_id={$banner_id}'>Sửa</a><br /><br /><br />
                <a href='' class='delete_invi' style='display:none;' id='{$banner_id}'>Xóa</a>
            </td>
            </tr>";
        }    
    ?>
</table>
<script>
    $(document).ready(function(){
       $('.delete_invi').click(function(){
        
            var b_id = $(this).attr('id');
            var del = confirm('Bạn muốn xóa banner mã ' + b_id + '?');
            if(del == true){
                $(this).attr('href', 'admin.php?page=other_features&q=delete_banner&b_id=' + b_id);
            }else{
                $(this).attr('href', '');
            }            
       }); 
    }) 
</script>