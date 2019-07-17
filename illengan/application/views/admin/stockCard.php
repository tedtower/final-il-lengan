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
                        <a class="btn btn-warning btn-sm m-0" href="<?= site_url('admin/inventory/stockcard/history/')?><?= $stock['stID']?>" style="background:#FDBD12;color:white;font-weight:900"><i class="fal fa-history"></i> History</a>
                        <button class="btn btn-danger btn-sm m-0" data-toggle="modal" data-target="#addReport" style="background:#cc0000;color:white;font-weight:900"><i class="fas fa-file-pdf"></i> Export to PDF</button>
                    </div>
                    <!--Card--> 
                    <div class="card" style="background:whitesmoke">
                        <div class="card-body">
                        <div style="width:100%;overflow:auto;">
                            <div style="overflow:auto;">
                            <span style="float:left;width:40%;"><b>Stock Item:</b> <?= $stock['stName'] . " " . $stock['stSize']?></span>
                                <span style="float:left;width:40%"><b>Beginning Inventory Date:</b> <?= $logs[0]['logDate']?></span>
                                <span style="float:left;width:20%"><b>Beginning Qty:</b> <?= $logs[0]['actual'] . " " . $stock['uomAbbreviation']?></span>
                            </div>
                            
                            <div style="overflow:auto;">
                                <span style="float:left;width:40%"><b>Storage:</b> <?= $stock['stLocation']?></span>
                                <span style="float:left;width:40%"><b>Category:</b> <?= $stock['ctName']?></span>
                                <span style="float:left;width:20%"><b>Status:</b> <?= $stock['stStatus']?></span>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--Table--> 
                    <table id="stockTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                        <thead class="thead-dark">
                            <tr>
                                <th style="width:2%"></th>
                                <th><b class="pull-left">Transaction Type</b></th>
                                <th><b class="pull-left">Transaction No.</b></th>
                                <th><b class="pull-left">Date</b></th>
                                <th><b class="pull-left">Log Quantity</b></th>
                                <th><b class="pull-left">Remaining Qty</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($logs)){
                            $icon;
                            foreach($logs as $log){
                                switch($log['type']){
                                    case 'restock':
                                        if($log['receipt'] == NULL){
                                            echo '<tr>
                                                    <td><img src="/assets/media/admin/plus.png" style="height:18px;width:18px"/></td>
                                                    <td>Restock</td>
                                                    <td>'.$log['tiID'].'</td>
                                                    <td>'. $log['logDate'].'</td>
                                                    <td>'. $log['actual'].'</td>
                                                    <td>'. $log['remain'].'</td>
                                                </tr>';
                                        }else{
                                            echo '<tr>
                                            <td><img src="/assets/media/admin/plus.png" style="height:18px;width:18px"/></td>
                                            <td>Restock</td>
                                            <td>'.$log['receipt'].'</td>
                                            <td>'. $log['logDate'].'</td>
                                            <td>'. $log['actual'].'</td>
                                            <td>'. $log['remain'].'</td>
                                        </tr>';
                                        }

                                        break;
                                    case 'beginning':
                                        echo '<tr style="background:#fcfcfc">
                                                <td><img src="/assets/media/admin/check.png" style="height:18px;width:18px;"/></td>
                                                <td>Beginning</td>
                                                <td><b>Date:</b> '.$log['logDate'].'</td>
                                                <td><b>Physical Count:</b> '.$log['actual'].' </td>
                                                <td><b>Discrepancy:</b> '.$log['discrepancy'].' </td>
                                                <td><b>Remarks:</b> '.$log['tiRemarks'].'</td>
                                            </tr>';
                                        break;
                                    default:
                                        echo '<tr>
                                                <td><img src="/assets/media/admin/negative.png" style="height:18px;width:18px"/></td>
                                                <td>'.ucwords($log['type']).'</td>
                                                <td>'.$log['tiID'].'</td>
                                                <td>'. $log['logDate'].'</td>
                                                <td>'. $log['actual'].'</td>
                                                <td>'. $log['remain'].'</td>
                                            </tr>';
                                        break;
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>

                    <!--Start of Add Report Modal-->
                    <div class="modal fade" id="addReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Report</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url()?>admin/stocklog/report/add" method="post" accept-charset="utf-8">
                                    <div class="modal-body">
                                        <p>Please input the date for the following:</p>
                                        <input type="hidden" name="stID" value="<?= $stock['stID'];?>" class="form-control form-control-sm">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                    Start Date</span>
                                            </div>
                                            <input class="form-control form-control-sm" name="sDate" type="date" class="no-border"  data-validate="required" message="Start date is required!" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                    End Date</span>
                                            </div>
                                            <input class="form-control form-control-sm" name="eDate" type="date" class="no-border"  data-validate="required" message="End date is required!" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success btn-sm">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= framework_url().'mdb/js/jquery-3.3.1.min.js';?>"></script>
<script src="<?= framework_url().'bootstrap-native/bootstrap.bundle.min.js'?>"></script>
</body>