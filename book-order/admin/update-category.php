<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Category</h1>

		<br><br>

		<?php 

		     //check wheter the id is set or not
		      if(isset($_GET['id']))
		      {
		      	  //get the ID and all other details
		      	  //echo "getting the data";
		      	  $id=$_GET['id'];
		      	  //create sql query to get all other details
		      	  $sql="SELECT * FROM tbl_category WHERE id=$id";

		      	  //Execute the query
		      	  $res=mysqli_query($conn,$sql);

		      	  //count the rows to check wheter the id is valid or not
		      	  $count=mysqli_num_rows($res);

		      	  if($count==1)
		      	  {
		      	  	   //Get all the data
		      	  	   $row=mysqli_fetch_assoc($res);
		      	  	   $title=$row['title'];
		      	  	   $current_image=$row['image_name'];
		      	  	   $featured=$row['featured'];
		      	  	   $active=$row['active'];
		      	  }
		      	  else
		      	  {
		      	  	   //redirect to manage category with session message
		      	  	   $_SESSION['no-category-found']="<div class='error'>Category not found</div>";
		      	  	   header('location:'.mysiteurl.'admin/manage-category.php');
		      	  }
		      }
		      else
		      {
		      	   //redirect to manage category
		      	   header('location:'.mysiteurl.'admin/manage-category.php');
		      }
		?>
		
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
			<tr>
				<td>Title: </td>
				<td>
					<input type="text" name="title" value="<?php echo $title; ?>">
				</td>
			</tr>

			<tr>
				<td>Current Image: </td>
				<td>
					<?php 

					     if($current_image!="")
					     {
					     	//display the image
					     	?>
					     	<img src="<?php echo mysiteurl; ?>images/category/<?php echo $current_image; ?>" width="80px" alt="80px">
					     	<?php 
					     }
					     else
					     {
					     	//display message
					     	echo "<div class='error'>Image not Added.</div>";
					     }
					?>
				</td>
			</tr>

			<tr>
				<td>New Image: </td>
				<td>
					<input type="file" name="image">
				</td>
			</tr>
			<tr>
				<td>Featured: </td>
				<td>
					<input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes 

					<input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No 

				</td>
			</tr>

			<tr>
				<td>Active: </td>
				<td>
					<input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes 

					<input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No 

				</td>
			</tr>

			<tr>
				<td>
					<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" name="submit" value="Update Category" class="btn-secondary">
				</td>
			</tr>
		    </table>
		</form>
		<?php 

		     if(isset($_POST['submit']))
		     {
		     	//echo "clicked";
		     	//1.Get all the values from our form
		     	$id=$_POST['id'];
		     	$title=$_POST['title'];
		     	$current_image=$_POST['current_image'];
		     	$featured=$_POST['featured'];
		     	$active=$_POST['active'];

		     	//2.updating new image if selected
		     	//check wheter the image is selected or not 
		     	if(isset($_FILES['image']['name']))
		     	{
		     		//Get the Image Details
		     		$image_name=$_FILES['image']['name'];

		     		//check wheter the image is available or not
		     		if($image_name!="")
		     		{
		     			//Image available
		     			//A.Upload the New Image

		     			//Auto Rename our Image
		     			//Get the extension of our image
		     			$ext=end(explode('.',$image_name));

		     			//Rename the Image
		     			$image_name="Book_Category_".rand(000,999).'.'.$ext;

		     			$source_path=$_FILES['image']['tmp_name'];

		     			$destination_path="../images/category/".$image_name;

		     			//finaly upload the image
		     			$upload=move_uploaded_file($source_path, $destination_path);

		     			//check wheter the image is uploaded or not
		     			//and if the image is not uploaded then stop the process and redirect with error message
		     			if($upload==false)
		     			{
		     				//set message
		     				$_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
		     				//Redirect to add category page
		     				header('location:'.mysiteurl.'admin/manage-category.php');
		     				//stop the process
		     				die();
		     			}
		     			//B. Remove the Current Image if available
		     			if($current_image!="")
		     			{
		     				$remove_path="../images/category".$current_image;

		     				$remove=unlink($remove_path);

		     				//check wheter the image is removed or not
		     				//if failed to remove then display message and stop the process
		     				if($remove==false)
		     				{
		     					//failed to Remove image
		     					$_SESSION['failed-remove']="<div class='error'>You Failed to remove current Image</div>";
		     					header('location:'.mysiteurl.'admin/manage-category.php');
		     					die();
		     				}
		     			}

		     		}
		     		else
		     		{
		     			$image_name=$current_image;
		     		}
		     	}
		     	else
		     	{
		     		$image_name=$current_image;
		     	}

		     	//3.update the database
		     	$sql2="UPDATE tbl_category SET 
		     	    title='$title',
		     	    image_name='$image_name',
		     	    featured='$featured',
		     	    active='$active'
		     	    WHERE id=$id
		     	";

		     	//Execute the Query
		     	$res2=mysqli_query($conn,$sql2);

		     	//4.Redirect to manage category with message
		     	//check wheter executed or not
		     	if($res2==true)
		     	{
		     		//category updated
		     		$_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
		     		header('location:'.mysiteurl.'admin/manage-category.php');
		     	}
		     	else
		     	{
		     		//failed to update category
		     		$_SESSION['update']="<div class='error'>You failed to update category.</div>";
		     		header('location:'.mysiteurl.'admin/manage-category.php');
		     	}
		     }
		?>

	</div>
</div>
<?php include('partials/footer.php'); ?>