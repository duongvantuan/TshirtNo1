<?php

$masp = $_GET["p_id"];
$sql="SELECT A.*, B.DuongDan FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON (A.MaSP = B.MaSP) WHERE A.MaSP = $masp AND B.AnhChinh = 1 LIMIT 0,1";          
$result = mysql_query($sql) or die("Loi co so du lieu");

$row = mysql_fetch_array($result);

$ten = $row["TenSP"];             
$gia = $row["Gia"];
$hinh = $row["DuongDan"];

if(!isset($_SESSION['cart'][$masp]))
{
    $_SESSION['cart'][$masp]= array(
        "TenSP" => $ten,
        "Gia" => $gia,
        "HinhAnh" => $hinh,
        "soluong" => 1
     );
}
else
{
    $_SESSION['cart'][$masp]['soluong'] += 1;
}

// Tính tổng tiền
$total = 0;
foreach ($_SESSION['cart'] as $product)
{
    $total += $product['Gia'] * $product['soluong'];
}

$_SESSION['Tongtien'] = $total;
    
?>

<form>
    <table width="200">
        <tr>
            <td colspan="2" ><p id="basketItemsWrap">Số mặt hàng trong giỏ:
                <?php 
                    if(isset($_SESSION['cart'])){
                        echo count($_SESSION['cart']);   
                    }
                    else{
                        echo "0";
                    }

                ?>
            </p>
            </td>

        </tr>
        <tr>
            <td colspan="2"><p>Thành tiền: 
            <?php 
                if(isset($_SESSION['Tongtien'])){
                    echo number_format($_SESSION['Tongtien'], 0, '.', '.').'VND';
                }else{
                    echo "0";   
                }                            
            ?> 
                VND</p>
            </td>
        </tr>
        <tr align="center">
            <td><input type="button" value="Xem" class="button_small" onclick="window.location='index.php?page=show_cart';"/></td>
            <td><input type="button" value="Thanh toán" class="button_big"/></td>
        </tr>
    </table>
</form>