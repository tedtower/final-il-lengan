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
                                <!--Add Addon Spoilage BUTTON-->
                                <div class="col-md-4 col-lg-2" id="addonTable">
                                    <a class="btn btn-primary btn-sm" href="<?= site_url('barista/addons/spoilage/formadd') ?>" data-original-title style="margin:0" id="addBtn">Add Spoilage</a>
                                </div>
                                <!--eND Add Addon Spoilage BUTTON-->
                                <!--Search-->
                                <div id="addonTable" style="width:25%; float:right; border-radius:5px">
                                    <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                </div>
                                <br><br>
                                <!--Table Body-->
                                <table id="addonTable" class="spoiltable table table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
                                    <thead class="thead-dark">
                                        <th>ITEM NAME</th>
                                        <th>CATEGORY</th>
                                        <th>QUANTITY</th>
                                        <th>DATE SPOILED</th>
                                        <th>DATE RECORDED</th>
                                        <th>OPERATION</th>
                                    </thead>
                                    <tbody id="addon_data" class="addonTable ic-level-1">
                                    </tbody>
                                </table>
                                <div id="pagination" style="float:right"></div>
                                <!--End Table Content-->

                                <!--Delete Confirmation Box-->
                                <div class="modal fade" id="deleteSpoilage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Addon Spoilage</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="confirmDelete">
                                                <div class="modal-body">
                                                    <h6 id="deleteTableCode"></h6>
                                                    <p>Are you sure you want to delete the selected addon spoilages?</p>
                                                    <input type="text" name="aoID" hidden="hidden"/>
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
                                            <form id="formEdit" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Quantity-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Quantity</span>
                                                        </div>
                                                        <input type="number" min="1" name="aosQty" id="aosQty" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("aosQty"); ?></span>
                                                    </div>
                                                    <!--Date Spoiled-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Date Spoiled</span>
                                                        </div>
                                                        <input type="date" name="aosDate" id="aosDate" class="form-control form-control-sm" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
                                                        <span class="text-danger"><?php echo form_error("aosDate"); ?></span>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Remarks</span>
                                                        </div>
                                                        <input type="text" name="aosRemarks" id="aosRemarks" class="form-control form-control-sm" required>
                                                        <span class="text-danger"><?php echo form_error("aosRemarks"); ?></span>
                                                    </div>
                                                    <input name="aoID" id="aoID" hidden="hidden">
                                                    <input name="aosID" id="aosID" hidden="hidden">
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
    $(document).ready(function() {
	createPagination(0);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum);
	});
	function createPagination(pageNum){
		$.ajax({
			url: '<?=base_url()?>barista/addonspoilage/loadDataAddsSpoil/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $('#pagination').html(data.pagination);
                var adds = data.addspoiled;
                setSpoilagesData(adds);
			},
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});
	}
        
   });
        function setSpoilagesData(adds) {
                $("#addonTable> tbody").empty();
                for(ao in adds){
                    var row1 = `<tr class="addonTable ic-level-1" data-aoID="`+adds[ao].aoID+`" data-aosID="`+adds[ao].aosID+`" data-aosQty="`+adds[ao].aosQty+`"  data-aosDate="`+adds[ao].aosDate+`"  data-aosRemarks="`+adds[ao].aosRemarks+`" data-spoilname="`+adds[ao].aoName+`"  >`;
                    row1 += `	<td><a data-toggle="collapse" href="#collapseExample" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/barista/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>`+adds[ao].aoName+`</td>`;
                    row1 += `<td>`+adds[ao].aoCategory+`</td>`;
                    row1 += `<td>`+adds[ao].aosQty+`</td>`;
                    row1 += `<td>`+adds[ao].aosDate+`</td>`;
                    row1 += `<td>`+adds[ao].aosDateRecorded+`</td>`;
                    row1 += ` <td>
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
                </tr>`;
                var accord = `<tr class="accordion" style="display:none;background: #f9f9f9">`;
                    accord += ` <td colspan="6">`;
                    accord += `<div style="overflow:auto;display:none">`;
                    accord += `<div style="overflow:auto;">`;
                    accord += `<div style="margin:0 46px;overflow:auto;">`;
                    accord += `<b style="float:left;">Remarks: </b>`;
                    accord += `<p style="float:left;margin-left:2%">`;
                        if(adds[ao].aosRemarks  == null || adds[ao].aosRemarks == '' ){
                            accord += `No Remarks`;
                            accord += `</p>`;
                        }else{
                            accord += adds[ao].aosRemarks;
                            accord += `</p>`;
                        }
                    accord +=` </div> 
                                </div>
                            </div>
                        </td>
                    </tr>`;
                $("#addonTable  tbody").append(row1);
                $("#addonTable  tbody").append(accord);

                $(".updateBtn").last().on('click', function() {
                    $("#editSpoil").find("input[name='aoID']").val($(this).closest("tr").attr(
                        "data-aoID"));
                    $("#editSpoil").find("input[name='aosID']").val($(this).closest("tr").attr(
                        "data-aosID"));
                    $("#editSpoil").find("input[name='aosQty']").val($(this).closest("tr").attr(
                        "data-aosQty"));
                    $("#editSpoil").find("input[name='aosDate']").val($(this).closest("tr").attr(
                        "data-aosDate"));
                    $("#editSpoil").find("input[name='aosRemarks']").val($(this).closest("tr").attr(
                        "data-aosRemarks"));
                });
                $(".item_delete").last().on('click', function() {
                    $("#deleteSpoilageId").text(
                        `Delete spoilage code ${$(this).closest("tr").attr("data-spoilname")}`);
                    $("#deleteSpoilage").find("input[name='aoID']").val($(this).closest("tr").attr(
                        "data-id"));
                });
            }

            $(".accordionBtn").on('click', function() {
                if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
                    $(this).closest("tr").next(".accordion").css("display", "table-row");
                    $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");

                } else {
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
                var aoID = $(this).find("input[name='aoID']").val();
                var aosID = $(this).find("input[name='aosID']").val();
                var aosQty = $(this).find("input[name='aosQty']").val();
                var aosDate = $(this).find("input[name='aosDate']").val();
                var aosRemarks = $(this).find("input[name='aosRemarks']").val();

                $.ajax({
                    url: "<?= site_url("barista/addons/spoilage/edit") ?>",
                    method: "post",
                    data: {
                        aoID: aoID,
                        aosID: aosID,
                        aosQty: aosQty,
                        aosDate: aosDate,
                        aosRemarks: aosRemarks
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

        //End Function Delete

        //Search Function
		$("#addonTable input[name='search']").on("keyup", function() {
			var string = $(this).val().toLowerCase();

			$("#addonTable .ic-level-1").each(function(index) {
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
