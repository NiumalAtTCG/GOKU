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

</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">
      

<?php include "adminheader.php";

           

              

            ?>
<div class="col-1"></div>
                <div class="col-10 ">
                    <div class="row">

                        <div class="col-12 mb-5 text-center">
                            <h2 class="SectionHeader__Heading_admin">Add New Product</h2>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-4">
                            
                        
                         
                        </div>
                
                        <div class="col-12 p-3 cart-class-div">
                            <div class="row">

                                <div class="col-12 col-lg-3 border-end border-success">
                                    <div class="row">
                                
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">SELECT CATOGORY</label>
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select text-center" id="category">
                                                <option value="0">Select Category</option>
                                                <?php
                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                                        <?php echo $category_data["cat_name"]; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                          
                                <div class="col-12 col-lg-3  border-end border-success">
                                    <div class="row">
                                        <div class="col-12 ">
                                            <label class="form-label fw-bold" style="font-size: 20px;">
                                                FLAVOR
                                            </label>
                                        </div>
                                        <div class="offset-0 col-12 col-lg-12">
                                            <input type="text" class="form-control" id="title"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3  border-end border-success">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">ADD  QUANTITY</label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="number" class="form-control" value="0" min="0" id="qty"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3  ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold " style="font-size: 20px;">COST PER GOKU</label>
                                                </div>
                                                <div class="offset-0  col-12 col-lg-12">
                                                    <div class="input-group mb-2 mt-0">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="cost"/>
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                               

                           

                          

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-12 border-end border-success">
                                            <div class="row">
                                       
                                            </div>
                                        </div>

                               

                                 
                                   

                                    </div>
                                </div>

                                

                              

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="col-12 col-lg-6  border-end border-success">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;"> DELIVERY COST</label>
                                        </div>
                                        <div class="col-12 col-lg-6 border-end border-success">
                                            <div class="row">
                                                <div class="col-12  col-lg-12">
                                                    <label class="form-label">DELIVERY COST WITHIN COLOMBO</label>
                                                </div>
                                                <div class="col-12 col-lg-12">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="dwc"/>
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-12  col-lg-12">
                                                    <label class="form-label">DELIVERY COST OUT OF COLOMBO</label>
                                                </div>
                                                <div class="col-12 col-lg-12">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="doc"/>
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-3  border-end border-success">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">PRODUCT DESCRIPTION</label>
                                        </div>
                                        <div class="col-12">
                                            <textarea cols="5" rows="4" class="form-control" id="desc"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-lg-3 ">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">ADD IMAGES</label>
                                        </div>
                                        <div class="offset-lg-3 col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="resource/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0"/>
                                                </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="resource/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1"/>
                                                </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="resource/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i2"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="offset-lg-0 col-12 col-lg-12 d-grid mt-4">
                                            <input type="file" class="d-none" multiple id="imageuploader"/>
                                            <label for="imageuploader" class="col-12 common-btn" onclick="changeProductImage();">Upload Images</label>
                                        </div>
                                    </div>
                                </div>
                                
                           
                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>


                                
                        

                                <div class="offset-lg-3  col-12 col-lg-6 d-grid mt-3 mb-3">
                                    <button class="common-btn" onclick="addProduct();">Save Product</button>
                                </div>

                            </div>
                        </div>
                        <div class="col-1"></div>

                    </div>
                </div>
                <div class="col-1"></div>

            <?php

            // } else {
            //     header("Location: home.php");
            // }

            ?>

       
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/script.js"></script>
</body>

</html>
<?php
} else {
    header("Location: adminsignin.php");
    exit();
}
?>