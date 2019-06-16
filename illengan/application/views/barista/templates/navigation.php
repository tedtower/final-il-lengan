<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark scrolling-navbar py-1">
  <img src="<?php echo base_url();?>assets/media/logo.png" class="nav-logo mr-2 my-1" alt="Il-lengan logo" />
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto delius">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('barista/orders')?>"><i class="fal fa-tasks"></i> Order Lists</a>
          </li>
      </ul>
      <ul class="navbar-nav mr-auto delius">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('barista/orderslip')?>"><i class="fal fa-tasks"></i> Order Slips</a>
          </li>
      </ul>
      <ul class="navbar-nav mr-auto delius">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('barista/billings')?>"><i class="fas fa-money-bill-wave"></i> Billings</a>
          </li>
      </ul>
      <ul class="navbar-nav mr-auto delius">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('barista/transactions')?>"><i class="fas fa-receipt"></i> Transactions</a>
          </li>
      </ul>
      <ul class="navbar-nav mr-auto delius">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('barista/inventory')?>"><i class="fas fa-boxes"></i></i> Inventory</a>
          </li>
      </ul>
      <ul class="navbar-nav ml-auto delius">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('login/logout')?>"><i class="fal fa-sign-out-alt"></i> Sign Out</a>
          </li>
      </ul>
  </div>
</nav>