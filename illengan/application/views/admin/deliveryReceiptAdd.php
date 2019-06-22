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
                        <h6 style="font-size: 16px;margin-left:15px">Add Delivery Receipt</h6>
                    </div>
                    <!--Card--> 
                    <form id="drForm" action="<?= site_url("admin/deliveryreceipt/add")?>" accept-charset="utf-8" class="form">
                        <input type="text" name="tID" hidden="hidden">
                        <div class="modal-body">
                            <div class="form-row">
                                <!--Source Name-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border border-secondary"
                                            style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                            Supplier</span>
                                    </div>
                                    <select class="spID form-control form-control-sm  border-left-0" name="spID" required>
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
                                        <span class="input-group-text border border-secondary"
                                            style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                            Receipt</span>
                                    </div>
                                    <input type="text" class="form-control  border-left-0"
                                        name="receipt">
                                </div>
                                <!--Date-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border border-secondary"
                                            style="width:142px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                            Transaction Date</span>
                                    </div>
                                    <input type="date" class="form-control  border-left-0"
                                        name="date" required>
                                </div>
                            </div>
                            <!--Remarks-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border border-secondary"
                                        style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                        Remarks</span>
                                </div>
                                <textarea type="text" name="remarks"
                                    class="form-control form-control-sm  border-left-0"
                                    rows="1"></textarea>
                            </div>
                            <a id="addNewBtn" class="btn btn-primary btn-sm"
                                style="margin:0;color:blue;font-weight:600;">New Item</a>
                            <a id="addPOBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#poBrochure"  data-original-title
                                style="margin:0;color:blue;font-weight:600;">PO Item</a>
                            <a id="addMBtn" class="addMBtn btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#merchandiseBrochure"  data-original-title
                                style="margin:0;color:blue;font-weight:600;">Add Merchandise</a>
                            <br><br>

                            <!--div containing the different input fields in adding trans items -->
                            <div class="ic-level-2 transitems"></div>

                            <br>
                            <span>Total: &#8369;<span class="total">0</span></span>
                            <!--Total of the trans items-->

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm"
                                    data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success btn-sm"
                                    type="submit">Insert</button>
                            </div>
                        </div>
                    </form>


                    <!--Start of merchandiseBrochure Modal"-->
                    <div class="modal fade bd-example-modal-sm" id="merchandiseBrochure" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
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
                                    <div style="margin:1% 3%" id="list">
                                        <!--checkboxes-->
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success btn-sm" onclick="getSelectedStocks()" type="button">Ok</button>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Select Purchase Order</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="poForm">
                                    <div class="modal-body">
                                        <div class="input-group mb-3 col">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:143px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                            Purchase Order</span>
                                        </div>
                                        <select class="brochureSelect custom-select" name="po">
                                            <option value="" selected>Choose</option>
                                            <?php if(isset($pos)){
                                                foreach($pos as $po){?>
                                                <option value="<?= $po['transactionID']?>"><?= $po['transNum']?> - <?= $po['suppName']?></option>
                                            <?php }}?>
                                        </select>
                                        </div>

                                        <div style="margin:1% 3%">
                                            <table class="poitemsTable table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Item Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success btn-sm" type="button" onclick="getSelectedPOs()" >Ok</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Merchandise Brochure Modal"-->
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
    var pos = [];
    var poitems = [];
    $(function() {
        var stocks = [];
        var uom = [];
        $.ajax({
            url: '/admin/jsonDR',
            dataType: 'json',
            success: function (data) {
                stocks = data.stock;
                uom = data.uom;
                pos = data.pos;
                poitems = data.poItems;
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
        $('#addNewBtn').on("click", function() {
            $('#drForm .ic-level-2').append(`<div style="overflow:auto;margin-bottom:2%" class="ic-level-1">
                <div style="float:left;width:95%;overflow:auto;">
                    <div class="find input-group mb-1">
                        <input type="text" name="itemName[]"
                            class="form-control form-control-sm"
                            value="" style="width:24%">
                        <input type="number" name="itemQty[]"
                            class="tiQty form-control form-control-sm"
                            placeholder="Quantity" onchange="setInputValues()" required>
                        <select name="itemUnit[]"
                            class="itemUnit form-control form-control-sm">
                            <option value="" selected="selected">Unit</option>
                        </select>
                        <input type="number" name="price[]"
                            class="tiPrice form-control form-control-sm"
                            value="" placeholder="Price" onchange="setInputValues()" required>
                        <input type="number" name="discount[]"
                            class="tidiscount form-control form-control-sm" onchange="setInputValues()" placeholder="Discount" >
                        <input type="number" name="itemSubtotal[]"
                            class="tiSubtotal form-control form-control-sm"
                            placeholder="Subtotal" readonly>
                    </div>

                    <div class="input-group">
                        <input name="stID2[]" type="text"
                        class="form-control border-right-0"
                        placeholder="Stock" style="width:190px">
                        <select name="stID[]"
                            class="stock form-control form-control-sm">
                            <option value="" selected="selected">Stock Item
                            </option>
                        </select>
                        <input name="actualQty[]" type="number"
                            class="qtyPerItem form-control border-right"
                            value="">
                    </div>
                </div>
                <div class="mt-4"style="float:left:width:3%;overflow:auto;">
                    <img class="exitBtn" src="/assets/media/admin/error.png"style="width:20px;height:20px;float:right;">
                </div>
            </div>`);
            $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").append(uom.map(uom => {
                return `<option value="${uom.uomID}">${uom.uomName}</option>`
            }).join(''));
            $("#drForm .ic-level-1:last-child select[name='stID2[]']").on("focus",stockBrochureOnSubmit(stocks));
            // $('.stock').empty();
            // $(".stock").append(`${stocks.map(stock => {
            //     return `<option value="${stock.stID}">${stock.stName}</option>`
            // }).join('')}`);
            $("#drForm .ic-level-1:last-child .exitBtn").on('click',function(){
                $(this).closest(".ic-level-1").remove();
            });
        });

        $(".addMBtn").on('click', function(){
            var spID = parseInt($(this).closest('.form').find('.spID').val());
            setBrochureContent(suppmerch.filter(sm => sm.spID == spID));
        });

        $(".brochureSelect").on('change', function(){
            var poID = parseInt($('.brochureSelect').val());
            setPOBrochureContent(poitems.filter(poitem => poitem.transactionID == poID));
            
        });

        $(".addPOBtn").on('click', function(){
            $('.poForm')[0].reset();
            console.log($('.poForm'));
        });
        $("#poBrochure").on("hidden.bs.modal",function(){
            $(this).find("form")[0].reset();
            $(this).find(".poitemsTable > tbody").empty();
        });
        $("#drForm").on('submit', function(event) {
            event.preventDefault();
            var supplier = $(this).find("select[name='spID']").val();
            var date = $(this).find("input[name='date']").val();
            var receipt = $(this).find("input[name='receipt']").val();
            var remarks = $(this).find("textarea[name='remarks']").val();
            var transitems = [];
            for (var index = 0; index < $(this).find(".ic-level-1").length; index++) {
                var row = $(this).find(".ic-level-1").eq(index);
                transitems.push({
                    tiID : row.attr('data-id'),
                    uomID:  row.find("select[name='itemUnit[]']").val(),
                    stID:  row.find("select[name='stID[]']").val(),
                    name: row.find("input[name='itemName[]']").val(),
                    price:  row.find("input[name='price[]']").val(),
                    discount: row.find("input[name='discount[]']").val(),
                    qty:  row.find("input[name='itemQty[]']").val(),
                    actualQty:  row.find("input[name='actualQty[]']").val()
                });
            }

            $.ajax({
                method: "post",
                url: "<?= site_url("admin/deliveryreceipt/add")?>",
                data: {
                    supplier: supplier,
                    date: date,
                    receipt:receipt,
                    remarks:remarks,
                    transitems: JSON.stringify(transitems)
                },
                dataType: "json",
                beforeSend: function() {
                    console.log(supplier,date,receipt,remarks,transitems);
                },
                success: function(data) {
                    if(data.success){
                        location.replace("<?= site_url('admin/deliveryreceipt')?>");
                    }else{
                        alert("Insert Unsuccessful!");
                    }
                },
                error: function(response, setting, error) {
                    console.log(error);
                    console.log(response.responseText);
                }
            });
        });
    });
    function setBrochureContent(suppstocks){
        $("#list").empty();
        $("#list").append(suppstocks.map(st => {
            return `<label style="width:96%"><input type="checkbox" id="stID${st.stID}" name="stockitems" class="stockitems mr-2" 
            value="${st.stID}"> ${st.spmName} </label>`;
        }).join(''));
    }

    function setPOBrochureContent(items){
        $(".poitemsTable > tbody").empty();
        $(".poitemsTable > tbody").append(`${items.map(item => {
            return `
            <tr>
                <td><input type="checkbox" name="poitems" class="poitems mr-2" value="${item.itemID}"></td>
                <td>${item.NAME}</td>
                <td>${item.qty}</td>
                <td>${item.price}</td>
                <td>${item.subtotal}</td>
            </tr>`
        }).join('')}`);
        
    }
    function stockBrochureOnSubmit(stocks){
        console.log(stocks)
        $("#stockBrochure form").on("submit", function(event){
            event.preventDefault();
            console.log($(this).find("input[name='stock']:checked").val());
            $("#drForm .ic-level-2 .ic-level-1[data-focus='true'] input[name='stID2[]']").val()
        });
    }
    
