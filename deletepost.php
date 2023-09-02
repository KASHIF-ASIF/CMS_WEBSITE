<?php
include 'connection.php';

// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the post from the database
    $sql = "DELETE FROM `post` WHERE `id` = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind the 'id' parameter and execute the statement
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Redirect to index.php after successful deletion
            header("Location: index.php");
            exit();
        } else {
            echo "Error deleting post: " . $stmt->error;
        }
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
