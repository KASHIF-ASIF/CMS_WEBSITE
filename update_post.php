<?php
include 'header.php';
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $category = $_POST['category']; 

    if ($_FILES['image']['size'] > 0) {
        $target_dir = "Files/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $image_name = uniqid() . '.' . $imageFileType;

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            if ($_FILES["image"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
            } else {
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image_name)) {
                        $sql = "UPDATE `post` SET `title` = '$title', `text` = '$text', `image_path` = '$image_name', `category` = '$category' WHERE `id` = $id";

                        if ($conn->query($sql) === TRUE) {
                            header("Location: index.php");
                            exit();
                        } else {
                            echo "Error updating post: " . $conn->error;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        $sql = "UPDATE `post` SET `title` = '$title', `text` = '$text', `category` = '$category' WHERE `id` = $id";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error updating post: " . $conn->error;
        }
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
