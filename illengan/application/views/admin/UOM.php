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
                            <div class="card-content" id="uomTable">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newUOM" data-original-title style="margin:0;">Add UOM</button>
                                <br><br>
                                <!--Search-->
                                <div id="uomTable" style="width:25%; float:right; border-radius:5px">
                                    <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                </div>
                                <br><br>
                                <table id="uomTable" class="table table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th class="text-left pl-3">Name</th>
                                            <th>Abbreviation</th>
                                            <th>Variant</th>
                                            <th>Store</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div id="pagination" style="float:right"></div>
                                <!--Start of Modal "Add Menu"-->
                                <div class="modal fade bd-example-modal" id="newUOM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Unit of Measurement</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url() ?>admin/measurement/add" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Addon Name-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Name</span>
                                                        </div>
                                                        <input type="text" name="uomName" class="form-control form-control-sm" required pattern="[a-zA-Z][a-zA-Z\s]*">
                                                    </div>
                                                    <!--Price-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Abbreviation</span>
                                                        </div>
                                                        <input type="text" name="uomAbbreviation" class="form-control form-control-sm" required pattern="[a-zA-Z][a-zA-Z\s]*">
                                                    </div>
                                                    <!--Category-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Variant</span>
                                                        </div>
                                                        <select class="custom-select" name="uomVariant">
                                                            <option value="" selected>Choose</option>
                                                            <option value="liquid">Liquid</option>
                                                            <option value="solid">Solid</option>
                                                        </select>
                                                    </div>
                                                    <!--Status-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Store</span>
                                                        </div>
                                                        <select class="custom-select" name="uomStore" required>
                                                            <option value="" selected>Choose</option>
                                                            <option value="set">Set</option>
                                                            <option value="single">Single</option>
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Add Transaction"-->

                                <!--Start of Modal "Edit Measurement"-->
                                <div class="modal fade bd-example-modal" id="editUOM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Unit of Measurement</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url() ?>admin/measurement/edit" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <input type="text" name="uomID" id="uomID" hidden="hidden">
                                                    <!--Addon Name-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Name</span>
                                                        </div>
                                                        <input type="text" name="uomName" id="uomName" class="form-control form-control-sm" required pattern="[a-zA-Z][a-zA-Z\s]*">
                                                    </div>
                                                    <!--Price-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Abbreviation</span>
                                                        </div>
                                                        <input type="text" name="uomAbbreviation" id="uomAbbreviation" class="form-control form-control-sm" required pattern="[a-zA-Z][a-zA-Z\s]*">
                                                    </div>
                                                    <!--Category-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Variant</span>
                                                        </div>
                                                        <select class="custom-select" name="uomVariant" id="uomVariant">
                                                            <option value="" selected>Choose</option>
                                                            <option value="liquid">Liquid</option>
                                                            <option value="solid">Solid</option>
                                                        </select>
                                                    </div>
                                                    <!--Status-->
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Store</span>
                                                        </div>
                                                        <select class="custom-select" name="uomStore" id="uomStore">
                                                            <option value="" selected>Choose</option>
                                                            <option value="set">Set</option>
                                                            <option value="single">Single</option>
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Add Transaction"-->

                                <!--Start of Delete Modal-->
                                <div class="modal fade" id="deleteUOM" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Unit of Measurement</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="confirmDelete">
                                                <div class="modal-body">
                                                    <h6 id="deleteAddonItem"></h6>
                                                    <p>Are you sure you want to delete this unit of measurement?</p>
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
                    url: '<?= base_url() ?>admin/stocks/loadDataUnitMeasures/' + pageNum,
                    type: 'get',
                    dataType: 'json',
                    success: function(data) {
                        $('#pagination').html(data.pagination);
                        var uom = data.umeasures;
                        setMeasuresData(uom);
                        console.log('uom:', uom);
                    },
                    error: function(response, setting, errorThrown) {
                        console.log(errorThrown);
                        console.log(response.responseText);
                    }
                });
            }
        });

        function setMeasuresData(data) {
            $("table#uomTable > tbody").empty();
            for (uom in data) {
                var row1 = ` <tr class="ic-level-1" data-id="` + data[uom].uomID + `" class="text-center">`;
                row1 += ` <td  class="text-left pl-3">` + data[uom].uomName + `</td>`;
                row1 += `<td>` + data[uom].uomAbbreviation + `</td>`;
                if (data[uom].uomVariant == null) {
                    row1 += `<td></td>`;
                } else {
                    row1 += `<td>` + data[uom].uomVariant + `</td>`;
                }
                if (data[uom].uomStore == null) {
                    row1 += `<td></td>`;
                } else {
                    row1 += `<td>` + data[uom].uomStore + `</td>`;
                }
                row1 += `<td>
                        <button class="btn btn-default btn-sm" name="editUOM" data-toggle="modal" data-target="#editUOM" data-id="` + data[uom].uomID + `">Edit</button>
                        <button class="deleteBtn btn btn-warning btn-sm" data-toggle="modal" data-target="#deleteUOM" id="` + data[uom].uomID + `" data-name="` + data[uom].uomName + `">Archive</button>
                        </td></tr>`;
                $("table#uomTable  tbody").append(row1);
            }

            $('.deleteBtn').click(function() {
                var id = $(this).attr("id");
                $("#deleteAddonItem").text(`delete ${$(this).attr("data-name")}`);
                // $("#deleteAddon").find("input[name='addonID']").val($(this).attr("data-id"));
                $("#confirmDelete").on('submit', function(event) {
                    event.preventDefault();
                    window.location = "<?php echo base_url(); ?>/admin/measurement/delete/" + id;
                });
            });


            var tuples = ((document.getElementById('uomTable')).getElementsByTagName('tbody'))[0].getElementsByTagName('tr');
            var tupleNo = tuples.length;
            var editButtons = document.getElementsByName('editUOM');
            var editModal = document.getElementById('editUOM');
            for (var x = 0; x < tupleNo; x++) {
                editButtons[x].addEventListener("click", showEditModal);
            }
        };

        function showEditModal(event) {
            var row = event.target.parentElement.parentElement;
            document.getElementById('uomName').value = row.firstElementChild.innerHTML;
            document.getElementById('uomAbbreviation').value = row.firstElementChild.nextElementSibling.innerHTML;
            document.getElementById('uomVariant').value = row.firstElementChild.nextElementSibling.nextElementSibling.innerHTML;
            document.getElementById('uomStore').value = row.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML;
            document.getElementById('uomID').value = event.target.getAttribute('data-id');
        }
        //Search Function
        $("#uomTable input[name='search']").on("keyup", function() {
            var string = $(this).val().toLowerCase();

            $("#uomTable .ic-level-1").each(function(index) {
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