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
                        <h6 style="font-size: 16px;margin-left:15px">Add Purchase Order</h6>
                    </div>
                    <!--Card--> 
                    <form accept-charset="utf-8" class="form">
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
                                    <select class="spID form-control form-control-sm  border-left-0" name="spID">
                                        <option value="" selected>Choose</option>
                                    <?php if(isset($supplier)){
                                        foreach($supplier as $sup){?>
                                        <option value="<?= $sup['spID']?>"><?= $sup['spName']?></option>
                                    <?php }}?>
                                    </select>
                                </div>
                                <!--Invoice Type-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border border-secondary"
                                            style="width:142px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                            Transaction Date</span>
                                    </div>
                                    <input type="date" class="form-control  border-left-0"
                                        name="tDate">
                                </div>
                            </div>
                            <!--Remarks-->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border border-secondary"
                                        style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                        Remarks</span>
                                </div>
                                <textarea type="text" name="tRemarks"
                                    class="form-control form-control-sm  border-left-0"
                                    rows="1"></textarea>
                            </div>
                            <a id="addMBtn" class="addMBtn btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#merchandiseBrochure"  data-original-title
                                style="margin:0;color:blue;font-weight:600;">Add Merchandise</a>
                            <br><br>

                            <!--div containing the different input fields in adding trans items -->
                            <div class="ic-level-1">
                            <div style="overflow:auto;margin-bottom:2%">
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
                                            placeholder="Subtotal">
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
                                <div class="mt-4"style="float:left:width:3%;overflow:auto;">
                                    <img class="exitBtn" src="/assets/media/admin/error.png"style="width:20px;height:20px;float:right;">
                                </div>
                            </div>
                            </div>
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

                    <!--Start of Brochure Modal"-->
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
                                        <label style="width:96%"><input type="checkbox" class="mr-2"
                                                value="">Sample data 2</label>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('templates/scripts.php') ?>
    <script>
    var stocks = [];
    var supplier = [];
    var suppmerch = [];
    $(function () {
        $.ajax({
            url: '/admin/jsonPO',
            dataType: 'json',
            success: function (data) {
                var poLastIndex = 0;
                stocks = data.stock;
                supplier = data.supplier;
                suppmerch = data.suppmerch;
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        $(".addMBtn").on('click', function(){
            var spID = parseInt($(this).closest('.form').find('.spID').val());
            setBrochureContent(suppmerch.filter(sm => sm.spID == spID));
            console.log('eye');
        });
    });
    function setBrochureContent(suppstocks){
        $("#list").empty();
        
        $("#list").append(`${suppstocks.map(st => {
            return `<label style="width:96%"><input type="checkbox" id="stID${st.stID}" name="stockitems" class="stockitems mr-2" 
            value="${st.stID}"> ${st.spmName} </label>`
        }).join('')}`);
    }
    
var subPrice = 0;
function getSelectedStocks() {
    $(document).ready(function () {
        var value = 0;
        var choices = document.getElementsByClassName('stockitems');
        var merchChecked, st;
        for (var i = 0; i <= choices.length - 1; i++) {
            if (choices[i].checked) {
                value = choices[i].value;
                st = stocks.filter(st => st.stID === value);
                var name = st[0].stName+' '+st[0].stSize;
                console.log(st);
                merchChecked = `
                <div style="overflow:auto;margin-bottom:2%">
                    <div style="float:left;width:95%;overflow:auto;" data-stockid="${st[0].stID}" data-stqty="${st[0].prstQty}" data-currqty="${st[0].stQty}">
                        <div class="input-group mb-1">
                            <input type="text" name="itemName[]"
                                class="form-control form-control-sm"
                                value="${st[0].stName} ${st[0].stSize}" style="width:24%" readonly>
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
                                placeholder="Subtotal">
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
                    <div class="mt-4"style="float:left:width:3%;overflow:auto;">
                        <img class="exitBtn" src="/assets/media/admin/error.png"style="width:20px;height:20px;float:right;">
                    </div>
                </div>
                 `;
                
                $('.ic-level-1').append(merchChecked);
                    // setInputValues();
             
            }
        }
    });
}
    </script>
</body>