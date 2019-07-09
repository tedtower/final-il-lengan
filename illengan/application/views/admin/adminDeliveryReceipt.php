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
                                <a class="btn btn-primary btn-sm" href="<?= site_url('admin/deliveryreceipt/formadd')?>" data-original-title style="margin:0"
                                    id="addBtn">Add Delivery Receipt</a>
                                <br>
                                <br>
                                <?php if(isset($drs[0])){
                                ?>
                                <table id="transTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead class="thead-dark">
                                        <th><b class="pull-left">Transaction #</b></th>
                                        <th><b class="pull-left">Receipt #</b></th>
                                        <th><b class="pull-left">Supplier</b></th>
                                        <th><b class="pull-left">Date</b></th>
                                        <th><b class="pull-left">Total</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                    <?php foreach($drs as $dr){
                                    ?>
                                        <tr data-id="<?= $dr['id']?>">
                                            <td><a href="javascript:void(0)" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>DEl - <?= $dr['id']?></td>
                                            <td><?= $dr['receipt']?></td>
                                            <td><?= $dr['supplierName']?></td>
                                            <td><?= $dr['transDate']?></td>
                                            <td><?= $dr['total']?></td>
                                            <td>
                                            <a class="btn btn-secondary btn-sm" href="<?= site_url('admin/deliveryreceipt/formedit/'.$dr['id'])?>" data-original-title style="margin:0"
                                                id="editBtn">Edit</a>
                                            <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#deletePO">Archive</button>
                                            </td>
                                        </tr>
                                        <tr class="accordion" style="display:none">
                                            <td colspan="6">
                                                <div class="container" style="display:none">
                                                <div>Date Recorded:<?= $dr['dateRecorded'] == null ? "N/A" : $dr['dateRecorded']?></div>
                                                <?php foreach($drItems as $drItem){
                                                        if($drItem['piID'] == $dr['piID']){?>
                                                <div>Remarks:<?= $drItem['tiRemarks'] == null ? "N/A" : $drItem['tiRemarks']?></div>

                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Qty</th>
                                                            <th>Actual Qty</th>
                                                            <th>Price</th>
                                                            <th>Discount</th>
                                                            <th>Subtotal</th>
                                                            <th>Delivery Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                        <tr>
                                                            <td><?= $drItem['stockname']?></td>
                                                            <td><?= $drItem['qty']?></td>
                                                            <td><?= $drItem['actual']?></td>
                                                            <td><?= $drItem['spmPrice']?></td>
                                                            <td><?= $drItem['tiDiscount'] == null ||  $drItem['tiDiscount'] == 0 ? "N/A" : $drItem['tiDiscount']?></td>
                                                            <td><?= ($drItem['qty']*$drItem['spmPrice'])-$drItem['tiDiscount']?></td>
                                                            <td><?= $drItem['piStatus']?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }?>
                                    </tbody>
                                </table>
                                <?php }
                                                        }?>
                                <?php
                                }else{
                                ?>
                                <p>No deliveries recorded!</p>
                                <?php
                                }?>
                                <!--End Table Content-->
                                
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
    var getEnumValsUrl = '<?= site_url('admin/transactions/getEnumVals')?>';
    var crudUrl = '<?= site_url('admin/transactions/add')?>';
    var getTransUrl = '<?= site_url('admin/transactions/getTransaction')?>';
    var loginUrl = '<?= site_url('login')?>';
    var getPOsUrl = '<?= site_url('admin/transactions/getPOs')?>';
    var getDRsUrl = '<?= site_url('admin/transactions/getDRs')?>';
    var getSPMsUrl = '<?= site_url('admin/transactions/getSPMs')?>';
    $(function() {
        $(".accordionBtn").on('click', function () {
            if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
                $(this).closest("tr").next(".accordion").css("display", "table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            } else {
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });
    });

    
</script>
</body>