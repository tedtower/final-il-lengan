<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark scrolling-navbar py-1">
  <img src="<?php echo base_url();?>assets/media/logo.png" class="nav-logo mr-2 my-1" alt="Il-lengan logo" />
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto delius">
          <li class="nav-item mr-2">
            <a class="nav-link" href="<?php echo base_url('barista/orderslip')?>"><i class="fal fa-list"></i> Order Slips</a>
          </li>
          <li class="nav-item mr-2">
            <a class="nav-link" href="<?php echo base_url('barista/servedOrders')?>"><i class="fal fa-tasks"></i> Served Slips</a>
          </li>
          <li class="nav-item mr-2">
            <a class="nav-link" href="<?php echo base_url('barista/billings')?>"><i class="fas fa-money-bill-wave"></i> Billings</a>
          </li>
          <li class="nav-item dropdown mr-2">
              <a class="nav-link dropdown-toggle" id="menu-dd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-boxes"></i> Inventory</a>
              <div class="dropdown-menu dropdown-default elegant-color c-focus" aria-labelledby="menu-dd">
                  <a class="dropdown-item" href=""><i class="far fa-truck-loading"></i> Delivery Receipt</a>
                  <a class="dropdown-item" href=""><i class="far fa-receipt"></i> Official Receipt</a>
                  <a class="dropdown-item" href=""><i class="far fa-calendar-minus"></i> Consumption</a>
              </div>
          </li>
          <li class="nav-item dropdown mr-2">
              <a class="nav-link dropdown-toggle" id="menu-dd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fal fa-trash"></i> Spoilage</a>
              <div class="dropdown-menu dropdown-default elegant-color c-focus">
                  <a class="dropdown-item" href="<?php echo base_url('barista/menu/spoilages')?>"><i class="fal fa-utensils-alt"></i> Menu Spoilage</a>
                  <a class="dropdown-item" href="<?php echo base_url('barista/stock/spoilages')?>"><i class="fal fa-box-open"></i> Stock Spoilage</a>
              </div>
          </li>
        </ul>
       <ul class="navbar-nav delius">
          <li class="nav-item" >
            <a class="nav-link" href="<?php echo base_url('login/logout')?>"><i class="fal fa-sign-out-alt"></i> Sign Out</a>
          </li>
      </ul>
  </div>
</nav>
