<!--End Side Bar-->

<body style="background:white">
    <div class="content">
        <div class="container-fluid">
            <br>
            <p style="text-align:right; font-weight: regular; font-size: 16px">
                <!-- Real Time Date & Time -->
                <?php echo date("M j, Y -l"); ?>
            </p>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <!--Table-->
                            <div class="card-content">
                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#addEditTransaction" data-original-title style="margin:0"
                                    id="addBtn">Add Transaction</button>
                                <br>
                                <br>
                                <table id="transTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead class="thead-dark">
                                        <th><b class="pull-left">Receipt No.</b></th>
                                        <th><b class="pull-left">Supplier</b></th>
                                        <th><b class="pull-left">Type</b></th>
                                        <th><b class="pull-left">Date</b></th>
                                        <th><b class="pull-left">Total</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                        <!--Start of Table row-->
                                        <?php if($transactions[0] != null){
                                        foreach($transactions as $transaction){
                                    ?>
                                        <tr data-id="<?= $transaction['tID']?>">
                                            <td><a href="javascript:void(0)" class="ml-2 mr-4"><img class="accordionBtn"
                                                        src="/assets/media/admin/down-arrow%20(1).png"
                                                        style="height:15px;width: 15px" /></a><?= $transaction['tNum'] == NULL ? "N/A" : $transaction['tNum'] ?>
                                            </td>
                                            <td><?= ucwords($transaction['spName'])?></td>
                                            <td><?= ucwords($transaction['tType'])?></td>
                                            <td><?= $transaction['tDate']?></td>
                                            <td>&#8369; <?=$transaction['tTotal']?></td>
                                            <td>
                                                <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal"
                                                    data-target="#addEditTransaction">Edit</button>
                                                <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#delete">Archived</button>
                                            </td>
                                        </tr>
                                        <!--End of Table row-->

                                        <!--Start of Table accordion-->
                                        <tr class="accordion" style="display:none">
                                            <td colspan="8">
                                                <div class="container" style="display:none">
                                                    <span>Date Recorded:
                                                        <?= $transaction['dateRecorded'] == null ? "N/A" : $transaction['dateRecorded']?></span>
                                                    <div style="overflow:auto">
                                                        <span style="float:left;margin-right:1%">Remarks: </span>
                                                        <p style="float:left">
                                                            <?= $transaction['tRemarks'] == null ? "No remarks" : $transaction['tRemarks']?>
                                                        </p>
                                                        <!--Remarks of Invoice-->
                                                    </div>
                                                    <table class="table">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Qty</th>
                                                                <th>UOM</th>
                                                                <th>Price</th>
                                                                <th>Discount</th>
                                                                <th>Status</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($transitems as $transitem){
                                                        if($transitem['tID'] == $transaction['tID']){?>
                                                            <tr>
                                                                <td><?= ucwords($transitem['tiName'])?></td>
                                                                <td><?= $transitem['tiQty']?></td>
                                                                <td><?= strtolower($transitem['uomAbbreviation'])?></td>
                                                                <td><?= number_format($transitem['tiPrice'],2,".",',')?>
                                                                </td>
                                                                <td><?= number_format($transitem['tiDiscount'],2,".",',')?>
                                                                </td>
                                                                <td><?= ucwords($transitem['tiStatus'])?></td>
                                                                <td><?= number_format($transitem['tiSubtotal'],2,".",',')?>
                                                                </td>
                                                            </tr>
                                                            <?php }
                                                    }?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    }?>
                                        <!--End of Table accordion-->
                                    </tbody>
                                </table>
                                <!--End Table Content-->

                                <!--Start of Modal "Add Transaction"-->
                                <div class="modal fade bd-example-modal-lg" id="addEditTransaction" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    style="overflow: auto !important;">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Transactions</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form accept-charset="utf-8">
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
                                                            <select class="form-control form-control-sm  border-left-0"
                                                                name="spID">
                                                                <option value="" selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Invoice Type-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text border border-secondary"
                                                                    style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                                    Type</span>
                                                            </div>
                                                            <select class="form-control form-control-sm  border-left-0"
                                                                name="tType">
                                                                <option value="" selected>Choose</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <!--Container of supplier and receipt no.-->
                                                        <!--Receipt Number-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text border border-secondary"
                                                                    style="width:100px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                                    Receipt No.</span>
                                                            </div>
                                                            <input type="text" class="form-control  border-left-0"
                                                                name="tNum">
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

                                                    <!--Transaction Items-->
                                                    <a id="addItemBtn" class="btn btn-primary btn-sm" data-original-title
                                                        style="margin:0;color:white;font-weight:600;background:#0073e6">Add Unknown Item</a>
                                                    <a id="addMBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#merchandiseBrochure"  data-original-title
                                                        style="margin:0;color:white;font-weight:600;background:#0073e6">Add Merchandise</a>
                                                    <!--Transaction PO Items-->
                                                    <a id="addPOBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#transactionBrochure"
                                                        style="color:white;font-weight:600;background:#0073e6">Add PO Items</a>
                                                    <a id="addDRBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#transactionBrochure"
                                                        style="color:white;font-weight:600;background:#0073e6">Add DR Items</a>
                                                    <br><br>

                                                    <!--div containing the different input fields in adding trans items -->
                                                    <div class="ic-level-2">
                                                    </div>
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
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Add Transaction"-->

                                <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal-lg" id="transactionBrochure" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog modal-lg" role="document">
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
                                                    <div>
                                                        <label><input type="checkbox" name="tType" value="po"/>Purchase Order</label>
                                                        <label><input type="checkbox" name="tType" value="dr"/>Delivery Receipt</label>
                                                    </div>
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
                                                    <div id="stockList">
                                                        <div class="d-flex d-inline-block">
                                                            <div><input name="stocks[]" type="radio" class="mr-3" value=/></div>
                                                            <div>basta</div>
                                                        </div>
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

                                <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal-sm" id="merchandiseBrochure" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form>
                                                <div class="modal-body">
                                                    <table>
                                                        <thead>
                                                            <th></th>
                                                            <th>Name</th>
                                                            <th>UOM</th>
                                                            <th>Price</th>
                                                            <th>Stock</th>
                                                            <th>Qty/UOM</th>
                                                        </thead>
                                                        <tbody class="ic-level-2">
                                                        </tbody>
                                                    </table>
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
                                
                                <!--Start of Modal "Delete Stock Item"-->
                                <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete/Archive
                                                    Transaction
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="confirmDelete">
                                                <div class="modal-body">
                                                    <h6 id="deleteTableCode"></h6>
                                                    <p>Are you sure you want to delete/archive this item?</p>
                                                    <input type="text" name="" hidden="hidden">
                                                    <div>
                                                        Remarks:<input type="text" name="deleteRemarks"
                                                            id="deleteRemarks" class="form-control form-control-sm">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Delete Stock Item"-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
    <script>
    var getEnumValsUrl = '<?= site_url('admin/transactions/getEnumVals')?>';
    var crudUrl = '<?= site_url('admin/transactions/add')?>';
    var getTransUrl = '<?= site_url('admin/transactions/getTransaction')?>';
    var loginUrl = '<?= site_url('login')?>';
    var getPOsUrl = '<?= site_url('admin/transactions/getPOs')?>';
    var getDRsUrl = '<?= site_url('admin/transactions/getDRs')?>';
    var getSPMsUrl = '<?= site_url('admin/transactions/getSPMs')?>';
    $(function() {
        $("#addBtn").on("click", function(){
            setAddEditBtnHandlers();
        });
        $('#addEditTransaction').on('hidden.bs.modal', function () {
            $("#addEditTransaction form")[0].reset();
            $(this).find("select[name='spID']").off('change');
            $("#addItemBtn").off('click');
            $("#addPOBtn").off('click');
            $("#addDRBtn").off('click');
            $("#addMBtn").off('click');
            $("#addEditTransaction").find(".ic-level-2").empty();
        });
        $(".accordionBtn").on('click', function() {
            if ($(this).closest('tr').next('.accordion').css('display') === 'none') {
                $(this).closest('tr').next('.accordion').slideDown();
                $(this).closest('tr').next('.accordion').find('div').slideDown();
            } else {
                $(this).closest('tr').next('.accordion').find('div').slideUp();
                $(this).closest('tr').next('.accordion').slideUp();
            }
        });
        $(".editBtn").on('click', function() {
            var id = $(this).closest("tr").attr("data-id");
            setAddEditBtnHandlers();
            populateModalForm(getTransUrl, id);
        });
        $("#addEditTransaction form").on('submit', function(event) {
            event.preventDefault();
            var id = $(this).find('input[name="tID"]').val();
            var supplier = $(this).find('select[name="spID"]').val();
            var type = $(this).find('select[name="tType"]').val();
            var receipt = $(this).find('input[name="tNum"]').val();
            var date = $(this).find('input[name="tDate"]').val();
            var remarks = $(this).find('textarea[name="tRemarks"]').val();
            var transitems = [];
            for(var x = 0; x < $(this).find('.ic-level-1').length ; x++){
                var tiID = $(this).find('.ic-level-1').eq(x).attr("data-id");
                transitems.push({
                    tiID: isNaN(parseInt(tiID)) ? (undefined) : tiID,
                    tiName: $(this).find('input[name = "itemName[]"]').eq(x).val(),
                    stID: $(this).find('input[name = "stID[]"]').eq(x).attr("data-id"),
                    tiQty: $(this).find('input[name = "itemQty[]"]').eq(x).val(),
                    stQty: $(this).find('input[name = "actualQty[]"]').eq(x).val(),
                    tiUnit: $(this).find('select[name = "itemUnit[]"]').eq(x).val(),
                    stUnit: $(this).find('select[name = "actualUnit[]"]').eq(x).val(),
                    tiPrice: $(this).find('input[name = "itemPrice[]"]').eq(x).val(),
                    tiStatus: $(this).find('select[name = "itemStatus[]"]').eq(x).val()
                });
            }
            $.ajax({
                method: 'POST',
                url: crudUrl,
                data: {
                    id: id,
                    supplier: supplier,
                    type: type,
                    receipt: receipt,
                    date: date,
                    remarks: remarks,
                    transitems: JSON.stringify(transitems)
                },
                dataType: 'JSON',
                beforeSend: function(){
                    console.log(transitems);
                },
                success: function(data){
                    console.log(data);
                },
                error: function(response, setting, error) {
                    console.log(response.responseText);
                    console.log(error);
                }
            });
        });
        $("#stockBrochure form").on('submit',function(event){
            event.preventDefault();
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='stID[]']").val($(this).find("input[name='stocks']:checked").attr("data-name"));
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='stID[]']").attr("data-id", $(this).find("input[name='stocks']:checked").val());
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("select[name='actualUnit[]']").trigger('change');
            $(this)[0].reset();
            $("#stockBrochure").modal("hide");
        });
        $("#merchandiseBrochure, #stockBrochure").on("hidden.bs.modal", function(){
            $(this).find(".ic-level-2").empty();
            $(this).find("form")[0].reset();
            $(this).find("form").off('submit');
        });
        $("#transactionBrochure").on("hidden.bs.modal", function(){
            $(this).find(".ic-level-4").empty();
            $(this).find("form")[0].reset();
            $(this).find("form").off('submit');
        });
    });

    function getEnumVals(url) {
        $.ajax({
            method: 'POST',
            url: url,
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                var input;
                $("#addEditTransaction").find('select[name="spID"]').children().first().siblings().remove();
                $("#addEditTransaction").find('select[name="tType"]').children().first().siblings().remove();
                $("#addEditTransaction").find('select[name="spID"]').append(data.suppliers.map(supplier => {
                    return `<option value="${supplier.spID}">${supplier.spName}</option>`;
                }).join(''));
                $("#addEditTransaction").find('select[name="tType"]').append(data.tTypes.map(type => {
                    return `<option value="${type}">${type.toUpperCase()}</option>`;
                }).join(''));
                $("#addItemBtn").on('click',function(){
                    $("#addEditTransaction").find(".ic-level-2").append(`
                    <div class="container mb-3 ic-level-1"
                        style="overflow:auto;width:100%" data-id="">
                        <div style="float:left;width:95%;overflow:auto;">

                            <div class="input-group mb-1">
                                <input type="text" name="itemName[]"
                                    class="form-control form-control-sm"
                                    placeholder="Item Name" style="width:24%">
                                <input name="stID[]" type="text"
                                    class="form-control border-right-0"
                                    placeholder="Stock" style="width:15%">
                                <input type="number" name="itemQty[]"
                                    class="form-control form-control-sm"
                                    placeholder="Quantity">
                                <input type="number" name="actualQty[]"
                                    class="form-control form-control-sm"
                                    placeholder="Actual Qty">

                            </div>
                            <div class="input-group">
                                <select name="itemUnit[]"
                                    class="form-control form-control-sm">
                                    <option value="" selected="selected">Unit
                                    </option>
                                </select>
                                <select name="actualUnit[]"
                                    class="form-control form-control-sm">
                                    <option value="" selected="selected">Actual Unit
                                    </option>
                                </select>
                                <input type="number" name="itemPrice[]"
                                    class="form-control form-control-sm "
                                    placeholder="Price">
                                <input type="number" name="itemSubtotal[]"
                                    class="form-control form-control-sm "
                                    placeholder="Subtotal">
                                <select name="itemStatus[]"
                                    class="form-control form-control-sm ">
                                    <option value="" selected>Choose Status</option>
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
                    $("#addEditTransaction").find(".exitBtn").last().on('click',function(){
                        $(this).closest(".ic-level-1").remove();
                    });
                    $("#addEditTransaction").find("select[name='itemUnit[]']").last().append(data.uoms.map(uom=>{
                        return `<option value="${uom.uomID}">${uom.uomAbbreviation}</option>`;
                    }).join(''));
                    $("#addEditTransaction").find("select[name='actualUnit[]']").last().append(data.uoms.map(uom=>{
                        return `<option value="${uom.uomID}">${uom.uomAbbreviation}</option>`;
                    }).join(''));
                    $("#addEditTransaction").find("select[name='itemStatus[]']").last().append(data.tiStatuses.map(status=>{
                        return `<option value="${status}">${status.toUpperCase()}</option>`;
                    }).join(''));
                    $("#addEditTransaction").find(".ic-level-1 *").on("focus",function(){
                        if(!$(this).closest(".ic-level-1").attr("data-focus")){
                            $("#addEditTransaction").find(".ic-level-1").removeAttr("data-focus");
                            $(this).closest(".ic-level-1").attr("data-focus",true);
                        }
                    });
                    $("#addEditTransaction").find("input[name='stID[]']").last().on('focus', function(){
                        $("#stockList").empty();
                        $("#stockList").append(data.stocks.map(stock =>{
                            return `<div class="d-flex d-inline-block"><label>
                                <div><input name="stocks" type="radio" class="mr-3" value=${stock.stID} data-name="${stock.stName}" /></div>
                                <div>${stock.stName}</div></label>
                            </div>`;
                        }).join(''));
                        $("#stockBrochure").modal('show');
                    });
                    $("#addEditTransaction").find("select[name='actualUnit[]']").last().on('change', function(event){
                        var stID = $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='stID[]']").attr("data-id");
                        $(this).find(`option[value=${data.stocks.filter(stock=>stock.stID == stID)[0].uomID}]`).attr("selected","selected");
                    });
                    $("#addEditTransaction").find("input[name='itemPrice[]']").last().on('change', function(event){
                        computeICSubtotal();
                    });
                    $("#addEditTransaction").find("input[name='itemQty[]']").last().on('change', function(event){
                        computeICSubtotal();
                    });
                    $("#addEditTransaction").find("input[name='itemSubtotal[]']").last().on('change', function(event){
                        computeICSubtotal();
                    });
                });
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            }
        });
    }
    function computeICSubtotal(){
        var qty = parseInt($("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='itemQty[]']").val());
        var price = parseFloat($("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='itemPrice[]']").val());
        var subtotal;
        if(isNaN(qty)){
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='itemQty[]']").val(0);
            qty = 0;
        }
        if(isNaN(price)){
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='itemPrice[]']").val(0);
            price = 0;
        }
        subtotal = qty * price;
        $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='itemSubtotal[]']").val(subtotal.toFixed(2));
    }
    function populateModalForm(url, id) {
        $.ajax({
            method: 'POST',
            url: url,
            data: {
                id: id
            },
            dataType: 'JSON',
            success: function(data) {
                if(!data.inputErr){
                    $("#addEditTransaction").find('input[name="tID"]').val(data.transaction[0].tID);
                    $("#addEditTransaction").find('select[name="spID"]').children(`option[value=${data.transaction[0].spID}]`).attr('selected', 'selected');
                    $("#addEditTransaction").find('select[name="tType"]').children(`option[value="${data.transaction[0].tType}"]`).attr(
                        'selected', 'selected');
                    $("#addEditTransaction").find('input[name="tNum"]').val(data.transaction[0].tNum);
                    $("#addEditTransaction").find('input[name="tDate"]').val(data.transaction[0].tDate);
                    $("#addEditTransaction").find('textarea[name="tRemarks"]').val(data.transaction[0].tRemarks);
                    data.transitems.forEach(item =>{
                        $("#addItemBtn").trigger("click");
                        $("#addEditTransaction").find(".ic-level-1").last().attr("data-id",item.tiID);
                        $("#addEditTransaction").find(".ic-level-1").last().attr("data-focus",true);
                        $("#addEditTransaction").find("input[name='itemName[]']").last().val(item.tiName);
                        $("#addEditTransaction").find("input[name='stID[]']").last().attr("data-id",item.stID);
                        $("#addEditTransaction").find("input[name='stID[]']").last().val(item.stName);
                        $("#addEditTransaction").find("input[name='itemQty[]']").last().val(item.tiQty);
                        $("#addEditTransaction").find("input[name='actualQty[]']").last().val(item.tiActualQty);
                        $("#addEditTransaction").find("select[name='itemUnit[]']").last().children(`option[value=${item.uomID}]`).attr("selected","selected");
                        $("#addEditTransaction").find("input[name='itemPrice[]']").last().val(parseFloat(item.tiPrice).toFixed(2));
                        $("#addEditTransaction").find("input[name='itemSubtotal[]']").last().val(parseFloat(item.tiSubtotal).toFixed(2));
                        $("#addEditTransaction").find("select[name='itemStatus[]']").last().children(`option[value='${item.tiStatus}']`).attr("selected","selected");
                        $("#addEditTransaction").find("select[name='actualUnit[]']").last().trigger("change");
                        $("#addEditTransaction").find(".ic-level-1").last().removeAttr("data-focus");
                    });
                }
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            }
        });
    }
    function setAddEditBtnHandlers(){
        var previousVal;
        $("#addPOBtn").prop("disabled",true);
        $("#addDRBtn").prop("disabled",true);
        $('#addEditTransaction').find("select[name='spID']").on("focus",function(){
            previousVal = $(this).val();
        }).change(function(){
            if(!isNaN(parseInt(previousVal))){
                $("#addEditTransaction").find(".ic-level-2").children().remove();
            }
            previousVal = $(this).val();
        });
        $("#addEditTransaction").find("select[name='tType']").on("change",function(){
            switch($(this).val()){
                case "purchase order" : 
                    $("#addPOBtn").prop("disabled",true);
                    $("#addDRBtn").prop("disabled",true);
                    break;
                case "delivery receipt" :
                    $("#addPOBtn").prop("disabled",false);
                    $("#addDRBtn").prop("disabled",true);
                    break;
                case "official receipt" :
                    $("#addPOBtn").prop("disabled",false);
                    $("#addDRBtn").prop("disabled",false);
                    break;
                default:
                    break;
            }
        });
        getEnumVals(getEnumValsUrl);
        $("#addMBtn").on("click",function(){
            setMerchandiseBrochure(getSPMsUrl);
        });
        $("#addPOBtn").on("click",function(){
            setTransactionBrochure(getPOsUrl);
        });
        $("#addDRBtn").on("click",function(){
            setTransactionBrochure(getDRsUrl);
        });
    }
    function setTransactionBrochure(url){
        var spID = $("#addEditTransaction").find("select[name='spID']").val();
        $.ajax({
            method: "POST",
            url: url,
            data: {
                supplier: spID
            },
            dataType: "JSON",
            success: function(data){
                if(!data.inputErr){
                    if(!Array.isArray(data.transactions) && !(data.transactions.length > 0)){
                        $("#transactionBrochure .ic-level-4").hide();
                    }else{
                        $("#transactionBrochure .ic-level-4").show();
                        $("#transactionBrochure .ic-level-4").append(data.transactions.map(transaction=>{
                            return `<div>
                                    <input type="checkbox" name="transaction" value="${transaction.tID}"/>
                                    <span>Receipt No.: </span><span>${transaction.tNum}</span>
                                    <span>Transaction Date: </span><span>${transaction.tDate}</span>
                                    <span>Date Recorded: </span><span>${transaction.dateRecorded}</span>
                                </div>
                                <table class="table ic-level-3">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:2%"></th>
                                            <th>Item</th>
                                            <th>Unit</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ic-level-2">
                                        ${data.transitems.filter(item=> item.tID == transaction.tID).map(item=>{
                                            return `<tr class="ic-level-1">
                                                    <td><input type="checkbox" name="tiID[]" value="${item.tiID}" data-tID="${item.tID}"></td>
                                                    <td>${item.tiName}</td>
                                                    <td>${item.uomAbbreviation}</td>
                                                    <td>${item.tiQty}</td>
                                                    <td>${parseFloat(item.tiPrice).toFixed(2)}</td>
                                                    <td>${parseFloat(item.tiSubtotal).toFixed(2)}</td>
                                                    <td>${item.tiStatus}</td>
                                                </tr>`;
                                        }).join('')}
                                    </tbody>
                                </table>`;
                        }).join(''));
                        $("#transactionBrochure form").on("submit",function(event){
                            event.preventDefault();
                            var selectItems = [];
                            $(this).find("input[name='tiID[]']:checked").each(function(index){
                                selectItems.push($(this).val());
                            });
                            selectItems = data.transitems.filter(item=> selectItems.includes(item.tiID));
                            selectItems.forEach(item =>{
                                $("#addItemBtn").trigger("click");
                                $("#addEditTransaction").find(".ic-level-1").last().attr("data-id",item.tiID);
                                $("#addEditTransaction").find(".ic-level-1").last().attr("data-focus",true);
                                $("#addEditTransaction").find("input[name='itemName[]']").last().val(item.tiName);
                                $("#addEditTransaction").find("input[name='stID[]']").last().attr("data-id",item.stID);
                                $("#addEditTransaction").find("input[name='stID[]']").last().val(item.stName);
                                $("#addEditTransaction").find("input[name='itemQty[]']").last().val(item.tiQty);
                                $("#addEditTransaction").find("input[name='actualQty[]']").last().val(item.tiActualQty);
                                $("#addEditTransaction").find("select[name='itemUnit[]']").last().children(`option[value=${item.uomID}]`).attr("selected","selected");
                                $("#addEditTransaction").find("input[name='itemPrice[]']").last().val(parseFloat(item.tiPrice).toFixed(2));
                                $("#addEditTransaction").find("input[name='itemSubtotal[]']").last().val(parseFloat(item.tiSubtotal).toFixed(2));
                                $("#addEditTransaction").find("select[name='itemStatus[]']").last().children(`option[value='${item.tiStatus}']`).attr("selected","selected");
                                $("#addEditTransaction").find("select[name='actualUnit[]']").last().trigger("change");
                                $("#addEditTransaction").find(".ic-level-1").last().removeAttr("data-focus");
                            });
                            $("#transactionBrochure").modal("hide");
                        });
                    }
                }else{
                    console.log(data);
                }
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            }
        });
    }
    function setMerchandiseBrochure(url){
        var spID = $("#addEditTransaction").find("select[name='spID']").val();
        $.ajax({
            method: "POST",
            url: url,
            data: {
                supplier: spID
            },
            dataType: "JSON",
            success: function(data){
                if(!data.inputErr){
                    $("#merchandiseBrochure").find(".ic-level-2").append(data.merchandise.map(merchandise =>{
                            return `<tr class="ic-level-1">
                                <td><input type="checkbox" name="merchandise" value="${merchandise.spmID}"/></td>
                                <td>${merchandise.spmName}</td>
                                <td>${merchandise.uomAbbreviation}</td>
                                <td>${merchandise.spmPrice}</td>
                                <td>${merchandise.stName}</td>
                                <td>${merchandise.spmActualQty}</td>
                            </tr>`;
                        }).join(''));
                    $("#merchandiseBrochure form").on("submit",function(event){
                        event.preventDefault();
                        var selectedMerch = [];
                        $(this).find("input[name='merchandise']:checked").each(function(index){
                            selectedMerch.push($(this).val());
                        });
                        selectedMerch = data.merchandise.filter(merchandise => selectedMerch.includes(merchandise.spmID));
                        selectedMerch.forEach(merch => {
                            $("#addItemBtn").trigger("click");
                            $("#addEditTransaction").find(".ic-level-1").last().attr("data-focus",true);
                            $("#addEditTransaction").find("input[name='itemName[]']").last().val(merch.spmName);
                            $("#addEditTransaction").find("input[name='stID[]']").last().attr("data-id",merch.stID);
                            $("#addEditTransaction").find("input[name='stID[]']").last().val(merch.stName);
                            $("#addEditTransaction").find("input[name='actualQty[]']").last().val(merch.spmActualQty);
                            $("#addEditTransaction").find("select[name='itemUnit[]']").last().children(`option[value=${merch.uomID}]`).attr("selected","selected");
                            $("#addEditTransaction").find("input[name='itemPrice[]']").last().val(merch.spmPrice);
                            $("#addEditTransaction").find("select[name='actualUnit[]']").last().trigger("change");
                            $("#addEditTransaction").find(".ic-level-1").last().removeAttr("data-focus");
                        });
                        $("#merchandiseBrochure").modal("hide");
                    });
                }else{
                    console.log(data);
                }
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            }
        });
    }
</script>
</body>