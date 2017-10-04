<?php
    /*
     * hiển thị quảng cáo
     * @position: vị trí: 0 - phải/ 1 - tráu
    */
    function show_adv($position){
    	echo "<div id='adv' class='block'>
                <h4>Ad links</h4>
                <div class='block_content'>";
        
        //bên phải
        if($position == 0){
            $query = 'SELECT * FROM tbl_quangcao WHERE ViTri = 0 ORDER BY (ThuTu)';
        }    
        // bên trái
        else{
            $query = 'SELECT * FROM tbl_quangcao WHERE ViTri = 1 ORDER BY (ThuTu)';
        }        
    	
    	$result = mysql_query($query) or die("<font color='red'><b>Lỗi truy xuất cơ sở dữ liệu</b></font>");
    	
    	while($rows = mysql_fetch_array($result)){
    		echo "<a href='{$rows['Link']}' title='{$rows['TenQC']}' target='_blank'>";
    		echo "<img src='{$rows['DuongDanAnh']}' alt='{$rows['TenQC']}' title='{$rows['TenQC']}'/>";	
    		echo "</a>";
    	}
        
        echo "</div><!-- end block content -->
            </div><!-- end adv clock -->";
    }