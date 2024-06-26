<?php
require "connection.php";

if (isset($_GET["catId"])) {
    $catId = $_GET["catId"];
    $cat_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $catId . "'");
    $cat_num = $cat_rs->num_rows;

    if ($cat_num == 1) {
        $cat_data = $cat_rs->fetch_assoc();

        if ($cat_data["cat_status"] == 1) {
            Database::iud("UPDATE `category` SET `cat_status` = '0' WHERE `cat_id` = '" . $catId . "'");
            echo ("blocked");
        } else if ($cat_data["cat_status"] == 0) {
            Database::iud("UPDATE `category` SET `cat_status` = '1' WHERE `cat_id` = '" . $catId . "'");
            echo ("unblocked");
        }
    } else {
        echo ("Cannot find the category. Please try again later.");
    }
} else {
    echo ("Something went wrong.");
}
?>
