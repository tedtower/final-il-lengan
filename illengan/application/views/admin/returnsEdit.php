<body style="background: white">
    <div class="content">
        <div class="container-fluid">
            <br>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <!--Date and Time-->
                    <div style="overflow:auto">
                        <p style="text-align:right; font-weight: regular; font-size: 16px;float:right">
                            <?php echo date("M j, Y -l"); ?> </p>
                    </div>
                    <!--Card Container-->
                    <div style="overflow:auto">
                        <!--Card-->
                        <div class="card" style="float:left;width:100%">
                            <div class="card-header">
                                <h6 style="font-size:15px;margin:0">Edit Return</h6>
                            </div>
                            <form id="conForm" action="<?= site_url("admin/returns/edit") ?>" accept-charset="utf-8" class="form">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="input-group input-group-sm mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border border-secondary" style="width:80px;font-size:14px;">
                                                    Supplier</span>
                                            </div>
                                            <input type="text" name="supplier" class="form-control form-control-sm" readonly>
                                        </div>
                                        <div class="input-group input-group-sm mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border border-secondary" style="width:90px;font-size:14px">
                                                    Return Date</span>
                                            </div>
                                            <input class="form-control form-control-sm" name="date" id="date" type="date" title="Return date is required!" pattern="\d{1,2}/\d{1,2}/\d{4}" required>
                                        </div>
                                    </div>
                                    <div class="ic-level-3">
                                        <table class="table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                <tr>
                                                    <th width="15%" style="font-weight:500 !important;">Receipt No</th>
                                                    <th style="font-weight:500 !important;">Stock Item</th>
                                                    <th width="14%" style="font-weight:500 !important;">Quantity</th>
                                                    <th width="12%" style="font-weight:500 !important;">Status</th>
                                                    <th width="33%" style="font-weight:500 !important;">Log Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2 deliveries">
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mb-0" style="overflow:auto">
                                    <button class="btn btn-success btn-sm" type="submit" style="float:right">Update</button>
                                    <button type="button" id="cancel" class="btn btn-danger btn-sm" style="float:right">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--End of container divs-->
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php'); ?>
    <script>
    var returns = [];
    var returnitems = [];
    var supplier = <?= json_encode($supplier) ?>;
    var returnsTrans = <?= json_encode($returns) ?>;
    var returnItems = <?= json_encode($returnitems) ?>;
    var id = parseInt(<?php echo $id ?>);
    console.log(id);

    $(function() {
        returns = returnsTrans.filter(ret => ret.rID == id);
        returnitems = returnItems.filter(ri => ri.rID == id);
        console.log(returnitems);
        $('input[name="supplier"]').val(returns[0].spAltName);
        $('input[name="supplier"]').val(returns[0].spAltName);
        $('input[name="date"]').val(returns[0].rDate);

        returnitems.forEach(function(ri) {
            $("tbody.deliveries").append(`
            <tr class="ic-level-1" data-tiid="${ri.tiID}" data-diid="${ri.diID}" data-riid="${ri.riID}">
                <td style="padding:1% !important"><input type="text" class="form-control form-control-sm" name="receipt"
                        value="${ri.returnReference}" readonly></td>
                <td><input type="text" data-id="${ri.riID}" data-stockid="${ri.stID}" value="${ri.spmName}"
                        data-spmid="${ri.spmID}" data-actqty="${ri.spmActual}" data-price="${ri.spmPrice}" name="stock"
                        class="form-control form-control-sm" readonly></td>
                <td>
                    <div class="input-group">
                        <input type="number" value="${ri.tiQty}" data-qty="${ri.tiQty}" name="qty"
                            class="form-control form-control-sm" min="1">
                        <div class="input-group-append">
                            <span class="input-group-text" style="font-size:12px">
                                ${ri.uomAbbreviation} </span>
                        </div>
                    </div>
                </td>
                <td>
                    <select name="riStatus" class="form-control form-control-sm">
                        <option value="" selected>Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="refunded">Refunded</option>
                        <option value="replaced">Replaced</option>
                    </select>
                </td>
                <td>
                    <textarea name="tiRemarks" class="form-control form-control-sm" rows="1">${ri.tiRemarks}</textarea>
                </td>
            </tr>`
        );

        $("select[name='riStatus']").find(`option[value=${ri.riStatus}]`).attr("selected", "selected");
        });

        $("#cancel").on("click", function() {
            window.location= "/admin/return";
        });
        $("#conForm").on("submit", function(event){
            event.preventDefault();
            var url = $(this).attr("action");
            var spID = $(this).find("input[name='supplier']").data("id");
            var spAltName = $(this).find("input[name='supplier']").val();
            var date = $(this).find("input[name='date']").val();
            var rTotal = 0;
            
            var returnitems = [];
            $(this).find(".ic-level-1").each(function(index){
                var tiQty = parseInt($(this).find("input[name='qty']").val());
                var orgQty = parseInt($(this).find("input[name='qty']").data("qty"));
                var actqty = parseInt($(this).find("input[name='stock']").attr('data-actqty'));
                var price = parseFloat($(this).find("input[name='stock']").attr('data-price'));
                var actualQty = tiQty * actqty;
                var subtotal = parseFloat(tiQty * price);
                rTotal = parseFloat(rTotal + subtotal);

                returnitems.push({
                    tiID: isNaN(parseInt($(this).data("tiid"))) ? (null) : parseInt($(this).data("tiid")),
                    riID: isNaN(parseInt($(this).data("riid"))) ? (null) : parseInt($(this).data("riid")),
                    diID: isNaN(parseInt($(this).data("riid"))) ? (null) : parseInt($(this).data("diid")),
                    stID: parseInt($(this).find("input[name='stock']").attr('data-stockid')),
                    spmID: parseInt($(this).find("input[name='stock']").attr('data-spmid')),
                    tiQty: tiQty,
                    tiActualQty: actualQty,
                    tiActual: actualQty - (orgQty * actqty),
                    tiSubtotal: tiQty * price,
                    tiRemarks: $(this).find("textarea[name='tiRemarks']").val(),
                    tiDate: date,
                    receipt: $(this).find("input[name='receipt']").val(),
                    riStatus: $(this).find("select[name='riStatus']").val(),
                    new: (tiQty !== orgQty) ? (1) : isNaN(parseInt($(this).data("tiid"))) ? (1) : (0)
                }); 
            }); 

            $.ajax({
                method: "POST",
                url: url,
                data: {
                    rID: id,
                    date: date,
                    spID: spID,
                    spAltName: spAltName,
                    rTotal: rTotal,
                    items: JSON.stringify(returnitems)
                },
                success: function(){
                    location.reload();
                },
                error: function(response, setting, error) {
                    console.log(error);
                    console.log(response.responseText);
                }
            });
        });

        $('#conForm').submit(function(event){
            var returnDateEdit = $("#date").val();
            var currentDate = new Date();
            if(Date.parse(returnDateEdit) > Date.parse(currentDate)){
                event.preventDefault();
                alert('Please check the date entered!');
                return false;
        }
        
    });
    });

    
    </script>
</body>

</html>