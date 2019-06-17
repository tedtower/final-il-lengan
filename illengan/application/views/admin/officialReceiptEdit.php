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
                        <h6 style="font-size: 16px;margin-left:15px">Edit Official Receipt</h6>
                    </div>
                    <!--Card--> 
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
                                    <select class="spID form-control form-control-sm  border-left-0" name="spID">
                                        <option value="" selected>Choose</option>
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
                            style="margin:0;color:blue;font-weight:600;">Merchandise Item</a>
                        <a id="addPOBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#poBrochure"
                            style="color:blue;font-weight:600;">PO Item</a>
                        <a id="addDRBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#deliveryBrochure"
                            style="color:blue;font-weight:600;">DR Item</a>
                        <br><br>

                            <!--div containing the different input fields in adding trans items -->
                            <div class="ic-level-2">
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
                            </div>
                            <div class="mt-4"
                                style="float:left:width:3%;overflow:auto;">
                                <img class="exitBtn"
                                    src="/assets/media/admin/error.png"
                                    style="width:20px;height:20px;float:right;">
                            </div>
                            <br><br>
                            <span>Total: &#8369;<span class="total">0</span></span>
                            <!--Total of the trans items-->

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm"
                                    data-dismiss="modal">Cancel</button>
                                <button class="btn btn-success btn-sm"
                                    type="submit">Update</button>
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
                                    <div style="margin:1% 3%" id="list">
                                        <!--checkboxes-->
                                        <label style="width:96%"><input type="checkbox" class="mr-2"
                                                value="">Sample data 2</label>
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
</body>