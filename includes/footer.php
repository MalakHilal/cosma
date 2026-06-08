<footer>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <h4 style="color: var(--text-dark); font-weight: 700;">Ma Rosa</h4>
                <p class="mb-0 text-muted">L'élégance à votre image ✨</p>
            </div>
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <p class="mb-1"><i class="fa-solid fa-location-dot me-2 text-danger"></i> Boulvard El Massira, CASABLANCA</p>
                <p class="mb-0"><i class="fa-solid fa-envelope me-2" style="color: var(--text-dark);"></i> contact@marosa.com</p>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <a href="mailto:contact@marosa.com" class="btn btn-primary-custom">
                    <i class="fa-solid fa-paper-plane me-2"></i> Nous Contacter
                </a>
            </div>
        </div>
        <hr class="mt-4 mb-3" style="border-color: var(--border-color);">
        <p class="text-center text-muted small mb-0">&copy; <?= date('Y') ?> Ma Rosa. Tous droits réservés.</p>
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS Animation JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
</script>
</body>
</html>
