<?php
session_start();
require '../db.php';
require __DIR__ . '/logic/produit.php';
include '../includes/header.php';
require __DIR__ . '/views/produit.php';
include '../includes/footer.php';
?>
