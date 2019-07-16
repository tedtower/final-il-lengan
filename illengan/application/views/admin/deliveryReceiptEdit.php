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
                        <!--Card-->
                        <div style="overflow:auto">
                            <div class="card" style="float:left;width:100%">
                                <div class="card-header">
                                    <h6 style="font-size:15px;margin:0">Add Delivery</h6>
                                </div>
                                <form id="drForm" action="<?= site_url("admin/deliveryreceipt/add")?>"
                                    accept-charset="utf-8" class="form">
                                    <div class="card-body">
                                        <input type="text" name="tID" hidden="hidden">
                                        <div class="form-row">
                                            <!--Supplier-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Supplier</span>
                                                </div>
                                                <select class="spID form-control status-level" name="supplier" id="supplier" data-level="2,3" required>
                                                    <option value="" selected>Choose</option>
                                                    <?php if(isset($supplier)){
                                                foreach($supplier as $sup){?>
                                                    <option value="<?= $sup['spID']?>"><?= $sup['spName']?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                            <!--Source-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Source</span>
                                                </div>
                                                <input class="form-control status-level" data-level="1" require name="source" type="text" value="" id="source" required pattern="[a-zA-Z][a-zA-Z\s]*" title="Source should only countain letters and white spaces.">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!--Receipt-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Receipt</span>
                                                </div>
                                                <input class="form-control status-level" data-level="0" name="receipt" type="text" value="" id="receipt">
                                            </div>
                                            <!--Date-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Date</span>
                                                </div>
                                                <input class="form-control" name="date" id="date" type="date" data-level="0" data-validate="required" message="Date is required!" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
                                            </div>
                                        </div>
                                        <!--Remarks-->
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="width:70px">Remarks</span>
                                            </div>
                                            <textarea type="text" data-level="0" name="remarks" class="status-level form-control form-control-sm"
                                                rows="1"></textarea>
                                        </div>

                                        <div class="ic-level-2">
                                            <table class="table table-borderless">
                                                <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                    <tr>
                                                        <th width="25%" style="font-weight:500 !important;">Stock Item</th>
                                                        <th style="font-weight:500 !important;">Quantity</th>
                                                        <th style="font-weight:500 !important;">Actual Qty</th>
                                                        <th style="font-weight:500 !important;">Discount</th>
                                                        <th style="font-weight:500 !important;">Price</th>
                                                        <th style="font-weight:500 !important;">Subtotal</th>
                                                        <th width="15%" style="font-weight:500 !important;">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ic-level-2 deliveries">
                                                    <tr>
                                                        <td><input type="text" class="form-control form-control-sm"></td>
                                                        <td><input type="text" class="form-control form-control-sm"></td>
                                                        <td><input type="text" class="form-control form-control-sm"></td>
                                                        <td><input type="text" class="form-control form-control-sm"></td>
                                                        <td><input type="text" class="form-control form-control-sm"></td>
                                                        <td><input type="text" class="form-control form-control-sm"></td>
                                                        <td>
                                                            <select class="form-control form-control-sm">
                                                                <option></option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <span>Total: &#8369;<span class="total">0</span></span>
                                        <!--Total of the trans items-->
                                    </div>
                                    <div class="card-footer mb-0" style="overflow:auto">
                                        <button class="btn btn-success btn-sm" type="submit"
                                            style="float:right">Insert</button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="float:right">Cancel</button>
                                    </div>
                                </form>
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
            </html>