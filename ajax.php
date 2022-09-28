
<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'disconnect':
            disconnect();
            break;
            
        case 'search':
            search($_POST['search']);
            break;
    }
}

function disconnect()
{
    $_SESSION["rememberme"] = "";
}

function search(string $val) {
    
}
?>
