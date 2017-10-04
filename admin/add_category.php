<form id="add-category-form">
    <p class="title">thêm loại (nhóm) sản phẩm mới</p>
    <table border='1'>
        <tr>
            <th>Tên loại (nhóm) sản phẩm</th>
            <td><input type="text" size="70" name="tennhom" /></td>
        </tr>
        <tr>
            <th>Thuộc nhóm </th>
            <td>
                <select name="nhom">
                <?php
                    $query = "SELECT * FROM vw_loaisp";
                    $res = mysql_query($query) or die ("Lỗi truy xuất CSDL");
                    
                    echo "<option value='0'>Nhóm mới</option>";
                    
                    while($rows = mysql_fetch_array($res)){
                        echo "<option value='{$rows['MaLoai']}'>{$rows['TenLoai']}</option>";
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