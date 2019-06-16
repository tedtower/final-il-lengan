<!-- Order Modal -->
<div class="modal fade" id="order_modal" tabindex="-1" role="dialog" aria-labelledby="orderListModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <button type="button" class="close d-flex justify-content-end" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="rp-title">&times;</span>
                </button>
	            <form method="post" id="orderedForm">
                    <?php 
                    $cust_name = $this->session->userdata('cust_name');
                    $table_no = $this->session->userdata('table_no');
                    $orders = $this->session->userdata('orders');
                    $date = date('F d, Y');
                    $now = date('Y-m-d');
                    echo form_hidden('date', $now);
                    
                    echo form_hidden('table_no', $table_no);
                    echo '<input type="hidden" id="table_no" value="'.$table_no['table_code'].'">';
                    echo form_hidden('cust_name', $cust_name);
                    echo '<input type="hidden" id="cust_name" value="'.$cust_name.'">';
                    if(empty($cust_name)){
                        echo '<div class="mb-3"><strong>Table Code: </strong>'.$table_no['table_code'].'<br><b>Date:&nbsp;</b>'.$date.'<br></div>';
                    }else{
                        echo '<div class="mb-3"><strong>Customer Name:</strong>'.$cust_name.'<br><strong>Table Code: </strong>'.$table_no['table_code'].'<br><b>Date:&nbsp;</b>'.$date.'<br></div>';
                    }
                    if(empty($orders)) {
                        echo '<h5>You have no saved orders. To order menu items click on <span style="color:#b96e43">"Save to Orderlist"</span> button.</h5>';
                    }else{ ?>
                    <div class="text-center" id="ol_main"></div>
                    <div id="order_footer"></div>
                
		    <?php include 'orderslip.php'; 
		     }; ?>
		    </form>
		    </div>
		
            </div>
        </div>
    </div>
    <?php include 'edit.php'; ?>    
    <?php include 'remove.php'; ?>
    <?php include 'remove_all.php'; ?>
    <?php include 'ordered_modal.php'?>
