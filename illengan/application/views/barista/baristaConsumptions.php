<html>

<head>
	<?php include_once('templates/head.php') ?>
</head>

<body>
	<?php include_once('templates/navigation.php') ?>
	<!--End Top Nav-->
	<div class="container">
		
			<!--Destock BUTTON-->
				<div class="row">
    			<div class="col-md-4 col-lg-2">
							<button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#destock" data-original-title style="margin:0;">Add Consumption</button><br>
							<!--eND Add Stock Spoilage BUTTON-->
				</div>
  				</div>
			<!--eND Destock BUTTON-->
		
		<br>
		<table class="invtable dtr-inline collapsed table display" id="inventoryTable">
			<thead>
				<tr>
					<th>TRANSACTION #</th>
					<th>STOCK ID</th>
					<th>ITEM NAME</th>
					<th>ITEM QTY</th>
					<th>TRANSACTION DATE</th>
					<th>DATE RECORDED</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		
		<!--Start of Modal DESTOCK-->
		<div class="modal fade bd-example-modal-lg" id="destock" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Consumption</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<!--Modal Content-->
					<form id="addItem" method="post" accept-charset="utf-8">
						<div class="modal-body">
							<a class="btn btn-xs" type="button" href="javascript:void(0)" data-toggle="modal"
								data-target="#destockbro"><b>Add Item</b></a>
							<br>
							<br>
							<div class="input-group mb-1">

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm"
											style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
											Consumption Date</span>
									</div>
									<input type="date" name="consumption_date" id="consumption_date" class="form-control form-control-sm" required>
									<span class="text-danger"><?php echo form_error("consumption_date"); ?></span>
								</div>
								</div>
							<div class="d-flex justify-content-center">
								<table class="destockTable table table-sm table-borderless" style="width:90%">
									<thead class="thead-light">
										<tr class="text-center">
											<th width="65%"><b>Item Name</b></th>
											<th width="*"><b>Quantity</b></th>
											<th width="20px"></th>
										</tr>
									</thead>
									<tbody id="destockBodyTable">
									</tbody>
								</table>
							</div>
							<!--Modal Footer-->
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn-sm"
									data-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-success btn-sm"
									onclick="addDestockItems()">Add</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
		<!--End of Modal DESTOCK-->
		<!--Start of Brochure Modal DESTOCK"-->
		<div class="modal fade bd-example-modal" id="destockbro" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Select Stockitems</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="destockitem" method="post" accept-charset="utf-8">
						<div class="modal-body">
							<div style="margin:1% 3%" id="list2">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-success btn-sm" data-dismiss="modal"
								onclick="getDestockStocks()">Ok</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--End of Brochure Modal DESTOCK"-->


		<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery-3.2.1.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/bootstrap.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/jquery.dataTables.js'?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/dataTables.bootstrap4.js'?>">
		</script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/baristaConsumptionBrochure.js'?>">
		</script>
		<script>
			var inventoryitems = [];
			$(function () {
				viewInventoryJs();
				//-----------------------Populate Brochure----------------------------------------
				$.ajax({
					url: '<?= site_url('barista/getConsumptionItems') ?>',
					dataType: 'json',
					success: function (data) {
						var poLastIndex = 0;
						stocks = data;
						setStockData(stocks);
					},
					failure: function () {
						console.log('None');
					},
					error: function (response, setting, errorThrown) {
						console.log(errorThrown);
						console.log(response.responseText);
					}
				});

			});

			function setStockData(stocks) {
				$("#list2").empty();
				$("#list2").append(`${stocks.map(stock => {
				return `<label style="width:96%"><input type="checkbox" name="stockchoice[]" class="choiceStock2 mr-2" value="${stock.stID}">${stock.stName}</label>`
			}).join('')}`);
			}
			//-----------------------End of Brochure Populate--------------------------	

			//POPULATE TABLE
			var table = $('#inventoryTable');

			function viewInventoryJs() {
				$.ajax({
					url: "<?= site_url('barista/inventoryJS') ?>",
					method: "post",
					dataType: "json",
					success: function (data) {
						inventoryitems = data;
						setInventoryData(inventoryitems);
						console.log(data);
					},
					error: function (response, setting, errorThrown) {
						console.log(response.responseText);
						console.log(errorThrown);
					}
				});
			}

			function setInventoryData() {
				if ($("#inventoryTable> tbody").children().length > 0) {
					$("#inventoryTable> tbody").empty();
				}
				inventoryitems.forEach(table => {
					$("#inventoryTable> tbody").append(`
					<tr data-stID="${table.tID}" data-stID="${table.stID}">
						<td>${table.tID}</td>
						<td>${table.stID}</td>
						<td>${table.tiName}</td>
						<td>${table.actualQty}</td>
						<td>${table.tDate}</td>
						<td>${table.dateRecorded}</td>
					</tr>`);
				});
			}
			//END OF POPULATING TABLE

			// 		//-----------------------Populate Dropdown----------------------------------------
			// 			$.ajax({
			// 				url: '<= site_url('barista/inventoryJS') ?>',
			// 				dataType: 'json',
			// 				success: function (data) {
			// 					var poLastIndex = 0;
			// 					stockitem = data;
			// 					setStockData(stockitem);
			// 				},
			// 				failure: function () {
			// 					console.log('None');
			// 				},
			// 				error: function (response, setting, errorThrown) {
			// 					console.log(errorThrown);
			// 					console.log(response.responseText);
			// 				}
			// 			});

			// 	function setStockData(stockitem){
			// 			$("#stockitems").empty();
			// 			$("#stockitems").append(`${stockitem.map(stocks => {
			// 				return `<option name= "stName" id ="stName" value="${stocks.stID}">${stocks.stName}</option>`
			// 			}).join('')}`);
			// 	}
			//   //-----------------------End of Dropdown Populate--------------------------	
		</script>
</body>

</html>