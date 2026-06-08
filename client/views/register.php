<div class="container d-flex justify-content-center align-items-center mb-5 min-vh-75">
    <div class="card p-4 shadow-lg border-0 auth-card">
        <div class="text-center mb-4">
            <h2 class="heading-strong">Créer un compte</h2>
            <p class="text-muted">Rejoignez Ma Rosa store.</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success) ?><br>
                <a href="login.php" class="alert-link">Se connecter</a>
            </div>
        <?php endif; ?>

        <?php if (!$success): ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Nom complet *</label>
                    <input type="text" name="nom" class="form-control form-controls-rounded" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control form-controls-rounded" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe *</label>
                    <input type="password" name="password" class="form-control form-controls-rounded" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Adresse complète</label>
                    <textarea name="adresse" class="form-control form-controls-rounded" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100 btn-pill">S'inscrire</button>
            </form>
        <?php endif; ?>

        <div class="text-center mt-4">
            <p class="text-muted mb-0">Déjà inscrit ?</p>
            <a href="login.php" class="text-accent" style="font-weight:bold; text-decoration:none;">Se connecter</a>
        </div>
    </div>
</div>
