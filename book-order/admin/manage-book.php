<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Manage Book</h1>
		<br><br><br><br>

			<!-- Button to Add Admin -->
			<a href="<?php echo mysiteurl; ?>admin/add-book.php" class="btn-primary">Add Book</a>

			<br><br><br><br>

			<?php 
			     if(isset($_SESSION['add']))
			     {
			     	echo $_SESSION['add'];
			     	unset($_SESSION['add']);
			     }

			     if(isset($_SESSION['delete']))
			     {
			     	echo $_SESSION['delete'];
			     	unset($_SESSION['delete']);
			     }

			     if(isset($_SESSION['upload']))
			     {
			     	echo $_SESSION['upload'];
			     	unset($_SESSION['upload']);
			     }

			     if(isset($_SESSION['unauthorize']))
			     {
			     	echo $_SESSION['unauthorize'];
			     	unset($_SESSION['unauthorize']);
			     }

			     if(isset($_SESSION['update']))
			     {
			     	echo $_SESSION['update'];
			     	unset($_SESSION['update']);
			     }
			?>
			<table class="tbl-full">
				<tr>
					<th>S.N</th>
					<th>Title</th>
					<th>Price</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				<?php 
				     //Create a sql query to get all details
				      $sql="SELECT * FROM tbl_book";

				      //Execute the query
				      $res=mysqli_query($conn,$sql);

				      //Create serial number variable and set default as 1
				      $sn=1;

				      //count Rows to check wheter we have book or not
				      $count=mysqli_num_rows($res);

				      if($count>0)
				      {
				      	//we have book in database
				      	//Get the books from Database and Display
				      	while($row=mysqli_fetch_assoc($res))
				      	{
				      		//get the values form indivual columns
				      		$id=$row['id'];
				      		$title=$row['title'];
				      		$price=$row['price'];
				      		$image_name=$row['image_name'];
				      		$featured=$row['featured'];
				      		$active=$row['active'];
				      		?>

				      				<tr>
					                   <td><?php echo $sn++; ?>.</td>
					                   <td><?php echo $title; ?></td>
					                   <td>$<?php echo $price; ?></td>
					                   <td>
					                   	<?php 
					                   	    //check wheter we have image or not
					                   	    if($image_name=="")
					                   	    {
					                   	    	// we don't have image,display error
					                   	    	echo "<div class='error'>Image not Added.</div>";
					                   	    }
					                   	    else 
					                   	    {
					                   	    	// we have image,display it
					                   	    	?>
					                   	    	<img src="<?php echo mysiteurl; ?>images/book<?php echo $image_name; ?>" width="100px">
					                   	    	<?php
					                   	    }
					                   	?>
					                   </td>
					                   <td><?php echo $featured; ?></td>
					                   <td><?php echo $active; ?></td>
					                   <td>
<a href="<?php echo mysiteurl; ?>admin/update-book.php?id=<?php echo $id; ?>" class="btn-secondary">Update Book</a>
<a href="<?php echo mysiteurl; ?>admin/delete-book.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Book</a>
					                   </td>
				                    </tr>



				      		<?php 
				      	}
				      }
				      else
				      {
				      	//No book added
				      	echo "<tr><td colspan='7' class='error'>Book not added yet.</td></tr>";
				      }
				?>


			</table>
	</div>
</div>

<?php include('partials/footer.php'); ?>