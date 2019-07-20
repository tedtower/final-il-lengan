<body style="background: white">
    <div class="content">
        <div class="container-fluid">
            <br>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="card-content">
                        <!--Export button and Real Time Date & Time -->
                        <div style="overflow:auto;">
                            <p style="text-align:right; font-weight: regular; font-size: 16px;float:right">
                                <?php echo date("M j, Y -l"); ?>
                            </p>
                        </div>
                        <!--Card-->
                        <div style="overflow:auto">
                            <div class="card" style="float:left;width:100%">
                                <div class="card-header">
                                    <h6 style="font-size:15px;margin:0">Add Delivery</h6>
                                </div>
                                <form id="drForm" action="<?= site_url("admin/deliveryreceipt/edit")?>"
                                    accept-charset="utf-8" class="form">
                                    <div class="card-body">
                                        <input type="text" name="tID" hidden="hidden">
                                        <div class="form-row">
                                            <!--Supplier-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Supplier</span>
                                                </div>
                                                <input class="form-control status-level" data-level="1" require id="supplier" name="supplier" type="text" value="" id="supplier" readonly >
                                            </div>
                                            <!--Source-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Source</span>
                                                </div>
                                                <input class="form-control status-level" data-level="1" name="source" type="text" value="" id="source">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <!--Receipt-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Receipt</span>
                                                </div>
                                                <input class="form-control status-level" data-level="0" name="receipt" type="text" value="" id="receipt">
                                            </div>
                                            <!--Date-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Date</span>
                                                </div>
                                                <input class="form-control" name="date" id="date" type="date" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
                                            </div>
                                        </div>
                                        <!--Remarks-->
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="width:70px">Remarks</span>
                                            </div>
                                            <textarea type="text" data-level="0" name="remarks" class="status-level form-control form-control-sm"
                                                rows="1"></textarea>
                                        </div>

                                        <div class="ic-level-2">
                                            <table class="drItems table table-borderless">
                                                <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                    <tr>
                                                        <th width="25%" style="font-weight:500 !important;">Stock Item</th>
                                                        <th style="font-weight:500 !important;">Quantity</th>
                                                        <th style="font-weight:500 !important;">Actual Qty</th>
                                                        <th style="font-weight:500 !important;">Discount</th>
                                                        <th style="font-weight:500 !important;">Price</th>
                                                        <th style="font-weight:500 !important;">Subtotal</th>
                                                        <th width="15%" style="font-weight:500 !important;">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ic-level-3 deliveries">
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <span>Total: &#8369;<span class="total">0</span></span>
                                        <!--Total of the trans items-->
                                    </div>
                                    <div class="card-footer mb-0" style="overflow:auto">
                                        <button class="btn btn-success btn-sm" type="submit"
                                            style="float:right">Insert</button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="float:right">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
    <script>
    var drs = [];
    var drItems = [];
    var delrec = <?= json_encode($dr) ?>;
    var drItem = <?= json_encode($drItem) ?>;
    var id = parseInt(<?php echo $id ?>);

    $(function() {
        drs = delrec.filter(dr => dr.pID == id);
        drItems = drItem.filter(dri => dri.pID == id);
        $("input[name='supplier']").val(drs[0].spName);
        $('input[name="receipt"]').val(drs[0].receipt);
        $('input[name="source"]').val(drs[0].spAltName);
        $('textarea[name="remarks"]').val(drItems[0].tiRemarks);
        $('input[name="date"]').val(drs[0].pdate);
        $('.total').text(drs[0].pTotal);
        
        drItems.forEach(function(dri) {
            $("#drForm .ic-level-3").append(`
                <tr class="ic-level-1" data-dr="${dri.pID}" data-dri="${dri.piID}" data-trans="${dri.tiID} data">
                    <td style="padding:1% !important"><input type="text"
                            class="form-control form-control-sm" data-id="${dri.spmID}" data-actual="${dri.actual}" data-stid="${dri.stID}" value="${dri.merch}" name="spm" readonly></td>
                    <td style="padding:1% !important"><input type="number"
                            class="form-control form-control-sm" value='${dri.qty}' name="qty" required  min="0"></td>
                    <td style="padding:1% !important"><input type="number"
                            class="form-control form-control-sm" value='${dri.actual}' name="actual" required  min="0" readonly></td>
                    <td style="padding:1% !important"><input type="number"
                            class="form-control form-control-sm" value='${dri.tiDiscount}' name="discount"   min="0"></td>
                    <td style="padding:1% !important"><input type="number"
                            class="form-control form-control-sm" value="${dri.tiSubtotal}" name="price"  min="0" readonly></td>
                    <td style="padding:1% !important"><input type="number"
                            class="subtotal form-control form-control-sm" name="subtotal" value="${dri.tiSubtotal}" min="0" readonly></td>
                    <td style="padding:1% !important">
                        <select class="form-control form-control-sm" name="status">
                            <option value="" selected>Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="delivered">Delivered</option>
                            <option value="partially delivered">Partially Delivered</option>
                        </select>
                    </td>
                    <input type="hidden" name="tiActualCur" hidden="hidden" value='${dri.actual}' >
                </tr>`);
        $("select[name='status']").find(`option[value=${dri.piStatus}]`).attr("selected", "selected");
        });

        $(document).on("change","input[name='qty']", function(drs) {
            var total = 0;
            var subtotal = $(this).val() * $(this).closest(".drItems > tbody > tr").find("input[name='price']").val();
            $(this).closest(".drItems > tbody > tr").find("input[name='subtotal']").val(subtotal);

            for(var i = 0; i <= $('.subtotal').length-1; i++) {
                total = total + parseFloat($('.subtotal').eq(i).val());
                $('.total').text(total);
            }
        });
        $(document).on("change","input[name='discount']", function(drs) {
           
                var subtotal = $(this).closest(".drItems > tbody > tr").find("input[name='subtotal']").val();
                var discount = $(this).closest(".drItems > tbody > tr").find("input[name='discount']").val();
                var disPrice = parseFloat(subtotal-discount);
                $("#drForm").find("input[name='subtotal']").val(disPrice);
                $('.total').text(disPrice);
        });

        $("#drForm").on("submit", function(event){
         event.preventDefault();
         var pID = id;
         var url = $(this).attr("action");
         var piID = isNaN(parseInt($(this).attr('data-dri'))) ? (null) : parseInt($(this).attr('data-dri'));
         drItems = [];
         var drTotal = 0;

         $(this).find(".ic-level-1").each(function(index){
             var date = $("#drForm").find("input[name='date']").val();
             var receipt = $("#drForm").find("input[name='receipt']").val();
             var remarks = $("#drForm").find("textarea[name='remarks']").val();
             var status = $(this).find("select[name='status']").val();
             var tiActualCur = $(this).find("input[name='tiActualCur']").val();
             var discount = $(this).find("input[name='discount']").val();
             var tiQty = parseInt($(this).find("input[name='qty']").val());
             var actQty = $(this).find("input[name='actual']").val();
             var spmID = parseInt($(this).find("input[name='spm']").attr('data-id'));
             var price = parseInt($(this).find("input[name='price']").val());
             var actualQty = tiQty * actQty;
             var subtotal = parseFloat(tiQty * price);
             drTotal = parseFloat(drTotal + subtotal);

             drItems.push({
                 tiID: isNaN(parseInt($(this).attr('data-trans'))) ? (null) : parseInt($(this).attr('data-trans')),
                 piID: isNaN(parseInt($(this).attr('data-dri'))) ? (null) : parseInt($(this).attr('data-dri')),
                 pID: isNaN(parseInt($(this).attr('data-dr'))) ? (null) : parseInt($(this).attr('data-dr')),
                 tiQty: tiQty,
                 date: date,
                 tiActual: actualQty,
                 tiSubtotal: subtotal,
                 tiRemarks:remarks,
                 tiActualCur:tiActualCur,
                 discount:discount

             }); 
             console.log(drItems);
            //  console.log("date" +date);
            // console.log("status" +status);
            // console.log("tiQty" +tiQty);
            // console.log("actQty" +actQty);
            // console.log("spmID" +spmID);
            // console.log("actualQty" +actualQty);
            // console.log("subtotal" +subtotal);
            // console.log("drTotal" +drTotal);
            // console.log("remarks" +remarks);
            // console.log("receipt" +receipt);
            // console.log(tiActualCur);
         }); 
         
         $.ajax({
             method: "POST",
             url: url,
             data: {
                 piID: piID,
                 piStatus: status,
                 drItems: JSON.stringify(drItems)
             },
             beforeSend: function() {
                    console.log(id, date, drItems);
            },
            // complete: function() {
            //     location.reload();
            // },
             error: function(response, setting, error) {
                 console.log(error);
                 console.log(response.responseText);
             }
         });
     });

    });

    $('#drForm').submit(function(event){
            var drEditDate = $("#date").val();
            var currentDate= new Date();
            if(Date.parse(currentDate) < Date.parse(drEditDate)){
                alert('Please check the date entered!');
                return false;
        }
    });
            </script>
</body>
    