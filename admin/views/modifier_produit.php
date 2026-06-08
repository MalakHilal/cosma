<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit - Ma Rosa</title>
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
                <li class="nav-item"><a class="nav-link" href="index.php">Produits</a></li>
                <li class="nav-item"><a class="nav-link" href="commandes.php">Commandes</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mb-5">
    <div class="card p-4 shadow-sm border-0 card-rounded-lg">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="heading-highlight"><i class="fa-solid fa-pen-to-square me-2"></i>Modifier un Produit</h3>
            <a href="index.php" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>Retour</a>
        </div>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row gy-3">
                <div class="col-md-6">
                    <label class="form-label">Nom du produit</label>
                    <input type="text" name="nom" class="form-control form-controls-rounded" value="<?= htmlspecialchars($produit['nom']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Image (Laissez vide pour conserver l'actuelle)</label>
                    <input type="file" name="image" class="form-control form-controls-rounded" accept="image/*">
                    <?php if ($produit['image']): ?>
                        <div class="mt-2 text-muted small">Image actuelle: <?= htmlspecialchars($produit['image']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <label class="form-label">Caractéristiques / Description</label>
                    <textarea name="caracteristique" class="form-control form-controls-rounded" rows="4" required><?= htmlspecialchars($produit['caracteristique']) ?></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Prix d'achat (€)</label>
                    <input type="number" step="0.01" name="prix_achat" class="form-control form-controls-rounded" value="<?= htmlspecialchars($produit['prix_achat']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Prix de vente (€)</label>
                    <input type="number" step="0.01" name="prix_vente" class="form-control form-controls-rounded" value="<?= htmlspecialchars($produit['prix_vente']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Quantité en stock</label>
                    <input type="number" name="stock" class="form-control form-controls-rounded" value="<?= htmlspecialchars($produit['stock']) ?>" required>
                </div>
            </div>
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary-custom btn-pill"><i class="fa-solid fa-save me-1"></i> Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
