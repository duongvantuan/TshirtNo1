<div id="center_col" class="center_col">
    <div id="productdetails" class="center_block">
<?php
    unset($_SESSION['rated']);
    if(isset($_GET['p_id'])){
        $p_id = $_GET['p_id'];
        $query = "SELECT A.*, B.DuongDan, C.TenNhaSX FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP INNER JOIN tbl_nhasx C ON A.MaNhaSX = C.MaNhaSX WHERE A.MaSP = {$p_id}";
        $result = mysql_query($query) or die ("Lỗi truy xuất CSDL");       

        $data = mysql_fetch_array($result);

        $url_seo = generate_seo_link($data['TenSP'], '-', true, $bad_words);
        echo "<h4><a href='#' title='{$data['TenSP']}'>{$data['TenSP']}</a></h4>";
        
        // lấy menu cấp 1
        $query2 = "SELECT * FROM tbl_loaisp WHERE MaCha = MaLoai AND MaCha = (SELECT MaCha FROM tbl_loaisp WHERE MaLoai = {$data['MaLoai']});";
        $result2 = mysql_query($query2) or die ("Lỗi truy xuất CSDL");
        $cat_name = mysql_fetch_array($result2);
        
        // lấy menu cấp 2
        $query3 = "SELECT * FROM tbl_loaisp WHERE MaLoai = {$data['MaLoai']};";
        $result3 = mysql_query($query3) or die ("Lỗi truy xuất CSDL");
        $cat_name2 = mysql_fetch_array($result3);
        
        // hiển thị link sản phẩm
        echo "<div class='center_block_content'>
                <div class='link'>
                    <a title='Back to home page' href='index.php?page=home'>Home</a>
                    <span>></span>
                    <a title='{$cat_name['TenLoai']}' href='index.php?page=products&cat_id={$cat_name['MaLoai']}'>{$cat_name['TenLoai']}</a>
                    <span>></span>
                    <a title='{$cat_name2['TenLoai']}' href='index.php?page=products&cat_id={$cat_name2['MaLoai']}'>{$cat_name2['TenLoai']}</a>
                    <span>></span>
                    {$data['TenSP']}<!-- tên sản phẩm -->";
        echo "</div><!-- end link -->
            <div id='primary_block' class='clearfix'>
                <div id='product_left_col'>
                    <div id='image_block'>";        
        // lấy ảnh sp
        $queryImg = "SELECT * FROM tbl_hinhanh WHERE MaSP = {$p_id} ORDER BY (DuongDan) DESC;";        
        $resultImg = mysql_query($queryImg) or die ("Không lấy được hình ảnh sản phẩm.");
        $countImg = mysql_num_rows($resultImg); // số ảnh lấy được
        while($rowsImg = mysql_fetch_array($resultImg)){
            echo "<a title='{$data['TenSP']}' href='{$BASE_URL}/{$rowsImg['DuongDan']}' id='productImageWrapID_{$data['MaSP']}'><img id='bigpic' alt='{$data['TenSP']}' title='{$data['TenSP']}' src='{$BASE_URL}/{$rowsImg['DuongDan']}' /></a>";            
        }
        echo "</div><!-- end image_block -->
                <ul id='thumbs'>";
        
        $queryImg = "SELECT * FROM tbl_hinhanh WHERE MaSP = {$p_id} ";
        // lấy ảnh thumbmnails khác
        $queryThumbs = $queryImg . "AND SoThuTu = 0;"; // lấy ảnh thumb đầu tiên, có class active (ảnh chính)
        $resultThumbs = mysql_query($queryThumbs) or die ("Không lấy được ảnh sản phẩm");
        $firstThumb = mysql_fetch_array($resultThumbs);
        echo "<li class='active' rel='1'><img src='{$BASE_URL}/{$firstThumb['DuongDan']}'/></li>";
        // từ ảnh thumb thứ 2 trở đi.
        $i = 2;
        $queryThumbs = $queryImg . "AND SoThuTu > 0 ORDER BY (DuongDan) DESC;"; // ảnh phụ
        $resultThumbs = mysql_query($queryThumbs) or die ("Không lấy được ảnh sản phẩm");
        while($thumbs = mysql_fetch_array($resultThumbs)){
            echo "<li rel='{$i}'><img src='{$BASE_URL}/{$thumbs['DuongDan']}'/></li>";
            $i++; 
        }           
        
        echo "</ul><!-- end views_block -->
        <p>Click on the large image to view full size</p>
        </div><!-- end product_left_col -->";
    }
