<?php
include "connection.php";

$email = $_POST["email"];
$newpw = $_POST["np"];
$retypepw = $_POST["rnp"];
$currentPassword = $_POST["cp"];

// Input validation
if (empty($currentPassword)) {
    echo "Please enter your current password.";
    exit;
} 
if (empty($newpw)) {
    echo "Please enter your new password.";
    exit;
} 
if (empty($retypepw)) {
    echo "Please re-enter your new password.";
    exit;
} 
if ($newpw !== $retypepw) {
    echo "Passwords do not match.";
    exit;
}

// Validate current password
$rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$currentPassword."'");
$num = $rs->num_rows;

if ($num == 1) {
    // Update password
    Database::iud("UPDATE `user` SET `password`='".$newpw."' WHERE `email`='".$email."'");
    echo "success";
} else {
    echo "Invalid email address or current password.";
}
?>
