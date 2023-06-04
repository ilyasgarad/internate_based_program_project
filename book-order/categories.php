
<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Books</h2>

            <?php 

                //Display all the categories
                //sql query
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                //Execute query
                $res=mysqli_query($conn,$sql);

                //count Rows
                $count=mysqli_num_rows($res);

                //check wheter categories available or not
                if($count>0)
                {
                    //category available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>

                        <a href="<?php echo mysiteurl; ?>category-books.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php  
                                    if($image_name=="")
                                    {
                                        //Image available
                                        echo "<div class='error'>Image not found</div>";
                                    }
                                    else
                                    {
                                        //Image available
                                        ?>
                                        <img src="<?php echo mysiteurl; ?>images/category/<?php echo $image_name; ?>" alt="Computer Science" class="img-responsive img-curve">
                                        <?php 
                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php 
                    }

                }
                else
                {
                    //categories not available
                    echo "<div class='error'>Category not found</div>";
                }

            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>