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
	//print_r($skills);
	$sql="SELECT * FROM projects WHERE Uid='$uid_from_login' ORDER BY id";
	$result=mysqli_query($conn,$sql);
	$projects=mysqli_fetch_all($result,MYSQLI_ASSOC);
	$sql="SELECT * FROM education WHERE Uid='$uid_from_login' ORDER BY id DESC";
	$result=mysqli_query($conn,$sql);
	$education=mysqli_fetch_all($result,MYSQLI_ASSOC);
}
else
	header('Location:login.php');

?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creative CV</title>
    <meta name="description" content="Creative CV is a HTML resume template for professionals. Built with Bootstrap 4, Now UI Kit and FontAwesome, this modern and responsive design template is perfect to showcase your portfolio, skils and experience."/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/aos.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/main.css" rel="stylesheet">
	<style>
	.alert{
	color:red;
	font-size:12px;}
	</style>

  </head>
  <body id="top">
    <header>
      <div class="profile-page sidebar-collapse">
        <nav class="navbar navbar-expand-lg fixed-top navbar-transparent bg-primary" color-on-scroll="400">
          <div class="container">
            <div class="navbar-translate"><a class="navbar-brand" href="#" rel="tooltip">Resumes of SPIT</a>
              <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-bar bar1"></span><span class="navbar-toggler-bar bar2"></span><span class="navbar-toggler-bar bar3"></span></button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link smooth-scroll" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link smooth-scroll" href="#skill">Skills</a></li>                
                <li class="nav-item"><a class="nav-link smooth-scroll" href="#experience">Projects</a></li>
				<li class="nav-item"><a class="nav-link smooth-scroll" href="#education">Education</a></li>
                <li class="nav-item"><a class="nav-link smooth-scroll" href="#contact">Contact</a></li>
				<?php 
				//session_start(); 
				if($_SESSION['login']==1){?>
				<li class="nav-item"><a class="nav-link smooth-scroll" href="form.php">Edit</a></li>
				<li class="nav-item"><a class="nav-link smooth-scroll" href="login.php">Logout</a></li>
				<?php } ?>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <div class="page-content">
      <div>
<div class="profile-page">
  <div class="wrapper">
    <div class="page-header page-header-small" filter-color="green">
      <div class="page-header-image" data-parallax="true" style="background-image: url('images/cc-bg-1.jpg');"></div>
      <div class="container">
        <div class="content-center">
          <div class="cc-profile-image"><a href="#"><img src="images/anthony.jpg" alt="Image"/></a></div>
          <div class="h2 title"><?php echo $student['Fname']." ".$student['Mname']." ".$student['Lname'];?></div>
          <p class="category text-white"><?php echo $student['Line'];?></p><a class="btn btn-primary smooth-scroll mr-2" href="#contact" data-aos="zoom-in" data-aos-anchor="data-aos-anchor">Hire Me</a><!--<a class="btn btn-primary" href="#" data-aos="zoom-in" data-aos-anchor="data-aos-anchor">Download CV</a>-->
        </div>
      </div>
      <div class="section">
        <div class="container">
          <div class="button-container"><a class="btn btn-default btn-round btn-lg btn-icon" href="#" rel="tooltip" title="Follow me on Facebook"><i class="fa fa-facebook"></i></a><a class="btn btn-default btn-round btn-lg btn-icon" href="#" rel="tooltip" title="Follow me on Twitter"><i class="fa fa-twitter"></i></a><a class="btn btn-default btn-round btn-lg btn-icon" href="#" rel="tooltip" title="Follow me on Google+"><i class="fa fa-google-plus"></i></a><a class="btn btn-default btn-round btn-lg btn-icon" href="#" rel="tooltip" title="Follow me on Instagram"><i class="fa fa-instagram"></i></a></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section" id="about">
  <div class="container">
    <div class="card" data-aos="fade-up" data-aos-offset="10">
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card-body">
            <div class="h4 mt-0 title">About</div>
            <p><h5 style="font-size:18px;">Hello! I am <?php echo $student['Fname']." ".$student['Mname']." ".$student['Lname'];?>. I am a <?php echo $student['Line'];?> from Sardar Patel Institute Of Technology, Andheri West.</h5></p>
            <p><h5 style="font-size:18px;"> <?php echo $student['About'];?></h5></p>
			</div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card-body">
            <div class="h4 mt-0 title">Basic Information</div>
            <div class="row">
              <div class="col-sm-4"><strong class="text-uppercase">Age:</strong></div>
              <div class="col-sm-8"><?php echo $student['Age'];?></div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Email:</strong></div>
              <div class="col-sm-8"><?php echo $student['Email'];?></div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Phone:</strong></div>
              <div class="col-sm-8"><?php echo $student['Phone'];?></div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Address:</strong></div>
              <div class="col-sm-8"><?php echo $student['Address'];?></div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Languages:</strong></div>
              <div class="col-sm-8"><?php echo $student['Languages'];?></div>
            </div>
			<div class="row mt-3">
              <div class="col-sm-4"><strong class="text-uppercase">Hobbies:</strong></div>
              <div class="col-sm-8"><?php echo $student['Hobbies'];?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section" id="skill">
  <div class="container">
    <div class="h4 text-center mb-4 title">Professional Skills</div>
    <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
      <div class="card-body">
        <div class="row">
		  <?php foreach($skills as $skill){ ?>
          <div class="col-md-6">
            <div class="progress-container progress-primary"><span class="progress-badge"><?php echo $skill['skill'];?></span>
              <div class="progress">
                <div class="progress-bar progress-bar-primary" data-aos="progress-full" data-aos-offset="10" data-aos-duration="2000" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $skill['good'];?>%;"></div><span class="progress-value"><?php echo $skill['good'];?>%</span>
              </div>
            </div>
          </div>
		  <?php } ?>          
        </div>
      </div>
    </div>
  </div>
