<?php
    ob_start();
    session_start();
    $masp=$_GET["p_id"];
    unset($_SESSION['cart'][$masp]);    
    header("location:index.php?page=show_cart");
?>
   