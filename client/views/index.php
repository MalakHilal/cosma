<div class="container mb-5 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="heading-highlight">Espace Beauté ✨</h2>
        <form method="GET" action="" class="d-flex align-items-center">
            <input type="text" name="search" class="form-control search-input-rounded me-2" placeholder="Rechercher un produit (ex: Crème, Sérum...)" value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary-custom btn-pill"><i class="fa-solid fa-search"></i></button>
        </form>
    </div>

    <?php if ($search): ?>
        <h5 class="mb-4 text-muted">Résultats pour "<?= htmlspecialchars($search) ?>" : <?= count($produits) ?> trouvé(s)</h5>
    <?php endif; ?>

    <div class="row">
        <?php if (count($produits) > 0): ?>
            <?php foreach ($produits as $p): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                    <div class="card product-card w-100">
                        <div class="card-img-wrapper">
                            <?php $img_src = !empty($p['image']) ? '../assets/images/' . htmlspecialchars($p['image']) : 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=600'; ?>
                            <a href="produit.php?id=<?= $p['id_produit'] ?>">
                                <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($p['nom']) ?>" class="card-img-top">
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($p['nom']) ?></h5>
                            <div class="mt-auto">
                                <div class="product-price"><?= number_format($p['prix_vente'], 2, ',', ' ') ?> €</div>
                                <?php if($p['stock'] > 0): ?>
                                    <span class="badge badge-soft-success mb-2 d-block w-50 mx-auto">En stock</span>
                                <?php else: ?>
                                    <span class="badge badge-soft-danger mb-2 d-block w-50 mx-auto">Rupture</span>
                                <?php endif; ?>
                                <a href="produit.php?id=<?= $p['id_produit'] ?>" class="btn btn-outline-custom w-100"><i class="fa-solid fa-eye me-1"></i> Détails</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Aucun produit trouvé.</h4>
                <?php if ($search): ?>
                    <a href="index.php" class="btn btn-outline-custom mt-2">Voir tous les produits</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
