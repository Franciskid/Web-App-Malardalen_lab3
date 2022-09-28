<!DOCTYPE html>
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$_SESSION["rememberme"] = "checked";
?>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="styles.css" />
  <link rel="stylesheet" type="text/css" href="styleAdminPage.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <script>
    function disconnect() {
      var ajaxurl = 'ajax.php';
      var clickBtnValue = $("#disconnect").val();
      data = {
        'action': clickBtnValue
      };
      $.post(ajaxurl, data, function(response) {
        alert("disconnected successfully");
        window.location.href = "./Exercise1.php";
      });
    };
  </script>
</head>

<body>
  <div class="inline">
    <div>
      <img src="Ressources/nasa_logo.png" alt="logo" width="100" height="100" />
    </div>
    <div id="centerTitle">
      <h1>ADMIN PAGE</h1>
    </div>
    <div id="goback">
      <form action="javascript:disconnect()" method="POST" >
        <button class="gobackButton" id="disconnect" type="submit" value="disconnect" title="Disconnect" onclick="disconnect()">
          Disconnect
        </button>
      </form>
    </div>
  </div>
  <div class="content">
    <div class="textFile">
      <h1>
        Choose text file
      </h1>
      <form name="myForm" method="POST" action="javascript:changeUrl()" onsubmit="return validationForm()">
        <input type="text" placeholder="Choose a text file" name="chooseTextFile">
        <input type="submit" value="Apply">
      </form>
    </div>
    <?php
      $db = new mysqli("localhost", "root", "root", "assignment3");
      if ($db->connect_error) {
        die("Could not connect: " . mysqli_connect_error());
      }

      $files = array("Ass2News.json", "Ass2News2nd.json", "Ass2News3rd.json");
      foreach ($files as $file) {
        $path = "Ressources/".$file;
        $json = file_get_contents($path);
        $data = json_decode($json, true);
        foreach ($data['news'] as $key => $value) {
          $title = $value['title'];
          $content = $value['content'];
          $date = $value['date'];
          if (isset($value['imgurl'])) {
            $image = $value['imgurl'];
            $db->query("INSERT IGNORE INTO news (title, date, content, image_path) VALUES ('$title', '$date', '$content', '$image')");
          } else {
            $db->query("INSERT IGNORE INTO news (title, date, content) VALUES ('$title', '$date', '$content')");
          }
        }
      }

      $db->close();
    ?>
    <h3>List of files availables</h3>
    <ul>
      <li>Ass2News.json</li>
      <li>Ass2News2nd.json</li>
      <li>Ass2News3rd.json</li>
    </ul>
  </div>

</body>

</html>
