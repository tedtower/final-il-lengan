<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
</head>

<body>
    <?php include_once('templates/sideNav.php') ?>
    <!--End Side Bar-->

    <!--Start of Container-->
    <div class="content">
        <div class="container-fluid"><br>
            <p style="text-align:right; font-weight: regular; font-size: 16px">
                <?php echo date("M j, Y -l"); ?>
                <!-- Real Time Date & Time -->
            </p>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="card-content">

                                <!--Add button-->
                                <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#addPO"
                                    data-original-title style="margin:0" id="addPOBtn">Add Purchase Order</a>
                                <br>
                                <br>
                                <!--Start of Table-->
                                <table id="poTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:10px"></th>
                                            <th><b class="pull-left">PO No.</b></th>
                                            <th><b class="pull-left">Supplier</b></th>
                                            <th><b class="pull-left">Purchased Date</b></th>
                                            <th><b class="pull-left">Expected Date</b></th>
                                            <th><b class="pull-left">Status</b></th>
                                            <th><b class="pull-left">Total</b></th>
                                            <th><b class="pull-left">Actions</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr>
                                            <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width:15px"/></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button class="editBtn btn btn-primary btn-sm" data-toggle="modal" data-target="#editPO">Edit</button>
                                                <button class="deleteBtn btn btn-danger btn-sm" data-toggle="modal" data-target="#delete">Delete</button>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="8">
                                                <div style="margin:1% 3%">
                                                    <table class="table dt-responsive nowrap">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Item Name</th>
                                                                <th>Unit</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                                <!--End of Table Content-->


                                <!--Start of Modal "Add Purchase Order"-->
                                <div class="modal fade bd-example-modal-lg" id="addPO" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Purchase Order</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--Modal Content-->
                                            <form id="formAdd" action="<?= site_url('admin/purchaseorder/add')?>"
                                                method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Container of Source. and Purchase date-->
                                                        <!--Source-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Supplier</span>
                                                            </div>
                                                            <select class="form-control form-control-sm"
                                                                name="poSupplier" id="poSupplier">
                                                                <option value="" selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Purchase date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Purchase Date</span>
                                                            </div>
                                                            <input type="date" name="poDate" id="poDate"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <!--Container of receipt no. and transaction date-->
                                                        <!--Status-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Status</span>
                                                            </div>
                                                            <select class="form-control form-control-sm" name="status"
                                                                id="status">
                                                                <option selected="selected">Choose</option>
                                                                <option value="pending">Pending</option>
                                                                <option value="delivered">Delivered</option>
                                                            </select>
                                                        </div>
                                                        <!--Delivery date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Delivery Date</span>
                                                            </div>
                                                            <input type="date" name="edDate" id="edDate"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <!--Remarks-->
                                                    <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Remarks</span>
                                                            </div>
                                                            <textarea class="form-control form-control-sm"></textarea>
                                                        </div>
                                                    <!--Button to add row in the table-->
                                                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#brochure" data-original-title style="margin:0" id="addTransaction">Add Items</a>
                                                    <br><br>
                                                    <!--Table containing the different input fields in adding PO items -->
                                                    <table class="poItemsTable table table-sm table-borderless">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Item Name</th>
                                                                <th width="15%">Unit</th>
                                                                <th width="10%">Qty</th>
                                                                <th width="15%">Price</th>
                                                                <th width="15%">Subtotal</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <input type="hidden" name="">
                                                                <td><input type="text" name="itemName"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemQty"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="text" name="itemUnit"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemPrice"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemSubtotal"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><img class="exitBtn" id="exitBtn"
                                                                        src="/assets/media/admin/error.png"
                                                                        style="width:20px;height:20px"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <!--Total of the trans items-->
                                                    <span>Total: &#8369;<span class="total"> 0</span></span>
                                                    <!--Modal Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm"
                                                            type="submit">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Add Purchase Order"-->

                                <!--Start of Modal "Add Purchase Order"-->
                                 <div class="modal fade bd-example-modal-lg" id="editPO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Purchase Order</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--Modal Content-->
                                            <form id="formAdd" action="<?= site_url('admin/purchaseorder/add')?>"
                                                method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Container of Source. and Purchase date-->
                                                        <!--Source-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Supplier</span>
                                                            </div>
                                                            <select class="form-control form-control-sm"
                                                                name="poSupplier" id="poSupplier">
                                                                <option value="" selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Purchase date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Purchase Date</span>
                                                            </div>
                                                            <input type="date" name="poDate" id="poDate"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <!--Container of receipt no. and transaction date-->
                                                        <!--Status-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:90px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Status</span>
                                                            </div>
                                                            <select class="form-control form-control-sm" name="status"
                                                                id="status">
                                                                <option selected="selected">Choose</option>
                                                                <option value="pending">Pending</option>
                                                                <option value="delivered">Delivered</option>
                                                            </select>
                                                        </div>
                                                        <!--Delivery date-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Delivery Date</span>
                                                            </div>
                                                            <input type="date" name="edDate" id="edDate"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <!--Remarks-->
                                                    <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="width:110px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Remarks</span>
                                                            </div>
                                                            <textarea class="form-control form-control-sm"></textarea>
                                                        </div>
                                                    <!--Button to add row in the table-->
                                                    <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#brochure" data-original-title style="margin:0" id="addTransaction">Add Items</a>
                                                    <br><br>
                                                    <!--Table containing the different input fields in adding PO items -->
                                                    <table class="poItemsTable table table-sm table-borderless">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Item Name</th>
                                                                <th width="15%">Unit</th>
                                                                <th width="10%">Qty</th>
                                                                <th width="15%">Price</th>
                                                                <th width="15%">Subtotal</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <input type="hidden" name="">
                                                                <td><input type="text" name="itemName"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemQty"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="text" name="itemUnit"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemPrice"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><input type="number" name="itemSubtotal"
                                                                        class="form-control form-control-sm"></td>
                                                                <td><img class="exitBtn" id="exitBtn"
                                                                        src="/assets/media/admin/error.png"
                                                                        style="width:20px;height:20px"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <!--Total of the trans items-->
                                                    <span>Total: &#8369;<span class="total"> 0</span></span>
                                                    <!--Modal Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm"
                                                            type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Edit Purchase Order"-->

                             <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal" id="brochure" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formAdd" action="<?= site_url('admin/transactions/add')?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div style="margin:1% 3%">
                                                    <!--checkboxes-->
                                                        <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample data 1</label>
                                                        <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample data 2</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
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
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Purchase Order</h5>
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
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
</body>
<script>
 var purOrders = [];
    $(function(){
        $.ajax({
            url: '/admin/jsonPOrders',
            dataType: 'json',
            success: function(data){
                var poLastIndex = 0;
                $.each(data.purOrders, function(index, item){
                    purOrders.push({"purOrders" : item});
                    purOrders[index].poItems = data.poItems.filter(po => po.poID == item.poID);
                });
                showTable();
            },
            failure: function(){
                console.log('None');
            },
            error: function(response,setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

    });
    function showTable(){
        purOrders.forEach(function(item){
            var tableRow = `                
                <tr class="table_row" data-menuId="${item.purOrders.poID}">   <!-- table row ng table -->
                    <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                    <td>${item.purOrders.poID}</td>
                    <td>${item.purOrders.spName}</td>
                    <td>${item.purOrders.poDate}</td>
                    <td>${item.purOrders.edDate}</td>
                    <td>${item.purOrders.poStatus}</td>
                    <td>${item.purOrders.poTotal}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-primary">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            `;

            var preferencesDiv = `
            <div class="preferences" style="width:45%;overflow:auto;float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.poItems.length === 0 ? "Not Applicable" : 
                `
                <span><b>Preferences:</b></span> <!-- label-->
                <table class="table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Stock Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.poItems.map(po => {
                        return `
                        <tr>
                            <td>${po.poItem}</td>
                            <td>&#8369; ${po.poiPrice}</td>
                            <td>${po.poiPrice}</td>
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
                <td colspan="5"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:68%;overflow:auto"> <!-- description, preferences, and addons container -->
                            
                            <div class="aoAndPreferences" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;
            $("#menuTable > tbody").append(tableRow);
            $("#menuTable > tbody").append(accordion);
            $(".aoAndPreferences").last().append(preferencesDiv);
        });
        $(".accordionBtn").on('click', function(){
            if($(this).closest("tr").next(".accordion").css("display") == 'none'){
                $(this).closest("tr").next(".accordion").css("display","table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            }else{
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });
        $(".editBtn").on("click",function(){
            var menuID = $(this).closest("tr").attr("data-menuID");
            //set Modal contents;

        });

    }  
</script> -->

</html>