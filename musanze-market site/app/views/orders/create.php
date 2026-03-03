<?php
if (!defined('BASE_URL')) define('BASE_URL', '../');
$pageTitle = 'Create Order';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/nav.php';
?>

<main class="container main-content">
    <div class="page-header">
        <div>
            <h1 class="page-title">➕ New Order</h1>
            <p class="page-subtitle">Create a new potato order slip</p>
        </div>
        <a href="index.php?route=orders" class="btn btn--outline">← Back to Orders</a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert--danger">
            <strong>⚠ Please fix the following errors:</strong>
            <ul><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <div class="form-layout">
        <form class="card form" method="POST" action="index.php?route=orders/create" id="orderForm" novalidate>
            <div class="card__header">
                <h2 class="card__title">Order Details</h2>
            </div>

            <!-- Supplier -->
            <div class="form__group">
                <label class="form__label" for="supplier_id">Supplier / Farmer <span class="form__required">*</span></label>
                <select class="form__input" id="supplier_id" name="supplier_id" required>
                    <option value="">— Select supplier —</option>
                    <?php foreach ($suppliers as $s): ?>
                        <option value="<?= $s['id'] ?>" <?= ($data['supplier_id'] == $s['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($s['name']) ?> (<?= htmlspecialchars($s['location']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="form__error" id="supplierErr"></span>
                <a href="index.php?route=suppliers/create" class="form__hint" target="_blank">+ Add new supplier</a>
            </div>

            <!-- Product -->
            <div class="form__row">
                <div class="form__group">
                    <label class="form__label" for="product_name">Product <span class="form__required">*</span></label>
                    <input class="form__input" type="text" id="product_name" name="product_name"
                        value="<?= htmlspecialchars($data['product_name']) ?>"
                        placeholder="e.g. Irish Potato" required>
                    <span class="form__error" id="productErr"></span>
                </div>
            </div>

            <!-- Qty + Unit -->
            <div class="form__row form__row--3">
                <div class="form__group">
                    <label class="form__label" for="quantity">Quantity <span class="form__required">*</span></label>
                    <input class="form__input" type="number" id="quantity" name="quantity"
                        value="<?= htmlspecialchars($data['quantity']) ?>"
                        min="0.01" step="0.01" placeholder="500" required>
                    <span class="form__error" id="qtyErr"></span>
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
                        value="<?= htmlspecialchars($data['unit_price']) ?>"
                        min="1" step="0.01" placeholder="150" required>
                    <span class="form__error" id="priceErr"></span>
                </div>
            </div>

            <!-- LIVE TOTAL CALCULATOR -->
            <div class="calculator-preview" id="calcPreview">
                <div class="calculator-preview__label">💰 Estimated Total</div>
                <div class="calculator-preview__value" id="totalDisplay">RWF 0</div>
                <div class="calculator-preview__breakdown" id="calcBreakdown"></div>
            </div>

            <!-- Pickup -->
            <div class="form__row">
                <div class="form__group">
                    <label class="form__label" for="pickup_location">Pickup Location <span class="form__required">*</span></label>
                    <input class="form__input" type="text" id="pickup_location" name="pickup_location"
                        value="<?= htmlspecialchars($data['pickup_location']) ?>"
                        placeholder="e.g. Musanze Central Market" required>
                    <span class="form__error" id="locationErr"></span>
                </div>
                <div class="form__group">
                    <label class="form__label" for="pickup_date">Pickup Date <span class="form__required">*</span></label>
                    <input class="form__input" type="date" id="pickup_date" name="pickup_date"
                        value="<?= htmlspecialchars($data['pickup_date']) ?>"
                        min="<?= date('Y-m-d') ?>" required>
                </div>
            </div>

            <!-- Status + Notes -->
            <div class="form__row">
                <div class="form__group">
                    <label class="form__label" for="status">Status</label>
                    <select class="form__input" id="status" name="status">
                        <?php foreach (['pending', 'confirmed', 'collected', 'cancelled'] as $s): ?>
                            <option value="<?= $s ?>" <?= ($data['status'] === $s) ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form__group">
                <label class="form__label" for="notes">Notes (optional)</label>
                <textarea class="form__input form__textarea" id="notes" name="notes"
                    placeholder="Any additional notes about this order..."><?= htmlspecialchars($data['notes']) ?></textarea>
            </div>

            <div class="form__actions">
                <a href="index.php?route=orders" class="btn btn--outline">Cancel</a>
                <button type="submit" class="btn btn--primary">💾 Save Order</button>
            </div>
        </form>
    </div>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
