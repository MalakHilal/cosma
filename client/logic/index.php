<?php
$search = $_GET['search'] ?? '';

try {
    if ($search) {
        $stmt = $pdo->prepare("SELECT * FROM produit WHERE nom LIKE ? OR caracteristique LIKE ?");
        $stmt->execute(["%$search%", "%$search%"]);
    } else {
        $stmt = $pdo->query("SELECT * FROM produit");
    }
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $produits = [];
}
