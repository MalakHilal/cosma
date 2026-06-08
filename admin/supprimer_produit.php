<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
require '../db.php';

$id = $_GET['id'] ?? 0;

if($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM produit WHERE id_produit = ?");
        $stmt->execute([$id]);
    } catch(PDOException $e) {
        // Handle error if needed (like foreign key constraints)
    }
}

header("Location: index.php");
exit();
?>
