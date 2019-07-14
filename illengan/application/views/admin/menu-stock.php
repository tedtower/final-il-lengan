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
                            <div class="card-content" id="menuStockTable">
                                <button id="addMenuStock" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addEditMenuStock" data-original-title style="margin:0;">Add
                                    Item</button>
                                <br>
                                <!--Search-->
                                <div id="menuStockTable" style="width:25%; float:right; border-radius:5px">
                                    <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                                </div>
                                <br><br>
                                <?php if (!empty($menuStock)) {
                                    ?>
                                    <table id="menuStockTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><b class="pull-left">Menu Item</b></th>
                                                <th><b class="pull-left">Stock Item</b></th>
                                                <th><b class="pull-left">Quantity</b></th>
                                                <th><b class="pull-left">Actions</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($menuStock as $item) {
                                                ?>
                                                <tr class="menuStockTable ic-level-1" data-id1="<?= $item['prID'] ?>" data-id2="<?= $item['stockitem'] ?>">
                                                    <td><?= $item['prefname'] ?></td>
                                                    <td><?= $item['stockitemname'] ?></td>
                                                    <td><?= $item['qty'] ?></td>
                                                    <td>
                                                        <button class="editBtn btn btn-sm btn-secondary" data-toggle="modal" data-target="#editMS">Edit</button>
                                                        <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#deleteMS">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php
                                } else { ?>
                                    <p>No items recorded!</p>
                                <?php
                                } ?>
                                <!--Start of Modal "Add Stock Spoilages"-->
                                <div class="modal fade bd-example-modal-lg" id="addEditMenuStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: auto !important;">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Menu-Stock</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="formAdd" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <!--Button to add launche the brochure modal-->
                                                    <a class="addItemBtn btn btn-default btn-sm" data-toggle="modal" data-target="#brochureMenu" data-original-title style="margin:0">Add
                                                        Menu Items</a>
                                                    <br><br>
                                                    <table class="stockSpoilageTable table table-sm table-borderless">
                                                        <!--Table containing the different input fields in adding stock spoilages -->
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Menu Name</th>
                                                                <th>Stock Name</th>
                                                                <th>Qty</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="ic-level-2">
                                                        </tbody>
                                                    </table>
                                                    <!--Total of the trans items-->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success btn-sm">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Modal "Add Stock Spoilage"-->

                                <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal" id="brochureMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Menu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div style="margin:1% 3%" class="ic-level-2">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success btn-sm">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Brochure Modal"-->

                                <!--Start of Brochure Modal"-->
                                <div class="modal fade bd-example-modal" id="brochureStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background:rgba(0, 0, 0, 0.3)">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Stock</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" accept-charset="utf-8">
                                                <div class="modal-body">
                                                    <div style="margin:1% 3%" class="ic-level-2">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success btn-sm">Ok</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--End of Brochure Modal"-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('templates/scripts.php') ?>
            <script>
                var getModalDataUrl = "<?= site_url('admin/menu/getMenuStockModalData') ?>";
                var addMenuStockUrl = "<?= site_url('admin/menu/addMenuStock') ?>";
                $(function() {
                    $("#addMenuStock").on('click', function() {
                        $("#addEditMenuStock form").on("submit", function(event) {
                            event.preventDefault();
                            var menuStock = [];
                            $(this).find(".ic-level-1").each(function(index) {
                                menuStock.push({
                                    prID: $(this).attr("data-id1"),
                                    stID: $(this).attr("data-id2"),
                                    prstQty: $(this).find("input[name='qty']").val()
                                });
                            });
                            $.ajax({
                                method: "POST",
                                url: addMenuStockUrl,
                                data: {
                                    items: JSON.stringify(menuStock)
                                },
                                dataType: "JSON",
                                success: function(data) {
                                    if (data.inputErr) {
                                        console.log(menuStock);
                                    } else {
                                        location.reload();
                                    }
                                },
                                error: function(response, setting, error) {
                                    console.log(response.responseText);
                                    console.log(error);
                                }
                            });
                        });
                        $.ajax({
                            method: 'POST',
                            url: getModalDataUrl,
                            dataType: 'JSON',
                            success: function(data) {
                                console.log(data);
                                $("#brochureMenu").find(".ic-level-2").append(data.preferences.map(pref => {
                                    return `<div class="ic-level-1">
                                        <label><input type="checkbox"
                                                name="prID" value="${pref.id}"/> ${pref.prefname}
                                        </label>
                                    </div>`;
                                }).join(''));
                                $("#brochureStock").find(".ic-level-2").append(data.stocks.map(stock => {
                                    return `<div class="ic-level-1">
                                        <label><input type="radio"
                                                name="stID" value="${stock.stID}"/> ${stock.stName} (${stock.uomAbbreviation})
                                        </label>
                                    </div>`;
                                }).join(''));
                                $("#addEditMenuStock").find(".addItemBtn").on("click", function() {
                                    console.log($("#addEditMenuStock").find(".addItemBtn"));
                                    $("#brochureMenu form").on("submit", function(event) {
                                        event.preventDefault();
                                        var item;
                                        $(this).find("input[name='prID']:checked").each(function(index) {
                                            item = data.preferences.filter(pref => pref.id == $(this).val())[0];
                                            $("#addEditMenuStock").find(".ic-level-2").append(`
                                            <tr class="ic-level-1" data-id1="${item.id}" data-id2="">
                                                <td><input type="text" name="prefID"
                                                        class="form-control form-control-sm"value="${item.prefname}" readonly="readonly"></td>
                                                <td><input type="text" name="stID"
                                                        class="form-control form-control-sm"value=""></td>
                                                <td><input type="number" name="qty"
                                                        class="form-control form-control-sm" value="0" min="0" required></td>
                                                <td><img class="exitBtn1"
                                                        src="/assets/media/admin/error.png"
                                                        style="width:20px;height:20px"></td>
                                            </tr>`);
                                            $("#addEditMenuStock").find(".ic-level-1").last().find("*").on("focus", function() {
                                                if (!$(this).closest(".ic-level-1").attr("data-focus")) {
                                                    $("#addEditMenuStock").find(".ic-level-1").removeAttr("data-focus");
                                                    $(this).closest(".ic-level-1").attr("data-focus", true);
                                                }
                                            });
                                            $("#addEditMenuStock").find("input[name='stID']").last().on("focus", function() {
                                                $("#brochureStock").modal("show");
                                                $("#brochureStock form").on("submit", function(event) {
                                                    event.preventDefault();
                                                    var stID = $(this).find("input[name='stID']:checked").val();
                                                    $("#addEditMenuStock").find(".ic-level-1[data-focus='true']").attr("data-id2", stID);
                                                    $("#addEditMenuStock").find(".ic-level-1[data-focus='true']").find("input[name='stID']").val(data.stocks.filter(stock => stock.stID == stID)[0].stName)
                                                    $(this)[0].reset();
                                                    $("#brochureStock").modal("hide");
                                                });
                                            });
                                        });
                                        $("#brochureMenu").modal("hide");
                                    });
                                });

                            },
                            error: function(response, setting, error) {
                                console.log(response.responseText);
                                console.log(error);
                            }
                        });
                    });
                    $("#brochureMenu").on("hidden.bs.modal", function() {
                        $(this).find("form")[0].reset();
                        $(this).find("form").off("submit");
                    });
                    $("#brochureStock").on("hidden.bs.modal", function() {
                        $(this).find("form")[0].reset();
                        $(this).find("form").off("submit");
                    });
                    $("#addEditMenuStock").on("hidden.bs.modal", function() {
                        $(this).find("form")[0].reset();
                        $(this).find(".ic-level-2").empty();
                        $(this).find("form").off("submit");
                    });

                });

                //Search Function
                $("#menuStockTable input[name='search']").on("keyup", function() {
                            var string = $(this).val().toLowerCase();

                            $("#menuStockTable .ic-level-1").each(function(index) {
                                var text = $(this).text().toLowerCase().replace(/(\r\n|\n|\r)/gm, ' ');
                                if (!text.includes(string)) {
                                    $(this).closest("tr").hide();
                                } else {
                                    $(this).closest("tr").show();
                                }
                            });
                        });
            </script>
</body>
</html>