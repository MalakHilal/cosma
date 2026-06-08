<?php

$product_categories = [
    'parfums' => [
        'label' => 'Parfums',
        'icon' => 'fa-spray-can-sparkles',
        'description' => 'Eaux de parfum, brumes et coffrets parfumés',
        'keywords' => [
            'parfum', 'eau de parfum', 'brume', 'parfumée', 'parfumées',
            'vanilla', 'vanille', 'kayali', 'gaultier', 'libre',
            'florabloom', 'vie est belle', 'aqua allegoria', 'yves saint laurent'
        ],
    ],
    'maquillage' => [
        'label' => 'Maquillage',
        'icon' => 'fa-wand-magic-sparkles',
        'description' => 'Teint, blush, mascara et essentiels makeup',
        'keywords' => [
            'maquillage', 'blush', 'poudre', 'terracotta', 'mascara',
            'benefit', 'cosmetics', 'badgal'
        ],
    ],
    'soins-visage' => [
        'label' => 'Soins visage',
        'icon' => 'fa-face-smile',
        'description' => 'Masques, routines, sérums et soins anti-âge',
        'keywords' => [
            'visage', 'masque', 'mask', 'peau', 'pores', 'taches brunes',
            'anti-âge', 'anti-age', 'beauty of joseon', 'nooance', 'led'
        ],
    ],
    'corps-bain' => [
        'label' => 'Corps & Bain',
        'icon' => 'fa-bath',
        'description' => 'Soins corps, bain et coffrets rituels',
        'keywords' => [
            'corps & bain', 'bain & corps', 'ritual', 'rituals', 'yozakura',
            'sakura'
        ],
    ],
    'cheveux' => [
        'label' => 'Cheveux',
        'icon' => 'fa-scissors',
        'description' => 'Soins capillaires, lisseurs et routines cheveux',
        'keywords' => [
            'cheveux', 'cheveu', 'hair', 'capillaire', 'lisseur', 'boucleur',
            'airwrap', 'steampod', 'kérastase', 'kerastase', 'blond absolu',
            'shampooing', 'anti-chute', 'loly', 'crépus'
        ],
    ],
    'autres' => [
        'label' => 'Autres',
        'icon' => 'fa-star',
        'description' => 'Tous les produits hors catégories principales',
        'keywords' => [],
    ],
];

function normalize_product_text(string $text): string
{
    return function_exists('mb_strtolower') ? mb_strtolower($text, 'UTF-8') : strtolower($text);
}

function product_matches_keywords(array $product, array $keywords): bool
{
    if (empty($keywords)) {
        return false;
    }

    $text = normalize_product_text(($product['nom'] ?? '') . ' ' . ($product['caracteristique'] ?? ''));

    foreach ($keywords as $keyword) {
        if (str_contains($text, normalize_product_text($keyword))) {
            return true;
        }
    }

    return false;
}

function product_matches_category(array $product, string $category_slug, array $categories): bool
{
    if ($category_slug === 'autres') {
        foreach ($categories as $slug => $category) {
            if ($slug !== 'autres' && product_matches_keywords($product, $category['keywords'])) {
                return false;
            }
        }

        return true;
    }

    return isset($categories[$category_slug])
        && product_matches_keywords($product, $categories[$category_slug]['keywords']);
}
