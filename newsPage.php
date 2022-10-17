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
        $id = $_GET['id'];
        $db = new mysqli("localhost", "root", "root", "assignment3");
        if ($db->connect_error) {
        die("Could not connect: " . mysqli_connect_error());
        }
    
        $result = $db->query("SELECT * FROM `news` WHERE `id`=$id;");

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $title = $row['title'];
                $content = $row['content'];
            }    
        }
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
            echo $title;
            ?>
        </h1>

        <p>
            <?php 
            echo $content;
            ?>
        </p>
    </div>
    </div>
</body>

</html>