
<body style="background: white">
<div class="content">
    <div class="container-fluid">
        <br>
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y -l"); ?>
        </p>
        <div class="content" style="margin-left:250px">
                <!--Table-->
                <div class="container-fluid" id="stockTable">
                <div class="card-content" class="stockTable">
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addEditStock" data-original-title
                        style="margin:0;color:blue" id="addBtn">Add Stock Item</a>
                    <a class="btn btn-primary btn-sm" href="<?= site_url('admin/inventory/physicalcount')?>" data-original-title style="margin:0"
                        d="addBtn">Perform Inventory</a>
                    <a class="btn btn-primary btn-sm" style="margin:0;color:blue;float:right" href="<?= site_url('admin/inventorylist')?>"><i class="fal fa-list-ul"></i> Inventory List</a>
                   <br><br>
                    
                    <!--Search-->
                    <div id="stockTable" style="width:25%; float:right; border-radius:5px">
                        <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                    </div>
                    <br><br>
                    <!--Table Body-->
                    <table id="stockTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                        <thead class="thead-dark">
                            <tr>
                                <th><b class="pull-left">Stock Name</b></th>
                                <th><b class="pull-left">Category</b></th>
                                <th><b class="pull-left">Quantity</b></th>
                                <th><b class="pull-left">Min Qty</b></th>
                                <th><b class="pull-left">Unit</b></th>
                                <th><b class="pull-left">Status</b></th>
                                <th><b class="pull-left">Storage</b></th>
                                <th><b class="pull-left">Action</b></th>
                            </tr>

                        </thead>
                        <tbody class="stockTable ic-level-1">
                        </tbody>
                    </table>
			<div id="pagination"></div>
                    <p id="note"></p>
                <!--Start of Modal "Restock Item"-->
                    <div class="modal fade bd-example-modal-lg" id="restock" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Restock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url('admin/inventory/add')?>" method="get"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <!--Add Stock Item-->
                                        <a class="btn btn-primary btn-sm" style="color:blue;margin:0"
                                            data-toggle="modal" data-target="#stockBrochure">Add Item</a>
                                        <!--Button to add row in the table-->
                                        <br><br>
                                        <table class=" table table-sm table-borderless inputTable">
                                            <!--Table containing the different input fields in adding trans items -->
                                            <thead style="border-bottom:2px solid #cecece">
                                                <tr class="text-center">
                                                    <th><b>Stock Name</b></th>
                                                    <th><b>Current Qty</b></th>
                                                    <th><b>Unit</b></th>
                                                    <th><b>Restock Qty</b></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">
                                            </tbody>
                                        </table>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Modal "Restock item"-->

                    <!--Start of Modal "Beginning"-->
                    <div class="modal fade bd-example-modal-lg" id="beginning" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow:auto !important">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Perform Ending Inventory</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="get" accept-charset="utf-8">
                                    <div class="modal-body">
                                        <!--Add Stock Item-->
                                        <a class="btn btn-primary btn-sm" style="color:blue;margin:0"
                                            data-toggle="modal" data-target="#BeginningBrochure">Add Items</a>
                                        <!--Button to add row in the table-->
                                        <br><br>
                                        <table class=" table table-sm table-borderless inputTable">
                                            <!--Table containing the different input fields in adding trans items -->
                                            <thead style="border-bottom:2px solid #cecece">
                                                <tr class="text-center">
                                                    <th><b>Stock Name</b></th>
                                                    <th><b>Current</b></th>
                                                    <th><b>Actual</b></th>
                                                    <th><b>Discrepancy</b></th>
                                                    <th><b>Remarks</b></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">
                                            </tbody>
                                        </table>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Modal "Restock item"-->

                    <!--Start of Brochure Modal"-->
                    <div class="modal fade bd-example-modal" id="stockBrochure" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="formAdd" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div class="ic-level-2" style="margin:1% 3%">
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
                    <div class="modal fade bd-example-modal-lg" id="BeginningBrochure" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Stock Items</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="formAdd" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <table class="table table-borderless">
                                            <thead style="border-bottom:2px solid #cecece">
                                                <tr>
                                                    <th></th>
                                                    <th><b>Stock Name</b></th>
                                                    <th><b>Category</b></th>
                                                    <th><b>Current</b></th>
                                                    <th><b>Unit</b></th>
                                                </tr>
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

                    <!--Start of Modal "Add Stock Item"-->
                    <div class="modal fade bd-example-modal-lg" id="addEditStock" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Stock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url('admin/inventory/add')?>" method="get"
                                    accept-charset="utf-8">
                                    <input type="text" name="stockID" id="stockID"
                                                class="form-control form-control-sm" hidden="hidden">
                                    <div class="modal-body" style="margin:1%;">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                    style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                    Stock Name</span>
                                            </div>
                                            <input class="form-control form-control-sm" name="stockName" type="textarea" value="" id="stockName" require pattern="[a-zA-Z][a-zA-Z\s]*" title="Stock name should only countain letters and white spaces." required>
                                        </div>
                                        <div class="form-row">
                                            <!--Stock Type-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm"
                                                            style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Type</span>
                                                    </div>
                                                    <select name="stockType" class="form-control" required>
                                                        <option value="" selected>Choose</option>
                                                        <option value="liquid">Liquid</option>
                                                        <option value="solid">Solid</option>
                                                    </select>
                                                </div>
                                            <!--Stock size-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Size</span>
                                                </div>
                                                <input type="number" class="form-control" name="stockSize" min="0">
                                                <select class="form-control" name="stockSizeUOM" style="border-left:1px solid whitesmoke">
                                                    <option value="">Choose Unit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <!--Stock UOM-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Stock UOM</span>
                                                </div>
                                                <select class="form-control" name="stockUOM" style="border-left:1px solid whitesmoke" required>
                                                    <option value="">Choose Unit</option>
                                                </select>
                                            </div>
                                            <!--Stock Storage-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Storage</span>
                                                </div>
                                                <select name="stockStorage" class="form-control" required>
                                                    <option value="" selected>Choose</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!--Category-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Category</span>
                                                </div>
                                                <select name="stockCategory" class="form-control" required>
                                                    <option value="" selected>Choose</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <!--Status-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Status</span>
                                                </div>
                                                <select name="stockStatus" class="form-control" required>
                                                    <option value="" selected>Choose</option>
                                                    <option value="available">Available</option>
                                                    <option value="unavailable">Unavailable</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <!--Quantity-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Quantity</span>
                                                </div>
                                                <input type="number" name="stockQty" class="form-control" required>
                                            </div>
                                            <!--Min Quantity-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Min Qty</span>
                                                </div>
                                                <input type="number" name="stockMinQty" class="form-control" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Modal "Add Stock item"-->

                    <!--Start of Modal "Delete Stock Item"-->
                    <div class="modal fade" id="deleteStock" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Stock Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="confirmDelete">
                                    <div class="modal-body">
                                        <h6 id="deleteTableCode"></h6>
                                        <p>Are you sure you want to delete this stock item?</p>
                                        <input type="text" name="" hidden="hidden">
                                        <div>
                                            Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks"
                                                class="form-control form-control-sm">
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