var subPrice = 0;
var merchChecked;
function getSelectedStocks() {
    $(document).ready(function () {
        var value = 0;
        var choices = document.getElementsByClassName('stockitems');
        var st, spm;
        for (var i = 0; i <= choices.length - 1; i++) {
            if (choices[i].checked) {
                value = choices[i].value;
                st = stocks.filter(st => st.stID === value);
                spm = suppmerch.filter(sp => sp.stID === value);
                console.log(suppmerch);
                merchChecked = `
                <div style="overflow:auto;margin-bottom:2%" class="ic-level-1" data-stockid="${st[0].stID}" data-stqty="${st[0].prstQty}" data-currqty="${st[0].stQty}">
                    <div style="float:left;width:95%;overflow:auto;">
                        <div class="find input-group mb-1">
                            <input type="text" name="itemName[]"
                                class="form-control form-control-sm"
                                value="${st[0].stName} ${st[0].stSize}" style="width:24%" readonly>
                            <input type="number" name="itemQty[]"
                                class="tiQty form-control form-control-sm"
                                placeholder="Quantity" value="1" min="1" onchange="setInputValues()" required>
                            <select name="itemUnit[]"
                                class="itemUnit form-control form-control-sm" readonly>
                                <option value="" selected="selected">Unit</option>
                            </select>
                            <input type="number" name="price[]"
                                class="tiPrice form-control form-control-sm"
                                value="${spm[0].spmPrice}" readonly required>
                            <input type="number" name="discount[]"
                                class="tidiscount form-control form-control-sm " onchange="setInputValues()"
                                placeholder="Discount">
                            <input type="number" name="itemSubtotal[]"
                                class="tiSubtotal form-control form-control-sm"
                                placeholder="Subtotal" readonly>
                        </div>

                        <div class="input-group">
                            <select name="stID[]"
                                class="stock form-control form-control-sm">
                                <option value="" selected="selected">Stock Item
                                </option>
                            </select>
                            <input name="actualQty[]" type="number"
                                class="qtyPerItem form-control border-right"
                                value="${spm[0].spmActualQty}">
                        </div>
                    </div>
                    <div class="mt-4"style="float:left:width:3%;overflow:auto;">
                        <img class="exitBtn" src="/assets/media/admin/error.png"style="width:20px;height:20px;float:right;">
                    </div>
                </div>
                 `;
                $('.ic-level-2').append(merchChecked);
                    setInputValues();

            }
        }
        $('.stock').empty();
        $(".itemUnit").append(`${uom.map(uom => {
            return `<option value="${uom.uomID}">${uom.uomName}</option>`
        }).join('')}`);

        $("select[name='itemUnit[]']").find(`option[value=${spm[0].uomID}]`).attr("selected","selected");
        console.log(uom);

        $('.stock').empty();
        $(".stock").append(`${stocks.map(stock => {
            return `<option value="${stock.stID}">${stock.stName}</option>`
        }).join('')}`);

        $(".exitBtn").on('click',function(){
            $(this).closest(".ic-level-1").remove();
        });
    });
    $("#merchandiseBrochure").modal("hide");
}

