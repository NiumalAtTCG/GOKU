<?php
session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["qty"]) && isset($_GET["id"])) {
        $qty = $_GET["qty"];
        $cid = $_GET["id"];
        $umail = $_SESSION["u"]["email"];

        // Validate quantity
        if (!is_numeric($qty) || $qty <= 0) {
            echo "Invalid Quantity";
            exit();
        }

        // Fetch cart details
        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_id`='" . $cid . "' AND `user_email`='" . $umail . "'");
        $cart_num = $cart_rs->num_rows;

        // Fetch product quantity
        $product_rs = Database::search("SELECT product.qty FROM `product` INNER JOIN cart ON product.id = cart.product_id WHERE `cart_id`='" . $cid . "'");
        $product_data = $product_rs->fetch_assoc();
        $product_qty = $product_data["qty"];

        if ($cart_num == 1) {
            $cart_data = $cart_rs->fetch_assoc();
            $new_qty = (int)$qty;

            if ($product_qty >= $new_qty) {
                Database::iud("UPDATE `cart` SET `qty`='" . $new_qty . "' WHERE `cart_id`='" . $cart_data["cart_id"] . "'");
                echo "Updated";
            } else {
                echo "Invalid Quantity";
            }
        } else {
            echo "Cart item not found";
        }
    } else {
        echo "Something went wrong.";
    }
} else {
    echo "Please Login or Signup first.";
}
?>
