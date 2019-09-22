<!DOCTYPE html>
<html>

<head>
  <!-- <meta http-equiv="refresh" content="3"> -->
  <?php include_once('templates/head.php') ?>
</head>

<body style="background:whitesmoke">
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
            <button id="multiplePay" class="pay btn btn-sm btn-info" data-toggle="modal" data-target="#Modal_Pay" onclick="getSelectedSlips();" style="margin:5px; width: 130px;">Pay Multiple Slips</button>
            <table id="ordersTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead class="thead-dark">
                <tr>
                  <th></th>
                  <th class="pull-left">SLIP NO.</th>
                  <th class="pull-left">CUSTOMER</th>
                  <th class="pull-left">TABLE CODE</th>
                  <th class="pull-left">TOTAL PAYABLE</th>
                  <th class="pull-left">ORDER DATE</th>
                  <th class="pull-left">STATUS
                  <th class="pull-left">ACTIONS</th>
                </tr>
              </thead>
              <!--Start Table Body-->
              <tbody>
              </tbody>
            </table>
          </div>
          <!--End Table-->
        </div>
      </div>
    </div>
  </div>

  <!--Start MODAL for BILL COMPUTATION-->
  <div class="modal fade" id="Modal_Pay" name="Modal_Pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLable">Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!--Modal Content-->
        <!--Table containing the different input fields in billings -->
        <table class="orderitemsTable table table-sm table-borderless">
          <thead class="thead-light">
            <tr>
              <th></th>
              <th style="width: 200px;">Item Name</th>
              <th style="width: 150px;">Qty</th>
              <th style="width: 150px;">Price</th>
              <th style="width: 150px;">*Add-on Total</th>
              <th style="width: 150px;">Subtotal</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <!--End Table Content-->
        <form id="formEdit" accept-charset="utf-8">
          <div class="modal-body">
            <div class="align-center"><input type="checkbox" class="discount form-control-sm" name="discount" id="discount" style="margin-right: 10px">Senior Citizen Discount</div>
            <!--Quantity-->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                  Amount Payable</span>
              </div>
              <input type="text" step="any" min="0" class="form-control" name="amount_payable" id="amount_payable" readonly>
              <span class="text-danger"><?php echo form_error("amount_payable"); ?></span>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                  Cash</span>
              </div>
              <input type="number" step="any" min="0" class="form-control" name="cash" id="cash" value="0.00" required>
              <span class="text-danger"><?php echo form_error("cash"); ?></span>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                  Change</span>
              </div>
              <input type="text" step="any" min="0" class="form-control" name="change" id="change" value="0.00" readonly>
              <span class="text-danger"><?php echo form_error("change"); ?></span>
            </div>
            <input type="hidden" class="form-control" name="osID" id="osID" readonly>
            <!--Footer-->
            <div class="modal-footer">
              <button type="button" id="closeBillModal" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
              <button class="btn btn-success btn-sm" id="updtbutton" type="submit">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--End MODAL for BILL COMPUTATION-->
  <!--Start MODAL2 for BILL COMPUTATION-->
  <div class="modal fade" id="Modal_Pay2" name="Modal_Pay2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLable">Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!--Modal Content-->
        <!--Table containing the different input fields in billings -->
        <table class="orderitemsTable table table-sm table-borderless">
          <thead class="thead-light">
            <tr>
              <th></th>
              <th style="width: 200px;">Item Name</th>
              <th style="width: 150px;">Qty</th>
              <th style="width: 150px;">Price</th>
              <th style="width: 150px;">*Add-on Total</th>
              <th style="width: 150px;">Subtotal</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <!--End Table Content-->
        <form id="formEdit" class="formEdit2" accept-charset="utf-8">
          <div class="modal-body">
            <div class="align-center"> <input type="checkbox" class="discount2 form-control-sm" name="discount2" id="discount2" style="margin-right: 10px"> Senior Citizen Discount</div>
            <!--Quantity-->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                  Amount Payable</span>
              </div>
              <input type="text" step="any" min="0" class="form-control" name="amount_payable2" id="amount_payable2" readonly>
              <span class="text-danger"><?php echo form_error("amount_payable2"); ?></span>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                  Cash</span>
              </div>
              <input type="number" step="any" min="0" class="form-control" name="cash2" id="cash2" value="0.00" required>
              <span class="text-danger"><?php echo form_error("cash2"); ?></span>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                  Change</span>
              </div>
              <input type="text" step="any" min="0" class="form-control" name="change2" id="change2" value="0.00" readonly>
              <span class="text-danger"><?php echo form_error("change2"); ?></span>
            </div>

            <input type="hidden" class="form-control" name="osID2" id="osID2" readonly>
            <!--Footer-->
            <div class="modal-footer">
              <button type="button" id="closeBillModal" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
              <button class="btn btn-success btn-sm" id="updtbutton2" type="submit">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--End MODAL for BILL COMPUTATION-->

  <!--Start MODAL for DELETE-->
  <div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Remove Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="confirmDelete">
          <div class="modal-body">
            <h6 id="deleteTableCode"></h6>
            <p style="text-align:center;">Are you sure to remove the selected orderslip?</p>
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
    //-------------------------------POPULATE TABLE--------------------------
    var orderbills = [];
    var payChoice = [];
    var table = $('#ordersTable');

    function viewOrderbillsJS() {
      $.ajax({
        url: "<?= site_url('barista/orderBillsJS') ?>",
        method: "post",
        dataType: "json",
        success: function(data) {
          console.log(data);
          orderbills = data;
          setOrderBills(orderbills);
        },
        error: function(response, setting, errorThrown) {
          console.log(response.responseText);
          console.log(errorThrown);
          console.log(data);
        }
      });
    }

    $(function() {
      viewOrderbillsJS();
    });
    
    function setOrderBills() {
      if ($("#ordersTable> tbody").children().length > 0) {
        $("#ordersTable> tbody").empty();
      }
      orderbills.forEach(orders => {
        $("#ordersTable> tbody").append(`
            <tr class="stockelem" data-osID="${orders.osID}" data-payable="${orders.osTotal}" data-custName="${orders.custName}">
                    <td><input type="checkbox" name="payChoice[]" class="choiceStock mr-2" value="${orders.osID}"></td>
                    <td>${orders.osID}</td>
                    <td>${orders.custName}</td>
                    <td>${orders.tableCode}</td>
                    <td>${orders.osTotal}</td>
                    <td>${orders.osDateTime}</td>
                    <td>${orders.payStatus}</td>
                    <td>
                                    <!--Action Buttons-->
                                    <div class="onoffswitch">
                                    <!--Pay Button-->
                                    <button class="pay2 btn btn-sm btn-info" data-toggle="modal" data-target="#Modal_Pay2" onclick="setOsID(${orders.osID})">Pay</button>           
                                    </div>
                    </td>
            </tr>`);

        $(".pay2").last().on('click', function() {

          $("#Modal_Pay2").find("input[name='amount_payable2']").val($(this).closest("tr").attr(
            "data-payable"));
          $("#Modal_Pay2").find("input[name='osID2']").val($(this).closest("tr").attr(
            "data-osID"));
          $("#Modal_Pay2").find("input[name='custName2']").val($(this).closest("tr").attr(
            "data-custName"));
          $("#Modal_Pay2").find("input[name='amount_payable2']").attr("data-payable", $(this).closest("tr").attr(
            "data-payable"));

        });
        $(".pay").last().on('click', function() {

          $("#Modal_Pay").find("input[name='amount_payable']").val($(this).closest("tr").attr(
            "data-payable"));
          $("#Modal_Pay").find("input[name='osID']").val($(this).closest("tr").attr(
            "data-osID"));
          $("#Modal_Pay").find("input[name='custName']").val($(this).closest("tr").attr(
            "data-custName"));

        });
        $(".item_delete").last().on('click', function() {

          $("#deleteSpoilage").find("input[name='prID']").val($(this).closest("tr").attr(
            "data-id"));
          $("#deleteSpoilage").find("input[name='msID']").val($(this).closest("tr").attr(
            "data-id"));
        });
      });


    }
    //---------------------------------Populate OrderItems in Brochure--------------------------
    function setOsID($osID) {
      var value = $osID;
      $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/barista/getOrderItems',
        data: {
          osID: value
        },
        dataType: 'json',
        success: function(data) {
          item = data;
          setItemData(item);
          console.log(item);
        },
        failure: function() {
          console.log('None');
        },
        error: function(response, setting, errorThrown) {
          console.log(errorThrown);
          console.log(response.responseText);
        }
      });
    }

    function setItemData(item) {
      $(".orderitemsTable> tbody").empty();
      $(".orderitemsTable> tbody").append(`${item.map(items =>{
              return `<tr>
                            <td></td>
                            <td><input type="text" name="olDesc" class="form-control form-control-sm"  value="${items.olDesc}" required readonly></td>
                            <td><input type="text" name="olQty" class="form-control form-control-sm"  value="${items.olQty}" required readonly></td>
                            <td><input type="text" name="olPrice" class="form-control form-control-sm"  value="${items.olPrice}" required readonly></td>
                            <td><input type="text" name="aoTotal" class="form-control form-control-sm"  value="${items.aoTotal}" required readonly></td>
                            <td><input type="text" name="olSubtotal" class="form-control form-control-sm"  value="${items.olSubtotal} " required readonly></td>
                            <td></td>
                      </tr>`
            }).join('')}`);
    }


    //---------------------For Resolving Payment Single Payment---------------------------
    $(document).ready(function() {
      $("#Modal_Pay2 form").on('submit', function(event) {
        event.preventDefault();
        var osID = $(this).find("input[name='osID2']").val();
        console.log(osID);
        $.ajax({
          url: "<?= site_url("barista/updatePayment2") ?>",
          method: "post",
          data: {
            osID: osID,
          },
          dataType: "json",
          complete: function() {
            $("#Modal_Pay2").modal("hide");
            location.reload();
          },
          error: function(error) {
            console.log(error);
          }

        });
      });
    });

    //-----------------------For the Payment Modal Multiple Payment-------------------------
    document.getElementById("updtbutton").disabled = true;
    $("#cash").on('change', function() {
      var payable = parseFloat(document.getElementById('amount_payable').value);
      var cash = parseFloat(document.getElementById('cash').value);
      if (cash < payable) {
        $("#Modal_Pay").find("input[name='change']").val("Insufficient Amount");
        document.getElementById("updtbutton").disabled = true;
      } else {
        var change = parseFloat(cash - payable);
        $("#Modal_Pay").find("input[name='change']").val(change);
        document.getElementById("updtbutton").disabled = false;
      }

    });
    //-----------------------For the Payment Modal Single Payment-------------------------
    document.getElementById("updtbutton2").disabled = true;
    $("#cash2").on('change', function() {
      var payable = parseFloat(document.getElementById('amount_payable2').value);
      var cash = parseFloat(document.getElementById('cash2').value);
      var seniorDiscount = parseFloat(payable * 0.20);

      if (cash < payable) {
        $("#Modal_Pay2").find("input[name='change2']").val("Insufficient Amount");
        document.getElementById("updtbutton2").disabled = true;
      } else {
        var change = parseFloat(cash - payable);
        $("#Modal_Pay2").find("input[name='change2']").val(change);
        document.getElementById("updtbutton2").disabled = false;
      }

    });
    //------------------------Stocks Get Brochure Function-----------------------------------
    function getSelectedSlips() {

      $(".orderitemsTable > tbody").empty(); //empty table
      var osFinTotal = 0;
      var value = 0;
      var choices = document.getElementsByClassName('choiceStock');
      var stockChecked;
      for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
          value = choices[i].value;

          $.ajax({
            type: 'POST',
            url: 'http://www.illengan.com/barista/getOrderItems',
            data: {
              osID: value
            },
            dataType: 'json',
            async: false,
            success: function(data) {
              console.log(data);
              for (var i = 0; i <= data.length - 1; i++) {
                stockChecked = `<tr class="stockelem" data-osID="` + data[i].osID + `" >
                            <td></td>
                            <td><input type="text" id="olDesc` + i + `" name="olDesc"
                                    class="form-control form-control-sm" value="` + data[i].olDesc + `"  required></td>
                            <td><input type="text" id="olQty` + i + `" name="olQty"
                                    class="form-control form-control-sm"  value="` + data[i].olQty + `" readonly="readonly" required></td>
                            <td><input type="text" id="olPrice` + i + `" name="olPrice"
                                    class="form-control form-control-sm"  value="` + data[i].olPrice + `" readonly="readonly" required></td>
                            <td><input type="text" id="aoTotal` + i + `" name="aoTotal"
                                    class="aoTotal form-control form-control-sm" value="` + data[i].aoTotal + `" readonly="readonly" required></td>
                            <td><input type="text" id="olSubtotal` + i + `" name="olSubtotal"
                                    class="olSubtotal form-control form-control-sm" value="` + data[i].olSubtotal + `" readonly="readonly" required></td>
                            
                            <td></td>
                            </tr>`;
                $('.orderitemsTable > tbody').append(stockChecked);
              }

            }
          });
        }
        setTotal();
      }

    }

    function setTotal() {
      $(document).ready(function() {
        var osIDarr = [];
        var osID = [];
        var total = 0;
        var length = parseInt($('#Modal_Pay').find('.olSubtotal').length);

        for (var i = 0; i <= length - 1; i++) {
          var subtotal = 0;
          subtotal = parseFloat($("input[name='olSubtotal']").eq(i).val());
          total = total + subtotal;
          osID = $("input[name='olSubtotal']").eq(i).closest("tr").attr("data-osID");
          osIDarr.push(osID);
          console.log(osID);
        }

        //---------------------For Resolving Payment Multiple Payment---------------------------
        $("#Modal_Pay").find("input[name='amount_payable']").val(parseFloat(total));
        $("#Modal_Pay").find("input[name='amount_payable']").attr("data-payable", parseFloat(total));

        $("#Modal_Pay form").on('submit', function(event) {
          event.preventDefault();

          $.ajax({
            url: "<?= site_url("barista/updatePayment") ?>",
            method: "post",
            data: {
              osIDarr: JSON.stringify(osIDarr)
            },
            complete: function() {
              $("#Modal_Pay").modal("hide");
              location.reload();
            },
            error: function(error) {
              console.log(error);
            }

          });
        });
      });


    }
    $(document).on('click', '.discount', function() {
      var payable = parseFloat($('#amount_payable').data("payable"));
      if (document.getElementById('discount').checked) {
        var disPrice = parseFloat(payable - (0.20 * payable));
        $("#formEdit").find("input[name='amount_payable']").val(disPrice);
      } else {
        $("#formEdit").find("input[name='amount_payable']").val(payable);
      }
    });

    $(document).on('click', '.discount2', function() {

      var payable = parseFloat($('#amount_payable2').data("payable"));
      if (document.getElementById('discount2').checked) {
        var disPrice = parseFloat(payable - (0.20 * payable));
        console.log(disPrice);
        $(".formEdit2").find("input[name='amount_payable2']").val(disPrice);
      } else {
        $(".formEdit2").find("input[name='amount_payable2']").val(payable);
      }
    });
  </script>
</body>

</html>