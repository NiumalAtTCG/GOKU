<?php
session_start();
include "connection.php";

$cn = $_POST['cn'];
if(empty($cn)){
    echo ("Please Enter catogory.");
}else{

    Database::iud("INSERT INTO `category` (`cat_name`,cat_status) VALUES ('".$cn."','1')");
    
    echo ("NEW CATOGORY ADDED");
    }




?>