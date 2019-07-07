<!--End Side Bar-->

<body style="background:white">
    <div class="content">
        <div class="container-fluid">
            <div style="overflow:auto">
            <p style="text-align:right; font-weight: regular; font-size: 16px">
                <!-- Real Time Date & Time -->
                <?php echo date("M j, Y -l"); ?>
            </p>
            <a  class="btn btn-primary btn-sm" href="<?= site_url('chef/menuspoilage/formadd')?>" data-original-title style="margin:0; width:15%;"
                                                id="addBtn">Add Menu Spoilage</a>
            </div>
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
										<form id="formAdd" action="<?= site_url('chef/menu/spoilages/add')?>" accept-charset="utf-8">
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
                                                        class="form-control form-control-sm" required>
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
                                                        <input type="date" name="msDate" id="msDate" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("msDate"); ?></span>
                                                    </div>
													<div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Orderslip No.</span>
                                                        </div>
                                                        <input list="orderslips" name="osID" id="osID"/>
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
	<?php include_once('scripts.php') ?>
    <script>
        $(function () {
        viewInventoryJs()
        });
    // var getEnumValsUrl = '< ?= site_url('chef/transactions/getEnumVals')?>';
    // var crudUrl = '< ?= site_url('barista/transactions/add')?>';
    // var getTransUrl = '< ?= site_url('barista/transactions/getTransaction')?>';
    // var loginUrl = '< ?= site_url('login')?>';
    // var getPOsUrl = '< ?= site_url('barista/transactions/getPOs')?>';
    // var getDRsUrl = '< ?= site_url('barista/transactions/getDRs')?>';
    // var getSPMsUrl = '< ?= site_url('barista/transactions/getSPMs')?>';
//POPULATE TABLE
    var inventoryitems = [];
	var table = $('#inventoryTable');

function viewInventoryJs() {
	$.ajax({
		url: "<?= site_url('chef/spoilagesmenujson') ?>",
		method: "post",
		dataType: "json",
		success: function (data) {
			inventoryitems = data;
			setInventoryData(inventoryitems);
			console.log('Success');
		},
		error: function (response, setting, errorThrown) {
			console.log(response.responseText);
			console.log(errorThrown);
		}
	});
}

