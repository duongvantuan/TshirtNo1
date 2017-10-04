<?
    $cat_id = $_GET['cat_id'];
    $query = "SELECT * FROM tbl_loaisp WHERE MaLoai={$cat_id};";
    $result = mysql_query($query) or die ("Lỗi truy xuất cơ sở dữ liệu");
    $row = mysql_fetch_array($result);
    
    $ten = $row['TenLoai'];
    $nhom = $row['MaCha']; 
?>
<form id="edit-category-form">
    <p class="title">sửa loại (nhóm) sản phẩm</p>
    <table border='1'>
        <tr>
            <td>Tên loại (nhóm) sản phẩm</td>
            <td><input type="text" size="70" name="tennhom" value="<?php echo $ten; ?>" /></td>
        </tr>
        <tr>
            <td>Thuộc nhóm </td>
            <td>
                <select name="nhom">
                <?php
                    $query = "SELECT * FROM vw_loaisp";
                    $res = mysql_query($query) or die ("Lỗi truy xuất CSDL");
                                       
                    while($rows = mysql_fetch_array($res)){
                        
                        if($rows['MaLoai'] == $nhom){
                            echo "<option selected='selected' value='{$rows['MaLoai']}'>{$rows['TenLoai']}</option>";
                        }else{
                            echo "<option value='{$rows['MaLoai']}'>{$rows['TenLoai']}</option>";    
                        }                        
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="button_big submit-btn" value="Thêm" />
                <input type="reset" class="button_big" value="Nhập lại" />
            </td>
        </tr>
    </table>
</form>