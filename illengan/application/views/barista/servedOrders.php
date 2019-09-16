<!DOCTYPE html>
<htmL>

<head>
    <?php include_once('templates/head.php') ?>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/barista/cards.css' ?>" type="text/css">
</head>

<body style="background:#c7ccd1;">
    <?php include_once('templates/navigation.php') ?>
    <!--End Top Nav-->
    <div class="container-fluid">
        <section class="lists-container">
            <!-- Lists container -->
    
    </section>
</div>
    <!-- End of lists container -->
    <!--End Cards-->
                <!--START "Remove Slip" MODAL-->
            
<?php include_once('templates/scripts.php')?>
<style>
    .table-container {
    display: flex;
    flex-direction:row;
    }

    .table-column {
    flex: 1 1 0px;
    }
</style>
<script>
      var slips = [];
      var lists = [];
      var addons = [];
      $(function() {
        $.ajax({
            url: '<?= base_url("barista/getServed") ?>',
            dataType: 'json',
            success: function(data) {
                $.each(data.slips, function(index, item) {
                    slips.push({
                        "slips": item
                    });
                    slips[index].lists = data.lists.filter(ol => ol.osID == item.osID);
                });
                lists = data.lists;
                addons = data.addons;
                orderaddons = data.orderaddons;
                setPenOrdersData(lists,orderaddons);
                console.log('Success');
                console.log(lists, addons);
            },
            error: function(response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });
      });
    var olID;
      function setPenOrdersData(olist,oad) {
              slips.forEach(function(item) {
                    var header = `
            <!--Long Order Card-->
            <div class="list" id="${item.slips.osID}">
                <div class="card m-0 p-0" style="max-height:100%">
                    <!--Long Card Header-->
                    <div class="card-header p-1 m-1">
                        <div style="overflow:auto;font-size:14px">
                            <div class="row" style="float:left;text-align:left;width:100%">
                                <div class="table-column"><b>Slip No: </b> ${item.slips.osID}</div>
                                <div class="table-column"><b>Customer: </b>${item.slips.custName}</div>
                                <div class="table-column"><b> Table No: </b>${item.slips.tableCode}</div>
                            </div>

                        </div>
                    </div>
                    
                    <!--Long Card Body-->
                    <div class="card-body p-0 m-0" style="overflow:auto">
                        <table class="table p-0 m-0" id="pendingordersTable" style="width:100%; height: auto;border:0">
                            <thead style="background:white">
                                <tr class="border-bottom">
                                    <th class="p-2">Qty</th>
                                    <th class="p-2" width="70%">Order</th>
                                    <th class="p-2" width="20%">Status</th>
                                    <th style="width:2%"></th>
                                    <th></th>
                                </tr>
                            </thead>`;
                    var ol = olist.filter(function(ot){
                        return ot.osID == item.slips.osID;
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
                                <tr class="p-2" colspan="4">`;
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
              <div class="modal-dialog modal-lg" role="document">
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
              $("input#item_status").on('click', function () {
                var id = $(this).attr('data-id');
                var stats = $(this).val();
                if( stats == 'served'){
                stats = 'pending';
                this.style.backgroundColor = "orange";
                this.value= "pending";
                stats = this.value;
                console.log(stats, id);
                updateStatus(stats, id);
                }else if (stats == 'pending'){
                stats='served';
                this.style.backgroundColor = "green";
                this.value= "served";
                stats = this.value;
                console.log(stats, id);
                updateStatus(stats, id);
                }
            });

            var btn;
            $("button.deleteOS").on("click", function() {
                 btn = $(this);
            });
            $("button#remSlip").on("click", function(){
            $(btn).closest("div.list").remove();
            });

            $("img.cancelBtn").on("click", function() {
                var cancelID = $(this).attr('data-id');
                var chckStats = $(this).attr('data-status');
                if(chckStats == 'served'){
                    alert('Can not cancel!Already Served');
                }else{
                    cancelOrder(cancelID);
                }
            });

        }
       
        function cancelOrder(cancelID){
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
            $('button#cancel').on('click', function(){
                var getId = $(this).attr('data-id');
                $.ajax({
                    url: "<?= site_url('barista/deleteOrderItem') ?>",
                    method: "post",
                    data : { 
                        'id' : getId
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

        function updateStatus(stats, id){
            console.log(stats, id);
            $.ajax({
                url: "<?= site_url('barista/updateStatus') ?>",
                method: "post",
                data : { 
                    'status' : stats,
                    'id' : id
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

$(document).ready(function(){
            $(function() {  
                $("body").niceScroll();
            });
        });
    
    </script>
</body>
</htmL>
