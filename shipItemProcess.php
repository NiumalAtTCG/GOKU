<?php

include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["u"])) {
    $email = $_GET["umail"];
    $oid = $_GET["oid"];

    $rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $email . "' AND `order_id`='" . $oid . "'");

    $n = $rs->num_rows;

    if ($n >= 1) {
        $code = uniqid();
        Database::iud("UPDATE `invoice` SET `status`='1', `trackingNo`='".$code."' WHERE `user_email`='" . $email . "' AND `order_id`='" . $oid . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hirushasilva64@gmail.com';
        $mail->Password = 'kawdvwvvglpeztyp';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('hirushasilva64@gmail.com', 'GOKU');
        $mail->addReplyTo('hirushasilva64@gmail.com', 'GOKU');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your Product Shipped';
        $bodyContent = '<h1 style="color:blue;">Your Tracking No is ' . $code . '</h1>';
        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo 'Tracking number sending failed.';
        } else {
            echo 'Success';
        }
    } else {
        echo "error1.";
    }
} else {
    echo "error2.";
}

?>
