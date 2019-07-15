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
							<div class="card-content" id="menuTable">
								<!--Add Menu Spoilage BUTTON-->
								<a  class="btn btn-primary btn-sm" href="<?= site_url('admin/menuspoilage/formadd')?>" data-original-title style="margin:0; width:20%;"
                                                id="addBtn">Add Menu Spoilage</a><br>
								<!--eND Add Menu Spoilage BUTTON-->
								<!--Search-->
                                <div id="menuTable" style="width:25%; float:right; border-radius:5px">
                                    <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                </div>
								<br><br>
								<div id="pagination"></div>
                                <!--Table Body-->
								<table id="menuTable" class="spoiltable table table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
									<thead class="thead-dark">
										<th>ITEM NAME</th>
										<th>Order Slip No.</th>
										<th>QUANTITY</th>
										<th>DATE SPOILED</th>
										<th>DATE RECORDED</th>
										<th>OPERATION</th>
									</thead>
									<tbody>
									</tbody>
								</table>
								<!--End Table Content-->
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
                                            <form id="editSpoil" accept-charset="utf-8"> 
												<div class="modal-body">
													 <!--Quantity-->
												<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Current Quantity</span>
                                                        </div>
                                                        <input type="text" name="msoldQty" id="msoldQty" class="form-control form-control-sm" readonly>
														<span class="text-danger"><?php echo form_error("msQty"); ?></span>
														<div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                New Quantity</span>
                                                        </div>
                                                        <input type="number" min="1" name="msQty" id="msQty" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("msQty"); ?></span>
                                                    </div>
													<!--Date Spoiled-->
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:150px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Current Date Spoiled</span>
                                                        </div>
                                                        <input type="text" name="msoldDate" id="msoldDate" class="form-control form-control-sm" readonly/>
                                                        <span class="text-danger"><?php echo form_error("msDate"); ?></span>
													</div>
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                New Date Spoiled</span>
                                                        </div>
                                                        <input type="hidden" name="currentDate" id="currentDate" value="<?php echo date('Y-m-d')?>"/>
                                                        <input type="date" name="msDate" id="msDate" class="form-control form-control-sm" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
                                                        <span class="text-danger"><?php echo form_error("msDate"); ?></span>
                                                    </div>
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Orderslip No.</span>
                                                        </div>
                                                        <input list="orderslips" type="number" name="osID" id="osID"/>
                                                        <datalist id="orderslips">
                                                            <option value="">None</option>
                                                            <?php foreach($slip as $s){ 
                                                            echo '<option value="'.$s['osID'].'">'.$s['osID'].'</option>';
                                                            }?>
                                                        </datalist>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <input type="text" name="msRemarks" id="msRemarks" class="form-control form-control-sm">
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
			url: '<?=base_url()?>admin/menuspoilage/loadDataMenuSpoil/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $('#pagination').html(data.pagination);
                var menuitems = data.menuspoiled;
				console.log(menuitems);
                setMenuSpoilData(menuitems);
			},
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});
	}
        
   });

