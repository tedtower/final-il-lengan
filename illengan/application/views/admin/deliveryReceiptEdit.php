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
                    <!--Card Container-->
                    <div style="overflow:auto">
                        <!--Card-->
                        <div class="card" style="float:left;width:60%">
                            <div class="card-header">
                                <h6 style="font-size:15px;">Edit Delivery Receipt</h6>
                            </div>
                            <form id="drForm" action="<?= site_url("admin/deliveryreceipt/edit")?>" accept-charset="utf-8">
                                <div class="card-body">
                                <input type="text" name="id" value="<?= $dr[0]['id']?>" hidden="hidden">
                                    <!--Source Name-->
                                <div class="form-row">
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:80px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                Supplier</span>
                                        </div>
                                        <input type="text" data-id="<?= $dr[0]['sp']?>" value="<?= $dr[0]['spName']?>" name="supplier" class="form-control border-left-0" require/>
                                    </div>
                                    <!--Invoice Type-->
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:80px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                Date</span>
                                        </div>
                                        <input class="form-control border-left-0" name="tdate" id="tdate" type="date" data-validate="required" value="<?= $dr[0]['date']?>" message="Date is required!"  require>
                                    </div>
                                </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:80px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                Receipt</span>
                                        </div>
                                        <input type="text" name="receipt"
                                            class="form-control form-control-sm  border-left-0" value="<?= $dr[0]['receipt']?>" require>
                                    </div>
                                    <!--Remarks-->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:80px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                Remarks</span>
                                        </div>
                                        <textarea type="text" name="tRemarks"
                                            class="form-control form-control-sm  border-left-0"
                                            rows="1"><?= $dr[0]['remarks']?></textarea>
                                    </div>
                            <a id="addNewBtn" class="btn btn-primary btn-sm"
                                style="margin:0;color:blue;font-weight:600;">New Item</a>
                            <a id="addMBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#merchandiseBrochure"  data-original-title
                                style="margin:0;color:blue;font-weight:600;">Merchandise Item</a>
                            <a id="addPOBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#poBrochure"  data-original-title
                                style="margin:0;color:blue;font-weight:600;">PO Item</a>
                            <br><br>

                            <!--div containing the different input fields in adding trans items -->
                            <div class="ic-level-2 mb-2" style="overflow:auto">
                                <div style="float:left;overflow:auto;" class="ic-level-1">
                                    <div class="input-group mb-1">
                                        <input type="text" name="itemName[]"
                                            class="form-control form-control-sm"
                                            placeholder="Item Name" style="width:40%" readonly="readonly">
                                            <input name="stID[]" type="text"
                                            class="form-control"
                                            placeholder="Stock" style="width:190px" readonly="readonly">
                                        <input name="actualQty[]" type="number"
                                            class="form-control"
                                            placeholder="Actual Qty" style="width:15%" readonly="readonly">
                                    </div>

                                    <div class="input-group">
                                    <input type="number" name="itemQty[]"
                                            class="form-control form-control-sm"
                                            placeholder="Quantity">
                                        <select name="itemUnit[]"
                                            class="form-control form-control-sm" readonly="readonly">
                                            <option value="" selected="selected">Unit
                                            </option>
                                        </select>
                                        <input type="number" name="itemPrice[]"
                                            class="form-control form-control-sm "
                                            placeholder="Price" require>
                                        <input type="number" name="discount[]"
                                            class="form-control form-control-sm "
                                            placeholder="Discount">
                                        <input type="number" name="itemSubtotal[]"
                                            class="form-control form-control-sm"
                                            placeholder="Subtotal" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span>Total: &#8369;<span class="total">0</span></span>
                            </div>
                            <!--Total of the trans items-->
                            </div>
                                <div class="card-footer">
                                    <div>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="background:white;margin-left:0" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success btn-sm" style="background:white"
                                            type="submit">Insert</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>

                        <!--Merchandise-->
                        <div class="card" id="rightCard" style="float:left;width:37%;margin-left:3%">
                            <div class="card-header" style="overflow:auto">
                                <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px" data-display="true" class="merchandise">Select
                                    Merchandise</div>
                                <div style="display:none;font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px" data-display="false" class="po">Select
                                    PO Items</div>
                                <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                    <input type="search"
                                        style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                        name="search" placeholder="Search...">
                                </div>
                            </div>
                            <div class="card-body merchandise ic-level-4" data-display="true" style="margin:1%;padding:1%;font-size:14px">
                                <p class="cardErrMsg">No merchandise available under the current supplier!</p>
                                <!--checkboxes-->
                                <table class="table table-borderless ic-level-3">
                                    <thead style="border-bottom:2px solid #cccccc">
                                        <tr>
                                            <th width="2%"></th>
                                            <th>Merchandise</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ic-level-2">
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body po ic-level-4"data-display="false" style="display:none;margin:1%;padding:1%;font-size:14px">
                                <p class="cardErrMsg">No purchase orders recorded!</p>
                                <div style="width:93%;margin:auto">
                                    <select name="poNum" style="width:100%;padding:3px 7px;border-radius:5px">
                                        <option value="" selected="selected">Select PO</option>
                                    </select>
                                </div>
                                <table class="table table-borderless ic-level-3">
                                    <thead style="border-bottom:2px solid #cccccc">
                                        <tr>
                                            <th width="2%"></th>
                                            <th>Item Name</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ic-level-2">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--Card-->

                     <!--PO-->
                        <!-- <div class="card" id="" style="float:left;width:37%;margin-left:3%">
                            <div class="card-header" style="overflow:auto">
                                <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Select
                                    PO Items</div>
                                <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                    <input type="search"
                                        style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                        name="search" placeholder="Search...">
                                </div>
                            </div>
                            <div class="card-body" style="margin:1%;padding:1%;font-size:14px"> -->
                                <!--checkboxes-->
                                <!-- <div style="width:93%;margin:auto">
                                    <select name="" style="width:100%;padding:3px 7px;border-radius:5px">
                                        <option value="" selected="selected">Select PO</option>
                                    </select>
                                </div>
                                <table class="table table-borderless">
                                    <thead style="border-bottom:2px solid #cccccc">
                                        <tr>
                                            <th width="2%"></th>
                                            <th>Item Name</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ic-level-2">
                                        <tr class="ic-level-1">
                                            <td><input type="checkbox" class="mr-2" name=""
                                                   data-name="" value=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    <!--Card-->

                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= framework_url().'mdb/js/jquery-3.3.1.min.js';?>"></script>
