<table width="950">
  <tr>
    <td>
        <table>            
            <tr><td><a href="admin.php?page=other_features&q=add_banner">Đăng banner mới</a></td></tr>
            <tr><td><a href="admin.php?page=other_features&q=view_banners">Danh sách banner đã đăng</a></td></tr>            
            <tr><td><a href="admin.php?page=other_features&q=add_adv">Đăng quảng cáo</a></td></tr>
            <tr><td><a href="admin.php?page=other_features&q=view_advs">Danh sách quảng cáo đã đăng</a></td></tr>
            <tr><td><a href="admin.php?page=other_features&q=view_feedbacks"><font color='red'>Danh sách góp ý, liên hệ</font></a></td></tr>
        </table>
    </td>
    <td width="700">
        <?php
            if(isset($_GET['q'])){
                $p = $_GET['q'];
                include_once($p . '.php');            
            }           
        ?>    
    </td>                
  </tr>
</table>