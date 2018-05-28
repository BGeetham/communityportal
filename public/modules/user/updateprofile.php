<?php
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
include '../../includes/mainmenu.php';
?>

<?php 

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$country="";
$city="";
$education="";
$company="";

if(!isset($_REQUEST["submitted"])){
  $UM=new UserManager();
  $existuser=$UM->getUserByEmail($_SESSION["email"]);
  $firstName=$existuser->firstName;
  $lastName=$existuser->lastName;
  $email=$existuser->email;
  $password=$existuser->password;
  $country=$existuser->country;
  $city=$existuser->city;
  $education=$existuser->education;
  $company=$existuser->company;
  
}else{
  $firstName=$_REQUEST["firstName"];
  $lastName=$_REQUEST["lastName"];
  $email=$_REQUEST["email"];
  $password=$_REQUEST["password"];
  $country=$_REQUEST["country"];
  $city=$_REQUEST["city"];
  $education=$_REQUEST["education"];
  $company=$_REQUEST["company"];
  

  if($firstName!='' && $lastName!='' && $email!='' && $password!=''){
       $update=true;
       $UM=new UserManager();
       if($email!=$_SESSION["email"]){
           $existuser=$UM->getUserByEmail($email);
           if(isset($existuser)){
               $formerror="User Email already in use, unable to update email";
               $update=false;
           }
       }
       if($update){
           $existuser=$UM->getUserByEmail($email);
           $existuser->firstName=$firstName;
           $existuser->lastName=$lastName;
           $existuser->email=$email;
           $existuser->password=$password;
		   $existuser->country=$country;
		   $existuser->city=$city;
		   $existuser->education=$education;
		   $existuser->company=$company;
           $UM->saveUser($existuser);
           header("Location:../../adminhome.php");
      }
  }else{
      $formerror="Please provide required values";
  }
}
?>
<body>
<div class="header">
<h1 align="center">Update Profile</h1>
</div>
<form name="myForm" method="post">
<div align="center"><?=$formerror?></div>
<div class="input-group">
   <label><b>First Name</b></label>
   <input type="text" name="firstName" value="<?=$firstName?>" size="50">
</div>
  <div class="input-group">
     <label><b>Last Name</b></label>
    <td><input type="text" name="lastName" value="<?=$lastName?>" size="50"></td>
  </div>
  <div class="input-group"> 
     <label><b>Email</b></label>
    <input type="text" name="email" value="<?=$email?>" size="50"></td>
 </div>
  <div class="input-group">  
     <label><b>Password</b></label>
    <input type="password" name="password" value="<?=$password?>" size="50"></td>
  </div>
 <div class="input-group">    
     <label><b>Confirm Password</b></label>
    <input type="password" name="cpassword" value="<?=$password?>" size="50">
 </div>
<div class="input-group">   
     <label><b>Country</b></label>
    <input type="text" name="country" value="<?=$country?>" size="50">
  </div>
<div class="input-group">    
     <label><b>City</b></label>
    <input type="text" name="city" value="<?=$city?>" size="50">
 </div> 
<div class="input-group">    
     <label><b>Education</b></label>
    <input type="text" name="education" value="<?=$education?>" size="50">
  </div>
  
<div class="input-group">   
     <label><b>Company</b></label>
    <td><input type="text" name="company" value="<?=$company?>" size="50">
  </div> 
<div>
   <center>
       <input type="hidden" name="submitted" value="1">
	   <input type="submit" name="submit" value="Submit" class="btn">
       <input type="submit" name="clear" value="Clear" class="btn" onclick="javascript:clearForm();">
	</center>   
   </div>
  </form>
</body>


