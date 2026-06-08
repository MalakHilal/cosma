<div class="container mb-5 mt-5">
    <h2 class="heading-highlight mb-4"><i class="fa-solid fa-cart-shopping me-2"></i>Mon Panier</h2>

    <?php if ($reorder_success): ?>
        <div class="alert alert-success rounded-4 shadow-sm" role="alert">
            <i class="fa-solid fa-check-circle me-2"></i>Votre commande précédente a été ajoutée au panier avec succès.
        </div>
    <?php endif; ?>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="card border-0 shadow-sm p-5 text-center card-rounded-lg">
            <i class="fa-solid fa-cart-arrow-down fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Votre panier est vide.</h4>
            <div class="mt-4">
                <a href="index.php" class="btn btn-primary-custom">Découvrir nos produits</a>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm card-rounded-lg">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-head-pink">
                                <tr>
                                    <th class="ps-4">Produit</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Sous-total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart'] as $item): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <?php $img_src = !empty($item['image']) ? '../assets/images/' . htmlspecialchars($item['image']) : 'https://via.placeholder.com/60'; ?>
                                                <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($item['nom']) ?>" class="product-thumbnail rounded me-3" width="60" height="60">
                                                <h6 class="mb-0 fw-bold"><?= htmlspecialchars($item['nom']) ?></h6>
                                            </div>
                                        </td>
                                        <td><?= number_format($item['prix_vente'], 2, ',', ' ') ?> €</td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-3 py-2 fs-6"><?= $item['quantite'] ?></span>
                                        </td>
                                        <td class="fw-bold text-accent"><?= number_format($item['prix_vente'] * $item['quantite'], 2, ',', ' ') ?> €</td>
                                        <td>
                                            <a href="cart.php?remove=<?= $item['id_produit'] ?>" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 card-rounded-lg card-soft-bg">
                    <h4 class="mb-4">Résumé de la commande</h4>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Sous-total</span>
                        <span><?= number_format($total, 2, ',', ' ') ?> €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Livraison</span>
                        <span class="text-success">Gratuite</span>
                    </div>
                    <hr class="border-primary-pink">
                    <div class="d-flex justify-content-between mb-4 fs-4 fw-bold order-summary">
                        <span>Total</span>
                        <span><?= number_format($total, 2, ',', ' ') ?> €</span>
                    </div>
                    <a href="checkout.php" class="btn btn-primary-custom w-100 py-3 fs-5"><i class="fa-solid fa-credit-card me-2"></i> Valider la commande</a>
                    <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">Continuer mes achats</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
