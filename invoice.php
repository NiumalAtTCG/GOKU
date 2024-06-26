<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOKU</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/boostrap.css">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>

    <div class="container-fluid ">
<div class="col-12">
<div class="row">
            <?php
            session_start();
            include "connection.php";

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];
                ?>
                <div class="col-12">
                    <hr />
                </div>
                <div class="row">
                    <div class="col-4 btn-toolbar justify-content-start">
                        <button onclick="window.location.href='home.php'"
                            class="material-icons fs-3 bg-white">arrow_back</button>
                    </div>

                    <div class="col-4 text-center">
                        <h2 class="fw-bolder">THANK YOU !</h2>
                    </div>

                    <div class="col-4 btn-toolbar justify-content-end">

                        <button class="bg-white me-2" onclick="printInvoice();"><i
                                class="bi bi-printer-fill fs-3"></i></button>
                        <button class="bg-white me-2" onclick="createPDFOfPage();"><i 
                        class="bi bi-filetype-pdf  fs-3"></i> </button>
                    </div>
                    <div class="col-12">
                        <hr />
                    </div>
                </div>
                <div class="row p-4"></div>
                <div class="col-lg-2"></div>
                <div class="col-12 col-lg-8 p-4 cart-class-div " id="page">
                    <div class="row ">
                        <div class="col-4">
                            <h2 class="fw-bolder">GOKU</h2>
                            <span>Maradana, Colombo 10, Sri Lanka.</span><br />
                            <span>+94762135123</span><br />
                            <span>goku@gmail.com</span>
                        </div>
                        <div class="col-5"></div>
                        <?php

                        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                        $address_data = $address_rs->fetch_assoc();

                        ?>
                        <div class="col-3 ">
                            <h6 class="fw-bolder text-start  mb-3">INVOICE TO :</h6>
                            <h6 class=""><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h6>
                            <span><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?></span><br />
                            <span><?php echo $umail; ?></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr />
                    </div>
                    <?php

                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                    $invoice_data = $invoice_rs->fetch_assoc();

                    ?>
                    <div class="row">
                        <div class="col-12 ">
                            <table class="table cart-class-div ">
                                <thead>
                                    <tr class="border border-1 border-secondary ">
                                        <th class=" text-black">#</th>
                                        <th class=" text-black">Order ID & Product</th>
                                        <th class="text-end text-black">Unit Price</th>
                                        <th class="text-end text-black">Quantity</th>
                                        <th class="text-end text-black">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

$invoice_trs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' ");

$product_trs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "' ");
$invoice_num = $invoice_rs->num_rows;

for ($x = 0; $x < $invoice_num; $x++) {

    $product_tdata = $product_trs->fetch_assoc();

    $invoice_tnum = $invoice_trs->num_rows;

    $invoice_tdata = $invoice_trs->fetch_assoc();




?>
                                    
                                        <tr style="height: 72px;">
                                            <td class=" text-black "><?php echo $invoice_tdata["invoice_id"]; ?></td>
                                            <td>
                                                <span class="fw-semibold   p-2"><?php echo $oid; ?></span><br />
                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_tdata["product_id"] . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                                ?>
                                                <span class="fw-bold  fs-5 p-2"><?php echo $product_data["title"]; ?></span>
                                            </td>
                                            <td class="fw-bold fs-6 text-end pt-3 bg-secondary text-white">Rs.
                                                <?php echo $product_data["price"]; ?> .00</td>
                                            <td class="fw-bold fs-6 text-end pt-3"><?php echo $invoice_tdata["qty"]; ?></td>
                                            <td class="fw-bold fs-6 text-end pt-3 bg-secondary text-white">Rs.
                                                <?php echo $invoice_tdata["total"]; ?> .00</td>
                                        </tr>
                                    <?php



}
?>
                                </tbody>
                                <tfoot>

                                    <?php

                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $address_data["city_city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();

                                    $delivery = 0;

                                    if ($city_data["district_district_id"] == 2) {
                                        $delivery = $product_data["delivery_fee_colombo"];
                                    } else {
                                        $delivery = $product_data["delivery_fee_other"];
                                    }
                                    $invoic_rs = Database::search("SELECT SUM(`total`) FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                    $invoic_data = $invoic_rs->fetch_assoc();
                                 
                                    $t = implode(" ",$invoic_data); 
                                    $g = $t - $delivery;

                                    ?>

                                    <tr>
                                        <td colspan="3" class="border-0  tblCellback"></td>
                                        <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                        <td class="text-end">Rs. <?php echo $g; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0 text-start tblCellback">
                                            <img class="logo " src="resources\goku.png" alt="Logo">
                                        </td>

                                        <td class="fs-5 text-end fw-bold border-primary">Delivery Fee</td>
                                        <td class="text-end border-primary">Rs. <?php echo $delivery; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0 tblCellback"></td>
                                        <td class="fs-5 text-end fw-bold border-primary text-primary">GRAND TOTAL</td>
                                        <td class="fs-5 text-end fw-bold border-primary text-primary">Rs. <?php echo $t; ?>
                                            .00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-lg  -2"></div>
                <div class="row p-5"></div>
                <?php

            } else {

                echo ("f");
            }
            ?>
    
        </div>
</div>
    </div>
    <?php include "footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="js\bootstrap.js"></script>
    <script src="js\bootstrap.bundle.js"></script>
    <script src="js\script.js"></script>
</body>

</html>