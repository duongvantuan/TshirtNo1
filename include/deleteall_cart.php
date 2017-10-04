<?php
    ob_start();
    session_start();
    unset($_SESSION['cart']);
    unset($_SESSION['Tongtien']);
    header("location:index.php?page=show_cart");
?>
