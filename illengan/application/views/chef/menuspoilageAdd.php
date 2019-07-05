<body style="background: white">
    <div class="content">
        <div class="container-fluid">
            <br>
                <div class="container-fluid">
                    <!--Date and Time-->
                    <div style="overflow:auto">
                        <p style="text-align:right; font-weight: regular; font-size: 16px;float:right">
                            <?php echo date("M j, Y -l"); ?> </p>
                        <a  class="btn btn-primary btn-sm" href="<?= site_url('chef/spoilages/menu')?>" data-original-title style="margin:0;width:15%"
                                            id="addBtn">View Spoiled Menu</a>
                    </div>
                    <!--Card Container-->
                    <div style="overflow:auto">
                        <!--Card-->
                        <div class="card" style="float:left;width:60%">
                            <div class="card-header">
                                <h6 style="font-size:15px;">Add Menu Spoilage</h6>
                            </div>
                            <form id="conForm" action="<?= site_url("chef/menuspoilage/add")?>" accept-charset="utf-8"
                                class="form">
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:125px;background:#8c8c8c;color:white;font-size:14px;font-weight:600">
                                                Date Spoiled</span>
                                        </div>
                                        <input type="date" class="form-control" name="date" required/>
                                    </div>
                                    <div class="ic-level-3">
                                        <table class="table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc">
                                                <tr>
                                                    <th>Menu Item</th>
                                                    <th width="10%">Quantity</th>
                                                    <th width="15%">Orderslip #</th>
                                                    <th width="20%">Log Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div>
                                        <a href="<?= site_url('chef/spoilages/menu')?>"><button type="button" class="btn btn-danger btn-sm"
                                            style="margin-left:0" data-dismiss="modal">Cancel</button></a>
                                        <button class="btn btn-success btn-sm"
                                            type="submit">Insert</button>
                                    </div>
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
    <?php include_once('scripts.php');?>
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
            console.log('prID:',id, name, qty, $(this).is(":checked"));
            if($(this).is(":checked")){
                $("#conForm .ic-level-2").append(`
                    <tr class="ic-level-1" data-stock="${id}">
                        <td style="padding:1% !important"><input type="text"
                                class="form-control" data-id="${id}" data-stID="${stID}" value="${name}" name="stock" readonly required></td>
                        <td style="padding:1% !important"><input type="number" value="1" min="1"
                                class="form-control" name="qty" required/></td>
                        <td style="padding:1% !important">
                            <select class="form-control" name="slipNum" >
                                <option value="">None</option>
                        <?php foreach($slip as $s){ 
                          echo '<option value="'.$s['osID'].'">'.$s['osID'].'</option>';
                        }?>
                            </select>
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
                    slip: $(this).find("select[name='slipNum']").val(),
                    remarks: $(this).find("textarea[name='cRemarks']").val()
                });
            });
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
    });
    </script>
</body>

</html>