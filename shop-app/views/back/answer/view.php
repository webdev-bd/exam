<?php
if(!empty($_GET)){
    $setValue=  array_values($_GET);
    extract($setValue[0]);
}
?>
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
                        <div class="actions"><a href="<?php echo base_url()?>administrator/reseller"><i class="fa fa-refresh fa-spin"></i></a></div>
                        <h3 class="content-header">Search</h3>
                    </div>
                    <div class="porlets-content" style="display: block;">
                        <?php $attributes = array('class' => 'form-horizontal searchForm  row-border', 'method' => 'get');
                        echo form_open_multipart('administrator/reseller', $attributes); ?>  

                        <div class="form-group">
                            <div class="box1">
                                <label class="control-label">Number</label>
                                <input type="text" class="form-control" name="search[number]"  maxlength="11" value="<?php echo (isset($number))?$number:''; ?>" >
                            </div>
                       
                            <div class="box1">
                                <label class="control-label">Status </label>
                                <select name="search[status]"  class="form-control" >
                                    <option value="20" <?php echo (isset($status)) ? $status : 'selected="selected"'; ?>>All</option>
                                    <option value="0" <?php echo (isset($status) && $status==0 ) ? 'selected="selected"':''; ?>>Off</option>
                                    <option value="1" <?php echo (isset($status) && $status==1 ) ? 'selected="selected"':''; ?>>On</option>
                                </select>
                            </div>
                            <div class="box1">
                                <label class="control-label">Operator</label>
                                <select  name="search[reseller]" class="form-control" >
                                    <option value="" selected="selected" >Select</option>
                                    <option value="1" >Reseller 01</option>
                                    <option value="2">Reseller 02</option>
                                    <option value="3">Reseller 03</option>
                                    <option value="4">Reseller 04</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right" style="margin-right: 13px;">Search</button>
                        </div>
                        </form>
                    </div><!--/porlets-content-->
                    <div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div><div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div><!--/block-web--> 
            </div><!--/col-md-6-->
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="block-web">
                    <div class="header">
                        <h3 class="content-header"><?php echo (!empty($title)) ? $title : ''; ?></h3>
                    </div>
                    <div class="porlets-content">
                    <?php
                        if(!empty($Resellers)):?>
                    <table class="myList table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Join Date</th>
                          <th>Type</th>
                          <th>Balance</th>
                          <th>Status</th>
                          <th>Edit</th>
                      </tr>   
                      </thead>
                      <tbody>
                    <?php
                    
                    foreach ($Resellers as $item):?>
                            
                         <tr>
                            <td><?php echo (isset($item->loginname)) ? $item->loginname :'';?></td>
                            <td><?php echo (isset($item->full_name)) ? $item->full_name :'';?></td>
                            <td><?php echo (isset($item->email)) ? $item->email :'';?></td>
                            <td><?php echo (isset($item->address)) ? $item->address :'';?></td>
                            <td><?php echo (isset($item->create_date)) ? $item->create_date :'';?></td>
                            <td><?php echo (isset($item->custype)) ? "Reseller 0".$item->custype :'';?></td>
                            <td><b class="badge bg-danger"><?php echo $item->balance;?></b></td>
                            <td><?php echo ($item->status==0) ? '<b class="badge bg-danger">Off</b>' : '<b class="badge bg-success">ON</b>';?></td>
                            <td><a href="<?php echo base_url();?>administrator/register_edit/<?php echo (isset($item->id)) ? $item->id :'';?>"><i class="fa fa-edit"></i></a></td>
                      </tr>
                    <?php endforeach;  ?>
                    </tbody>
                    </table>
                    <?php else:
                            echo '<h3>No Reseller Found!</h3>'; 
                        endif;
                    ?>
                        
<!--                         <?php                    print_r($questions);
        
 foreach ( $questions as $item):
        echo '<pre>';
      echo $item->question;
     echo '</pre>';
 
 
    
 endforeach;
        ?>
                        <style>
                            pre {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 4px;
  color: #333;
  display: block;
  font-size: 16px;
  line-height: 1.42857;
  margin: 15px 0;
  padding: 15px;
  word-break: break-all;
  word-wrap: break-word;
}
                            
                        </style>-->


                    </div><!--/porlets-content-->
                    <div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div><div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div><!--/block-web--> 
            </div><!--/col-md-6-->
            
            
                   
        </div>
        
        


    </div>
</div>
   
