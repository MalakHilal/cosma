<?php
session_start();
require '../db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM administrateur WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin) {
            if ($password === $admin['password'] || password_verify($password, $admin['password'])) {
                $_SESSION['admin'] = $admin['username'];
                $_SESSION['id_admin'] = $admin['id_admin'];
                header("Location: index.php");
                exit();
            } else {
                $error = "ACCESS NOT AUTHORIZED - Identifiants incorrects.";
            }
        } else {
            $error = "ACCESS NOT AUTHORIZED - Identifiants incorrects.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma Rosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh; background: var(--bg-color);">

<div class="card p-4 shadow-lg border-0" style="width: 100%; max-width: 400px; border-radius: 20px;">
    <div class="text-center mb-4">
        <h2 style="color: var(--accent-pink); font-weight: bold;">Espace Administrateur</h2>
        <p class="text-muted">Connectez-vous pour gérer le site.</p>
    </div>

    <?php if($error): ?>
        <div class="alert alert-danger text-center">
            <strong>ACCESS NOT AUTHORIZED</strong><br><?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Nom d'utilisateur</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary-custom w-100">Se connecter</button>
    </form>
    <div class="text-center mt-3">
        <a href="../index.php" class="text-muted text-decoration-none">< Retour au site</a>
    </div>
</div>

</body>
</html>
