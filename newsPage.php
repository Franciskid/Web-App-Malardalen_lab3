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

            ?>
        </h1>

        <p>
            <?php 
            
            ?>
        </p>
    </div>
    </div>
</body>

</html>