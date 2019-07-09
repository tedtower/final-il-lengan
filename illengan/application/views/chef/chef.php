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
        <table aria-label="..." style="font-size:15px;" id="pagination"><tr></tr></table>
        <div class="content">
            <div class="container-fluid">
                <!--Table-->
                    
                <table id="orders" class="table table-bordered" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                            <th></th>
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
$(document).ready(function() {
	createPagination(0);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum);
	});
	function createPagination(pageNum){
		$.ajax({
			url: 'chef/orders/loadData/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $.each(data.orders, function (index, items) {
                    orders.push({
                        "orders": items
                    });
                    orders[index].addons = data.addons.filter(ao => ao.olID == items.olID);
                   
                });
                $('#pagination').html(data.pagination);
                addons = data.addons;
				showTable(data.orders, data.addons);
                addAddons(data.addons);
			},
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});
	}
        
   });
    function showTable(data, addons) {
        $('#orders tbody').empty();
        for(ord in data){
			var ordRow = `<tr class="table_row" data-id="`+data[ord].osID+`">`;
                ordRow += `<td><img class="accordionBtn" src="/assets/media/admin/down-arrow%20(1).png" style="height:13px;width:13px;margin-right:5px;margin-left:0"/> 
                </td>`;
                ordRow += `<td>`+ data[ord].olID +`</td>`;
                ordRow += `<td>`+ data[ord].olDesc +`</td>`;
                ordRow += `<td>`+ data[ord].olQty +`</td>`;
                ordRow += `<td>`+ data[ord].tableCode +`</td>`;
                ordRow += `<td>`+ data[ord].custName +`</td>`;
                ordRow += `</tr>`;
            var accordion = `<tr class="accordion" style="display:table-row">`;
                accordion += ` <td colspan="5">`;
                accordion += ` <div style="overflow:hidden;">`;
                accordion += ` <div style="width:100%;overflow:auto;margin-left:1%;"> `;
                accordion += `<div class="AOaccordion" style="overflow:auto;"> `;
                accordion += `                    
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
            for(ao in addons){
                var addonsDiv = `<div class="addons" >`;
                if(parseInt(data[ord].olID) != addons[ao].olID){
                    addonsDiv +=  `No Addons`;
                }else{
                    addonsDiv += `<caption><b>Addons:</b></caption><br>`;
                    addonsDiv += `<table id="orderitem" class=" table table-bordered">`;
                    addonsDiv += `<thead class="thead-light">`;
                    addonsDiv +=`<tr>
                                <th scope="col">Item Name</th>
                                <th scope="col">Quantity</th>
                                </tr>`
                    addonsDiv +=`</thead><tbody>
                        <tr class="thisAddons`+data[ord].olID+`" data-olID="`+data[ord].olID+`">
                            <td style="margin-left:5%" class="aDoName`+data[ord].olID+`"></td>
                            <td style="margin-left:5%" class="aDoQty`+data[ord].olID+`"></td>
                        </tbody>
                    </table>`;
                }
                addonsDiv += `</div>`;
            }
            var remarks = `<div class="remarks" style="border-left: 2px solid #dee2e6; padding-left: 20px;">`;
            if(data[ord].olRemarks === null || data[ord].olRemarks === ""){
                remarks += ` `;
            }else{
                remarks +=`<caption><b>Remarks</b></caption>
                <br>
                <div>
                    <div>`+data[ord].olRemarks+`</div>
                </div>
                `}
                remarks += `</div>`;
                
            $("#orders > tbody").append(ordRow);
            $("#orders > tbody").append(accordion);
            $(".AOaccordion").last().append(addonsDiv);	
            $(".AOaccordion").last().append(remarks);				
		}
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
    function addAddons(addons) {
            for(ao in addons){
                if ($(".thisAddons" + addons[ao].olID) != '') {
                    var id = $(".thisAddons" + addons[ao].olID).attr('data-olID');
                    var names = addons.filter(function (n) {
                                    return n.olID == id;
                                });
                    console.log(names);
                    for(aos in names){
                        $(".aDoName" + addons[ao].olID).append(names[aos].aoName);
                        $(".aDoQty" + addons[ao].olID).append(names[aos].aoQty);
                    }
                }
            }
        }



 
</script>

</html>
