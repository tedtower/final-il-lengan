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
                                <!--Start of Modal "Add Stock Spoilages"-->
                                <div class="modal fade bd-example-modal-lg" id="addEditMenuStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Menu-Stock</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formAdd" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Button to add launche the brochure modal-->
                                                    <a class="addItemBtn btn btn-default btn-sm" data-toggle="modal" data-target="#brochureMenu" data-original-title style="margin:0">Add
                                                        Menu Items</a>
                                                    <br><br>
                                                    <table class="stockSpoilageTable table table-sm table-borderless">
                                                        <!--Table containing the different input fields in adding stock spoilages -->
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Menu Name</th>
                                                                <th>Stock Name</th>
                                                                <th>Qty</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="ic-level-2">
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
                                <!--End of Modal "Add Stock Spoilage"-->

                                <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal" id="brochureMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Menu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div style="margin:1% 3%" class="ic-level-2">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success btn-sm">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Brochure Modal"-->

                                <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal" id="brochureStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div style="margin:1% 3%" class="ic-level-2">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success btn-sm">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Brochure Modal"-->
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
            var row = `<tr class="menuStockTable ic-level-1" data-id1="`+item[p].prID+`" data-id2="`+item[p].stockitem+`">`;
            row += ` <td>`+item[p].prefname+`</td>`;
            row += ` <td>`+item[p].stockitemname+`</td>`;
            row += ` <td>`+item[p].qty+`</td>`;
            row += ` <td>
            <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal" data-target="#editMS">Edit</button>
            <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#deleteMS">Delete</button>
            </td>
            </tr>`;
            $('#menuStockTable > tbody').append(row);
        }
    }
    }

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
