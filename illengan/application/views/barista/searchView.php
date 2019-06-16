<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Result</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/barista/bootstrap.min.css'); ?>">
</head>
<body>
<div class="container" style="width:100%; background-color: whitesmoke;">
<table class="table table-bordered" >
            <thead style="text-align: center">
                <tr>
                    <th>Order Id</th>
                    <th>Table No.</th>
                    <th>Customer</th>
                    <th>Qty</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
                </thead>
            <tbody>
                <?php
                    if(isset($orderArray)){
                        foreach ($orderArray as $row){
                    ?>
                        <tr style="text-align: center;">
                            <td><?php echo $row['order_id']?></td>
                            <td><?php echo $row['table_code']?>
                            </td>
                            <td><?php echo $row['cust_name']?></td>
                            <td><?php echo $row['order_qty'] ?></td>
                            <td><?php echo $row['menu_name'] ?></td>
                            <td><?php echo $row['item_status'] ?></td>
                        </tr>
                <?php 
                        }
                    }else{
                        echo "no data";
                    }
                ?>
            </tbody>

        </table>

    </div>
</body>
</html>