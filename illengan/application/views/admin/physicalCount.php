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
                    <div style="overflow:auto" class="mb-3">
                        <!--Card-->
                        <div class="card" id="stockCard">
                            <div class="card-header">
                                <div style="font-size:15px;font-weight:600;float:left;width:60%;margin-top:4px">Perform Physical Count</div>
                                <div style="width:35%;float:left;margin-left:5%;border-radius:10px">
                                    <input type="search"   
                                        style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px"
                                        name="search" placeholder="Search...">
                                </div>
                            </div>
                            <form id="physicalCount" action="<?= site_url("admin/inventory/beginning")?>" accept-charset="utf-8">
                                <div class="card-body">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                              <span class="input-group-text border border-secondary"
                                                style="width:125px;font-size:14px;">
                                                Date</span>
                                        </div>
                                        <input class="form-control" name="date" id="date" type="date"  data-validate="required" message="Date is required!" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
                                    </div>
                                    <div class="ic-level-3">
                                        <table class="stockitems table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                <tr>
                                                    <th width="35%">Stock Name</th>
                                                    <th>Current</th>
                                                    <th>Physical Count</th>
                                                    <th>Discrepancy</th>
                                                    <th width="28%">Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">
                                                <?php foreach($stocks as $stock){?>
                                                <tr class="ic-level-1">
                                                    <td class="stock" data-stock="<?= $stock['stID']?>"><?= $stock['stName']?></td>
                                                    <td><input type="number" name="current" value="<?= $stock['stQty']?>" class="form-control form-control-sm"  readonly="readonly"></td>
                                                    <td><input type="number" name="actual" value='' class="form-control form-control-sm"></td>
                                                    <td><input type="number" name="discrepancy" value='' class="form-control form-control-sm"  readonly="readonly"></td>
                                                    <td><textarea type="text" name="remarks" value="" class="form-control form-control-sm" rows="1"></textarea></td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mb-0" style="overflow:auto">
                                    <button class="btn btn-success btn-sm" type="submit"
                                        style="float:right">Insert</button>
                                        <a class="btn btn-danger btn-sm" type= "button" href="<?= site_url('admin/inventory')?>" data-original-title  style="float:right">Cancel</a>
                                </div>
                            </form>
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
        $("#physicalCount").find("input[name='actual']").on("change",function(){
            var discrep = $(this).val() - $(this).closest(".stockitems > tbody > tr").find("input[name='current']").val();
            $(this).closest(".stockitems > tbody > tr").find("input[name='discrepancy']").val(discrep);
        });



         //Search Function
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
          
        $("#physicalCount").on("submit", function(event){
            event.preventDefault();
            var url = $(this).attr("action");
            var date = $(this).find("input[name='date']").val();
            var items = [];
            $(this).find(".ic-level-1").each(function(index){
                items.push({
                    stock: $(this).find(".stock").attr('data-stock'),
                    current: $(this).find("input[name='current']").val(),
                    actual: $(this).find("input[name='actual']").val(),
                    discrepancy: $(this).find("input[name='discrepancy']").val(),
                    remarks: $(this).find("textarea[name='remarks']").val(),
                    date: date
                });
            });
            $.ajax({
                method: "POST",
                url: url,
                data: {
                    date: date,
                    items: JSON.stringify(items)
                },
                dataType: "JSON",
                beforeSend: function() {
                    console.log(date, items);
                },
                succes: function(){
                    location.reload();
                },
                error: function(response, setting, error) {
                    console.log(error);
                    console.log(response.responseText);
                }
            });
        });

        $('#physicalCount').submit(function(event){
				var countingDate = $("#date").val();
				var currentDate = new Date();
				if(Date.parse(countingDate) > Date.parse(currentDate)){
					alert('Please check the date input!');
					return false;
				}
    		});
    });
    </script>
</body>

</html>