function getSelectedPOs() {
    var value = 0;
    var choices = document.getElementsByClassName('poitems');
    var poi;
    for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
            value = choices[i].value;
            poi = poitems.filter(poi => poi.itemID === value);
            merchChecked = `
            <div style="overflow:auto;margin-bottom:2%" class="ic-level-1" data-id="${poi[0].itemID}" >
                <div style="float:left;width:95%;overflow:auto;">
                    <div class="find input-group mb-1">
                        <input type="text" name="itemName[]"
                            class="form-control form-control-sm"
                            value="${poi[0].NAME}" style="width:24%" readonly>
                        <input type="number" name="itemQty[]"
                            class="tiQty form-control form-control-sm"
                            placeholder="Quantity" value="${poi[0].qty}" onchange="setInputValues()" required>
                        <select name="itemUnit[]"
                            class="itemUnit form-control form-control-sm">
                            <option value="" selected="selected">Unit</option>
                        </select>
                        <input type="number" name="price[]"
                            class="tiPrice form-control form-control-sm"
                            value="${poi[0].price}" readonly required>
                        <input type="number" name="discount[]"
                            class="tidiscount form-control form-control-sm " onchange="setInputValues()"
                            placeholder="Discount">
                        <input type="number" name="itemSubtotal[]"
                            class="tiSubtotal form-control form-control-sm"
                            placeholder="Subtotal" readonly>
                    </div>

                    <div class="input-group">
                        <select name="stID[]"
                            class="stock form-control form-control-sm">
                            <option value="" selected="selected">Stock Item
                            </option>
                        </select>
                        <input name="actualQty[]" type="number"
                            class="qtyPerItem form-control border-right"
                            value="${poi[0].equivalent}">
                    </div>
                </div>
                <div class="mt-4"style="float:left:width:3%;overflow:auto;">
                    <img class="exitBtn" src="/assets/media/admin/error.png"style="width:20px;height:20px;float:right;">
                </div>
            </div>
                `;
            $('.ic-level-2').append(merchChecked);
            setInputValues();
        }
    }
    $(".itemUnit").append(`${uom.map(uom => {
        return `<option value="${uom.uomID}">${uom.uomName}</option>`
    }).join('')}`);


    $('.stock').empty();
    $(".stock").append(`${stocks.map(stock => {
        return `<option value="${stock.stID}">${stock.stName}</option>`
    }).join('')}`);

    $(".exitBtn").on('click',function(){
        $(this).closest(".ic-level-1").remove();
    });
    $("#poBrochure").modal("hide");
}


