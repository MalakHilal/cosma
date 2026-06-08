<?php
session_start();
require '../db.php';
require __DIR__ . '/logic/login.php';
include '../includes/header.php';
require __DIR__ . '/views/login.php';
include '../includes/footer.php';
?>
