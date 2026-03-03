<?php
if (!defined('BASE_URL')) define('BASE_URL', '../');
$pageTitle = 'Suppliers';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/nav.php';
?>

<main class="container main-content">
    <div class="page-header">
        <div>
            <h1 class="page-title">👨‍🌾 Suppliers</h1>
            <p class="page-subtitle"><?= count($suppliers) ?> registered supplier(s)</p>
        </div>
        <a href="index.php?route=suppliers/create" class="btn btn--primary">+ Register Supplier</a>
    </div>

    <div class="filter-bar">
        <input class="form__input filter-bar__search" type="search" id="tableSearch" placeholder="🔍 Search suppliers...">
    </div>

    <div class="card">
        <div class="table-wrap">
            <table class="table" id="suppliersTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($suppliers)): ?>
                        <tr><td colspan="6" class="table__empty">No suppliers yet. <a href="index.php?route=suppliers/create">Register one →</a></td></tr>
                    <?php else: ?>
                        <?php foreach ($suppliers as $i => $s): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><strong><?= htmlspecialchars($s['name']) ?></strong></td>
                            <td><a href="tel:<?= htmlspecialchars($s['phone']) ?>"><?= htmlspecialchars($s['phone']) ?></a></td>
                            <td><?= htmlspecialchars($s['location']) ?></td>
                            <td><?= date('d M Y', strtotime($s['created_at'])) ?></td>
                            <td class="table__actions">
                                <a href="index.php?route=suppliers/edit&id=<?= $s['id'] ?>" class="btn btn--xs btn--secondary">Edit</a>
                                <a href="index.php?route=suppliers/delete&id=<?= $s['id'] ?>"
                                   class="btn btn--xs btn--danger"
                                   onclick="return confirm('Delete this supplier?')">✕</a>
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
