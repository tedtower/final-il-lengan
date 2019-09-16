<!DOCTYPE html>
<htmL>

<head>
    <!-- <meta http-equiv="refresh" content="3"> -->
    <?php include_once('templates/head.php') ?>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/barista/cards.css' ?>" type="text/css">
</head>

<body style="background:#c7ccd1;">
    <?php include_once('templates/navigation.php') ?>
    <div class="leftNav">
        <div class="addOrder">
            <button class="btn btn-success" style="padding-right:100px;font-size:15px;margin-left: 0px;"
                onClick="window.location.href='<?php echo base_url(); ?>customer/checkin';return false;"><i
                    class="far fa-plus"></i> Add Order</button>
        </div>
        <div class="mainkey"><span id="count" style="color: #FBDAB9 !important"></span> <span style="margin-left: 5px;">Orderslips</span></div>
        <div id="shortcutKeys">
        </div>
        <div class="mainkey icons-go">
        <div id="left" class="icons"><i class="far fa-arrow-left"></i></div>
        <div id="right" class="icons" style="margin-left: 20px"><i class="far fa-arrow-right"></i></div>
        </div>
    </div>

    <!--End Top Nav-->

    <div class="container-fluid" style="touch-action: pan-x;padding: 0px 100px 100px 200px;">
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
$(function () {
    $.ajax({
        url: '<?= base_url("barista/getOrderslip") ?>',
        dataType: 'json',
        success: function (data) {
            $.each(data.orderslips, function (index, item) {
                orderslips.push({
                    "orderslips": item
                });
                orderslips[index].orderlists = data.orderlists.filter(ol => ol.osID == item.osID);
            });
            orderlists = data.orderlists;
            addons = data.addons;
            tables = data.tables;
            setPenOrdersData(orderlists,orderaddons);
        },
        error: function (response, setting, errorThrown) {
            console.log(errorThrown);
            console.log(response.responseText);
        }
    });
});
var olID;
let count = 0;
function setPenOrdersData(olist,oad) {
    orderslips.forEach(function (item) {
        count += 1;
        let cust = (item.orderslips.custName === "" ? "Customer" : item.orderslips.custName);
        let customer = (item.orderslips.custName === "" ? "Customer" : item.orderslips.custName);
        customer = customer[0].toUpperCase();
        cust = cust.replace(cust[0], customer);

        var keys = `<a class="orderKey" data-locate="${item.orderslips.osID}"><div class="key"><span>${item.orderslips.osID}</span>
                        <span>${cust}</span></div></a>`;

        var header = `
            <!--Long Order Card-->
            <div class="list" id="${item.orderslips.osID}">
                <div class="table-container card m-0 p-0" style="max-height:100%">
                    <!--Long Card Header-->
                    <div class="card-header p-2">
                        <div class="row" style="text-align:left;font-size:14px">
                            <div style="width:70%">
                                <div class="mr-4" style="float:left">Slip No: <b>${item.orderslips.osID}</b></div>
                                <div style="float:left">Customer: <b>${cust}</b></div>
                            </div>

                            <div style="float:right;width:30%">Table No: <b>${item.orderslips.tableCode}</b><img class="editBtn" data-id="${item.orderslips.osID}" data-tableCode="${item.orderslips.tableCode}" src="/assets/media/barista/edit.png" style="width:15px;height:15px;float:right; cursor:pointer;" 
                            data-toggle="modal" data-target="#editTable"></div>
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
                            </thead>`;
                    var ol = olist.filter(function(ot){
                        return ot.osID == item.orderslips.osID;
                    });

                    header += `<tbody style="font-size:13px">`
                    for(o in ol){
                    header +=`<tr data-id="${ol[o].olID}" style="overflow:auto">
                                    <td class="p-2">${ol[o].olQty}</td>
                                    <td class="p-2">${ol[o].olDesc}</td>
                                    <td class="p-2">
                                        <input type="button" style="width:100%;padding:6%;background:orange;color:white;border:0;border-radius:5px"
                                       id="item_status" data-id="${ol[o].olID}" value="${ol[o].olStatus}"/>
                                    </td>
                                    <td></td>
                                    <td>
                                        <img class="cancelBtn" data-status="${ol[o].olStatus}" data-id="${ol.olID}"src="/assets/media/admin/error.png" style="width:18px;height:18px; float:right;"  data-toggle="modal" data-target="#cancelModal">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Remarks:</td>
                                    <td class="p-2" colspan="4">${ol[o].olRemarks}</td>
                                </tr>
                                <tr class="thisAddons${ol[o].olID}">`;
                    var add = oad.filter(function(oa){
                        return oa.olID == ol[o].olID;
                    })
                    
                    header += `<td>Addons:</td>`;
                        for(i in add){
                        header +=  `<td>${add[i].aoQty}&nbsp;${add[i].aoName}<br></td>`;
                        }               
                    }
                    header += `</tr></tbody>
                        </table>
                    </div>
                    <!--Footer-->
                        <div class="card-footer text-muted">
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
        $('#shortcutKeys').append(keys);
        $("#count").text(count);
    });
    $("input#item_status").on('click', function () {
        var id = $(this).attr('data-id');
        var stats = $(this).val();
        if (stats == 'served') {
            stats = 'pending';
            this.style.backgroundColor = "gray";
            this.value = "pending";
            stats = this.value;

            updateStatus(stats, id);
        } else if (stats == 'pending') {
            stats = 'served';
            this.style.backgroundColor = "green";
            this.value = "served";
            stats = this.value;

            updateStatus(stats, id);
        }
    });
    var btn;
    $("button.deleteOS").on("click", function () {
        btn = $(this);
    });
    $("button#remSlip").on("click", function () {
        $(btn).closest("div.list").remove();
        //location.reload();
    });
    $("img.cancelBtn").on("click", function () {
        var cancelID = $(this).attr('data-id');
        var chckStats = $(this).attr('data-status');
        if (chckStats == 'served') {
            alert('Cannot cancel! Already Served');
        } else {
            cancelOrder(cancelID);
        }
    });
    $("img.editBtn").on("click", function () {
        var tableCode = $(this).attr('data-tableCode');
        var slipId = $(this).attr('data-id');
        setTableData(slipId);
    });
}

function cancelOrder(cancelID) {
    $('#cancelModal').remove();
    var name = orderlists.filter(item => item.olID === cancelID);

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
                            <p class="delius">Are you sure you want to cancel <strong>${name[0].olDesc}</strong>?</p>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" id="cancel" data-id="${name[0].olID}"class="btn btn-danger btn-sm">Delete</button>
                            </div>
                    </div>
                </div>
            </div>`;

    $('.lists-container').append(cancel);
    $('button#cancel').on('click', function () {
        var getId = $(this).attr('data-id');
        $.ajax({
            url: "<?= site_url('barista/deleteOrderItem') ?>",
            method: "post",
            data: {
                'id': getId
            },
            success: function (data) {
                location.reload();
            },
            error: function (response, setting, errorThrown) {
                console.log(response.responseText);
                console.log(errorThrown);
            }
        });
    });
}

function updateStatus(stats, id) {
    $.ajax({
        url: "<?= site_url('barista/updateStatus') ?>",
        method: "post",
        data: {
            'status': stats,
            'id': id
        },
        success: function (data) {
            location.reload();
        },
        error: function (response, setting, errorThrown) {
            console.log(response.responseText);
            console.log(errorThrown);
        }
    });
}

function setTableData(slipID) {
    console.log(slipID);
    $("#tableCode").empty();
    $("#tableCode").append(`<option>--Select--</option>`);
    $(tables).each(function (i) { //to list cities
        $("#tableCode").append(`<option id="table" value=` + tables[i].tableCode + `>` + tables[i].tableCode + `</option>`);
    });
    // for(var t=0; t < tables.length; t++){
    // $("#tableCode").append(`<option name= "tableCode" id ="table" value="${tables[t].tableCode}">${tables[t].tableCode}</option>`);
    // }   

    $("select#tableCode").on('change', function (event) {
        var optionSelected = $("option:selected", this);
        var tableCode = this.value;
        console.log(slipID, tableCode);
        $.ajax({
            url: '<?= site_url("barista/editTableNumber") ?>',
            method: "post",
            data: {
                'osID': slipID,
                'tableCode': tableCode
            },
            success: function (data) {
                alert('Table Updated');
                location.reload();
            },
            error: function (error) {
                console.log(error);
            }

        });
    });
}
//-----------------Not Working--------------
// $(function() {
//     $("body").mousewheel(function(event, delta) {
//     this.scrollLeft -= (delta * 30);
//     event.preventDefault();
//     });
// });

//-----------Working but with Error in Chrome Console// using of jquery.mousewheel.min.js-------------
// $("html, body").mousewheel(function(event, delta) {
//     this.scrollLeft -= (delta * 30);
//     event.preventDefault();
// });
$(document).ready(function () {
    $("body").niceScroll();
    $("#shortcutKeys").niceScroll();
    $(document).on("click", "a.orderKey", function (event) {
        const id = $(this).attr("data-locate");
        document.documentElement.scrollLeft = document.getElementById(id).offsetLeft - 400;
        $("#" + id + " .card").addClass("active");

        setTimeout(() => {
            $("#" + id + " .card").addClass("non-active");
        }, 500);

        setTimeout(() => {
            $("#" + id + " .card").removeClass("active");
            $("#" + id + " .card").removeClass("non-active");
        }, 1000);
    });

    $("#left").on("click", TopScrollTo());

});


// var TopscrollTo = function () {
//     if(window.scrollX!=0) {
//       setTimeout(function() {
//         window.scrollTo(0,window.scrollX-30);
//         TopscrollTo();
//       }, 5);
//     }
//   }

    </script>
</body>

</html>
