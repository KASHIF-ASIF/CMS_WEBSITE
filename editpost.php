<?php
include 'header.php';
include 'connection.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $category = $_POST['category'];

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE `post` SET `title` = ?, `text` = ?, `category` = ? WHERE `id` = ?";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssi", $title, $text, $category, $id);
            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error updating post: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }
        $conn->close();
    } else {
        $sql = "SELECT * FROM `post` WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='container mt-5'>";
                echo "<h1>Edit Post</h1>";
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<div class='form-group'>";
                echo "<label for='title'>Title</label>";
                echo "<input type='text' class='form-control' id='title' name='title' value='" . $row['title'] . "' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='text'>Text</label>";
                echo "<textarea class='form-control' id='text' name='text' required>" . $row['text'] . "</textarea>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='category'>Category</label>";
                echo "<input type='text' class='form-control' id='category' name='category' value='" . $row['category'] . "' required>";
                echo "</div>";
                echo "<button type='submit' class='btn btn-primary'>Save</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "Post not found.";
            }
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }
    }
} else {
    echo "Invalid request.";
}
?>
