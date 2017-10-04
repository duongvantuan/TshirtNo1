<table width="950">
  <tr>
    <td>
        <table>
            <tr><td><font color='red'>Thống kê sản phẩm </font><a href="admin.php?page=statistic&q=stt_products_cat">theo loại</a></td></tr>
            <tr><td><font color='red'>Thống kê sản phẩm </font><a href="admin.php?page=statistic&q=stt_products_group">theo nhóm</a></td></tr>
            <tr><td><font color='red'>Thống kê sản phẩm </font><a href="admin.php?page=statistic&q=stt_products_man">theo nhà sản xuất</a></td></tr>
            <tr><td><a href="admin.php?page=statistic&q=stt_money">Thống kê tài chính</a></td></tr>
        </table>
    </td>
    <td width="700">
        <?php
            if(!isset($_GET['q'])){
                include_once('stt_products_cat.php');
            }
            
            else{
                $p = $_GET['q'];
                include_once($p . '.php');                
            }
        ?>
    </td>                
  </tr>
</table>