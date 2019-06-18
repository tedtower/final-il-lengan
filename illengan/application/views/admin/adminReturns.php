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
                                        <th><b class="pull-left">Transtaction #</b></th>
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
                                <form id="formAdd" action="<?= site_url('admin/returns/add')?>" method="post"
                                    accept-charset="utf-8">
                                    <div class="modal-body">
                                        <div class="form-row">
                                            <!--Source Name-->
                                            <div class="input-group mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"id="inputGroup-sizing-sm"
                                                        style="background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                                        Supplier</span>
                                                </div>
                                                <select class="spID form-control form-control-sm  border-left-0" name="spID">
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
                                                    class="form-control form-control-sm">
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
                                         <a id="addReturnStock" class="addReturnStock btn btn-default btn-sm" data-toggle="modal" data-target="#stockItemsModal"
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
                                            <button class="btn btn-success btn-sm" type="submit">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal "Add Returns" -->
                    
                                <!--Start of Stock Items Modal"-->
                                <div class="modal fade bd-example-modal" id="stockItemsModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true"
                                    style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog" role="document">
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

                console.log(returns);
                stocks = data.stock;
                supplier = data.supplier;
                suppmerch = data.suppmerch;
                showTable();
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        $(".addReturnStock").on('click', function(){
            var spID = parseInt($(this).closest('.modal').find('.spID').val());
            setBrochureContent(suppmerch.filter(sm => sm.spID == spID));
            console.log('eye');
        });
    });

    function setBrochureContent(suppstocks){
        $("#list").empty();
        
        $("#list").append(`${suppstocks.map(st => {
            return `<label style="width:96%"><input type="checkbox" id="stID${st.stID}" name="stockitems" class="stockitems mr-2" 
            value="${st.stID}"> ${st.spmName} </label>`
        }).join('')}`);
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
                    <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal" data-target="#editSales" id="editSalesBtn">Edit</button>
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

        $(".addReturnsbtn").on('click', function(){
            setSupplier(supplier);
        });
    }

    function setSupplier(supplier){
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
                st = stocks.filter(st => st.stID === value);
                console.log(st);
                merchChecked = `<tr class="returnElements" data-stockid="${st[0].stID}"
                    data-stqty="${st[0].prstQty}" data-currqty="${st[0].stQty}">
                    <td><input type="text" id="stName" name="stName" class="stName form-control form-control-sm"
                            value="${st[0].stName}" readonly="readonly"></td>
                    <td><input type="number" id="tiQty" onchange="setInputValues()" name="tiQty"
                            class="tiQty form-control form-control-sm" value="1" required min="1"></td>
                    <td><input type="text" id="uomID" name="uomID" class="uomID form-control form-control-sm"
                            value="${st[0].uomName}" readonly="readonly"></td>
                    <td><input type="number" name="qtyPerItem" class="qtyPerItem form-control form-control-sm"
                            value="${st[0].spmActualQty}" disabled></td>
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
                            <input type="number" name="tiPrice" class="tiPrice form-control form-control-sm" value="${st[0].spmPrice}"
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
                                value="0" readonly="readonly">
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
                    <td><img class="delBtn" src="/assets/media/admin/error.png" style="width:20px;height:20px"
                            onclick="removeItem(this)"></td>
                </tr>
                         `;
                if ($('#addReturns').is(':visible')) {
                    $('.returnsTable > tbody').append(merchChecked);
                    setInputValues();
                } else {
                    $('.editsalesTable > tbody').append(merchChecked);
                }
            }
        }
    });
}

function setInputValues() {
    var total = 0;
    for(var i = 0; i <= $('.returnElements').length -1 ; i++) {
        var tiQty = parseInt($('.tiQty').eq(i).val());
        var qtyPerItem = parseInt($('.qtyPerItem').eq(i).val());
        var price = parseFloat($('.tiPrice').eq(i).val());

        // Setting item subtotal
        var subtotal = price * tiQty;
        var actualqty = tiQty * qtyPerItem;
        $('.actualQty').eq(i).val(actualqty);
        $('.tiSubtotal').eq(i).val(subtotal);
        console.log(subtotal);
       
    }

     //Setting items tota
    for(var i = 0; i <= $('.tiSubtotal').length-1; i++) {
        total = total + parseFloat($('.tiSubtotal').eq(i).val());
    }

    if ($('#addReturns').is(':visible')) {
        $('#total').text(total);
    } else {
        $('.editsalesTable > tbody').append(merchChecked);
    }
}

// ----------------------- A D D I N G  T R A N S A C T I O N --------------------------
$(document).ready(function() {
    $("#addReturns form").on('submit', function(event) {
        event.preventDefault();
        var spID = $(this).find("select[name='spID']").val();
        var spName = $(this).find("select[name='spID']").text();
        var tDate = $(this).find("input[name='osDateTime']").val();
        var tTotal = $(this).find("span[id='total']").text();
        var tRemarks = $(this).find("input[name='tRemarks']").val();
       
        var trans = [];
        for (var index = 0; index < $(this).find(".returnElements").length; index++) {
            var row = $(this).find(".returnElements").eq(index);
            var subrow =  $(this).find(".returnElements").next('subreturnElements').eq(index);
            trans.push({
                uomID:  row.find("input[name='uomID']").val(),
                stID: parseInt(row.attr('data-stockid')),
                tiName: row.find("input[name='stName']").val(),
                tiPrice:  subrow.find("input[name='tiPrice']").val(),
                rStatus: subrow.find("select[name='rStatus']").val()
            });
        }

        var transitems = [];
        for (var index = 0; index < $(this).find(".returnElements").length; index++) {
            var row = $(this).find(".returnElements").eq(index);
            var subrow =  $(this).find(".returnElements").next('subreturnElements').eq(index);

            transitems.push({
                tiQty: row.find("input[name='tiQty']").val(),
                qtyPerItem:  row.find("input[name='qtyPerItem']").val(),
                actualQty: subrow.find("input[name='actualQty']").val(),
                tiSubtotal:  subrow.find("input[name='tiSubtotal']").val()
            });
        }

        $.ajax({
            url: "<?= site_url("admin/sales/edit")?>",
            method: "post",
            // data: {
            //     spID 
            //     spName 
            //     tDate 
            //     tTotal 
            //     tRemarks
            //     orderlists: JSON.stringify(ol),
            //     addons: JSON.stringify(addons)
            // },
            success: function() {
                location.reload();
            },
            error: function (response, setting, errorThrown) {
                alert("There are add on duplicates on an item");
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
    });
});

</script>
</html>