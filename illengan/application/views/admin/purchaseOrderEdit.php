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
                            <div class="card">
                                <div class="card-header">
                                    <h6 style="font-size:15px;margin:0">Edit Purchase Order</h6>
                                </div>
                                <form id="conForm"  action="<?= site_url("admin/purchaseorder/edit")?>" accept-charset="utf-8" class="form">
                                    <div class="card-body">
                                        <input type="text" name="tID" hidden="hidden">
                                        <div class="form-row">
                                            <!--Supplier-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Supplier</span>
                                                </div>
                                                <input type="text" class="suppliers form-control form-control-sm" name="suppliers" readonly>
                                            </div>
                                            <!--Date-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Date</span>
                                                </div>
                                                <input class="form-control form-control-sm" name="date" id="date" type="date" data-validate="required" message="End Date is required!"  required>
                                            </div>
                                        </div>
                                        <!--Remarks-->
                                        <!-- <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="width:70px">Remarks</span>
                                            </div>
                                            <textarea type="text" name="tRemarks" class="form-control form-control-sm"
                                                rows="1"></textarea>
                                        </div> -->
                                        <div class="ic-level-3">
                                        <table class="poitems table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                <tr>
                                                    <th style="font-weight:500 !important;width: 30%">Item Name</th>
                                                    <th style="font-weight:500 !important;">Qty</th>
                                                    <th style="font-weight:500 !important;">Unit</th>
                                                    <th style="font-weight:500 !important;">Price</th>
                                                    <th style="font-weight:500 !important;">Subtotal</th>
                                                    <th style="font-weight:500 !important;width:17%">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">

                                            </tbody>
                                        </table>
                                    </div>

                                        <br>
                                        <span>Total: &#8369;<span class="total"></span></span>
                                    </div>
                                    <div class="card-footer mb-0" style="overflow:auto">
                                        <button class="btn btn-success btn-sm" type="submit"
                                            style="float:right">Insert</button>
                                        <a href="<?= site_url('admin/purchaseorder')?>" class="btn btn-danger btn-sm"
                                            style="float:right" role="button">Cancel</a>
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
    var pos = [];
    var poitems = [];
    var supplier = <?= json_encode($supplier)?>;
    var suppmerch = <?= json_encode($suppmerch)?>;
    var purchaseOrder = <?= json_encode($pos) ?>;
    var poItems = <?= json_encode($poitems) ?>;
    var id = parseInt(<?php echo $id ?>);


    $(function() {
        pos = purchaseOrder.filter(po => po.id == id);
        poitems = poItems.filter(poi => poi.pID == id);
        $("input[name='suppliers']").val(pos[0].supplierName);
        $('input[name="date"]').val(pos[0].transDate);
        console.log(pos);

        $('.total').text(pos[0].total);

        poitems.forEach(function(poi, spm) {
            $("#conForm .ic-level-2").append(`
                <tr class="ic-level-1" data-po="${poi.pID}" data-poi="${poi.piID}" data-trans="${poi.tiID}">
                    <td style="padding:1% !important"><input type="text"
                            class="form-control form-control-sm" data-id="${poi.spmid}" data-actual="${poi.spmActual}" data-stid="${poi.stID}" value="${poi.spmName}" name="spm" readonly></td>
                    <td style="padding:1% !important"><input type="number"
                            class="form-control form-control-sm" value='${poi.qty}' name="qty" required></td>
                    <td style="padding:1% !important"><input type="text"
                            class="form-control form-control-sm" data-uom="${poi.uomID}" value="${poi.uomAbbreviation}" name="unit" readonly></td>
                    <td style="padding:1% !important"><input type="number"
                            class="form-control form-control-sm" value="${poi.spmPrice}" name="price" readonly></td>
                    <td style="padding:1% !important"><input type="number"
                            class="subtotal form-control form-control-sm" name="subtotal" value="${poi.subtotal}" readonly></td>
                    <td style="padding:1% !important">
                        <select class="form-control form-control-sm" name="status">
                            <option value="" selected>Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="delivered">Delivered</option>
                            <option value="partially delivered">Partially Delivered</option>
                        </select>
                    </td>
                </tr>`);
        $("select[name='status']").find(`option[value=${poi.piStatus}]`).attr("selected", "selected");
        });

        $(document).on("change","input[name='qty']", function(pos) {
            var total = 0;
            var subtotal = $(this).val() * $(this).closest(".poitems > tbody > tr").find("input[name='price']").val();
            $(this).closest(".poitems > tbody > tr").find("input[name='subtotal']").val(subtotal);

            for(var i = 0; i <= $('.subtotal').length-1; i++) {
                total = total + parseFloat($('.subtotal').eq(i).val());
                $('.total').text(total);
            }
        });

        $("#conForm").on("submit", function(event){
         event.preventDefault();
         var pID = id;
         var url = $(this).attr("action");
         var date = $(this).find("input[name='date']").val();
         poitems = [];
         var poTotal = 0;

         $(this).find(".ic-level-1").each(function(index){
             var date = $("#conForm").find("input[name='date']").val();
             var status = $(this).find("select[name='status']").val();
             var tiQty = parseInt($(this).find("input[name='qty']").val());
             var actqty = parseInt($(this).find("input[name='spm']").attr('data-actual'));
             var price = parseFloat($(this).find("input[name='price']").val());
             var actualQty = tiQty * actqty;
             var subtotal = parseFloat(tiQty * price);
             poTotal = parseFloat(poTotal + subtotal);

             poitems.push({
                 tiID: isNaN(parseInt($(this).attr('data-trans'))) ? (null) : parseInt($(this).attr('data-trans')),
                 piID: isNaN(parseInt($(this).attr('data-poi'))) ? (null) : parseInt($(this).attr('data-poi')),
                 pID: isNaN(parseInt($(this).attr('data-po'))) ? (null) : parseInt($(this).attr('data-po')),
                 tiQty: tiQty,
                 date: date,
                 tiActual: actualQty,
                 tiSubtotal: subtotal,
                 piStatus: status
             }); 
         }); 

         $.ajax({
             method: "POST",
             url: url,
             data: {
                 id: pID,
                 date: date,
                 total: poTotal,
                 poitems: JSON.stringify(poitems)
             },
             beforeSend: function() {
                    console.log(id, date, poitems);
            },
             succes: function(){
                 location.reload();
             },
             error: function(response, setting, error) {
                 console.log(error);
                 console.log(response.responseText);
             }
         });
     });

    });


    </script>
</body>