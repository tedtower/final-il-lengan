<!-- Remove Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrderModal" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content" style="padding:0px;">
            <!-- Modal Body -->
            <div class="modal-body text-center py-2">
                <i class="fas fa-times fa-4x animated rotateIn text-danger"></i>
                <input hidden id="remID">
                <p class="delius">Are you sure you want to remove <span class="text-danger" id="remName"></span> from your orderlist?</p>
            </div>
            <div class="modal-footer justify-content-center py-1">
                <button type="button" class="btn btn-outline-danger" id="croButton">Close</button>
                <button type="button" class="btn btn-danger" id="removo">Remove</button>
            </div>
            </div>
        </div>
    </div>