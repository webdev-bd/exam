<section class="homepage-bg">    
    <div class="container" id="whatsNew">
        <div class="breadcrumbs">
            <ul>
                <li><a href="<?php base_url(); ?>">Home</a></li>
                <li><a href="<?php base_url(); ?>/category/<?php echo $single->cat_slug; ?>"><?php echo $single->cat_title; ?></a></li>
                <li><?php echo $single->title; ?></li>
            </ul>
        </div>
        <div class="fullWidht">
            <div id="SingleContainer" class="col-lg-9">
                <div class="singleLeft">
                    <?php if (!empty($single->images)): ?>
                    <div class="clearfix singleZoomBox">
                        <a href="<?php echo base_url(); ?>/upload/products/full/<?php echo $single->images[0]->pi_name; ?>" class="jqzoom" rel='gal1'  title="<?php echo $single->title; ?>" >
                            <img src="<?php echo base_url(); ?>/upload/products/single/<?php echo $single->images[0]->pi_name; ?>"  title="<?php echo $single->title; ?>">
                        </a>
                    </div>
                    <ul id="thumblist" class="clearfix" >
                        <?php foreach ($single->images as $key => $item): ?>
                            <li><a <?php echo ($key == 0) ? 'class="zoomThumbActive"' : ''; ?>  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo base_url(); ?>/upload/products/single/<?php echo $item->pi_name; ?>',largeimage: '<?php echo base_url(); ?>/upload/products/full/<?php echo $item->pi_name; ?>'}"><img src='<?php echo base_url(); ?>/upload/products/thumbs/<?php echo $item->pi_name; ?>'></a></li>
                        <?php endforeach; ?>
                    </ul>
                   <?php  else:?>     
                    <img src="<?php echo base_url(); ?>/upload/products/single/empty.jpg">
                   <?php endif; ?>
                </div>
                <div class="singleRight">
                    <h1><?php echo $single->title; ?></h1>
                    <div class="ShortDiscription"><?php echo $single->discription; ?></div>
                    <div class="fullWidht">
                        <div class="code pull-left">Code No: <span><?php echo $single->id; ?></span></div>
                        <div class="avail pull-right">Availability: <span>In stock</span></div>
                    </div>
                    <div class="PriceAddCart fullWidht">
                        <h3>TK <?php echo $single->price;?></h3>
                        <a class="AddToCart">Call For Order</a>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-3">
                <h3 class="right_title"><span class="red">Most</span> Popular</h3>
                <?php echo (isset($_bestSellerRight))? $_bestSellerRight:'';?> 
            </div>

        </div>


        <div class="displayGrid fullWidht">
            <h3 class="home_title"><span class="red">Related</span> Products</h3>
            <?php echo (isset($_whats_new)) ? $_whats_new : ''; ?>
        </div>

    </div> 
</section>
<link href="<?php echo base_url(); ?>css/plugin/jquery.jqzoom.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>js/plugin/jquery.jqzoom-core.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens: true,
            preloadImages: false,
            alwaysOn: false
        });

    });


</script>