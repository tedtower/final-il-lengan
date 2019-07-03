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
                    <div class="card" style="background:whitesmoke">
                        <div class="card-body">
                                <div class="mb-4"><b>Stock Item:</b></div>
                                <div class="form-row">
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                Start Date</span>
                                        </div>
                                        <input type="date" name="sDate" class="form-control form-control-sm">
                                    </div>
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                End Date</span>
                                        </div>
                                        <input type="date" name="eDate" class="form-control form-control-sm">
                                        <button class="btn btn-sm" style="background:#227C57;color:white;width:10%;border:0"><b>Ok</b></button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!--Table--> 
                    <table id="stockTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:2%"></th>
                                <th><b class="pull-left">Transaction</b></th>
                                <th><b class="pull-left">Receipt No.</b></th>
                                <th><b class="pull-left">Date</b></th>
                                <th><b class="pull-left">Log Quantity</b></th>
                                <th><b class="pull-left">Remaining Qty</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="/assets/media/admin/plus.png" style="height:18px;width:18px"/></td>
                                <td>delivery</td>
                                <td>12345356356</td>
                                <td>Janiuary 10 , 2019</td>
                                <td>10</td>
                                <td>25</td>
                            </tr>
                            <!--table row when an inventory check was performed-->
                            <tr style="background:whitesmoke">
                                <td><img src="/assets/media/admin/check.png" style="height:18px;width:18px"/></td>
                                <td>Inventory Check</td>
                                <td><b>Date:</b> </td>
                                <td><b>Physical Count:</b> </td>
                                <td><b>Discrepancy:</b> </td>
                                <td><b>Remarks:</b> </td>
                            </tr>
                        </tbody>
                    </table>

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