<div id="center_col" class="center_col">
    <div id="frame" class="center_block">
        <h4>Thanh toán</h4>
        <div class="center_block_content"> 
             <form id="order-form" action="index.php?page=save_order" method="POST">
                 <p id="frame_header" >Thông tin đơn hàng</p>
                 <?php
                     $check = 0;
                     $_SESSION['id_khach'] = 0;
                     if(isset($_SESSION['username'])){
                        $check = 1;                   
                        $us = $_SESSION['username'];
                        
                        $sql = "SELECT * FROM tbl_thanhvien WHERE UserName = '$us';";
                        $result = mysql_query($sql) or die("loi co so du lieu");
                        $row =  mysql_fetch_array($result);
                        
                        $_SESSION['id_khach'] = $row['MaTV'];
                    }
                
             ?>
              <table width="100%">
                    <tr>
                        <td colspan="2">Bạn phải điền đầy đủ các trường có dấu <font color='red'>*</font></td>
                    </tr>                        
                    <tr>
                        <td><font color='red'>*</font>Tên người nhận</td>
                        <td><input class="text_big" type="text" name="tennguoinhan"  /></td>
                    </tr>
                    <tr>
                        <td><font color='red'>*</font>Email người nhận</td>
                        <td><input class="text_big" type="text" name="emailnguoinhan" /></td>
                    </tr>
                    <tr>
                        <td><font color='red'>*</font>Số điện thoại</td>
                        <td><input class="text_big" type="text" name="sodienthoainhanhang" onkeyup="check_phone(this.value)" />
                        <p id="message_phone" class="error"></p>
                        </td>
                    </tr>
                    <tr>
                        <td><font color='red'>*</font>Địa chỉ người nhận</td>
                        <td><textarea class="txt" name="diachinhanhang"></textarea></td>
                    </tr>                    
                    <tr>
                        <td>Ghi chú</td>
                        <td><textarea class="txt" name="ghichu" width="200px" ></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" align='center'><input type="submit" class="button_big" name="button" value="Đặt hàng" style="margin:0 20px 0 100px; float:left;" />
                            <input type="reset" value="Nhập lại" class="button_big" />
                        </td>
                    </tr>
                </table>
             </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#order-form").validate({
        rules: {tennguoinhan:{required: true, minlength: 5}
               ,emailnguoinhan:{required: true, email: true}
               ,sodienthoainhanhang:{required: true, digits: true, minlength: 10, maxlength: 11}               
               ,diachinhanhang:{required: true, minlength: 5}},
        messages:{tennguoinhan:{required: "Vui lòng điền tên đầy đủ của người nhận", minlength: "Cần có tối thiểu 5 kí tự."}
                 ,emailnguoinhan:{required:"Vui lòng điền Email của người nhận", email:"Địa chỉ email không chính xác."}
                 ,sodienthoainhanhang:{required: "Vui lòng điền số điện thoại của người nhận", digits: "Bạn phải điền số", minlength: "Tối thiểu 10 số", maxlength: "Tối thiểu 11 số"}
                 ,diachinhanhang:{required: "Vui lòng điền địa chỉ nhận hàng", minlength:"Cần có tối thiểu 5 kí tự."}}
    });
    
    // check số điện thoại
    function check_phone(str_phone){
        if(str_phone != ''){
            if(/^[0][1-9][0-9]{8,9}$/.test(str_phone)){
                $('#message_phone').hide();

            }else{
                $('#message_phone').html("Số điện thoại không hợp lệ");
                $('#message_phone').show();
            }
        }                            
    };
</script>