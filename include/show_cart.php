<div id="center_col" class="center_col">
    <div id="frame" class="center_block">
        <h4>Chi tiết giỏ hàng</h4>
        <div class="center_block_content"> 
            <form name="form_cart2" method="GET" id="shoping_cartform" action="update_cart.php">
	           <p id="frame_header" ><img src="<?php echo BASE_URL; ?>/images/cart.png" alt="Giỏ hàng của bạn" />&nbsp;&nbsp;Giỏ hàng của bạn</p>
<script type="text/javascript">
                function keypress(e){
                    var keypressed = null;
                    if (window.event){
                        keypressed = window.event.keyCode;
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
        
        <table width="480" style="background-color:white;" >
    <?php
   
    if(!isset($_SESSION['cart'])){
        echo "<h3>Không có hàng trong giỏ</h3>";       
        $check2=0;
    }else
    {
        $check2=1;
        $total=0;
        foreach ($_SESSION["cart"] as $key => $value){ 
    ?>
    
                <tr>
 			<td width="90"><img src="<?php echo $value["HinhAnh"]; ?>" /></td>
			<td width="322">
				<table width="300" style="border-bottom:1px dashed #c0c0c0;">
					<tr>
					  <td style="text-align:center"><?php echo $value["TenSP"]; ?></td>
					</tr>
                    <tr><td><?php echo  "Giá: " . number_format($value["Gia"], 0, '.', '.') . " VND"; ?></td></tr>
                    <tr><td>Số lượng: <input class="text_small" type="text" value="<?php echo $value["soluong"] ?>" name="<?php echo $key ?>" onkeypress="return keypress(event);" /></td></tr>				
					<tr><td><?php echo "Thành tiền:" . number_format($value["Gia"]*$value["soluong"], 0, '.', '.') . " VND"; ?></td></tr>
                                </table>
			</td>
                        <td width="32"><a href="index.php?page=delete_cart&p_id=<?php echo $key ?>" >Xóa</a></td>
                </tr>
  
            <?php
            
                           
                               $total += $value["soluong"]*$value["Gia"];
                             
                           
                }
            
            ?>
                <tr>
                    <td colspan="2">
                         <?php 
                                                                         
                              
                         echo "Tổng tiền: " .number_format($total,0,'.','.')." VND"; 
           }
                         ?>
                    </td>
                    <td>
                        <?php 
                            if(isset($_SESSION['cart'])){
                                echo  "<a href='index.php?page=products' id='buy-cont'>Mua tiếp</a>";
                            }  
                       ?>
                    </td>
                </tr>
                
               <tr  >    
                    
                    <td colspan="3">
                        <table >
                            <tr>
                                <td>
                                    <input class="button_big" type="submit" name="submit" value="Cập nhật"  />
                                </td>
                         
                                <td>
                                    <?php
                                    $check = 0;
                                    if(isset($_SESSION['user_login'])){
                                         $check = 1;
                                    }
                                    ?>
                                    <script type="text/javascript">
                                        function chuadangki()
                                        {
                                            if(<?php echo $check2?> == 1 )
                                            {
                                                if(<?php echo $total ?> > 500000){                                           
                                                    if(<?php echo $check ?> == 0)
                                                        {
                                                            alert("Giỏ hàng của bạn có tổng tiền lớn hơn 500.000 VND \n \t\tXin vui lòng đăng nhập để thanh toán! ");
                                                        }
                                                    else
                                                        {
                                                            window.location='index.php?page=order';
                                                        } 
                                                    }
                                                else if(<?php echo $total ?>==0)
                                                    {
                                                        alert("Bạn chưa có sản sản phẩm nào trong giỏ");
                                                    }
                                                    else
                                                    {
                                                        window.location='index.php?page=order';
                                                    }
                                           
                                         }
                                         else
                                         {
                                            alert("Bạn chưa có sản sản phẩm nào trong giỏ");
                                         }
                                        }
                    
                                 </script>
                                 <input class="button_big" style="float: left;" type="button" name="btnThanhtoan" value="Thanh toán" onclick="chuadangki();"/>
                                </td>
                                <td>
                                    <input class="button_big"  type="button" name="btnXoaALL" value="Xóa hết" onclick="window.location='index.php?page=deleteall_cart';"/>
                                </td>
                            
                        </table>
                        
                    </td>                                                           
                </tr>          
  
            </table>
        </form>
           
        </div>
    </div>
</div>
