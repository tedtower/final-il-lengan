<!DOCTYPE html>
<html>

<head>
  <?php include_once('templates/head.php') ?>
</head>

<body style="background:white">
  <?php include_once('templates/navigation.php') ?>
  <!--End Top Nav-->
  <div class="content">
    <div class="container-fluid">
      <br>
      <p style="text-align:right; font-weight: regular; font-size: 16px">
        <!-- Real Time Date & Time -->
        <?php echo date("M j, Y - l"); ?>
      </p>
      <div class="content" style="margin-left:auto;">
        <div class="conteiner-fluid">
          <!--Start Table-->
          <div class="card-content">
            <table id="ordersTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead class="thead-dark">
                <tr>
                  <th class="pull-left">SLIP NO.</th>
                  <th class="pull-left">CUSTOMER NAME</th>
                  <th class="pull-left">TABLE CODE</th>
                  <th class="pull-left">DATE</th>
                  <th class="pull-left">TOTAL</th>
                  <th class="pull-center">ACTIONS</th>
                </tr>
              </thead>
              <!--Start Table Body-->
              <tbody id="orderslipData">
                <?php if (isset($bills)) {
                  foreach ($bills as $bill) {
                    ?>
                    <tr>
                      <td><?= $bill["osID"] ?></td>
                      <td><?= $bill["custName"] ?></td>
                      <td><?= $bill["tableCode"] ?></td>
                      <td><?= $bill["osDateTime"] ?></td>
                      <td><?= $bill["osTotal"] ?></td>
                      <td>
                        <button class="editBtn btn btn-sm btn-info" data-toggle="modal" data-target="#Modal_Pay">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#Modal_Remove">Archived</button>
                      </td>
                    </tr>

                  <?php }
              } ?>
              </tbody>
            </table>
          </div>
          <!--End Table-->
        </div>
      </div>
    </div>
  </div>

  <!--Start MODAL for EDIT TRANSACTION-->    
  
  <!--End MODAL for EDIT TRANSACTION-->

  <!--Start MODAL for DELETE-->
  <div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Remove Transaction</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="confirmDelete">
          <div class="modal-body">
            <h6 id="deleteTableCode"></h6>
            <p style="text-align:center;">Are you sure to remove the selected transaction?</p>
            <input type="text" name="" hidden="hidden">
            <div>
              Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--End MODAL for DELETE-->

  <?php include_once('templates/scripts.php') ?>

  <script>
    $(document).ready(function() {
      var bills = {};
      //   $("#open_modal").click(function(){
      //     $("#Modal_Pay").modal();
      //   });

      $('#except').on('click', 'td', function(e) {
        if ($(e.target).hasClass('except')) {
          e.stopPropagation();
        }
      });

      //   $('tr').click(function(event){
      //     console.log($(event.target).hasClass("except"));
      //     event.preventDefault();
      // });


      $('#remove_modal').on('click', function() {
        var osID = $(this).data('osID');


        $('#Modal_Remove').modal('show');
        $('[name="osID_remove"]').val(osID);
      });

      //delete record to database
      $('#btn_cancel').on('click', function() {
        var osID = $('#osID_remove').val();
        $.ajax({
          type: "POST",
          url: "<?php echo site_url('barista/cancel') ?>",
          dataType: "JSON",
          data: {
            osID: osID
          },
          success: function(data) {
            $('[name="osID_remove"]').val("");
            alert("Record removed successfully!");
            $('#Modal_Remove').modal('hide');

            table.DataTable().ajax.reload(null, false);
          }
        });
        return false;
      });

      //---------MAY AAYUSIN DITO---------------------------------------------------------
      $("#orderslipData> tbody").on("click", function() {
        var osId = $(this).data('osID');
        var osTotal = $(this).data('osTotal');
        $('#billModal').modal('show');
        $('[name="slipId"]').val(osID);
        $('[name="amount_payable"]').val(osTotal);

        $.ajax({
          method: "post",
          data: {
            osID: osId,
            osTotal: osTotal
          }

        });

      });


      //     console.log(orderId);
      //     if (bills[orderId] === undefined) {
      //         $.ajax({
      //             method: "post",
      //             url: "<//?php echo site_url('barista/orderBillsJS')?>",
      //             data: {
      //                 osID: orderId,
      //             },
      //             dataType: "json",
      //             success: function(bill) {
      //                 bills[orderId] = bill;            
      //                 setModalData(orderId);
      //             }
      //         });
      //     }else{            
      //         setModalData(orderId);
      //     }


      $("#cash").on('change', function() {
        if (isNaN(parseFloat($(this).val()))) {
          $(this).val('0.00');
          $("#change").val('0.00');
        } else {
          $(this).val(parseInt($(this).val()).toFixed(2));
          $("#change").val((parseFloat($(this).val()) - parseFloat($("#amount_payable").text())).toFixed(2));
        }
      });

      $("#update-pay-status-btn").on('click', function(event) {
        var status;
        if ($(this).attr("data-paystatus") === "Paid") {
          status = "p";
        } else {
          status = "u";
        }
        if (parseFloat($("#cash").val()) < parseFloat($("#amount_payable").text()) && status === "u") {
          alert("Customer Payment is insufficient!");
        } else {
          var orderId = $(this).attr("data-orderid");
          $.ajax({
            method: "post",
            url: "billings/setStatus",
            data: {
              osID: orderId,
              payStatus: status
            },
            dataType: "json",
            success: function(bill) {
              console.log(bill);
            }
          });
        }
      });
    });
  </script>
</body>

</html>