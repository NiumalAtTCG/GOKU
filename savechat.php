<?php
include "connection.php"; 

$msg = $_GET["msg"];
$user = $_GET["user"];
$sub = $_GET["sub"];
$pid = $_GET["pid"];




$t1 = Database::search("SELECT `service_id` FROM `service` WHERE `rating`='$sub'");
$r1 = $t1->fetch_assoc();
$sub_id = $r1["service_id"];




$date = date("Y-m-d");
$time = date("H:i:s");
$datetime = $date . " " . $time;

Database::iud("INSERT INTO `feedback` (`feed`, `date`, `user_email`, `product_id`, `Service_id`) VALUES ('$msg', '$datetime', '$user', '$pid', '$sub_id')");

echo ("Success")
?>