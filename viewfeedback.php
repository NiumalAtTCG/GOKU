<?php
session_start();
require "connection.php";

if (isset($_SESSION["au"])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/boostrap.css">
</head>

<body>

    <?php include "adminheader.php" ?>
    <div class="col-12 mb-5 mt-3">
        <div class="row align-items-center">
            <h1 class="SectionHeader__Heading_admin Heading u-h1 text-center fw-semibold ">FEEDBACKS</h1>
        </div>
    </div>
 <div class="col-12">
    <div class="row">
    <div class="col-1"></div>
    <div class="col-10  border-bottom  border-3 border-dark">
        <span class="fw-bold mt-2">SEARCH BY SERVICE :</span>
        <select class=" p-1 " id="serviceDropdown" onchange="fetchData()">
            <option value="">SELECT SERVICE TYPE</option>
            <?php
            $service_rs = Database::search("SELECT * FROM `service`");
            while ($service_rst_data = $service_rs->fetch_assoc()) {
                echo "<option value='" . $service_rst_data["service_id"] . "'>" . $service_rst_data["rating"] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-12">
        <div class="row" style="height: 20px;"></div>
    </div>
 <div class="col-1"></div>
    </div>
 </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <table id="feedbackTable">
                    <tr>
                        <th class="col-1">ID</th>
                        <th class="col-1  ">SERVICE</th>
                        <th class="col-2">USER</th>
                        <th class="col-2">PRODUCT</th>
                        <th class="col-2">FEED</th>
                        <th class="col-2"> DATE</th>
                    </tr>
                    <?php
                    $query = "SELECT feedback.feed,product.id, service.rating, product.title, feedback.date, feedback.user_email FROM feedback
                              INNER JOIN service ON feedback.service_id = service.service_id
                              INNER JOIN product ON feedback.product_id = product.id";
                    $pageno;

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $user_rs = Database::search($query);
                    $user_num = $user_rs->num_rows;

                    $results_per_page = 20;
                    $number_of_pages = ceil($user_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);

                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();

                        echo "<tr>";
                        echo "<td><span class='text-dark'>" . ($x + 1 + $page_results) . "</span></td>";
                        echo "<td><span class='text-dark'>" . $selected_data["rating"]."</span></td>";
                        echo "<td><span class='text-dark'>" . $selected_data["user_email"]."</span></td>";
                        echo "<td><span>" . $selected_data['title'] .'-' . $selected_data['id'] . "</span></td>";
                        echo "<td><span class='text-dark'>" . $selected_data['feed'] . "</span></td>";
                        echo "<td><span>" . $selected_data['date'] . "</span></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link text-black" href="<?php if ($pageno <= 1) { echo "#"; } else { echo "?page=" . ($pageno - 1); } ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                        echo "<li class='page-item active bg'>";
                        echo "<a class='page-link bg-black' href='?page=" . $x . "'>" . $x . "</a>";
                        echo "</li>";
                    } else {
                        echo "<li class='page-item'>";
                        echo "<a class='page-link bg-black' href='?page=" . $x . "'>" . $x . "</a>";
                        echo "</li>";
                    }
                }
                ?>
                <li class="page-item bg">
                    <a class="page-link text-black" href="<?php if ($pageno >= $number_of_pages) { echo "#"; } else { echo "?page=" . ($pageno + 1); } ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <script src="js\bootstrap.js"></script>
    <script src="js\bootstrap.bundle.js"></script>
    <script src="js\script.js"></script>
    <script>
        function fetchData() {
            var service = document.getElementById('serviceDropdown').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_feedback.php?service=' + service, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    document.getElementById('feedbackTable').innerHTML = this.responseText;
                }
            };
            xhr.send();
        }
    </script>
</body>

</html>
<?php
} else {
    header("Location: adminsignin.php");
    exit();
}
?>
