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
    
</script>