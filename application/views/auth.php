<!DOCTYPE html>
<html>
<head>
	<title>Metiz soft</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	
<div class="container" style="padding-top: 10px;margin: 0 auto;">
	<h3>Login</h3>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<?php
				$success = $this->session->userdata('success');
				if ($success != "") {?>
								<div class="alert alert-success"><?php echo $success; ?></div>
							<?php
				}
				?>
							<?php
				$error = $this->session->userdata('error');
				if ($error != "") {?>
								<div class="alert alert-danger"><?php echo $error; ?></div>
							<?php
				}
				?>
						</div>
					</div>
	<div class="row">
		<?php
			$attributes = array('role'=>'form','name'=>'userlogin','id'=>'userlogin','method'=>'post');
		 echo form_open('auth',$attributes); ?>
		<!-- <form method="post" name="createcand" action="<?php echo base_url().'index.php/candidate/create'?>" enctype="multipart/form-data"> -->
			<div class="col-md-12">
				<div class="col-md-6">
			<div class="form-group">
				<label>E-mail</label>
				<input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="form-control">
				<?php echo form_error('email');?>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" id="password" value="" class="form-control">
				<?php echo form_error('password');?>
			</div>
			<div class="form-group" style="padding-top: 10px;">
				<button class="btn btn-primary">Login</button>
				
			</div>
			
		</div>
		
			
		</div>
			</div>

		
		<?php echo form_close(); ?>
	</div>
	
</div>
</body>
</html>
<script type="text/javascript">
	
	$( "#userlogin" ).submit(function( event ) {
	  var email = $('#email').val();
	  
	  var password = $('#password').val();
	  

	  if(email == '' || password == ''){
	  	alert('E-mail and password is required');
	  }
	  
	});


</script>