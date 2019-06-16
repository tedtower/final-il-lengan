<div class="modal fade" id="menu_modal" tabindex="-1" role="dialog" aria-labelledby="menuItemModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding:0px;">
            <div class="modal-body">
                <?php echo form_open('customer/menu/addOrder', "id='menumodalform'");?>
                <input name="mID" id="mid" value="" hidden>
                <img class="w-100 img-fluid" src="" id="menu_image">
                <div class="d-flex justify-content-between gab rp-title">
                    <p id="menu_name"></p>
                    <p><span class="fs-24">₱</span><span id="menu_price"></span></p>
                </div>
                <p id="menu_description"></p>
                <h4 class="gab">Status: <span id="menu_status"></span></h4>
                <hr>
                <div id="order-details">
                    <h2 class="text-center gab">Order Details</h2>
                    <p id="promo_description"></p>
                    <!--Quantity--> 
                    <div class="md-form input-group mb-3 m-0 p-0 delius">
                        <h4 class="gab m-0"><i class="far fa-sort-numeric-up"></i> Quantity</h4>
                        <div class="d-flex flex-row mr-5 w-100">
                            <div class="input-group-prepend">
                                <button id="qtyDecrement" class="btn btn-md btn-light m-0 py-1 px-3 z-depth-0" type="button">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>
                                <input type="number" class="form-control text-center font-weight-bold px-3"
                                    name="order_quantity" id="quantity" min="1" value="1">
                                <button id="qtyIncrement" class="btn btn-md btn-light m-0 py-1 px-3 z-depth-0" type="button">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                               
                            </div>
                        </div>
                    </div>
                    <!--Preferences-->
                    <div class="input-group mb-3 delius" id="sizeable">
                        <input type="text" id="sizeInput" data-price="" name="menu_size" value="" hidden="hidden">
                        <div class="w-100" id="menu_size">
                            <h4 class="gab m-0"><i class="far fa-user-cog"></i> Preference</h4>
                            <select class="browser-default custom-select" id="sizeSelect" name="menu_size"></select>
                        </div>
                    </div>
                    <!--Freebies-->
                    <?php /*div class="freebiemain">
                    <div class="freebie col-xs-12" id="freebie">
                    <p class="freebieQty"></p>
                    <span class="please"><i>Please choose your freebie</i></span>
                    </div>
                    </div*/ ?>
                    <!--Addons-->
                    <div class="mb-3" id="addonable">
                        <h4 class="gab m-0"><i class="far fa-layer-plus"></i> Add-ons</h4>
                        <div class="add_butt">
                            <button type="button" class="btn btn-outline-accent p-2 ml-0 mb-2" id="addonSelectBtn">Add Add-on</button>
                        </div>
                        <div class="ao_select" id="ao_select_div">
                        </div>
                    </div>
                    <!--Notes-->
                    <div class="form-group green-border-focus">
                        <h4 class="gab m-0"><i class="far fa-comment"></i> Notes</h4>
                        <textarea class="form-control delius" name="notes" id="menu_note" rows="2"></textarea>
                    </div>
                    <!--Total Price-->
                    <h3 class="gab">Total Price: <span id="menuSubtotal"></span> php</h3>
                </div>
                <div class="text-center float-right">
                    <button type="button" class="btn btn-outline-accent px-3" data-dismiss="modal" id="close-menu">Close</button>
                    <button type="submit" class="btn btn-accent px-3" id="submit_ol">Save To Order List</button>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>