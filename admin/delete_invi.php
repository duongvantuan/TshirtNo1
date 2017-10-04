<?php
    if(isset($_SESSION["admin_login"]))
    {
        $sql = "SELECT * FROM tbl_admin WHERE TenDangNhap='{$_SESSION["admin_login"]}' AND MaAdmin = '1'";
        //echo $sql;
        $result = mysql_query($sql); 
        $data = mysql_fetch_array($result);
        $_SESSION["data_1"] = $data; //Lấy session biến data
       
        if($data > 0)
        {
            echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $(".delete_invi").show();                   
                    });
                  </script>';
        }
    }
?>