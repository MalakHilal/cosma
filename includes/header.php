<?php
// Determine base URL dynamically or use a fixed path based on relative position
$base_url = '/cosma/';
require_once __DIR__ . '/product_categories.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Rosa - Premium Cosmetics</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/style.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= $base_url ?>index.php">
            <img src="<?= $base_url ?>assets/images/logo.png" alt="Ma Rosa" height="40" class="me-2" style="border-radius:50%; object-fit: cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
            <i class="fa-solid fa-gem me-2" style="display:none;"></i>Ma Rosa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto align-items-lg-center category-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle category-nav-trigger" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catégories
                    </a>
                    <ul class="dropdown-menu category-dropdown" aria-labelledby="categoryDropdown">
                        <li>
                            <a class="dropdown-item category-dropdown-item" href="<?= $base_url ?>index.php#collection">
                                <i class="fa-solid fa-border-all"></i>
                                <span>
                                    <strong>Tous les produits</strong>
                                    <small>Voir toute la collection</small>
                                </span>
                            </a>
                        </li>
                        <?php foreach ($product_categories as $slug => $category): ?>
                            <li>
                                <a class="dropdown-item category-dropdown-item" href="<?= $base_url ?>index.php?categorie=<?= urlencode($slug) ?>#collection">
                                    <i class="fa-solid <?= htmlspecialchars($category['icon']) ?>"></i>
                                    <span>
                                        <strong><?= htmlspecialchars($category['label']) ?></strong>
                                        <small><?= htmlspecialchars($category['description']) ?></small>
                                    </span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>index.php">Accueil</a>
                </li>
                
                <?php if (isset($_SESSION['client'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_url ?>client/index.php">Mes Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_url ?>client/commandes.php">Mes commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_url ?>client/cart.php">
                            <i class="fa-solid fa-cart-shopping"></i> Panier
                            <?php 
                            $cart_count = 0;
                            if (isset($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $item) {
                                    $cart_count += $item['quantite'];
                                }
                            }
                            if ($cart_count > 0): ?>
                                <span class="badge bg-danger rounded-pill"><?= $cart_count ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fa-regular fa-user"></i> <?= htmlspecialchars($_SESSION['client']['nom']) ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= $base_url ?>client/logout.php">Déconnexion</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_url ?>client/login.php">Espace Client</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a class="btn btn-outline-custom btn-sm" href="<?= $base_url ?>admin/login.php">
                            <i class="fa-solid fa-lock me-1"></i> Admin
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
