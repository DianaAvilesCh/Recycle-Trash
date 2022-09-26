<?php
session_start();
if ($_SESSION["newsession"] != "nothing" || $_SESSION["newsession"] != null) {
    session_destroy();
    header("Status: 301 Moved Permanently");
    header("Location: ../../index.php");
    exit;
}
?>