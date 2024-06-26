<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GOKU</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
  <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
  <?php
  if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $details_rs = Database::search("SELECT * FROM `user`  WHERE `email`='" . $email . "'");

    $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");
    $user_details = $details_rs->fetch_assoc();
    $image_details = $image_rs->fetch_assoc();
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
          aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto  mb-lg-0 header-list">
            <li class="nav-item">
              <a class="nav-link active fw-bolder" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bolder" href="shopview.php">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bolder" href="aboutGoku.php">About Goku</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bolder" href="gmap.php">Where to Buy</a>
            </li>
          </ul>
        </div>
        <div class="col-4 mt-1 ">
          <img class="logo" src="resources/goku.png" alt="Logo">
        </div>
        <div class="col-3 d-none d-lg-block" style="display: flex; justify-content: center;">
  <button type="button" class="search-btn" onclick="window.location.href='userProfileUpdate.php';" style="display: flex; align-items: center;">
    <?php
    if (empty($image_details["path"])) {
      ?>
      <img src="resources\profile_images\image.png" class="rounded" style="width: 50px;,height: 30px;" id="img" />
      <?php
    } else {
      ?>
      <img src="<?php echo $image_details["path"]; ?>" class="rounded" id="img" style="width: 25px; ,height: 30px;" />
      <?php
    }
    ?>
    <span class="" style="margin-left: 10px;">
      <?php echo $user_details["fname"] . " " . $user_details["lname"] ?>
    </span>
  </button>
</div>

        <div class="col-1 col-lg-1 d-flex justify-content-end">
          <ul class="icons">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="material-symbols-outlined fs-2">apps</i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                <li><a class="dropdown-item" href="home.php"><i class="material-symbols-outlined">home</i></a></li>
                <li><a class="dropdown-item" href="userProfileUpdate.php"><i
                      class="material-symbols-outlined">person</i></a></li>
                <li><a class="dropdown-item" href="cart.php"><i class="material-symbols-outlined">shopping_cart</i></a>
                </li>
                <li><a class="dropdown-item" href="myProducts.php"><i
                      class="material-symbols-outlined">shopping_bag</i></a></li>
                <li><a class="dropdown-item" href="shop.php"><i class="material-symbols-outlined">search</i></a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#" onclick="signout();" style="color: red"><i
                      class="material-symbols-outlined">logout</i></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <?php
  } else {
    ?>

    <script>
      window.location = "login.php";
    </script>

    <?php
  }

  ?>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/script.js"></script>

</body>

</html>