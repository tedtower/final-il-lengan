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
                                <button class="addReturnsbtn btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#addReturns" data-original-title style="margin:0">Add Returns</button>
                                <br>
                                <br>
                                <table id="transTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead class="thead-dark">
                                        <th><b class="pull-left">Transaction #</b></th>
                                        <th><b class="pull-left">Delivery Receipt #</b></th>
                                        <th><b class="pull-left">Supplier</b></th>
                                        <th><b class="pull-left">Date</b></th>
                                        <th><b class="pull-left">Total</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <!--End Table Content-->

                                <!--Start of Modal "Add Returns"-->
                                <div class="modal fade bd-example-modal-lg" id="addReturns" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    style="overflow: auto !important;">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Returns</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--Modal Content-->
                                            <form id="formAdd" action="<?= site_url('admin/returns/add')?>"
                                                method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Source Name-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Supplier</span>
                                                            </div>
                                                            <select
                                                                class="spID form-control form-control-sm  border-left-0"
                                                                name="spID">
                                                                <option value="" selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Invoice Type-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Delivery Receipt</span>
                                                            </div>
                                                            <input type="text" name="receiptNo" id="receiptNo"
                                                                class="form-control form-control-sm" value="0" readonly="readonly">
                                                        </div>
                                                    </div>

                                                    <!-- Customer Name -->
                                                    <div class="form-row">
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Transaction Date</span>
                                                            </div>
                                                            <input type="date" name="tDate" id="tDate"
                                                                class="form-control form-control-sm" required>
                                                        </div>

                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Remarks</span>
                                                            </div>
                                                            <input type="text" name="tRemarks" id="tRemarks"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <!--Button to add row in the table-->
                                                    <a id="addReturnStock" class="addReturnStock btn btn-default btn-sm"
                                                        data-toggle="modal" data-target="#stockItemsModal"
                                                        data-original-title style="margin:0" id="">Add Items</a>
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
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-success btn-sm"
                                                            type="submit">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Modal "Add Returns" -->

                                <!--Start of Modal "Edit Returns"-->
                                <div class="modal fade bd-example-modal-lg" id="editReturns" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    style="overflow: auto !important;">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Returns</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!--Modal Content-->
                                            <form id="formAdd" action="<?= site_url('admin/returns/edit')?>"
                                                method="post" accept-charset="utf-8">
                                                <input type="hidden" name="trID" id="trID">
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <!--Source Name-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Supplier</span>
                                                            </div>
                                                            <select
                                                                class="spID form-control form-control-sm  border-left-0"
                                                                name="spID" disabled>
                                                                <option value="" selected>Choose</option>
                                                            </select>
                                                        </div>
                                                        <!--Invoice Type-->
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Delivery Receipt</span>
                                                            </div>
                                                            <input type="text" name="receiptNo" id="receiptNo"
                                                                class="form-control form-control-sm" disabled>
                                                        </div>
                                                    </div>

                                                    <!-- Customer Name -->
                                                    <div class="form-row">
                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Transaction Date</span>
                                                            </div>
                                                            <input type="date" name="tDate" id="tDate"
                                                                class="form-control form-control-sm" required>
                                                        </div>

                                                        <div class="input-group mb-3 col">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                                    Remarks</span>
                                                            </div>
                                                            <input type="text" name="tRemarks" id="tRemarks"
                                                                class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <!--Button to add row in the table-->
                                                    <a id="addReturnStock" class="addReturnStock btn btn-default btn-sm"
                                                        data-toggle="modal" data-target="#stockItemsModal"
                                                        data-original-title style="margin:0" id="">Add Items</a>
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
                                <!-- End of Modal "Edit Returns" -->

                                <!--Start of Stock Items Modal"-->
                                <div class="modal fade bd-example-modal-lg" id="stockItemsModal" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock Items</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="stockItemsForm" method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div style="margin:1% 3%" id="list">
                                                        <!--checkboxes-->
                                                        <label style="width:96%"><input type="checkbox" class="mr-2"
                                                                value="">Sample
                                                            data 2</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-dismiss="modal" onclick="getSelectedStocks();">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Stock Items Modal"-->
      
