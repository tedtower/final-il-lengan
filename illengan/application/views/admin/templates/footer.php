<script>

var getEnumValsUrl = '<?= site_url('admin/transactions/getEnumVals')?>';
    var crudUrl = '<?= site_url('admin/transactions/add')?>';
    var getTransUrl = '<?= site_url('admin/transactions/getTransaction')?>';
    var loginUrl = '<?= site_url('login')?>';
    var getPOsUrl = '<?= site_url('admin/transactions/getPOs')?>';
    var getDRsUrl = '<?= site_url('admin/transactions/getDRs')?>';
    var getSPMsUrl = '<?= site_url('admin/transactions/getSPMs')?>';
      $(function() {
        $("#addBtn").on("click", function(){
            setAddEditBtnHandlers();
        });
        $('#addEditTransaction').on('hidden.bs.modal', function () {
            $("#addEditTransaction form")[0].reset();
            $(this).find("select[name='spID']").off('change');
            $("#addItemBtn").off('click');
            $("#addPOBtn").off('click');
            $("#addDRBtn").off('click');
            $("#addMBtn").off('click');
            $("#addEditTransaction").find(".ic-level-2").empty();
        });
        $(".accordionBtn").on('click', function() {
            if ($(this).closest('tr').next('.accordion').css('display') === 'none') {
                $(this).closest('tr').next('.accordion').slideDown();
                $(this).closest('tr').next('.accordion').find('div').slideDown();
            } else {
                $(this).closest('tr').next('.accordion').find('div').slideUp();
                $(this).closest('tr').next('.accordion').slideUp();
            }
        });
        $(".editBtn").on('click', function() {
            var id = $(this).closest("tr").attr("data-id");
            setAddEditBtnHandlers();
            populateModalForm(getTransUrl, id);
        });
        $("#addEditTransaction form").on('submit', function(event) {
            event.preventDefault();
            var id = $(this).find('input[name="tID"]').val();
            var supplier = $(this).find('select[name="spID"]').val();
            var type = $(this).find('select[name="tType"]').val();
            var receipt = $(this).find('input[name="tNum"]').val();
            var date = $(this).find('input[name="tDate"]').val();
            var remarks = $(this).find('textarea[name="tRemarks"]').val();
            var transitems = [];
            for(var x = 0; x < $(this).find('.ic-level-1').length ; x++){
                var tiID = $(this).find('.ic-level-1').eq(x).attr("data-id");
                transitems.push({
                    tiID: isNaN(parseInt(tiID)) ? (undefined) : tiID,
                    tiName: $(this).find('input[name = "itemName[]"]').eq(x).val(),
                    stID: $(this).find('input[name = "stID[]"]').eq(x).attr("data-id"),
                    tiQty: $(this).find('input[name = "itemQty[]"]').eq(x).val(),
                    stQty: $(this).find('input[name = "actualQty[]"]').eq(x).val(),
                    tiUnit: $(this).find('select[name = "itemUnit[]"]').eq(x).val(),
                    stUnit: $(this).find('select[name = "actualUnit[]"]').eq(x).val(),
                    tiPrice: $(this).find('input[name = "itemPrice[]"]').eq(x).val(),
                    tiStatus: $(this).find('select[name = "itemStatus[]"]').eq(x).val()
                });
            }
            $.ajax({
                method: 'POST',
                url: crudUrl,
                data: {
                    id: id,
                    supplier: supplier,
                    type: type,
                    receipt: receipt,
                    date: date,
                    remarks: remarks,
                    transitems: JSON.stringify(transitems)
                },
                dataType: 'JSON',
                beforeSend: function(){
                    console.log(transitems);
                },
                success: function(data){
                    console.log(data);
                },
                error: function(response, setting, error) {
                    console.log(response.responseText);
                    console.log(error);
                }
            });
        });
        $("#stockBrochure form").on('submit',function(event){
            event.preventDefault();
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='stID[]']").val($(this).find("input[name='stocks']:checked").attr("data-name"));
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("input[name='stID[]']").attr("data-id", $(this).find("input[name='stocks']:checked").val());
            $("#addEditTransaction").find(".ic-level-1[data-focus='true']").find("select[name='actualUnit[]']").trigger('change');
            $(this)[0].reset();
            $("#stockBrochure").modal("hide");
        });
        $("#merchandiseBrochure, #stockBrochure").on("hidden.bs.modal", function(){
            $(this).find(".ic-level-2").empty();
            $(this).find("form")[0].reset();
            $(this).find("form").off('submit');
        });
        $("#transactionBrochure").on("hidden.bs.modal", function(){
            $(this).find(".ic-level-4").empty();
            $(this).find("form")[0].reset();
            $(this).find("form").off('submit');
        });
    });
</script>