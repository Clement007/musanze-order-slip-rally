<?php
if (!defined('BASE_URL')) define('BASE_URL', '../');
$pageTitle = 'Dashboard';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/nav.php';
?>

<main class="container main-content">
    <div class="page-header">
        <div>
            <h1 class="page-title">📊 Dashboard</h1>
            <p class="page-subtitle">Welcome back, <?= htmlspecialchars($_SESSION['user_name']) ?>! Here's today's overview.</p>
        </div>
        <a href="index.php?route=orders/create" class="btn btn--primary">+ New Order</a>
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid">
        <div class="stat-card stat-card--blue">
            <div class="stat-card__icon">📋</div>
            <div class="stat-card__body">
                <p class="stat-card__label">Orders Today</p>
                <p class="stat-card__value"><?= number_format($stats['orders_today']) ?></p>
            </div>
        </div>
        <div class="stat-card stat-card--green">
            <div class="stat-card__icon">💰</div>
            <div class="stat-card__body">
                <p class="stat-card__label">Value Today (RWF)</p>
                <p class="stat-card__value"><?= number_format($stats['value_today'], 0) ?></p>
            </div>
        </div>
        <div class="stat-card stat-card--orange">
            <div class="stat-card__icon">⏳</div>
            <div class="stat-card__body">
                <p class="stat-card__label">Pending Orders</p>
                <p class="stat-card__value"><?= number_format($stats['pending']) ?></p>
            </div>
        </div>
        <div class="stat-card stat-card--purple">
            <div class="stat-card__icon">👨‍🌾</div>
            <div class="stat-card__body">
                <p class="stat-card__label">Total Suppliers</p>
                <p class="stat-card__value"><?= number_format($stats['suppliers_total']) ?></p>
            </div>
        </div>
        <div class="stat-card stat-card--teal">
            <div class="stat-card__icon">📦</div>
            <div class="stat-card__body">
                <p class="stat-card__label">Total Orders</p>
                <p class="stat-card__value"><?= number_format($stats['orders_total']) ?></p>
            </div>
        </div>
        <div class="stat-card stat-card--red">
            <div class="stat-card__icon">💵</div>
            <div class="stat-card__body">
                <p class="stat-card__label">Total Value (RWF)</p>
                <p class="stat-card__value"><?= number_format($stats['value_total'], 0) ?></p>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <section class="card">
        <div class="card__header">
            <h2 class="card__title">Recent Orders</h2>
            <a href="index.php?route=orders" class="btn btn--sm btn--outline">View All</a>
        </div>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ref</th>
                        <th>Supplier</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Total (RWF)</th>
                        <th>Pickup</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($recentOrders)): ?>
                        <tr><td colspan="8" class="table__empty">No orders yet. <a href="index.php?route=orders/create">Create one →</a></td></tr>
                    <?php else: ?>
                        <?php foreach ($recentOrders as $o): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($o['order_ref']) ?></strong></td>
                            <td><?= htmlspecialchars($o['supplier_name']) ?></td>
                            <td><?= htmlspecialchars($o['product_name']) ?></td>
                            <td><?= number_format($o['quantity'], 1) ?> <?= htmlspecialchars($o['unit']) ?></td>
                            <td class="text-right"><?= number_format($o['total_amount'], 0) ?></td>
                            <td><?= htmlspecialchars($o['pickup_date']) ?></td>
                            <td><span class="badge badge--<?= $o['status'] ?>"><?= ucfirst($o['status']) ?></span></td>
                            <td>
                                <a href="index.php?route=orders/view&id=<?= $o['id'] ?>" class="btn btn--xs btn--outline">View</a>
                                <a href="index.php?route=orders/receipt&id=<?= $o['id'] ?>" class="btn btn--xs btn--secondary">🖨 Receipt</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
