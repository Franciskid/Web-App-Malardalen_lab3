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

    <?php 

$myfile = fopen("Ressources/NewsToDisplayInNewsPage.json", "r") or die("Unable to open file!");
$filesize = filesize("Ressources/NewsToDisplayInNewsPage.json");
if ($filesize > 0) {
  $json = file_get_contents("Ressources/"."NewsToDisplayInNewsPage".".json"); 
}
else {
  $json = file_get_contents("Ressources/Ass2News.json");
}
fclose($myfile);

$data = json_decode($json, true);
    
    ?>
</head>

<body>
    <div class="inline">
        <div>
            <img src="Ressources/nasa_logo.png" alt="logo" width="100" height="100" />
        </div>
        <div id="centerTitle">
            <h1>NEWS</h1>
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
    <div class="textFile">
        <h1>
            <?php 
$title = $data["news"]['title'];
echo $title;
            ?>
        </h1>

        <p>
            <?php 
$title = $data["news"]['content'];
echo $title;
            ?>
        </p>
    </div>
    </div>
</body>

</html>