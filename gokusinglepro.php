
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOKU</title>
</head>
<link rel="stylesheet" href="css\boostrap.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="css\style.css" />

<body>

    <div class="container-fluid ">
        <div class="row">


            <?php
          
            session_start();
            include "connection.php";
            include "header.php";
            if (isset($_SESSION["u"]) && isset($_GET['id'])) {
                $user = $_SESSION["u"]["email"];
                $productId = $_GET['id'];

             
                ?>
                <div class="col-12 mb-5 mt-3">
                    
                </div>
                <div class="col-1  col-lg-3 "></div>
                <div class="col-10 col-lg-6 d-flex justify-content-center">

                    <?php

                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                        product.id=product_img.product_id INNER JOIN `category`ON  product.category_cat_id=category.cat_id  WHERE `user_email`='" . $user . "' AND  `id`='" . $productId . "'");
             

       
                        ?>
                       <div class="col-12">
                        <div class="row">
                        
                           <div class="col-12  ">
                        <!-- products -->
                        <div class="col-12 col-lg-12 ">
                                <div class="row">

                                    <?php

                             
                                        $product_data = $product_rs->fetch_assoc();

                                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $productId . "'");
                                         $cart_data =  $cart_rs->fetch_assoc();

                                        

                                  
                                        
                                      

                                        ?>
                                        <div class=" mb-2 mx-0 col-12  cart-class-div  mb-4">
                                            <div class="row g-0">
                                           

                                                

                                            <div class="col-md-6 mt-5 text-center">
    <img src="<?php echo $product_data['img_path']; ?>" class="img-fluid rounded-start mb-3">
    <br>
    <img src="resources/product_images/zzzzzzzzz.png" class="img-fluid" style="width: 60%;" alt="">
    <br><br>
    <p class="text-black fw-bolder  text-center ">HUNT FOR HIDRATION</p>
</div>

                                                <div class="col-12 col-md-6 mt-3 text-center text-lg-start">
                                                    <div class="card-body">

                                                        <h3 class="card-title  text-black-75 fs-3 mb-2 reduced-letter-height"><?php echo $product_data["title"]; ?></h3>
                                                        <span class="  text-black reduced-letter-height fs-6 ">
                                                        <?php echo $product_data["cat_name"]; ?> </span>
                                                        

                                                                <br>
                                                   
                                                        
                                                      
                                                            <h7  class=" text-black  fs-6">
                                                            500 ML </h7>
                                                            <br>         <br>
                                                            <p class=" text-black  fs-6">
                                                            SUBSCRIBE TO RECEIVE 5% OFF EACH DELIVERY. </p>
                                                        <br>

                                                        <span class="text-black fs-5">Quantity :</span>&nbsp;
                                                        <input type="number"
                                                            class="mt-3 border fs-4 fw-bold px-1"
                                                            value="<?php echo $cart_data['qty']; ?>"
                                                            onchange="changeQTY(<?php echo $cart_data['cart_id']; ?>, 'qty_num_<?php echo $cart_data['cart_id']; ?>');"
                                                            id="qty_num_<?php echo $cart_data['cart_id']; ?>">

                                                        <br><br>
                                                        
                                                     
                                                        <?php
                                                        if ($product_data["qty"] > 0) {
                                                            ?>
                                                            <div class="d-flex justify-content-start mt-2">
                                                            <button class="common-btn" type="button" data-bs-toggle="offcanvas"
                                                                    data-bs-target="#offcanvasWithBothOptions"
                                                                    aria-controls="offcanvasWithBothOptions"
                                                                    onclick="addToCart(<?php echo $product_data['id']; ?>)">ADD TO
                                                                    CART</button>
                                                                    
                                                            </div>
                                                            <br>
                                                            
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="d-flex justify-content-center mt-2">
                                                                <button class="outOfStock-btn" data-bs-toggle="offcanvas"
                                                                    data-bs-target="#offcanvasWithBothOptions"
                                                                    aria-controls="offcanvasWithBothOptions">OUT OF STOCK</button>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <img src="resources\product_images\gockudissimj (1).png" style="width: 100%;" alt="">
                                                           <span class="fw-semibold text-black fs-6">  <?php echo $product_data["description"]; ?></span>
                                                    </div>
                                                </div>
                                                
                                                </div>
                                             

                                                <hr>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-5 col-md-5">
                                                        <img class="logo" src="resources\goku.png" alt="Logo">
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span
                                                                class="fw-bold fs-5 text-black-50">ORIGINAL</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  

                                </div>
                            </div>

                           
                        
                           </div>
                        </div>
                       </div>
                    
                </div>
                <div class="col-12 col-lg-3 ">
                
                </div>
                <?php
            } else {
            ?>
            
            
                     <div class="col-12 d-flex justify-content-center">
                     <div class="row">
                         <div class="col-12 emptyCart"></div>
                         <div class="col-12 text-center mb-2">
                             <label class="form-label fs-1 fw-bold">
                              PLEASE LOGIN OR SIGNUP
                             </label>
                         </div>
                         <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                             <a href="login.php" class="buy-btn  fw-bold">
                                BACK TO LOG IN
                             </a>
                         </div>
                     </div>
                 </div>
                 
            
            <?php
            }
            ?>
          
           </div>
           </div>
           <?php include "footer.php"; ?>

           <script src="js\bootstrap.js"></script>
           <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="js\bootstrap.bundle.js"></script>
    <script src="js\script.js"></script>

</body>

</html>


<!-- C:\Users\User\Downloads\free-psd-templates-com-186540-free-energy-drink-can-mockup-set-template\Free_energy_drink_mockup_set -->