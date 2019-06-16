<html>

<head>
	<?php include_once('templates/head.php') ?>
</head>

<body>
	<?php include_once('templates/navigation.php') ?>
	<!--End Top Nav-->
	<div class="container">
		<div class="d-flex d-inline-block p-0">
			<!--Restock BUTTON-->
			<a class="btn btn-primary" data-toggle="modal" data-target="#restock" data-original-title
				style="margin:2px">Restock</a><br>
			<!--eND Restock BUTTON-->
			<!--Destock BUTTON-->
			<a class="btn btn-primary" data-toggle="modal" data-target="#destock" data-original-title
				style="margin:2px">Destock</a><br>
			<!--eND Destock BUTTON-->
		</div>
		<br>
		<table class="invtable dtr-inline collapsed table display" id="inventoryTable">
			<thead>
				<tr>
					<th>Item Name</th>
					<th>Item Status</th>
					<th>Item Qty</th>
					<th>Item Status</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		<!--Start of Modal RESTOCK-->
		<div class="modal fade bd-example-modal-lg" id="restock" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Restock</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<!--Modal Content-->
					<form id="addItem" method="post" accept-charset="utf-8">
						<div class="modal-body">
							<a class="btn btn-default btn-sm" href="javascript:void(0)" data-toggle="modal"
								data-target="#restockbro"><b>Add Item</b></a>
							<br>
							<br>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-sm"
										style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
										Restock Date</span>
								</div>
								<input type="date" name="restock_date" id="restock_date" class="form-control form-control-sm" required>
								<span class="text-danger"><?php echo form_error("restock_date"); ?></span>
							</div>
							<div class="d-flex justify-content-center">
								<table class="restockTable table table-sm table-borderless" style="width:90%">
									<thead class="thead-light">
										<tr class="text-center">
											<th width="65%"><b>Item Name</b></th>
											<th width="*"><b>Quantity</b></th>
											<th width="20px"></th>
										</tr>
									</thead>
									<tbody id="restockBodyTable">
									</tbody>
								</table>
							</div>
							<!--Modal Footer-->
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn-sm"
									data-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-success btn-sm"
									onclick="addRestockItems()">Add</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--End of Modal RESTOCK-->
		<!--Start of Brochure Modal RESTOCK"-->
		<div class="modal fade bd-example-modal" id="restockbro" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Select Stockitems</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="restockitem" method="post" accept-charset="utf-8">
						<div class="modal-body">
							<div style="margin:1% 3%" id="list">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-success btn-sm" data-dismiss="modal"
								onclick="getRestockStocks()">Ok</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--End of Brochure Modal RESTOCK"-->
		<!--Start of Modal DESTOCK-->
		<div class="modal fade bd-example-modal-lg" id="destock" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Destock</h5>
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
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-sm"
										style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
										Destock Type</span>
								</div>
								<select class="custom-select" name="destock_type" id="destock_type" required>
									<option value="consumed" selected>Consumed</option>
									<option value="spoilage">Spoilage</option>
								</select>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="inputGroup-sizing-sm"
											style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
											Destock Date</span>
									</div>
									<input type="date" name="destock_date" id="destock_date" class="form-control form-control-sm" required>
									<span class="text-danger"><?php echo form_error("destock_date"); ?></span>
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
		<script type="text/javascript" src="<?php echo base_url().'assets/js/barista/baristaInventoryBrochure.js'?>">
		</script>
		<script>
			var inventoryitems = [];
			$(function () {
				viewInventoryJs();
				//-----------------------Populate Brochure----------------------------------------
				$.ajax({
					url: '<?= site_url('barista/inventoryJS') ?>',
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
				$("#list").empty();
				$("#list").append(`${stocks.map(stock => {
				return `<label style="width:96%"><input type="checkbox" name="stockchoice[]" class="choiceStock mr-2" value="${stock.stID}">${stock.stName}</label>`
			}).join('')}`);
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
					<tr data-stID="${table.stID}" data-stID="${table.stID}">
						<td>${table.stName}</td>
						<td>${table.stStatus}</td>
						<td>${table.stQty}</td>
						<td>${table.stStatus}</td>
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