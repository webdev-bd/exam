<section class="header-bg">
    <div id="header" class="container">
        <div class="col-lg-4 logo">
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>/images/logo.png"></a>
        </div>
        <div class="col-lg-5 HeadSearchMenu">
            <div class="headMenu">
                <ul>
                    <li><a href="#">Log In</a></li>
                    <li><a href="#">Sign Up!</a></li>
                </ul>
            </div>
            <div class="headSearch">
                <?php echo form_open('search', array('method'=>'get')); ?>  
                <input type="text" class="form-control" name="value" required="required" placeholder="What are you looking for ..." >
                <input type="submit" value="" class="HeadSearchBtn">
                </form>
            </div>
        </div>
        <div class="col-lg-3 HeadCartNumber pull-right">
            <h2>+88 01923484442</h2>
            <div class="CartHead">
                <span class="cartIcon">Cart:</span>  <span id="HeadCartItem">0</span> item(s) - Tk.<span id="HeadCartTotal">0.00</span>
            </div>
        </div>
    </div>
</section>

 