<body style="background: white">
<div class="content">
                    <!--Export button and Real Time Date & Time --> 
                    <div style="overflow:auto;">
                        <p style="text-align:right; font-weight: regular; font-size: 16px;float:right">
                            <?php echo date("M j, Y -l"); ?>
                        </p>
                    </div>
                    <div class="card">
                    <div class="card-header">
                    <h6 style="font-size: 16px;margin:0">Add Delivery Receipt</h6>
                    </div>
                    <form id="drForm" action="<?= site_url("barista/deliveryreceipt/add")?>" accept-charset="utf-8" class="form">
                    <div class="card-body">
                        <input type="text" name="tID" hidden="hidden">
                        <div class="modal-body">
                            <div class="form-row">
                                <!--Source Name-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            style="width:100px;background:whitesmoke;color:black;font-size:15px;font-weight:600;">
                                            Supplier</span>
                                    </div>
                                    <select class="spID form-control"  name="spID" required>
                                        <option value="" selected>Choose</option>
                                    <?php if(isset($supplier)){
                                        foreach($supplier as $sup){?>
                                        <option value="<?= $sup['spID']?>"><?= $sup['spName']?></option>
                                    <?php }}?>
                                    </select>
                                </div>
                                <!--Date-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            style="width:100px;background:whitesmoke;color:black;font-size:15px;font-weight:600">
                                            Receipt</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        name="receipt">
                                </div>
                                <!--Date-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            style="width:142px;background:whitesmoke;color:black;font-size:15px;font-weight:600">
                                            Transaction Date</span>
                                    </div>
                                    <input type="date" class="form-control"
                                        name="date" required>
                                </div>
                            </div>
                            <!--Remarks-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        style="width:100px;background:whitesmoke;color:black;font-size:15px;font-weight:600">
                                        Remarks</span>
                                </div>
                                <textarea type="text" name="remarks"
                                    class="form-control"
                                    rows="1"></textarea>
                            </div>
                            <button id="addNewBtn" class="btn btn-primary btn-sm"
                                style="margin:0;color:#005ce6;border:2px solid #0066ff;font-weight:600;background:white;" type="button">New Item</button>
                            <button id="addMBtn" class="addMBtn btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#merchandiseBrochure"  data-original-title
                                style="margin:0;color:#005ce6;border:2px solid #0066ff;font-weight:600;background:white;width:auto" type="button" data-url="<?= site_url('barista/getSupplierMerchandise')?>">Add Merchandise</button>
                            <button id="addPOBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#poBrochure"  data-original-title
                                style="margin:0;color:#005ce6;border:2px solid #0066ff;font-weight:600;background:white;" type="button" data-url="<?= site_url('barista/getPosFromSupplier')?>">PO Item</button>
                            <br><br>

                            <!--div containing the different input fields in adding trans items -->
                            <div class="ic-level-2"></div>

                            <br>
                            <span style="font-size:16px">Total: &#8369;<span class="total">0</span></span>
                            <!--Total of the trans items-->
                        </div>
                        <div class="modal-footer" >
                                <button type="button" class="btn btn-danger btn-sm"
                                    data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success btn-sm"
                                    type="submit">Insert</button>
                        </div>
                    </div>
                    </form>
                    </div>



                    <!--Start of merchandiseBrochure Modal"-->
                    <div class="modal fade bd-example-modal-sm" id="merchandiseBrochure" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Merchandise From Supplier</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
                                    <div class="modal-body">
                                        <div class="brochureErrMsg">
                                        </div>
                                        <div class="ic-level-2" style="margin:1% 3%" >
                                            <!--checkboxes-->
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
                
                    <!--Start of POSelect Merchandise ItemModal"-->
                    <div class="modal fade bd-example-modal-lg" id="poBrochure" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Purchase Order Items</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
                                    <div class="modal-body">
                                        <div class="brochureErrMsg">
                                        </div>
                                        <div class="input-group mb-3 ic-level-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text "
                                                    style="width:130px;background:#737373;color:white;font-size:14px;font-weight:600">
                                                    Purchase Order</span>
                                            </div>
                                            <select class="form-control " name="po">
                                                <option value="" selected>Choose</option>
                                            </select>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Item Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Discount</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ic-level-2">
                                                </tbody>
                                            </table>
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
                    <!--End of Merchandise Brochure Modal"-->
                    <div class="modal fade bd-example-modal-sm" id="stockBrochure" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true"
                        style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
                                    <div class="modal-body">
                                        <div class="ic-level-2">
                                            <?php
                                                if(empty($stocks)){
                                                    echo json_encode($stocks);
                                            ?>
                                            <p>No stock items recorded.</p>
                                            <?php
                                                }else{
                                                    foreach($stocks as $stock){
                                            ?>
                                            <div class="d-flex d-inline-block ic-level-1" style="font-size:16px;overflow:auto">
                                                <div><input name="stocks" type="radio" style="margin-top:6px" class="mr-3" value="<?= $stock['stID']?>" data-name="<?= $stock['stName']?>"/></div>
                                                <div><?= $stock['stName']?> (<?= $stock['uomAbbreviation']?>)</div>
                                            </div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer m-0">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success btn-sm" type="submit">Ok</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
      
                <?php include_once('templates/scripts.php') ?>
<script>
$(function(){
    var uom;
    $.ajax({
        method: "GET",
        url: "/barista/getUOMs",
        dataType: "JSON",
        success: function(data){
            uom = data.uom;
        }
    });
    $("#addNewBtn").on("click",function(){
        $("#drForm").find(".ic-level-2").append(`
        <div style="overflow:auto;margin-bottom:2%" class="ic-level-1">
            <div style="float:left;width:95%;overflow:auto;">
                <div class="input-group mb-1">
                    <input type="text" name="itemName[]"
                        class="form-control form-control-sm"
                        placeholder="Item Name" style="width:24%">
                    <input type="number" name="itemQty[]"
                        class="form-control form-control-sm"
                        placeholder="Quantity">
                    <select name="itemUnit[]"
                        class="form-control form-control-sm">
                        <option value="" selected="selected">Unit
                        </option>
                    </select>
                    <input type="number" name="itemPrice[]"
                        class="form-control form-control-sm "
                        placeholder="Price">
                    <input type="number" name="discount[]"
                        class="form-control form-control-sm "
                        placeholder="Discount">
                    <input type="number" name="itemSubtotal[]"
                        class="form-control form-control-sm"
                        placeholder="Subtotal" readonly>
                </div>
                <div class="input-group">
                    <input name="stID[]" type="text"
                        class="form-control border-right-0"
                        placeholder="Stock" style="width:190px">
                    <input name="actualQty[]" type="number"
                        class="form-control border-right-0"
                        placeholder="Actual Qty" style="width:15%">
                </div>
            </div>
            <div class="mt-4"
                style="float:left:width:3%;overflow:auto;">
                <img class="exitBtn"
                    src="/assets/media/admin/error.png"
                    style="width:20px;height:20px;float:right;">
            </div>
        </div>`);
        setIL1FormEvents();
        setInputUOM(uom);
    });

    $("#addMBtn").on("click",function(){
        var url = $(this).attr("data-url");
        var supplier = $("#drForm select[name='spID']").val();
        if(!isNaN(parseInt(supplier))){
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    id: supplier
                },
                dataType: "JSON",
                success: function(data){
                    setMerchandiseBrochure(supplier, data);
                    $("#merchandiseBrochure form").on("submit",function(event){
                        event.preventDefault();
                        merchBrochureOnSubmit(data.uom, data.merchandise, $(this).find("input[name='merch']:checked"));
                    });
                },
                error: function (response, setting, errorThrown) {
                    console.log(errorThrown);
                    console.log(response.responseText);
                }
            });
        }else{
            $("#merchandiseBrochure .brochureErrMsg").text("No supplier selected.");
        }
    });
    $("#addPOBtn").on("click",function(){
        var supplier = $("#drForm select[name='spID']").val();
        var url = $(this).attr("data-url");
        if(!isNaN(parseInt(supplier))){
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    id: supplier
                },
                dataType: "JSON",
                success: function(data){
                    data.uom = uom;
                    if(data.pos.length === 0){
                        $("#poBrochure .brochureErrMsg").show();
                        $("#poBrochure .brochureErrMsg").text("No purchase orders made for current selected supplier.");
                        $("#poBrochure .ic-level-3").hide();
                    }else{
                        $("#poBrochure .ic-level-3").show();
                        setPOBrochure(data);
                    }
                },
                error: function (response, setting, errorThrown) {
                    console.log(errorThrown);
                    console.log(response.responseText);
                }
            });
        }else{
            $("#poBrochure .ic-level-3").hide();
            $("#drBrochure .brochureErrMsg").show();
            $("#poBrochure .brochureErrMsg").text("No supplier selected.");
        }
    });
    $("#merchandiseBrochure").on("hidden.bs.modal",function(){
        $(this).find("form")[0].reset();
        $(this).find("form").off("submit");
        $(this).find(".ic-level-2").empty();
        $(this).find(".brochureErrMsg").empty();
        $(this).find(".brochureErrMsg").hide();
    });
    $("#stockBrochure").on("hidden.bs.modal",function(){
        $(this).find("form")[0].reset();
        $(this).find("form").off("submit");
    });
    $("#poBrochure").on("hidden.bs.modal",function(){
        $(this).find("form")[0].reset();
        $(this).find(".ic-level-2").empty();
        $(this).find("form").off("submit");
        $(this).find(".brochureErrMsg").empty();
        $(this).find(".brochureErrMsg").hide();
        $(this).find("select[name='po'] option:first-child ~ option").remove();
    });
    $("#drForm").on("submit",function(event){
        event.preventDefault();
        var url = $(this).attr("action");
        var supplier = $("#drForm select[name='spID']").val();
        var date = $("#drForm input[name='date']").val();
        var receipt = $("#drForm input[name='receipt']").val();
        var remarks = $("#drForm textarea[name='remarks']").val();
        var drItems = [];
        $("#drForm .ic-level-1").each(function(index){
            drItems.push({
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
                transitems: JSON.stringify(drItems)
            },
            dataType: "JSON",
            beforeSend: function() {
                console.log(supplier,date, receipt, remarks, drItems);
            },
            success: function(data){
                console.log(data);
            },
            error: function(response, setting, error) {
                console.log(error);
                console.log(response.responseText);
            }
        });
    });
});

