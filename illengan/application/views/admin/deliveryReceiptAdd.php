<body style="background: white">
    <div class="content">
        <div class="container-fluid">
            <br>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="card-content">
                        <!--Export button and Real Time Date & Time -->
                        <div style="overflow:auto;">
                            <p style="text-align:right; font-weight: regular; font-size: 16px;float:right">
                                <?php echo date("M j, Y -l"); ?>
                            </p>
                        </div>
                        <!--Card-->
                        <div style="overflow:auto">
                            <div class="card" style="float:left;width:62%">
                                <div class="card-header">
                                    <h6 style="font-size:15px;margin:0">Add Delivery</h6>
                                </div>
                                <form id="drForm" action="<?= site_url("admin/deliveryreceipt/add")?>"
                                    accept-charset="utf-8" class="form">
                                    <div class="card-body">
                                        <input type="text" name="tID" hidden="hidden">
                                        <div class="form-row">
                                            <!--Supplier-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Supplier</span>
                                                </div>
                                                <select class="spID form-control status-level" name="supplier" id="supplier" data-level="2,3" required>
                                                    <option value="" selected>Choose</option>
                                                    <?php if(isset($supplier)){
                                                foreach($supplier as $sup){?>
                                                    <option value="<?= $sup['spID']?>"><?= $sup['spName']?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                            <!--Source-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Source</span>
                                                </div>
                                                <input class="form-control status-level" data-level="1" require name="source" type="text" value="" id="source" required pattern="[a-zA-Z][a-zA-Z\s]*" title="Source should only countain letters and white spaces.">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!--Receipt-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Receipt</span>
                                                </div>
                                                <input class="form-control status-level" data-level="0" name="receipt" type="text" value="" id="receipt">
                                            </div>
                                            <!--Date-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Date</span>
                                                </div>
                                                <input class="form-control" name="date" id="date" type="date" data-level="0" data-validate="required" message="Date is required!" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
                                            </div>
                                        </div>
                                        <!--Remarks-->
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="width:70px">Remarks</span>
                                            </div>
                                            <textarea type="text" data-level="0" name="remarks" class="status-level form-control form-control-sm"
                                                rows="1"></textarea>
                                        </div>

                                        <!--Radio Buttons-->
                                        <div class="form-check form-check-inline mb-3"
                                            style="font-size:14px;width:100%;margin:0" required>
                                            <label class=" form-check-label mr-3"><input class="radio-level form-check-input"
                                                    type="radio" data-trigger-level="3" name="inlineRadioOptions" value="3">W/ PO Ref</label>
                                            <label class=" form-check-label mr-3"><input class="radio-level form-check-input"
                                                    type="radio" data-trigger-level="2" name="inlineRadioOptions" value="2">W/O PO Ref</label>
                                            <label class=" form-check-label mr-3"><input class="radio-level form-check-input"
                                                    type="radio" data-trigger-level="1" name="inlineRadioOptions" value="1">No Official Supplier</label>
                                        </div>
                                        <!--Buttons-->
                                        <button id="addNewBtn" data-level="1" class="btn btn-outline-primary btn-sm m-0 status-level"
                                            type="button" disabled>New Item</button>
                                        <button id="addMBtn" data-level="2" class="btn btn-outline-primary btn-sm m-0 status-level"
                                            type="button" disabled>Add Merchandise</button>
                                        <button id="addPOBtn" data-level="3" class="btn btn-outline-primary btn-sm m-0 status-level"
                                            type="button" disabled>PO Item</button>
                                        <button id="addRBtn" data-level="3" class="btn btn-outline-primary btn-sm m-0 status-level"
                                            type="button" disabled>Return Item</button>
                                        <br><br>

                                        <div class="ic-level-2">
                                        </div>
                                        <br>
                                        <span>Total: &#8369;<span class="total">0</span></span>
                                        <!--Total of the trans items-->
                                    </div>
                                    <div class="card-footer mb-0" style="overflow:auto">
                                        <button class="btn btn-success btn-sm" type="submit"
                                            style="float:right">Insert</button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="float:right">Cancel</button>
                                    </div>
                                </form>
                            </div>

                        <!--Start of PO sidenav-->
                            <div class="card brochure" id="stockCardPO" style="float:left;width:35%;margin-left:3%" hidden>
                                <div class="status-level" data-show-level="3">
                                    <div class="card-header" style="overflow:auto">
                                        <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Purchase Order</div>
                                        <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                            <input type="search"
                                                style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                                name="search" placeholder="Search...">
                                        </div>
                                    </div>
                                    <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                        <!--checkboxes-->
                                        <div class="mt-1 mb-1">
                                            <select class="form-control form-control-sm" id="po" name="po" required>
                                            </select>
                                      </div>
                                      <p class="modal-title" style="font-size: 16px;padding-left: 10px;font-weight: 600;
                                      margin-top: 15px" id="exampleModalLabel">Purchase Item</p>
                                            <form id="formAdd"  method="post" accept-charset="utf-8">
                                                    <div class="modal-body">
                                                        <div style="margin:1% 3%" id="listpo" class="ic-level-1">
                                                        </div>
                                                    </div>
                                            </form>
                                            </div>
                                </div>
                                <div class="status-level" data-show-level="3">
                                </div>
                                <div class="status-level" data-show-level="2">
                                </div>
                            </div>
                            <!--End of PO sidenav-->

                            <!--Start of Return sidenav-->
                            <div class="card brochure" id="returnCard" style="float:left;width:35%;margin-left:3%" hidden>
                                <div class="card-header" style="overflow:auto">
                                    <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Return</div>
                                    <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                        <input type="search"
                                            style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                            name="search" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                    <!--checkboxes-->
                                    <div class="mt-1 mb-1">
                                        <select class="form-control form-control-sm" name="returns" required>
                                            <option value="0" selected>Choose Return</option>
                                        </select>
                                    </div>
                                    <table class="table table-borderless">
                                        <thead style="border-bottom:2px solid #cccccc">
                                            <tr>
                                                <th width="2%"></th>
                                                <th style="font-weight:500 !important">Item Name</th>
                                                <th style="font-weight:500 !important">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ic-level-2">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--End of PO sidenav-->

                            <!--Start of Merchandise sidenav-->
                            <div class="card brochure" id="stockCardmerch" style="float:left;width:35%;margin-left:3%" hidden>
                                <div class="card-header" style="overflow:auto">
                                    <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Merchandise</div>
                                    <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                        <input type="search"
                                            style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                            name="search" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                    <!--checkboxes-->
                                    <p class="modal-title" style="font-size: 16px;padding-left: 10px;font-weight: 600"
                                    id="exampleModalLabel">Merchandise Name</p>
                                    <form id="formAdd"  method="post" accept-charset="utf-8">
                                            <div class="modal-body">
                                                <div style="margin:1% 3%" id="list" class="ic-level-1">
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <!--End of Merchandise sidenav-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
    <script>
            
    $(function () {
        var uom;
        var stockitems;
        $.ajax({
            method: "GET",
            url: "/admin/getUOMs",
            dataType: "JSON",
            success: function (data) {
                uom = data.uom;
                stockitems = data.stocks;
            }
        });
        $("#drForm .radio-level").on("change", function () {
            resetForm();
            var level = $(this).attr("data-trigger-level");
            $("#drForm .status-level").each(function (index) {
                !$(this).attr("data-level").includes(level) && $(this).attr("data-level") != 0 ? $(this).prop("disabled", true) : $(this).prop("disabled", false);
            });
        });

        //---------------- FOR NEW STOCK ITEMS FUNCTIONS -------------------//
        $("#addNewBtn").on("click", function () {
            $(".brochure").attr("hidden", true);
            $("#drForm .ic-level-2").attr("data-type", "new");
            $("#drForm").find(".ic-level-2").append(`
                        <div style="overflow:auto" class="ic-level-1">
                            <div style="float:left;width:96%;overflow:auto;">
                                <div class="input-group mb-1">
                                    <select name="stID[]" 
                                        class="form-control form-control-sm" placeholder="Stock"></select>
                                    <input name="actualQty[]" type="number"
                                        class="form-control form-control-sm" placeholder="Actual Qty">
                                </div>
                            </div>
                            <div class="mt-2" style="float:left:width:3%;overflow:auto">
                                <img class="exitBtn" src="/assets/media/admin/error.png"
                                    style="width:15px;height:15px;float:right;">
                            </div>
                        </div>`);
            setIL1FormEvents();

            stockitems.forEach(function (item) {
                $("select[name='stID[]']").append(
                    `<option value="${item.stID}">${item.stName}</option>`
                );
            })
        });

        //---------------- FOR MERCHANDISE STOCK ITEMS FUNCTIONS -------------------//
        $("#addMBtn").on("click", function () {
            $("select[name='supplier']").removeAttr("readonly");
            $(".brochure").attr("hidden", true);
            $("#stockCardmerch").removeAttr("hidden");
            $("#drForm .ic-level-2").attr("data-type", "merchandise");

        });
        $(document).on("click", "#list input[name='merch']", function (event) {
            var spmID = $(this).val();
            var stID = $(this).attr("data-stID");
            var spmName = $(this).attr("data-spmName");
            var stQty = $(this).attr("data-stQty");
            var spmActual = $(this).attr("data-spmActual");
            var spmPrice = $(this).attr("data-spmPrice");
            var spID = $(this).attr("data-spID");
            
            if ($(this).is(":checked")) {
                $("#drForm .ic-level-2").append(`
               <div style="overflow:auto" class="ic-level-1" data-id="${spmID}">
                   <div style="float:left;width:96%;overflow:auto;">
                       <div class="input-group mb-1">
                       <input type="text" name="spmName" class="form-control form-control-sm" value="${spmName}"
                           style="width:17%" readonly>
                        <input type="hidden" name="spmID"
                           class="form-control form-control-sm" placeholder="spmID" id="spmID" value="${spmID}">
                        <input type="hidden" name="spID"
                           class="form-control form-control-sm" placeholder="spID" id="spID" value="${spID}">
                        <input type="hidden" name="stID"
                           class="form-control form-control-sm" placeholder="stID" id="stID" value="${stID}">
                       <input type="number" min="0" name="tiQty" id="tiQty" data-price="${spmPrice}" data-actqty="${spmActual}"
                           class="form-control form-control-sm" placeholder="tiQty" required>
                        <input type="number" min="0" name="tiActualQty" id="tiActualQty"
                           class="form-control form-control-sm" placeholder="tiActualQty"
                           readonly>
                        <input type="number"  min="0" name="tiDiscount" id="tiDiscount"
                           class="tiDiscount form-control form-control-sm" placeholder="Discount" >
                       <input type="number" name="spmPrice" id="spmPrice"
                           class="form-control form-control-sm" placeholder="Price" value="${spmPrice}">
                       <input type="number" name="tiSubtotal" id="tiSubtotal"
                           class="form-control form-control-sm" placeholder="Subtotal"
                           readonly>
                       </div>
                   </div>
               </div>
               `);
     
            } else {
                $('#drForm .ic-level-1[data-id='+spmID+']').remove();
            }
            setIL1FormEvents();
   
        });

        function setMerchandiseBrochure(merch) {
            var spID = $("select[name='supplier']").val();
            merch = merch.filter(me => me.spID == spID);

            $("#list").empty();
            if (merch.length > 0) {
                $("#list").append(`${merch.map(stock => {
                    return `<label style="width:96%"><input type="checkbox" name="merch" class="choiceStock mr-2" data-spID="${stock.spID}" 
                    data-spmActual="${stock.spmActual}" data-spmPrice="${stock.spmPrice}" data-spmName="${stock.spmName}" 
                    data-stID="${stock.stID}" data-stQty="${stock.stQty}" value="${stock.spmID}">${stock.spmName}</label>`
                }).join('')}`);
            } else {
                $("#list").append(`<p>No merchandises</p>`);
            }

            checkSelectedStocks();
        }
        //---------------- FOR PURCHASE ORDER STOCK ITEMS FUNCTIONS -------------------//
        $("#addPOBtn").on("click", function () {
            $(".brochure").attr("hidden", true);
            $("#stockCardPO").removeAttr("hidden");
            $("#drForm .ic-level-2").attr("data-type", "po");
            var supplier = $("#drForm select[name='spID']").val();
            var url = $(this).attr("data-url");

            $.ajax({
                url: '<?= site_url('admin/getpurchases') ?>',
                dataType: 'json',
                success: function (data) {
                    var poLastIndex = 0;
                    stockitem = data;
                    setStockData(stockitem);
                },
                failure: function () {
                    console.log('None');
                },
                error: function (response, setting, errorThrown) {
                    console.log(errorThrown);
                    console.log(response.responseText);
                }
            });
            setIL1FormEvents();
        });

        function setStockData(stockitem) {
            $("#po").empty();
            $("#po").append(`<option data-spID="0" value="0" selected>Choose PO</option>`);
            $("#po").append(`${stockitem.map(stocks => {
				return `<option data-spID="${stocks.spID}" data-pID="${stocks.pID}" value="${stocks.piID}">${stocks.spName} (${stocks.pDate})</option>`
			}).join('')}`);
        }

        $("#po").on("change", function () {
            resetForm();
            var pID = $(this).find("option:selected").attr("data-pID");
          
            $.ajax({
                type: 'POST',
                url: '<?= site_url('admin/viewPurchItems') ?>',
                data: {
                    pID: pID
                },
                dataType: 'json',
                success: function (data) {
                    var poLastIndex = 0;
                    var purchorder = data;
                    setPOBrochure(purchorder);
                },
                error: function (response, setting, error) {
                    console.log(response.responseText);
                    console.log(error);
                }
            });
        });

        function setPOBrochure(purchorder) {
            $("#listpo").empty();

            if (purchorder.length > 0) {
                $("#listpo").append(`${purchorder.map(stock => {
                return `<label style="width:96%"><input type="checkbox" name="purchorder" class="choiceStock mr-2"  
                data-spID="${stock.spID}" data-spmActual="${stock.spmActual}" data-piid="${stock.piID}" data-spmPrice="${stock.spmPrice}" data-spmName="${stock.spmName}" 
                    data-stID="${stock.stID}" data-tiqty="${stock.tiQty}"  value="${stock.spmID}">${stock.spmName}</label>`
                }).join('')}`);
            } else {
                $("#listpo").append(`<p>No purchases</p>`);
            }

            checkSelectedStocks();
        }

        $(document).on("click", "#listpo input[name='purchorder']", function (event) {
            var spmID = $(this).val();
            var stID = $(this).attr("data-stID");
            var spmName = $(this).attr("data-spmName");
            var tiQty = $(this).attr("data-tiqty");
            var spmActual = $(this).attr("data-spmActual");
            var spmPrice = $(this).attr("data-spmPrice");
            var spID = $(this).attr("data-spID");
            var piID = $(this).attr("data-piid");
            
            if ($(this).is(":checked")) {
                $("#drForm .ic-level-2").append(`
               <div style="overflow:auto" class="ic-level-1" data-id="${spmID}">
                   <div style="float:left;width:96%;overflow:auto;">
                       <div class="input-group mb-1">
                       <input type="text" name="spmName" class="form-control form-control-sm" value="${spmName}"
                           style="width:17%" data-piid="${piID}" readonly>
                        <input type="hidden" name="spmID"
                           class="form-control form-control-sm" placeholder="spmID" id="spmID" value="${spmID}">
                        <input type="hidden" name="spID"
                           class="form-control form-control-sm" placeholder="spID" id="spID" value="${spID}">
                        <input type="hidden" name="stID"
                           class="form-control form-control-sm" placeholder="stID" id="stID" value="${stID}">
                       <input type="number" min="0" name="tiQty" id="tiQty" data-price="${spmPrice}" data-actqty="${spmActual}"
                           class="form-control form-control-sm" placeholder="tiQty" min="1" max="${tiQty}" required>
                        <input type="number" min="0" name="tiActualQty" id="tiActualQty"
                           class="form-control form-control-sm" placeholder="tiActualQty"
                           readonly>
                        <input type="number"  min="0" name="tiDiscount" id="tiDiscount"
                           class="tiDiscount form-control form-control-sm" placeholder="Discount" >
                       <input type="number" name="spmPrice" id="spmPrice"
                           class="form-control form-control-sm" placeholder="Price" value="${spmPrice}">
                       <input type="number" name="tiSubtotal" id="tiSubtotal"
                           class="form-control form-control-sm" placeholder="Subtotal"
                           readonly>
                       </div>
                   </div>
               </div>
               `);
     
            } else {
                $('#drForm .ic-level-1[data-id='+spmID+']').remove();
            }
            setIL1FormEvents();
        });

        $(document).on('change', 'input[name="tiQty"]', function () {
            var tiQty = parseFloat($(this).val());
            var spmActualQty = parseFloat($(this).data('actqty'));
            var tiActual = parseFloat(tiQty * spmActualQty);
            $(this).next("input[name='tiActualQty']").val(tiActual);

            var spmPrice = parseFloat($(this).data("price"));
            var subtotal = parseFloat(spmPrice * tiQty);
            $(this).closest(".ic-level-1").find("input[name='tiSubtotal']").val(subtotal);

            setTotals();
        });

        $(document).on('change', 'input[name="tiDiscount"]', function () {
            var subtotal = parseFloat($(this).closest('.ic-level-1').find('input[name="tiSubtotal"]').val());
            var discount = parseFloat($(this).val());
            var disPrice = parseFloat(subtotal - discount);
            $(this).closest(".ic-level-1").find("input[name='tiSubtotal']").val(disPrice);

            setTotals();
        });

        $(document).on("change", "select[name='po']", function () {
            var supplier = $(this).find(':selected').attr('data-spID');
            $("#drForm").find("select[name='supplier']").val(supplier);
        });


        // ----------------------- RESOLVING RETURNED ITEMS -----------------------
        $("#addRBtn").on("click", function () {
            $(".brochure").attr("hidden", true);
            $("#drForm .ic-level-2").attr("data-type", "return");
            $("#returnCard").removeAttr("hidden");
            var supplier = $("#drForm select[name='spID']").val();
            var url = $(this).attr("data-url");
            setReturnData();

        });
        
        function setReturnData() {
            var ret = <?= json_encode($retTrans) ?>;

            $("select[name='returns']").append(`${ret.map(rt => {
				return `<option name="rID" id="rID" value="${rt.rID}">${rt.spName} (${rt.rDate})</option>`
			}).join('')}`);
        }

       $("select[name='returns']").on("change", function() {
            $("#returnCard tbody").empty();
            var returns = <?= json_encode($returns) ?>;
            var rID = $(this).val();
            returns = returns.filter(rt => rt.rID == rID);

            if (returns.length > 0) {
                returns.forEach(function (del) {
                $("#returnCard tbody").append(`
                    <tr class="ic-level-1">
                    <td><input type="checkbox" class="mr-2" name="returns"
                            data-name="${del.stName}" data-uom="${del.uomName}" 
                            data-stid="${del.stID}"  data-actual="${del.spmActual}" 
                            data-price="${del.spmPrice}"  data-riid="${del.riID}" 
                            data-tiqty="${del.tiQty}" data-spmid="${del.spmID}"
                            value="${del.stID}"></td>
                    <td class="trans"  data-receipt='${del.returnReference}' data-supplier='${del.spAltName}' 
                    data-spid="${del.spID}">${del.returnReference}${del.rDate}</td>
                    <td class="item" data-stid='${del.stID}'>${del.item}</td>
            </tr>`);
                });
            } else {
                $("#returnCard tbody").append(`<tr><td colspan="6">No return items</td></tr>`);
            }

            checkSelectedStocks();

       });
          

        $(document).on("click", "#returnCard input[name='returns']", function (event) {
            var id = $(this).val();
            var name = $(this).attr("data-name");
            var uom = $(this).data("uom");
            var price = $(this).data("price");
            var actualQty = $(this).data("actual");
            var tiQty = $(this).data("tiqty");
            var supplier = $(this).closest("tr").find("td.trans").data("supplier");
            var spID = $(this).closest("tr").find("td.trans").data("spid");
            var spmID = $(this).data("spmid");
            var receiptNo = $(this).closest("tr").find("td.trans").data("receipt");
            var riID = $(this).data("riid");

            if ($(this).is(":checked")) {
                $("#drForm .ic-level-2").append(`
                    <tr class="ic-level-1" data-stock="${id}" data-riid="${riID}">
                        <td style="padding:1% !important"><input type="text" class="form-control form-control-sm"
                                data-stock="${id}" value="${receiptNo}" data-riid="${riID}" name="receipt" readonly></td>
                        <td style="padding:1% !important"><input type="text" class="form-control form-control-sm"
                                data-id="${id}" data-spmid="${spmID}" data-actqty="${actualQty}" data-price="${price}" 
                                value="${name}" data-tiqty="${tiQty}" name="stock" readonly></td>
                        <td width="20%" style="padding:1% !important">
                            <div class="input-group input-group-sm mb-3">
                                <input type="number" class="form-control form-control-sm" name="qty" value="${tiQty}" min="1" max="${tiQty}">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="font-size:14px">
                                        ${uom} </span>
                                </div>
                            </div>
                        </td>
                        <td style="padding:1% !important"><textarea placeholder="Remarks" type="text" class="form-control form-control-sm"
                                name="tiRemarks" rows="1"></textarea>
                        </td>
                    </tr>`);

                $("#drForm").find('select[name="supplier"]').find(`option[value=${spID}]`).attr("selected", "selected");
                $("#drForm").find('select[name="supplier"]').attr("readonly", true);
            } else {
                $('#drForm .ic-level-1[data-riID="' + riID + '"]').remove();
                if (isNaN($("#drForm .ic-level-2 tr").length) || $("#conForm .ic-level-2 tr").length == 0) {
                    $('#drForm')[0].reset();
                }

            }
        });

        $(document).on("change", "select[name='supplier']", function() {
            resetForm();
            
            if ($("#stockCardmerch").is(':visible')) {
                var merch;
                $.ajax({
                    url: '<?= site_url('admin/viewStockitems') ?>',
                    dataType: 'json',
                    success: function (data) {
                        var poLastIndex = 0;
                        merch = data;
                        setMerchandiseBrochure(merch);
                    },
                    failure: function () {
                        console.log('None');
                    },
                    error: function (response, setting, errorThrown) {
                        console.log(errorThrown);
                        console.log(response.responseText);
                    }
                });
            }
        });

        
        $("#drForm").on("submit", function (event) {
            event.preventDefault();
            var addType = $(this).find('.ic-level-2').data("type");
            var supplier = parseInt($(this).find("select[name='supplier']").val());
            var source = $(this).find("input[name='source']").val();
            var date = $(this).find("input[name='date']").val();
            var receipt = $(this).find("input[name='receipt']").val();
            var remarks = $(this).find("textarea[name='remarks']").val();
            var newItems = [],
                merchItems = [],
                purItems = [],
                retItems = [];
            var rTotal = 0;

            var params = {
                url: '/admin/deliveryreceipt/add',
                type: "POST",
                success: function () {
                    location.reload();
                }
            };
            switch (addType) {
                case "new":
                    $("#drForm .ic-level-1").each(function (index) {
                        newItems.push({
                            stID: $(this).find("select[name='stID[]']").val(),
                            qty: $(this).find("input[name='actualQty[]']").val(),
                            piStatus: 'delivered',
                            date: date
                        });
                    });

                    params.data = {
                        spAltName: source,
                        date: date,
                        receipt: receipt,
                        remarks: remarks,
                        addtype: "new",
                        items: JSON.stringify(newItems)
                    }
                    break;
                case "merchandise":
                    $("#drForm .ic-level-1").each(function (index) {
                        var stID = $(this).find("input[name='stID']").val();
                        var spmID = $(this).find("input[name='spmID']").val();
                        var stQty = $(this).find("input[name='stQty']").val();
                        var tiQty = $(this).find("input[name='tiQty']").val();
                        var tiSubtotal= $(this).find("input[name='tiSubtotal']").val();
                        var tiActualQty= $(this).find("input[name='tiActualQty']").val()
                        var price = parseFloat($(this).find("input[name='spmPrice']").val());
                        var tiDiscount = parseInt($(this).find("input[name='tiDiscount']").val());
                        rTotal = parseFloat(rTotal + tiSubtotal);

                        merchItems.push({
                            stID: stID,
                            stQty: stQty,
                            tiSubtotal:tiSubtotal,
                            spmID: spmID,
                            tiQty: tiQty,
                            tiActualQty:tiActualQty,
                            tiDate: date,
                            tiDiscount: tiDiscount,
                            rTotal:rTotal
                        });
                    });
                       
                    params.data = {
                        supplier:supplier,
                        spAltName: source,
                        date: date,
                        receipt: receipt,
                        remarks: remarks,
                        addtype: "merchandise",
                        items: JSON.stringify(merchItems)
                    }
                    break;

                case "po":
                    $("#drForm .ic-level-1").each(function (index) {
                        var stID = $(this).find("input[name='stID']").val();
                        var spmID = $(this).find("input[name='spmID']").val();
                        var stQty = $(this).find("input[name='stQty']").val();
                        var tiQty= $(this).find("input[name='tiQty']").val();
                        var tiSubtotal= parseFloat($(this).find("input[name='tiSubtotal']").val());
                        var tiActualQty= $(this).find("input[name='tiActualQty']").val()
                        var price = parseFloat($(this).find("input[name='spmPrice']").val());
                        var piID = parseInt($(this).find("input[name='spmName']").data("piid"));
                        var tiDiscount = parseInt($(this).find("input[name='tiDiscount']").val());
                        rTotal = parseFloat(rTotal + tiSubtotal);

                        purItems.push({
                            piID: piID,
                            stID: stID,
                            stQty: stQty,
                            tiSubtotal:tiSubtotal,
                            spmID: spmID,
                            tiQty: tiQty,
                            tiActualQty:tiActualQty,
                            tiDate: date,
                            tiDiscount: tiDiscount,
                            rTotal:rTotal
                        });
                    });

                    params.data = {
                        spID: supplier,
                        spAltName: source,
                        date: date,
                        receipt: receipt,
                        remarks: remarks,
                        addtype: "po",
                        items: JSON.stringify(purItems)
                    }
                    break;

                case "return":
                    $("#drForm .ic-level-1").each(function (index) {
                        var oldtiQty = parseInt($(this).find("input[name='stock']").attr('data-tiqty'));
                        var tiQty = parseInt($(this).find("input[name='qty']").val());
                        var actqty = parseInt($(this).find("input[name='stock']").attr('data-actqty'));
                        var price = parseFloat($(this).find("input[name='stock']").attr('data-price'));
                        var actualQty = tiQty * actqty;
                        var subtotal = parseFloat(tiQty * price);
                        rTotal = parseFloat(rTotal + subtotal);

                        retItems.push({
                            stID: $(this).find("input[name='stock']").attr('data-id'),
                            riID: $(this).find("input[name='receipt']").attr('data-riid'),
                            spmID: $(this).find("input[name='stock']").attr('data-spmid'),
                            tiQty: tiQty,
                            tiActualQty: actualQty,
                            tiActual: actualQty,
                            tiSubtotal: subtotal,
                            tiRemarks: $(this).find("textarea[name='tiRemarks']").val(),
                            tiDate: date,
                            receipt: receipt
                        });
                    });

                    params.data = {
                        spID: supplier,
                        spAltName: source,
                        date: date,
                        receipt: receipt,
                        remarks: remarks,
                        addtype: "return",
                        items: JSON.stringify(retItems)
                    }
                    break;
            }

            $.ajax(params);

        });
    });

    function setIL1FormEvents() {
        $("#drForm .ic-level-1:last-child .exitBtn").on("click", function () {
            $(this).closest(".ic-level-1").remove();
        });
        $("#drForm .ic-level-1:last-child input[name='stID[]']").on('focus', function () {
            $("#stockBrochure").modal("show");
            $("#stockBrochure form").on("submit", function (event) {
                event.preventDefault();
                var st = $(this).find(".ic-level-2 input[name='stocks']:checked");
                $("#drForm .ic-level-1[data-focus='true'] input[name='stID[]']").attr("data-id",
                    st.val());
                $("#drForm .ic-level-1[data-focus='true'] input[name='stID[]']").val(st.attr(
                    "data-name"));
                $("#stockBrochure").modal("hide");
            });
        });
        $("#drForm .ic-level-1:last-child *").on("focus", function () {
            if (!$(this).closest(".ic-level-1").attr("data-focus")) {
                $("#drForm").find(".ic-level-1").removeAttr("data-focus");
                $(this).closest(".ic-level-1").attr("data-focus", true);
            }
        });
        $("#drForm .ic-level-1:last-child input[name='tiQty']").on("change", function () {
            setTotals();
        });
        $("#drForm .ic-level-1:last-child input[name='tiDiscount']").on("change", function () {
            setTotals();
        });
    }

   

    function setInputUOM(uom) {
        $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").append(uom.map(unit => {
            return `<option value="${unit.uomID}">${unit.uomAbbreviation} - ${unit.uomName}</option>`;
        }).join(''));
    }

    function setTotals() {
        var total = 0;

        $('input[name="tiSubtotal"]').each(function(index) {
            var subtotal = isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
            total = parseFloat(total + subtotal);

        }); 

        $("#drForm .total").text(total);
    }

    function checkSelectedStocks() {
        $("#drForm .ic-level-1").each(function(index) {
            var stid = $(this).data("stock");
            $("input[data-stid="+stid+"]").attr("checked",true);
        });
    }

    function resetForm() {
        $("#drForm .total").text("0");
        $("#drForm .ic-level-2").empty();
    }

            </script>

            </html>