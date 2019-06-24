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
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Card 1 to 4 Dashboard-->
</body>