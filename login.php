

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>GOKU</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <div class="login-container " id="signInBox">
      <div class="login-card">
         <h1>LOGIN</h1>
         <h4>Please enter your e-mail and password:</h4>
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
         <input type="text" placeholder="Email" id="email1" value="<?php echo $email; ?>">
         <input type="password" placeholder="Password" id="password1" value="<?php echo $password; ?>">
         <div class="d-flex">
            <div class="remember-me f-left">
               <input type="checkbox" id="rememberme" name="rememberme">
               <label for="rememberme">Remember Me</label>
            </div>
            <button class="forget_pass f-rignt" onclick="forgotPassword();">Forget password ?</button>
         </div>
         <button class="login_btn" onclick="signin();"><span>LOGIN</span></button>
         <p>Dont have an account? <button onclick="changeView();">Create one</button></p>
      </div>
   </div>





   <div class="login-container d-none " id="signUpBox">
      <div class="login-card">
         <h1>REGISTER</h1>
         <h4>Please fill in the information below:</h4>
         <div id="msgdiv d-none">
            <div class="msg " id="msg"></div>
         </div>
         <input type="text" placeholder="First name" id="fname">
         <input type="text" placeholder="Last name" id="lname">
         <input type="email" placeholder="Email" id="email">
         <input type="password" placeholder="Password" id="password">
         <button class="login_btn " onclick="signup();"><span>CREATE MY ACCOUNT</span></button>
         <p>Already have an account? <button onclick="changeView();">Back to Login</button></p>
      </div>
   </div>


   <div class="login-container-d-box d-none " id="fpmodal">
      <div class="login-card">
         <h1>Forgot Password</h1>
         <h4>Please fill in the information below:</h4>
         <div id="msgdiv d-none">
            <div class="msg " id="msg"></div>
         </div>


   
         <input type="password" placeholder="New Password" id="np">
         <input type="password" placeholder="Re-type Password" id="rnp">
         <input type="text" placeholder="Verification Code" id="vcode">
         <button class="login_btn " onclick="resetPassword();"><span>SUBMIT</span></button>
         <p>Already have an account? <button onclick="window.location='login.php'">Back to Login</button></p>

      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="js\script.js"></script>

</body>

</html>