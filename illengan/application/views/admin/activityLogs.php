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
                            <?php
                                if (isset($actlogs)) {
                                    foreach ($actlogs as $actlog) {
                                        ?>
                                        <tr>
                                            <td><?php echo $actlog['alDate'] ?></td>
                                            <td><?php echo $actlog['aUserName'] ?></td>
                                            <td><?php echo $actlog['alDesc'] ?></td>
                                            <td><?php echo $actlog['additionalRemarks'] ?></td>
                                        </tr>
                                    <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('templates/scripts.php') ?>
    <script>


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