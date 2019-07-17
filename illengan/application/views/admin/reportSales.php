<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Il-Lengan | Sales Report</title>
    <link rel="icon" type="image/ico" href="<?= logo_url().'logo_sm.ico'?>">
    <link rel="stylesheet" type="text/css" href="<?= framework_url().'bootstrap-native/bootstrap.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?= admin_css().'light-bootstrap-dashboard.css'?>">
    <link rel="stylesheet" type="text/css" href="<?= admin_css().'sidenav.css'?>">
    <link rel="stylesheet" type="text/css" href="<?= admin_css().'print.css'?>">
    <link rel="stylesheet" type="text/css" href="<?= font_url().'fontawesome/font-awesome.css'?>">

</head>
<body style="background:white">
<div id="printReport">
    <div class="page">

        <div class="subpage">
        <div>
        
        <p style="font-weight: regular; font-size: 16px;">
            <span class="text-left">Il-lengan | Sales
            <span style="float:right"><?php echo date("M j, Y - l"); ?><span>
        </p>
        </div>
            <table class="table table-bordered">
                <thead class="head">
                    <tr>
                        <th><b>Slip No.</b></th>
                        <th><b>Menu</b></th>
                        <th><b>Date</b></th>
                        <th><b>Quantity</b></th>
                        <th><b>Price</b></th>
                        <th><b>Subtotal</b></th>
                        <th><b>W/ Discount</b></th>
                    </tr>
                </thead>

                <tbody>
                <?php  
                    if(isset($report[0])){
                        foreach($report as $report){
                ?>
                    <tr>
                        <td>Slip No. <?php echo $report['osID']?></td>
                        <td><?php echo $report['olDesc']?></td>
                        <td><?php echo $report['osPayDateTime']?></td>
                        <td><?php echo $report['olQty']?></td>
                        <td><?php echo $report['olPrice']?></td>
                        <?php if($report['osDiscount'] == 0){
                                echo '<td>'.$report['olSubtotal'].'</td>
                                        <td></td>';
                            }else{
                                $discount = $report['olSubtotal'] * ($report['osDiscount']/100);
                                $amount = $report['olSubtotal'] - $discount;
                                echo 
                                    '<td style="color:red">'.$amount.'</td>
                                    <td>w/ 20% discount</td>
                                ';
                                }
                            ?>
                    </tr>
                    <?php foreach($addons as $addon){
                    if($addon['olID'] == $report['olID']){?>
                    <tr>
                        <td></td>
                        <td><i class="pl-5"> > <?php echo $addon['aoName']?></i></td>
                        <td><?php echo $report['osPayDateTime']?></td>
                        <td><?php echo $addon['aoQty']?></td>
                        <td><?php echo $addon['aoPrice']?></td>
                        <?php if($report['osDiscount'] == 0){
                                    echo '<td>'.$addon['aoTotal'].'</td>
                                          <td></td>';
                                }else{
                                    $discount = $addon['aoTotal'] * ($report['osDiscount']/100);
                                    $amount = $addon['aoTotal'] - $discount;
                                    echo 
                                        '<td style="color:red">'.$amount.'</td>
                                        <td>w/ 20% discount</td>';
                                    }
                        ?>
                    </tr>
                    <?php }
                     }?>
                    <?php }
                    } ?>
                </tbody>

            </table>
            <?php  
                        foreach($total as $total){
                ?>
                <div style="border-bottom:2px solid gray;width:12%;float:right;overflow:auto">
                    <div style="padding-bottom:5px">
                        <div style="float:left;">Total:</div> 
                        <div style="float:left;"><span class="ml-2">&#8369; <?php echo $total['total']?></span></div>
                    </div>
                </div>
                <?php }
                     ?>
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

