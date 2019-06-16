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
                            <div class="card-content">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newMCategory" data-original-title style="margin:0" id="addCategroy">Add Category</button>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newSCategory" data-original-title style="margin:0" id="addCategroy">Add Subcategory</button>
                                <br>
                                <br>
                                <table id="categTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead class="thead-dark">
                                        <th><b class="pull-left">Category Name</b></th>
                                        <th><b class="pull-left">Number of Items</b></th>
                                        <th><b class="pull-left">Status</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if(isset($category)){
                                            foreach($category as $category){
                                        ?>
                                        <tr data-id="<?= $category['ctID'];?>">
                                            <td><?php echo $category['ctName']?></td>
                                            <td><?php echo $category['menu_no']?></td>
                                            <td><?php echo $category['ctStatus']?></td>
                                            <td>
                                                <button class="btn btn-secondary btn-sm" name="editCategory" data-toggle="modal" data-target="#editCategory" data-id="<?php echo $category['ctID']?>">Edit</button>
                                                <button class="deleteBtn btn btn-warning btn-sm" data-toggle="modal" data-target="#deleteCategory" id="<?php echo $category['ctID'];?>" data-name="<?php echo $category['ctName'];?>">Archive</button>
                                            </td>
                                        </tr>
                                    <?php }} ?>
                                    </tbody>
                                </table>
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
                                            <form id="formAdd" action="<?= site_url('admin/menucategories/add') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Category Name</span>
                                                            </div>
                                                            <input type="text" name="ctName" id="ctName" class="form-control form-control-sm">
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
                                            
                                            <form id="formAdd" action="<?= site_url('admin/submenucategories/add') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Main Category</span>
                                                            </div>
                                                            <select name="subcatID" class="form-control form-control-sm" required>
                                                                <option value="">Choose</option>
                                                            <?php if(isset($maincategory)){
                                                                foreach($maincategory as $row){
                                                                ?>
                                                                <option value="<?php echo $row['ctID'];?>"><?php echo $row['ctName'];?></option>
                                                                <?php }} ?>
                                                            </select>
                                                           
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Category Name</span>
                                                            </div>
                                                            <input type="text" name="ctName" id="ctName" class="form-control form-control-sm">
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
                                            <form id="formAdd" action="<?= site_url('admin/menucategories/edit') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                <input type="hidden" name="ctID" id="ctID" value="" />
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Category Name</span>
                                                            </div>
                                                            <input type="text" name="new_name" id="new_name"class="form-control form-control-sm">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Status</span>
                                                            </div>
                                                            <select  name="new_status" id="new_status" class="form-control form-control-sm">
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
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="confirmDelete">
                                                <div class="modal-body">
                                                    <h6 id="deleteCategoryItem"></h6>
                                                    <p>Are you sure you want to delete this category?</p>
                                                    <input type="text" name="categoryID" hidden="hidden">
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
        $('.deleteBtn').click(function() {
            var id = $(this).attr("id");
            $("#deleteCategoryItem").text(`delete ${$(this).attr("data-name")}`);
            // $("#deleteAddon").find("input[name='addonID']").val($(this).attr("data-id"));
            $("#confirmDelete").on('submit', function(event) {
                event.preventDefault();
                window.location = "<?php echo base_url();?>/admin/menucategories/delete/" + id;
            });
        });   
    });
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
    </script>
    </body>