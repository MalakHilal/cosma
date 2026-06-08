<?php
session_start();
if (!isset($_SESSION['client'])) {
    header("Location: login.php");
    exit();
}
require '../db.php';
require __DIR__ . '/logic/commandes.php';
include '../includes/header.php';
require __DIR__ . '/views/commandes.php';
include '../includes/footer.php';
