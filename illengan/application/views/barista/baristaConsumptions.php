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

							<!--Add  Consumption BUTTON-->
							<div class="col-md-4 col-lg-2">
							<a class="btn btn-primary btn-sm" href="<?= site_url('barista/consumption/formadd')?>" data-original-title style="margin:0"
                                    id="addBtn">Add Consumption</a>
							<!--eND Add  Consumption BUTTON-->
							</div>
						</div>
							<!--eND Add  Consumption BUTTON-->
							<br>
							<table id="consumptionTable" class="spoiltable table table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
								<thead class="thead-dark" style="font-weight:900">
									<th></th>
									<th>TRANSACTION #</th>
									<th>CONSUMPTION ITEM</th>
									<th>ACTUAL QUANTITY</th>
									<th>DATE CONSUMED</th>
									<th>OPERATION</th>
								
								</thead>
								<tbody id="spoilage_data">
								
								</tbody>
							</table>
							<div id="pagination" style="float:right"></div>
							<!--End Table Content-->

							<!--Delete Confirmation Box-->
							<div class="modal fade" id="deleteConsumption" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Delete  Consumption</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="confirmDelete">
											<div class="modal-body">
												<h6 id="deleteTableCode"></h6>
												<p>Are you sure you want to delete the selected consumption?</p>
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
							<!--Edit Consumption-->
							
							<div class="modal fade" id="editConsumption" name="editConsumption" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Consumption</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formEdit"  action="<?= site_url('barista/consumption/edit')?>" accept-charset="utf-8" > 
												<div class="modal-body">
                                                     <!-- Quantity-->
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
													<input name="stQty" id="stQty" hidden="hidden">
													<input name="stID" id="stID" hidden="hidden">
													<input name="ciID" id="ciID" hidden="hidden">
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

