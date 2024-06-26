<?php
require "connection.php";

$service_id = $_GET['service'] ?? '';

$query = "SELECT feedback.feed, product.id, service.rating, product.title, feedback.date, feedback.user_email FROM feedback
          INNER JOIN service ON feedback.service_id = service.service_id
          INNER JOIN product ON feedback.product_id = product.id";

if ($service_id) {
    $query .= " WHERE feedback.service_id = '" . $service_id . "'";
}

$feedback_rs = Database::search($query);
$feedback_num = $feedback_rs->num_rows;

if ($feedback_num > 0) {
    echo "<tr>
            <th class='col-1'>ID</th>
            <th class='col-1'>SERVICE</th>
            <th class='col-2'>USER</th>
            <th class='col-2'>PRODUCT</th>
            <th class='col-2'>FEED</th>
            <th class='col-2'>DATE</th>
          </tr>";

    for ($x = 0; $x < $feedback_num; $x++) {
        $feedback_data = $feedback_rs->fetch_assoc();
        echo "<tr>";
        echo "<td><span class='text-dark'>" . ($x + 1) . "</span></td>";
        echo "<td><span class='text-dark'>" . $feedback_data["rating"] . "</span></td>";
        echo "<td><span class='text-dark'>" . $feedback_data["user_email"] . "</span></td>";
        echo "<td><span>" . $feedback_data['title'] . '-' . $feedback_data['id'] . "</span></td>";
        echo "<td><span class='text-dark'>" . $feedback_data['feed'] . "</span></td>";
        echo "<td><span>" . $feedback_data['date'] . "</span></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No feedbacks found for the selected service.</td></tr>";
}
?>
