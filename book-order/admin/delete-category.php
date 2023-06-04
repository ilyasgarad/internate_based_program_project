<?php 
   //echo "Delete category";
   //Include Constants files
   include('../config/constants.php');

   //check wheter the id and image are set or not
   if(isset($_GET['id']) AND isset($_GET['image_name']))
   {
   	   //Get the value and delete
   	   //echo "Get the value and delete";
   	   //Get the value and delete
   	   $id=$_GET['id'];
   	   $image_name=$_GET['image_name'];

   	   //Remove the available image file
   	   if($image_name!="")
   	   {
   	   	  //image is available.so remove it
   	   	  $path="../images/category/".$image_name;
   	   	  //Remove the image
   	   	  $remove=unlink($path);

   	   	  //if u failed to remove then add an error and stop the process
   	   	  if($remove==false)
   	   	  {
   	   	  	  //set the session Message
   	   	  	  $_SESSION['remove']="<div class='error'>You failed to remove category page</div>";
   	   	  	  //Redirect to manage category page
   	   	  	  header('location:'.mysiteurl.'admin/manage-category.php');
   	   	  	  //stop the process
   	   	  	  die();
   	   	  }
   	   }

   	   //delete data from database
   	   //SQL Query to delete data from database
   	   $sql="DELETE FROM tbl_category WHERE id=$id";

   	   //Execute the query
   	   $res=mysqli_query($conn,$sql);

   	   //check wheter the data is deleted from database or not
   	   if($res==true)
   	   {
   	   	    //set success message and redirect
            $_SESSION['delete']="<div class='success'>Category Deleted Successfully.</div>";
            //Redirect to manage category
            header('location:'.mysiteurl.'admin/manage-category.php');
   	   }
   	   else
   	   {
   	   	    //set the fail message and redirect
             $_SESSION['delete']="<div class='error'>You failed to deletecategory,try again</div>";
            //Redirect to manage category
            header('location:'.mysiteurl.'admin/manage-category.php');
   	   }
   }
   else
   {
   	  //redirect to manage category page
   	  header('location:'.mysiteurl.'admin/manage-category.php');
   }
?>