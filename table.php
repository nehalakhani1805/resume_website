<?php
session_start();
if(isset($_SESSION['uid']) && $_SESSION['login']==1){
	$servername = "localhost";
	$username = "neha";
	$password = "neha@1805";
	$uid_from_login=$_SESSION['uid'];
	//echo $uid_from_login;
	// Create connection
	$conn = new mysqli($servername, $username, $password,'resume');

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully";

	$sql="SELECT * FROM contact WHERE Uid='$uid_from_login'";
	$result=mysqli_query($conn,$sql);
	$contacts=mysqli_fetch_all($result,MYSQLI_ASSOC);
	
	//print_r($skills);
}
else
	header('Location:login.php');

?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <style>
 .trying{
	margin-top:50px;
 }
 .try2{
	 background-color:black;
	 color:white;
 }
 </style>
</head>
<body>
<div class="container">
    <div class="h1 text-center title">Responses</div>
	<table class="table table bordered trying">
	  <thead class="try2">
		<tr>
		  <th scope="col">Sr.No.</th>
		  <th scope="col">Name</th>
		  <th scope="col">Subject</th>
		  <th scope="col">Email</th>
		  <th scope="col">Message</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($contacts as $contact){?>
		<tr <?php if($contact['Id']%2==0) { ?> class="success" <?php } ?> >
		
		  <th scope="row"><?php echo $contact['Id'] ?></th>
		  <td><?php echo $contact['Name'] ?></td>
		  <td><?php echo $contact['Subject'] ?></td>
		  <td><?php echo $contact['Email'] ?></td>
		  <td><?php echo $contact['Message'] ?></td>
		
		</tr>
		<?php } ?>
		
	  </tbody>
	</table>
</div>

</body>
</html>
