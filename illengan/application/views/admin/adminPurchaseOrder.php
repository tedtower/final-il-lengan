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
                                    id="addBtn">Add Purchase Order</button>
                                <br>
                                <br>
                                <table id="transTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead class="thead-dark">
                                        <th><b class="pull-left">Transtaction #</b></th>
                                        <th><b class="pull-left">Supplier</b></th>
                                        <th><b class="pull-left">Date</b></th>
                                        <th><b class="pull-left">Total</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="javascript:void(0)" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal" data-target="#editPO" >Edit</button>
                                                <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#deletePO">Archive</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <div>Date Recorded:</div>
                                                <div>Remarks:</div>

                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Qty</th>
                                                            <th>UOM</th>
                                                            <th>Price</th>
                                                            <th>Subtotal</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </td>
                                        </tr>
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
  
    </script>
    </body>