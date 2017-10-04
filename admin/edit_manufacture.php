<?php
    $m_id = $_GET['m_id'];
    
    $query = "SELECT * FROM tbl_nhasx WHERE MaNhaSX = {$m_id}";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);    
?>
<form method="POST">
    <table border='1' width='700' >
        <p class="title">sửa nhà sản xuất</p>
        <tr>
            <td>Tên nhà sản xuất</td>
            <td><input type="text" name="tennhasx" size="70" value="<?php echo $row['TenNhaSX']?>" /></td></tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="button_big submit-btn" value="Sửa" style="margin-left: 10px;" name="suansx-btn" />
                <input type="reset" class="button_big" value="Nhập lại" />
            </td>
        </tr>
    </table>
</form>