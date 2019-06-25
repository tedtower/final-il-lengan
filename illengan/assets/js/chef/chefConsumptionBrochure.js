//------------------------Destock Function-----------------------------------
function getDestockStocks() {
    var value = 0;
    var choices = document.getElementsByClassName('choiceStock2');
    var stockChecked;

    for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
            value = choices[i].value;

            $.ajax({
                type: 'POST',
                url: 'http://www.illengan.com/chef/getConsumptionItems',
                data: {
                    stID : value
                },
                dataType: 'json',
                async: false,
                success: function(data) {
                   
                    stockChecked = `<tr class="stockelem" data-id="` + data[i].stID + `" >
                            <input type="hidden" id="uomID` + i + `" name="uomID" class="form-control form-control-sm" data-uomID="` + data[i].uomID + `" value="` + data[i].uomID + `">
                            <input type="hidden" id="curQty` + i + `" name="curQty" class="form-control form-control-sm" data-curQty="` + data[i].stQty + `" value="` + data[i].stQty + `">
                            <input type="hidden" id="stID` + i + `" name="stID" class="form-control form-control-sm" data-stID="` + data[i].stID + `" value="` + data[i].stID + `">
                            <td><input type="text" id="stName` + i + `" name="stName" class="form-control form-control-sm" data-stNameID="` + data[i].stName + `" value="` + data[i].stName + `" readonly="readonly" required></td>
                            <td><input type="number" min="1" id="consQty` + i + `" name="consQty" class="form-control form-control-sm" required/></td>
                            <td><img class="exitBtn"
                                    src="/assets/media/admin/error.png"
                                    style="width:20px;height:20px"></td>
                            </tr>`;
                    $('.destockTable > tbody').append(stockChecked);
                }

            });
        }
    }
}

var elements2;
function addDestockItems() {
    elements2 = document.getElementsByClassName('stockelem');
    var tDate = document.getElementById('consumption_date').value;
    var stockItems = [];
    var stocks = [];
    var stID,curQty,uomID,stName,consQty;
    for (var i = 0; i <= elements2.length - 1; i++) {
        stID = document.getElementsByName('stID')[i].value;
        curQty = document.getElementsByName('curQty')[i].value;
        uomID = document.getElementsByName('uomID')[i].value;
        stName = document.getElementsByName('stName')[i].value;
        consQty =  document.getElementsByName('consQty')[i].value;
        stockItems = {
            'stID': stID,
            'curQty': curQty,
            'tDate' : tDate,
            'uomID' : uomID,
            'stName' : stName,
            'consQty': consQty
        };
        stocks.push(stockItems);
    }
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/chef/destock',
        data: {
            stocks: JSON.stringify(stocks)
        },
        dataType: 'json',
         complete: function() {
        //     $("#destockitem").modal("hide");
             location.reload();
             },
        error: function(response, setting, error) {
            console.log(response.responseText);
            console.log(error);
        }
    });
}
