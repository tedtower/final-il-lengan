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
    <title>Il-Lengan | Barista Billings</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/jquery.dataTables.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/dataTables.bootstrap4.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/responsive.bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/select.bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/buttons.bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/barista/style.css'?>">
</head>
<body>
<body>
  <br>
  <div class="container">
    <p>*Click Table Rows for Payment*</p>
  <br>
      <table id="ordersData" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
          <th>Slip No.</th>
          <th>Customer</th>
          <th>Table No.</th>
          <th>Total</th>
          <th>Order Date</th>
          <th>Status</th>
          <th>Date Paid</th>
          <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php  if(isset($bills)){
                          foreach($bills as $bill) 
                          {  
                            ?> 
                               <tr>  
                                    <td><?= $bill["osID"]?></td>  
                                    <td><?= $bill["custName"]?></td>  
                                    <td><?= $bill["tableCode"]?></td>  
                                    <td><?= $bill["osTotal"]?></td>  
                                    <td><?= $bill["osDate"]?></td>  
                                    <td><?= $bill["payStatus"]?></td>  
                                    <td><?= $bill["osPayDate"]?></td>  
                                    <td><button id="remove_data" class="btn btn-warning btn-sm">Remove</button></td>  
                               </tr>    
                         
                          <?php } 
                        } ?>  
        </tbody>
    </table> 
    </div>

     <!--MODAL FOR BILL COMPUTATION-->
        <form method="post" action="">
            <div class="modal fade" id="Modal_Pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-10 col-form-label">Amount Payable: </label>
                            <div class="col-md-10">
                              <input type="text" name="totalamountpayable" id="totalamountpayable" value=" <?php echo $bill['osTotal'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label">Cash:</label>
                            <div class="col-md-10">
                              <input type="text" name="cash" id="cash" value="0.00" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label">Change:</label>
                            <div class="col-md-10">
                              <input type="text" name="change" id="change" value="0.00" readonly>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" id="update-pay-status-btn" data-orderid="">Submit</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
        
        <!--END FOR MODAL COMPUTATION-->
       

            <!--MODAL DELETE-->
            <form>
            <div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Remove order slip?</strong>
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
     
    </script>
</body>
</html>