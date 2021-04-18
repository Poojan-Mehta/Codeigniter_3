<!DOCTYPE html>
<html>
<head>
	<title>Metiz soft</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	
<div class="container" style="padding-top: 10px;">
	<h3>Create User</h3>	
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
		<div class="col-md-6">
			<a href="<?php echo base_url().'users' ?>" class="btn btn-success" style="float: right">Users List</a>
		</div>
		<?php
			$attributes = array('role'=>'form','name'=>'createuser','id'=>'createuser','method'=>'post');
		 echo form_open_multipart('users/create',$attributes); ?>
			<div class="col-md-12">
				<div class="col-md-6">
			<div class="form-group">
				<label>First Name</label>
				<input type="text" name="fname" id="fname" value="<?php echo set_value('fname'); ?>" class="form-control">
				<?php echo form_error('fname');?>
			</div>
			<div class="form-group">
				<label>Last Name</label>
				<input type="text" name="lname" id="lname" value="<?php echo set_value('lname'); ?>" class="form-control">
				<?php echo form_error('lname');?>
			</div>
			<div class="form-group">
				<label>E-mail</label>
				<input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="form-control">
				<?php echo form_error('email');?>
			</div>
			<div class="form-group">
				<label>Mobile</label>
				<input type="number" name="mobile" id="mobile" value="<?php echo set_value('mobile'); ?>" class="form-control">
				<?php echo form_error('mobile');?>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" class="form-control">
				<?php echo form_error('password');?>
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
				<input type="password" name="cpassword" id="cpassword" class="form-control">
			</div>
			<div class="form-group">
				<label>Users Profile</label>
				<?php echo form_upload(['name'=>'user_image','class'=>'form-control']); ?>
				<?php echo form_error('user_image');?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Country</label>
				<select name="country" id="country">
					<option value="">--Please Select Country--</option>
					<?php foreach($country_data as $key => $value){?>
						<option value="<?php echo $value['country_id']; ?>"><?php echo $value['country_name']; ?></option>
					<?php }?>
				</select>
			</div>
			<div class="form-group">
				<label>State</label>
				<select name="state" id="state">
					<option value="">--Please Select State--</option>
				</select>
			</div>
			<div class="form-group">
				<label>City</label>
				<select name="city" id="city">
					<option value="">--Please Select City--</option>
				</select>
			</div>
			<div class="form-group">
				<label>Zipcode</label>
				<input type="number" name="zipcode" id="zipcode" class="form-control">
			</div>
			<div class="form-group">
				<label>Hobbies</label></br>
				<input type="checkbox" id="hobbies1" name="hobbies[]" value="Coding">
				<label for="hobbies1"> Coding</label><br>
				<input type="checkbox" id="hobbies2" name="hobbies[]" value="Playing">
				<label for="hobbies2"> Playing </label><br>
				<input type="checkbox" id="hobbies3" name="hobbies[]" value="Reading">
				<label for="hobbies3"> Reading </label><br>	
			</div>
			<div class="form-group">
				<label>Gender</label></br>
				<input type="radio" name="gender" value="male">Male
				<input type="radio" name="gender" value="female">Female
			</div>
			<div class="form-group">
				<label>Address</label></br>
				<textarea name="address" rows="4" cols="50">
					
				</textarea>
			</div>
			<div class="form-group" style="padding-top: 10px;">
				<button class="btn btn-primary">Create</button>
				<a href="<?php echo base_url().'users/index'?>" class="btn-secondary btn">Cancel</a>
			</div>
		</div>
			</div>

		
		<?php echo form_close(); ?>
	</div>
	
</div>
</body>
</html>
<script type="text/javascript">
	
	$( "#createuser" ).submit(function( event ) {
	  var fname = $('#fname').val();
	  var lname = $('#lname').val();
	  var mobile = $('#mobile').val();
	  var email = $('#email').val();
	  var password = $('#password').val();
	  var cpassword = $('#cpassword').val();
	  var zipcode = $('#zipcode').val();
	  var $radio = $('input:radio[name="gender"]');
		$radio.addClass("validate[required]");

	  if(password != cpassword){
	  	alert('password and confirm password is different');
	  	event.preventDefault();
	  }

	  if(fname == ''){
	  	alert("First name is required..");
	  	event.preventDefault();
	  }else if(lname == ''){
	  	alert("Last name is required..");
	  	event.preventDefault();
	  }else if(mobile == ''){
	  	alert("Mobile is required..");
	  	event.preventDefault();
	  }else if(email == ''){
	  	alert("E-mail is required..");
	  	event.preventDefault();
	  }else if(password == ''){
	  	alert("Password is required..");
	  	event.preventDefault();
	  }else if(cpassword == ''){
	  	alert("Confirm password is required..");
	  	event.preventDefault();
	  }else if(zipcode == ''){
	  	alert("zipcode is required");
	  	event.preventDefault();
	  }
	  
	});

	$("#country").change(function () {
        var country_id = this.value;
        $.ajax({
		   url: '<?php echo base_url().'users/getstate'; ?> ',
		   data: 'country_id='+country_id,
		   method: 'post',
		   dataType: "json"
		})
		.done(function( data ) {
		    var state = data.data;
		    $("#state").empty();
		    $("#state").append("<option value=''>--Please Select State--</option>");

		    $("#city").empty();
		    $("#city").append("<option value=''>--Please Select City--</option>");

		    $.each(state, function( index, value ) {
			  $("#state").append("<option value=\"" + value.state_id + "\">" + value.state_name + "</option>");
			});
		    

		  });
    });

    $("#state").change(function () {
    	var country_id = $('#country').val();
        var state_id = this.value;
        $.ajax({
		   url: '<?php echo base_url().'users/getcity'; ?> ',
		   data: 'country_id='+country_id+'&state_id='+state_id,
		   method: 'post',
		   dataType: "json"
		}).done(function( data ) {
		    var city = data.data;
		    console.log(city);
		    $("#city").empty();
		    $("#city").append("<option value=''>--Please Select City--</option>");

		    $.each(city, function( index, value ) {
			  $("#city").append("<option value=\"" + value.city_id + "\">" + value.city_name + "</option>");
			});
		    

		  });
    });


</script>