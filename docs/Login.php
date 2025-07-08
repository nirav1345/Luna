<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="Login.css" />
  <title>Login</title>
  <link rel="shortcut icon" type="image/x-icon" href="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd076b8af2de62a58babdc_Favicon.png">
  <link rel="apple-touch-icon" href="https://assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd081f7534b09e8a678e7e_WebClip.png">
  <?php include 'Lnav.php'; ?>
</head>
<body>

  <div class="hero">
  <div class="form-box">
    <div class="button-box">
      <div id="btn"></div>
      <button type="button" class="toggle-btn" onclick="login()">Login</button>
      <button type="button" class="toggle-btn" onclick="register()">Sign up</button>
    </div>

<form id="login" class="input-group" action="auth.php" method="POST">
  <input type="email" class="input-field" name="email" placeholder="Email" required />
  <input type="password" class="input-field" name="password" placeholder="Enter Password" required />
  <input type="checkbox" class="check-box" /><span>Remember Me</span>
  <button type="submit" name="login" class="submit-btn">Login</button>

  <button type="button" class="spotify-btn" onclick="window.location.href='spotify_login.php'">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 64 64" class="spotify-icon">
      <path d="M32 0C14.3 0 0 14.337 0 32c0 17.7 14.337 32 32 32 17.7 0 32-14.337 32-32S49.663 0 32 0zm14.68 46.184c-.573.956-1.797 1.223-2.753.65-7.532-4.588-16.975-5.62-28.14-3.097-1.07.23-2.14-.42-2.37-1.49s.42-2.14 1.49-2.37c12.196-2.79 22.67-1.606 31.082 3.556a2 2 0 0 1 .688 2.753zm3.9-8.717c-.726 1.185-2.256 1.53-3.44.84-8.602-5.276-21.716-6.805-31.885-3.747-1.338.382-2.714-.344-3.097-1.644-.382-1.338.344-2.714 1.682-3.097 11.622-3.517 26.074-1.835 35.976 4.244 1.147.688 1.49 2.217.765 3.403zm.344-9.1c-10.323-6.117-27.336-6.69-37.2-3.708-1.568.497-3.25-.42-3.747-1.988s.42-3.25 1.988-3.747c11.317-3.44 30.127-2.753 41.98 4.282 1.415.84 1.873 2.676 1.032 4.09-.765 1.453-2.638 1.912-4.053 1.07z" fill="#1ed760"/>
    </svg>
    Continue with Spotify
  </button>
</form>

<form id="register" class="input-group" action="auth.php" method="POST">
  <input type="text" class="input-field" name="name" placeholder="Name" required />
  <input type="email" class="input-field" name="email" placeholder="Email" required />
  <input type="password" class="input-field" name="password" placeholder="Enter Password" required />
  <input type="checkbox" class="check-box" required /><span>I agree to the terms & conditions</span>
  <button type="submit" name="register" class="submit-btn">Register</button>
  
  <button type="button" class="spotify-btn" onclick="window.location.href='spotify_login.php'">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 64 64" class="spotify-icon">
      <path d="M32 0C14.3 0 0 14.337 0 32c0 17.7 14.337 32 32 32 17.7 0 32-14.337 32-32S49.663 0 32 0zm14.68 46.184c-.573.956-1.797 1.223-2.753.65-7.532-4.588-16.975-5.62-28.14-3.097-1.07.23-2.14-.42-2.37-1.49s.42-2.14 1.49-2.37c12.196-2.79 22.67-1.606 31.082 3.556a2 2 0 0 1 .688 2.753zm3.9-8.717c-.726 1.185-2.256 1.53-3.44.84-8.602-5.276-21.716-6.805-31.885-3.747-1.338.382-2.714-.344-3.097-1.644-.382-1.338.344-2.714 1.682-3.097 11.622-3.517 26.074-1.835 35.976 4.244 1.147.688 1.49 2.217.765 3.403zm.344-9.1c-10.323-6.117-27.336-6.69-37.2-3.708-1.568.497-3.25-.42-3.747-1.988s.42-3.25 1.988-3.747c11.317-3.44 30.127-2.753 41.98 4.282 1.415.84 1.873 2.676 1.032 4.09-.765 1.453-2.638 1.912-4.053 1.07z" fill="#1ed760"/>
    </svg>
    Sign up with Spotify
  </button>
</form>
  </div>
</div>
  <?php
  if (isset($_SESSION['error_login']) || isset($_SESSION['error_register']) || isset($_SESSION['success_register'])) {
      echo '<div id="message-container" class="message-box">';
  
      if (isset($_SESSION['error_login'])) {
          echo '<p class="error">'.$_SESSION['error_login'].'</p>';
          unset($_SESSION['error_login']);
      }
      if (isset($_SESSION['error_register'])) {
          echo '<p class="error">'.$_SESSION['error_register'].'</p>';
          unset($_SESSION['error_register']);
      }
      if (isset($_SESSION['success_register'])) {
          echo '<p class="success">'.$_SESSION['success_register'].'</p>';
          unset($_SESSION['success_register']);
      }
  
      echo '</div>';
  }
  ?>

  <script>
  const loginForm = document.getElementById("login");
  const registerForm = document.getElementById("register");
  const btn = document.getElementById("btn");

  function register() {
    loginForm.style.transform = "translateX(-100%)";
    registerForm.style.transform = "translateX(0%)";
    btn.style.transform = "translateX(100%)";
  }

  function login() {
    loginForm.style.transform = "translateX(0%)";
    registerForm.style.transform = "translateX(100%)";
    btn.style.transform = "translateX(0%)";
  }

  login();

  document.addEventListener("DOMContentLoaded", function () {
    var messageBox = document.getElementById("message-container");
    if (messageBox) {
        messageBox.classList.add("active"); 

        setTimeout(function () {
            messageBox.classList.remove("active");
        }, 5000);
    }
});
</script>

</body>
</html>