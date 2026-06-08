<?php
try {
    $sql = "SELECT * FROM produit";
    $stmt = $pdo->query($sql);
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $produits = [];
    $error = 'Erreur : ' . $e->getMessage();
}
