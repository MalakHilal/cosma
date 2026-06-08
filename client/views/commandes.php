<div class="container mb-5 mt-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="heading-highlight">Mes commandes</h2>
            <p class="text-muted mb-0">Consultez l’historique de vos commandes validées et recommandez-les en un clic.</p>
        </div>
        <a href="index.php" class="btn btn-outline-secondary btn-sm align-self-md-center">Continuer mes achats</a>
    </div>

    <?php if ($error): ?>
        <div class="alert alert-danger rounded-4 shadow-sm" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <div class="card border-0 shadow-sm p-5 text-center card-rounded-lg">
            <i class="fa-solid fa-clock-rotate-left fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Vous n’avez pas encore de commandes validées.</h4>
            <p class="mb-4">Passez votre première commande pour la retrouver ici.</p>
            <a href="index.php" class="btn btn-primary-custom">Découvrir nos produits</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($orders as $order): ?>
                <?php $image_src = !empty($order['images'][0]) ? '../assets/images/' . htmlspecialchars($order['images'][0]) : 'https://via.placeholder.com/120'; ?>
                <div class="col-12">
                    <div class="card border-0 shadow-sm p-4 card-rounded-lg">
                        <div class="row align-items-center gy-3">
                            <div class="col-md-2 text-center">
                                <img src="<?= $image_src ?>" alt="Commande #<?= $order['id_commande'] ?>" class="order-thumbnail rounded">
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-1">Commande #<?= $order['id_commande'] ?></h5>
                                <p class="mb-1 text-muted">Le <?= date('d/m/Y H:i', strtotime($order['date_commande'])) ?></p>
                                <p class="mb-1">
                                    <span class="badge bg-success me-2"><?= htmlspecialchars($order['statut']) ?></span>
                                    <span class="text-muted">Total quantités : <?= $order['total_quantite'] ?></span>
                                </p>
                                <p class="mb-0 text-muted">Produits : <?= count($order['produits']) ?> articles</p>
                                <?php if (!empty($order['images'])): ?>
                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                        <?php foreach ($order['images'] as $thumb): ?>
                                            <?php $thumb_src = !empty($thumb) ? '../assets/images/' . htmlspecialchars($thumb) : 'https://via.placeholder.com/60'; ?>
                                            <img src="<?= $thumb_src ?>" alt="Produit" class="product-thumb-small rounded">
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="fs-4 fw-bold text-primary mb-2"><?= number_format($order['montant_total'], 2, ',', ' ') ?> €</div>
                                <a href="commandes.php?reorder=<?= $order['id_commande'] ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fa-solid fa-cart-plus me-2"></i>Recommander
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
