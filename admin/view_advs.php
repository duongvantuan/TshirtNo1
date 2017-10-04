<?php
    include 'delete_invi.php';
?>
<table border='1' class="tables-admin" >
    <p class="title">danh sách quảng cáo đã đăng</p>
    <tr>
        <th>Mã quảng cáo</th>
        <th>Tên quảng cáo</th>
        <th>Đường dẫn</th>
        <th>Ảnh</th>
        <th>Vị trí hiển thị</th>
        <th>Số thứ tự</th>
        <th>Quản lý</th>        
    </tr>
    <?php
           
        mysql_query("SET NAMES UTF8;");
        $query = "SELECT MaQC
                        , TenQC
                        , DuongDanAnh
                        , ThuTu
                        , Link
                        , CASE ViTri
                            WHEN '1' THEN 'Trái'
                            ELSE 'Phải' 
                          END ViTri FROM tbl_quangcao;";
        $result = mysql_query($query);
        
        while($rows = mysql_fetch_array($result)){
            
            $adv_id = $rows['MaQC'];
            $adv_name = $rows['TenQC'];
            $hinh = $rows['DuongDanAnh'];
            $stt = $rows['ThuTu'];
            $link = $rows['Link'];
            $vitri = $rows['ViTri'];
            
            echo "<tr><td>{$adv_id}</td>
                <td>{$adv_name}</td>
                <td><a href='{$link}' target='_blank'>{$link}</a></td>
                <td><img src='../{$hinh}' alt='{$adv_name}' /></td>
                <td>{$vitri}</td>                
                <td>{$stt}</td>
                <td><a href='admin.php?page=other_features&q=edit_adv&a_id={$adv_id}'>Sửa</a><br /><br /><br />
                <a class='delete_invi' href='' id={$adv_id} style='display:none;'>Xóa</a>
                </td>
            </tr>";
        }
    ?>
</table>
<script type="text/javascript">
    $(document).ready(function(){
                
       $('.delete_invi').click(function(){
        
            var adv_id = $(this).attr('id');
            var del = confirm('Bạn muốn xóa quảng cáo có mã ' + adv_id + '?');
            if(del == true){
                $(this).attr('href', 'admin.php?page=other_features&q=delete_adv&a_id=' + adv_id);
            }else{
                $(this).attr('href', '');
            }            
       }); 
    });
</script>