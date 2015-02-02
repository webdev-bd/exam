<div class="main-content">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <?php echo $message; ?>
            </div>
        </div>
        <div class="col-md-6">
          <div class="block-web">
            <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Category</h3>
            </div>
              <div class="porlets-content">
                  <div class="table-responsive">
                      <?php if(!empty($categorys)):?>
                  <table class="myList table table-bordered">
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                      </tr>
                      <?php
                      foreach ($categorys as $item):?>
                      <tr>
                          <td><?php echo $item->id;?></td>
                          <td><?php echo $item->name;?></td>
                      </tr>
                     <?php endforeach; ?>
                  </table>
                      <?php else: echo '<h3>No Recharge Found!</h3>';                      endif;?>
                  </div>     
                  
            </div><!--/porlets-content--> 
          </div><!--/block-web--> 
        </div><!--/col-md-6--> 
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
        <div class="row">
            <div class="col-md-12">
                <a class="btn-info btn" href="javascript:void(0)" id="answer_practice">Answer</a>
        <a class="btn-info btn pull-right" href="<?php echo base_url();?>administrator/practice">Next</a>
            </div>
        </div>    
        
    </div>
</div>
 