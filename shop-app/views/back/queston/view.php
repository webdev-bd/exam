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
                        <h3 class="content-header"><?php echo (!empty($title)) ? $title : ''; ?></h3>
                    </div>
                    <div class="porlets-content">
                    <?php
                        if(!empty($questions)):?>
                    <table class="myList table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Created</th>
                          <th>Status</th>
                      </tr>   
                      </thead>
                      <tbody>
                    <?php
                    foreach ($questions as $item):?>
                         <tr>
                            <td><?php echo (isset($item->id)) ? $item->id : '';?></td>
                            <td><?php
                            $url =  base_url()."administrator/single_question/".$item->id;
                            echo (isset($item->title)) ? "<a href='{$url}'>" . $item->title . '</a>' :'';?></td>
                            <td><?php echo (isset($item->category)) ? $item->category :'';?></td>
                            <td><?php echo (isset($item->create_date)) ? $item->create_date : '';?></td>
                            <td><?php echo ($item->status==0) ? '<b class="badge bg-danger">Unpublished</b>' : '<b class="badge bg-success">Published</b>';?></td>
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
   
