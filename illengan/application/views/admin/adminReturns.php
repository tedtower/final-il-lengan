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
                                <a class="addReturnsbtn btn btn-primary btn-sm" href="<?= site_url('admin/returns/formadd') ?>" style="margin:0">Add Return</a>
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
                                        <th><b class="pull-left">Supplier</b></th>
                                        <th><b class="pull-left">Date</b></th>
                                        <th><b class="pull-left">Total</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody class="ic-level-2">
                                    </tbody>
                                </table>
                                <!--End Table Content-->

                                <!--Start of Modal "Add Returns"-->
                                <div class="modal fade bd-example-modal-lg" id="addReturns" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Returns</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--Modal Content-->
                                            <form id="formAdd" action="<?= site_url('admin/returns/add') ?>" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Source Name-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Supplier</span>
                                                            </div>
                                                            <select class="spID form-control form-control-sm  border-left-0" name="spID">
                                                                <option value="" selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Invoice Type-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Delivery Receipt</span>
                                                            </div>
                                                            <input type="text" name="receiptNo" id="receiptNo" class="form-control form-control-sm" value="0" readonly="readonly">
                                                        </div>
                                                    </div>

                                                    <!-- Customer Name -->
                                                    <div class="form-row">
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Transaction Date</span>
                                                            </div>
                                                            <input type="date" name="tDate" id="tDate" class="form-control form-control-sm" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Remarks</span>
                                                            </div>
                                                            <textarea name="tRemarks" id="tRemarks" class="form-control form-control-sm"> </textarea>
                                                        </div>
                                                    </div>

                                                    <!--Button to add row in the table-->
                                                    <a id="addReturnStock" class="addReturnStock btn btn-default btn-sm" data-toggle="modal" data-target="#stockItemsModal" data-original-title style="margin:0" id="">Add Items</a>
                                                    <br><br>
                                                    <!--Table containing the different input fields in adding PO items -->
                                                    <table class="returnsTable table table-sm table-borderless">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th width="27%">Item Name</th>
                                                                <th width="20%">Qty</th>
                                                                <th width="23%">Unit</th>
                                                                <th>Qty per Unit</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>

                                                    <!--Total of the trans items-->
                                                    <span>Total: &#8369;<span id="total" class="total"> </span></span>
                                                    <!--Modal Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal "Add Returns" -->

                                <!--Start of Modal "Edit Returns"-->
                                <div class="modal fade bd-example-modal-lg" id="editReturns" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Returns</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--Modal Content-->
                                            <form id="formAdd" action="<?= site_url('admin/returns/edit') ?>" method="post" accept-charset="utf-8">
                                                <input type="hidden" name="trID" id="trID">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Source Name-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Supplier</span>
                                                            </div>
                                                            <select class="spID form-control form-control-sm  border-left-0" name="spID" disabled>
                                                                <option value="" selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Invoice Type-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Delivery Receipt</span>
                                                            </div>
                                                            <input type="text" name="receiptNo" id="receiptNo" class="form-control form-control-sm" disabled>
                                                        </div>
                                                    </div>

                                                    <!-- Customer Name -->
                                                    <div class="form-row">
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Transaction Date</span>
                                                            </div>
                                                            <input type="date" name="tDate" id="tDate" class="form-control form-control-sm" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Remarks</span>
                                                            </div>
                                                            <textarea name="tRemarks" id="tRemarks" class="form-control form-control-sm"> </textarea>
                                                        </div>
                                                    </div>

                                                    <!--Button to add row in the table-->
                                                    <a id="addReturnStock" class="addReturnStock btn btn-default btn-sm" data-toggle="modal" data-target="#stockItemsModal" data-original-title style="margin:0" id="">Add Items</a>

                                                    <a id="resolveBtn" class="resolveBtn btn btn-default btn-sm">Resolve
                                                        Items</a>
                                                    <br><br>
                                                    <!--Table containing the different input fields in adding PO items -->
                                                    <table class="returnsTable table table-sm table-borderless">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th width="27%">Item Name</th>
                                                                <th width="20%">Qty</th>
                                                                <th width="23%">Unit</th>
                                                                <th>Qty per Unit</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>

                                                    <!--Total of the trans items-->
                                                    <span>Total: &#8369;<span id="total1" class="total1"> </span></span>
                                                    <!--Modal Footer-->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal "Edit Returns" -->

                                <!--Start of Stock Items Modal"-->
                                <div class="modal fade bd-example-modal-lg" id="stockItemsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock Items</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="stockItemsForm" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div style="margin:1% 3%" id="list">
                                                        <!--checkboxes-->
                                                        <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample
                                                            data 2</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="getSelected btn btn-success btn-sm" data-dismiss="modal" onclick="getSelectedStocks();">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Stock Items Modal"-->


                                <!--Start of Stock Items Modal"-->
                                <div class="modal fade bd-example-modal-lg" id="stockItemsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock Items</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="stockItemsForm" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div style="margin:1% 3%" id="list">
                                                        <!--checkboxes-->
                                                        <label style="width:96%"><input type="checkbox" class="mr-2" value="">Sample
                                                            data 2</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="getSelectedStocks();">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Stock Items Modal"-->
                                <!--Start of Delete Modal-->
                                <div class="modal fade" id="deleteReturns" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Return</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formDelete" action="<?= site_url('admin/transaction/delete') ?>">
                                                <div class="modal-body">
                                                    <h6 id="deleteReturnItem"></h6>
                                                    <p>Are you sure you want to delete this return?</p>
                                                    <input type="number" name="tID" value="" hidden="hidden">
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

                                <!--Start of Resolve Modal-->
                                <div class="modal fade" id="resolveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background: rgba(0, 0, 0, 0.5);">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Resolve a Return</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 id="deleteReturnItem"></h6>
                                                <input type="number" name="tiID" value="" hidden="hidden">
                                                <div>
                                                    Remarks:<textarea name="tRemarks" id="tRemarks" class="form-control form-control-sm"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="setRemarks()" class="btn btn-warning btn-sm">Resolve</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

