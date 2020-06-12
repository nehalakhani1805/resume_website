<?php
session_start();
$name=$year=$branch='';
$errors=array('name'=>'','year'=>'','branch'=>'');
if(isset($_POST['submit'])){
	if(empty($_POST['name'])){
		$errors['name']='*This field is required';
	}
	else
	{
		$name=$_POST['name'];
		//echo $name;
		if(!preg_match('/^[a-zA-Z ]*$/',$name)){
			//echo "name error";
			$errors['name']='Invalid name';
		}
		
	}
	if(empty($_POST['year'])){
		$errors['year']='*This field is required';
	}
	else
	{
		$year=$_POST['year'];
		if(!preg_match('/^[0-9]/',$year)){
			echo "year error";
			$errors['year']='Invalid year';
		}
	}
	$branch=$_POST['branch'];
	if(!array_filter($errors)){
		$servername = "localhost";
		$username = "neha";
		$password = "neha@1805";

		// Create connection
		$conn = new mysqli($servername, $username, $password,'resume');

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		//echo "Connected successfully";

		$sql='SELECT Uid,Fname,Mname,Lname, Year, Branch FROM basicinfo ';
		$result=mysqli_query($conn,$sql);
		$students=mysqli_fetch_all($result,MYSQLI_ASSOC);
		$flag=0;$sp=' ';
		foreach($students as $student){
			$sname=$student['Fname'].$sp.$student['Mname'].$sp.$student['Lname'];
			if($sname==$name && $student['Year']==$year && $student['Branch']==$branch)
			{
				$flag=1;
				$_SESSION['fname']=$student['Fname'];
				$_SESSION['mname']=$student['Mname'];
				$_SESSION['lname']=$student['Lname'];
				$_SESSION['uid']=$student['Uid'];
				$_SESSION['login']=2;
				break;
			}
		}
		if($flag==1){
			$name=$year=$branch='';
			header('Location:index.php');
		}
		else{
			$errors['branch']='*Please check the entries';
		}
		//print_r($skills);
		
		
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V18</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="main.php" method="POST">
					<span class="login100-form-title p-b-43">
						RESUMES OF SPIT
					</span>
					
					
					<div class="wrap-input100" >
						<input class="input100" type="text" name="name" >
						<span class="focus-input100"></span>
						<span class="label-input100">Name of the student</span>
					</div>
					<span class="alerting"><?php echo $errors['name']; ?></span><br>
					
					<div class="wrap-input100" >
						<input class="input100" type="text" name="year" >
						<span class="focus-input100"></span>
						<span class="label-input100">Year of graduation</span>
					</div>
					<span class="alerting"><?php echo $errors['year']; ?></span><br>
					<div class="wrap-input100 " >
						
						<select class="input100" name="branch" id = "myList" >
						
						   <option value = "Comps">Computers</option>
						   <option value = "IT">Information Technology</option>
						   <option value = "EXTC">Electronics and Telecommunication</option>
						   <option value = "ETRX">Electronics</option>
						 </select>
						<span class="focus-input100"></span>
						<span class="label-input100">Branch</span>
					</div>
					<span class="alerting"><?php echo $errors['branch']; ?></span><br>			
			

					<div class="container-login100-form-btn">
						<input type="submit" name="submit" value="View Resume" class="login100-form-btn">
							
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							Are you a student with us?
						</span>
						<a style="color:green" class="txt2" href ="login.php">Login here</a>
					</div>

					
				</form>

				<div class="login100-more" style="background-image: url('images/bg-001.jpg');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>