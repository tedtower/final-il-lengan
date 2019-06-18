<body style="background:white">
<div class="content">
	<div class="container-fluid">
		<br>
		<p style="text-align:right; font-weight: regular; font-size: 16px">
			<!-- Real Time Date & Time -->
			<?php echo date("M j, Y -l"); ?>
		</p>
		<div div class="content" style="margin-left:250px;">
			<div class="container-fluid">
				<div class="content">
					<div class="container-fluid">
						<!--Table-->
						<div class="card-content">

							<!--Add Menu Spoilage BUTTON-->
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMenuSpoilage" data-original-title style="margin:0">Add Menu Spoilage</button><br>
							<!--eND Add Menu Spoilage BUTTON-->
							<br>
							<table id="menuTable" class="spoiltable table table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
								<thead class="thead-dark">
									<th>ITEM NAME</th>
									<th>QUANTITY</th>
									<th>DATE SPOILED</th>
									<th>DATE RECORDED</th>
									<th>OPERATION</th>
								</thead>
								<tbody id="menu_data">
								</tbody>
							</table>
							<!--End Table Content-->
							<!--Start of Modal "Add Menu Spoilages"-->
							<div class="modal fade bd-example-modal-lg" id="addMenuSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Add Spoilage</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="formAdd" action="<?= site_url('admin/menu/spoilages/add')?>" accept-charset="utf-8">
											<div class="modal-body">
												<div class="form-row">
													<!--Container of Menu Spoilage Date-->
													<!--Spoilage Date-->
													<div class="input-group mb-3">
														<div class="input-group-prepend">
															<span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
																Spoilage Date</span>
														</div>
														<input type="date" name="spoilDate" id="spoilDate" class="form-control form-control-sm" required>
													</div>
												</div>
												<!--Add Menu Item-->
												<!--Button to add row in the table-->
												<!--Button to add launche the brochure modal-->
												<a class="addSpoilageItem btn btn-default btn-sm" data-toggle="modal" data-target="#brochureSS" data-original-title style="margin:0" id="addMenuSpoilage">Add Spoilage Items</a>
												<br><br>
												<table class="menuspoilageTable table table-sm table-borderless">
													<!--Table containing the different input fields in adding menu spoilages -->
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
													<button type="button" class="btn btn-success btn-sm" onclick="addMenuItems()">Add</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!--End of Modal "Add Menu Spoilage"-->

							<!--Start of Brochure Modal"-->
                            <div class="modal fade bd-example-modal" id="brochureSS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Select Preferences</h5>
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
												<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="getSelectedPref()">Ok</button>
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
											<h5 class="modal-title" id="exampleModalLongTitle">Delete Menu Spoilage</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="confirmDelete">
											<div class="modal-body">
												<h6 id="deleteTableCode"></h6>
												<p>Are you sure you want to delete the selected menu spoilages?</p>
												<input type="text" name="tableCode" hidden="hidden">
												<div>
													Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm" required>
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
							<div class="modal fade" id="editSpoil" name="editSpoil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
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
                                                    <!--Quantity-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Quantity</span>
                                                        </div>
                                                        <input type="number" min="1" name="msQty" id="msQty" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("msQty"); ?></span>
                                                    </div>
                                                    <!--Date Spoiled-->
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Date Spoiled</span>
                                                        </div>
                                                        <input type="date" name="msDate" id="msDate" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("msDate"); ?></span>
                                                    </div>
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <input type="text" name="msRemarks" id="msRemarks" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("msRemarks"); ?></span>
                                                    </div>
													<input name="msID" id="msID" hidden="hidden">
													<input name="prID" id="prID" hidden="hidden">
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
</div>
<!--End Table Content-->
<?php include_once('templates/scripts.php') ?>
<script src="<?= admin_js().'addMenuSpoilBrochure.js'?>"></script>
<script>
	var spoilages = [];
	var menuchoice = [];
	$(function() {
		viewSpoilagesJs();
//-----------------------Populate Brochure----------------------------------------
		$.ajax({
				url: '<?= site_url('admin/menu/spoilages/viewMenuJS') ?>',
				dataType: 'json',
				success: function (data) {
					var poLastIndex = 0;
					menus = data;
					setMenuData(menus);
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
	function setMenuData(menus){
			$("#list").empty();
			$("#list").append(`${menus.map(menu => {
				return `<label style="width:96%"><input type="checkbox" name="menuchoice[]" class="choiceMenu mr-2" value="${menu.prID}">${menu.prName}</label>`
			}).join('')}`);
	}
	//-----------------------End of Brochure Populate--------------------------		
	//POPULATE TABLE
	var table = $('#menuTable');
	function viewSpoilagesJs() {
        $.ajax({
            url: "<?= site_url('admin/spoilagesmenujson') ?>",
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
        if ($("#menuTable> tbody").children().length > 0) {
            $("#menuTable> tbody").empty();
        }
        spoilages.forEach(table => {
            $("#menuTable> tbody").append(`
            <tr data-prID="${table.prID}" data-msID="${table.msID}" data-msQty="${table.msQty}" data-msDate="${table.msDate}" data-msRemarks="${table.msRemarks}" >
				<td><a data-toggle="collapse" href="#collapseExample" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>${table.mName}</td>
                <td>${table.msQty}</td>
				<td>${table.msDate}</td>
				<td>${table.msDateRecorded}</td>
                <td>
                        <!--Action Buttons-->
                        <div class="onoffswitch">

                            <!--Edit button-->
                            <button class="updateBtn btn btn-secondary btn-sm" data-toggle="modal"
                                data-target="#editSpoil">Edit</button>
                            <!--Delete button-->
                            <button class="item_delete btn btn-warning btn-sm" data-toggle="modal" 
                            data-target="#deleteSpoilage">Archived</button>                      
                        </div>
                    </td>
                </tr>`);

				var accordion = `
            <tr class="accordion" style="display:none;background: #f9f9f9">
                <td colspan="6"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
					<div style="overflow:auto;"> <!-- description, preferences, and addons container -->
                            <div style="margin:0 46px;overflow:auto;">
							<b style="float:left;">Remarks: </b><!-- label-->
								<p style="float:left;margin-left:2%">
								${table.msRemarks == null || table.msRemarks == '' ? "No remarks." : table.msRemarks}
                                </p>
                            </div> 
                        </div>
                    </div>
                </td>
            </tr>
            `;
            $(".updateBtn").last().on('click', function () {
				$("#editSpoil").find("input[name='prID']").val($(this).closest("tr").attr(
                    "data-prID"));
                $("#editSpoil").find("input[name='msID']").val($(this).closest("tr").attr(
                    "data-msID"));
				$("#editSpoil").find("input[name='msQty']").val($(this).closest("tr").attr(
					"data-msQty"));
				$("#editSpoil").find("input[name='msDate']").val($(this).closest("tr").attr(
					"data-msDate"));
				$("#editSpoil").find("input[name='msRemarks']").val($(this).closest("tr").attr(
					"data-msRemarks"));
            });
            $(".item_delete").last().on('click', function () {
                $("#deleteSpoilageId").text(
                    `Delete spoilage code ${$(this).closest("tr").attr("data-spoilname")}`);
                $("#deleteSpoilage").find("input[name='prID']").val($(this).closest("tr").attr(
					"data-id"));
				$("#deleteSpoilage").find("input[name='msID']").val($(this).closest("tr").attr(
                    "data-id"));
            });
			$("#menuTable > tbody").append(accordion);
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
		var msID = $(this).find("input[name='msID']").val();
        var prID = $(this).find("input[name='prID']").val();
        var msQty = $(this).find("input[name='msQty']").val();
        var msDate = $(this).find("input[name='msDate']").val();
        var msRemarks = $(this).find("input[name='msRemarks']").val();
       
        $.ajax({
            url: "<?= site_url("admin/menu/spoilage/edit")?>",
            method: "post",
            data: {
				msID: msID,
                prID : prID,
                msQty: msQty,
                msDate: msDate,
                msRemarks: msRemarks
            },
            dataType: "json",
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
	
</script> 
</body>

</html>