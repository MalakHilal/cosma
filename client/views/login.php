<div class="container d-flex justify-content-center align-items-center mb-5 min-vh-75">
    <div class="card p-4 shadow-lg border-0 auth-card">
        <div class="text-center mb-4">
            <h2 class="heading-strong">Connexion Client</h2>
            <p class="text-muted">Accédez à votre espace beauté.</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success text-center">
                <?= htmlspecialchars($success) ?><br>
                <a href="forgot_password.php" class="alert-link">Changer le mot de passe</a>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control form-controls-rounded" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control form-controls-rounded">
            </div>
            <div class="text-end mb-4">
                <a href="forgot_password.php" class="text-accent" style="text-decoration:none; font-weight:600;">Mot de passe oublié ?</a>
            </div>
            <button type="submit" class="btn btn-primary-custom w-100 btn-pill">Se connecter</button>
        </form>

        <div class="text-center mt-4">
            <p class="text-muted mb-0">Pas encore de compte ?</p>
            <a href="register.php" class="text-accent" style="font-weight:bold; text-decoration:none;">S'inscrire</a>
        </div>
    </div>
</div>
