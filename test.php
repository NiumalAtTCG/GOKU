<!-- <?php
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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-yellow shadow sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-none d-lg-block" href="#">
                <img src="resources/goku.png" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav header-list">
                    <li class="nav-item">
                        <a class="nav-link" href="adminPanel.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manageUsers.php">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manageProducts.php">Manage Products</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <img src="resources/profile_images/image.png" alt="Profile" style="width: 30px;" class="me-2">
                <h5 class="mb-0"><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h5>
            </div>
        </div>
    </nav>

    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
<?php
} else {
    echo ("You are not a valid user");
}
?> -->
<i class="material-icons material-symbols-outlined d-none d-lg-block" style="margin-right: 8px;">flash_on</i>
<span class="d-none d-lg-block" style="margin-left: 10px;">WELCOME!</span>