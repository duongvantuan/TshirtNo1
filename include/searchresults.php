<?php
    include_once 'functions/show_product.php';

    echo "<div id='center_col' class='center_col'>
            <div id='products' class='center_block'>";
    $h4 = 'Search results';
    $query = "SELECT A.*, B.DuongDan FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP AND B.SoThuTu = 0 ";
    if(isset($_GET['keyword']) && $_GET['keyword'] != ''){
        $keyword = $_GET['keyword'];
        if(isset($_GET['category'])){
           $manufacture = $_GET['category'];
           // nếu cả 3 input được điền
           if(isset($_GET['PriceFrom']) && isset($_GET['PriceTo']) && $_GET['PriceFrom'] != '' && $_GET['PriceTo'] != ''){
               $costfrom = $_GET['PriceFrom'];
               $costto = $_GET['PriceTo'];
               // nếu chọn tất cả nhà sx
               if($manufacture == 0){
                    $query .= "WHERE A.TenSP LIKE '%{$keyword}%' AND A.Gia BETWEEN {$costfrom} AND {$costto} ";
               }
               else{
                    $query .= "WHERE A.TenSP LIKE '%{$keyword}%' AND A.MaLoai IN (SELECT MaLoai FROM tbl_loaisp WHERE MaCha = {$manufacture}) AND A.Gia BETWEEN {$costfrom} AND {$costto} ";
               }
               show_product($query, $h4, "{$BASE_URL}/search/keyword={$keyword}&category={$manufacture}&PriceFrom={$costfrom}&PriceTo={$costto}");
           } else { // tìm theo keyword và nhà sx
               // nếu chọn tất cả nhà sx
               if($manufacture == 0){
                   $query .= "WHERE A.TenSP LIKE '%{$keyword}%' ";
               }
               else{
                   $query .= "WHERE A.TenSP LIKE '%{$keyword}%' AND A.MaLoai IN (SELECT MaLoai FROM tbl_loaisp WHERE MaCha = {$manufacture}) ";
               }
               show_product($query, $h4, "{$BASE_URL}/search/keyword={$keyword}&category={$manufacture}");
           }
        } else { // tìm theo keyword và giá
           if(isset($_GET['PriceFrom']) && isset($_GET['PriceTo']) && $_GET['PriceFrom'] != '' && $_GET['PriceTo'] != '') {
               $costfrom = $_GET['PriceFrom'];
               $costto = $_GET['PriceTo'];
               $query .= "WHERE A.TenSP LIKE '%{$keyword}%' AND A.Gia BETWEEN {$costfrom} AND {$costto} ";
               show_product($query, $h4, "{$BASE_URL}/search/keyword={$keyword}&PriceFrom={$costfrom}&PriceTo={$costto}");
           }
           // chỉ tìm theo từ khóa
           else{
               $query .= "WHERE A.TenSP LIKE '%{$keyword}%' ";
               show_product($query, $h4, "{$BASE_URL}/search/keyword={$keyword}");
           }
        }
    } else { // trường hợp không điền keyword
        if(isset($_GET['category'])){
            $manufacture = $_GET['category'];
            // nếu tìm theo nhà sx và giá
            if(isset($_GET['PriceFrom']) && isset($_GET['PriceTo']) && $_GET['PriceFrom'] != '' && $_GET['PriceTo'] != ''){

               $costfrom = $_GET['PriceFrom'];
               $costto = $_GET['PriceTo'];

               // nếu tìm tất cả nhà sx
               if($manufacture == 0){
                   $query .= "WHERE A.Gia BETWEEN {$costfrom} AND {$costto} ";
               }
               else{
                   $query .= "WHERE A.MaLoai IN (SELECT MaLoai FROM tbl_loaisp WHERE MaCha = {$manufacture}) AND A.Gia BETWEEN {$costfrom} AND {$costto} ";
               }
               show_product($query, $h4, "{$BASE_URL}/search/keyword=&category={$manufacture}&PriceFrom={$costfrom}&PriceTo={$costto}");
           } else { // chỉ tìm nhà sx
               if($manufacture != 0){ 
                   $query .= "WHERE A.MaLoai IN (SELECT MaLoai FROM tbl_loaisp WHERE MaCha = {$manufacture}) ";
               }
               show_product($query, $h4, "{$BASE_URL}/search/keyword=&category={$manufacture}");
           }
        }
        else{
            // chỉ tìm theo giá
            if(isset($_GET['PriceFrom']) && isset($_GET['PriceTo']) && $_GET['PriceFrom'] != '' && $_GET['PriceTo'] != ''){
                $costfrom = $_GET['PriceFrom'];
                $costto = $_GET['PriceTo'];
                $query .= "WHERE A.Gia BETWEEN {$costfrom} AND {$costto} ";
                show_product($query, $h4, "{$BASE_URL}/search/keyword=&PriceFrom={$costfrom}&PriceTo={$costto}");
            } else {
                echo "<h4 title='{$h4}'>{$h4}</h4>
                  <div class='center_block_content'><ul>
                  <font color='#207FAB'><b>The category you selected is not empty :(</b>
                                <br /><br />
                                We will update the new product in the shortest time.
                            </font></ul></div>";
            }
        }
    }

    echo "</div><!-- end products center block -->
            </div><!-- end center columns";