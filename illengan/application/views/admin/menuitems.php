<!--End Side Bar-->
<body style="background:white">
<div class="content">
<div class="container-fluid">
<br>
    <p style="text-align:right; font-weight: regular; font-size: 16px">
        <!-- Real Time Date & Time -->
        <?php echo date("M j, Y -l"); ?>
    </p>
<div class="content" style="margin-left:250px;">
<div class="container-fluid">
<div class="content">
                        <div class="container-fluid">
                            <!--Table-->
                            <div class="card-content">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newMenu"
                                    data-original-title style="margin:0;">Add Menu Item</button>
                                <!--Search
                            <div id ="example_filter" class="dataTables_filter">
                                <label>
                                    "Search:"
                                    <div class="form-group form-group-sm is-empty">
                                       <input type="search" class="form-control" placeholder aria-controls="example">
                                       <span class="material-input"></span> 
                                    </div>
                                </label>
                            </div>-->
                                <br>
                                <br>
            <table id="menuTable" class="table table-bordered dt-responsive nowrap" cellpadding="0" width="100%">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>Menu Item</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

            <!--Start of Modal "Add Menu"-->
            <div class="modal fade bd-example-modal-lg" id="newMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Menu Item</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo base_url()?>admin/menu/add" method="post"
                            accept-charset="utf-8">
                            <div class="modal-body">
                                <!--Menu Name-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Name</span>
                                    </div>
                                    <input type="text" name="mName" class="form-control form-control-sm border border-secondary border-left-0" required>
                                </div>  
                                <!--Description-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Description</span>
                                    </div>
                                    <textarea type="text" name="mDesc" class="form-control form-control-sm"></textarea>
                                </div>                                                                                                                                                       
                                <div class="form-row"> <!--Container of receipt no. and transaction date-->
                                    <!--Receipt no-->
                                    <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Category</span>
                                    </div>
                                    <select class="custom-select" name="ctName" required>
                                        <option value="" selected disabled>Choose</option>
                                        <?php foreach($category as $category){?>
                                            <option value="<?= $category['ctID']?>"><?= $category['ctName']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                    <!--Transaction date-->
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Status</span>
                                    </div>
                                    <select class="custom-select" name="mAvailability" required>
                                        <option value="" selected>Choose</option>
                                        <option value="available">Available</option>
                                        <option value="unavailable">Unvailable</option>
                                    </select>
                                    </div>
                                </div>

                                <!--Menu Items-->
                                <a class="addPreference btn btn-primary btn-sm" style="color:blue;margin:0">Add Preferences</a> <!--Button to add row in the table-->
                                <br><br>
                                <table class="preferencetable table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Temperature</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <!--Menu Items-->
                                <a class="addAddon btn btn-primary btn-sm" style="color:blue;margin:0">Add Addons</a> <!--Button to add row in the table-->
                                <br><br>
                                <table class="addontable table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:96%;text-align:center">Addon Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-success btn-sm"
                                        type="submit">Insert</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <!--Start of Modal "Edit Menu"-->
            <div class="modal fade bd-example-modal-lg" id="editMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Menu Item</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo base_url()?>admin/menu/edit" method="post"
                            accept-charset="utf-8">
                            <div class="modal-body">
                                <input type="text" name="menuID" class="form-control form-control-sm" hidden="hidden">    
                                <!--Menu Name-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Name</span>
                                    </div>
                                    <input type="text" name="mName" class="form-control form-control-sm border border-secondary border-left-0" required>
                                </div>  
                                <!--Description-->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Description</span>
                                    </div>
                                    <textarea type="text" name="mDesc" class="form-control form-control-sm"></textarea>
                                </div>                                                                                                                                                       
                                <div class="form-row"> <!--Container of receipt no. and transaction date-->
                                    <!--Receipt no-->
                                    <div class="input-group mb-3 col">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Category</span>
                                    </div>
                                    <select class="custom-select" name="ctName" id="ctName" required>
                                        <option value="" selected disabled>Choose</option>
                                    </select>
                                </div>
                                    <!--Transaction date-->
                                    <div class="input-group mb-3 col">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">
                                        Status</span>
                                    </div>
                                    <select class="custom-select" name="mAvailability" required>
                                        <option value="" selected>Choose</option>
                                        <option value="available">Available</option>
                                        <option value="unavailable">Unvailable</option>
                                        <option value="archived">Archived</option>
                                    </select>
                                    </div>
                                </div>

                                <!--Menu Items-->
                                <a class="addPreference btn btn-primary btn-sm" style="color:blue;margin:0">Add Preferences</a> <!--Button to add row in the table-->
                                <br><br>
                                <table class="preferencetable table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Temperature</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <!--Menu Items-->
                                <a class="addAddon btn btn-primary btn-sm" style="color:blue;margin:0">Add Addons</a> <!--Button to add row in the table-->
                                <br><br>
                                <table class="addontable table table-sm table-borderless"> <!--Table containing the different input fields in adding trans items -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width:96%;text-align:center">Addon Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-success btn-sm"
                                        type="submit">Insert</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <!--Start of Modal "Add Image"-->
            <div class="modal fade bd-example-modal-lg" id="addImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Menu Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo base_url()?>admin/menu/image/add" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                            <div class="modal-body">
                                <h6 id="menuItemName"></h6>
                                <input name="menuId" hidden="hidden">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width:105px;background:rgb(242, 242, 242);color:rgba(48, 46, 46, 0.9);font-size:14px;">Image</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="mImage" id="mImage">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div> 
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-success btn-sm" type="submit">Insert</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
<!--End of Modal "Add Image"-->
        <!--Start of Delete Modal-->
        <div class="modal fade" id="deleteMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Addon</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="confirmDelete">
                            <div class="modal-body">
                                <h6 id="deleteMenuItem"></h6>
                                <p>Are you sure you want to delete this menu?</p>
                                <input type="text" name="menuID" hidden="hidden">
                                <!-- <div>
                                    Remarks:<input type="text" name="deleteRemarks" id="deleteRemarks" class="form-control form-control-sm">
                                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!--End of Delete Modal-->

</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include_once('templates/scripts.php') ?>
<script>
var menu = [];
var menuedit =[];
var addons = <?= json_encode($addons)?>;
var categories = [];
console.log(categories);

$(document).ready(function() {
    $(function(){
        $.ajax({
            url: '<?= base_url("admin/menu/getDetails")?>',
            dataType: 'json',
            success: function(data){
                var prefLastIndex = 0;
                var aoLastIndex = 0;
                $.each(data.menu, function(index, item){
                    menu.push({"menu" : item});
                    menu[index].preferences = data.preferences.filter(pref => pref.mID == item.mID);
                    menu[index].addons = data.addons.filter(ao => ao.mID == item.mID);
                });
                showTable();
                menuedit = data;
                categories = data.categories;

            },
            error: function(response,setting, errorThrown){
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

    });

    $("#addBtn").on('click', function() {
        $("#newMenu form")[0].reset();
    });
    $(".addPreference").on('click',function(){
        var row=`
        <tr data-id="">
            <td><input type="text" name="prName[]" class="form-control form-control-sm"></td>
            <td>
                <select class="form-control" name="mTemp[]">
                    <option value="" selected>Choose</option>
                    <option value="c">Cold</option>
                    <option value="h">Hot</option>
                    <option value="hc">Hot and Cold</option>
                </select>
            </td>
            <td><input type="number" name="prPrice[]" class="form-control form-control-sm"></td>
            <td>
                <select class="form-control" name="prStatus[]">
                    <option value="" selected disabled>Choose</option>
                    <option value="available">Available</option>
                    <option value="unavailable">Unvailable</option>
                </select>
            </td>
            <td><img class="exitBtn1" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
        </tr>
        `;
        $(this).closest(".modal").find(".preferencetable > tbody").append(row);
        $(this).closest(".modal").find(".exitBtn1").last().on('click',function(){
            $(this).closest("tr").remove();
        });
    });
    $(".addAddon").on('click',function(){
        var row=`
        <tr>
            <td>
                <select class="form-control" name="aoID[]">
                ${addons.map(addon => {
                        return `
                        <option value="${addon.aoID}">${addon.aoName}</option>`
                    }).join('')}
                </select>
            </td>
            <td><img class="exitBtn2" src="/assets/media/admin/error.png" style="width:20px;height:20px;right:0"></td>
        </tr>
        `;
        $(this).closest(".modal").find(".addontable > tbody").append(row);
        $(this).closest(".modal").find(".exitBtn2").last().on('click',function(){
            $(this).closest("tr").remove();
        });
    });

    $("#newMenu form").on('submit', function(event) {
        event.preventDefault();
        var name = $(this).find("input[name='mName']").val();
        var description = $(this).find("textarea[name='mDesc']").val();
        var category = $(this).find("select[name='ctName']").val();
        var status = $(this).find("select[name='mAvailability']").val();
        var preferences = [];
        for (var index = 0; index < $(this).find(".preferencetable > tbody").children().length; index++) {
            preferences.push({
                prName: $(this).find("input[name='prName[]']").eq(index).val(),
                mTemp: $(this).find("select[name='mTemp[]']").eq(index).val(),
                prPrice: parseFloat($(this).find("input[name='prPrice[]']").eq(index).val()),
                prStatus: $(this).find("select[name='prStatus[]']").eq(index).val()
            });
        }
        var addons = [];
        for (var index = 0; index < $(this).find(".addontable > tbody").children().length; index++) {
            addons.push({
                aoID: $(this).find("select[name='aoID[]']").eq(index).val()
            });
        }
        $.ajax({
            url: "<?= base_url("admin/menu/add")?>",
            method: "post",
            data: {
                valueNull : undefined,
                name: name,
                description: description,
                category:category,
                status:status,
                preferences: JSON.stringify(preferences),
                addons: JSON.stringify(addons)
               
            },
            dataType: "json",
            beforeSend: function() {
                console.log(name,description,category,status,preferences,addons);
            },
            success: function(data) {
                if(data.success == true){
                    window.location = "<?php echo base_url();?>/admin/menu";
                }
            },
            error: function(response, setting, error) {
                console.log(error);
            },
            complete: function() {
                $("#newMenu").modal("hide");
            }
        });
    });

    $("#editMenu form").on('submit', function(event) {
        event.preventDefault();
        var id = $(this).find("input[name='menuID']").val();
        var name = $(this).find("input[name='mName']").val();
        var description = $(this).find("textarea[name='mDesc']").val();
        var category = $(this).find("select[name='ctName']").val();
        var status = $(this).find("select[name='mAvailability']").val();
        var preferences = [];
        for (var index = 0; index < $(this).find(".preferencetable > tbody").children().length; index++) {
            var row = $(this).find(".preferencetable > tbody > tr").eq(index);
            console.log(row);
            preferences.push({
                prID : isNaN(parseInt(row.attr('data-id'))) ?  (null) : parseInt(row.attr('data-id')),
                prName: row.find("input[name='prName[]']").val(),
                mTemp: row.find("select[name='mTemp[]']").val(),
                prPrice: parseFloat(row.find("input[name='prPrice[]']").val()),
                prStatus: row.find("select[name='prStatus[]']").val(),
                del: isNaN(parseInt(row.attr('data-delete'))) ?  (null) : parseInt(row.attr('data-delete'))
            });
        }
        var addons = [];
        for (var index = 0; index < $(this).find(".addontable > tbody").children().length; index++) {
            var row = $(this).find(".addontable > tbody > tr").eq(index);
            console.log(row);
            addons.push({
                oldaoID: parseInt(row.find("input[name='oldaoID']").val()) || 0,
                aoID: parseInt(row.find("select[name='aoID[]']").val()),
                del: isNaN(parseInt(row.attr('data-delete'))) ?  (null) : parseInt(row.attr('data-delete'))
            });
        }
        console.log(id, name, description, category, status, preferences, addons);
        $.ajax({
            url: "<?= site_url("admin/menu/edit")?>",
            method: "post",
            data: {
                id : id,
                name: name,
                description: description,
                category: category,
                status: status,
                preferences: JSON.stringify(preferences),
                addons: JSON.stringify(addons)
            },
            dataType: "json",
            beforeSend: function() {
                console.log(id, name, description, category, status, preferences, addons);
            },
            success: function() {
            },
            error: function(response, setting, error) {
                console.log(error);
                console.log(response.responseText);
            },
            complete: function() {
                $("#editMenu").modal("hide");
            }
        });
    });

});
    function showTable(){
        menu.forEach(function(item){
            var tableRow = `               
                <tr class="table_row" data-menuId="${item.menu.mID}">   <!-- table row ng table -->
                    <td><a href="javascript:void(0)" class="ml-2 mr-4"><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>${item.menu.mName}</td>
                    <td>${item.menu.ctName}</td>
                    <td class="text-center">${item.menu.mAvailability}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal" data-target="#editMenu" data-id="${item.menu.mID}">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#deleteMenu" id="${item.menu.mID}" data-name="${item.menu.mName}">Archive</button>
                    </td>
                </tr>
            `;
            var preferencesDiv = `
            <div class="preferences" style="width:45%;overflow:auto;float:left;margin-right:3%" > <!-- Preferences table container-->
                <span><b>Preferences:</b></span><br> <!-- label-->
                ${item.preferences.length === 0 ? "No prefernces are set for this menu item" : 
                `
                <table class="table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Size Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.preferences.map(pref => {
                        return `
                        <tr>
                            <td>${pref.prName.toLowerCase() === 'normal' || pref.prName == '' ? `${pref.mTemp == null || pref.mTemp == '' ? "Regular" : pref.mTemp === 'h' ? "Hot" : pref.mTemp === 'c' ? "Cold" : "Hot and Cold" }` : `${pref.prName+ " "+ `${pref.mTemp == null ? "" : pref.mTemp}`}`}</td>
                            <td>&#8369; ${pref.prPrice}</td>
                            <td>${pref.prStatus}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;
            var accordion = `
            <tr class="accordion" data-id="${item.menu.mID}" data-name="${item.menu.mName}" style="display:none;background: #f9f9f9">
                <td colspan="5"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none;"> <!-- container ng accordion -->
                        <div style="width:278px;overflow:auto;float:left;margin-right:3%;background:#bcbcbc"> <!-- image container -->
                            <img src="<?= site_url('uploads/');?>${item.menu.mImage == null ? 'no_image.jpg' : item.menu.mImage}" alt="Missing Image" style="width:278px;height:178px;border-bottom:2px solid white">
                            <div style="margin:auto;width:90%">
                                <div style="margin:4% 0;font-size:14px;">
                                    <a class="addMenuImage" href="javascript:void(0)" data-toggle="modal" data-target="#addImage" style="overflow:auto;margin:0 30%"><img src="/assets/media/admin/add image.png" style="height:20px;width:20px;"/> Add Image</a>
                                </div>
                            </div>
                        </div>
                        
                        <div style="width:68%;overflow:auto"> <!-- description, preferences, and addons container -->
                            <div><b>Description:</b> <!-- label-->
                                <p>${item.menu.mDesc == null ? "Description is not available." : item.menu.mDesc}
                                </p>
                            </div> 
                            <div class="aoAndPreferences" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;
            var addonsDiv = `
            <div class="addons" style="width:45%;overflow:auto" > <!-- Addons table container--><span><b>Addons:</b></span><br>
                ${item.addons.length === 0 ? "No addons are set for this menu item." : 
                    `<!-- label-->
                    <table class="table table-bordered"> <!-- Addons table-->
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Addons Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        ${item.addons.map(addon => {
                            return `<tr><td>${addon.aoName}</td>
                            <td>&#8369; ${addon.aoPrice}</td>
                            <td>${addon.aoStatus}</td></tr>`;
                            }).join('')}
                        </tbody>
                    </table>`
                }
            </div>`;
            $("#menuTable > tbody").append(tableRow);
            $("#menuTable > tbody").append(accordion);
            $(".aoAndPreferences").last().append(preferencesDiv);
            $(".aoAndPreferences").last().append(addonsDiv);

        });
        $(".accordionBtn").on('click', function(){
            if($(this).closest("tr").next(".accordion").css("display") == 'none'){
                $(this).closest("tr").next(".accordion").css("display","table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            }else{
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });

        $(".editBtn").on("click",function(){
                $("#editMenu form")[0].reset();
                $("#editMenu .preferencetable > tbody").empty();
                $("#editMenu .addontable > tbody").empty();
                var menuID = $(this).closest("tr").attr("data-menuId");
                $('#ctName').empty();
                $("#ctName").append(`${categories.map(category => {
                    return `<option value="${category.ctID}">${category.ctName}</option>`;
                }).join('')}`);
                setEditModal($("#editMenu"), menuedit.menu.filter(menu => menu.mID === menuID)[0], menuedit.addons.filter(addon => addon.mID === menuID), menuedit.preferences.filter(preference => preference.mID === menuID));
        });

        $('.addMenuImage').on('click', function(){
                $("#menuItemName").text(
                    `Menu Name: ${$(this).closest("tr").attr("data-name")}`);
                $("#addImage").find("input[name='menuId']").val($(this).closest("tr").attr(
                    "data-id"));
        });

        $('.deleteBtn').on('click',function() {
            var id = $(this).attr("id");
            $("#deleteMenuItem").text(`Menu Name:  ${$(this).attr("data-name")}`);
            // $("#deleteAddon").find("input[name='addonID']").val($(this).attr("data-id"));
            $("#confirmDelete").on('submit', function(event) {
                event.preventDefault();
                window.location = "<?php echo base_url();?>/admin/menu/delete/" + id;
            });
        });

    } 

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    
    function setEditModal(modal, menu, addon, preference) {
        modal.find("input[name='menuID']").val(menu.mID);
        modal.find("input[name='mName']").val(menu.mName);
        modal.find("textarea[name='mDesc']").val(menu.mDesc);
        modal.find("select[name='ctName']").find(`option[value='${menu.ctID}']`).attr("selected", "selected");
        modal.find("select[name='mAvailability']").find(`option[value='${menu.mAvailability}']`).attr("selected", "selected");
        console.log(menu);
        preference.forEach(preference => {
            modal.find(".preferencetable > tbody").append(`
            <tr class="menuElem" data-id="${preference.prID}">
                <td><input type="text" name="prName[]" value="${preference.prName}" class="form-control form-control-sm"></td>
                <td>
                    <select class="form-control" name="mTemp[]" value="${preference.mTemp}">
                        <option value="" selected>Choose</option>
                        <option value="c">Cold</option>
                        <option value="h">Hot</option>
                        <option value="hc">Hot and Cold</option>
                    </select>
                </td>
                <td><input type="number" name="prPrice[]" class="form-control form-control-sm" value="${preference.prPrice}"></td>
                <td>
                    <select class="form-control" name="prStatus[]" value="${preference.prStatus}">
                        <option value="" selected disabled>Choose</option>
                        <option value="available">Available</option>
                        <option value="unavailable">Unvailable</option>
                        <option value="deleted">Deleted</option>
                    </select>
                </td>
                <td><img class="exitBtn1 delBtn" onclick="deleteItem(this)" src="/assets/media/admin/error.png" style="width:20px;height:20px"></td>
            </tr>
        `);
        modal.find("select[name='prStatus[]']").last().find(`option[value='${preference.prStatus}']`).attr("selected", "selected");
        modal.find("select[name='mTemp[]']").last().find(`option[value='${preference.mTemp}']`).attr("selected", "selected");

        });

        addon.forEach(addon => {
            modal.find(".addontable > tbody").append(`
                <tr>
                    <td>
                        <input type="hidden" name="oldaoID" value="${addon.aoID}">
                        <select class="form-control" name="aoID[]">
                        ${addons.map(addon => {
                                return `
                                <option value="${addon.aoID}">${addon.aoName}</option>`;
                            }).join('')}
                        </select>
                    </td>
                    <td><img class="exitBtn2 delBtn" onclick="deleteItem(this)" src="/assets/media/admin/error.png" style="width:20px;height:20px;right:0"></td>
                </tr>
            `);
            modal.find("select[name='aoID[]']").last().find(`option[value='${addon.aoID}']`).attr("selected", "selected");
        })
    }

    function deleteItem(element) {
        var el = $(element).closest("tr");
        $(el).attr("data-delete", "0");
        $(el).addClass("deleted");

        $(".deleted").find("input").attr("disabled", "disabled");
        $(".deleted").find("input").removeAttr("class");
        $(".deleted").find("input").addClass("form-control form-control-sm");

        var deleted = $(".deleted");
        for(var i = 0; i <= deleted.length - 1; i++) {
            deleted[i].style.textDecoration = "line-through";
            deleted[i].style.opacity = "0.6";
        }
    }
</script>
</body>