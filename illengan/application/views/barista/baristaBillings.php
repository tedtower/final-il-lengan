<!DOCTYPE html>
<html>
    <head>
        <?php include_once('templates/head.php') ?>
    </head>
    <body>
        <?php include_once('templates/navigation.php') ?>
        <!--End Top Nav-->
        <div id="billModal">
            <h5>Order No : </h5><!-- Order ID -->
            <p id="orderNo"></p>
            <h5>Table Code : </h5><!-- Table Code -->
            <p id="tableCode"></p>
            <h5>Customer Name : </h5><!-- Customer Name -->
            <p id="customerName"></p>
            <h5>Payment Status: </h5><!-- Payment Status -->
            <p id="paymentStatus"></p>
            <h5>Payment Date and Time: </h5><!-- Payment Status -->
            <p id="paymentDate"></p>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="orderList">
                            <td class="itemNames"></td>
                            <td class="itemQty"></td>
                            <td class="itemPrice"></td>
                        </tr>
                        <tr>
                            <td cols="2">Amount Payable</td>
                            <td id="totalamountpayable"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <div class="d-inline-block">
                    <label for="cash">Cash: </label>
                    <input type="text" id="cash" name="cash" value="0.00" />
                </div>
                <div>
                    <label for="change">Change: </label>
                    <input type="text" id="change" name="change" value="0.00" readonly="readonly" />
                </div>
            </div>
            <div class="d-inline-block">
                <button type="button" class="closemodal">Close</button>
                <button type="button" id="update-pay-status-btn" data-orderid="">Submit</button>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <!--Table-->
                    <div class="card-content">
                        <!--Search
                    <div id ="example_filter" class="dataTables_filter">
                        <label>
                        "Search:"
                        <div class="form-group form-group-sm is-empty">
                           <input type="search" class="form-control" placeholder aria-controls="example">
                               <span class="material-input"></span> 
                        </div>
                        </label>
                    </div>-->
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
                            <thead>
                                <th><b class="pull-left">Slip No.</b></th>
                                <th><b class="pull-left">Table No.</b></th>
                                <th><b class="pull-left">Customer Name</b></th>
                                <th><b class="pull-left">Amount Payable</b></th>
                                <th><b class="pull-left">Payment Status</b></th>
                                <th><b class="pull-left">Action</b></th>
                            </thead>
                            <tbody>
                                <!--Insert PHP-->
                    <?php 
                        if(!empty($bills)){
                            foreach($bills as $bill){
                    ?>
                                <tr>
                                    <td>
                                        <?php echo $bill['osID'] ?>
                                        <!--insert PHP echo e.g. "?php echo $row->code; ?>-->
                                    </td>
                                    <td>
                                        <?php echo $bill['tableCode'] ?>
                                        <!--insert PHP echo e.g. "?php echo $row->code; ?>-->
                                    </td>
                                    <td>
                                        <?php echo $bill['custName'] ?>
                                        <!--insert PHP echo e.g. "?php echo $row->code; ?>-->
                                    </td>
                                    <td>
                                        <?php echo $bill['osTotal'] ?>
                                        <!--insert PHP echo e.g. "?php echo $row->code; ?>  data-toggle="modal"  data-target=""-->
                                    </td>
                                    <td>
                                        <?php echo $bill['payStatus'] ?>
                                    </td>
                                    <td>
                                        <div class="onoffswitch">
                                            <!--View button-->
                                            <button class="btn btn-info btn-sm view-btn"
                                                data-orderid="<?php echo $bill['osID']?>">View</button>
                                            <!--Cancel button-->
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php            
                            }
                        }
                    ?>
                            </tbody>
                            <!--End Table Content-->
                        </table>
</body>

<!--   Core JS Files   -->
<script src="<?php echo framework_url()."mdb/js/jquery-3.3.1.min.js"?>" type="text/javascript"></script>
<script src="assets/js/barista/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo framework_url()?>assets/js/barista/light-bootstrap-dashboard.js?v=1.4.0"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/barista/demo.js"></script>

