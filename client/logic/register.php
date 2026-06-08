<?php
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $adresse = $_POST['adresse'] ?? '';

    if (!empty($nom) && !empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT id_client FROM client WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Cet email est déjà utilisé.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            try {
                $stmt = $pdo->prepare("INSERT INTO client (nom, email, password, adresse) VALUES (?, ?, ?, ?)");
                $stmt->execute([$nom, $email, $hashed_password, $adresse]);
                $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            } catch (PDOException $e) {
                $error = "Erreur lors de l'inscription.";
            }
        }
    } else {
        $error = "Veuillez remplir les champs obligatoires.";
    }
}
