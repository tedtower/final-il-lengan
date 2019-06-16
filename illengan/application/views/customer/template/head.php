<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Il-Lengan: Customer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Webpage Icon -->
    <link rel="icon" href="<?php echo logo_url().'logo_sm.ico'?>" type="image/ico" />
    <!-- Frameworks -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo framework_url(); ?>mdb/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo framework_url(); ?>mdb/css/mdb.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo framework_url(); ?>mdb/css/animations-extended.min.css">
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo font_url(); ?>fontawesome/font-awesome.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo font_url(); ?>gabriola.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo font_url(); ?>delius.css">
    <!-- Custom -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo cmcss_url(); ?>style.css">
</head>

<!--Main Navigation-->
<header>
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark elegant-color scrolling-navbar py-0">
        <img src="<?php echo logo_url(); ?>logo_lg.png" class="nav-logo mr-2 my-1" alt="Il-lengan logo" />
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto delius">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="menu-dd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-utensils-alt"></i></i> Menu</a>
                    <div class="dropdown-menu dropdown-default elegant-color c-focus" aria-labelledby="menu-dd">
                        <a class="dropdown-item categories" href="<?php echo site_url()?>/customer/menu">All Menu</a>
                        <?php foreach($categories as $cat) {?>
                            <a class="dropdown-item categories" href="<?php echo site_url()?>/customer/category/<?php echo $cat->ctID;?>"><?php echo $cat->ctName; ?></a>
                        <?php } ?>
                    </div>
                </li>
                <li class="nav-item"><!-- #order_modal -->
                    <a class="nav-link" data-toggle="modal" href="#order_modal" id="omButton"><i class="fal fa-tasks"></i> Orders</a>
                </li>
            </ul>
            <!-- Search form -->
            <div class="navbar-nav py-0 my-1">
                <div class="active-sbar">
                    <input id="searchmenu" class="form-control" type="search" placeholder="Search here..." aria-label="Search">
                </div>
            </div>
        </div>
    </nav>
    <!-- Progress Bar -->
    <div class="progress-container">
        <div class="progress-bar" id="bar"></div>
    </div>
</header>

<body>
