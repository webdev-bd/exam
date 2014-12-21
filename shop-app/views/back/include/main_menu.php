<?php  $session=$this->session->userdata('back_session_admin');
if($session){ ?>
<div class="header navbar navbar-inverse box-shadow navbar-fixed-top">
  <div class="navbar-inner">
    <div class="header-seperation">
      <ul class="nav navbar-nav">
        <li class="sidebar-toggle-box"><a href="#"><i class="fa fa-bars"></i></a> </li>
        <li> <a href="<?php echo base_url()?>administrator/dashboard"><strong>Dashboard</strong></a> </li>
        <li> <a href="<?php echo base_url()?>administrator/logout">Log Out <i class="fa fa-angle-double-right"></i></a> </li>
      </ul><!--/nav navbar-nav--> 
    </div><!--/header-seperation--> 
  </div><!--/navbar-inner--> 
</div>
<div class="page-container">
   <div id="sidebar" class="nav-collapse top-margin fixed box-shadow2 hidden-xs">
    <div class="leftside-navigation" style="overflow: hidden;" tabindex="5000">
      <div class="sidebar-section sidebar-user clearfix">
        <div class="sidebar-user-avatar"> <a href="#"> <img src="<?php echo base_url()?>images/avatar1.jpg" alt="avatar"> </a></div><a href="#">
        <div class="sidebar-user-name">Admin</div>
        </a><div class="sidebar-user-links"><a href="#"> </a><a data-original-title="User" href="profile.html" data-toggle="" data-placement="bottom" title=""><i class="fa fa-user"></i></a> <a data-original-title="Messages" href="inbox.html" data-toggle="" data-placement="bottom" title=""><i class="fa fa-envelope-o"></i></a> <a data-original-title="Logout" href="lockscreen.html" data-toggle="" data-placement="bottom" title=""><i class="fa fa-sign-out"></i></a> </div>
      </div>
      <ul class="sidebar-menu" id="nav-accordion">
        <li> <a <?php echo (isset($title) && $title=='New Queshion') ? 'class="active"' : '';?> href="<?php echo base_url()?>administrator/new_question"> <i class="fa fa-send"></i> <span>New Question</span> </a> </li>
        <li> <a <?php echo (isset($title) && $title=='View Queshion') ? 'class="active"' : '';?> href="<?php echo base_url()?>administrator/view_question"> <i class="fa fa-send"></i> <span>View Question</span> </a> </li>
        <li> <a <?php echo (isset($title) && $title=='Category') ? 'class="active"' : '';?> href="<?php echo base_url()?>administrator/category"> <i class="fa fa-send"></i> <span>Category</span> </a> </li>
        <li> <a <?php echo (isset($title) && $title=='Practice') ? 'class="active"' : '';?> href="<?php echo base_url()?>administrator/practice"> <i class="fa fa-send"></i> <span>Practice</span> </a> </li>
      <?php 
        $user=$this->session->userdata('back_session_admin');
        if($user->status==9):
      ?>
        <li> <a <?php echo (isset($title) && $title=='Bank') ? 'class="active"' : '';?> href="<?php echo base_url()?>administrator/bank"> <i class="fa fa-send"></i> <span>Bank</span> </a> </li>
      <?php endif;?>
 
      
    </ul><!--/nav-accordion sidebar-menu--> 
    </div><!--/leftside-navigation--> 
  <div id="ascrail2000" class="nicescroll-rails" style="width: 3px; z-index: auto; cursor: default; position: absolute; top: 0px; left: 207px; height: 575px; display: block; opacity: 0;"><div style="position: relative; top: 0px; float: right; width: 3px; height: 0px; background-color: rgb(149, 149, 149); border: 0px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 0px;"></div></div><div id="ascrail2000-hr" class="nicescroll-rails" style="height: 3px; z-index: auto; top: 572px; left: 0px; position: absolute; cursor: default; display: none; opacity: 0; width: 207px;"><div style="position: relative; top: 0px; height: 3px; width: 0px; background-color: rgb(149, 149, 149); border: 0px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 0px; left: 0px;"></div></div></div> 
<?php }?> 
    