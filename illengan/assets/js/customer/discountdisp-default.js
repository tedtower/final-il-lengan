promos();

function hide_freebies() {
    $('.please').hide();
    var elements = document.getElementsByClassName('freeBOpt');
                    while(elements.length > 0){
                        elements[0].parentNode.removeChild(elements[0]);
                    }
    var free_elements = document.getElementsByClassName('freebieQty');
                    while(free_elements.length > 0){
                        free_elements[0].parentNode.removeChild(free_elements[0]);
                    }

}

function promos() {
    $(document).ready(function() {
        $.ajax({
            url: 'http://www.illengan.com/customer/promos',
            dataType : 'json',
            success: function(data) {
                var i, d_menu_id, menu_id;
                $('.indicate_promo').hide();

                for(i = 0; i < data.length ; i++) {
                    if(data[i].promo_id != null) {
                    d_menu_id = data[i].menu_id; // Ito yung menu id na galing sa database
                    menu_id = document.getElementById(d_menu_id); // kinuha ko yung div na yon gamit yung value ng id
                    $('.' + d_menu_id).show();
                    }     
                }
                },
              failure: function() {
                  alert('There are no current discounts for today.');
              } 
                
            });
                }); 
     
            };

function freebies_discounts() {  
    $(document).ready(function() {
        var e = document.getElementById("sizeSelect");
        var v_pref_id, v_quantity;

        v_quantity = document.getElementById('quantity').value;
        
        try {
            v_pref_id = e.options[e.selectedIndex].value;
        } catch(err) {
            v_pref_id = $('#sizeInput').attr('value');
        }

        console.log('Latest View Qty Entered: ' + v_quantity + ' PrefId ' + v_pref_id);
        $.ajax({
            type: 'POST',
            url: 'http://www.illengan.com/customer/freebies_discounts',
            data: {
            pref_id: v_pref_id
            }, 
            dataType: 'json',
         success: function(data) {
             var freeBQty, freebieDrop;
         
                if(v_quantity >= data[0].pc_qty && data[0].elective == 1){
                    freeBQty = data[0].fb_qty * parseInt(v_quantity / data[0].pc_qty);
                    //console.log('Total Freebies(Early): ' + freeBQty + ' | View Qty Entered: ' + v_quantity + ' | Constraint: ' + data[0].pc_qty);
                    $('.please').show();
                    var appendDivs = []; 

                for(var i = 0; i <= freeBQty - 1; i++ ) {
                    count = i+1;
                    appendDivs.push('<select class="freeBOpt browser-default custom-select"><option>Freebie '+count+'</option></select>');

                }
                var elements = document.getElementsByClassName('freeBOpt');
                    while(elements.length > 0){
                        elements[0].parentNode.removeChild(elements[0]);
                    }

                $('#freebie').append(appendDivs);
                
                try {
                for(var i = 0; i <= data.length; i++) {
                    optionsFB = '<option>'+data[i].fb_menuname+'</option>';
                    console.log(optionsFB);
                    $('.freeBOpt').append(optionsFB);
                }
                } catch(err) {

                }
                console.log('Total Freebies(Late): ' + freeBQty + ' data[0].menu_name ' + appendDivs.length);
                    
                       
                }
                // For freebie promos which have different freebie offers
               else if(v_quantity >= data[0].pc_qty && data[0].elective == 0) {
                var free_elements = document.getElementsByClassName('freebieQty');
                while(free_elements.length > 0){
                    free_elements[0].parentNode.removeChild(free_elements[0]);
                }

                freeBQty = data[0].fb_qty * parseInt(v_quantity / data[0].pc_qty);
                $('#freebie').append('<p class="freebieQty">You have '+freeBQty+' '+data[0].menu_name+' for a freebie!</p>');

               }
             
         },
         failure: function() {
            console.log('OH NO');

         }
        });
    });
}
