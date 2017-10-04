<?php
	ob_start();
    session_start();
    require_once('../include/dbconnect.php');
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Trang điều khiển Admin</title>
        <?php 
            include_once ('css_js_admin.php');
        ?>        
    </head>
    <body id="admin">
        <div id="wrapper">
            <?php
                if(!isset($_SESSION['admin_login'])){
                    header("location: login.php");
                }
            ?>
            <?php 
                include_once('header.php');
            ?>
            <div id="contents">
            <?php 
                if(!isset($_GET['page'])){
                    $_GET['page'] = 'products';
                }
				$page = $_GET['page'];
				
				include_once($page.'.php');
            ?>
            </div>
            <div id="footer">
                <p>&copy;Tshirt No 1. Committed to quaility, Committed to you<br />For more information please contact Email: <a href="mailto:tshirtno1@gmail.com" title="Contact">tshirtno1@gmail.com</a></p>
            </div>
        </div>
    </body>
</html>