    
    <?php include('partials-front/menu.php'); ?>
         <?php 
              //check wheter book id is set or not
              if(isset($_GET['book_id']))
              {
                //Get the book id and details
                $book_id=$_GET['book_id'];

                //Get the details
                $sql="SELECT * FROM tbl_book WHERE id=$book_id";
                //Execute the query
                $res=mysqli_query($conn,$sql);
                //Count the rows
                $count=mysqli_num_rows($res);
                //check wheter the data is available or not
                if($count==1)
                {
                    //we have data
                    //Get the data from database
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                }
                else
                {
                    //book is not available
                    //Redirect
                    header('location:'.mysiteurl);
                }
              }
              else
              {
                //Redirect to home page
                header('location:'.mysiteurl);
              }
         ?>
    <!-- book sEARCH Section Starts Here -->
    <section class="book-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Book</legend>

                    <div class="book-menu-img">
                        <?php

                             //check wheter image is available or not
                             if($image_name=="")
                             {
                                //Image not available
                                echo "<div class='error'>Image is not available</div>";
                             }
                             else
                             {
                                //Image is available
                                ?>
                                <img src="<?php echo mysiteurl; ?>images/book/<?php echo $image_name; ?>" alt="Computer Science" class="img-responsive img-curve">
                                <?php 
                             }
                        ?>
                    </div>
    
                    <div class="book-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="book" value="<?php echo $title; ?>">

                        <p class="book-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Issakha Fadoul" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 544xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                 //check wheter submit button is clicked or not
                 if(isset($_POST['submit']))
                 {
                    //Get all details from database

                    $book=$_POST['book'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];

                    $total=$price*$qty;

                    $order_date=date("Y-m-d h:i:sa");

                    $status="Ordered";

                    $customer_name=$_POST['full-name'];
                    $customer_contact=$_POST['contact'];
                    $customer_email=$_POST['email'];
                    $customer_address=$_POST['address'];

                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                        book = '$book',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                     //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Book Ordered Successfully.</div>";
                        header('location:'.mysiteurl);
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Book.</div>";
                        header('location:'.mysiteurl);
                    }
                 } 
            ?>

        </div>
    </section>
    <!-- book search Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>