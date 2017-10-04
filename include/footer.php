<ul id="footer_links">
    <li class="first_item"><a title="Home" href="<?php echo BASE_URL; ?>">Home</a></li>
    <li class="item"><a title="Introduction" href="<?php echo $BASE_URL; ?>/introduction">Introduction</a></li>
    <li class="item"><a title="Site map" href="<?php echo $BASE_URL; ?>/sitemap">Site map</a></li>
    <li class="item"><a title="Payment" href="<?php echo $BASE_URL; ?>/payment">Payment</a></li>
    <li class="item"><a title="Contact" href="<?php echo $BASE_URL; ?>/contact">Contact</a></li>
    <script type="text/javascript">
        $(document).ready(function() {
                $('#wrapper').append('<div id="top" title="Lên đầu trang"></div>');
                $('#top').fadeOut();
                										
                $(window).scroll(function() {
                        if($(window).scrollTop() != 0) {
                                $('#top').fadeIn(200);
                        } else {
                                $('#top').fadeOut(200);
                        }
                });
                $('#top').click(function() {
                        $('html, body').animate({scrollTop:0},300);
                });
        });
    </script>                                
</ul>
    <p>&copy;Tshirt No 1. Committed to quaility, Committed to you<br />For more information please contact Email: <a href="mailto:tshirtno1@gmail.com" title="Contact">tshirtno1@gmail.com</a></p>