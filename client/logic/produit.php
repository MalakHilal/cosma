<?php
$id = $_GET['id'] ?? 0;

if (!$id) {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM produit WHERE id_produit = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch();

if (!$produit) {
    header("Location: index.php");
    exit();
}

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['client'])) {
        header("Location: login.php");
        exit();
    }

    $quantite = (int) $_POST['quantite'];

    if ($quantite > 0 && $quantite <= $produit['stock']) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id_produit'] == $id) {
                if ($item['quantite'] + $quantite <= $produit['stock']) {
                    $item['quantite'] += $quantite;
                    $success = "Quantité mise à jour dans le panier.";
                } else {
                    $error = "Stock insuffisant pour ajouter cette quantité supplémentaire.";
                }
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            $_SESSION['cart'][] = [
                'id_produit' => $id,
                'nom' => $produit['nom'],
                'prix_vente' => $produit['prix_vente'],
                'image' => $produit['image'],
                'quantite' => $quantite,
                'stock' => $produit['stock']
            ];
            $success = "Produit ajouté au panier.";
        }
    } else {
        $error = "Quantité invalide ou stock insuffisant.";
    }
}
