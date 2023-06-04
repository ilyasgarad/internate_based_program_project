<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Category</h1>

		<br><br>

		<?php 

		   if(isset($_SESSION['add']))
		   {
		   	   echo $_SESSION['add'];
		   	   unset($_SESSION['add']);
		   }

		   if(isset($_SESSION['upload']))
		   {
		   	   echo $_SESSION['upload'];
		   	   unset($_SESSION['upload']);
		   }
		?>

		<br><br>
		<!-- Add category form starts -->
		<form action="" method="post" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Category Title">
					</td>
				</tr>

				<tr>
					<td>Select Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="Yes">Yes 
						<input type="radio" name="featured" value="No">No 
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input type="radio" name="active" value="Yes">Yes 
						<input type="radio" name="active" value="No">No 
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Category" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

		<!-- Add category form ends -->

		<?php 


		   //check wheter the submit Button is clicked or not
		   if(isset($_POST['submit']))
		   {
		   	   //echo "Clicked";

		   	   //1.Get the value from category form
		   	   $title=$_POST['title'];
		   	   //for radio input,we need to check wheter the Button is selected or not
		   	   if(isset($_POST['featured']))
		   	   {
		   	   	    //Get the value from form
		   	   	    $featured=$_POST['featured'];
		   	   }
		   	   else
		   	   {
		   	   	   //Set the default value 
		   	   	   $featured="No";
		   	   }
		   	   if(isset($_POST['active']))
		   	   {
		   	   	   //Get the value from form
		   	   	   $active=$_POST['active'];
		   	   }
		   	   else
		   	   {
		   	   	   //Set the default value
		   	   	   $active="No";
		   	   }

		   	   //check wheter the image is selected or not and set the value for image name accordingly
		   	   //print_r($_FILES['image']);

		   	   //die();//bereak the code here

		   	   if(isset($_FILES['image']['name']))
		   	   {
		   	   	    //upload the image
		   	   	    // to upload image we need image name,source path and destination path
		   	   	    $image_name=$_FILES['image']['name'];

		   	   	    //upload the image only if image name is selected
		   	   	    //upload the image if only image name is select
		   	   	    if($image_name!="")
		   	   	    {


		   	   	        //Auto Rename our image
		   	   	        //Get the extension of our image(jpg,png,gif,etc) e.g "specialfood1.jpg"
		   	   	        $ext=end(explode('.',$image_name));

		   	   	        //Rename the image
		   	   	        $image_name="Book_Category_".rand(000,999).'.'.$ext;// e.g Food_Category_875.jpg

		   	   	        $source_path=$_FILES['image']['tmp_name'];

		   	   	        $destination="../images/category/".$image_name;

		   	   	        //finaly Upload the image
		   	   	        $upload=move_uploaded_file($source_path, $destination);

		   	   	        //check wheter the image is uploaded or not
		   	   	        //and if the image is not uploaded then we will stop the process and redirect with error message
		   	   	        if($upload==false)
		   	   	        {
		   	   	    	    //set message
		   	   	    	    $_SESSION['upload']="<div class='error'>You failed to upload Image</div>";
		   	   	    	   //Redirect to add category page
		   	   	    	   header('location:'.mysiteurl.'admin/add-category.php');
		   	   	    	   //stop the process
		   	   	    	   die();
		   	   	        }
		   	   	    }


		   	   }
		   	   else 
		   	   {
		   	   	    //don't upload image and set the image_name value as blank
		   	   	    $image_name="";
		   	   }

		   	   //2.Create sql query to insert category into database
		   	   $sql=" INSERT INTO tbl_category SET 
		   	        title='$title',
		   	        image_name='$image_name',
		   	        featured='$featured',
		   	        active='$active'
		   	    ";

		   	    //3.Execute the query and save in database
		   	    $res=mysqli_query($conn,$sql);

		   	    //4.check wheter the query executed or not and data added or not
		   	    if($res==true)
		   	    {
		   	    	//Query executed and category added
		   	    	$_SESSION['add']="<div class='success'>Category Added Successfully</div>";
		   	    	//Redirect to Manage category page
		   	    	header('location'.mysiteurl.'admin/manage-category.php');
		   	    }
		   	    else
		   	    {
		   	    	//Failed to add category
		   	    	$_SESSION['add']="<div class='error'>Category Added Successfully</div>";
		   	    	//Redirect to Manage category page
		   	    	header('location'.mysiteurl.'admin/add-category.php');
		   	    }
		   }
		?>
	</div>
</div>


<?php include('partials/footer.php'); ?>