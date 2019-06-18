addSupplierOpts();
removeOptions();
var total = 0;

$('#addPO').on('hidden.bs.modal', function (e) {
    removeOptions();
});

function removeOptions() {
    $(document).ready(function () {
        $("#addPO form")[0].reset();
        var opt_elements = document.getElementsByClassName('options');
        while (opt_elements.length > 0) {
            opt_elements[0].remove(opt_elements[0]);
        }
        var fbTab_elements = document.getElementsByClassName('pmTab');
        while (fbTab_elements.length > 0) {
            fbTab_elements[0].remove(fbTab_elements[0]);
        }
        var item_elements = document.getElementsByClassName('merchelem');
        while (item_elements.length > 0) {
            item_elements[0].remove(item_elements[0]);
        }
        $('#total').text('');
    });
}


function addSupplierOpts() {
    $(document).ready(function () {
        $.ajax({
            url: 'http://www.illengan.com/admin/jsonSupp',
            dataType: 'json',
            success: function (data) {
                var optArr = [];
                for (var i = 0; i <= data.length - 1; i++) {
                    var options = '<option class="options" value="' + data[i].spID + '">' + data[i].spName + '</option>';
                    optArr.push(options);

                }
                $('#spName').append(optArr);
            }
        });
    });
}

function setSuppMerchandise() {
    $(document).ready(function () {
        $.ajax({
            url: 'http://www.illengan.com/admin/jsonMerchandise',
            dataType: 'json',
            success: function (data) {
                var optArr = [];
                for (var i = 0; i <= data.length - 1; i++) {
                    var options = '<label style="width:96%">' +
                        '<input type="checkbox" class="mr-2" value="' + data[i].spmID + '">' +
                        data[i].stName + ' per ' + data[i].spmUnit + '</label>';
                    optArr.push(options);
                }

                $('#spName').append(optArr);
            }
        });
    });

}
var countTr = 0;

function getSelectedMerch() {
    var value = 0;
    var choices = document.getElementsByClassName('merchChoice');
    var merchChecked;
    for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
            value = choices[i].value;
            $.ajax({
                type: 'POST',
                url: 'http://www.illengan.com/admin/jsonMerchandise',
                data: {
                    spmID: value
                },
                dataType: 'json',
                async: false,
                success: function (data) {
                    merchChecked = `<tr class="merchelem" data-id="` + data[0].spmID + `">
                    <input type="hidden" name="vID" value="` + data[0].vID + `">
                    <input type="hidden" name="spmDesc" value="` + data[0].spmDesc + `">
                    <td><input type="text" id="stName" name="stName"
                             class="form-control form-control-sm"  data-stID="` + data[0].stID + `" value="` + data[0].branditem + `" readonly="readonly"></td>
                     <td><input type="text" id="vQty" onchange="setSubtotal()" name="vQty"
                             class="vQty form-control form-control-sm" value="` + data[0].vQty + `" ></td>
                     <td><input type="text" id="vUnit" name="vUnit"
                            class="form-control form-control-sm" value="` + data[0].vUnit + `" readonly="readonly"></td>
                     <td><input type="text" id="vSize" name="vSize"
                            class="form-control form-control-sm" value="` + data[0].vSize + `" readonly="readonly"></td>
                     <td><input type="number" id="spmPrice" name="spmPrice"
                             class="spmPrice form-control form-control-sm"  value="` + data[0].spmPrice + `" readonly="readonly"></td>
                     <td><input type="number" name="subtotal" class="subtotal form-control form-control-sm" value="" readonly="readonly"></td>
                    <td><img class="exitBtn"
                             src="/assets/media/admin/error.png"
                             style="width:20px;height:20px"></td>
                     </tr>`;
                    if ($('#editPO').is(':visible')) {
                        $('.poItemsTables > tbody').append(merchChecked);
                    } else {
                        $('.poItemsTable > tbody').append(merchChecked);
                    }
                    countTr = countTr + 1;
                    console.log('count ' + countTr)
                    setSubtotal();
                }
            });
        }


    }
}
var elements;

function addPurchaseOrder() {
    var spID = $('#spName').val();
    var poDate = $('#poDate').val();
    var edDate = $('#edDate').val();
    var poRemarks = $('#poRemarks').val();
    var poiQty, poiUnit, poiPrice;
    elements = document.getElementsByClassName('merchelem');

    var itemMerch = [];
    var merch = [];
    for (var i = 0; i <= elements.length - 1; i++) {
        vID = document.getElementsByName('vID')[i].value;
        poiName= document.getElementsByName('spmDesc')[i].value;
        poiQty = document.getElementsByName('vQty')[i].value;
        poiUnit = document.getElementsByName('vUnit')[i].value;
        poiPrice = document.getElementsByName('spmPrice')[i].value;
        poTotal = total;

        itemMerch = {
            'vID': vID,
            'poiName': poiName,
            'poiQty': poiQty,
            'poiUnit': poiUnit,
            'poiPrice': poiPrice,
            'poiStatus': 'pending',
            'poiRemarks': poRemarks
        };
        merch.push(itemMerch);
    }

    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/purchaseorder/add',
        data: {
            spID: spID,
            poDate: poDate,
            edDate: edDate,
            poTotal: poTotal,
            poRemarks: poRemarks,
            merchandise: JSON.stringify(merch)
        },
        beforeSend: function() {
            console.log('POI'+poiName);
        },
        dataType: 'json',
        success: function (data) {
            alert('Purchase Order added');
            location.reload();
        }
    })
}


function setSubtotal() {
    $(document).ready(function () {
        var spmPrice, vQty;
        elements = document.getElementsByClassName('merchelem');
        total = 0;

        for (var i = 0; i <= elements.length - 1; i++) {
            spmPrice = parseInt(document.getElementsByName('spmPrice')[i].value);
            vQty = parseInt(document.getElementsByName('vQty')[i].value);
            document.getElementsByName('subtotal')[i].value = vQty * spmPrice;

        }
        for (var i = 0; i <= elements.length - 1; i++) {
            var subtotal = parseInt(document.getElementsByName('subtotal')[i].value);
            console.log();
            total = total + subtotal;
        }
        if ($('#addPO').is(':visible')) {
            $('#total').text(total);
        } else {
            $('#total1').text(total);
        }

    });


}
