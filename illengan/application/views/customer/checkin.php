<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<html>
	<head>
		<title>Illengan</title>
		<?php include_once('template/head.php');?>
	</head>
	<body>
		<?php echo isset($error) ? $error : ''; ?>
         <form method="post" action="<?php echo site_url();?>customer/processCheckIn">
    <div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="text-center">
                    <img class="mt-2" src="<?php echo base_url().'assets/media/logo.png'?>" style="height:130px;width:130px">
                    <div class="modal-header">
                        <h2 class="modal-title w-100 gab">Welcome to Il-lengan Cafe!</h1>
                    </div>
                </div>
                <div class="modal-body">
				<h4 class="gab">Table Code:</h4>
				<select class="form-control mb-2 delius" name="table_no" required>
				    <option value="" disabled selected>Please Select</option>
                    <?php foreach($number as $row){ 
                        echo '<option value="'.$row->tableCode.'">'.$row->tableCode.'</option>';
                    }?>
                </select>
					<div class="md-form input-group m-0 delius">
                        <input type="text" name="cust_name" id="cust_name" class="form-control text-center" placeholder="Customer's Name (optional)" aria-label="Cutomer Name"/>
                    </div>
                </div>
                <div class="text-center">
                   <input type="submit" class="btn btn-dark-green" value="Login">
                </div>
            </div>
        </div>
    </div>
		</form>
	</body>
</html>
<?php include_once('template/foot.php');?>
