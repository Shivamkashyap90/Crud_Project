<?php
$login = false;
$showError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('_dbconnection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION['username'] = $username;
                header("location: /CRUD_PROJECT/index.php?login=true");
            } else {
                header("location: /CRUD_PROJECT/index.php?login=false");
            }
        }
    } else {
        header("location: /CRUD_PROJECT/index.php?login=false");
    }
}
