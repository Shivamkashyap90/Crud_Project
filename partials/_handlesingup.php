<?php
$showError = "false";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require('_dbconnection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $exitsql = "SELECT * FROM `users` where username = '$username'";
    $result = mysqli_query($conn, $exitsql);
    $numrows = mysqli_num_rows($result);
    if ($numrows > 0) {
        header("Location: /CRUD_PROJECT/index.php?usernameError=true");
        exit();
    } else {
        if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `timestamp`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                if ($showresult) {
                    echo '<div class="alert alert-danger alert-dismissible fade show"     role="alert">
                            <strong>Sorry!</strong> Your password do not match Please try again.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"    aria-label="Close"></button>
                    </div>';
                }
                header("Location: /CRUD_PROJECT/index.php?singupsuccess=true");
                exit();
            }
        }
    }
    header("Location: /CRUD_PROJECT/index.php?singupsuccess=false&error=$showError");
}
