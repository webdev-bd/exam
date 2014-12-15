<div class="login-container">
  <div class="middle-login">
    <div class="block-web">
      <div class="head">
        <h3 class="text-center">Admin</h3>
      </div>
        <?php $attributes = array('id' => 'login_form');echo form_open('administrator/signin', $attributes); ?>
          <div class="content">
              <h4 class="title"><?php echo validation_errors() ; ?></h4>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="username" placeholder="Username" required="required" name="id">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="input-group"> <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" placeholder="Password" required="required" name="password">
                </div>
              </div>
            </div>
          </div>
        
       
          <div class="foot">
            <!--<a href="register.html"><button type="button" data-dismiss="modal" class="btn btn-default">Register</button></a>-->
            <button type="submit" data-dismiss="modal" class="btn btn-primary">Log in</button>
          </div>
        </form>
    </div>
      <div class="text-center out-links"><a href="<?php echo base_url();?>">&copy;  Copyright <?php echo base_url(), ' ',  date('Y');?>. </a></div>
  </div>
</div>
