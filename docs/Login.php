<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="Login.css" />
  <title>Login</title>
  <link rel="icon" href="Images/favi.svg" type="image/png" />
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

  <button type="button" class="google-btn" onclick="window.location.href='google_login.php'">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50" class="google-icon">
      <path d="M 25.996094 48 C 13.3125 48 2.992188 37.683594 2.992188 25 C 2.992188 12.316406 13.3125 2 25.996094 2 C 31.742188 2 37.242188 4.128906 41.488281 7.996094 L 42.261719 8.703125 L 34.675781 16.289063 L 33.972656 15.6875 C 31.746094 13.78125 28.914063 12.730469 25.996094 12.730469 C 19.230469 12.730469 13.722656 18.234375 13.722656 25 C 13.722656 31.765625 19.230469 37.269531 25.996094 37.269531 C 30.875 37.269531 34.730469 34.777344 36.546875 30.53125 L 24.996094 30.53125 L 24.996094 20.175781 L 47.546875 20.207031 L 47.714844 21 C 48.890625 26.582031 47.949219 34.792969 43.183594 40.667969 C 39.238281 45.53125 33.457031 48 25.996094 48 Z"></path>
    </svg>
    Continue with Google
  </button>
</form>

    <form id="register" class="input-group" action="auth.php" method="POST">
      <input type="text" class="input-field" name="name" placeholder="Name" required />
      <input type="email" class="input-field" name="email" placeholder="Email" required />
      <input type="password" class="input-field" name="password" placeholder="Enter Password" required />
      <input type="checkbox" class="check-box" required /><span>I agree to the terms & conditions</span>
      <button type="submit" name="register" class="submit-btn">Register</button>
        <button type="button" class="google-btn" onclick="window.location.href='google_login.php'">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50" class="google-icon">
      <path d="M 25.996094 48 C 13.3125 48 2.992188 37.683594 2.992188 25 C 2.992188 12.316406 13.3125 2 25.996094 2 C 31.742188 2 37.242188 4.128906 41.488281 7.996094 L 42.261719 8.703125 L 34.675781 16.289063 L 33.972656 15.6875 C 31.746094 13.78125 28.914063 12.730469 25.996094 12.730469 C 19.230469 12.730469 13.722656 18.234375 13.722656 25 C 13.722656 31.765625 19.230469 37.269531 25.996094 37.269531 C 30.875 37.269531 34.730469 34.777344 36.546875 30.53125 L 24.996094 30.53125 L 24.996094 20.175781 L 47.546875 20.207031 L 47.714844 21 C 48.890625 26.582031 47.949219 34.792969 43.183594 40.667969 C 39.238281 45.53125 33.457031 48 25.996094 48 Z"></path>
    </svg>
    Sign with Google
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