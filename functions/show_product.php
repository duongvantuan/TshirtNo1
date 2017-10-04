<?php

      // hiển thị sản phẩm:
      /*
       * @query: câu lệnh truy vấn
       * @h4: tiêu đề cho block
       * @rows_per_page :số bản ghi hiển thị trên 1 trang
       * @pages_per_segment: số trang mỗi phân đoạn
       */
      function show_product($query, $h4, $self, $rows_per_page = 18, $pages_per_segment = 5){
        mysql_query("SET NAMES UTF8;");
        $results = mysql_query($query);
        // số bản ghi lấy được
        $records = mysql_num_rows($results);
        $BASE_URL = BASE_URL;
        $bad_words = array('a','and','the','an','it','is','with','can','of','why','not');

        // Tổng số trang = tổng số dòng / số dòng trên 1 trang
        $totalpages = ceil($records / $rows_per_page);
        // tổng số phân đoạn = tổng số trang / số trang trên 1 phân đoạn
        $totalsegments = ceil($totalpages / $pages_per_segment);

        // trang hiện tại
        if(isset($_GET['p'])){
            $current_page = intval($_GET['p']);
        }
        else{ // Người dùng không chọn thì mặc định là trang 1
            $current_page = 1;
        }

        // phân đoạn hiện tại: trang hiện tại / số trang 1 phân đoạn
        $current_segment = ceil($current_page / $pages_per_segment);

        // trang bắt đầu
        $start_page = ($current_page - 1) * $rows_per_page;

        // nối chuỗi -> query LIMIT
        $query .= "LIMIT {$start_page}, {$rows_per_page};";
        $results = mysql_query($query) or die('<div class="center_block_content"><font color="red"><b>Lỗi truy xuất CSDL</b></font></div>');

        // in thẻ <h4>
        echo "<h4 title='{$h4}'>{$h4}</h4>";
        echo "<div class='center_block_content'><ul>";

        // xuất CSDL
        if($results && mysql_num_rows($results) > 0){
          while($rows = mysql_fetch_array($results)){
              echo "<li><div class='product'>";

              $url_seo = generate_seo_link($rows['TenSP'], '-', true, $bad_words);
              echo "<a class='product_image screenshot' href='{$BASE_URL}/productdetails/$url_seo-{$rows['MaSP']}.html' title='{$rows['TenSP']}' rel='{$BASE_URL}/{$rows['DuongDan']}' id='productImageWrapID_{$rows['MaSP']}'>
                        <img src='{$BASE_URL}/{$rows['DuongDan']}' alt='{$rows['TenSP']}' />
                    </a>
                    <h5><a href='{$BASE_URL}/productdetails/$url_seo-{$rows['MaSP']}.html' title='{$rows['TenSP']}'>{$rows['TenSP']}</a></h5>";

              // nếu sp không khuyến mại và không mới
              if($rows['KhuyenMai'] == 0 && $rows['SPMoi'] == 0){

                echo "<span class='price'>" . $rows['Gia'] . " USD</span>";

              }
              else{// nếu sp đang khuyến mại và không mới
                if($rows['KhuyenMai'] == 1 && $rows['SPMoi'] == 0){
                    echo "<img src='{$BASE_URL}/images/saleoff-icon.png' class='saleoff' alt='Promotion' /><span class='saleoff'>" . $rows['GiaCu'] . " USD</span>";
                    echo "<span class='price'>" . $rows['Gia'] . " USD</span>";
                }
                else{
                    // nếu không khuyến mại và mới
                    if($rows['KhuyenMai'] == 0 && $rows['SPMoi'] == 1){
                        echo "<img src='{$BASE_URL}/images/new-icon.png' class='new' alt='New' />";
                        echo "<span class='price'>" . $rows['Gia'] . " USD</span>";
                    }
                    // vừa khuyến mại, vừa mới
                    else{
                        echo "<img src='{$BASE_URL}/images/new-icon.png' class='new' alt='New' />";
                        echo "<img src='{$BASE_URL}/images/saleoff-icon.png' class='saleoff' alt='Promotion' /><span class='saleoff'>" . $rows['GiaCu'] . " USD</span>";
                        echo "<span class='price'>" . $rows['Gia'] . " USD</span>";
                    }
                }
              }

              echo "<div class='buy-btn'><a target='_blank' class='button_big' href='{$rows["LinkSun"]}' name='buy_btn'><span class='buy_now' style='padding-left: 3px;'>Buy Now</span></a></div></div></li>";
          }
            echo "</ul><div id='paging'>";
            //Xuất số trang bên dưới để người dùng chọn ==> thực hiện hành động truyền tham số cho p
            // Lấy địa chỉ hiện tại
            $sPage = "";

            // nếu không phải là phân đoạn đầu tiên
            if($current_segment - 1 != 0){
                $sPage .= "<a href='{$self}/page-1.html'> « </a>&nbsp;";
                $sPage .= "<a href='{$self}/page-" . (($current_segment -1) * $pages_per_segment) .".html'> ‹ </a>&nbsp;";
            }

            $count = ($totalpages <= $current_segment * $pages_per_segment) ? ($totalpages - ($current_segment - 1) * $pages_per_segment) : $pages_per_segment;

            for($i = 1; $i <= $count; $i++){
                $page = ($current_segment - 1) * $pages_per_segment + $i;
                $sPage .= "<a href ='{$self}/page-" . $page . ".html' " . (($page == $current_page) ? "class='current-page'" : "") . " >" . ($page) . "</a>&nbsp;";
            }

            // nếu không phải phân đoạn cuối
            if($current_segment < $totalsegments){
                $sPage .= "<a href = '{$self}/page-" . (($current_segment) * $pages_per_segment + 1) . ".html'> › </a>&nbsp;";
                $sPage .= "<a href = '{$self}/page-" . ($totalpages) . ".html'> » </a>&nbsp;";
            }
            echo $sPage;
            echo "</div><!-- end paging -->
                </div><!-- end center block content -->";
        }
        else{ // nếu k có sp
            echo '<font color="#207FAB"><b>The category you selected is not empty :(</b>
                            <br /><br />
                            We will update the new product in the shortest time.
                        </font></ul></div>';
        }
    }// end function show_products
?>