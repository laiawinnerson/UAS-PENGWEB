<?php
    session_start();
    session_unset();
    session_destroy();

    $cookie_name = "cookie_username";
    $cookie_value = "";
    $time = time() - (60 * 60);
    setcookie($cookie_name,$cookie_value,$time,"/");

    header("Location:index.php");
?>