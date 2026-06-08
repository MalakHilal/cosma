<?php
session_start();
require '../db.php';
require __DIR__ . '/logic/forgot_password.php';
include '../includes/header.php';
require __DIR__ . '/views/forgot_password.php';
include '../includes/footer.php';
?>
