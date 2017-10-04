<?php
    include 'delete_invi.php';
?>
<table width="950">
  <tr>
    <td>
        <table>
            <tr><td><a href="admin.php?page=accounts&q=view_admins"><font color='red'>Danh sách quản trị viên</font></a></td></tr>
            <tr><td><a href="admin.php?page=accounts&q=view_members">Quản lý thành viên</a></td></tr>
            <tr><td><a href="admin.php?page=accounts&q=add_admin" class="delete_invi" style='display:none;'>Thêm quản trị viên</a></td></tr>
        </table>
    </td>
    <td width="700">
        <?php
            if(!isset($_GET['q'])){
                include_once('view_members.php');
            }
            else{
                $p = $_GET['q'];
                include_once($p . '.php');                
            }
        ?>    
    </td>                
  </tr>
</table>