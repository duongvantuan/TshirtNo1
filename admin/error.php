<p class='success'>Lỗi<br />
    <img src='../images/error-icon.png' alt='Lỗi' /><br />
</p>
<?php
    $e = $_GET['e'];
    
    switch($e){
        case 1: echo "<a href='admin.php?page=other_features&q=add_adv'>Thử đăng lại quảng cáo</a>";
            break;
        case 2: echo "<a href='admin.php?page=other_features&q=view_advs'>Thử xóa lại quảng cáo</a>";
            break;
        case 3: echo "<a href='admin.php?page=other_features&q=add_banner'>Thử đăng lại banner</a>";
            break;
        case 4: echo "<a href='admin.php?page=other_features&q=view_banners'>Thử xóa lại banner</a>";
            break;
        case 5:// thêm loại
            break;
        case 6:// xóa loại
            break;
        case 7: echo "<a href='admin.php?page=other_features&q=view_feedbacks'>Thử xóa lại góp ý, liên hệ</a>";
            break;
        case 8://thêm nsx
            break;
        case 9: echo "<a href='admin.php?page=products&q=view_manufactures'>Thử xóa lại nhà sản xuất</a>";
            break;
        case 10: echo "<a href='admin.php?page=products&q=add_product'>Thử thêm lại sản phẩm</a>";
            break;
        case 11: echo "<a href='admin.php?page=products&q=view_products'>Thử xóa lại sản phẩm</a>";
            break;
        case 12: echo "<a href='admin.php?page=accounts&q=view_members'>Thử xóa lại thành viên</a>";
            break;
        case 13: echo "<a href='admin.php?page=accounts&q=view_admins'>Thử xóa lại quản trị viên</a>";
            break;
        case 14: echo "<a href='admin.php'>Quay lại trang điều khiển</a>";
            break;
    }