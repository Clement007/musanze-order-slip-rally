/**
 * Musanze Market Order Slip — main.js
 * Role 5: JavaScript Interaction Engineer
 *
 * Features:
 *  1. Live order total calculator (qty × price)
 *  2. Client-side form validation with user-friendly messages
 *  3. Mobile nav toggle
 *  4. Table search + status filter
 *  5. Password show/hide toggle
 *  6. Auto-dismiss flash messages
 */

'use strict';

// ── 1. DOMContentLoaded wrapper ───────────────────────────
document.addEventListener('DOMContentLoaded', () => {

  // Run all feature modules
  initNavToggle();
  initLiveCalculator();
  initOrderFormValidation();
  initSupplierFormValidation();
  initTableSearch();
  initStatusFilter();
  initPasswordToggle();
  initFlashAutoDismiss();

});

// ── 2. Mobile Nav Toggle ──────────────────────────────────
function initNavToggle() {
  const toggle = document.getElementById('navToggle');
  const links  = document.getElementById('navLinks');
  if (!toggle || !links) return;

  toggle.addEventListener('click', () => {
    const open = links.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  });

  // Close on outside click
  document.addEventListener('click', (e) => {
    if (!toggle.contains(e.target) && !links.contains(e.target)) {
      links.classList.remove('is-open');
    }
  });
}

// ── 3. Live Calculator ────────────────────────────────────
function initLiveCalculator() {
  const qtyInput   = document.getElementById('quantity');
  const priceInput = document.getElementById('unit_price');
  const unitSel    = document.getElementById('unit');
  const display    = document.getElementById('totalDisplay');
  const breakdown  = document.getElementById('calcBreakdown');
  const preview    = document.getElementById('calcPreview');

  if (!qtyInput || !priceInput || !display) return;

  function calculate() {
    const qty   = parseFloat(qtyInput.value)   || 0;
    const price = parseFloat(priceInput.value) || 0;
    const unit  = unitSel ? unitSel.value : 'kg';
    const total = qty * price;

    // Animate number update
    display.textContent = 'RWF ' + total.toLocaleString('en-RW', { maximumFractionDigits: 0 });

    if (breakdown) {
      breakdown.textContent = qty > 0 && price > 0
        ? `${qty.toLocaleString()} ${unit} × RWF ${price.toLocaleString()} = RWF ${total.toLocaleString()}`
        : '';
    }

    // Visual cue
    if (preview) {
      preview.style.opacity = total > 0 ? '1' : '0.6';
    }
  }

  qtyInput.addEventListener('input', calculate);
  priceInput.addEventListener('input', calculate);
  if (unitSel) unitSel.addEventListener('change', calculate);

  // Run once on load (for edit form with existing values)
  calculate();
}

