<!DOCTYPE html>
<html>
<head>
	<title>Metiz soft</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	
<div class="container" style="padding-top: 10px;">
	<h3>Update User</h3>
	
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
			$attributes = array('role'=>'form','name'=>'updateuser','id'=>'updateuser','enctype'=>
				'multipart/form-data','method'=>'post');
		 echo form_open('users/edit/'.$user_data['id'],$attributes); ?>
			<div class="col-md-12">
				<div class="col-md-6">
			<div class="form-group">
				<label>First Name</label>
				<input type="text" name="fname" id="fname" value="<?php echo set_value('name',$user_data['fname']); ?>" class="form-control">
				<?php echo form_error('fname');?>
			</div>
			<div class="form-group">
				<label>Last Name</label>
				<input type="text" name="lname" id="lname" value="<?php echo set_value('lname',$user_data['lname']); ?>" class="form-control">
				<?php echo form_error('lname');?>
			</div>
			<div class="form-group">
				<label>E-mail</label>
				<input type="text" name="email" id="email" value="<?php echo set_value('email',$user_data['email']); ?>" class="form-control">
				<?php echo form_error('email');?>
			</div>
			<div class="form-group">
				<label>Mobile</label>
				<input type="number" name="mobile" id="mobile" value="<?php echo set_value('mobile',$user_data['mobile']); ?>" class="form-control">
				<?php echo form_error('mobile');?>
			</div>
			<div class="form-group">
				<label>Users Profile</label>
				<input type="file" name="user_image" id="user_image" value="<?php echo set_value('user_image'); ?>" class="form-control">
				<?php echo form_error('user_image');?>
				<?php 
				if($user_data['user_image'] != ''){
				?>
				<img src="<?php echo base_url().'assets/upload/'.$user_data['user_image'];?>" alt="<?php echo $user_data['user_image'];?>" width="128" height="128">
			<?php } ?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Country</label>
				<select name="country" id="country">
					<option value="">--Please Select Country--</option>
					<?php foreach($country_data as $key => $value){?>
						<option value="<?php echo $value['country_id']; ?>" <?php echo $value['country_id'] == $user_data['country'] ? 'selected' : '';?>><?php echo $value['country_name']; ?></option>
					<?php }?>
				</select>
			</div>
			<div class="form-group">
				<label>State</label>
				<select name="state" id="state">
					<option value="">--Please Select State--</option>
					<?php foreach($state_data as $key => $value){?>
						<option value="<?php echo $value['state_id']; ?>" <?php echo $value['state_id'] == $user_data['state'] ? 'selected' : '';?>><?php echo $value['state_name']; ?></option>
					<?php }?>
				</select>
			</div>
			<div class="form-group">
				<label>City</label>
				<select name="city" id="city">
					<option value="">--Please Select City--</option>
					<?php foreach($city_data as $key => $value){?>
						<option value="<?php echo $value['city_id']; ?>" <?php echo $value['city_id'] == $user_data['city'] ? 'selected' : '';?>><?php echo $value['city_name']; ?></option>
					<?php }?>
				</select>
			</div>
			<div class="form-group">
				<label>Zipcode</label>
				<input type="number" name="zipcode" value="<?php echo set_value('zipcode',$user_data['zipcode']); ?>" id="zipcode" class="form-control">
			</div>
			<div class="form-group">
				<label>Hobbies</label></br>
				<?php 
					$core_hobbies = array('Coding','Playing','Reading');
				?>
				<?php foreach($core_hobbies as $key=> $value) {
					if(in_array($value, $hobbies)){
					?>
					<input type="checkbox" id="<?php echo $core_hobbies[$key]; ?>" name="hobbies[]" value="<?php echo $core_hobbies[$key]; ?>" checked>
					<label for="<?php echo $core_hobbies[$key]; ?>"> <?php echo $core_hobbies[$key]; ?></label><br>
				<?php }else{ ?>
					<input type="checkbox" id="<?php echo $core_hobbies[$key]; ?>" name="hobbies[]" value="<?php echo $core_hobbies[$key]; ?>">
					<label for="<?php echo $core_hobbies[$key]; ?>"> <?php echo $core_hobbies[$key]; ?></label><br>
				<?php } } ?>					
			</div>
			<div class="form-group">
				<label>Gender</label></br>
				<input type="radio" name="gender" value="male" <?php echo $user_data['gender'] == 'male' ? 'checked' : '';?>>Male
				<input type="radio" name="gender" value="female" <?php echo $user_data['gender'] == 'female' ? 'checked' : '';?>>Female
			</div>
			<div class="form-group">
				<label>Address</label></br>
				<textarea name="address" rows="4" cols="50">
					<?php echo $user_data['address']; ?>
				</textarea>
			</div>
			<div class="form-group" style="padding-top: 10px;">
				<button class="btn btn-primary">Update</button>
				<a href="<?php echo base_url().'index.php/users/index'?>" class="btn-secondary btn">Cancel</a>
			</div>
		</div>
			</div>		
		</form>
	</div>
	
</div>
</body>
</html>
<script type="text/javascript">
	
	$( "#updateuser" ).submit(function( event ) {
	  var fname = $('#fname').val();
	  var lname = $('#lname').val();
	  var mobile = $('#mobile').val();
	  var email = $('#email').val();
	  
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