function setMenuSpoilData(data) {
    $("#menuTable > tbody").empty();
        for(mesp in data){
            var osID;
                if(data[mesp].osID === null){
                    osID = 'No order slip.';
                }else{
                    osID = data[mesp].osID;
                }
            var row1 = `<tr data-msID="`+data[mesp].msID+`" data-prID="`+data[mesp].prID+`" data-sID="`+data[mesp].sID+`"
			data-msQty="`+data[mesp].msQty+`" data-msDate="`+data[mesp].msDate+`" data-msRemarks="`+data[mesp].msRemarks+`" data-osID="`+osID+`">`;
                row1 += `<td><a data-toggle="collapse" href="#collapseExample" class="ml-2 mr-4"><img class="accordionBtn" 
				src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>`+data[mesp].prName+`</td>`;
				row1 += `<td>`+osID+`</td>`;
                row1 += `<td >`+data[mesp].msQty+`</td>`;
                row1 += `<td >`+data[mesp].msDate+`</td>`;
                row1 += `<td>`+data[mesp].msDateRecorded+`</td>`;
                row1 += `<td>
                <button class="updateBtn btn btn-secondary btn-sm" data-toggle="modal"
                                data-target="#editSpoil">Edit</button>
                            <!--Delete button-->
                <button class="item_delete btn btn-warning btn-sm" data-toggle="modal" 
                            data-target="#deleteSpoilage">Archived</button>
                </td></tr>`;
            var accord = `<tr class="accordion" style="display:none;background: #f9f9f9">`;
                accord += ` <td colspan="6">`;
                accord += `<div style="overflow:auto;display:none">`;
                accord += `<div style="overflow:auto;">`;
                accord += `<div style="margin:0 46px;overflow:auto;">`;
                accord += `<b style="float:left;">Remarks: </b>`;
                accord += `<p style="float:left;margin-left:2%">`;
                    if(data[mesp].msRemarks  == null || data[mesp].msRemarks == '' ){
                        accord += `No Remarks`;
                        accord += `</p>`;
                    }else{
                        accord += data[mesp].msRemarks;
                        accord += `</p>`;
                    }
            $("#menuTable  tbody").append(row1);
            $("#menuTable  tbody").append(accord);
		
            $(".updateBtn").last().on('click', function () {
				$("#editSpoil").find("input[name='prID']").val($(this).closest("tr").attr(
                    "data-prID"));
                $("#editSpoil").find("input[name='msID']").val($(this).closest("tr").attr(
                    "data-msID"));
				$("#editSpoil").find("input[name='msoldQty']").val($(this).closest("tr").attr(
                    "data-msQty"));
				$("#editSpoil").find("input[name='msQty']").val($(this).closest("tr").attr(
                    "data-msQty"));
				$("#editSpoil").find("input[name='osID']").val($(this).closest("tr").attr(
                    "data-osID"));
				$("#editSpoil").find("input[name='msoldDate']").val($(this).closest("tr").attr(
                    "data-msDate"));
				$("#editSpoil").find("input[name='msDate']").val($(this).closest("tr").attr(
                    "data-msDate"));
				$("#editSpoil").find("input[name='msRemarks']").val($(this).closest("tr").attr(
					"data-msRemarks"));
                    
            });
			$(".item_delete").last().on('click', function() {
					$("#deleteSpoilageId").text(
						`Delete spoilage code ${$(this).closest("tr").attr("data-spoilname")}`);
					$("#deleteSpoilage").find("input[name='prID']").val($(this).closest("tr").attr(
						"data-id"));
					$("#deleteSpoilage").find("input[name='msID']").val($(this).closest("tr").attr(
						"data-id"));
				});
		}		
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
    $("#editSpoil form#editSpoil").on('submit', function(event) {
		event.preventDefault();
		var msID = $(this).find("input[name='msID']").val();
        var prID = $(this).find("input[name='prID']").val();
        var msQty = $(this).find("input[name='msQty']").val();
		var oldQty = $(this).find("input[name='msoldQty']").val();
        var msDate = $(this).find("input[name='msDate']").val();
        var msRemarks = $(this).find("input[name='msRemarks']").val();
        var osID = $(this).find("input[name='osID']").val();
       console.log('msID:',msID,',','osID:', osID,',','prID:', prID,',','msQty',msQty,',',
       'msDate',msDate,',','msRemarks:',msRemarks,',','oldQty:',oldQty);
        $.ajax({
            url: "<?= site_url("admin/spoilages/menu/edit")?>",
            method: "post",
            data: {
				msID: msID,
                prID : prID,
                msQty: msQty,
				oldQty: oldQty,
                msDate: msDate,
                msRemarks: msRemarks,
                osID:osID
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

			$('#formAdd1').submit(function(event) {
				var spoiledDate = $("#spoilDate").val();
				var currentDate = new Date();
				if (Date.parse(currentDate) < Date.parse(spoiledDate)) {
					alert('Please check the date input!');
					return false;
				}
			});
		});

		//Search Function
		$("#menuTable input[name='search']").on("keyup", function() {
			var string = $(this).val().toLowerCase();

			$("#menuTable .ic-level-1").each(function(index) {
				var text = $(this).text().toLowerCase().replace(/(\r\n|\n|\r)/gm, ' ');
				if (!text.includes(string)) {
					$(this).closest("tr").hide();
				} else {
					$(this).closest("tr").show();
				}
			});

		});
	</script>
</body>

</html>
