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
                            <div class="card" style="float:left;width:62%">
                                <div class="card-header">
                                    <h6 style="font-size:15px;margin:0">Add Purchase Order</h6>
                                </div>
                                <form id="addPurchaseOrder"  action="<?= site_url("admin/purchaseorder/add")?>" accept-charset="utf-8" class="form">
                                    <div class="card-body">
                                        <input type="text" name="tID" hidden="hidden">
                                        <div class="form-row">
                                            <!--Supplier-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Supplier</span>
                                                </div>
                                                <select class="spID form-control" name="spID" required>
                                                    <option value="" selected>Choose</option>
                                                    <?php if(isset($supplier)){
                                            foreach($supplier as $sup){?>
                                                    <option value="<?= $sup['spID']?>"><?= $sup['spName']?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                            <!--Date-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Date</span>
                                                </div>
                                                <input type="date" class="form-control" name="tDate">
                                            </div>
                                        </div>
                                        <!--Remarks-->
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="width:70px">Remarks</span>
                                            </div>
                                            <textarea type="text" name="tRemarks" class="form-control form-control-sm"
                                                rows="1"></textarea>
                                        </div>
                                        <!--div containing the different input fields in adding trans items -->
                                        <p style="font-size:14px;border-bottom:1px solid whitesmoke;padding-bottom:5px">
                                            Purchase Order Items</p>
                                        <div class="ic-level-2">
                                            <div style="overflow:auto;margin-bottom:2%" class="ic-level-1"
                                                data-stockid="${merch.stID}" data-stqty="${merch.prstQty}"
                                                data-currqty="${merch.stQty}">
                                                <div
                                                    style="overflow:auto;margin-bottom:2%;float:left;width:95%;overflow:auto;">
                                                    <div class="find input-group mb-1">
                                                        <input type="text" name="itemName[]"
                                                            class="form-control form-control-sm" value=""
                                                            style="width:24%" readonly placeholder="Item Name">
                                                        <input type="number" name="itemQty[]"
                                                            class="tiQty form-control form-control-sm"
                                                            placeholder="Quantity" value="1" min="1"
                                                            onchange="setInputValues()">
                                                        <select name="itemUnit[]"
                                                            class="itemUnit form-control form-control-sm" readonly>
                                                            <option value="" selected="selected">Unit</option>
                                                        </select>
                                                        <input type="number" name="price[]"
                                                            class="tiPrice form-control form-control-sm"
                                                            value="${merch.spmPrice}" readonly placeholder="Price">
                                                        <input type="number" name="itemSubtotal[]"
                                                            class="tiSubtotal form-control form-control-sm"
                                                            placeholder="Subtotal" readonly>
                                                        <select hidden name="stID[]"
                                                            class="stock form-control form-control-sm" readonly>
                                                            <option value="" selected="selected">Stock Item
                                                            </option>
                                                        </select>
                                                        <input hidden name="actualQty[]" type="number"
                                                            class="qtyPerItem form-control form-control-sm"
                                                            value="${merch.spmActualQty}" readonly
                                                            placeholder="Actual Quantity">
                                                    </div>
                                                </div>
                                                <div class="mt-4" style="float:left:width:3%;overflow:auto;">
                                                    <img class="exitBtn" src="/assets/media/admin/error.png"
                                                        style="width:18px;height:18px;float:right;">
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <span>Total: &#8369;<span class="total">0</span>
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

                            <!--Start of Merchandise sidenav-->
                            <div class="card" id="stockCard" style="float:left;width:35%;margin-left:3%">
                                <div class="card-header" style="overflow:auto">
                                    <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">
                                        Merchandise</div>
                                    <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                        <input type="search"
                                            style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                            name="search" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                    <!--checkboxes-->
                                    <table class="table table-borderless">
                                        <thead style="border-bottom:2px solid #cccccc;font-weight:400 !important">
                                            <tr>
                                                <th width="3%"></th>
                                                <th style="font-weight:500 !important">Merchandise Name</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ic-level-2">
                                            <tr class="ic-level-1">
                                                <td><input type="checkbox" class="mr-2" name="stock" data-name=""
                                                        value=""></td>
                                                <td class="">Strawberry Syrup</td>
                                            </tr>
                                            <tr class="ic-level-1">
                                                <td><input type="checkbox" class="mr-2" name="stock" data-name=""
                                                        value=""></td>
                                                <td class="">Strawberry Syrup</td>
                                            </tr>
                                            <tr class="ic-level-1">
                                                <td><input type="checkbox" class="mr-2" name="stock" data-name=""
                                                        value=""></td>
                                                <td class="">Strawberry Syrup</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--End of Merchandise sidenav-->
                        </div>

                        <!--Start of Brochure Modal"-->
                        <div class="modal fade bd-example-modal" id="brochureStock" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true"
                            style="background:rgba(0, 0, 0, 0.3)">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Select Stock</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" accept-charset="utf-8">
                                        <div class="modal-body">
                                            <div style="margin:1% 3%" class="ic-level-2">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success btn-sm">Ok</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--End of Brochure Modal"-->
                        <!--Start of Brochure Modal"-->
                        <div class="modal fade bd-example-modal-sm" id="merchandiseBrochure" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true"
                            style="background:rgba(0, 0, 0, 0.3)">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Select Merchandise Item</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form>
                                        <div class="modal-body">
                                            <div style="margin:1% 3%" class="ic-level-2" id="list">
                                                <!--checkboxes-->
                                                <?php if(!empty($merchandise)){
                                            foreach($merchandise as $merch){
                                        ?>
                                                <label style="width:96%"><input type="checkbox" name="merch[]"
                                                        class="mr-2"
                                                        value="<?= $merch['spmID']?>"><?= ucWords($merch['spmName'])?></label>
                                                <?php
                                            }
                                        }?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" type="submit">Ok</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--End of Brochure Modal"-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
    <script>
    var stocks = [];
    var uom = [];
    var supplier = [];
    var suppmerch = [];
    $(function() {
        $.ajax({
            url: '/admin/jsonPO',
            dataType: 'json',
            success: function(data) {
                var poLastIndex = 0;
                stocks = data.stock;
                supplier = data.supplier;
                suppmerch = data.suppmerch;
                uom = data.uom;
                $(".addMBtn").on('click', function() {
                    var spID = parseInt($(this).closest('.form').find('.spID').val());
                    var merchandise = suppmerch.filter(sm => sm.spID == spID);
                    setMerchandiseBrochure(merchandise);
                    $("#merchandiseBrochure form").on("submit", function(event) {
                        event.preventDefault();
                        $(this).find("input[name='stockitems']:checked").each(
                            function(index) {
                                var selectedMerch = merchandise.filter(merch =>
                                    merch.spmID == $(this).attr(
                                        "data-spmid"));
                                $("#addPurchaseOrder .ic-level-2").append(
                                    selectedMerch.map(merch => {
                                        return `<div style="overflow:auto;margin-bottom:2%" class="ic-level-1" data-stockid="${merch.stID}" data-stqty="${merch.prstQty}" data-currqty="${merch.stQty}">
                                    <div style="float:left;width:95%;overflow:auto;">
                                        <div class="find input-group mb-1">
                                            <input type="text" name="itemName[]"
                                                class="form-control form-control-sm"
                                                value="${merch.spmName}" style="width:24%" readonly>
                                            <input type="number" name="itemQty[]"
                                                class="tiQty form-control form-control-sm"
                                                placeholder="Quantity" value="1" min="1" onchange="setInputValues()">
                                            <select name="itemUnit[]"
                                                class="itemUnit form-control form-control-sm" readonly>
                                                <option value="" selected="selected">Unit</option>
                                            </select>
                                            <input type="number" name="price[]"
                                                class="tiPrice form-control form-control-sm"
                                                value="${merch.spmPrice}" readonly>
                                            <input type="number" name="discount[]"
                                                class="form-control form-control-sm "
                                                placeholder="Discount">
                                            <input type="number" name="itemSubtotal[]"
                                                class="tiSubtotal form-control form-control-sm"
                                                placeholder="Subtotal" readonly>
                                        </div>
                                        <div class="input-group">
                                            <select name="stID[]"
                                                class="stock form-control form-control-sm" readonly="readonly">
                                                <option value="" selected="selected">Stock Item
                                                </option>
                                            </select>
                                            <input name="actualQty[]" type="number"
                                                class="qtyPerItem form-control border-right"
                                                value="${merch.spmActualQty}" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="mt-4"style="float:left:width:3%;overflow:auto;">
                                        <img class="exitBtn" src="/assets/media/admin/error.png"style="width:20px;height:20px;float:right;">
                                    </div>
                                </div>`;
                                    }).join(''));
                                setInputValues()
                                $(".exitBtn").last().on('click', function() {
                                    $(this).closest(".ic-level-1")
                                        .remove();
                                });
                                $('.itemUnit').last().empty();
                                $(".itemUnit").last().append(`${uom.map(uom => {
                                return `<option value="${uom.uomID}">${uom.uomName}</option>`
                            }).join('')}`);
                                $("select[name='itemUnit[]']").last().find(
                                    `option[value=${selectedMerch[0].uomID}]`
                                    ).attr("selected", "selected");
                                $('.stock').last().empty();
                                $(".stock").last().append(`${stocks.map(stock => {
                                return `<option value="${stock.stID}">${stock.stName}</option>`
                            }).join('')}`);
                                $(".ic-level-1").last().find(
                                    `select[name='stID[]'] > option[value='${selectedMerch[0].stID}']`
                                    ).attr("selected", "selected");
                            });
                        $("#merchandiseBrochure").modal("hide");
                    });
                });
            },
            error: function(response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
        $("#merchandiseBrochure").on("hidden.bs.modal", function() {
            $(this).find("form")[0].reset();
            $(this).find("form").off("submit");
            $(this).find(".ic-level-2").empty();
        });
        $("#addPurchaseOrder").on('submit', function(event) {
            event.preventDefault();
            var supplier = $(this).find("select[name='spID']").val();
            var date = $(this).find("input[name='tDate']").val();
            var remarks = $(this).find("textarea[name='tRemarks']").val();
            var transitems = [];
            for (var index = 0; index < $(this).find(".ic-level-1").length; index++) {
                var row = $(this).find(".ic-level-1").eq(index);
                transitems.push({
                    uomID: row.find("select[name='itemUnit[]']").val(),
                    stID: row.find("select[name='stID[]']").val(),
                    name: row.find("input[name='itemName[]']").val(),
                    price: row.find("input[name='price[]']").val(),
                    discount: row.find("input[name='discount[]']").val(),
                    qty: row.find("input[name='itemQty[]']").val(),
                    actualQty: row.find("input[name='actualQty[]']").val()
                });
            }

            $.ajax({
                method: "post",
                url: "<?= site_url("admin/purchaseorder/add")?>",
                data: {
                    supplier: supplier,
                    date: date,
                    remarks: remarks,
                    transitems: JSON.stringify(transitems)
                },
                dataType: "json",
                beforeSend: function() {
                    console.log(supplier, date, remarks, transitems);
                },
                success: function(data) {
                    if (data.success) {
                        location.replace('<?= site_url("admin/purchaseorder")?>');
                    }
                },
                error: function(response, setting, error) {
                    console.log(error);
                    console.log(response.responseText);
                }
            });
        });
    });

    function setMerchandiseBrochure(suppstocks) {
        $("#merchandiseBrochure .ic-level-2").empty();
        $("#merchandiseBrochure .ic-level-2").append(`${suppstocks.map(st => {
            return `<label style="width:96%"><input type="checkbox" id="stID${st.stID}" data-spmid="${st.spmID}" name="stockitems" class="stockitems mr-2" 
            value="${st.stID}"> ${st.spmName} </label>`
        }).join('')}`);
    }


    var subPrice = 0;

    function setInputValues() {
        var total = 0;
        for (var i = 0; i <= $('.ic-level-1').length - 1; i++) {
            var tiQty = parseInt($('.tiQty').eq(i).val());
            var qtyPerItem = parseInt($('.qtyPerItem').eq(i).val());
            var price = parseFloat($('.tiPrice').eq(i).val());

            // Setting item subtotal
            var subtotal = price * tiQty;
            var actualqty = tiQty * qtyPerItem;
            $('.actualQty').eq(i).val(actualqty);
            $('.tiSubtotal').eq(i).val(subtotal);
        }

        //Setting items tota
        for (var i = 0; i <= $('.tiSubtotal').length - 1; i++) {
            total = total + parseFloat($('.tiSubtotal').eq(i).val());
            $('.total').text(total);
        }
    }
    </script>
</body>