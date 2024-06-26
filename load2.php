<?php

require "connection.php";

// Adjust query to fetch data for each month along with product titles
$rs = Database::search("
    SELECT DATE_FORMAT(invoice.date, '%Y-%m') as month, SUM(invoice.qty) as qty, product.title 
    FROM invoice 
    INNER JOIN product ON invoice.product_id = product.id 
    GROUP BY DATE_FORMAT(invoice.date, '%Y-%m'), product.title
");

$n = $rs->num_rows;

$data = [];

if ($n >= 1) {
    while ($chart_data = $rs->fetch_assoc()) {
        $month = $chart_data["month"];
        $title = $chart_data["title"];
        $qty = $chart_data["qty"];
        
        if (!isset($data[$month])) {
            $data[$month] = [];
        }

        $data[$month][$title] = $qty;
    }
} else {
    $data["None"] = ["None" => 0];
}

echo json_encode($data);
?>
