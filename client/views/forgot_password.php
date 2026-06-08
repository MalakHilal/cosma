<div class="container d-flex justify-content-center align-items-center mb-5 min-vh-75">
    <div class="card p-4 shadow-lg border-0 form-card">
        <div class="text-center mb-4">
            <h2 class="heading-strong">Réinitialisation du mot de passe</h2>
            <p class="text-muted">Demandez un code puis définissez un nouveau mot de passe.</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success text-center"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <div class="row gy-4">
            <div class="col-md-6">
                <h5>1) Demander un code</h5>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-controls-rounded" required>
                    </div>
                    <button type="submit" name="request_reset" class="btn btn-outline-primary w-100 btn-pill">Envoyer le code</button>
                </form>
            </div>

            <div class="col-md-6">
                <h5>2) Réinitialiser</h5>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-controls-rounded" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Code</label>
                        <input type="text" name="code" class="form-control form-controls-rounded" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="password" class="form-control form-controls-rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirmer mot de passe</label>
                        <input type="password" name="password_confirm" class="form-control form-controls-rounded" required>
                    </div>
                    <button type="submit" name="perform_reset" class="btn btn-primary-custom w-100 btn-pill">Réinitialiser le mot de passe</button>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="login.php" class="text-accent" style="font-weight:bold; text-decoration:none;">Retour à la connexion</a>
        </div>
    </div>
</div>
