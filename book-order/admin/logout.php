<?php 
   //include constants.php for mysiteurl
   include('../config/constants.php');
   //1.Destroy the session
   session_destroy();

   //2.Redirect to login page
   header('location:'.mysiteurl.'admin/login.php');
?>