<?php
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
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
  $user=$UM->getUserById($_REQUEST["Id"]);
  $firstName=$user->firstName;
  $lastName=$user->lastName;
  $email=$user->email;
  $password=$user->password;
  $country=$user->country;
  $city=$user->city;
  $education=$user->education;
  $company=$user->company;
  
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
           $user=$UM->getUserById($id);
           $user->firstName=$firstName;
           $user->lastName=$lastName;
           $user->email=$email;
           $user->password=$password;
		   $user->country=$country;
		   $user->city=$city;
		   $user->education=$education;
		   $user->company=$company;
           $UM->saveUser($user);
           header("Location:../../adminhome.php");
       }
  }else{
      $formerror="Please provide required values";
  }
}
?>
<body bgcolor=turquoise>
<div class = "content" align="center">
<form name="myForm" method="post">
<h1 align="center">Update Profile</h1>
<div align="center"><?=$formerror?></div>
<table border='1' width="800">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstName" value="<?=$firstName?>" size="50"></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastName" value="<?=$lastName?>" size="50"></td>
  </tr>
  <tr>    
    <td>Email</td>
    <td><input type="text" name="email" value="<?=$email?>" size="50"></td>
  </tr>
  <tr>    
    <td>Password</td>
    <td><input type="password" name="password" value="<?=$password?>" size="20"></td>
  </tr>  
  <tr>    
    <td>Confirm Password</td>
    <td><input type="password" name="cpassword" value="<?=$password?>" size="20"></td>
  </tr> 
<tr>    
    <td>Country</td>
    <td><input type="text" name="country" value="<?=$country?>" size="20"></td>
  </tr> 
<tr>    
    <td>City</td>
    <td><input type="text" name="city" value="<?=$city?>" size="20"></td>
  </tr> 
<tr>    
    <td>Education</td>
    <td><input type="text" name="education" value="<?=$education?>" size="20"></td>
  </tr> 
  
  <tr>    
    <td>Company</td>
    <td><input type="text" name="company" value="<?=$company?>" size="20"></td>
  </tr>  
  <tr>
    <td colspan="2" align="right">
       <input type="hidden" name="submitted" value="1"><input type="submit" name="submit" value="Submit">
       <input type="submit" name="clear" value="Clear Search" onclick="javascript:clearForm();">
    </td>
  </tr>
</table>
</form>
</div>
</body>


<?php
include '../../includes/footer.php';
?>