<!--End Table Content-->
<?php include_once('templates/scripts.php') ?>
<script>
	$(document).ready(function() {
	createPagination(0);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum);
	});
	function createPagination(pageNum){
		$.ajax({
			url: '<?=base_url()?>barista/loadConsumptionData/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $('#pagination').html(data.pagination);
                var cons = data.consumption;
				console.log(cons);
                setConsumptionData(cons);
			},
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});
	}
        
   });
	function setConsumptionData(table) {
            $("#consumptionTable > tbody").empty();
			for(t in table){
			var row=`<tr class="consumptionTabletr" data-tiActual="`+table[t].tiActual+`" data-stQty="${table[t].stQty}" data-tiRemarks="`+table[t].tiRemarks+`" data-tiDate="`+table[t].tiDate+`" data-stID="`+table[t].stID+`" data-ciID="`+table[t].ciID+`">`;
				row += `<td><a data-toggle="collapse" href="#collapseExample" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/barista/down-arrow%20(1).png" style="height:15px;width: 15px"/></a></td>`;
				row += `<td>`+table[t].tiID+`</td>`;
				row += `<td>`+table[t].stName+`</td>`;
				row += `<td>`+table[t].tiActual+`</td>`;
				row += `<td>`+table[t].tiDate+`</td>`;
                row += `<td>`;
				row += ` <!--Action Buttons-->
                        <div class="onoffswitch">

                            <!--Edit button-->
                            <button class="updateBtn btn btn-secondary btn-sm" data-toggle="modal"
                                data-target="#editConsumption">Edit</button>
                            <!--Delete button-->
                            <button class="item_delete btn btn-warning btn-sm" data-toggle="modal" 
                            data-target="#deleteConsumption">Archive</button>                      
                        </div>
                    </td>
				</tr>`;
                       

			var accordion = `<tr class="accordion" style="display:none;background: #f9f9f9">`;
            	accordion += ` <td colspan="7">`;
                accordion += `<div style="overflow:auto;display:none">`;
                accordion += `<div style="overflow:auto;">`;
				accordion += `<div style="margin:0 46px;overflow:auto;">`;
				accordion += `<b style="float:left;">Remarks: </b>`;
				accordion += `<p style="float:left;margin-left:2%">`;
				if(table[t].tiRemarks == null || table[t].tiRemarks == ''){
					accordion += `No remarks.`;
				}else{
					accordion += table[t].tiRemarks;
				}
				accordion += `
                                </p>
                            </div> 
                        </div>
                    </div>
                </td>
            </tr>
            `;
			$("#consumptionTable > tbody").append(row);
			$("#consumptionTable > tbody").append(accordion);
			
			$(".updateBtn").last().on('click', function () {
				
				$("#editConsumption").find("input[name='tiActual']").val($(this).closest("tr").attr(
					"data-tiActual")); 
				$("#editConsumption").find("input[name='stQty']").val($(this).closest("tr").attr(
					"data-stQty")); 
				$("#editConsumption").find("input[name='tiRemarks']").val($(this).closest("tr").attr(
					"data-tiRemarks"));
				$("#editConsumption").find("input[name='tiDate']").val($(this).closest("tr").attr(
					"data-tiDate"));	
				$("#editConsumption").find("input[name='stID']").val($(this).closest("tr").attr(
					"data-stID"));
				$("#editConsumption").find("input[name='ciID']").val($(this).closest("tr").attr(
					"data-ciID"));
				$("#editConsumption").find("input[name='actualQtyUpdate']").val($(this).closest("tr").attr(
					"data-tiActual"));
				
            });
            $(".item_delete").last().on('click', function () {
                $("#deleteConsumptionID").text(
                    `Delete consumption code ${$(this).closest("tr").attr("data-spoilname")}`);
				$("#deleteConsumption").find("input[name='tID']").val($(this).closest("tr").attr(
					"data-tID"));
				$("#deleteConsumption").find("input[name='stID']").val($(this).closest("tr").attr(
					"data-stID"));
				$("#deleteConsumption").find("input[name='tID']").val($(this).closest("tr").attr(
                    "data-tID"));
            });
			
		};
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
    $("#editConsumption form").on('submit', function(event) {
		event.preventDefault();
		var tiActual = $(this).find("input[name='tiActual']").val();
		var stQty = $(this).find("input[name='stQty']").val(); 
        var tiRemarks = $(this).find("input[name='tiRemarks']").val();
        var tiDate = $(this).find("input[name='tiDate']").val();
        var stID = $(this).find("input[name='stID']").val();
		var ciID = $(this).find("input[name='ciID']").val();
		var actualQtyUpdate = $(this).find("input[name='actualQtyUpdate']").val();
		console.log(ciID);

        $.ajax({
            url: "<?= site_url("barista/consumption/edit")?>",
            method: "post",
            data: {
				tiActual: tiActual,
				stQty: stQty,
				tiRemarks: tiRemarks,
				tiDate: tiDate,
				stID: stID,
				ciID: ciID,
				actualQtyUpdate: actualQtyUpdate
            },
            dataType: "json",
            success: function(data) {
                alert(' Consumption Updated');
				console.log(data);
            },
            complete: function() {
                $("#editConsumption").modal("hide");
				location.reload();
            },
            error: function(error) {
				console.log(error);
            }
        });
    });

	//--------------------End of Function for Edit-----------------------------
	// Function for Delete
	
	$("#deleteConsumption form").on('submit', function(event) {
		event.preventDefault();
		var delRemarks =$(this).find("input[name='delRemarks']").val();
		var tID =$(this).find("input[name='tID']").val();
        $.ajax({
                url: '<?= site_url('barista/consumption/delete') ?>',
                method: 'POST',
                data: {
					tID: tID,
					delRemarks:delRemarks
                },
                dataType: 'json',
                complete: function() {
                $("#deleteConsumption").modal("hide");
				location.reload();
                }
            });
        });
	});

	//End Function Delete

</script> 
</body>

</html>
