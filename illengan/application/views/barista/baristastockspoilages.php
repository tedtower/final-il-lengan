<body style="background:white">
<div class="content">
	<div class="container-fluid">
		<br>
		<p style="text-align:right; font-weight: regular; font-size: 16px">
			<!-- Real Time Date & Time -->
			<?php echo date("M j, Y -l"); ?>
		</p>
			<div class="container-fluid">
				<div class="content">
					<div class="container-fluid">
						<!--Table-->
						<div class="card-content">

							<!--Add Stock Spoilage BUTTON-->
							<div class="col-md-4 col-lg-2">
							<!-- <button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#addStockSpoilage" data-original-title style="margin:0;">Add Stock Spoilage</button><br> -->
							<a class="btn btn-primary btn-sm" href="<?= site_url('barista/stock/spoilage/formadd')?>" data-original-title style="margin:0"
                                    id="addBtn">Add Spoilage</a>
							<!--eND Add Stock Spoilage BUTTON-->
							</div>
						</div>
							<!--eND Add Stock Spoilage BUTTON-->
							<br>
							<table id="spoilagesTable" class="spoiltable table table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
								<thead class="thead-dark" style="font-weight:900">
									<th></th>
									<th>TRANSACTION #</th>
									<th>STOCK ITEM</th>
									<th>QUANTITY</th>
									<th>ACTUAL QUANTITY</th>
									<th>DATE SPOILED</th>
									<th>OPERATION</th>
								
								</thead>
								<tbody id="spoilage_data">
								</tbody>
							</table>
							<!--End Table Content-->

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
												<input type="text" name="tID" hidden="hidden">
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
												<button type="submit" class="btn btn-danger btn-sm">Archive</button>
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
                                            <form id="formEdit"  action="<?= site_url('barista/stock/spoilage/edit')?>" accept-charset="utf-8" > 
												<div class="modal-body">
                                                     <!-- Quantity-->
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Quantity</span>
                                                        </div>
                                                        <input type="number" min="1" name="updateTiQty" id="updateTiQty" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("updateTiQty"); ?></span>
                                                    </div>
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                               Actual Quantity</span>
                                                        </div>
                                                        <input type="number" min="1" name="actualQtyUpdate" id="actualQtyUpdate" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("actualQtyUpdate"); ?></span>
                                                    </div>
                                                    <!--Date Spoiled-->
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Date Spoiled</span>
                                                        </div>
                                                        <input type="date" name="tiDate" id="tiDate" class="form-control form-control-sm" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
                                                        <span class="text-danger"><?php echo form_error("tDate"); ?></span>
                                                    </div>
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <input type="text" name="tiRemarks" id="tiRemarks" class="form-control form-control-sm">
                                                        <span class="text-danger"><?php echo form_error("ssRemarks"); ?></span>
                                                    </div>
													<input name="tiActual" id="tiActual" hidden="hidden">
													<input name="tiQty" id="tiQty" hidden="hidden">
													<input name="stQty" id="stQty" hidden="hidden">
													<input name="stID" id="stID" hidden="hidden">
													<input name="siID" id="siID" hidden="hidden">
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
	</div>
