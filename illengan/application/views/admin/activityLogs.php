<body style="background: white">
    <div class="content">
        <div class="container-fluid">
            <br>
            <div class="content" style="margin-left:250px;">
                <div class="container-fluid">
                    <div class="card-content">
                        <!--Export button and Real Time Date & Time -->
                        <p style="text-align:right; font-weight: regular; font-size: 16px;float:right">
                            <?php echo date("M j, Y -l"); ?>
                        </p>
                        <br><br>
                        <!--Search-->
                        <div id="stockTable" style="width:25%; float:right; border-radius:5px">
                            <input type="search" style="padding:1% 5%;width:100%;border-radius:20px;font-size:14px" name="search" placeholder="Search...">
                        </div>
                        <br><br>
                        <!--Table-->
                        <table id="stockTable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th><b class="pull-left">Date Recorded</b></th>
                                    <th><b class="pull-left">User</b></th>
                                    <th><b class="pull-left">Activity</b></th>
                                    <th><b class="pull-left">Remarks</b></th>
                                </tr>
                            </thead>
                            <tbody class="activityLogTable ic-level-1">
                            </tbody>
                        </table>
                        <div id="pagination" style="float:right"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
    <script>
     $(document).ready(function() {
	createPagination(0);
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageNum = $(this).attr('data-ci-pagination-page');
		createPagination(pageNum);
	});
	function createPagination(pageNum){
		$.ajax({
			url: '<?=base_url()?>admin/log/activity/'+pageNum,
			type: 'get',
			dataType: 'json',
			success: function(data){
                $('#pagination').html(data.pagination);
                var acts = data.actlogs;
                setActLogData(acts);
			},
            error: function (response, setting, errorThrown) {
                console.log(errorThrown);
                console.log(response.responseText);
            }
		});
	}
        
   });
   function setActLogData(act){
        $("#stockTable > tbody").empty();
        for(a in act){
            var row = `<tr>`;
            row += `<td>`+act[a].alDate+`</td>`;
            row += `<td>`+act[a].aUserName+`</td>`;
            row += `<td>`+act[a].alDesc+`</td>`;
            if(act[a].additionalRemarks == '' || act[a].additionalRemarks == null){
                row += `<td></td>`;
            }else{ 
                row += `<td>`+act[a].additionalRemarks+`</td>`;
            }
            row += `</tr>`;
        $("#stockTable > tbody").append(row);             
        }
   }
        //Search Function
        $("stockTable input[name='search']").on("keyup", function() {
            var string = $(this).val().toLowerCase();

            $("#stockTable .ic-level-1").each(function(index) {
                var text = $(this).text().toLowerCase().replace(/(\r\n|\n|\r)/gm, ' ');
                if (!text.includes(string)) {
                    $(this).closest("tr").hide();
                } else {
                    $(this).closest("tr").show();
                }
            });

        });


    </script>
</body>
