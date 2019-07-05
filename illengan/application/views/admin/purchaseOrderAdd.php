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
                                <form id="conForm"  action="<?= site_url("admin/purchaseorder/add")?>" accept-charset="utf-8" class="form">
                                    <div class="card-body">
                                        <input type="text" name="tID" hidden="hidden">
                                        <div class="form-row">
                                            <!--Supplier-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Supplier</span>
                                                </div>
                                                <select class="spID form-control" name="spID" required>
                                                    <option value="" selected>Choose</option>
                                                    <?php if(isset($supplier)){
                                            foreach($supplier as $sup){?>
                                                    <option value="<?= $sup['spID']?>"><?= $sup['spName']?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                            <!--Date-->
                                            <div class="input-group input-group-sm mb-3 col">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" style="width:70px">Date</span>
                                                </div>
                                                <input type="date" class="form-control" name="tDate">
                                            </div>
                                        </div>
                                        <!--Remarks-->
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="width:70px">Remarks</span>
                                            </div>
                                            <textarea type="text" name="tRemarks" class="form-control form-control-sm"
                                                rows="1"></textarea>
                                        </div>
                                        <div class="ic-level-3">
                                        <table class="table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                <tr>
                                                    <th style="font-weight:500 !important;">Item Name</th>
                                                    <th style="font-weight:500 !important;">Qty</th>
                                                    <th style="font-weight:500 !important;">Unit</th>
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
                                        <button class="btn btn-success btn-sm" type="submit"
                                            style="float:right">Insert</button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="float:right">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <!--Start of Merchandise sidenav-->
                            <div class="card" id="poCard" style="float:left;width:35%;margin-left:3%">
                                <div class="card-header" style="overflow:auto">
                                    <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">
                                        Merchandise</div>
                                    <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                        <input type="search"
                                            style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                            name="search" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                <select class="suppliers form-control form-control-sm" name="suppliers">
                                    <option value="" selected>Select Supplier</option>
                                    <?php
                                foreach($supplier as $supp){
                                ?>
                                    <option value="<?= $supp['spID']?>"><?= $supp['spName']?></option>
                                <?php } ?>
                                <select>
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
                data></td>
            <td class="stock">${merch.spmName} (${merch.uomAbbreviation})</td>
            <td class="category">${merch.spmPrice}</td>
         </tr>`
     );
     });
 }

 $(function() {
     $(document).on("change","select[name='suppliers']", function() {
         suppmerch = <?= json_encode($suppmerch) ?>;
         var spID = $(this).val();
         console.log(spID);
         suppmerch = suppmerch.filter(merch => merch.spID === spID);
         console.log(suppmerch);
         showMerchandise();
     });

     $("#poCard .ic-level-1").on("click",function(event){
         if(event.target.type !== "checkbox"){
             $(this).find("input[name='stock']").trigger("click");
         } console.log("eyeyeye");
     });
     $(document).on("click", "#poCard input[name='stock']", function(event) {
         var id = $(this).val();
         var name = $(this).attr("data-name");

         console.log(id, name, $(this).is(":checked"));
         if($(this).is(":checked")){
             $("#conForm .ic-level-2").append(`
                    <tr class="ic-level-1" data-stock="${id}">
                        <td style="padding:1% !important"><input type="text"
                                class="form-control form-control-sm" data-id="${id}" value="${name}" name="stock" readonly></td>
                        <td style="padding:1% !important"><input type="number"
                                class="form-control form-control-sm" name="qty"></td>
                        <td style="padding:1% !important"><input type="number"
                                class="form-control form-control-sm" name="qty"></td>
                        <td style="padding:1% !important"><input type="number"
                                class="form-control form-control-sm" name="qty"></td>
                        <td style="padding:1% !important"><input type="number"
                                class="form-control form-control-sm" name="qty"></td>
                    </tr>`);

             $("#conForm").find('input[name="supplier"]').val(supplier);
             $("#conForm").find('input[name="supplier"]').attr('data-id', spID);
             $("#conForm").find('input[name="supplier"]').attr("readonly", true);
             
         }else{
             $(`#conForm .ic-level-1[data-stock=${id}]`).remove();
             if(isNaN($("#conForm .ic-level-2 tr").length) || $("#conForm .ic-level-2 tr").length == 0) {
                 $('#conForm')[0].reset();
             }
          
         }
     });
     $("#listDeliver input[name='search']").on("keyup",function(){
         var string = $(this).val();
         $("#listDeliver .item").each(function(index){
             if(!$(this).text().includes(string)){
                 $(this).closest(".ic-level-1").hide();
             }else{
                 $(this).closest(".ic-level-1").show();
             }
         });

     });
     $("#conForm").on("submit", function(event){
         event.preventDefault();
         var url = $(this).attr("action");
         var spID = $(this).find("input[name='supplier']").data("id");
         var spAltName = $(this).find("input[name='supplier']").val();
         var date = $(this).find("input[name='date']").val();
         console.log(date);
         var returnitems = [];
         var rTotal = 0;

         $(this).find(".ic-level-1").each(function(index){
             var tiQty = parseInt($(this).find("input[name='qty']").val());
             var actqty = parseInt($(this).find("input[name='stock']").attr('data-actqty'));
             var price = parseFloat($(this).find("input[name='stock']").attr('data-price'));
             var actualQty = tiQty * actqty;
             var subtotal = parseFloat(tiQty * price);
             rTotal = parseFloat(rTotal + subtotal);

             returnitems.push({
                 stID: $(this).find("input[name='stock']").attr('data-id'),
                 spmID: $(this).find("input[name='stock']").attr('data-spmid'),
                 tiQty: tiQty,
                 tiActual: actualQty,
                 tiSubtotal: subtotal,
                 tiRemarks: $(this).find("textarea[name='tiRemarks']").val(),
                 tiDate: date,
                 receipt: $(this).find("input[name='receipt']").val(),
                 riStatus: 'pending'
             }); 
         }); 

         $.ajax({
             method: "POST",
             url: url,
             data: {
                 date: date,
                 spID: spID,
                 spAltName: spAltName,
                 rTotal: rTotal,
                 items: JSON.stringify(returnitems)
             },
             succes: function(){
                 location.reload();
             },
             error: function(response, setting, error) {
                 console.log(error);
                 console.log(response.responseText);
             }
         });
     });
 });
    // var stocks = [];
    // var uom = [];
    // var supplier = [];
    // var suppmerch = [];
    // $(function() {
    //     $("#poForm select[name='spID']").on("change",function(){
    //         var supplier = $(this).val();
    //         console.log(supplier);
    //         $.ajax({
    //             method: "GET",
    //             url: "/admin/purchaseorder/get",
    //             data: {
    //                 id: supplier
    //             },
    //             dataType: "JSON",
    //             success: function(data){
    //                 console.log(data);
    //             },
    //             error: function(response, setting, errorThrown) {
    //                 console.log(errorThrown);
    //                 console.log(response.responseText);
    //             }
    //         });
    //     });
    //     $.ajax({
    //         url: '/admin/jsonPO',
    //         dataType: 'json',
    //         success: function(data) {
    //             var poLastIndex = 0;
    //             stocks = data.stock;
    //             supplier = data.supplier;
    //             suppmerch = data.suppmerch;
    //             uom = data.uom;
    //             $(".addMBtn").on('click', function() {
    //                 var spID = parseInt($(this).closest('.form').find('.spID').val());
    //                 var merchandise = suppmerch.filter(sm => sm.spID == spID);
    //                 setMerchandiseBrochure(merchandise);
    //                 $("#merchandiseBrochure form").on("submit", function(event) {
    //                     event.preventDefault();
    //                     $(this).find("input[name='stockitems']:checked").each(
    //                         function(index) {
    //                             var selectedMerch = merchandise.filter(merch =>
    //                                 merch.spmID == $(this).attr(
    //                                     "data-spmid"));
    //                             $("#addPurchaseOrder .ic-level-2").append(
    //                                 selectedMerch.map(merch => {
    //                                     return `<div style="overflow:auto;margin-bottom:2%" class="ic-level-1" data-stockid="${merch.stID}" data-stqty="${merch.prstQty}" data-currqty="${merch.stQty}">
    //                                 <div style="float:left;width:95%;overflow:auto;">
    //                                     <div class="find input-group mb-1">
    //                                         <input type="text" name="itemName[]"
    //                                             class="form-control form-control-sm"
    //                                             value="${merch.stName} ${merch.stSize}" style="width:24%" readonly>
    //                                         <input type="number" name="itemQty[]"
    //                                             class="tiQty form-control form-control-sm"
    //                                             placeholder="Quantity" value="1" min="1" onchange="setInputValues()">
    //                                         <select name="itemUnit[]"
    //                                             class="itemUnit form-control form-control-sm" readonly>
    //                                             <option value="" selected="selected">Unit</option>
    //                                         </select>
    //                                         <input type="number" name="price[]"
    //                                             class="tiPrice form-control form-control-sm"
    //                                             value="${merch.spmPrice}" readonly>
    //                                         <input type="number" name="discount[]"
    //                                             class="form-control form-control-sm "
    //                                             placeholder="Discount">
    //                                         <input type="number" name="itemSubtotal[]"
    //                                             class="tiSubtotal form-control form-control-sm"
    //                                             placeholder="Subtotal" readonly>
    //                                     </div>
    //                                     <div class="input-group">
    //                                         <select name="stID[]"
    //                                             class="stock form-control form-control-sm" readonly="readonly">
    //                                             <option value="" selected="selected">Stock Item
    //                                             </option>
    //                                         </select>
    //                                         <input name="actualQty[]" type="number"
    //                                             class="qtyPerItem form-control border-right"
    //                                             value="${merch.spmActualQty}" readonly="readonly">
    //                                     </div>
    //                                 </div>
    //                                 <div class="mt-4"style="float:left:width:3%;overflow:auto;">
    //                                     <img class="exitBtn" src="/assets/media/admin/error.png"style="width:20px;height:20px;float:right;">
    //                                 </div>
    //                             </div>`;
    //                                 }).join(''));
    //                             setInputValues()
    //                             $(".exitBtn").last().on('click', function() {
    //                                 $(this).closest(".ic-level-1")
    //                                     .remove();
    //                             });
    //                             $('.itemUnit').last().empty();
    //                             $(".itemUnit").last().append(`${uom.map(uom => {
    //                             return `<option value="${uom.uomID}">${uom.uomName}</option>`
    //                         }).join('')}`);
    //                             $("select[name='itemUnit[]']").last().find(
    //                                 `option[value=${selectedMerch[0].uomID}]`
    //                                 ).attr("selected", "selected");
    //                             $('.stock').last().empty();
    //                             $(".stock").last().append(`${stocks.map(stock => {
    //                             return `<option value="${stock.stID}">${stock.stName}</option>`
    //                         }).join('')}`);
    //                             $(".ic-level-1").last().find(
    //                                 `select[name='stID[]'] > option[value='${selectedMerch[0].stID}']`
    //                                 ).attr("selected", "selected");
    //                         });
    //                     $("#merchandiseBrochure").modal("hide");
    //                 });
    //             });
    //         },
    //         error: function(response, setting, errorThrown) {
    //             console.log(errorThrown);
    //             console.log(response.responseText);
    //         }
    //     });
    //     $("#merchandiseBrochure").on("hidden.bs.modal", function() {
    //         $(this).find("form")[0].reset();
    //         $(this).find("form").off("submit");
    //         $(this).find(".ic-level-2").empty();
    //     });
    //     $("#addPurchaseOrder").on('submit', function(event) {
    //         event.preventDefault();
    //         var supplier = $(this).find("select[name='spID']").val();
    //         var date = $(this).find("input[name='tDate']").val();
    //         var remarks = $(this).find("textarea[name='tRemarks']").val();
    //         var transitems = [];
    //         for (var index = 0; index < $(this).find(".ic-level-1").length; index++) {
    //             var row = $(this).find(".ic-level-1").eq(index);
    //             transitems.push({
    //                 uomID: row.find("select[name='itemUnit[]']").val(),
    //                 stID: row.find("select[name='stID[]']").val(),
    //                 name: row.find("input[name='itemName[]']").val(),
    //                 price: row.find("input[name='price[]']").val(),
    //                 discount: row.find("input[name='discount[]']").val(),
    //                 qty: row.find("input[name='itemQty[]']").val(),
    //                 actualQty: row.find("input[name='actualQty[]']").val()
    //             });
    //         }

    //         $.ajax({
    //             method: "post",
    //             url: "<?= site_url("admin/purchaseorder/add")?>",
    //             data: {
    //                 supplier: supplier,
    //                 date: date,
    //                 remarks: remarks,
    //                 transitems: JSON.stringify(transitems)
    //             },
    //             dataType: "json",
    //             beforeSend: function() {
    //                 console.log(supplier, date, remarks, transitems);
    //             },
    //             success: function(data) {
    //                 if (data.success) {
    //                     location.replace('<?= site_url("admin/purchaseorder")?>');
    //                 }
    //             },
    //             error: function(response, setting, error) {
    //                 console.log(error);
    //                 console.log(response.responseText);
    //             }
    //         });
    //     });
    // });
    </script>
</body>