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
                <!--Table-->
                <div class="card-content">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSales" data-original-title
                        style="margin:0;" id="addBtn">Add Sales</button>
                    <br><br>
                    <table id="salesTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th><b class="pull-left">Slip No.</b></th>
                                <th><b class="pull-left">Table No.</b></th>
                                <th><b class="pull-left">Date</b></th>
                                <th><b class="pull-left">Total Sale</b></th>
                                <th><b class="pull-left">Actions</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                     <!--Start of Modal "Add Sales"-->
                    <div class="modal fade bd-example-modal-lg" id="addSales" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Sales</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!--Modal Content-->
                                <form id="formAdd" action="<?= site_url('admin/sales/add')?>" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <!--Pay date-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Order Paid Date</span>
                                                </div>
                                                <input type="date" name="osPayDateTime" id="osPayDateTime"
                                                    class="form-control form-control-sm" required>
                                            </div>

                                            <!--Order date-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Order Date</span>
                                                </div>
                                                <input type="date" name="osDateTime" id="osDateTime"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <!-- Customer Name -->
                                        <div class="form-row">
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Customer Name</span>
                                                </div>
                                                <input type="text" name="custName" id="custName"
                                                    class="form-control form-control-sm">
                                            </div>
                                        
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Senior Citizen Discount %</span>
                                                </div>
                                                <input type="number" name="seniorDC" id="seniorDC" onchange="setSubtotal()"
                                                    class="form-control form-control-sm">
                                            </div>

                                               <!-- Table Code -->
                                        <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Table Code</span>
                                                </div>
                                                <select class="form-control" name="tableCode" id="tableCode"></select>
                                            </div>
                                        </div>

                                        <!--Button to add row in the table-->
                                         <a id="addMenuItem" class="addMenuItem btn btn-default btn-sm" data-toggle="modal" data-target="#menuItems"
                                            data-original-title style="margin:0" id="">Add Items</a>
                                        <br><br>
                                        <!--Table containing the different input fields in adding PO items -->
                                        <table class="salesTable table table-sm table-borderless">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th width="10%">Qty</th>
                                                    <th width="15%">Price</th>
                                                    <th width="15%">Discount</th>
                                                    <th width="15%">Subtotal</th>
                                                    <th width="15%">Actions</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>

                                        <!--Total of the trans items-->
                                        <span>Total: &#8369;<span id="total" class="total"> </span></span>
                                        <!--Modal Footer-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" type="submit">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal "Add Sales" -->

                    <!--Start of Modal "Edit Sales"-->
                    <div class="modal fade bd-example-modal-lg" id="editSales" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Sales</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!--Modal Content-->
                                <form id="formEdit" action="<?= site_url('admin/sales/edit')?>" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <!--Pay date-->
                                            <input type="hidden" name="osID" id="osID" value="">
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Order Paid Date</span>
                                                </div>
                                                <input type="datetime-local" name="osPayDateTime" id="osPayDateTime"
                                                    class="form-control form-control-sm" required>
                                            </div>

                                            <!--Order date-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Order Date</span>
                                                </div>
                                                <input type="datetime-local" name="osDateTime" id="osDateTime"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <!-- Customer Name -->
                                        <div class="form-row">
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Customer Name</span>
                                                </div>
                                                <input type="text" name="custName" id="custName"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Senior Citizen Discount %</span>
                                                </div>
                                                <input type="number" name="seniorDC" id="seniorDC" onchange="setSubtotal()"
                                                    class="form-control form-control-sm">
                                            </div>
                                               <!-- Table Code -->
                                        <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Table Code</span>
                                                </div>
                                                <select class="form-control" name="tableCodes" id="tableCodes" required></select>
                                            </div>
                                        </div>

                                        <!--Button to add row in the table-->
                                        <a id="addMenuItem" class="addMenuItem btn btn-default btn-sm" data-toggle="modal" data-target="#menuItems"
                                            data-original-title style="margin:0" id="">Add Items</a>
                                        <br><br>
                                        <!--Table containing the different input fields in adding PO items -->
                                        <table class="editsalesTable table table-sm table-borderless">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th width="10%">Qty</th>
                                                    <th width="15%">Price</th>
                                                    <th width="15%">Discount</th>
                                                    <th width="15%">Subtotal</th>
                                                    <th width="15%">Actions</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>

                                        <!--Total of the trans items-->
                                        <span>Total: &#8369;<span id="total1" class="total1"> </span></span>
                                        <!--Modal Footer-->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END OF EDIT SALES MODAL -->
                    
                     <!--Start of Menu Items Modal"-->
                     <div class="modal fade bd-example-modal" id="menuItems" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Menu Items</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="menuItemsForm" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div style="margin:1% 3%" id="list">
                                            <!--checkboxes-->
                                            <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample
                                                data 2</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="getSelectedMenu();">Ok</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <!--End of Menu Items Modal"-->
                    
                    <!--Start of Modal "Delete Stock Item"-->
                    <div class="modal fade" id="deleteStock" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Sales</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url() ?>admin/sales/add" method="get" accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <!--Table Number-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Table No.</span>
                                                </div>
                                                <input type="text" name="tableNum" id="tableNum" class="form-control form-control-sm" required>
                                            </div>
                                            <!--Date-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Date</span>
                                                </div>
                                                <input type="number" name="date" id="date" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <!--Item-->
                                        <a class="addItem btn btn-primary btn-sm" style="color:blue;margin:0">Add Item</a>
                                        <!--Button to add row in the table-->
                                        <br><br>
                                        <table class="merchandisetable table table-sm table-borderless">
                                            <!--Table containing the different input fields in adding sales items -->
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Menu Name</th>
                                                    <th style="width:15%">Price</th>
                                                    <th style="width:15%">Qty</th>
                                                    <th style="width:35%">Sub Total</th>
                                                    <th style="width:4%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End of Add Modal-->

                <!--Start of Modal "Delete Stock Item"-->
                <div class="modal fade" id="deleteStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                    <p>Are you sure you want to delete this item?</p>
                                    <input type="text" name="" hidden="hidden">
                                    <div>
                                        Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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



