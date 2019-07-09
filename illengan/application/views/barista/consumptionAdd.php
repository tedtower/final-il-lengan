<body style="background: white">
    <div class="content">
        <div class="container-fluid">
            <br>
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
                                <h6 style="font-size:15px;">Add Consumption</h6>
                            </div>
                            <form id="conForm" action="<?= site_url("barista/consumption/add")?>" accept-charset="utf-8"
                                class="form">
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:125px;background:#8c8c8c;color:white;font-size:14px;font-weight:600">
                                                Date Consumed</span>
                                        </div>
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary"
                                                style="width:125px;background:#8c8c8c;color:white;font-size:14px;font-weight:600">
                                                Remarks</span>
                                        </div>
                                        <textarea type="text" name="remarks"
                                            class="form-control form-control-sm  border-left-0" rows="1"></textarea>
                                    </div>
                                    <div class="ic-level-3">
                                        <table class="table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc">
                                                <tr>
                                                    <th>Stock Item</th>
                                                    <th width="17%">Quantity</th>
                                                    <th width="33%">Log Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="margin-left:0" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success btn-sm"
                                            type="submit">Insert</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card" id="stockCard" style="float:left;width:37%;margin-left:3%">
                            <div class="card-header" style="overflow:auto">
                                <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Select
                                    Stock Items</div>
                                <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                    <input type="search"
                                        style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                        name="search" placeholder="Search...">
                                </div>
                            </div>
                            <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                <!--checkboxes-->
                                <?php if(!empty($stocks)){
                            ?>
                                <table class="table table-borderless">
                                    <thead style="border-bottom:2px solid #cccccc">
                                        <tr>
                                            <th width="2%"></th>
                                            <th>Stock Item</th>
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ic-level-2"><?php
                                foreach($stocks as $stock){
                                ?>
                                        <tr class="ic-level-1">
                                            <td><input type="checkbox" class="mr-2" name="stock"
                                                   data-name="<?= $stock['stName']?>" value="<?= $stock['stID']?>"></td>
                                            <td class="stock"><?= $stock['stName']?></td>
                                            <td class="category"><?= $stock['ctName']?></td>
                                        </tr>
                                        <?php 
                                }?>
                                    </tbody>
                                </table>
                                <?php
                            }else{
                            ?>
                                <p>No stock items recorded!</p>
                                <?php
                            }?>
                            </div>
                        </div>
                    </div>

                    <!--End of container divs-->
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
            console.log(id, name, $(this).is(":checked"));
            if($(this).is(":checked")){
                $("#conForm .ic-level-2").append(`
                    <tr class="ic-level-1" data-stock="${id}">
                        <td style="padding:1% !important"><input type="text"
                                class="form-control" data-id="${id}" value="${name}" name="stock" readonly></td>
                        <td style="padding:1% !important"><input type="number"
                                class="form-control" name="qty" min="0" required></td>
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
            var remarks = $(this).find("textarea[name='remarks']").val();
            var items = [];
            $(this).find(".ic-level-1").each(function(index){
                items.push({
                    stock: $(this).find("input[name='stock']").attr('data-id'),
                    qty: $(this).find("input[name='qty']").val(),
                    remarks: $(this).find("textarea[name='cRemarks']").val()
                });
            });
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    date: date,
                    remarks: remarks,
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
                error: function(response, setting, error) {
                    console.log(error);
                    console.log(response.responseText);
                }
            });
        });
    });

    $('#conForm').submit(function(event){
        var consumedDate = $("#date").val();
        var currentDate = new Date();
        if(Date.parse(consumedDate) > Date.parse(currentDate)){
            alert('Invalid! Date exceeds current date.');
            return false;
        }
    });
    </script>
</body>

</html>