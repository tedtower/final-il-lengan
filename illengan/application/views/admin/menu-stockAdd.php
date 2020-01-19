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
                    </div>
                    <!--Card Container-->
                    <div style="overflow:auto">
                        <!--Card-->
                        <div class="card" style="float:left;width:60%">
                            <div class="card-header">
                                <h6 style="font-size:15px;margin:0">Add Menu-Stock</h6>
                            </div>
                            <form id="conForm" action="<?= site_url("admin/menustock/add")?>" accept-charset="utf-8"
                                class="form">
                                <div class="card-body">
                                    <div class="ic-level-3">
                                        <table class="table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                <tr>
                                                <th>Menu Name</th>
                                                <th>Stock ID</th>
                                                <th>Qty</th>
                                                <th></th>
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
                                    <a href="<?= site_url()?>admin/menu/menustock" class="btn btn-danger btn-sm"
                                        style="float:right">Cancel</a>
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
                                <?php if(!empty($preferences)){
                            ?>
                                <table class="table table-borderless">
                                    <thead style="border-bottom:2px solid #cccccc">
                                        <tr>
                                            <th width="2%"></th>
                                            <th style="font-weight:500 !important;">Menu Item</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ic-level-2"><?php
                                foreach($preferences as $pref){
                                ?>
                                        <tr class="ic-level-1" >
                                            <td><input type="checkbox" class="mr-2" name="pref" data-name="<?= $pref['prefname']?>" value="<?= $pref['id']?>"></td>
                                            <td class="pref"><?= $pref['prefname']?></td>
                                        </tr>
                                        <?php 
                                }?>
                                    </tbody>
                                </table>
                                <?php
                            }else{
                            ?>
                                <p>No preferences items recorded!</p>
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
                $(this).find("input[name='pref']").trigger("click");
            }
        });
        $("#stockCard input[name='pref']").on("click", function(event) {
            var id = $(this).val();
            var name = $(this).attr("data-name");
            if($(this).is(":checked")){
                $("#conForm .ic-level-2").append(`
                    <tr class="ic-level-1" data-pref="${id}">
                        <td style="padding:1% !important"><input type="text"
                                class="form-control form-control-sm" data-id="${id}" value="${name}" name="pref" readonly></td>
                        <td style="padding:1% !important">
                        <?php foreach($stocks as $s){ ?> 
                        <input list="stocks" type="text" name="stID" id="stID" class="form-control form-control-sm" required/>
                            <datalist id="stocks">
                                <?php echo '<option value="'.$s['stID'].'">'. $s['stName'].'</option>';}?>
                        </datalist>
                        </td>
                        <td style="padding:1% !important"><input type="number" min="1" value="1"
                                class="form-control form-control-sm" name="quantity" id="quantity" required/></td>
                    </tr>`);
            }else{
                $(`#conForm .ic-level-1[data-pref=${id}]`).remove();
            }
        });

        
        $("#stockCard input[name='search']").on("keyup", function() {
            var string = $(this).val().toLowerCase();
            $("#stockCard .ic-level-1").each(function(index) {
            var text = $(this).text().toLowerCase().replace(/(\r\n|\n|\r)/gm, ' ');
                if (!text.includes(string)) {
                    $(this).closest("tr").hide();
                } else {
                    $(this).closest("tr").show();
                }
            });
        });

        $("#conForm").on("submit", function(event){
            event.preventDefault();
            var url = $(this).attr("action");
            var items = [];
            $(this).find(".ic-level-1").each(function(index){
                items.push({
                    prID: $(this).find("input[name='pref']").attr('data-id'),
                    stID: $(this).find("input[name='stID']").val(),
                    qty: $(this).find("input[name='quantity']").val(),
                });
            });
                if($('input[name="pref"]:checked').length == 0) {
                        alert('No checkbox is checked');
                        return false;
                    }
            console.log(items);
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    items: JSON.stringify(items)
                },
                dataType: "JSON",
                succes: function(data){
                    if(data.sessErr){
                        location.replace("/login");
                    }else{
                        console.log(data);
                    }
                },
                complete: function() {
                location.reload();
                },
                error: function(response, setting, error) {
                    console.log(error);
                    console.log(response.responseText);
                }
            });
        });
    });

    $('#conForm').submit(function(event){
        var spoilageDate = $("#tDate").val();
        var currentDate = new Date();
        if(Date.parse(spoilageDate) > Date.parse(currentDate)){
            alert('Invalid! Date exceeds current date.');
            return false;
        }
    });
    		
    </script>
</body>

</html>
