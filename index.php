<?php
include 'header.php';
include 'connection.php';

$sqlLatest = "SELECT * FROM `post` ORDER BY `date_of_upload` DESC LIMIT 3";
$resultLatest = $conn->query($sqlLatest);

$sqlAll = "SELECT * FROM `post`";
$resultAll = $conn->query($sqlAll);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<section class="hero-section">
    <div class="container text-center">
        <h1>Welcome to CMS Website</h1>
    </div>
</section>
<br><br>
<div class="container-fluid">
    <center><img src="https://img.freepik.com/free-vector/flat-design-cms-concept-with-open-apps_23-2148821227.jpg" class="img-fluid" style="height: 50vh;"></center>
</div>
<br><hr><br>
<center><h2>Recent Posts</h2></center>
<div class="container">
    <div class="row">
        <?php
        while ($row = $resultLatest->fetch_assoc()) {
            echo '<div class="col-md-4">';
            echo '<div class="card" style="width: 18rem;">';
            echo '<img src="Files/' . $row["image_path"] . '" class="card-img-top" alt="' . $row["title"] . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row["title"] . '</h5>';
            echo '<p class="card-text">' . substr($row["text"], 0, 100) . '...</p>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<a href="showpost.php?id=' . $row["id"] . '" class="card-link">Read More</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>
<br><hr><br>
<center><h2>All Articles</h2></center>
<div class="container">
    <div class="row">
        <?php
        while ($row = $resultAll->fetch_assoc()) {
            echo '<div class="col-md-4">';
            echo '<div class="card" style="width: 18rem;">';
            echo '<img src="Files/' . $row["image_path"] . '" class="card-img-top" alt="' . $row["title"] . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row["title"] . '</h5>';
            echo '<p class="card-text">' . substr($row["text"], 0, 100) . '...</p>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<a href="showpost.php?id=' . $row["id"] . '" class="card-link">Read More</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>
<br><hr><br>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
