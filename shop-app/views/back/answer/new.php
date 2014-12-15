<div class="main-content">
  <div class="page-content">
      <div class="row">
        <div class="col-md-12">
          <?php echo $message;?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
                <div class="actions">
                    <a class="fa fa-plus-square addQueBtn pull-right" tabindex="<?php echo (!empty($answers)) ? sizeof($answers) : 2;?>" ></a>
                </div>
              <h3 class="content-header"><?php echo (!empty($title))?$title:'';?></h3>
            </div>
            <div class="porlets-content" style="display: block;">
                <?php $attributes = array('class' => 'form-horizontal AnswerForm row-border');echo form_open_multipart('administrator/save_answer', $attributes); ?>  
                <div  id="ansHolder">
                    <input type="hidden" name="que_id" value="<?php echo (isset($question->id)) ? $question->id : '';?>">
                    <?php
                    if(!empty($answers)):
                    $i=1;
                    foreach ($answers as $key=>$item):?>
                    <div class="form-group addAnsList">
                        <div class="col-sm-2">
                            <div class="ckbox ckbox-primary">
                                <input type="checkbox" name="queston[<?php echo $key;?>][right]" id="checkboxPrimary<?php echo $i;?>"  <?php echo ($item->status==1) ? 'checked="checked"' : '';?> vstyle="padding-left: 40px;" alue="1">
                                <label for="checkboxPrimary<?php echo $i;?>">Right answer</label>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <input name="queston[<?php echo $key;?>][title]"  required="required" value="<?php echo (isset($item->answer)) ? $item->answer :'';?>"  class="form-control">
                            <input type="hidden" name="queston[<?php echo $key;?>][id]"  required="required" value="<?php echo (isset($item->id)) ? $item->id :'';?>">
                        </div>
                        <div class="col-sm-1">
                            <a class="fa fa-trash-o removeQueBtnFormbd" tabindex="<?php echo (isset($item->id)) ? $item->id :'';?>"></a>
                        </div>
                    </div>
                    <?php 
                    $i++;
                    endforeach;  
                    else :
                    ?>
                    <div class="form-group addAnsList">
                        <div class="col-sm-2">
                            <div class="ckbox ckbox-primary">
                                <input type="checkbox" name="queston[1][right]"  id="checkboxPrimary1" vstyle="padding-left: 40px;" alue="1">
                                <label for="checkboxPrimary1">Right answer</label>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <input name="queston[1][title]"  required="required"  class="form-control" tabindex="1">
                        </div>
                        <div class="col-sm-1">
                        </div>
                    </div>
                    <div class="form-group addAnsList">
                        <div class="col-sm-2">
                            <div class="ckbox ckbox-primary">
                                <input type="checkbox" name="queston[2][right]"  id="checkboxPrimary2" vstyle="padding-left: 40px;" alue="1">
                                <label for="checkboxPrimary2">Right answer</label>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <input name="queston[2][title]"  required="required"  class="form-control" tabindex="2">
                        </div>
                        <div class="col-sm-1">
                        </div>
                    </div>
                   
                    <?php
                    endif;
                    ?>
                    
                </div>
                <div class="bottom">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div><!--/form-group-->
              </form>
            </div><!--/porlets-content-->
          <div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div><div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div><!--/block-web--> 
          <?php
          
          //echo highlight_string(' ');
          ?>
          
        </div><!--/col-md-6-->
      </div>
       <div class="row">
            <div class="col-md-12">
                <div class="block-web">
                    <div class="header">
                        <div class="actions"><a href="<?php echo base_url()?>administrator/edit_question/<?php echo (isset($question->id)) ? $question->id : '';?>"><i class="fa fa-edit header_icon"></i></a></div>
                        <h3 class="content-header">Question</h3>
                    </div>
                    <div class="porlets-content" style="display: block;">
                        <div class="que_title">
                        <?php  echo $question->title;?>
                        </div>
                        <div class="que_single view_pre">
                        <?php  echo (!empty($question->question)) ? "<pre>{$question->question}</pre>" : '';?>
                        </div>
                        
                    </div><!--/porlets-content-->
                    <div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div><div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div><!--/block-web--> 
            </div><!--/col-md-6-->
        </div>
   </div>
</div>
  