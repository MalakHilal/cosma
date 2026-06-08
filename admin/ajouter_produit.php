<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
require '../db.php';
require __DIR__ . '/logic/ajouter_produit.php';
require __DIR__ . '/views/ajouter_produit.php';
?>
