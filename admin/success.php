<p class='success'>Thành công<br />
    <img src='../images/success-icon.png' alt='Thành công' />
</p>
<?php
    $s = $_GET['s'];
    
    switch($s){
        case 1: echo "<a href='admin.php?page=other_features&q=view_advs'>Nhấn vào đây</a> để xem danh sách quảng cáo đã đăng<br />
                    Hoặc <a href='admin.php?page=other_features&q=add_adv'>Đăng tiếp quảng cáo mới</a>";
            break;
        case 2: echo "<a href='admin.php?page=other_features&q=view_banners'>Nhấn vào đây</a> để xem danh sách banner đã đăng<br />
                    Hoặc <a href='admin.php?page=other_features&q=add_banner'>Đăng tiếp banner mới</a>";
            break;
        case 3: echo "<a href='admin.php?page=other_features&q=view_as'>Nhấn vào đây</a> để xem danh sách banner đã đăng<br />
                    Hoặc <a href='admin.php?page=other_features&q=add_adv'>Đăng tiếp banner mới</a>";
            break;
        case 4: echo "<a href='admin.php?page=other_features&q=view_advs'>Nhấn vào đây</a> để xem danh sách banner đã đăng<br />
                    Hoặc <a href='admin.php?page=other_features&q=add_adv'>Đăng tiếp banner mới</a>";
            break;
        case 5: echo "<a href='admin.php?page=products&q=view_manufactures'>Nhấn vào đây</a> để xem danh sách nhà sản xuất<br />
                    Hoặc <a href='admin.php?page=products&q=add_manufacture'>Thêm nhà sản xuất mới</a>";
            break;
        case 6: echo "<a href='admin.php?page=products&q=view_products'>Nhấn vào đây</a> để xem danh sách sản phẩm<br />
                    Hoặc <a href='admin.php?page=products&q=add_product'>Đăng tiếp sản phẩm mới</a>";
            break;            
    }
?>