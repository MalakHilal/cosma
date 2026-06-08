<div class="container mb-5 mt-5">
    <div class="row gx-4">
        <div class="col-md-5 mb-4">
            <div class="card border-0 shadow-sm card-rounded-lg overflow-hidden">
                <?php $img_src = !empty($produit['image']) ? '../assets/images/' . htmlspecialchars($produit['image']) : 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=600'; ?>
                <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($produit['nom']) ?>" class="product-image-large">
            </div>
        </div>

        <div class="col-md-7">
            <h2 class="heading-strong"><?= htmlspecialchars($produit['nom']) ?></h2>
            <div class="fs-3 fw-bold mb-3 text-accent"><?= number_format($produit['prix_vente'], 2, ',', ' ') ?> €</div>

            <p class="text-muted mb-4"><?= nl2br(htmlspecialchars($produit['caracteristique'])) ?></p>
            <hr>

            <?php if ($success): ?>
                <div class="alert alert-success"><i class="fa-solid fa-check-circle me-2"></i><?= htmlspecialchars($success) ?> <a href="cart.php" class="alert-link ms-2">Voir le panier</a></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if ($produit['stock'] > 0): ?>
                <p class="mb-3 text-success"><i class="fa-solid fa-check me-1"></i> En stock (<?= $produit['stock'] ?> disponibles)</p>
                <form method="POST" action="" class="d-flex align-items-center gap-3">
                    <label class="fw-bold mb-0">Quantité :</label>
                    <input type="number" name="quantite" value="1" min="1" max="<?= $produit['stock'] ?>" class="form-control form-controls-rounded" style="width: 100px;">
                    <button type="submit" name="add_to_cart" class="btn btn-primary-custom btn-pill px-4"><i class="fa-solid fa-cart-plus me-2"></i> Ajouter au panier</button>
                </form>
            <?php else: ?>
                <div class="alert alert-warning">Ce produit n'est malheureusement plus disponible pour le moment.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
