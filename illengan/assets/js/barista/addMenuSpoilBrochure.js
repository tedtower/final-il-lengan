function getSelectedPref() {
    var value = 0;
    var choices = document.getElementsByClassName('choiceMenu');
    var menuChecked;
    for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
            value = choices[i].value;

            $.ajax({
                type: 'POST',
                url: 'http://www.illengan.com/admin/menu/spoilages/viewMenuJS',
                data: {
                    prID : value
                },
                dataType: 'json',
                async: false,
                success: function (data) {  
                    
                    menuChecked = `<tr class="menuelem" data-id="` + data[i].prID + `" >
                            <input type="hidden" id="prID` + i + `" name="prID" class="form-control form-control-sm" data-prID="` + data[i].prID + `" value="` + data[i].prID + `">
                            <td><input type="text" id="mName` + i + `" name="mName"
                                    class="form-control form-control-sm" value="` + data[i].prName + `"  required></td>
                            <td><input type="number" min="1" id="msQty` + i + `" name="msQty"
                                    class="form-control form-control-sm" value="" required></td>
                            <td><input type="text" id="msRemarks` + i + `" name="msRemarks"
                                    class="form-control form-control-sm"  value="" required></td>
                            <td><img class="exitBtn1"
                                    src="/assets/media/admin/error.png"
                                    style="width:20px;height:20px"></td>
                            </tr>`;
                            $(this).closest(".modal").find(".exitBtn1").last().on('click',function(){
                                $(this).closest("tr").remove();
                            });
                    $('.menuspoilageTable > tbody').append(menuChecked);
                }

            });
        }
    }
}

var elements;
function addMenuItems() {
    elements = document.getElementsByClassName('menuelem');
    var msDate = document.getElementById('spoilDate').value;
    var menuItems = [];
    var menus = [];
    var prID, msQty, msRemarks;
    for (var i = 0; i <= elements.length - 1; i++) {
        prID = document.getElementsByName('prID')[i].value;
        msQty = document.getElementsByName('msQty')[i].value;
        msRemarks = document.getElementsByName('msRemarks')[i].value;

        menuItems = {
            'prID': prID,
            'msQty': msQty,
            'msDate': msDate,
            'msRemarks': msRemarks
        };
        menus.push(menuItems);
    }
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/menu/spoilages/add',
        data: {
            menus: JSON.stringify(menus)
        },
        dataType: 'json',
        complete: function() {
            $('#addmenuspoilage').modal('hide');
            location.reload();
        },
        error: function(response, setting, error) {
            console.log(response.responseText);
            console.log(error);
        }
    });
}

function newFunction(data) {
    console.log(data);
}
