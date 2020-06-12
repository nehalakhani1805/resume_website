<?php
session_start();
if(isset($_SESSION['uid']) && $_SESSION['login']!=0){
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

	$sql="SELECT * FROM basicinfo WHERE Uid='$uid_from_login'";
	$result=mysqli_query($conn,$sql);
	$student=mysqli_fetch_assoc($result);
	$sql="SELECT * FROM skills where Uid='$uid_from_login' ORDER BY good DESC";
	$result=mysqli_query($conn,$sql);
	$skills=mysqli_fetch_all($result,MYSQLI_ASSOC);
	$sql="SELECT * FROM projects WHERE Uid='$uid_from_login' ORDER BY id";
	$result=mysqli_query($conn,$sql);
	$projects=mysqli_fetch_all($result,MYSQLI_ASSOC);
	$sql="SELECT * FROM education WHERE Uid='$uid_from_login' ORDER BY id";
	$result=mysqli_query($conn,$sql);
	$education=mysqli_fetch_all($result,MYSQLI_ASSOC);
	//print_r($skills);
}
else
	header('Location:login.php');

?>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
body{
		background-color: #4CAF50;
	}
	.contact{
		padding: 4%;
		height: 400px;
	}
	.col-md-3{
		background: #FFD333;
		padding: 4%;
		border-top-left-radius: 0.5rem;
		border-bottom-left-radius: 0.5rem;
	}
	.contact-info{
		margin-top:10%;
	}
	.contact-info img{
		margin-bottom: 15%;
	}
	.contact-info h2{
		margin-bottom: 10%;
	}
	.col-md-9{
		background: #fff;
		padding: 3%;
		border-top-right-radius: 0.5rem;
		border-bottom-right-radius: 0.5rem;
	}
	.contact-form label{
		font-weight:600;
	}
	input[type=submit]{
		background: #4CAF50;
		color: #fff;
		font-weight: 600;
		width: 25%;
	}
	input[type=submit]:focus{
		box-shadow:none;
	}
</style>



