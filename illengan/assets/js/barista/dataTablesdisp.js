let UPDATE = 5000;
var table = $('#mydata');

function orders() {
$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/chef/get_orderlist'
            }); 
 
});
 }

 function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Add Ons</td>'+
            '<td>Remarks</td>'+
        '</tr>'+
        '<tr>'+
            '<td>---</td>'+
            '<td>'+d.remarks+'</td>'+
        '</tr>'+
    '</table>';
}

$('#mydata').on('init.dt', function(e, settings){
   var api = new $.fn.dataTable.Api( settings );
   api.rows().every( function () {
      var tr = $(this.node());
      this.child(format(this.data())).show();
      tr.addClass('shown');
   });
});

$(document).ready(function() {
    var table = $('#mydata').DataTable( {
             ajax: {
                 url: "http://www.illengan.com/chef/get_orderlist",
                 dataSrc: ''
             },
		    colReorder: {
			realtime: true
		    },
            "aoColumns" : [
                {
                "className":      'details-control',
                "data":           null,
                "defaultContent": ''
                },
                {data : 'menu_name'},
                {data : 'cust_name'},
                {data : 'table_code'},
                {data : 'order_qty'},
                {
                    data: null,
                    render: function ( data, type, row, meta) {
                        return '<button id="status" class="status btn dt-buttons '+ data.item_status +
                        '" data-order_item_id="'+ data.order_item_id +'"'+
                        ' data-item_status="'+ data.item_status +'" onclick="change_status()">'+ data.item_status +'</button>';
                        }
                    }
		        ]
	        });

// FOR SHOWING THE ACCORDION
        $('#mydata tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
        
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );
        
            table.rows().every( function () {
                var tr = $(this.node());
                this.child(format(table.row(tr).data())).show();
                tr.addClass('shown');
                });

            
} );

function change_status() {
    $('.status').on('click', function() {
        var orderItemId = $(this).data("order_item_id");
        var itemStatus = $(this).data("item_status");
        var item_status;

        if(itemStatus === "pending") {
            item_status = "ongoing";
        } else if(itemStatus === "ongoing") {
            item_status = "done";
        } else if(itemStatus === "done") {
            item_status = "pending";
        }
    
        // AJAX CODE FOR POSTING NEW STATUS
        $.ajax({
        type: 'POST',
        url: 'http://www.illengan.com/chef/change_status',
        data: {
            order_item_id: orderItemId,
            item_status: item_status
        },
        success: function() {
            table.DataTable().ajax.reload(null, false);
        }
            }); 
 
        });
}