<div class="container mb-5 mt-5">
    <?php if ($success_order): ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg p-5 text-center card-rounded-lg card-accent-border-top">
                    <i class="fa-solid fa-circle-check fa-4x text-success mb-4"></i>
                    <h2 class="heading-strong">Merci pour votre commande, <?= htmlspecialchars($client['nom']) ?> !</h2>
                    <p class="fs-5 text-muted">Votre commande n°<strong><?= $id_order_display ?></strong> a été validée avec succès.</p>
                    <hr class="my-4">
                    <h4 class="text-start mb-3">Détails de la facture</h4>
                    <div class="table-responsive">
                        <table class="table text-start">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th class="text-end">Prix Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order_details as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['nom']) ?></td>
                                        <td>x<?= $item['quantite'] ?></td>
                                        <td class="text-end"><?= number_format($item['prix_vente'] * $item['quantite'], 2, ',', ' ') ?> €</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-end fs-5">Montant Total Facturé :</th>
                                    <th class="text-end fs-4 text-accent"><?= number_format($total_amount, 2, ',', ' ') ?> €</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="mt-4 d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <a href="index.php" class="btn btn-primary-custom"><i class="fa-solid fa-arrow-left me-2"></i>Retour à l'accueil</a>
                        <a href="commandes.php" class="btn btn-outline-secondary"><i class="fa-solid fa-box-open me-2"></i>Voir mon historique</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <h2 class="heading-highlight mb-4"><i class="fa-solid fa-clipboard-check me-2"></i>Validation de commande</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger p-4 shadow-sm alert-card">
                <h4><i class="fa-solid fa-triangle-exclamation me-2"></i>Attention</h4>
                <p class="mb-0"><?= htmlspecialchars($error) ?></p>
                <a href="cart.php" class="btn btn-sm btn-outline-danger mt-3">Retour au panier</a>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card border-0 shadow-sm p-4 card-rounded-lg">
                        <h4 class="mb-3">Informations de livraison</h4>
                        <p><strong>Nom :</strong> <?= htmlspecialchars($client['nom']) ?></p>
                        <p><strong>Email :</strong> <?= htmlspecialchars($client['email']) ?></p>
                        <p><strong>Adresse :</strong> <?= nl2br(htmlspecialchars($client['adresse'])) ?></p>
                        <hr>
                        <h4 class="mb-3 mt-4">Paiement</h4>
                        <div class="alert alert-info">
                            Le paiement se fera à la livraison (Cash on Delivery).
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4 card-rounded-lg card-soft-bg">
                        <h4 class="mb-4">Total à payer</h4>
                        <div class="d-flex justify-content-between mb-4 fs-3 fw-bold order-summary">
                            <span>Total</span>
                            <span><?= number_format($total_amount, 2, ',', ' ') ?> €</span>
                        </div>
                        <form method="POST" action="">
                            <button type="submit" name="confirm_order" class="btn btn-primary-custom w-100 py-3 fs-5"><i class="fa-solid fa-check-double me-2"></i> Confirmer l'achat</button>
                        </form>
                        <a href="cart.php" class="btn btn-outline-secondary w-100 mt-2">Retour au panier</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
