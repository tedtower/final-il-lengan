<!doctype html>
<html lang="en">

<head>
    <?php include_once('templates/head.php') ?>
</head>
<body>
    <?php include_once('templates/sideNav.php') ?>
    <!--End Sidebar-->
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
                                    <!--Card 1-->
                                    <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background="orange">
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Today's Total Sales</p>
                                                <h3 class="title">
                                                    <?php
                                                    ?>
                                                </h3>
                                            </div>
                                            <a href="adminSales.html">
                                                <div class="card-footer">
                                                    <div class="stats">
                                                        <i class="glyphicon glyphicon-circle-arrow-right">Details</i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!--Card 2-->
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background="orange">
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Today's Total Revenue</p>
                                                <h3 class="title">
                                                    <?php
                                                    ?>
                                                </h3>
                                            </div>
                                            <a href="views/adminTotalRevenue.html">
                                                <div class="card-footer">
                                                    <div class="stats">
                                                        Details
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!--Card 3-->
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background="orange">
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Total Items</p>
                                                <h3 class="title">
                                                    <?php
                                                    ?>
                                                </h3>
                                            </div>
                                            <a href="views/adminTotalItems.html">
                                                <div class="card-footer">
                                                    <div class="stats">
                                                        <i>Details</i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!--Card 4-->
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background="orange">
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Needs Restock</p>
                                                <h3 class="title">
                                                    <?php
                                                    ?>
                                                </h3>
                                            </div>
                                            <a href="views/adminNeedRestocks.html">
                                                <div class="card-footer">
                                                    <div class="stats">
                                                        <i>Details</i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
</div>
                                    <!--End Card 1 to 4 Dashboard-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">

                                            <div class="header">
                                                <h4 class="title">Yearly Sales</h4>
                                                <p class="category">January to December 2018</p>
                                            </div>
                                            <div class="content">
                                                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                                <div class="footer">
                                                    <div class="legend">
                                                        <i class="fa fa-circle text-info"></i> High
                                                        <i class="fa fa-circle text-danger"></i> Low
                                                    </div>
                                                    <hr>
                                                    <div class="stats">
                                                        <i class="fa fa-history"></i> Updated 10 minutes ago
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Top Menu Category-->
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="header">
                                                <h4 class="title">Top Menu Categories By Sales</h4>
                                                <p class="category">January - December 2018</p>
                                            </div>
                                            <div class="content">
                                                <div id="chartHours" class="ct-chart"></div>
                                                <div class="footer">
                                                    <div class="legend">
                                                        <i class="fa fa-circle text-info"></i> High
                                                        <i class="fa fa-circle text-danger"></i> Low
                                                    </div>
                                                    <hr>
                                                    <div class="stats">
                                                        <i class="fa fa-history"></i> Updated 10 minutes ago
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card ">
                                            <div class="header">
                                                <h4 class="title">Top Menu Items By Sales</h4>
                                                <p class="category">January - December 2018</p>
                                            </div>
                                            <div class="content">
                                                <div id="chartActivity" class="ct-chart"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card ">
                                            <div class="header">
                                                <h4 class="title">Others</h4>
                                                <p class="category"></p>
                                            </div>
                                            <div class="content">
                                                <div class="table-full-width">
                                                    <table class="table">
                                                    </table>
                                                </div>

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
    </div>
</body>

</html>