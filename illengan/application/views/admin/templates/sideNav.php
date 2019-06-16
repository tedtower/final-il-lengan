<!-- Sidebar Holder -->
<nav id="sidebar">
    <div class="sidebar-header">
        <img  class="logo" src="/assets/media/logo.png">
    </div>
    <hr>
    <ul class="list-unstyled" id="sidelist">
        <!--Dashboard-->
        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="far fa-tachometer-alt-slowest"></i> Dashboard</a></li>
        <!--Inventory-->
        <li class="has-oul">
            <a href="#homeSubmenu" data-toggle="collapse"  class="dropdown-toggle" aria-expanded="false"><i class="far fa-industry"></i> Inventory</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="<?php echo base_url('admin/inventory')?>"><i class="far fa-boxes"></i> Stock Items</a></li>
                <li><a href="<?php echo base_url('admin/stockcategories')?>"><i class="far fa-bookmark"></i> Categories</a></li>
                <li><a href="<?php echo base_url('admin/transactions')?>"><i class="far fa-truck-loading"></i> Transactions</a></li>
                <li><a href="<?= base_url('admin/consumption'); ?>"><i class="far fa-calendar-minus"></i> Consumption</a></li>
                <li><a href="<?php echo base_url('admin/stock/spoilages')?>"><i class="far fa-trash"></i> Spoilages</a></li>
                <li><a href="<?php echo base_url('admin/measurements')?>"><i class="far fa-trash"></i> Measurements</a></li>
            </ul>
        </li>
        <!--Menu-->
        <li class="has-oul">
            <a href="#Menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="far fa-bars"></i> Menu</a>
            <ul class="collapse list-unstyled" id="Menu">
                <li><a href="<?php echo base_url('admin/menu') ?>"><i class="far fa-book"></i> Menu Items</a></li>
                <li><a href="<?php echo base_url('admin/menu/addons')?>"><i class="far fa-layer-group"></i> Addons</a></li>
                <li><a href="<?php echo base_url('admin/menucategories')?>"><i class="far fa-bookmark"></i> Categories</a></li>
                <li><a href="<?php echo base_url('admin/menu/promos')?>"><i class="far fa-gift"></i> Promos</a></li>
                <li>
                    <a href="#Spoilages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="far fa-trash"></i> Spoilages</a>
                    <ul  class="collapse list-unstyled" id="Spoilages">
                        <li><a href="<?php echo base_url('admin/addons/spoilages')?>"><span class="ml-4">Addon Spoilages</span></a></li>
                        <li><a href="<?php echo base_url('admin/menu/spoilages')?>"><span class="ml-4">Menu Spoilages</span></a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <!--Sales-->
        <li><a href="<?php echo base_url('admin/sales')?>"><i class="far fa-receipt"></i> Sales</a></li>
        <!--Sources-->
        <li><a href="<?php echo base_url('admin/supplier') ?>"><i class="far fa-user-tag"></i> Sources</a></li>
        <!--Accounts-->
        <li><a href="<?php echo base_url('admin/accounts') ?>"><i class="far fa-users"></i> Accounts</a></li>
        <!--Tables-->
        <li><a  href="<?php echo base_url('admin/tables') ?>"><i class="far fa-cube"></i> Tables</a></li>
        <!--Reports-->
        <li class="has-oul">
            <a href="#Reports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="far fa-chart-line"></i> Reports</a>
            <ul  class="collapse list-unstyled" id="Reports">
                <li><a href="#" ><i class="far fa-industry"></i> Inventory Report</a></li>
                <li><a href="#"><i class="far fa-receipt"></i> Sales Report</a></li>
            </ul>
        </li>
        <!--Activity Logs-->
        <li><a href="<?php echo base_url('admin/log/activity')?>"><i class="far fa-history"></i> Activity Logs</a></li>
        <li><a href="<?php echo base_url('logout')?>"><i class="far fa-sign-out-alt"></i> Log Out</a></li>
    </ul>
</nav>