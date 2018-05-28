<?php
require_once '../../includes/autoload.php';


use classes\util\DBUtil;
use classes\business\UserManager;
use classes\entity\User;

$formerror="";
$email="";
$subscribed="";
$formSuccess="";

if(isset($_REQUEST["submitted"])){
    $email=$_REQUEST["email"];
    
    $UM=new UserManager();

    $existuser=$UM->getUserByEmail($email);
	
	
    if(isset($existuser)){
		$subscribed=$UM->setUnsubcribe($email);
		if (isset($subscribed)){
			$formSuccess="Your news letters are unsubscribed";
		}
	    }
	else{
        $formerror="Invalid email address";
    }

}
?>
<body bgcolor=turquoise>
<form name="myForm" method="post" >
<h3 align = "center">Unsubscribe</h3><br>
<div align = "center" class="error"><?=$formerror?></div>
<table align = "center">
  
  <tr>    
    <td>Email</td>
    <td><input type="text" name="email" value="<?=$email?>" size="50" placeholder="Please enter your email address"></td>
  </tr>
  <tr>
    <td colspan="2" align="right">
       <input type="hidden" name="submitted" value="1">
	   <input type="submit" name="submit" value="Submit" onclick="javascript:clearForm();">
    </td>
  </tr>
  
</table>
</form>
</body>