<!--   Core JS Files   -->
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
var lastIndex = 0;
var crudUrl = '<?= site_url("admin/inventory/addEdit")?>';
var enumValsUrl = '<?= site_url('admin/inventory/getEnumVals')?>';
var getStockUrl = '<?= site_url('admin/inventory/getStockItem')?>';
var restockUrl = '<?= site_url('admin/inventory/restock')?>';
var getStockBrochure = '<?= site_url('admin/inventory/getStockItems')?>';
var loginUrl = '<?= site_url('login')?>';
$(document).ready(function() {
     createPagination(0);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum2 = $(this).attr('data-ci-pagination-page');
        createPagination(pageNum2);
	});
	function createPagination(pageNum2){
		$.ajax({
			url: '<?=base_url()?>admin/stocks/loadDataStocks/'+pageNum2,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $('#pagination').html(data.pagination);
                stocks = data.invstocks;
                setStocksData(stocks);
                console.log('Stock:',stocks);
			},
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});
    }
});
    
    function setStocksData(data) {
		$("table#stockTable > tbody").empty();
        for(stk in data){
            var row1 = ` <tr class="stockTable ic-level-1" data-id="`+data[stk].stID+`">`;
                row1 += ` <td>`+data[stk].stName+`</td>`;
                row1 += `<td>`+data[stk].ctName+`</td>`;
                row1 += `<td>`+data[stk].stQty+`</td>`;
                row1 += `<td>`+data[stk].stMin+`</td>`;
                row1 += `<td>`+data[stk].uomAbbreviation+`</td>`;
                row1 += `<td>`+data[stk].stStatus+`</td>`;
                row1 += `<td>`+data[stk].stLocation+`</td>`;
                row1 += `<td>
                <button class="editBtn btn btn-default btn-sm" data-toggle="modal" data-target="#addEditStock">Edit</button>
                <button class="btn btn-warning btn-sm">Archived</button>
                <a href="<?= site_url()?>admin/inventory/stockcard/`+data[stk].stID+`" class="btn btn-success btn-sm">Stock Card</a>
                </td></tr>`;
            $("table#stockTable  tbody").append(row1);
        }
        $(".editBtn").on("click", function() {
        getEnumVals(enumValsUrl);
        var id = $(this).closest("tr").attr("data-id");
        console.log(id, getStockUrl);
        populateModalForm(id, getStockUrl);
    });

    }
    $("#addBtn").on('click', function() {
        $("#addEditStock form")[0].reset();
        getEnumVals(enumValsUrl);
        $("#addEditStock").find("input[name='stockQty']").removeAttr("readonly");
    });
    $("#rBtn").on("click",function(){
        $.ajax({
            method: "POST",
            url: getStockBrochure,
            dataType: "JSON",
            success: function(data){
                var selectItems = [];
                $("#restock").find(".ic-level-2").empty();
                $("#stockBrochure").find(".ic-level-2").empty();
                $("#stockBrochure").find(".ic-level-2").append(data.map(item => {
                    return `<label style="width:96%">
                <input name="stock" type="checkbox" class="mr-2" value="${item.stID}">${item.stName} - ${item.stQty} ${item.uomAbbreviation}</label>`;
                }).join(''));
                $("#stockBrochure form").on('submit',function(event){
                    event.preventDefault();
                    $(this).find("input[name='stock']:checked").each(function(index,element){
                        selectItems.push(element.value);
                    });
                    $("#stockBrochure").modal('hide');
                    $(this)[0].reset();
                    $("#restock").find(".ic-level-2").append(data.filter(stock => selectItems.includes(stock.stID)).map(stock=>{
                        return `
                            <tr data-id="${stock.stID}" class="ic-level-1">
                                <td>${stock.stName}</td>
                                <td>${stock.stQty}</td>
                                <td>${stock.uomAbbreviation}</td>
                                <td><input type="number" name="restockQty[]"
                                        class="form-control form-control-sm"></td>
                                <td><img class="exitBtn" src="/assets/media/admin/error.png"
                                    style="width:20px;height:20px"></td>
                            </tr>`;
                    }).join(''));
                });
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            }
        });
    });
    $("#begBtn").on('click',function(){
        var stocks = setBrochureForBeginning();
        var items = [];
        $("#beginning form").on("submit",function(event){
            event.preventDefault();
            $(this).find(".ic-level-1").each(function(index){
                items.push({
                    stock: $(this).attr("data-id"),
                    qty: $(this).find("input[name='actual']").val(),
                    remarks: $(this).find("textarea[name='remarks']").val()
                });
            });
            $.ajax({
                method: 'POST',
                url: '<?= site_url('admin/stocklog/ending/add')?>',
                data: {
                    items: JSON.stringify(items)
                },
                dataType: 'JSON',
                success: function(data){
                    if(data.sessErr){
                        location.replace('login');
                    }else{
                        console.log(data);
                    }
                },
                error: function(response, setting, error) {
                    console.log(response.responseText);
                    console.log(error);
                }
            });
            $("#beginning").modal("hide");
        });
        $("#beginning").on("hidden.bs.modal",function(){
            $("#BeginningBrochure").find("ic-level-2").empty();
            $("#beginning form").find(".ic-level-2").empty();
            $("#beginning form").off("submit");
        });
    });
    $("#restock form").on("submit",function(event){
        event.preventDefault();
        var stockQtys = [];
        for(var x = 0 ;x<$(this).find(".ic-level-1").length;x++){
            console.log($(this).find(".ic-level-1").eq(x));
            stockQtys.push({
                id: $(this).find(".ic-level-1").eq(x).attr("data-id"),
                qty: $(this).find(".ic-level-1").eq(x).find("input[name='restockQty[]']").val()
            });
        }
        $.ajax({
            method: "POST",
            url: restockUrl,
            data: {
                rsQtys: JSON.stringify(stockQtys)
            },
            dataType: "JSON",
            beforeSend: function(){
                console.log(stockQtys);
            },
            success: function(data){
                if(data.sessErr){
                    location.replace(loginUrl);
                }else{
                    console.log(data);
                    location.reload();
                }
            }
        });
    });
    // setTableData();
    $("#addEditStock form").on('submit', function(event) {
        event.preventDefault();
        var id = $(this).find("input[name='stockID']").val();
        id = isNaN(parseInt(id)) ? (undefined) :  parseInt(id);
        var name = $(this).find("input[name='stockName']").val();
        var type = $(this).find("select[name='stockType']").val();
        var category = $(this).find("select[name='stockCategory']").val();
        var status = $(this).find("select[name='stockStatus']").val();
        var storage = $(this).find("select[name='stockStorage']").val();
        var min = $(this).find("input[name='stockMinQty']").val();
        var qty = $(this).find("input[name='stockQty']").val();
        var uom = $(this).find("select[name='stockUOM']").val();
        var size = $(this).find("input[name='stockSize']").val().concat($(this).find("select[name='stockSizeUOM']").val());
       
        $.ajax({
            url: crudUrl,
            method: "POST",
            data: {
                id: id,
                name: name,
                type: type,
                category: category,
                status: status,
                storage: storage,
                min: min,
                qty: qty,
                uom: uom,
                size: size
            },
            dataType: "JSON",
            beforeSend: function() {
                console.log("Name: ", name, " Type: ", type, " Category: ", category, " Status: ", status, " Storage: ", storage, " Min: ", min, " QTY: ", qty, " UOM: ", uom, " Size: ", size, "");
            },
            success: function(data) {
                if(data.sessErr){
                    location.replace(loginUrl);
                }else{
                    console.log(data);
                    location.reload();
                }
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            },
            complete: function() {
                $("#addEditStock").modal("hide");
            }
        });
    });

