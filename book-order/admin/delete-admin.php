<?php 

    //include Constants.php file here
    include('../config/constants.php');

    //1.get the ID of Admin to be deleted
    echo $id=$_GET['id'];

    //2.Create SQL query to delete Admin
    $sql="DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res=mysqli_query($conn,$sql);

    //Check wheter the query executed successfully or not
    if($res==true)
    {
    	//Query executed succssfully and admin deleted
    	//echo "Admin Deleted"; 
    	//Create Session Variable to display Message
    	$_SESSION['delete']="<div class='success'>Admin deleted successfully.</div>";
    	//Redirect to Manage Admin Page
    	header('location:'.mysiteurl.'admin/manage-admin.php');
    }
    else
    {
    	//Failed to delete admin
    	//echo "Failed to delete Admin";
    	$_SESSION['delete']="<div class='error'>Failed to delete Admin.Try Again Later</div>";
    	header('location:'.mysiteurl.'admin/manage-admin.php');

    }

    //3.Redirect to Message Admin page with message(succcess/error)

?>