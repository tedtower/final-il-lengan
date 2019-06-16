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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newSupplier" id="addBtn" data-original-title style="margin:0;">Add New Source</button><br>

                            <br>
                            <table id="suppliertable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead class="thead-dark">
                                    <th><b class="pull-left">Name</b></th>
                                    <th><b class="pull-left">Number</b></th>
                                    <th><b class="pull-left">Email</b></th>
                                    <th><b class="pull-left">Address</b></th>
                                    <th><b class="pull-left">Status</b></th>
                                    <th><b class="pull-left">Actions</b></th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <p id="note"></p>
                            <!--End Table Content-->

                            <!--Start of Add Modal-->
                            <div class="modal fade bd-example-modal-lg" id="newSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Source</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?php echo base_url() ?>admin/supplier/add" method="get" accept-charset="utf-8">
                                            <div class="modal-body">
                                                <div class="form-row">
                                                    <!--Source name-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Supplier</span>
                                                        </div>
                                                        <input type="text" name="supplierName" id="supplierName" class="form-control form-control-sm" required>
                                                    </div>
                                                    <!--Contact Number-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Contact No.</span>
                                                        </div>
                                                        <input type="number" name="contactNum" id="contactNum" class="form-control form-control-sm" required>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <!--Email-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Email</span>
                                                        </div>
                                                        <input type="text" name="email" id="email" class="form-control form-control-sm">
                                                    </div>
                                                    <!--Status-->
                                                    <div class="input-group mb-3 col">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                Status</span>
                                                        </div>
                                                        <select name="status" id="status" class="form-control form-control-sm" required>
                                                            <option value="">Choose</option>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Address</span>
                                                    </div>
                                                    <input type="text" name="supplierAddress" id="supplierAddress" class="form-control form-control-sm">
                                                </div>
                                                <!--Merchandise-->
                                                <a class="addMerchandise btn btn-primary btn-sm" style="color:blue;margin:0">Add Merchandise Item</a>
                                                <!--Button to add row in the table-->
                                                <br><br>
                                                <table class="merchandisetable table table-sm table-borderless">
                                                    <!--Table containing the different input fields in adding trans items -->
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th width="26%">Item Name</th>
                                                            <th width="20%">Unit</th>
                                                            <th width="13%">Actual Qty</th>
                                                            <th width="13%">Price</th>
                                                            <th width="26%">Variance</th>
                                                            <th width="2%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End of Add Modal-->

                        <!--Start of Edit Modal-->
                        <div class="modal fade bd-example-modal-lg" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Source</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo base_url() ?>admin/supplier/edit" method="get" accept-charset="utf-8">
                                        <div class="modal-body">
                                            <input type="text" name="sourceID" class="form-control form-control-sm" hidden="hidden">
                                            <div class="form-row">
                                                <!--Source name-->
                                                <div class="input-group mb-3 col">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Supplier</span>
                                                    </div>
                                                    <input type="text" name="supplierName" id="supplierName" class="form-control form-control-sm" required>
                                                </div>
                                                <!--Contact Number-->
                                                <div class="input-group mb-3 col">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Contact No.</span>
                                                    </div>
                                                    <input type="number" name="contactNum" id="contactNum" class="form-control form-control-sm" required>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <!--Email-->
                                                <div class="input-group mb-3 col">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Email</span>
                                                    </div>
                                                    <input type="text" name="email" id="email" class="form-control form-control-sm">
                                                </div>
                                                <!--Status-->
                                                <div class="input-group mb-3 col">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                            Status</span>
                                                    </div>
                                                    <select name="status" id="status" class="form-control form-control-sm" required>
                                                        <option value="">Choose</option>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                        <option value="archived" hidden="hidden">Archive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Address</span>
                                                </div>
                                                <input type="text" name="supplierAddress" id="supplierAddress" class="form-control form-control-sm">
                                            </div>
                                            <!--Merchandise-->
                                            <a class="addMerchandise btn btn-primary btn-sm" style="color:blue;margin:0">Add Merchandise Item</a>
                                            <!--Button to add row in the table-->
                                            <br><br>
                                            <table class="merchandisetable table table-sm table-borderless">
                                                <!--Table containing the different input fields in adding trans items -->
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th width="26%">Item Name</th>
                                                        <th width="20%">Unit</th>
                                                        <th width="13%">Actual Qty</th>
                                                        <th width="13%">Price</th>
                                                        <th width="26%">Variance</th>
                                                        <th width="2%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End of Edit Modal-->

                    <!--Start of Delete Modal-->
                    <div class="modal fade" id="deleteSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Source</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="confirmDelete">
                                    <div class="modal-body">
                                        <h6 id="deleteSupplierItem"></h6>
                                        <p>Are you sure you want to delete this supplier?</p>
                                        <input type="text" name="supplierID" hidden="hidden">
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

