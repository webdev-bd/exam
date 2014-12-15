<div class="error_msg">
<?php $message=$this->session->userdata('message');
		if(isset($message) && !empty($message))
			{
				echo "<h4 class='alert alert-info'><button class='close' data-dismiss='alert'> × </button><i class='fa-fw fa fa-info'></i>$message</h4> ";
				$this->session->unset_userdata('message');
			}
 	echo validation_errors();
?></div>