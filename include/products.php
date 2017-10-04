<?php
    include_once 'functions/show_product.php';
    $_SESSION['flag']=0;

    echo "<div id='center_col' class='center_col'>
            <div id='products' class='center_block'>";
    if (isset($_GET['TenLoai'])) {
        $TenLoai = $_GET['TenLoai'];
        $cat_res = mysql_query("SELECT MaLoai FROM tbl_loaisp WHERE LOWER(TenLoai) = '{$TenLoai}';") or die ('ERROR');
        $cat_name = mysql_fetch_array($cat_res);
        $_GET['cat_id'] = $cat_name['MaLoai'];
    }

    if(!isset($_GET['cat_id'])){
        $h4 = "The store's products";
        $query = "SELECT A.*, B.DuongDan FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP AND B.SoThuTu = 0 ORDER BY RAND() ";   // lựa chọn ngẫu nhiên
        show_product($query, $h4, "{$BASE_URL}/products");
    } else {
        $cat_id = $_GET['cat_id'];
        $_SESSION['cat_id']=$cat_id;
        $cat_query = "SELECT * FROM vw_nhomsp;";
        $cat_result = mysql_query($cat_query) or die ('Không lấy được cơ sở dữ liệu');
        $m = mysql_num_rows($cat_result);


        // nếu là menu cấp 2
        if ($cat_id > $m){
            $query = "SELECT * FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP WHERE A.MaLoai = {$cat_id} AND B.SoThuTu = 0 ";
        }
        // menu cấp 1
        else{
            $query = "SELECT * FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP WHERE A.MaLoai IN (SELECT MaLoai FROM tbl_loaisp WHERE MaCha = {$cat_id}) AND B.SoThuTu = 0 ";
        }
        // lấy thẻ <h4> chứa tên loại
        $cat_res = mysql_query("SELECT TenLoai FROM tbl_loaisp WHERE MaLoai = {$cat_id};")
                    or die ('<div class="center_block_content"><font color="red"><b>Lỗi truy xuất cơ sở dữ liệu</b></font></div>');
        $cat_name = mysql_fetch_array($cat_res);
        $h4 = $cat_name['TenLoai'];
        show_product($query, $h4, "{$BASE_URL}/products/$TenLoai");
    }
    echo "</div><!-- end products center block -->
            </div><!-- end center columns-->";