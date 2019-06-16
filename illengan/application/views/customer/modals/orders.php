 <!-- Order Modal -->
    <div class="modal fade" id="menu_modal" tabindex="-1" role="dialog" aria-labelledby="orderListModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Body -->
                <div class="modal-body">
                    <button type="button" class="close d-flex justify-content-end" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="rp-title">&times;</span>
                    </button>
	<form method="post" action="<?php echo base_url();?>index.php/customer/save_order">
	<?php 
		$cart_check = $this->cart->contents();
		$cust_name = $this->session->userdata('cust_name');
        $table_no = $this->session-> userdata('table_no');
		echo '<strong>Customer Name:</strong>'.$cust_name.'
		<br><strong>Table Number: </strong>'.$table_no.'<br>';
          if(empty($cart_check)) { //check if the customer did not order yet
            echo 'To order menu items click on "Save to Orderlist" Button';
		  }else{
            ?>
                    <div class="text-center">
                        <h1 class="gab">Orderlist</h1>
                        <table class="table table-sm table-hover w-responsive mx-auto delius">
                            <thead>
                                <tr>
                                <th scope="col">Menu Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Actions</th>
                                </tr>
                            </thead>
							<?php 
							$cart = $this->cart->contents();
							 $i=1;
							 $total_qty=0;
							foreach($cart as $item){
								$subtotal= $item['qty']* $item['price'];
								$total= $this->cart->total();
							?>
                            <tbody>
                                <tr>
								<?php 
									echo form_hidden($i.'[rowid]', $item['rowid']); 
									echo form_hidden($item['id']);
								?>
                                <th scope="row"><?php echo $item['name'];?></th>
                                <td><?php echo $item['qty'];?></td>
                                <td><?php echo $subtotal;?></td>
                                <td>
                                    <button type="button" class="btn btn-mdb-color btn-sm m-0 p-2" data-toggle="modal" data-target="#editModal">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm m-0 p-2" data-toggle="modal" data-target="#deleteModal">Remove</button>
                                </td>
                                </tr>
							<?php
								 $total_qty += $item['qty'];
								$i++;
								}
							?>
								<tr>
									<td><h3 class="gab">Total Quantity: <?php echo $total_qty; ?></h3></td>
									<td><h3 class="gab">Total Price: <?php echo $total; ?> php</h3></td>
								</tr>
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="text-center">
                        <input type="submit" data-toggle="modal" class="btn btn-green btn-md delius" data-target="#proceed_modal">Order Now!</input>
					</div>
                </div>
				</form>
				<?php 
				}
			?>
            </div>
        </div>
    </div>
			