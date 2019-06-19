function getSelectedAddons() {
    var value = 0;
    var choices = document.getElementsByClassName('choiceAddon');
    var addonChecked;
    for (var i = 0; i <= choices.length - 1; i++) {
        if (choices[i].checked) {
            value = choices[i].value;

            $.ajax({
                type: 'POST',
                url: 'http://www.illengan.com/admin/addon/spoilages/viewAddonJS',
                data: {
                    aoID : value
                },
                dataType: 'json',
                async: false,
                success: function (data) {  
                    
                    addonChecked = `<tr class="addonelem" data-id="` + data[i].aoID + `" >
                            <input type="hidden" id="aoID` + i + `" name="aoID" class="form-control form-control-sm" data-aoID="` + data[i].aoID + `" value="` + data[i].aoID + `">
                            <td><input type="text" id="aoName` + i + `" name="aoName"
                                    class="form-control form-control-sm" value="` + data[i].aoName + `" required></td>
                            <td><input type="number" min="1" id="aosQty` + i + `" name="aosQty"
                                    class="form-control form-control-sm" value="" required></td>
                            <td><input type="text" id="aosRemarks` + i + `" name="aosRemarks"
                                    class="form-control form-control-sm"  value="" required></td>
                            <td class="text-center" id="temp1"><a href="javascript:void(0)" class="exitBtn" onclick="remove()"><img src="/assets/media/admin/error.png" style="width:20px;height:20px"></a></td>
                            </tr>`;
                        //    function remove(){
                        //         $(this).closest("tr").remove();
                        //    };

                    $('.addonspoilageTable > tbody').append(addonChecked);
                }

            });
        }
    }
}
var elements;
function addAddonItems() {
    elements = document.getElementsByClassName('addonelem');
    var aosDate = document.getElementById('spoilDate').value;
    var addonItems = [];
    var addons = [];
    var aoID, aosQty, aosRemarks;
    for (var i = 0; i <= elements.length - 1; i++) {
        aoID = document.getElementsByName('aoID')[i].value;
        aoName = document.getElementsByName('aoName')[i].value;
        aosQty = document.getElementsByName('aosQty')[i].value;
        aosRemarks = document.getElementsByName('aosRemarks')[i].value;

        addonItems = {
            'aoID': aoID,
            'aoName': aoName,
            'aosQty': aosQty,
            'aosDate': aosDate,
            'aosRemarks': aosRemarks
        };
        addons.push(addonItems);
    }
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/admin/addons/spoilages/add',
        data: {
            addons: JSON.stringify(addons)
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

