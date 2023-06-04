<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Change password</h1>
		<br><br>

		<?php 
		  if(isset($_GET['id']))
		  {
		  	$id=$_GET['id'];
		  }
		?>

		<form action="" method="post">
			<table class="tbl-30">
				<tr>
					<td>Current Password:</td>
					<td>
						<input type="password" name="current_password" placeholder="Enter Your Current password">
					</td>
				</tr>

				<tr>
					<td>New Password:</td>
					<td>
						<input type="pasword" name="new_password" placeholder="Enter Your New password">
					</td>
				</tr>
				<tr>
					<td>Confirm Password:</td>
					<td>
						<input type="password" name="confirm_password" placeholder="Confirm Your New Password">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Change Password" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php 
   
   //Check wheter the submit Button is clicked or not
   if(isset($_POST['submit']))
   {
   	     //echo "Clciked";

   	     //1.Get the data from form
   	     $id=$_POST['id'];
   	     $current_password=md5($_POST['current_password']);
   	     $new_password=md5($_POST['new_password']);
   	     $cofirm_password=md5($_POST['confirm_password']);

   	     //2.Check wheter the user with current id and current password exists or not
   	     $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

   	     //Execute the query
   	     $res=mysqli_query($conn,$sql);

   	     if($res==true)
   	     {
   	     	//check wheter the data is available or not
   	     	$count=mysqli_num_rows($res);

   	     	if($count==1)
   	     	{
   	     		//User exists and password can be changed
   	     		//echo "User is Found";

   	     		//check wheter the new password and confirm match or not
   	     		if($new_password==$confirm_password)
   	     		{
   	     			//update the password
   	     			//echo "password is matched";
   	     			$sql2="UPDATE tbl_admin SET 
   	     			password='$new_password'
   	     			WHERE id=$id
   	     			";

   	     			//Execute the query
   	     			$res2=mysqli_query($conn,$sql2);

   	     			//check wheter the query executed or not
   	     			if($res2==true)
   	     			{
   	     				//Display success Message
   	     				//redirect to Manage Admin page with error Message
   	     			    $_SESSION['change-pwd']="<div class='success'>Password changed successfully.</div>";
   	     		        //Redirect the user
   	     		        header('location:'.mysiteurl.'admin/manage-admin.php');

   	     			}
   	     			else
   	     			{
   	     				//Display error Message
   	     				//redirect to Manage Admin page with error Message
   	     			    $_SESSION['change-pwd']="<div class='error'>Failed to change password.</div>";
   	     		        //Redirect the user
   	     		        header('location:'.mysiteurl.'admin/manage-admin.php');
   	     			}
   	     		}
   	     		else
   	     		{
   	     			//redirect to Manage Admin page with error Message
   	     			$_SESSION['pwd-not-match']="<div class='error'>Password did not match.</div>";
   	     		    //Redirect the user
   	     		    header('location:'.mysiteurl.'admin/manage-admin.php');
   	     		}
   	     	}
   	     	else
   	     	{
   	     		//User does not exist set message and redirect
   	     		$_SESSION['user-not-found']="<div class='error'>User is not Found.</div>";
   	     		//Redirect the user
   	     		header('location:'.mysiteurl.'admin/manage-admin.php');
   	     	}
   	     }
   }
?>

<?php include('partials/footer.php'); ?>