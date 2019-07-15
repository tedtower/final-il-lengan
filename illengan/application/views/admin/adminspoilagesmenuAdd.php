<body style="background: white">
    <div class="content">
        <div class="container-fluid">
            <br>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <!--Date and Time-->
                    <div style="overflow:auto">
                        <p style="text-align:right; font-weight: regular; font-size: 16px;float:right">
                            <?php echo date("M j, Y -l"); ?> </p>
                        <a  class="btn btn-primary btn-sm" href="<?= site_url('admin/menu/spoilages')?>" data-original-title style="margin:0;width:20%"
                                            id="addBtn">View Spoiled Menu</a>
                    </div>
                    <!--Card Container-->
                    <div style="overflow:auto">
                        <!--Card-->
                        <div class="card" style="float:left;width:60%">
                            <div class="card-header">
                                <h6 style="font-size:15px;margin:0">Add Spoilage</h6>
                            </div>
                            <form id="conForm" action="<?= site_url("admin/menuspoilage/add")?>" accept-charset="utf-8"
                                class="form">
                                <div class="card-body">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:125px;font-size:14px;">
                                                Date Spoiled</span>
                                        </div>
                                        <input class="form-control form-control-sm" name="date" id="date" type="date" class="no-border"  data-validate="required" message="Date consumed is required!"  required>
                                    </div>
                                
                                    <div class="ic-level-3">
                                        <table class="table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                <tr>
                                                    <th style="font-weight:500 !important;">Stock Item</th>
                                                    <th width="17%" style="font-weight:500 !important;">Quantity</th>
                                                    <th width="17%" style="font-weight:500 !important;">Orderslip</th>
                                                    <th width="33%" style="font-weight:500 !important;">Log Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mb-0" style="overflow:auto">
                                    <button class="btn btn-success btn-sm" type="submit"
                                        style="float:right">Insert</button>
                                    <a  class="btn btn-danger btn-sm" href="<?= site_url('admin/menu/spoilages')?>" style="float:right">Cancel</a>
                                    <!-- <button type="button" class="btn btn-danger btn-sm"
                                        style="float:right">Cancel</button> -->
                                </div>
                            </form>
                        </div>

                        <div class="card" id="stockCard" style="float:left;width:37%;margin-left:3%">
                            <div class="card-header" style="overflow:auto">
                                <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Select
                                        Menu Items</div>
                                <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                    <input type="search"
                                        style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                        name="search" placeholder="Search...">
                                </div>
                            </div>
                            <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                <!--checkboxes-->
                                <?php if(!empty($menu)){
                            ?>
                                <table class="table table-borderless">
                                    <thead style="border-bottom:2px solid #cccccc">
                                        <tr>
                                            <th width="2%"></th>
                                            <th>Menu Item</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ic-level-2"><?php
                                foreach($menu as $m){
                                ?>
                                        <tr class="ic-level-1">
                                            <td><input type="checkbox" class="mr-2" name="stock"
                                                   data-name="<?= $m['prName']?>" data-stID="<?= $m['stID']?>" data-qty="<?= $m['prstQty']?>"value="<?= $m['prID']?>" required></td>
                                            <td class="stock"><?= $m['prName']?></td>
                                        </tr>
                                        <?php 
                                }?>
                                    </tbody>
                                </table>
                                <?php
                            }else{
                            ?>
                                <p>No menu items recorded!</p>
                                <?php
                            }?>
                            </div>
                        </div>
                    </div>

                    <!--End of container divs-->
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php');?>
    <script>
    $(function() {
        $("#stockCard .ic-level-1").on("click",function(event){
            if(event.target.type !== "checkbox"){
                $(this).find("input[name='stock']").trigger("click");
            }
        });
        $("#stockCard input[name='stock']").on("click", function(event) {
            var id = $(this).val();
            var name = $(this).attr("data-name");
            var stID = $(this).attr("data-stID");
            var qty = $(this).attr("data-qty");
            console.log('prID:',id,stID, name, qty, $(this).is(":checked"));
            if($(this).is(":checked")){
                $("#conForm .ic-level-2").append(`
                    <tr class="ic-level-1" data-stock="${id}">
                        <td style="padding:1% !important"><input type="text"
                                class="form-control" data-id="${id}" data-stID="${stID}" value="${name}" name="stock" readonly required></td>
                        <td style="padding:1% !important"><input type="number" value="1" min="1"
                                class="form-control" name="qty" required/></td>
                        <td style="padding:1% !important">
                            <input list="orderslips" type="number" class="form-control" name="slipNum" >
                            <datalist id="orderslips">
                                <option value="">None</option>
                                <?php foreach($slip as $s){ 
                            echo '<option value="'.$s['osID'].'">'.$s['osID'].'</option>';
                                }?>
                            </datalist>
                        </td>
                        <td style="padding:1% !important"><textarea type="text"
                                class="form-control" name="cRemarks" rows="1"></textarea>
                        </td>
                    </tr>`);
            }else{
                $(`#conForm .ic-level-1[data-stock=${id}]`).remove();
            }
        });
        $("#stockCard input[name='search']").on("keyup",function(){
            var string = $(this).val();
            $("#stockCard .stock").each(function(index){
                if(!$(this).text().includes(string)){
                    $(this).closest(".ic-level-1").hide();
                }else{
                    $(this).closest(".ic-level-1").show();
                }
            });
        });
        $("#conForm").on("submit", function(event){
            event.preventDefault();
            var url = $(this).attr("action");
            var date = $(this).find("input[name='date']").val();
            var menus = [];
            $(this).find(".ic-level-1").each(function(index){
                menus.push({
                    prID: $(this).find("input[name='stock']").attr('data-id'),
                    stID: $(this).find("input[name='stock']").attr('data-stID'),
                    qty: $(this).find("input[name='qty']").val(),
                    slip: $(this).find("input[name='slipNum']").val(),
                    remarks: $(this).find("textarea[name='cRemarks']").val()
                });
            });
                // var checked = $("#conForm input:checked").length > 0;
                // if (!checked){
                //     alert("Please check at least one checkbox!");
                //     return false;
                // }
            console.log(menus);
            console.log(date);
            if(menus != null){
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    date: date,
                    menus: JSON.stringify(menus)
                },
                dataType: "JSON",
                complete: function(data){
                     location.reload();
                     alert('Added');
                },
                error: function(response, setting, error) {
                    console.log(error);
                    console.log(response.responseText);
                }
            });
            }else{
                alert('Add stock Item!');
            }
        });

        $('#conForm').submit(function(event){
        var spoiledDate = $("#date").val();
        var currentDate = new Date();
        if(Date.parse(spoiledDate) > Date.parse(currentDate)){
            alert('Incorrect date input!');
            return false;
        }
    });
    });
    </script>
</body>

</html>
