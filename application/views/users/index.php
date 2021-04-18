<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container" style="padding-top: 10px;">
	<div class="row">
		<div class="col-md-12">
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
		<div class="col-md-12">
			<h3>Users Dashboard </h3>
			<a href="<?php echo base_url() . 'users/create' ?>" class="btn btn-success" style="float: right">Create</a>
		</div>
		<div class="innerbox">
			<div class="col-md-12" style="padding-top: 10px;">
			<table class="table table-striped">
				<tr>
					<th class="text-center">Name</th>
					<th class="text-center">E-mail</th>
					<th class="text-center">Mobile</th>
					<th class="text-center">Hobbies</th>
					<th class="text-center">Created Date</th>
					<th class="text-center">Edit</th>
					<th class="text-center">Delete</th>
				</tr>

					<?php foreach ($users as $key => $data) {?>
						<tr id="user_<?php echo $data['id']; ?>">
					<td class="text-center"><?php echo $data['fname']; ?></td>
					<td class="text-center"><?php echo $data['email']; ?></td>
					<td class="text-center"><?php echo $data['mobile']; ?></td>
					<td class="text-center"><?php echo $data['hobbies']; ?> </td>
					<!-- created helper test convdate() -->
					<td class="text-center"><?php echo convdate($data['created_date']); ?></td> <!-- custom helper -->
					<td class="text-center"><a href="<?php echo base_url() . 'users/edit/' . $data['id'] ?>" class="btn btn-primary">Edit</td>
						<td class="text-center"><a href="javascript:void(0)" class="btn btn-danger remove">Delete</td>
				</tr>
				<?php }?>

			</table>

		</div>
		</div>
		<div class="row">
		<div class="col-md-12">
			<ul class="pagination" style="float:right;">
				<li>
				<?php
for ($page = 1; $page <= $number_of_page; $page++) {

    ?>

        <a href ="<?php echo base_url(); ?>users/?page=<?php echo $page; ?>" class="<?php echo ($current_page == $page) ? 'active' : ''; ?>"><?php echo $page; ?></a>
  <?php }
?> </li>
			</ul>
		</div>
	</div>


	</div>






	<style type="text/css">
		.pagination {
  display: inline-block;
}

.pagination a {
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.active {
	background-color: #212529;
	color: white;
	border-radius: 7px;
	}

	.innerbox
{
   height: 400px; 
   overflow: scroll;
}
	</style>


</div>
</body>
</html>

<script type="text/javascript">
	$(".remove").click(function(){
		alert('hello');
        var str = $(this).parents("tr").attr("id");
        var id = str.replace("user_", "");
        
        if(confirm('Are you sure to remove this record ?'))
        {
        	$.ajax({
               url: '<?php echo base_url().'users/delete/'; ?>'+id,
               type: 'post',
               dataType: "json",
               success: function(data) {
                    $("#user_"+id).remove();
                    alert("Record removed successfully");  
                    location.reload();
               }
            });
        }
    });
</script>