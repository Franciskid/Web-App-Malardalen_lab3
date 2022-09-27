
<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'disconnect':
            disconnect();
            break;
    }
}

function disconnect()
{
    $_SESSION["rememberme"] = "";
}
?>
