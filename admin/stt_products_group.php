<?php
    if(!isset($_GET['PriceTo']))
        $t = 1;
    else $t = $_GET['PriceTo'];
?>
<table>
    <tr>
        <td>
            <a href="admin.php?page=statistic&q=stt_products_group&t=1" class="paging" <?php echo ($t==1)? 'style="background-color:#3C3C3C; color: #FFFFFF;"' : ''; ?>>Biểu đồ cột</a>&nbsp;&nbsp;&nbsp;
            <a href="admin.php?page=statistic&q=stt_products_group&t=2" class="paging" <?php echo ($t==2)? 'style="background-color:#3C3C3C; color: #FFFFFF;"' : ''; ?>>Biểu đồ tròn</a>
        </td>
    </tr>
</table>
<?php        
    $query = "SELECT * FROM vw_statistic_group";
    $result = mysql_query($query);
    $count = mysql_num_rows($result);
    
    $arr_stt_group = array($count); // mảng chứa tên nhóm và số sp trong nhóm    
    
    while($rows=mysql_fetch_array($result)){
        $arr_stt_group["{$rows['TenLoai']}"] = $rows['SoSP'];
    }
    // đếm tổng số sp
    $query2 = "SELECT SUM(SoSP) FROM vw_statistic_group;";
    $result2 = mysql_query($query2);
    $row2 = mysql_fetch_array($result2);
?>
<div id="charts-products" style="min-width: 400px; height: 400px; margin: 0 5px 5px 0;"></div>
		<script type="text/javascript">
        $(function () {            
            var chart;
            $(document).ready(function() {
            
                var colors = Highcharts.getOptions().colors,
                    categories = [<?php
                                       $i = 0;
                                       foreach($arr_stt_group as $key => $value){
                                            if($i != 0) echo "'{$key}',";
                                            $i++;
                                       }
                                 ?>],
                    data = [           
                            <?php
                                $i = 0;// tránh in phần tử số 0
                                $color = 0;// màu của biểu đồ
                                foreach($arr_stt_group as $key => $value){
                                    
                                    if($i != 0){                                        
                                        echo "{y:" . round($value/$row2['0'], 3)*100
                                                   . ",color: colors[" . ($color) . "], drilldown: {name: '" . $key ."', categories: [";
                                                   
                                        mysql_query("SET NAMES UTF8");  
                                        $sub_query = "SELECT A.TenLoai AS TenCha, B.* FROM vw_statistic_group A LEFT JOIN vw_statistic_category B ON A.Maloai = B.Macha WHERE A.TenLoai LIKE '%". $key . "%';";
                                        $sub_result = mysql_query($sub_query) or die ('Lỗi lấy nhóm sản phẩm');
                                        $sub_count = mysql_num_rows($sub_result);
                                        // mảng con chứa tên loại sản phẩm và số sp mỗi loại
                                        $sub_arr = array($sub_count);
                                        
                                        while($sub_rows=mysql_fetch_array($sub_result)){
                                            $sub_arr["{$sub_rows['TenLoai']}"] = $sub_rows['SoSP'];
                                        }
                                        
                                        $m = 0;// tránh in phần tử số 0
                                        foreach($sub_arr as $sub_key => $sub_val){
                                            if($m)
                                                echo "'{$sub_key}',";
                                            $m++;
                                        }
                                        echo "], data: [";
                                        
                                        $n = 0;// tránh in phần tử số 0
                                        foreach($sub_arr as $sub_key => $sub_val){
                                            if($n)
                                                echo round($sub_val/$row2['0'], 3)*100 . ","; // tính %
                                            $n++;     
                                        }
                                        echo "], color: colors[" . $color . "]}},";
                                        $color++;
                                    }
                                    $i++;
                                }
                            ?>
                        ];
                        
                // Mảng dữ liệu
                var groupData = [];
                var categoriesData = [];
                for (var i = 0; i < data.length; i++) {
            
                    // chèn dl vào biểu đồ tròn bên trong
                    groupData.push({
                        name: categories[i],
                        y: data[i].y,
                        color: data[i].color
                    });
            
                    // chèn các loại sp vào biểu đồ bên ngoài
                    for (var j = 0; j < data[i].drilldown.data.length; j++) {
                        var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
                        categoriesData.push({
                            name: data[i].drilldown.categories[j],
                            y: data[i].drilldown.data[j],
                            color: Highcharts.Color(data[i].color).brighten(brightness).get()
                        });
                    }
                }
            
                // Tạo biểu đồ
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'charts-products',
                        type: <?php echo ($t == 1) ? "'bar'" : "'pie'"; ?>
                    },
                    title: {
                        text: 'Thống kê sản phẩm - Tổng số sản phẩm: ' + <?php echo " {$row2['0']}"?>
                    },
                    subtitle: {
                        text: 'Theo nhóm sản phẩm'
                    },
                    xAxis: {
                        categories: [<?php
                                       if($t == 1){
                                           $i = 0;
                                           foreach($arr_stt_group as $key => $value){
                                                if($i != 0) echo "'{$key}',";
                                                $i++;
                                           }                                        
                                       } 
                                 ?>],
                        title: {
                            text: 'Nhóm sản phẩm'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Nhóm sản phẩm',
                            align: 'high'
                        }
                    },                                        
                    plotOptions: {
                        pie: {
                            shadow: true
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            <?php echo ($t == 1) ? "return '<b>'+this.x +'</b>: '+ this.y +' sản phẩm';" : "return '<b>'+ this.point.name +'</b>: '+ this.y +' %';" ;?>                            
                        }
                    },
                    legend: {enabled: false},
                    series: [
                        <?php
                            
                            if($t == 1){
                                    echo "{data:[";
                                    $i = 0; 
                                    foreach($arr_stt_group as $key=>$value){
                                        if($i != 0){
                                            echo "{$value},";
                                        }
                                        $i++;
                                    }
                                    echo "]}";

                            }else{
                                echo "{name: 'Nhóm sản phẩm',
                                        data: groupData,
                                        size: '60%',
                                        dataLabels: {
                                            formatter: function() {
                                                return this.y > 5 ? this.point.name : null;
                                            },
                                            color: 'white',
                                            distance: -30
                                        }
                                    }, {
                                        name: 'Nhóm sản phẩm',
                                        data: categoriesData,
                                        innerSize: '60%',
                                        dataLabels: {
                                            formatter: function() {                                
                                                return this.y > 0 ? '<b>'+ this.point.name +':</b> '+ this.y +'%'  : null;
                                            }
                                        }}";
                            }

                        ?>
                    ]
                });
            });
            
        });        
		</script>