function setIL1FormEvents(){
    $("#drForm .ic-level-1:last-child .exitBtn").on("click",function(){
        $(this).closest(".ic-level-1").remove();
    });
    $("#drForm .ic-level-1:last-child input[name='stID[]']").on('focus',function(){
        $("#stockBrochure").modal("show");
        $("#stockBrochure form").on("submit",function(event){
            event.preventDefault();
            var st = $(this).find(".ic-level-2 input[name='stocks']:checked");
            $("#drForm .ic-level-1[data-focus='true'] input[name='stID[]']").attr("data-id",st.val());
            $("#drForm .ic-level-1[data-focus='true'] input[name='stID[]']").val(st.attr("data-name"));
            $("#stockBrochure").modal("hide");
        });
    });
    $("#drForm .ic-level-1:last-child *").on("focus",function(){
        if(!$(this).closest(".ic-level-1").attr("data-focus")){
            $("#drForm").find(".ic-level-1").removeAttr("data-focus");
            $(this).closest(".ic-level-1").attr("data-focus",true);
        }
    });
    $("#drForm .ic-level-1:last-child input[name='itemQty[]']").on("change",function(){
        setTotals();
    });
    $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").on("change",function(){
        setTotals();
    });
    $("#drForm .ic-level-1:last-child input[name='discount[]']").on("change",function(){
        setTotals();
    });
}
function setMerchandiseBrochure(supplier, merch){
    $("#merchandiseBrochure .ic-level-2").append(merch.merchandise.map(item =>{
        return `
        <label style="width:96%"><input name="merch" type="checkbox" class="mr-2"
            value="${item.spmID}">${item.spmName}</label>`;
    }).join(''));
}

