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
                    
                    <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th><b class="pull-left">Order No.</b></th>
                                <th><b class="pull-left">Order</b></th>
                                <th><b class="pull-left">Quantity</b></th>
                                <th><b class="pull-left">Date & Time</b></th>
                                <th><b class="pull-left">Table No.</b></th>
                                <th><b class="pull-left">Customer</b></th>
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
               
                //showTable();
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
            var tableRow = `
                <tr class="table_row" data-id="${item.orders.osID}">   <!-- table row ng table -->
                    <td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:15px;width: 15px"/></td>
                    <td>${item.orders.olID}</td>
                    <td>${item.orders.olDesc}</td>
                    <td>${item.orders.olQty}</td>
                    <td>${item.orders.osDateTime}</td>
                    <td>${item.orders.tableCode}</td>
                    <td>${item.orders.custName}</td>
                    <td>
                        <button class="editBtn btn btn-sm btn-primary" data-toggle="modal" data-target="#editPO" id="editPOBtn">Edit</button>
                        <button class="deleteBtn btn btn-sm btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
                    </td>
                </tr>
            `;
            var ordersDiv = `
            <div class="preferences" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${parseInt(item.orders[0].orderlists) === 0 ? "No orders" : 
                `<caption><b>Orders</b></caption>
                <br>
                <table id="orderitem" class=" table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Subtotal Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.orders.map(ol => {
                        return `
                        <tr>
                            <td>${ol.orderlists.mName} ${ol.orderlists.prName === 'Normal' ? " " : ol.orderlists.prName }</td>
                            <td>${ol.orderlists.olQty}</td>
                            <td>&#8369; ${ol.orderlists.prPrice}</td>
                            <td>&#8369; ${(parseFloat(ol.orderlists.olSubtotal)).toFixed(2)}</td>
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
                <td colspan="10"> <!-- table row ng accordion -->
                    <div style="overflow:auto;display:none"> <!-- container ng accordion -->
                        
                        <div style="width:100%;overflow:auto;padding-left: 5%"> <!-- description, preferences, and addons container -->
                            
                            <div class="poAccordionContent" style="overflow:auto;margin-top:1%"> <!-- Preferences and addons container-->
                                
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            `;

            var addonsDiv = `
            <div class="addons" style="float:left;margin-right:3%" > <!-- Preferences table container-->
                ${parseInt(item.orders[0].addons.length) === 0 ? " " : 
                `<caption><b>Add Ons</b></caption>
                <br>
                <table class="table table-bordered"> <!-- Preferences table-->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Add On</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Subtotal Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    ${item.orders[0].addons.map(or => {
                        return `
                        <tr>
                            <td>${or.aoName}</td>
                            <td>${or.aoQty}</td>
                            <td>&#8369; ${or.aoPrice}</td>
                            <td>&#8369; ${(parseFloat(or.aoTotal)).toFixed(2)}</td>
                        </tr>
                        `;
                    }).join('')}
                    </tbody>
                </table>
                `}
            </div>
            `;
        
            $("#salesTable > tbody").append(tableRow);
            $("#salesTable > tbody").append(accordion);
            $(".poAccordionContent").last().append(ordersDiv);
            $(".poAccordionContent").append(addonsDiv);
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

    showAddOns();
    }

 function showAddOns() {
    for(var i = 0; i <= addons.length-1; i++) {
     var addonsTr = '<tr><td>Add On</td>'+
     '<td>'+addons[i].aoName+'</td>'+
     '<td>'+addons[i].aoQty+'</td>'+
     '<td>'+addons[i].aoPrice+'</td>'+
     '<td>'+addons[i].aoTotal+'</td></tr>';
     
     $('#'+addons[i].olID).after(addonsTr);
    }
 }

 
</script>

</html>