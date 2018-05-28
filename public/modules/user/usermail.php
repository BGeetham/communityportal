<?php
require_once '../../includes/autoload.php';
require_once "../../includes/phpmailer/PHPMailerAutoload.php";

use classes\business\UserManager;
use classes\entity\User;
use classes\util\DBUtil;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
include '../../includes/adminmainmenu.php';
?>
<head>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> 
 </head>
 <style>
body{
	background:turquoise;
}
</style>
<body>
<?php 
$formerror="";
$recipient;
$subject ;
$message ;
$email="";
$UM=new UserManager();
$users=$UM->getUsersBySubscription();
$selected=array();

if(isset($users)){
    ?>

 <div class = "content" align="center">
 <div class="container">
 <form method='POST' name='userList'>
     <div class="panel panel-primary">
      <div class="panel-heading"><h3>List of users</h3></div>
      <div class="panel-body">
	  <table class="table table-hover table-condensed" align = "center" width="800" border="1">
            <tr>
               <td align="center"><b>Name</b></td>
               <td align="center"><b>Email</b></td>
			   <td align="center"><b>Send Mail</b></td>
				  
            </tr>    
    <?php 
    foreach ($users as $user) {
        if($user!=null){
            ?>
            <tr>
               <td align="center"><?=$user->name?></td>
               <td align="center"><?=$user->email?></td>
			   <td align="center"><input type="checkbox" id="checkItem" name="email[]" value="<?php echo $user->email; ?>"></td>
			   
<?php 
    array_push($selected, $user->email);
    ?>			     
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/>
	<div align = "right"><button  class="btn btn-info" type='submit' name='selectAll' >Select all</button>
	<button  class="btn btn-info" type='submit' name='userList'>Select Checked</button></div>
	  </div>
    </div>
  </div>
  <?php
//To receive data from userList
if(isset($_POST['userList'])){
    $selected = $_POST['email'];
    //Assigning $recipient to the checked checkbox
    $recipient = (implode(",", $selected));
} else if (isset($_POST['selectAll'])){
    $recipient = (implode(", ", $selected));
}
}
?> 
  </div>
</div>   
</div>
<div class = "content" >
<div class="container" style="width:50%;">
<form method="post" name="mailbulk">
    <div class="panel panel-primary">
	<div class="panel-heading">New Message</div>
	<table class="table">
	<td>
	    <label for="recipient"> To :</label> 
        <input id="recipient" style="width:70%; border: 0px solid;"  name="recipients" type="text" value='<?php if(isset($recipient)){echo $recipient;}?>' readonly></td><tr>
		<td>
        <label>Subject: </label>
        <input name="subject" type="text" style="width:70%; border: 0px solid;"></td><tr>
        <td>
		<div class="form-group">
      <label for="message">Message:</label>
	  <textarea name="message" id="CK1"></textarea> 
    <script>
        CKEDITOR.replace("message"); 
     </script>
     
      </div> 
		<tr><td>
        <input  class="btn btn-info" align="left" id="submit" name="mailbulk" type="submit" value="Send" ></td>
</table>		
    </div> 
	</div>
</form>
</div>
</div>
	
<?php 
	if(isset($_POST["mailbulk"])){
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $recipients = explode(',', $_POST['recipients']);
    //Proceed when $recipients is not empty
    if($recipients) {
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
			$mail->Password = "password";
			//If SMTP requires TLS encryption then set it
			$mail->SMTPSecure = "tls";
			//Set TCP port to connect to
			//$mail->Port = 587;
			$mail->Port = 25;
			$mail->From = "example@gmail.com";
			$mail->FromName = "Admin";
		      foreach($recipients as $emailRecipient){
              $mail->addAddress($emailRecipient,$UM->getUserByEmail($emailRecipient)->firstName);
          }
          $mail->isHTML(true);
          $mail->Subject = $subject ;
          $mail->Body = $message ;
             if($mail->send()){
              //echo "INSIDE SEND";
              //echo '<br><h4><p style="color:blue">Hi '.ucwords($existuser->firstName.' '.$existuser->lastName).',</p><p style="color:blue">Thank You <br> Your password has been sent to '.$email.'. Please check your mail.</h4></p>';
            echo 'OK';
          }else{
              echo "<br>Error in sending mail: ".$mail->ErrorInfo;
          }
      }else{
        echo 'No Email in recipients';
      }


} //End of $_POST["mailbulk"]
?>
</body>