function setPOBrochure(pos){
    $("#poBrochure select[name='po']").append(pos.pos.map(po => {
        return `<option value="${po.transactionID}">PO#${po.transNum}  Dated:${po.date}</option>`;
    }).join(''));
    $("#poBrochure select[name='po']").on("change",function(){
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
    $("#poBrochure form").on("submit", function(event){
        event.preventDefault();
        $(this).find("input[name='poitems']:checked").each(function(index){
            var item = pos.poItems.filter(item => item.itemID == $(this).val());
            $("#addNewBtn").trigger("click");
            $("#drForm .ic-level-1:last-child").attr("data-id",item[0].itemID);
            $("#drForm .ic-level-1:last-child input[name='itemName[]']").prop("readonly",true);
            $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").prop("readonly",true);
            $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").prop("readonly",true);
            $("#drForm .ic-level-1:last-child input[name='itemSubtotal[]']").prop("readonly",true);
            $("#drForm .ic-level-1:last-child input[name='stID[]']").prop("readonly",true);
            $("#drForm .ic-level-1:last-child input[name='actualQty[]']").prop("readonly",true);
            $("#drForm .ic-level-1:last-child input[name='itemName[]']").val(item[0].NAME);
            $("#drForm .ic-level-1:last-child input[name='itemQty[]']").val(item[0].qty)
            $("#drForm .ic-level-1:last-child input[name='itemUnit[]']").prop("readonly",true);
            $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").find(`option[value=${item[0].uom}]`).attr("selected","selected");
            $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").val(item[0].price);
            $("#drForm .ic-level-1:last-child input[name='itemSubtotal[]']").val(item[0].subtotal);
            $("#drForm .ic-level-1:last-child input[name='stID[]']").val(item[0].stockname);
            $("#drForm .ic-level-1:last-child input[name='stID[]']").attr(item[0].stock);
            $("#drForm .ic-level-1:last-child input[name='actualQty[]']").val(item[0].actual);
            $("#drForm .ic-level-1:last-child *").on("focus",function(){
                if(!$(this).closest(".ic-level-1").attr("data-focus")){
                    $("#drForm .ic-level-1").removeAttr("data-focus");
                    $(this).closest(".ic-level-1").attr("data-focus",true);
                }
            });
        });
        $("#poBrochure").modal("hide");
    });
}
function setInputUOM(uom){
    $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").append(uom.map(unit=>{
        return `<option value="${unit.uomID}">${unit.uomAbbreviation} - ${unit.uomName}</option>`;
    }).join(''));
}

