<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark scrolling-navbar py-1">
  <img src="<?php echo base_url();?>assets/media/logo.png" class="nav-logo mr-2 my-1" alt="Il-lengan logo" />
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto delius">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().'chef'?>"><i class="fal fa-tasks"></i> Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().'chef/inventory'?>"><i class="fal fa-boxes"></i> Inventory</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().'chef/consumption'?>"><i class="fal fa-boxes"></i> Consumption</a>
          </li>
          <li class="nav-item">
            <a onclick="myFunction()" href="#" class="dropbtn nav-link"><i class="fal fa-trash"></i> Spoilages</a>
            <div  id="myDropdown" class="dropdown-content">
              <a href="<?php echo base_url().'chef/spoilages/menu'?>"><i class="fal fa-book"></i>  Menu Spoilages</a>
              <a href="<?php echo base_url().'chef/spoilages/stock'?>"><i class="fal fa-fish"></i>  Stock Spoilages</a>
            </div>
</li>
      </ul>
      <ul class="navbar-nav ml-auto delius">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('login/logout')?>"><i class="fal fa-sign-out-alt"></i> Sign Out</a>
          </li>
      </ul>
  </div>
</nav>