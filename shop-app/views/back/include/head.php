<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo (!empty($title))? $title:'Admin';?></title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">

<link href="<?php echo base_url();?>css/admin/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/admin/style-template.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/admin/style-responsive-template.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/admin/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/plugin/datepicker.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/plugin/chosen.min.css" rel="stylesheet">
<!-- Bootstrap -->
<script>
    var baseUrl="<?php echo base_url();?>";
</script>
<script src="<?php echo base_url();?>js/library/jquery.min.js"></script>
<script src="<?php echo base_url();?>js/library/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/plugin/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>js/plugin/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>js/admin/functions.js"></script>
</head>        
 
<body class="light-theme">