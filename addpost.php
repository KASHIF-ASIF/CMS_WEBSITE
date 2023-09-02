<?php
include 'header.php';
include 'connection.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit(); 
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $author = $_SESSION['username'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $category = $_POST['category']; 
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
                    $date_of_upload = date("Y-m-d H:i:s"); 
                    $sql = "INSERT INTO `post` (author, title, text, image_path, date_of_upload, category) 
                            VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    if ($stmt) {
                        $stmt->bind_param("ssssss", $author, $title, $text, $image_name, $date_of_upload, $category);
                        if ($stmt->execute()) {
                            echo "Post added successfully.";
                            header("Location: addpost.php");
                            exit();
                        } else {
                            echo "Error adding post: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        echo "Error preparing the statement: " . $conn->error;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    } else {
        echo "File is not an image.";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Post</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="text">Text</label>
                <textarea class="form-control" id="text" name="text" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Feature Image</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
