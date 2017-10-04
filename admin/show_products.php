<table class="tables-admin" width="100%">
<?php

    include 'delete_invi.php';

    require_once('../include/dbconnect.php');  
    
    $query = "SELECT * FROM tbl_sanpham A INNER JOIN tbl_hinhanh B ON A.MaSP = B.MaSP AND B.SoThuTu = 0 WHERE MaLoai = {$cat_id} ";
    $result = mysql_query($query);
    $records = mysql_num_rows($result);
        
    $totalpages = ceil($records / 15);

    if(isset($_GET['p'])){
        $cur_page = $_GET['p'];
    }
    else{
        $cur_page = 1;
    }
        
    for($i = 1; $i <= $totalpages; $i++){
        echo "<a href='admin.php?page=products&q=view_products&cat_id={$cat_id}&p={$i}' class='paging" . (($i == $cur_page) ? " cur-page" : "") . "'>{$i}</a>&nbsp;";
    }            
    
    $start = ($cur_page - 1) * 15;
    
    $query .= "LIMIT {$start}, 15;";
    $result = mysql_query($query);
    $count = 0;
    
    // nếu chưa có sản phẩm
    if($records == 0){
        echo "<tr><td>Danh mục này hiện chưa có sản phẩm.<br /> 
                <a href='admin.php?page=products&q=add_product&cat_id={$cat_id}' title='Thêm sản phẩm'>Click vào đây</a> để thêm sản phẩm
                </td></tr>";
    }
    
    while($rows=mysql_fetch_array($result)){
        if($count % 5 == 0){
            echo "<tr>";
        }
?>
    <td>
        <?php echo "<b>" . $rows['TenSP'] . "</b>"; ?><br /><br />
        <img src='../<?php echo $rows['DuongDan']; ?>' alt="<?php echo $rows['TenSP']; ?>" /><br /><br />
        Giá: <?php echo  "<font color='red'><b>" . number_format($rows['Gia'], 0, '.', '.') . " VND</b></font>"; ?><br />
        <a href="admin.php?page=products&q=edit_product&p_id=<?php echo $rows['MaSP']; ?>">Sửa</a>&nbsp;&nbsp;&nbsp;
        <a href="" class="delete_invi" style='display:none;' id="<?php echo $rows['MaSP'];?>">Xóa</a>
    </td>
    <?php
        $count++;
        if($count % 5 == 0){
            echo "</tr>";
        }
    }
    ?>
</table>
<script type="text/javascript">
    $(document).ready(function(){
                
       $('.delete_invi').click(function(){
        
            var p_id = $(this).attr('id');
            var del = confirm('Bạn muốn xóa sản phẩm có mã ' + p_id + '?\r\nMọi hình ảnh của sản phẩm này cũng sẽ bị xóa.');
            if(del == true){
                $(this).attr('href', 'admin.php?page=products&q=delete_product&p_id=' + p_id);
            }else{
                $(this).attr('href', '');
            }            
       }); 
    })    
</script>