<style>
	.alert {
		padding: 20px;
		background-color: #f44336;
		color: white;
		opacity: 1;
		transition: opacity 0.6s;
		margin-bottom: 15px;
	}
	.alert.success {
    background-color: #4CAF50;
  }
  .alert.warning {
    background-color: #ff0000;
  }
	.closebtn {
		margin-left: 15px;
		color: white;
		font-weight: bold;
		float: right;
		font-size: 22px;
		line-height: 20px;
		cursor: pointer;
		transition: 0.3s;
	}
	.closebtn:hover {
		color: black;
	}
</style>
<?php
session_start();
include '../../db.php';
if ( $_SESSION['logged_in'] != 1 ) 
{
	$_SESSION['message'] = "You must log in before viewing your profile page!";
	header("location: error.php");    
}
else
{
	$id=$_SESSION['id'];
}
$id			= $_SESSION['id'];
$sql10 		= "Select * from admin where id='$id'";
$result 	= $conn->query($sql10);
$check=0;

if ($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) 
	{
		$iname 		= $row['name'];
		$email 		= $row['email'];
		$password 	= base64_decode($row['password']);
	}
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$check=1;
	if (isset($_POST['add'])) 
	{
		$password 		= $_POST['password'];
		$password1 		= $_POST['password1'];
		$name 			= $_POST['name'];
		$cnic 			= $_POST['cnic'];
		$latitude 		= $_POST['latitude'];
		$longitude 		= $_POST['longitude'];
		$contact_no 	= $_POST['contact_no'];
		$address 		= $_POST['address'];
		$father_name 	= $_POST['father_name'];
		$father_contact_no 	= $_POST['father_contact_no'];
		$reg_no 		= $_POST['reg_no'];
			
		if($password !=$password1)
		{
			$pcheck=1;
		}
		else
		{
			$password=base64_encode($password);
			$sql = "INSERT INTO `users`(`name`, `cnic`, `password`, `latitude`, `longitude`, `contact_no`, `address`, `father_name`, `father_contact_no`, `reg_no`, `type`, `status`) VALUES ('$name','$cnic','$password','$latitude','$longitude','$contact_no','$address','$father_name','$father_contact_no','$reg_no','1','1') ";
			$conn->query($sql);
			$pcheck=0;
		}
	}
}
include 'header.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin <u><?= $iname ?></u> </h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
	
		<div class="row">
		  <div class="col-md-12" style="margin-top:2rem;">
            <div class="card card-primary">
			  <div class="card-header" style="background-color: black;">
                <h3 class="card-title"><b> Add User</b></h3>
			  </div>
			  <?php if($check==1){ ?>
			  <div class="alert <?php if($pcheck==0) { ?> success<?php } if($pcheck==1) { ?>warning<?php } ?> ">
					<span class="closebtn">&times;</span>  
					<?php if($pcheck==0) {?>
					Conguradulation <b><?= $iname ?> </b>Your Information is updated successfully into Database.
					<?php } if($pcheck==1) { ?>
					Password donot match
					<?php } ?>
				</div>
				<script>
					var close = document.getElementsByClassName("closebtn");
					var i;
					for (i = 0; i < close.length; i++) 
					{
						close[i].onclick = function()
						{
							var div = this.parentElement;
							div.style.opacity = "0";
							setTimeout(function(){ div.style.display = "none"; }, 600);
						}
					}
				</script>
			  <?php } ?>
			
              <form role="form"   action="add-user-profile.php"  method="POST">
                <div class="card-body">
					<div style="display: grid;grid-template-columns: 47% 47%;grid-column-gap: 6%;">
						<div class="form-group">
							<label> Name</label>
							<input type="text" class="form-control" name="name" placeholder="Enter Name" required  />
						</div>
						<div class="form-group">
							<label> cnic</label>
							<input type="text" class="form-control" name="cnic" placeholder="Enter cnic" required  />
						</div>
						<div class="form-group">
							<label> Password</label>
							<input type="password" class="form-control" name="password" placeholder="Enter password" required />
						</div>
						<div class="form-group">
							<label> Retype Password</label>
							<input type="password" class="form-control" name="password1" placeholder="Enter  password again" required />
						</div>
						<div class="form-group">
							<label> latitude</label>
							<input type="text" class="form-control" name="latitude" placeholder="Enter latitude" required  />
						</div>
						<div class="form-group">
							<label> longitude</label>
							<input type="text" class="form-control" name="longitude" placeholder="longitude Name" required  />
						</div>
						
						<div class="form-group">
							<label> contact no</label>
							<input type="text" class="form-control" name="contact_no" placeholder="Enter contact no"  required />
						</div>
						<div class="form-group">
							<label> address</label>
							<input type="text" class="form-control" name="address" placeholder="Enter address"  required />
						</div>
						<div class="form-group">
							<label> father name</label>
							<input type="text" class="form-control" name="father_name" placeholder="Enter father name "  required />
						</div>
						<div class="form-group">
							<label> father_contact_no</label>
							<input type="text" class="form-control" name="father_contact_no" placeholder="Enter father contact no "  required />
						</div>
						<div class="form-group">
							<label> Registration No </label>
							<input type="text" class="form-control" name="reg_no" placeholder="Sp20-Bcs-184 "  required />
						</div>
						
						
					</div>
				</div>
				<div class="card-footer">
                  	<button type="submit" name="add" class="btn btn-primary">Add User Record</button>
                </div>
              </form>
            </div>
		  </div>
        </div>
	  </div>
    </section>
  </div>
  
<?php 
include 'footer.php';
?>
