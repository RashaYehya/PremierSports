<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="backgroundstyle">
</div>
	<div class="container p-3 my-3 border">
	<figure><img src="imgs/thank you for registering.png" alt="register image"></figure>
		<div class="signup-content">
			<div class="signup-info">

<?php

//Get the data posted in the registration form
$fullname = $_POST['fullname'];
$dateofbirth = $_POST['dob'];
$category = $_POST['category'];

//bib numbers per category are as per below:
if($category=="1"){
	//Category: 10K
	$min = 0;
	$max=100;
}
elseif($category=="2"){
	//Category: half marathon
	$min = 101;
	$max = 200;
}
else{
	//Category: marathon
	$min = 201;
	$max=300;
}

//Connect to the database
$db_host="127.0.0.1";
$db_name="premiersports";
$db_user="root";
$db_pass="";
$link = new mysqli($db_host, $db_user, $db_pass, $db_name);

if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 

//To support arabic characters:

$sql= "SET NAMES 'utf8'";
$query = mysqli_query($link, $sql);

$sql="SET CHARACTER SET utf8" ;
$query = mysqli_query($link, $sql);

//Get the category description from the category table.
$sql="SELECT category_desc FROM category WHERE id = $category";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$category_desc = $row['category_desc'];

//Get the max assigned bib number for this category 
$sql = "SELECT Max(bib) AS maxbib FROM registration where category = $category";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

//if there is no assigned bib number in this category, set the first bib number as per category
if($row['maxbib'] == NULL){
	$bib=$min;
	// if($category=="1"){
		// //Category: 10K
		// $bib = 0;
	// }
	// elseif($category=="2"){
		// //Category: half marathon
		// $bib = 101;
	// }
	// else{
		// //Category: marathon
		// $bib = 201;
	// }
	
}
elseif($row['maxbib']==$max){
		$bib=-1;
}
else{
//Set the bib number for this registrant (race numbers are assigned sequentially and per category)
	$bib =  $row['maxbib'] + 1;
}

//Insert registration details in the database
$sql = "INSERT INTO registration (fullname, dateofbirth, category,bib)
VALUES ('$fullname', '$dateofbirth', '$category',$bib)";

if($bib !=-1){
	//Print registration details in a table
	if (mysqli_query($link, $sql)) {

		  echo "<table class='reginfo'>
			<tr>
				<th>Full Name: </th>
				<td>$fullname</td>
			</tr>
			<tr>
				<th>Date of Birth: </th>
				<td>$dateofbirth</td>
			</tr>
			<tr>
				<th>Category: </th>
				<td>$category_desc</td>
			</tr>
			<tr>
				<th>Race Number: </th>
				<td>$bib</td>
			</tr>
		</table>";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
}
else{
	echo '<h5 class="text-danger text-center">Sorry, Capacity Full! </h5><p> You can register in another category or join future races.</p>';
}
	//Close connection to database
	mysqli_close($link);

?>
			<button onclick="location.href = 'index.php';" id="backBtn" class="btn btn-primary" >Back</button>
			</div>

		</div>
	</div>
</body>
</html>