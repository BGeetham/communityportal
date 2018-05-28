<?php

ob_start();

require_once '../../includes/autoload.php';
include '../../includes/header.php';
include '../../includes/mainmenu.php';

use classes\business\UserManager;
use classes\entity\User;


include '../../includes/security.php';
$firstName="";
$lastName="";
$email="";
$password="";
$country="";
$city="";
$education="";
$company="";
//$users=[];
   
      if(isset($_POST['Search'])){
         
         $firstName = $_POST["firstName"];
         $lastName = $_POST["lastName"];
         
          if($firstName!='')
         {
       
             $UM=new UserManager();
             $users=$UM->getUserByfirstName($firstName);
                      
        }
         
     }
     
    if(!isset($users)){
         
 ?>
	<body>
    <div class = "content" align="center">
    <br/><br/>Search Results<br/><br/>
    <table align = "center" width="800" border="1">
            <tr>
               <td><b>Id</b></td>
               <td><b>First Name</b></td>
               <td><b>Last Name</b></td>
               <td><b>Email</b></td>
			   <td><b>Country</b></td>
               <td><b>City</b></td>
               <td><b>Education</b></td>
               <td><b>Company</b></td>
			   <td></td>
			   
            </tr>    
    <?php 
   foreach ($users as $user) {
        if($user!=null){
            ?>
            <tr>
               <td><?=$user->id?></td>
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
               <td><?=$user->email?></td>
			   <td><?=$user->country?></td>
               <td><?=$user->city?></td>
               <td><?=$user->education?></td>
               <td><?=$user->company?></td>
               <td><b><a href="publicprofile.php?email=<?=$user->email?>">View</a></b></td>
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/><br/>
	</div>
	</body>
    <?php 
}
?>


<?php
include '../../includes/footer.php';
?>