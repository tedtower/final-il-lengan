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
                    <form id="drForm" accept-charset="utf-8" class="form">
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
                                        <?php if(!empty($merchandise)){
                                            foreach($merchandise as $merch){
                                        ?>
                                    
                                        <label style="width:96%"><input type="checkbox" name="merch[]" class="mr-2"
                                                value="<?= $merch['spmID']?>"><?= ucWords($merch['spmName'])?></label>
                                        <?php
                                            }
                                        }else{
                                            echo '<p>Please select a supplier first.</p>';
                                        }
                                        ?>
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
                                        <select class="tID custom-select" name="po">
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
            $('#drForm .ic-level-2').append(`<div style="overflow:auto;margin-bottom:2%" class="drElements">
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
            $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").append();
            $(".itemUnit").append(uom.map(uom => {
                return `<option value="${uom.uomID}">${uom.uomName}</option>`
            }).join(''));

            $('.stock').empty();
            $(".stock").append(`${stocks.map(stock => {
                return `<option value="${stock.stID}">${stock.stName}</option>`
            }).join('')}`);

            $(".exitBtn").on('click',function(){
                $(this).closest(".drElements").remove();
            });
        });

        $(".addMBtn").on('click', function(){
            var spID = parseInt($(this).closest('.form').find('.spID').val());
            setBrochureContent(suppmerch.filter(sm => sm.spID == spID));
        });

        $(".tID").on('change', function(){
            var poID = parseInt($('.tID').val());
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
            for (var index = 0; index < $(this).find(".drElements").length; index++) {
                var row = $(this).find(".drElements").eq(index);
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
        $("#list").append(`${suppstocks.map(st => {
            return `<label style="width:96%"><input type="checkbox" id="stID${st.stID}" name="stockitems" class="stockitems mr-2" 
            value="${st.stID}"> ${st.spmName} </label>`
            console.log(st.stID);
        }).join('')}`);
        
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
                <div style="overflow:auto;margin-bottom:2%" class="drElements" data-stockid="${st[0].stID}" data-stqty="${st[0].prstQty}" data-currqty="${st[0].stQty}">
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
            $(this).closest(".drElements").remove();
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
            <div style="overflow:auto;margin-bottom:2%" class="drElements" data-id="${poi[0].itemID}" >
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
        $(this).closest(".drElements").remove();
    });
    $("#poBrochure").modal("hide");
}


function setInputValues() {
    var total = 0;
    for(var i = 0; i <= $('.drElements').length -1 ; i++) {
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