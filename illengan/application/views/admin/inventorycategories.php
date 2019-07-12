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
                                <div class="card-content" id="categTable">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newMCategory" data-original-title style="margin:0" id="addCategroy">Add Category</button>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newSCategory" data-original-title style="margin:0" id="addCategroy">Add Subcategory</button>
                                    <br>
                                    <!--Search-->
                                    <div id="categTable" style="width:25%; float:right; border-radius:5px">
                                        <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                    </div>
                                    <br><br>
                                    <table id="categTable" class="table table-bordered dt-responsive text-center nowrap" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <th><b class="pull-left">Category Name</b></th>
                                            <th><b class="pull-left">Number of Items</b></th>
                                            <th><b class="pull-left">Status</b></th>
                                            <th><b class="pull-left">Actions</b></th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div id="pagination" style="float:right"></div>
                                    <!--End Table Content-->

                                    <!--Start of Modal "Add Transaction"-->
                                    <div class="modal fade bd-example" id="newMCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="formAdd" action="<?= site_url('admin/stockcategories/add') ?>" method="post" accept-charset="utf-8">
                                                    <div class="modal-body">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Category Name</span>
                                                            </div>
                                                            <input type="text" name="ctName" id="ctName" class="form-control form-control-sm" required pattern="[a-zA-Z][a-zA-Z\s]*">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-success btn-sm" type="submit">Add</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade bd-example" id="newSCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form id="formAdd" action="<?= site_url('admin/substockcategories/add') ?>" method="post" accept-charset="utf-8">
                                                    <div class="modal-body">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Main Category</span>
                                                            </div>
                                                            <select name="subcatID" class="form-control form-control-sm" required pattern="[a-zA-Z][a-zA-Z\s]*">
                                                                <option value="">Choose</option>
                                                                <?php if (isset($maincategory)) {
                                                                    foreach ($maincategory as $row) {
                                                                        ?>
                                                                        <option value="<?php echo $row['ctID']; ?>"><?php echo $row['ctName']; ?></option>
                                                                    <?php }
                                                                } ?>
                                                            </select>

                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Category Name</span>
                                                            </div>
                                                            <input type="text" name="ctName" id="ctName" class="form-control form-control-sm" required pattern="[a-zA-Z][a-zA-Z\s]*">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-success btn-sm" type="submit">Add</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End of Modal "Add Menu Category"-->

                                    <!--Start of Modal "Edit Transaction"-->
                                    <div class="modal fade bd-example" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="formAdd" action="<?= site_url('admin/stockcategories/edit') ?>" method="post" accept-charset="utf-8">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="ctID" id="ctID" value="" />
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Category Name</span>
                                                            </div>
                                                            <input type="text" name="new_name" id="new_name" class="form-control form-control-sm" required pattern="[a-zA-Z][a-zA-Z\s]*">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Status</span>
                                                            </div>
                                                            <select name="new_status" id="new_status" class="form-control form-control-sm" required>
                                                                <option value="" selected>Choose</option>
                                                                <option value="active">Active</option>
                                                                <option value="archived" hidden="hidden">Archived</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-success btn-sm" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Start of Delete Modal-->
                                    <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Archive Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form id="confirmDelete">
                                                    <div class="modal-body">
                                                        <h6 id="deleteCategoryItem"></h6>
                                                        <p>Are you sure you want to archive this category?</p>
                                                        <input type="text" name="categoryID" hidden="hidden">
                                                        <div>
                                                            Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning btn-sm">Archive</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End of Delete Modal-->

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
                $('#pagination').on('click', 'a', function(e) {
                    e.preventDefault();
                    var pageNum = $(this).attr('data-ci-pagination-page');
                    createPagination(pageNum);
                });

                function createPagination(pageNum) {
                    $.ajax({
                        url: '<?= base_url() ?>admin/stocks/loadDataCategories/' + pageNum,
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                            $('#pagination').html(data.pagination);
                            var cat = data.category;
                            setCategData(cat);
                            console.log('category:', cat);
                        },
                        error: function(response, setting, errorThrown) {
                            console.log(errorThrown);
                            console.log(response.responseText);
                        }
                    });
                }
            });

            function setCategData(data) {
                $("table#categTable > tbody").empty();
                for (cat in data) {
                    var row1 = ` <tr class="ic-level-1" data-id="` + data[cat].ctID + `">`;
                    row1 += ` <td>` + data[cat].ctName + `</td>`;
                    row1 += `<td>` + data[cat].stockCount + `</td>`;
                    row1 += `<td>` + data[cat].ctStatus + `</td>`;
                    row1 += `<td>
                <button class="btn btn-secondary btn-sm" name="editCategory" data-toggle="modal" data-target="#editCategory" data-id="` + data[cat].ctID + `">Edit</button>
                <button class="deleteBtn btn btn-warning btn-sm" data-toggle="modal" data-target="#deleteCategory" id="` + data[cat].ctID + `" data-name="` + data[cat].ctName + `">Archive</button>
                </td></tr>`;
                    $("table#categTable  tbody").append(row1);

                }
                $('.deleteBtn').click(function() {
                    var id = $(this).attr("id");
                    $("#deleteCategoryItem").text(`Archive ${$(this).attr("data-name")}`);
                    // $("#deleteAddon").find("input[name='addonID']").val($(this).attr("data-id"));
                    $("#confirmDelete").on('submit', function(event) {
                        event.preventDefault();
                        window.location = "<?php echo base_url(); ?>/admin/stockcategories/delete/" + id;
                    });
                });
            }
            var tuples = ((document.getElementById('categTable')).getElementsByTagName('tbody'))[0].getElementsByTagName('tr');
            var tupleNo = tuples.length;
            var editButtons = document.getElementsByName('editCategory');
            var editModal = document.getElementById('editCategory');
            for (var x = 0; x < tupleNo; x++) {
                editButtons[x].addEventListener("click", showEditModal);
            }

            function showEditModal(event) {
                var row = event.target.parentElement.parentElement;
                document.getElementById('new_name').value = row.firstElementChild.innerHTML;
                document.getElementById('new_status').value = row.firstElementChild.nextElementSibling.nextElementSibling.innerHTML;
                document.getElementById('ctID').value = event.target.getAttribute('data-id');
            }
            //Search Function
            $("#categTable input[name='search']").on("keyup", function() {
                var string = $(this).val().toLowerCase();

                $("#categTable .ic-level-1").each(function(index) {
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