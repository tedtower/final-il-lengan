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
                        <div class="card" style="float:left;width:60%">
                            <div class="card-header">
                                <h6 style="font-size:15px;margin:0">Add Return</h6>
                            </div>
                            <form id="conForm" action="<?= site_url("admin/returns/add")?>" accept-charset="utf-8"
                                class="form">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="input-group input-group-sm mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border border-secondary"
                                                    style="width:80px;font-size:14px;">
                                                    Supplier</span>
                                            </div>
                                            <input type="text" name="supplier" data-id="" class="form-control form-control-sm">

                                        </div>
                                        <div class="input-group input-group-sm mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border border-secondary"
                                                    style="width:80px;font-size:14px">
                                                    Date</span>
                                            </div>
                                            <input type="date" name="date" class="form-control form-control-sm">
                                        </div>
                                    </div>

                                    <div class="ic-level-3">
                                        <table class="table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                <tr>
                                                    <th width="17%" style="font-weight:500 !important;">Receipt</th>
                                                    <th style="font-weight:500 !important;">Stock Item</th>
                                                    <th width="20%" style="font-weight:500 !important;">Quantity</th>
                                                    <th width="33%" style="font-weight:500 !important;">Log Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mb-0" style="overflow:auto">
                                    <button class="btn btn-success btn-sm" type="submit"
                                        style="float:right">Insert</button>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        style="float:right">Cancel</button>
                                </div>
                            </form>
                        </div>

                        <div class="card" id="listDeliver" style="float:left;width:37%;margin-left:3%">
                            <div class="card-header" style="overflow:auto">
                                <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Select
                                    Delivery</div>
                                <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                    <input type="search"   
                                        style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                        name="search" placeholder="Search...">
                                </div>
                            </div>
                            <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                <select class="suppliers form-control form-control-sm" name="suppliers">
                                    <option value="" selected>Select Delivery</option>
                                    <?php
                                foreach($supplier as $supp){
                                ?>
                                    <option value="<?= $supp['spID']?>"><?= $supp['spName']?></option>
                                <?php } ?>
                                <select>
                                <!--checkboxes-->
                                <table class="table table-borderless">
                                    <thead style="border-bottom:2px solid #cccccc">
                                        <tr>
                                            <th width="2%"></th>
                                            <th style="font-weight:500 !important;">Receipt</th>
                                            <th style="font-weight:500 !important;">Item</th>
                                        </tr>
                                    </thead>
                                    <tbody class="deliveries ic-level-2">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--End of container divs-->
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php');?>
    <script>
    var deliveries = <?= json_encode($deliveries) ?>;

   function showDeliveries() {
        $("tbody.deliveries").empty();
        deliveries.forEach(function(del) {
            $("tbody.deliveries").append(`
            <tr class="ic-level-1">
                    <td><input type="checkbox" class="mr-2" name="delivery"
                            data-name="${del.stName}" data-uom="${del.uomName}" 
                            data-stid="${del.stID}"  data-actual="${del.spmActual}" 
                            data-price="${del.spmPrice}"  data-spmid="${del.spmID}"
                             value="${del.stID}"></td>
                    <td class="trans"  data-receipt='${del.receiptNo}' data-supplier='${del.spAltName}' 
                    data-spid="${del.spID}">${del.trans}</td>
                    <td class="item" data-stid='${del.stID}'>${del.item}</td>
                </tr>`
        );
        });
    }

    $(function() {
        $(document).on("change","select[name='suppliers']", function() {
            deliveries = <?= json_encode($deliveries) ?>;
            var spID = $(this).val();
            console.log(spID);
            deliveries = deliveries.filter(del => del.spID === spID);
            console.log(deliveries);
            showDeliveries();
        });

        $("#listDeliver .ic-level-1").on("click",function(event){
            if(event.target.type !== "checkbox"){
                $(this).find("input[name='delivery']").trigger("click");
            } console.log("eyeyeye");
        });
        $(document).on("click", "#listDeliver input[name='delivery']", function(event) {
            var id = $(this).val();
            var name = $(this).attr("data-name");
            var uom = $(this).data("uom");
            var price = $(this).data("price");
            var actualQty = $(this).data("actual");
            var supplier = $(this).closest("tr").find("td.trans").data("supplier");
            var spID = $(this).closest("tr").find("td.trans").data("spid");
            var spmID = $(this).data("spmid");
            var receiptNo = $(this).closest("tr").find("td.trans").data("receipt");

            console.log(id, name, $(this).is(":checked"));
            if($(this).is(":checked")){
                $("#conForm .ic-level-2").append(`
                    <tr class="ic-level-1" data-stock="${id}">
                        <td style="padding:1% !important"><input type="text" class="form-control form-control-sm"
                                data-stock="${id}" value="${receiptNo}" name="receipt" readonly></td>
                        <td style="padding:1% !important"><input type="text" class="form-control form-control-sm"
                                data-id="${id}" data-spmid="${spmID}" data-actqty="${actualQty}" data-price="${price}" 
                                value="${name}" name="stock" readonly></td>
                        <td style="padding:1% !important">
                            <div class="input-group input-group-sm mb-3">
                                <input type="number" class="form-control form-control-sm" name="qty" value="1" min="1">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="font-size:14px">
                                        ${uom} </span>
                                </div>
                            </div>
                        </td>
                        <td style="padding:1% !important"><textarea type="text" class="form-control form-control-sm"
                                name="tiRemarks" rows="1"></textarea>
                        </td>
                    </tr>`);

                $("#conForm").find('input[name="supplier"]').val(supplier);
                $("#conForm").find('input[name="supplier"]').attr('data-id', spID);
                $("#conForm").find('input[name="supplier"]').attr("readonly", true);
                
            }else{
                $(`#conForm .ic-level-1[data-stock=${id}]`).remove();
                if(isNaN($("#conForm .ic-level-2 tr").length) || $("#conForm .ic-level-2 tr").length == 0) {
                    $('#conForm')[0].reset();
                }
             
            }
        });
        $("#listDeliver input[name='search']").on("keyup",function(){
            var string = $(this).val();
            $("#listDeliver .item").each(function(index){
                if(!$(this).text().includes(string)){
                    $(this).closest(".ic-level-1").hide();
                }else{
                    $(this).closest(".ic-level-1").show();
                }
            });

        });
        $("#conForm").on("submit", function(event){
            event.preventDefault();
            var url = $(this).attr("action");
            var spID = $(this).find("input[name='supplier']").data("id");
            var spAltName = $(this).find("input[name='supplier']").val();
            var date = $(this).find("input[name='date']").val();
            console.log(date);
            var returnitems = [];
            var rTotal = 0;
            console.log(spAltName);
            $(this).find(".ic-level-1").each(function(index){
                var tiQty = parseInt($(this).find("input[name='qty']").val());
                var actqty = parseInt($(this).find("input[name='stock']").attr('data-actqty'));
                var price = parseFloat($(this).find("input[name='stock']").attr('data-price'));
                var actualQty = tiQty * actqty;
                var subtotal = parseFloat(tiQty * price);
                rTotal = parseFloat(rTotal + subtotal);

                returnitems.push({
                    stID: $(this).find("input[name='stock']").attr('data-id'),
                    spmID: $(this).find("input[name='stock']").attr('data-spmid'),
                    tiQty: tiQty,
                    tiActualQty: actualQty,
                    tiActual: actualQty,
                    tiSubtotal: subtotal,
                    tiRemarks: $(this).find("textarea[name='tiRemarks']").val(),
                    tiDate: date,
                    receipt: $(this).find("input[name='receipt']").val(),
                    riStatus: 'pending'
                }); 
            }); 

            $.ajax({
                method: "POST",
                url: url,
                data: {
                    date: date,
                    spID: spID,
                    spAltName: spAltName,
                    rTotal: rTotal,
                    items: JSON.stringify(returnitems)
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

</html>