</body>
<?php include_once('templates/scripts.php') ?>
<script>
var returns = [];
var stocks = [];
var supplier = [];
var suppmerch = [];

    $(function () {
        $.ajax({
            url: '/admin/jsonReturns',
            dataType: 'json',
            success: function (data) {
                var poLastIndex = 0;
                $.each(data.returns, function (index, items) {
                    returns.push({
                        "returns": items
                    });
                    returns[index].returnitems = data.returnitems.filter(ret => ret.tID == items.tID);
                });

                supplier = data.supplier;
                suppmerch = data.suppmerch;
                console.log(suppmerch);
                showTable();
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        $(".addReturnStock").on('click', function () {
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
            class="${st.receiptNo} stockitems mr-2" value="${st.stID}" data-receipt="${st.receiptNo}"></td>
                    <td>${st.receiptNo}</td>
                    <td>${st.tDate}</td>
                    <td>${st.spmName}</td></tr>`
        }).join('')}`);

        disableSelected();
    }

    function disableReceipts(checkbox) {
        var receiptNo = $(checkbox).data('receipt');
        var checkboxes = $("input[name='stockitems']");

        if($(checkbox).prop('checked')) {
            $(checkbox).addClass('checked');
            for(var i = 0; i <= checkboxes.length - 1; i++) {
            if(!($(checkboxes).eq(i).hasClass(receiptNo))) {
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
    console.log(receiptNo);
    if ($('.returnElements') != 0 || $('.returnElements') != null) {
        var addedItems = $('.returnElements').find('#spmID');
        for (var i = 0; i <= addedItems.length - 1; i++) {
            var id = addedItems[i].value;
            $('#spmID' + id).attr("disabled", "disabled");
            $('#spmID' + id).attr("checked", "checked");
            $('#spmID' + id).removeAttr("class");

        }
    }
    if(parseInt(receiptNo) !== 0) {
        for(var i = 0; i <= checkboxes.length - 1; i++) {
            if(!($(checkboxes).eq(i).hasClass(receiptNo))) {
                $(checkboxes).eq(i).attr('disabled', "disabled");
            }
    }
    }
}

    function showTable() {
        returns.forEach(function (item) {
            var tableRow = `
                <tr class="table_row" data-id="${item.returns.tID}">   <!-- table row ng table -->
                    <td><a href="javascript:void(0)" class="ml-2 mr-4">
                    <img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>
                    ${item.returns.tNum}</td>                    
                    <td>${item.returns.receiptNo}</td>
                    <td>${item.returns.supplierName}</td>
                    <td>${item.returns.tDate}</td>
                    <td>${item.returns.tTotal}</td>
                    <td>
                    <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal" data-target="#editReturns" id="editSalesBtn">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#delete">Archive</button>
                    </td>
                </tr>
            `;

            var returnsDiv = `
            <div class="preferences" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.returnitems.length === 0 ? "No orders" : 
                `<caption><b>Orders</b></caption>
                <br>
                <table id="orderitem" class=" table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>UOM</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.returnitems.map(ret => {
                        return `
                        <tr id="${ret.tiID}">
                            <td>${ret.tiName}</td>
                            <td>${ret.tiQty}</td>
                            <td>${ret.uomName}</td>
                            <td>&#8369; ${ret.tiPrice}</td>
                            <td>&#8369; ${ret.tiSubtotal}</td>
                            <td>${ret.rStatus}</td>
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
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;padding-left: 5%"> <!-- description, preferences, and addons container -->
                            
                            <div class="returnsContent" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;

            $("#transTable > tbody").append(tableRow);
            $("#transTable > tbody").append(accordion);
            $(".returnsContent").last().append(returnsDiv);

        });

        $(".accordionBtn").on('click', function () {
            if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
                $(this).closest("tr").next(".accordion").css("display", "table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            } else {
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });

        $(".addReturnsbtn").on('click', function () {
            setSupplier(supplier);
        });

        $(".editBtn").on("click", function () {
            $('.returnsTable > tbody').empty();
            $('#addReturns form')[0].reset();
            $("#editReturns form")[0].reset();
            setSupplier(supplier);

            var tID = $(this).closest("tr").attr("data-id");
            setEditModal($("#editReturns"), returns.filter(item => item.returns.tID === tID)[0]);
        });
    }

    function setSupplier(supplier) {
        $(".spID").empty();
        $(".spID").append(`${supplier.map(sp => {
            return `<option value="${sp.spID}">${sp.spName}</option>`
        }).join('')}`);
    }


    var subPrice = 0;
    function getSelectedStocks() {
        $(document).ready(function () {
            var value = 0;
            var choices = document.getElementsByClassName('stockitems');
            var merchChecked, st;
            for (var i = 0; i <= choices.length - 1; i++) {
                if (choices[i].checked) {
                    value = choices[i].value;
                    st = suppmerch.filter(st => st.stID === value);
                   
                    merchChecked = `
                    <tr class="returnElements" data-stockid="${st[0].stID}" data-stqty="${st[0].prstQty}"
                        data-currqty="${st[0].stQty}">
                        <input type="hidden" name="tiID" id="tiID" value="${st[0].tiID}">                        
                        <input type="hidden" id="spmID" value="${st[0].spmID}">
                        <td><input type="text" id="stName" name="stName" class="stName form-control form-control-sm"
                                value="${st[0].spmName}" readonly="readonly"></td>
                        <td><input type="number" id="tiQty" onchange="setInputValues()" name="tiQty"
                                class="tiQty form-control form-control-sm" value="1" required min="1"></td>
                        <td><input type="text" id="uomID" data-id="${st[0].uomID}" name="uomID"
                                class="uomID form-control form-control-sm" value="${st[0].uomName}" readonly="readonly">
                        </td>
                        <td><input type="number" name="qtyPerItem" class="qtyPerItem form-control form-control-sm"
                                value="${st[0].spmActualQty}" disabled></td>
                        <td><img class="delBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"
                                onclick="removeItem(this)"></td>
                    </tr>

                    <tr class="subreturnElements">
                        <td>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Actual Qty</span>
                                </div>
                                <input type="number" name="actualQty" class="actualQty form-control form-control-sm"
                                    value="" readonly="readonly">
                            </div>
                        </td>
                        <td>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Price</span>
                                </div>
                                <input type="number" name="tiPrice" class="tiPrice form-control form-control-sm"
                                    value="${st[0].spmPrice}" disabled>
                            </div>
                        </td>
                        <td>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Subtotal</span>
                                </div>
                                <input type="number" name="tiSubtotal" class="tiSubtotal form-control form-control-sm"
                                    value="0" readonly="readonly">
                            </div>
                        </td>
                        <td>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"
                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Status</span>
                                </div><select class="rStatus form-control" style="font-size: 14px;" name="rStatus">
                                    <option value="pending">pending</option>
                                    <option value="parital">parital</option>
                                    <option value="delivered">delivered</option>
                                    <option value="resolved">resolved</option>
                                </select>
                            </div>
                        </td>

                    </tr>
                         `;

                    if ($('#addReturns').is(':visible')) {
                        $('#addReturns .returnsTable > tbody').append(merchChecked);
                        $('#addReturns').find("input[name='receiptNo']").val(st[0].receiptNo);
                        $('#addReturns').find("input[name='receiptNo']").attr('disabled','disabled');
                        setInputValues();
                    } else {
                        $('#editReturns .returnsTable > tbody').append(merchChecked);
                        $('#editReturns').find("input[name='receiptNo']").val(st[0].receiptNo);
                        $('#editReturns').find("input[name='receiptNo']").attr('disabled','disabled');
                    }
                }
            }
        });
    }

    function setInputValues() {
        var total = 0;
        for (var i = 0; i <= $('.returnElements').length - 1; i++) {
            var tiQty = parseInt($('.tiQty').eq(i).val());
            var qtyPerItem = parseInt($('.qtyPerItem').eq(i).val());
            var price = parseFloat($('.tiPrice').eq(i).val());

            // Setting item subtotal
            var subtotal = price * tiQty;
            var actualqty = tiQty * qtyPerItem;
            $('.actualQty').eq(i).val(actualqty);
            $('.tiSubtotal').eq(i).val(subtotal);
        }

        //Setting items total
        for (var i = 0; i <= $('.tiSubtotal').length - 1; i++) {
            total = total + parseFloat($('.tiSubtotal').eq(i).val());
        }

        if ($('#addReturns').is(':visible')) {
            $('#total').text(total);
        } else {
            $('#total1').text(total);;
        }
    }

    function deleteItem(element) {
        var el = $(element).closest("tr.returnElements");
        var subEl = $(element).closest("tr.returnElements").next(".subreturnElements");

        $(el).find('.tiQty').val(0);
        $(subEl).find('.tiSubtotal').val(0);
        $(el).attr("data-delete", "0");
        $(el).addClass("deleted");
        $(el).removeClass("salesElem");
        $(subEl).attr("data-delete", "0");
        $(subEl).addClass("deleted");
        $(subEl).removeClass("salesElem");
        $(".deleted").find("input").attr("disabled", "disabled");
        $(".deleted").find("input").removeAttr("class");
        $(".deleted").find("input").addClass("form-control form-control-sm");

        var deleted = $(".deleted");
        for (var i = 0; i <= deleted.length - 1; i++) {
            deleted[i].style.textDecoration = "line-through";
            deleted[i].style.opacity = "0.6";
        }

        setInputValues();
    }

    function removeItem(remove) {
        $(remove).closest("tr").next("tr").remove();
        $(remove).closest("tr").remove();
        
        setInputValues();
    }

    // ----------------------- A D D I N G  R E T U R N S --------------------------
    $(document).ready(function () {
        $("#addReturns form").on('submit', function (event) {
            event.preventDefault();
            var spID = $(this).find("select[name='spID']").val();
            var spName = $(this).find(".spID option[value='" + spID + "']").text();
            var receiptNo = $(this).find("input[name='receiptNo']").val();
            var tiID = $(this).find("input[name='tiID']").val();
            var tDate = $(this).find("input[name='tDate']").val();
            var tTotal = $(this).find("span[id='total']").text();
            var tRemarks = $(this).find("input[name='tRemarks']").val();

            var trans = [];
            for (var index = 0; index < $(this).find(".returnElements").length; index++) {
                var row = $(this).find(".returnElements").eq(index);
                var subrow = $(this).find(".returnElements").next('.subreturnElements').eq(index);
                trans.push({
                    tiID: parseInt(row.find("input[name='tiID']").val()),
                    uomID: row.find("input[name='uomID']").data("id"),
                    stID: parseInt(row.attr('data-stockid')),
                    tiName: row.find("input[name='stName']").val(),
                    tiPrice: subrow.find("input[name='tiPrice']").val(),
                    rStatus: subrow.find("select[name='rStatus']").val()
                });
            }

            var transitems = [];
            for (var index = 0; index < $(this).find(".returnElements").length; index++) {
                var row = $(this).find(".returnElements").eq(index);
                var subrow = $(this).find(".returnElements").next('.subreturnElements').eq(index);

                transitems.push({
                    tiID: parseInt(row.find("input[name='tiID']").val()),
                    stID: parseInt(row.attr('data-stockid')),
                    tiQty: row.find("input[name='tiQty']").val(),
                    qtyPerItem: row.find("input[name='qtyPerItem']").val(),
                    actualQty: subrow.find("input[name='actualQty']").val(),
                    tiSubtotal: subrow.find("input[name='tiSubtotal']").val()
                });
            }

            $.ajax({
                url: "<?= site_url("admin/returns/add")?>",
                method: "post",
                data: {
                    spID: spID,
                    spName: spName,
                    receiptNo: receiptNo,
                    tDate: tDate,
                    tTotal: tTotal,
                    tRemarks: tRemarks,
                    trans: JSON.stringify(trans),
                    ti: JSON.stringify(transitems)
                },
                beforeSend: function () {
                    console.log('spID ' + spID);
                    console.log('spName ' + spName);
                    console.log('tDate ' + tDate);
                    console.log('tTotal ' + tTotal);
                    console.log('tRemarks ' + tRemarks);
                    console.log(trans);
                    console.log(transitems);
                },
                success: function () {
                    location.reload();
                },
                error: function (response, setting, errorThrown) {
                    console.log(errorThrown);
                    console.log(response.responseText);
                }
            });
        });
    });
    // ----------------------- E N D  O F  A D D I N G  R E T U R N S --------------------------


    function setEditModal(modal, returns) {
        // Setting values for inputs
        modal.find("select[name='spID']").find(`option[value=${returns.returns.spID}]`).attr("selected", "selected");
        modal.find("input[name='receiptNo']").val(returns.returns.receiptNo);
        modal.find("input[name='tDate']").val(returns.returns.tDate);
        modal.find("input[name='tRemarks']").val(returns.returns.tRemarks);
        modal.find("input[name='trID']").val(returns.returns.tID);

        returns.returnitems.forEach(rt => {
            modal.find(".returnsTable > tbody").append(`
        <tr class="returnElements" data-stockid="${rt.stID}" data-id="${rt.tiID}">
                    <td><input type="text" id="stName" name="stName" class="stName form-control form-control-sm"
                            value="${rt.tiName}" readonly="readonly"></td>
                    <td><input type="number" id="tiQty" onchange="setInputValues()" name="tiQty"
                            class="tiQty form-control form-control-sm" value="${rt.tiQty}" required min="1"></td>
                    <td><input type="text" id="uomID" data-id="${rt.uomID}" name="uomID" class="uomID form-control form-control-sm"
                            value="${rt.uomName}" readonly="readonly"></td>
                    <td><input type="number" name="qtyPerItem" class="qtyPerItem form-control form-control-sm"
                            value="${rt.qtyPerItem}" disabled></td>
                    <td><img class="delBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"
                            onclick="deleteItem(this)"></td>
                </tr>

                <tr class="subreturnElements">
                    <td>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Actual Qty</span>
                            </div>
                            <input type="number" name="actualQty" class="actualQty form-control form-control-sm"
                                value="${rt.actualQty}" readonly="readonly">
                        </div>
                    </td>
                    <td>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Price</span>
                            </div>
                            <input type="number" name="tiPrice" class="tiPrice form-control form-control-sm" value="${rt.tiPrice}"
                            disabled>
                        </div>
                    </td>
                    <td>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Subtotal</span>
                            </div>
                            <input type="number" name="tiSubtotal" class="tiSubtotal form-control form-control-sm"
                                value="${rt.tiSubtotal}" readonly="readonly">
                        </div>
                    </td>
                    <td>
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm"
                                    style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                    Status</span>
                            </div><select class="rStatus form-control" style="font-size: 14px;"
                                name="rStatus">
                                <option value="pending">pending</option>
                                <option value="parital">parital</option>
                                <option value="delivered">delivered</option>
                                <option value="resolved">resolved</option>
                            </select>
                        </div>
                    </td>
                   
                </tr>`);

            modal.find("select[name='rStatus']").find(`option[value=${rt.rStatus}]`).attr("selected", "selected");
        });

        setInputValues();
    }


    // --------------------- E D I T I N G  R E T U R N S ---------------------------------
    $(document).ready(function () {
        $("#editReturns form").on('submit', function (event) {
            event.preventDefault();"input[name='trID']"
            var tID = $(this).find("input[name='trID']").val();
            var spID = $(this).find("select[name='spID']").val();
            var spName = $(this).find(".spID option[value='" + spID + "']").text();
            var receiptNo = $(this).find("input[name='receiptNo']").val();
            var tDate = $(this).find("input[name='tDate']").val();
            var tTotal = $(this).find("span[id='total']").text();
            var tRemarks = $(this).find("input[name='tRemarks']").val();

            var trans = [];
            for (var index = 0; index < $(this).find(".returnElements").length; index++) {
                var row = $(this).find(".returnElements").eq(index);
                var subrow = $(this).find(".returnElements").next('.subreturnElements').eq(index);
                trans.push({
                    tiID: isNaN(parseInt(row.attr('data-id'))) ? (null) : parseInt(row.attr('data-id')),
                    uomID: row.find("input[name='uomID']").data("id"),
                    stID: parseInt(row.attr('data-stockid')),
                    tiName: row.find("input[name='stName']").val(),
                    tiPrice: subrow.find("input[name='tiPrice']").val(),
                    rStatus: subrow.find("select[name='rStatus']").val(),
                    del: isNaN(parseInt(row.attr('data-delete'))) ? (null) : parseInt(row.attr('data-delete'))
                });
            }
            
            var transitems = [];
            for (var index = 0; index < $(this).find(".returnElements").length; index++) {
                var row = $(this).find(".returnElements").eq(index);
                var subrow = $(this).find(".returnElements").next('.subreturnElements').eq(index);

                transitems.push({
                    tiID: isNaN(parseInt(row.attr('data-id'))) ? (null) : parseInt(row.attr('data-id')),
                    stID: parseInt(row.attr('data-stockid')),
                    tiQty: row.find("input[name='tiQty']").val(),
                    qtyPerItem: row.find("input[name='qtyPerItem']").val(),
                    actualQty: subrow.find("input[name='actualQty']").val(),
                    tiSubtotal: subrow.find("input[name='tiSubtotal']").val(),
                    del: isNaN(parseInt(subrow.attr('data-delete'))) ? (null) : parseInt(subrow.attr('data-delete'))
                });
            }
                    console.log('spID ' + spID);
                    console.log('spName ' + spName);
                    console.log('tDate ' + tDate);
                    console.log('tTotal ' + tTotal);
                    console.log('tRemarks ' + tRemarks);
                    console.log(trans);
                    console.log(transitems);

            $.ajax({
                url: "<?= site_url("admin/returns/edit")?>",
                method: "post",
                data: {
                    spID: spID,
                    spName: spName,
                    receiptNo: receiptNo,
                    tDate: tDate,
                    tTotal: tTotal,
                    tRemarks: tRemarks,
                    trans: JSON.stringify(trans),
                    ti: JSON.stringify(transitems)
                },
                beforeSend: function () {
                    console.log('spID ' + spID);
                    console.log('spName ' + spName);
                    console.log('tDate ' + tDate);
                    console.log('tTotal ' + tTotal);
                    console.log('tRemarks ' + tRemarks);
                    console.log(trans);
                    console.log(transitems);
                },
                success: function () {
                    // location.reload();
                },
                error: function (response, setting, errorThrown) {
                    console.log(errorThrown);
                    console.log(response.responseText);
                }
            });
        });
    });
    // ----------------------- E N D  O F  E D I T I N G  R E T U R N S --------------------------

</script>
</html>