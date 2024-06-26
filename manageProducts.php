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
            <h1 class="SectionHeader__Heading_admin text-center fw-semibold ">manage Products</h1>
        </div>
    </div>
    <div class="col-12 d-inline-block justify-content-center mb-2 mt-3 ">
    <div class="row align-content-center justify-content-center">

        <div class="col-4 d-flex justify-content-center">
            <button onclick="window.location.href='addproduct.php'" class="addprooduct-btn">ADD PRODUCT</button>
        </div>

        <div class="col-4 d-flex justify-content-center"> 
            <button onclick="window.location.href='AddProductData.php'" class="addprooduct-btn">MANAGE PRODUCT CATOGORY</button>
        </div>

        <div class="col-4 d-flex justify-content-center"> 
            <button class="addprooduct-btn" onclick="printInvoice();">Print Report</button>
        </div>

    </div>
</div>



    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12" id="page">
                <table>
                    <tr>
                        <th class="col-1">ID</th>
                        <th class="col-2">PRODUCT IMAGE</th>
                        <th class="col-2">FLAVOR</th>
                        <th class="col-1">PRICE</th>
                        <th class="col-1">QTY</th>
                        <th class="col-2">REGISTERED DATE</th>
                        <th class="col-1">STATUS</th>
                        <th class="col-2">Update</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM product INNER JOIN product_img ON product.id = product_img.product_id";
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

                        $img_rs = Database::search("SELECT * FROM  `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                        $img_data = $img_rs->fetch_assoc();
                        $img_num = $img_rs->num_rows;

                        echo "<tr>";
                        echo "<td><span class='text-dark'>" . ($x + 1 + $page_results) . "</span></td>";
                        echo "<td>";
                        if ($img_num == 1) {
                            echo "<img src='" . $img_data["img_path"] . "' style='height: 40px; margin-left: 80px;' />";
                        } else {
                            echo "<img src='resources\product_images\goku.png' style='height: 40px; margin-left: 80px;' />";
                        }
                        echo "</td>";
                        echo "<td><span class='text-dark'>" . $selected_data["title"] . " </span></td>";
                        echo "<td><span>" . $selected_data['price'] . "</span></td>";
                        echo "<td><span>" . $selected_data['qty'] . "</span></td>";

                        echo "<td><span>" . $selected_data['datetime_added'] . "</span></td>";
                        echo "<td>";
                        if ($selected_data["status_status_id"] == 1) {
                            echo "<button id='pb" . $selected_data['id'] . "' class='block-btn' onclick=\"blockProduct('" . $selected_data['id'] . "');\">Block</button>";
                        } else {
                            echo "<button id='pb" . $selected_data['id'] . "' class='Active-btn' onclick=\"blockProduct('" . $selected_data['id'] . "');\">Unblock</button>";
                        }
                        echo "</td>";
                        echo "<td>";
                       
                        echo "<button class='Active-btn' onclick='openModal(\"" . $selected_data['id'] . "\");'>Update QTY</button>";
                      
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
                    <a class="page-link text-black"
                        href="<?php if ($pageno <= 1) {
                            echo "#";
                        } else {
                            echo "?page=" . ($pageno - 1);
                        } ?>"
                        aria-label="Previous">
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
                    <a class="page-link text-black"
                        href="<?php if ($pageno >= $number_of_pages) {
                            echo "#";
                        } else {
                            echo "?page=" . ($pageno + 1);
                        } ?>"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- ****************************************************** -->
    <div class="modal" tabindex="-1" id="updateFlavorModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">UPDATE QUANTITY</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="col-12">
                        <label class="form-label">ADD QTY</label>
                        <input type="text" class="form-control" id="uf"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateFavorqty();">Update</button>
            </div>
        </div>
    </div>
</div>
            <!-- modal -->
            <script src="js\bootstrap.js"></script>
  <script src="js\bootstrap.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js\script.js"></script>
</body>

</html>
<?php
} else {
    header("Location: adminsignin.php");
    exit();
}
?>