// ── 4. Order Form Validation ──────────────────────────────
function initOrderFormValidation() {
  const form = document.getElementById('orderForm');
  if (!form || !document.getElementById('supplier_id')) return;

  form.addEventListener('submit', (e) => {
    let valid = true;

    const supplier  = document.getElementById('supplier_id');
    const product   = document.getElementById('product_name');
    const qty       = document.getElementById('quantity');
    const price     = document.getElementById('unit_price');
    const location  = document.getElementById('pickup_location');
    const date      = document.getElementById('pickup_date');

    clearErrors(form);

    if (supplier && !supplier.value) {
      showError(supplier, 'supplierErr', 'Please select a supplier.');
      valid = false;
    }
    if (product && !product.value.trim()) {
      showError(product, 'productErr', 'Product name is required.');
      valid = false;
    }
    if (qty && (isNaN(parseFloat(qty.value)) || parseFloat(qty.value) <= 0)) {
      showError(qty, 'qtyErr', 'Quantity must be a positive number.');
      valid = false;
    }
    if (price && (isNaN(parseFloat(price.value)) || parseFloat(price.value) <= 0)) {
      showError(price, 'priceErr', 'Unit price must be a positive number.');
      valid = false;
    }
    if (location && !location.value.trim()) {
      showError(location, 'locationErr', 'Pickup location is required.');
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
      // Scroll to first error
      const firstError = form.querySelector('.is-invalid');
      if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });

  // Real-time feedback on input
  ['quantity', 'unit_price'].forEach(id => {
    const el = document.getElementById(id);
    if (el) {
      el.addEventListener('input', () => {
        const errId = id === 'quantity' ? 'qtyErr' : 'priceErr';
        if (parseFloat(el.value) > 0) {
          el.classList.remove('is-invalid');
          el.classList.add('is-valid');
          setError(errId, '');
        }
      });
    }
  });
}

// ── 5. Supplier Form Validation ───────────────────────────
function initSupplierFormValidation() {
  const form = document.getElementById('supplierForm');
  if (!form || !document.getElementById('phone')) return;

  form.addEventListener('submit', (e) => {
    let valid = true;
    clearErrors(form);

    const name     = document.getElementById('name');
    const phone    = document.getElementById('phone');
    const location = document.getElementById('location');

    if (name && !name.value.trim()) {
      showError(name, 'nameErr', 'Supplier name is required.');
      valid = false;
    }
    if (phone) {
      const cleaned = phone.value.trim().replace(/[\s\-]/g, '');
      if (!cleaned || !/^\+?[\d]{7,15}$/.test(cleaned)) {
        showError(phone, 'phoneErr', 'Enter a valid phone number (e.g. +250788123456).');
        valid = false;
      }
    }
    if (location && !location.value.trim()) {
      showError(location, 'locationErr', 'Location is required.');
      valid = false;
    }

    if (!valid) e.preventDefault();
  });
}

// ── 6. Login Form Validation ──────────────────────────────
(function initLoginValidation() {
  const form = document.querySelector('.login-page form');
  if (!form) return;

  form.addEventListener('submit', (e) => {
    let valid = true;
    const email    = document.getElementById('email');
    const password = document.getElementById('password');
    clearErrors(form);

    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
      showError(email, 'emailError', 'Enter a valid email address.');
      valid = false;
    }
    if (password && password.value.length < 6) {
      showError(password, 'passwordError', 'Password must be at least 6 characters.');
      valid = false;
    }
    if (!valid) e.preventDefault();
  });
})();

// ── 7. Table Search ───────────────────────────────────────
function initTableSearch() {
  const input = document.getElementById('tableSearch');
  const table = document.getElementById('ordersTable') || document.getElementById('suppliersTable');
  if (!input || !table) return;

  input.addEventListener('input', () => {
    const query = input.value.toLowerCase().trim();
    const rows  = table.querySelectorAll('tbody tr[data-status], tbody tr:not(.table__empty)');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(query) ? '' : 'none';
    });
  });
}

// ── 8. Status Filter ──────────────────────────────────────
function initStatusFilter() {
  const select = document.getElementById('statusFilter');
  const table  = document.getElementById('ordersTable');
  if (!select || !table) return;

  select.addEventListener('change', () => {
    const status = select.value;
    table.querySelectorAll('tbody tr[data-status]').forEach(row => {
      row.style.display = (!status || row.dataset.status === status) ? '' : 'none';
    });
  });
}

// ── 9. Password Toggle ────────────────────────────────────
function initPasswordToggle() {
  const btn = document.getElementById('togglePw');
  const pw  = document.getElementById('password');
  if (!btn || !pw) return;

  btn.addEventListener('click', () => {
    const show = pw.type === 'password';
    pw.type = show ? 'text' : 'password';
    btn.textContent = show ? '🙈' : '👁';
    btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
  });
}

// ── 10. Flash Auto-dismiss ────────────────────────────────
function initFlashAutoDismiss() {
  const flash = document.querySelector('.flash');
  if (!flash) return;
  setTimeout(() => {
    flash.style.transition = 'opacity .4s ease';
    flash.style.opacity = '0';
    setTimeout(() => flash.remove(), 400);
  }, 4000);
}

// ── Helper Functions ──────────────────────────────────────
function showError(input, errId, message) {
  input.classList.add('is-invalid');
  setError(errId, message);
}

function setError(errId, message) {
  const el = document.getElementById(errId);
  if (el) el.textContent = message;
}

function clearErrors(form) {
  form.querySelectorAll('.is-invalid').forEach(el => {
    el.classList.remove('is-invalid');
    el.classList.remove('is-valid');
  });
  form.querySelectorAll('.form__error').forEach(el => el.textContent = '');
}
