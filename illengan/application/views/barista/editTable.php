<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Change Table Number</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/barista/bootstrap.min.css'); ?>">
    </head>
<body>
<form action="http://www.illengan.com/barista/editTableNumber" method="post" name="form">
    <?php echo validation_errors(); ?>
    <?php echo form_open('editTable'); ?>

    <label for="changeTable">New Table Code: </label><input type="text" name="table_code" value=""/>

    <div><input type="submit" class="btn btn-secondary btn-sm" value="Save" />
    <a href="<?php echo site_url('barista/orders'); ?>" class="btn btn-secondary btn-sm">Cancel</a>
    </div>

    </form>

</body>
</html>
<!--<html>
<head>
    <title>Edit Table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>
<form action="" method="get">
        New Table Number: &nbsp<input type="text"/>
        <br><br>
        <input type="submit" class="btn btn-secondary btn-sm" value="Save"/>
        &nbsp;<a href="http://illengan.com/barista/orders" class="btn btn-secondary btn-sm">Cancel</a>
</form>
</body>
</html>-->

