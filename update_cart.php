<?php
    ob_start();
    session_start();
    if($_SESSION["flag_capnhat"]==0){ 
        foreach ($_SESSION["cart"] as $key => $value){
                        
            $ten=$value["TenSP"];
            $hinh=$value["HinhAnh"];
            $gia=$value["Gia"];
            $sl=$_GET[$key];
            
            $_SESSION["cart"][$key]= array("TenSP"=>$ten,"HinhAnh"=>$hinh,"Gia"=>$gia,"soluong"=>$sl);
            $_SESSION["flag_capnhat"]=1;
               
        }
    }
    
    header("location:index.php?page=show_cart");
?>
