<?php
    include 'functions/show_product.php';
?>
<div id="center_col" class="center_col">
        <?php
            echo "<div id='slideshow'>
                    <div class='box_skitter''>";
                    
        	$sql = 'SELECT * FROM tbl_banner ORDER BY(SoThuTu)';
			$result = mysql_query($sql);
			echo '<ul>';
			while($rows = mysql_fetch_array($result))
			{
				echo "<li><img src='{$rows['DuongDan']}'/><div class='label_text'><p>{$rows['ChuThich']}</p></div></li>";	
			}
			echo '</ul>';
		?>
            <script>
                $(document).ready(function(){
                        $('.box_skitter').skitter({
                            animation: 'random', 
                            interval: 3000,
                            hideTools: true
                        });
                });
            </script>                    
        </div><!-- end box_skitter -->
    </div><!-- end slide show -->
    <div id="bestseller" class="center_block">
    </div><!-- end bestseller block -->
    <div id="newproducts" class="center_block">
        <?php
            $h4 = "New products";
            $query = "SELECT A.*, B.DuongDan FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP  WHERE A.SPMoi = 1 AND B.SoThuTu = 0 ";   // lựa chọn ngẫu nhiên
            show_product($query, $h4, "{$BASE_URL}");
        ?>
    </div><!--end new product -->
</div><!-- end center column -->   