
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

            if (isset($_SESSION["u"])) {

                $user = $_SESSION["u"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;
                ?>
                <div class="col-12 mb-5 mt-3">
                    <div class="row align-items-center">
                        <h1 class=" SectionHeader__Heading_cart Heading u-h1 text-center fw-semibold">CART</h1>
                    </div>
                </div>
                <div class="col-1  col-lg-3 "></div>
                <div class="col-10 col-lg-6 d-flex justify-content-center">

                    <?php
                    

                    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
                    $cart_num = $cart_rs->num_rows;

                    if ($cart_num == 0) {
                        ?>
                        <!-- Empty View -->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 emptyCart"></div>
                                <div class="col-12 text-center mb-2">
                                    <label class="form-label fs-1 fw-bold">
                                        You have no items in your Cart yet.
                                    </label>
                                </div>
                                <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                    <a href="home.php" class="buy-btn  fw-bold">
                                        Start Shopping
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Empty View -->
                        <?php
                    } else {
                        ?>
                       <div class="col-12">
                        <div class="row">
                        
                           <div class="col-12  ">
                        <!-- products -->
                        <div class="col-12 col-lg-12 ">
                                <div class="row">

                                    <?php

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                        product.id=product_img.product_id WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                        $address_rs = Database::search("SELECT `district_id` AS did FROM `user_has_address` INNER JOIN `city` ON 
                                    user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                    city.district_district_id=district.district_id WHERE `user_email`='" . $user . "'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        if ($address_data["did"] == 2) {
                                            $ship = $product_data["delivery_fee_colombo"];
                                            $shipping = $shipping + $ship;
                                        } else {
                                            $ship = $product_data["delivery_fee_other"];
                                            $shipping = $shipping + $ship;
                                        }

                                      

                                        ?>
                                        <div class=" mb-2 mx-0 col-12  cart-class-div  mb-4">
                                            <div class="row g-0">
                                           

                                                

                                                <div class="col-md-4 mt-5">

                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover"
                                                        data-bs-trigger="hover focus"
                                                        data-bs-content="<?php echo $product_data["description"]; ?>"
                                                        title="Product Description">
                                                        <img src="<?php echo $product_data["img_path"]; ?>"
                                                            class="img-fluid rounded-start">
                                                    </span>

                                                </div>
                                                <div class="col-12 col-md-6 mt-3 text-center text-lg-start">
                                                    <div class="card-body">

                                                        <h3 class="card-title  text-black-75 fs-5"><?php echo $product_data["title"]; ?></h3>

                                                        

                                                       
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.
                                                            <?php echo $product_data["price"]; ?> .00</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                        <input type="number"
                                                            class="mt-3 border fs-4 fw-bold px-1"
                                                            value="<?php echo $cart_data['qty']; ?>"
                                                            onchange="changeQTY(<?php echo $cart_data['cart_id']; ?>, 'qty_num_<?php echo $cart_data['cart_id']; ?>');"
                                                            id="qty_num_<?php echo $cart_data['cart_id']; ?>">

                                                        <br><br>
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-6">Rs.<?php echo $ship; ?>.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="card-body d-grid">
                                                      
                                                        <a class="delete-btn "
                                                            onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove</a>
                                                    </div>
                                                    <div class="card-body d-grid">                                                     
                                                    <a href="<?php echo 'singleProductView.php?id=' . $product_data['id']; ?>" class="buy-btn">BUY NOW </a>          
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
                                        <?php

                                    }

                                    ?>

                                </div>
                            </div>

                           
                        
                           </div>
                        </div>
                       </div>
                    
                </div>
                <div class="col-12 col-lg-3 ">
                <div class="row">

<div class="col-12">
    <label class="form-label fs-3 fw-bold">Product Summary</label>
</div>

<div class="col-12">
    <hr />
</div>

<div class="col-6 mb-3">
    <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
</div>

<div class="col-6 text-end mb-3">
    <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
</div>

<div class="col-6">
    <span class="fs-6 fw-bold">Shipping</span>
</div>

<div class="col-6 text-end">
    <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
</div>

<div class="col-12 mt-3">
    <hr />
</div>

<div class="col-6 mt-2">
    <span class="fs-4 fw-bold">Total</span>
</div>

<div class="col-6 mt-2 text-end">
    <span class="fs-4 fw-bold">Rs. <?php echo $total + $shipping; ?> .00</span>
</div>

<div class="col-12 mt-3 mb-3 d-grid">
    <button class="common-btn" onclick="payNow2(<?php echo ($shipping + $total); ?>)">CHECKOUT</button>
</div>
<?php
                    }
                    ?>
</div>
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