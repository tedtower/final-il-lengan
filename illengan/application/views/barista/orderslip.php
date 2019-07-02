<!DOCTYPE html>
<htmL>

<head>
    <?php include_once('templates/head.php') ?>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/barista/cards.css' ?>" type="text/css">
</head>
<body style="background:#c7ccd1;">
    <?php include_once('templates/navigation.php') ?>
    <div>
        <button class="btn btn-success" style="padding-right:100px;font-size:15px;" onClick="window.location.href='<?php echo base_url(); ?>customer/checkin';return false;"><i class="far fa-plus"></i> Add Order</button>
    </div>
    <!--End Top Nav-->
    <div class="container-fluid">
        <section class="lists-container">

        </section>
    </div>
    <!-- End of lists container -->
    <!--End Cards-->
    <!--START "Remove Slip" MODAL-->
    <?php include_once('templates/scripts.php') ?>
    <script>
        var orderslips = [];
        var orderlists = [];
        var addons = [];
        var tables = [];
        $(function() {
            $.ajax({
                url: '<?= base_url("barista/getOrderslip") ?>',
                dataType: 'json',
                success: function(data) {
                    $.each(data.orderslips, function(index, item) {
                        orderslips.push({
                            "orderslips": item
                        });
                        orderslips[index].orderlists = data.orderlists.filter(ol => ol.osID == item.osID);
                    });
                    orderlists = data.orderlists;
                    addons = data.addons;
                    tables = data.tables;
                    setPenOrdersData();
                    console.log('Success');
                },
                error: function(response, setting, errorThrown) {
                    console.log(errorThrown);
                    console.log(response.responseText);
                }
            });
        });
        var olID;

        function setPenOrdersData() {
            orderslips.forEach(function(item) {
                var header = `
            <!--Long Order Card-->
            <div class="list" id="${item.orderslips.osID}">
                <div class="table-container card m-0 p-0" style="max-height:100%">
                    <!--Long Card Header-->
                    <div class="card-header p-1 m-1">
                        <div style="overflow:auto;font-size:14px">
                            <div class="row" style="float:left;text-align:left;width:100%">
                                <div style="width:25%"><b>Slip No: </b> ${item.orderslips.osID}</div>
                                <div style="width:35%"><b>Customer: </b>${item.orderslips.custName}</div>
                                <div style="width:40%"><b> Table No: </b>${item.orderslips.tableCode}<img class="editBtn" data-id="${item.orderslips.osID}" data-tableCode="${item.orderslips.tableCode}" src="/assets/media/barista/edit.png" style="width:15px;height:15px; float:right; cursor:pointer;" 
                                data-toggle="modal" data-target="#editTable"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!--Long Card Body-->
                    <div class="card-body p-0 m-0" style="overflow:auto">
                        <table class="table p-0 m-0" id="pendingordersTable" style="width:100%; height:15%;border:0">
                            <thead style="background:white">
                                <tr class="border-bottom; width:100%">
                                    <th class="p-2">Qty</th>
                                    <th class="p-2" width="70%">Order</th>
                                    <th class="p-2" width="20%">Status</th>
                                    <th style="width:2%"></th>
                                    <th style="width:2%"></th>
                                </tr>
                            </thead>
                    ${item.orderlists.map(ol => {
                        //olID = ol.olID;
                                    return `
                                    <tbody style="font-size:13px">
                                <tr data-id="${ol.olID}" style="overflow:auto">
                                    <td class="p-2">${ol.olQty}</td>
                                    <td class="p-2">${ol.olDesc}</td>
                                    <td class="p-2">
                                        <input type="button" style="width:100%;padding:6%;background:orange;color:white;border:0;border-radius:5px"
                                       id="item_status" data-id="${ol.olID}" value="${ol.olStatus}"/>
                                    </td>
                                    <td></td>
                                    <td>
                                        <img class="cancelBtn" data-status="${ol.olStatus}" data-id="${ol.olID}"src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;"  data-toggle="modal" data-target="#cancelModal">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Remarks:</td>
                                    <td class="p-2" colspan="4">${ol.olRemarks}</td>
                                </tr>
                                <tr>
                                    <td class="p-2">Addons:</td>
                                    <td class="aDoQty${ol.olID}"></td>
                                    <td colspan="2" class="aDoName${ol.olID}"></td>
                                    <td class="aDoPrice${ol.olID}"></td>
                                </tr>
                                `
                                }).join('')} 
                                </tbody>
                        </table>
                    </div>
                    <!--Footer-->
                    <div class="card-footer p-1 m-1 text-muted">
                            <div style="overflow:auto;">
                                <div style="float:right;width:25%;float:left;">
                                    <button class="deleteOS btn btn-warning btn-sm" style="font-size:13px;margin:0" data-toggle="modal" data-target="#deleteModal">Remove Slip</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
                var modal = `<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Remove Slip</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center py-2">
                            <i class="fas fa-times fa-4x animated rotateIn text-danger"></i>
                            <input hidden id="remID">
                            <p class="delius">Are you sure you want to remove this orderslip?</p>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" id="remSlip" class="btn btn-danger btn-sm">Remove</button>
                            </div>
                    </div>
                </div>
            </div>`;
                var tableModal = `<div class="modal fade" id="editTable" tabindex="-1" role="dialog" aria-labelledby="editTableModal" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Table Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="formEdit" accept-charset="utf-8" > 
                  <div class="modal-body">
                        <h6 id="editTableCode"></h6>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-sm" style="width:130px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                            Change Table</span>
                        </div>
                          <select name="tableCode" id="tableCode" class="form-control form-control-sm" required>
                          </select>                    
                        <input name="osID" id="osID" hidden="hidden">
                  </div>
                  <div class="modal-footer" id="updateTable" >
                  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                  <input type="hidden" id="updateDB" data-osID="${item.orderslips.osID}"/>
                  </div>
                </div>
                </form>
              </div>
            </div>
            </div>`;
                $('.lists-container').append(header);
                $('.lists-container').append(modal);
                $('.lists-container').append(tableModal);

            });
            $("input#item_status").on('click', function() {
                var id = $(this).attr('data-id');
                var stats = $(this).val();
                if (stats == 'served') {
                    stats = 'pending';
                    this.style.backgroundColor = "gray";
                    this.value = "pending";
                    stats = this.value;
                    console.log(stats, id);
                    updateStatus(stats, id);
                } else if (stats == 'pending') {
                    stats = 'served';
                    this.style.backgroundColor = "green";
                    this.value = "served";
                    stats = this.value;
                    console.log(stats, id);
                    updateStatus(stats, id);
                }
            });
            var btn;
            $("button.deleteOS").on("click", function() {
                btn = $(this);
            });
            $("button#remSlip").on("click", function() {
                var oSlip = getElementById()
                $(btn).closest("div.list").remove();
                location.reload();
            });
            $("img.cancelBtn").on("click", function() {
                var cancelID = $(this).attr('data-id');
                var chckStats = $(this).attr('data-status');
                if (chckStats == 'served') {
                    alert('Can not cancel!Already Served');
                } else {
                    cancelOrder(cancelID);
                }
            });
            $("img.editBtn").on("click", function() {
                var tableCode = $(this).attr('data-tableCode');
                var slipId = $(this).attr('data-id');
                setTableData(slipId);
            });
            addAddons();
        }

        function cancelOrder(cancelID) {
            $('#cancelModal').remove();
            console.log(cancelID);
            var name = orderlists.filter(item => item.olID === cancelID);
            console.log(name[0].mName);
            var cancel = `<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Cancel Order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center py-2">
                            <i class="fas fa-times fa-4x animated rotateIn text-danger"></i>
                            <input hidden id="remID">
                            <p class="delius">Are you sure you want to cancel <strong>${name[0].mName}</strong>?</p>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" id="cancel" data-id="${name[0].olID}"class="btn btn-danger btn-sm">Delete</button>
                            </div>
                    </div>
                </div>
            </div>`;
            $('.lists-container').append(cancel);
            $('button#cancel').on('click', function() {
                var getId = $(this).attr('data-id');
                $.ajax({
                    url: "<?= site_url('barista/deleteOrderItem') ?>",
                    method: "post",
                    data: {
                        'id': getId
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(response, setting, errorThrown) {
                        console.log(response.responseText);
                        console.log(errorThrown);
                    }
                });
            });
        }

        function updateStatus(stats, id) {
            console.log(stats, id);
            $.ajax({
                url: "<?= site_url('barista/updateStatus') ?>",
                method: "post",
                data: {
                    'status': stats,
                    'id': id
                },
                success: function(data) {
                    console.log(data);
                    location.reload();
                },
                error: function(response, setting, errorThrown) {
                    console.log(response.responseText);
                    console.log(errorThrown);
                }
            });
        }

        function addAddons() {
            // addons.forEach(ao => {
            for (var i = 0; i < addons.length; i++) {
                if ($(".thisAddons" + addons[i].olID) != '') {
                    for (var i = 0; i < addons.length; i++) {
                        $(".aDoQty" + addons[i].olID).append(`${addons[i].aoQty}<br>`);
                        $(".aDoName" + addons[i].olID).append(`${addons[i].aoName}<br>`);
                        $(".aDoPrice" + addons[i].olID).append(`${addons[i].aoTotal}<br>`);

                    }
                }
                //  });
            }
        }

        function setTableData(slipID) {
            console.log(slipID);
            $("#tableCode").empty();
            $("#tableCode").append(`<option>--Select--</option>`);
            $(tables).each(function(i) { //to list cities
                $("#tableCode").append(`<option id="table" value=` + tables[i].tableCode + `>` + tables[i].tableCode + `</option>`);
            });
            // for(var t=0; t < tables.length; t++){
            // $("#tableCode").append(`<option name= "tableCode" id ="table" value="${tables[t].tableCode}">${tables[t].tableCode}</option>`);
            // }   

            $("select#tableCode").on('change', function(event) {
                var optionSelected = $("option:selected", this);
                var tableCode = this.value;
                console.log(slipID, tableCode);
                $.ajax({
                    url: "<?= site_url("barista/editTableNumber") ?>",
                    method: "post",
                    data: {
                        'osID': slipID,
                        'tableCode': tableCode
                    },
                    success: function(data) {
                        alert('Table Updated');
                        location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }

                });
            });
        }
    </script>
</body>

</htmL