<?php
session_start();
$_SESSION["newsession"] = 'nothing';
header("Status: 301 Moved Permanently");
header("Location: /");
exit;
