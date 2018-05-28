<?php
ob_start();
require_once '../../includes/autoload.php';
include '../../includes/header.php';

use classes\util\DBUtil;
use classes\business\UserManager;
use classes\entity\User;

$formerror="";
$successmsg="";
$email="";

?>
<head>
  <title>Reset Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/communityportal/public/css/style.css">
</head>

<body>
<?php
//session_start();
if(isset($_REQUEST["resetSubmit"])){
		$fpCode = $_GET['fpCode'];
		$email= $_GET['email'];
    if(!empty($_POST['password']) && !empty($_POST['confirm_password'])){
        $password = $_POST['password'];
        //password and confirm password comparison
        if($_POST['password'] !== $_POST['confirm_password']){
            
            $formerror= 'Confirm password must match with the password.'; 
        }
		else{
			
			$UM=new UserManager();
			$existuser=$UM->getUserByEmail($email);
			if(isset($existuser)){
			$setpass=$UM->setPassword($email,$password);
			if(isset($setpass)){
				$successmsg = 'Your account password has been reset successfully. Please <a href="http://localhost/communityportal/">login </a> with your new password.';
			//	header("Location:resetThankyou.php");
			}
			}	
			}
}
} 
?> 
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
		<h2>Reset Password</h2>
</div>
<form method="post" name="resetPassword" class="form">
<div align = "center" style="color:red;"><?=$formerror?></div>
<div align = "center" ><?=$successmsg?></div><br><br>
  	<div class="input-group">
	    <label for="password"><b>Password</b></label> 
        <input size="50"  name="password" type="password">
	</div>
	<div class="input-group">
        <label><b>Confirm Password</b></label>
        <input name="confirm password" type="password" size="50">
	</div>
    <div align="center">
	<input  class="btn" name="resetSubmit" type="submit" value="Reset" >
	</div> 
</form>
</body>

 
