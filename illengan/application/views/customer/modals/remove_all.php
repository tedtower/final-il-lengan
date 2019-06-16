<!-- Remove Modal -->
<div class="modal fade" id="deleteAllModal" tabindex="-1" role="dialog" aria-labelledby="deleteAllOrderModal" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content" style="padding:0px;">
            <!-- Modal Body -->
            <div class="modal-body text-center py-1">
                <i class="fas fa-times fa-4x animated rotateIn text-danger"></i>
                <p class="delius">Are you sure you want to remove all orders from your orderlist?</p>
            </div>
            <div class="modal-footer justify-content-center py-1">
                <button type="button" class="btn btn-outline-danger" id="craoButton">Close</button>
                <a href="<?= site_url('customer/clearOrder');?>"><button type="button" class="btn btn-danger">Remove</button></a>
            </div>
            </div>
        </div>
    </div>