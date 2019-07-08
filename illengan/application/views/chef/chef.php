<!DOCTYPE html>
<html>

<head>
    <?php include_once('head.php') ?>
</head>
<body>
<?php include_once('navigation.php') ?>
<div class="content">
    <div class="container-fluid" style="margin-top:70px">
        <br>
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y - l"); ?>
        </p>
        <div class="content">
            <div class="container-fluid">
                <!--Table-->
                    
                <table id="orders" class="table table-bordered" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                            <th width="10%"><b>No.</b></th>
                                <th><b>Order</b></th>
                                <th><b>Qty</b></th>
                                <th><b>Table</b></th>
                                <th><b>Customer</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>


<?php include_once('scripts.php') ?>

</body>
<script>
var orders = [];
var addons = [];
 $(function () {
        $.ajax({
            url: '/chef/orders',
            dataType: 'json',
            success: function (data) {
                var poLastIndex = 0;
                $.each(data.orders, function (index, items) {
                    orders.push({
                        "orders": items
                    });
                    orders[index].addons = data.addons.filter(ao => ao.olID == items.olID);
                   
                });
                addons = data.addons;
                showTable();
                console.log(orders);
            },
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
        });

        
    });
    function showTable() {
       orders.forEach(function (item) {
           console.log(item.orders);
            var tableRow = `
                <tr class="table_row" data-id="${item.orders.osID}">   <!-- table row ng table -->
                <td>
                    <img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" 
                    style="height:13px;width:13px;margin-right:5px;margin-left:0"/> 
                    ${item.orders.olID}</td>
                    <td><b>${item.orders.olDesc}</b></td>
                    <td><b>${item.orders.olQty}</b></td>
                    <td>${item.orders.tableCode}</td>
                    <td>${item.orders.custName}</td>
                </tr>
            `;
            var addonsDiv = `
            <div class="addons" > <!-- Preferences table container-->
                ${parseInt(item.addons.length) === 0 ? "No addons" : 
                `<caption><b>Addons:</b></caption>
                <br>
                <table id="orderitem" class=" table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <div>
                        <div style="margin-left:5%" class="aDoQty${item.orders.olID}"></div>
                        </div>
                    </tbody>
                </table>
                `}
            </div>
            `;
            var accordion = `
            <tr class="accordion" style="display:table-row">
            <td colspan="5"> <!-- table row ng accordion -->
                    <div style="overflow:hidden;"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;margin-left:1%;"> <!-- description, preferences, and addons container -->
                        <div class="AOaccordion" style="overflow:auto;"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;

            var remarks = `
            <div class="remarks" style="border-left: 2px solid #dee2e6; padding-left: 20px;"> <!-- Preferences table container-->
                ${item.orders.olRemarks === null || item.orders.olRemarks === "" ? " " : 
                `<caption><b>Remarks</b></caption>
                <br>
                <div>
                    <div>${item.orders.olRemarks}</div>
                </div>
                `}
            </div>
            `;
        
            $("#orders > tbody").append(tableRow);
            $("#orders > tbody").append(accordion);
            $(".AOaccordion").last().append(addonsDiv);
            $(".AOaccordion").last().append(remarks);
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
        addAddons();

    }
    function addAddons() {
            // addons.forEach(ao => {
            for (var i = 0; i < addons.length; i++) {
                if ($(".thisAddons" + addons[i].olID) != '') {
                    for (var i = 0; i < addons.length; i++) {
                        $(".aDoQty" + addons[i].olID).append(`${addons[i].aoQty}&nbsp;${addons[i].aoName}`);
                    }
                }
            }
        }



 
</script>

</html>
