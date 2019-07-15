<!--End Sidebar-->
<div class="content">
    <div class="container-fluid">
        <div class="content" style="margin-left:250px;">
            <div class="container-fluid">
                <div class="content">
                    <div class="container-fluid">
                        <!--Card Content-->
                        <div class="card-content">

                            <!-- Welcome Content -->
                            <div class="row">
                                <div class="col">
                                    <h4>Welcome, <?= $this->session->userdata('user_name') ?>!</h4>
                                    <h5>Today is <?= date("l jS \of F Y") ?></h5>
                                </div>
                            </div>
                            <!-- Welcome Content -->

                            <!-- Coutables Content -->
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-counter primary">
                                    <i class="fa fa-money-check-alt"></i>
                                    <span class="count-numbers"><?php if (count($todaySales) > 0) echo $todaySales[0]->salesCount; else echo '0'; ?></span>
                                    <span class="count-name">Today's Menu Ordered</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-counter success">
                                    <i class="fa fa-money-bill-alt"></i>
                                    <span class="count-numbers"><?php if (count($todaySales) > 0) echo $todaySales[0]->sales; else echo '0'; ?></span>
                                    <span class="count-name">Today's Total Sales</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-counter info">
                                    <i class="fa fa-minus-square"></i>
                                    <span class="count-numbers"><?= $monthConsumption[0]->total ?></span>
                                    <span class="count-name">This Month's Consumption</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card-counter danger">
                                    <i class="fa fa-truck-loading"></i>
                                    <span class="count-numbers"><?= count($stockroom)+count($kitchen) ?></span>
                                    <span class="count-name">Needs Restock</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Countables Content -->

                            <!--Sales Category-->
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
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Total Sales By Custom Date <span id="csdg-load"></span></h4>
                                            <p class="category">Custom generated sales report.</p>
                                        </div>
                                        <div class="content">
                                            <div id="error-custom-generate"></div>
                                            <p class="mb-0"><i class="fa fa-calendar"></i> Date</p>
                                            <div class="input-group mb-2">
                                                <input type="date" class="form-control" id="sales-date" required />
                                                <a class="btn btn-sm btn-secondary ml-1 align-self-center" id="custom_sale_generate">Generate <i class="fa fa-arrow-right"></i></a>
                                            </div>
                                            <div id="custom_sale_result"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Sales Category-->

                            <!--Top Sales Category-->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">Top Menu Items By Sales</h4>
                                            <p class="category">January <span id="maxMonth"></span> <?= date('Y') ?></p>
                                        </div>
                                        <div class="content">
                                            <?php if (count($topmenu) > 0) { ?>
                                            <table class="table text-center">
                                                <tr>
                                                    <th>Rank</th>
                                                    <th>Menu Item</th>
                                                    <th>Sales Count</th>
                                                </tr>
                                                <?php $x = 1; foreach ($topmenu as $tpm) { ?>
                                                <tr>
                                                    <td><?= $x ?></td>
                                                    <td><?= $tpm->mName ?></td>
                                                    <td><?= $tpm->salesCount ?></td>
                                                </tr>
                                                <?php $x++; } ?>
                                            </table>
                                            <?php } else { ?>
                                                <h5><i class="fa fa-times"></i> There is no sale recorded.</h5>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Top Sales Category-->

                            <!--Needs Restock Category-->
                            <div class="row">
                                <!--Stockroom-->
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
                                        </div>
                                    </div>
                                </div>
                                <!--Kitchen-->
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Needs Restock Category-->

                        </div>
                        <!--Card Content-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>