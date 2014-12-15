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
                    <div class="header">
                        <div class="actions"><a href="<?php echo base_url()?>administrator/edit_question/<?php echo (isset($question->id)) ? $question->id : '';?>"><i class="fa fa-edit header_icon"></i></a></div>
                        <h3 class="content-header">Single Question</h3>
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
        <div class="row">
            <div class="col-md-10">
                <div class="block-web">
                    <div class="header">
                        <div class="actions"><a href="<?php echo base_url()?>administrator/answers/<?php echo (isset($question->id)) ? $question->id : '';?>"><i class="fa fa-edit header_icon"></i></a></div>
                        <h3 class="content-header">Answers</h3>
                    </div>
                    <div class="porlets-content">
                        
                         <?php
                        if(!empty($answers)):?>
                    <table class="myList table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Status</th>
                      </tr>   
                      </thead>
                      <tbody>
                    <?php
                    foreach ($answers as $item):?>
                            
                         <tr>
                            <td><?php echo (isset($item->id)) ? $item->id :'';?></td>
                            <td width="80%"><?php echo (isset($item->answer)) ? $item->answer :'';?></td>
                            <td><?php echo ($item->status==0) ? '<b class="badge bg-danger">Wrong</b>' : '<b class="badge bg-success">Right</b>';?></td>
                      </tr>
                    <?php endforeach;  ?>
                    </tbody>
                    </table>
                    <?php else:
                            echo '<h3>No Reseller Found!</h3>'; 
                        endif;
                    ?>

                    </div><!--/porlets-content-->
                    <div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div><div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div><!--/block-web--> 
            </div><!--/col-md-6-->
            
            
                   
        </div>
        
        


    </div>
</div>
   