</head>
<body>
<?php
//MySQL-90;C-80;Flask-80;RPA-75;Javascript-75;php-75;Java-70;Python-70;
if(isset($_POST['submit']))
{
	$names=explode(" ",$_POST['name']);
	//echo gettype($_POST['name']);
	//print_r($names);
	$line=$_POST['line'];
	$about=$_POST['about'];
	$age=$_POST['age'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$languages=$_POST['languages'];
	$hobbies=$_POST['hobbies'];
	
	$sql="UPDATE basicinfo SET Fname= '$names[0]',Mname='$names[1]', Lname='$names[2]',About='$about',Email='$email',Address='$address', Languages='$languages', Hobbies='$hobbies' WHERE Uid='$uid_from_login'";
	if(!mysqli_query($conn,$sql))
	
		echo "not done update";
	$sql2="DELETE from skills where Uid='$uid_from_login'" ;
	
	if(!mysqli_query($conn,$sql2))
		
		echo "not done delete";
		
	$sql3="DELETE from projects where Uid='$uid_from_login'" ;
	if(!mysqli_query($conn,$sql3))
		
		echo "not done delete";
	$sql4="DELETE from education where Uid='$uid_from_login'" ;
	if(!mysqli_query($conn,$sql4))
		
		echo "not done delete";
	
	$temp=substr($_POST['skills'],0,strlen($_POST['skills'])-1);
	//echo $temp;
	$sks=explode(";",$temp);
	//print_r($sks);
	//$final=array();
	$f1=array();
	$f2=array();
	foreach($sks as $sk)
	{
		$s=explode("-",$sk);
		
		$sql3="INSERT INTO skills (skill,good,Uid) VALUES ('$s[0]','$s[1]','$uid_from_login')";
		if(!mysqli_query($conn,$sql3))
			echo "not done insert";
			
	}
	
	$temp=substr($_POST['projects'],1,strlen($_POST['projects']));
	$a1=explode("#",$temp);
	//print_r($a1);
	foreach ($a1 as $a)
	{
		$a2=explode("-",$a);
		$sql = "INSERT INTO projects (name,technologies,description,Uid ) VALUES ('$a2[0]', '$a2[1]','$a2[2]','$uid_from_login')";
        if(!mysqli_query($conn,$sql))
			echo mysqli_error($conn);
		//print_r($a2);
	}
	
	$temp=substr($_POST['education'],1,strlen($_POST['education']));
	$a1=explode("#",$temp);
	//print_r($a1);
	foreach ($a1 as $a)
	{
		$a2=explode(",",$a);
		$sql = "INSERT INTO education (type,name,year,marks,degree,Uid ) VALUES ('$a2[0]', '$a2[1]','$a2[2]','$a2[3]','$a2[4]','$uid_from_login')";
        if(!mysqli_query($conn,$sql))
			echo mysqli_error($conn);
		//print_r($a2);
	}
	//print_r($a1);
	header('Location:index.php');
}
?>

<div class="container contact">
  <form action="form.php" method="POST">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info">
				<img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
				<!--<h2>Resume Form</h2>-->
				<h4>Edit your resume here</h4>
			</div>
		</div>
		<div class="col-md-9">
			<div class="contact-form">
				<div class="form-group">
				  <label class="control-label col-sm-2" for="name">Name:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="name" value="<?php echo $student['Fname']." ".$student['Mname']." ".$student['Lname']; ?>" name="name">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="line">One line:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="line" value="<?php echo $student['Line']; ?>" name="line">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="about">About:</label>
				  <div class="col-sm-10">          
					<textarea id="about" class="form-control" name="about" ><?php echo $student['About']; ?> </textarea>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="age">Age:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="age" value="<?php echo $student['Age']; ?>" name="age">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="email">Email:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="email" value="<?php echo $student['Email']; ?>" name="email">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="phone">Phone No:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="phone" value="<?php echo $student['Phone']; ?>" name="phone">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="address">Address:</label>
				  <div class="col-sm-10">
					<textarea class="form-control" name="address" id="address"><?php echo $student['Address']; ?></textarea>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="languages">Languages:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="languages" value="<?php echo $student['Languages']; ?>" name="languages">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="hobbies">Hobbies:</label>
				  <div class="col-sm-10">
					<input type="ptext" class="form-control" id="hobbies" value="<?php echo $student['Hobbies']; ?>" name="hobbies">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="skills">Skills:</label>
				  <div class="col-sm-10">
					<textarea class="form-control" name="skills" id="skills"><?php foreach($skills as $skill){ echo $skill['skill']."-".$skill['good'].";";} ?></textarea>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="projects">Projects:</label>
				  <div class="col-sm-10">
					<textarea class="form-control" rows="10" name="projects" id="projects"><?php foreach($projects as $project){ echo "#".$project['name']."-".$project['technologies']."-".$project['description']."\n";} ?></textarea>
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="education">Projects:</label>
				  <div class="col-sm-10">
					<textarea class="form-control" rows="6" name="education" id="education"><?php foreach($education as $edu){ echo "#".$edu['type'].",".$edu['name'].",".$edu['year'].",".$edu['marks'].",".$edu['degree']."\n";} ?></textarea>
				  </div>
				</div>				
				
				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" value="Submit" name="submit"/>
				  </div>
				</div>
			</div>
		</div>
	</div>
  </form>
</div>

</html>

<!--
HTML, CSS, JavaScript, Flask, SQLAlchemy, Beautiful Soup, Requests, Sklearn
A Machine Learning project created to book movie tickets. The cost of the tickets is determined by the IMdB rating of the movie which is predicted by the ML model with an accuracy of 89%. A user friendly interface with the aim to provide customers with a fair price for the movie tickets

Automation Anywhere, Alteryx, Pandas, NumPy
Using robotic process automation, the house pricing is fully automated. The data is cleaned using the alteryx software and the pandas code predicts the price of a property based on a variety of factors using linear regression model with an accuracy of 87%

Android studio
Two word games namely Boggle and Crossword designed by using backtracking and recursion algorithms making them efficient and reducing the time complexity to minimum

Java, Swing, MySQL
A system accessed by both customers and the bank. It allows user to deposit and withdraw money from a variety of options provided for the type of account. Users can also open an account with the bank by filling a registration form. The bank employees verify the form and keep a record of the cash and cheque transactions
-->