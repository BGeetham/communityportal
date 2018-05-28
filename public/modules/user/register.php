<?php
ob_start();
require_once '../../includes/autoload.php';

use classes\util\DBUtil;
use classes\business\UserManager;
use classes\entity\User;

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$country="";
$city="";
$education="";
$company="";
$errors = array();

if(isset($_REQUEST["submit"])){
    $firstName=$_REQUEST["firstName"];
    $lastName=$_REQUEST["lastName"];
    $email=$_REQUEST["email"];
    $password=$_REQUEST["password"];
	$cpassword=$_REQUEST["cpassword"];
	$country=$_REQUEST["country"];
	$city=$_REQUEST["city"];
	$education=$_REQUEST["education"];
	$company=$_REQUEST["company"];
	if (empty($firstName)) { array_push($errors, "Firstname is required"); }
	if (empty($lastName)) { array_push($errors, "Lastname is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password)) { array_push($errors, "Password is required"); }
	if ($password != $cpassword) {
			array_push($errors, "The two passwords do not match");
		}
		if (count($errors) == 0) {
		$password = $password;//encrypt the password before saving in the database
		$UM=new UserManager();
        $user=new User();
        $user->firstName=$firstName;
        $user->lastName=$lastName;
        $user->email=$email;
        $user->password=$password;
		$user->country=$country;
		$user->city=$city;
		$user->education=$education;
		$user->company=$company;
        
		$existuser=$UM->getUserByEmail($email);
            if(!isset($existuser)){
			$_SESSION['firstName'] = $firstName;
			$_SESSION['email'] = $email;				
            // Save the Data to Database
            $UM->saveUser($user);
            header("Location:registerthankyou.php");
        }
        else{
            $formerror="User Already Exist";
        }
    }else{
        $formerror="Please fill in the fields";
    }
}
?>
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/communityportal/public/css/style.css">
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"><img src="/communityportal/public/images/logo.png" class="img-responsive" style="height:50px"></a>
    </div> 

    <div class="collapse navbar-collapse" id="myNavbar">	
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">About Us</a></li>
    </ul>
</div>
</div>
</nav>
<div class="header">
		<h2>Registration</h2>
</div>
<form name="myForm" method="post" class="form">
<?php  if (count($errors) > 0) : ?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<p style="color:red"><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>
	<div class="input-group">
	
		<label><b>First Name</b></label>
		<input type="text" name="firstName" size="50" value="<?=$firstName?>">
	
	</div>
	<div class="input-group">
	  <label><b>Last Name</b></label>
	  <input type="text" name="lastName" size="50" value="<?=$lastName?>">
	 </div>
	<div class="input-group">
	  <label><b>Email</b></label>
    <input type="email" name="email" size="50" value="<?=$email?>">
  </div>
  <div class="input-group">
	  <label><b>Password</b></label>
	  <input type="password" name="password" size="50"  value="<?=$password?>">
  </div>  
  <div class="input-group">
	  <label><b>Confirm Password</b></label>
	  <input type="password" name="cpassword" size="50"  value="<?=$password?>">
  </div>
  <div class="input-group">
	  <label><b>Country</b>
	  <input type="text" name="country" size="50"  value="<?=$country?>">
</div>
 
    <div class="input-group">
	  <label>City</b></label>
	  <input type="text" name="city" size="50" value="<?=$city?>">
	</div> 
  <div class="input-group">
	  <label><b>Education</b></label>
      <input type="text" name="education" size="50"  value="<?=$education?>">
	</div>
  
  <div class="input-group">
	  <label><b>Company</b></label>
    <input type="text" name="company"  size="50" value="<?=$company?>">
	</div>
  
 <div align="center">
     <input type="hidden" name="submitted" value="1">
	 <input type="submit" name="submit" value="Submit"  class="btn">
     <input type="submit" name="clear" value="Cancel"  class="btn" onclick="javascript:clearForm();">
  </div>
  
</form>
</body>
<footer id="myFooter">
<div class="container">
            <ul>
                <li><a href="#">Company Information</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Terms of service</a></li>
				<li><a href="public/modules/user/unsubscribe.php">Unsubscribe</a></li>
            </ul>
<p class="footer-copyright">© 2018 Copyright by Indira Easaiya </p>
</div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>