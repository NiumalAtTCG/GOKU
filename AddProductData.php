<?php
session_start();
require "connection.php";

if (isset($_SESSION["au"])) {
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product | eShop</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/boostrap.css">

    <link rel="icon" href="resource/logo.svg" />

</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">


            <?php include "adminheader.php";





            ?>
          
            <div class="col-12   ">
                <div class="row">

                    <div class="row align-items-center">
                        <h1 class="SectionHeader__Heading_admin Heading u-h1 text-center fw-semibold ">Manege CATOGORY</h1>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-12 col-lg-4 mt-5  cart-class-div">
                                    <div class="row">
                                        <div class="col-12 ">
                                            <label class="form-label fw-bold " style="font-size: 20px;">
                                               ADD NEW CATOGORY
                                            </label>
                                        </div>
                                        <div class="offset-0 col-12 col-lg-12">
                                            <input type="text" class="form-control" id="c-name"/>
                                        </div>
                                        <div class="  col-6 col-lg-6 d-grid mt-3 mb-3">
                                    <button class="common-btn" onclick="updateCatogory();">ADD</button>
                                </div>
                                    </div>
                                </div>
                    <div class="col-12 col-lg-6 ">


                        <div class="col-12 mb-5 mt-3">

                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <table>
                                        <tr>
                                            <th class="col-1">ID</th>
                                            <th class="col-1">CATOGORY</th>
                                            <th class="col-2">STATUS</th>
                                        </tr>
                                        <?php
                                        $query = "SELECT * FROM `category`";
                                        $pageno;

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $user_rs = Database::search($query);
                                        $user_num = $user_rs->num_rows;

                                        $results_per_page = 2;
                                        $number_of_pages = ceil($user_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);

                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();

                                            $img_rs = Database::search("SELECT * FROM  `category` ");
                                            $img_data = $img_rs->fetch_assoc();
                                            $img_num = $img_rs->num_rows;

                                            echo "<tr>";
                                            echo "<td><span class='text-dark'>" . ($x + 1 + $page_results) . "</span></td>";


                                            echo "<td><span>" . $selected_data['cat_name'] . "</span></td>";

                                            echo "<td>";
                                            if ($selected_data["cat_status"] == 1) {
                                                echo "<button id='cb" . $selected_data['cat_id'] . "' class='block-btn' onclick=\"deactiveCategory('" . $selected_data['cat_id'] . "');\">De-Active</button>";
                                            } else {
                                                echo "<button id='cb" . $selected_data['cat_id'] . "' class='Active-btn' onclick=\"deactiveCategory('" . $selected_data['cat_id'] . "');\">Active</button>";
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





                        <!-- 
                                <div class="offset-lg-3  col-12 col-lg-6 d-grid mt-3 mb-3">
                                    <button class="common-btn" onclick="addProduct();">Save Product</button>
                                </div> -->

                    </div>
                    <div class="col-1"></div>
                </div>
             

            </div>
        </div>
   

        <?php


        ?>


    </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
<?php
} else {
    header("Location: adminsignin.php");
    exit();
}
?>