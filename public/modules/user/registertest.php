<head>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="\moduleproject5\public\css\mystyle.css">
</head>
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

if(isset($_REQUEST["submitted"])){
    $firstName=$_REQUEST["firstName"];
    $lastName=$_REQUEST["lastName"];
    $email=$_REQUEST["email"];
    $password=$_REQUEST["password"];
	$country=$_REQUEST["country"];
	$city=$_REQUEST["city"];
	$education=$_REQUEST["education"];
	$company=$_REQUEST["company"];
      if($firstName!='' && $lastName!='' && $email!='' && $password!=''){
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
<header>
<h1 align="center">ABC Pte Ltd </h1>
 </header>
<body>
<div class="container" align="center">
<form name="myForm" method="post" class="form">
<div align="center"><?=$formerror?></div>
<div class="panel panel-primary">
<div class="panel-heading header"><h3>New Registration</h3></div>
<div class="panel-body">
<div class="input-group">
<label><b>First Name</b></label>
<input type="text" name="firstName" value="<?=$firstName?>">
</div>
 <div  class="input-group"> 
 <label><b>Last Name</b></label>
 <input type="text" name="lastName" value="<?=$lastName?>">
 </div>
<div  class="input-group">  
    <label><b>Email</b><label>
    <input type="email" name="email" value="<?=$email?>">
  </div>
  <div  class="input-group">    
    <label><b>Password</b></label>
   <input type="password" name="password" value="<?=$password?>">
  </div>  
  <div  class="input-group">    
    <label><b>Confirm Password</b></label>
    <input type="password" name="cpassword" value="<?=$password?>">
  </div> 
  <div  class="input-group">   
    <label><b>Country</b></label>
	<input type="text" name="country" value="<?=$country?>">
  </div>
 
    <div  class="input-group">    
    <label><b>City</b></label>
	<input type="text" name="city" value="<?=$city?>">
	</div> 
	<div  class="input-group">    
    <label><b>Education</b></label>
   	<input type="text" name="education" value="<?=$education?>">
    </div> 
  
  <div  class="input-group">    
    <label><b>Company</b><label>
    <input type="text" name="company" value="<?=$company?>">
  </div>
  <div>
       <input type="hidden" name="submitted" value="1">
	   <input type="submit" name="submit" value="Submit" class="btn">
       <input type="submit" name="clear" value="Clear" class="btn" onclick="javascript:clearForm();">
    </div>
  
  </div>
  </div>
</form>
</div>
</body>
<footer>copy right &copy 2018 by Indira Easaiya</footer>