<?php
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
//include '../../includes/mainmenu.php';
?>
<head>
<title>Search a record</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/communityportal/public/css/style.css">
</head>

<body onload='setFocusfirstName();'>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/communityportal/index.php"><img src="/communityportal/public/images/logo.png" class="img-responsive" style="height:50px"></a>
    </div> 
<?php 
   if(isset($_SESSION["email"])){
       ?>
	<div class="collapse navbar-collapse" id="myNavbar">	
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="/communityportal/public/home.php">Home</a> &nbsp;</li>
      <li><a href="/communityportal/public/modules/user/updateprofile.php">Update Profile</a> &nbsp;</li>
      <li><a href="/communityportal/public/modules/user/userlist.php">View Users</a> &nbsp;</li>
	  <li><a href="/communityportal/public/modules/user/search.php">Search</a> &nbsp; </li>
	  <li><a href="/communityportal/public/logout.php">Logout</a> &nbsp;</li>
	</ul>
	
 <?php 
   }
?>	
	</div>
</div>
</nav>
<?php 
$firstName="";
$lastName="";
$country="";
$city="";
$formError="";
     
      if(isset($_POST['Search'])){
         
         $firstName = $_POST["firstName"];
         $lastName = $_POST["lastName"];
		 $country = $_POST["country"];
		 $city = $_POST["city"];
        if ($firstName!=''||$lastName!=''||$country!=''||$city!=''){
			 $UM=new UserManager();
        if($firstName!='')
         {
            $users=$UM->getUserByFirstname($firstName,$lastName);
                     
        }
		if($lastName!='')
         {
			$users=$UM->getUserByLastname($firstName,$lastName);  
        }
		if($country!='')
         {
			$users=$UM->getUserByCountry($country);  
        }
		if($city!='')
         {
			$users=$UM->getUserByCity($city);  
        }
         
     }
	 else
	 {
		$formError = "Wrong Input";
	 }
	  }
 ?>
 <form action="search.php" method="post" class="form-inline" style="width:70%;">
 <p style="color:red"><?=$formError?></p>
  <div class="row">
      <input type="text" class="form-control" name="firstName" value="<?=$firstName?>"  placeholder="First name"> 
      <input type="text" class="form-control" name="lastName" value="<?=$lastName?>" placeholder="Last name">
      <input type="text" class="form-control" name="country" value="<?=$country?>" placeholder="country">
      <input type="text" class="form-control" name="city" value="<?=$city?>" placeholder="city">
      <input type="submit" name="Search" value="Search" class="btn">
	  <input type="submit" name="ClearSearch" value="Clear" class="btn">
  </div>
</form>  
<?php
/*
 <form action="search.php" method="post" class="form-inline form">
  <div class="row">
    <div class="input-group">
      <input type="text" class="form-control" name="firstName" value="<?=$firstName?>"  placeholder="First name">
    </div>
    <div class="input-group">
      <input type="text" class="form-control" name="lastName" value="<?=$lastName?>" placeholder="Last name">
    </div>
	<div class="input-group">
      <input type="text" class="form-control" name="country" value="<?=$country?>" placeholder="country">
    </div>
	<div class="input-group">
      <input type="text" class="form-control" name="city" value="<?=$city?>" placeholder="city">
    </div>
	</div>
	<div class="input-group">
  <center> 
    <input type="submit" name="Search" value="Search" class="btn">
	<input type="submit" name="ClearSearch" value="ClearSearch"  class="btn">
	</center>
  </div>
</form>  
*/
?>

   
     
     <?php 
          if(!isset($users)){
		  $formError= "No records found";
		  }
			   else{
		      ?>
				
    <br/><br/><h3 align="center">Search Results</h3> <br/><br/>
    <table align="center" width="800" border="1">
            <tr>
               <td><b>First Name</b></td>
               <td><b>Last Name</b></td>
               <td><b>Country</b></td>
			   <td><b>City</b></td>
               <td><b>Company</b></td>
			   <td></td>
        
            </tr>    
    <?php 
    foreach ($users as $user) {
        if($user!=null){
            ?>
            <tr>
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
               <td><?=$user->country?></td>
               <td><?=$user->city?></td>         
                <td><?=$user->company?></td>
                <td><b><a href="publicprofile.php?email=<?=$user->email?>">View</a></b></td>
                 
                  
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/><br/>
    <?php 
}
?>
</body> 