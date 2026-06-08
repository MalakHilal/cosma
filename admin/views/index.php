<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Rosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="page-background">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="../assets/images/logo.png" alt="Ma Rosa" class="brand-logo-img me-2">
            <span class="text-dark">Ma Rosa</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fa-solid fa-box me-1"></i> Produits</a></li>
                <li class="nav-item"><a class="nav-link" href="commandes.php"><i class="fa-solid fa-list me-1"></i> Commandes</a></li>
            </ul>
            <span class="navbar-text me-3 text-dark">Bienvenue, <?= htmlspecialchars($_SESSION['admin']) ?></span>
            <a href="logout.php" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-right-from-bracket me-1"></i>Déconnexion</a>
            <a href="../index.php" class="btn btn-outline-custom btn-sm ms-2" target="_blank">Voir le site</a>
        </div>
    </div>
</nav>

<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="heading-highlight"><i class="fa-solid fa-box-open me-2"></i>Liste des Produits</h2>
        <a href="ajouter_produit.php" class="btn btn-primary-custom"><i class="fa-solid fa-plus me-1"></i> Ajouter un Produit</a>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="table-responsive table-custom">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Caractéristique</th>
                    <th>Prix Achat</th>
                    <th>Prix Vente</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($produits) > 0): ?>
                    <?php foreach($produits as $p): ?>
                        <tr class="<?= $p['stock'] == 0 ? 'table-danger' : '' ?>">
                            <td><?= $p['id_produit'] ?></td>
                            <td>
                                <?php $img = !empty($p['image']) ? '../assets/images/' . htmlspecialchars($p['image']) : 'https://via.placeholder.com/60'; ?>
                                <img src="<?= $img ?>" width="60" class="rounded" alt="<?= htmlspecialchars($p['nom']) ?>">
                            </td>
                            <td class="fw-bold"><?= htmlspecialchars($p['nom']) ?></td>
                            <td><small><?= htmlspecialchars(substr($p['caracteristique'], 0, 50)) ?>...</small></td>
                            <td><?= number_format($p['prix_achat'], 2) ?> €</td>
                            <td><?= number_format($p['prix_vente'], 2) ?> €</td>
                            <td>
                                <?php if($p['stock'] > 0): ?>
                                    <span class="badge badge-soft-success rounded-pill px-3 py-2"><?= $p['stock'] ?> en stock</span>
                                <?php else: ?>
                                    <span class="badge badge-soft-danger rounded-pill px-3 py-2">Rupture</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="modifier_produit.php?id=<?= $p['id_produit'] ?>" class="btn btn-sm btn-outline-secondary me-1"><i class="fa-solid fa-pen"></i></a>
                                <a href="supprimer_produit.php?id=<?= $p['id_produit'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Aucun produit trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
