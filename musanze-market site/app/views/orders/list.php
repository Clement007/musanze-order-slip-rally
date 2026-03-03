<?php
if (!defined('BASE_URL')) define('BASE_URL', '../');
$pageTitle = 'All Orders';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/nav.php';
?>

<main class="container main-content">
    <div class="page-header">
        <div>
            <h1 class="page-title">📋 Orders</h1>
            <p class="page-subtitle"><?= count($orders) ?> total order(s)</p>
        </div>
        <a href="index.php?route=orders/create" class="btn btn--primary">+ New Order</a>
    </div>

    <!-- Filter bar -->
    <div class="filter-bar" id="filterBar">
        <input class="form__input filter-bar__search" type="search" id="tableSearch" placeholder="🔍 Search orders..." aria-label="Search orders">
        <select class="form__input filter-bar__select" id="statusFilter">
            <option value="">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="collected">Collected</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table class="table" id="ordersTable">
                <thead>
                    <tr>
                        <th>Order Ref</th>
                        <th>Supplier</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total (RWF)</th>
                        <th>Pickup Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="9" class="table__empty">No orders found. <a href="index.php?route=orders/create">Create your first order →</a></td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $o): ?>
                        <tr data-status="<?= $o['status'] ?>">
                            <td><strong><?= htmlspecialchars($o['order_ref']) ?></strong></td>
                            <td><?= htmlspecialchars($o['supplier_name']) ?></td>
                            <td><?= htmlspecialchars($o['product_name']) ?></td>
                            <td><?= number_format($o['quantity'], 1) ?> <?= htmlspecialchars($o['unit']) ?></td>
                            <td><?= number_format($o['unit_price'], 0) ?> RWF</td>
                            <td class="text-right fw-bold"><?= number_format($o['total_amount'], 0) ?></td>
                            <td><?= htmlspecialchars($o['pickup_date']) ?></td>
                            <td><span class="badge badge--<?= $o['status'] ?>"><?= ucfirst($o['status']) ?></span></td>
                            <td class="table__actions">
                                <a href="index.php?route=orders/view&id=<?= $o['id'] ?>" class="btn btn--xs btn--outline">View</a>
                                <a href="index.php?route=orders/edit&id=<?= $o['id'] ?>" class="btn btn--xs btn--secondary">Edit</a>
                                <a href="index.php?route=orders/receipt&id=<?= $o['id'] ?>" class="btn btn--xs btn--success" title="Print receipt">🖨</a>
                                <a href="index.php?route=orders/delete&id=<?= $o['id'] ?>" class="btn btn--xs btn--danger" onclick="return confirm('Delete this order?')">✕</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
