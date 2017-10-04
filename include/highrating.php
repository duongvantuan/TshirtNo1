<div id='center_col' class='center_col'>
    <div id='products' class='center_block'>
    <?php
        include_once 'functions/show_product.php';
        
        $query = "SELECT * FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP AND B.SoThuTu = 0 ORDER BY Rating DESC ";
        $h4 = "The product is highly";
        show_product($query, $h4, "{$BASE_URL}/highrating");
    ?>
    </div><!-- end products center block -->
</div><!-- end center columns-->    