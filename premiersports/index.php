<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css?v=<?php echo time()?>">

</head>
<body>
<div class="backgroundstyle">
</div>
<section class="signup">

<div class="container p-3 my-3 border">
	<div class="signup-content">
			<div class="signup-form">
				<h1 class="form-title">Registration</h1>
				<form method="post" name="" enctype="multipart/form-data" action="confirmation.php" style="display:inline-block;">
					<div class="form-group">
						<label for="fullname">Full Name <span class="text-danger">*</span> 
						<input type = "text" name ="fullname" class="form-control" required /></label>
					</div>
					<div class="form-group">
						<label for="dob">Date of Birth
						<input type="date" name="dob" class="form-control"/></label>
					</div>
					<div class="form-group">
						<label for="category">Category <span class="text-danger">*</span>
						<select id="category" name="category" size="1"  class="form-control" style="width: 192px;" required>
							<option value="1"> 10K </option>
							<option value="2"> Half Marathon </option>
							<option value="3"> Marathon </option>
						</select></label>
					</div>
					<input type ="submit" name= "register" value="Register" class="btn btn-primary"/>
				</form>
			</div>
			<div class="signup-image">
				<figure><img src="imgs/register.png" alt="register image"></figure>
			</div>
		</div>
	</div>
</section>
</body>
</html>