<!-- separate file -->
<script>
var bills = {};
$(function() {
    // $('table tbody tr  td').on('click', function() {
    //     $("#myModal").modal("show");
    //     $("#txtfname").val($(this).closest('tr').children()[0].textContent);
    //     $("#txtlname").val($(this).closest('tr').children()[1].textContent);
    // });

    $("button[class~='view-btn']").on("click", function() {
        var orderId = $(this).attr("data-orderid");
        console.log(orderId);
        if (bills[orderId] === undefined) {
            $.ajax({
                method: "post",
                url: "<?php echo site_url('barista/getBillDetails')?>",
                data: {
                    osID: orderId
                },
                dataType: "json",
                success: function(bill) {
                    bills[orderId] = bill;            
                    setModalData(orderId);
                }
            });
        }else{            
            setModalData(orderId);
        }
    });

    $("#cash").on('change', function() {
        if (isNaN(parseFloat($(this).val()))) {
            $(this).val('0.00');
            $("#change").val('0.00');
        } else {
            $(this).val(parseInt($(this).val()).toFixed(2));
            $("#change").val((parseFloat($(this).val()) - parseFloat($("#totalamountpayable").text())).toFixed(2));
        }
    });

    $("#update-pay-status-btn").on('click', function(event){
        var status;
        if($(this).attr("data-paystatus") === "Paid"){
            status = "p";
        }else{
            status = "u";
        }
        if(parseFloat($("#cash").val()) < parseFloat($("#totalamountpayable").text()) && status === "u"){
            alert("Customer Payment is insufficient!");
        }else{
            var orderId = $(this).attr("data-orderid");
            $.ajax({
                method: "post",
                url: "billings/setStatus",
                data: {
                    osID: orderId,
                    payStatus: status
                }, 
                dataType: "json",
                success: function(bill){
                    console.log(bill);
                }
            });
        }       
    });

});

function setModalData(orderId) {
    var listLength = bills[orderId]['orderlists'].length;
    var listRow = `<tr class="orderList">
                            <td class="itemNames"></td>
                            <td class="itemQty"></td>
                            <td class="itemPrice"></td>
                        </tr>
                        `;
    removeModalData();
    console.log(bills[orderId]['orderslips']['osID']);
    $("#orderNo").text(bills[orderId]['orderslips']['osID']);
    $("#tableCode").text(bills[orderId]['orderslips']['tableCode']);
    $("#customerName").text(bills[orderId]['orderslips']['custName']);
    $("#paymentStatus").text(bills[orderId]['orderslips']['payStatus']);
    $("#paymentDate").text(bills[orderId]['orderslips']['osPayDate']);
    for(var index = 0 ; index < listLength ; index++){
        $("#billModal table tbody").last().before(listRow);
        $(".itemNames").eq($("orderList").length-1).text(bills[orderId]['orderlists'][index]["olDesc"]);
        $(".itemQty").eq($("orderList").length-1).text(bills[orderId]['orderlists'][index]["olQty"]);
        $(".itemPrice").eq($("orderList").length-1).text(bills[orderId]['orderlists'][index]["olSubtotal"]);
    }
    if(bills[orderId]["orderslips"]["payStatus"] === "Paid"){
        $("#cash").attr("disabled","disabled");
        $("#change").attr("disabled","disabled");
        $("#update-pay-status-btn").text("Unpay");
    }else{        
        $("#cash").removeAttr("disabled");
        $("#change").removeAttr("disabled");
        $("#update-pay-status-btn").text("Pay");
    }
    $("#totalamountpayable").text(bills[orderId]['orderslips']['osTotal']);
    $("#update-pay-status-btn").attr("data-orderid", bills[orderId]["orderslips"]["osID"]);
    $("#update-pay-status-btn").attr("data-paystatus", bills[orderId]["orderslips"]["payStatus"]);
}

function removeModalData(){    
    $("#orderNo").empty();
    $("#tableCode").empty();
    $("#customerName").empty();
    $("#paymentStatus").empty();
    $("#paymentDate").empty();
    $(".orderList").remove();
    $("#cash").val('0.00');
    $("#change").val('0.00');
    $("#update-pay-status-btn").attr("data-orderid", "");    
    $("#update-pay-status-btn").attr("data-paystatus", "");
}
</script>

</html>
