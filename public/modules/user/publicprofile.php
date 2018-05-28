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
$email=$_REQUEST["email"];
$UM=new UserManager();
$user=$UM->getUserByEmail($email);
if(isset($user)){
    ?>
	<body bgcolor=turquoise>
    <div class = "content" align="center">
	<br><br><br>
    <table width="50%">
	<tbody>
			<tr></tr>
			<tr></tr>
			<tr><h2> Profile of <?=$user->firstName?></h2></tr>
			<tr></tr>
			<tr></tr>
            <tr><td><b>First Name</b></td><td></td><td><?=$user->firstName?></td></tr>
            <tr><td><b>Last Name</b></td><td></td><td><?=$user->lastName?></td></tr>
            <tr><td><b>Email</b></td><td></td><td><?=$user->email?></td></tr>
			<tr><td><b>Country</b></td><td></td><td><?=$user->country?></td>
            <tr><td><b>City</b></td><td></td><td><?=$user->city?></td></tr>
            <tr><td><b>Education</b></td><td></td><td><?=$user->education?></td></tr>
            <tr><td><b>Company</b></td><td></td><td><?=$user->company?></td></tr> 
	</tbody>		
</table>			
</body>			<?php }
include '../../includes/footer.php';
?>
                              		                            