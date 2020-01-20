<!--End Side Bar-->

<body style="background:white">
    <div class="content">
        <div class="container-fluid">
            <div style="overflow:auto">
            <p style="text-align:right; font-weight: regular; font-size: 16px">
                <!-- Real Time Date & Time -->
                <?php echo date("M j, Y -l"); ?>
            </p>
            <a  class="btn btn-primary btn-sm" href="<?= site_url('barista/menuspoilage/formadd')?>" data-original-title style="margin:0; width:20%;"
                                                id="addBtn">Add Menu Spoilage</a>
            </div>
            <br>
            <div id="pagination"></div>
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <!--Table-->
                            <div class="card-content">
                                <table id="inventoryTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead class="thead-dark">
                                        <th></th>
                                        <th><b class="pull-left">Orderslip #</b></th>
                                        <th><b class="pull-left">Menu Name</b></th>
                                        <th><b class="pull-left">Qty Spoiled</b></th>
                                        <th><b class="pull-left">Date Spoiled</b></th>
                                        <th><b class="pull-left">Date Recorded</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <!--End Table Content-->
                                <!-- Start of Modal "Add Menu Spoilages"-->
							<div class="modal fade bd-example-modal-lg" id="addMenuSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Add Menu Spoilage</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="formAdd" action="<?= site_url('barista/menu/spoilages/add')?>" accept-charset="utf-8">
											<div class="modal-body">
												<div class="form-row" style="margin-right: 20%;">
													<!--Container of Menu Spoilage Date-->
													<!--Spoilage Date-->
													<div class="input-group mb-3 col">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm"
                                                            style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Spoilage Date</span>
                                                    </div>
                                                    <input type="date" name="spoilDate" id="spoilDate" style="width: 70%;";
                                                        class="form-control form-control-sm" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
                                                </div>
												</div>
												<!--Add Menu Item-->
												<!--Button to add row in the table-->
												<!--Button to add launche the brochure modal-->
												<a class="addSpoilageItem btn btn-default btn-sm" data-toggle="modal" data-target="#brochureSS" data-original-title style="margin:0;" id="addMenuSpoilage">Add Spoilage Items</a>
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
													<button type="submit" class="btn btn-success btn-sm">Add</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!--End of Modal "Add Menu Spoilage" -->
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
                                <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal-lg" id="transactionBrochure" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form>
                                                <div class="modal-body">
                                                    <div>
                                                        <label><input type="checkbox" name="tType" value="po"/>Purchase Order</label>
                                                        <label><input type="checkbox" name="tType" value="dr"/>Delivery Receipt</label>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text "
                                                                style="width:130px;background:#737373;color:white;font-size:14px;font-weight:600">
                                                                Purchase Order</span>
                                                        </div>
                                                        <select class="form-control form-control-sm" name="po">
                                                            <option value="" selected>Choose</option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <div class="ic-level-4">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-success btn-sm" type="submit">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Brochure Modal"-->

                                <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal-sm" id="stockBrochure" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form>
                                                <div class="modal-body">
                                                    <div id="stockList">
                                                        <div class="d-flex d-inline-block">
                                                            <div><input name="stocks[]" type="radio" class="mr-3" value=/></div>
                                                            <div>basta</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-success btn-sm" type="submit">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Brochure Modal"-->

                                <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal-sm" id="merchandiseBrochure" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock Item</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form>
                                                <div class="modal-body">
                                                    <table>
                                                        <thead>
                                                            <th></th>
                                                            <th>Name</th>
                                                            <th>UOM</th>
                                                            <th>Price</th>
                                                            <th>Stock</th>
                                                            <th>Qty/UOM</th>
                                                        </thead>
                                                        <tbody class="ic-level-2">
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-success btn-sm" type="submit">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Brochure Modal"-->
                                
                                <!--Start of Modal "Delete Stock Item"-->
                                <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete/Archive
                                                    Transaction
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="confirmDelete">
                                                <div class="modal-body">
                                                    <h6 id="deleteTableCode"></h6>
                                                    <p>Are you sure you want to delete/archive this item?</p>
                                                    <input type="text" name="" hidden="hidden">
                                                    <div>
                                                        Remarks:<input type="text" name="deleteRemarks"
                                                            id="deleteRemarks" class="form-control form-control-sm">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Delete Stock Item"-->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
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
			url: '<?=base_url()?>barista/menuspoilage/loadDataMenuSpoil/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $('#pagination').html(data.pagination);
                var menuitems = data.menuspoiled;
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
    $("#inventoryTable > tbody").empty();
        for(mesp in data){
            var osID;
                if(data[mesp].osID == null){
                    osID = '';
                }else{
                    osID = data[mesp].osID;
                }
            var row1 = `<tr data-msID="`+data[mesp].msID+`" data-prID="`+data[mesp].prID+`" data-sID="`+data[mesp].sID+`">`;
                row1 += `<td><a data-toggle="collapse" href="#collapseExample" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a></td>`;
                row1 += `<td>`+osID+`</td>`;
                row1 += `<td>`+data[mesp].prName+`</td>`;
                row1 += `<td>`+data[mesp].msQty+`</td>`;
                row1 += `<td>`+data[mesp].msDate+`</td>`;
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
            $("#inventoryTable  tbody").append(row1);
            $("#inventoryTable  tbody").append(accord);
        
            $(".updateBtn").last().on('click', function () {
				$("#editSpoil").find("input[name='prID']").val($(this).closest("tr").attr(
                    "data-prID"));
                $("#editSpoil").find("input[name='msID']").val($(this).closest("tr").attr(
                    "data-msID"));
				$("#editSpoil").find("input[name='msQty']").val($(this).closest("tr").attr(
                    "data-msQty"));
				$("#editSpoil").find("input[name='msoldQty']").val(data[mesp].msQty);
				$("#editSpoil").find("input[name='msoldDate']").val(data[mesp].msDate);
				$("#editSpoil").find("input[name='msDate']").val($(this).closest("tr").attr(
                    "data-msDate"));
				$("#editSpoil").find("input[name='msRemarks']").val($(this).closest("tr").attr(
					"data-msRemarks"));
                    
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
$("#editSpoil input[name='msDate']").on('change',function(){
            var date = $(this).val();
            var output = $("#editSpoil input[name='currentDate']").val();
            var endate = new Date(date);
            var curdate = new Date(output);
            if(endate > curdate)
            {
                alert("Invalid Date");
                $(this).val('');
            }else{
                $(this).val(date);
            }

});
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
            url: "<?= site_url("barista/spoilages/menu/edit")?>",
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

    
    $('#formAdd').submit(function(event){
        var spoilDate = $("#spoilDate").val();
        var currentDate = new Date();
        if(Date.parse(currentDate) < Date.parse(spoilDate)){
            alert('Incorrect date input!');
            return false;
        }
    });
});
	//--------------------End of Function for Edit-----------------------------
	
        
</script>
</body>