?>

    <!-- Javascript show ảnh lớn khi hover qua ảnh thumbnail -->
    <script type="text/javascript">
        var currentImage; // Ảnh hiện tại đang show
        var currentIndex = -1; // Vị trí ảnh hiện tại
    
        function showImage(index){ // Hàm show ảnh lớn, INPUT: Chỉ số của ảnh thumnails
                                    // nếu chưa hết số ảnh đang có
            if(index < $('#image_block img').length){
                var indexImage = $('#image_block img')[index] // lấy chỉ số của ảnh lớn trong div #image_block
    
            if(currentImage){
                if(currentImage != indexImage ){ // nếu ảnh hiện tại có chỉ số khác với ảnh thumbnail hover qua
                    $(currentImage).css('z-index',2);
    
                    $(currentImage).fadeOut('slow', function() {// thì tắt ảnh hiện tại đi
                        $(this).css({'display':'none','z-index':1})
                    });
                }
            }
            $(indexImage).css({'display':'block', 'opacity':1});
            currentImage = indexImage; // chuyển ảnh có chỉ số tương ứng với ảnh thumbnail
            currentIndex = index; // đặt chỉ số mới
            $('#thumbs li').removeClass('active'); // remove class active ở ảnh thumbnail cũ
            $($('#thumbs li')[index]).addClass('active'); // và add class active cho ảnh thumbnail có index tương ứng 
            }
        }
    
        function showNext(){
            var len = $('#image_block img').length;
            var next = currentIndex < (len-1) ? currentIndex + 1 : 0;
            showImage(next);
        }
    
        $(document).ready(function() {
            showNext(); //load ảnh đầu tiên
            // bắt sự kiện hover ảnh thumbnails
            $('#thumbs li').bind('click',function(e){                    
                    var count = $(this).attr('rel'); // lấy chỉ số ảnh thumbnail [qua thuộc tính rel]
                    showImage(parseInt(count)-1);// gọi hàm showImage
            });
        });
        
        // Click vào ảnh lớn -> Zoom [plugin jQueryLightBox]
        $(function() {
            $('#image_block a').lightBox();
        });
    </script>

            <div id="product_right_col">
                <div style="position: absolute; margin-left: 275px; margin-top: 39px;">
                    <img style="width:120px;" src="<?php echo BASE_URL; ?>/images/bestselling.png"/><br>
                    <img style="width:200px;margin-top:10px;margin-left: -50px;" src="<?php echo BASE_URL; ?>/images/100USA.png"/>
                </div>
                <form action="index.php?page=cart" method="POST">
                    <table width="200">
                        <tr>
                            <td><p>Price:</p></td>
                            <td>
                                <?php
                                    // nếu sp đang khuyến mại 
                                    if($data['KhuyenMai'] == 1){
                                        echo "<span><s>" . $data['GiaCu'] . " USD</s></span><br />";
                                        
                                    }
                                    echo "<span class='cost'>" . $data['Gia'] . " USD</span>";
                                ?>                                
                            </td>
                        </tr>
                        <tr>
                            <td><p>Warranty:</p></td>
                            <td><span><?php echo "{$data['BaoHanh']} month";?></span></td>
                        </tr>
                        <tr>
                            <td><p>Colors:</p></td>
                            <td><span><?php echo "{$data['MauSac']}";?></span></td>
                        </tr>                        
                        <tr>
                            <td><p>Made In:</p></td>
                            <td><span><?php 
                                if($data['MaNhaSX'] == 1){
                                    echo "Not update";
                                }
                                else{
                                    echo "{$data['TenNhaSX']}";
                                }
                            ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class='buy-btn'><a target='_blank' href='<?php echo "{$data["LinkSun"]}"; ?>' class='button_big' name='buy_btn''><span class='buy_now' style='padding-left: 23px;'>Buy Now</span></a></div>
                                <?php
                                    if($data['SPMoi'] == 1){
                                        echo "<img src='{$BASE_URL}/images/new-icon.png' alt='Sản phẩm mới' />";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Reviews of this product<br />
                                <ul id="rating" class="<?php echo "{$p_id}"; ?>">
                                    <li><a href="#" title="Very bad"></a></li>
                                    <li><a href="#" title="bad"></a></li>
                                    <li><a href="#" title="Normally"></a></li>
                                    <li><a href="#" title="Good"></a></li>
                                    <li><a href="#" title="Very good"></a></li>
                                </ul>
                                <span id="cur-rate"><?php echo "{$data['Rating']} ({$data['LuotDanhGia']} votes)<br />";?></span>
                                <span id="message-rating" style="font-size: 11px; font-weight: normal;">Thank you for your vote products</span>
                            </td>
                        </tr>                        
                    </table>
                </form>    
                </div><!-- end product_right_col -->
            </div><!-- end primary_block -->
            <div id="description"><span>Product description</span>
                <p><?php echo "{$data['MoTa']}";?></p>
            </div>
        </div><!-- end center_block content -->
    </div><!-- end productdetails block -->
    <div id="comment" class="center_block">
        <h4>Customer comments</h4>
        <div class="center_block_content">
        <?php
            if(isset($_POST['submit_productdetails'])){
                    $title = $_POST['title'];
                    $fullname = $_POST['fullname'];
                    $tel = $_POST['telephone'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $feedback = $_POST['feedback'];
                    mysql_query('SET NAMES utf8');
                    $query = "INSERT INTO tbl_gopy(TieuDe, HoTen, DienThoai, Email, DiaChi, NoiDung, NgayGopY) VALUES                 ('$title','$fullname','$tel','$email','$address', '$feedback',NOW());";
                    mysql_query($query);
                    header('location:index.php?page=success&q=3');                    
                }
            
        ?>        
            <form action="" method="POST" id="productdetailsFrom">
                <table width="500">
                    <tr>
                        <td colspan="2"><span>Thank you for your interest in this product, Please leave these reviews, his perception of the product.</span></td>
                    </tr>
                    <tr>
                        <td><font color="red">*</font>Title:</td>
                        <td><input type="text" name="title" class="text_big" /></td>
                    </tr>                    
                    <tr>
                        <td><font color="red">*</font>Full name :</td>
                        <td><input type="text" name="name" class="text_big" /></td>
                    </tr>
                    <tr>
                        <td>Điện thoại:</td>
                        <td>
                            <input type="text" class="text_big" name="telephone" onkeyup="check_phone(this.value)" />
                            <p id="message_phone" class="error"></p>
                        </td>
                    </tr>                    
                    <tr>
                        <td><font color="red">*</font>Email:</td>
                        <td><input type="text" name="email" class="text_big" /></td>
                    </tr>
                    <tr valign="top">
                        <td>Địa chỉ:</td>
                        <td><textarea name="address" class="txt"></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top"><font color="red">*</font>Message :</td>
                        <td>
                            <textarea name="feedback" id="feedback" class="txt"></textarea>
                            <p id="message" class="error"></p>
                        </td>
                    </tr>
                    <?php 
                        include_once('include/captcha.php');
                    ?>
                    <tr align="left">
                        <td colspan="2">
                            <input type="submit" name="send_cmt" value="Send" class="button_big" id="submit"/>
                            <input type="reset" name="reset_cmt" value="Reset" class="button_big"/>
                        </td>                        
                    </tr>
                </table>
            </form>
            <script type="text/javascript">
            
                $(document).ready(function(){
                    
                    $('#message').hide();
                    
                    // đếm số ký tự trong feedback
                    $('#feedback').keyup(function(){
                       var len = this.value.length;
                                              
                       $('#message').fadeIn(100);
                       $('#message').html("Your message there: " + len + " characters remaining: " + (800 - len) + " the characters.");
                         return len;                        
                    });
                    

                    
                    $("#productdetailsFrom").validate({
                        rules: {title:{required: true, minlength: 10}
                               ,telephone: {digits: true}
                               ,email:{required: true, email: true}
                               ,fullname:{required: true, minlength: 5}
                               ,feedback:{required: true, minlength: 10, maxlength:800}},
                        messages:{title:{required: "Please enter title.", minlength: "Your headline is too short, a minimum of 10 characters"}
                                 ,telephone: {digits: "You must enter the number"}
                                 ,email:{required:"Please fill in your Email.", email:"You must enter the number."}
                                 ,fullname:{required: "Please fill in your name", minlength:"They must name a minimum of 5 characters."}
                                 ,feedback:{required: "You have written a message", minlength: "The content is too short, a minimum of 10 characters.", maxlength:"The content is too long, maximum 800 characters"}}
                    });
                });
                
                // check số điện thoại
                function check_phone(str_phone){
                    if(str_phone != ''){
                        if(/^[0][1-9][0-9]{8,9}$/.test(str_phone)){
                            $('#message_phone').hide();

                        }else{
                            $('#message_phone').html("The phone number is invalid");
                            $('#message_phone').show();
                        }
                    }
                };
            </script>
        </div><!-- end center block content -->
    </div><!--end comment product -->
    <!-- sản phẩm liên quan -->
    <div id="other_product" class="center_block">
        <?php 
            include_once('functions/show_product.php');
            $h4 = 'Related products';
            $other_products_query = "SELECT A.*, B.DuongDan FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP  WHERE A.MaLoai = {$cat_name2['MaLoai']} AND B.SoThuTu = 0 ";
            show_product($other_products_query, $h4, "{$BASE_URL}/productdetails/{$url_seo}-{$p_id}",6, 3);
        ?>
    </div><!--end other_product product -->    
</div><!-- end center column -->   