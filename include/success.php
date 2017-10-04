<div id='center_col' class='center_col'>
    <div id='frame' class='center_block'>

<?php
    switch($_GET['q']){
        // nếu nhận từ trang register
        case 1:echo "<h4>Đăng ký thành công</h4>
                    <div class='center_block_content'>
                        <p id='frame_header'>Bạn đã đăng ký thành công.<br /> Chào mừng đến với Website của chúng tôi
                        <br /><img src='<?php echo BASE_URL; ?>/images/success-icon.png' alt='Đăng ký thành công' /></p>
                        <p>Mã xác nhận đã được gửi tới địa chỉ email của bạn.<br />
                        Để hoàn tất việc đăng ký, bạn vui lòng kiểm tra email và bấm vào link xác nhận.</p></div>";
                break;
        // nếu nhận từ trang forgotpass
        case 2:echo "<h4>Lấy mật khẩu thành công</h4>
                    <div class='center_block_content'>
                        <p id='frame_header'>Mật khẩu của bạn đã được gửi.<br />
                            <img src='<?php echo BASE_URL; ?>/images/success-icon.png' alt='Lấy mật khẩu thành công' />
                        </p>
                        <p>Mật khẩu mới đã được gửi tới địa chỉ email của bạn.<br />
                        Vui lòng kiểm tra hòm thư để biết được mật khẩu mới.</p></div>";
                break;
        case 3: echo "<h4>Thành công</h4>
                    <div class='center_block_content'>
                        <p id='frame_header'>Gửi ý kiến, liên hệ thành công<br />
                            <img src='<?php echo BASE_URL; ?>/images/email-icon.png' alt='Gửi ý kiến, liên hệ thành công' />
                        </p>
                        <p>Cám ơn những đóng góp và phản hồi của bạn.<br />
                        Chúng tôi sẽ trả lời vả liên lạc lại tới quý khách trong thời gian sớm nhất</p></div>";
                break;
        case 4: echo "<h4>Sửa thông tin thành công</h4>
                    <div class='center_block_content'>
                        <p id='frame_header'>Bạn đã sửa thông tin thành công.<br />
                        <img src='<?php echo BASE_URL; ?>/images/success-icon.png' alt='Sửa thông tin thành công' /></p>
                        <p>Thông tin của bạn đã được cập nhật</p></div>";
                break;
        case 5: echo "<h4>Mua hàng thành công</h4>
                    <div class='center_block_content'>
                        <p id='frame_header'>Cám ơn bạn đã mua sản phẩm của cửa hàng chúng tôi.<br />
                        <img src='<?php echo BASE_URL; ?>/images/success-icon.png' alt='Mua hàng thành công thành công' /></p>
                        <p>Đơn đặt hàng của bạn đã được chúng tôi cập nhật<br />Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất :)</p>
                        <p><a href='index.php?page=products' id='buy-cont'>Mua hàng tiếp</a></p>
                        </div>";
                break;
    }
?>
    </div><!-- end center block -->
</div><!-- end center column -->