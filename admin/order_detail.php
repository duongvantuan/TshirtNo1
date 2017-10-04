<?php 
    $madh=$_GET["MaDH"];
    $sql="SELECT * FROM tbl_donhang WHERE MaDH=$madh ";
    $result=  mysql_query($sql) or die("Loi cau lenh truy van");
    $data=  mysql_fetch_array($result);
    
?>

<table width="800" class="tables-admin" align="center" style="background-color: white; ">
    <tr>
        <p class="title">Chi tiết đơn hàng</p>
    </tr>
    <tr>
        <td><h4>Tên người đặt:</h4></td><td align="center"><?php echo $data["TenNguoiDat"]; ?></td>
    </tr>
    <?php
    // Nếu là thành viên
    if($data["MaTV"]!=0)
    {
    ?>
        <tr>
        <td><h4>Email người đặt:</h4></td><td align="center"><?php echo $data["EmailNguoiDat"]; ?></td>
        </tr>
        <tr>
            <td><h4>Địa chỉ người đặt:</h4></td><td align="center"><?php echo $data["DiaChiNguoiDat"]; ?></td>
        </tr>
        <tr>
            <td><h4>điện thoại người đặt:</h4></td><td align="center"><?php echo $data["DienThoai"]; ?></td>
        </tr>
    <?php
    }
    ?>
     <tr>
        <td><h4>Thời gian đặt:</h4></td><td align="center"><?php echo $data["NgayDat"]; ?></td>
    </tr>
     <tr>
        <td><h4>Tên người Nhận:</h4></td><td align="center"><?php echo $data["TenNguoiNhan"]; ?></td>
    </tr>
     <tr>
        <td><h4>Email người nhận:</h4></td><td align="center"><?php echo $data["EmailNguoiNhan"]; ?></td>
    </tr>
     <tr>
        <td><h4>Địa chỉ người nhận:</h4></td><td align="center"><?php echo $data["DiaChiNguoiNhan"]; ?></td>
    </tr>
    <tr>
        <td><h4>điện thoại người nhận:</h4></td><td align="center"><?php echo $data["DienThoaiNN"]; ?></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        
        <td><h4>Sản phẩm đã đặt:</h4></td>
        <td>
            <table style="text-align: center;border:1px dashed #c0c0c0;" >
                <tr style="background-color: #c0c0c0;">
                    <td>Sản phẩm</td>
                    <td>Tên sản phẩm</td>
                    <td>Số lượng đặt</td>
                    <td width="100">Thành tiền</td>
                </tr>
                
            <?php 
            //Chi tiết đơn hàng
            $total=0;
                $sql="SELECT * FROM tbl_chitietdh A JOIN tbl_sanpham B ON A.MaSP = B.MaSP 
                        JOIN tbl_hinhanh C ON A.MaSP = C.MaSP WHERE A.MaDH=$madh";
                $result1=  mysql_query($sql) or die("lỗi câu lệnh");
                while ($row=  mysql_fetch_array($result1)){
                
            ?>
            
                <tr >
                    <td ><img src="../<?php echo $row['DuongDan']; ?>" /></td>
                    <td><?php echo $row['TenSP']; ?></td>
                    <td><input size="10" type="text" value="<?php echo $row['SoLuong'] ?>"/></td>
                    <td><?php echo number_format($row['SoLuong']*$row['Gia'], 0, '.', '.')." VND"; ?></td>
                </tr>
            
            <?php
            
            $total += $row["SoLuong"]*$row["Gia"];
                }
            ?>
                <tr>
                    <td colspan="4"> <h3> <?php echo "Tổng tiền: <font style='color: red;'>".number_format($total,0,'.','.')." VND</font>" ?></h3></td>
                </tr>
                
                </table>
            
        </td>
    </tr>
    <tr>
                    <td><h4>Ghi chú:</h4></td><td><?php echo $data['GhiChu']; ?></td>
    </tr>
    <tr>
        <td><h4>Trạng thái đơn hàng:</h4></td>
        <td>
            <?php 
                if($data["ThanhToan"] == 0)
                {
                    $trangthai="Chưa thanh toán";
                    $trangthai2="Đã thanh toán"; 
                }
                else {
                     $trangthai2="chưa thanh toán"; 
                    $trangthai="Đã thanh toán";    
                }
            ?>
            <select name="chon">
                <option name="1"><?php echo $trangthai; ?></option>
                <option name="2"><?php echo $trangthai2; ?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <table>
                <tr>
                    <td><input class="button_big" type="submit" name="submit" value="Cập nhật" /></td>
                    <td>&nbsp&nbsp;</td>
                    <td><input class="button_big" type="submit" name="thoat" value="Thoát" /></td>                       
                </tr>              
            </table>
        </td>
    </tr>
</table>
