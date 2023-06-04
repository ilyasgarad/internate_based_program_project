<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Admin</h1>

		<br><br>
		
		<?php 
		   if(isset($_SESSION['add']))
		   {
		   	   echo $_SESSION['add'];
		   	   unset($_SESSION['add']);
		   }
		?>

		<form action="" method="post">
			<table class="tbl-30">
				<tr>
					<td>Full Name:</td>
					<td>
						<input type="text" name="full_name" placeholder="Enter your name">
					</td>
				</tr>
				<tr>
					<td>Username:</td>
					<td>
						<input type="text" name="username" placeholder="Enter your username">
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td>
						<input type="password" name="password" placeholder="Enter your Password">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include('partials/footer.php'); ?>


<?php 
   //Process the value from form and save it in database
   //Check wheter the submit button is clicked or not
   if(isset($_POST['submit']))
   {
   	  //Button Clicked
   	//echo "Button Clicked";

   	//1.Get the Data from form
   	 //$full_name=$_POST['full_name'];
   	 $full_name=mysqli_real_escape_string($conn,$_POST['full_name']);

   	 //$username=$_POST['username'];
   	 $username=mysqli_real_escape_string($conn,$_POST['username']);

   	 $password=md5($_POST['password']);
   	 $cpassword=mysqli_real_escape_string($conn,$password);

   	 //2.SQL Query to save the data into database
   	 $sql="INSERT INTO tbl_admin SET 
   	    full_name='$full_name',
   	    username='$username',
   	    password='$password'
   	 ";

   	 //echo $sql;
   	 

     //3.Execute Query and Saving Data into database
   	 $res=mysqli_query($conn,$sql) or die(mysqli_error());

   	 //4.Check wheter the (Query is executed) data is inserted or not
   	 if($res==TRUE)
   	 {
   	 	//Data inserted
   	 	//echo "Data inserted";
   	 	//Create a session variable to display Message
   	 	$_SESSION['add']="<div class='success'>Admin Added Successfully</div>";
   	 	//Redirect page to manage Admin
   	 	header("location:".mysiteurl.'admin/manage-admin.php');
   	 }
   	 else
   	 {
   	 	//Failed to insert data
   	 	//echo "Failed to insert data";
   	 	//Create a session variable to display Message
   	 	$_SESSION['add']="<div class='error'>Failed to Add Admin</div>";
   	 	//Redirect page to Add Admin
   	 	header("location:".mysiteurl.'admin/add-admin.php');
   	 }

   }

?>