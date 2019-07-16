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
                                <a class="btn btn-primary btn-sm" href="<?= site_url('admin/purchaseorder/formadd')?>"
                                    data-original-title style="margin:0" id="addBtn">Add Purchase Order</a>
                                <br>
                                <!--Search-->
                                <div id="transTable" style="width:25%; float:right; border-radius:5px">
                                    <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                </div>
                                <br><br>
                                <!--Table Body-->
                                <table id="transTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead class="thead-dark">
                                        <th><b class="pull-left">Transaction #</b></th>
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

                                <!--Start of Modal "Delete PO"-->
                                <div class="modal fade" id="deletePO" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete/Archive
                                                    Purchase Order
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
			url: '<?=base_url()?>admin/loadDataPurchaseOrder/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $('#pagination').html(data.pagination);
                var po = data.purOrd;
                var poi =data.poitems;
                console.log(po);
                setSpoilagesData(po, poi);
			},
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});
	}
        
   });
   function setSpoilagesData(po, poi) {
                $("#transTable > tbody").empty();
                for(p in po){
                    var row = ` <tr class="ic-level-1" data-id="`+po[p].id+`">`;
                        row +=`<td><a href="javascript:void(0)" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png"
                        style="height:15px;width: 15px" /></a>`+po[p].id+`</td>`;
                        row +=`<td>`+po[p].supplierName+`</td>`;
                        row +=`<td>`+po[p].transDate+`</td>`;
                        row +=`<td>&#8369;`+po[p].total+`</td>`;
                        row +=` <td>
                                    <a class="editBtn btn btn-sm btn-secondary" href="<?= site_url()?>admin/purchaseorder/formedit/`+po[p].id+`">Edit</a>
                                    <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#deletePO">Archive</button>
                                </td> </tr>`;
                var ordItems = poi.filter(function(o){
                    return o.pID == po[p].id
                });

                    var poitems = `<div>Date Recorded:&nbsp;`;
                    if(po[p].dateRecorded == null){
                        poitems +=` No recorded date.`;
                                    
                    }else{
                        poitems += po[p].dateRecorded;
                    }
                        poitems += `</div>`;
                        poitems +=`<table class="table table-bordered">`;
                        poitems +=`<thead class="thead-light"><tr>`;
                        poitems +=`<th>Name</th>
                                    <th>Qty</th>
                                    <th>Actual Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th>Delivery Status</th></tr> </thead>`;
                        poitems +=`<tbody>`;
                for(oi in ordItems){
                        poitems +=`<tr><td>`+ordItems[oi].spmName+`</td>`;
                        poitems +=`<td>`+ordItems[oi].qty+`</td>`;
                        poitems +=`<td>`+ordItems[oi].actual+`</td>`;
                        poitems +=`<td>&#8369; `+ordItems[oi].spmPrice+`</td>`;
                        poitems +=`<td>&#8369; `+ordItems[oi].subtotal+`</td>`;
                        poitems +=`<td>`+ordItems[oi].piStatus+`</td></tr>`;
                        }
                        poitems +=`</tbody>`;
                        poitems +=`</table>`;
                        poitems +=`</div></td></tr>`;
                    
            var accordion = `
                    <tr class="accordion" style="display:none">
                        <td colspan="6"> <!-- table row ng accordion -->
                            <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                                <div style="width:100%;overflow:auto;padding-left: 5%"> <!-- description, preferences, and addons container -->
                                    <div class="poItemsContent" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    `;

            $("#transTable > tbody").append(row);
            $("#transTable > tbody").append(accordion);
            $(".poItemsContent").last().append(poitems);
            
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
    var stocks = [];
    var supplier = [];
    var suppmerch = [];
    $(function() {
        $.ajax({
            url: '/admin/jsonPO',
            dataType: 'json',
            success: function(data) {
                var poLastIndex = 0;
                stocks = data.stock;
                supplier = data.supplier;
                suppmerch = data.suppmerch;
                $(".addMBtn").on('click', function() {
                    var spID = parseInt($(this).closest('.modal').find('.spID').val());
                    setBrochureContent(suppmerch.filter(sm => sm.spID == spID));
                    console.log('eye');
                });
            },
            error: function(response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
        $("#addBtn").on('click', function() {
            setSupplier(supplier);
        });
    });

    function setSupplier(supplier) {
        $(".spID").empty();
        console.log()
        $(".spID").append(`${supplier.map(sp => {
                return `<option value="${sp.spID}">${sp.spName}</option>`
            }).join('')}`);

    }

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
    </script>
</body>
