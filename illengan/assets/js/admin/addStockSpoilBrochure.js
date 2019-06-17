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
                            <input type="hidden" id="curQty` + i + `" name="curQty" class="form-control form-control-sm" data-curQty="` + data[i].stQty + `" value="` + data[i].stQty + `">
                            <input type="hidden" id="stID` + i + `" name="stID" class="form-control form-control-sm" data-stID="` + data[i].stID + `" value="` + data[i].stID + `">
                            <input type="hidden" id="uomID` + i + `" name="uomID" class="form-control form-control-sm" data-uomID="` + data[i].uomID + `" value="` + data[i].uomID + `">
                            <input type="hidden" id="spmActualQty` + i + `" name="spmActualQty" class="form-control form-control-sm" data-spmActualQty="` + data[i].spmActualQty + `" value="` + data[i].spmActualQty + `">
                            <input type="hidden" id="uomStore` + i + `" name="uomStore" class="form-control form-control-sm" data-uomStore="` + data[i].uomStore + `" value="` + data[i].uomStore + `">
                            <td><input type="text" id="stName` + i + `" name="stName"
                                    class="form-control form-control-sm"  value="` + data[i].stName + `"  required></td>
                            <td><input type="number" min="1" id="tiQTy` + i + `" name="tiQTy"
                                    class="form-control form-control-sm" value="" required></td>
                            <td><input type="text" id="tRemarks` + i + `" name="tRemarks"
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
    console.log(elements);
    var tDate = document.getElementById('tDate').value;
    var stockItems = [];
    var stocks = [];
    var stID,tiQTy, tRemarks, curQty,uomID,spmActualQty,uomStore;
    for (var i = 0; i <= elements.length - 1; i++) {
        uomID = document.getElementsByName('uomID')[i].value;
        stID = document.getElementsByName('stID')[i].value;
        stName = document.getElementsByName('stName')[i].value;
        curQty = document.getElementsByName('curQty')[i].value;
        tiQTy = document.getElementsByName('tiQTy')[i].value;
        tRemarks = document.getElementsByName('tRemarks')[i].value;
        spmActualQty = document.getElementsByName('spmActualQty')[i].value;
        uomStore =document.getElementsByName('uomStore')[i].value;

        stockItems = {
            'uomID': uomID,
            'stID': stID,
            'stName':stName,
            'curQty': curQty,
            'tiQTy': tiQTy,
            'tRemarks': tRemarks,
            'tDate': tDate,
            'spmActualQty':spmActualQty,
            'uomStore':uomStore
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
        // complete: function() {
        //     $("#formAdd").modal("hide");
        //     location.reload();
        //     },
        error: function(response, setting, error) {
            console.log(response.responseText);
            console.log(error);
        }
    });
}

