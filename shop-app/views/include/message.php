<div class="error_msg">
<?php $message=$this->session->userdata('message');
		if(isset($message) && !empty($message))
			{
				echo "<h4 class='alert alert-warning'>$message</h4> ";
				$this->session->unset_userdata('message');
			}
 	echo validation_errors();
?></div>