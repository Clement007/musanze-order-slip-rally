<nav class="navbar">
    <div class="navbar__brand">
        <span class="navbar__logo">🥔</span>
        <span class="navbar__title">Musanze Market</span>
    </div>

    <button class="navbar__toggle" id="navToggle" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>

    <ul class="navbar__links" id="navLinks">
        <?php if (!empty($_SESSION['user_id'])): ?>
            <li><a href="index.php?route=dashboard" class="<?= (($_GET['route'] ?? '') === 'dashboard' || ($_GET['route'] ?? '') === 'home') ? 'active' : '' ?>">📊 Dashboard</a></li>
            <li><a href="index.php?route=orders"    class="<?= str_starts_with($_GET['route'] ?? '', 'orders') ? 'active' : '' ?>">📋 Orders</a></li>
            <li><a href="index.php?route=suppliers" class="<?= str_starts_with($_GET['route'] ?? '', 'suppliers') ? 'active' : '' ?>">👨‍🌾 Suppliers</a></li>
            <li class="navbar__user">
                <span>👤 <?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></span>
                <a href="index.php?route=logout" class="btn btn--sm btn--outline">Logout</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
