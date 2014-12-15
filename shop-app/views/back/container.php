<?php 
echo $header;
echo (isset($main_menu))?$main_menu:'';
echo (isset($page))?$page:'';
echo (isset($footer))?$footer:'';
?>