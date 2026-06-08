<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
require '../db.php';
require __DIR__ . '/logic/commandes.php';
require __DIR__ . '/views/commandes.php';
