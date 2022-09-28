
<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'disconnect':
            disconnect();
            break;
        case 'connect':
            if (checkIfUserExist($_POST["user"], $_POST["password"])){
                echo 1;
            }
            else {
                echo 0;
            }
            break;
    }
}


function disconnect()
{
    $_SESSION["rememberme"] = "";
}

function checkIfUserExist(string $username, string $password){
    // $db = new mysqli("localhost", "root", "root", "assignment3");
    //   if ($db->connect_error) {
    //     return False;
    //   }

    //   if (isset($_GET['username'])) {
    //     $user = $db->query("SELECT * FROM users WHERE username = '$username'");
    //     if ($user->num_rows > 0) {
    //       $real_password = $user->fetch_assoc()['$password'];
    //       if ($real_password === $password) {
    //         return True;
    //       } else {
    //         return False;
    //       }
    //     }
    //   } else if (isset($_GET['password'])) {
    //     return False;
    //   }

    //   $db->close();
      return True;
}
?>
