(function ($) {
    $(document).ready(function () {
     
     $('.sidebar-toggle-box').click( function (){
         $('#sidebar').toggleClass('show-left-bar');
         $('.main-content').toggleClass('positionL0');
     })
    if($('#ansHolder').length>0){
        
        $('.addQueBtn').click(function() {
            var _lenghtCounter = $(this).attr('tabindex');
            if (_lenghtCounter < 10) {
                _lenghtCounter++;

                var _html = '<div class="form-group addAnsList"><div class="col-sm-2"><div class="ckbox ckbox-primary"><input type="checkbox" name="queston[' + _lenghtCounter + '][right]" id="checkboxPrimary' + _lenghtCounter + '" vstyle="padding-left: 40px;"alue="1"><label for="checkboxPrimary' + _lenghtCounter + '">Right answer</label></div></div><div class="col-sm-9"><input tabindex="' + _lenghtCounter + '" name="queston[' + _lenghtCounter + '][title]"  required="required"  class="form-control"></div><div class="col-sm-1"><a class="fa fa-trash-o removeQueBtn" href="#"></a></div></div>';
                $('#ansHolder').append(_html);
                $(this).attr('tabindex', _lenghtCounter);
                removerQue();

            }
        });
        function removerQue() {
            $('.removeQueBtn').click(function() {
                $(this).closest('.addAnsList').hide(4000).remove();
            });
        }
        $('.removeQueBtnFormbd').click(function() {
        var id = $(this).attr("tabindex");
        var request = $.ajax({
            url: baseUrl+"administrator/delate_answer/",
            type: "POST",
            data: {id: id},
            dataType: "html"
        });
        request.done(function(msg) {
            //$("#log").html(msg);
        });
            $(this).closest('.addAnsList').hide(4000).remove();
        });
        
        
    } 
  
    });
})(jQuery);