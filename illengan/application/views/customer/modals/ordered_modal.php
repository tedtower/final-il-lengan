<div class="modal fade" id="ordered_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="text-center">
                    <img class="mt-2" src="<?php echo base_url().'assets/media/logo.png'?>" style="height:130px;width:130px">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-200 delius">Thank you for ordering!</h4>
                    </div>
                <div class="delius modal-body">
                <a href="<?php echo site_url("customer/clearOrder")?>">
                    <button class="btn btn-dark-green">Order again</button></a>
                <br>
                <a class="text-success" href="<?php echo site_url("customer/checkout")?>">New Customer</a>
                <br>
                </div>
            </div>
            </div>
        </div>
    </div>
