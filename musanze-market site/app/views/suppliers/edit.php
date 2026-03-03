<?php
if (!defined('BASE_URL')) define('BASE_URL', '../');
$pageTitle = 'Edit Supplier';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/nav.php';
?>

<main class="container main-content">
    <div class="page-header">
        <div>
            <h1 class="page-title">✏ Edit Supplier</h1>
        </div>
        <a href="index.php?route=suppliers" class="btn btn--outline">← Back</a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert--danger">
            <ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <div class="form-layout form-layout--narrow">
        <form class="card form" method="POST" action="index.php?route=suppliers/edit&id=<?= $supplier['id'] ?>" novalidate>
            <div class="card__header"><h2 class="card__title">Update Supplier</h2></div>

            <div class="form__group">
                <label class="form__label" for="name">Full Name <span class="form__required">*</span></label>
                <input class="form__input" type="text" id="name" name="name"
                    value="<?= htmlspecialchars($supplier['name']) ?>" required>
            </div>

            <div class="form__group">
                <label class="form__label" for="phone">Phone <span class="form__required">*</span></label>
                <input class="form__input" type="tel" id="phone" name="phone"
                    value="<?= htmlspecialchars($supplier['phone']) ?>" required>
            </div>

            <div class="form__group">
                <label class="form__label" for="location">Location <span class="form__required">*</span></label>
                <input class="form__input" type="text" id="location" name="location"
                    value="<?= htmlspecialchars($supplier['location']) ?>" required>
            </div>

            <div class="form__actions">
                <a href="index.php?route=suppliers" class="btn btn--outline">Cancel</a>
                <button type="submit" class="btn btn--primary">💾 Update</button>
            </div>
        </form>
    </div>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
