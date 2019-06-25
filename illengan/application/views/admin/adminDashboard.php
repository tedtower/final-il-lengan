<!--End Sidebar-->
<div class="content">

    <div class="container-fluid">
        <br>
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <?php echo date("M j, Y -l"); ?>
        </p>
        <div class="content" style="margin-left:250px;">
            <div class="container-fluid">
                <div class="content">
                    <div class="container-fluid">
                        <!--Table-->
                        <div class="card-content">
                            <!--Card 1-->
                            <div class="row ">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header-1">
                                            <img class="card-img m-3" src="../assets/media/admin/sales.png" alt="Sales">
                                        </div>
                                        <div class="card-content-text m-1 p-2 card-top">
                                            <p style="font-size: 14.5px !important">Today's Menu Ordered</p>
                                            <h3 class="title" id="tmo" style="color:#1c1ce0"><?php if (count($todaySales) > 0) echo $todaySales[0]->salesCount; else echo '0'; ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <!--Card 2-->
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header-2">
                                            <img class="card-img m-3" src="../assets/media/admin/money.png" alt="Bill">
                                        </div>
                                        <div class="card-content-text m-1 p-2 card-top">
                                            <p style="font-size: 14.5px !important">Today's Total Sales</p>
                                            <h3 class="title" id="tts" style="color:#0000c0">&#x20b1;<?php if (count($todaySales) > 0) echo $todaySales[0]->sales; else echo '0'; ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <!--Card 3-->
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header-3">
                                            <img class="card-img m-3" src="../assets/media/admin/storage.png" alt="Items">
                                        </div>
                                        <div class="card-content-text m-1 p-2 card-top">
                                            <p style="font-size: 14.5px !important">Today's Consumed Items</p>
                                            <h3 class="title" id="tsi" style="color:#8210d3"><?= $todayConsumption[0]->total ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <!--Card 4-->
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header-4">
                                            <img class="card-img m-3" src="../assets/media/admin/cart.png" alt="Restock">
                                        </div>
                                        <div class="card-content-text m-1 p-2 card-top">
                                            <p style="font-size: 14.5px !important">Needs Restock</p>
                                            <h3 class="title" id="nr" style="color:#ca1010"><?= count($stockroom)+count($kitchen) ?></h3>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <!--End Card 1 to 4 Dashboard-->

                            <!--Top Menu Category-->
                            <div class="row">

                                <div class="col-md-12 col-lg-7">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Monthly Sales</h4>
                                            <p class="category">January <span id="maxMonth"></span> <?= date('Y') ?></p>
                                        </div>
                                        <div class="content">
                                            <canvas id="revenue"></canvas>
                                            <div class="footer">
                                                <div class="legend">
                                                    <i class="fa fa-circle" style="color:#2b89d6de"></i> Sales
                                                </div>
                                                <hr>
                                                <div class="stats">
                                                    <i class="fa fa-history"></i> Updated as of <?= date('g:i A') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-5">
                                    <div class="row">
                                        <div class="col-lg-12 card">
                                            <div class="header">
                                                <h4 class="title">Top Menu Items By Sales</h4>
                                                <p class="category">January <span id="maxMonth"></span> <?= date('Y') ?></p>
                                            </div>
                                            <div class="content">
                                                <div>
                                                    <?php if (count($topmenu) > 0) { ?>
                                                        <table class="table text-center">
                                                            <tr>
                                                                <th>Rank</th>
                                                                <th>Menu Item</th>
                                                                <th>Sales Count</th>
                                                            </tr>
                                                            <?php $x = 1;
                                                            foreach ($topmenu as $tpm) { ?>
                                                                <tr>
                                                                    <td><?= $x ?></td>
                                                                    <td><?= $tpm->mName ?></td>
                                                                    <td><?= $tpm->salesCount ?></td>
                                                                </tr>
                                                                <?php $x++;
                                                            } ?>
                                                        </table>
                                                    <?php } else { ?>
                                                        <h5><i class="fa fa-times"></i> There is no sale recorded.</h5>
                                                    <?php } ?>
                                                    </table>
                                                </div>
                                                <div class="footer">
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Stockroom Items Needed to Restock</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <?php if(count($stockroom) > 0) { ?>
                                <table class="table text-center">
                                <tr>
                                    <th>Item</th>
                                    <th>Actual</th>
                                    <th>Minimum</th>
                                </tr>
                                <?php foreach($stockroom as $st) { ?>
                                <tr>
                                    <td><?= $st->stock ?></td>
                                    <td class="text-danger"><b><?= $st->stQty ?></b></td>
                                    <td><b><?= $st->stMin ?></b></td>
                                </tr>
                                <?php } ?>
                                </table>
                                <?php } else { ?>
                                    <h5><i class="fa fa-check"></i> You have no insufficient stocks.</h5>
                                <?php } ?>
                                </table>
                                <div class="footer">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Kitchen Items Needed to Restock</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <?php if(count($kitchen) > 0) { ?>
                                <table class="table text-center">
                                <tr>
                                    <th>Item</th>
                                    <th>Actual</th>
                                    <th>Minimum</th>
                                </tr>
                                <?php foreach($kitchen as $st) { ?>
                                <tr>
                                    <td><?= $st->stock ?></td>
                                    <td class="text-danger"><b><?= $st->stQty ?></b></td>
                                    <td><b><?= $st->stMin ?></b></td>
                                </tr>
                                <?php } ?>
                                </table>
                                <?php } else { ?>
                                        <h5><i class="fa fa-check"></i> You have no insufficient stocks.</h5>
                                <?php } ?>
                                </table>
                                <div class="footer">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>