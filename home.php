<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOKU</title>
    <link rel="stylesheet" href="css/boostrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<body>

    <?php
    session_start();
    require "header.php";



    if (isset($_SESSION["u"])) {
        ?>
        <!-- ************************************************************************************************************************** -->
        <div class="background_img"> </div>

        <!-- ************************************************************************************************************************** -->
        <div class="bg_title">
            <header>
               
                <div class="cursor-poiter">
                    <a href="shopview.php" class="goku_btn "><span class="goku_btnfont fw-bolder fs-7">JOIN THE HUNT</span></a>
                </div>
            </header>
        </div>

        <!-- ************************************************************************************** -->
        <?php
        $category_rs = Database::search("SELECT * FROM `category`");
        $category_num = $category_rs->num_rows;
        for ($y = 0; $y < $category_num; $y++) {
            $category_data = $category_rs->fetch_assoc();
            ?>

            <h2 class="col-12 mt-5 SectionHeader__Heading Heading u-h1 text-center"><?php echo $category_data["cat_name"]; ?>
            </h2>
            <div class="col-lg-12 bg-white">
                <div class="row">
                    <div class="col-1 col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="row align-items-center">
                                    <?php
                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $category_data["cat_id"] . "' AND `status_status_id`='1' ORDER BY `datetime_added` DESC");
                                    $product_num = $product_rs->num_rows;

                                    if ($product_num > 0) {
                                        for ($z = 0; $z < $product_num; $z++) {
                                            $product_data = $product_rs->fetch_assoc();
                                            ?>
                                            <!-- card start************************** -->
                                            <div class="col-md-6 col-lg-3 mt-2 mb-4 text-center">
                                                <div class="row">
                                                    <?php
                                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                                    $img_data = $img_rs->fetch_assoc();
                                                    ?>
                                                    <img src="<?php echo $img_data['img_path']; ?>"
                                                        onclick="window.location.href='gokusinglepro.php?id=<?php echo $product_data['id']; ?>';"
                                                        class="card-img-top img-fluid mt-2" style="width:100%;max-width:600px;" />

                                                    <div class="ms-0 m-0 text-center">
                                                        <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                                                        <span>QTY-<?php echo $product_data["qty"] ?></span><br />
                                                        <span
                                                            class="fw-semibold">RS.<?php echo $product_data["price"] ?>.00</span><br />

                                                        <?php
                                                        if ($product_data["qty"] > 0) {
                                                            ?>
                                                            <div class="d-flex justify-content-center mt-2">
                                                                <button class="buy-btn" type="button" data-bs-toggle="offcanvas"
                                                                    data-bs-target="#offcanvasWithBothOptions"
                                                                    aria-controls="offcanvasWithBothOptions"
                                                                    onclick="addToCart(<?php echo $product_data['id']; ?>)" >ADD TO
                                                                    CART</button>
                                                            </div>
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
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- *********************************************************************************************************************************************** -->
                                            <!-- card end ************************** -->
                                            <?php

                                        }
                                        ?>
                                        <?php
                                        if ($category_data["cat_id"] == 1) {
                                            ?>
                                            <div class="background_img2"> </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="background_img3"> </div>
                                            <?php
                                        }
                                        ?>
                                        <?php

                                    } else {
                                        echo "<p>No products available in this category.</p>";
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="col-lg-0"></div>
        <?php
    } else {
        ?>

        <script>
            window.location = "login.php";
        </script>

        <?php
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<?php include "footer.php" ?>
<script src="js\bootstrap.js"></script>
<script src="js\bootstrap.bundle.js"></script>
<script src="js\script.js"></script>

</html>