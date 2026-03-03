<?php
if (!defined('BASE_URL')) define('BASE_URL', '../');
$pageTitle = 'Register Supplier';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/nav.php';
?>

<main class="container main-content">
    <div class="page-header">
        <div>
            <h1 class="page-title">➕ Register Supplier</h1>
            <p class="page-subtitle">Add a new farmer or cooperative</p>
        </div>
        <a href="index.php?route=suppliers" class="btn btn--outline">← Back</a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert--danger">
            <ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <div class="form-layout form-layout--narrow">
        <form class="card form" method="POST" action="index.php?route=suppliers/create" id="supplierForm" novalidate>
            <div class="card__header"><h2 class="card__title">Supplier Details</h2></div>

            <div class="form__group">
                <label class="form__label" for="name">Full Name <span class="form__required">*</span></label>
                <input class="form__input" type="text" id="name" name="name"
                    value="<?= htmlspecialchars($data['name']) ?>"
                    placeholder="e.g. Uwimana Celestin" required>
                <span class="form__error" id="nameErr"></span>
            </div>

            <div class="form__group">
                <label class="form__label" for="phone">Phone Number <span class="form__required">*</span></label>
                <input class="form__input" type="tel" id="phone" name="phone"
                    value="<?= htmlspecialchars($data['phone']) ?>"
                    placeholder="+250788123456" required>
                <span class="form__error" id="phoneErr"></span>
            </div>

            <div class="form__group">
                <label class="form__label" for="location">Location / Sector <span class="form__required">*</span></label>
                <input class="form__input" type="text" id="location" name="location"
                    value="<?= htmlspecialchars($data['location']) ?>"
                    placeholder="e.g. Kinigi Sector, Musanze" required>
                <span class="form__error" id="locationErr"></span>
            </div>

            <div class="form__actions">
                <a href="index.php?route=suppliers" class="btn btn--outline">Cancel</a>
                <button type="submit" class="btn btn--primary">💾 Register Supplier</button>
            </div>
        </form>
    </div>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
