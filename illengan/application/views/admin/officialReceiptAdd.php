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
                        <h6 style="font-size: 16px;margin-left:15px">Add Official Receipt</h6>
                    </div>
                    <!--Card--> 
                    <form id="orForm" accept-charset="utf-8">
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
                            <div class="form-row">
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border border-secondary"
                                            style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                            Receipt</span>
                                    </div>
                                    <input type="text" name="receipt"
                                        class="form-control form-control-sm  border-left-0">
                                </div>
                                <!--Remarks-->
                                <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border border-secondary"
                                            style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                            Remarks</span>
                                    </div>
                                    <textarea type="text" name="tRemarks"
                                        class="form-control form-control-sm  border-left-0"
                                        rows="1"></textarea>
                                </div>
                            </div>
                        <!--Transaction Items-->
                        <a id="addItemBtn" class="btn btn-primary btn-sm" data-original-title
                            style="margin:0;color:blue;font-weight:600">New Item</a>
                        <a id="addMBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#merchandiseBrochure"  data-original-title
                            style="margin:0;color:blue;font-weight:600;" data-url="<?= site_url('admin/getSupplierMerchandise')?>">Merchandise Item</a>
                        <a id="addPOBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#poBrochure"
                            style="color:blue;font-weight:600;">PO Item</a>
                        <a id="addDRBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#deliveryBrochure"
                            style="color:blue;font-weight:600;">DR Item</a>
                        <br><br>

                            <!--div containing the different input fields in addig trans items -->
                            <div class="ic-level-2">
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

                        <!--Start of Delivery Brochure Modal"-->
                        <div class="modal fade bd-example-modal-lg" id="deliveryBrochure" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true"
                            style="background:rgba(0, 0, 0, 0.3)">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Select Delivery Item</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form>
                                        <div class="modal-body">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text "
                                                        style="width:130px;background:#737373;color:white;font-size:14px;font-weight:600">
                                                        Purchase Order</span>
                                                </div>
                                                <select class="form-control form-control-sm" name="po">
                                                    <option value="" selected>Choose</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="ic-level-4">
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

                    <!--Start of Merchandise Brochure Modal"-->
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
                    
                    <!--Start of PO Brochure Modal"-->
                    <div class="modal fade bd-example-modal-lg" id="poBrochure" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">SSelect Merchandise Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form>
                                    <div class="modal-body">
                                    <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text "
                                                        style="width:130px;background:#737373;color:white;font-size:14px;font-weight:600">
                                                        Purchase Order</span>
                                                </div>
                                                <select class="form-control form-control-sm" name="po">
                                                    <option value="" selected>Choose</option>
                                                </select>
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

                    <!--Start of Brochure Modal"-->
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
                                        <div id="ic-level-2">
                                            <?php
                                                if(empty($stocks)){
                                                    echo json_encode($stocks);
                                            ?>
                                            <p>No stock items recorded.</p>
                                            <?php
                                                }else{
                                                    foreach($stocks as $stock){
                                            ?>
                                            <div class="d-flex d-inline-block ic-level-1">
                                                <div><input name="stocks" type="radio" class="mr-3" value="<?= $stock['stID']?>" data-name="<?= $stock['stName']?>"/></div>
                                                <div><?= $stock['stName']?> (<?= $stock['uomAbbreviation']?>)</div>
                                            </div>
                                            <?php
                                                    }
                                                }
                                            ?>
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
<script src="<?= framework_url().'mdb/js/jquery-3.3.1.min.js';?>"></script>
<script src="<?= framework_url().'bootstrap-native/bootstrap.bundle.min.js'?>"></script>
<!--  Charts Plugin -->
<script src="assets/js/admin/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/admin/bootstrap-notify.js"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/admin/light-bootstrap-dashboard.js?v=1.4.0"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/admin/demo.js"></script>
<script>
$(function(){
    var newItemTemplate = `
        <div style="overflow:auto;margin-bottom:2%" class="ic-level-1"">
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
        </div>`;
    $("#addItemBtn").on("click",function(){
        $("#orForm").find(".ic-level-2").append(newItemTemplate);
        $(".exitBtn").last().on("click",function(){
            $(this).closest(".ic-level-1").remove();
        });
        $("#orForm").find(".ic-level-1 input[name='stID[]']").last().on('focus',function(){
            $("#stockBrochure").modal("show");
            $("#stockBrochure form").on("submit",function(){
                $(this).find(".ic-level-2 input[name='stocks']").each(function(index){
                    $("#orForm .ic-level-2 .ic-level-1[data-focus='true']").find("input[name='stID[]']").attr("data-id",$(this).val());
                    $("#orForm .ic-level-2 .ic-level-1[data-focus='true']").find("input[name='stID[]']").val($(this).attr("data-name"));
                });
                $("#stockBrochure").modal("hide");
            });
        });
        $("#orForm").find(".ic-level-1").last().find("*").on("focus",function(){
            if(!$(this).closest(".ic-level-1").attr("data-focus")){
                $("#addEditTransaction").find(".ic-level-1").removeAttr("data-focus");
                $(this).closest(".ic-level-1").attr("data-focus",true);
            }
        });

    });
    $("#addMBtn").on("click",function(){
        var url = $(this).attr("data-url");
        var supplier = $("#orForm").find("select[name='spID']").val();
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
                    $("#merchandiseBrochure").on("submit",function(event){
                        event.preventDefault();
                        merchBrochureOnSubmit(data.uom, data.merchandise, $(this).find("input[name='merch']:checked"));
                    });
                },
                error: function (response, setting, errorThrown) {
                    console.log(errorThrown);
                    console.log(response.responseText);
                }
            });
        }
    });
    $("#addPOBtn").on("click",function(){

    });
    $("#addDRBtn").on("click",function(){

    });
    $("#stockBrochure").on("hidden.bs.modal",function(){
        $(this).find("form")[0].reset();
        $(this).find("form").off("submit");
    });
});

