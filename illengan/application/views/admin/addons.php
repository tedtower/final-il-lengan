
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
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newAddon"
                                    data-original-title style="margin:0;">Add Addons</button>
                                <br>
                                <br>
            <table id="addonTable" class="table table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Addon</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(isset($addon)){
                        foreach($addon as $addon){
                    ?>
                    <tr data-id ="<?php echo $addon['aoID'];?>">
                        <td><?php echo $addon['aoName']?></td>
                        <td><?php echo $addon['aoPrice']?></td>
                        <td><?php echo $addon['aoCategory']?></td>
                        <td><?php echo $addon['aoStatus']?></td>
                        <td>
                            <button class="btn btn-default btn-sm" name="editAddon" data-toggle="modal" data-target="#editAddon" data-id="<?php echo $addon['aoID']?>">Edit</button>
                            <button class="deleteBtn btn btn-warning btn-sm" data-toggle="modal" data-target="#deleteAddon" id="<?php echo $addon['aoID'];?>" data-name="<?php echo $addon['aoName'];?>">Archived</button>
                        </td>
                    </tr>
                <?php }} ?>                    
                </tbody>
            </table>
            <!--Start of Modal "Add Menu"-->
            <div class="modal fade bd-example-modal" id="newAddon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document"> 
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Addon</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo base_url()?>admin/addon/add" method="post" accept-charset="utf-8">
                            <div class="modal-body">
                                <!--Addon Name-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Name</span>
                                    </div>
                                    <input type="text" name="aoName" class="form-control form-control-sm">
                                </div>
                                <!--Price-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Price</span>
                                    </div>
                                    <input type="number" name="aoPrice" class="form-control form-control-sm">
                                </div>   
                                <!--Category-->                                                                                 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Category</span>
                                    </div>
                                    <select class="custom-select" name="aoCategory">
                                        <option value="" selected>Choose</option>
                                        <option value="drinks">Drink</option>
                                        <option value="food">Food</option>
                                    </select>
                                </div>
                                <!--Status-->                                                                                 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Status</span>
                                    </div>
                                    <select class="custom-select" name="aoStatus">
                                        <option value="" selected>Choose</option>
                                        <option value="available">Available</option>
                                        <option value="unavailable">Unavailable</option>
                                    </select>
                                </div>
        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-success btn-sm"
                                        type="submit">Insert</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!--End of Modal "Add Transaction"-->

<!--Start of Modal "Add Menu"-->
            <div class="modal fade bd-example-modal" id="editAddon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Addon</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo base_url()?>admin/addon/edit" method="post" accept-charset="utf-8">
                            <div class="modal-body">
                                <input type="hidden" name="aoID" id="aoID" value="" />
                                <!--Addon Name-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Name</span>
                                    </div>
                                    <input type="text" name="aoName" id="aoName" class="form-control form-control-sm">
                                </div>
                                <!--Price-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Price</span>
                                    </div>
                                    <input type="number" name="aoPrice" id="aoPrice" class="form-control form-control-sm">
                                </div>   
                                <!--Category-->                                                                                 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Category</span>
                                    </div>
                                    <select class="custom-select" name="aoCategory" id="aoCategory">
                                        <option value="" selected>Choose</option>
                                        <option value="drinks">Drink</option>
                                        <option value="food">Food</option>
                                    </select>
                                </div>
                                <!--Status-->                                                                                 
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Status</span>
                                    </div>
                                    <select class="custom-select" name="aoStatus" id="aoStatus">
                                        <option value="" selected>Choose</option>
                                        <option value="available">Available</option>
                                        <option value="unavailable">Unavailable</option>
                                        <option value="archived" hidden="hidden">Archived</option>
                                    </select>
                                </div>
        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-success btn-sm"
                                        type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!--End of Modal "Add Transaction"-->

        <!--Start of Delete Modal-->
            <div class="modal fade" id="deleteAddon" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Addon</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="confirmDelete">
                            <div class="modal-body">
                                <h6 id="deleteAddonItem"></h6>
                                <p>Are you sure you want to delete this addon?</p>
                                <input type="text" name="addonID" hidden="hidden">
                                <!-- <div>
                                    Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm">
                                </div> -->
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

<?php include_once('templates/scripts.php') ?>
<script>
    $(document).ready(function() {
        $('.deleteBtn').click(function() {
            var id = $(this).attr("id");
            $("#deleteAddonItem").text(`delete ${$(this).attr("data-name")}`);
            // $("#deleteAddon").find("input[name='addonID']").val($(this).attr("data-id"));
            $("#confirmDelete").on('submit', function(event) {
                event.preventDefault();
                window.location = "<?php echo base_url();?>/admin/addons/delete/" + id;
            });
        });   
    });

        var tuples = ((document.getElementById('addonTable')).getElementsByTagName('tbody'))[0].getElementsByTagName('tr');
        var tupleNo = tuples.length;
        var editButtons = document.getElementsByName('editAddon');
        var editModal = document.getElementById('editAddon');
        for (var x = 0; x < tupleNo; x++) {
            editButtons[x].addEventListener("click", showEditModal);
        }

        function showEditModal(event) {
            var row = event.target.parentElement.parentElement;
            document.getElementById('aoName').value = row.firstElementChild.innerHTML;
            document.getElementById('aoPrice').value = row.firstElementChild.nextElementSibling.innerHTML;
            document.getElementById('aoCategory').value = row.firstElementChild.nextElementSibling.nextElementSibling.innerHTML;
            document.getElementById('aoStatus').value = row.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML;
            document.getElementById('aoID').value = event.target.getAttribute('data-id');
        }

    </script>
    </body>
