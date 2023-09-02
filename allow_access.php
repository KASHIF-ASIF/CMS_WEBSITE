<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "UPDATE user SET allow = 'yes' WHERE id = $user_id";
    $result = $conn->query($query);

    if ($result) {
        header('Location: alluser.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
