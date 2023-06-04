    
    <?php include('partials-front/menu.php'); ?>
    <!-- book sEARCH Section Starts Here -->
    <section class="book-search text-center">
        <div class="container">
            <?php   
                 //Get the search keyword
                 $search=mysqli_real_escape_string($conn,$_POST['search']);
            ?>
            <h2>Books on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- book search Section Ends Here -->



    <!-- bookMEnu Section Starts Here -->
    <section class="book-menu">
        <div class="container">
            <h2 class="text-center">Book Menu</h2>

            <?php 

                 //SQL quey to get books based on search keyword
                 $sql="SELECT * FROM tbl_book WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";

                 //Execute the query
                 $res=mysqli_query($conn,$sql);

                 //conut rows
                 $count=mysqli_num_rows($res);

                 //check wheter book available or not
                 if($count>0)
                 {
                    //book available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        ?>

                        <div class="book-menu-box">
                             <div class="book-menu-img">
                                <?php 
                                     //check wheter image name is available or not
                                     if($image_name=="")
                                     {
                                        //Image not available
                                        echo "<div class='error'>Image not available</div>";
                                     }
                                     else
                                     {
                                        //Image Available
                                        ?>
                                          <img src="<?php echo mysiteurl; ?>images/book/<?php echo $image_name; ?>" alt="Computer" class="img-responsive img-curve">
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

                                 <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php 
                    }
                 }
                 else
                 {
                    //book not available
                    echo "<div class='error'>Book not found</div>";
                 }

            ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- book Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>