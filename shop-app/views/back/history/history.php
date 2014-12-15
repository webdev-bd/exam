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
                        <div class="actions"><a href="<?php echo base_url()?>administrator/history"><i class="fa fa-refresh fa-spin"></i></a></div>
                        <h3 class="content-header">Search</h3>
                    </div>
                    <div class="porlets-content" style="display: block;">
                        <?php $attributes = array('class' => 'form-horizontal searchForm  row-border', 'method' => 'get');
                        echo form_open_multipart('administrator/history', $attributes); ?>  

                        <div class="form-group">
                            <div class="box1">
                                <label class="control-label">Number</label>
                                <input type="text" class="form-control" name="search[number]"  maxlength="11" value="<?php echo (isset($number))?$number:''; ?>" >
                            </div>
                            <div class="box2">
                                <label class="control-label">Date</label>
                                <div class="SearchByDateInput">
                                    <input name="search[start]" class="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo (isset($start)) ? $start:''; ?>"> To 
                                    <input name="search[end]" class="datepicker" data-date-format="yyyy-mm-dd"   value="<?php echo (isset($end)) ? $end:''; ?>">
                                </div>
                            </div>
                            <div class="box1">
                                <label class="control-label">Status</label>
                                <select  name="search[status]" class="form-control" >
                                    <option value="20" <?php echo (isset($status)) ? $status : 'selected="selected"'; ?>>All</option>
                                    <option value="0" <?php echo (isset($status) && $status==0 ) ? 'selected="selected"':''; ?>>Pending</option>
                                    <option value="1" <?php echo (isset($status) && $status==1 ) ? 'selected="selected"':''; ?>>Success</option>
                                    <option value="4" <?php echo (isset($status) && $status==4 ) ? 'selected="selected"':''; ?>>Waiting</option>
                                    <option value="2" <?php echo (isset($status) && $status==2 ) ? 'selected="selected"':''; ?>>Failed</option>
                                </select>
                            </div>
                            <div class="box1">
                                <label class="control-label">Operator</label>
                                <select  name="search[operator]" class="form-control" >
                                    <option value="" <?php echo (isset($operator)) ? $operator : 'selected="selected"'; ?>>All</option>
                                    <option value="gp" <?php echo (isset($operator) && $operator=="gp" ) ? 'selected="selected"':''; ?>>GP</option>
                                    <option value="blink" <?php echo (isset($operator) && $operator=="blink" ) ? 'selected="selected"':''; ?>>Bnaglalink</option>
                                    <option value="robi" <?php echo (isset($operator) && $operator=="robi" ) ? 'selected="selected"':''; ?>>Robi</option>
                                    <option value="airtel" <?php echo (isset($operator) && $operator=="airtel" ) ? 'selected="selected"':''; ?>>Airtel</option>
                                    <option value="teletalk" <?php echo (isset($operator) && $operator=="teletalk" ) ? 'selected="selected"':''; ?>>Teletalk</option>
                                    <option value="citycell"  <?php echo (isset($operator) && $operator=="citycell" ) ? 'selected="selected"':''; ?>>Citycell</option>
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
                        <?php 
                        if(!empty($History)):
                        ?>
                        <h3 style="float: left;" class='content-header'>History</h3>
                        <ul class="historyTop">
                            <li>Recharge: <b class="label label-primary"><?php echo $Summery['totalRecharge'];?></b></li>
                            <li>Amount: <b class="label label-default"><?php echo $Summery['totalAmount'];?></b></li>
                            <li>Failed: <b class="label label-danger"><?php echo $Summery['totalFaild'];?></b></li>
                            <li>Waiting: <b class="label label-warning"><?php echo $Summery['totalWaiting'];?></b></li>
                            <li>Pending: <b class="label label-info"><?php echo $Summery['totalPending'];?></b></li>
                            <li>Success: <b class="label label-success"><?php echo $Summery['totalSuccess'];?></b></li>
                        </ul>
                        <?php endif;?>
                    </div>
                    <div class="porlets-content">
                    <?php
                        if(!empty($History)):?>
                    <table class="myList table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Soft ID</th>
                          <th>Entry Date</th>
                          <th>Operator</th>
                          <th>Topup Number</th>
                          <th>Member ID</th>
                          <th>Status</th>
                          <th>Status Date</th>
                          <th>Flexi Amount</th>
                          <th>Operator Amount</th>
                          <th>Operator Replay</th>
                      </tr>   
                      </thead>
                      <tbody>
                    <?php foreach ($History as $item):
                        
                        echo '<pre>';
                        print_r($item);
                        ?>
                            
                         <tr>
                             <td><?php echo (isset($item->id)) ? $item->id :'';?></td>
                             <td><?php echo (isset($item->submitted_date)) ?  date('m/d/Y h:i A', strtotime($item->submitted_date)) :'';?></td>
                             <td><?php echo (isset($item->operator)) ? $item->operator :'';?></td>
                             <td><?php echo (isset($item->phone)) ? $item->phone :'';?></td>
                             <td><?php echo (isset($item->user_id)) ? $item->user_id :'';?></td>
                             <td class="statusChange"><?php 
                                switch ($item->status):
                                    case 0:
                                        echo '<b class="label label-info">Pending</b> ';
                                        echo "<a title='{$item->id}' type='f' class='label label-default'>Failed</a> ";
                                        echo " <a title='{$item->id}' type='s' class='label label-default'>Success</a>";
                                        break;
                                    case 1:
                                        echo '<b class="label label-success">Success</b> ';
                                        echo " <a title='{$item->id}' type='f' class='label label-default'>Failed</a>";
                                        break;
                                    case 4:
                                        echo '<b class="label label-warning">Waiting</b> ';
                                        echo " <a title='{$item->id}' type='f' class='label label-default'>Failed</a>";
                                        break;
                                    case 2:
                                        echo '<b class="label label-danger">Failed</b> ';
                                        echo " <a title='{$item->id}' type='s' class='label label-default'>Success</a>";
                                        break;
                                    default :
                                        echo ' <b class="label label-default">Undefind</b>';
                                        break;        

                                endswitch;
                           ?></td>
                             <td><?php echo (isset($item->datetime)) ? $item->datetime :'';?></td>
                             <td><b   class="badge bg-danger"><?php echo $item->balance;?></b></td>
                             <td><?php echo (isset($item->updateBalance)) ? $item->updateBalance :'';?></td>
                             <td><?php echo (isset($item->msgbody)) ?  substr($item->msgbody, 0 , 48):'';?></td>
                             
                             
<!--                             <td><?php echo (isset($item->load_type)) ? $item->load_type :'';?></td>
                             <td><?php echo (isset($item->transactionid)) ? $item->transactionid :'';?></td>
                             <td><?php echo (isset($item->loginname)) ? $item->loginname :'';?></td>-->
                             
                      </tr>
                    <?php endforeach;  ?>
                    </tbody>
                    </table>
                    <?php else:
                            echo '<h3>No Recharge Found!</h3>'; 
                        endif;
                    ?>
                        
                    </div><!--/porlets-content-->
                    <div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div><div class="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div></div><!--/block-web--> 
            </div><!--/col-md-6-->
        </div>
        

    </div>
</div>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker();
        $('.statusChange a').click( function (){
           var type = $(this).attr('type');
           var id = $(this).attr('title');
           var target = $(this).closest('.statusChange');
           
            var request = $.ajax({
            url: baseUrl + "administrator/changeStatus",
            type: "POST",
            data: { id : id, type : type  },
            dataType: "html"
            });
            request.done(function( data ) {
                $(target).html(data);
            });
        });
    });
</script>    