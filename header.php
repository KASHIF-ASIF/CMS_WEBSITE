<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "connection.php";
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #f5f5f5">
        <div class="container-fluid">
            <a class="navbar-brand">CMS BY M.KASHIF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                        <?php
                            $categoryQuery = "SELECT DISTINCT category FROM post";
                            $categoryResult = $conn->query($categoryQuery);

                            if ($categoryResult->num_rows > 0) {
                                while ($row = $categoryResult->fetch_assoc()) {
                                    echo '<a class="dropdown-item" href="result.php?category=' . $row['category'] . '">' . $row['category'] . '</a>';
                                }
                            }
                        ?>
                    </div>
                </li>
                    <?php
                    if (isset($_SESSION['email'])) {
                        if ($_SESSION['email'] === 'admin@admin.com') {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="admin_dashboard.php">Admin Dashboard</a>';
                            echo '</li>';
                        } else {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="editor_dashboard.php">Editor Dashboard</a>';
                            echo '</li>';
                        }
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="logout.php">Logout</a>';
                        echo '</li>';
                    } else {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link active" aria-current="page" href="login.php">Login</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
                <form class="form-inline ml-auto" action="result.php" method="get">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
               
            </div>
        </div>
    </nav>

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
<?php
include 'footer.php';
?>
