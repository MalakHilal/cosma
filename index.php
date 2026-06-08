<?php
session_start();
require 'db.php';
require_once 'includes/product_categories.php';

$selected_category = $_GET['categorie'] ?? '';
$active_category = $product_categories[$selected_category] ?? null;
?>
<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 data-aos="fade-up">Minimalist. Elegant. Pure.</h1>
                <p data-aos="fade-up" data-aos-delay="200">Une collection exclusive de soins de la peau et d'essentiels beauté haut de gamme, conçue pour sublimer votre éclat naturel.</p>
                <div data-aos="fade-up" data-aos-delay="400" class="mt-5">
                    <a href="#collection" class="btn btn-primary-custom">Explorer la collection</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Skincare Section -->
<section class="container mb-5" data-aos="fade-up">
    <div class="row align-items-center mb-5 pb-5 border-bottom border-light">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="/cosma/assets/images/store.jpg" alt="Premium Skincare" class="img-fluid" style="border-radius: 4px; box-shadow: var(--soft-shadow);">
        </div>
        <div class="col-md-5 offset-md-1">
            <h2 class="section-title">Ma Rosa Store</h2>
            <p class="section-subtitle mb-4">Découvrez notre univers beauté dédié aux femmes : soins de la peau, produits capillaires, parfums et essentiels du quotidien, soigneusement sélectionnés pour révéler votre élégance naturelle et sublimer chaque instant.</p>
            <a href="#collection" class="btn btn-outline-custom">Découvrir plus</a>
        </div>
    </div>
</section>

<!-- Main Products Collection -->
<section id="collection" class="container mb-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <?php if ($active_category): ?>
            <h2 class="section-title"><?= htmlspecialchars($active_category['label']) ?></h2>
            <p class="section-subtitle"><?= htmlspecialchars($active_category['description']) ?></p>
        <?php else: ?>
            <h2 class="section-title">Les Essentiels du Quotidien</h2>
            <p class="section-subtitle">Élevez votre routine beauté grâce à nos best-sellers.</p>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php
        try {
            $stmt = $pdo->query("SELECT * FROM produit");
            $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($active_category) {
                $produits = array_values(array_filter($produits, function ($produit) use ($selected_category, $product_categories) {
                    return product_matches_category($produit, $selected_category, $product_categories);
                }));
            }

            if (count($produits) > 0) {
                $delay = 0;
                foreach ($produits as $p):
                    $delay += 100;
                ?>
                    <div class="col-md-4 col-sm-6 mb-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                        <div class="card product-card w-100">
                            <div class="card-img-wrapper">
                                <?php
                                $img_src = !empty($p['image']) ? (filter_var($p['image'], FILTER_VALIDATE_URL) ? $p['image'] : 'assets/images/' . htmlspecialchars($p['image'])) : 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&q=80&w=600';
                                ?>
                                <a href="client/produit.php?id=<?= $p['id_produit'] ?>">
                                    <img src="<?= $img_src ?>" alt="<?= htmlspecialchars($p['nom']) ?>">
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($p['nom']) ?></h5>
                                <p class="card-text text-muted small mb-4"><?= htmlspecialchars(substr($p['caracteristique'], 0, 80)) ?>...</p>
                                <div class="mt-auto">
                                    <div class="product-price"><?= number_format($p['prix_vente'], 2, ',', ' ') ?> €</div>
                                    <a href="client/produit.php?id=<?= $p['id_produit'] ?>" class="btn btn-outline-custom w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            } else {
                if ($active_category) {
                    echo '<div class="col-12 text-center"><p class="text-muted">Aucun produit disponible dans cette catégorie.</p><a href="index.php#collection" class="btn btn-outline-custom mt-2">Voir tous les produits</a></div>';
                } else {
                    echo '<div class="col-12 text-center"><p class="text-muted">No products available at the moment.</p></div>';
                }
            }
        } catch(PDOException $e) {
            echo '<div class="col-12 text-center"><div class="alert alert-danger">Database connection error.</div></div>';
        }
        ?>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonial-section text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="zoom-in">
                <i class="fa-solid fa-quote-left mb-4" style="font-size: 2rem; color: var(--border-color);"></i>
                <p class="testimonial-text">"J'avais l'habitude de dépenser la moitié de mon salaire dans d'autres géants de la beauté, mais Ma Rosa m'a complètement conquise. Leur sélection pointue de soins pour la peau est tout simplement incomparable, et j'adore le fait qu'ils mettent en avant des marques de beauté écoresponsables et indépendantes aux côtés des grands classiques. Mon colis est arrivé en seulement deux jours, emballé comme un magnifique cadeau. En plus, les échantillons offerts n'étaient pas de simples sachets choisis au hasard : ils correspondaient parfaitement au profil de ma peau. 10/10, je suis officiellement fidèle !"</p>
                <p class="mt-4 font-playfair" style="font-weight: 600; font-size: 1.1rem;">— Salma Qamar</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6" data-aos="fade-up">
                <h2 class="section-title" style="font-size: 2rem;">Rejoignez le Club</h2>
                <p class="section-subtitle mb-4">Profitez d'offres exclusives, d'accès en avant-première à nos lancements et de conseils pour votre peau.</p>
                <form class="d-flex" onsubmit="event.preventDefault();">
                    <input type="email" class="form-control newsletter-input me-3" placeholder="Enter your email address" required>
                    <button type="submit" class="btn btn-primary-custom" style="padding: 10px 20px;">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
