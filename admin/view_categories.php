<?php
    include 'delete_invi.php';
?>
<table border='1' width="400px" class="tables-admin">
<p class="title">các loại (nhóm) sản phẩm</p>
<?php
    $query = "SELECT * FROM vw_nhomsp;";
    $result = mysql_query($query);    
    
    while($rows = mysql_fetch_array($result)){
        
        $sub_query = "SELECT * FROM tbl_loaisp WHERE MaCha <> MaLoai AND (MaCha IN (SELECT MaLoai FROM tbl_loaisp WHERE MaCha = {$rows['MaLoai']}));";
        $sub_result = mysql_query($sub_query);
        $n = mysql_num_rows($sub_result);
         
        if($n > 0){        
            echo "<tr><td rowspan='{$n}'><b>{$rows['TenLoai']}</b><br />
                <a href='admin.php?page=products&q=edit_category&cat_id={$rows['MaLoai']}'>Sửa</a>&nbsp;&nbsp;&nbsp;
                <a href='admin.php?page=products&q=delete_category'&cat_id={$rows['MaLoai']}' class='delete_invi' style='display:none;'>Xóa</a>                
                </td>";
            while($sub_rows = mysql_fetch_array($sub_result)){
                echo "<td>{$sub_rows['TenLoai']}<br />
                        <a href='admin.php?page=products&q=edit_category&cat_id={$sub_rows['MaLoai']}'>Sửa</a>&nbsp;&nbsp;&nbsp;
                        <a href='admin.php?page=products&q=delete_category&cat_id={$sub_rows['MaLoai']}' class='delete_invi' style='display:none;' >Xóa</a>
                </td></tr>";
            }
        }
        else{
            echo "<tr><td><b>{$rows['TenLoai']}</b><br />
                <a href='admin.php?page=products&q=edit_category&cat_id={$rows['MaLoai']}'>Sửa</a>&nbsp;&nbsp;&nbsp;
                <a href='admin.php?page=products&q=delete_category&cat_id={$rows['MaLoai']}' class='delete_invi' style='display:none;'>Xóa</a>                
                </td></tr>";
        }
    }
?>
</table>