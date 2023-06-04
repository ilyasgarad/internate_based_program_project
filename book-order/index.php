  <?php include('partials-front/menu.php'); ?>

  <!-- book search Section Starts Here -->
    <section class="book-search text-center">
        <div class="container">
            
            <form action="<?php echo mysiteurl; ?>book-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Book.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- book sEARCH Section Ends Here -->

    <?php 
         if(isset($_SESSION['order']))
         {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
         }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Books</h2>
            <?php 
                 //create sql to display categories from database
                 $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                 //execute the query
                 $res=mysqli_query($conn,$sql);
                 //count rows to check wheter the cateogry is available or not
                 $count=mysqli_num_rows($res);

                 if($count>0)
                 {
                    // category available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the value like id,title,image_name
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>

                        <a href="<?php echo mysiteurl; ?>category-books.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //check wheter image is available or not
                                     if($image_name=="")
                                     {
                                        //Display Message
                                        echo "<div class='error'>Image is not Available</div>";
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
                    //cateogry not available
                    echo "<div class='error'>Category not Added</div>";
                 }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- book Menu Section Starts Here -->
    <section class="book-menu">
        <div class="container">
            <h2 class="text-center">Book Menu</h2>

            <?php  

            //Getting books from database
            //sql query
            $sql2="SELECT * FROM tbl_book WHERE active='Yes' AND featured='Yes' LIMIT 6 ";

            //Execute the query
            $res2=mysqli_query($conn,$sql2);
            //count rows
            $count2=mysqli_num_rows($res2);

            //check wheter book available or not
            if($count2>0)
            {
                //Book available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>

                    <div class="book-menu-box">
                        <div class="book-menu-img">
                            <?php 
                                //check wheter image available or not
                                if($image_name=="")
                                {
                                    //Image not available
                                    echo "<div class='error'>Image not available</div>";
                                }
                                else
                                {
                                    ?>
                                     <img src="<?php echo mysiteurl; ?>images/book/<?php echo $image_name; ?>" alt="Computer Science" class="img-responsive img-curve">
                                    <?php 
                                }
                            ?>
                        </div>

                     <div class="book-menu-desc">
                         <h4><?php echo $title; ?></h4>
                         <p class="book-price">$<?php echo $price; ?></p>
                         <p class="book-detail">
                            <?php echo $description; ?>
                         </p>
                         <br>

                        <a href="<?php echo mysiteurl; ?>order.php?book_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                     </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //Book not available
                echo "<div class='error'>Book not available</div>";
            }
            ?>


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Books</a>
        </p>
    </section>
    <!-- book Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>