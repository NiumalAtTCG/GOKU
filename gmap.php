<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<link rel="stylesheet" href="css\boostrap.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link rel="stylesheet" type="text/css" href="./style.css" />
<link rel="stylesheet" href="css/main.css">


<link rel="stylesheet" href="css/bootstrap.css">
<script type="module" src="./index.js"></script>


<body>

    <div class="container-fluid   ">
        <div class="row">
        <?php
            session_start();
            include "connection.php";
            require "header.php";
            


            if (isset($_SESSION["u"])) {
                ?>
            <div class="col-12 mb-5 mt-3">
                <div class="row align-items-center ">
                    <h1 class=" SectionHeader__Heading_cart Heading u-h1 text-center fw-semibold">FIND US</h1>
                </div>
            </div>
            <div class="col-12 mb-5">
            <gmp-map
                            center="7.8731,80.7718"
                            zoom="7"
                            map-id="DEMO_MAP_ID"
                            style="height: 400px"
                        >
                            <gmp-advanced-marker
                                position="6.9271,79.8612"
                                title="Colombo"
                            ></gmp-advanced-marker>
                            <gmp-advanced-marker
                                position="6.9271,79.8612"
                                title="Kandy"
                            ></gmp-advanced-marker>
                        </gmp-map>
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7jYT0WWBpkh_AxlUSHKXBN8eEM-J3EJU&libraries=maps,marker&v=beta"
        defer></script>
    <script src="js\bootstrap.js"></script>
    <script src="js\bootstrap.bundle.js"></script>
    <script src="js\script.js"></script>
</body>

</html>