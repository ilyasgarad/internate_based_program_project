<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login-Book Order System</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>

	<div class="login">
		<h1 class="text-center">Login</h1>
		<br><br>

		<?php 
		   if(isset($_SESSION['login']))
		   {
		   	   echo $_SESSION['login'];
		   	   unset($_SESSION['login']);
		   }

		   if(isset($_SESSION['no-login-message']))
		   {
		   	   echo $_SESSION['no-login-message'];
		   	   unset($_SESSION['no-login-message']);
		   }
		?>
		<br><br>
		<!-- Login Form start here -->
		<form action="" method="post" class="text-center">
			Username:<br>
			<input type="text" name="username" placeholder="Enter Username"><br><br>
			Password:<br>
			<input type="password" name="password" placeholder="Enter Password"><br><br>

			<input type="submit" name="submit" value="login" class="btn-primary"><br><br>
		</form>

		<!-- Login Form Ends here -->

		<p class="text-center">Created by<a href="#">ISSAKHA FADOUL BERE</a></p>
	</div>

</body>
</html>

<?php 
   
   //check wheter the submit Button is clicked or not
   if(isset($_POST['submit']))
   {
   	   //process for login
   	   //1.Get the data from login form
   	   //$username=$_POST['username'];
   	   $username=mysqli_real_escape_string($conn,$_POST['username']);
   	   
   	   //$password=md5($_POST['password']);
   	   $raw_password=md5($_POST['password']);
   	   $password=mysqli_real_escape_string($conn,$raw_password);

   	   //2.SQL to check wheter the user with username and password exists or not
   	   $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

   	   //3.Execute the query
   	   $res=mysqli_query($conn,$sql);

   	   //4.count rows to check wheter the user exists or not
   	   $count=mysqli_num_rows($res);

   	   if($count==1)
   	   {
   	   	    //User available and login Success
   	   	    $_SESSION['login']="<div class='success'>Login Successfull.</div>";
   	   	    $_SESSION['user']=$username;/*to check wheter the user is logged in or not and logout using unset with session_destor*/
   	   	    //Redirect to home page/Dashboard
   	   	    header('location:'.mysiteurl.'admin/index.php');
   	   }
   	   else
   	   {
   	   	    //User available and login Success
   	   	    $_SESSION['login']="<div class='error text-center'>Failed to login username or password didn't match.</div>";
   	   	    //Redirect to home page/Dashboard
   	   	    header('location:'.mysiteurl.'admin/login.php');
   	   }
   }
?>