function setTotals(){
    var qty = $("#drForm .ic-level-1[data-focus='true'] input[name='itemQty[]']").val();
    var price = $("#drForm .ic-level-1[data-focus='true'] input[name='itemPrice[]']").val();
    var discount = $("#drForm .ic-level-1[data-focus='true'] input[name='discount[]']").val();
    var subtotal = qty*(price-discount);
    subtotal = subtotal < 0 ? 0 : subtotal;
    var total = 0;
    $("#drForm .ic-level-1[data-focus='true'] input[name='itemSubtotal[]']").val(subtotal);
    $("#drForm .ic-level-1 input[name='itemSubtotal[]']").each(function(index){
        total+= isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
    });
    $("#drForm .total").text(total);
}

function merchBrochureOnSubmit(uom, merchandise, selectedMerch){
    var y;
    selectedMerch.each(function(index) {
        y = merchandise.filter(x => x.spmID == $(this).val());
        $("#addNewBtn").trigger("click");
        $("#drForm .ic-level-1:last-child input[name='itemName[]']").prop("readonly",true);
        $("#drForm .ic-level-1:last-child input[name='itemName[]']").val(y[0].spmName);
        $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").prop("readonly",true);
        $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").find(`option[value=${y[0].uomID}]`).attr("selected","selected");
        $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").prop("readonly",true);
        $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").val(y[0].spmPrice);
        $("#drForm .ic-level-1:last-child input[name='stID[]']").prop("readonly",true);
        $("#drForm .ic-level-1:last-child input[name='stID[]']").val(y[0].stName);
        $("#drForm .ic-level-1:last-child input[name='stID[]']").attr("data-id",y[0].stID);
        $("#drForm .ic-level-1:last-child input[name='actualQty[]']").prop("readonly",true);
        $("#drForm .ic-level-1:last-child input[name='actualQty[]']").val(y[0].spmActualQty);
        $("#drForm .ic-level-1:last-child *").on("focus",function(){
            if(!$(this).closest(".ic-level-1").attr("data-focus")){
                $("#drForm .ic-level-1").removeAttr("data-focus");
                $(this).closest(".ic-level-1").attr("data-focus",true);
            }
        });
    });
    $("#merchandiseBrochure").modal("hide");
}
</script>
</html>