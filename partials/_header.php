<?php
session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dard bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/CRUD_PROJECT"><img src="/CRUD_PROJECT/crudoperation.png" width="110px" alt=""></a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>';
if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
    echo '
          <p class="fw-bold text-primary my-2 mx-2">Welcome ' . $_SESSION['username'] . '</p>
          <a href="partials/_logout.php" class="btn btn-outline-success mx-2">Logout</a>';
} else {
    echo ' <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button class="btn btn-outline-success ml-2 " data-bs-toggle="modal" data-bs-target="#singupModal">SingUp</button>';
}

echo '
        </div>
    </div>
</nav>
';
