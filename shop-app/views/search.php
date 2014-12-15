<section class="homepage-bg">    
    <div class="container" id="whatsNew">
        <div class="breadcrumbs">
            <ul>
                <li><?php echo $title; ?></li>
            </ul>
        </div>
        <div class="fullWidht">
            <div id="SingleContainer" class="col-lg-9">
                   <?php echo (!empty($SerachResult))? $SerachResult:'<h3 class="sResult">No Product Found!</h3>';?> 
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