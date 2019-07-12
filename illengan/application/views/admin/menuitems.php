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
                                <!--Search-->
                                    <div id="menuTable" style="width:25%; float:right; border-radius:5px">
                                        <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                    </div>
                                <br><br>
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
            <div style="float:right" id="pagination"></div>
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
                                    <input class="form-control form-control-sm border border-secondary border-left-0" required name="mName" type="textarea" value="" id="example-number-input" required="" pattern="[a-zA-Z][a-zA-Z\s]*" title="Menu should only countain letters and white spaces.">
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
                                    <!--Status-->
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
                                    <input class="form-control form-control-sm border border-secondary border-left-0" required name="mName" type="textarea" value="" id="example-number-input" required pattern="[a-zA-Z][a-zA-Z\s]*" title="Menu should only countain letters and white spaces.">
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
                                        type="submit">Update</button>
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
// var menu = [];
 var menuedit =[];
 var addons = [];
// var categories = [];
// console.log(categories);

$(document).ready(function() {
    createPagination(0);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum);
	});
	function createPagination(pageNum){
		$.ajax({
			url: '<?=base_url()?>admin/loadDataMenu/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $('#pagination').html(data.pagination);
                var menuitems = data.menu;
                var pref = data.preferences;
                var adds = data.addons;
                addons= data.addons;
                var categories = data.categories;
                showTable(menuitems, pref, adds, categories);
                menuedit = data;
			},
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});
	}
        
});

    $("#addBtn").on('click', function() {
        $("#newMenu form")[0].reset();
    });
    $(".addPreference").on('click',function(){
        var row=`
        <tr data-id="">
            <td><input class="form-control form-control-sm" required name="prName[]" type="textarea" value="" id="example-number-input" required="" pattern="[a-zA-Z][a-zA-Z\s]*" title="Preferences should only countain letters and white spaces."></td>
            <td>
                <select class="form-control" name="mTemp[]">
                    <option value="" selected>Choose</option>
                    <option value="c">Cold</option>
                    <option value="h">Hot</option>
                    <option value="hc">Hot and Cold</option>
                </select>
            </td>
            <td><input type="number" name="prPrice[]" class="form-control form-control-sm" required></td>
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
                loction.reload();
            }
        });
    });
    function showTable(menu,pref,addons,category){
        $("#menuTable > tbody").empty();
        for(m in menu){
             var tableRow = ` <tr class="table_row" data-menuId="`+menu[m].mID+`">`;
                tableRow += `<td><a href="javascript:void(0)" class="ml-2 mr-4">
                <img class="accordionBtn" data-id="`+menu[m].mID+`" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>
                `+menu[m].mName+`</td>`;
                tableRow += ` <td>`+menu[m].ctName+`</td>`;
                tableRow += `<td class="text-center">`+menu[m].mAvailability+`</td>`;
                tableRow += `<td>
                        <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal" data-target="#editMenu" data-id="`+menu[m].mID+`">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#deleteMenu" id="`+menu[m].mID+`" data-name="`+menu[m].mName+`">Archive</button>
                    </td>
                </tr>`;

        var names = pref.filter(function (n) {
             return n.mID == menu[m].mID;
        });
             var prefer = `<div class="preferences" style="width:45%;overflow:auto;float:left;margin-right:3%" >`;
                prefer += `<span><b>Preferences:</b></span><br>`;
            if(names == null || names == ''){
                prefer += `No preferences are set for this menu item`;
            }else{
                prefer += `<table class="table table-bordered">`;
                prefer += `<thead class="thead-light">`;
                prefer += `<tr>
                            <th scope="col">Size Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>`;
                for(p in names){
                    prefer += ` <tr>`;
                    prefer += `<td>`;
                    if(names[p].prName === 'Normal' || names[p].mTemp == null || names[p].mTemp == ''){
                        prefer += `<span>Regular</<span>&nbsp;`; 
                    }else if(names[p].mTemp === 'h'){
                        prefer += `Hot`;
                    }else if(names[p].mTemp === 'c'){
                        prefer += `Cold`;
                    }else if(names[p].mTemp === 'hc'){
                        prefer += `Hot and Cold`;
                    }else if(names[p].mTemp === 'h' && names[p].prName == 'Solo'){
                        prefer += `Solo Hot`;
                    }else if(names[p].mTemp === 'c' && names[p].prName == 'Solo'){
                        prefer += `Solo Cold`;
                    }else if(names[p].mTemp === 'h' && names[p].prName == 'Jumbo'){
                        prefer += `Jumbo Hot`;
                    }else if(names[p].mTemp === 'c' && names[p].prName == 'Jumbo'){
                        prefer += `Jumbo Cold`;
                    }
                    prefer += `</td>`;
                    prefer += `<td>`+names[p].prPrice+`</td>`;
                    prefer += `<td>`+names[p].prStatus+`</td>`;
                    }
            }
            prefer += `</tr>`;
            prefer += `</tbody></table></div>`;
        var accordion = `<tr class="accordion" data-id="`+menu[m].mID+`" data-name="`+menu[m].mName+`" style="display:none;background: #f9f9f9">`;
            accordion += `<td colspan="5">`;
            accordion += ` <div style="overflow:auto;display:none;">`;
            accordion += `<div style="width:278px;overflow:auto;float:left;margin-right:3%;background:#bcbcbc">`;
            if(menu[m].mImage == null){
                accordion += `<img src="<?= site_url('uploads/');?>no_image.jpg" alt="Missing Image" style="width:278px;height:178px;border-bottom:2px solid white">`;
            }else{
                accordion += `<img src="<?= site_url('uploads/');?>`+menu[m].mImage+`" alt="Missing Image" style="width:278px;height:178px;border-bottom:2px solid white">`;
            }
            accordion += `<div style="margin:auto;width:90%">`;
            accordion += ` <div style="margin:4% 0;font-size:14px;">`;
            accordion += ` <a class="addMenuImage" href="javascript:void(0)" data-toggle="modal" data-target="#addImage" style="overflow:auto;margin:0 30%"><img src="/assets/media/admin/add image.png" style="height:20px;width:20px;"/> Add Image</a>`;
            accordion +=` </div>
                            </div>
                        </div>`;
            accordion += `<div style="width:68%;overflow:auto">`;
            accordion += `<div><b>Description:</b>`;
            if(menu[m].mDesc == null){
                accordion += `<p>Description is not available.</p>`;
            }else{
                accordion += `<p>`+menu[m].mDesc+`</p>`;
            }
            accordion += ` </div>`;
            accordion += ` <div class="aoAndPreferences" style="overflow:auto;margin-top:1%"></div>`;
            accordion += `</div></div></td></tr> `;
            
    var adds = addons.filter(function (n) {
        return n.mID == menu[m].mID;
    });

        var addonsDiv = ` <div class="addons" style="width:45%;overflow:auto" > `;
        addonsDiv += `<span><b>Addons:</b>`;
                if(adds == '' || adds == null){
                        addonsDiv += `<br>No addons are set for this menu item.`;
                }else{
                        addonsDiv += ` <table class="table table-bordered">`;
                        addonsDiv += ` <thead class="thead-light">`;
                        addonsDiv += ` <tr>`;
                        addonsDiv += ` <th scope="col">Addons Name</th>`;
                        addonsDiv += `<th scope="col">Price</th>`;
                        addonsDiv += `<th scope="col">Status</th>`;
                        addonsDiv += `</tr>`;
                        addonsDiv += ` </thead>`;
                    for(ao in adds){
                        addonsDiv += `<tbody>`;
                        addonsDiv += `<tr><td>`+adds[ao].aoName+`</td>`;
                        addonsDiv += ` <td>`+adds[ao].aoPrice+`</td>`;
                        addonsDiv += ` <td>`+adds[ao].aoStatus+`</td></tr>`;
                    }
                    addonsDiv += `</tbody></table></div>`;
            }
            
             $("#menuTable > tbody").append(tableRow);
            $("#menuTable > tbody").append(accordion);
            $(".aoAndPreferences").last().append(prefer);
            $(".aoAndPreferences").last().append(addonsDiv);
        }
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
                $("#ctName").append(`${category.map(category => {
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
               <td><input class="form-control form-control-sm" required name="prName[]" type="textarea" value="${preference.prName}" id="example-number-input" required="" pattern="[a-zA-Z][a-zA-Z\s]*" title="Preferences should only countain letters and white spaces."></td>
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
//Search Function
            $("#menuTable input[name='search']").on("keyup", function() {
                var string = $(this).val().toLowerCase();

                $("#menuTable .ic-level-1").each(function(index) {
                    var text = $(this).text().toLowerCase().replace(/(\r\n|\n|\r)/gm, ' ');
                    if (!text.includes(string)) {
                        $(this).closest("tr").hide();
                    } else {
                        $(this).closest("tr").show();
                    }
                });

            });
    // function deleteItem(element) {
    //     var el = $(element).closest("tr");
    //     $(el).attr("data-delete", "0");
    //     $(el).addClass("deleted");

    //     $(".deleted").find("input").attr("disabled", "disabled");
    //     $(".deleted").find("input").removeAttr("class");
    //     $(".deleted").find("input").addClass("form-control form-control-sm");

    //     var deleted = $(".deleted");
    //     for(var i = 0; i <= deleted.length - 1; i++) {
    //         deleted[i].style.textDecoration = "line-through";
    //         deleted[i].style.opacity = "0.6";
    //     }
    // }
</script>
</body>
