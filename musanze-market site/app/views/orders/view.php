<?php
if (!defined('BASE_URL')) define('BASE_URL', '../');
$pageTitle = 'Order ' . $order['order_ref'];
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/nav.php';
?>

<main class="container main-content">
    <div class="page-header">
        <div>
            <h1 class="page-title">📄 Order: <?= htmlspecialchars($order['order_ref']) ?></h1>
            <span class="badge badge--<?= $order['status'] ?> badge--lg"><?= ucfirst($order['status']) ?></span>
        </div>
        <div class="page-header__actions">
            <a href="index.php?route=orders/receipt&id=<?= $order['id'] ?>" class="btn btn--secondary">🖨 Print Receipt</a>
            <a href="index.php?route=orders/edit&id=<?= $order['id'] ?>" class="btn btn--primary">✏ Edit</a>
            <a href="index.php?route=orders" class="btn btn--outline">← Back</a>
        </div>
    </div>

    <div class="detail-grid">
        <!-- Order Info Card -->
        <div class="card">
            <div class="card__header"><h2 class="card__title">📦 Order Information</h2></div>
            <dl class="detail-list">
                <dt>Order Reference</dt>
                <dd><strong><?= htmlspecialchars($order['order_ref']) ?></strong></dd>

                <dt>Product</dt>
                <dd><?= htmlspecialchars($order['product_name']) ?></dd>

                <dt>Quantity</dt>
                <dd><?= number_format($order['quantity'], 2) ?> <?= htmlspecialchars($order['unit']) ?></dd>

                <dt>Unit Price</dt>
                <dd><?= number_format($order['unit_price'], 2) ?> RWF</dd>

                <dt>Total Amount</dt>
                <dd class="detail-list__total">RWF <?= number_format($order['total_amount'], 2) ?></dd>

                <dt>Pickup Location</dt>
                <dd><?= htmlspecialchars($order['pickup_location']) ?></dd>

                <dt>Pickup Date</dt>
                <dd><?= htmlspecialchars($order['pickup_date']) ?></dd>

                <dt>Status</dt>
                <dd><span class="badge badge--<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span></dd>

                <?php if ($order['notes']): ?>
                <dt>Notes</dt>
                <dd><?= nl2br(htmlspecialchars($order['notes'])) ?></dd>
                <?php endif; ?>

                <dt>Created By</dt>
                <dd><?= htmlspecialchars($order['created_by_name']) ?></dd>

                <dt>Date Created</dt>
                <dd><?= date('d M Y H:i', strtotime($order['created_at'])) ?></dd>
            </dl>
        </div>

        <!-- Supplier Info Card -->
        <div class="card">
            <div class="card__header"><h2 class="card__title">👨‍🌾 Supplier Information</h2></div>
            <dl class="detail-list">
                <dt>Name</dt>
                <dd><?= htmlspecialchars($order['supplier_name']) ?></dd>

                <dt>Phone</dt>
                <dd><a href="tel:<?= htmlspecialchars($order['supplier_phone']) ?>"><?= htmlspecialchars($order['supplier_phone']) ?></a></dd>

                <dt>Location</dt>
                <dd><?= htmlspecialchars($order['supplier_location']) ?></dd>
            </dl>

            <div class="detail-summary">
                <div class="detail-summary__label">Order Total</div>
                <div class="detail-summary__value">RWF <?= number_format($order['total_amount'], 0) ?></div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="index.php?route=orders/delete&id=<?= $order['id'] ?>"
           class="btn btn--danger"
           onclick="return confirm('Are you sure you want to delete this order?')">
            🗑 Delete Order
        </a>
    </div>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