function getEnumVals(url){
    $.ajax({
        method: 'POST',
        url: url,
        dataType: 'JSON',
        success: function(data){
            console.log(data);
            $("#addEditStock").find("select[name='stockType']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockStatus']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockStorage']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockSizeUOM']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockUOM']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockCategory']").children().first().siblings().remove();
            $("#addEditStock").find("select[name='stockType']").append(data.stTypes.map(type=>{
                return `<option value="${type}">${type.toUpperCase()}</option>`; 
            }).join(''));
            $("#addEditStock").find("select[name='stockStatus']").append(data.stStatuses.map(status=>{
                return `<option value="${status}">${status.toUpperCase()}</option>`;
            }).join(''));
            $("#addEditStock").find("select[name='stockStorage']").append(data.stLocations.map(storage=>{
                return `<option value="${storage}">${storage.toUpperCase()}</option>`;
            }).join(''));
            $("#addEditStock").find("select[name='stockSizeUOM']").append(data.uomVariants.map(variant=>{
                return `<option value="${variant.uomAbbreviation}" data-type="${variant.uomVariant}">${variant.uomName} - ${variant.uomAbbreviation}</option>`;
            }).join(''));
            $("#addEditStock").find("select[name='stockSizeUOM'] option").hide();
            $("#addEditStock").find("select[name='stockType']").on('change',function(){
                $("#addEditStock").find("select[name='stockSizeUOM'] option").hide();
            });
            $("#addEditStock").find("select[name='stockSizeUOM']").on('focus',function(){
                $("#addEditStock").find(`select[name='stockSizeUOM'] option[data-type="${$("#addEditStock").find("select[name='stockType']").val().toUpperCase()}"]`).show();
            });
            $("#addEditStock").find("select[name='stockUOM']").append(data.uomStores.map(unit=>{
                return `<option value="${unit.uomID}">${unit.uomName} - ${unit.uomAbbreviation}</option>`;
            }).join(''));
            $("#addEditStock").find("select[name='stockCategory']").append(data.categories.map(category=>{
                return `<option value="${category.ctID}">${category.ctName.toUpperCase()}</option>`;
            }).join(''));
            
        },
        error: function(response, setting, error) {
            console.log(response.responseText);
            console.log(error);
        }
    });
}

