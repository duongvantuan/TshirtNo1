<?php
    include 'delete_invi.php';
?>
<table border ='1' class="tables-admin">
    <p class="title">danh sách quản trị viên</p>
    <tr>
        <th>Mã admin</th>
        <th>Tên đăng nhập</th>
        <th>Họ Tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Ngày tạo</th>
        <th>Ngày đăng nhập gần nhất</th>
        <th>Ngày sửa gần nhất</th>
        <th>Thao tác</th>
    </tr>
<?php

    $sql = "SELECT  MaAdmin
                    , TenDangNhap
                    , HoTen
                    , Email
                    , DienThoai 
                    , NgayTao
                    , NgayLoginGanNhat
                    , NgaySuaGanNhat
                FROM tbl_admin";

    $result = mysql_query($sql);
    
    while ($data=mysql_fetch_array($result)){   
        $ad_id = $data['MaAdmin'];
        echo "<tr><td>{$data['MaAdmin']}</td>
                  <td>{$data['TenDangNhap']}</td>
                  <td>{$data['HoTen']}</td>
                  <td>{$data['Email']}</td>
                  <td>{$data['DienThoai']}</td>
                  <td>{$data['NgayTao']}</td>
                  <td>{$data['NgayLoginGanNhat']}</td>
                  <td>{$data['NgaySuaGanNhat']}</td>
                  <td><a href='' id={$ad_id} class='delete_invi' style='display:none;'>Xóa</a></td>
                  </th>";
    }
?>
</table>
<script type="text/javascript">
    $(document).ready(function(){
                
       $('.delete_invi').click(function(){
        
            var ad_id = $(this).attr('id');
            var del = confirm('Bạn muốn xóa quản trị viên có mã ' + ad_id + '?');
            if(del == true){
                $(this).attr('href', 'admin.php?page=other_features&q=delete_admin&ad_id=' + ad_id);
            }else{
                $(this).attr('href', '');
            }            
       }); 
    });
</script>