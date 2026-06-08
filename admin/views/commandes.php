<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Commandes - Ma Rosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="page-background">

<nav class="navbar navbar-expand-lg sticky-top admin-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="../assets/images/logo.png" alt="Ma Rosa" class="brand-logo-img me-2" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
            <span class="brand-text">
                <span class="brand-name">Ma Rosa</span>
                <span class="brand-tagline">Administration</span>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa-solid fa-box me-1"></i> Produits</a></li>
                <li class="nav-item"><a class="nav-link active" href="commandes.php"><i class="fa-solid fa-list me-1"></i> Commandes</a></li>
            </ul>
            <a href="logout.php" class="btn btn-outline-light btn-sm"><i class="fa-solid fa-right-from-bracket me-1"></i>Déconnexion</a>
            <a href="../index.php" class="btn btn-outline-custom btn-sm ms-lg-2 mt-2 mt-lg-0" target="_blank">Voir le site</a>
        </div>
    </div>
</nav>

<div class="container mb-5">

    <div class="card filter-card p-4 border-0 mb-4">
        
        <h3 class="filter-title">
            <i class="fa-solid fa-filter me-2"></i>Filtrer les Commandes
        </h3>

        <form method="GET" action="" class="row g-3 align-items-end mt-2">

            <div class="col-md-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($date_filter) ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">Nom du Client</label>
                <input type="text" name="client" class="form-control" placeholder="Rechercher un client..." value="<?= htmlspecialchars($client_filter) ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">Produit</label>
                <input type="text" name="produit" class="form-control" placeholder="Rechercher par produit..." value="<?= htmlspecialchars($produit_filter) ?>">
            </div>

            <div class="col-md-1">
                <button type="submit" class="btn btn-primary-custom w-100">
                    <i class="fa-solid fa-search"></i>
                </button>
            </div>

        </form>
    </div>

    <div class="table-responsive table-custom">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID Commande</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Montant Total</th>
                    <th>Statut</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($commandes) > 0): ?>
                    <?php foreach($commandes as $c): ?>
                    <tr>
                        <td><strong>#<?= $c['id_commande'] ?></strong></td>
                        <td><?= date('d/m/Y H:i', strtotime($c['date_commande'])) ?></td>
                        <td><?= htmlspecialchars($c['client_nom']) ?></td>
                        <td><?= htmlspecialchars($c['email']) ?></td>
                        <td class="fw-bold text-primary"><?= number_format($c['montant_total'], 2) ?> €</td>
                        <td>
                            <?php if($c['statut'] == 'en_attente'): ?>
                                <span class="badge bg-warning text-dark">En attente</span>
                            <?php else: ?>
                                <span class="badge bg-success">Validée</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalCommande<?= $c['id_commande'] ?>">
                                <i class="fa-solid fa-eye"></i> Voir
                            </button>

                            <div class="modal fade" id="modalCommande<?= $c['id_commande'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Détails Commande #<?= $c['id_commande'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group list-group-flush">
                                                <?php
                                                $stmt_det = $pdo->prepare("SELECT dc.*, p.nom, p.image FROM details_commande dc JOIN produit p ON dc.id_produit = p.id_produit WHERE dc.id_commande = ?");
                                                $stmt_det->execute([$c['id_commande']]);
                                                $details = $stmt_det->fetchAll();
                                                foreach($details as $d):
                                                    $img_src = !empty($d['image']) ? '../assets/images/' . htmlspecialchars($d['image']) : 'https://via.placeholder.com/60';
                                                ?>
                                                <li class="list-group-item d-flex align-items-center justify-content-between gap-3 order-detail-item">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($d['nom']) ?>" class="order-detail-img">
                                                        <div>
                                                            <div class="fw-semibold mb-1"><?= htmlspecialchars($d['nom']) ?></div>
                                                            <div class="text-muted small">Quantité : x<?= $d['quantite'] ?></div>
                                                        </div>
                                                    </div>
                                                    <span class="fw-bold"><?= number_format($d['prix_unitaire'] * $d['quantite'], 2) ?> €</span>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <div class="text-end mt-3 fw-bold">
                                                Total : <?= number_format($c['montant_total'], 2) ?> €
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Aucune commande trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
