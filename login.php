
<?php
session_start();
$_SESSION['login']=0;
$uid=$password_login='';
$errors=array('uid'=>'','password'=>'');
if(isset($_POST['submit'])){
	if(empty($_POST['uid'])){
		$errors['uid']='*This field is required';
	}
	else
	{
		$uid=$_POST['uid'];
		if(!preg_match('/^[0-9]/',$uid)){
			$errors['uid']='Invalid UID';
		}
	}
	if(empty($_POST['password'])){
		$errors['password']='*This field is required';
	}
	else
	{
		$password_login=$_POST['password'];
	}
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

		$sql='SELECT Uid,Password FROM basicinfo ';
		$result=mysqli_query($conn,$sql);
		$students=mysqli_fetch_all($result,MYSQLI_ASSOC);
		$flag=0;
		foreach($students as $student){
			
			if($student['Uid']==$uid && $student['Password']==$password_login)
			{
				$flag=1;
				$_SESSION['uid']=$uid;
				$_SESSION['login']=1;
				break;
			}
		}
		if($flag==1){
			header('Location:index.php');
		}
		else{
			$errors['password']='*Please check UID or Password';
		}
		//print_r($skills);
		
		
	}
}
?>
<html>
<head>
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);
.alert{
	color:red;
	font-size:12px;
}
.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
input[type=submit]{
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background-color: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.button1:hover,.button1:active,.button1:focus {
  background: #43A047;
}

.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  background-image: url('images/bg-001.jpg');
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}

</style>
<script>
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>
</head>

<body>
<div class="login-page">
  <div class="form">
   
    <form class="login-form" action="login.php" method="POST">
      <input type="text" name="uid" placeholder="UID"/>
	  <div class="alert"><?php echo $errors['uid']; if(!$errors['uid']==''){ echo "<br>";}?></div><br>
      <input type="password" name="password" placeholder="Password"/>
	  <div class="alert"><?php echo $errors['password']; ?></div><br>
      <div class="center">
				<input type="submit" name="submit" value="Submit" class="button1">
			</div>
	  
      <p class="message">Not registered? <a href="main.php">View other profiles</a></p>
    </form>
  </div>
</div>
</body>
</html>