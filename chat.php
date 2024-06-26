<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <link rel="stylesheet" href="css\chat.css">
    <link rel="stylesheet" href="css\boostrap.css">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>

    <div class="chat-container">

        <?php

        session_start();
        include "connection.php";
    


        if (isset($_SESSION["u"]) && (isset($_GET['id']))) {

            $user = $_SESSION["u"]["email"];
            $pid = $_GET['id'];
            ?>
            <div class=" col-12 chat-header bg-light p-1 bfcol">
                <div class="row">
                <div class="col-1">
                <a href="myProducts.php"><i class="text-text-decoration-none material-symbols-outlined  fs-1 text-bg-dark">arrow_back</i></a>
                    </div>
                    <div class="col-10 text-center mb-3 mt-3 text-black">
                        <h3>SEND A FEEDBACK</h3>
                    </div>
                    <div class="col-1">
                
                    </div>
                    <div class="col-12">
                        <div class="row">

                            <div class="col-3">

                            </div>
                            <div class="col-6">
                                <h6 class="text-dark" id="user"><?php echo ($user) ?></h6>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <h6 class="text-dark">SERVICE</h6>
                            </div>
                            <div class="col-6">

                                <select class="form-select" id="subject" >

                                    <?php

                                    $servise = Database::search("SELECT `rating` FROM `service` ");

                                    for ($i = 0; $i < $servise->num_rows; $i++) {
                                        $servise_data = $servise->fetch_assoc();
                                        ?>

                                        <option>
                                            <?php echo $servise_data["rating"]; ?>
                                        </option>

                                        <?php
                                    }
                                    ?>

                                </select>
                                <!-- *********************** -->
                           

                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="chat-box" id="chat-box">
            <div class="row mt-3 overflow-auto chatbox  ">
                                    <div class="col-12 " id="ch">




                                    </div>
                                </div>
            </div>
            <div class="chat-input">
                <input type="text" id="msg" placeholder="Type your message..." autocomplete="off">
                <button onclick="sendMessage('<?php echo $user; ?>','<?php echo $pid; ?>')">Send</button>

            </div>
            <?php
        }
        ?>
    </div>
    <script src="js\bootstrap.js"></script>
    <script src="js\bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js\script.js"></script>
</body>

</html>