<?php include_once('templates/scripts.php') ?>
<script src="<?= admin_js().'addSales.js'?>"></script>
<script>
var orders = [];
var orderlists = [];
var orderslips = [];
var menuItems = [];
var tables = [];
var discounts = <?= json_encode($discounts) ?>;
var addons = [];
var mnaddons = <?= json_encode($mnaddons) ?>;
var sales = [];
     $(function () {
        $.ajax({
            url: '/admin/jsonSales',
            dataType: 'json',
            success: function (data) {
                var poLastIndex = 0;
                $.each(data.orderlists, function (index, items) {
                    orderlists.push({
                        "orderlists": items
                    });
                    orderlists[index].addons = data.addons.filter(ao => ao.olID == items.olID);
                   
                });
                $.each(data.orderslips, function (index, item) {
                    orderslips.push({
                        "orderslips": item
                    });
                    orderslips[index].orders = orderlists.filter(ol => ol.orderlists.osID == item.osID);
                });
                sales = data;
                menuItems = data.menuitems;
                tables = data.tables;
                addons = data.addons;
                showTable();
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        $(".addMenuItem").on('click',function(){
            setBrochureContent(menuItems);
        });
        
    });
    function setBrochureContent(menuitems){
        $("#list").empty();
        $("#list").append(`${menuitems.map(menu => {
            return `<label style="width:96%"><input type="checkbox" id="prID${menu.prID}" name="menuitems[]" class="orderitems mr-2" 
            value="${menu.prID}"> ${menu.prName} - ${parseFloat(menu.prPrice).toFixed(2)}</label>`
        }).join('')}`);
        disableSelected();
    }

    function disableSelected() {
        if($('.salesElem') != 0 || $('.salesElem') != null) {
            var addedItems = $('.salesElem').find('#prID');
        for(var i = 0; i <= addedItems.length-1; i++) {
           var id = addedItems[i].value;
           $('#prID'+id).attr("disabled","disabled");
        }
        }
    }
    
    $('#addBtn').on('click', function() {
        $('#dcpercent').remove();
        $("#editSales form")[0].reset();
        $(".editsalesTable > tbody").empty();
        $('.salesTable > tbody').empty();
        $('#addSales form')[0].reset();
        $('#total').empty();
        $('#tableCode').empty();
        $("#tableCode").append(`${tables.map(tab => {
            return `<option value="${tab.tableCode}">${tab.tableCode}</option>`;
        }).join('')}`);
        subPrice = 0;

    });
    
    function showTable() {
       orderslips.forEach(function (item) {
            var tableRow = `
                <tr class="table_row" data-id="${item.orderslips.osID}">   <!-- table row ng table -->
                    <td><a href="javascript:void(0)" class="ml-2 mr-4">
                    <img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>
                    ${item.orderslips.osID}</td>                    
                    <td>${item.orderslips.tableCode}</td>
                    <td>${item.orderslips.osPayDateTime}</td>
                    <td>&#8369; ${(parseFloat(item.orderslips.osTotal)).toFixed(2)}</td>
                    <td>
                    <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal" data-target="#editSales" id="editSalesBtn">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#delete">Archive</button>
                    </td>
                </tr>
            `;
            var ordersDiv = `
            <div class="preferences" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.orders[0].orderlists.length === 0 ? "No orders" : 
                `<caption><b>Orders</b></caption>
                <br>
                <table id="orderitem" class=" table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                        <th></th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Subtotal Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.orders.map(ol => {
                        return `
                        <tr id="${ol.orderlists.olID}">
                            <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                            <td>${ol.orderlists.mName} ${ol.orderlists.prName === 'Normal' ? " " : ol.orderlists.prName }</td>
                            <td>${ol.orderlists.olQty}</td>
                            <td>&#8369; ${ol.orderlists.prPrice}</td>
                            <td>&#8369; ${(parseFloat(ol.orderlists.olSubtotal)).toFixed(2)}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;
            var accordion = `
            <tr class="accordion" style="display:none">
                <td colspan="6"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;padding-left: 5%"> <!-- description, preferences, and addons container -->
                            
                            <div class="poAccordionContent" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;
        
            $("#salesTable > tbody").append(tableRow);
            $("#salesTable > tbody").append(accordion);
            $(".poAccordionContent").last().append(ordersDiv);
            
        });
        $(".accordionBtn").on('click', function () {
            if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
                $(this).closest("tr").next(".accordion").css("display", "table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            } else {
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });

        $(".editBtn").on("click", function() {
        $('#dcpercent').remove();
        $('.salesTable > tbody').empty();
        $('#addSales form')[0].reset();
        $("#editSales form")[0].reset();
        $(".editsalesTable > tbody").empty();
        $('#tableCodes').empty();
        $("#tableCodes").append(`${tables.map(tab => {
            return `<option value="${tab.tableCode}">${tab.tableCode}</option>`;
        }).join('')}`);
        subPrice = 0;
        var osID = $(this).closest("tr").attr("data-id");
        setEditModal($("#editSales"), sales.orderslips.filter(item => item.osID === osID)[0], 
        sales.orderlists.filter(ol => ol.osID === osID), addons);
    });
    showAddOns();
    }

 function showAddOns() {
    for(var i = 0; i <= addons.length-1; i++) {
     var addonsTr = '<tr><td>Add On</td>'+
     '<td>'+addons[i].aoName+'</td>'+
     '<td>'+addons[i].aoQty+'</td>'+
     '<td>'+addons[i].aoPrice+'</td>'+
     '<td>'+addons[i].aoTotal+'</td></tr>';
     
     $('#'+addons[i].olID).after(addonsTr);
    }
 }

 function setEditModal(modal, saleslist, ol, addons) {
    var olAddons = [];
    var options = [];
   
    // Conversion of Date to Datetime-local format
    var osDateTime = new Date(saleslist.osDateTime);
    var osPayDateTime = new Date(saleslist.osPayDateTime);
    var stringDT = osDateTime.toISOString();
    var stringPDT = osPayDateTime.toISOString();
    osDateTime = stringDT.substr(0, stringDT.length-1);
    osPayDateTime = stringPDT.substr(0, stringPDT.length-1);
    
    // Setting values for inputs
    modal.find("input[name='osID']").val(saleslist.osID);
    modal.find("input[name='osPayDateTime']").val(osPayDateTime);
    modal.find("input[name='osDateTime']").val(osDateTime);
    modal.find("input[name='custName']").val(saleslist.custName);
    modal.find("input[name='seniorDC']").val(saleslist.osDiscount);
    modal.find("select[name='tableCodes']").find(`option[value=${saleslist.tableCode}]`).attr("selected","selected");

    ol.forEach(ol => {
        modal.find(".editsalesTable > tbody").append(`
        <tr class="salesElem salesElements" data-id="${ol.olID}">
            <input type="hidden" name="prID" id="prID" value="${ol.prID}">
            <input type="hidden" name="osID" id="osID" value="${ol.osID}">
            <input type="hidden" class="mID" id="mID" name="mID" value="${ol.mID}">
                <td><input type="text" id="olDesc" name="olDesc"
                  class="olDesc form-control form-control-sm" value="${ol.olDesc}" readonly="readonly"></td>
                <td><input type="number" id="olQty" onchange="setSubtotal()" name="olQty"
                  class="olQty form-control form-control-sm" value="${ol.olQty}" required min="1"></td>
                <td><input type="number" id="prPrice" name="prPrice" data-orPrice="${ol.prPrice}"
                  class="prPrice form-control form-control-sm" onchange="setSubtotal()" value="${ol.olPrice}" ></td>
                <td> <select onchange="setSubtotal()" class="discount form-control" style="font-size: 14px;" 
                onchange="" name="discount" id="discount${ol.prID}"></select></td> 
                <td><input type="number" name="subtotal" class="subtotal form-control form-control-sm" value="${ol.olSubtotal}" readonly="readonly"></td>
                <td><a class="addAddons btn btn-default btn-sm" style="margin:0;" onclick="addAddons(this);" id="addAddons">Add Addons</a></td>
                </td><td><img class="delBtn" onclick="deleteItem(this)" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
          </tr>
        `);
        mID = ol.mID;
        olAddons = addons.filter(ao => ao.olID == ol.olID);
        var prID = ol.prID;
        olAddons.forEach(oa => {
            modal.find(".editsalesTable > tbody").last('tr').append(`
            <tr class="addonsTable addonsTables" data-id="${oa.olID}">
            <input type="hidden" name="aoprID" id="aoprID" value="${prID}">
            <input type="hidden" name="oldaoID" id="oldaoID" value="${oa.aoID}">
            <td>
                    <select id="ao${oa.olID}${oa.aoID}" class="addonsSelect form-control" style="font-size: 14px;" 
                    onchange="onchangeAddon(this)" name="aoID" id="addon" required></select>
            </td>
            <td>
                <input type="number" name="aoQty" id="aoQty" onchange="onchangeAddonQuantity(this);" value="${oa.aoQty}" class="aoQty form-control form-control-sm" required min="1">
            </td>
            <td>
                <input type="number" name="aoPrice" id="aoPrice" value="${oa.aoPrice}" class="aoPrice form-control form-control-sm" readonly>
            </td>
            <td style="text-align:center"> <b> --- </b></td>
            <td>
                <input type="number" name="aoSubtotal" id="aoSubtotal" value="${oa.aoTotal}" class="aoSubtotal form-control form-control-sm" readonly>
            </td>
            <td style="text-align:center"> <b> --- </b></td>
            <td><img class="delBtn" src="/assets/media/admin/error.png" onclick="deleteItem(this)" style="width:20px;height:20px"></td>
        </tr>`);
            setAddonOptions(modal, mID, oa.olID, oa.aoID);

        });
        setDiscount();
        modal.find("select[name='discount']").find(`option[value=${ol.olDiscount}]`).attr("selected","selected");

    });
   
    if(olAddons.length > 0) {
        setAddonTotal();
    }
    setSubtotal();
  
}
function setAddonOptions(modal, mID, olID, aoID) {
    mnaddon = mnaddons.filter(item => item.mID === mID);
    console.log(mnaddon);
    mnaddon.forEach(ma => {
                modal.find("#ao"+olID+aoID).append(`
                <option value="${ma.aoID}">${ma.aoName}</option>`);
    });

    modal.find("select[id='ao"+olID+aoID+"']").find(`option[value=${aoID}]`).attr("selected","selected");

}

var input, aoPrice;
function onchangeAddon(select) {
    input = $(select);
    var aoID = $(select).val();
    
    try {
        var arr = mnaddons.filter(ao => ao.aoID === aoID);
        aoPrice = arr[0].aoPrice;
        $(select).closest('td').nextAll('td').find('#aoPrice')[0].value = aoPrice;

        setAddOnsSubtotal();
    } catch(error) {
        aoPrice = 0;
        $(select).closest('td').nextAll('td').find('#aoPrice')[0].value = 0;

        setAddOnsSubtotal();
    }
}
function setAddOnsSubtotal() {
        var aoQty = $(input).closest('td').next('td').find('#aoQty').val();
        var aoSubtotal = parseFloat(aoPrice * aoQty);
        $(input).closest('td').nextAll('td').find('#aoSubtotal')[0].value = aoSubtotal;
       
        setAddonTotal();
}
function onchangeAddonQuantity(quantity) {
    var aoQty = $(quantity).val();
    var aoPrice =  $(quantity).closest('td').nextAll('td').find('#aoPrice')[0].value;
    var aoSubtotal = parseFloat(aoPrice * aoQty);
    $(quantity).closest('td').nextAll('td').find('#aoSubtotal')[0].value = aoSubtotal;
    
    setAddonTotal();
   
}
function setDiscount() {
    
    for(var i = 0; i <= $('.discount').length - 1;i++) {
        var tr = $('.discount').eq(i).closest('tr');
        $(tr).find('select').empty();
        var prmID = $('.discount').eq(i).closest('tr').find('#prID').val();
        var discount = discounts.filter(item => item.prID === prmID);
        console.log(discount);
        if(parseInt(discount.length) === 0) {
            $(tr).find('select').append(`<option value="0" selected>None</option>`);
        } else {
            $(tr).find('select').append(`<option value="0" selected>None</option>`);
            discount.forEach(dc => {
            $(tr).find("#discount"+prmID).append(`
                <option value="${dc.dcAmount}">${dc.dcName}</option>`);
        });
        }
       
    }
}
// --------------------- Editing sales ---------------------------------
$(document).ready(function() {
    $("#editSales form").on('submit', function(event) {
        event.preventDefault();
        var osID = $(this).find("input[name='osID']").val();
        var osPayDateTime = $(this).find("input[name='osPayDateTime']").val();
        var osDateTime = $(this).find("input[name='osDateTime']").val();
        var osTotal = $(this).find("span[id='total1']").text();
        var custName = $(this).find("input[name='custName']").val();
        var osDiscount = $(this).find("input[name='seniorDC']").val();
        var tableCodes = $(this).find("select[name='tableCodes']").val();
       
        var ol = [];
        for (var index = 0; index < $(this).find(".salesElements").length; index++) {
            var row = $(this).find(".salesElements").eq(index);
            ol.push({
                olID:  isNaN(parseInt(row.attr('data-id'))) ?  (null) : parseInt(row.attr('data-id')),
                prID :  row.find("input[name='prID']").val(),
                osID:  osID,
                olDesc: row.find("input[name='olDesc']").val(),
                olQty: row.find("input[name='olQty']").val(),
                olSubtotal: row.find("input[name='subtotal']").val(),
                olStatus: 'served',
                olRemarks: ' ',
                olPrice: row.find("input[name='prPrice']").val(),
                olDiscount: parseFloat((row.find("select[name='discount']").val()).trim()),
                del: isNaN(parseInt(row.attr('data-delete'))) ?  (null) : parseInt(row.attr('data-delete'))
            });
        }

        var addons = [];
        for (var index = 0; index < $(this).find(".addonsTables").length; index++) {
            var row = $(this).find(".addonsTables").eq(index);
            addons.push({
                prID: row.find("input[name='aoprID']").val(),
                olID:  isNaN(parseInt(row.attr('data-id'))) ?  (null) : parseInt(row.attr('data-id')),
                oldaoID: isNaN(parseInt(row.find("input[name='oldaoID']").val())) ?  (null): parseInt(row.find("input[name='oldaoID']").val()),
                aoID :  parseInt((row.find("select[name='aoID']").val()).trim()),
                aoQty: row.find("input[name='aoQty']").val(),
                aoTotal: row.find("input[name='aoSubtotal']").val(),
                del: isNaN(parseInt(row.attr('data-delete'))) ?  (null) : parseInt(row.attr('data-delete'))
            });
        }

        $.ajax({
            url: "<?= site_url("admin/sales/edit")?>",
            method: "post",
            data: {
                osID: parseInt(osID),
                osPayDateTime: osPayDateTime,
                osDateTime: osDateTime,
                custName: custName,
                osTotal: parseInt(osTotal),
                payStatus: 'paid',
                tableCodes: (tableCodes).trim(),
                orderlists: JSON.stringify(ol),
                addons: JSON.stringify(addons)
            },
            success: function() {
                alert('Sales Updated');
                //location.reload();
            },
            error: function (response, setting, errorThrown) {
                //alert("There are add on duplicates on an item");
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
    });
});


    
</script>
