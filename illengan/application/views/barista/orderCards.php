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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/responsive.bootstrap.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/select.bootstrap.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/buttons.bootstrap.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/style.css'?>">
    </head>
    <body>
    <div class="container">
    <div class="row" style="overflow-x: auto;">
    <div class="card" style="display: inline-block;">
        <div class="card border-info">
            <div class="card-header">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th>Slip No: <?php echo $slips['osID'] ?></th>
                        <th>Table: <?php echo $slips['tableCode'] ?> </th>

                    </tr>
                    <tr>
                        <th>Name: <?php echo $slips['custName'] ?></th>
                        <th>Status: <?php echo $slips['payStatus'] ?></th>
                    </tr>
                </table>
            </div>
            <div class="card-body" style="width: auto; height: auto;">
                <br>
                <button class="btn btn-link btn-sm" onClick="window.location.href = '<?php echo base_url();?>customer/processCheckIn';return false;">Add Order</button>
                <br>
                <table class="pendOrders dtr-inline collapsed table display table-sm" id="pendingordersTable" style="width: auto; height: auto;">
                  <thead>
                      <tr>
                          <!-- <th>Slip No.</th>
                          <th>Order Item No.</th> 
                         <th>Customer Name</th> -->
                          <th>Order Id</th>
                          <th>Qty</th>
                          <th>Order</th>
                          <th>Subtotal</th>
                          <th>Item Status</th>
                          <th style="text-align: right;">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
            </table>
            <br>
                <label>Total: <input type="text" style="border: 2px solid black; align: right" name="total_amount" id="total_amount" readonly></label>
            <div class="card-footer">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Remove_slip" id="bill_modal">Remove Slip</button>
            </div>
            </div> 
        </div>
     </div>
     </div>
    </div>
    <br>

           <!--MODAL TO CANCEL/(DELETE) AN ORDER -->

           <div class="modal fade" id="deleteOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="confirmDelete">
                    <div class="modal-body">
                    <strong>Are you sure to remove this record?</strong>
                    <input type="hidden" name="olID" id="olID" class="form-control">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
         <!--END OF MODAL TO CANCEL/(DELETE) AN ORDER -->

    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery-3.2.1.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/bootstrap.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery.dataTables.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/barista/tables.js'?>"></script>

    </body>

    <script>
          var penOrders = [];
          $(function() {
              viewOrderslipsJs();
          });

          //POPULATE TABLE
          var table = $('#pendingordersTable');
            function format(d) {
              return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td>Remarks</td>' +
                '</tr>' +
                '<tr>' +
                '<td>' + d.ssRemarks + '</td>' +
                '</tr>' +
                '</table>';

            }
            function viewOrderslipsJs() {
                  $.ajax({
                      url: "<?= site_url('barista/orderData') ?>",
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
                          <td>${table.olQty}</td>
                          <td>${table.olDesc}</td>
                          <td>${table.olSubtotal}</td>
                          <td><button id="status" class="status btn dt-buttons"></button></td>
                          <td>
                                  <!--Action Buttons-->
                                  <div class="onoffswitch">
                                      <!--Delete button-->
                                      <button class="item_delete btn btn-danger btn-sm" data-toggle="modal" 
                                      data-target="#deleteOrder">Cancel</button>                      
                                  </div>
                              </td>
                          </tr>
                          <tr>$nbsp;$nbsp;$nbsp;
                            <td></td>
                            <td>${table.aoName}</td>
                            <td>${table.aoPrice}</td>
                            <td>${table.olRemarks}</td>
                            </tr>`);
                      $(".item_delete").last().on('click', function () {
                          $("#deleteOrder").find("input[name='olID']").val($(this).closest("tr").attr(
                                    "data-olID"));
                      });

                  });

            }

    </script>

</html>