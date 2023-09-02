<?php
include 'header.php';
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password' AND allow = 'yes'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
      }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['usertype'] = $user['usertype'];

        if ($email === 'admin@admin.com' && $password === 'admin') {
            header('Location: admin_dashboard.php');
            exit();
        } else {
            header('Location: editor_dashboard.php');
            exit();
        }
    } else {
        $error_message = "Invalid email or password or not allowed to login.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
    <style>
      body{
        height: 100vh;
        width: 100vw;
        background-image: url("https://t3.ftcdn.net/jpg/03/55/60/70/360_F_355607062_zYMS8jaz4SfoykpWz5oViRVKL32IabTP.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
      }
    </style>
</head>
<body>
    <br><br>
    <div class="fl" style="display: flex; justify-content: center; align-items: center;">
        <div class="card mb-3" style="">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="https://t4.ftcdn.net/jpg/04/60/71/01/360_F_460710131_YkD6NsivdyYsHupNvO3Y8MPEwxTAhORh.jpg" class="card-img" alt="..." style="height: 100%;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">LOGIN...</h5><hr>
                        <div class="card-text"><b style="color: crimson;">LOGIN</b> to your account</div>
                        <div class="card-body">
                            <form action="" method="post">
                                <input type="email" onkeypress="return RestrictCommaSemicolon(event);" ondrop="return false;" onpaste="return false;" name="email" placeholder="Enter Your Email..." style="width: 100%;"><br><br>
                                <input type="password" onkeypress="return RestrictCommaSemicolon(event);" ondrop="return false;" onpaste="return false;" name="pass" id="myInput" placeholder="Enter Your Password..."style="width: 100%;"><br>
                                <input id="mycheck" type="checkbox" onclick="myFunction()"> <b style="cursor: context-menu;" onclick="checker()">Show Password</b>
                                <br><br>
                                <button type="submit" class="btn btn-primary" style="border-radius: 5%;width: 100%;" name="savebtn">Login</button>
                            </form> 
                        </div>
                        <div class="card-text" style="text-align: center;">
                            <a href="register.php">Create An Account???</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function checker(){
        document.getElementById("mycheck").click();
    }
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
    <script>
    function RestrictCommaSemicolon(e) {
        var theEvent = e || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        var regex = /[^,'";]+$/;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) {
                theEvent.preventDefault();
            }
        }
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<script>
function showAlert(message) {
    alert(message);
}
</script>
<script>
function showAlert(message) {
    alert(message);
}
</script>

<?php
if (isset($error_message)) {
    echo '<script>showAlert("' . $error_message . '");</script>';
}
include 'footer.php';
?>
