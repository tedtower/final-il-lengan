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
                        <thead class="thead-light">
                            <tr>
                            <th width="10%">No.</th>
                                <th>Order</th>
                                <th>Qty</th>
                                <th>Table</th>
                                <th>Customer</th>
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
               
                $.each(data.orderlists, function (index, items) {
                    orders.push({
                        "orders": items
                    });
                    orders[index].addons = data.addons.filter(ao => ao.olID == items.olID);
                   
                });
               
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
                ${parseInt(item.addons.length) === 0 && item.orders.olRemarks === null ? "No addons and remarks" : 
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
                    ${item.addons.map(ao => {
                        return `
                        <tr>
                        <div>
                            <div style="margin-left:5%">> (${ao.aoQty}) ${ao.aoName}</div>
                            <div style="margin-left:5%">> (${ao.aoQty}) ${ao.aoName}</div>
                        </div>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;
            var accordion = `
            <tr class="accordion" style="display:none">
            <td colspan="5"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;margin-left:9%;"> <!-- description, preferences, and addons container -->
                        <div class="AOaccordion" style="overflow:auto;"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;

            var remarks = `
            <div class="remarks"> <!-- Preferences table container-->
                ${item.orders.olRemarks === null || item.orders.olRemarks === "" ? " " : 
                `<caption><b>Remarks:</b></caption>
                <br>
                <div>
                    <div style="margin-left:5%">${item.orders.olRemarks}</div>
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

    }



 
</script>

</html>