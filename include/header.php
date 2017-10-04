<a id="header_logo" href="<?php echo BASE_URL; ?>" title="Home Tshirt No 1 - The best online store">
    <img src="<?php echo BASE_URL; ?>/images/logo.png" alt="Home Tshirt No 1 - The best online store" />
</a>
<!-- Menu -->
<ul id="header_links">
    <li class="home"><a class="home" href="<?php echo BASE_URL; ?>" title="Home Tshirt No 1">Home</a></li>
    <!-- drop down menu sản phẩm -->
    <?php
        echo "<li class='products' id='dropdown'>
                <a class='products' href='$BASE_URL/products'>Product &darr;</a>";
        // lấy menu cấp 1
        $menu_query = 'SELECT * FROM vw_nhomsp;';
        $menu_result = mysql_query($menu_query) or die ('Không lấy được menu từ cơ sở dữ liệu');

        if($menu_result && mysql_num_rows($menu_result) > 0){
            echo "<ul>";

            while($menu_items = mysql_fetch_array($menu_result)){
                // lấy menu cấp 2
                $sub_query = "SELECT * FROM tbl_loaisp WHERE (MaCha <> MaLoai) AND (MaCha IN (SELECT MaLoai FROM tbl_loaisp WHERE MaCha = {$menu_items['MaCha']}));";
                $sub_result = mysql_query($sub_query) or die ('Không lấy được menu từ cơ sở dữ liệu');

                $url_seo = generate_seo_link($menu_items['TenLoai'], '-', true, $bad_words);
                if($sub_result && mysql_num_rows($sub_result) > 0){
                    echo "<li><a href='{$BASE_URL}/products/{$url_seo}'>{$menu_items['TenLoai']} &raquo;</a>";
                    echo "<ul>";
                    while ($sub_items = mysql_fetch_array($sub_result)){
                        $url_seo_sub = generate_seo_link($sub_items['TenLoai'], '-', true, $bad_words);
                        echo "<li><a href='{$BASE_URL}/products/{$url_seo_sub}'>{$sub_items['TenLoai']}</a></li>";
                    }
                    echo "</ul></li>";
                }
                else{
                    echo "<li><a href='{$BASE_URL}/products/{$url_seo}'>{$menu_items['TenLoai']}</a></li>";
                }
            }
            echo "</ul>";
        }
        // end dropdown menu
        echo "</li>";
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
           $("#dropdown").hover(function(){
                $(this).find('ul:first').css({visibility: "visible", display: "none"}).show(500);
           }, function(){
                $(this).find('ul:first').css({visibility: "hidden"});
           });
            $("#dropdown ul li").hover(function(){
               $(this).find('ul:first').css({visibility: "visible",display: "none"}).show(500);
            }, function(){
                $(this).find('ul:first').css({visibility: "hidden"});
        });
        });
    </script>
    <li class="info"><a class="info" href="<?php echo $BASE_URL; ?>/introduction" title="Information">Introduction</a></li>
    <li class="checkout"><a class="checkout" href="<?php echo $BASE_URL; ?>/payment" title="Payment">Payment</a></li>
    <li class="sitemap"><a class="sitemap" href="<?php echo $BASE_URL; ?>/sitemap" title="Site map">Site map</a></li>
    <li class="contact"><a class="contact" href="<?php echo $BASE_URL; ?>/contact" title="Contact">Contact</a></li>
    <?php
       if(isset($_SESSION["admin_login"])) {
           echo "<li class='item'><a title='Log in to the control page' href='admin/admin.php'>Admin</a></li>";
       }
    ?>
</ul>
