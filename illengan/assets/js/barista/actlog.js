$(document).ready(function() {
    var table = $('#mydata').DataTable( {
             ajax: {
                 url: "http://www.illengan.com/admin/activitylog",
                 dataSrc: ''
             },
		    colReorder: {
			realtime: true
		    },
            "aoColumns" : [
                {data : 'actlog_date'},
                {
                    data: null,
                    render: function ( data, type, row, meta) {
                        return data.aType+' '+lowerLetter(data.actlog_type)+'ed in the '+data.actlog_desc;
                        }
                    }
		        ]
	        });
            
} );

function lowerLetter(string) {
    return string.charAt(0).toLowerCase() + string.slice(1);
}

