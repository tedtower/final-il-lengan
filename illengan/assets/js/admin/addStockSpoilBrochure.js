function getSelectedStocks() {
    var value = 0;
    var choices = document.getElementsByClassName('choiceStock');
    var stockChecked;
    for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
            value = choices[i].value;

            $.ajax({
                type: 'POST',
                url: 'http://www.illengan.com/admin/stock/spoilages/viewStockJS',
                data: {
                    stID : value
                },
                dataType: 'json',
                async: false,
                success: function (data) {
                   
                    stockChecked = `<tr class="stockelem" data-id="` + data[i].stID + `" >
                            <input type="hidden" id="curstQty` + i + `" name="curstQty" class="form-control form-control-sm" data-curstQty="` + data[i].stQty + `" value="` + data[i].stQty + `">
                            <input type="hidden" id="stID` + i + `" name="stID" class="form-control form-control-sm" data-stID="` + data[i].stID + `" value="` + data[i].stID + `">
                            <td><input type="text" id="stName` + i + `" name="stName"
                                    class="form-control form-control-sm"  value="` + data[i].stName + `"  required></td>
                            <td><input type="number" min="1" id="ssQty` + i + `" name="ssQty"
                                    class="form-control form-control-sm" value="" required></td>
                            <td><input type="text" id="ssRemarks` + i + `" name="ssRemarks"
                                    class="form-control form-control-sm"  value="" required></td>
                            <td><img class="exitBtn1"
                                    src="/assets/media/admin/error.png"
                                    style="width:20px;height:20px"></td>
                            </tr>`;
                            $(this).closest(".modal").find(".exitBtn1").last().on('click',function(){
                                $(this).closest("tr").remove();
                            });
                    $('.stockSpoilageTable > tbody').append(stockChecked);
                }

            });
        }
    }
}
var elements;
function addStockItems() {
    elements = document.getElementsByClassName('stockelem');
    var ssDate = document.getElementById('spoilDate').value;
    var stockItems = [];
    var stocks = [];
    var stID,ssQty, ssRemarks;
    for (var i = 0; i <= elements.length - 1; i++) {
        stID = document.getElementsByName('stID')[i].value;
        curstQty = document.getElementsByName('curstQty')[i].value;
        ssQty = document.getElementsByName('ssQty')[i].value;
        ssRemarks = document.getElementsByName('ssRemarks')[i].value;

        stockItems = {
            'stID': stID,
            'curstQty': curstQty,
            'ssQty': ssQty,
            'ssDate': ssDate,
            'ssRemarks': ssRemarks
        };
        stocks.push(stockItems);
    }
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/stock/spoilages/add',
        data: {
            stocks: JSON.stringify(stocks)
        },
        dataType: 'json',
        complete: function() {
            $("#formAdd").modal("hide");
            location.reload();
            },
        error: function(response, setting, error) {
            console.log(response.responseText);
            console.log(error);
        }
    });
}

