<?php
    include_once ('functions/show_adv.php');
?>
<div id="left_col" class="column">
    <div id="search" class="block">
        <h4>Search</h4>
        <div class="block_content">
            <form id="searchForm" method="GET" action="/search/" onsubmit="return false;">
                <table width="200">
                    <tr>
                        <td colspan="2"><p>Keyword</p>
                        <?php
                            if(isset($_GET['keyword'])){
                                echo "<input type='text' name='keyword' class='searchbykey' value='{$_GET['keyword']}'/>";
                            } else {
                                echo "<input type='text' name='keyword' class='searchbykey' />";
                            }
                        ?>
                        </td>
                    </tr>
                    <tr><td id="advance-search">Advanced Search</td></tr>
                    <tr><td id="collapse">Hide</td></tr>
                    <tr class="hiddenrows">
                        <td colspan="2"><p>Category</p>
                            <?php
                                echo "<select name='category'>";
                                echo "<option value='0'>All</option>";

                                $manu_res = mysql_query("SELECT * FROM vw_nhomsp;") or die ('Không lấy được dữ liệu');

                                if($manu_res && mysql_num_rows($manu_res) > 0){
                                    while($manu_rows = mysql_fetch_array($manu_res)){
                                        if(isset($_GET['category']) && $manu_rows['MaLoai'] == $_GET['category']){
                                            echo "<option value='{$manu_rows['MaLoai']}' name='{$manu_rows['TenLoai']}' selected='selected'>{$manu_rows['TenLoai']}</option>";
                                        } else {
                                            echo "<option value='{$manu_rows['MaLoai']}' name='{$manu_rows['TenLoai']}'>{$manu_rows['TenLoai']}</option>";
                                        }
                                    }
                                }
                                echo "</select>";
                            ?>
                        </td>
                    </tr>
                    <tr class="hiddenrows">
                        <td colspan="2"><p>Price</p>
                            <span>From</span>
                            <?php
                                if(isset($_GET['PriceFrom'])){
                                    echo "<input type='text' name='PriceFrom' class='text_small' value='{$_GET['PriceFrom']}' />";
                                } else {
                                    echo "<input type='text' name='PriceFrom' class='text_small' />";
                                }
                            ?>
                            <span>To</span>
                            <?php
                                if(isset($_GET['PriceTo'])){
                                    echo "<input type='text' name='PriceTo' class='text_small' value='{$_GET['PriceTo']}' />";
                                } else {
                                    echo "<input type='text' name='PriceTo' class='text_small' />";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <span>&nbsp;</span>
                        <input type="submit" onclick="doSearch(window.location.href=this.form.action, this.form.keyword.value, this.form.category.value, this.form.PriceFrom.value, this.form.PriceTo.value);" value="Search" class="button_small" style="margin-right:15px;" /></td>
                    </tr>
                </table>
                <?php
                    $category = "0";
                    if (isset($_GET['category'])) {
                        $category = $_GET['category'];
                    }
                    if($category == "0" && !isset($_GET['PriceFrom']) && !isset($_GET['PriceTo'])){
                        echo "<script type='text/javascript'>
                                $(document).ready(function(){
                                    $('#collapse').hide();
                                    $('#advance-search').show();";
                    } else {
                        echo "<script type='text/javascript'>
                                $(document).ready(function(){
                                    $('#collapse').show();
                                    $('#advance-search').hide();
                                    $('.hiddenrows').show();";
                    }
                    echo "$('#advance-search').click(function(){
                            $(this).fadeOut(500);
                            $('.hiddenrows').fadeIn(800);
                            $('#collapse').fadeIn(600);
                       });

                       $('#collapse').click(function(){
                            $(this).fadeOut(500);
                            $('.hiddenrows').fadeOut(300);
                            $('#advance-search').fadeIn(600);
                       });

                       // validate form
                       $('#searchForm').validate({
                           rules:{f:{digits: true}, t:{digits: true}},
                           messages:{f:{digits: 'You must enter the number'}, t:{digits: 'You must enter the number'}}
                       });
                    });
                </script>";
                ?>
            </form>
        </div><!-- end block content -->
    </div><!--end seacrh block-->
        	<?php
                /*************************
                *       Nhóm sản phẩm    *
                **************************/
                echo "<div id='categories' class='block'>
                        <h4><a href='{$BASE_URL}/products' title='Product'>Product</a></h4>
                        <div class='block_content'>";
                $menu_query = 'SELECT * FROM vw_nhomsp;';
                $menu_result = mysql_query($menu_query) or die ('Không lấy được menu từ cơ sở dữ liệu');
                $n = mysql_num_rows($menu_result); // số menu level 1
                if($menu_result && $n > 0){
                    echo "<ul id='nav'>";

                    while($menu_items = mysql_fetch_array($menu_result)){
                        $sub_query = "SELECT * FROM tbl_loaisp WHERE (MaCha <> MaLoai) AND (MaCha IN (SELECT MaLoai FROM tbl_loaisp WHERE MaCha = {$menu_items['MaCha']}));";
                        $sub_result = mysql_query($sub_query) or die ('Không lấy được menu từ cơ sở dữ liệu');

                        $url_seo = generate_seo_link($menu_items['TenLoai'], '-', true, $bad_words);
                        if($sub_result && mysql_num_rows($sub_result) > 0){
                            echo "<li><span class='close'></span><a href='{$BASE_URL}/products/{$url_seo}' title='{$menu_items['TenLoai']}'>{$menu_items['TenLoai']}</a>";
                            echo "<ul>";
                            while($sub_items = mysql_fetch_array($sub_result)){
                                $url_seo_sub = generate_seo_link($sub_items['TenLoai'], '-', true, $bad_words);
                                echo "<li><a href='{$BASE_URL}/products/{$url_seo_sub}' title='{$sub_items['TenLoai']}'>{$sub_items['TenLoai']}</a></li>";
                            }
                            echo "</ul></li>";
                        }
                        else{// chèn các loaisp không có menu con
                            echo "<li><a href='{$BASE_URL}/products/{$url_seo}' title='{$menu_items['TenLoai']}'>{$menu_items['TenLoai']}</a></li>";
                        }
                    }
                    echo "</ul>";// end div nav
                }

                /* *********************************
                 *  javascript cho menu (jquery)
                 * *********************************/
                echo "<script type='text/javascript'>
                      $(document).ready(function(){";
                //lấy MaLoai
                if (isset($_GET['TenLoai'])) {
                    $TenLoai = $_GET['TenLoai'];
                    $cat_res = mysql_query("SELECT MaLoai FROM tbl_loaisp WHERE LOWER(TenLoai) = '{$TenLoai}';") or die ('ERROR');
                    $cat_name = mysql_fetch_array($cat_res);
                    $_GET['cat_id'] = $cat_name['MaLoai'];
                }
                if(isset($_GET['cat_id'])){
                    $k = $_GET['cat_id'];

                    /* Nếu mã loại vượt quá số Menu level 1
                     * tìm tên loại, dùng jquery tìm ul chứa tên loại
                     */
                    if($k > $n){
                        $submenu_res = mysql_query("SELECT TenLoai FROM tbl_loaisp WHERE MaLoai = {$k}") or die ('Không lấy được menu từ cơ sở dữ liệu');

                        $submenu_name = mysql_fetch_array($submenu_res);
                        $quote = '"';
                        // -> hide các ul khác không chứa tên mà người dùng click vào
                        // add class active cho <a> đứng trước (prev) ul có tên loại
                        // add class open cho <span> đứng trước <a>
                        echo "$({$quote}#nav > li > ul:not(:contains('{$submenu_name['TenLoai']}')){$quote}).hide();
                              $({$quote}#nav > li > ul:contains('{$submenu_name['TenLoai']}'){$quote}).prev().addClass('active');
                              $({$quote}#nav > li > ul:contains('{$submenu_name['TenLoai']}'){$quote}).prev().prev().addClass('open');
                            ";
                    }

                    // ngược lại lấy theo chỉ số
                    else{
                        $k--;
                        echo "$('#nav > li > ul:not(:eq({$k}))').hide();
                            $('#nav > li:eq({$k}) > a').addClass('active');
                            $('#nav > li:eq({$k}) > span').addClass('open');
                                ";
                    }
                }
                // nếu $k chưa tồn tại: hide tất cả các ul level 2
                else{
                    echo "$('#nav > li > ul').hide();";
                }

                // hàm xử lí sự kiện click vào <span> để mở menu
                echo "    $('#nav > li > span').click(function(){
                          $('.open').removeClass('open');
                          $('.active').removeClass('active');
                          $('#nav > li > ul').slideUp('slow');

                            if ($(this).next('a').next('ul').is(':hidden') == true){
								$(this).addClass('open');
                                $(this).next('a').addClass('active');
                                $(this).next('a').next('ul').slideDown('slow');
                            }
                        });
                        $('#nav > li > a').hover(function(){
                            $(this).addClass('on');
                        }, function(){
                            $(this).removeClass('on');
                        });
                    });
                </script>";

                echo "</div>
                    </div><!-- End div categories -->";


                /*************************
                *       Giàm giá         *
                **************************/

                echo "<div id='saleoff' class='block'>
                        <h4><a href='{$BASE_URL}/saleoff' title='Promotional products'>Promotional products</a></h4>
                        <div class='block_content'>
                            <div id='slider'>
                                <ul id='sliderContent'>";

                    $query = "SELECT * FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP AND B.SoThuTu = 0 WHERE KhuyenMai = 1";
                    $result = mysql_query($query);
                    while($rows = mysql_fetch_array($result)){
                        echo "<li class='sliderImage'>";
                            $url_seo = generate_seo_link($rows['TenSP'], '-', true, $bad_words);
                            echo "<a href = '{$BASE_URL}/productdetails/$url_seo-{$rows['MaSP']}.html' title = '{$rows['TenSP']}'>";
                            echo "<img src = '{$BASE_URL}/{$rows['DuongDan']}' alt = '{$rows['TenSP']}'/>";
                            echo "</a>";

                            echo "<span class='bottom'>";
                                  echo "<b>{$rows['TenSP']}</b><br />";
                                  echo "Sale: <s>". number_format($rows['GiaCu'], 0, '.', '.') . " USD</s><br />";
                                  echo "New: <font color='#FF0000'>". number_format($rows['Gia'], 0, '.', '.') . " USD</font>";
                            echo "</span>";
                        echo "<li>";

                    }
                    echo "  <div class='clear sliderImage'></div>
                            </ul>
                          </div><!-- end slide -->
                        </div><!-- end block content -->
                    </div><!--End div saleoff-->";


                /*************************
                *       SP đánh giá cao  *
                **************************/
                echo "<div id='highrating' class='block'>
                        <h4><a href='{$BASE_URL}/highrating' title='The product is highly'>The product is highly</a></h4>
                        <div class='block_content'>
                            <div id='slider2'>
                                <ul id='slider2Content'>";

                    $query = "SELECT * FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP AND B.SoThuTu = 0 ORDER BY Rating DESC LIMIT 0,10;";
                    $result = mysql_query($query);
                    while($rows = mysql_fetch_array($result)){
                        echo "<li class='slider2Image'>";
                            $url_seo = generate_seo_link($rows['TenSP'], '-', true, $bad_words);
                            echo "<a href='{$BASE_URL}/productdetails/$url_seo-{$rows['MaSP']}.html' title='{$rows['TenSP']}'>";
                            echo "<img src='{$BASE_URL}/{$rows['DuongDan']}' alt='{$rows['TenSP']}' />";
                            echo "</a>";

                            echo "<span class='bottom'>
                                    <b>{$rows['TenSP']}</b><br />
                                    Price: ". number_format($rows['Gia'], 0, '.', '.') . " USD<br />
                                    Rating: <b><font color='red'>{$rows['Rating']}</font></b> ({$rows['LuotDanhGia']} lượt đánh giá)
                                 </span></li>";
                    }
                    echo "  <div class='clear slider2Image'></div>
                            </ul>
                        </div><!-- end slide2 -->
                    </div><!-- end block content -->
                </div><!--End div highrating-->";
                ?>
<script type="text/javascript">
        $(document).ready(function() {
            $('#slider').s3Slider({
                timeOut: 3000
            });
            $('#slider2').s3Slider({
                timeOut: 4000
            });
        });
</script>
    <!-- quảng cáo -->
    <?php
        show_adv(1);
    ?>
</div><!-- End Left column-->