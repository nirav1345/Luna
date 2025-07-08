<style>
  @import url("https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600;700&display=swap");

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'IBM Plex Mono', monospace;
    scroll-behavior: smooth;
  }

  header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 3px 39px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 99;
    background: rgba(0, 0, 0, 0.5);
  }

  .logo img {
    height: 100px;
    width: auto;
    transition: 0.3s;
  }

  .navigation {
    display: flex;
    align-items: center;
  }

  .navigation a {
    font-size: 1.2em;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    margin-left: 40px;
    position: relative;
  }

  .navigation a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 100%;
    height: 2px;
    background: #fff;
    border-radius: 5px;
    transform-origin: right;
    transform: scaleX(0);
    transition: transform 0.5s;
  }

  .navigation a:hover::after,
  .navigation a.active::after {
    transform-origin: left;
    transform: scaleX(1);
  }

  #menu-checkbox {
    display: none;
  }

  .menu-toggle {
    display: none;
    cursor: pointer;
    font-size: 2em;
    color: #fff;
    z-index: 100; 
  }

  /* MOBILE styles */
  @media (max-width: 768px) {
    .logo img {
      height: 60px;
    }

    .menu-toggle {
      display: block;
    }

    .navigation {
      position: absolute;
      top: 100%;
      right: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      flex-direction: column;
      width: 100%;
      display: none;
    }

    .navigation a {
      margin: 20px 0;
      text-align: center;
    }

    #menu-checkbox:checked ~ .navigation {
      display: flex;
    }
  }
</style>

<?php 
  $current_page = basename($_SERVER['PHP_SELF']); 
?>

<header>
  <div class="logo">
    <a href="login.php">
     <img src="assets.website-files.com/5f21a3db5bf757b4a83cfd6b/5fbd03f28330854200a49d07_BrandScotty_Green.png" alt="BrandScotty Logo">
    </a>
  </div>

  <!-- Hidden checkbox + toggle label -->
  <input type="checkbox" id="menu-checkbox">
  <label for="menu-checkbox" class="menu-toggle">&#9776;</label>
  <nav class="navigation">
    <a href="login.php" class="<?= $current_page == 'login.php' ? 'active' : '' ?>">Login</a>
    <a href="contact.php" class="<?= $current_page == 'contact.php' ? 'active' : '' ?>">Contact Us</a>
    <a href="about.php" class="<?= $current_page == 'about.php' ? 'active' : '' ?>">About Us</a>
    <a href="Team.php" class="<?= $current_page == 'Team.php' ? 'active' : '' ?>">Developers</a>
  </nav>
</header>