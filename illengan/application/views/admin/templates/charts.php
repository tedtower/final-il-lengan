<script type="application/javascript">
    <?= "var sales = ".json_encode($sales).";\n" ?>
    <?= "var todaySales = ".json_encode($todaySales).";\n" ?>
    var arrSales    = [0];
    var arrMonth    = ['January'];
    var arrRevenue  = [0];
    //Splits objects arrays into 2 arrays
    for(var x=0; x < sales.length; x++){
        if(sales[x].osLongMonth != 'January'){
            arrRevenue.push(parseInt(sales[x].revenue));
            arrMonth.push(sales[x].osLongMonth);
        } else{
            arrRevenue[0]   = parseInt(sales[x].revenue);
        }
    }
    if(arrMonth.length > 1) {
        $('span#maxMonth').text(' - '+arrMonth[arrMonth.length-1]);
    }
    var minRevenue  = Math.min.apply(Math,arrRevenue),
        maxRevenue  = Math.max.apply(Math,arrRevenue) + 100;
    let revenueChart = document.getElementById('revenue').getContext('2d');
    Chart.defaults.global.defaultFontSize = 15;
    let linearRevenueChart = new Chart(revenueChart,{
        type: 'line',
        data: {
            datasets: [{
                label: 'Sales',
                data: arrRevenue,
                backgroundColor: '#2b89d6de'
            }],
            labels: arrMonth
        },
        options: {
            legend: {
                display:false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: minRevenue,
                        suggestedMax: maxRevenue
                    }
                }]
            }
        }
    });

    $('a#custom_sale_generate').click(function(){
        $('div#error-custom-generate').empty();
        var csDate = $("input#sales-date[type='date']").val();
        if(!csDate){
            $('div#error-custom-generate').append("<div class='alert alert-danger' style='opacity:1;'>User Error: Please enter date.</div>");
        } else {
            $.ajax({
                method: "post",
                url: "<?php echo site_url('admin/dashboard/generateSalesDay')?>",
                data: {
                    date: csDate          
                },
                beforeSend: function(){
                    $('span#csdg-load').append("<i class='fas fa-sync fa-spin'></i>");
                },
                success: function(data) {
                    $('span#csdg-load').empty();
                    $('div#custom_sale_result').empty();
                    var lists = JSON.parse(data);
                    if(lists.length > 0){
                        var lString= "", sCount = 0;
                        console.log(lists);
                        for(var a=0; a < lists.length; a++){
                            lString = lString+"<tr><td>"+lists[a].ctName+"</td><td>"+lists[a].olCount+"</td><td>&#8369; "+lists[a].sCount+"</td></tr>";
                            sCount = sCount + parseFloat(lists[a].sCount);
                        }
                        lString = "<table class='w-100'><tr><th class='w-50'>Category</th><th class='w-25'>Order Count</th><th class='w-25'>Total Sales</th></tr>"+lString+"</table><hr>";
                        $('div#custom_sale_result').html(lString+"<p>Total Sales: <b>&#8369;"+sCount+"</b></p>");
                    } else {
                        $('div#custom_sale_result').html("<p class='text-center'>There are no sales recorded in this date.</p>");
                    }
                },
                error: function() {
                    $('span#csdg-load').empty();
                    $('div#error-custom-generate').append("<div class='alert alert-danger' style='opacity:1;'>System Error: There is a problem in fetching data.</div>");
                }
            });
        }
    });
    
</script>