<?php
session_start();
    session_destroy();
    header("Status: 301 Moved Permanently");
    header("Location: ../../index.php");
    exit;
?>