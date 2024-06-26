<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="login-container " id="verificationModal1">
        <div class="login-card">
            <h1>ADMIN LOGIN</h1>
            <h4>Please enter your e-mail:</h4>
            <div id="msgdiv1 ">
                <div class="msg1 " id="msg1"></div>
            </div>
            <?php
            $email = "";
            $password = "";

            if (isset($_COOKIE["email"])) {
                $email = $_COOKIE["email"];
            }

            if (isset($_COOKIE["password"])) {
                $password = $_COOKIE["password"];
            }
            ?>
            <input type="text" placeholder="Email" id="e" value="<?php echo $email; ?>">
            <button class="login_btn"  onclick="adminVerification(); changeView2(); " ><span>SEND VERIFICATION CODE</span></button>
            <p>Back to customer login <button onclick="window.location.href='login.php'">Click Me</button></p>
        </div>

    </div>


<!-- *************************veryfy**************************************************************** -->
    <div class="login-container-d-box d-none " id="verificationModal2">
      <div class="login-card">
         <h1>Enter your verification code</h1>
   
         <input type="text" placeholder="Verification Code" id="vcode">
         <button class="login_btn " onclick="verify();"><span>VERYFY</span></button>
         <p>Back? <button onclick="window.location='login.php'">Back to Admin Login</button></p>

      </div>
   </div>







   
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js\script.js"></script>

</body>

</html>