$(document).ready(function() {
    $('#table-orders').DataTable( {
        "processing":true,  
           "serverSide":true,  
           "order":[],  
           "ajax":{  
                url:"<?php echo base_url() . 'index.php/chef/index'; ?>",  
                type:"POST" 

    } } );
} );
