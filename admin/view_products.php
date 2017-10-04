<?php
    if(!isset($_GET['cat_id'])){
        $cat_id = 1;
    }
    else{
        $cat_id = $_GET['cat_id'];
    }
?>
<table>
<tr>
<td><form action="" method="GET">
    <p class="title">danh sách sản phẩm</p>
    <select name="cat_id">
    <?php                   
        $query = "SELECT * FROM tbl_loaisp WHERE (MaCha <> MaLoai) ";
        $result = mysql_query($query) or die ("Lỗi truy xuất CSDL");
        $records = mysql_num_rows($result);       
                
        if($result && mysql_num_rows($result)){
            
            while($rows = mysql_fetch_array($result)){
                if($rows['MaLoai'] == $cat_id){
                    echo "<option selected='selected' value='{$rows['MaLoai']}'>{$rows['TenLoai']} </option>";
                }
                else{
                    echo "<option value='{$rows['MaLoai']}'>{$rows['TenLoai']} </option>";
                }
            }
        }
    ?>
</td>    
</tr>
<tr>    
    <td><input type="submit" value="Hiện sản phẩm" class="button_big" /></td>
</tr>    
</form>
<?php
    if(isset($_GET['cat_id'])){
        $cat_id = $_GET['cat_id'];
        include_once('show_products.php');
    }
?>
</table>