<?php
    require_once ('include/dbconnect.php');

    $tennguoinhan= $_POST['tennguoinhan'];
    $sdtnguoinhan=$_POST['sodienthoainhanhang'];
    $diachinguoinhan=$_POST['diachinhanhang'];
    $email=$_POST['emailnguoinhan'];
    $ghichu=$_POST['ghichu'];

// thành viên
if(isset($_SESSION['user_login']))
{
    
    $nguoidat="SELECT * FROM tbl_thanhvien WHERE UserName='{$_SESSION["user_login"]}'";
    $result1=  mysql_query($nguoidat)or die("loi cau lenh truy van du lieu");
    $data=  mysql_fetch_array($result1); 
    mysql_query("SET NAMES UTF8");   
    $themdon="INSERT INTO tbl_donhang(MaTV,TenNguoiDat,NgayDat,EmailNguoiDat,DienThoai,DiaChiNguoiDat,TenNguoiNhan,EmailNguoiNhan,DiaChiNguoiNhan,DienThoaiNN,GhiChu)
                                VALUE ('{$data["MaTV"]}','{$data["HoTen"]}',NOW(),'{$data["Email"]}','{$data["SoDienThoai"]}','{$data["DiaChi"]}','$tennguoinhan','$email','$diachinguoinhan','$sdtnguoinhan','$ghichu')";
    mysql_query($themdon) or die("Lỗi thêm đơn hàng thành viên");

    //Thêm vào bảng chi tiết hóa đơn
    $sql="SELECT * FROM tbl_donhang ORDER BY MaDH DESC LIMIT 0,1";
    $result=mysql_query($sql) or die("Lỗi thêm đơn hàng");
    while ($row=  mysql_fetch_array($result))
    {
        $id_donhang = $row['MaDH'];
    }
    foreach ($_SESSION['cart'] as $key=>$value)
    {
        $soluong=$value['soluong'];
        $gia=$value['Gia'];
        mysql_query("SET NAMES UTF8"); 
        $themchitet = "INSERT INTO tbl_chitietdh (MaDH, MaSP, SoLuong, DonGia) VALUES ('$id_donhang', '$key', '$soluong','$gia')";
        mysql_query($themchitet) or die("Lỗi câu lệnh truy vấn");
    }
}
// khách vãng lai
else {
        $nguoidat="SELECT * FROM tbl_thanhvien WHERE MaTV='0'";
        $result1=  mysql_query($nguoidat)or die("loi cau lenh truy van du lieu");
        $data = mysql_fetch_array($result1);
        mysql_query("SET NAMES UTF8");
        $themdon="INSERT INTO tbl_donhang(MaTV, TenNguoiDat, NgayDat, EmailNguoiDat, DienThoai, DiaChiNguoiDat, TenNguoiNhan, EmailNguoiNhan, DiaChiNguoiNhan, DienThoaiNN, GhiChu)
                                    VALUE ('{$data["MaTV"]}','{$data["HoTen"]}',NOW(),'{$data["Email"]}','{$data["SoDienThoai"]}','{$data["DiaChi"]}','$tennguoinhan','$email','$diachinguoinhan','$sdtnguoinhan','$ghichu')";
        mysql_query($themdon) or die("Lỗi thêm đơn hàng khách vãng lai");

        //Thêm vào bảng chi tiết hóa đơn
        $sql="SELECT * FROM tbl_donhang ORDER BY MaDH DESC LIMIT 0,1";
        $result=mysql_query($sql) or die("Lỗi thêm đơn hàng");
        while ($row=  mysql_fetch_array($result)){
            $id_donhang = $row['MaDH'];
        }
        foreach ($_SESSION['cart'] as $key=>$value){
            $soluong=$value['soluong'];
            $gia=$value['Gia'];
            mysql_query("SET NAMES UTF8");
            $themchitet = "INSERT INTO tbl_chitietdh (MaDH, MaSP, SoLuong, DonGia) VALUES ('$id_donhang', '$key', '$soluong','$gia')";
            mysql_query($themchitet) or die("Lỗi câu lệnh truy vấn");
        }
}
    unset ($_SESSION['cart']);
    unset($_SESSION['Tongtien']);
    header ("location: index.php?page=success&q=5");
?>
        