<table width="950">
  <tr>
    <td>
        <table>
            <tr><td><a href="admin.php?page=order_admin&q=viewAll_order"><font color='red'>Tất cả hóa đơn</font></a></td></tr>
            <tr><td><a href="admin.php?page=order_admin&q=view_order_TV">Hóa đơn của thành viên</a></td></tr>
            <tr><td><a href="admin.php?page=order_admin&q=view_order_VL">Hóa đơn của khách vãng lai</a></td></tr>
        </table>
    </td>
    <td width="700">
        <?php
            if(!isset($_GET['q'])){
                include_once('viewAll_order.php');
            }
            else{
                $p = $_GET['q'];
                include_once($p . '.php');                
            }
        ?>    
    </td>                
  </tr>
</table>
