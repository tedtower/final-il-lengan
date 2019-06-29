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
                                    <h6 style="font-size:15px;margin:0">Add Delivery</h6>
                                </div>
                                <form id="drForm" action="<?= site_url("admin/deliveryreceipt/add")?>"
                                    accept-charset="utf-8" class="form">
                                    <div class="card-body">
                                        <input type="text" name="tID" hidden="hidden">
                                        <div class="form-row">
                                            <!--Supplier-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Supplier</span>
                                                </div>
                                                <select class="spID form-control status-level" name="supplier" data-level="2,3" required>
                                                    <option value="" selected>Choose</option>
                                                    <?php if(isset($supplier)){
                                                foreach($supplier as $sup){?>
                                                    <option value="<?= $sup['spID']?>"><?= $sup['spName']?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                            <!--Source-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Source</span>
                                                </div>
                                                <input type="text" data-level="1" class="form-control status-level" name="source">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!--Receipt-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Receipt</span>
                                                </div>
                                                <input type="text" data-level="0" class="form-control status-level" name="receipt">
                                            </div>
                                            <!--Date-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Date</span>
                                                </div>
                                                <input type="date" data-level="0" class="form-control status-level" name="date">
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

                                        <!--Radio Buttons-->
                                        <div class="form-check form-check-inline mb-3"
                                            style="font-size:14px;width:100%;margin:0">
                                            <label class=" form-check-label mr-3"><input class="radio-level form-check-input"
                                                    type="radio" data-trigger-level="3" name="inlineRadioOptions">W/ PO Ref</label>
                                            <label class=" form-check-label mr-3"><input class="radio-level form-check-input"
                                                    type="radio" data-trigger-level="2" name="inlineRadioOptions">W/O PO Ref</label>
                                            <label class=" form-check-label mr-3"><input class="radio-level form-check-input"
                                                    type="radio" data-trigger-level="1" name="inlineRadioOptions">No Official Supplier</label>
                                        </div>
                                        <!--Buttons-->
                                        <button id="addNewBtn" data-level="1" class="btn btn-outline-primary btn-sm m-0 status-level"
                                            type="button">New Item</button>
                                        <button id="addMBtn" data-level="2" class="btn btn-outline-primary btn-sm m-0 status-level"
                                            type="button">Add Merchandise</button>
                                        <button id="addPOBtn" data-level="3" class="btn btn-outline-primary btn-sm m-0 status-level"
                                            type="button">PO Item</button>
                                        <button id="addRBtn" data-level="3" class="btn btn-outline-primary btn-sm m-0 status-level"
                                            type="button">Return Item</button>
                                        <br><br>

                                        <!--input fields in adding trans items w/PO and w/supplier -->
                                        <div class="ic-level-2">
                                            <!-- <div style="overflow:auto" class="ic-level-1">
                                                <div style="float:left;width:96%;overflow:auto;">
                                                    <div class="input-group mb-1">
                                                        <input type="text" name="name[]"
                                                            class="form-control form-control-sm" placeholder="Item Name"
                                                            style="width:17%">
                                                        <input type="number" name="qty[]"
                                                            class="form-control form-control-sm" placeholder="Qty">
                                                        <input type="text" name="unit[]"
                                                            class="form-control form-control-sm" placeholder="Unit">
                                                        <input type="number" name="price[]"
                                                            class="form-control form-control-sm" placeholder="Price">
                                                        <input type="number" name="discount[]"
                                                            class="form-control form-control-sm" placeholder="Discount">
                                                        <input type="number" name="subtotal[]"
                                                            class="form-control form-control-sm" placeholder="Subtotal"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="mt-2" style="float:left:width:3%;overflow:auto">
                                                    <img class="exitBtn" src="/assets/media/admin/error.png"
                                                        style="width:15px;height:15px;float:right;">
                                                </div>
                                            </div> -->
                                            <!-- <div style="overflow:auto" class="ic-level-1">
                                                <div style="float:left;width:96%;overflow:auto;">
                                                    <div class="input-group mb-1">
                                                        <input name="stID[]" type="text"
                                                            class="form-control form-control-sm" placeholder="Stock">
                                                        <input name="actualQty[]" type="number"
                                                            class="form-control form-control-sm" placeholder="Actual Qty">
                                                    </div>
                                                </div>
                                                <div class="mt-2" style="float:left:width:3%;overflow:auto">
                                                    <img class="exitBtn" src="/assets/media/admin/error.png"
                                                        style="width:15px;height:15px;float:right;">
                                                </div>
                                            </div> -->
                                        </div>

                                        <!--input fields in adding trans items w/o Supplier -->
                                        <!-- <div class="ic-level-2">
                                            <div style="overflow:auto" class="ic-level-1">
                                                <div style="float:left;width:96%;overflow:auto;">
                                                    <div class="input-group mb-1">
                                                        <input name="stID[]" type="text"
                                                            class="form-control form-control-sm" placeholder="Stock">
                                                        <input name="actualQty[]" type="number"
                                                            class="form-control form-control-sm" placeholder="Actual Qty">
                                                    </div>
                                                </div>
                                                <div class="mt-2" style="float:left:width:3%;overflow:auto">
                                                    <img class="exitBtn" src="/assets/media/admin/error.png"
                                                        style="width:15px;height:15px;float:right;">
                                                </div>
                                            </div>
                                        </div> -->
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

                        <!--Start of PO sidenav-->
                            <div class="card" id="stockCard" style="float:left;width:35%;margin-left:3%">
                                <div class="status-level" data-show-level="3">
                                    <div class="card-header" style="overflow:auto">
                                        <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Purchase Order</div>
                                        <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                            <input type="search"
                                                style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                                name="search" placeholder="Search...">
                                        </div>
                                    </div>
                                    <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                        <!--checkboxes-->
                                        <div class="mt-1 mb-1">
                                            <select class="form-control form-control-sm">
                                                <option value="" selected>Choose PO</option>
                                            </select>
                                        </div>
                                        <table class="table table-borderless ic-level-3">
                                            <thead style="border-bottom:2px solid #cccccc">
                                                <tr>
                                                    <th width="2%"></th>
                                                    <th style="font-weight:500 !important">Item Name</th>
                                                    <th style="font-weight:500 !important">Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">
                                                <tr class="ic-level-1">
                                                    <td><input type="checkbox" class="mr-2" name="stock"
                                                        data-name="" value=""></td>
                                                    <td class=""></td>
                                                    <td class=""></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="status-level" data-show-level="3">
                                </div>
                                <div class="status-level" data-show-level="2">
                                </div>
                            </div>
                            <!--End of PO sidenav-->

                            <!--Start of Return sidenav-->
                            <div class="card" id="stockCard" style="float:left;width:35%;margin-left:3%">
                                <div class="card-header" style="overflow:auto">
                                    <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Return</div>
                                    <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                        <input type="search"
                                            style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                            name="search" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                    <!--checkboxes-->
                                    <div class="mt-1 mb-1">
                                        <select class="form-control form-control-sm">
                                            <option value="" selected>Choose Return</option>
                                        </select>
                                    </div>
                                    <table class="table table-borderless">
                                        <thead style="border-bottom:2px solid #cccccc">
                                            <tr>
                                                <th width="2%"></th>
                                                <th style="font-weight:500 !important">Item Name</th>
                                                <th style="font-weight:500 !important">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ic-level-2">
                                            <tr class="ic-level-1">
                                                <td><input type="checkbox" class="mr-2" name="stock"
                                                    data-name="" value=""></td>
                                                <td class=""></td>
                                                <td class=""></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--End of PO sidenav-->

                            <!--Start of Merchandise sidenav-->
                            <div class="card" id="stockCard" style="float:left;width:35%;margin-left:3%">
                                <div class="card-header" style="overflow:auto">
                                    <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Merchandise</div>
                                    <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                        <input type="search"
                                            style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                            name="search" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                    <!--checkboxes-->
                                    <table class="table table-borderless">
                                        <thead style="border-bottom:2px solid #cccccc">
                                            <tr>
                                                <th width="3%"></th>
                                                <th style="font-weight:500 !important">Merchandise Name</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ic-level-2">
                                            <tr class="ic-level-1">
                                                <td><input type="checkbox" class="mr-2" name="stock"
                                                    data-name="" value=""></td>
                                                <td class=""></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--End of Merchandise sidenav-->





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <?php include_once('templates/scripts.php') ?>
            <script>
            $(function() {
                var uom;
                $.ajax({
                    method: "GET",
                    url: "/admin/getUOMs",
                    dataType: "JSON",
                    success: function(data) {
                        uom = data.uom;
                    }
                });
                $("#drForm .radio-level").on("change",function(){
                    var level = $(this).attr("data-trigger-level");
                    $("#drForm .status-level").each(function(index){
                        !$(this).attr("data-level").includes(level) && $(this).attr("data-level") != 0 ? $(this).prop("disabled",true) : $(this).prop("disabled",false);
                    });
                });
                $("#addNewBtn").on("click", function() {
                    $("#drForm").find(".ic-level-2").append(`
                        <div style="overflow:auto" class="ic-level-1">
                            <div style="float:left;width:96%;overflow:auto;">
                                <div class="input-group mb-1">
                                    <input name="stID[]" type="text"
                                        class="form-control form-control-sm" placeholder="Stock">
                                    <input name="actualQty[]" type="number"
                                        class="form-control form-control-sm" placeholder="Actual Qty">
                                </div>
                            </div>
                            <div class="mt-2" style="float:left:width:3%;overflow:auto">
                                <img class="exitBtn" src="/assets/media/admin/error.png"
                                    style="width:15px;height:15px;float:right;">
                            </div>
                        </div>`);
                    setIL1FormEvents();
                });
                $("#addMBtn").on("click", function() {
                    var url = $(this).attr("data-url");
                    var supplier = $("#drForm select[name='spID']").val();
                    if (!isNaN(parseInt(supplier))) {
                        $.ajax({
                            method: "POST",
                            url: url,
                            data: {
                                id: supplier
                            },
                            dataType: "JSON",
                            success: function(data) {
                                setMerchandiseBrochure(supplier, data);
                                $("#merchandiseBrochure form").on("submit", function(
                                event) {
                                    event.preventDefault();
                                    merchBrochureOnSubmit(data.uom, data
                                        .merchandise, $(this).find(
                                            "input[name='merch']:checked"));
                                });
                            },
                            error: function(response, setting, errorThrown) {
                                console.log(errorThrown);
                                console.log(response.responseText);
                            }
                        });
                    } else {
                        $("#merchandiseBrochure .brochureErrMsg").text("No supplier selected.");
                    }
                });
                $("#addPOBtn").on("click", function() {
                    var supplier = $("#drForm select[name='spID']").val();
                    var url = $(this).attr("data-url");
                    if (!isNaN(parseInt(supplier))) {
                        $.ajax({
                            method: "POST",
                            url: url,
                            data: {
                                id: supplier
                            },
                            dataType: "JSON",
                            success: function(data) {
                                data.uom = uom;
                                if (data.pos.length === 0) {
                                    $("#poBrochure .brochureErrMsg").show();
                                    $("#poBrochure .brochureErrMsg").text(
                                        "No purchase orders made for current selected supplier."
                                        );
                                    $("#poBrochure .ic-level-3").hide();
                                } else {
                                    $("#poBrochure .ic-level-3").show();
                                    setPOBrochure(data);
                                }
                            },
                            error: function(response, setting, errorThrown) {
                                console.log(errorThrown);
                                console.log(response.responseText);
                            }
                        });
                    } else {
                        $("#poBrochure .ic-level-3").hide();
                        $("#drBrochure .brochureErrMsg").show();
                        $("#poBrochure .brochureErrMsg").text("No supplier selected.");
                    }
                });
                $("#merchandiseBrochure").on("hidden.bs.modal", function() {
                    $(this).find("form")[0].reset();
                    $(this).find("form").off("submit");
                    $(this).find(".ic-level-2").empty();
                    $(this).find(".brochureErrMsg").empty();
                    $(this).find(".brochureErrMsg").hide();
                });
                $("#stockBrochure").on("hidden.bs.modal", function() {
                    $(this).find("form")[0].reset();
                    $(this).find("form").off("submit");
                });
                $("#poBrochure").on("hidden.bs.modal", function() {
                    $(this).find("form")[0].reset();
                    $(this).find(".ic-level-2").empty();
                    $(this).find("form").off("submit");
                    $(this).find(".brochureErrMsg").empty();
                    $(this).find(".brochureErrMsg").hide();
                    $(this).find("select[name='po'] option:first-child ~ option").remove();
                });
                $("#drForm").on("submit", function(event) {
                    event.preventDefault();
                    var url = $(this).attr("action");
                    var supplier = $("#drForm select[name='spID']").val();
                    var date = $("#drForm input[name='tDate']").val();
                    var receipt = $("#drForm input[name='receipt']").val();
                    var remarks = $("#drForm textarea[name='tRemarks']").val();
                    var orItems = [];
                    $("#drForm .ic-level-1").each(function(index) {
                        orItems.push({
                            tiID: $(this).attr("data-id"),
                            name: $(this).find("input[name='itemName[]']").val(),
                            qty: $(this).find("input[name='itemQty[]']").val(),
                            uomID: $(this).find("select[name='itemUnit[]']").val(),
                            price: $(this).find("input[name='itemPrice[]']").val(),
                            discount: $(this).find("input[name='discount[]']").val(),
                            stID: $(this).find("input[name='stID[]']").attr("data-id"),
                            actualQty: $(this).find("input[name='actualQty[]']").val()
                        });
                    });
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: {
                            supplier: supplier,
                            date: date,
                            receipt: receipt,
                            remarks: remarks,
                            items: JSON.stringify(orItems)
                        },
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data);
                        },
                        error: function(response, setting, error) {
                            console.log(error);
                            console.log(response.responseText);
                        }
                    });
                });
            });

            function setIL1FormEvents() {
                $("#drForm .ic-level-1:last-child .exitBtn").on("click", function() {
                    $(this).closest(".ic-level-1").remove();
                });
                $("#drForm .ic-level-1:last-child input[name='stID[]']").on('focus', function() {
                    $("#stockBrochure").modal("show");
                    $("#stockBrochure form").on("submit", function(event) {
                        event.preventDefault();
                        var st = $(this).find(".ic-level-2 input[name='stocks']:checked");
                        $("#drForm .ic-level-1[data-focus='true'] input[name='stID[]']").attr("data-id",
                            st.val());
                        $("#drForm .ic-level-1[data-focus='true'] input[name='stID[]']").val(st.attr(
                            "data-name"));
                        $("#stockBrochure").modal("hide");
                    });
                });
                $("#drForm .ic-level-1:last-child *").on("focus", function() {
                    if (!$(this).closest(".ic-level-1").attr("data-focus")) {
                        $("#drForm").find(".ic-level-1").removeAttr("data-focus");
                        $(this).closest(".ic-level-1").attr("data-focus", true);
                    }
                });
                $("#drForm .ic-level-1:last-child input[name='itemQty[]']").on("change", function() {
                    setTotals();
                });
                $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").on("change", function() {
                    setTotals();
                });
                $("#drForm .ic-level-1:last-child input[name='discount[]']").on("change", function() {
                    setTotals();
                });
            }

            function setMerchandiseBrochure(supplier, merch) {
                $("#merchandiseBrochure .ic-level-2").append(merch.merchandise.map(item => {
                    return `
        <label style="width:96%"><input name="merch" type="checkbox" class="mr-2"
            value="${item.spmID}">${item.spmName}</label>`;
                }).join(''));
            }

            function setPOBrochure(pos) {
                $("#poBrochure select[name='po']").append(pos.pos.map(po => {
                    return `<option value="${po.transactionID}">PO#${po.transNum}  Dated:${po.date}</option>`;
                }).join(''));
                $("#poBrochure select[name='po']").on("change", function() {
                    $("#poBrochure .ic-level-2").empty();
                    pos.poItems.filter(item => item.transactionID == $(this).val()).forEach(item => {
                        $("#poBrochure .ic-level-2").append(`<tr class="ic-level-1">
                    <td><input type="checkbox" name="poitems" class="mr-2" value="${item.itemID}"></td>
                    <td>${item.NAME}</td>
                    <td>${item.qty} (${item.unit})</td>
                    <td>${item.price}</td>
                    <td>${item.discount}</td>
                    <td>${item.subtotal}</td>
                </tr>`);
                    });
                });
                $("#poBrochure form").on("submit", function(event) {
                    event.preventDefault();
                    $(this).find("input[name='poitems']:checked").each(function(index) {
                        var item = pos.poItems.filter(item => item.itemID == $(this).val());
                        $("#addNewBtn").trigger("click");
                        $("#drForm .ic-level-1:last-child").attr("data-id", item[0].itemID);
                        $("#drForm .ic-level-1:last-child input[name='itemName[]']").prop("readonly",
                            true);
                        $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").prop("readonly",
                            true);
                        $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").prop("readonly",
                            true);
                        $("#drForm .ic-level-1:last-child input[name='itemSubtotal[]']").prop(
                            "readonly", true);
                        $("#drForm .ic-level-1:last-child input[name='stID[]']").prop("readonly", true);
                        $("#drForm .ic-level-1:last-child input[name='actualQty[]']").prop("readonly",
                            true);
                        $("#drForm .ic-level-1:last-child input[name='itemName[]']").val(item[0].NAME);
                        $("#drForm .ic-level-1:last-child input[name='itemQty[]']").val(item[0].qty)
                        $("#drForm .ic-level-1:last-child input[name='itemUnit[]']").prop("readonly",
                            true);
                        $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").find(
                            `option[value=${item[0].uom}]`).attr("selected", "selected");
                        $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").val(item[0]
                        .price);
                        $("#drForm .ic-level-1:last-child input[name='itemSubtotal[]']").val(item[0]
                            .subtotal);
                        $("#drForm .ic-level-1:last-child input[name='stID[]']").val(item[0].stockname);
                        $("#drForm .ic-level-1:last-child input[name='stID[]']").attr("data-id", item[0]
                            .stock);
                        $("#drForm .ic-level-1:last-child input[name='actualQty[]']").val(item[0]
                            .actual);
                        $("#drForm .ic-level-1:last-child *").on("focus", function() {
                            if (!$(this).closest(".ic-level-1").attr("data-focus")) {
                                $("#drForm .ic-level-1").removeAttr("data-focus");
                                $(this).closest(".ic-level-1").attr("data-focus", true);
                            }
                        });
                    });
                    $("#poBrochure").modal("hide");
                });
            }

            function setInputUOM(uom) {
                $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").append(uom.map(unit => {
                    return `<option value="${unit.uomID}">${unit.uomAbbreviation} - ${unit.uomName}</option>`;
                }).join(''));
            }

            function setTotals() {
                var qty = $("#drForm .ic-level-1[data-focus='true'] input[name='itemQty[]']").val();
                var price = $("#drForm .ic-level-1[data-focus='true'] input[name='itemPrice[]']").val();
                var discount = $("#drForm .ic-level-1[data-focus='true'] input[name='discount[]']").val();
                var subtotal = qty * (price - discount);
                subtotal = subtotal < 0 ? 0 : subtotal;
                var total = 0;
                $("#drForm .ic-level-1[data-focus='true'] input[name='itemSubtotal[]']").val(subtotal);
                $("#drForm .ic-level-1 input[name='itemSubtotal[]']").each(function(index) {
                    total += isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
                });
                $("#drForm .total").text(total);
            }

            function merchBrochureOnSubmit(uom, merchandise, selectedMerch) {
                var y;
                selectedMerch.each(function(index) {
                    y = merchandise.filter(x => x.spmID == $(this).val());
                    $("#addNewBtn").trigger("click");
                    $("#drForm .ic-level-1:last-child input[name='itemName[]']").prop("readonly", true);
                    $("#drForm .ic-level-1:last-child input[name='itemName[]']").val(y[0].spmName);
                    $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").prop("readonly", true);
                    $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").find(
                        `option[value=${y[0].uomID}]`).attr("selected", "selected");
                    $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").prop("readonly", true);
                    $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").val(y[0].spmPrice);
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").prop("readonly", true);
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").val(y[0].stName);
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").attr("data-id", y[0].stID);
                    $("#drForm .ic-level-1:last-child input[name='actualQty[]']").prop("readonly", true);
                    $("#drForm .ic-level-1:last-child input[name='actualQty[]']").val(y[0].spmActualQty);
                    $("#drForm .ic-level-1:last-child *").on("focus", function() {
                        if (!$(this).closest(".ic-level-1").attr("data-focus")) {
                            $("#drForm .ic-level-1").removeAttr("data-focus");
                            $(this).closest(".ic-level-1").attr("data-focus", true);
                        }
                    });
                });
                $("#merchandiseBrochure").modal("hide");
            }
            </script>

            </html>