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
<?php
/*
<style>
.regisFrm input[type="text"], .regisFrm input[type="email"], .regisFrm input[type="password"] {
    width: 94.5%;
    padding: 10px;
    margin: 10px 0;
    outline: none;
    color: #000;
    font-weight: 500;
    font-family: 'Roboto', sans-serif;
}
</style>
*/
?>
<head>
  <title>Reset Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body bgcolor=turquoise>
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
				$successmsg = 'Your account password has been reset successfully. Please login with your new password.';
			//	header("Location:resetThankyou.php");
			}
			}	
			}
}
} 
?> 
<?php
/*
<h3 align="center">Reset Your Account Password</h3>
<div class="container"   align="center" style="width:50%;">
<div align = "center"><?=$formerror?></div>
    <div class="regisFrm">
        <form action="" method="post">
            <input type="password" name="password" placeholder="Password" required="">
            <input type="password" name="confirm_password" placeholder="Confirm Password" required="">
            <div class="send-button">
                <input type="submit" name="resetSubmit" value="RESET PASSWORD">
            </div>
        </form>
    </div>
</div>
 */
?>


<div class = "content" style="margin-top :150px;" >
<div class="container" style="width:50%;" align="center">
<div align = "center" style="color:red;"><?=$formerror?></div><br>
<div align = "center" ><?=$successmsg?></div><br><br>


<form method="post" name="resetPassword">
    <div class="panel panel-primary">
	<div class="panel-heading"><h5><b>Reset Password</b></h5></div>
	<table class="table">
	<td>
	<div>
	    <label for="password"> Password</label> 
        <input style="width:75%;  border: 0px solid;"  name="password" type="password" align="right">
		</div>
	</td><tr>	
	<td>
	<div>
        <label>Confirm Password </label>
        <input name="confirm password" type="password" style="width:75%;border: 0px solid;" align="right">
	</div><tr><tr>	
    <td>
	<div align="center">
	<input  class="btn btn-info" name="resetSubmit" type="submit" value="Reset" ></td>
</table>		
</div> 
</div>
</form>
</div>
</div>
</body>

 
