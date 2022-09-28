<!DOCTYPE html>
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="styles.css" />
  <link rel="stylesheet" type="text/css" href="styleAdminPage.css" />
  <link rel="stylesheet" type="text/css" href="styleLoginPage.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
  <div class="inline">
    <div>
      <img src="Ressources/nasa_logo.png" alt="logo" width="100" height="100" />
    </div>
    <div id="centerTitle">
      <h1>LOGIN</h1>
    </div>
    <div id="goback">
      <form action="./Exercise1.php">
        <button class="gobackButton" type="submit" value="/AdminPage.php" title="Cancel">
          Cancel
        </button>
      </form>
    </div>
  </div>
  <div class="content">

    <div class="login-container">
      <form name="loginForm"  action="./LoginPage.php" method="POST" >
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" id="username" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>
        <button type="submit" class="gobackButton">Login</button>
      </form>
      <?php

      $db = new mysqli("localhost", "root", "root", "assignment3");
      if ($db->connect_error) {
        die("Could not connect: " . mysqli_connect_error());
      }

      if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $user = $db->query("SELECT * FROM users WHERE username = '$username'");
        if ($user->num_rows > 0) {
          $password = $user->fetch_assoc()['password'];
          if ($password === $_POST['password']) {
            echo "<script>window.location.href = './AdminPage.php';</script>";
          } else {
            echo "<script>alert('The username or password is incorrect !');</script>";
          }
        }
      } else if (isset($_POST['password'])) {
        echo "<script>alert('The username or password is incorrect !');</script>";
      }

      $db->close();
      ?>
      <label id="rememberme">
        <input type="checkbox" name="remember" <?php if (isset($_SESSION["rememberme"]) and $_SESSION["rememberme"] != "") { ?> checked <?php } ?>> Remember me
      </label>
    </div>
  </div>
  </div>
  </div>
</body>

</html>