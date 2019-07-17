<!--End Side Bar-->

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
                            <div class="card-content" id="transTable">
                                <a class="btn btn-primary btn-sm" href="<?= site_url('admin/deliveryreceipt/formadd') ?>" data-original-title style="margin:0" id="addBtn">Add Delivery Receipt</a>
                                <br>
                                <!--Search-->
                                <div id="transTable" style="width:25%; float:right; border-radius:5px">
                                    <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                </div>
                                <br><br>
                                <!--Table Body-->
                                
                                    <table id="transTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <th><b class="pull-left">Transaction #</b></th>
                                            <th><b class="pull-left">Receipt #</b></th>
                                            <th><b class="pull-left">Supplier</b></th>
                                            <th><b class="pull-left">Date</b></th>
                                            <th><b class="pull-left">Total</b></th>
                                            <th><b class="pull-left">Actions</b></th>
                                        </thead>
                                        <tbody class="transTable ic-level-2">
                                        </tbody>
                                    </table>
                                    <div id="pagination" style="float:right"></div>
                                <!--End Table Content-->

                                <!--Start of Modal "Delete Stock Item"-->
                                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete/Archive
                                                    Transaction
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="confirmDelete">
                                                <div class="modal-body">
                                                    <h6 id="deleteTableCode"></h6>
                                                    <p>Are you sure you want to delete/archive this item?</p>
                                                    <input type="text" name="" hidden="hidden">
                                                    <div>
                                                        Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm">
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
                                <!--End of Modal "Delete Stock Item"-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
    <script>
        var getEnumValsUrl = '<?= site_url('admin/transactions/getEnumVals') ?>';
        var crudUrl = '<?= site_url('admin/transactions/add') ?>';
        var getTransUrl = '<?= site_url('admin/transactions/getTransaction') ?>';
        var loginUrl = '<?= site_url('login') ?>';
        var getPOsUrl = '<?= site_url('admin/transactions/getPOs') ?>';
        var getDRsUrl = '<?= site_url('admin/transactions/getDRs') ?>';
        var getSPMsUrl = '<?= site_url('admin/transactions/getSPMs') ?>';
       
        //Search Function
        $("#transTable input[name='search']").on("keyup", function() {
            var string = $(this).val().toLowerCase();

            $("#transTable .ic-level-1").each(function(index) {
                var text = $(this).text().toLowerCase().replace(/(\r\n|\n|\r)/gm, ' ');
                if (!text.includes(string)) {
                    $(this).closest("tr").hide();
                } else {
                    $(this).closest("tr").show();
                }
            });

        });

    $(document).ready(function() {
	createPagination(0);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum);
	});
	function createPagination(pageNum){
		$.ajax({
			url: '<?=base_url()?>admin/loadDataDeliveryReceipt/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $('#pagination').html(data.pagination);
                var dr = data.delRec;
                var drItems = data.dr;
				console.log(dr, drItems);
                setDelReceiptsData(dr, drItems);
			},
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});
	}
        
   });
		function setDelReceiptsData(del, delItems) {
				$("#transTable > tbody").empty();
            for(dr in del){
                var row = ` <tr class="transTabletr ic-level-1">`;
                    row += `<td><a data-toggle="collapse" href="#collapseExample" class="ml-2 mr-4">`;
                    row += `<img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>${del[dr].pID}</td>`;
                    if(del[dr].receipt == null || del[dr].receipt == ''){
                        row += ` <td>No receipt<td>`; 
                    }else{
                        row += `<td>`+del[dr].receipt+`</td>`;
                    }
                    if(jQuery.trim(del[dr].spAltName) == ""){
                        row += `<td>${del[dr].spName}</td>`;
                    }else{
                        row += `<td>${del[dr].spAltName }</td>`;
                    }
                    row += `<td>${del[dr].pDate}</td>`;
                    row += `<td>${del[dr].pTotal}</td>`;
                    row += `<td>`;
                    row += ` <div class="onoffswitch">`;
                    row += `<a role="button" class="updateBtn btn btn-secondary btn-sm" href="<?= site_url()?>admin/deliveryreceipt/formedit/${del[dr].pID}">Edit</a>`;
                    row += ` <button class="item_delete btn btn-warning btn-sm" data-toggle="modal" data-target="#delete">Archive</button>`;
                    row += `</div></td></tr>`;
               
            var dri = delItems.filter(function(dI){
                return dI.pID == del[dr].pID
            });
            var accordion = `<tr class="accordion" style="display:none;background: #f9f9f9">`;
                accordion += ` <td colspan="7">`;
                accordion += ` <div class="container" style="overflow:auto;display:none">`;
                if(dri.length === 0){
                    accordion += ` No item delivered `;
                }else{
                accordion += `<table id="drItems" width="90%" style="margin-left:auto;margin-right:auto;" class="drItems table-bordered">`;
                accordion += `<thead class="thead-light" style="font-size: 15px">`;
                accordion += `<tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Actual Qty</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Subtotal</th>
                                    <th>Delivery Status</th>
                            </tr></thead>`;
                accordion +=` <tbody>`;
                for(it in dri){
                accordion +=`<tr>`;
                accordion +=` <td>${dri[it].merch == null ? dri[it].stock : dri[it].merch }</td>`;
                accordion +=` <td>${dri[it].qty}</td>`;
                accordion +=`<td>${dri[it].actual}</td>`;
                if(dri[it].spmPrice == null || dri[it].spmPrice == ''){
                    accordion +=`<td>N/A</td>`; 
                }else{
                    accordion +=`<td>${dri[it].spmPrice}</td>`;
                }
                if(dri[it].tiDiscount == null || dri[it].tiDiscount == ''){
                    accordion +=`<td>N/A</td>`; 
                }else{
                    accordion +=`<td>${dri[it].tiDiscount}</td>`;
                }
                if(dri[it].tiSubtotal == null || dri[it].tiSubtotal == ''){
                    accordion +=`<td>N/A</td>`;
                    
                } else {
                    accordion +=`<td>${dri[it].tiSubtotal}</td>`;
                }
                accordion +=` <td>${dri[it].priStatus}</td>`;
                accordion +=`</tr>`;
                accordion +=` </tbody>
                                </table>`;
                }
            }
                accordion += `</div></td></tr>`;
            
            $('#transTable > tbody').append(row);
            $("#transTable > tbody").append(accordion);
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

    </script>
</body>
