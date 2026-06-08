<?php
$success = '';
$error = '';
$id = $_GET['id'] ?? 0;

if (!$id) {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM produit WHERE id_produit = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch();

if (!$produit) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $caracteristique = $_POST['caracteristique'] ?? '';
    $prix_achat = $_POST['prix_achat'] ?? 0;
    $prix_vente = $_POST['prix_vente'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $image = $produit['image'];

    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../assets/images/";
        $new_image = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $new_image;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
            $error = "Désolé, seuls les fichiers JPG, JPEG, PNG, WEBP & GIF sont autorisés.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $new_image;
            } else {
                $error = "Erreur lors du téléchargement de l'image.";
            }
        }
    }

    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("UPDATE produit SET nom=?, caracteristique=?, prix_achat=?, prix_vente=?, stock=?, image=? WHERE id_produit=?");
            $stmt->execute([$nom, $caracteristique, $prix_achat, $prix_vente, $stock, $image, $id]);
            $success = "Produit modifié avec succès.";
            $stmt = $pdo->prepare("SELECT * FROM produit WHERE id_produit = ?");
            $stmt->execute([$id]);
            $produit = $stmt->fetch();
        } catch (PDOException $e) {
            $error = "Erreur : " . $e->getMessage();
        }
    }
}
