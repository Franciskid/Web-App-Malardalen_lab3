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
    <form name="loginForm" action="javascript:changeURL()" onsubmit="return validationLoginForm()">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <button type="submit" class="gobackButton">Login</button>
    </form>
    <?php
      $db = new mysqli("localhost", "root", "root", "assignment3");
      if ($db->connect_error) {
        die("Could not connect: " . mysqli_connect_error());
      }

      $users = $db->query("SELECT * FROM users");
      while($row = $users->fetch_assoc()) {
        echo $row["username"];
        echo '<br>';
      }
    
    $db->close();
    ?>
    <script>
      function validationLoginForm() {
        var x = document.forms["loginForm"]["username"].value;
        var y = document.forms["loginForm"]["password"].value;
        if (x == "" || y == "") {
          alert("Username or password is incorrect !");
          return false;
        }
      }

      function changeURL() {
        var x = document.forms["loginForm"]["username"].value;
        var y = document.forms["loginForm"]["password"].value;
        console.log(x.length);
        console.log(y.length);
        if (x.length !== 0 && y.length != 0) {
          window.location.href = "./AdminPage.php";
        }
      }
    </script>
    <label id="rememberme">
      <input type="checkbox" name="remember" <?php if (isset($_SESSION["rememberme"]) and $_SESSION["rememberme"] != "") { ?> checked <?php } ?>> Remember me
    </label>
  </div>
  </div>
  </div>
</body>

</html>