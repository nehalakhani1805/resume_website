<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<title>MyResume Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
<body class="w3-light-grey">

  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">MyResume | ADMIN MODE</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="index_insert.php"><span class="glyphicon glyphicon-pencil"></span> Insert</a></li>
      <li><a href="index_delete.php"><span class="glyphicon glyphicon-trash"></span> Delete</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Admin</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="default_avatar.png" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            <h2>Yash Mor</h2>
          </div>
        </div>
        <div class="w3-container" style="padding-top: 10px">

           <!-- Personal Details -->

        <?php
        $sql = "SELECT * FROM about_me;";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result))
        {
        ?>

            <p><i class="<?php echo $row['icon']; ?>"></i><?php echo $row['details']; ?></p>
        
        <?php
        }
        ?>

        <hr>

           <!-- Skills -->

        <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b></p>
          
        <?php
        $sql = "SELECT * FROM skills ORDER BY skill_level DESC;";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {

        ?>

  			<p><?php echo $row['skill_name']; ?></p>
  			<div class="w3-light-grey w3-round-xlarge w3-small">
  			<div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:<?php echo $row['skill_level']; ?>%"><?php echo $row['skill_level']."%"; ?></div>
  			</div>
            <br>

        <?php
        	}
        ?>

        <hr>

        <!-- Languages -->

        <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Languages</b></p>

        <?php
        $sql = "SELECT * FROM languages ORDER BY lang_level DESC;";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
        ?>
            <p><?php echo $row['lang_name']; ?></p>
            <div class="w3-light-grey w3-round-xlarge">
            <div class="w3-round-xlarge w3-teal" style="height: 24px;width: <?php echo $row['lang_level']; ?>%"></div>
            </div>
            <br>

        <?php
          }
        ?>

        <br>
        </div>
        </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Projects</h2>
        

        <?php
        $sql = "SELECT * FROM projects";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
        ?>

            <div class="w3-container">
            <h5 class="w3-opacity"><b><?php echo $row['topic']; ?></b></h5>
            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $row['year']; ?></h6> <!-- <span class="w3-tag w3-teal w3-round">Current </span> -->
            <p><?php echo $row['details']; ?><br><br> <em>Platform : <?php echo $row['platform']; ?></em></p>
            <hr>
            </div>

        <?php 
        }
        ?>  

      </div>

       <!-- Education -->

      <div class="w3-container w3-card w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-graduation-cap fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education</h2>

        <?php
        $sql = "SELECT * FROM education";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
        ?>

            <div class="w3-container">
              <h5 class="w3-opacity"  style="font-size: 25px;"><b></b><?php echo $row['institute']; ?></b></h5>
              <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i><?php echo $row['year']; ?></h6>
              <p><?php echo $row['details']."<br><br>"; if($row['grades'] == null) { echo "Current Engagement."; } else { echo "Passing Grades : ".$row['grades']." %"; } ?></p>
              <hr>
            </div>

        <?php
        }
        ?>

      </div>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

<footer class="w3-container w3-teal w3-center w3-margin-top">
  <p>Find me on social media.</p>
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

</body>
</html>