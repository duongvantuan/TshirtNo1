<?php
    // biến t dùng để biết biều đồ dạng tròn hay cột
    if(!isset($_GET['PriceTo']))
        $t = 1;
    else $t = $_GET['PriceTo'];
?>
<table>
    <tr>
        <td>
            <a href="admin.php?page=statistic&q=stt_products_man&t=1" class="paging" <?php echo ($t==1)? 'style="background-color:#3C3C3C; color: #FFFFFF;"' : ''; ?>>Biểu đồ cột</a>&nbsp;&nbsp;&nbsp;
            <a href="admin.php?page=statistic&q=stt_products_man&t=2" class="paging" <?php echo ($t==2)? 'style="background-color:#3C3C3C; color: #FFFFFF;"' : ''; ?>>Biểu đồ tròn</a>
        </td>
    </tr>
</table>
<?php        
    $query = "SELECT * FROM vw_statistic_man";
    $result = mysql_query($query);
    $count = mysql_num_rows($result);
    
    $arr_stt_man = array($count);
    
    while($rows=mysql_fetch_array($result)){
        $arr_stt_man["{$rows['TenNhaSX']}"] = $rows['SoSP'];    
    }
    
    // tính tổng số sản phẩm
    $query2 = "SELECT SUM(SoSP) FROM vw_statistic_man;";
    $result2 = mysql_query($query2);
    $row2 = mysql_fetch_array($result2);
?>
<div id="charts-products" style="min-width: 400px; height: 400px; margin: 0 5px 5px 0;"></div>
		<script type="text/javascript">
        $(function(){
            var chart;
            $(document).ready(function() {
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'charts-products',
                        type: <?php
                                    echo ($t == 1) ? "'column'," : "'pie', margin: [ 50, 50, 10, 80]";
                                ?>                        
                    },
                    title: {
                        text: 'Thống kê sản phẩm - Tổng số sản phẩm: ' + <?php echo " {$row2['0']}"?>
                    },
                    subtitle: {
                        text: 'Theo nhà sản xuất'
                    },
                    xAxis: {
                        categories: [<?php  
                                         $i = 0;// biến $i dùng để tránh in ra phần tử 0                
                                         foreach($arr_stt_man as $key=>$value){
                                            if($i!=0){
                                                echo "'{$key}',";                                                
                                            }
                                            $i++;
                                         }
                                    ?>],
                        labels: {
                                rotation: -45,
                                align: 'right',
                                style: {
                                    fontSize: '10px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Số sản phẩm'
                        }
                    },
                    <?php 
                           if($t == 1){
                                echo "tooltip: {
                                        formatter: function() {
                                            return '<b>' + this.x + '</b>: ' + this.y +' sản phẩm';
                                        }},";
                            }
                            else{
                                echo "tooltip: {
                                    formatter: function() {
                                        return this.y > 0 ? '<b>'+ this.point.name +':</b> '+ this.y +'%'  : null;
                                    }},";
                            }
                    ?>

                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        },
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                formatter: function() {
                                        return this.y > 0 ? '<b>'+ this.point.name +':</b> '+ this.y +'%'  : null;}
                            },
                        }
                    },
                    legend: {enabled: false},
                    credits: {
                        enabled: true
                    },
                    series: [{
                        data: [<?php
                                    $i = 0; 
                                    foreach($arr_stt_man as $key=>$value){
                                        if($i != 0){
                                            echo ($t == 1) ? "{$value}," : ("['{$key}', " . round($value/$row2['0'], 3)*100 . "],");
                                        }
                                        $i++;
                                    }
                                ?>]
                    }]
                });
            });
            
        });
        	        
		</script>