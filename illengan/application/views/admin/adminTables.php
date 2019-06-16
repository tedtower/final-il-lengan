<!--End Side Bar-->
<body style="background:white">

    <!--End Side Bar-->
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
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewTable" data-original-title style="margin:0;">Add Table</button><br>
                        <br>
                        <table id="tablesTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <th><b class="pull-left">Table Code</b></th>
                                <th><b class="pull-left">Actions</b></th>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                        <!--Modals-->
                        <!--Modal for Add New Table-->
                        <div class="modal fade" id="addNewTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Table</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="formAdd" action="<?= site_url('admin/tables/add') ?>" method="post" accept-charset="utf-8">
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <!--Container of Table Code-->
                                                <!--Table Code-->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Table Code</span>
                                                    </div>
                                                    <input type="text" name="tableCode" id="tableCode" class="form-control form-control-sm">
                                                </div>
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
                        <!--End of Modal "Add Table"-->
                        <!--Start of Modal "Edit Table"-->
                        <div class="modal fade" id="editTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Table</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="formEdit" action="<?= site_url('admin/tables/edit') ?>" method="post" accept-charset="utf-8">
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <!--Container of Table Code-->
                                                <!--Table Code-->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Table Code</span>
                                                    </div>
                                                    <input class="form-control" type="text" name="prevTableCode" hidden="hidden">
                                                    <input class="form-control" type="text" name="tableCode" value="">
                                                </div>
                                            </div>
                                            <!--End of Mpdal "Edit Table"-->

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-success btn-sm" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!--Delete Confirmation Box-->
                        <div class="modal fade" id="deleteTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Table</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="confirmDelete">
                                        <div class="modal-body">
                                            <h6 id="deleteTableCode"></h6>
                                            <p>Are you sure you want to delete this table?</p>
                                            <input type="text" name="tableCode" hidden="hidden">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <?php
                        // $error = $this->session->flashdata('error');
                        // $success = $this->session->flashdata('success');
                        // if (!empty($error)) {
                        ?>
                <div class="alert alert-danger" style="margin: 80px; text-align: center; ">
                    <strong><?php //echo $error; 
                            ?></strong>
                </div>
                <?php

                ?>
                <div class="alert alert-success" style="margin: 80px; text-align: center; ">
                    <strong><?php
                            ?></strong>
                </div>
                <?php
                ?> -->
                <!--End Confirmation Modal-->
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
<script>
    var tables = [];
    $(function() {
        getTables();
        $("#confirmDelete").on('submit', function(event) {
            event.preventDefault();
            var tableCode = $(this).find("input").val();
            $.ajax({
                url: '<?= site_url('admin/addons/delete') ?>',
                method: 'post',
                data: {
                    tableCode: tableCode
                },
                dataType: 'json',
                success: function(data) {
                    tables = data;
                    setTableData();
                },
                error: function(response, setting, errorThrown) {
                    console.log(response.responseText);
                    console.log(errorThrown);
                }
            });
        });

        $("#formEdit").on('submit', function(event) {
            event.preventDefault();
            var tableCode = $(this).find("input[name='prevTableCode']").val();
            var newTableCode = $(this).find("input[name='tableCode']").val();
            $.ajax({
                url: '<?= site_url('admin/tables/edit') ?>',
                method: 'post',
                data: {
                    prevTableCode: tableCode,
                    tableCode: newTableCode
                },
                dataType: 'json',
                success: function(data) {
                    tables = data;
                    setTableData();
                },
                error: function(response, setting, errorThrown) {
                    console.log(response.responseText);
                    console.log(errorThrown);
                }
            });
        });
        $("#formAdd").on('submit', function(event) {
            event.preventDefault();
            var tableCode = $(this).find("input[name='tableCode']").val();
            $.ajax({
                url: '<?= site_url('admin/tables/add') ?>',
                method: 'post',
                data: {
                    tableCode: tableCode
                },
                dataType: 'json',
                success: function(data) {
                    tables = data;
                    setTableData();
                },
                error: function(response, setting, errorThrown) {
                    console.log(response.responseText);
                    console.log(errorThrown);
                }
            });
        });
    });

    function getTables() {
        $.ajax({
            url: "<?= site_url('admin/tables/getTables') ?>",
            method: "post",
            dataType: "json",
            success: function(data) {
                tables = data;
                setTableData(tables);
            },
            error: function(response, setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
        });
    }

    function setTableData() {
        if ($("#tablesTable > tbody").children().length > 0) {
            $("#tablesTable > tbody").empty();
        }
        tables.forEach(table => {
            $("#tablesTable > tbody").append(`
        <tr data-id="${table.tableCode}">
            <td>${table.tableCode}</td>
            <td>
                <!--Action Buttons-->
                <div class="onoffswitch">
                    <!--Edit button-->
                    <button class="updateBtn btn btn-secondary btn-sm" data-toggle="modal"
                        data-target="#editTable">Edit</button>
                    <!--Delete button-->
                    <button class="deleteBtn btn btn-warning btn-sm" data-toggle="modal"
                        data-target="#deleteTable">Archived</button>
                </div>
            </td>
        </tr>`);
            $(".updateBtn").last().on('click', function() {
                $("input[name='prevTableCode']").val($(this).closest("tr").attr("data-id"));
                $("#editTable").find("input[name='tableCode']").val($(this).closest("tr").attr("data-id"));
            });
            
            $(".deleteBtn").last().on('click', function() {
                $("#deleteTableCode").text(`Delete table code ${$(this).closest("tr").attr("data-id")}`);
                $("#deleteTable").find("input[name='tableCode']").val($(this).closest("tr").attr("data-id"));
            });
        });
    }
    // $('table tbody tr  td').on('click', function() {
    //     $("#myModal").modal("show");
    //     $("#txtfname").val($(this).closest('tr').children()[0].textContent);
    //     $("#txtlname").val($(this).closest('tr').children()[1].textContent);
    // });
</script>
</body>
</html>