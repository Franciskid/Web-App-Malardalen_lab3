
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
    $db = new mysqli("localhost", "root", "root", "assignment3");
      if ($db->connect_error) {
        die("Could not connect: " . mysqli_connect_error());
      }
    
    $sql = "SELECT * FROM `news` WHERE `title` LIKE '%.$val%'";

    $result = $db->query($sql);

    $array_to_return = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $array_to_return = $row;
        }

        return $array_to_return;
    } else {
        return False;
    }

}
?>
