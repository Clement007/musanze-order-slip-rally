<?php
if (!defined('BASE_URL')) define('BASE_URL', '../');
$pageTitle = 'Edit Order';
$data = $order; // use existing order as default values
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/nav.php';
?>

<main class="container main-content">
    <div class="page-header">
        <div>
            <h1 class="page-title">✏ Edit Order: <?= htmlspecialchars($order['order_ref']) ?></h1>
        </div>
        <a href="index.php?route=orders/view&id=<?= $order['id'] ?>" class="btn btn--outline">← Back to Order</a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert--danger">
            <strong>⚠ Please fix:</strong>
            <ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <div class="form-layout">
        <form class="card form" method="POST" action="index.php?route=orders/edit&id=<?= $order['id'] ?>" id="orderForm" novalidate>
            <div class="card__header">
                <h2 class="card__title">Order Details</h2>
                <span class="badge badge--<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span>
            </div>

            <div class="form__group">
                <label class="form__label" for="supplier_id">Supplier <span class="form__required">*</span></label>
                <select class="form__input" id="supplier_id" name="supplier_id" required>
                    <option value="">— Select —</option>
                    <?php foreach ($suppliers as $s): ?>
                        <option value="<?= $s['id'] ?>" <?= ($data['supplier_id'] == $s['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($s['name']) ?> (<?= htmlspecialchars($s['location']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form__group">
                <label class="form__label" for="product_name">Product <span class="form__required">*</span></label>
                <input class="form__input" type="text" id="product_name" name="product_name"
                    value="<?= htmlspecialchars($data['product_name']) ?>" required>
            </div>

            <div class="form__row form__row--3">
                <div class="form__group">
                    <label class="form__label" for="quantity">Quantity <span class="form__required">*</span></label>
                    <input class="form__input" type="number" id="quantity" name="quantity"
                        value="<?= htmlspecialchars($data['quantity']) ?>" min="0.01" step="0.01" required>
                </div>
                <div class="form__group">
                    <label class="form__label" for="unit">Unit</label>
                    <select class="form__input" id="unit" name="unit">
                        <?php foreach (['kg', 'tonne', 'bag', 'crate', 'piece'] as $u): ?>
                            <option value="<?= $u ?>" <?= ($data['unit'] === $u) ? 'selected' : '' ?>><?= $u ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form__group">
                    <label class="form__label" for="unit_price">Unit Price (RWF) <span class="form__required">*</span></label>
                    <input class="form__input" type="number" id="unit_price" name="unit_price"
                        value="<?= htmlspecialchars($data['unit_price']) ?>" min="1" step="0.01" required>
                </div>
            </div>

            <div class="calculator-preview" id="calcPreview">
                <div class="calculator-preview__label">💰 Estimated Total</div>
                <div class="calculator-preview__value" id="totalDisplay">RWF 0</div>
            </div>

            <div class="form__row">
                <div class="form__group">
                    <label class="form__label" for="pickup_location">Pickup Location <span class="form__required">*</span></label>
                    <input class="form__input" type="text" id="pickup_location" name="pickup_location"
                        value="<?= htmlspecialchars($data['pickup_location']) ?>" required>
                </div>
                <div class="form__group">
                    <label class="form__label" for="pickup_date">Pickup Date</label>
                    <input class="form__input" type="date" id="pickup_date" name="pickup_date"
                        value="<?= htmlspecialchars($data['pickup_date']) ?>" required>
                </div>
            </div>

            <div class="form__group">
                <label class="form__label" for="status">Status</label>
                <select class="form__input" id="status" name="status">
                    <?php foreach (['pending', 'confirmed', 'collected', 'cancelled'] as $s): ?>
                        <option value="<?= $s ?>" <?= ($data['status'] === $s) ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form__group">
                <label class="form__label" for="notes">Notes</label>
                <textarea class="form__input form__textarea" id="notes" name="notes"><?= htmlspecialchars($data['notes'] ?? '') ?></textarea>
            </div>

            <div class="form__actions">
                <a href="index.php?route=orders/view&id=<?= $order['id'] ?>" class="btn btn--outline">Cancel</a>
                <button type="submit" class="btn btn--primary">💾 Update Order</button>
            </div>
        </form>
    </div>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
