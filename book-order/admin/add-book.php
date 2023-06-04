<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Book</h1>

		<br><br>

		<?php 
		     if(isset($_SESSION['upload']))
		     {
		     	echo $_SESSION['upload'];
		     	unset($_SESSION['upload']);
		     }
		?>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Enter book title">
					</td>
				</tr>

				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" rows="5" cols="20" placeholder="Enter book description"></textarea>
					</td>
				</tr>

				<tr>
					<td>Price:         </td>
					<td>
						<input type="number" name="price">
					</td>
				</tr>

				<tr>
					<td>Select_Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category: </td>
					<td>
						<select name="category">

							<?php 
							     //Create php code to display categories from database
							     //1.Create sql to get all active categories from database
							     $sql="SELECT * FROM tbl_category WHERE active='Yes'";

							     //Execute query
							     $res=mysqli_query($conn,$sql);

							     //count Rows to check wheter we have categories or not
							     $count=mysqli_num_rows($res);

							     //if count is greater than zero,we have categories else we do not
							     if($count>0)
							     {
							     	//we have categories
							     	while($row=mysqli_fetch_assoc($res))
							     	{
							     		//get the details of categories
							     		$id=$row['id'];
							     		$title=$row['title'];

							     		?>
							     		<option value="<?php echo $id; ?>"><?php echo $title; ?></option>

							     		<?php 
							     	}
							     }
							     else
							     {
							     	//we do not have categories
							     	?>
							     	<option value="0">No Cateogry Found</option>
							     	<?php 
							     }

							     //2.Display on Description
							?>
						</select>
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
						<input type="submit" name="submit" value="Add Book" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

		<?php 

		     //check wheter the button is clicked or not
		     if(isset($_POST['submit']))
		     {
		     	//add the food in database
		     	//echo "clicked";

		     	//1.Get the data from form
		     	$title=$_POST['title'];
		     	$description=$_POST['description'];
		     	$price=$_POST['price'];
		     	$category=$_POST['category'];

		     	//check wheter radio button for featured and active are checked or not
		     	if(isset($_POST['featured']))
		     	{
		     		$featured=$_POST['featured'];
		     	}
		     	else
		     	{
		     		$featured="No";
		     	}

		     	if(isset($_POST['active']))
		     	{
		     		$active=$_POST['active'];
		     	}
		     	else
		     	{
		     		$active="No";
		     	}

		     	//2.Upload the image if selected
		     	//check wheter the select image is selected or not and upload the image if selected
		     	if(isset($_FILES['image']['name']))
		     	{
		     		//Get the details of selected image
		     		$image_name=$_FILES['image']['name'];

		     		//check wheter the image is selected or not and upload image if selected
		     		if($image_name!="")
		     		{
		     			//Image is selected
		     			//A.Rename the image
		     			$ext=end(explode('.',$image_name));

		     			//create new name for image
		     			$image_name="Book-Name-".rand(0000,9999).".".$ext;

		     			//B. upload the Image
		     			//Get the src path and destination path
		     			$src=$_FILES['image']['tmp_name'];

		     			//Destination path for the image to be uploaded
		     			$dst="../images/book/".$image_name;

		     			//finaly upload the food image
		     			$upload=move_uploaded_file($src, $dst);

		     			//check wheter image uploaded or not
		     			if($upload==false)
		     			{
		     				//failed to upload image
		     				//Redirect to add food page with error Message
		     				$_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";
		     				header('location:'.mysiteurl.'admin/add-book.php');
		     				//stop the process
		     				die();
		     			}
		     		}
		     	}
		     	else
		     	{
		     		$image_name="";
		     	}

		     	//3.Insert data into database

		     	//Create a sql query to save or add food
		     	//for numerical we don't need to use single quote but in string must use
		     	$sql2="INSERT INTO tbl_book SET 
		     	title='$title',
		     	description='$description',
		     	price=$price,
		     	image_name='$image_name',
		     	category_id=$category,
		     	featured='$featured',
		     	active='$active'
		     	";

		     	//Execute the Query
		     	$res2=mysqli_query($conn,$sql2);
		     	//check wheter data inserted or not
		     	//4.Redirect with message to manage food page
		     	if($res2==true)
		     	{
		     		//data inserted successfully
		     		$_SESSION['add']="<div class='success'>Book Added Successfully.</div>";
		     		header('location:'.mysiteurl.'admin/manage-book.php');
		     	}
		     	else
		     	{
		     		//failed to insert data
		     		$_SESSION['add']="<div class='error'>Failed to Add Book</div>";
		     		header('location:'.mysiteurl.'admin/manage-book.php');
		     	}


		     }
		?>
	</div>
</div>
<?php include('partials/footer.php'); ?>