<script src="<?= framework_url().'bootstrap-native/bootstrap.bundle.min.js'?>"></script>
<script>
$(function(){
    var supplier = $("#drForm input[name='supplier']").attr("data-id");
    var id = $("#drForm input[name='id']").val();
    var pos;
    var poItems;
    var merchandise;
    var uom;
    $.ajax({
        method: "POST",
        url: "/admin/deliveryreceipt/getFormVals",
        data: {
            id: id,
            supplier: supplier
        },
        dataType: "JSON",
        success: function(data){
            uom = data.uom;
            pos = data.pos;
            poItems = data.poItems;
            merchandise = data.merchandise;

            console.log(data);
            if(merchandise.length == 0){
                $("#rightCard .merchandise .cardErrMsg").show();
                $("#rightCard .merchandise table").hide();
            }else{
                $("#rightCard .merchandise .cardErrMsg").hide();
                $("#rightCard .merchandise .ic-level-2").append(merchandise.map(merch=>{
                    return `<tr class="ic-level-1">
                            <td><input type="checkbox" class="mr-2" name="merchandise"
                            data-itemName="${merch.spmName}" data-stockID="${merch.stID}" data-stockName="${merch.stName}"
                            data-actual="${merch.spmActualQty}" data-unit="${merch.uomID}" data-price="${merch.spmPrice}"
                            value="${merch.spmName}"></td>
                            <td class="name">${merch.spmName}</td>
                            <td class="price">${merch.spmPrice}</td>
                        </tr>`;
                }).join(''));
                $("#rightCard .merchandise input[name='merchandise']").on("click",function(){
                    $("#addNewBtn").trigger("click");
                    $("#drForm .ic-level-1:last-child input[name='itemName[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='itemSubtotal[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='actualQty[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='itemUnit[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='itemName[]']").val($(this).attr("data-itemName"));
                    $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").find(`option[value=${$(this).attr("data-unit")}]`).attr("selected","selected");
                    $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").val($(this).attr("data-price"));
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").val($(this).attr("data-stockName"));
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").attr("data-id", $(this).attr("data-stockID"));
                    $("#drForm .ic-level-1:last-child input[name='actualQty[]']").val($(this).attr("data-actual"));
                    $("#drForm .ic-level-1:last-child *").on("focus",function(){
                        if(!$(this).closest(".ic-level-1").attr("data-focus")){
                            $("#drForm .ic-level-1").removeAttr("data-focus");
                            $(this).closest(".ic-level-1").attr("data-focus",true);
                        }
                    });
                });
            }
            if(pos.length == 0){
                $("#rightCard .po .cardErrMsg").show();
                $("#rightCard .po table").hide();
            }else{
                $("#rightCard .po .cardErrMsg").hide();
                $("#rightCard .po select[name='poNum']").append(pos.map(po=>{
                    return `<option value="${po.transactionID}">PO# ${po.transNum}</option>`;
                }).join(''));
                $("#rightCard .po .ic-level-2").append(poItems.map(item=>{
                    return `<tr class="ic-level-1" data-transactionID="${item.transactionID}" >
                        <td><input type="checkbox" class="mr-2" name="poItem" data-itemID="${item.itemID}"
                        data-stockID="${item.stock}" data-stockName="${item.stockname}" data-actual="${item.actual}" 
                        data-unit="${item.uom}" data-price="${item.price}" data-discount="${item.discount}"
                        data-itemName="${item.NAME}" data-qty="${item.qty}" value="${item.itemID}"></td>
                        <td class="name">${item.NAME}</td>
                        <td class="qty">${item.qty}</td>
                    </tr>`;
                }).join(''));
                $("#rightCard .po select[name='poNum']").on("change",function(){
                    var num = $(this).val();
                    $("#rightCard .po .ic-level-1").each(function(index){
                        if(isNaN(parseInt(num))){
                            $(this).hide();
                        }else if($(this).attr("data-transactionID")!= num){
                            $(this).hide();
                        }else{
                            $(this).show();
                        }
                    });
                });
                $("#rightCard .po select[name='poNum']").trigger("change");
                $("#rightCard .po input[name='poItem']").on("click",function(){
                    $("#addNewBtn").trigger("click");
                    $("#drForm .ic-level-1:last-child").attr("data-id",$(this).attr("data-itemID"));
                    $("#drForm .ic-level-1:last-child input[name='itemName[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='itemSubtotal[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='actualQty[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='itemUnit[]']").prop("readonly",true);
                    $("#drForm .ic-level-1:last-child input[name='itemQty[]']").val($(this).attr("data-qty"));
                    $("#drForm .ic-level-1:last-child input[name='itemName[]']").val($(this).attr("data-itemName"));
                    $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").find(`option[value=${$(this).attr("data-unit")}]`).attr("selected","selected");
                    $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").val($(this).attr("data-price"));
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").val($(this).attr("data-stockName"));
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").attr("data-id", $(this).attr("data-stockID"));
                    $("#drForm .ic-level-1:last-child input[name='actualQty[]']").val($(this).attr("data-actual"));
                    $("#drForm .ic-level-1:last-child *").on("focus",function(){
                        if(!$(this).closest(".ic-level-1").attr("data-focus")){
                            $("#drForm .ic-level-1").removeAttr("data-focus");
                            $(this).closest(".ic-level-1").attr("data-focus",true);
                        }
                    });
                });
            }
        },
        error: function (response, setting, errorThrown) {
            console.log(errorThrown);
            console.log(response.responseText);
        }
    });
    $("#rightCard input[name='search']").on("keyup",function(){
        var string = $(this).val();
        $("#rightCard .ic-level-4[data-display='true'] .name").each(function(index){
            if(string.trim().length == 0 && $("#rightCard .po.ic-level-4").attr("data-display") == true){
                $("#rightCard .po select[name='poNum']").trigger('change');
            }else if(!$(this).text().includes(string)){
                $(this).closest(".ic-level-1").hide();
            }else{
                $(this).closest(".ic-level-1").show();
            }
        });
    });
    $("#addNewBtn").on("click",function(){
        $("#drForm .ic-level-2").append(`
            <div style="float:left;overflow:auto;" class="ic-level-1">
                <div class="input-group mb-1">
                    <input type="text" name="itemName[]"
                        class="form-control form-control-sm"
                        placeholder="Item Name" style="width:40%">
                        <input name="stID[]" type="text"
                        class="form-control"
                        placeholder="Stock" style="width:190px">
                    <input name="actualQty[]" type="number"
                        class="form-control"
                        placeholder="Actual Qty" style="width:15%">
                </div>

                <div class="input-group">
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
                        placeholder="Price" >
                    <input type="number" name="discount[]"
                        class="form-control form-control-sm "
                        placeholder="Discount">
                    <input type="number" name="itemSubtotal[]"
                        class="form-control form-control-sm"
                        placeholder="Subtotal">
                </div>
            </div>`);
        setIL1FormEvents();
        setInputUOM(uom);
    });
    $("#addMBtn").on("click",function(){
        $("#rightCard .po").hide();
        $("#rightCard .po").attr("data-display",false);
        $("#rightCard .merchandise").show();
        $("#rightCard .merchandise").attr("data-display",true);
    });
    $("#addPOBtn").on("click",function(){
        $("#rightCard .merchandise").hide();
        $("#rightCard .merchandise").attr("data-display",false);
        $("#rightCard .po").show();
        $("#rightCard .po").attr("data-display",true);
    });
    $("#drForm").on("submit",function(event){
        event.preventDefault();
        var date = $(this).find("input[name='tDate']").val();
        var receipt = $(this).find("input[name='receipt']").val();
        var remarks = $(this).find("input[name='tRemarks']").val();
        var items = [];
        $("#drForm .ic-level-1").each(function(index){
            items.push({
                id: $(this).attr("data-id"),
                qty: $(this).find("input[name='itemQty[]']").val(),
                price: $(this).find("input[name='itemPrice[]']").val(),
                discount: $(this).find("input[name='discount[]']").val()
            });
        });
        console.log(date, receipt, remarks, items);
    });
});

function setIL1FormEvents(){
    // $("#drForm .ic-level-1:last-child .exitBtn").on("click",function(){
    //     $(this).closest(".ic-level-1").remove();
    // });
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
        total+= isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
    });
    $("#drForm .total").text(total);
}
</script>
</body>