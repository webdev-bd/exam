<?php foreach ($product as $item): ?>
    <div class="product_item">
        <div class="gridImg">
            <?php if (!empty($item->images)): ?>
                <img src="<?php echo base_url(); ?>/upload/products/medium/<?php echo $item->images[0]->pi_name; ?>">
            <?php else: ?>
                <img src="<?php echo base_url(); ?>/upload/products/medium/empty.jpg">

            <?php endif; ?>

        </div>
        <div class="gridText">
            <h3><?php 
                if (isset($item->title)):

                    if (strlen($item->title) > 22):

                        echo substr($item->title, 0, 20).'..';
                    else:
                        echo $item->title;
                    endif;

                endif;?></h3>
            <h4>Tk. <?php echo (isset($item->price)) ? $item->price : ''; ?></h4>
            <a href="<?php echo base_url();?>product/<?php echo $item->slug;?>">Details</a>
        </div>
    </div>
<?php endforeach; 