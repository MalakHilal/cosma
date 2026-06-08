<?php
$client = $_SESSION['client'];
$error = '';

if (isset($_GET['reorder'])) {
    $order_id = (int)$_GET['reorder'];
    $stmt = $pdo->prepare(
        "SELECT dc.id_produit, dc.quantite, dc.prix_unitaire, p.nom, p.image
         FROM details_commande dc
         JOIN produit p ON dc.id_produit = p.id_produit
         WHERE dc.id_commande = ?
           AND EXISTS (
               SELECT 1 FROM commande_client c
               WHERE c.id_commande = ?
                 AND c.id_client = ?
                 AND c.statut = 'validée'
           )"
    );
    $stmt->execute([$order_id, $order_id, $client['id_client']]);
    $items = $stmt->fetchAll();

    if ($items) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        foreach ($items as $item) {
            $found = false;
            foreach ($_SESSION['cart'] as &$cart_item) {
                if ($cart_item['id_produit'] === $item['id_produit']) {
                    $cart_item['quantite'] += $item['quantite'];
                    $found = true;
                    break;
                }
            }
            unset($cart_item);

            if (!$found) {
                $_SESSION['cart'][] = [
                    'id_produit' => $item['id_produit'],
                    'nom' => $item['nom'],
                    'image' => $item['image'],
                    'prix_vente' => $item['prix_unitaire'],
                    'quantite' => $item['quantite'],
                ];
            }
        }

        header('Location: cart.php?reorder_success=1');
        exit();
    }

    $error = "Commande introuvable ou inaccessible.";
}

$stmt = $pdo->prepare(
    "SELECT c.id_commande, c.date_commande, c.montant_total, c.statut,
            dc.id_produit, dc.quantite, dc.prix_unitaire, p.nom AS produit_nom, p.image
     FROM commande_client c
     JOIN details_commande dc ON c.id_commande = dc.id_commande
     JOIN produit p ON dc.id_produit = p.id_produit
     WHERE c.id_client = ?
       AND c.statut = 'validée'
     ORDER BY c.date_commande DESC"
);
$stmt->execute([$client['id_client']]);
$rows = $stmt->fetchAll();

$orders = [];
foreach ($rows as $row) {
    $order_id = $row['id_commande'];
    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            'id_commande' => $row['id_commande'],
            'date_commande' => $row['date_commande'],
            'montant_total' => $row['montant_total'],
            'statut' => $row['statut'],
            'total_quantite' => 0,
            'produits' => [],
            'images' => [],
        ];
    }

    $orders[$order_id]['produits'][] = [
        'nom' => $row['produit_nom'],
        'quantite' => $row['quantite'],
        'prix_unitaire' => $row['prix_unitaire'],
        'image' => $row['image'],
    ];
    $orders[$order_id]['total_quantite'] += $row['quantite'];

    if (count($orders[$order_id]['images']) < 3) {
        $orders[$order_id]['images'][] = $row['image'];
    }
}

$orders = array_values($orders);
