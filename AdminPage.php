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
      <form action="./AdminPage.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload News" name="submit">
      </form>
    </div>
    <?php
      $files = array();
      $currentDirectory = getcwd();
      $uploadDirectory = "./Ressources/";
      $errors = [];
      $fileExtensionsAllowed = ['json'];
      if (isset($_FILES['fileToUpload']['name'])) {
        $fileName = $_FILES['fileToUpload']['name'];
        $fileTmpName  = $_FILES['fileToUpload']['tmp_name'];
        $exploded = explode('.',$fileName);
        $fileExtension = strtolower(end($exploded));
    
        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
    
        if (isset($_POST['submit'])) {
    
          if (!in_array($fileExtension,$fileExtensionsAllowed)) {
            $errors[] = "This file extension is not allowed. Please upload a JSON file ";
          }
    
          if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    
            if ($didUpload) {
              echo "The file " . basename($fileName) . " has been uploaded";
              if (!in_array(basename($fileName), $files)) {
                array_push($files, basename($fileName));
              }
            } else {
              echo "An error occurred. Please contact the administrator.";
            }
          } 
        }
      }

      $db = new mysqli("localhost", "root", "root", "assignment3");
      if ($db->connect_error) {
        die("Could not connect: " . mysqli_connect_error());
      }

      foreach ($files as $file) {
        if (isset($file)) {
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
          unlink($path);
        }
      }

      $db->close();
    ?>
  </div>
</body>

</html>
