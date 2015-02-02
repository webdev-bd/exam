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
              <h3 class="content-header">Select A Category</h3>
            </div>
              <div class="porlets-content">
                  <div class="table-responsive">
                      <?php if(!empty($categorys)):?>
                  <table class="myList table table-bordered">
                      <?php
                      foreach ($categorys as $item):?>
                      <tr>
                          <td><a href="<?php echo base_url()."question/practice_cat/{$item->id}";?>"><?php echo $item->name;?></a></td>
                      </tr>
                     <?php endforeach; ?>
                  </table>
                      <?php else: echo '<h3>No Recharge Found!</h3>';                      endif;?>
                  </div>     
                  
            </div><!--/porlets-content--> 
          </div><!--/block-web--> 
        </div><!--/col-md-6--> 
           
        
    </div>
</div>
 