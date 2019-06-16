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
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMenuStock"
                                    data-original-title style="margin:0;">Add Item</button>
                                <br>
                                <br>
                    <table id="stockTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
                        <thead class="thead-dark">
                            <tr>
                                <th><b class="pull-left">Menu Item</b></th>
                                <th><b class="pull-left">Quantity</b></th>
                                <th><b class="pull-left">Actions</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <!--Start of Modal "Add Stock Spoilages"-->
                    <div class="modal fade bd-example-modal-lg" id="addMenuStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Menu-Stock</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="formAdd" action="<?= site_url('admin/stock/spoilages/add')?>" accept-charset="utf-8">
                                    <div class="modal-body">
                                        <!--Button to add launche the brochure modal-->
                                        <a class="addSpoilageItem btn btn-default btn-sm" data-toggle="modal" data-target="#brochureSS" data-original-title style="margin:0" id="addStockSpoilage">Add Menu Items</a>
                                        <br><br>
                                        <table class="stockSpoilageTable table table-sm table-borderless">
                                            <!--Table containing the different input fields in adding stock spoilages -->
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Menu Name</th>
                                                    <th>Stock Name</th>
                                                    <th>Qty</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <!--Total of the trans items-->
            
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-success btn-sm" onclick="addStockItems()">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End of Modal "Add Stock Spoilage"-->

                    <!--Start of Brochure Modal"-->
                    <div class="modal fade bd-example-modal" id="brochureSS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Menu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="formAdd"  method="post" accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div style="margin:1% 3%" id="list">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="getSelectedStocks()">Ok</button>
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
<?php include_once('templates/scripts.php') ?>
</body>