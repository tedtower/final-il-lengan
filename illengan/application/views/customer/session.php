<?php 
	$cust_name = $this->session->userdata('cust_name');
    $table_no = $this->session-> userdata('table_no');
?>
<div class="ml-2">
	<h3 class="gab mb-0">
		Welcome to Il-lengan Cafe
		<?php if($cust_name != ""){
			echo ', '.$cust_name.'!';
		}else{
			echo '!';
		}?>
	</h3>
	<span class="delius">Done ordering? <a href="<?php echo base_url('customer/checkout')?>">Click here to checkout.</a></span>
</div>