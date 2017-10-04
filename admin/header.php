<?php
    include 'delete_invi.php';
?>
<div id="header">
    <a id="header_logo" href="../index.php?page=home" title="Computer Parts Store - The best online store">
        <img src="../images/logo-admin.png" alt="Computer Parts Store - The best online store" />
    </a>
    <ul id="header_links">    
        <li id='dropdown'><a href='admin.php?page=products'>Sản phẩm</a>
            <ul>
                <li><a href="admin.php?page=products&q=view_products">Xem danh sách sản phẩm</a></li>
                <li><a href="admin.php?page=products&q=add_product">Thêm sản phẩm</a></li>
                <li><a href="admin.php?page=products&q=add_category">Thêm loại sản phẩm</a></li>
                <li><a href="admin.php?page=products&q=view_categories">Xem loại sản phẩm</a></li>
                <li><a href="admin.php?page=products&q=view_manufactures">Danh sách nhà sản xuất</a></li>
                <li><a href="admin.php?page=products&q=add_manufacture">Thêm nhà sản xuất</a></li>                
            </ul>
        </li>            
        <li id='dropdown'><a href="admin.php?page=accounts" title="Quản lý tài khoản">Tài khoản</a>
            <ul>
                <li><a href="admin.php?page=accounts&q=view_members">Quản lý thành viên</a></li>
                <li><a href="admin.php?page=accounts&q=view_admins"><font color='#FF0000'>Danh sách quản trị viên</font></a></li>
                <li><a href="admin.php?page=accounts&q=add_admin" class="delete_invi" style='display:none;'>Thêm quản trị viên</a></li>
            </ul>                    
        </li>
        <li>
            <a href="" title="Quản lý đơn hàng">Đơn hàng</a>
        </li>
        <li id='dropdown'><a href="admin.php?page=statistic" title="Thống kê">Thống kê</a>
            <ul>
                <li>
                    <a href=""><font color='#FF0000'>Thống kê sản phẩm</font> &raquo;</a>
                    <ul>
                        <li><a href="admin.php?page=statistic&q=stt_products_cat">Theo loại</a></li>
                        <li><a href="admin.php?page=statistic&q=stt_products_group">Theo nhóm</a></li>
                        <li><a href="admin.php?page=statistic&q=stt_products_man">Theo nhà sản xuất</a></li>
                    </ul>
                </li>
                <li><a href="admin.php?page=statistic&q=stt_money">Thống kê tài chính</a></li>
            </ul>
        </li>        
        <li id='dropdown'><a href="admin.php?page=other_features" title="Các chức năng khác">Các chức năng khác</a>
            <ul>
                <li><a href="admin.php?page=other_features&q=add_banner">Đăng Banner mới</a></li>
                <li><a href="admin.php?page=other_features&q=view_banners">Danh sách Banner đã đăng</a></li>
                <li><a href="admin.php?page=other_features&q=add_adv">Đăng quảng cáo mới</a></li>
                <li><a href="admin.php?page=other_features&q=view_advs">Danh sách quảng cáo đã đăng</a></li>
                <li><a href="admin.php?page=other_features&q=view_feedbacks"><font color='#FF0000'>Danh sách góp ý, liên hệ</font></a></li>
            </ul>
        </li>
        <li id='dropdown'><a href="../index.php" title="Quay lại cửa hàng" target="_blank" >Quay lại cửa hàng</a></li>
    </ul>
    <ul id="header_user">
    	<li style="padding-top:6px;">Xin chào,<a href="admin.php?page=change_info" class="change_info">
            <?php 
                 if(isset($_SESSION["admin_login"])){
                    $query = "SELECT HoTen FROM tbl_admin WHERE TenDangNhap='{$_SESSION["admin_login"]}';";
                    $result = mysql_query($query) or die ('Lỗi truy vấn CSDL');
                    $data = mysql_fetch_array($result);
                    echo "{$data['HoTen']}";
                  }
              ?></a>
        </li>    
        <li><a class="logout" href="../index.php?page=logout" title="Thoát" id="li_logout">Thoát</a></li>
    </ul>
</div><!-- end header -->