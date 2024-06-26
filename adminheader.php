
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    
   <style>
        .navbar-nav {
            flex: 1;
            justify-content: center;
        }
        .navbar-right {
            display: flex;
            align-items: center;
        }
        .navbar-right img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .header-list{
        
    list-style: none;

    color: #000;
    font-size: 15px;
    font-family: NormalidadWide-Medium;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .87px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <a class="navbar-brand" href="#">
            <img src="resources/goku.png" alt="Logo" width="70" height="30">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
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
                    <li class="nav-item">
                        <a class="nav-link" href="viewfeedback.php">FEEDBACKS</a>
                    </li>
                </ul>
            <div class="navbar-right">
            <img src="resources/profile_images/image.png" alt="Profile" style="width: 35px;" class="me-2">
            <h5 class="mb-0"><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h5>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
