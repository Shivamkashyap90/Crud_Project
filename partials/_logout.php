<?php
session_start();
echo "Loging out please wait.";
session_unset();
session_destroy();
header("location: /CRUD_PROJECT/index.php?logout=true");
