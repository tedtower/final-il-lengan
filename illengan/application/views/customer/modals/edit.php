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
                <div class="input-group w-auto mb-3 d-flex align-items-center">
                    <label>Preference: &nbsp;</label>
                    <select name="edit_pref" id="edit_pref" class="form-control"></select>
                </div>
                <!--IF ORDERLIST HAS ADDONS OR MENU HAS ADDONS-->
                <button class="btn btn-md btn-outline-mdb-color m-0 px-3 py-2 mb-2 z-depth-0" type="button">Add Addons</button>
                <div class="input-group mb-3 delius d-flex align-items-center">
                    <select class="browser-default custom-select" id="edit_addons" name="edit_addons[]"></select>
                    <input type="number" min="1" placeholder="Quantity..." aria-label="Add-on Quantity" class="form-control" id="edit-qty">
                    <a href="javascript:void(0)" class="text-danger ml-1 px-2" onclick="$(this).parent().remove();"><i class="fal fa-times"></i></a>
                </div>
                <!--REMARKS-->
                <div class="d-flex flex-row">
                    <span class="px-1 mt-1 label-indent">Remarks: </span>
                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer py-1 justify-content-center">
                <button type="button" class="btn btn-mdb-color" href="#proceed_order">Save</button>
            </div>
            </div>
        </div>
    </div>