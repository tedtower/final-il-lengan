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
                                <a class="btn btn-primary btn-sm" href="<?= site_url('admin/consumption/formadd')?>" data-original-title style="margin:0"
                                    id="addBtn">Add Consumption</a>
                                <br>
                                <br>
                                <table id="transTable" class="table table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <thead class="thead-dark">
                                        <th><b class="pull-left">Transaction #</b></th>
                                        <th><b class="pull-left">Stock Name</b></th>
                                        <th><b class="pull-left">Qty Consumed</b></th>
                                        <th><b class="pull-left">Date Consumed</b></th>
                                        <th><b class="pull-left">Date Recorded</b></th>
                                        <th><b class="pull-left">Actions</b></th>
                                    </thead>
                                    <tbody>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                            <a class="btn btn-secondary btn-sm" href="<?= site_url('admin/consumption/formedit')?>" data-original-title style="margin:0"
                                                id="editBtn">Edit</a>
                                            <button class="deleteBtn btn btn-sm btn-warning" data-toggle="modal" data-target="#deleteConsumption">Archive</button>
                                            </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                                <!--End Table Content-->

                     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
  
</body>
<script>
var cons = [];
var stocks = [];
var supplier = [];
var suppmerch = [];

    $(function () {
        $.ajax({
            url: '/admin/jsonReturns',
            dataType: 'json',
            success: function (data) {
                var poLastIndex = 0;
                $.each(data.consumption, function (index, items) {
                    cons.push({
                        "cons": items
                    });
                    cons[index].consitems = data.consitems.filter(cn => cn.cID == items.cID);
                });
                
                showTable();
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

    });
                            
    function showTable() {
        cons.forEach(function (item) {
            var tableRow = `
                <tr class="table_row" data-id="${item.cons.cID}">   <!-- table row ng table -->
                    <td><a href="javascript:void(0)" class="ml-2 mr-4">
                    <img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></a>
                    ${item.cons.cID}</td>                    
                    <td>${item.cons.stName}</td>
                    <td>${item.cons.cDate}</td>
                    <td>${item.cons.cDateRecorded}</td>
                    <td>
                    <a class="editReturnsReturnsbtn btn btn-secondary btn-sm" href="returns/formedit/${item.returns.rID}" style="margin:0">Edit Return</a>                 
                        <button class="deleteBtn btn btn-sm btn-warning" data-id="${item.returns.rID}" data-toggle="modal" data-target="#deleteReturns">Archive</button>
                    </td>
                </tr>
            `;

            var consDiv = `
            <div class="preferences" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${item.consitems.length === 0 ? "No consumed items" : 
                `<caption><b>Orders</b></caption>
                <br>
                <table width="100%" id="consitems" class=" table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                        <th>t</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.returnitems.map(ret => {
                        return `
                        <tr id="${ret.ciID}">
                        <td>${ret.returnReference}</td>
                            <td>${ret.stName}</td>
                            <td>${ret.tiQty}</td>
                            <td>${ret.uomName}</td>
                            <td>${ret.tiActual}</td>
                            <td>&#8369; ${ret.spmPrice}</td>
                            <td>&#8369; ${ret.tiSubtotal}</td>
                            <td>${ret.riStatus}</td>
                            <td>${ret.tiRemarks === null ? " " : ret.tiRemarks}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;

            var accordion = `
            <tr class="accordion" style="display:none">
                <td colspan="6"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;padding-left: 5%"> <!-- description, preferences, and addons container -->
                            
                            <div class="returnsContent" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;

            $("#transTable > tbody").append(tableRow);
            $("#transTable > tbody").append(accordion);
            $(".returnsContent").last().append(returnsDiv);

        });

        $(".accordionBtn").on('click', function () {
            if ($(this).closest("tr").next(".accordion").css("display") == 'none') {
                $(this).closest("tr").next(".accordion").css("display", "table-row");
                $(this).closest("tr").next(".accordion").find("td > div").slideDown("slow");
            } else {
                $(this).closest("tr").next(".accordion").find("td > div").slideUp("slow");
                $(this).closest("tr").next(".accordion").hide("slow");
            }
        });

        $('.deleteBtn').on('click',function() {
            var id = $(this).attr("data-id");
            console.log(id);
            console.log(this);
            $("#deleteReturns").find('input[name="tID"]').val(id);
           
    });
    }

</script>