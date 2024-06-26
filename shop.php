<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOKU</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/boostrap.css">
</head>

<body>

    <!-- ************************************************************************************************************************** -->
    <?php
            session_start();
            include "connection.php";
            require "header.php";
            


            if (isset($_SESSION["u"])) {
                ?>

    <div class="container-fluid ">
        <div class="row">

            <div class="col-12 bg-body mb-2">

            </div>

            <div class="col-12 bg-body mb-2">
                <div class="row">
                    <div class="offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2">
                                <div class="mt-2 mb-2 logo" style="height: 10px;"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-12 col-lg-12 mb-3 bg-body rounded  ">
                <div class="row ">

                    <div class="offset-lg-1 col-12 col-lg-10 cart-class-div ">
                        <div class="row">
                        <div class="col-12">
                            <div class="row">

                            <div class=" col-6 mt-2 mb-2">
                                    <select id="s"
                                        class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-dark">
                                        <option value="0">SORT BY</option>
                                        <option value="1">PRICE LOW TO HIGH</option>
                                        <option value="2">PRICE HIGH TO LOW</option>
                                        <option value="3">QUANTITY LOW TO HIGH</option>
                                        <option value="4">QUANTITY HIGH TO LOW</option>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-4 ">
                                    <input type="text" class="form-control fs-5 " placeholder="Type keyword to search..."
                                        id="t" />
                                </div>

                                <div class="col-12 col-lg-2   mb-1 d-grid">

                                    <button class="common-btn" onclick="advancedSearch(0);">Search</button>

                                </div>
                           



                            </div>

                        </div>

                            <div class="col-12 col-lg-2 mt-2">
                                <select class="form-select" id="c1">
                                    <option value="0">Select Category</option>
                                    <?php
                                    

                                    $category_rs = Database::search("SELECT * FROM `category`");
                                    $category_num = $category_rs->num_rows;

                                    for ($x = 0; $x < $category_num; $x++) {
                                        $category_data = $category_rs->fetch_assoc();
                                        ?>
                                        <option value="<?php echo $category_data["cat_id"]; ?>">
                                            <?php echo $category_data["cat_name"]; ?>
                                        </option>
                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-2 mb-3">
                                <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                            </div>

                            <div class="col-12 col-lg-2 mb-3">
                                <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                            </div>
                            <div class="col-5"></div>
                            <div class=" col-4 col-lg-1 bg-body rounded mt-3">
                            <div class="row">
                            <img class="logo " src="resources\goku.png" alt="Logo">
                            </div>
                        </div>

                        </div>
                     







             
                    </div>


                </div>
            </div>


           <div class=" col-12 col-lg-12 bg-body rounded mb-3">
                <div class="row">
                    <div class=" col-12 col-lg-12 text-center">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search h1"
                                        style="font-size: 100px;"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>
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

<script src="js\bootstrap.js"></script>
<script src="js\bootstrap.bundle.js"></script>
<script src="js\script.js"></script>

</html>