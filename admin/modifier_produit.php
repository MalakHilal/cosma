<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
require '../db.php';
require __DIR__ . '/logic/modifier_produit.php';
require __DIR__ . '/views/modifier_produit.php';
?>
