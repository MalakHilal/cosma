<?php
session_start();
require '../db.php';
require __DIR__ . '/logic/register.php';
include '../includes/header.php';
require __DIR__ . '/views/register.php';
include '../includes/footer.php';
?>
