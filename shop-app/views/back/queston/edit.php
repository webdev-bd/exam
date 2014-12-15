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
              <h3 class="content-header"><?php echo (!empty($title))?$title:'';?></h3>
            </div>
            <div class="porlets-content" style="display: block;">
                <?php $attributes = array('class' => 'row-border');echo form_open_multipart('administrator/update_question', $attributes); ?>  
                  
                <div class="form-group">
                  <label  class="control-label">Category</label>
                  <select name="queston[category]" required="required" class="form-control">
                      <?php foreach ($categorys as $item):
                                $select = ($question->category==$item->id) ? 'selected="selected"' : "";
                                echo "<option {$select} value='{$item->id}'>{$item->name}</option>";
                            endforeach;
                       ?>
                  </select>
                  
                </div>
                <div class="form-group">
                  <label  class="control-label">Title</label>
                  <textarea name="queston[title]"  required="required" class="form-control"><?php echo $question->title; ?></textarea>
                  <input type="hidden" name="queston[id]"  required="required" class="form-control" value="<?php echo $question->id; ?>" >
                </div>
                <div class="form-group">
                    <label  class="control-label">Question <span style="font-size: 12px; font-style: italic;">(Optional) Only for PHP code</span></label>
                  <textarea name="queston[question]" style="height: 250px;" class="form-control"><?php echo $question->question; ?></textarea>
                </div>
                
                
                <div class="bottom">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div><!--/form-group-->
              </form>
            </div><!--/porlets-content-->
          <div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div><div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div><!--/block-web--> 
        </div><!--/col-md-6-->
      </div>
   </div>
</div>
