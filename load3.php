<?php

require "connection.php";

// Adjust query to fetch data for each year along with product titles
$rs = Database::search("
    SELECT YEAR(invoice.date) as year, SUM(invoice.qty) as qty, product.title 
    FROM invoice 
    INNER JOIN product ON invoice.product_id = product.id 
    GROUP BY YEAR(invoice.date), product.title
");

$n = $rs->num_rows;

$data = [];

if ($n >= 1) {
    while ($chart_data = $rs->fetch_assoc()) {
        $year = $chart_data["year"];
        $title = $chart_data["title"];
        $qty = $chart_data["qty"];
        
        if (!isset($data[$year])) {
            $data[$year] = [];
        }

        $data[$year][$title] = $qty;
    }
} else {
    $data["None"] = ["None" => 0];
}

echo json_encode($data);
?>
