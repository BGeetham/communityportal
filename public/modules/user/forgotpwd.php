<?php
require_once '../../includes/autoload.php';
require_once "../../includes/phpmailer/PHPMailerAutoload.php";

use classes\util\DBUtil;
use classes\business\UserManager;
use classes\entity\User;

$formerror="";
$email="";
$fp_code="";
$fn="";
$uniqidStr="";

if(isset($_REQUEST["submitted"])){
    $email=$_REQUEST["email"];
    
    $UM=new UserManager();

    $existuser=$UM->getUserByEmail($email);
	
	
    if(isset($existuser)){
		$fn=$existuser->firstName;
		$uniqidStr = md5(uniqid(mt_rand()));
		$setFpcode=$UM->setForgetPassCode($email,$uniqidStr);
		if(isset($setFpcode)){
		$mail = new PHPMailer;
			//Enable SMTP debugging.
			//$mail->SMTPDebug = 3;
			//Set PHPMailer to use SMTP.
			$mail->isSMTP();
			//Set SMTP host name
			$mail->Host = "smtp.gmail.com";
			//Set this to true if SMTP host requires authentication
			$mail->SMTPAuth = true;
			//Provide username and password
			$mail->Username = "example@gmail.com";
			$mail->Password = "yourPassword";
			//If SMTP requires TLS encryption then set it
			$mail->SMTPSecure = "tls";
			//Set TCP port to connect to
			//$mail->Port = 587;
			$mail->Port = 25;
			$mail->From = "example@gmail.com";
			$mail->FromName = "Admin";
			$mail->addAddress(trim($existuser->email), "User");
			$mail->isHTML(true);
			$mail->Subject = "Forgot Password";
			$mail->Body = '<p>Dear '.ucwords($existuser->firstName.' '.$existuser->lastName).',<br><p> Please click <a href="http://localhost/communityportal/public/modules/user/resetPassword.php?fpCode='.$uniqidStr.'&email='.trim($existuser->email).'" >here</a> to reset your password</p>';
			//$mail->AltBody = "";
			if($mail->send()){
				header("Location:forgotpwdconfirmation.php");
				//echo '<br><h4><p>Hi '.ucwords($existuser->firstName.' '.$existuser->lastName).',</p></p>Thank You <br> Your password has been sent to '.$email.'. Please check your mail.</h4></p>';
			}else{
				echo "<br>Error in sending mail: ".$mail->ErrorInfo;
			}
        //        mail($to,$subject,$mailContent,$headers);	
        //header("Location:forgotpwdconfirmation.php");
		}
    }
	else{
        $formerror="Invalid email address";
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
<body>
<div class="header">
		<h2>Forgot Password</h2>
</div>
<form name="myForm" method="post" class="form">
<p align = "center"><b>Let's find your account<br><br> Please enter your Email ID</b></p>
<div align = "center"><?=$formerror?></div>
   <div class="input-group">
   <input type="text" name="email" value="<?=$email?>" size="50" placeholder="Email">
  </div>
  <div>
       <input type="hidden" name="submitted" value="1">
	   <input type="submit" name="submit" value="Submit" class="btn "onclick="javascript:clearForm();">
   </div> 
</form>
</body>