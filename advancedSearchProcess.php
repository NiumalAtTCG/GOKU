<?php

include "connection.php";

$search_txt = $_POST["t"];
$category = $_POST["cat"];

$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$status = 0;

if ($sort == 0) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_cat_id`='" . $category . "'";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_cat_id`='" . $category . "'";
    }


    if (!empty($price_from) && empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_from . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $price_from . "'";
        }
    }

    if (empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $price_to . "'";
        }
    }

    if (!empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        }
    }
} else if ($sort == 1) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%' ORDER BY `price` ASC";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_cat_id`='" . $category . "' ORDER BY `price` ASC";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_cat_id`='" . $category . "' ORDER BY `price` ASC";
    }



   


    if (!empty($price_from) && empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_from . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $price_from . "' ORDER BY `price` ASC";
        }
    }

    if (empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $price_to . "' ORDER BY `price` ASC";
        }
    }

    if (!empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` ASC";
        }
    }
}

?>



<?php

$pageno;

if ("0" != ($_POST["page"])) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 6;
$number_of_pages = ceil($product_num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page;
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

$selected_num = $selected_rs->num_rows;
for ($x = 0; $x < $selected_num; $x++) {
    $selected_data = $selected_rs->fetch_assoc();
?>


                            <?php
                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                $img_data = $img_rs->fetch_assoc();
                ?>
                                        <div class="col-md-6 col-lg-3 mt-2 mb-4 text-center">
                                            <div class="row">
                                                <?php
                                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                $img_data = $img_rs->fetch_assoc();
                                                ?>
                                                <img src="<?php echo $img_data["img_path"]; ?>"
                                                    class="card-img-top img-fluid mt-2" />
                                                <div class="ms-0 m-0 text-center">
                                                    <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>
                                                    <span >QTY-<?php echo $selected_data["qty"] ?></span><br />
                                                    <span>RS.<?php echo $selected_data["price"] ?>.00</span><br />
                                                    <?php
                                                    if ($selected_data["qty"] > 0) {
                                                        ?>
                                                        <div class="d-flex justify-content-center mt-2">
                                                            <button class="buy-btn" type="button" data-bs-toggle="offcanvas"
                                                                data-bs-target="#offcanvasWithBothOptions"
                                                                aria-controls="offcanvasWithBothOptions"
                                                                onclick="addToCart(<?php echo $selected_data['id']; ?>)">ADD TO
                                                                CART</button>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="d-flex justify-content-center mt-2">
                                                            <button class="outOfStock-btn" data-bs-toggle="offcanvas"
                                                                data-bs-target="#offcanvasWithBothOptions"
                                                                aria-controls="offcanvasWithBothOptions">OUT OF STOCK</button>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <?php

                          
                               
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
               
            </div>
        </div>

<?php
}
?>

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                                } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item text-black">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                                } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

