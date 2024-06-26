<?php
session_start();
include "connection.php";

$productId = $_POST['productId'];
$flavorname = $_POST['flavorname'];

try {
    Database::iud("UPDATE `product` SET `qty`='".$flavorname."' WHERE `id`='".$productId ."'");
    echo ("QTY Updated!");
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>