<body style="background: white">
    <div class="content">
        <div class="container-fluid">
            <br>
            <div div class="content" style="margin-left:250px;">
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
                                <h6 style="font-size:15px;margin:0">Add Spoilage</h6>
                            </div>
                            <form id="conForm" action="<?= site_url("admin/stock/spoilages/add") ?>" accept-charset="utf-8" class="form">
                                <div class="card-body">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border border-secondary" style="width:125px;font-size:14px;">
                                                Date Spoiled</span>
                                        </div>
                                        <input type="date" id="tDate" class="form-control" name="tDate" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
                                    </div>

                                    <div class="ic-level-3">
                                        <table class="table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                <tr>
                                                    <th style="font-weight:500 !important;">Stock Item</th>
                                                    <th width="17%" style="font-weight:500 !important;">Actual Quantity</th>
                                                    <th width="33%" style="font-weight:500 !important;">Log Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mb-0" style="overflow:auto">
                                    <button class="btn btn-success btn-sm" type="submit" style="float:right">Insert</button>
                                    <a class="btn btn-danger btn-sm" role="button" href="<?= site_url('admin/stock/spoilages') ?>" data-original-title style="float:right">Cancel</a>
                                </div>
                            </form>
                        </div>

                        <div class="card" id="stockCard" style="float:left;width:37%;margin-left:3%">
                            <div class="card-header" style="overflow:auto">
                                <div style="font-size:15px;font-weight:600;float:left;width:40%;margin-top:4px">Select
                                    Stock Items</div>
                                <div style="width:55%;float:left;margin-left:5%;border-radius:10px">
                                    <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                </div>
                            </div>
                            <div class="card-body" style="margin:1%;padding:1%;font-size:14px">
                                <!--checkboxes-->
                                <?php if (!empty($stocks)) {
                                    ?>
                                    <table class="table table-borderless">
                                        <thead style="border-bottom:2px solid #cccccc">
                                            <tr>
                                                <th width="2%"></th>
                                                <th style="font-weight:500 !important;">Stock Item</th>
                                                <th style="font-weight:500 !important;">Category</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ic-level-2"><?php
                                                                    foreach ($stocks as $stock) {
                                                                        ?>
                                                <tr class="ic-level-1">
                                                    <td><input type="checkbox" class="mr-2" name="stock" data-curQty="<?= $stock['stQty'] ?>" data-name="<?= $stock['stName'] ?>" value="<?= $stock['stID'] ?>" required></td>
                                                    <td class="stock"><?= $stock['stName'] ?></td>
                                                    <td class="category"><?= $stock['ctName'] ?></td>
                                                </tr>
                                            <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php
                                } else {
                                    ?>
                                    <p>No stock items recorded!</p>
                                <?php
                                } ?>
                            </div>
                        </div>
                    </div>

                    <!--End of container divs-->
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php'); ?>
    <script>
        $(function() {

            $("#stockCard .ic-level-1").on("click", function(event) {
                if (event.target.type !== "checkbox") {
                    $(this).find("input[name='stock']").trigger("click");
                }
            });
            $("#stockCard input[name='stock']").on("click", function(event) {

                var id = $(this).val();
                var name = $(this).attr("data-name");
                var curQty = $(this).attr("data-curQty");
                console.log(id, name, $(this).is(":checked"));
                if ($(this).is(":checked")) {
                    $("#conForm .ic-level-2").append(`
                    <tr class="ic-level-1" data-stock="${id}">
                    <input name="curQty" id="curQty" type="hidden" data-curQty="${curQty}" >
                        <td style="padding:1% !important"><input type="text"
                                class="form-control form-control-sm" data-id="${id}" value="${name}" name="stock" readonly></td>
                        <td style="padding:1% !important"><input type="number" min= "1"
                                class="form-control form-control-sm" name="actualQty"></td>
                        <td style="padding:1% !important"><textarea type="text"
                                class="form-control form-control-sm" name="tRemarks" rows="1"></textarea>
                        </td>
                    </tr>`);
                    console.log($(this));
                } else {
                    $(`#conForm .ic-level-1[data-stock=${id}]`).remove();
                }
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

            $("#conForm").on("submit", function(event) {
                event.preventDefault();
                var url = $(this).attr("action");
                var tDate = $(this).find("input[name='tDate']").val();
                var remarks = $(this).find("textarea[name='remarks']").val();
                var items = [];
                $(this).find(".ic-level-1").each(function(index) {
                    items.push({
                        stID: $(this).find("input[name='stock']").attr('data-id'),
                        actualQty: $(this).find("input[name='actualQty']").val(),
                        tRemarks: $(this).find("textarea[name='tRemarks']").val(),
                        curQty: $(this).find("input[name='curQty']").attr('data-curQty')
                    });
                });
                if ($('input[name="stock"]:checked').length == 0) {
                    alert('No checkbox is checked');
                    return false;
                }

                console.log(items);
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {
                        date: tDate,
                        remarks: remarks,
                        items: JSON.stringify(items)
                    },
                    dataType: "JSON",
                    succes: function(data) {
                        if (data.sessErr) {
                            location.replace("/login");
                        } else {
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

        $('#conForm').submit(function(event) {
            var spoiledDate = $("#tDate").val();
            var currentDate = new Date();
            if (Date.parse(spoiledDate) > Date.parse(currentDate)) {
                alert('Invalid! Date exceeds current date.');
                return false;
            }
        });
    </script>
</body>

</html>
