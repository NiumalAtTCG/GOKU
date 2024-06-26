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
    <div class="col-12 mb-2 mt-3">
        <div class="row align-items-center">
            <h1 class="SectionHeader__Heading_admin Heading u-h1 text-center fw-semibold ">Dashboard</h1>
        </div>
    </div>
    <div class="col-12 btn-toolbar justify-content-end mb-2">
       
        <button class="bg-white me-2" onclick="createPDFOfPage();"><i class="bi bi-filetype-pdf fs-3"></i></button>
    </div>
    <div class="col-12 mb-2" id="page">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-12 col-lg-5">
                <div class="row" >
                    <div class="col-12 rounded rounded-3 border border-secondary border-2 p-2">
                        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="row">
                    <div class="col-12 rounded rounded-3 border border-secondary border-2 p-2">
                        <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-1"></div>
            <div class="col-12 col-lg-10">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center rounded rounded-3 border border-secondary border-2 p-2">
                        <canvas id="myChart2" style="width:100%;max-width:800px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/script.js"></script>
    
    <script>

        function createPDFOfPage() {
            const element = document.getElementById('page');
   
            setTimeout(() => {
                html2pdf().from(element).save('dashboard.pdf');
            }, 2000); 
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
