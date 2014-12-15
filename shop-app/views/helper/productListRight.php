<?php foreach ($product as $key=>$item): if($key<4): ?>
    <div class="RightProductItem">
        <div class="RightProductImg">
            <?php if (!empty($item->images)): ?>
                <img src="<?php echo base_url(); ?>/upload/products/thumbs/<?php echo $item->images[0]->pi_name; ?>">
            <?php else: ?>
                <img src="<?php echo base_url(); ?>/upload/products/thumbs/empty.jpg">
            <?php endif; ?>
        </div>
        <div class="RightProductText">
            <h3><h3><?php 
                if (isset($item->title)):

                    if (strlen($item->title) > 15):

                        echo substr($item->title, 0, 13).'..';
                    else:
                        echo $item->title;
                    endif;

                endif;?></h3></h3>
            <h4>Tk. <?php echo (isset($item->price)) ? $item->price : ''; ?></h4>
            <a href="<?php echo base_url();?>product/<?php echo $item->slug;?>">Details</a>
        </div>
    </div>
<?php endif; endforeach; 