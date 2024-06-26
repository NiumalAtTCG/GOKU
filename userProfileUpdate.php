<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GOKU</title>
    <link rel="stylesheet" href="css/boostrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/main.css">

    <link rel="icon" href="resource/logo.svg" />

</head>

<body>
    <?php
    session_start();
    include "connection.php";
    require "header.php";



    if (isset($_SESSION["u"])) {

        $email = $_SESSION["u"]["email"];

        $details_rs = Database::search("SELECT * FROM `user`  WHERE `email`='" . $email . "'");

        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                city.district_district_id=district.district_id INNER JOIN `province` ON 
                district.province_province_id=province.province_id WHERE `user_email`='" . $email . "'");

        $user_details = $details_rs->fetch_assoc();
        $image_details = $image_rs->fetch_assoc();
        $address_details = $address_rs->fetch_assoc();
        ?>
        <div class="container-fluid">


            <div class="row">


                <div class="col-12">

                    <div class="row">
                        <div class="row align-items-center">
                            <h1 class=" SectionHeader__Heading_cart Heading u-h1 text-center fw-semibold ">PROFILE</h1>
                        </div>

                        <div class="col-12 bg-body rounded mt-4 mb-4  ">
                            <div class="row g-2">
                                <div class="col-md-1"></div>
                                <div class="col-md-3  cart-class-div">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <?php

                                        if (empty($image_details["path"])) {
                                            ?>
                                            <img src="resources\profile_images\image.png" class="rounded mt-5"
                                                style="width: 150px;" id="img" />
                                            <?php
                                        } else {
                                            ?>
                                            <img src="<?php echo $image_details["path"]; ?>" class="rounded mt-5" id="img"
                                                style="width: 150px;" />
                                            <?php
                                        }

                                        ?>

                                        <div class="col-12 mb-4 d-flex flex-column align-items-center">
                                            <div class="row text-center">
                                                <span
                                                    class="fw-bold"><?php echo $user_details["fname"] . " " . $user_details["lname"] ?></span>
                                                <span class="fw-bold text-black-50"><?php echo $email; ?></span>
                                            </div>
                                            <input type="file" class="d-none" id="profileimage" />
                                            <label for="profileimage" class="common-btn mt-1"
                                                onclick="changeProfileImg();">Update Profile Image</label>
                                        </div>

                                        <h2>CHANGE PASSWORD</h2>
                                        <div class="col-12 cart-class-div p-4">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label">Currunt Password</label>
                                                    <input type="text" class="form-control " id="cpass" />
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">New Password</label>
                                                    <input type="text" class="form-control" id="newpass" />
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">Re-Type Naw Password</label>
                                                    <input type="text" class="form-control" id="renewpass" />
                                                </div>

                                                <div> <label class="common-btn mt-1" onclick="changePassword();">Update
                                                    </label>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7  cart-class-div">
                                    <div class="p-3  ">


                                        <div class="d-flex justify-content-between align-items-center mb-3">

                                        </div>

                                        <div class="row mt-4">
                                            <h2>USER DETAILS</h2>
                                            <div class="col-12 cart-class-div p-4 mb-5">
                                                <div class="row">

                                                    <div class="col-4">
                                                        <label class="form-label">First Name</label>
                                                        <input id="fname" type="text" class="form-control"
                                                            value="<?php echo $user_details["fname"]; ?>" />
                                                    </div>

                                                    <div class="col-4">
                                                        <label class="form-label">Last Name</label>
                                                        <input id="lname" type="text" class="form-control"
                                                            value="<?php echo $user_details["lname"]; ?>" />
                                                    </div>

                                                    <div class="col-4">
                                                        <label class="form-label">Registered Date</label>
                                                        <input type="text" class="form-control" readonly
                                                            value="<?php echo $user_details["joined_date"]; ?>" />
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control" readonly
                                                            value="<?php echo $user_details["email"]; ?> " id="email22" />
                                                    </div>


                                                    <div class="col-4">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" class="form-control" readonly
                                                            value="<?php echo $user_details["password"]; ?>" />
                                                    </div>


                                                    <div class="col-4">
                                                        <label class="form-label">Mobile</label>
                                                        <input id="mobile" type="text" class="form-control"
                                                            value="<?php echo $user_details["mobile"]; ?>" />
                                                    </div>


                                                </div>
                                            </div>
                                            <h2>SHIPPING DETAILS</h2>
                                            <div class="col-12 cart-class-div p-4">
                                                <div class="row">

                                                    <div class="col-6">
                                                        <label class="form-label">Address Line 01</label>

                                                        <?php
                                                        if (empty($address_details["line1"])) {
                                                            ?>
                                                            <input id="line1" type="text" class="form-control" />
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <input id="line1" type="text" class="form-control"
                                                                value="<?php echo $address_details["line1"]; ?>" />
                                                            <?php
                                                        }
                                                        ?>

                                                    </div>

                                                    <div class="col-6">
                                                        <label class="form-label ">Address Line 02</label>
                                                        <?php
                                                        if (empty($address_details["line2"])) {
                                                            ?>
                                                            <input id="line2" type="text" class="form-control" />
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <input id="line2" type="text" class="form-control"
                                                                value="<?php echo $address_details["line2"]; ?>" />
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    <?php
                                                    $province_rs = Database::search("SELECT * FROM `province`");
                                                    $district_rs = Database::search("SELECT * FROM `district`");
                                                    $city_rs = Database::search("SELECT * FROM `city`");
                                                    ?>

                                                    <div class="col-3">
                                                        <label class="form-label  mb-3">Province</label>
                                                        <select class="form-select" id="province">
                                                            <option value="0">Select Province</option>
                                                            <?php
                                                            for ($x = 0; $x < $province_rs->num_rows; $x++) {
                                                                $province_data = $province_rs->fetch_assoc();
                                                                ?>
                                                                <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                                   if (!empty($address_details["province_id"])) {
                                                                       if ($province_data["province_id"] == $address_details["province_id"]) {
                                                                           ?>selected<?php
                                                                       }
                                                                   }
                                                                   ?>>
                                                                    <?php echo $province_data["province_name"]; ?>
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-3">
                                                        <label class="form-label  mb-3">District</label>
                                                        <select class="form-select" id="district">
                                                            <option value="0">Select District</option>
                                                            <?php
                                                            for ($x = 0; $x < $district_rs->num_rows; $x++) {
                                                                $district_data = $district_rs->fetch_assoc();
                                                                ?>
                                                                <option value="<?php echo $district_data["district_id"]; ?>" <?php
                                                                   if (!empty($address_details["district_id"])) {
                                                                       if ($district_data["district_id"] == $address_details["district_id"]) {
                                                                           ?>selected<?php
                                                                       }
                                                                   }
                                                                   ?>>
                                                                    <?php echo $district_data["district_name"]; ?>
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>

                                                    <div class="col-3">
                                                        <label class="form-label mb-3">City</label>
                                                        <select class="form-select" id="city">
                                                            <option value="0">Select City</option>
                                                            <?php
                                                            for ($x = 0; $x < $city_rs->num_rows; $x++) {
                                                                $city_data = $city_rs->fetch_assoc();
                                                                ?>
                                                                <option value="<?php echo $city_data["city_id"]; ?>" <?php
                                                                   if (!empty($address_details["city_id"])) {
                                                                       if ($city_data["city_id"] == $address_details["city_id"]) {
                                                                           ?>selected<?php
                                                                       }
                                                                   }
                                                                   ?>>
                                                                    <?php echo $city_data["city_name"]; ?>
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>

                                                    <div class="col-3">
                                                        <label class="form-label">Postal Code</label>
                                                        <?php
                                                        if (empty($address_details["postal_code"])) {
                                                            ?>
                                                            <input id="pcode" type="text" class="form-control" />
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <input id="pcode" type="text" class="form-control"
                                                                value="<?php echo $address_details["postal_code"]; ?>" />
                                                            <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 d-grid mt-2">
                                                <button class="buy-btn" onclick="updateProfile();">Update My
                                                    Profile</button>
                                            </div>
                                            <div class="col-lg-4 d-none d-lg-block"></div>
                                            <div class="col-2 d-grid mt-4 text-end">
                                                <img class="logo" src="resources\goku.png" alt="Logo">
                                            </div>




                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>


                    </div>
                </div>

                <?php
    } else {
        ?>

                <script>
                    window.location = "login.php";
                </script>

                <?php
    }

    ?>
            <script src="js\bootstrap.bundle.js"></script>
            <script src="js\script.js"></script>
</body>
<?php include "footer.php" ?>

</html>