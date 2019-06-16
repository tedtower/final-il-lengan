<!DOCTYPE html>
<html>

<head>
  <?php include_once('templates/head.php') ?>
</head>

<body style="background: white">
  <div class="content">
    <div class="container-fluid">
      <br>
      <p style="text-align:right; font-weight: regular; font-size: 16px">
        <!-- Real Time Date & Time -->
        <?php echo date("M j, Y -l"); ?>
      </p>
      <div class="content" style="margin-left:250px">

        <!--Table-->
        <div class="container-fluid">
          <div class="card-content">
            <table id="ordersTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead class="thead-dark">
                <tr>
                  <th><b class="pull-left">Order Item No.</b></th>
                  <th><b class="pull-left">Customer Name</b></th>
                  <th><b class="pull-left">Table No</b></th>
                  <th><b class="pull-left">Order</b></th>
                  <th><b class="pull-left">Order Qty</b></th>
                  <th><b class="pull-left">Item Status</b></th>
                  <th><b class="pull-left">Action</b></th>
                </tr>
              </thead>


              <!-- MODAL EDIT
            <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Table Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Order Id</label>
                            <div class="col-md-10">
                              <input type="text" name="order_id_edit" id="order_id_edit" class="form-control" placeholder="Order Id" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">New Table Code</label>
                            <div class="col-md-10">
                              <input type="text" name="table_code_edit" id="table_code_edit" class="form-control" placeholder="New Table Code">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        END MODAL EDIT-->

              <!--MODAL DELETE-->
              <form>
                <div class="modal fade" id="Modal_Remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <strong>Are you sure to remove this record?</strong>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="osID_remove" id="osID_remove" class="form-control">
                        <button type="button" type="submit" id="btn_cancel" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <!--END MODAL DELETE-->


              <script type="text/javascript" src="<?php echo base_url() . 'assets/js/barista/jquery-3.2.1.js' ?>"></script>
              <script type="text/javascript" src="<?php echo base_url() . 'assets/js/barista/bootstrap.js' ?>"></script>
              <script type="text/javascript" src="<?php echo base_url() . 'assets/js/barista/jquery.dataTables.js' ?>"></script>
              <script type="text/javascript" src="<?php echo base_url() . 'assets/js/barista/dataTables.bootstrap4.js' ?>"></script>
              <script type="text/javascript" src="<?php echo base_url() . 'assets/js/barista/tables.js' ?>"></script>
              <script type="text/javascript" src="<?php echo base_url() . 'assets/js/barista/dataTables.responsive.js' ?>"></script>
              <script type="text/javascript" src="<?php echo base_url() . 'assets/js/barista/dataTables.select.js' ?>"></script>
              <script type="text/javascript" src="<?php echo base_url() . 'assets/js/barista/dataTables.buttons.js' ?>"></script>

              <script>
                var table = $('#ordersTable');

                function format(d) {
                  return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<tr>' +
                    '<td>Add Ons</td>' +
                    '<td>Remarks</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>---</td>' +
                    '<td>' + d.olRemarks + '</td>' +
                    '</tr>' +
                    '</table>';

                }

//For showing the accordion
  $('#mydata tbody').on('click', 'td.details-control', function(){
    var tr = $(this).closest('tr');
    var row = table.row(tr);

                  //For showing the accordion
                  $('#ordersTable tbody').on('click', 'td.details-control', function() {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);

                    if (row.child.isShown()) {
                      row.child.hide(); //to hide child row if open
                      tr, removeClass('shown');
                    } else {
                      row.child(format(row.data())).show(); //to open the child row
                      tr.addClass('shown');
                    }
                  });

                  //function for 'Expand all' button
                  $('#btn-show-all-children').on('click', function() {
                    table.rows().every(function() {
                      if (!this.child.isShown()) {
                        this.child(format(this.data())).show();
                        $(this.node()).addClass('shown');
                      }
                    });
                  });

                  $('#btn-hide-all-children').on('click', function() {
                    table.rows().every(function() {
                      if (this.child.isShown()) {
                        this.child.hide();
                        $(this.node()).removeClass('shown');
                      }
                    });
                  });

                });


                //get data for delete record
                $('#show_data').on('click', '.item_delete', function() {
                  var osID = $(this).data('osID');

                  $('#Modal_Remove').modal('show');
                  $('[name="osID_remove"]').val(osID);
                });

                //delete record to database
                $('#btn_cancel').on('click', function() {
                  var osID = $('#osID_remove').val();
                  $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('barista/cancel') ?>",
                    dataType: "JSON",
                    data: {
                      osID: osID
                    },
                    success: function(data) {
                      $('[name="osID_remove"]').val("");
                      alert("Record removed successfully!");
                      $('#Modal_Remove').modal('hide');

                      table.DataTable().ajax.reload(null, false);
                    }
                  });
                  return false;
                });

                function change_status() {
                  $('.orderStatus').on('click', function() {
                    var orderItemId = $(this).data('olID');
                    var itemStatus = $(this).data('olStatus');
                    var item_status;

                    if (itemStatus === "pending") {
                      item_status = "done";
                    } else if (itemStatus === "done") {
                      item_status = "served";
                    } else if (itemStatus === "served") {
                      item_status = "pending";
                    }

                    $.ajax({
                      type: 'POST',
                      url: 'http://www.illengan.com/barista/change_status',
                      data: {
                        olID: orderItemId,
                        olStatus: item_status
                      },
                      success: function() {
                        table.DataTable().ajax.reload(null, false);
                      }
                    });

                  });
                }
              </script>

</body>

</html>