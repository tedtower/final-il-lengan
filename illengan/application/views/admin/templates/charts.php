<script type="application/javascript">
    <?= "var sales = ".json_encode($sales).";\n" ?>
    var arrSales    = [0];
    var arrMonth    = ['January'];
    var arrRevenue  = [0];
    //Splits objects arrays into 2 arrays
    for(var x=0; x < sales.length; x++){
        if(sales[x].osLongMonth != 'January'){
            arrSales.push(parseInt(sales[x].salesCount));
            arrRevenue.push(parseInt(sales[x].revenue));
            arrMonth.push(sales[x].osLongMonth);
        } else{
            arrSales[0]     = parseInt(sales[x].salesCount);
            arrRevenue[0]   = parseInt(sales[x].revenue);
        }
        
    } 
    var minSales    = Math.min.apply(Math,arrSales),
        maxSales    = Math.max.apply(Math,arrSales) + 10,
        minRevenue  = Math.min.apply(Math,arrRevenue),
        maxRevenue  = Math.max.apply(Math,arrRevenue) + 100;
    let salesChart = document.getElementById('sales').getContext('2d');
    let revenueChart = document.getElementById('revenue').getContext('2d');
    Chart.defaults.global.defaultFontSize = 15;
    let linearSalesChart = new Chart(salesChart,{
        type: 'line',
        data: {
            datasets: [{
                label: 'Sales',
                data: arrSales,
                backgroundColor: '#7ca8e2'
            }],
            labels: arrMonth
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display:true,
                text:'Sales'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: minSales,
                        suggestedMax: maxSales
                    }
                }]
            }
        }
    });
    let linearRevenueChart = new Chart(revenueChart,{
        type: 'line',
        data: {
            datasets: [{
                label: 'Revenue',
                data: arrRevenue,
                backgroundColor: '#e27c7c'
            }],
            labels: arrMonth
        },
        options: {
            legend: {
                display:false
            },
            title: {
                display:true,
                text:'Revenue'
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