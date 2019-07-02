<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Il-Lengan | Inventory Report</title>
    <link rel="icon" type="image/ico" href="<?= logo_url().'logo_sm.ico'?>">
    <link rel="stylesheet" type="text/css" href="<?= admin_css().'light-bootstrap-dashboard.css'?>">
    <link rel="stylesheet" type="text/css" href="<?= admin_css().'print.css'?>">
    <link rel="stylesheet" type="text/css" href="<?= font_url().'fontawesome/font-awesome.css'?>">

</head>
<body style="background:white">
<div id="printReport">
    <div class="page" style="margin:0 !important;padding:0 !important;padding-left:4% !important;padding-right:4% !important;padding-bottom:5% !important">
        <div class="subpage">
        <?php foreach($categories as $category){ ?>
            <br>
            <div class="menu_box">
                <!-- Subcategory -->
                <div class="d-inline-flex mb-2 delius">
                    <h5 class="subcategory_label" style="font-weight:600;margin:0"><?php echo $category['ctName']?></h5>
                </div>

            <table class="table table-bordered">
                <thead class="head">
                    <tr>
                        <th width="40%"><b>Stock Item</b></th>
                        <th width="30%"><b>UOM</b></th>
                        <th width="30%"><b>Storage</b></th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($stockitems as $stock) {
                    if($category['ctName'] == $stock['ctName']){ ?>
                    <tr>
                        <td><?php echo $stock['stockitemname']?></td>
                        <td><?php echo $stock['uomName']?> (<?php echo $stock['uomAbbreviation']?>)</td>
                        <td><?php echo $stock['stLocation']?></td>
                    </tr>
                <?php }} ?>
                </tbody>

            </table>
        <?php } ?>
            <button  class="btn btn-info btn-sm noprint" id="print" onclick="printContent('printReport');" style="width:90px;margin:10px 0;background:#0ba1c6;color:white;font-size:15px" >Print</button>
        </div>
    </div>
</div>

<?php include_once('templates/scripts.php') ?>
<script src="<?= admin_js().'print.js'?>"></script>
<script>
      function printContent(el){
      var restorepage = $('body').html();
      var printcontent = $('#' + el).clone();
      var enteredtext = $('#text').val();
      $('body').empty().html(printcontent);
      window.print();
      $('body').html(restorepage);
      $('#text').html(enteredtext);
      }
  </script>
</body>
</html>

