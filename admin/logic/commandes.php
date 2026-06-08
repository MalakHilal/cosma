<?php
$date_filter = $_GET['date'] ?? '';
$client_filter = $_GET['client'] ?? '';
$produit_filter = $_GET['produit'] ?? '';

$query = "
    SELECT c.id_commande, c.date_commande, c.montant_total, c.statut, cl.nom as client_nom, cl.email
    FROM commande_client c
    JOIN client cl ON c.id_client = cl.id_client
";

$conditions = [];
$params = [];

if ($date_filter) {
    $conditions[] = "DATE(c.date_commande) = ?";
    $params[] = $date_filter;
}
if ($client_filter) {
    $conditions[] = "cl.nom LIKE ?";
    $params[] = "%$client_filter%";
}
if ($produit_filter) {
    $query .= " JOIN details_commande dc ON c.id_commande = dc.id_commande
                JOIN produit p ON dc.id_produit = p.id_produit";
    $conditions[] = "p.nom LIKE ?";
    $params[] = "%$produit_filter%";
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$query .= " ORDER BY c.date_commande DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$commandes = $stmt->fetchAll();
