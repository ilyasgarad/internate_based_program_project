<?php 

   //Authorization-Access control
   //Check wheter the user is logged in or not
   if(!isset($_SESSION['user']))
   {
   	   //User is not logged in
   	   //check wheter the user is logged in or not
   	   $_SESSION['no-login-message']="<div class='error text-center'>Please login to access Admin Panel.</div>";
   	   //Redirect to login page
   	   header('location:'.mysiteurl.'admin/login.php');
   }
?>