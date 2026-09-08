<?php

session_start();

/*
    Check whether the user is logged in
*/

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();

}


/*
    Check whether the account is approved
*/

if (!isset($_SESSION["user_status"]) ||
    $_SESSION["user_status"] !== "approved") {

    session_unset();
    session_destroy();

    header("Location: login.php?error=pending");
    exit();

}

?>