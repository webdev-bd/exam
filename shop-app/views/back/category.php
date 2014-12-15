<div class="main-content">
  <div class="page-content">
      <div class="row">
        <div class="col-md-12">
          <?php echo $message;?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="block-web">
            <div class="header">
              <h3 class="content-header"><?php echo (!empty($title)) ? $title:'';?></h3>
            </div>
            <div class="porlets-content" style="display: block;">
                <?php $attributes = array('class' => 'form-horizontal newRecharge row-border');echo form_open_multipart('administrator/save_category', $attributes); ?>  
                <div class="form-group">
                  <label class="col-sm-3 control-label">Parent</label>
                  <div class="col-sm-9">
                      <select name="category[parent]" class="chosen-select form-control">
                          <option value="1">PHP</option>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" name="category[name]"  required="required" value="<?php echo set_value('category[name]'); ?>">
                  </div>
                </div>
                <div class="bottom">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div><!--/form-group-->
              </form>
            </div><!--/porlets-content-->
          <div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div><div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div><!--/block-web--> 
        </div><!--/col-md-6-->
        
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
      </div>
   </div>
</div>
