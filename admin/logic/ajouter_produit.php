<?php
$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $caracteristique = $_POST['caracteristique'] ?? '';
    $prix_achat = $_POST['prix_achat'] ?? 0;
    $prix_vente = $_POST['prix_vente'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $image = '';

    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../assets/images/";
        $image = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
            $error = "Désolé, seuls les fichiers JPG, JPEG, PNG, WEBP & GIF sont autorisés.";
        } else {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $error = "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            }
        }
    }

    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO produit (nom, caracteristique, prix_achat, prix_vente, stock, image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $caracteristique, $prix_achat, $prix_vente, $stock, $image]);
            $success = "Produit ajouté avec succès.";
        } catch (PDOException $e) {
            $error = "Erreur : " . $e->getMessage();
        }
    }
}
