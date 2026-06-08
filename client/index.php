<?php
session_start();
if (!isset($_SESSION['client'])) {
    header("Location: login.php");
    exit();
}
require '../db.php';
require __DIR__ . '/logic/index.php';
include '../includes/header.php';
require __DIR__ . '/views/index.php';
include '../includes/footer.php';
?>
