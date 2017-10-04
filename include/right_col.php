<?php
    include_once ('functions/show_adv.php');
	include_once ('functions/show_statistic.php');
?>
<!-- Right Columns-->
<div id="right_col" class="column">
    <div id="search" class="block">
        <h4>Search</h4>
        <div class="block_content">
            <form id="searchForm" method = "GET" action="index.php" >
                <table width="200">
                    <tr>
                        <td colspan="2"><p>Keyword</p>
                        <?php
                            if(isset($_GET['keyword'])){
                                echo "<input type='text' name='k' class='searchbykey' value='{$_GET['keyword']}'/>";                                
                            }
                            else{
                                echo "<input type='text' name='k' class='searchbykey' />";
                            }
                        ?>                            
                        </td>
                    </tr>
                    <tr><td id="advance-search">Advanced Search</td></tr>
                    <tr><td id="collapse">Hide</td></tr>
                    <tr class="hiddenrows">
                        <td colspan="2"><p>Nhà sản xuất</p>
                            <?php
                                echo "<select name='category'>";
                                echo "<option value='0'>Tất cả</option>";
                            
                                $manu_res = mysql_query("SELECT * FROM tbl_nhasx ORDER BY(MaNhaSX);") or die ('Không lấy được dữ liệu');
                                
                                if($manu_res && mysql_num_rows($manu_res) > 0){
                                    while($manu_rows = mysql_fetch_array($manu_res)){
                                        if(isset($_GET['category']) && $manu_rows['MaNhaSX'] == $_GET['category']){
                                            echo "<option value='{$manu_rows['MaNhaSX']}' name='{$manu_rows['MaNhaSX']}' selected='selected'>{$manu_rows['TenNhaSX']}</option>";
                                        }
                                        else{
                                            echo "<option value='{$manu_rows['MaNhaSX']}' name='{$manu_rows['MaNhaSX']}'>{$manu_rows['TenNhaSX']}</option>";    
                                        }    
                                    }
                                }
                                echo "</select>";
                            ?>
                        </td>
                    </tr>
                    <tr class="hiddenrows">
                        <td colspan="2"><p>Giá</p>
                            <span>Từ</span>
                            <?php
                                if(isset($_GET['PriceFrom'])){
                                    echo "<input type='text' name='PriceFrom' class='text_small' value='{$_GET['PriceFrom']}' />";
                                }
                                else{
                                    echo "<input type='text' name='PriceFrom' class='text_small' />";
                                }
                            ?>
                            <span>đến</span>
                            <?php
                                if(isset($_GET['PriceTo'])){
                                    echo "<input type='text' name='t' class='text_small' value='{$_GET['PriceTo']}' />";
                                }
                                else{
                                    echo "<input type='text' name='t' class='text_small' />";
                                }
                            ?>	
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <span>&nbsp;</span>
                        <input type="submit" name="searchbtn" value="Tìm" class="button_small" style="margin-right:15px;" /></td>
                    </tr>
                </table>
                <?php
                    if(!isset($_GET['category']) && !isset($_GET['PriceFrom']) && !isset($_GET['PriceTo'])){
                        echo "<script type='text/javascript'>
                                $(document).ready(function(){
                                    $('#collapse').hide();
                                    $('#advance-search').show();";
                    }
                    else{
                        echo "<script type='text/javascript'>
                                $(document).ready(function(){
                                    $('#collapse').show();
                                    $('#advance-search').hide();
                                    $('.hiddenrows').show();";
                    }
                    
                    echo "$('#advance-search').click(function(){
                            $(this).fadeOut(500);
                            $('.hiddenrows').fadeIn(800);
                            $('#collapse').fadeIn(600);
                       });
                       
                       $('#collapse').click(function(){
                            $(this).fadeOut(500);
                            $('.hiddenrows').fadeOut(300);
                            $('#advance-search').fadeIn(600);
                       });
                       
                       // validate form
                       $('#searchForm').validate({
                           rules:{f:{digits: true}, t:{digits: true}},
                           messages:{f:{digits: 'Bạn phải điền số'}, t:{digits: 'Bạn phải điền số'}} 
                       });
                    });
                </script>";
                ?>
            </form>
        </div><!-- end block content -->
    </div><!--end seacrh block-->
	<?php
    	show_statistics();
	?>

    <?php 
        show_adv(0);
    ?>
</div><!-- End Right Column -->     