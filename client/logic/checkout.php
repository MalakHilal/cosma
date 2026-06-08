<?php
$client = $_SESSION['client'];
$error = '';
$success_order = false;
$order_details = [];
$total_amount = 0;

foreach ($_SESSION['cart'] as $item) {
    $total_amount += $item['prix_vente'] * $item['quantite'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_order'])) {
    $stock_valid = true;
    foreach ($_SESSION['cart'] as $item) {
        $stmt = $pdo->prepare("SELECT stock FROM produit WHERE id_produit = ?");
        $stmt->execute([$item['id_produit']]);
        $prod_db = $stmt->fetch();
        if (!$prod_db || $prod_db['stock'] < $item['quantite']) {
            $stock_valid = false;
            $error = "Stock insuffisant pour le produit : " . htmlspecialchars($item['nom']) . ". Veuillez ajuster votre panier.";
            break;
        }
    }

    if ($stock_valid) {
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("INSERT INTO commande_client (id_client, montant_total, statut) VALUES (?, ?, 'validée')");
            $stmt->execute([$client['id_client'], $total_amount]);
            $id_commande = $pdo->lastInsertId();

            foreach ($_SESSION['cart'] as $item) {
                $stmt = $pdo->prepare("INSERT INTO details_commande (id_commande, id_produit, quantite, prix_unitaire) VALUES (?, ?, ?, ?)");
                $stmt->execute([$id_commande, $item['id_produit'], $item['quantite'], $item['prix_vente']]);

                $stmt = $pdo->prepare("UPDATE produit SET stock = stock - ? WHERE id_produit = ?");
                $stmt->execute([$item['quantite'], $item['id_produit']]);

                $order_details[] = $item;
            }

            $pdo->commit();
            $success_order = true;
            $id_order_display = $id_commande;
            unset($_SESSION['cart']);
        } catch (PDOException $e) {
            $pdo->rollBack();
            $error = "Erreur lors de la validation de la commande : " . $e->getMessage();
        }
    }
}
