<?php
    include 'delete_invi.php';
?>  
<table border='1' class="tables-admin">
    <p class="title">danh sách nhà sản xuất</p>
    <th>Tên nhà sản xuất</th>
    <th>Thao tác</th>
<?php
    $query = "SELECT * FROM tbl_nhasx ";
    $result = mysql_query($query);
    $records = mysql_num_rows($result);
        
    $totalpages = ceil($records / 5);

    if(isset($_GET['p'])){
        $cur_page = $_GET['p'];
    }
    else{
        $cur_page = 1;
    }
    
    
    for($i = 1; $i <= $totalpages; $i++){
        echo "<a href='admin.php?page=products&q=view_manufactures&p={$i}' class='paging" . (($i == $cur_page) ? " cur-page" : "") . "'>{$i}</a>&nbsp;";
    }
    
    $start = ($cur_page - 1) * 5;
    
    $query .= "LIMIT {$start}, 5;";
    $result = mysql_query($query);
    $count = 0;    
    
    while($rows=mysql_fetch_array($result)){    
        
        echo "<tr><td>{$rows['TenNhaSX']}</td>
                <td>
                    <a href='admin.php?page=products&q=edit_manufacture&m_id={$rows['MaNhaSX']}'>Sửa</a><br /><br />
                    <a href='' class='delete_invi' style='display:none;' id='{$rows['MaNhaSX']}'>Xóa</a>
                </td>
              </tr>";
    }
?>
</table>
<script type="text/javascript">
    $(document).ready(function(){
       $('.delete_invi').click(function(){
        
            var m_id = $(this).attr('id');
            var del = confirm('Bạn muốn xóa nhà sản xuất có mã ' + m_id + '?');
            if(del == true){
                $(this).attr('href', 'admin.php?page=products&q=delete_manufacture&m_id=' + m_id);
            }else{
                $(this).attr('href', '');
            }            
       }); 
    })  
</script>