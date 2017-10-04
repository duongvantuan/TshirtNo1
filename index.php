<?php
    require_once('phpmailer/class.phpmailer.php');
    require_once ('include/dbconnect.php');
    define('BASE_URL', 'http://mailtuandv.club');
    ob_start();
    session_start();

    if(!isset($_GET['page'])) {
        $_GET['page'] = 'home';
    }
    $BASE_URL = BASE_URL;
    $page = $_GET['page'];
    $title = '';  // tiêu đề cho trang web
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        require('include/ajax_' . $page . '.php');
        exit(0);
    }
    switch($page){
        case 'home': $title = 'Tshirt No1';
            break;
        case 'info': $title = 'Information';
            break;
        case 'contact': $title = 'Contact';
            break;
        case 'productdetails': $title = 'Product detail';
            break;
        case 'products': $title = 'Product';
            break;
        case 'register': $title = 'Register User';
            break;
        case 'searchresults': $title = 'Search Result';
            break;
        case 'success': $title = 'Success';
            break;
        case 'sitemap': $title = 'Sitemap';
            break;
        case 'login_error': $title = 'Login Error';
            break;
        case 'confirmation': $title = 'Confirmation';
            break;
        case 'change_info': $title = 'Change Info';
            break;
        case 'forgotpass': $title = 'Forgot password';
            break;
        case 'forgotpass_success': $title = 'Success!';
            break;
        case 'change_info': $title = 'Edit Info';
            break;
        case 'highrating': $title = 'Products are highly appreciated';
            break;
        case 'saleoff': $title = 'Products are promotional';
            break;
        case 'checkout': $title = 'Payment';
            break;
    };
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="<?php echo BASE_URL; ?>/images/favicon/Grey-Triskele.ico" >
        <?php include_once 'include/css_js.php'; ?> <!-- Include CSS & Javascript -->
        <title><?php echo $title; ?></title>
    </head>
    <body <?php echo "id='{$page}'"; ?>>
        <div id="wrapper">
            <!--Header-->
            <div id="header">
                <?php
                    include_once ('include/header.php');
                ?>
            </div><!-- end header -->
            <div style="clear:both;"></div>
            <!-- Columns -->
            <div id="columns">
                <!-- left column -->
                <?php
                    include_once ('include/left_col.php');
                ?>
                <!-- center column -->
                <?php
                    if(isset($_GET['keyword']) || isset($_GET['category']) || isset($_GET['PriceFrom']) || isset($_GET['PriceTo'])) {
                        include_once ('include/searchresults.php');
                    } else {
                        include_once ('include/'.$page.'.php');
                    }
                ?>
            </div>
            <!--Footer-->
            <div id="footer">
                <?php
                    include_once ('include/footer.php');
                ?>
            </div><!-- end footer -->
        </div><!-- end wrapper -->
    </body>
</html>
