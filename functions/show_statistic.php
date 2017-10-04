<?php
    require_once 'include/dbconnect.php';    
	
	function show_statistics(){
        $session = session_id();
		echo "<div id='statistic' class='block'>
				 <h4>Statistics</h4>
			  <div class='block_content'>";
			
        //Đếm số người truy cập:
        echo "<p>User Online: ";
        
        // Lấy thời gian hiện tại của người truy cập
        $time = time();
        $timenew = $time - 900;  // set time = 15 phút
        
        $sql = "SELECT * FROM tbl_useronline WHERE session = '{$session}';";
        $result = mysql_query($sql);
                
        if(mysql_num_rows($result) == 0){
            $sql1 = "INSERT INTO tbl_useronline(session, time) VALUES ('{$session}', '{$time}');";
            $result1 = mysql_query($sql1);
        }
        else{
            $sql2 = "UPDATE tbl_useronline SET time='{$time}' WHERE session = '{$session}'";
            $result2 = mysql_query($sql2);
        }
        
        $sql3 = "SELECT * FROM tbl_useronline";
        $result3 = mysql_query($sql3);
        $users_online = mysql_num_rows($result3);               
        
        $sql4="DELETE FROM tbl_useronline WHERE time < $timenew";
        $result4=mysql_query($sql4);
       
        echo "<span><b>$users_online</b></span></p>";
             
        //Lượt truy cập:
        echo "<p>Total:";
        $f_read = fopen("functions/count.log",'r')or exit(); 
        $count = fgets( $f_read ); 
        fclose($f_read); 
        $count++; 
        echo "<span><b>$count</b></span>"; 
        $f_write = fopen("functions/count.log",'w'); 
        fwrite($f_write,$count); 
        fclose($f_write); 
        echo "</p>";
		echo "</div><!-- end block content -->
			  </div><!-- end statistic -->";
	}
?>
