<div class="main-content">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <?php echo $message; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="block-web">
                    <div class="header" style="border: none; margin-top: 5px;">
                        <h3 class="content-header"><?php  echo $question->title;?></h3>
                    </div>
                    <div class="porlets-content" style="display: block;">
                        <div class="que_title">
                        </div>
                        <div class="que_single view_pre">
                        <?php  echo (!empty($question->question)) ? "<pre>{$question->question}</pre>" : '';?>
                            <input type="hidden" value="<?php echo (isset($question->id)) ? $question->id :'';?>" id="q_id" >
                        </div>
                        
                    </div><!--/porlets-content-->
                    <div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div><div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div><!--/block-web--> 
            </div><!--/col-md-6-->
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="block-web">
                    <div class="porlets-content">
                        <div class="practice">
                         <?php
                        if(!empty($answers)):  
                    foreach ($answers as $key=>$item):?>
                            <div class="ckbox ckbox-primary">
                                <input type="checkbox" name="queston[<?php echo $key;?>][right]" id="checkboxPrimary<?php echo $key;?>"  vstyle="padding-left: 40px;" alue="1">
                                <label for="checkboxPrimary<?php echo $key;?>"><?php echo (isset($item->answer)) ? $item->answer :'';?></label>
                            </div>
                    <?php endforeach;  ?>
                    </div>
                    <?php else:
                            echo '<h3>No Reseller Found!</h3>'; 
                        endif;
                    ?>
                    </div><!--/porlets-content-->
                    <div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div><div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div><!--/block-web--> 
            </div><!--/col-md-6-->
        </div>
        <a class="btn-info btn" href="<?php echo base_url();?>administrator/practice">Next</a>
        
    </div>
</div>
<script>
$('.practiceAns').click( function(){
    $(this).css('border', '1px solid violet')
//   var request = $.ajax({
//        type: "POST",
//        url: baseUrl+"administrator/practice_check",
//        data: { ans: $(this).attr('title'), id: $('#q_id').val()},
//        dataType: "html"
//    });
//    request.done(function( res ) {
//        $('.practice').html(res);
//    });

});

</script>  