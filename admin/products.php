<table width="950">
  <tr>
    <td>
        <table>
            <tr><td><a href="admin.php?page=products&q=view_products"><font color='red'>Xem danh sách sản phẩm</font></a></td></tr>
            <tr><td><a href="admin.php?page=products&q=add_product">Thêm sản phẩm</a></td></tr>
            <tr><td><a href="admin.php?page=products&q=view_categories">Xem loại sản phẩm</a></td></tr>
            <tr><td><a href="admin.php?page=products&q=add_category">Thêm loại sản phẩm</a></td></tr>
            <tr><td><a href="admin.php?page=products&q=view_manufactures">Danh sách nhà sản xuất</a></td></tr>
            <tr><td><a href="admin.php?page=products&q=add_manufacture">Thêm nhà sản xuất</a></td></tr>
        </table>
    </td>
    <td width="700">
        <?php
            if(!isset($_GET['q'])){
                include_once('view_products.php');
            }
            else{
                $p = $_GET['q'];
                include_once($p . '.php');                
            }
        ?>
    </td>
  </tr>
</table>