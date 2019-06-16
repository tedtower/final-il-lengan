<body style="background: white">
<div class="content">
    <div class="container-fluid">
        <br>
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y -l"); ?>
        </p>
        <div class="content" style="margin-left:250px">
            <div class="container-fluid">
                <div class="card-content">
                    <!--Card--> 
                    <div class="card" style="background:whitesmoke">
                        <div class="card-body">
                        <div style="width:100%;overflow:auto;">
                            <div style="overflow:auto;">
                            <span style="float:left;width:40%;"><b>Stock Item:</b> <?= $stock['stName'] . " " . $stock['stSize']?></span>
                                <span style="float:left;width:35%"><b>Beginning Inventory Date:</b> <?= $currentInv['maxDate']?></span>
                                <span style="float:left;width:25%"><b>Beginning Qty:</b> <?= $currentInv['slQty'] . " " . $stock['uomAbbreviation']?></span>
                            </div>
                            <div style="overflow:auto;">
                                <span style="float:left;width:40%"><b>Storage:</b> <?= $stock['stLocation']?></span>
                                <span style="float:left;width:35%"><b>Category:</b> <?= $stock['ctName']?></span>
                                <span style="float:left;width:25%"><b>Status:</b> <?= $stock['stStatus']?></span>
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
                                <th><b class="pull-left">Quantity</b></th>
                                <th><b class="pull-left">Remaining Qty</b></th>
                                <th><b class="pull-left">Remarks</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($logs)){
                            $bQty = $currentInv['slQty'];
                            $icon;
                            foreach($logs as $log){
                                switch($log['slType']){
                                    case 'restock':
                                        $bQty = $bQty + $log['slQty'];
                                        $icon = "plus";
                                        break;
                                    case 'beginning':
                                        $icon = "plus";
                                        break;
                                    default:
                                        $bQty = $bQty - $log['slQty'];
                                        $icon = "negative";
                                        break;
                                }
                        ?>
                            <tr>
                                <td><img src="/assets/media/admin/<?= $icon?>.png" style="height:18px;width:18px"/></td>
                                <td><?= ucwords($log['slType'])?></td>
                                <td><?= $log['tNum'] == NULL ? "N/A" : $log['tNum']?></td>
                                <td><?= $log['slDateTime']?></td>
                                <td><?= $log['slQty']?></td>
                                <td><?= $bQty?></td>
                                <td><?= $log['slRemarks']?></td>
                            </tr>
                        <?php
                            }
                        }?>
                        </tbody>
                    </table>
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
</body>