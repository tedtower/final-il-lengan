$(document).ready(function () {
    $('#searchmenu').on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $('div.menu_group div.card').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    
});