function setInputValues() {
    var total = 0;
    for(var i = 0; i <= $('.ic-level-1').length -1 ; i++) {
        var tiQty = parseInt($('.tiQty').eq(i).val());
        var qtyPerItem = parseInt($('.qtyPerItem').eq(i).val());
        var price = parseFloat($('.tiPrice').eq(i).val());
        var discount = parseFloat($('.tidiscount').eq(i).val());

        // Setting item subtotal
        var subtotal = (price * tiQty);
        var actualqty = tiQty * qtyPerItem;
        $('.actualQty').eq(i).val(actualqty);
        $('.tiSubtotal').eq(i).val(subtotal);
    }

     //Setting items tota
    for(var i = 0; i <= $('.tiSubtotal').length-1; i++) {
        total = total + parseFloat($('.tiSubtotal').eq(i).val());
        $('.total').text(total);
    }
}

    </script>
</body>
<!-- $(function(){
    var uom;
    $.ajax({
        method: "GET",
        url: "/admin/getUOMs",
        dataType: "JSON",
        success: function(data){
            uom = data.uom;
        }
    });
    $("#addItemBtn").on("click",function(){
        $("#orForm").find(".ic-level-2").append(`
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
                    <select name="paymentStatus[]"
                        class="form-control form-control-sm">
                        <option value="" selected="selected">Payment Status
                        </option>
                    </select>
                    <select name="deliveryStatus[]"
                        class="form-control form-control-sm ">
                        <option value="" selected>Delivery Status</option>
                    </select>
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
        var supplier = $("#orForm select[name='spID']").val();
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
        var supplier = $("#orForm select[name='spID']").val();
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
            $("#poBrochure .brochureErrMsg").text("No supplier selected.");
        }
    });
    $("#addDRBtn").on("click",function(){
        var supplier = $("#orForm select[name='spID']").val();
        $.ajax({
            method: "POST",
            url: ""
        });
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
    });
});

function setIL1FormEvents(){
    $("#orForm .ic-level-1:last-child .exitBtn").on("click",function(){
        $(this).closest(".ic-level-1").remove();
    });
    $("#orForm .ic-level-1:last-child input[name='stID[]']").on('focus',function(){
        $("#stockBrochure").modal("show");
        $("#stockBrochure form").on("submit",function(event){
            event.preventDefault();
            var st = $(this).find(".ic-level-2 input[name='stocks']:checked");
            $("#orForm .ic-level-1[data-focus='true'] input[name='stID[]']").attr("data-id",st.val());
            $("#orForm .ic-level-1[data-focus='true'] input[name='stID[]']").val(st.attr("data-name"));
            $("#stockBrochure").modal("hide");
        });
    });
    $("#orForm .ic-level-1:last-child *").on("focus",function(){
        if(!$(this).closest(".ic-level-1").attr("data-focus")){
            $("#orForm").find(".ic-level-1").removeAttr("data-focus");
            $(this).closest(".ic-level-1").attr("data-focus",true);
        }
    });
    $("#orForm .ic-level-1:last-child input[name='itemQty[]']").on("change",function(){
        setTotals();
    });
    $("#orForm .ic-level-1:last-child input[name='itemPrice[]']").on("change",function(){
        setTotals();
    });
    $("#orForm .ic-level-1:last-child input[name='discount[]']").on("change",function(){
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
}

function setInputUOM(uom){
    $("#orForm .ic-level-1:last-child select[name='itemUnit[]']").append(uom.map(unit=>{
        return `<option value="${unit.uomID}">${unit.uomAbbreviation} - ${unit.uomName}</option>`;
    }).join(''));
}

function setTotals(){
    var qty = $("#orForm .ic-level-1[data-focus='true'] input[name='itemQty[]']").val();
    var price = $("#orForm .ic-level-1[data-focus='true'] input[name='itemPrice[]']").val();
    var discount = $("#orForm .ic-level-1[data-focus='true'] input[name='discount[]']").val();
    var subtotal = qty*(price-discount);
    subtotal = subtotal < 0 ? 0 : subtotal;
    var total = 0;
    $("#orForm .ic-level-1[data-focus='true'] input[name='itemSubtotal[]']").val(subtotal);
    $("#orForm .ic-level-1 input[name='itemSubtotal[]']").each(function(index){
        total+= isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
    });
    $("#orForm .total").text(total);
}

function merchBrochureOnSubmit(uom, merchandise, selectedMerch){
    var y;
    var merchItemTemplate = `
        <div style="overflow:auto;margin-bottom:2%" class="ic-level-1">
            <div style="float:left;width:95%;overflow:auto;">
                <div class="input-group mb-1">
                    <input type="text" name="itemName[]"
                        class="form-control form-control-sm"
                        placeholder="Item Name" style="width:24%" readonly>
                    <input type="number" name="itemQty[]"
                        class="form-control form-control-sm"
                        placeholder="Quantity">
                    <select name="itemUnit[]"
                        class="form-control form-control-sm" readonly>
                        <option value="" selected="selected">Unit
                        </option>
                    </select>
                    <input type="number" name="itemPrice[]"
                        class="form-control form-control-sm "
                        placeholder="Price" readonly>
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
                        placeholder="Stock" style="width:190px" data-id="" readonly>
                    <input name="actualQty[]" type="number"
                        class="form-control border-right-0"
                        placeholder="Actual Qty" style="width:15%" readonly>
                    <select name="paymentStatus[]"
                        class="form-control form-control-sm">
                        <option value="" selected="selected">Payment Status
                        </option>
                    </select>
                    <select name="deliveryStatus[]"
                        class="form-control form-control-sm ">
                        <option value="" selected>Delivery Status</option>
                    </select>
                </div>
            </div>
            <div class="mt-4"
                style="float:left:width:3%;overflow:auto;">
                <img class="exitBtn"
                    src="/assets/media/admin/error.png"
                    style="width:20px;height:20px;float:right;">
            </div>
        </div>`;
    selectedMerch.each(function(index) {
        y = merchandise.filter(x => x.spmID == $(this).val());
        $("#orForm .ic-level-2").append(merchItemTemplate);
        setIL1FormEvents();
        setInputUOM(uom);
        $("#orForm .ic-level-1:last-child input[name='itemName[]']").val(y[0].spmName);
        $("#orForm .ic-level-1:last-child select[name='itemUnit[]']").append(uom.map(unit =>{
            return `<option value="${unit.uomID}">${unit.uomAbbreviation}</option>`;
        }).join(''));
        $("#orForm .ic-level-1:last-child select[name='itemUnit[]']").find(`option[value=${y[0].uomID}]`).attr("selected","selected");
        $("#orForm .ic-level-1:last-child input[name='itemPrice[]']").val(y[0].spmPrice);
        $("#orForm .ic-level-1:last-child input[name='stID[]']").val(y[0].stName);
        $("#orForm .ic-level-1:last-child input[name='stID[]']").attr("data-id",y[0].stID);
        $("#orForm .ic-level-1:last-child input[name='actualQty[]']").val(y[0].spmActualQty);
        $("#orForm .ic-level-1:last-child *").on("focus",function(){
            if(!$(this).closest(".ic-level-1").attr("data-focus")){
                $("#orForm .ic-level-1").removeAttr("data-focus");
                $(this).closest(".ic-level-1").attr("data-focus",true);
            }
        });
    });
    $("#merchandiseBrochure").modal("hide");
} -->