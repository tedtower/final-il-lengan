<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark scrolling-navbar py-1">
  <img src="<?php echo base_url();?>assets/media/logo.png" class="nav-logo mr-2 my-1" alt="Il-lengan logo" />
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto delius">
          <li class="nav-item mr-2">
          <a class="nav-link" href="<?php echo base_url().'chef'?>"><i class="fal fa-tasks"></i> Orders</a>
          </li>
          <!-- <li class="nav-item dropdown mr-2">
              <a class="nav-link dropdown-toggle" id="menu-dd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-boxes"></i> Inventory</a>
              <div class="dropdown-menu dropdown-default elegant-color c-focus" aria-labelledby="menu-dd">
                  <a class="dropdown-item" href="<?php echo base_url('chef/consumption')?>"><i class="far fa-truck-loading"></i> Consumption</a>
                  <a class="dropdown-item" href="<?php echo base_url('chef/inventory/deliveries')?>"><i class="far fa-receipt"></i> Delivery Receipts</a>
              </div>
          </li>
          <li class="nav-item dropdown mr-2">
              <a class="nav-link dropdown-toggle" id="menu-dd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-trash"></i> Spoilage</a>
              <div class="dropdown-menu dropdown-default elegant-color c-focus">
                  <a class="dropdown-item" href="<?php echo base_url('chef/spoilages/menu')?>"><i class="fal fa-utensils-alt"></i> Menu Spoilage</a>
                  <a class="dropdown-item" href="<?php echo base_url('chef/spoilages/stock')?>"><i class="fal fa-box-open"></i> Stock Spoilage</a>
              </div>
          </li> -->
        </ul>
       <ul class="navbar-nav delius">
          <li class="nav-item" >
            <a class="nav-link" href="<?php echo base_url('login/logout')?>"><i class="fal fa-sign-out-alt"></i> Sign Out</a>
          </li>
      </ul>
  </div>
</nav>
