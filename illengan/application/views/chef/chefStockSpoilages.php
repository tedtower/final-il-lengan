<!DOCTYPE html>
<html>
    <head>
        <?php include_once('head.php') ?>
	</head>
	<body style="background:white">
	<?php include_once('navigation.php') ?>
<div class="content">
	<div class="container-fluid">
		<br>
		<p style="text-align:right; font-weight: regular; font-size: 16px">
			<!-- Real Time Date & Time -->
			<?php echo date("M j, Y -l"); ?>
		</p>
		<!-- <div div class="content" style="margin-left:100px;"> -->
			<div class="container-fluid">
				<div class="content">
					<div class="container-fluid">
						<!--Table-->
						<div class="card-content">

							<!--Add Stock Spoilage BUTTON-->
							<div class="row">
    <div class="col-md-4 col-lg-2">
							<button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#addStockSpoilage" data-original-title style="margin:0;">Add Stock Spoilage</button><br>
							<!--eND Add Stock Spoilage BUTTON-->
							</div>
  </div>
							<br>
							<table id="spoilagesTable" class="spoiltable table table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
								<thead class="thead-dark" style="font-weight:900">
									<th></th>
									<th>TRANSACTION #</th>
									<th>STOCK ITEM</th>
									<th>QUANTITY</th>
									<th>DATE SPOILED</th>
									<th>DATE RECORDED</th>
									<th>OPERATION</th>
								
								</thead>
								<tbody id="spoilage_data">
								</tbody>
							</table>
							<!--End Table Content-->
							<!--Start of Modal "Add Stock Spoilages"-->
							<div class="modal fade bd-example-modal-lg" id="addStockSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Add Spoilage</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="formAdd" action="<?= site_url('barista/stock/spoilages/add')?>" accept-charset="utf-8">
											<div class="modal-body">
												<div class="form-row">
													<!--Container of Stock Spoilage Date-->
													<!--Spoilage Date-->
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
																Spoilage Date</span>
														</div>
														<input type="datetime-local" name="tDate" id="tDate" class="form-control form-control-sm" required>
													</div>
												</div>
												<!--Add Stock Item-->
												<!--Button to add row in the table-->
												<!--Button to add launche the brochure modal-->
												<a class="addSpoilageItem btn btn-default btn-sm" data-toggle="modal" data-target="#brochureSS" data-original-title style="margin:0" id="addStockSpoilage">Add Spoilage Items</a>
												<br><br>
												<table class="stockSpoilageTable table table-sm table-borderless">
													<!--Table containing the different input fields in adding stock spoilages -->
													<thead class="thead-light">
														<tr>
															<th>Name</th>
															<th width="20%">Qty</th>
															<th>Remarks</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
												<!--Total of the trans items-->
					
												<div class="modal-footer">
													<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
													<button type="button" class="btn btn-success btn-sm" onclick="addStockItems()">Add</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!--End of Modal "Add Stock Spoilage"-->

							<!--Start of Brochure Modal"-->
                            <div class="modal fade bd-example-modal" id="brochureSS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Select Variance</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="formAdd"  method="post" accept-charset="utf-8">
                                            <div class="modal-body">
                                                <div style="margin:1% 3%" id="list">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
												<button type="button" class="btn btn-danger btn-sm"
													data-dismiss="modal">Cancel</button>
												<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="getSelectedStocks()">Ok</button>
											</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!--End of Brochure Modal"-->

							<!--Delete Confirmation Box-->
							<div class="modal fade" id="deleteSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Delete Stock Spoilage</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="confirmDelete">
											<div class="modal-body">
												<h6 id="deleteTableCode"></h6>
												<p>Are you sure you want to delete the selected stock spoilages?</p>
												<input type="text" name="tiID" hidden="hidden">
												<div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <input type="text" name="delRemarks" id="delRemarks" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("delRemarks"); ?></span>
                                                </div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-danger btn-sm">Delete</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!--End of Delete Modal-->
							<!--Edit Spoilage-->
							
							<div class="modal fade" id="editSpoil" name="editSpoil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Spoilage</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formEdit" accept-charset="utf-8" > 
												<div class="modal-body">
                                                    <!-- Quantity-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Quantity</span>
                                                        </div>
                                                        <input type="number" min="1" name="ssQtyUpdate" id="ssQtyUpdate" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("ssQtyUpdate"); ?></span>
                                                    </div>
                                                    <!--Date Spoiled-->
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Date Spoiled</span>
                                                        </div>
                                                        <input type="datetime-local" name="tDate" id="tDate" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("tDate"); ?></span>
                                                    </div>
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <input type="text" name="tRemarks" id="tRemarks" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("ssRemarks"); ?></span>
                                                    </div>
													<input name="stID" id="stID" hidden="hidden">
													<input name="tiID" id="tiID" hidden="hidden">
													<input name="stQty" id="stQty" hidden="hidden">
													<input name="dateRecorded" id="dateRecorded" hidden="hidden">
                                                    <!--Footer-->
                                                    <div class="modal-footer">
													<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                            		<button class="btn btn-success btn-sm" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>

							
							<!--End of Edit Modal-->
						</div>
					</div>
				</div>
			</div>
		<!-- </div> -->
	</div>
