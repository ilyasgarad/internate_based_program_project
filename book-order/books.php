    
    <?php include('partials-front/menu.php'); ?>
    <!-- book sEARCH Section Starts Here -->
    <section class="book-search text-center">
        <div class="container">
            
            <form action="<?php echo mysiteurl; ?>book-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Book.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="book-menu">
        <div class="container">
            <h2 class="text-center">Book Menu</h2>

            <?php 
                 //Display books that are active
                 $sql="SELECT * FROM tbl_book WHERE active='Yes' ";
                 //Execute the query
                 $res=mysqli_query($conn,$sql);

                 //count rows
                 $count=mysqli_num_rows($res);

                 //check wheter the books are available or not
                 if($count>0)
                 {
                    //Book available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id=$row['id'];
                        $title=$row['title'];
                        $description=$row['description'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
                        ?>

                        <div class="book-menu-box">
                             <div class="book-menu-img">
                                <?php 
                                    //check wheter image is available or not
                                    if($image_name=="")
                                    {
                                        //Image not available
                                        echo "<div class='error'>Image not Available.</div>";
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
                    //Book not available
                    echo "<div class='error'>Book not Found</div>";
                 }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- book Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>