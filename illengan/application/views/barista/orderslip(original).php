<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Il-Lengan | Orderslip </title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/bootstrap.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/jquery.dataTables.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/dataTables.bootstrap4.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/style.css'?>">
</head>
<body>
<div class="nav nav-tabs"><a href="<?php echo site_url('barista/orders'); ?>" class="nav nav-link" role="tab">Orderlist</a> &nbsp;
            <a href="<?php echo site_url('barista/pendingStatus'); ?>" class="nav nav-link" role="tab">Pending Orders</a> &nbsp;
            <a href="<?php echo site_url('barista/servedStatus'); ?>" class="nav nav-link" role="tab">Served Orders</a>
            <a href="<?php echo site_url('barista/orderslip'); ?>" class="nav nav-link active" role="tab">Orderslip</a>
            </div>
            <br>
<div class="container">

            <table class="table table-striped" id="mydata" >
                <thead>
                    <tr>
                        <th>Slip No.</th>
                       <!-- <th>Order Item No.</th> -->
                        <th>Customer Name</th>
                        <th>Table</th>
                        <th>Order</th>
                        <th>Order Qty</th>
                        <!--<th>Item Status</th>-->
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                    
                </tbody>
            </table>
      </div>
        


<!-- MODAL EDIT -->
<form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Table Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Order Id</label>
                            <div class="col-md-10">
                              <input type="text" name="order_id_edit" id="order_id_edit" class="form-control" placeholder="Order Id" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">New Table Code</label>
                            <div class="col-md-10">
                              <input type="text" name="table_code_edit" id="table_code_edit" class="form-control" placeholder="New Table Code">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL EDIT-->

        <!--MODAL DELETE-->
        <form>
            <div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Are you sure to remove this record?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="order_id_remove" id="order_id_remove" class="form-control">
                    <button type="button" type="submit" id="btn_cancel" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL DELETE-->

        

<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/dataTables.bootstrap4.js'?>"></script>

<script type="text/javascript">
var table = $('#mydata');
$(document).ready(function() {
	  table.DataTable( {
             ajax: {
                 url: "http://www.illengan.com/barista/orders_b",
                 dataSrc: ''
             },
		    colReorder: {
			realtime: true
		    },
            "aoColumns" : [
                {data : 'order_id'},
                {data : 'cust_name'},
                {
                  data: null,
                    render: function ( data, type, row, meta) {
                        return data.table_code+
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-order_id="'+data.order_id+'" data-table_code="'+data.table_code+'">Edit</a>';
                    }        
                },

                {data : 'order_desc'},
                {data : 'order_qty'},
               /* {
                    data: null,
                    render: function ( data, type, row, meta) {
                        return '<button id="status" class="status btn dt-buttons '+ data.item_status +
                        '" data-order_item_id="'+ data.order_item_id +'"'+
                        ' data-item_status="'+ data.item_status +'" onclick="change_status()">'+ data.item_status +'</button>';
                    }
                },*/
      
                {data: null,
                    render: function ( data, type, row, meta) {
                        return '<a href="javascript:void(0);" class="btn btn-warning btn-sm item_delete" data-order_id="'+data.order_id+'">Cancel</a>';
                               
                    }        
                }

		    ]
	        } );

});



//function for editing Table code
$('#show_data').on('click','.item_edit',function(){
            var order_id = $(this).data('order_id');
            var table_code        = $(this).data('table_code');
            
            $('#Modal_Edit').modal('show');
            $('[name="order_id_edit"]').val(order_id);
            $('[name="table_code_edit"]').val(table_code);
        });

        //update record to database
         $('#btn_update').on('click',function(){
            var order_id = $('#order_id_edit').val();
            var table_code = $('#table_code_edit').val();
            $.ajax({
                type : "POST",
                url  : "http://illengan.com/barista/editTableNumber",
                dataType : "JSON",
                data : {order_id:order_id , table_code:table_code},
                success: function(data){
                    $('[name="order_id_edit"]').val("");
                    $('[name="table_code_edit"]').val("");
                    $('#Modal_Edit').modal('hide');
                    alert("Table Code was successfully updated!");
                    location.reload();
                    //view_product();
                }
            });
            return false;
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var order_id = $(this).data('order_id');
            
            $('#Modal_Remove').modal('show');
            $('[name="order_id_remove"]').val(order_id);
        });

        //delete record to database
         $('#btn_cancel').on('click',function(){
            var order_id = $('#order_id_remove').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('barista/cancel')?>",
                dataType : "JSON",
                data : {order_id:order_id},
                success: function(data){
                    $('[name="order_id_remove"]').val("");
                    alert("Record removed successfully!");
                    $('#Modal_Remove').modal('hide');
                    
                    location.reload();
                }
            });
            return false;
        });

//change status function
/*$('.status').on('click', function() {
        var orderItemId = $(this).data("order_item_id");
        var itemStatus = $(this).data("item_status");
        var item_status;
        if(itemStatus === "pending") {
            item_status = "ongoing";
        } else if(itemStatus === "ongoing") {
            item_status = "done";
        } else if(itemStatus === "done") {
            item_status = "served";
        }else if(itemStatus === "served"){
            item_status = "pending";
        }
    
        // AJAX CODE FOR POSTING NEW STATUS
        $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/barista/change_status',
        data: {
            order_item_id: orderItemId,
            item_status: item_status
        },
        success: function() {
            table.DataTable().ajax.reload(null, false);
        }
            });
  });*/


</script>

</body>
</html>
