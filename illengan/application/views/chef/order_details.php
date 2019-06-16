<div class="modal fade" id="order_details<?php echo $row->order_id ?>" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="padding:0px;">
      <div class="modal-header">
      <h4>Ordered Menu Items</h4>
</div>
        <!-- Modal Body -->
        <div class="modal-body">
        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Customer Name"
        style="width: 20%;">
        <input type="text" class="form-control" name="table_no" id="table_no" placeholder="Table Number"
        style="width: 20%; right: 0;">
       <br/>
         <?php echo $row->cust_name ?>
        </div>
        <div class="modal-footer">
		      <button type="button" class="btn btn-outline-dark-green" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