function populateModalForm(id, url){
    var matches;
    $("#addEditStock form")[0].reset();
    $.ajax({
        method: 'POST',
        url: url,
        data: {
            id: id
        },
        dataType: 'JSON',
        success: function(data){
            matches = data.stock.stSize.match(/\d+|\w+/g);
            $("#addEditStock").find("input[name='stockID']").val(data.stock.stID);
            $("#addEditStock").find("input[name='stockName']").val(data.stock.stName);
            $("#addEditStock").find("select[name='stockType']").find(`option[value="${data.stock.stType.toLowerCase()}"]`).attr("selected","selected");
            $("#addEditStock").find("select[name='stockCategory']").find(`option[value=${data.stock.ctID}]`).attr("selected","selected");
            $("#addEditStock").find("select[name='stockStatus']").find(`option[value="${data.stock.stStatus.toLowerCase()}"]`).attr("selected","selected");
            $("#addEditStock").find("select[name='stockStorage']").find(`option[value="${data.stock.stLocation.toLowerCase()}"]`).attr("selected","selected");
            $("#addEditStock").find("input[name='stockMinQty']").val(data.stock.stMin);
            $("#addEditStock").find("input[name='stockQty']").val(data.stock.stQty);
            $("#addEditStock").find("input[name='stockQty']").attr("readonly","readonly");
            $("#addEditStock").find("select[name='stockUOM']").find(`option[value=${data.stock.uomID}]`).attr("selected","selected");
            if(data.uomVariants.findIndex(variant => variant.uomAbbreviation === matches[matches.length-1]) !== -1){
                $("#addEditStock").find("select[name='stockSizeUOM']").find(`option[value="${matches.pop().toLowerCase()}"]`).attr("selected","selected");
            }
            $("#addEditStock").find("input[name='stockSize']").val(matches.join(' '));
        },
        error: function(response, setting, error) {
            console.log(response.responseText);
            console.log(error);
        }
    });
}
function setBrochureForBeginning(){
    var stocks = [];
    $.ajax({
        method: "POST",
        url: '<?= site_url('admin/inventory/getStocksForBeginningBrochure')?>',
        dataType: "JSON",
        success: function(data){
            stocks = data.stocks;
            $("#BeginningBrochure").find(".ic-level-2").append(stocks.map(stock =>{
                return `<tr class="ic-level-1" style="border-bottom:1px solid #d9d9d9">
                            <td><input type="checkbox" name="stID" value="${stock.stID}"></td>
                            <td>${stock.stName}</td>
                            <td>${stock.ctName}</td>
                            <td>${stock.stQty}</td>
                            <td>${stock.uomAbbreviation}
                        </tr>`;
            }).join(''));
            $("#BeginningBrochure").on("hidden.bs.modal",function(){
                $("#BeginningBrochure form")[0].reset();
            });
            $("#BeginningBrochure form").on("submit",function(event){
                event.preventDefault();
                $(this).find("input[name='stID']:checked").each(function(index){
                    var item = stocks.filter(stock => stock.stID == $(this).val())[0];
                    $("#beginning").find(".ic-level-2").append(`
                        <tr class="ic-level-1" data-id="${item.stID}">
                            <td><input type="text" name="name" value="${item.stName}" class="form-control form-control-sm" readonly="readonly"></td>
                            <td><input type="number" name="current" value="${item.stQty}" class="form-control form-control-sm"  readonly="readonly"></td>
                            <td><input type="number" name="actual" value='0' class="form-control form-control-sm"></td>
                            <td><input type="number" name="discrep" class="form-control form-control-sm"  readonly="readonly"></td>
                            <td><textarea type="text" name="remarks" class="form-control form-control-sm" rows="1"></textarea></td>
                            <td><img class="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
                        </tr>`);
                });
                $("#beginning").find("input[name='actual']").on("change",function(){
                    var discrep = $(this).val()- $(this).closest(".ic-level-1").find("input[name='current']").val();
                    $(this).closest(".ic-level-1").find("input[name='discrep']").val(discrep);
                });
                $("#beginning").find("input[name='discrep']").on("change",function(){
                    $(this).closest(".ic-level-1").find("input[name='actual']").trigger("click");
                });
                $(this).find(".extBtn").on("click",function(){
                    $(this).closest(".ic-level-1").remove();
                });
                $("#BeginningBrochure").modal("hide");
            });
            return stocks;
        },
        error: function(response, setting, error) {
            console.log(response.responseText);
            console.log(error);
        }
    });
}

//Search Function
//Search Function
$("#stockTable input[name='search']").on("keyup", function() {
    var string = $(this).val().toLowerCase();

    $("#stockTable .ic-level-1").each(function(index) {
        var text = $(this).text().toLowerCase().replace(/(\r\n|\n|\r)/gm, ' ');
        if (!text.includes(string)) {
            $(this).closest("tr").hide();
        } else {
            $(this).closest("tr").show();
        }
    });

});
</script>
</body>
