<?php
    include 'delete_invi.php';
?>
<table border='1' class="tables-admin" >
    <p class="title">danh sách góp ý, liên hệ</p>
    <tr>
        <th>Tiêu đề</th>
        <th>Họ tên người gửi</th>
        <th>Điện thoại</th>
        <th>Email</th>
        <th>Địa chỉ</th>
        <th>Nội dung</th>
        <th>Ngày gửi</th>
        <th>Thao tác</th>
    </tr>
<?php
    $query = "SELECT * FROM tbl_gopy;";
    $result = mysql_query($query);    
        
    while($rows=mysql_fetch_array($result)){
        $magopy = $rows['MaGopY'];
        $tieude = $rows['TieuDe'];
        $nguoigui = $rows['HoTen'];
        $dienthoai = $rows['DienThoai'];
        $email = $rows['Email'];
        $diachi = $rows['DiaChi'];
        $noidung = $rows['NoiDung'];
        $ngaygui = $rows['NgayGopY'];
        
        echo "<tr>
                <td>{$tieude}</td>
                <td>{$nguoigui}</td>
                <td>{$dienthoai}</td>
                <td>{$email}</td>
                <td>{$diachi}</td>
                <td>{$noidung}</td>
                <td>{$ngaygui}</td>
                <td>
                    <a href='mailto:{$email}'>Trả lời</a><br /><br />
                    <a href='' class='delete_invi' style='display:none;' id='{$magopy}'>Xóa<a/>
                </td>        
            </tr>";    
    }
?>    
</table>
<script type="text/javascript">
    $(document).ready(function(){
                
       $('.delete_invi').click(function(){
        
            var f_id = $(this).attr('id');
            var del = confirm('Bạn muốn xóa góp ý có mã ' + f_id + '?');
            if(del == true){
                $(this).attr('href', 'admin.php?page=other_features&q=delete_feedback&f_id=' + f_id);
            }else{
                $(this).attr('href', '');
            }            
       }); 
    });
</script>