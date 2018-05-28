<?php
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;
ob_start();
include '../../includes/security.php';
include '../../includes/header.php';
include '../../includes/adminmainmenu.php';
?>
<script>
$("#checkAl").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
});
</script>

<?php 
$checked=array();
$UM=new UserManager();
$users=$UM->getAllUsers();
if(isset($users)){
    ?>
<style>
body{
	background:turquoise;
}
</style>	
	
<body>
<div class = "content" align="center">
<div class="container">
     <div class="panel panel-primary">
      <div class="panel-heading"><h3>List of users</h3></div>
      <div class="panel-body">
	  <table class="table table-hover" align = "center" width="800" border="1">
            <tr>
			   <td><b>Id</b></td>
               <td><b>First Name</b></td>
               <td><b>Last Name</b></td>
               <td><b>Email</b></td>
			   <td><b>Country</b></td>
               <td><b>City</b></td>
               <td><b>Education</b></td>
               <td><b>Company</b></td>
			   <td><b>View</b></td>
			   <td><b>Update</b></td>
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
			   <td><b><a href="a.php?id=<?=$user->id?>">Update</a></b></td>
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/><br/>
	</div>
	</div>
	</div>
	</body>
    <?php 
}
?>

<?php
if(isset($_POST['save'])){
$checked= $_POST['check'];
for($i=0;$i<count($checked);$i++){
$del_id = $checked[$i];
$UM=new UserManager(); 
$UM->deleteUserById("$del_id");
$message = "Data deleted successfully !";
}
?>



<?php
}
?>