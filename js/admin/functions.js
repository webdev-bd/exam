$(document).ready(function() {
    
    if ($('#answer_practice').length > 0) {
        $('#answer_practice').click( function(){
            $('.ans label').css('color', 'violet');

           var request = $.ajax({
                type: "POST",
                url: baseUrl+"administrator/practice_check",
                data: { ans: $(this).attr('title'), id: $('#q_id').val()},
                dataType: "json"
            });
            request.done(function( res ) {
                $.each( res, function(i, n){
                        if(n==1){
                            $('.'+i+ ' label').css('color', '#46b8da');
                        }
                });
            });
        });
    } 
    
});

