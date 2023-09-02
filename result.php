<?php
ob_start(); 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "connection.php";
include "header.php";

$category = $_GET['category'] ?? '';
$keyword = $_GET['keyword'] ?? '';

$query = "SELECT * FROM post WHERE 1";

if (!empty($category)) {
    $query .= " AND category = '$category'";
}

if (!empty($keyword)) {
    $query .= " AND (title LIKE '%$keyword%' OR text LIKE '%$keyword%')";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">

</head>
<body>
    

    <div class="container mt-5">
        <h1>Search Results</h1>
        <div class="row">
            <?php
            while ($row = $result->fetch_assoc()) {
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

