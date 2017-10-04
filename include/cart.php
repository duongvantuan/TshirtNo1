
<div id="center_col" class="center_col">
    <div id="frame" class="center_block">
<h4>Chi tiết giỏ hàng</h4>
<div class="center_block_content"> 
    <form name="form_cart" method="get" id="cartForm" action="update_cart.php">
        <p id="frame_header" ><img src="images/cart.png" />&nbsp;&nbsp;Giỏ hàng của bạn</p>
        <table width="480" style="background-color:white;"  >
	<?php 
            $_SESSION["flag_capnhat"]=0;
            
            $masp = $_GET["p_id"];
            $sql="SELECT A.*, B.DuongDan FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON (A.MaSP = B.MaSP) WHERE A.MaSP = $masp AND B.SoThuTu = 0;";          
            $result = mysql_query($sql) or die("Loi co so du lieu");
            
            while($row = mysql_fetch_array($result)){
                $ten = $row["TenSP"];             
                $gia = $row["Gia"];
                $hinh = $row["DuongDan"];
            }
                if(!isset($_SESSION['cart'][$masp])){
                   $_SESSION['cart'][$masp]= array("TenSP"=>$ten,"Gia"=>$gia,"HinhAnh"=>$hinh,"soluong"=>1);
                }
                else
                {
                    foreach ($_SESSION['cart'] as $key => $value){
                        if($key==$masp && $_SESSION['flag']==0){
                            
                            $ten = $value["TenSP"];
                            $gia = $value["Gia"];
                            $hinh = $value["HinhAnh"];
                            $sl = $value["soluong"]+1;
                                                        
                            //cap nhat lai bien session
                            $_SESSION['cart'][$masp] = array("TenSP"=> $ten,"Gia"=>$gia,"HinhAnh"=>$hinh,"soluong"=>$sl);
                            
                            $_SESSION['flag']=1;
                    
                        }
                    }
                }
        ?>
        <script type="text/javascript">
                function keypress(e){
                    var keypressed = null;
                    if (window.event){
                        keypressed = window.event.keyCode; //IE
                    }
                    else {
                        keypressed = e.which; //NON-IE, Standard
                    }
                    if (keypressed < 48 || keypressed > 57){ 
                        if (keypressed == 8 || keypressed == 127){
                            return;
                        }
                        return false;
                    }
                }
        </script>


             <?php    
             $total=0;
             foreach ($_SESSION['cart'] as $key => $value){ 
                ?>
    
            <tr >
 			<td width="75">
                <a href="index.php?page=productdetails&p_id=<?php echo $value['TenSP']; ?>" title="<?php echo $value['TenSP']; ?>">
                    <img src="<?php echo $value["HinhAnh"] ?>" alt="<?php echo $value["TenSP"]; ?>" />
                </a>
            </td>
			<td width="356">
				<table width="320" style="border-bottom:1px dashed #c0c0c0;">
					<tr>
					  <td style="text-align:center"><?php echo $value["TenSP"]; ?></td>
					</tr>
                     <tr><td><?php echo  "Giá: " . number_format($value["Gia"], 0, '.', '.') . " VND"; ?></td></tr>
                     <tr><td>Số lượng: <input type="text" class="text_small" value="<?php echo $value['soluong'] ?>" name="<?php echo $key ?>" onkeypress="return keypress(event);"/></td></tr>				
					<tr><td><?php echo "Thành tiền:" . number_format($value["Gia"]*$value["soluong"], 0, '.', '.') . " VND"; ?></td></tr>
              </table>
			</td>
                        <td width="33"><a href="index.php?page=delete_cart&MaSP=<?php echo $key ?>" >Xóa</a></td>
                        
                
          </tr>
  
            <?php
                
                $total += $value["soluong"]*$value["Gia"];
            }
            ?>
          <tr>
                    <td colspan="3">
                         <?php 
                                                      
                         echo "Tổng tiền:" .number_format($total, 0, '.', '.')." VND"; 
                           $_SESSION['Tongtien']=$total;
                         ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table >
                            <tr>
                                <td>
                                    <input class="button_big" type="submit" name="submit" value="Cập nhật" />
                                </td>
                         
                                <td>
                                    <?php
                                    $check = 0;
                                    if(isset($_SESSION['user_login'])) 
                                    {
                                         $check = 1;
                                    }
                                    ?>
                                    <script type="text/javascript">
                                        function chuadangki()
                                        {
                                            if(<?php echo $total ?> > 500000 ){                                           
                                                if(<?php echo $check ?> == 0)
                                                    {
                                                        alert("Gio hang cua ban co tong tien lon hon 500.000 VND \n Xin vui long dang nhap de duoc thanh toan! ");
                                                    }
                                                else
                                                    {
                                                        window.location='index.php?page=order&Tongtien=<?php echo $total ?>';
                                                    } 
                                                }
                                            else
                                                {
                                                     window.location='index.php?page=order&Tongtien={<?php echo $total ?>}';
                                                }
                                           
                                        }
                    
                                 </script>
                                 <input class="button_big" type="button"  name="btnThanhtoan" value="Thanh toán" onclick="chuadangki();" />
                                </td>
                                <td>
                                    <input class="button_big"  type="button" name="btnXoaALL" value="Xóa hết" onclick="window.location='index.php?page=deleteall_cart';"/>
                                </td>
                            </tr>
                        </table>
                    </td>                                                           
                </tr>
                
            <?php //session_unset();  ?>
  
</table>
</form>
           
        </div>
    </div>
</div>
    </body>