<?php include_once('templates/scripts.php') ?>

<script>
    var supplier = <?= json_encode($supplier) ?>;
    console.log(supplier);
    var lastIndex = 0;
    var rowsPerPage = supplier.sources.length;
    $(document).ready(function() {
        $("#addBtn").on('click', function() {
            $("#newSupplier form")[0].reset();
            console.log(supplier);
        });
        $(".addMerchandise").on('click', function() {
            var row = `
        <tr data-id="">
            <td><input type="text" name="merchName[]" class="form-control form-control-sm" required></td>
            <td>
                <select class="form-control" name="merchUnit[]" required>
                    <option value="">Choose</option>
                        ${supplier.uom.map(uom => {
                            return `
                            <option value="${uom.uomID}">${uom.uomName} (${uom.uomAbbreviation})</option>`
                        }).join('')}
                </select>   
            </td>
            <td><input type="number" name="merchActualQty[]" class="form-control form-control-sm" required></td>
            <td><input type="number" name="merchPrice[]" class="form-control form-control-sm" required></td>
            <td>
                <select class="form-control" name="variance[]" required>
                <option value="">Choose</option>
                    ${supplier.stocks.map(stock => {
                        return `
                        <option value="${stock.stID}">${stock.stName}</option>`
                    }).join('')}
                </select>
            </td>
            <td><img class="exitBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
        </tr>
        `;
            $(this).closest(".modal").find(".merchandisetable > tbody").append(row);
            $(this).closest(".modal").find(".exitBtn").last().on('click', function() {
                $(this).closest("tr").remove();
            });
        });
        setTableData();
        $("#newSupplier form").on('submit', function(event) {
            event.preventDefault();
            var name = $(this).find("input[name='supplierName']").val();
            var contactNum = $(this).find("input[name='contactNum']").val();
            var email = $(this).find("input[name='email']").val();
            var address = $(this).find("input[name='supplierAddress']").val();
            var status = $(this).find("select[name='status']").val();
            var supplierMerchandise = [];
            for (var index = 0; index < $(this).find(".merchandisetable > tbody").children().length; index++) {
                supplierMerchandise.push({
                    merchName: $(this).find("input[name='merchName[]']").eq(index).val(),
                    merchUnit: $(this).find("select[name='merchUnit[]']").eq(index).val(),
                    merchActualQty: $(this).find("input[name='merchActualQty[]']").eq(index).val(),
                    merchPrice: $(this).find("input[name='merchPrice[]']").eq(index).val(),
                    stID: parseInt($(this).find("select[name='variance[]']").eq(index).val())
                });
            }
            $.ajax({
                url: "<?= site_url("admin/supplier/add") ?>",
                method: "post",
                data: {
                    name: name,
                    contactNum: contactNum,
                    email: email,
                    address: address,
                    status: status,
                    merchandises: JSON.stringify(supplierMerchandise)
                },
                dataType: "json",
                beforeSend: function() {
                    console.log(name, contactNum, email, address, status, supplierMerchandise);
                },
                success: function(data) {
                    console.log(data);
                    // inventory = data;
                    // lastIndex = 0;
                    // setTableData();
                },
                error: function(response, setting, error) {
                    console.log(response.responseText);
                    console.log(error);
                },
                complete: function() {
                    $("#newSupplier").modal("hide");
                }
            });
        });

        $("#editSupplier form").on('submit', function(event) {
            event.preventDefault();
            var id = $(this).find("input[name='sourceID']").val();
            var name = $(this).find("input[name='supplierName']").val();
            var contactNum = $(this).find("input[name='contactNum']").val();
            var email = $(this).find("input[name='email']").val();
            var address = $(this).find("input[name='supplierAddress']").val();
            var status = $(this).find("select[name='status']").val();
            var supplierMerchandise = [];
            for (var index = 0; index < $(this).find(".merchandisetable > tbody").children().length; index++) {
                var row = $(this).find(".merchandisetable > tbody > tr").eq(index);
                console.log(row);
                supplierMerchandise.push({
                    spmID: isNaN(parseInt(row.attr('data-id'))) ? (null) : parseInt(row.attr('data-id')),
                    merchName: row.find("input[name='merchName[]']").val(),
                    merchUnit: row.find("select[name='merchUnit[]']").val(),
                    merchActualQty: row.find("input[name='merchActualQty[]']").val(),
                    merchPrice: parseFloat(row.find("input[name='merchPrice[]']").val()),
                    stID: parseInt($(this).find("select[name='variance[]']").eq(index).val()),
                    del: isNaN(parseInt(row.attr('data-delete'))) ?  (null) : parseInt(row.attr('data-delete'))
                });
            }

            console.log(id, name, contactNum, email, address, status, supplierMerchandise);
            $.ajax({
                url: "<?= site_url("admin/supplier/edit") ?>",
                method: "post",
                data: {
                    id: id,
                    name: name,
                    contactNum: contactNum,
                    email: email,
                    address: address,
                    status: status,
                    merchandises: JSON.stringify(supplierMerchandise)
                },
                dataType: "json",
                beforeSend: function() {
                    console.log(name, contactNum, email, address, status, supplierMerchandise);
                },
                success: function(data) {
                    console.log(data);
                    // inventory = data;
                    // lastIndex = 0;
                    // setTableData();
                },
                error: function(response, setting, error) {
                    console.log(error);
                    console.log(response.responseText);
                },
                complete: function() {
                    $("#editSupplier").modal("hide");
                }
            });
        });
    });

    function setTableData() {
        var count = 0;
        //Populate Stock Table
        if ($("#suppliertable > tbody").children().length === 0) {
            for (lastIndex; lastIndex < supplier.sources.length; lastIndex++) {
                if (count < rowsPerPage) {
                    appendRow(supplier.sources[lastIndex]);
                    appendAccordion(supplier.merchandises.filter(merchandise => merchandise.spID === supplier.sources[lastIndex].spID));
                }
            }
            //Set accordion icon event to show accordion
            $(".accordionBtn").on('click', function() {
                if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
                    $(this).closest("tr").next(".accordion").css("display", "table-row");
                    $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
                } else {
                    $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                    $(this).closest("tr").next(".accordion").hide("slow");
                }
            });
            $(".editBtn").on("click", function() {
                $("#editSupplier form")[0].reset();
                $("#editSupplier .merchandisetable > tbody").empty();
                var sourceID = $(this).closest("tr").attr("data-id");
                setEditModal($("#editSupplier"), supplier.sources.filter(item => item.spID === sourceID)[0], supplier.merchandises.filter(merchandise => merchandise.spID === sourceID));
            });

            $('.deleteBtn').on('click',function() {
            var id = $(this).attr("id");
            $("#deleteSupplierItem").text(`Supplier Name:  ${$(this).attr("data-name")}`);
            // $("#deleteAddon").find("input[name='addonID']").val($(this).attr("data-id"));
            $("#confirmDelete").on('submit', function(event) {
                event.preventDefault();
                window.location = "<?php echo base_url();?>/admin/source/delete/" + id;
            });
        });
        } else {
            $("#suppliertable > tbody").empty();
        }
    }

    function appendRow(source) {
        var nullVal = false;
        var row = `${source.spID == null ? nullVal = true : `
    <tr data-id="${source.spID}">
        <td><a href="javascript:void(0)" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>${source.spName}</td>
        <td>${source.spContactNum}</td>
        <td>${source.spEmail == null ? source.spEmail = "N/A" : source.spEmail}</td>
        <td>${source.spAddress == null ? source.spAddress = "N/A" : source.spAddress}</td>
        <td>${source.spStatus}</td>
        <td>
            <button class="editBtn btn btn-secondary btn-sm" data-toggle="modal"
                data-target="#editSupplier">Edit</button>
            <button class="deleteBtn btn btn-warning btn-sm" data-toggle="modal" data-target="#deleteSupplier" id="${source.spID}" data-name="${source.spName}">Archive</button>
        </td>
    </tr>`}`;
        if (nullVal) {
            $("#note").text("No supplier items recorded!");
        } else {
            $("#note").text("");
            $("#suppliertable > tbody").append(row);
        }
    }

    function appendAccordion(merchandises) {
        var row = `
    <tr class="accordion" style="display:none;background: #f9f9f9">
        <td colspan="6">
        <div class="suppliermerch" style="margin:1% 5%">
                ${merchandises.length === 0 ? "No merchandise products are set for this supplier." : 
                `<span>Merchandise Items</span>
                    <table class="table table-bordered dt-responsive nowrap mt-2">
                        <thead style="background:white">
                            <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Actual Qty</th>
                            <th scope="col">Price</th>
                            </tr>
                        </thead>
                    <tbody>
                    ${merchandises.map(merchandise => {
                        return `
                        <tr>
                        <td>${merchandise.spmName}</td>
                        <td>${merchandise.uomName}</td>
                        <td>${merchandise.spmActualQty}</td>
                        <td>${merchandise.spmPrice}</td>
                        </tr> 
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
        </div>
        </td>
    </tr>
    `;
        $("#suppliertable > tbody").append(row);
    }

    function setEditModal(modal, source, merchandises) {
        modal.find("input[name='sourceID']").val(source.spID);
        modal.find("input[name='supplierName']").val(source.spName);
        modal.find("input[name='contactNum']").val(source.spContactNum);
        modal.find("input[name='email']").val(source.spEmail);
        modal.find("input[name='supplierAddress']").val(source.spAddress);
        modal.find("select[name='status']").find(`option[value='${source.spStatus}']`).attr("selected", "selected");

        merchandises.forEach(merchandise => {
            modal.find(".merchandisetable > tbody").append(`
        <tr class="supplierElem" data-id="${merchandise.spmID}">
            <td><input type="text" name="merchName[]" value="${merchandise.spmName}" class="form-control form-control-sm" required></td>
            <td>
                <select class="form-control" name="merchUnit[]" required>
                    <option value="">Choose</option>
                    ${supplier.uom.map(uom => {
                        return `
                    <option value="${uom.uomID}">${uom.uomName} (${uom.uomAbbreviation})</option>`
                    }).join('')}
                </select>
            </td>
            <td><input type="number" name="merchActualQty[]" value="${merchandise.spmActualQty}" class="form-control form-control-sm" required></td>
            <td><input type="number" name="merchPrice[]" value="${merchandise.spmPrice}" class="form-control form-control-sm" required></td>
            <td>
            <select class="form-control" name="variance[]" required>
                ${supplier.stocks.map(stock => {
                        return `
                        <option value="${stock.stID}">${stock.stName}</option>`
                    }).join('')}
            </select>
            </td>
            <td><img class="exitBtn delBtn" onclick="deleteItem(this)" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
        </tr>
        `);
            modal.find("select[name='variance[]']").last().find(`option[value='${merchandise.stID}']`).attr("selected", "selected");
            modal.find("select[name='merchUnit[]']").last().find(`option[value='${merchandise.uomID}']`).attr("selected", "selected");
        });

    }

    function deleteItem(element) {
        var el = $(element).closest("tr");
        $(el).attr("data-delete", "0");
        $(el).addClass("deleted");

        $(".deleted").find("input").attr("disabled", "disabled");
        $(".deleted").find("input").removeAttr("class");
        $(".deleted").find("input").addClass("form-control form-control-sm");

        var deleted = $(".deleted");
        for(var i = 0; i <= deleted.length - 1; i++) {
            deleted[i].style.textDecoration = "line-through";
            deleted[i].style.opacity = "0.6";
        }
    }
</script>
</body>