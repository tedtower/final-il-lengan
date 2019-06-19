$(document).on('click','.btn',function()
 { 
     var order_id = $('input[name="order_id"]').val();
     var menu_id = $('input[name="menu_id"]').val();
    var item_status = $('input[name="item_status"]').val();
    url = "<?php echo base_url().'index.php/Chef/change_status'?>"; 
        $.ajax({
          type:"POST",
          url: url, 
          data: {"order_id":order_id,"menu_id":menu_id,"item_status":item_status}, 
          success: function(data) { 
          location.reload();
    } }); 
 });