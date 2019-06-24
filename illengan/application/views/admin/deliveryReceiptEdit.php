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
                    </div>
                    <!--Card Container-->
                    <div style="overflow:auto">
                        <!--Card-->
                        <div class="card" style="float:left;width:60%">
                            <div class="card-header">
                                <h6 style="font-size:15px;">Add Consumption</h6>
                            </div>
                            <form accept-charset="utf-8">
                                <div class="card-body">
                                <input type="text" name="tID" hidden="hidden">
                                    <!--Source Name-->
                                <div class="form-row">
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:80px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                Supplier</span>
                                        </div>
                                        <select class="spID form-control form-control-sm  border-left-0" name="spID" readonly="readonly">
                                            <option value="" selected>Choose</option>
                                        </select>
                                    </div>
                                    <!--Invoice Type-->
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:80px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                Date</span>
                                        </div>
                                        <input type="date" class="form-control  border-left-0"
                                            name="tDate">
                                    </div>
                                </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:80px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                Receipt</span>
                                        </div>
                                        <input type="text" name="receipt"
                                            class="form-control form-control-sm  border-left-0">
                                    </div>
                                    <!--Remarks-->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:80px;background:#bfbfbf;color:white;font-size:14px;font-weight:600">
                                                Remarks</span>
                                        </div>
                                        <textarea type="text" name="tRemarks"
                                            class="form-control form-control-sm  border-left-0"
                                            rows="1"></textarea>
                                    </div>
                            <a id="addNBtn" class="btn btn-primary btn-sm"
                                style="margin:0;color:blue;font-weight:600;">New Item</a>
                            <a id="addPOBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#poBrochure"  data-original-title
                                style="margin:0;color:blue;font-weight:600;">PO Item</a>
                            <a id="addMBtn" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#merchandiseBrochure"  data-original-title
                                style="margin:0;color:blue;font-weight:600;">Merchandise Item</a>
                            <br><br>

                            <!--div containing the different input fields in adding trans items -->
                            <div class="ic-level-2 mb-2" style="overflow:auto">
                                <div style="float:left;overflow:auto;">
                                    <div class="input-group mb-1">
                                        <input type="text" name="itemName[]"
                                            class="form-control form-control-sm"
                                            placeholder="Item Name" style="width:40%" readonly="readonly">
                                            <input name="stID[]" type="text"
                                            class="form-control"
                                            placeholder="Stock" style="width:190px" readonly="readonly">
                                        <input name="actualQty[]" type="number"
                                            class="form-control"
                                            placeholder="Actual Qty" style="width:15%" readonly="readonly">
                                    </div>

                                    <div class="input-group">
                                    <input type="number" name="itemQty[]"
                                            class="form-control form-control-sm"
                                            placeholder="Quantity">
                                        <select name="itemUnit[]"
                                            class="form-control form-control-sm" readonly="readonly">
                                            <option value="" selected="selected">Unit
                                            </option>
                                        </select>
                                        <input type="number" name="itemPrice[]"
                                            class="form-control form-control-sm "
                                            placeholder="Price" >
                                        <input type="number" name="discount[]"
                                            class="form-control form-control-sm "
                                            placeholder="Discount">
                                        <input type="number" name="itemSubtotal[]"
                                            class="form-control form-control-sm"
                                            placeholder="Subtotal" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span>Total: &#8369;<span class="total">0</span></span>
                            </div>
                            <!--Total of the trans items-->
                            </div>
                                <div class="card-footer">
                                    <div>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="background:white;margin-left:0" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success btn-sm" style="background:white"
                                            type="submit">Insert</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>

                        <!--Merchandise-->
                        <div class="card" id="" style="float:left;width:37%;margin-left:3%">
                            <div class="card-header" style="overflow:auto">
                                <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Select
                                    Merchandise</div>
                                <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                    <input type="search"
                                        style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                        name="search" placeholder="Search...">
                                </div>
                            </div>
                            <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                <!--checkboxes-->
                                <table class="table table-borderless">
                                    <thead style="border-bottom:2px solid #cccccc">
                                        <tr>
                                            <th width="2%"></th>
                                            <th>Merchandise</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ic-level-2">
                                        <tr class="ic-level-1">
                                            <td><input type="checkbox" class="mr-2" name=""
                                                   data-name="" value=""></td>
                                            <td class=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--Card-->

                     <!--PO-->
                        <!-- <div class="card" id="" style="float:left;width:37%;margin-left:3%">
                            <div class="card-header" style="overflow:auto">
                                <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Select
                                    PO Items</div>
                                <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                    <input type="search"
                                        style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                        name="search" placeholder="Search...">
                                </div>
                            </div>
                            <div class="card-body" style="margin:1%;padding:1%;font-size:14px"> -->
                                <!--checkboxes-->
                                <!-- <div style="width:93%;margin:auto">
                                    <select name="" style="width:100%;padding:3px 7px;border-radius:5px">
                                        <option value="" selected="selected">Select PO</option>
                                    </select>
                                </div>
                                <table class="table table-borderless">
                                    <thead style="border-bottom:2px solid #cccccc">
                                        <tr>
                                            <th width="2%"></th>
                                            <th>Item Name</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ic-level-2">
                                        <tr class="ic-level-1">
                                            <td><input type="checkbox" class="mr-2" name=""
                                                   data-name="" value=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    <!--Card-->

                    
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