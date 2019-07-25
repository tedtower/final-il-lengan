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
                                    <h6 style="font-size:15px;margin:0">Add Purchase Order</h6>
                                </div>
                                <form id="conForm" action="<?= site_url("admin/purchaseorder/add") ?>" accept-charset="utf-8" class="form">
                                    <div class="card-body">
                                        <input type="text" name="tID" hidden="hidden">
                                        <div class="form-row">
                                            <!--Supplier-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Supplier</span>
                                                </div>
                                                <select class="suppliers form-control form-control-sm" name="suppliers" required>
                                                    <option value="" selected>Select Supplier</option>
                                                    <?php
                                                    foreach ($supplier as $supp) {
                                                        ?>
                                                        <option value="<?= $supp['spID'] ?>"><?= $supp['spName'] ?></option>
                                                    <?php } ?>
                                                    <select>
                                            </div>
                                            <!--Date-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Date</span>
                                                </div>
                                                <input type="date" class="form-control" name="date" id="purchaseDate" required>
                                            </div>
                                        </div>
                                        <!--Remarks-->
                                        <!-- <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="width:70px">Remarks</span>
                                            </div>
                                            <textarea type="text" name="tRemarks" class="form-control form-control-sm"
                                                rows="1"></textarea>
                                        </div> -->
                                        <div class="ic-level-3">
                                            <table class="poitems table table-borderless">
                                                <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                    <tr>
                                                        <th style="font-weight:500 !important;width: 40%">Item Name</th>
                                                        <th style="font-weight:500 !important;">Qty</th>
                                                        <th style="font-weight:500 !important;width:5%">Unit</th>
                                                        <th style="font-weight:500 !important;">Price</th>
                                                        <th style="font-weight:500 !important;">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ic-level-2">

                                                </tbody>
                                            </table>
                                        </div>

                                        <br>
                                        <span>Total: &#8369;<span class="total">0</span>
                                            <!--Total of the trans items-->
                                    </div>
                                    <div class="card-footer mb-0" style="overflow:auto">
                                        <button class="btn btn-success btn-sm" type="submit" style="float:right">Insert</button>
                                        <a href="<?= site_url('admin/purchaseorder') ?>" class="btn btn-danger btn-sm" style="float:right" role="button">Cancel</a>
                                    </div>
                                </form>
                            </div>

                            <!--Start of Merchandise sidenav-->
                            <div class="card" id="poCard" style="float:left;width:35%;margin-left:3%">
                                <div class="card-header" style="overflow:auto">
                                    <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">
                                        Merchandise</div>
                                    <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                        <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                    <!--checkboxes-->
                                    <table class="table table-borderless">
                                        <thead style="border-bottom:2px solid #cccccc">
                                            <tr>
                                                <th width="2%"></th>
                                                <th style="font-weight:500 !important;">Merchandise</th>
                                                <th style="font-weight:500 !important;">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody class="merchandises ic-level-2">

                                        </tbody>
                                    </table>
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
        var suppmerch = <?= json_encode($suppmerch) ?>;

        function showMerchandise() {
            $("tbody.merchandises").empty();
            suppmerch.forEach(function(merch) {
                $("tbody.merchandises").append(`
         <tr class="ic-level-1">
            <td><input type="checkbox" class="mr-2" name="stock"
                value="${merch.spmID}"
                data-name="${merch.spmName}" 
                data-uom="${merch.uomAbbreviation}"
                data-price="${merch.spmPrice}"
                data-actual="${merch.spmActual}"
                data-stid="${merch.stID}"
                data-uomid="${merch.uomID}"></td>
            <td class="stock">${merch.spmName} (${merch.uomAbbreviation})</td>
            <td class="price">${merch.spmPrice}</td>
         </tr>`);
            });
        }

        $(function() {
            $(document).on("change", "select[name='suppliers']", function() {
                $(".poitems > tbody").empty();
                suppmerch = <?= json_encode($suppmerch) ?>;
                var spID = $(this).val();
                suppmerch = suppmerch.filter(merch => merch.spID === spID);
                showMerchandise();
            });

            $("#poCard .ic-level-1").on("click", function(event) {
                if (event.target.type !== "checkbox") {
                    $(this).find("input[name='stock']").trigger("click");
                }
            });
            $(document).on("click", "#poCard input[name='stock']", function(event) {
                var spmid = $(this).val();
                var spmName = $(this).attr("data-name");
                var spmPrice = $(this).attr("data-price");
                var spmActual = $(this).attr("data-actual");
                var uomID = $(this).attr("data-uomid");
                var uomAbbreviation = $(this).attr("data-uom");
                var stID = $(this).attr("data-stid");


                console.log(spmid, spmName, $(this).is(":checked"));
                if ($(this).is(":checked")) {
                    $("#conForm .ic-level-2").append(`
                    <tr class="ic-level-1" data-stock="${spmid}">
                        <td style="padding:1% !important"><input type="text"
                                class="form-control form-control-sm" data-id="${spmid}" data-actual="${spmActual}" data-stid="${stID}" value="${spmName}" name="spm" readonly></td>
                        <td style="padding:1% !important"><input type="number"
                                class="form-control form-control-sm" value='0' min="0" name="qty" required></td>
                        <td style="padding:1% !important"><input type="text"
                                class="form-control form-control-sm" data-uom="${uomID}" value="${uomAbbreviation}" name="unit" readonly></td>
                        <td style="padding:1% !important"><input type="number"
                                class="form-control form-control-sm" value="${spmPrice}" name="price" readonly></td>
                        <td style="padding:1% !important"><input type="number"
                                class="subtotal form-control form-control-sm" name="subtotal" readonly></td>
                    </tr>`);

                } else {
                    $(`#conForm .ic-level-1[data-stock=${spmid}]`).remove();
                    if (isNaN($("#conForm .ic-level-2 tr").length) || $("#conForm .ic-level-2 tr").length == 0) {
                        $('#conForm')[0].reset();
                    }

                }
            });
            $(document).on("change", "input[name='qty']", function() {
                var total = 0;
                var subtotal = $(this).val() * $(this).closest(".poitems > tbody > tr").find("input[name='price']").val();
                $(this).closest(".poitems > tbody > tr").find("input[name='subtotal']").val(subtotal);

                for (var i = 0; i <= $('.subtotal').length - 1; i++) {
                    total = total + parseFloat($('.subtotal').eq(i).val());
                    $('.total').text(total);
                }
            });

            //Search Function
            $("#poCard input[name='search']").on("keyup", function() {
                var string = $(this).val().toLowerCase();

                $("#poCard .ic-level-1").each(function(index) {
                    var text = $(this).text().toLowerCase().replace(/(\r\n|\n|\r)/gm, ' ');
                    if (!text.includes(string)) {
                        $(this).closest("tr").hide();
                    } else {
                        $(this).closest("tr").show();
                    }
                });

            });

            $("#conForm").on("submit", function(event) {
                event.preventDefault();
                var url = $(this).attr("action");
                var supplier = $(this).find("select[name='suppliers']").val();
                var date = $(this).find("input[name='date']").val();
                poitems = [];
                var poTotal = 0;

                $(this).find(".ic-level-1").each(function(index) {
                    var date = $("#conForm").find("input[name='date']").val();
                    var tiQty = parseInt($(this).find("input[name='qty']").val());
                    var actqty = parseInt($(this).find("input[name='spm']").attr('data-actual'));
                    var price = parseFloat($(this).find("input[name='price']").val());
                    var actualQty = tiQty * actqty;
                    var subtotal = parseFloat(tiQty * price);
                    poTotal = parseFloat(poTotal + subtotal);

                    poitems.push({
                        stID: $(this).find("input[name='spm']").attr('data-stid'),
                        spmID: $(this).find("input[name='spm']").attr('data-id'),
                        tiQty: tiQty,
                        date: date,
                        tiActual: actualQty,
                        tiSubtotal: subtotal,
                        piStatus: 'pending',
                        piType: 'purchase order'
                    });
                });

                if ($('input[name="stock"]:checked').length == 0) {
                    alert('No checkbox is checked');
                    return false;
                }
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {
                        supplier: supplier,
                        date: date,
                        total: poTotal,
                        poitems: JSON.stringify(poitems)
                    },
                    beforeSend: function() {
                        console.log(supplier, date, poitems);
                    },
                    success: function() {
                        location.reload();
                    },
                    error: function(response, setting, error) {
                        console.log(error);
                        console.log(response.responseText);
                    }
                });
            });

            $('#conForm').submit(function(event){
             var purchaseDate = $("#purchaseDate").val();
             var currentDate= new Date();
                if(Date.parse(currentDate) < Date.parse(spDate)){
                    alert('Please check the date entered!');
                    return false;
                }
            });
        });
    </script>
</body>