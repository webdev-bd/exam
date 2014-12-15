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
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header"><?php echo (!empty($title))?$title:'';?></h3>
            </div>
            <div class="porlets-content" style="display: block;">
                <?php $attributes = array('class' => 'form-horizontal row-border');echo form_open_multipart('administrator/update_category', $attributes); ?>  
                  
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" name="cat_title" required="required" value="<?php echo $single_cat->cat_title;?>">
                      <input type="hidden" name="id" required="required" value="<?php echo $single_cat->cat_id;?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                      <textarea  name="cat_discription" class="form-control"><?php echo $single_cat->cat_discription;?></textarea>
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
              <h3 class="content-header">All Category</h3>
            </div>
              <div class="porlets-content">
                  <div class="table-responsive">
                  <table class="myList table table-bordered">
                      <tr>
                          <th>Name</th>
                          <th>Total Products</th>
                          <th>Action</th>
                      </tr>
                      <?php foreach ($category as $item):?>
                      <tr>
                          <td><?php echo $item->cat_title;?></td>
                          <td><b class="badge bg-danger"><?php echo $item->cat_counter;?></b></td>
                          <td><a class="btn btn-success" href="<?php echo base_url()?>administrator/edit_category/<?php echo $item->cat_id;?>"><i class="fa fa-pencil"></i> Edit</a></td>
                      </tr>
                      <?php if(!empty($item->sub)):?>
                        <?php foreach ($item->sub as $item2):?>
                      <tr>
                          <td class="subCat"><?php echo $item2->cat_title;?></td>
                          <td><b class="badge bg-danger"><?php echo $item2->cat_counter;?></b></td>
                          <td><a class="btn btn-success" href="<?php echo base_url()?>administrator/edit_category/<?php echo $item2->cat_id;?>"><i class="fa fa-pencil"></i> Edit</a></td>
                      </tr>
                      <?php endforeach; endif;?>
                     <?php endforeach; ?>
                  </table>
                  </div>     
                  
            </div><!--/porlets-content--> 
          </div><!--/block-web--> 
        </div><!--/col-md-6--> 
      </div>
      
      
   </div>
</div>
