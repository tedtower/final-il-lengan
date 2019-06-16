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
      var orderslips = [];
      var orderlists = [];
      var addons = [];
      $(function() {
        $.ajax({
            url: '<?= base_url("barista/getOrderslip") ?>',
            dataType: 'json',
            success: function(data) {
                $.each(data.orderslips, function(index, item) {
                    orderslips.push({
                        "orderslips": item
                    });
                    orderslips[index].orderlists = data.orderlists.filter(ol => ol.osID == item.osID);
                });
                $.each(data.addons, function(index, item) {
                    addons.push({
                        "addons": item
                    });
                });
                console.log(orderslips);
                setPenOrdersData();
                console.log('Success');
            },
            error: function(response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
    });
      function setPenOrdersData() {
              orderslips.forEach(function(item) {
                    var header = `<div class="card" id="orderslip" style="display: inline-block;">
                    <div class="card border-info">
                        <div class="card-header">
                            <table class="table table-borderless table-sm">
                            <th>Slip No:${item.orderslips.osID}</th>
                                    <th>Table:${item.orderslips.tableCode}</th>

                                </tr>
                                <tr>
                                    <th>Name:${item.orderslips.custName}</th>
                                    <th>Status:${item.orderslips.payStatus}</th>
                                </tr>
                            </table>
                        </div>
                        <div class="card-body" id="orderlist" style="width: auto; height: auto;">
                        <table id="oList">
                    <thead><tr>
                                    <th>Order ID</th>
                                    <th>Quantity</th>
                                    <th>Desc</th>
                                    <th>Subtotal</th>
                                    <th>Remarks</th>
                            </tr></thead>
                            
                    ${item.orderlists.map(ol => {
                                    return `
                            <tbody>
                                    <tr>
                                        <td>${ol.olID}</td>
                                        <td>${ol.olQty}</td>
                                        <td>${ol.olDesc}</td>
                                        <td><span class="fs-24">₱</span>${ol.olSubtotal}</td>
                                        <td>${ol.olRemarks}</td>
                                    </tr>
                                    
                                    `;
                                }).join('')}  
                            </tbody>
                        </table>
                        </div> 
                    </div>
                </div>
                </div>
                        `;
                    $('.row').append(header);
              });
               addons.forEach(function(item){
                   var addons = `<tr>
                                    <td>${item.addons.aoID}</td>
                                    <td>${item.addons.aoQty}</td>
                                    <td>${item.addons.aoTotal}</td>
                                </tr>`;
                    $('.row').append(addons);

               });
              }
    </script>

</html>