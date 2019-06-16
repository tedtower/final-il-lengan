<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editOrderModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="padding:0px;">
            <!-- Modal Body -->
            <div class="modal-body delius">
                <button type="button" class="close float-right" onclick="$('#editModal').modal('hide');" aria-label="Close">
                    <span aria-hidden="true" class="rp-title">&times;</span>
                </button>
                <h3 class="text-center gab mt-2" id="edit_name"></h3>
                <div class="md-form input-group mb-3">
                    <div class="d-flex flex-row align-items-center">
                        <span id="edit_row" hidden></span>
                        <span class="pr-2">Quantity:</span>
                        <div class="input-group-prepend">
                            <button class="btn btn-md btn-light m-0 px-3 py-2 z-depth-0" type="button" id="qty-minus">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                            <input type="number" class="form-control text-center font-weight-bold" name="edit_qty" id="quantity" min="1" value="1" disabled>
                            <button class="btn btn-md btn-light m-0 px-3 py-2 z-depth-0" type="button" id="qty-plus">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!--PREFERENCE-->
                <div id="edit_preferencable" class="input-group w-auto mb-3 d-flex align-items-center"></div>
                <!--ADDONS BUTTON-->
                <div id="edaddbutt"><button class="btn btn-md btn-outline-mdb-color m-0 px-3 py-2 mb-2 z-depth-0" id="addOnButt" type="button">Add Addons</button></div>
                <!--ADDONS-->
                <div id="edit_addonable" class="mb-2"></div>
                <!--REMARKS-->
                <div class="d-flex flex-row">
                    <span class="px-1 label-indent">Notes: </span>
                    <textarea class="form-control" id="edit_remarks" rows="2"></textarea>
                </div>
            </div>
            <div class="mb-2 py-1 justify-content-center text-center">
                <button type="button" class="btn btn-mdb-color" id="edit_orderlist">Save</button>
            </div>
            </div>
        </div>
    </div>
