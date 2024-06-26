<?php

session_start();
include "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];

$title = $_POST["t"];

$qty = $_POST["q"];
$cost = $_POST["co"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["de"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;

// Check if product with same title and price already exists
$result = Database::search("SELECT * FROM `product` WHERE `title` = '".$title."' AND `price` = '".$cost."'");

if ($result->num_rows > 0) {
    // If product exists, update the quantity
    Database::iud("UPDATE `product` SET `qty` = `qty` + '".$qty."' WHERE `title` = '".$title."' AND `price` = '".$cost."'");
     echo ("Quantity Updated");
} else {
    // If product does not exist, insert a new record
    Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,
    `delivery_fee_other`,`category_cat_id`,`status_status_id`,`user_email`) VALUES ('".$cost."','".$qty."','".$desc."','".$title."','".$date."','".$dwc."','".$doc."',
    '".$category."','".$status."','".$email."')");
}

$product_id = Database::$connection->insert_id;

$length = sizeof($_FILES);

if($length <= 3 && $length > 0){

    $allowed_image_extensions = array("image/jpeg","image/png","image/svg+xml");

    for($x = 0;$x < $length;$x++){
        if(isset($_FILES["image".$x])){

            $image_file = $_FILES["image".$x];
            $file_extension = $image_file["type"];

            if(in_array($file_extension,$allowed_image_extensions)){

                $new_img_extension;

            if($file_extension == "image/jpeg"){
                $new_img_extension = ".jpeg";
            }else if($file_extension == "image/png"){
                $new_img_extension = ".png";
            }else if($file_extension == "image/svg+xml"){
                $new_img_extension = ".svg";
            }

            $file_name = "resources//product_images//".$title."_".$x."_".uniqid().$new_img_extension;
            move_uploaded_file($image_file["tmp_name"],$file_name);

            Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES 
            ('".$file_name."','".$product_id."')");

            }else{
                echo ("Invalid image type.");
            }

        }
    }

    echo ("success");

}else{
    echo ("_&_Invalid Image Count.");
}

?>
