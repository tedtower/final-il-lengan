<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Il-Lengan | Barista Orders</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/jquery.dataTables.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/dataTables.bootstrap4.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/responsive.bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/select.bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/buttons.bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/style.css'?>">

</head>
<body>
    <div class = "nav na-tabs">
    <ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a href="<?php echo site_url('barista/orders') ?>" class="nav-link active" href="#pendingTab" role="tab" data-toggle="tab">Pending Orders</a>
  </li>
  <li class="nav-item">
    <a href ="<?php echo site_url('barista/servedOrderlist') ?>" class="nav-link" href="#servedTab" role="tab" data-toggle="tab">Served Orders</a>
  </li></ul>

    </div>
  <br>
  <div class="tab-content" id="pendingTab">
  <div class="container"><br>
  <button class="btn btn-link btn-sm" onClick="window.location.href = '<?php echo base_url();?>customer/processCheckIn';return false;">Add Order</button>
  <br>
            <table class="pendOrders dtr-inline collapsed table display" id="pendingordersTable" >
                <thead>
                    <tr>
                        <!--<th>Slip No.</th> -->
                        <th>Order Item No.</th>
                        <th>Customer Name</th>
                        <th>Table</th>
                        <th>Order</th>
                        <th>Order Qty</th>
                        <th>Item Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
    </div>


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

<script>
var penOrders = [];
$(function() {
		viewpendingOrdersJs();
});

//POPULATE TABLE
let UPDATE = 5000;
var table = $('#pendingordersTable');
	// function format(d) {
	// 	return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
	// 		'<tr>' +
	// 		'<td>Remarks</td>' +
	// 		'</tr>' +
	// 		'<tr>' +
	// 		'<td>' + d.ssRemarks + '</td>' +
	// 		'</tr>' +
	// 		'</table>';

	// }

	function viewpendingOrdersJs() {
        $.ajax({
            url: "<?= site_url('barista/pendingOrdersJS') ?>",
            method: "post",
            dataType: "json",
            success: function(data) {
                penOrders = data;
                setPenOrdersData(penOrders);
            },
            error: function(response, setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
        });
	}
	function setPenOrdersData() {
        if ($("#pendingordersTable> tbody").children().length > 0) {
            $("#pendingordersTable> tbody").empty();
        }
        penOrders.forEach(table => {
            $("#pendingordersTable> tbody").append(`
            <tr data-olID="${table.olID}" >
                <td>${table.olID}</td>
                <td>${table.custName}</td>
                <td>${table.tableCode}</td>
                <td>${table.olDesc}</td>
                <td>${table.olQty}</td>
                <td>${table.olStatus}</td>
                <td>
                        <!--Action Buttons-->
                        <div class="onoffswitch">
                            <!--Delete button-->
                            <button class="item_delete btn btn-danger btn-sm" data-toggle="modal" 
                            data-target="#Modal_Remove">Cancel</button>                      
                        </div>
                    </td>
                </tr>`);
            $(".item_delete").last().on('click', function () {
                $("#Modal_Remove").find("input[name='olID']").val($(this).closest("tr").attr(
                          "data-olID"));
            });
          
            $(".status").on('click', function() {
                var olID = $(this).data('olID');
                var order_status = $(this).data('olStatus');
                var item_status;

                if (order_status === "pending") {
                    item_status = "served";
                } else if (order_status === "served") {
                    item_status = "pending";
                }

                $.ajax({
                    type: 'POST',
                    url: 'http://www.illengan.com/barista/change_status',
                    data: {
                        olID: olID,
                        olStatus: item_status
                    },
                    success: function() {
                        location.reload();
                    }
                });

            });
            
        });
	}
	//END OF POPULATING TABLE
//start of new function
/*$('#show_data').on('click','.item_edit',function(){
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
        });*/

        //get data for delete record
        // $('#show_data').on('click','.item_delete',function(){
        //      var osID = $(this).data('osID');
            
        //      $('#Modal_Remove').modal('show');
        //      $('[name="order_id_remove"]').val(osID);
        //  });

        //  //delete record to database
        //   $('#btn_cancel').on('click',function(){
        //      var osID = $('#order_id_remove').val();
        //      $.ajax({
        //          type : "POST",
        //          url  : "<?php echo site_url('barista/cancel')?>",
        //          dataType : "JSON",
        //          data : {osID:osID},
        //          success: function(data){
        //              $('[name="order_id_remove"]').val("");
        //              alert("Record removed successfully!");
        //              $('#Modal_Remove').modal('hide');
                    
        //              location.reload();
        //          }
        //     });
        //      return false;
        //  });

// //change status function
// $('.status').on('click', function() {
//         var orderItemId = $(this).data("order_item_id");
//         var itemStatus = $(this).data("item_status");
//         var item_status;
//         if(itemStatus === "pending") {
//             item_status = "ongoing";
//         } else if(itemStatus === "ongoing") {
//             item_status = "done";
//         } else if(itemStatus === "done") {
//             item_status = "served";
//         }else if(itemStatus === "served"){
//             item_status = "pending";
//         }
    
//         // AJAX CODE FOR POSTING NEW STATUS
//         $.ajax({
//         type: 'POST',
//         url: 'http://www.illengan.com/barista/change_status',
//         data: {
//             order_item_id: orderItemId,
//             item_status: item_status
//         },
//         success: function() {
//             table.DataTable().ajax.reload(null, false);
//         }
//             });
//   });


</script>

</body>
</html>
