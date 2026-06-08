<?php
$error = '';
$success = '';
require_once '../includes/password_reset.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email)) {
        $stmt = $pdo->prepare("SELECT * FROM client WHERE email = ?");
        $stmt->execute([$email]);
        $client = $stmt->fetch();

        if ($client && !empty($password)) {
            if ($password === $client['password'] || password_verify($password, $client['password'])) {
                $_SESSION['client'] = $client;
                header("Location: index.php");
                exit();
            } else {
                $reset = createPasswordResetCode($client);
                $success = "Mot de passe incorrect. Un code a été envoyé à votre adresse email pour changer le mot de passe.";
                if (!$reset['sent']) {
                    $success .= " En local, l'envoi email n'est pas configuré. Code de test : " . $reset['code'];
                }
            }
        } elseif ($client) {
            $reset = createPasswordResetCode($client);
            $success = "Mot de passe non saisi. Un code a été envoyé à votre adresse email pour changer le mot de passe.";
            if (!$reset['sent']) {
                $success .= " En local, l'envoi email n'est pas configuré. Code de test : " . $reset['code'];
            }
        } else {
            $error = "Identifiants incorrects.";
        }
    } else {
        $error = "Veuillez saisir votre email.";
    }
}
