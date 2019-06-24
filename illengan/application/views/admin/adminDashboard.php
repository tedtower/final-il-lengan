<style>
    .card-header-1 {
        background: darkblue;
        position: relative;
        top: -30px;
        left: 5%;
        height: 80px;
        width: 80px;
    }

    .card-header-2 {
        background: green;
        position: relative;
        top: -30px;
        left: 5%;
        height: 80px;
        width: 80px;
    }

    .card-header-3 {
        background: indigo;
        position: relative;
        top: -30px;
        left: 5%;
        height: 80px;
        width: 80px;
    }

    .card-header-4 {
        background: red;
        position: relative;
        top: -30px;
        left: 5%;
        height: 80px;
        width: 80px;
    }

    .card-top {
        margin-top: -10% !important;
    }

    .card-content-text {
        text-align: right;
    }

    .card-img {
        height: 60%;
        width: 60%;
        margin: auto;
        display: block;
    }
</style>

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
                                        <div class="card-content-text m-2 p-2 card-top">
                                            <p class="category">Today's Total Sales</p>
                                            <h3 class="title">
                                                123456
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!--Card 2-->
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header-2">
                                            <img class="card-img m-3" src="../assets/media/admin/money.png" alt="Bill">
                                        </div>
                                        <div class="card-content-text m-2 p-2 card-top">
                                            <p class="category">Today's Total Revenue</p>
                                            <h3 class="title">
                                                12345
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!--Card 3-->
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header-3">
                                            <img class="card-img m-3" src="../assets/media/admin/storage.png" alt="Items">
                                        </div>
                                        <div class="card-content-text m-2 p-2 card-top">
                                            <p class="category">Total Items</p>
                                            <h3 class="title">
                                                12345
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!--Card 4-->
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-header-4">
                                            <img class="card-img m-3" src="../assets/media/admin/cart.png" alt="Restock">
                                        </div>
                                        <div class="card-content-text m-2 p-2 card-top">
                                            <p class="category">Needs Restock</p>
                                            <h3 class="title">
                                                12345
                                            </h3>
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
                                    <div class="row text-center">
                                        <div class="col card m-1 p-0">
                                            <div class="bg-dark text-white">
                                                <span class="cnumber-text">245</span><br>
                                                <span class="csub-text">Last Month's Menu Ordered</span>
                                            </div>
                                        </div>
                                        <div class="col card m-1 p-0">
                                            <div class="bg-dark text-white">
                                                <span class="cnumber-text">245</span><br>
                                                <span class="csub-text">Last Month's Menu Ordered</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-center mb-3">
                                        <div class="col card m-1 p-0">
                                            <div class="bg-dark text-white">
                                                <span class="snumber-text">245</span><br>
                                                <span class="csub-text">Last Month's Menu Ordered</span>
                                            </div>
                                        </div>
                                        <div class="col card m-1 p-0">
                                            <div class="bg-dark text-white">
                                                <span class="snumber-text">245</span><br>
                                                <span class="csub-text">Last Month's Menu Ordered</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 card">
                                            <div class="header">
                                                <h4 class="title">Top Menu Items By Sales</h4>
                                                <p class="category">January <span id="maxMonth"></span> <?= date('Y') ?></p>
                                            </div>
                                            <div class="content">
                                                <div style="overflow-y:scroll">
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
                                                    <div class="stats">
                                                        <i class="fa fa-history"></i> Updated as of <?= date('g:i A') ?>
                                                    </div>
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
                                        <h4 class="title">Others</h4>
                                        <p class="category"></p>
                                    </div>
                                    <div class="content">
                                        <div class="footer">
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-history"></i> Updated 25 minutes ago
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="card ">
                                    <div class="header">
                                        <h4 class="title">Others</h4>
                                        <p class="category"></p>
                                    </div>
                                    <div class="content">
                                        <div class="footer">
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-history"></i> Updated 25 minutes ago
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