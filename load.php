<?php

require "connection.php";

$today_date = date("Y-m-d");
$rs = Database::search("
    SELECT invoice.qty, product.title 
    FROM invoice 
    INNER JOIN product ON invoice.product_id = product.id 
    WHERE DATE(invoice.date) = '$today_date'
");

$n = $rs->num_rows;

$st = 0;

if ($n >= 1) {
    while ($chart_data = $rs->fetch_assoc()) {
        if ($st != "5") {
            $qty[] = $chart_data["qty"];
            $name[] = $chart_data["title"];
            $st = $st + 1;
        }
    }
} else {
    $qty[] = 0;
    $name[] = "None";
}

$data = new stdClass();
$data->qty = $qty;
$data->name = $name;

echo json_encode($data);
?>
