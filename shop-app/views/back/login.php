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
              <a class="pull-left"  href="#reg" data-toggle="modal"><button type="button" data-dismiss="modal" class="btn-info btn">New User</button></a>
            <button type="submit" data-dismiss="modal" class="btn btn-primary pull-right">Log in</button>
          </div>
        </form>
    </div>
      <div class="text-center out-links"><a href="<?php echo base_url();?>">&copy;  Copyright <?php echo date('Y');?></a></div>
  </div>
</div>



<div class="modal fade" id="reg" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Enter Your Information</h4>
            </div>
            <div class="modal-body " >                
                    <form id="registration">
                           <div class="form-group">
                            <div class="col-sm-12">
                              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input type="text" class="form-control" id="username" placeholder="Username" required="required" name="reg[id]">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-12">
                              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                  <input type="password" class="form-control"  placeholder="Password" required="required" name="reg[password]">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-12">
                              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                  <input type="email" class="form-control"  placeholder="Email" required="required" name="reg[email]">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-12">
                              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>
                                  <input type="text" class="form-control"  placeholder="Name" required="required" name="reg[name]">
                              </div>
                            </div>
                          </div>
                        
                        
                    </form>
                <div class=" clearfix">
                <input type="button" class="btn-info btn " id="actionTaken48" value="Register">
                </div>
            </div>            
        </div>
    </div>
  </div>