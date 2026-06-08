<?php
$error = '';
$success = '';
require_once '../includes/password_reset.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['request_reset'])) {
        $email = trim($_POST['email'] ?? '');
        if (empty($email)) {
            $error = "Veuillez saisir votre email.";
        } else {
            $stmt = $pdo->prepare("SELECT * FROM client WHERE email = ?");
            $stmt->execute([$email]);
            $client = $stmt->fetch();

            if ($client) {
                $reset = createPasswordResetCode($client);
                $success = "Si cet email existe, un code a été envoyé.";
                if (!$reset['sent']) {
                    $success .= " En local, code de test : " . $reset['code'];
                }
            } else {
                $success = "Si cet email existe, un code a été envoyé.";
            }
        }
    }

    if (isset($_POST['perform_reset'])) {
        $email = trim($_POST['email'] ?? '');
        $code = trim($_POST['code'] ?? '');
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        if (empty($email) || empty($code) || empty($password)) {
            $error = "Veuillez remplir tous les champs.";
        } elseif ($password !== $password_confirm) {
            $error = "Les mots de passe ne correspondent pas.";
        } else {
            $sessionCode = $_SESSION['password_reset_code'] ?? null;
            $sessionEmail = $_SESSION['password_reset_email'] ?? null;

            if ($sessionCode && $sessionEmail && $sessionCode === $code && $sessionEmail === $email) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE client SET password = ? WHERE email = ?");
                $stmt->execute([$hash, $email]);

                unset($_SESSION['password_reset_code'], $_SESSION['password_reset_email'], $_SESSION['password_reset_time']);

                $success = "Mot de passe mis à jour. Vous pouvez maintenant vous connecter.";
            } else {
                $error = "Code invalide ou expiré.";
            }
        }
    }
}