</div>
<!--End Table Content-->
<?php include_once('templates/scripts.php') ?>
<script>
	var spoilages = [];
	$(function() {
		viewSpoilagesJs();


	//POPULATE TABLE
	var table = $('#spoilagesTable');
	
	function viewSpoilagesJs() {
        $.ajax({
            url: "<?= site_url('barista/spoilagesstockjson') ?>",
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
	});
	function setSpoilagesData() {
        if ($("#spoilagesTable> tbody").children().length > 0) {
            $("#spoilagesTable> tbody").empty();
        }
        spoilages.forEach(table => {
            $("#spoilagesTable > tbody").append(`
			<tr class="spoilagesTabletr" data-tiActual="${table.tiActual}" data-tiQty="${table.tiQty}" data-stQty="${table.stQty}" data-tiRemarks="${table.tiRemarks}" data-tiDate="${table.tiDate}" data-stID="${table.stID}" data-siID="${table.siID}">
				<td><a data-toggle="collapse" href="#collapseExample" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/barista/down-arrow%20(1).png" style="height:15px;width: 15px"/></a></td>
				<td>${table.tiID}</td>
				<td>${table.stName}</td>
				<td>${table.tiQty}</td>
				<td>${table.tiActual}</td>
				<td>${table.tiDate}</td>
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
								${table.tiRemarks == null || table.tiRemarks == '' ?  "No remarks." : table.tiRemarks}
                                </p>
                            </div> 
                        </div>
                    </div>
                </td>
            </tr>
            `;
			
			
			$(".updateBtn").last().on('click', function () {
				
				$("#editSpoil").find("input[name='tiActual']").val($(this).closest("tr").attr(
					"data-tiActual")); 
				$("#editSpoil").find("input[name='stQty']").val($(this).closest("tr").attr(
					"data-stQty")); 
				$("#editSpoil").find("input[name='tiRemarks']").val($(this).closest("tr").attr(
					"data-tiRemarks"));
				$("#editSpoil").find("input[name='tiDate']").val($(this).closest("tr").attr(
					"data-tiDate"));	
				$("#editSpoil").find("input[name='stID']").val($(this).closest("tr").attr(
					"data-stID"));
				$("#editSpoil").find("input[name='siID']").val($(this).closest("tr").attr(
					"data-siID"));
				$("#editSpoil").find("input[name='actualQtyUpdate']").val($(this).closest("tr").attr(
					"data-tiActual"));
				$("#editSpoil").find("input[name='updateTiQty']").val($(this).closest("tr").attr(
					"data-tiQty"));
				$("#editSpoil").find("input[name='tiQty']").val($(this).closest("tr").attr(
					"data-tiQty"));

				
            });
            $(".item_delete").last().on('click', function () {
                $("#deleteSpoilageId").text(
                    `Delete spoilage code ${$(this).closest("tr").attr("data-spoilname")}`);
				$("#deleteSpoilage").find("input[name='tID']").val($(this).closest("tr").attr(
					"data-tID"));
				$("#deleteSpoilage").find("input[name='stID']").val($(this).closest("tr").attr(
					"data-stID"));
				$("#deleteSpoilage").find("input[name='tID']").val($(this).closest("tr").attr(
                    "data-tID"));
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
		var tiActual = $(this).find("input[name='tiActual']").val();
		var updateTiQty = $(this).find("input[name='updateTiQty']").val();
		var tiQty = $(this).find("input[name='tiQty']").val();
		var stQty = $(this).find("input[name='stQty']").val(); 
        var tiRemarks = $(this).find("input[name='tiRemarks']").val();
        var tiDate = $(this).find("input[name='tiDate']").val();
        var stID = $(this).find("input[name='stID']").val();
		var siID = $(this).find("input[name='siID']").val();
		var actualQtyUpdate = $(this).find("input[name='actualQtyUpdate']").val();
		console.log(tiQty);
		console.log(updateTiQty);
		console.log(tiActual);
		console.log(actualQtyUpdate);

        $.ajax({
            url: "<?= site_url("barista/stock/spoilage/edit")?>",
            method: "post",
            data: {
				tiActual: tiActual,
				tiQty:tiQty,
				updateTiQty:updateTiQty,
				stQty: stQty,
				tiRemarks: tiRemarks,
				tiDate: tiDate,
				stID: stID,
				siID: siID,
				actualQtyUpdate: actualQtyUpdate
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

	//--------------------End of Function for Edit-----------------------------
	// Function for Delete
	
	$("#deleteSpoilage form").on('submit', function(event) {
		event.preventDefault();
		var delRemarks =$(this).find("input[name='delRemarks']").val();
		var tID =$(this).find("input[name='tID']").val();
        $.ajax({
                url: '<?= site_url('barista/stock/spoilage/delete') ?>',
                method: 'POST',
                data: {
					tID: tID,
					delRemarks:delRemarks
                },
                dataType: 'json',
                complete: function() {
                $("#deleteSpoilage").modal("hide");
				location.reload();
                }
            });
        });
	});

	//End Function Delete

</script> 
</body>

</html>