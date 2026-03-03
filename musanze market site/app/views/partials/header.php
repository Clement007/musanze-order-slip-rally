<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musanze Market — <?= $pageTitle ?? 'Dashboard' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🥔</text></svg>">
</head>
<body>
<?php if (!empty($_SESSION['flash'])): 
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
?>
<div class="flash flash--<?= htmlspecialchars($flash['type']) ?>">
    <span><?= htmlspecialchars($flash['msg']) ?></span>
    <button class="flash__close" onclick="this.parentElement.remove()">✕</button>
</div>
<?php endif; ?>
