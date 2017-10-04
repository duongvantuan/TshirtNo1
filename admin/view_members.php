<table border ='1' class="tables-admin" >
    <p class="title">danh sách thành viên</p>
    <tr>
        <th>Tên đăng nhập</th>
        <th>Họ Tên</th>
        <th>Giới tính</th>
        <th>Ngày Sinh</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Email</th>
        <th>Ngày đăng ký</th>
        <th>Ngày đăng nhập gần nhất</th>
        <th>Ngày sửa thông tin gần nhất</th>
        <th>Thao tác</th>
    </tr>
<?php
    mysql_query("SET NAMES UTF8");
    $sql = "SELECT  MaTV
                    , UserName
                    , HoTen
                    , CASE GioiTinh WHEN '1' THEN 'Nam' ELSE 'Nữ' END GioiTinh
                	, NgaySinh
                	, SoDienThoai
                    , DiaChi
                    , Email
                	, NgayDangKi
                    , NgayLoginGanNhat
                    , NgaySuaGanNhat
        	FROM tbl_thanhvien WHERE MaTV <> 0";
    $result = mysql_query($sql);
      
    while ($data = mysql_fetch_array($result)){
       $m_id = $data["MaTV"];
        echo "<tr><td>{$data['UserName']}</td>
              <td>{$data['HoTen']}</td>            
              <td>{$data['GioiTinh']}</td>
              <td>{$data['NgaySinh']}</td>
              <td>{$data['SoDienThoai']}</td>
              <td>{$data['DiaChi']}</td>
              <td>{$data['Email']}</td>
              <td>{$data['NgayDangKi']}</td>
              <td>{$data['NgayLoginGanNhat']}</td>
              <td>{$data['NgaySuaGanNhat']}</td>
              <td><a href='' id='{$m_id}' class='delete_member delete_invi' style='display:none;'>Xóa</a></td></tr>";                
    }
?>
</table>
<br /><br />
<table border='1' class="tables-admin">
    <p class="title">danh sách đang chờ xác nhận email</p>
    <tr>
        <th>Tên đăng nhập</th>
        <th>Họ Tên</th>
        <th>Giới tính</th>
        <th>Ngày Sinh</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Email</th>
        <th>Ngày đăng ký</th>
        <th>Thao tác</th>
    </tr>    
    <?php
    mysql_query("SET NAMES UTF8");
    $sql = "SELECT  UserName
                    , HoTen
                    , CASE GioiTinh WHEN '1' THEN 'Nam' ELSE 'Nữ' END GioiTinh
                	, NgaySinh
                	, SoDienThoai
                    , DiaChi
                    , Email
                	, NgayDangKi
        	FROM tbl_thanhvien_temp";
    $result = mysql_query($sql);
    $data = mysql_fetch_array($result);
    $u_id_t= $data["UserName"];
    if($data == 0)
   {
        echo "<tr><td colspan='9' align='center'>Không có thành viên mới</td></tr>";
    }
    else
            {
        echo "<tr>
                <td>{$data['UserName']}</td>
                <td>{$data['HoTen']}</td>            
                <td>{$data['GioiTinh']}</td>
                <td>{$data['NgaySinh']}</td>
                <td>{$data['SoDienThoai']}</td>
                <td>{$data['DiaChi']}</td>
                <td>{$data['Email']}</td>
                <td>{$data['NgayDangKi']}</td>
                <td><a href='' id='{$u_id_t}' class='delete_member_temp delete_invi' style='display:none;'>Xóa</a></td>
              </tr>";
        }   
    ?>
</table>
<script type="text/javascript">
    $(document).ready(function(){
                
       $('.delete_member').click(function(){
        
            var m_id = $(this).attr('id');
            var del = confirm('Bạn muốn xóa thành viên có mã ' + m_id + '?');
            if(del == true){
                $(this).attr('href', 'admin.php?page=accounts&q=delete_user&m_id=' + m_id);
            }else{
                $(this).attr('href', '');
            }            
       }); 
       $('.delete_member_temp').click(function(){
        
            var m_id_t = $(this).attr('id');
            var del = confirm('Bạn muốn xóa thành viên chưa xác nhận có tên đăng nhập ' + m_id_t + '?');
            if(del == true){
                $(this).attr('href', 'admin.php?page=accounts&q=delete_user_temp&m_id=' + m_id_t);
            }else{
                $(this).attr('href', '');
            }            
       }); 
    });
</script>
<?php
    include 'delete_invi.php';
?>