<?php
// Add BASE_URL for assets if not defined
if (!defined('BASE_URL')) define('BASE_URL', '../');
$pageTitle = 'Login';
require __DIR__ . '/../partials/header.php';
?>

<div class="login-page">
    <div class="login-card">
        <div class="login-card__header">
            <span class="login-card__logo">🥔</span>
            <h1 class="login-card__title">Musanze Market</h1>
            <p class="login-card__sub">Order Slip System</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert--danger">
                <?php foreach ($errors as $err): ?>
                    <p>⚠ <?= htmlspecialchars($err) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form class="form" method="POST" action="index.php?route=login" novalidate>
            <div class="form__group">
                <label class="form__label" for="email">Email Address</label>
                <input
                    class="form__input"
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($email ?? '') ?>"
                    placeholder="you@example.com"
                    required
                    autocomplete="email"
                >
                <span class="form__error" id="emailError"></span>
            </div>

            <div class="form__group">
                <label class="form__label" for="password">Password</label>
                <div class="form__password-wrap">
                    <input
                        class="form__input"
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="form__toggle-pw" id="togglePw" aria-label="Show password">👁</button>
                </div>
                <span class="form__error" id="passwordError"></span>
            </div>

            <button class="btn btn--primary btn--full" type="submit">Sign In →</button>
        </form>

        <p class="login-card__hint">
            Demo credentials: <strong>admin@musanze.rw</strong> / <strong>password</strong>
        </p>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