</div>
<!--End Table Content-->
<?php include_once('scripts.php') ?>
<script src="<?= chef_js().'addStockSpoilBrochure.js'?>"></script>
<script>
	var spoilages = [];
	var stockchoice = [];
	$(function() {
		viewSpoilagesJs();
//-----------------------Populate Brochure----------------------------------------
		$.ajax({
				url: '<?= site_url('chef/viewStockJS') ?>',
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
	function setStockData(stocks){
			$("#list").empty();
			$("#list").append(`${stocks.map(stock => {
				return `<label style="width:96%"><input type="checkbox" name="stockchoice[]" class="choiceStock mr-2" value="${stock.stID}">${stock.stName}</label>`
			}).join('')}`);
	}
	//-----------------------End of Brochure Populate--------------------------	
	//POPULATE TABLE
	var table = $('#spoilagesTable');
	
	function viewSpoilagesJs() {
        $.ajax({
            url: "<?= site_url('chef/spoilagesstockjson') ?>",
			method: "post",
            dataType: "json",
            success: function(data) {
                spoilages = data;
                setSpoilagesData(spoilages);
            },
            error: function(response, setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
        });
	}
	function setSpoilagesData() {
        if ($("#spoilagesTable> tbody").children().length > 0) {
            $("#spoilagesTable> tbody").empty();
        }
        spoilages.forEach(table => {
            $("#spoilagesTable > tbody").append(`
			<tr class="spoilagesTabletr" data-actualQty="${table.actualQty}" data-stID="${table.stID}" data-tiID="${table.tiID}" data-spoilname="${table.tiName}" data-stQty="${table.stQty}" data-dateRecorded="${table.actualQty}" data-tDate="${table.tDate}" data-tRemarks="${table.tRemarks}">
				<td><a data-toggle="collapse" href="#collapseExample" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/barista/down-arrow%20(1).png" style="height:15px;width: 15px"/></a></td>
				<td>${table.tID}</td>
				<td>${table.tiName}</td>
				<td>${table.actualQty}</td>
				<td>${table.tDate}</td>
				<td>${table.dateRecorded}</td>
                <td>
                        <!--Action Buttons-->
                        <div class="onoffswitch">

                            <!--Edit button-->
                            <button class="updateBtn btn btn-secondary btn-sm" data-toggle="modal"
                                data-target="#editSpoil">Edit</button>
                            <!--Delete button-->
                            <button class="item_delete btn btn-warning btn-sm" data-toggle="modal" 
                            data-target="#deleteSpoilage">Archive</button>                      
                        </div>
                    </td>
				</tr>`);

			var accordion = `
            <tr class="accordion" style="display:none;background: #f9f9f9">
                <td colspan="7"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="overflow:auto;"> <!-- description, preferences, and addons container -->
                            <div style="margin:0 46px;overflow:auto;">
							<b style="float:left;">Remarks: </b><!-- label-->
								<p style="float:left;margin-left:2%">
								${table.tRemarks == null || table.tRemarks == '' ?  "No remarks." : table.tRemarks}
                                </p>
                            </div> 
                        </div>
                    </div>
                </td>
            </tr>
            `;

			
			$(".updateBtn").last().on('click', function () {
				
                $("#editSpoil").find("input[name='tID']").val($(this).closest("tr").attr(
					"data-tID"));
				$("#editSpoil").find("input[name='tiID']").val($(this).closest("tr").attr(
					"data-tiID")); 
				$("#editSpoil").find("input[name='tDate']").val($(this).closest("tr").attr(
					"data-tDate"));
				$("#editSpoil").find("input[name='ssQtyUpdate']").val($(this).closest("tr").attr(
					"data-actualQty"));
				$("#editSpoil").find("input[name='tRemarks']").val($(this).closest("tr").attr(
					"data-tRemarks"));
            });
            $(".item_delete").last().on('click', function () {
                $("#deleteSpoilageId").text(
                    `Delete spoilage code ${$(this).closest("tr").attr("data-spoilname")}`);
				$("#deleteSpoilage").find("input[name='tiID']").val($(this).closest("tr").attr(
                    "data-tiID"));
            });
			$("#spoilagesTable > tbody").append(accordion);
		});
		$(".accordionBtn").on('click', function(){
            if($(this).closest("tr").next(".accordion").css("display") == 'none'){
                $(this).closest("tr").next(".accordion").css("display","table-row");
				$(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
			
            }else{
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        	});
	}
	//END OF POPULATING TABLE
	//-------------------------Function for Edit-------------------------------

	$(document).ready(function() {
    $("#editSpoil form").on('submit', function(event) {
		event.preventDefault();
		var tID = $(this).find("input[name='tID']").val();
		var tiID = $(this).find("input[name='tiID']").val(); 
		var iniActQty = $(this).find("input[name='actualQty']").val(); 
        var ssQtyUpdate = $(this).find("input[name='ssQtyUpdate']").val();
        var tDate = $(this).find("input[name='tDate']").val();
        var tRemarks = $(this).find("input[name='tRemarks']").val();
      
        $.ajax({
            url: "<?= site_url("chef/spoilages/stock/edit")?>",
            method: "post",
            data: {
				stID: stID,
				tiID: tiID,
				stQty: stQty,
				stQtyUpdate: stQtyUpdate,
				dateRecorded: dateRecorded,
                tDate: tDate,
                tRemarks: tRemarks   
            },
            dataType: "json",
            success: function(data) {
                alert('Stock Spoilage Updated');
				console.log(data);
            },
            complete: function() {
                $("#editSpoil").modal("hide");
				location.reload();
            },
            error: function(error) {
                console.log(error);
            }
            
        });
    });
});
	//--------------------End of Function for Edit-----------------------------
	// Function for Delete
	
    $("#confirmDelete").on('submit', function(event) {
		event.preventDefault();
		var delRemarks =$(this).find("input[name='delRemarks']").val();
        $.ajax({
                url: '<?= site_url('admin/stock/spoilage/delete') ?>',
                method: 'POST',
                data: {
					tiID: tiID,
					delRemarks:delRemarks
                },
                dataType: 'json',
                success: function(data) {
                    accounts = data;
                    setAccountData();
                },
                complete: function() {
                $("#deleteSpoilage").modal("hide");
				location.reload();
                }
            });
        });

	//End Function Delete

</script> 
</body>

</html>