function setMerchandiseBrochure(supplier, merch){
    $("#merchandiseBrochure").find(".ic-level-2").append(merch.merchandise.map(item =>{
        return `
        <label style="width:96%"><input name="merch" type="checkbox" class="mr-2"
            value="${item.spmID}">${item.spmName}</label>`;
    }));
}

function setSubformValues(){

}

function merchBrochureOnSubmit(uom, merchandise, selectedMerch){
    var y;
    var merchItemTemplate = `
        <div style="overflow:auto;margin-bottom:2%" class="ic-level-1"">
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
        $("#orForm").find(".ic-level-2").append(merchItemTemplate);
        $("#orForm .ic-level-2").find("input[name='itemName[]']").last().val(y[0].spmName);
        $("#orForm .ic-level-2").find("select[name='itemUnit[]']").last().append(uom.map(unit =>{
            return `<option value="${unit.uomID}">${unit.uomAbbreviation}</option>`;
        }).join(''));
        $("#orForm .ic-level-2").find("select[name='itemUnit[]']").last().find(`option[value=${y[0].uomID}]`).attr("selected","selected");
        $("#orForm .ic-level-2").find("input[name='itemPrice[]']").last().val(y[0].spmPrice);
        $("#orForm .ic-level-2").find("input[name='stID[]']").last().val(y[0].stName);
        $("#orForm .ic-level-2").find("input[name='stID[]']").last().attr("data-id",y[0].stID);
        $("#orForm .ic-level-2").find("input[name='actualQty[]']").last().val(y[0].spmActualQty);
        $("#orForm").find(".ic-level-1").last().find("*").on("focus",function(){
            if(!$(this).closest(".ic-level-1").attr("data-focus")){
                $("#addEditTransaction").find(".ic-level-1").removeAttr("data-focus");
                $(this).closest(".ic-level-1").attr("data-focus",true);
            }
        });
    });
    $("#merchandiseBrochure").modal("hide");
}
</script>
</body>