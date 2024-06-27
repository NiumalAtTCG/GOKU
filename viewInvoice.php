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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/boostrap.css">
</head>

<body>

    <?php include "adminheader.php" ?>
    <div class="col-12 mb-5 mt-3">
        <div class="row align-items-center">
            <h1 class="SectionHeader__Heading_admin Heading u-h1 text-center fw-semibold ">PRODUCT SHIPPING</h1>
        </div>
        
    </div>
    <div class="col-12">
        <div class="row">
        <div class="col-12 d-inline-block justify-content-center mb-2 mt-3 ">
   
</div>
            <div class="col-12"  id="page">
                <table>
                    <tr>
                        <th class="col-1">ID</th>
                        <th class="col-1  ">ORDER ID</th>
                        <th class="col-1">USER NAME</th>
                        <th class="col-2">EMAIL</th>
                        <th class="col-1">PID</th>
                        <th class="col-1">QTY</th>
                        <th class="col-2">PLACE ORDER DATE</th>
                        <th class="col-2">SHIP ITEM</th>
                       
                    </tr>
                    <?php
                    $query = "SELECT * FROM `invoice`";
                    $pageno;

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $user_rs = Database::search($query);
                    $user_num = $user_rs->num_rows;

                    $results_per_page = 6;
                    $number_of_pages = ceil($user_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);

                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();

                        $img_rs = Database::search("SELECT * FROM  `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                        $img_data = $img_rs->fetch_assoc();
                        $img_num = $img_rs->num_rows;

                        echo "<tr>";
                        echo "<td><span class='text-dark'>" . ($x + 1 + $page_results) . "</span></td>";
                        echo "<td><span>" . $selected_data['order_id'] . "</span></td>";
                        echo "<td><span class='text-dark'>" . $img_data["fname"] . " " . $img_data["lname"] . "</span></td>";
                        echo "<td><span>" . $selected_data['user_email'] . "</span></td>";
                        echo "<td><span>" . $selected_data['product_id'] . "</span></td>";
                        echo "<td><span class='text-dark'>" . $selected_data['qty'] . "</span></td>";
                        echo "<td><span>" . $selected_data['date'] . "</span></td>";
                        echo "<td>";
                        if ($selected_data['status'] == 0) {
                            echo "<button id='btn" . $selected_data['user_email'] . "' class='Active-btn' onclick=\"shipitem('" . $selected_data['user_email'] . "', '" . $selected_data['order_id'] . "');\">SHIP</button>";
                        } else {
                            echo "<button class='disabled-btn' onclick=\"alertShipped();\">Already Shipped</button>";
                        }
                        echo "</td>";
                        
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
</body>

</html>
<?php
} else {
    header("Location: adminsignin.php");
    exit();
}
?>