</body>
<?php include_once('templates/scripts.php') ?>
<script>
    var returns = [];
    var stocks = [];
    var supplier = [];
    var suppmerch = [];

    $(function() {
        $.ajax({
            url: '/admin/jsonReturns',
            dataType: 'json',
            success: function(data) {
                var poLastIndex = 0;
                $.each(data.returns, function(index, items) {
                    returns.push({
                        "returns": items
                    });
                    returns[index].returnitems = data.returnitems.filter(ret => ret.rID == items.rID);
                    returns[index].resolveitems = data.resolvedItems.filter(ret => ret.rID == items.rID);
                });
                supplier = data.supplier;

                showTable();
            },
            error: function(response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        $(".addReturnStock").on('click', function() {
            var spID = parseInt($(this).closest('.modal').find('.spID').val());
            setBrochureContent(suppmerch.filter(sm => sm.spID == spID));
        });
    });

    function setBrochureContent(suppstocks) {
        $("#list").empty();
        $("#list").append(`<table class="table"><thead>
                    <th></th>
                    <th>Receipt No.</th>
                    <th>Date</th>
                    <th>Stock</th>
                </thead><tbody></tbody></table>`);

        $("#list").find('table > tbody').append(`${suppstocks.map(st => {
            return ` <tr><td><input type="checkbox" id="spmID${st.spmID}" name="stockitems" onchange="disableReceipts(this)" 
            class="${st.receiptNo} receipts stockitems mr-2" value="${st.stID}" data-receipt="${st.receiptNo}"></td>
                    <td>${st.receiptNo}</td>
                    <td>${st.tDate}</td>
                    <td>${st.spmName}</td></tr>`
        }).join('')}`);

        disableSelected();
    }

    function disableReceipts(checkbox) {
        var receiptNo = $(checkbox).data('receipt');
        var checkboxes = $("input[name='stockitems']");
        console.log(receiptNo);
        if ($(checkbox).prop('checked')) {
            $(checkbox).addClass('checked');
            for (var i = 0; i <= checkboxes.length - 1; i++) {
                console.log(!($(checkboxes).eq(i).hasClass(receiptNo)));
                if ($(checkboxes).eq(i).data("receipt") !== receiptNo) {
                    $(checkboxes).eq(i).attr('disabled', "disabled");
                }
            }
        } else {
            $(checkboxes).removeAttr('disabled');
            $(checkbox).removeClass('checked');
        }

        disableSelected();
    }

    function disableSelected() {
        var receiptNo = $("input[name='receiptNo']").eq(0).val();
        var checkboxes = $("input[name='stockitems']");

        if ($('.returnElements') != 0 || $('.returnElements') != null) {
            var addedItems = $('.returnElements').find('#spmID');
            for (var i = 0; i <= addedItems.length - 1; i++) {
                var id = addedItems[i].value;
                $('#spmID' + id).attr("disabled", "disabled");
                $('#spmID' + id).attr("checked", "checked");
                $('#spmID' + id).removeAttr("class");

            }
        }
        if (parseInt(receiptNo) !== 0) {
            for (var i = 0; i <= checkboxes.length - 1; i++) {
                if ($(checkboxes).eq(i).data("receipt") !== receiptNo) {
                    $(checkboxes).eq(i).attr('disabled', "disabled");
                }
            }
        }
    }

    function showTable() {
        returns.forEach(function(item) {
            var tableRow = `
                <tr class="table_row" data-id="${item.returns.rID}">   <!-- table row ng table -->
                    <td class="ic-level-1"><a href="javascript:void(0)" class="ml-2 mr-4">
                    <img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>
                    ${item.returns.rID}</td>                    
                    <td>${item.returns.spAltName}</td>
                    <td>${item.returns.rDate}</td>
                    <td>${item.returns.rTotal}</td>
                    <td>
                    <a class="editReturnsbtn btn btn-secondary btn-sm" href="returns/formedit/${item.returns.rID}" style="margin:0">Edit Return</a>                 
                        <button class="deleteBtn btn btn-sm btn-warning" data-id="${item.returns.rID}" data-toggle="modal" data-target="#deleteReturns">Archive</button>
                    </td>
                </tr>
            `;

            var returnsDiv = `
            <div width="100%"> <!-- Preferences table container-->
                ${item.returnitems.length === 0 ? "No returns" : 
                `<caption><b>Returns</b></caption>
                <br>
                <table width="100%" id="orderitem" class=" table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                        <th>Receipt</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Per</th>
                        <th>Qty per Unit</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.returnitems.map(ret => {
                        return `
                        <tr id="${ret.riID}">
                        <td>${ret.returnReference}</td>
                            <td>${ret.stName}</td>
                            <td>${ret.tiQty}</td>
                            <td>${ret.uomName}</td>
                            <td>${ret.tiActual}</td>
                            <td>&#8369; ${ret.spmPrice}</td>
                            <td>&#8369; ${ret.tiSubtotal}</td>
                            <td>${ret.riStatus}</td>
                            <td>${ret.tiRemarks === null ? " " : ret.tiRemarks}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;

            var resolveDiv = `
            <div  width="100%"> <!-- Preferences table container-->
                ${item.resolveitems.length === 0 ? "No returns resolved" : 
                `<caption><b>Resolved Items</b></caption>
                <br>
                <table width="100%" class=" table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                        <th>Date Received</th>
                        <th>New Receipt</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Per</th>
                        <th>Qty per Unit</th>
                        <th>Delivery Type</th>
                        <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.resolveitems.map(ret => {
                        return `
                        <tr id="${ret.pID}">
                        <td>${ret.pDate}</td>
                        <td>${ret.replacementReference}</td>
                            <td>${ret.stName}</td>
                            <td>${ret.tiQty}</td>
                            <td>${ret.uomName}</td>
                            <td>${ret.tiActual}</td>
                            <td>${ret.piStatus}</td>
                            <td>${ret.tiRemarks === null ? " " : ret.tiRemarks}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;

            var accordion = `
            <tr class="accordion" style="display:none">
                <td colspan="6"> <!-- table row ng accordion -->
                    <div class="container returnsContent"> <!-- container ng accordion -->

                    </div>
                </td>
            </tr>
            `;

            $("#transTable > tbody").append(tableRow);
            $("#transTable > tbody").append(accordion);
            $(".returnsContent").last().append(returnsDiv);
            $(".returnsContent").last().append(resolveDiv);

        });

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

    $("#deleteReturns form").on('submit', function(event) {
        event.preventDefault();
        var tID = $("input[name='tID']").val();

        $.ajax({
            url: "<?= site_url("admin/transaction/delete") ?>",
            method: "post",
            data: {
                tID: tID
            },
            success: function() {
                location.reload();
            },
            error: function(response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }

        });
    });

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

</html>