</div>

<div class="section" id="experience">
  <div class="container cc-experience">
    <div class="h4 text-center mb-4 title">Projects</div>
	<?php foreach($projects as $project){ ?>
    <div class="card">
      <div class="row">
        <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body cc-experience-header">
            <p class="h4"><?php echo $project['name']; ?></p>
          </div>
        </div>
        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body">
            <div class="h6">Technologies used:</div>
            <p><?php echo $project['technologies'];?></p>
            <div class="h6">Description:</div>
            <p><?php echo $project['description']; ?></p>
		  </div>
        </div>
      </div>
    </div>  
	<?php } ?>	
  </div>
</div>
<div class="section" id="education">
  <div class="container cc-education">
    <div class="h4 text-center mb-4 title">Education</div>
	<?php foreach ($education as $edu) { ?>
    <div class="card">
      <div class="row">
        <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body cc-education-header">
            <p><?php echo $edu['year']; ?></p>
            <div class="h5"><?php echo $edu['type']; ?></div>
          </div>
        </div>
        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
          <div class="card-body">
            <div class="h5"><?php echo $edu['degree']; ?></div>
            <p class="category"><?php echo $edu['name']; ?></p>
            <p>Percentage/CGPA:</p>
			<p><?php echo $edu['marks']; ?></p>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    
  </div>
</div>


<div class="section" id="contact">
<?php
//ob_start();
$name=$subject=$email=$message='';
$errors=array('name'=>'','subject'=>'','email'=>'','message'=>'');
if(isset($_POST['submit'])){
	//echo "hi";
	if(empty($_POST['name'])){
		$errors['name']='*This field is required';
	}
	else
	{
		$name=$_POST['name'];
		if(!preg_match('/^\w+/',$name)){
			$errors['name']='Invalid Name';
		}
	}
	if(empty($_POST['subject'])){
		$errors['subject']='*This field is required';
	}
	else
	{
		$subject=$_POST['subject'];
	}	
	if(empty($_POST['email'])){
		$errors['email']='*This field is required';
	}
	else
	{
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$errors['email']='Invalid email';
		}
		else
			$email=$_POST['email'];
	}
	if(empty($_POST['message'])){
		$errors['message']='*This field is required';
	}
	else
	{
		$message=$_POST['message'];
	}
	if(!array_filter($errors)){
		
		$servername = "localhost";
		$username = "neha";
		$password = "neha@1805";
		
		$conn = new mysqli($servername, $username, $password,'resume');

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql="INSERT INTO contact(Uid, Name, Subject, Email, Message) VALUES('$uid_from_login','$name','$subject','$email','$message')";
		$result=mysqli_query($conn,$sql);
		if($result){
			$name=$subject=$email=$message='';?>
			<script> alert "Sent";</script><?php
			//header("Location:http://www.geeksforgeeks.org");
		}
		//print_r($skills);
		
		
	}
}
//ob_end_flush();
?>
  <div class="cc-contact-information" style="background-image: url('images/staticmap.png');">
    <div class="container">
      <div class="cc-contact">
        <div class="row">
          <div class="col-md-9">
            <div class="card mb-0" data-aos="zoom-in">
              <div class="h4 text-center title">Contact Me</div>
			  <?php if($_SESSION['login']==1){ ?>
			  <a href="table.php" class="btn btn-primary stretched-link"style="margin-left:20px">View Responses</a>
			  <?php } ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="card-body">
                    <form action="#contact" method="POST">
                      <div class="p pb-3"><strong>Feel free to contact me </strong></div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                            <input class="form-control" type="text" name="name" placeholder="Name" value="<?php echo $name;?>"/>							
                          </div>
                        </div>
                      </div>
					  <div class="alert"><?php echo $errors['name']; ?></div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                            <input class="form-control" type="text" name="subject" placeholder="Subject" value="<?php echo $subject;?>"/>							
                          </div>
                        </div>
                      </div>
					  <div class="alert"><?php echo $errors['subject']; ?></div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input class="form-control" name="email" placeholder="E-mail" value="<?php echo $email;?>" />							
                          </div>
                        </div>
                      </div>
					  <div class="alert"><?php echo $errors['email']; ?></div>
                      <div class="row mb-3">
                        <div class="col">
                          <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Your Message" value="<?php echo $message;?>"></textarea>							
                          </div>
                        </div>
                      </div>
					  <p class="alert"><?php echo $errors['message']; ?></p>
                      <div class="row">
                        <div class="col">
                          <input class="btn btn-primary" type="submit" name="submit" value="SEND"/>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-body">
                    <p class="mb-0"><strong>Address </strong></p>
                    <p class="pb-2"><?php echo $student['Address'];?></p>
                    <p class="mb-0"><strong>Phone</strong></p>
                    <p class="pb-2"><?php echo $student['Phone'];?></p>
                    <p class="mb-0"><strong>Email</strong></p>
                    <p><?php echo $student['Email'];?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div></div>
    </div>
    <footer class="footer">
      <div class="container text-center"><a class="cc-facebook btn btn-link" href="#"><i class="fa fa-facebook fa-2x " aria-hidden="true"></i></a><a class="cc-twitter btn btn-link " href="#"><i class="fa fa-twitter fa-2x " aria-hidden="true"></i></a><a class="cc-google-plus btn btn-link" href="#"><i class="fa fa-google-plus fa-2x" aria-hidden="true"></i></a><a class="cc-instagram btn btn-link" href="#"><i class="fa fa-instagram fa-2x " aria-hidden="true"></i></a></div>
      <div class="h4 title text-center">SPIT</div>
      <div class="text-center text-muted">
        <p>&copy; All rights reserved.<br>Design - <a class="credit" href="https://templateflip.com" target="_blank">TemplateFlip</a></p>
      </div>
    </footer>
    <script src="js/core/jquery.3.2.1.min.js"></script>
    <script src="js/core/popper.min.js"></script>
    <script src="js/core/bootstrap.min.js"></script>
    <script src="js/now-ui-kit.js?v=1.1.0"></script>
    <script src="js/aos.js"></script>
    <script src="scripts/main.js"></script>
  </body>
</html>