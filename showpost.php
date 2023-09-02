<?php
include 'header.php';
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `post` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<div class="container mt-5">';
            echo '<div class="row">';
            echo '<div class="col-md-6">';
            echo '<img src="Files/' . $row["image_path"] . '" class="img-fluid" alt="' . $row["title"] . '">';
            echo '</div>';
            echo '<div class="col-md-6">';
            echo '<h2>' . $row["title"] . '</h2>';
            echo '<p><strong>Author:</strong> ' . $row["author"] . '</p>';
            echo '<p><strong>Category:</strong> ' . $row["category"] . '</p>';
            echo '<p><strong>Date of Upload:</strong> ' . $row["date_of_upload"] . '</p>';
            echo '<p>' . $row["text"] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } else {
            echo "Post not found.";
        }
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
