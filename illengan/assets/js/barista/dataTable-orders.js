$(document).ready(function(){
    show_product(); //call function show all product
     
    $('#mydata').dataTable();
      
    //function show all product
    function show_product(){
        $.ajax({
            type  : 'ajax',
            url   : 'http://www.illengan.com/index.php/chef/order_list',
            async : true,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<tr>'+
                            '<td>'+data[i].order_id+'</td>'+
                            '<td>'+data[i].table_code+'</td>'+
                            '<td>'+data[i].cust_name+'</td>'+
                            '<td>'+data[i].menu_name+'</td>'+
                            '<td>'+data[i].order_qty+'</td>'+
                            '<td>'+data[i].item_status+'</td>'+
                            '<td style="text-align:right;">'+
                                '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-order_id="'+data[i].order_id+'" data-menu_name="'+data[i].menu_name+'">Edit</a>'+' '+
                                '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-order_id="'+data[i].order_id+'">Delete</a>'+
                            '</td>'+
                            '</tr>';
                }
                $('#show_data').html(html);
            }

        });
    }

/*
    $('#btn_save').on('click',function(){
        var product_code = $('#product_code').val();
        var product_name = $('#product_name').val();
        var price        = $('#price').val();
        $.ajax({
            type : "POST",
            url  : "<?php echo site_url('product/save')?>",
            dataType : "JSON",
            data : {product_code:product_code , product_name:product_name, price:price},
            success: function(data){
                $('[name="product_code"]').val("");
                $('[name="product_name"]').val("");
                $('[name="price"]').val("");
                $('#Modal_Add').modal('hide');
                show_product();
            }
        });
        return false;
    });

    //get data for update record
    $('#show_data').on('click','.item_edit',function(){
        var product_code = $(this).data('product_code');
        var product_name = $(this).data('product_name');
        var price        = $(this).data('price');
         
        $('#Modal_Edit').modal('show');
        $('[name="product_code_edit"]').val(product_code);
        $('[name="product_name_edit"]').val(product_name);
        $('[name="price_edit"]').val(price);
    });

    //update record to database
     $('#btn_update').on('click',function(){
        var product_code = $('#product_code_edit').val();
        var product_name = $('#product_name_edit').val();
        var price        = $('#price_edit').val();
        $.ajax({
            type : "POST",
            url  : "<?php echo site_url('product/update')?>",
            dataType : "JSON",
            data : {product_code:product_code , product_name:product_name, price:price},
            success: function(data){
                $('[name="product_code_edit"]').val("");
                $('[name="product_name_edit"]').val("");
                $('[name="price_edit"]').val("");
                $('#Modal_Edit').modal('hide');
                show_product();
            }
        });
        return false;
    });

    //get data for delete record
    $('#show_data').on('click','.item_delete',function(){
        var product_code = $(this).data('product_code');
         
        $('#Modal_Delete').modal('show');
        $('[name="product_code_delete"]').val(product_code);
    });

    //delete record to database
     $('#btn_delete').on('click',function(){
        var product_code = $('#product_code_delete').val();
        $.ajax({
            type : "POST",
            url  : "<?php echo site_url('product/delete')?>",
            dataType : "JSON",
            data : {product_code:product_code},
            success: function(data){
                $('[name="product_code_delete"]').val("");
                $('#Modal_Delete').modal('hide');
                show_product();
            }
        });
        return false;
    }); */

});
