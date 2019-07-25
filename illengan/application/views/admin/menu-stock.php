<body style="background:white">
    <div class="content">
        <div class="container-fluid">
            <br>
            <p style="text-align:right; font-weight: regular; font-size: 16px">
                <!-- Real Time Date & Time -->
                <?php echo date("M j, Y -l"); ?>
            </p>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="content">
                        <div class="container-fluid">
                            <!--Table-->
                            <div class="card-content" id="menuStockTable">
                            <a  class="btn btn-primary btn-sm" href="<?= site_url('admin/menustock/formadd')?>" data-original-title style="margin:0; width:20%;"
                                                id="addBtn">Add Menu-Stock Item</a><br>
                                <br>
                                <!--Search-->
                                <div id="menuStockTable" style="width:25%; float:right; border-radius:5px">
                                    <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                </div>
                                <br><br>
                                    <table id="menuStockTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><b class="pull-left">Menu Item</b></th>
                                                <th><b class="pull-left">Stock Item</b></th>
                                                <th><b class="pull-left">Quantity</b></th>
                                                <th><b class="pull-left">Actions</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div id="pagination" style="float:right"></div>
				     <!--Delete Confirmation Box-->
								<div class="modal fade" id="deletePrefStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">Delete Menu-Stock</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form id="confirmDelete">
												<div class="modal-body">
													<h6 id="deleteTableCode"></h6>
													<p>Are you sure you want to delete the selected prefstock?</p>
                                                    <input type="number" name="prID" hidden="hidden"/>
                                                    <input type="number" name="stID" hidden="hidden"/>
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
                                <div class="modal fade" id="editMS" name="editSpoil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Menu-Stock</h5>
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
                                                        <input type="number" min="1" name="qty" id="qty" class="form-control form-control-sm" required/>
                                                    </div>
                                                    <!--Date Spoiled-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:140px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Stock ID</span>
                                                        </div>
                                                         
                                                        <input list="stocks" type="text" name="newstID" id="newstID" class="form-control form-control-sm" required/>
                                                            <datalist id="stocks">
                                                                <?php foreach($stocks as $s){ 
                                                                 echo '<option value="'.$s['stID'].'">'. $s['stName'].'</option>';
                                                                 }?>
                                                        </datalist>
                                                    </div>
                                                    <input name="prID" id="prID" hidden="hidden"/>
                                                    <input name="stID" id="stID" hidden="hidden"/>
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
			url: '<?=base_url()?>admin/menustock/loadDataMenuStock/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $('#pagination').html(data.pagination);
                var pref = data.prefstocks;
                setPrefStockData(pref);
			},
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});
    }
    });
    function setPrefStockData(item){
        $('#menuStockTable > tbody').empty();
        for(p in item){
            if(item.length == null){
                var text = `<p>No items recorded!</p>`;
                $('#menuStockTable > tbody').append(text);
            }else{
            var row = `<tr class="menuStockTable ic-level-1" data-id1="`+item[p].prID+`" data-id2="`+item[p].stockitem+`" data-qty="`+item[p].qty+`">`;
            row += ` <td>`+item[p].prefname+`</td>`;
            row += ` <td>`+item[p].stockitemname+`</td>`;
            row += ` <td>`+item[p].qty+`</td>`;
            row += ` <td>
            <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal" data-target="#editMS">Edit</button>
            <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#deletePrefStock">Delete</button>
            </td>
            </tr>`;
            $('#menuStockTable > tbody').append(row);
        }
       $(".editBtn").last().on('click', function() {
                    $("#editMS").find("input[name='prID']").val($(this).closest("tr").attr(
                        "data-id1"));
                    $("#editMS").find("input[name='stID']").val($(this).closest("tr").attr(
                        "data-id2"));
                    $("#editMS").find("input[name='qty']").val($(this).closest("tr").attr(
                        "data-qty"));
                });
        $(".deleteBtn").last().on('click', function() {
					$("#deletePrefStock").find("input[name='prID']").val($(this).closest("tr").attr(
						"data-id1"));
					$("#deletePrefStock").find("input[name='stID']").val($(this).closest("tr").attr(
						"data-id2"));
				});
    }
    }
    $(document).ready(function() {
            $("#editMS form").on('submit', function(event) {
                event.preventDefault();
                var prID = $(this).find("input[name='prID']").val();
                var qty = $(this).find("input[name='qty']").val();
                var stID = $(this).find("input[name='newstID']").val();
                var ostID = $(this).find("input[name='stID']").val();
                console.log(prID,stID,qty,ostID);
                $.ajax({
                    url: "<?= site_url("admin/menustock/edit") ?>",
                    method: "post",
                    data: {
                        prID: prID,
                        qty: qty,
                        stID: stID,
			ostID: ostID 
                    },
                    dataType: "json",
                    complete: function() {
                    //     $("#editMS").modal("hide");
                    //     location.reload();
                     },
                     error: function(response, setting, error) {
                    console.log(error);
                    console.log(response.responseText);
                }

                });
            });
        });

                //Search Function
                $("#menuStockTable input[name='search']").on("keyup", function() {
                            var string = $(this).val().toLowerCase();

                            $("#menuStockTable .ic-level-1").each(function(index) {
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
