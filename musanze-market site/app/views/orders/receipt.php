<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt — <?= htmlspecialchars($order['order_ref']) ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Courier New', monospace; background: #f5f5f5; display: flex; justify-content: center; padding: 2rem; }
        .receipt { background: #fff; width: 380px; padding: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,.12); border-radius: 4px; }
        .receipt__top { text-align: center; border-bottom: 2px dashed #ccc; padding-bottom: 1rem; margin-bottom: 1rem; }
        .receipt__logo { font-size: 2.5rem; }
        .receipt__company { font-size: 1.1rem; font-weight: bold; margin: .4rem 0 .2rem; }
        .receipt__sub { font-size: .8rem; color: #666; }
        .receipt__title { font-size: .9rem; background: #1a1a2e; color: #fff; padding: .4rem .8rem; margin: 1rem 0; text-align: center; letter-spacing: 2px; }
        .receipt__row { display: flex; justify-content: space-between; font-size: .85rem; margin: .5rem 0; }
        .receipt__row--muted { color: #888; font-size: .8rem; }
        .receipt__divider { border: none; border-top: 1px dashed #ccc; margin: .8rem 0; }
        .receipt__total-row { display: flex; justify-content: space-between; font-size: 1.1rem; font-weight: bold; margin-top: 1rem; padding-top: .8rem; border-top: 2px solid #1a1a2e; }
        .receipt__footer { text-align: center; margin-top: 1.5rem; padding-top: 1rem; border-top: 2px dashed #ccc; font-size: .75rem; color: #888; }
        .receipt__ref { font-size: 1.2rem; font-weight: bold; letter-spacing: 2px; }
        .receipt__badge { display: inline-block; background: #2ecc71; color: #fff; font-size: .7rem; padding: .2rem .6rem; border-radius: 20px; text-transform: uppercase; letter-spacing: 1px; }
        .receipt__badge.pending { background: #f39c12; }
        .receipt__badge.confirmed { background: #3498db; }
        .receipt__badge.collected { background: #2ecc71; }
        .receipt__badge.cancelled { background: #e74c3c; }
        .no-print { display: flex; gap: .8rem; justify-content: center; margin: 1.5rem 0; }
        .btn { padding: .6rem 1.2rem; border: none; border-radius: 6px; cursor: pointer; font-size: .9rem; text-decoration: none; display: inline-block; }
        .btn-print { background: #1a1a2e; color: #fff; }
        .btn-back  { background: #eee; color: #333; }
        @media print {
            body { background: #fff; padding: 0; }
            .receipt { box-shadow: none; width: 100%; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

<div>
    <div class="no-print">
        <a href="index.php?route=orders/view&id=<?= $order['id'] ?>" class="btn btn-back">← Back to Order</a>
        <button class="btn btn-print" onclick="window.print()">🖨 Print Receipt</button>
    </div>

    <div class="receipt">
        <div class="receipt__top">
            <div class="receipt__logo">🥔</div>
            <div class="receipt__company">MUSANZE MARKET</div>
            <div class="receipt__sub">Order Slip System — Musanze, Rwanda</div>
        </div>

        <div class="receipt__title">ORDER RECEIPT</div>

        <div class="receipt__row">
            <span>Order Ref:</span>
            <span class="receipt__ref"><?= htmlspecialchars($order['order_ref']) ?></span>
        </div>
        <div class="receipt__row">
            <span>Status:</span>
            <span><span class="receipt__badge <?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span></span>
        </div>
        <div class="receipt__row receipt__row--muted">
            <span>Date Issued:</span>
            <span><?= date('d M Y, H:i') ?></span>
        </div>

        <hr class="receipt__divider">

        <div class="receipt__row">
            <span>Supplier:</span>
            <span><?= htmlspecialchars($order['supplier_name']) ?></span>
        </div>
        <div class="receipt__row receipt__row--muted">
            <span>Phone:</span>
            <span><?= htmlspecialchars($order['supplier_phone']) ?></span>
        </div>
        <div class="receipt__row receipt__row--muted">
            <span>Supplier Location:</span>
            <span><?= htmlspecialchars($order['supplier_location']) ?></span>
        </div>

        <hr class="receipt__divider">

        <div class="receipt__row">
            <span>Product:</span>
            <span><?= htmlspecialchars($order['product_name']) ?></span>
        </div>
        <div class="receipt__row">
            <span>Quantity:</span>
            <span><?= number_format($order['quantity'], 2) ?> <?= htmlspecialchars($order['unit']) ?></span>
        </div>
        <div class="receipt__row">
            <span>Unit Price:</span>
            <span>RWF <?= number_format($order['unit_price'], 2) ?></span>
        </div>

        <hr class="receipt__divider">

        <div class="receipt__row">
            <span>Pickup Location:</span>
            <span><?= htmlspecialchars($order['pickup_location']) ?></span>
        </div>
        <div class="receipt__row">
            <span>Pickup Date:</span>
            <span><?= htmlspecialchars($order['pickup_date']) ?></span>
        </div>

        <?php if ($order['notes']): ?>
        <hr class="receipt__divider">
        <div class="receipt__row receipt__row--muted">
            <span>Notes:</span>
            <span><?= htmlspecialchars($order['notes']) ?></span>
        </div>
        <?php endif; ?>

        <div class="receipt__total-row">
            <span>TOTAL DUE:</span>
            <span>RWF <?= number_format($order['total_amount'], 0) ?></span>
        </div>

        <div class="receipt__footer">
            <p>Created by: <?= htmlspecialchars($order['created_by_name']) ?></p>
            <p>Generated: <?= date('d M Y H:i:s') ?></p>
            <p style="margin-top:.6rem">Thank you for doing business with Musanze Market!</p>
            <p>Disputes? Call: +250 788 449 931</p>
        </div>
    </div>
</div>

</body>
</html>
