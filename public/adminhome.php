<?php
include 'includes/security.php';
//invoke adminmain menu

  if(isset($_SESSION["email"])){
  include 'includes/adminmainmenu.php';}
  echo "<center><h3>"."Welcome Home ".$_SESSION["firstName"]."</h3></center>"
       ?>
<head>
<link rel="stylesheet" href="/communityportal/public/css/style.css">
</head>


