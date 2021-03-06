<div class="main-content">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <?php echo $message; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
            <div class="col-md-12">
                <div class="block-web">
                    <div class="porlets-content">
                        <div class="practice">
                         <?php
                        if(!empty($answers)):  
                    foreach ($answers as $key=>$item):?>
                            <div class="ckbox ckbox-primary ans <?php echo $item->id;?>">
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
         <?php  
                $output =NULL;
                $next= NULL;
                $next_id= NULL;
                $i = 1;
                foreach ($ids as $id_item):
                    $url_b= base_url();
                    $output .= ($question->id != $id_item->id) ? "<a class='btn-info btn' href='{$url_b}question/practice_cat/{$question->category}/{$id_item->id}'>{$i}</a>" : "<a class='btn-default btn cur_d' href='{$url_b}question/practice_cat/2/{$id_item->id}'>{$i}</a>"  ;
                    if($next != NULL){
                        $next_id =  $id_item->id;
                        $next = NULL;
                    }
                    $next = ($question->id == $id_item->id) ? 1 : NULL;
                    
                    $i++;
                endforeach;
                
                ?>
        
        <div class="row">
            <div class="col-md-12">
                <a class="btn-info btn" href="javascript:void(0)" id="answer_practice">Answer</a>
                <?php if($next_id != NULL):?>
                        <a class="btn-info btn pull-right" href="<?php echo base_url();?>question/practice_cat/<?php echo "{$question->category}/{$next_id}";?>">Next</a>
                <?php endif;?>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-12" id="pagination_Ids">
                <?php echo $output;?>
            </div>
        </div>    
        
    </div>
</div>
 