function setInventoryData() {
	if ($("#inventoryTable > tbody").children().length > 0) {
		$("#inventoryTable > tbody").empty();
	}
	inventoryitems.forEach(table => {
        var osID;
        if(table.osID == null){
            osID = '';
        }else{
            osID = table.osID;
        }
		$("#inventoryTable > tbody").append(`
		<tr data-msID="${table.msID}" data-prID="${table.prID} data-sID="${table.sID}">
        <td><a data-toggle="collapse" href="#collapseExample" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a></td>
            <td>${osID}</td>
			<td>${table.mName}</td>
			<td>${table.msQty}</td>
			<td>${table.msDate}</td>
			<td>${table.msDateRecorded}</td>
            <td>
            <button class="updateBtn btn btn-secondary btn-sm" data-toggle="modal"
                                data-target="#editSpoil">Edit</button>
                            <!--Delete button-->
            <button class="item_delete btn btn-warning btn-sm" data-toggle="modal" 
                            data-target="#deleteSpoilage">Archived</button>
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
				$("#editSpoil").find("input[name='msoldQty']").val(table.msQty);
				$("#editSpoil").find("input[name='msoldDate']").val(table.msDate);
				$("#editSpoil").find("input[name='msDate']").val($(this).closest("tr").attr(
					"data-msDate"));
				$("#editSpoil").find("input[name='msRemarks']").val($(this).closest("tr").attr(
					"data-msRemarks"));
            });
            $("#inventoryTable > tbody").append(accordion);
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
            url: "<?= site_url("chef/spoilages/menu/edit")?>",
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
});
	//--------------------End of Function for Edit-----------------------------
	
        $("#addBtn").on("click", function(){
            setAddEditBtnHandlers();
        });
        $('#addEditTransaction').on('hidden.bs.modal', function () {
            $("#addEditTransaction form")[0].reset();
            $(this).find("select[name='spID']").off('change');
            $("#addItemBtn").off('click');
            $("#addPOBtn").off('click');
            $("#addDRBtn").off('click');
            $("#addMBtn").off('click');
            $("#addEditTransaction").find(".ic-level-2").empty();
        });
        $(".accordionBtn").on('click', function() {
            if ($(this).closest('tr').next('.accordion').css('display') === 'none') {
                $(this).closest('tr').next('.accordion').slideDown();
                $(this).closest('tr').next('.accordion').find('div').slideDown();
            } else {
                $(this).closest('tr').next('.accordion').find('div').slideUp();
                $(this).closest('tr').next('.accordion').slideUp();
            }
        });
        $(".editBtn").on('click', function() {
            var id = $(this).closest("tr").attr("data-id");
            setAddEditBtnHandlers();
            populateModalForm(getTransUrl, id);
        });
        $("#addEditTransaction form").on('submit', function(event) {
            event.preventDefault();
            var id = $(this).find('input[name="tID"]').val();
            var supplier = $(this).find('select[name="spID"]').val();
            var type = $(this).find('select[name="tType"]').val();
            var receipt = $(this).find('input[name="tNum"]').val();
            var date = $(this).find('input[name="tDate"]').val();
            var transitems = [];
            for(var x = 0; x < $(this).find('.ic-level-1').length ; x++){
                var tiID = $(this).find('.ic-level-1').eq(x).attr("data-id");
                transitems.push({
                    tiID: isNaN(parseInt(tiID)) ? (undefined) : tiID,
                    tiName: $(this).find('input[name = "itemName[]"]').eq(x).val(),
                    stID: $(this).find('input[name = "stID[]"]').eq(x).attr("data-id"),
                    tiQty: $(this).find('input[name = "itemQty[]"]').eq(x).val(),
                    stQty: $(this).find('input[name = "actualQty[]"]').eq(x).val(),
                    tiUnit: $(this).find('select[name = "itemUnit[]"]').eq(x).val(),
                    stUnit: $(this).find('select[name = "actualUnit[]"]').eq(x).val(),
                    tiPrice: $(this).find('input[name = "itemPrice[]"]').eq(x).val(),
                    tiStatus: $(this).find('select[name = "itemStatus[]"]').eq(x).val()
                });
            }
            $.ajax({
                method: 'POST',
                url: crudUrl,
                data: {
                    id: id,
                    supplier: supplier,
                    type: type,
                    receipt: receipt,
                    date: date,
                    remarks: remarks,
                    transitems: JSON.stringify(transitems)
                },
                dataType: 'JSON',
                beforeSend: function(){
                    console.log(transitems);
                },
                success: function(data){
                    console.log(data);
                },
                error: function(response, setting, error) {
                    console.log(response.responseText);
                    console.log(error);
                }
            });
        });
        $("#stockBrochure form").on('submit',function(event){
            event.preventDefault();
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='stID[]']").val($(this).find("input[name='stocks']:checked").attr("data-name"));
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='stID[]']").attr("data-id", $(this).find("input[name='stocks']:checked").val());
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("select[name='actualUnit[]']").trigger('change');
            $(this)[0].reset();
            $("#stockBrochure").modal("hide");
        });
        $("#merchandiseBrochure, #stockBrochure").on("hidden.bs.modal", function(){
            $(this).find(".ic-level-2").empty();
            $(this).find("form")[0].reset();
            $(this).find("form").off('submit');
        });
        $("#transactionBrochure").on("hidden.bs.modal", function(){
            $(this).find(".ic-level-4").empty();
            $(this).find("form")[0].reset();
            $(this).find("form").off('submit');
        });

    function getEnumVals(url) {
        $.ajax({
            method: 'POST',
            url: url,
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                var input;
                $("#addEditTransaction").find('select[name="spID"]').children().first().siblings().remove();
                $("#addEditTransaction").find('select[name="tType"]').children().first().siblings().remove();
                $("#addEditTransaction").find('select[name="spID"]').append(data.suppliers.map(supplier => {
                    return `<option value="${supplier.spID}">${supplier.spName}</option>`;
                }).join(''));
                $("#addEditTransaction").find('select[name="tType"]').append(data.tTypes.map(type => {
                    return `<option value="${type}">${type.toUpperCase()}</option>`;
                }).join(''));
                $("#addItemBtn").on('click',function(){
                    $("#addEditTransaction").find(".ic-level-2").append(`
                    <div class="container mb-3 ic-level-1"
                        style="overflow:auto;width:100%" data-id="">
                        <div style="float:left;width:95%;overflow:auto;">

                            <div class="input-group mb-1">
                                <input type="text" name="itemName[]"
                                    class="form-control form-control-sm"
                                    placeholder="Item Name" style="width:24%">
                                <input name="stID[]" type="text"
                                    class="form-control border-right-0"
                                    placeholder="Stock" style="width:15%">
                                <input type="number" name="itemQty[]"
                                    class="form-control form-control-sm"
                                    placeholder="Quantity">
                                <input type="number" name="actualQty[]"
                                    class="form-control form-control-sm"
                                    placeholder="Actual Qty">

                            </div>
                            <div class="input-group">
                                <select name="itemUnit[]"
                                    class="form-control form-control-sm">
                                    <option value="" selected="selected">Unit
                                    </option>
                                </select>
                                <select name="actualUnit[]"
                                    class="form-control form-control-sm">
                                    <option value="" selected="selected">Actual Unit
                                    </option>
                                </select>
                                <input type="number" name="itemPrice[]"
                                    class="form-control form-control-sm "
                                    placeholder="Price">
                                <input type="number" name="itemSubtotal[]"
                                    class="form-control form-control-sm "
                                    placeholder="Subtotal">
                                <select name="itemStatus[]"
                                    class="form-control form-control-sm ">
                                    <option value="" selected>Choose Status</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4"
                            style="float:left:width:3%;overflow:auto;">
                            <img class="exitBtn"
                                src="/assets/media/barista/error.png"
                                style="width:20px;height:20px;float:right;">
                        </div>
                    </div>`);
                    $("#addEditTransaction").find(".exitBtn").last().on('click',function(){
                        $(this).closest(".ic-level-1").remove();
                    });
                    $("#addEditTransaction").find("select[name='itemUnit[]']").last().append(data.uoms.map(uom=>{
                        return `<option value="${uom.uomID}">${uom.uomAbbreviation}</option>`;
                    }).join(''));
                    $("#addEditTransaction").find("select[name='actualUnit[]']").last().append(data.uoms.map(uom=>{
                        return `<option value="${uom.uomID}">${uom.uomAbbreviation}</option>`;
                    }).join(''));
                    $("#addEditTransaction").find("select[name='itemStatus[]']").last().append(data.tiStatuses.map(status=>{
                        return `<option value="${status}">${status.toUpperCase()}</option>`;
                    }).join(''));
                    $("#addEditTransaction").find(".ic-level-1 *").on("focus",function(){
                        if(!$(this).closest(".ic-level-1").attr("data-focus")){
                            $("#addEditTransaction").find(".ic-level-1").removeAttr("data-focus");
                            $(this).closest(".ic-level-1").attr("data-focus",true);
                        }
                    });
                    $("#addEditTransaction").find("input[name='stID[]']").last().on('focus', function(){
                        $("#stockList").empty();
                        $("#stockList").append(data.stocks.map(stock =>{
                            return `<div class="d-flex d-inline-block"><label>
                                <div><input name="stocks" type="radio" class="mr-3" value=${stock.stID} data-name="${stock.stName}" /></div>
                                <div>${stock.stName}</div></label>
                            </div>`;
                        }).join(''));
                        $("#stockBrochure").modal('show');
                    });
                    $("#addEditTransaction").find("select[name='actualUnit[]']").last().on('change', function(event){
                        var stID = $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='stID[]']").attr("data-id");
                        $(this).find(`option[value=${data.stocks.filter(stock=>stock.stID == stID)[0].uomID}]`).attr("selected","selected");
                    });
                    $("#addEditTransaction").find("input[name='itemPrice[]']").last().on('change', function(event){
                        computeICSubtotal();
                    });
                    $("#addEditTransaction").find("input[name='itemQty[]']").last().on('change', function(event){
                        computeICSubtotal();
                    });
                    $("#addEditTransaction").find("input[name='itemSubtotal[]']").last().on('change', function(event){
                        computeICSubtotal();
                    });
                });
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            }
        });
    }
    function computeICSubtotal(){
        var qty = parseInt($("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='itemQty[]']").val());
        var price = parseFloat($("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='itemPrice[]']").val());
        var subtotal;
        if(isNaN(qty)){
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='itemQty[]']").val(0);
            qty = 0;
        }
        if(isNaN(price)){
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='itemPrice[]']").val(0);
            price = 0;
        }
        subtotal = qty * price;
        $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='itemSubtotal[]']").val(subtotal.toFixed(2));
    }
    function populateModalForm(url, id) {
        $.ajax({
            method: 'POST',
            url: url,
            data: {
                id: id
            },
            dataType: 'JSON',
            success: function(data) {
                if(!data.inputErr){
                    $("#addEditTransaction").find('input[name="tID"]').val(data.transaction[0].tID);
                    $("#addEditTransaction").find('select[name="spID"]').children(`option[value=${data.transaction[0].spID}]`).attr('selected', 'selected');
                    $("#addEditTransaction").find('select[name="tType"]').children(`option[value="${data.transaction[0].tType}"]`).attr(
                        'selected', 'selected');
                    $("#addEditTransaction").find('input[name="tNum"]').val(data.transaction[0].tNum);
                    $("#addEditTransaction").find('input[name="tDate"]').val(data.transaction[0].tDate);
                    $("#addEditTransaction").find('textarea[name="tRemarks"]').val(data.transaction[0].tRemarks);
                    data.transitems.forEach(item =>{
                        $("#addItemBtn").trigger("click");
                        $("#addEditTransaction").find(".ic-level-1").last().attr("data-id",item.tiID);
                        $("#addEditTransaction").find(".ic-level-1").last().attr("data-focus",true);
                        $("#addEditTransaction").find("input[name='itemName[]']").last().val(item.tiName);
                        $("#addEditTransaction").find("input[name='stID[]']").last().attr("data-id",item.stID);
                        $("#addEditTransaction").find("input[name='stID[]']").last().val(item.stName);
                        $("#addEditTransaction").find("input[name='itemQty[]']").last().val(item.tiQty);
                        $("#addEditTransaction").find("input[name='actualQty[]']").last().val(item.tiActualQty);
                        $("#addEditTransaction").find("select[name='itemUnit[]']").last().children(`option[value=${item.uomID}]`).attr("selected","selected");
                        $("#addEditTransaction").find("input[name='itemPrice[]']").last().val(parseFloat(item.tiPrice).toFixed(2));
                        $("#addEditTransaction").find("input[name='itemSubtotal[]']").last().val(parseFloat(item.tiSubtotal).toFixed(2));
                        $("#addEditTransaction").find("select[name='itemStatus[]']").last().children(`option[value='${item.tiStatus}']`).attr("selected","selected");
                        $("#addEditTransaction").find("select[name='actualUnit[]']").last().trigger("change");
                        $("#addEditTransaction").find(".ic-level-1").last().removeAttr("data-focus");
                    });
                }
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            }
        });
    }
    function setAddEditBtnHandlers(){
        var previousVal;
        $("#addPOBtn").prop("disabled",true);
        $("#addDRBtn").prop("disabled",true);
        $('#addEditTransaction').find("select[name='spID']").on("focus",function(){
            previousVal = $(this).val();
        }).change(function(){
            if(!isNaN(parseInt(previousVal))){
                $("#addEditTransaction").find(".ic-level-2").children().remove();
            }
            previousVal = $(this).val();
        });
        $("#addEditTransaction").find("select[name='tType']").on("change",function(){
            switch($(this).val()){
                case "purchase order" : 
                    $("#addPOBtn").prop("disabled",true);
                    $("#addDRBtn").prop("disabled",true);
                    break;
                case "delivery receipt" :
                    $("#addPOBtn").prop("disabled",false);
                    $("#addDRBtn").prop("disabled",true);
                    break;
                case "official receipt" :
                    $("#addPOBtn").prop("disabled",false);
                    $("#addDRBtn").prop("disabled",false);
                    break;
                default:
                    break;
            }
        });
        getEnumVals(getEnumValsUrl);
        $("#addMBtn").on("click",function(){
            setMerchandiseBrochure(getSPMsUrl);
        });
        $("#addPOBtn").on("click",function(){
            setTransactionBrochure(getPOsUrl);
        });
        $("#addDRBtn").on("click",function(){
            setTransactionBrochure(getDRsUrl);
        });
    }
    function setTransactionBrochure(url){
        var spID = $("#addEditTransaction").find("select[name='spID']").val();
        $.ajax({
            method: "POST",
            url: url,
            data: {
                supplier: spID
            },
            dataType: "JSON",
            success: function(data){
                if(!data.inputErr){
                    if(!Array.isArray(data.transactions) && !(data.transactions.length > 0)){
                        $("#transactionBrochure .ic-level-4").hide();
                    }else{
                        $("#transactionBrochure .ic-level-4").show();
                        $("#transactionBrochure .ic-level-4").append(data.transactions.map(transaction=>{
                            return `<div>
                                    <input type="checkbox" name="transaction" value="${transaction.tID}"/>
                                    <span>Receipt No.: </span><span>${transaction.tNum}</span>
                                    <span>Transaction Date: </span><span>${transaction.tDate}</span>
                                    <span>Date Recorded: </span><span>${transaction.dateRecorded}</span>
                                </div>
                                <table class="table ic-level-3">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:2%"></th>
                                            <th>Item</th>
                                            <th>Unit</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ic-level-2">
                                        ${data.transitems.filter(item=> item.tID == transaction.tID).map(item=>{
                                            return `<tr class="ic-level-1">
                                                    <td><input type="checkbox" name="tiID[]" value="${item.tiID}" data-tID="${item.tID}"></td>
                                                    <td>${item.tiName}</td>
                                                    <td>${item.uomAbbreviation}</td>
                                                    <td>${item.tiQty}</td>
                                                    <td>${parseFloat(item.tiPrice).toFixed(2)}</td>
                                                    <td>${parseFloat(item.tiSubtotal).toFixed(2)}</td>
                                                    <td>${item.tiStatus}</td>
                                                </tr>`;
                                        }).join('')}
                                    </tbody>
                                </table>`;
                        }).join(''));
                        $("#transactionBrochure form").on("submit",function(event){
                            event.preventDefault();
                            var selectItems = [];
                            $(this).find("input[name='tiID[]']:checked").each(function(index){
                                selectItems.push($(this).val());
                            });
                            selectItems = data.transitems.filter(item=> selectItems.includes(item.tiID));
                            selectItems.forEach(item =>{
                                $("#addItemBtn").trigger("click");
                                $("#addEditTransaction").find(".ic-level-1").last().attr("data-id",item.tiID);
                                $("#addEditTransaction").find(".ic-level-1").last().attr("data-focus",true);
                                $("#addEditTransaction").find("input[name='itemName[]']").last().val(item.tiName);
                                $("#addEditTransaction").find("input[name='stID[]']").last().attr("data-id",item.stID);
                                $("#addEditTransaction").find("input[name='stID[]']").last().val(item.stName);
                                $("#addEditTransaction").find("input[name='itemQty[]']").last().val(item.tiQty);
                                $("#addEditTransaction").find("input[name='actualQty[]']").last().val(item.tiActualQty);
                                $("#addEditTransaction").find("select[name='itemUnit[]']").last().children(`option[value=${item.uomID}]`).attr("selected","selected");
                                $("#addEditTransaction").find("input[name='itemPrice[]']").last().val(parseFloat(item.tiPrice).toFixed(2));
                                $("#addEditTransaction").find("input[name='itemSubtotal[]']").last().val(parseFloat(item.tiSubtotal).toFixed(2));
                                $("#addEditTransaction").find("select[name='itemStatus[]']").last().children(`option[value='${item.tiStatus}']`).attr("selected","selected");
                                $("#addEditTransaction").find("select[name='actualUnit[]']").last().trigger("change");
                                $("#addEditTransaction").find(".ic-level-1").last().removeAttr("data-focus");
                            });
                            $("#transactionBrochure").modal("hide");
                        });
                    }
                }else{
                    console.log(data);
                }
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            }
        });
    }
    function setMerchandiseBrochure(url){
        var spID = $("#addEditTransaction").find("select[name='spID']").val();
        $.ajax({
            method: "POST",
            url: url,
            data: {
                supplier: spID
            },
            dataType: "JSON",
            success: function(data){
                if(!data.inputErr){
                    $("#merchandiseBrochure").find(".ic-level-2").append(data.merchandise.map(merchandise =>{
                            return `<tr class="ic-level-1">
                                <td><input type="checkbox" name="merchandise" value="${merchandise.spmID}"/></td>
                                <td>${merchandise.spmName}</td>
                                <td>${merchandise.uomAbbreviation}</td>
                                <td>${merchandise.spmPrice}</td>
                                <td>${merchandise.stName}</td>
                                <td>${merchandise.spmActualQty}</td>
                            </tr>`;
                        }).join(''));
                    $("#merchandiseBrochure form").on("submit",function(event){
                        event.preventDefault();
                        var selectedMerch = [];
                        $(this).find("input[name='merchandise']:checked").each(function(index){
                            selectedMerch.push($(this).val());
                        });
                        selectedMerch = data.merchandise.filter(merchandise => selectedMerch.includes(merchandise.spmID));
                        selectedMerch.forEach(merch => {
                            $("#addItemBtn").trigger("click");
                            $("#addEditTransaction").find(".ic-level-1").last().attr("data-focus",true);
                            $("#addEditTransaction").find("input[name='itemName[]']").last().val(merch.spmName);
                            $("#addEditTransaction").find("input[name='stID[]']").last().attr("data-id",merch.stID);
                            $("#addEditTransaction").find("input[name='stID[]']").last().val(merch.stName);
                            $("#addEditTransaction").find("input[name='actualQty[]']").last().val(merch.spmActualQty);
                            $("#addEditTransaction").find("select[name='itemUnit[]']").last().children(`option[value=${merch.uomID}]`).attr("selected","selected");
                            $("#addEditTransaction").find("input[name='itemPrice[]']").last().val(merch.spmPrice);
                            $("#addEditTransaction").find("select[name='actualUnit[]']").last().trigger("change");
                            $("#addEditTransaction").find(".ic-level-1").last().removeAttr("data-focus");
                        });
                        $("#merchandiseBrochure").modal("hide");
                    });
                }else{
                    console.log(data);
                }
            },
            error: function(response, setting, error) {
                console.log(response.responseText);
                console.log(error);
            }
        });
    }
</script>
</body>
