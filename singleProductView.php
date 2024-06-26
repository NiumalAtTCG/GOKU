<a?php

?>

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

            if (isset($_SESSION["u"]) &&  (isset($_GET['id']))) {

                $user = $_SESSION["u"]["email"];

              
             
                 $product_id = $_GET['id'];
           
                $total = 0;
                $subtotal = 0;
                $shipping = 0;
                ?>
                <div class="col-12 mb-5 mt-3">

                </div>
                <div class="col-1  col-lg-2 "></div>
                <div class="col-10 col-lg-8 d-flex justify-content-center">

                    <?php

             $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "' AND `product_id`='" . $product_id . "'");

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
                                                $customerAddress = Database::search("SELECT *  FROM `user_has_address` INNER JOIN `city` ON 
                                                user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                                city.district_district_id=district.district_id WHERE `user_email`='" . $user . "'");
                                                $customerAddress_data = $customerAddress->fetch_assoc();

                                                $user_Deets = Database::search("SELECT * FROM `user` WHERE email='" . $user . "'");
                                                $user_Deets_data = $user_Deets->fetch_assoc();

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
                                                <div class=" mb-2 mx-0 col-12  cart-class-div tblCellback mb-4">
                                                    <div class="row g-0">



                                                        <div class="col-md-3 mt-5   ">





                                                            <span class="d-inline-block border-bottom" tabindex="0"
                                                                data-bs-toggle="popover">
                                                                <img src="<?php echo $product_data["img_path"]; ?>"
                                                                    class="img-fluid rounded-start">
                                                            </span>
                                                            <h5 class=" fw-bold mt-2 mb-4 text-cente border-bottom border-3 "><?php echo $product_data["title"]; ?></h5>

                                                            <h6 class="text-start  mt-2"><?php echo $product_data["description"]; ?></h6>

                                                            

                                                            <!-- ****************************************** -->

                                                        </div>

                                                        <div
                                                            class="col-12 col-md-9  text-center text-lg-start  p-3 ">
                                                            <div class="card-body">
                                                                <div class="row ms-1">
                                                                    <div class="col-12 ">
                                                                        <span class="fw-bold text-black-50 fs-5">Shipping address
                                                                            :</span>
                                                                    </div>
                                                                    <div class="col-4 mt-2 border-end border-4">

                                                                        <span class="fw-bold text-black fs-12">
                                                                            <?php echo $user_Deets_data["fname"] . ' ' . $user_Deets_data["lname"] . ' ' . $user_Deets_data["mobile"]; ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-4 mt-2 ">

                                                                        <?php echo $customerAddress_data["line1"] . ' ' . $customerAddress_data["line2"]; ?>

                                                                    </div>
                                                                    <div class="col-4 mt-2 mb-2">


                                                                        <span class=" text-black  fs-12">
                                                                            <?php echo $customerAddress_data["district_name"] . ', ' . $customerAddress_data["city_name"]; ?>.
                                                                        </span>
                                                                    </div>


                                                                </div>
                                                                <div class="row ms-1">



                                                                    <div class="col-12">
                                                                        <hr />
                                                                    </div>
                                                                    <div class="col-12 ">
                                                                        <span class="fw-bold text-black-50 fs-5">Product    Summery</span>
                                                                    </div>
                                                                    <div class="col-12">
                                                                    <span class="fs-6 fw-bold">Quantity :</span>&nbsp;
                                                        <input type="number"
                                                            class="mt-3 border  fw-bolder  fs-6 "
                                                            value="<?php echo $cart_data["qty"]; ?>"
                                                            onchange="changeQTY(<?php echo $cart_data['cart_id']; ?>);"
                                                            id="qty_num">
                                                                    </div>
                                                                    <div class="col-6 mb-3">
                                                                        <span class="fs-6 fw-bold">items 
                                                                           </span>
                                                                    </div>

                                                                    <div class="col-6 text-end mb-3">
                                                                        <span class="fs-6 fw-bold">Rs. <?php echo $total; ?>
                                                                            .00</span>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <span class="fs-6 fw-bold">Shipping</span>
                                                                    </div>

                                                                    <div class="col-6 text-end">
                                                                        <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?>
                                                                            .00</span>
                                                                    </div>

                                                                    <div class="col-12 mt-3">
                                                                        <hr />
                                                                    </div>

                                                                    <div class="col-6 mt-2">
                                                                        <span class="fs-4 fw-bold">Total</span>
                                                                    </div>

                                                                    <div class="col-6 mt-2 text-end">
                                                                        <span class="fs-4 fw-bold">Rs.
                                                                            <?php echo $total + $shipping; ?> .00</span>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-6 mt-3 mb-3 d-flex justify-content-start">
                                                                            <a class="buy-btn fs-5 fw-bold"
                                                                                onclick="window.location='cart.php'">Back</a>
                                                                        </div>
                                                                        <div class="col-6 mt-3 mb-3 d-flex justify-content-end">
                                                                            <a class="buy-btn fs-5 fw-bold"
                                                                          type="submit" id="payhere-payment" onclick="payNow(<?php echo $product_id; ?>);">Buy </a>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>





                                                        <hr>

                                                        <div class="col-md-12 mt-3 mb-3">
                                                            <div class="row">
                                                                <div class="col-2 col-md-2 ">
                                                                    <img class="logo justify-content-start" src="resources\goku.png" alt="Logo">
                                                                </div>
                                                                <div class="col-4 col-md-4"></div>
                                                                <div class="col-6 col-md-6 text-end">
                                                                    <span class="fw-bold fs-5 text-black-50">ORIGINAL</span>
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
                        <?php
                    }
                    ?>

                    <!-- <div class=" col-12 bg-black  mt-2 mb-4 text-center">
                            <div class="row">
                                <div class="col-4"> img</div>
                                <div class="col-8">


                                </div>
                            </div>
                        </div> -->




                </div>
                <div class="col-12 col-lg-2 ">
                    <!-- products -->

                    <!-- summary -->
                    <?php
                    if ($cart_num !== 0) {
                        ?>
                        <div class="col-12 col-lg-12 ">

                            
                        </div>
                        <?php
                    } ?>
                    <!-- summary -->
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
            <?php include "footer.php"; ?>
        </div>
    </div>




    <script src="js\bootstrap.js"></script>
    <script src="js\bootstrap.bundle.js"></script>
    <script src="js\script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>