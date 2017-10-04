<div id="center_col" class="center_col">
    <div id="sitemap" class="center_block">
        <h4>Site map</h4>
        <div class="center_block_content">
                <?php
                    echo "<div class='cat_tree'>
                            <h3>CATALOG OF PRODUCTS</h3>
                            <div class='tree_top'>
                                <a href='index.php?page=home' title='Home'>Home</a>
                            </div><ul class='tree'>";
                    
                    $menu_query = 'SELECT * FROM vw_nhomsp;';
                    $menu_result = mysql_query($menu_query) or die ('Không lấy được menu từ cơ sở dữ liệu');
                    // số menu level 1
                    $n = mysql_num_rows($menu_result);
                    
                    if($menu_result && $n > 0){
                        // $k dùng để kiểm tra menu có là li cuối cùng không
                        $k = 0;
                        while($menu_items = mysql_fetch_array($menu_result)){                            
                                                        
                            // lấy menu cấp 2
                            $sub_query = "SELECT * FROM tbl_loaisp WHERE (MaCha <> MaLoai) AND (MaCha IN (SELECT MaLoai FROM tbl_loaisp WHERE MaCha = {$menu_items['MaCha']}));";
                            $sub_result = mysql_query($sub_query) or die ('Không lấy được menu từ cơ sở dữ liệu');
                            $m = mysql_num_rows($sub_result); // số menu cấp 2
                            
                            $url_seo = generate_seo_link($menu_items['TenLoai'], '-', true, $bad_words);
                            if($sub_query && $m > 0){
                                $t = 0; // kiểm tra li cấp 2 có là cuối cùng không
                                
                                $k++;// tăng $k
                                // nếu là li cuối thì thêm class = 'last'
                                if($k == $n){
                                    echo "<li class='last'><a href='{$BASE_URL}/products/{$url_seo}' title='{$menu_items['TenLoai']}'>{$menu_items['TenLoai']}</a>";
                                    echo "<ul>";
                                }
                                else{
                                    echo "<li><a href='{$BASE_URL}/products/{$url_seo}' title='{$menu_items['TenLoai']}'>{$menu_items['TenLoai']}</a>";
                                    echo "<ul>";                                    
                                }
                                                                
                                
                                while($sub_items = mysql_fetch_array($sub_result)){
                                    $t++;
                                    $url_seo_sub = generate_seo_link($sub_items['TenLoai'], '-', true, $bad_words);
                                    if($t == $m){
                                        echo "<li class='last'><a href='{$BASE_URL}/products/{$url_seo_sub}' title='{$sub_items['TenLoai']}'>{$sub_items['TenLoai']}</a></li>";
                                    }
                                    else{
                                        echo "<li><a href='{$BASE_URL}/products/{$url_seo_sub}' title='{$sub_items['TenLoai']}'>{$sub_items['TenLoai']}</a></li>";
                                    }
                                }
                                echo "</ul></li>";
                            }
                            else{
                                $k++;
                                // nếu là li cuối thì thêm class = 'last'
                                if($k == $n){
                                    echo "<li class='last'><a href='{$BASE_URL}/products/{$url_seo}' title='{$menu_items['TenLoai']}'>{$menu_items['TenLoai']}</a></li>";
                                }
                                else{
                                    echo "<li><a href='{$BASE_URL}/products/{$url_seo}' title='{$menu_items['TenLoai']}'>{$menu_items['TenLoai']}</a></li>";
                                }
                            }                            
                        }
                    }                    
                    echo "</ul>
                    </div><!-- end cat_tree -->";                
                ?>                
        </div><!-- end block content -->
    </div><!-- end info block -->
</div><!-- end center_col -->