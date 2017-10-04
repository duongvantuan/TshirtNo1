<?php    
    if(isset($_POST['add_manufacture'])){
        $tennsx = $_POST['tennhasx'];
        mysql_query("SET NAMES UFT8");
        $query = "INSERT INTO tbl_nhasx(TenNhaSX) VALUES('{$tennsx}')" ;                
        $result = mysql_query($query) or die ('Lỗi thêm nhà sx' . mysql_error());
        
        if($result){
            header("location:admin.php?page=products&q=success&s=9");
        }else{
            header('location:admin.php?page=products&q=error&e=9');
        }
    }
    
?>


<form method="POST" id="add-manufacture-form" action="admin.php?page=products&q=add_manufacture" enctype="multipart/form-data">
    <table border='1' width='700' >
        <p class="title">thêm nhà sản xuất</p>
        <tr>
            <th>Tên nhà sản xuất</th>
            <td><input type="text" name="tennhasx" size="70" onkeyup="check_exist(this.value)" />
                <p id="message"></p>
            </td></tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="button_big submit-btn" value="Thêm" style="margin-left: 10px;" name="add_manufacture" />
                <input type="reset" class="button_big" value="Nhập lại" />
            </td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    $(function()
      {
          $('#chuthich').wysiwyg();
      });
      
  
    $(document).ready(function(){
        $('#message').html("").hide();
        $("#add-manufacture-form").validate({
            rules: {tennhasx:{required: true}},
                  
            messages:{tennhasx:{required: "Vui lòng điền tên nhà sản xuất."}}
                     
        });	       
        
    });
    // kiểm tra sự tồn tại của tên nhà sản xuất
    function check_exist(str_tennhasx){
        $.ajax({
           type: "POST",
           url: "check_manufacture.php",
           data: "m_name=" + str_tennhasx,
           success: function(data){
                $('#message').html("");
                $('#message').show();
                $('#message').append(data);
           }
        });
    }

</script>