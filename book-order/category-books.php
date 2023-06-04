    
    <?php include('partials-front/menu.php'); ?>

    <?php 
        //checkwheter id is passed or not
        if(isset($_GET['category_id']))
        {
            //category id is set and get the id
            $category_id=$_GET['category_id'];
            //Get the category title based on category id
            $sql="SELECT title from tbl_category WHERE id=$category_id";

            //Execute the query
            $res=mysqli_query($conn,$sql);

            //Get value from databae
            $row=mysqli_fetch_assoc($res);
            //Get title
            $category_title=$row['title'];

        }
        else
        {
            //category not passed
            //Redirect to home page
            header('location:'.mysiteurl);
        }
    ?>
    <!-- book sEARCH Section Starts Here -->
    <section class="book-search text-center">
        <div class="container">
            
            <h2>Books on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- book sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="book-menu">
        <div class="container">
            <h2 class="text-center">Book Menu</h2>
            <?php

                 //create sql query books based on selecting categories
                 $sql2="SELECT * FROM tbl_book WHERE category_id=$category_id "; 

                 //create the query
                 $res2=mysqli_query($conn,$sql2);

                 //count the rows
                 $count2=mysqli_num_rows($res2);

                 //check wheter book is available or not
                 if($count2>0)
                 {
                    //Book is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id=$row2['id'];
                        $title=$row2['title'];
                        $price=$row2['price'];
                        $description=$row2['description'];
                        $image_name=$row2['image_name'];
                        ?>

                        <div class="book-menu-box">
                            <div class="book-menu-img">
                                <?php
                                     if($image_name=="")
                                     {
                                        //Image not available
                                        echo "<div class='error'>Image not Available</div>";
                                     }
                                     else
                                     {
                                        //Image available
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

                 }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>