<?php

session_start();

/* Remove all session data */

$_SESSION = array();

/* Destroy session */

session_destroy();

/* Return to login */

header("Location: login.php");

exit();

?>