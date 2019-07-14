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

                                        <!--input fields in adding trans items w/PO and w/supplier -->
                                        <!-- <div class="ic-level-2">
                                            <div style="overflow:auto" class="ic-level-1">
                                                <div style="float:left;width:96%;overflow:auto;">
                                                    <div class="input-group mb-1">
                                                        <input type="text" name="name[]"
                                                            class="form-control form-control-sm" placeholder="Item Name"
                                                            style="width:17%">
                                                        <input type="number" name="qty[]"
                                                            class="form-control form-control-sm" placeholder="spmActualQty">
                                                        <input type="number" name="qty[]"
                                                            class="form-control form-control-sm" placeholder="tiQty">
                                                        <input type="text" name="unit[]"
                                                            class="form-control form-control-sm" placeholder="Unit">
                                                        <input type="number" name="price[]"
                                                            class="form-control form-control-sm" placeholder="Price">
                                                        <input type="number" name="discount[]"
                                                            class="form-control form-control-sm" placeholder="Discount">
                                                        <input type="number" name="subtotal[]"
                                                            class="form-control form-control-sm" placeholder="Subtotal"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="mt-2" style="float:left:width:3%;overflow:auto">
                                                    <img class="exitBtn" src="/assets/media/admin/error.png"
                                                        style="width:15px;height:15px;float:right;">
                                                </div>
                                            </div>
                                             <div style="overflow:auto" class="ic-level-1">
                                                <div style="float:left;width:96%;overflow:auto;">
                                                    <div class="input-group mb-1">
                                                        <input name="stID[]" type="text"
                                                            class="form-control form-control-sm" placeholder="Stock">
                                                        <input name="actualQty[]" type="number"
                                                            class="form-control form-control-sm" placeholder="Actual Qty">
                                                    </div>
                                                </div>
                                                <div class="mt-2" style="float:left:width:3%;overflow:auto">
                                                    <img class="exitBtn" src="/assets/media/admin/error.png"
                                                        style="width:15px;height:15px;float:right;">
                                                </div>
                                            </div> -->
                                        <!-- </div> -->

                                        <!--input fields in adding trans items w/o Supplier -->
                                        <!-- <div class="ic-level-2">
                                            <div style="overflow:auto" class="ic-level-1">
                                                <div style="float:left;width:96%;overflow:auto;">
                                                    <div class="input-group mb-1">
                                                        <input name="stID[]" type="text"
                                                            class="form-control form-control-sm" placeholder="Stock">
                                                        <input name="actualQty[]" type="number"
                                                            class="form-control form-control-sm" placeholder="Actual Qty">
                                                    </div>
                                                </div>
                                                <div class="mt-2" style="float:left:width:3%;overflow:auto">
                                                    <img class="exitBtn" src="/assets/media/admin/error.png"
                                                        style="width:15px;height:15px;float:right;">
                                                </div>
                                            </div>
                                        </div> -->
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
                            <div class="card" id="stockCardPO" style="float:left;width:35%;margin-left:3%">
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
                                                <option value="" selected>Choose PO</option>
                                            </select>
                                        </div>
                                        <h5 class="modal-title" id="exampleModalLabel">Purchase Item</h5>
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
                            <div class="card" id="returnCard" style="float:left;width:35%;margin-left:3%" hidden>
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
                                        <select class="form-control form-control-sm" required>
                                            <option value="" selected>Choose Return</option>
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
                            <div class="card" id="stockCardmerch" style="float:left;width:35%;margin-left:3%">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Merchandise Name</h5>
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
            
            $(function() {
                var uom;
                var stockitems;
                $.ajax({
                    method: "GET",
                    url: "/admin/getUOMs",
                    dataType: "JSON",
                    success: function(data) {
                        uom = data.uom;
                        stockitems = data.stocks;
                    }
                });
                $("#drForm .radio-level").on("change",function(){
                    resetForm();
                    var level = $(this).attr("data-trigger-level");
                    $("#drForm .status-level").each(function(index){
                        !$(this).attr("data-level").includes(level) && $(this).attr("data-level") != 0 ? $(this).prop("disabled",true) : $(this).prop("disabled",false);
                    }); 
                });
                $("#addNewBtn").on("click", function() {
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

                    stockitems.forEach(function(item) {
                        $("select[name='stID[]']").append(
                            `<option value="${item.stID}">${item.stName}</option>`
                        );
                    })
                });
                $("#addMBtn").on("click", function() {
                    $.ajax({
                        url: '<?= site_url('admin/viewStockitems') ?>',
                        dataType: 'json',
                        success: function (data) {
                            var poLastIndex = 0;
                            var merch = data;
                            setMerchandiseBrochure(merch);
                            $("#merchandiseBrochure form").on("submit", function(event) {
                                    event.preventDefault();
                                    merchBrochureOnSubmit(data.uom, data
                                        .merchandise, $(this).find(
                                            "input[name='merch']:checked"));
                                });
                        },
                        failure: function () {
                            console.log('None');
                        },
                        error: function (response, setting, errorThrown) {
                            console.log(errorThrown);
                            console.log(response.responseText);
                        }
                    });
                });
        // $(document).on("click", "#stockCardmerch .ic-level-1",function(event){
        //     if(event.target.type !== "checkbox"){
        //         $(this).find("input[name='merch']").trigger("click");
        //     }
        // });
        $(document).on("click", "#listpo input[name='purchorder']",function(event) {
          
          var id = $(this).val();
          var name = $(this).attr("data-spmName");
          var curQty = $(this).attr("data-curQty");
          var spmActual = $(this).attr("data-spmActual");
          var spmPrice = $(this).attr("data-spmPrice");
          var spID = $(this).attr("data-spID");
          console.log(id, name, $(this).is(":checked"));
          if($(this).is(":checked")){
              $("#drForm .ic-level-2").append(`
              <div style="overflow:auto" class="ic-level-1">
                  <div style="float:left;width:96%;overflow:auto;">
                      <div class="input-group mb-1">
                      <input type="text" name="name"
                          class="form-control form-control-sm" data-id="${id}" value="${name}"
                          style="width:17%">
                       <input type="text" name="receiptNo" id="receiptNo" placeholder="Receipt No."
                          class="form-control form-control-sm" style="width:17%">
                       <input type="hidden" name="spID"
                          class="form-control form-control-sm" placeholder="spID" id="spID" value="${spID}">
                      <input type="hidden" name="spmActualQty"
                          class="form-control form-control-sm" placeholder="spmActualQty" id="spmActualQty" value="${spmActual}">
                      <input type="number" name="tiQty" id="tiQty"
                          class="form-control form-control-sm" placeholder="tiQty">
                       <input type="number" name="tiActualQty" id="tiActualQty"
                          class="form-control form-control-sm" placeholder="tiActualQty">
                      <input type="number" name="spmPrice" id="spmPrice"
                          class="form-control form-control-sm" placeholder="Price" value="${spmPrice}">
                      <input type="number" name="subtotal" id="subtotal"
                          class="form-control form-control-sm" placeholder="Subtotal"
                          readonly>
                      </div>
                      <label style="width:96%"><input type="checkbox" name="discount" id ="discount" class="discount mr-2">Add Discount</label>
                  </div>
              </div>
              `);
                  console.log($(this));
          }else{
              $(`#drForm .ic-level-2[data-stock=${id}]`).remove();
          }
      });

        $(document).on("click", "#list input[name='merch']",function(event) {
          
           var id = $(this).val();
           var name = $(this).attr("data-spmName");
           var curQty = $(this).attr("data-curQty");
           var spmActual = $(this).attr("data-spmActual");
           var spmPrice = $(this).attr("data-spmPrice");
           var spID = $(this).attr("data-spID");
           console.log(id, name, $(this).is(":checked"));
           if($(this).is(":checked")){
               $("#drForm .ic-level-2").append(`
               <div style="overflow:auto" class="ic-level-1">
                   <div style="float:left;width:96%;overflow:auto;">
                       <div class="input-group mb-1">
                       <input type="text" name="name"
                           class="form-control form-control-sm" data-id="${id}" value="${name}"
                           style="width:17%">
                        <input type="text" name="receiptNo" id="receiptNo" placeholder="Receipt No."
                           class="form-control form-control-sm" style="width:17%">
                        <input type="hidden" name="spID"
                           class="form-control form-control-sm" placeholder="spID" id="spID" value="${spID}">
                       <input type="hidden" name="spmActualQty"
                           class="form-control form-control-sm" placeholder="spmActualQty" id="spmActualQty" value="${spmActual}">
                       <input type="number" name="tiQty" id="tiQty"
                           class="form-control form-control-sm" placeholder="tiQty">
                        <input type="number" name="tiActualQty" id="tiActualQty"
                           class="form-control form-control-sm" placeholder="tiActualQty">
                       <input type="number" name="spmPrice" id="spmPrice"
                           class="form-control form-control-sm" placeholder="Price" value="${spmPrice}">
                       <input type="number" name="subtotal" id="subtotal"
                           class="form-control form-control-sm" placeholder="Subtotal"
                           readonly>
                       </div>
                       <label style="width:96%"><input type="checkbox" name="discount" id ="discount" class="discount mr-2">Add Discount</label>
                   </div>
               </div>
               `);
                   console.log($(this));
           }else{
               $(`#drForm .ic-level-2[data-stock=${id}]`).remove();
           }
       });
       $(document).on('change', '#tiQty', function() {
            var tiQty = parseFloat(document.getElementById('tiQty').value);
            var spmActualQty = parseFloat(document.getElementById('spmActualQty').value);
            
            var tiActual = parseFloat(tiQty*spmActualQty);
            $("#drForm").find("input[name='tiActualQty']").val(tiActual); 

            var spmPrice = parseFloat(document.getElementById('spmPrice').value);
            var subtotal = parseFloat(spmPrice*tiQty);
            $("#drForm").find("input[name='subtotal']").val(subtotal); 
        });
        $(document).on('click', '.discount', function(){
            var subtotal = parseFloat(document.getElementById('subtotal').value);
            if ( this.checked ) {
            var disPrice = parseFloat(subtotal - (0.20*subtotal));
            $("#drForm").find("input[name='subtotal']").val(disPrice);
            }else{
            var disPrice = parseFloat(subtotal + (0.20*subtotal));
            $("#drForm").find("input[name='subtotal']").val(disPrice);
            } 
        });
         // -----------------------Populate Dropdown----------------------------------------
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

				function setStockData(stockitem){
                    console.log(stockitem);
						$("#po").append(`${stockitem.map(stocks => {
							return `<option name= "piID" id ="piID" data-pID="${stocks.pID}" value="${stocks.piID}">${stocks.spName} (${stocks.pDate})</option>`
						}).join('')}`);
				}
			//   -----------------------End of Dropdown Populate--------------------------
            
                // $("#addPOBtn").on("click", function() {
                //     $.ajax({
                //         url: '<?= site_url('admin/viewPurchItems ') ?>',
                //         dataType: 'json',
                //         success: function (data) {
                //             var poLastIndex = 0;
                //             var purchorder = data;
                //             setPOBrochure(purchorder);
                //             $("#merchandiseBrochure form").on("submit", function(event) {
                //                     event.preventDefault();
                //                     merchBrochureOnSubmit(data.uom, data
                //                         .merchandise, $(this).find(
                //                             "input[name='purchorder']:checked"));
                //                 });
                //         },
                //         failure: function () {
                //             console.log('None');
                //         },
                //         error: function (response, setting, errorThrown) {
                //             console.log(errorThrown);
                //             console.log(response.responseText);
                //         }
                //     });
                // });
                 $("#po").on("change", function() {
                    // var pID = $(this).attr("data-pID");
                    var piID = document.getElementById('piID').value;
                    console.log("piID"+ piID);
                    // console.log("pID"+ pID);
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('admin/viewPurchItems ') ?>',
                        data: {
                            piID:piID
                        },
                        dataType: 'json',
                        success: function (data) {
                            var poLastIndex = 0;
                            var purchorder = data;
                            setPOBrochure(purchorder);
                            
                        },
                        error: function(response, setting, error) {
                            console.log(response.responseText);
                            console.log(error);
                        }
                    });
                });

              
                $("#addPOBtn").on("click", function() {
                    var supplier = $("#drForm select[name='spID']").val();
                    var url = $(this).attr("data-url");
                    if (!isNaN(parseInt(supplier))) {
                        $.ajax({
                            method: "POST",
                            url: url,
                            data: {
                                id: supplier
                            },
                            dataType: "JSON",
                            success: function(data) {
                                data.uom = uom;
                                if (data.pos.length === 0) {
                                    $("#poBrochure .brochureErrMsg").show();
                                    $("#poBrochure .brochureErrMsg").text(
                                        "No purchase orders made for current selected supplier."
                                        );
                                    $("#poBrochure .ic-level-3").hide();
                                } else {
                                    $("#poBrochure .ic-level-3").show();
                                    setPOBrochure(data);
                                }
                            },
                            error: function(response, setting, errorThrown) {
                                console.log(errorThrown);
                                console.log(response.responseText);
                            }
                        });
                    } else {
                        $("#poBrochure .ic-level-3").hide();
                        $("#drBrochure .brochureErrMsg").show();
                        $("#poBrochure .brochureErrMsg").text("No supplier selected.");
                    }
                });
            
                $("#merchandiseBrochure").on("hidden.bs.modal", function() {
                    $(this).find("form")[0].reset();
                    $(this).find("form").off("submit");
                    $(this).find(".ic-level-2").empty();
                    $(this).find(".brochureErrMsg").empty();
                    $(this).find(".brochureErrMsg").hide();
                });
                $("#stockBrochure").on("hidden.bs.modal", function() {
                    $(this).find("form")[0].reset();
                    $(this).find("form").off("submit");
                });
                $("#poBrochure").on("hidden.bs.modal", function() {
                    $(this).find("form")[0].reset();
                    $(this).find(".ic-level-2").empty();
                    $(this).find("form").off("submit");
                    $(this).find(".brochureErrMsg").empty();
                    $(this).find(".brochureErrMsg").hide();
                    $(this).find("select[name='po'] option:first-child ~ option").remove();
                });

                // ----------------------- RESOLVING RETURNED ITEMS -----------------------
                $("#addRBtn").on("click", function () {
                    $("#returnCard").removeAttr("hidden");
                    var supplier = $("#drForm select[name='spID']").val();
                    var url = $(this).attr("data-url");
                    setReturnsBrochure();

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
                                <input type="number" class="form-control form-control-sm" name="qty" value="${tiQty}" min="1">
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
                        console.log($('#drForm .ic-level-1[data-riID="'+ riID +'"]'));
                        $('#drForm .ic-level-1[data-riID="'+ riID +'"]').remove();
                        if (isNaN($("#drForm .ic-level-2 tr").length) || $("#conForm .ic-level-2 tr").length == 0) {
                            $('#drForm')[0].reset();
                        }

                    }
                });
                $("#drForm").on("submit", function(event) {
                    event.preventDefault();
                    var supplier = parseInt($(this).find("select[name='supplier']").val());
                    var source = $(this).find("input[name='source']").val();
                    var date = $(this).find("input[name='date']").val();
                    var receipt = $(this).find("input[name='receipt']").val();
                    var remarks = $(this).find("textarea[name='remarks']").val();
                    var newItems = [], merchItems = [], purItems = [], retItems = [];
                    var rTotal = 0;

                    var params = {
                        url: '/admin/deliveryreceipt/add',
                        type: "POST",
                        success: function() {
                            console.log("yehey");
                        }
                    };

                    switch (parseInt($("input[name='inlineRadioOptions']:checked").val())) {
                        case 1:
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
                                addtype: 4,
                                items: JSON.stringify(newItems)
                            }
                            break;
                        case 2:
                            // console.log("2");
                            $("#drForm .ic-level-1").each(function (index) {
                                merchItems.push({
                                        receiptNo: $(this).find("input[name='receiptNo[]']").val(),
                                        spID: $(this).find("input[name='spID[]']").val(),
                                        spmActualQty: $(this).find("input[name='spmActualQty[]']").val(),
                                        tiQty:$(this).find("input[name='tiQty[]']").val(),
                                        tiActualQty:$(this).find("input[name='tiActualQty[]']").val(),
                                        spmPrice:$(this).find("input[name='spmPrice[]']").val(),
                                        price:$(this).find("input[name='price[]']").val()
                                    });
                                });

                                params.data = {
                                    spAltName: source,
                                    date: date,
                                    receipt: receipt,
                                    remarks: remarks,
                                    addtype: 2,
                                    items: JSON.stringify(merchItems)
                                }
                                break;
                            
                        case 3:
                            // console.log("3");
                            $("#drForm .ic-level-1").each(function (index) {
                                purItems.push({
                                        receiptNo: $(this).find("input[name='receiptNo[]']").val(),
                                        spID: $(this).find("input[name='spID[]']").val(),
                                        spmActualQty: $(this).find("input[name='spmActualQty[]']").val(),
                                        tiQty:$(this).find("input[name='tiQty[]']").val(),
                                        tiActualQty:$(this).find("input[name='tiActualQty[]']").val(),
                                        spmPrice:$(this).find("input[name='spmPrice[]']").val(),
                                        price:$(this).find("input[name='price[]']").val()
                                    });
                                });

                                params.data = {
                                    spAltName: source,
                                    date: date,
                                    receipt: receipt,
                                    remarks: remarks,
                                    addtype: 3,
                                    items: JSON.stringify(purItems)
                                }
                                break;

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
                                    receipt: receipt,
                                    riStatus: (oldtiQty !== tiQty) ? 'pending' : 'replaced',
                                });
                            });

                            params.data = {
                                spID: supplier,
                                spAltName: source,
                                date: date,
                                receipt: receipt,
                                remarks: remarks,
                                addtype: 3,
                                items: JSON.stringify(retItems)
                            }
                            break;
                    }

                    $.ajax(params);
                    console.log(params);
                   
                    // var url = $(this).attr("action");
                    // var supplier = $("#drForm select[name='spID']").val();
                    // var date = $("#drForm input[name='tDate']").val();
                    // var receipt = $("#drForm input[name='receipt']").val();
                    // var remarks = $("#drForm textarea[name='tRemarks']").val();
                    // var orItems = [];
                    // $("#drForm .ic-level-1").each(function(index) {
                    //     orItems.push({
                    //         tiID: $(this).attr("data-id"),
                    //         name: $(this).find("input[name='itemName[]']").val(),
                    //         qty: $(this).find("input[name='itemQty[]']").val(),
                    //         uomID: $(this).find("select[name='itemUnit[]']").val(),
                    //         price: $(this).find("input[name='itemPrice[]']").val(),
                    //         discount: $(this).find("input[name='discount[]']").val(),
                    //         stID: $(this).find("input[name='stID[]']").attr("data-id"),
                    //         actualQty: $(this).find("input[name='actualQty[]']").val()
                    //     });
                    // });
                    // $.ajax({
                    //     method: "POST",
                    //     url: url,
                    //     data: {
                    //         supplier: supplier,
                    //         date: date,
                    //         receipt: receipt,
                    //         remarks: remarks,
                    //         items: JSON.stringify(orItems)
                    //     },
                    //     dataType: "JSON",
                    //     success: function(data) {
                    //         console.log(data);
                    //     },
                    //     error: function(response, setting, error) {
                    //         console.log(error);
                    //         console.log(response.responseText);
                    //     }
                    // });
                });
            });
        
            
               

            function setIL1FormEvents() {
                $("#drForm .ic-level-1:last-child .exitBtn").on("click", function() {
                    $(this).closest(".ic-level-1").remove();
                });
                $("#drForm .ic-level-1:last-child input[name='stID[]']").on('focus', function() {
                    $("#stockBrochure").modal("show");
                    $("#stockBrochure form").on("submit", function(event) {
                        event.preventDefault();
                        var st = $(this).find(".ic-level-2 input[name='stocks']:checked");
                        $("#drForm .ic-level-1[data-focus='true'] input[name='stID[]']").attr("data-id",
                            st.val());
                        $("#drForm .ic-level-1[data-focus='true'] input[name='stID[]']").val(st.attr(
                            "data-name"));
                        $("#stockBrochure").modal("hide");
                    });
                });
                $("#drForm .ic-level-1:last-child *").on("focus", function() {
                    if (!$(this).closest(".ic-level-1").attr("data-focus")) {
                        $("#drForm").find(".ic-level-1").removeAttr("data-focus");
                        $(this).closest(".ic-level-1").attr("data-focus", true);
                    }
                });
                $("#drForm .ic-level-1:last-child input[name='itemQty[]']").on("change", function() {
                    setTotals();
                });
                $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").on("change", function() {
                    setTotals();
                });
                $("#drForm .ic-level-1:last-child input[name='discount[]']").on("change", function() {
                    setTotals();
                });
            }

            function setMerchandiseBrochure(merch) {
                $("#list").empty();
                    $("#list").append(`${merch.map(stock => {
                        return `<label style="width:96%"><input type="checkbox" name="merch" class="choiceStock mr-2"data-spID="${stock.spID}" data-spmActual="${stock.spmActual}" data-spmPrice="${stock.spmPrice}" data-spmName="${stock.spmName}" value="${stock.spmID}">${stock.spmName}</label>`
                    }).join('')}`);
            }

            function setPOBrochure(purchorder) {
                $("#listpo").empty();
                    $("#listpo").append(`${purchorder.map(stock => {
                        return `<label style="width:96%"><input type="checkbox" name="purchorder" class="choiceStock mr-2"  data-piID="${stock.piID}" data-pID="${stock.pID}"  data-spID="${stock.spID}" data-spmActual="${stock.spmActual}" data-spmPrice="${stock.spmPrice}" data-spmName="${stock.spmName}" value="${stock.spmID}">${stock.spmName}</label>`
                    }).join('')}`);

                // $("#poBrochure select[name='po']").append(pos.pos.map(po => {
                //     return `<option value="${po.transactionID}">PO#${po.transNum}  Dated:${po.date}</option>`;
                // }).join(''));
                // $("#poBrochure select[name='po']").on("change", function() {
                //     $("#poBrochure .ic-level-2").empty();
                //     pos.poItems.filter(item => item.transactionID == $(this).val()).forEach(item => {
                //         $("#poBrochure .ic-level-2").append(`<tr class="ic-level-1">
                //     <td><input type="checkbox" name="poitems" class="mr-2" value="${item.itemID}"></td>
                //     <td>${item.name}</td>
                //     <td>${item.qty} (${item.unit})</td>
                //     <td>${item.price}</td>
                //     <td>${item.discount}</td>
                //     <td>${item.subtotal}</td>
                // </tr>`);
                //     });
                // });
                // $("#poBrochure form").on("submit", function(event) {
                //     event.preventDefault();
                //     $(this).find("input[name='poitems']:checked").each(function(index) {
                //         var item = pos.poItems.filter(item => item.itemID == $(this).val());
                //         $("#addNewBtn").trigger("click");
                //         $("#drForm .ic-level-1:last-child").attr("data-id", item[0].itemID);
                //         $("#drForm .ic-level-1:last-child input[name='itemName[]']").prop("readonly",
                //             true);
                //         $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").prop("readonly",
                //             true);
                //         $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").prop("readonly",
                //             true);
                //         $("#drForm .ic-level-1:last-child input[name='itemSubtotal[]']").prop(
                //             "readonly", true);
                //         $("#drForm .ic-level-1:last-child input[name='stID[]']").prop("readonly", true);
                //         $("#drForm .ic-level-1:last-child input[name='actualQty[]']").prop("readonly",
                //             true);
                //         $("#drForm .ic-level-1:last-child input[name='itemName[]']").val(item[0].NAME);
                //         $("#drForm .ic-level-1:last-child input[name='itemQty[]']").val(item[0].qty)
                //         $("#drForm .ic-level-1:last-child input[name='itemUnit[]']").prop("readonly",
                //             true);
                //         $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").find(
                //             `option[value=${item[0].uom}]`).attr("selected", "selected");
                //         $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").val(item[0]
                //         .price);
                //         $("#drForm .ic-level-1:last-child input[name='itemSubtotal[]']").val(item[0]
                //             .subtotal);
                //         $("#drForm .ic-level-1:last-child input[name='stID[]']").val(item[0].stockname);
                //         $("#drForm .ic-level-1:last-child input[name='stID[]']").attr("data-id", item[0]
                //             .stock);
                //         $("#drForm .ic-level-1:last-child input[name='actualQty[]']").val(item[0]
                //             .actual);
                //         $("#drForm .ic-level-1:last-child *").on("focus", function() {
                //             if (!$(this).closest(".ic-level-1").attr("data-focus")) {
                //                 $("# .ic-level-1").removeAttr("data-focus");
                //                 $(this).closest(".ic-level-1").attr("data-focus", true);
                //             }
                //         });
                //     });
                //     $("#poBrochure").modal("hide");
                // });
            }

            function setInputUOM(uom) {
                $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").append(uom.map(unit => {
                    return `<option value="${unit.uomID}">${unit.uomAbbreviation} - ${unit.uomName}</option>`;
                }).join(''));
            }

            function setTotals() {
                var qty = $("#drForm .ic-level-1[data-focus='true'] input[name='itemQty[]']").val();
                var price = $("#drForm .ic-level-1[data-focus='true'] input[name='itemPrice[]']").val();
                var discount = $("#drForm .ic-level-1[data-focus='true'] input[name='discount[]']").val();
                var subtotal = qty * (price - discount);
                subtotal = subtotal < 0 ? 0 : subtotal;
                var total = 0;
                $("#drForm .ic-level-1[data-focus='true'] input[name='itemSubtotal[]']").val(subtotal);
                $("#drForm .ic-level-1 input[name='itemSubtotal[]']").each(function(index) {
                    total += isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
                });
                $("#drForm .total").text(total);
            }

            function merchBrochureOnSubmit(uom, merchandise, selectedMerch) {
                var y;
                selectedMerch.each(function(index) {
                    y = merchandise.filter(x => x.spmID == $(this).val());
                    $("#addNewBtn").trigger("click");
                    $("#drForm .ic-level-1:last-child input[name='itemName[]']").prop("readonly", true);
                    $("#drForm .ic-level-1:last-child input[name='itemName[]']").val(y[0].spmName);
                    $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").prop("readonly", true);
                    $("#drForm .ic-level-1:last-child select[name='itemUnit[]']").find(
                        `option[value=${y[0].uomID}]`).attr("selected", "selected");
                    $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").prop("readonly", true);
                    $("#drForm .ic-level-1:last-child input[name='itemPrice[]']").val(y[0].spmPrice);
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").prop("readonly", true);
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").val(y[0].stName);
                    $("#drForm .ic-level-1:last-child input[name='stID[]']").attr("data-id", y[0].stID);
                    $("#drForm .ic-level-1:last-child input[name='actualQty[]']").prop("readonly", true);
                    $("#drForm .ic-level-1:last-child input[name='actualQty[]']").val(y[0].spmActualQty);
                    $("#drForm .ic-level-1:last-child *").on("focus", function() {
                        if (!$(this).closest(".ic-level-1").attr("data-focus")) {
                            $("#drForm .ic-level-1").removeAttr("data-focus");
                            $(this).closest(".ic-level-1").attr("data-focus", true);
                        }
                    });
                });
                $("#merchandiseBrochure").modal("hide");
            }
            var returns = <?= json_encode($returns) ?>;

            function setReturnsBrochure() {
                $("#returnCard tbody").empty();
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
                    data-spid="${del.spID}">${del.returnReference}</td>
                    <td class="item" data-stid='${del.stID}'>${del.item}</td>
                </tr>`);
                });
            }
            
            function resetForm() {
                $("#drForm .ic-level-2").empty();
            }

            // <div style="overflow:auto" class="ic-level-1">
            //                                     <div style="float:left;width:96%;overflow:auto;">
            //                                         <div class="input-group mb-1">
            //                                             <input type="text" name="name[]"
            //                                                 class="form-control form-control-sm" placeholder="Item Name"
            //                                                 style="width:17%">
            //                                             <input type="number" name="qty[]"
            //                                                 class="form-control form-control-sm" placeholder="Qty">
            //                                             <input type="text" name="unit[]"
            //                                                 class="form-control form-control-sm" placeholder="Unit">
            //                                             <input type="number" name="price[]"
            //                                                 class="form-control form-control-sm" placeholder="Price">
            //                                             <input type="number" name="discount[]"
            //                                                 class="form-control form-control-sm" placeholder="Discount">
            //                                             <input type="number" name="subtotal[]"
            //                                                 class="form-control form-control-sm" placeholder="Subtotal"
            //                                                 readonly>
            //                                         </div>
            //                                     </div>
            </script>

            </html>