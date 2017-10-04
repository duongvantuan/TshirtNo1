<form method="GET" >
<table class="tables-admin" style="font-size: 10px; background-color: white; text-align: center;" >
     <p class="title">danh sách tất cả đơn đặt hàng</p>
     <tr style="background-color: #c0c0c0;">
         <td>Mã đơn hàng</td>
         <td>Ngày đặt</td>
         <td>Tên người nhận</td>
         <td>Email người nhận</td>
         <td>Địa chỉ nhận</td>
         <td>Điện thoại người nhận</td>   
         <td>Trạng thái</td>
         <td>Thao tác</td>
    </tr>
<?php

$sql="SELECT * FROM tbl_donhang ORDER BY NgayDat DESC  ";
$result=  mysql_query($sql) or die("Lỗi câu lệnh truy vấn");
while ($row =  mysql_fetch_array($result)){
    
    if($row["ThanhToan"]==0)
    {
        $trangthai="Chưa thanh toán";
    }
 else {
     $trangthai="Đã thanh toán";
    }

?>
    <tr>
        <td><?php echo $row["MaDH"]; ?></td>
        <td><?php echo $row["NgayDat"]; ?></td>
        <td><?php echo $row["TenNguoiNhan"]; ?></td>
        <td><?php echo $row["EmailNguoiNhan"]; ?></td>
        <td><?php echo $row["DiaChiNguoiNhan"]; ?></td>
        <td><?php echo $row["DienThoaiNN"]; ?></td>
        <td><?php echo $trangthai; ?></td>
        <td><a href="admin.php?page=order_detail&MaDH=<?php echo $row['MaDH']; ?>" style="font-size: 12;">Xem</a><br/>
            <a href="admin.php?page=delete_order&MaDH=<?php echo $row['MaDH']; ?>" style="color: red;">Xóa</a>
        </td>
    </tr>

<?php
}
?>
</table>
</form>