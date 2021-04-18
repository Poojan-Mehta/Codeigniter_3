<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="navbar navbar-dark bg-dark">
		
			<div class="container">
					<a href="" class="navbar-brand"> Metizsoft...  </a>
				
				<?php if(!$this->session->userdata("logged_in")){ ?>
					<a href="<?php echo base_url(); ?>/auth" class="btn btn-primary">Login</a>
					
				<?php }else{ ?>
	            	<a href="<?php echo base_url(); ?>users/logout" class="btn btn-primary">Logout</a>
	            <?php } ?>

			</div>
			<div class="container">
				
			<span style="color: white;padding-left: 20px;">
			<?php if($this->session->userdata("logged_in")){
				echo 'Hello, '.$this->session->userdata("fname"); 
			} ?>
			</span>
		
			</div>
		</div>
		
		
		

	</div>

</body>
</html>