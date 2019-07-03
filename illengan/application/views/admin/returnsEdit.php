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
                        <div class="card" style="float:left;width:100%">
                            <div class="card-header">
                                <h6 style="font-size:15px;margin:0">Edit Return</h6>
                            </div>
                            <form id="conForm" action="<?= site_url("admin/return/edit") ?>" accept-charset="utf-8" class="form">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="input-group input-group-sm mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border border-secondary" style="width:80px;font-size:14px;">
                                                    Supplier</span>
                                            </div>
                                            <select class="form-control form-control-sm">
                                                <option value="" selected>Select Supplier</option>
                                                <option></option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border border-secondary" style="width:80px;font-size:14px">
                                                    Return Date</span>
                                            </div>
                                            <input type="date" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="input-group input-group-sm mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border border-secondary" style="width:80px;font-size:14px;">
                                                    Receipt</span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                        <div class="input-group input-group-sm mb-3 col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border border-secondary" style="width:80px;font-size:14px">
                                                    Receipt</span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="ic-level-3">
                                        <table class="table table-borderless">
                                            <thead style="border-bottom:2px solid #cccccc;font-size:14px">
                                                <tr>
                                                    <th style="font-weight:500 !important;">Stock Item</th>
                                                    <th width="17%" style="font-weight:500 !important;">Quantity</th>
                                                    <th width="17%" style="font-weight:500 !important;">Status</th>
                                                    <th width="33%" style="font-weight:500 !important;">Log Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ic-level-2">
                                                <tr>
                                                    <td><input type="text" class="form-control form-control-sm" readonly></td>
                                                    <td><input type="number" class="form-control form-control-sm"></td>
                                                    <td>
                                                        <select class="form-control form-control-sm">
                                                            <option value="" selected>Select Status</option>
                                                            <option>Active</option>
                                                            <option>Inactive</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control form-control-sm" rows="1"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer mb-0" style="overflow:auto">
                                    <button class="btn btn-success btn-sm" type="submit" style="float:right">Update</button>
                                    <button type="button" class="btn btn-danger btn-sm" style="float:right">Cancel</button>
                                </div>
                            </form>
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
                console.log(id, name, $(this).is(":checked"));
                if ($(this).is(":checked")) {
                    $("#conForm .ic-level-2").append(`
                    <tr class="ic-level-1" data-stock="${id}">
                        <td style="padding:1% !important"><input type="text"
                                class="form-control form-control-sm" data-id="${id}" value="${name}" name="stock" readonly></td>
                        <td style="padding:1% !important"><input type="number"
                                class="form-control form-control-sm" name="qty"></td>
                        <td style="padding:1% !important"><textarea type="text"
                                class="form-control form-control-sm" name="cRemarks" rows="1"></textarea>
                        </td>
                    </tr>`);
                } else {
                    $(`#conForm .ic-level-1[data-stock=${id}]`).remove();
                }
            });
            $("#stockCard input[name='search']").on("keyup", function() {
                var string = $(this).val();
                $("#stockCard .stock").each(function(index) {
                    if (!$(this).text().includes(string)) {
                        $(this).closest(".ic-level-1").hide();
                    } else {
                        $(this).closest(".ic-level-1").show();
                    }
                });
            });
            $("#conForm").on("submit", function(event) {
                event.preventDefault();
                var url = $(this).attr("action");
                var date = $(this).find("input[name='date']").val();
                var remarks = $(this).find("textarea[name='remarks']").val();
                var items = [];
                $(this).find(".ic-level-1").each(function(index) {
                    items.push({
                        stock: $(this).find("input[name='stock']").attr('data-id'),
                        qty: $(this).find("input[name='qty']").val(),
                        status: $(this).find("input[name='status']").val(),
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
                    succes: function(data) {
                        if (data.sessErr) {
                            location.replace("/login");
                        } else {
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
    </script>
</body>

</html>