<?php

session_start();
echo "Logging you out.Please wait...";

// session_unset();
session_destroy();
header("location: /REC FORUM");
// exit;
// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
// {
//     header("location: login.php");
//     exit;
// }
// else
// {

// }

?>